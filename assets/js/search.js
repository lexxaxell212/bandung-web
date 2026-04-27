// DATA KONTEN
const data = [
  {
    title: "Artikel terbaru",
    url: "/artikel-terbaru",
    category: "artikel",
    content: "artikel"
  },
  {
    title: "Budaya",
    url: "/budaya",
    category: "artikel",
    content: "budaya"
  },
  {
    title: "Informasi terkini",
    url: "/informasi-terkini",
    category: "Artikel",
    content: "Informasi terkini"
  },
  {
    title: "Kenapa harus bandung",
    url: "/kenapa-harus-bandung",
    category: "artikel",
    content: "kenapa harus bandung"
  },
  {
    title: "Kritik dan Saran",
    url: "/kritik-dan-saran",
    category: "Artikel",
    content: "Kritik dan Saran"
  },
  {
    title: "Kuliner",
    url: "/kuliner",
    category: "Artikel",
    content: "Kuliner"
  },
  {
    title: "Panduan Maps",
    url: "/panduan-maps",
    category: "Artikel",
    content: "Panduan maps"
  },
  {
    title: "Penginapan",
    url: "/penginapan",
    category: "Artikel",
    content: "Penginapan"
  },
  {
    title: "Privacy Policy",
    url: "/privacy-policy",
    category: "Artikel",
    content: "Privacy policy"
  },
  {
    title: "Sejarah",
    url: "/sejarah",
    category: "Artikel",
    content: "Sejarah"
  }
];

// ELEMENTS - NULL SAFE
const input = document.getElementById("searchInput");
const results = document.getElementById("results");
const typing = document.getElementById("typing");
const stats = document.getElementById("stats");
const noResults = document.getElementById("noResults");
const countEl = document.getElementById("count");
const queryEl = document.getElementById("query");
let timeout;

// Format kategori konsisten (Artikel)
function formatCategory(category) {
  return category.charAt(0).toUpperCase() + category.slice(1).toLowerCase();
}

// Main input event handler - FIXED FLOW
if (input) {
  input.addEventListener("input", function () {
    const q = this.value.trim();

    // 1. SELALU RESETUI PERTAMA
    resetUI();

    // 2. INPUT KOSONG = EXIT BERSIH
    if (q.length === 0) return;

    // 3. VALIDASI
    const validation = validateInput(q);
    if (!validation.isValid) {
      showValidationError(validation.message);
      return;
    }

    // 4. SEARCH
    const query = q.toLowerCase();
    clearTimeout(timeout);
    if (typing) typing.style.display = "block";
    timeout = setTimeout(() => search(query), 100);
  });
}

// Validasi input
function validateInput(input) {
  if (input.length < 2) {
    return { isValid: false, message: "❌ Minimal 2 karakter untuk pencarian" };
  }
  if (!/^[a-zA-Z0-9\s]+$/.test(input)) {
    return { isValid: false, message: "❌ Hanya huruf, angka, dan spasi yang diperbolehkan" };
  }
  if (/^\s+$/.test(input)) {
    return { isValid: false, message: "❌ Pencarian tidak boleh hanya spasi" };
  }
  return { isValid: true };
}

// Tampilkan pesan error validasi - NO RESET
function showValidationError(message) {
  if (noResults) {
    noResults.innerHTML = `<p style="padding: 3px; color: #3F83F8; margin-bottom: 20px;opacity:0.8;">${message}</p>`;
    noResults.style.display = "block";
  }
}

// Filter & sort data berdasarkan query
function search(query) {
  const found = data
    .filter(
      (item) =>
        item.title.toLowerCase().includes(query) ||
        item.content.toLowerCase().includes(query) ||
        item.category.toLowerCase().includes(query)
    )
    .sort((a, b) => {
      const getScore = (item) => {
        let score = 0;
        if (item.title.toLowerCase().includes(query)) score += 3;
        if (item.category.toLowerCase().includes(query)) score += 2;
        if (item.content.toLowerCase().includes(query)) score += 1;
        return score;
      };
      return getScore(b) - getScore(a);
    })
    .slice(0, 6);

  showResults(found, query);
}

// Render hasil pencarian
function showResults(items, query) {
  if (typing) typing.style.display = "none";

  if (items.length === 0) {
    showNoResults(`Tidak ditemukan "${query}"`);
    return;
  }

  if (countEl) countEl.textContent = items.length;
  if (queryEl) queryEl.textContent = `"${query}"`;
  if (stats) stats.style.display = "block";

  if (results) {
    results.innerHTML = items
      .map(
        (item) => `
        <a href="${item.url}" style="color:inherit;text-decoration:none;">
          <div class="result">
            <div class="result-card">
              <div class="result-header">
                <div class="result-title">${safeHighlight(item.title, query)}</div>
                <span class="result-category">${formatCategory(item.category)}</span>
              </div>
              <div class="result-body">
                <div class="result-snippet">${safeHighlight(
                  getSnippet(item, query),
                  query
                )}</div>
              </div>
            </div>
          </div>
        </a>
      `)
      .join("");
  }

  if (noResults) noResults.style.display = "none";
}

// Tampilkan pesan no results - NO RESET
function showNoResults(message) {
  if (noResults) {
    noResults.innerHTML = `<p style="padding: 3px; color: #3F83F8; margin-bottom: 20px;opacity:0.8;">${message}</p>`;
    noResults.style.display = "block";
  }
}

// Reset semua UI elements - PERFECT
function resetUI() {
  if (results) results.innerHTML = "";
  if (typing) typing.style.display = "none";
  if (stats) stats.style.display = "none";
  if (noResults) {
    noResults.innerHTML = "";
    noResults.style.display = "none";
  }
}


// Highlight query dalam text (safe, no regex)
function safeHighlight(text, query) {
  if (!query || query.length === 0) return escapeHtml(text);
  const lowerText = text.toLowerCase();
  const lowerQuery = query.toLowerCase();
  let result = "";
  let lastIndex = 0;
  let index = lowerText.indexOf(lowerQuery);
  while (index !== -1) {
    result += escapeHtml(text.slice(lastIndex, index));
    const matchEnd = index + query.length;
    result += `<span class="highlight">${escapeHtml(text.slice(index, matchEnd))}</span>`;
    lastIndex = matchEnd;
    index = lowerText.indexOf(lowerQuery, lastIndex);
  }
  result += escapeHtml(text.slice(lastIndex));
  return result;
}

// Ambil snippet yang relevan
function getSnippet(item, query) {
  let snippet = item.content;
  if (item.content.toLowerCase().includes(query.toLowerCase())) {
    snippet = getContextSnippet(item.content, query);
  } else {
    snippet = item.title;
  }
  return snippet.length > 80 ? snippet.slice(0, 80) + "..." : snippet;
}

// Ambil konteks sekitar query
function getContextSnippet(content, query) {
  const lowerContent = content.toLowerCase();
  const queryIndex = lowerContent.indexOf(query.toLowerCase());
  if (queryIndex === -1) return content;
  const start = Math.max(0, queryIndex - 30);
  const end = Math.min(content.length, queryIndex + query.length + 50);
  return content.slice(start, end);
}

// Escape HTML untuk keamanan XSS
function escapeHtml(text) {
  const map = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': "&quot;",
    "'": "&#039;"
  };
  return text.replace(/[&<>"']/g, (m) => map[m]);
}

// Auto focus input
if (input) input.focus();