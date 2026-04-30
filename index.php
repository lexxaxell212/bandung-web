<?php 
$page_title = 'Home - Ayokebandung.id';
require_once 'includes/header.php';
?>

<style>
  .main-content {
  padding-top: var(--navbar-height) !important;
  }
</style>
<!-- Hero Section -->
<style>
        .hero-land-container {
            width: 100vw;
            height: calc(100vh - var(--navbar-height));
        }
        @media (min-width: 1100px) {
            .hero-land-container {
                height: 70vh;
            }
        }

        .hero-land-slide {
            height: 100%;
            background-size: cover;
            background-position: center;
            transition: opacity 0.7s ease;
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }
        .hero-land-slide.active {
            opacity: 1;
        }
        .hero-land-desc {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
            text-shadow: 0 2px 6px rgba(50,50,80,0.5);
        }
        .hero-land-title {
          text-shadow: 0 2px 6px rgba(50,50,80,0.2);
        }
        .hero-land-slide.active .hero-land-desc {
            opacity: 1;
            transform: translateY(0);
        }
        /* Content positioned 70% from top */
        .hero-land-content {
            position: absolute;
            top: 70%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 800px;
        }
        .hero-land-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            z-index: 20;
            backdrop-filter: blur(10px);
        }
        .hero-land-prev { left: 30px; }
        .hero-land-next { right: 30px; }
        .hero-land-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,0.5);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .hero-land-indicator.active {
            background: white;
            transform: scale(1.05);
        }
       
        
        /* Hero button link styling */
        .hero-land-btn-link {
            display: inline-block;
            text-decoration: none;
        }
</style>
<section id="hero-website" class="hero-land-container position-relative">
        <!-- Slide 1 -->
        <div class="hero-land-slide active" 
             style="background: 
            linear-gradient(135deg, rgba(15,23,42,0.85) 0%, rgba(30,41,59,0.9) 50%, rgba(51,65,85,0.95) 100%),
            url('https://ayokebandung.id/assets/images/wisata.webp')
            center/cover;
    ">
            <div class="hero-land-content">
                <div class="text-center">
                    <span class="text-hero font-bold mb-6
                    hero-land-title">WISATA</span>
                    <p class="hero-land-desc fs-4 mt-6 text-white mb-6">Eksplorasi destinasi ikonik Bandung dengan layanan premium dan kenyamanan tak tertandingi.</p>
                    <a href="#kenapaharusbandung" class="mt-6">
                        <button class="btn btn-accent btn-md">MULAI JELAJAHI
                        <i class="fas fa-angle-right"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="hero-land-slide" 
             style="background: 
            linear-gradient(135deg, rgba(15,23,42,0.85) 0%, rgba(30,41,59,0.9) 50%, rgba(51,65,85,0.95) 100%),
            url('https://ayokebandung.id/assets/images/kuliner.webp')
            center/cover;
    ">
            <div class="hero-land-content">
                <div class="text-center text-white">
                    <span class="text-hero font-bold mb-6 hero-land-title">KULINER</span>
                    <p class="hero-land-desc fs-4 mt-6 text-white mb-6">Manjakan lidah dengan cita rasa autentik dan pengalaman bersantap kelas dunia di Bandung.</p>
                    <a href="#kenapaharusbandung" class="mt-6">
                        <button class="btn btn-accent btn-md">MULAI JELAJAHI
                        <i class="fas fa-angle-right"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="hero-land-slide" 
             style="background: 
            linear-gradient(135deg, rgba(15,23,42,0.85) 0%, rgba(30,41,59,0.9) 50%, rgba(51,65,85,0.95) 100%),
            url('https://ayokebandung.id/assets/images/hotel.webp')
            center/cover;">
            <div class="hero-land-content">
                <div class="text-center text-white">
                    <span class="text-hero font-bold mb-6
                    hero-land-title">HOTEL</span>
                    <p class="hero-land-desc fs-4 mt-6 text-white mb-6">Temukan kemewahan menginap terbaik di lokasi strategis untuk istirahat Anda yang sempurna.</p>
                    <a href="#kenapaharusbandung" class="mt-6">
                        <button class="btn btn-accent btn-md">MULAI
                        JELAJAHI
                        <i class="fas fa-angle-right"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Indicators -->
        <div class="position-absolute bottom-0 start-50 translate-middle-x mb-4 d-flex gap-2 pb-3">
            <div class="hero-land-indicator active" onclick="heroLandGoTo(0)"></div>
            <div class="hero-land-indicator" onclick="heroLandGoTo(1)"></div>
            <div class="hero-land-indicator" onclick="heroLandGoTo(2)"></div>
        </div>
    </section>
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

        // Swipe & Scroll HERO ONLY
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
<!-- Kenapa bandung -->
<section id="kenapaharusbandung" class="container-fluid" style="background: var(--bg-light);padding: 7rem 1.5rem 1.5rem 1.5rem">
 <div class="container">
  <div class="row">
    <div class="col-12 col-md-6 col-lg-6 element-1">
      <!-- -->
      <div class="h-100">
        <div class="my-6">
          <h1 class="mb-3 fs-1">
          KENAPA HARUS BANDUNG?
          </h1>
          <p class="mb-6">
              Dikenal sebagai Paris van Java, Bandung terus bertransformasi menjadi destinasi komersial kelas atas tanpa kehilangan jati diri budayanya. Keunggulan kuliner, kemewahan akomodasi, dan keindahan alamnya menciptakan ekosistem yang ideal bagi siapa pun yang mencari keseimbangan antara produktivitas bisnis dan kenyamanan rekreasi.
                </p>
              <a href="<?php echo PAGES_URL; ?>kenapa-harus-bandung" class="btn
              btn-primary mb-6">Baca lengkap
              <i class="fas fa-angle-right"></i>
              </a>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6 element-2">
      <!-- Auto slide -->
      <div class="kenapa-image-container auto-slide">
        <div class="kenapa-image-slide">
        <Img Class="kenapa-image w-100"
          src="https://ayokebandung.id/assets/images/cards/default.jpg">
        <Img Class="kenapa-image w-100" Src="https://ayokebandung.id/assets/images/cards/default.jpg">
        <Img Class="kenapa-image w-100" Src="https://ayokebandung.id/assets/images/cards/default.jpg">
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<script>
  // Auto Slide 
