document.addEventListener('DOMContentLoaded', () => {
  const heroSlides = document.querySelectorAll('.hero-item');
  const heroDots   = document.querySelectorAll('.dot');

  if (!heroSlides.length) return;

  let currentIndex = 0;
  let heroInterval;

  // ── Lazy load background slide non-aktif ──────
  function loadBg(el) {
    const slug = el.dataset.slug;
    if (!slug) return;
    const isMobile = window.innerWidth <= 768;
    const cls      = isMobile ? `hero-slide-${slug}-mobile` : `hero-slide-${slug}`;
    el.classList.add(cls);
    delete el.dataset.slug; // prevent double-load
  }

  function showSlide(index) {
    heroSlides.forEach(el => el.classList.remove('active'));
    heroDots.forEach(el => el.classList.remove('active'));
    heroSlides[index].classList.add('active');
    heroDots[index].classList.add('active');
    loadBg(heroSlides[index]); // load bg on demand
    currentIndex = index;
  }

  function nextSlide() {
    showSlide((currentIndex + 1) % heroSlides.length);
  }

  function start() {
    heroInterval = setInterval(nextSlide, 5000);
  }

  // Expose globally untuk onclick di HTML
  window.heroJump = (index) => {
    if (index < 0 || index >= heroSlides.length) return;
    clearInterval(heroInterval);
    showSlide(index);
    start();
  };

  // Pause saat hover
  const heroSection = document.getElementById('hero-website');
  heroSection?.addEventListener('mouseenter', () => clearInterval(heroInterval));
  heroSection?.addEventListener('mouseleave', () => start());

  // Preload slide berikutnya saat idle
  requestIdleCallback?.(() => {
    heroSlides.forEach((el, i) => { if (i > 0) loadBg(el); });
  });

  start();
});