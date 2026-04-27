</div>
 <style>
        /* MESSAGE STATES */
        .newsletter-container {
        margin-top: 2rem;
            border-radius: 24px;
            padding: 40px;
            max-width: 350px;
            width: 100%;
            box-shadow: 0 16px 30px rgba(0,0,0,0.1);
            text-align: center;
        }
        .message {
            padding: 1.5rem;
            border-radius: 16px;
            margin: 10px auto;
            display: flex;
            align-items: center;
            display: block;
            font-weight: 500;
            text-align: center;
        }
        .message.success {
            background: var(--blue-100);
            color: var(--blue-900);
            border-radius: 12px;
        }
        .message.error {
            background: var(--blue-100);
            color: red;
            border-radius: 12px;
        }
        .message.warning {
            background: var(--blue-100);
            color: var(--orange-500);
            border-radius: 12px;
        }
        .message i { font-size: 1.5rem; }
        
        /* FORM */
        .newsletter-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .email-input {
            padding: 16px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s;
            background: #f8fafc;
        }
        .email-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102,126,234,0.1);
            background: white;
        }
        .email-input.is-valid { border-color: #10b981; background: #f0fdf4; }
        .email-input.is-invalid { border-color: #ef4444; background: #fef2f2; }
        
        .submit-btn {
            padding: 16px;
            background: linear-gradient(135deg, var(--blue-600) 0%,
            var(--blue-800) 100%);
            color: var(--blue-50);
            border: none;
            border-radius: 22px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 8px 25px rgba(102,126,234,0.3);
        }
        .submit-btn:hover { 
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(102,126,234,0.4);
        }
        
        .reset-btn {
            background: none;
            border: 2px solid #60a5fa;
            color: #60a5fa;
            padding: 12px 24px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-block;
            margin-top: 1rem;
        }
        .reset-btn:hover {
            background: #60a5fa;
            color: white;
            transform: translateY(-1px);
        }
        
        @media (max-width: 480px) {
            .newsletter-container { padding: 32px 24px; margin: 10px; }
            .title { font-size: 1.75rem; }
        }
    </style>

<footer id="footer" class="footer">
<div class="container">
<section class="newsletter-section">
<div class="container">
<div class="row justify-content-center">
<div class="col-xl-8 col-lg-10">
<div class="text-center mb-5">
<i class="fas fa-envelope-open-text newsletter-icon"></i>
</div>
<div class="text-center mb-5" id="registernewsletter">
<h1>
NEWSLETTER
</h1>
<p class="white-text">
Dapatkan event dan pembaruan terkini website melalui email.
</p>
</div>

 <div class="newsletter-container mx-auto">
        <!-- STATUS MESSAGE -->
        <?php if ($message): ?>
            <div class="message <?php echo $type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
            
            <!-- RESET BUTTON -->
            <a href="?reset=1" class="reset-btn">
                <i class="fas fa-plus me-2"></i>Daftar Email Lain
            </a>
        <?php else: ?>
            <!-- FORM -->
            <form method="POST" class="newsletter-form" id="newsletterForm">
                <input 
                    type="email" 
                    name="email" 
                    class="email-input" 
                    id="emailInput"
                    placeholder="contoh: user@gmail.com"
                    value="<?php echo htmlspecialchars($email_value); ?>"
                    required 
                    autocomplete="email"
                >
                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-paper-plane me-2"></i>Subscribe
                </button>
            </form>
        <?php endif; ?>
    </div>

</div>
</div>
</div>
</section>
<div class="logo-container">
<div class="logo-main mb-5"></div>
<div class="logo-footer">
<a class="logo-social" href="https://instagram.com/">
<i class="fa-brands fa-instagram"></i>
</a>
<a class="logo-social" href="https://facebook.com/">
<i class="fa-brands fa-facebook"></i>
</a>
<a class="logo-social" href="https://youtube.com/">
<i class="fa-brands fa-youtube"></i>
</a>
</div>
</div>
<div class="footer-section">
<ul class="list-unstyled">
<li class="list">
<a href="<?php echo BASE_URL; ?>tentang">
Tentang
</a>
</li>
<li class="list">
<a href="<?php echo BASE_URL; ?>privacy-policy">
Kebijakan Privasi
</a>
</li>
</ul>
</div>
<div class="text-center mt-5">
<div class="row">
<div class="col-12">
<p style="font-size:12px;opacity:0.7;">
AYOKEBANDUNG.ID
</p>
</div>
</div>
</div>
</div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo JS_URL; ?>chat.js"></script>
<script src="<?php echo JS_URL; ?>search.js"></script>
<script src="<?php echo JS_URL; ?>navbar.js"></script>
<script src="<?php echo JS_URL; ?>weather.js"></script>
<script>
        // DOMAIN VALIDATION JS + PHP SYNC
        const allowedDomains = ['gmail.com', 'googlemail.com', 'yahoo.com', 'ymail.com', 'outlook.com', 'hotmail.com', 'live.com', 'icloud.com', 'me.com', 'protonmail.com', 'proton.me'];
        
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('newsletterForm');
            const input = document.getElementById('emailInput');
            const submitBtn = document.getElementById('submitBtn');
            
            if (input) {
                
                input.addEventListener('input', function() {
                    const email = this.value.trim();
                    this.classList.remove('is-valid', 'is-invalid');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Subscribe';
                    
                    if (email) {
                        if (isValidEmailDomain(email) && this.checkValidity()) {
                            this.classList.add('is-valid');
                            submitBtn.innerHTML = '<i class="fas fa-check-circle me-2"></i>Subscribe Now';
                        } else {
                            this.classList.add('is-invalid');
                            submitBtn.disabled = true;
                            submitBtn.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i>Domain Tidak Valid';
                        }
                    }
                });
                
                // Enter submit
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter' && isValidEmailDomain(this.value.trim())) {
                        form.submit();
                    }
                });
            }
        });
        
        function isValidEmailDomain(email) {
            const domain = email.split('@')[1]?.toLowerCase();
            return allowedDomains.includes(domain);
        }
    </script>
</body>
</html>