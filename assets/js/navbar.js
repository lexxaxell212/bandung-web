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
class SmartFab {
    constructor(fabId = 'chatbotFabBtn', scrollThreshold = 200) {
        this.fab = document.getElementById(fabId);
        this.threshold = scrollThreshold;
        this.isVisible = false;
        this.init();
    }

    init() {
        if (!this.fab) return;
        this.updateVisibility();
        this.handleScroll = this.throttle(this.handleScroll.bind(this), 16);
        window.addEventListener('scroll', this.handleScroll, { passive: true });
        window.addEventListener('beforeunload', () => this.destroy());
        this.fab.addEventListener('click', this.onFabClick);
    }

    onFabClick = () => {
        this.toggleChatbot();
    }

    toggleChatbot() {
        const chatbotElement = document.getElementById("chatbot");
        if (window.bootstrap?.Offcanvas && chatbotElement) {
            const modal = window.bootstrap.Offcanvas.getInstance(chatbotElement) || 
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
        this.fab.style.opacity = '1';
        this.fab.style.transform = 'scale(1) translateY(0)';
        this.fab.style.visibility = 'visible';
        this.fab.style.animation = 'fabSlideIn 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
        this.isVisible = true;
    }

    hide() {
        this.fab.style.opacity = '0';
        this.fab.style.transform = 'scale(0.8) translateY(20px)';
        this.isVisible = false;
        setTimeout(() => {
            if (!this.isVisible) {
                this.fab.style.visibility = 'hidden';
            }
        }, 300);
    }

    throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        }
    }

    destroy() {
        window.removeEventListener('scroll', this.handleScroll);
        this.fab.removeEventListener('click', this.onFabClick);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new SmartFab('chatbotFabBtn', 200);
});

// scroll top
class SmartScrollTop {
    constructor(btnId = 'scrollTopBtn') {
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
        window.addEventListener('scroll', this.throttle(this.handleScroll.bind(this), 16), { passive: true });
        window.addEventListener('resize', this.throttle(this.handleResize.bind(this), 250));
        this.btn.addEventListener('click', this.scrollToTopHandler);
    }

    destroy() {
        window.removeEventListener('scroll', this.handleScroll);
        window.removeEventListener('resize', this.handleResize);
        if (this.btn && this.scrollToTopHandler) {
            this.btn.removeEventListener('click', this.scrollToTopHandler);
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
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    show() {
        this.btn.style.opacity = '1';
        this.btn.style.transform = 'scale(1) translateY(0)';
        this.btn.style.visibility = 'visible';
        this.isVisible = true;
    }

    hide() {
        this.btn.style.opacity = '0';
        this.btn.style.transform = 'scale(0.7) translateY(20px)';
        this.isVisible = false;
        setTimeout(() => {
            if (!this.isVisible) this.btn.style.visibility = 'hidden';
        }, 300);
    }

    updateVisibility() {
        const nearBottom = this.isNearBottom();
        if (nearBottom) this.show();
        else this.hide();
    }

    throttle(func, limit) {
        let inThrottle;
        return function() {
            if (!inThrottle) {
                func.apply(this, arguments);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        }.bind(this);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new SmartScrollTop('scrollTopBtn');
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
