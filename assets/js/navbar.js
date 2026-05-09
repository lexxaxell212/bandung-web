const toggler = document.getElementById("navbarToggler");
const menuOverlay = document.getElementById("menuOverlay");
const navbarCollapse = document.getElementById("navbarNav");

// Fungsi pembantu untuk menutup Offcanvas Bootstrap 5
function closeAllOffcanvas() {
  const activeOffcanvas = document.querySelector('.offcanvas.show');
  if (activeOffcanvas && window.bootstrap?.Offcanvas) {
    const instance = window.bootstrap.Offcanvas.getInstance(activeOffcanvas);
    if (instance) instance.hide();
  }
}

function toggleMenu() {
  const isOpen = menuOverlay.classList.contains("menu-open");

  if (isOpen) {
    menuOverlay.classList.remove("menu-open");
    navbarCollapse.classList.remove("menu-open");
    toggler.classList.remove("menu-open");
    document.body.style.overflow = "";
  } else {
    // Tutup Chatbot dulu sebelum buka Menu Utama
    closeAllOffcanvas();

    menuOverlay.classList.add("menu-open");
    navbarCollapse.classList.add("menu-open");
    toggler.classList.add("menu-open");
    document.body.style.overflow = "hidden";
  }
}

// Event Listeners Navigasi
if (toggler) toggler.addEventListener("click", toggleMenu);
if (menuOverlay) menuOverlay.addEventListener("click", toggleMenu);

// Global Listener untuk Keyboard (Escape)
document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    if (menuOverlay?.classList.contains("menu-open")) {
      toggleMenu();
    }
  }
});

// chat bot modal
class SmartFab {
  constructor(fabId = "chatbotFabBtn", scrollThreshold = 200) {
    this.fab = document.getElementById(fabId);
    this.threshold = scrollThreshold;
    this.isVisible = false;
    this.init();
  }

  init() {
    if (!this.fab) return;
    this.updateVisibility();
    this.handleScroll = this.throttle(this.handleScroll.bind(this), 16);
    window.addEventListener("scroll", this.handleScroll, { passive: true });
    window.addEventListener("beforeunload", () => this.destroy());
    this.fab.addEventListener("click", this.onFabClick);
  }

  onFabClick = () => {
    // Tutup Menu Utama dulu kalau sedang terbuka sebelum buka Chatbot
    if (menuOverlay && menuOverlay.classList.contains("menu-open")) {
      toggleMenu();
    }
    this.toggleChatbot();
  };

  toggleChatbot() {
    const chatbotElement = document.getElementById("chatbot");
    if (window.bootstrap?.Offcanvas && chatbotElement) {
      const modal =
        window.bootstrap.Offcanvas.getInstance(chatbotElement) ||
        new window.bootstrap.Offcanvas(chatbotElement);
      modal.toggle();
    }
  }

  handleScroll() {
    this.updateVisibility();
  }

  updateVisibility() {
    const shouldShow = window.scrollY >= this.threshold;
    if (shouldShow && !this.isVisible) {
      this.show();
    } else if (!shouldShow && this.isVisible) {
      this.hide();
    }
  }

  show() {
    this.fab.style.opacity = "1";
    this.fab.style.transform = "scale(1) translateY(0)";
    this.fab.style.visibility = "visible";
    this.fab.style.animation = "fabSlideIn 0.4s cubic-bezier(0.4, 0, 0.2, 1)";
    this.isVisible = true;
  }

  hide() {
    this.fab.style.opacity = "0";
    this.fab.style.transform = "scale(0.8) translateY(20px)";
    this.isVisible = false;
    setTimeout(() => {
      if (!this.isVisible) {
        this.fab.style.visibility = "hidden";
      }
    }, 300);
  }

  throttle(func, limit) {
    let inThrottle;
    return function () {
      const args = arguments;
      const context = this;
      if (!inThrottle) {
        func.apply(context, args);
        inThrottle = true;
        setTimeout(() => (inThrottle = false), limit);
      }
    };
  }

