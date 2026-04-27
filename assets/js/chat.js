const API_URL = "../api/groq-chat.php";
let isLoading = false;

async function sendMessage() {
  if (isLoading) return;

  const input = document.getElementById("message-input");
  const messages = document.getElementById("chat-messages");
  const topic = "bandung";

  const message = input.value.trim();
  if (!message) return;

  // User message
  addMessage(message, "user");
  input.value = "";
  input.focus();

  // Loading
  const loadingId = addMessage("Tunggu sebentar yah..");
  isLoading = true;

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
  const messageDiv = document.createElement("div");
  messageDiv.className = `message ${type}`;
  
  let content = `<div class="bubble">`;
  
  if (type === 'user') {
    content += `
      <div style="font-size: 14px; opacity: 0.9; margin-bottom: 4px;font-weight:700;">You</div>
      <div style="line-height: 1.5;">${text.replace(/\n/g, "<br>")}</div>
      <div style="font-size: 11px; opacity: 0.7; margin-top: 8px;">
        ${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}
      </div>
    `;
  } else if (type === 'ai') {
    content += `
      <div style="font-size: 14px; opacity: 0.9; margin-bottom: 4px;font-weight:700;">Bot</div>
      <div style="line-height: 1.5;">${text.replace(/\n/g, "<br>")}</div>
      <div style="font-size: 11px; opacity: 0.7; margin-top: 8px;">
        ${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}
      </div>
    `;
  } else {
    content += text;
  }
  
  content += `</div>`;
  messageDiv.innerHTML = content;
  
  messages.appendChild(messageDiv);
  messages.scrollTop = messages.scrollHeight;
  
  messageDiv.id = "msg_" + Date.now();
  return messageDiv.id;
}

function clearChat() {
  document.getElementById("chat-messages").innerHTML = "";
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
addMessage("Hai.. mau tanya apa nih?","ai");
document.getElementById("message-input").focus();
};