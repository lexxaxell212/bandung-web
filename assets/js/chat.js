/**
 * chatbot-front.js
 *
 * CHANGELOG:
 * ----------
 * [FIX]     XSS vulnerability — teks user & AI sebelumnya dirender via innerHTML
 *           tanpa sanitasi, sehingga input seperti <script>alert(1)</script> bisa
 *           dieksekusi. Sekarang pakai textContent untuk teks plain, dan fungsi
 *           sanitasi escapeHTML() untuk teks yang perlu dirender sebagai HTML.
 *
 * [FIX]     isLoading tidak direset jika response.json() gagal parse — sekarang
 *           selalu direset di blok finally.
 *
 * [FIX]     messageDiv.id di-set SETELAH appendChild — berpotensi race condition
 *           jika ada kode lain yang langsung cari ID. Sekarang di-set sebelum append.
 *
 * [FIX]     loadingId bisa null jika addMessage gagal — sekarang ada pengecekan
 *           sebelum .remove().
 *
 * [FEATURE] Conversation history — setiap pesan user & AI disimpan di array
 *           `conversationHistory` dan dikirim ke backend tiap request, sehingga
 *           AI bisa mengingat konteks percakapan sebelumnya.
 *
 * [FEATURE] Typing indicator yang lebih manusiawi — tiga titik animasi terpisah
 *           sebagai elemen DOM, bukan teks "..." statis.
 *
 * [FEATURE] Auto-resize textarea — input box tumbuh mengikuti panjang teks,
 *           menggantikan input satu baris yang tidak nyaman untuk pesan panjang.
 *
 * [IMPROVE] addMessage() direfactor — pisahkan pembuatan elemen DOM dari logika
 *           konten, hilangkan duplikasi blok user/ai yang hampir identik.
 *
 * [IMPROVE] Inline style dihapus dari JS — semua styling pakai CSS class,
 *           sehingga lebih mudah dikustomisasi dari stylesheet.
 *
 * [IMPROVE] removeLoadingBubble() — helper terpusat untuk hapus loading bubble,
 *           menghindari duplikasi getElementById().remove() di try & catch.
 *
 * [IMPROVE] clearChat() juga reset conversationHistory agar konteks ikut bersih.
 *
 * [IMPROVE] window.onload → DOMContentLoaded, lebih cepat dan lebih idiomatis.
 *
 * [IMPROVE] sendMessage() input validation dipindah lebih awal (sebelum DOM
 *           manipulation) sehingga tidak ada efek samping jika validasi gagal.
 */

const API_URL = "../api/groq-chat.php";
const TOPIC   = "bandung";
const TIMEOUT = 20_000;

// [FEATURE] Simpan history percakapan di sisi client
// Format: [{ role: 'user'|'assistant', content: string }]
let conversationHistory = [];
let isLoading = false;

