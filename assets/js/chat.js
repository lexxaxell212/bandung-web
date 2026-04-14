const API_URL = "../api/groq-chat.php"; // Dari assets/js/ → ../api/
let isLoading = false;

async function sendMessage() {
  if (isLoading) return;

  const input = document.getElementById("message-input");
  const messages = document.getElementById("chat-messages");
  const topic = document.getElementById("topic-select").value;

  const message = input.value.trim();
  if (!message) return;

  // User message
  addMessage(message, "user");
  input.value = "";
  input.focus();

  // Loading
  const loadingId = addMessage("\n 🚀 Web Assistant \n", "ai loading");
  isLoading = true;

  const startTime = performance.now();

  try {
    const controller = new AbortController();
    const timeout = setTimeout(() => controller.abort(), 20000);

    const response = await fetch(API_URL, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ message, topic }),
      signal: controller.signal
    });

    clearTimeout(timeout);
    const data = await response.json();

    // Remove loading
    document.getElementById(loadingId).remove();

    if (data.success) {
      addMessage(data.reply, "ai");
      updateStats(data.tokens, performance.now() - startTime, data.model);
    } else {
      addMessage(`❌ ${data.error}`, "error");
    }
  } catch (error) {
    document.getElementById(loadingId).remove();
    addMessage(`❌ ${error.message}`, "error");
  }

  isLoading = false;
}

function addMessage(text, type) {
  const messages = document.getElementById("chat-messages");
  const div = document.createElement("div");
  div.className = `message ${type}`;
  div.innerHTML = text.replace(/\n/g, "<br>");
  messages.appendChild(div);
  messages.scrollTop = messages.scrollHeight;
  return (div.id = "msg_" + Date.now());
}

function updateStats(tokens, time, model) {
  document.getElementById("token-count").textContent = `Tokens: ${tokens}`;
  document.getElementById("response-time").textContent = `${(
    time / 1000
  ).toFixed(2)}s`;
  document.getElementById("model-used").textContent = model;
}

function clearChat() {
  document.getElementById("chat-messages").innerHTML = "";
  updateStats(0, 0, "-");
}

// Events
document.getElementById("message-input").addEventListener("keypress", (e) => {
  if (e.key === "Enter" && !e.shiftKey) {
    e.preventDefault();
    sendMessage();
  }
});

// Welcome
window.onload = () => {
  addMessage("🚀 Selamat datang!🚀 ", "ai");
  document.getElementById("message-input").focus();
};
