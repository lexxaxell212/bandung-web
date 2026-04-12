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
            <!-- Slide 1 - Pure Background -->
            <div class="hero-landing-slide active" 
                 style="background-image: url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
            </div>

            <!-- Slide 2 - Pure Background -->
            <div class="hero-landing-slide" 
                 style="background-image: url('https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80');">
            </div>

            <!-- Slide 3 - Pure Background -->
            <div class="hero-landing-slide" 
                 style="background-image: url('https://images.unsplash.com/photo-1518709268805-4e9042af2176?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
            </div>

            <!-- FIXED OVERLAY TEXT - KIRI ATAS -->
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
            <h2 class="hero-landing-desc-title" id="heroLandingDescTitle">Welcome to the Future</h2>
            <p class="hero-landing-desc-text" id="heroLandingDescText">
                Experience the next generation of digital transformation with our cutting-edge solutions designed specifically for your business growth.
            </p>
            <a class="event-news-button" id="heroLandingDescButton" href="#"></a>
            
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
                        title: "Welcome to the Future", 
                        text: "Next generation digital transformation.", 
                        buttonText: "🚀 Mulai Sekarang", 
                        buttonLink: "#" 
                    },
                    { 
                        title: "Power of Innovation", 
                        text: "Innovative technology for modern enterprise.", 
                        buttonText: "💡 Lihat Portofolio", 
                        buttonLink: "#" 
                    },
                    { 
                        title: "Join the Revolution", 
                        text: "Redefining what's possible for businesses.", 
                        buttonText: "🔥 Bergabung", 
                        buttonLink: "#" 
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
                <!--
                <div class="highlight-event-badge">BREAKING NEWS</div>
                -->
                
                <h1 class="highlight-event-title">
                    KENAPA HARUS
                    <br>BANDUNG
                </h1>
                
                <p class="highlight-event-subtitle">
                    Pemerintah umumkan investasi Rp500 Triliun untuk infrastruktur digital nasional. 
                    5G dan AI akan jadi tulang punggung ekonomi masa depan.
                </p>
                
                <button class="highlight-event-cta">
                    Baca Lengkap →
                </button>
            </div>
            
            <!-- Image -->
            <div class="highlight-event-image" 
                 style="background-image: url('https://images.unsplash.com/photo-1689363302902-2c58330d6494?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
            </div>
        </div>
    </section>
    
    <!-- Scroll artikel -->
    
    <div class="menu-container">
        <h2 class="cool-title-h1">ARTIKEL TERBARU</h2>
        <div class="cards-wrapper">
            <div class="cards-container" id="cardsContainer">
                <!-- Card 1: AI Tech -->
                <div class="card">
                    <div class="card-image" 
                         style="background-image: url('https://images.unsplash.com/photo-1677442136019-21780ecad995?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80');">
                    </div>
                    <div class="card-content">
                        <span class="card-category">Teknologi</span>
                        <h3 class="card-title">AI Mengubah Cara Kerja Kita Selamanya</h3>
                        <p class="card-excerpt">Artificial Intelligence bukan lagi masa depan, tapi realitas saat ini yang mengubah produktivitas dan kreativitas secara fundamental.</p>
                        <button class="read-btn">Baca</button>
                    </div>
                </div>

                <!-- Card 2: Business -->
                <div class="card">
                    <div class="card-image" 
                         style="background-image: url('https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
                    </div>
                    <div class="card-content">
                        <span class="card-category">Bisnis</span>
                        <h3 class="card-title">Digital Marketing 2024: Strategi Terbukti</h3>
                        <p class="card-excerpt">Tingkatkan konversi 300% dengan strategi marketing modern yang sudah teruji di lapangan oleh ribuan bisnis.</p>
                        <button class="read-btn">Baca</button>
                    </div>
                </div>

                <!-- Card 3: Design -->
                <div class="card">
                    <div class="card-image" 
                         style="background-image: url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
                    </div>
                    <div class="card-content">
                        <span class="card-category">Design</span>
                        <h3 class="card-title">Minimalism dalam UI/UX Design</h3>
                        <p class="card-excerpt">Desain minimalis bukan tren sementara, tapi filosofi yang menciptakan pengalaman user terbaik di era digital.</p>
                        <button class="read-btn">Baca</button>
                    </div>
                </div>

                <!-- Card 4: Productivity -->
                <div class="card">
                    <div class="card-image" 
                         style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
                    </div>
                    <div class="card-content">
                        <span class="card-category">Produktivitas</span>
                        <h3 class="card-title">5 Tools WFH Terbaik 2024</h3>
                        <p class="card-excerpt">Tools yang sudah terbukti meningkatkan produktivitas tim remote secara signifikan dengan fitur canggih.</p>
                        <button class="read-btn">Baca</button>
                    </div>
                </div>

                <!-- Card 5: Startup -->
                <div class="card">
                    <div class="card-image" 
                         style="background-image: url('https://images.unsplash.com/photo-1558618047-3c8c76ffe7dd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
                    </div>
                    <div class="card-content">
                        <span class="card-category">Startup</span>
                        <h3 class="card-title">Cara Pitch ke Investor</h3>
                        <p class="card-excerpt">Panduan lengkap membuat pitch deck dan strategi fundraising yang berhasil digunakan unicorn startups.</p>
                        <button class="read-btn">Baca</button>
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
                
                document.querySelectorAll('.read-btn, .card').forEach(el => {
                    el.addEventListener('click', (e) => {
                        if (e.target.classList.contains('read-btn') || e.currentTarget.classList.contains('card')) {
                            // Simulate navigation
                            console.log('Navigasi ke artikel...');
                        }
                    });
                });
            });
        </script>
        
    <!-- News events -->
        
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
                    Pemerintah Umumkan Investasi Rp500 Triliun Transformasi Digital Nasional
                </h2>
                <p class="event-news-excerpt">
                    Menteri Kominfo mengungkapkan roadmap 2024-2028 dengan fokus infrastruktur 5G, AI, dan cloud computing untuk dorong ekonomi digital Indonesia.
                </p>
                <button class="event-news-button">Baca Lengkap</button>
            </div>
        </article>

        <!-- CARD 2 -->
        <article class="event-news-card">
            <div class="event-news-image" 
                 style="background-image: url('https://images.unsplash.com/photo-1517336714731-489689fd1ca8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');">
                <div class="event-news-badge">STARTUP</div>
            </div>
            <div class="event-news-content">
                <h2 class="event-news-title">
                    Startup Lokal Raih Funding $100 Juta dari Silicon Valley
                </h2>
                <p class="event-news-excerpt">
                    Pendanaan Seri D terbesar tahun ini diraih Gojek dengan valuasi mencapai $5 miliar dari investor top Amerika Serikat.
                </p>
                <button class="event-news-button">Baca Lengkap</button>
            </div>
        </article>

        <!-- CARD 3 -->
        <article class="event-news-card">
            <div class="event-news-image" 
                 style="background-image: url('https://images.unsplash.com/photo-1517336714731-489689fd1ca8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');">
                <div class="event-news-badge">EVENT</div>
            </div>
            <div class="event-news-content">
                <h2 class="event-news-title">
                    Tech Summit Indonesia 2024: Masa Depan Teknologi Digital
                </h2>
                <p class="event-news-excerpt">
                    Gelaran terbesar teknologi tahunan di Jakarta Convention Center. Hadir 500+ startup dan 50+ investor global.
                </p>
                <button class="event-news-button">Baca Lengkap</button>
            </div>
        </article>
    </div>
    </div>
    
    
</body>

</html>


<?php 

/* Footer */

require_once 'includes/footer.php'; ?>

