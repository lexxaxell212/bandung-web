const toggler = document.getElementById("navbarToggler");
const menuOverlay = document.getElementById("menuOverlay");
const navbarCollapse = document.getElementById("navbarNav");
const searchBtn = document.getElementById("searchBtn");
const searchBody = document.getElementById("searchBody");
const searchModalBackdrop = document.getElementById("searchModalBackdrop");
const searchModalContainer = document.getElementById("searchModalContainer");
const searchModalClose = document.getElementById("searchModalClose");
const searchInput = document.getElementById("searchInput");

function toggleMenu() {
  const isOpen = menuOverlay.classList.contains("menu-open");

  if (isOpen) {
    menuOverlay.classList.remove("menu-open");
    navbarCollapse.classList.remove("menu-open");
    toggler.classList.remove("menu-open");
    document.body.style.overflow = "";
  } else {
    menuOverlay.classList.add("menu-open");
    navbarCollapse.classList.add("menu-open");
    toggler.classList.add("menu-open");
    document.body.style.overflow = "hidden";
  }
}

function openSearchModal() {
  if (navbarCollapse.classList.contains("menu-open")) {
    toggleMenu();
  }
  searchBody.classList.add("search-open-show");
  searchModalBackdrop.classList.add("search-open-show");
  searchModalContainer.classList.add("search-open-show");
  document.body.style.overflow = "hidden";
  setTimeout(() => {
    searchInput?.focus();
    searchInput?.select();
  }, 50);
}

function closeSearchModal() {
  searchBody.classList.remove("search-open-show");
  searchModalBackdrop.classList.remove("search-open-show");
  searchModalContainer.classList.remove("search-open-show");
  document.body.style.overflow = "";
   resetUI();
  if (input) {
    input.value = "";
    input.focus();
  }
}

if (toggler) toggler.addEventListener("click", toggleMenu);
if (menuOverlay) menuOverlay.addEventListener("click", toggleMenu);
if (searchBtn) searchBtn.onclick = openSearchModal;

if (searchBody) {
  searchBody.onclick = closeSearchModal;
}

if (searchModalClose) {
  searchModalClose.onclick = (e) => {
    e.stopPropagation();
    closeSearchModal();
  };
}

if (searchModalBackdrop) {
  searchModalBackdrop.onclick = (e) => {
    e.stopPropagation();
    closeSearchModal();
  };
}

if (searchModalContainer) {
  searchModalContainer.onclick = (e) => {
    e.stopPropagation();
  };
}

document.addEventListener("keydown", (e) => {
  if ((e.ctrlKey || e.metaKey) && e.key === "k") {
    e.preventDefault();
    openSearchModal();
  }
  if (e.key === "Escape") {
    if (menuOverlay?.classList.contains("menu-open")) {
      toggleMenu();
    } else if (searchBody?.classList.contains("search-open-show")) {
      closeSearchModal();
    }
  }
});

// chat bot modal

const blueIconFab = document.getElementById("chatbotFabBtn");
const fabLabel = document.querySelector(".fab-chatbot-label");
let chatbotModal = null;

function initChatbot() {
  const chatbotElement = document.getElementById("chatbot");
  if (chatbotElement && window.bootstrap?.Offcanvas) {
    chatbotModal = new window.bootstrap.Offcanvas(chatbotElement);
  }
}

function toggleChatbot() {
  if (chatbotModal?.toggle) {
    chatbotModal.toggle();
    setTimeout(() => {
      const chatInput = document.getElementById("message-input");
      if (
        chatInput &&
        document.getElementById("chatbot")?.classList.contains("show")
      ) {
        chatInput.focus();
      }
    }, 500);
  }
}

function closeChatbot() {
  if (chatbotModal?.hide) {
    chatbotModal.hide();
  }
}

document.addEventListener("DOMContentLoaded", () => {
  initChatbot();

  blueIconFab?.addEventListener("click", function (e) {
    e.stopPropagation();
    e.preventDefault();
    this.style.transform = "scale(0.94)";
    setTimeout(() => (this.style.transform = ""), 150);
    toggleChatbot();
  });

  blueIconFab?.addEventListener("mouseenter", function (e) {
    e.stopPropagation();
    fabLabel.style.transition = "all 0.3s cubic-bezier(0.4, 0, 0.2, 1)";
    fabLabel.style.animation = "none";
    fabLabel.style.opacity = "1";
    fabLabel.style.transform = "translateY(-6px) scale(1.05)";
  });

  blueIconFab?.addEventListener("mouseleave", function (e) {
    e.stopPropagation();
    setTimeout(() => {
      fabLabel.style.transition = "all 0.35s cubic-bezier(0.4, 0, 0.2, 1)";
      fabLabel.style.animation = "fab-chatbot-blueLabelOut 0.35s forwards";
    }, 3000);
  });
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
