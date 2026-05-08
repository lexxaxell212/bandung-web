<?php
$page_title = "Home - Ayokebandung.id";
require_once "includes/header.php";
?>
<style>
.main-content {
    padding-top: var(--navbar-height) !important;
}
</style>
<?php
function safe_include($file_path, $fallback_title = "Konten")
{
  if (!file_exists($file_path)) {
    echo fallback_card($fallback_title);
    return;
  }
  ob_start();
  try {
    include $file_path;
    ob_end_flush();
  } catch (Throwable $e) {
    ob_end_clean();
    echo fallback_card($fallback_title);
  }
}
function fallback_card($title = "Konten")
{
  return '
    <div class="container py-6">
      <div class="row mx-auto">
        <div class="col-12">
            <div class="card card-glass">
                <div class="card-body text-center py-5">
                    <i class="fas fa-circle-notch fa-spin fa-1x text-muted mb-3"></i>
                    <h5 class="text-muted mb-1">' .
    htmlspecialchars($title) .
    '</h5>
                    <p class="text-muted small mb-0">Sedang dalam perbaikan.</p>
                </div>
            </div>
        </div>
      </div>
    </div>';
}
safe_include("parts/hero.php", "Parts Hero Section");
safe_include("parts/kenapa-bandung.php", "Parts Kenapa Bandung");
safe_include("parts/blog-card.php", "Parts Artikel Terbaru");
safe_include("parts/update-card.php", "Parts Update Terkini");
?>
<script>
let currentSlide = 0;
let autoSlide = setInterval(nextSlide, 8000);
let lastWheel = 0;
function heroLandSlide(n) {
  clearInterval(autoSlide);
  showSlide((currentSlide + n + 3) % 3);
  autoSlide = setInterval(nextSlide, 8000);
}
function heroLandGoTo(n) {
  clearInterval(autoSlide);
  showSlide(n);
  autoSlide = setInterval(nextSlide, 8000);
}
function nextSlide() {
  heroLandSlide(1);
}
function showSlide(n) {
  const slides = document.querySelectorAll('.hero-land-slide');
  const indicators = document.querySelectorAll('.hero-land-indicator');
    slides[currentSlide].classList.remove('active');
    indicators[currentSlide].classList.remove('active');
    currentSlide = n;
    slides[currentSlide].classList.add('active');
            indicators[currentSlide].classList.add('active');
}
let startX = 0;
const container = document.querySelector('.hero-land-container');
  container.addEventListener('touchstart', e => startX = e.touches[0].clientX);
  container.addEventListener('touchend', e => {
    let endX = e.changedTouches[0].clientX;
    if (startX - endX > 50) nextSlide();
    if (endX - startX > 50) heroLandSlide(-1);
    });
  container.addEventListener('wheel', e => {
    const now = Date.now();
      if (now - lastWheel < 500) return;
        lastWheel = now;
      if (Math.abs(e.deltaX) > Math.abs(e.deltaY)) {
        e.preventDefault();
        if (e.deltaX > 0) nextSlide();
        else heroLandSlide(-1);
            }
    }, { passive: false });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const containers = document.querySelectorAll('.kenapa-image-container');
  containers.forEach(container => {
    const slideContainer = container.querySelector('.kenapa-image-slide');
    const images = slideContainer.querySelectorAll('.kenapa-image');
    if (images.length < 2) return;
    let currentIndex = 0;
    const slideDuration = 5000;
    let slideInterval;
    function nextSlide() {
      currentIndex = (currentIndex + 1) % images.length;
      slideContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
    }
    function startAutoSlide() {
      slideInterval = setInterval(nextSlide, slideDuration);
    }
    function stopAutoSlide() {
      clearInterval(slideInterval);
    }
    container.addEventListener('mouseenter', stopAutoSlide);
    container.addEventListener('mouseleave', startAutoSlide);
    startAutoSlide();
  });
});
</script>
<script>
(function () {
    const track = document.getElementById('sliderTrack');
    const cards = track.querySelectorAll('.slide-card');
    const total = cards.length;
    let current = 0;
    let startX = 0;
    function getVisible() {
        return window.innerWidth >= 768 ? 2 : 1;
    }
    function maxIndex() {
        return Math.max(0, total - getVisible());
    }
    function updateSlider() {
        const cardWidth = cards[0].offsetWidth + 32;
        track.style.transform = `translateX(-${current * cardWidth}px)`;
        document.getElementById('btnPrev').disabled = current === 0;
        document.getElementById('btnNext').disabled = current >= maxIndex();
    }
    window.moveSlide = function (dir) {
        current = Math.min(Math.max(current + dir, 0), maxIndex());
        updateSlider();
    };
    track.addEventListener('touchstart', e => { startX = e.touches[0].clientX; });
    track.addEventListener('touchend', e => {
        const diff = startX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 50) moveSlide(diff > 0 ? 1 : -1);
    });
    window.addEventListener('resize', updateSlider);
    updateSlider();
})();
</script>
<?php require "includes/footer.php";
?>