document.addEventListener('DOMContentLoaded', function() {
  const containers = document.querySelectorAll('.kenapa-image-container');
  
  containers.forEach(container => {
    const slideContainer = container.querySelector('.kenapa-image-slide');
    const images = slideContainer.querySelectorAll('.kenapa-image');
    
    if (images.length < 2) return; // Minimal 2
    
    let currentIndex = 0;
    const slideDuration = 5000; // 5 detik per slide
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
    
    // Hover pause
    container.addEventListener('mouseenter', stopAutoSlide);
    container.addEventListener('mouseleave', startAutoSlide);
    
    startAutoSlide();
  });
});
</script>
<div class="container">
<div class="spacer"></div>
<div class="spacer"></div>
<div class="spacer"></div>
<!-- Artikel Terbaru Section -->
<section id="artikelterbaru">
    <div class="container">
        <!-- Title -->
        <div class="text-center mb-6">
            <h1 class="fs-1 mb-3">
                ARTIKEL TERBARU
            </h1>
        </div>
        <!-- Artikel Terbaru -->
        <div class="wrapper-artikel-terbaru position-relative">
            <!-- scroll wrapper -->
            <div class="wrapper-artikel-terbaru-track overflow-hidden" id="cardsTrack">
                <!-- Viewport (Cards Container) -->
                <div class="wrapper-artikel-terbaru-viewport d-flex gap-4 p-6" id="cardsContainer">
                    <!-- Card  -->
                    <div class="glass glass-hover flex-shrink-0" style="width: 340px; min-width: 340px; max-width: 340px;">
                     <div class="overflow-hidden">
                      <img src="https://ayokebandung.id/assets/images/cards/default.jpg"
                            class="card-img-top">
                        </div>
                        <div class="card-body p-6">
                            <h5 class="card-title mb-2">Title</h5>
                            <p class="card-text text-muted mb-6 small">Konten.</p>
                            <a href="#" class="btn btn-primary">
                            Baca Selengkapnya
                            <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Navigation Controls -->
            <div class="nav-controls d-flex justify-content-center align-items-center gap-3 px-3 py-6">
                <button class="btn btn-outline-primary rounded-circle p-3
                carousel-control-prev" type="button" id="prevBtn" style="width:
                50px; height: 50px;" aria-label="Previous">
                    <i class="fas fa-chevron-left fs-5"></i>
                </button>
                <div class="indicators d-flex gap-2 opacity-50 px-4 py-2 rounded-pill" id="indicators" style="min-width: 120px;"></div>
                <button class="btn btn-outline-primary rounded-circle
                carousel-control-next" type="button" id="nextBtn" style="width:
                50px; height: 50px; z-index: 4;" aria-label="Next">
                    <i class="fas fa-chevron-right fs-5"></i>
                </button>
            </div>
        </div>
        </div>
        </section>
