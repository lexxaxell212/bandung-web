// Menu Toggle
const toggler = document.getElementById("navbarToggler");
const navbarCollapse = document.getElementById("navbarNav");
const menuOverlay = document.getElementById("menuOverlay");

function toggleMenu() {
  const isOpen = navbarCollapse.classList.contains("show");
  navbarCollapse.classList.toggle("show", !isOpen);
  menuOverlay.classList.toggle("show", !isOpen);
  toggler.classList.toggle("menu-open", !isOpen);
  document.body.style.overflow = isOpen ? "" : "hidden";
}

toggler.addEventListener("click", toggleMenu);
menuOverlay.addEventListener("click", toggleMenu);

document.addEventListener("keydown", (e) => {
  if (e.key === "Escape" && navbarCollapse.classList.contains("show")) {
    toggleMenu();
  }
});

// DARKMODE
function toggleDark(el) {
  document.documentElement.toggleAttribute("data-dark");
  el.classList.toggle("on");
  localStorage.dark = document.documentElement.hasAttribute("data-dark");
}

// Load saved state
if (localStorage.dark === "true") {
  document.documentElement.setAttribute("data-dark", "");
  document.querySelector(".switch").classList.add("on");
}

// MODAL ELEMENTS
const searchBtn = document.getElementById("searchBtn");
const searchModalBackdrop = document.getElementById("searchModalBackdrop");
const searchModalContainer = document.getElementById("searchModalContainer");
const searchModalClose = document.getElementById("searchModalClose");
const searchInput = document.getElementById("searchInput");
const searchResults = document.getElementById("searchResults");

// SLIDE FUNCTIONS

function openSearchModal() {
  if (navbarNav.classList.contains("show")) toggleMenu();
  searchModalBackdrop.classList.add("show");
  searchModalContainer.classList.add("show");
  setTimeout(() => {
    searchInput.focus();
    searchInput.select();
  }, 300);
}

function closeSearchModal() {
  searchModalBackdrop.classList.remove("show");
  searchModalContainer.classList.remove("show");
}

// EVENT LISTENERS
searchBtn.onclick = openSearchModal;
searchModalClose.onclick = closeSearchModal;
searchModalBackdrop.onclick = closeSearchModal;

// KEYBOARD SHORTCUTS
document.addEventListener("keydown", (e) => {
  if ((e.ctrlKey || e.metaKey) && e.key === "k") {
    e.preventDefault();
    openSearchModal();
  }

  if (e.key === "Escape") {
    if (searchModalContainer.classList.contains("show")) {
      closeSearchModal();
    }
  }
});


// Chatbot modal
let chatbotModal;

// Initialize
document.addEventListener("DOMContentLoaded", () => {
  chatbotModal = new bootstrap.Offcanvas(document.getElementById("chatbot"));
});

function toggleChatbot() {
  chatbotModal.toggle();
  if (chatbotModal._isShown()) {
    document.getElementById("chat-input").focus();
  }
}

function closeChatbot() {
  chatbotModal.hide();
}