// ─── Helper: Escape HTML ──────────────────────────────────────────────────────
// [FIX] Mencegah XSS — semua teks dari user/AI wajib di-escape sebelum dirender
function escapeHTML(str) {
  return str
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

// ─── Helper: Format teks AI ───────────────────────────────────────────────────
// Escape dulu, baru render newline sebagai <br>
function formatText(text) {
  return escapeHTML(text).replace(/\n/g, "<br>");
}

// ─── Helper: Waktu Sekarang ───────────────────────────────────────────────────
function currentTime() {
  return new Date().toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
}

// ─── Helper: Scroll ke Bawah ─────────────────────────────────────────────────
function scrollToBottom() {
  const messages = document.getElementById("chat-messages");
  messages.scrollTop = messages.scrollHeight;
}

// ─── Helper: Hapus Loading Bubble ────────────────────────────────────────────
// [IMPROVE] Terpusat, tidak duplikasi di try & catch
function removeLoadingBubble(id) {
  document.getElementById(id)?.remove();
}

// ─── addMessage ───────────────────────────────────────────────────────────────
// type: 'user' | 'ai' | 'error' | 'loading'
// [IMPROVE] Refactor — tidak ada duplikasi, semua styling via CSS class
function addMessage(text, type = "loading") {
  const messages = document.getElementById("chat-messages");
  const wrap = document.createElement("div");

  // [FIX] Set ID sebelum append
  wrap.id        = `msg_${Date.now()}_${Math.random().toString(36).slice(2, 6)}`;
  wrap.className = `message ${type}`;

  const bubble = document.createElement("div");
  bubble.className = "bubble";

  if (type === "loading") {
    // [FEATURE] Typing indicator animasi
    bubble.innerHTML = `
      <div class="typing-indicator">
        <span></span><span></span><span></span>
      </div>`;
  } else if (type === "error") {
    bubble.innerHTML = `<span class="error-text">⚠️ ${escapeHTML(text)}</span>`;
  } else {
    // user & ai sama strukturnya, beda label & class saja
    const label  = type === "user" ? "You" : "Yara";
    bubble.innerHTML = `
      <div class="msg-label">${label}</div>
      <div class="msg-text">${formatText(text)}</div>
      <div class="msg-time">${currentTime()}</div>`;
  }

  wrap.appendChild(bubble);
  messages.appendChild(wrap);
  scrollToBottom();

  return wrap.id;
}

// ─── sendMessage ──────────────────────────────────────────────────────────────
async function sendMessage() {
  if (isLoading) return;

  const input   = document.getElementById("message-input");
  const message = input.value.trim();

  // [IMPROVE] Validasi lebih awal, sebelum ada efek samping
  if (!message) return;

  // Tampilkan pesan user & reset input
  addMessage(message, "user");
  input.value = "";
  input.style.height = "auto"; // reset auto-resize
  input.focus();

  // [FEATURE] Simpan ke history sebelum kirim
  conversationHistory.push({ role: "user", content: message });

  const loadingId = addMessage("", "loading");
  isLoading = true;

  try {
    const controller = new AbortController();
    const timeout    = setTimeout(() => controller.abort(), TIMEOUT);

    const response = await fetch(API_URL, {
      method:  "POST",
      headers: { "Content-Type": "application/json" },
      // [FEATURE] Kirim history ke backend
      body:    JSON.stringify({ message, topic: TOPIC, history: conversationHistory }),
      signal:  controller.signal
    });

    clearTimeout(timeout);
    const data = await response.json();
    removeLoadingBubble(loadingId);

    if (data.success) {
      addMessage(data.reply, "ai");
      // [FEATURE] Simpan jawaban AI ke history
      conversationHistory.push({ role: "assistant", content: data.reply });
    } else {
      addMessage(data.error ?? "Terjadi kesalahan.", "error");
      // Rollback history user jika gagal
      conversationHistory.pop();
    }
  } catch (err) {
    removeLoadingBubble(loadingId);
    const msg = err.name === "AbortError"
      ? "Request timeout. Coba lagi ya Akang/Teteh 🙏"
      : "Koneksi bermasalah. Periksa jaringanmu.";
    addMessage(msg, "error");
    // Rollback history user jika gagal
    conversationHistory.pop();
  } finally {
    // [FIX] Selalu reset isLoading, termasuk jika response.json() throw
    isLoading = false;
  }
}

// ─── clearChat ────────────────────────────────────────────────────────────────
// [IMPROVE] Reset history juga agar konteks AI ikut bersih
function clearChat() {
  document.getElementById("chat-messages").innerHTML = "";
  conversationHistory = [];
  addMessage("Chat dibersihkan. Ada yang bisa Yara bantu lagi? 😊", "ai");
}

// ─── Auto-resize Textarea ─────────────────────────────────────────────────────
// [FEATURE] Input tumbuh mengikuti panjang teks
function autoResize(el) {
  el.style.height = "auto";
  el.style.height = Math.min(el.scrollHeight, 120) + "px"; // max 120px
}

// ─── Events ───────────────────────────────────────────────────────────────────
document.addEventListener("DOMContentLoaded", () => {
  const input = document.getElementById("message-input");

  input.addEventListener("keydown", (e) => {
    if (e.key === "Enter" && !e.shiftKey) {
      e.preventDefault();
      sendMessage();
    }
  });

  // [FEATURE] Auto-resize
  input.addEventListener("input", () => autoResize(input));

  // [IMPROVE] DOMContentLoaded lebih cepat dari window.onload
  addMessage("Wilujeng sumping! 👋 Yara siap bantu eksplor Bandung. Mau tanya apa nih, Akang/Teteh?", "ai");
  input.focus();
});