<style>
/* Ultra Smooth Horizontal Scroll */
.wrapper-artikel-terbaru {
    --card-width: 340px;
    --card-gap: 24px;
    --transition: cubic-bezier(0.25, 0.1, 0.25, 1) 0.4s;
}

.wrapper-artikel-terbaru-track {
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.wrapper-artikel-terbaru-track::-webkit-scrollbar {
    display: none;
}

.wrapper-artikel-terbaru-viewport {
    transition: transform var(--transition);
    backface-visibility: hidden;
    transform: translateZ(0);
}

.wrapper-artikel-terbaru .glass {
    transition: all 0.3s var(--transition);
}



/* Indicators */
.indicator {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: #adb5bd;
    cursor: pointer;
    transition: all 0.2s ease;
    border: 2px solid transparent;
}

.indicator.active,
.indicator:hover {
    background: #0d6efd;
    transform: scale(1.1);
    border-color: white;
}

/* Responsive Card Sizes */
@media (max-width: 1199.98px) {
    .wrapper-artikel-terbaru .glass {
        width: 320px !important;
        min-width: 320px !important;
        max-width: 320px !important;
    }
}

@media (max-width: 991.98px) {
    .wrapper-artikel-terbaru .glass {
        width: 300px !important;
        min-width: 300px !important;
        max-width: 300px !important;
    }
    
    .wrapper-artikel-terbaru-viewport {
        gap: 20px !important;
        padding: 2rem 1rem !important;
    }
}

@media (max-width: 575.98px) {
    .wrapper-artikel-terbaru .glass {
        width: 280px !important;
        min-width: 280px !important;
        max-width: 280px !important;
    }
    
    .nav-controls {
        gap: 1rem !important;
    }
    
    .nav-controls .btn {
        width: 50px !important;
        height: 50px !important;
        padding: 0.75rem !important;
    }
}
</style>
<script>
class SmoothScrollCards {
    constructor() {
        this.track = document.getElementById('cardsTrack');
        this.viewport = document.getElementById('cardsContainer');
        this.cards = document.querySelectorAll('.wrapper-artikel-terbaru-viewport .glass');
        this.prevBtn = document.getElementById('prevBtn');
        this.nextBtn = document.getElementById('nextBtn');
        this.indicatorsContainer = document.getElementById('indicators');
        
        this.currentIndex = 0;
        this.isAnimating = false;
        this.init();
    }

    init() {
        this.updateLayout();
        this.createIndicators();
        this.updateScroll();
        this.bindEvents();
        requestAnimationFrame(() => this.updateScroll());
        }

    updateLayout() {
        const containerWidth = this.track.offsetWidth;
        let visibleCards;
        
        if (window.innerWidth >= 1200) visibleCards = 2;
        else if (window.innerWidth >= 992) visibleCards = 2;
        else if (window.innerWidth >= 768) visibleCards = 1.5;
        else visibleCards = 1;
        
        this.cardWidth = 340 + 24; // Fixed card width + gap
        this.maxIndex = Math.max(0, this.cards.length - visibleCards);
    }

    createIndicators() {
        this.indicatorsContainer.innerHTML = '';
        for (let i = 0; i <= this.maxIndex; i++) {
            const dot = document.createElement('div');
            dot.className = 'indicator';
            if (i === 0) dot.classList.add('active');
            dot.addEventListener('click', (e) => {
                e.preventDefault();
                this.goTo(i);
            });
            this.indicatorsContainer.appendChild(dot);
        }
        this.indicators = document.querySelectorAll('.indicator');
    }

    bindEvents() {
        // Mouse events
        this.prevBtn.addEventListener('click', (e) => {
            e.preventDefault();
            this.prev();
        });
        
        this.nextBtn.addEventListener('click', (e) => {
            e.preventDefault();
            this.next();
        });

        // Touch/Swipe - Ultra smooth
        let startX = 0, currentX = 0, isDragging = false;
        
        this.track.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            isDragging = true;
            this.pauseAnimations();
        }, { passive: true });
        
        this.track.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            currentX = e.touches[0].clientX;
        }, { passive: true });
        
        this.track.addEventListener('touchend', (e) => {
            if (!isDragging) return;
            const diff = startX - currentX;
            if (Math.abs(diff) > 60) {
                if (diff > 0) this.next();
                else this.prev();
            }
            isDragging = false;
            this.resumeAnimations();
        }, { passive: true });

        // Keyboard
        document.addEventListener('keydown', (e) => {
            if (e.target.closest('.wrapper-artikel-terbaru')) {
                if (e.key === 'ArrowLeft') this.prev();
                if (e.key === 'ArrowRight') this.next();
            }
        });

        // Resize observer for ultra smooth resize
        const resizeObserver = new ResizeObserver(() => {
            this.updateLayout();
            this.createIndicators();
            this.currentIndex = 0;
            this.updateScroll();
        });
        resizeObserver.observe(this.track);
    }

    async goTo(index) {
        if (this.isAnimating || index === this.currentIndex) return;
        
        this.isAnimating = true;
        this.currentIndex = Math.max(0, Math.min(index, this.maxIndex));
        
        await this.updateScroll();
        this.updateIndicators();
        this.isAnimating = false;
    }

    async next() {
        if (this.currentIndex < this.maxIndex) {
            await this.goTo(this.currentIndex + 1);
        }
    }

    async prev() {
        if (this.currentIndex > 0) {
            await this.goTo(this.currentIndex - 1);
        }
    }

    async updateScroll() {
        return new Promise(resolve => {
            requestAnimationFrame(() => {
                const translateX = -(this.currentIndex * this.cardWidth);
                this.viewport.style.transform = `translate3d(${translateX}px, 0, 0)`;
                resolve();
            });
        });
    }

    updateIndicators() {
        this.indicators.forEach((indicator, i) => {
            indicator.classList.toggle('active', i === this.currentIndex);
        });
    }

    pauseAnimations() {
        this.viewport.style.transition = 'none';
    }

    resumeAnimations() {
        requestAnimationFrame(() => {
            this.viewport.style.transition = '';
        });
    }
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => new SmoothScrollCards());
} else {
    new SmoothScrollCards();
}
</script>
<div class="spacer"></div>
<!-- informasi terkini -->
<section id="informasiterkini">
    <div class="row gap-4 p-5 justify-content-center overflow-hidden">
        <!-- CARD -->
        <div class="card card-glass col-12 col-sm-8 col-lg-4 overflow-hidden p-0
        m-4">
            <img class="card-img-top w-100" 
                 src="https://ayokebandung.id/assets/images/cards/default.jpg">
            <div class="card-body p-6">
                <h5 class="mb-3">
                    Lorem Ipsum
                </h5>
                <p class="mb-6">
                    Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum.
                </p>
                <a href="#" class="btn btn-primary">
                 Baca Lengkap
                 <i class="fas fa-angle-right"></i>
                 </a>
            </div>
        </div>
    </div>
</section>
</div>

<?php  
require 'includes/footer.php'; 
?>
