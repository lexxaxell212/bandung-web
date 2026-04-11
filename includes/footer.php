<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="<?php echo CSS_URL; ?>footer.css" rel="stylesheet">
</head>

<body>
    <br><br><br><br>
    <!-- FOOTER 3 KOLOM -->
    <footer id="footer-demo" class="footer-custom">
        <div class="container">
            <h1 class="newsletter-title">Media Bandung</h1>
            <!-- 3 KOLOM -->
            <div class="row g-4 g-lg-5 mb-5">
                
                <!-- KOLOM 1: Company -->
                <div class="col-lg-4 col-md-6">
                    <h5>Instagram</h5>
                    <ul class="list-unstyled footer-links">
                        <li>
                            <a href="#" class="footer-link">
                                <i class="fas fa-brands fa-instagram"></i>
                                <span>Instagram/1</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">
                                <i class="fas fa-brands fa-instagram"></i>
                                <span>Instagram/2</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">
                                <i class="fas fa-brands fa-instagram"></i>
                                <span>Instagram/3</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- KOLOM 2: Services -->
                <div class="col-lg-4 col-md-6">
                    <h5>Facebook</h5>
                    <ul class="list-unstyled footer-links">
                        <li>
                            <a href="#" class="footer-link">
                                <i class="fas fa-brands fa-facebook"></i>
                                <span>Facebook/1</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">
                                <i class="fas fa-brands fa-facebook"></i>
                                <span>Facebook/2</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">
                                <i class="fas fa-brands fa-facebook"></i>
                                <span>Facebook/3</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- KOLOM 3: Contact -->
                <div class="col-lg-4 col-md-12">
                    <h5>Tiktok</h5>
                    <ul class="list-unstyled footer-links">
                        <li>
                            <a href="#" class="footer-link">
                                <i class="fas fa-brands fa-tiktok"></i>
                                <span>Tiktok/1</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">
                                <i class="fas fa-brands fa-tiktok"></i>
                                <span>Tiktok/2</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">
                                <i class="fab fa-brands fa-tiktok"></i>
                                <span>Tiktok/3</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            
            <!-- Newsletter section -->
            
            <div class="footer-brand-section text-center">
                <section class="newsletter-section">
                    <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-10">
                            <!-- Icon -->
                            <div class="text-center mb-5">
                                <i class="fas fa-envelope-open-text newsletter-icon"></i>
                            </div>
                            
                            <!-- Title & Subtitle -->
                            <div class="text-center mb-5">
                                <h1 class="newsletter-title mb-4">
                                    Berlangganan Newsletter
                                </h1>
                                <p class="newsletter-subtitle lead">
                                    Dapatkan berita, event dan pembaruan terkini website.
                                </p>
                            </div>
                            
                            <!-- Newsletter Form -->
                            <div class="newsletter-card">
                                <form id="newsletterForm">
                                    <div class="input-group-newsletter input-group-lg mb-0">
                                        <input type="email" class="form-control newsletter-input" 
                                               id="emailInput" placeholder="Masukan email anda" required>
                                        
                                    </div>
                                    <button class="btn btn-subscribe btn-lg" type="submit">
                                            <i class="fas fa-paper-plane me-2"></i>
                                            Subscribe
                                    </button>
                                </form>
                                
                                <!-- Success Message -->
                                <div id="successMsg" class="success-message mt-4">
                                    <div class="success-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <span class="mb-3 fw-bold">Terima Kasih!</span>
                                    <p class="mb-0">Silahkan periksa kotak masuk email anda!</p>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </section>
            </div>
            
            <script>
                const form = document.getElementById('newsletterForm');
                const emailInput = document.getElementById('emailInput');
                const successMsg = document.getElementById('successMsg');
                const btn = form.querySelector('.btn-subscribe');
                
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    
                    const email = emailInput.value.trim();
                    
                    if (!email.includes('@') || !email.includes('.')) {
                        emailInput.classList.add('is-invalid');
                        return;
                    }
                    
                    // Loading state
                    const originalText = btn.innerHTML;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mendaftar...';
                    btn.disabled = true;
                    
                    // Simulate API
                    await new Promise(r => setTimeout(r, 1500));
                    
                    // Show success
                    form.style.display = 'none';
                    successMsg.style.display = 'block';
                    
                    // Reset after 4 seconds
                    setTimeout(() => {
                        form.reset();
                        form.style.display = 'block';
                        successMsg.style.display = 'none';
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                        emailInput.focus();
                    }, 4000);
                });
                
                // Real-time validation
                emailInput.addEventListener('input', () => {
                    emailInput.classList.remove('is-invalid');
                    btn.style.opacity = emailInput.value.includes('@') ? '1' : '0.7';
                });
            </script>
            
            <div class="footer-brand-section">
                <li class="list">
                <a href="<?php echo BASE_URL; ?>tentang">
                    Tentang Website
                </a>
                </li>
                <li class="list">
                <a href="<?php echo BASE_URL; ?>privacy-policy">
                    Privacy Policy
                </a>
                </li>
            </div>

            <!-- NAMA WEB CENTER BAWAH -->
            <div class="footer-brand-section text-center">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h3>MyApp</h3>
                        <p class="copyright">
                            © <?php echo date('Y'); ?> • 
                            <i class="fas fa-heart text-danger mx-1" style="animation: heartbeat 1.5s ease-in-out infinite;"></i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>
    </footer>
    

    
    <style>
        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }
    </style>
    
</body>
</html>