  destroy() {
    window.removeEventListener("scroll", this.handleScroll);
    this.fab.removeEventListener("click", this.onFabClick);
  }
}

// scroll top
class SmartScrollTop {
  constructor(btnId = "scrollTopBtn") {
    this.btn = document.getElementById(btnId);
    this.isVisible = false;
    this.scrollToTopHandler = null;
    this.init();
  }

  init() {
    if (!this.btn) return;

    this.scrollToTopHandler = (e) => {
      e.preventDefault();
      this.scrollToTop();
    };

    this.updateVisibility();
    window.addEventListener(
      "scroll",
      this.throttle(this.handleScroll.bind(this), 16),
      { passive: true }
    );
    window.addEventListener(
      "resize",
      this.throttle(this.handleResize.bind(this), 250)
    );
    this.btn.addEventListener("click", this.scrollToTopHandler);
  }

  destroy() {
    window.removeEventListener("scroll", this.handleScroll);
    window.removeEventListener("resize", this.handleResize);
    if (this.btn && this.scrollToTopHandler) {
      this.btn.removeEventListener("click", this.scrollToTopHandler);
    }
  }

  handleScroll() {
    const nearBottom = this.isNearBottom();
    if (nearBottom && !this.isVisible) {
      this.show();
    } else if (!nearBottom && this.isVisible) {
      this.hide();
    }
  }

  isNearBottom() {
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight;
    const halfDocHeight = docHeight * 0.25;
    const scrolledFromBottom = docHeight - scrollTop - window.innerHeight;
    return scrolledFromBottom <= halfDocHeight;
  }

  handleResize() {
    this.updateVisibility();
  }

  scrollToTop() {
    window.scrollTo({ top: 0, behavior: "smooth" });
  }

  show() {
    this.btn.style.opacity = "1";
    this.btn.style.transform = "scale(1) translateY(0)";
    this.btn.style.visibility = "visible";
    this.isVisible = true;
  }

  hide() {
    this.btn.style.opacity = "0";
    this.btn.style.transform = "scale(0.7) translateY(20px)";
    this.isVisible = false;
    setTimeout(() => {
      if (!this.isVisible) this.btn.style.visibility = "hidden";
    }, 300);
  }

  updateVisibility() {
    const nearBottom = this.isNearBottom();
    if (nearBottom) this.show();
    else this.hide();
  }

  throttle(func, limit) {
    let inThrottle;
    return function () {
      if (!inThrottle) {
        func.apply(this, arguments);
        inThrottle = true;
        setTimeout(() => (inThrottle = false), limit);
      }
    }.bind(this);
  }
}

// DARKMODE
function toggleDark(el) {
  document.documentElement.toggleAttribute("data-dark");
  el.classList.toggle("on");
  localStorage.dark = document.documentElement.hasAttribute("data-dark");
}

// Inisialisasi saat DOM siap
document.addEventListener("DOMContentLoaded", () => {
  new SmartFab("chatbotFabBtn", 200);
  new SmartScrollTop("scrollTopBtn");
  
  const chatbotElement = document.getElementById("chatbot");
  
  const refreshScrollLock = () => {
    const isMenuOpen = menuOverlay?.classList.contains("menu-open");
    const isOffcanvasOpen = document.querySelector('.offcanvas.show');
    
    if (!isMenuOpen && !isOffcanvasOpen) {
      document.body.style.overflow = "";
      document.body.style.paddingRight = "";
    }
  };

  if (chatbotElement) {
    chatbotElement.addEventListener('show.bs.offcanvas', () => {
      document.body.style.overflow = "hidden";
    });

    chatbotElement.addEventListener('hidden.bs.offcanvas', refreshScrollLock);
  }

  document.addEventListener('click', (e) => {
    if (e.target.closest('[data-bs-dismiss="offcanvas"]')) {
      setTimeout(refreshScrollLock, 100);
    }
  });


  // Load saved dark mode state
  if (localStorage.dark === "true") {
    document.documentElement.setAttribute("data-dark", "");
    const switchEl = document.querySelector(".switch");
    if (switchEl) switchEl.classList.add("on");
  }
});
