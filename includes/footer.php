</div>
<footer id="footer" class="footer">
  <div class="container">
    <section class="newsletter-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-8 col-lg-10">
            <div class="text-center mb-5">
              <h4 style="font-size:40px" class="fas fa-envelope"></h4>
            </div>
            <div class="text-center mb-5" id="registernewsletter">
              <h1>NEWSLETTER</h1>
              <p class="mb-3">
                Dapatkan event dan pembaruan terkini website melalui email.
              </p>
            </div>
            <div class="newsletter-container mx-auto">
              <div id="newsletterMessage" class="message" style="display: none;"></div>
              <form class="newsletter-form" id="newsletterForm">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
                
                <input type="email" name="email" class="email-input" id="emailInput" placeholder="contoh: user@gmail.com" required autocomplete="email">
                <input type="hidden" name="action" value="newsletter">
                <button type="submit" class="submit-btn btn btn-primary btn-sm" id="submitBtn">
                  <i class="fas fa-paper-plane me-2"></i>Subscribe
                </button>
              </form>
            </div>
    
            <script>
              const allowedDomains = ['gmail.com', 'googlemail.com', 'yahoo.com', 'ymail.com', 'rocketmail.com', 'outlook.com', 'hotmail.com', 'live.com', 'icloud.com', 'me.com', 'protonmail.com', 'proton.me'];
              
              document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('newsletterForm');
                const input = document.getElementById('emailInput');
                const submitBtn = document.getElementById('submitBtn');
    
                if (!input || !form || !submitBtn) return;
    
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
    
                form.addEventListener('submit', function(e) {
                  e.preventDefault();
                  
                  // Proteksi double-click
                  if (submitBtn.disabled) return;
    
                  const email = input.value.trim();
                  const csrf = document.querySelector('input[name="csrf_token"]')?.value || '';
    
                  if (!email || !isValidEmailDomain(email)) {
                    showFloatingMessage('Email atau domain tidak valid!', 'error');
                    return;
                  }
    
                  submitBtn.disabled = true;
                  submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
                  hideMessage();
    
                  // Sertakan CSRF token dalam pengiriman
                  const postData = `action=newsletter&email=${encodeURIComponent(email)}&csrf_token=${encodeURIComponent(csrf)}`;
    
                  fetch('/newsletter-ajax.php', {
                      method: 'POST',
                      headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                      },
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
                      showFloatingMessage('Terjadi gangguan koneksi.', 'error');
                    })
                    .finally(() => {
                      submitBtn.disabled = false;
                      submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Subscribe';
                    });
                });
    
                function showFloatingMessage(text, type) {
                  hideMessage();
                  const message = document.createElement('div');
                  message.id = 'floatingMessage';
                  message.className = `floating-message floating-${type}`;
                  message.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle'} me-2"></i>${text}`;
                  
                  Object.assign(message.style, {
                    position: 'fixed',
                    top: '20px',
                    right: '20px',
                    zIndex: '9999',
                    padding: '16px 24px',
                    borderRadius: '0.75rem',
                    boxShadow: '0 12px 40px rgba(0,0,0,0.1)',
                    fontWeight: '600',
                    fontSize: '14px',
                    maxWidth: '350px',
                    backgroundColor: type === 'success' ? '#d1e7dd' : '#f8d7da', // Warna fallback
                    color: type === 'success' ? '#0f5132' : '#842029',
                    backdropFilter: 'blur(10px)',
                    transform: 'translateX(400px)',
                    transition: 'all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94)',
                    pointerEvents: 'none'
                  });
    
                  document.body.appendChild(message);
                  requestAnimationFrame(() => {
                    message.style.transform = 'translateX(0)';
                  });
    
                  setTimeout(() => {
                    message.style.transform = 'translateX(400px)';
                    setTimeout(() => { if (message.parentNode) message.parentNode.removeChild(message); }, 400);
                  }, 5000);
                }
    
                function hideMessage() {
                  const msg = document.getElementById('floatingMessage');
                  if (msg) {
                    msg.style.transform = 'translateX(400px)';
                    setTimeout(() => { if (msg.parentNode) msg.parentNode.removeChild(msg); }, 400);
                  }
                }
    
                function isValidEmailDomain(email) {
                  const domain = email.split('@')[1]?.toLowerCase();
                  return allowedDomains.includes(domain);
                }
              });
            </script>
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
          <p style="font-size:10px;opacity:0.5;">
            AYOKEBANDUNG.ID
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo JS_URL; ?>chat.js"></script>
<script src="<?php echo JS_URL; ?>live-search.js"></script>
<script src="<?php echo JS_URL; ?>navbar.js"></script>
<script src="<?php echo JS_URL; ?>weather.js"></script>
</body>

</html>
