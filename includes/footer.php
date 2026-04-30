</div>
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
    <div id="newsletterMessage" class="message" style="display: none;"></div>
    
    <form class="newsletter-form" id="newsletterForm">
        <input 
            type="email" 
            name="email" 
            class="email-input" 
            id="emailInput"
            placeholder="contoh: user@gmail.com"
            required 
            autocomplete="email"
        >
        <input type="hidden" name="action" value="newsletter">
        <button type="submit" class="submit-btn" id="submitBtn">
            <i class="fas fa-paper-plane me-2"></i>Subscribe
        </button>
    </form>
</div>
<script>
const allowedDomains = ['gmail.com','googlemail.com','yahoo.com','ymail.com','rocketmail.com','outlook.com','hotmail.com','live.com','icloud.com','me.com','protonmail.com','proton.me'];

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('newsletterForm');
    const input = document.getElementById('emailInput');
    const submitBtn = document.getElementById('submitBtn');
    
    if (!input || !form || !submitBtn) return;
    
    // 1. REAL-TIME VALIDATION
    input.addEventListener('input', function() {
        const email = this.value.trim();
        this.classList.remove('is-valid', 'is-invalid');
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Subscribe';
        hideMessage();
        
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
    
    // 2. ENTER KEY
    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !submitBtn.disabled) {
            form.dispatchEvent(new Event('submit'));
        }
    });
    
    // 3. AJAX SUBMIT
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const email = input.value.trim();
        if (!email || !isValidEmailDomain(email)) {
            showFloatingMessage('Email atau domain tidak valid!', 'error');
            return;
        }
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
        hideMessage();
        
        const postData = `action=newsletter&email=${encodeURIComponent(email)}`;
        
        fetch('/newsletter-ajax.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: postData
        })
        .then(response => {
            if (!response.ok) throw new Error(`HTTP ${response.status}`);
            return response.json();
        })
        .then(data => {
            const type = data.type || (data.success ? 'success' : 'error');
            showFloatingMessage(data.message || (data.success ? 'Berhasil berlangganan!' : 'Gagal!'), type);
            
            if (data.success) {
                input.value = '';
                input.classList.remove('is-valid', 'is-invalid');
            } else {
                input.value = data.email_value || email;
                input.classList.add('is-invalid');
                input.focus();
            }
        })
        .catch(error => {
            console.error('AJAX Error:', error);
            showFloatingMessage('Koneksi gagal: ' + error.message, 'error');
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Subscribe';
        });
    });
    
    // FLOATING MESSAGE SYSTEM
    function showFloatingMessage(text, type) {
        // Hapus message lama
        hideMessage();
        
        // Buat floating message
        const message = document.createElement('div');
        message.id = 'floatingMessage';
        message.className = `floating-message floating-${type}`;
        message.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle'} me-2"></i>${text}`;
        
        // Style inline
        Object.assign(message.style, {
            position: 'fixed',
            top: '20px',
            right: '20px',
            zIndex: '9999',
            padding: '16px 24px',
            borderRadius: '12px',
            boxShadow: '0 12px 40px rgba(0,0,0,0.15)',
            fontWeight: '600',
            fontSize: '16px',
            maxWidth: '350px',
            backdropFilter: 'blur(10px)',
            border: '1px solid rgba(255,255,255,0.2)',
            transform: 'translateX(400px)',
            transition: 'all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94)',
            pointerEvents: 'none'
        });
        
        document.body.appendChild(message);
        
        // Animate IN
        requestAnimationFrame(() => {
            message.style.transform = 'translateX(0)';
        });
        
        // Auto hide 5 detik
        setTimeout(() => {
            message.style.transform = 'translateX(400px)';
            setTimeout(() => {
                if (message.parentNode) {
                    message.parentNode.removeChild(message);
                }
            }, 400);
        }, 5000);
    }
    
    function hideMessage() {
        const msg = document.getElementById('floatingMessage');
        if (msg) {
            msg.style.transform = 'translateX(400px)';
            setTimeout(() => {
                if (msg.parentNode) msg.parentNode.removeChild(msg);
            }, 400);
        }
    }
    
    function isValidEmailDomain(email) {
        const domain = email.split('@')[1]?.toLowerCase();
        return allowedDomains.includes(domain);
    }
});
</script>
<style>.newsletter-container{border-radius:24px;padding:30px;max-width:350px;width:100%;box-shadow:0
16px 30px
rgba(0,0,0,.1);text-align:center}.message.success{background:var(--blue-100);color:var(--blue-900);border-radius:12px}.message.error{background:var(--blue-100);color:red;border-radius:12px}.message.warning{background:var(--blue-100);color:var(--orange-500);border-radius:12px}.message
i{font-size:1.5rem}.newsletter-form{display:flex;flex-direction:column;gap:1rem}.email-input{padding:16px
20px;border:2px solid #e2e8f0;border-radius:12px;font-size:16px;transition:all
.3s;background:#f8fafc}.email-input:focus{outline:none;border-color:#667eea;box-shadow:0
0 0 4px
rgba(102,126,234,.1);background:#fff}.email-input.is-valid{border-color:#10b981;background:#f0fdf4}.email-input.is-invalid{border-color:#ef4444;background:#fef2f2}.submit-btn{padding:16px;background:linear-gradient(135deg,var(--blue-600)
0%,var(--blue-800)
100%);color:var(--blue-50);border:none;border-radius:22px;font-size:16px;font-weight:600;cursor:pointer;transition:all
.3s;box-shadow:0 8px 25px
rgba(102,126,234,.3)}.submit-btn:hover{transform:translateY(-2px);box-shadow:0
12px 35px rgba(102,126,234,.4)}.reset-btn{background:none;border:2px solid
#60a5fa;color:#60a5fa;padding:12px
24px;border-radius:25px;text-decoration:none;font-weight:500;transition:all
.3s;display:inline-block;margin-top:1rem}.reset-btn:hover{background:#60a5fa;color:#fff;transform:translateY(-1px)}@media
(max-width:480px){.newsletter-container{padding:20px;margin:10px}.title{font-size:1.75rem}}.floating-message{background:rgba(255,255,255,.95);backdrop-filter:blur(20px)}.floating-success{border-left:4px
solid #10b981;background:rgba(16,185,129,.1)!important;color:#065f46}.floating-error{border-left:4px
solid #ef4444;background:rgba(239,68,68,.1)!important;color:#991b1b}@media
(prefers-color-scheme:dark){.floating-message{background:rgba(30,41,59,.95)!important;color:#f1f5f9;border-color:rgba(255,255,255,.1)}}</style>

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
<a href="<?php echo BASE_URL; ?>pages/tentang">
Tentang
</a>
</li>
<li class="list">
<a href="<?php echo BASE_URL; ?>pages/privacy-policy">
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
</body>
</html>