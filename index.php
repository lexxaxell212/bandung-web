<?php 
$page_title = "Halaman Awal - MyApp";
require_once 'config/config.php';
require_once 'includes/header.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>

<body>
    
    <!-- Hero landing -->
    
    <section class="hero-landing-container">
        <div class="hero-landing-slider" id="heroLandingSlider">
            
            <div class="hero-landing-slide active" 
                 style="background-image: url('<?php echo IMG_URL; ?>kuliner.jpg');">
            </div>

            <div class="hero-landing-slide" 
                 style="background-image: url('<?php echo IMG_URL; ?>wisata.jpg');">
            </div>

            <div class="hero-landing-slide" 
                 style="background-image: url('<?php echo IMG_URL; ?>hotel.jpg');">
            </div>

            <div class="hero-landing-fixed-overlay">
                <!-- weather widget -->
               <div class="weather" id="w">
                <div>Loading...</div>
              </div>
            </div>

            <!-- MANUAL ONLY Navigation -->
            <div class="hero-landing-nav">
                <div class="hero-landing-nav-arrow" id="heroLandingPrev" aria-label="Previous slide">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="hero-landing-dots">
                    <div class="hero-landing-dot active" data-slide="0"></div>
                    <div class="hero-landing-dot" data-slide="1"></div>
                    <div class="hero-landing-dot" data-slide="2"></div>
                </div>
                <div class="hero-landing-nav-arrow" id="heroLandingNext" aria-label="Next slide">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        </div>

        <!-- Description Section -->
        <div class="hero-landing-description" id="heroLandingDescription">
            <h2 id="heroLandingDescTitle">KULINER BANDUNG</h2>
            <p id="heroLandingDescText">
                Temukan cita rasa khas Bandung yang bikin nagih, dari tradisional hingga kekinian.
            </p>
            <a class="my-btn-dark" id="heroLandingDescButton" href="<?php echo BASE_URL; ?>kuliner">JELAJAHI KULINER</a>
            
            
        </div>
    </section>
    
    <script>
        class HeroLandingSlider {
            constructor() {
                this.currentSlide = 0;
                this.totalSlides = 3;
                this.init();
            }

            init() {
                this.bindNavigation();
                this.updateContent();
            }

            bindNavigation() {
                document.querySelectorAll('.hero-landing-dot').forEach((dot, index) => {
                    dot.addEventListener('click', () => this.goToSlide(index));
                });

                document.getElementById('heroLandingPrev').addEventListener('click', () => this.prevSlide());
                document.getElementById('heroLandingNext').addEventListener('click', () => this.nextSlide());

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') this.prevSlide();
                    if (e.key === 'ArrowRight') this.nextSlide();
                });

                let startX = 0, currentX = 0;
                document.getElementById('heroLandingSlider').addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                });
                document.getElementById('heroLandingSlider').addEventListener('touchmove', (e) => {
                    currentX = e.touches[0].clientX;
                });
                document.getElementById('heroLandingSlider').addEventListener('touchend', () => {
                    const diffX = startX - currentX;
                    if (Math.abs(diffX) > 50) {
                        diffX > 0 ? this.nextSlide() : this.prevSlide();
                    }
                });
            }

            goToSlide(index) {
                document.querySelectorAll('.hero-landing-slide').forEach((slide, i) => {
                    slide.classList.toggle('active', i === index);
                });

                document.querySelectorAll('.hero-landing-dot').forEach((dot, i) => {
                    dot.classList.toggle('active', i === index);
                });

                this.currentSlide = index;
                this.updateContent();
            }

            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                this.goToSlide(this.currentSlide);
            }

            prevSlide() {
                this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                this.goToSlide(this.currentSlide);
            }

            
            updateContent() {
                const content = [
                    { 
                        title: "KULINER BANDUNG", 
                        text: "Temukan cita rasa khas Bandung yang bikin nagih, dari tradisional hingga kekinian.", 
                        buttonText: "JELAJAHI KULINER", 
                        buttonLink: "<?php echo BASE_URL; ?>kuliner" 
                    },
                    { 
                        title: "DESTINASI WISATA", 
                        text: "Jelajahi destinasi wisata Bandung, dari alam sejuk hingga spot hits yang Instagramable.", 
                        buttonText: "KUNJUNGI SEKARANG", 
                        buttonLink: "<?php echo BASE_URL; ?>wisata" 
                    },
                    { 
                        title: "PENGINAPAN FAVORIT", 
                        text: "Nikmati kenyamanan dan layanan terbaik di penginapan favorit pilihan.", 
                        buttonText: "LIHAT REKOMENDASI", 
                        buttonLink: "<?php echo BASE_URL; ?>penginapan" 
                    }
                ];

                const data = content[this.currentSlide];
                
                // Update title & text
                document.getElementById('heroLandingDescTitle').textContent = data.title;
                document.getElementById('heroLandingDescText').textContent = data.text;
                
                // GANTI TEXT + LINK
                const button = document.getElementById('heroLandingDescButton');
                button.textContent = data.buttonText;
                button.href = data.buttonLink;
                
                document.getElementById('heroLandingDescription').classList.add('active');
            }
        }

        document.addEventListener('DOMContentLoaded', () => new HeroLandingSlider());
    </script>
    

    <!-- weather widget JS -->
    
    <script src="<?php echo JS_URL; ?>weather.js"></script>
    
    <!-- Kenapa bandung -->
    
    <section class="highlight-event-section">
  <div class="highlight-event-container">
    <!-- Content -->
    <div class="highlight-event-content">
      <h1 class="highlight-event-title">
        KENAPA HARUS
        <br>BANDUNG?
      </h1>
      
      <p class="highlight-event-subtitle">
        Bandung selalu jadi pilihan favorit untuk liburan karena menawakan perpaduan lengkap antara keindahan alam, udara sejuk, dan ragam aktivitas seru. Mulai dari wisata alam yang menenangkan, kuliner yang menggoda, hingga tempat-tempat hits yang Instagramable, semuanya bisa kamu temukan dalam satu kota.
      </p>
    </div>
    
    <!-- sLIDER 3 IMAGE -->
        <div class="highlight-event-slider">
          <!-- Image 1 -->
          <div class="highlight-event-slide active" 
               style="background-image: url('https://nibble-images.b-cdn.net/nibble/original_images/alam_teh_72f293b22c.jpg?class=large');"></div>
          
          <!-- Image 2 -->
          <div class="highlight-event-slide" 
               style="background-image: url('https://images.unsplash.com/photo-1519046904884-53103b34b206?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');"></div>
          
          <!-- Image 3 -->
          <div class="highlight-event-slide" 
               style="background-image: url('https://images.unsplash.com/photo-1571896349840-0d6d4e9f4d7c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');"></div>
          
          <!-- Dots Navigation -->
          <div class="slider-dots">
            <div class="dot active" data-slide="0"></div>
            <div class="dot" data-slide="1"></div>
            <div class="dot" data-slide="2"></div>
          </div>
        </div>
      </div>
    </section>
    
    <script>
      class ImageSlider {
        constructor() {
          this.slides = document.querySelectorAll('.highlight-event-slide');
          this.dots = document.querySelectorAll('.dot');
          this.currentSlide = 0;
          this.slideInterval = null;
          this.autoSlideDelay = 3000; 
          
          this.init();
        }
        
        init() {
          this.startAutoSlide();
          this.bindEvents();
        }
        
        nextSlide() {
          this.currentSlide = (this.currentSlide + 1) % this.slides.length;
          this.showSlide(this.currentSlide);
        }
        
        showSlide(index) {
          // Update slides
          this.slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
          });
          
          // Update dots
          this.dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
          });
        }
        
        startAutoSlide() {
          this.slideInterval = setInterval(() => {
            this.nextSlide();
          }, this.autoSlideDelay);
        }
        
        stopAutoSlide() {
          clearInterval(this.slideInterval);
        }
        
        bindEvents() {
          // Dots click
          this.dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
              this.stopAutoSlide();
              this.showSlide(index);
              this.startAutoSlide(); 
            });
          });
          
          // Pause on hover
          const slider = document.querySelector('.highlight-event-slider');
          slider.addEventListener('mouseenter', () => this.stopAutoSlide());
          slider.addEventListener('mouseleave', () => this.startAutoSlide());
        }
      }
      
      document.addEventListener('DOMContentLoaded', () => {
        new ImageSlider();
      });
    </script>
    
    <!-- artikel terbaru -->
    
    <div class="menu-container">
        <h2 class="cool-title-h1">ARTIKEL TERBARU</h2>
        <div class="cards-wrapper">
            <div class="cards-container" id="cardsContainer">
                <!-- Card 1:  -->
                <div class="card">
                    <div class="card-image" 
                         style="background-image: url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
                    </div>
                    <div class="card-content">
                        <span class="card-category">Design</span>
                        <h3 class="card-title">Minimalism dalam UI/UX Design</h3>
                        <p class="card-excerpt">Desain minimalis bukan tren sementara, tapi filosofi yang menciptakan pengalaman user terbaik di era digital.</p>
                        <a href="#" class="my-btn-dark">Baca</a>
                    </div>
                </div>
                
                <!-- Card 2:  -->
                <div class="card">
                    <div class="card-image" 
                         style="background-image: url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
                    </div>
                    <div class="card-content">
                        <span class="card-category">Design</span>
                        <h3 class="card-title">Minimalism dalam UI/UX Design</h3>
                        <p class="card-excerpt">Desain minimalis bukan tren sementara, tapi filosofi yang menciptakan pengalaman user terbaik di era digital.</p>
                        <a href="#" class="my-btn-dark">Baca</a>
                    </div>
                </div>

                <!-- Card 3:  -->
                <div class="card">
                    <div class="card-image" 
                         style="background-image: url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
                    </div>
                    <div class="card-content">
                        <span class="card-category">Design</span>
                        <h3 class="card-title">Minimalism dalam UI/UX Design</h3>
                        <p class="card-excerpt">Desain minimalis bukan tren sementara, tapi filosofi yang menciptakan pengalaman user terbaik di era digital.</p>
                        <a href="#" class="my-btn-dark">Baca</a>
                    </div>
                </div>

                <!-- Card 4:  -->
                <div class="card">
                    <div class="card-image" 
                         style="background-image: url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
                    </div>
                    <div class="card-content">
                        <span class="card-category">Design</span>
                        <h3 class="card-title">Minimalism dalam UI/UX Design</h3>
                        <p class="card-excerpt">Desain minimalis bukan tren sementara, tapi filosofi yang menciptakan pengalaman user terbaik di era digital.</p>
                        <a href="#" class="my-btn-dark">Baca</a>
                    </div>
                </div>

                <!-- Card 5:  -->
                <div class="card">
                    <div class="card-image" 
                         style="background-image: url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
                    </div>
                    <div class="card-content">
                        <span class="card-category">Design</span>
                        <h3 class="card-title">Minimalism dalam UI/UX Design</h3>
                        <p class="card-excerpt">Desain minimalis bukan tren sementara, tapi filosofi yang menciptakan pengalaman user terbaik di era digital.</p>
                        <a href="#" class="my-btn-dark">Baca</a>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="nav-controls">
            <button class="arrow-btn" id="prevBtn">←</button>
            <div class="indicators" id="indicators"></div>
            <button class="arrow-btn" id="nextBtn">→</button>
        </div>
    </div>
        <script>
            class MinimalScrollCards {
                constructor() {
                    this.container = document.getElementById('cardsContainer');
                    this.cards = document.querySelectorAll('.card');
                    this.prevBtn = document.getElementById('prevBtn');
                    this.nextBtn = document.getElementById('nextBtn');
                    this.indicatorsContainer = document.getElementById('indicators');
                    
                    this.currentIndex = 0;
                    this.cardWidth = 320 + 24;
                    this.init();
                }
    
                init() {
                    this.updateMaxIndex();
                    this.createIndicators();
                    this.updateScroll();
                    this.bindEvents();
                }
    
                updateMaxIndex() {
                    const containerWidth = window.innerWidth < 768 ? 340 : 440;
                    this.maxVisible = Math.floor(containerWidth / this.cardWidth);
                    this.maxIndex = Math.max(0, this.cards.length - this.maxVisible);
                }
    
                createIndicators() {
                    this.indicatorsContainer.innerHTML = '';
                    for (let i = 0; i <= this.maxIndex; i++) {
                        const dot = document.createElement('div');
                        dot.className = 'indicator';
                        if (i === 0) dot.classList.add('active');
                        dot.addEventListener('click', () => this.goTo(i));
                        this.indicatorsContainer.appendChild(dot);
                    }
                    this.indicators = document.querySelectorAll('.indicator');
                }
    
                bindEvents() {
                    this.prevBtn.addEventListener('click', () => this.prev());
                    this.nextBtn.addEventListener('click', () => this.next());
                    window.addEventListener('resize', () => {
                        this.updateMaxIndex();
                        this.createIndicators();
                        this.currentIndex = 0;
                        this.updateScroll();
                    });
                }
    
                goTo(index) {
                    this.currentIndex = Math.max(0, Math.min(index, this.maxIndex));
                    this.updateScroll();
                }
    
                next() {
                    if (this.currentIndex < this.maxIndex) {
                        this.currentIndex++;
                        this.updateScroll();
                    }
                }
    
                prev() {
                    if (this.currentIndex > 0) {
                        this.currentIndex--;
                        this.updateScroll();
                    }
                }
    
                updateScroll() {
                    const translateX = -this.currentIndex * this.cardWidth;
                    this.container.style.transform = `translateX(${translateX}px)`;
                    this.updateIndicators();
                }
    
                updateIndicators() {
                    this.indicators.forEach((indicator, i) => {
                        indicator.classList.toggle('active', i === this.currentIndex);
                    });
                }
            }
    
            document.addEventListener('DOMContentLoaded', () => {
                new MinimalScrollCards();
                
                document.querySelectorAll('.my-btn-dark, .card').forEach(el => {
                    el.addEventListener('click', (e) => {
                        if (e.target.classList.contains('my-btn-dark') || e.currentTarget.classList.contains('card')) {
                            // Simulate navigation
                            console.log('Navigasi ke artikel...');
                        }
                    });
                });
            });
        </script>
        
    <!-- informasi terkini -->
        
    <div class="event-news-section">
        <div class="event-news-cards-container">
        <!-- CARD 1 -->
        <article class="event-news-card">
            <div class="event-news-image" 
                 style="background-image: url('https://images.unsplash.com/photo-1689363302902-2c58330d6494?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');">
                <div class="event-news-badge">BERITA UTAMA</div>
            </div>
            <div class="event-news-content">
                <h2 class="event-news-title">
                    Lorem Ipsum
                </h2>
                <p class="event-news-excerpt">
                    Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum.
                </p>
                <a href="#" class="my-btn-dark">Baca Lengkap</a>
            </div>
        </article>

        <!-- CARD 2 -->
        <article class="event-news-card">
            <div class="event-news-image" 
                 style="background-image: url('https://images.unsplash.com/photo-1689363302902-2c58330d6494?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');">
                <div class="event-news-badge">BERITA UTAMA</div>
            </div>
            <div class="event-news-content">
                <h2 class="event-news-title">
                    Lorem Ipsum
                </h2>
                <p class="event-news-excerpt">
                    Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum.
                </p>
                <a href="#" class="my-btn-dark">Baca Lengkap</a>
            </div>
        </article>

        <!-- CARD 3 -->
        <article class="event-news-card">
            <div class="event-news-image" 
                 style="background-image: url('https://images.unsplash.com/photo-1689363302902-2c58330d6494?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');">
                <div class="event-news-badge">BERITA UTAMA</div>
            </div>
            <div class="event-news-content">
                <h2 class="event-news-title">
                    Lorem Ipsum
                </h2>
                <p class="event-news-excerpt">
                    Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum.
                </p>
                <a href="#" class="my-btn-dark">Baca Lengkap</a>
            </div>
        </article>
    </div>
    </div>
    
    
</body>

</html>


<?php 

/* Footer */

require_once 'includes/footer.php'; ?>

