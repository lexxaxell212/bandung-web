<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link href="<?php echo CSS_URL; ?>footer.css" rel="stylesheet">
</head>
<body>
  <br><br><br><br>
  <!-- FOOTER 3 KOLOM -->
  <footer class="footer">
    <div class="container">
      <!-- Newsletter section -->
      <div>
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
                  <h1>
                    NEWSLETTER
                  </h1>
                  <p class="white-text">
                    Dapatkan berita, event dan pembaruan terkini website.
                  </p>
                </div>
                <!-- Newsletter Form -->
                <div class="newsletter-card justify-content-center">
                  <form id="newsletterForm">
                    <div class="input-group-newsletter input-group-lg mb-0">
                      <input type="email" class="form-control newsletter-input" id="emailInput" placeholder="Masukan email anda" required>
                    </div>
                    <button class="btn btn-subscribe" type="submit">
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
                    <p class="white-text">Silahkan periksa kotak masuk email anda!</p>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </section>
      </div>
      <script>
      </script>
      <div class="logo-container">
        <div class="logo-footer mx-auto">
          <img class=logo-main src="<?php echo IMG_URL?>logo.png">
          <!-- Atau: <img src="logo.png" class="img-fluid" style="max-width: 140px;"> -->
        </div>
        <!-- 3 Logo Sosmed -->
        <div class="logo-footer">
          <a class="logo-social" href="#">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <a class="logo-social" href="#">
            <i class="fa-brands fa-facebook"></i>
          </a>
          <a class="logo-social" href="#">
            <i class="fa-brands fa-youtube"></i>
          </a>
        </div>
      </div>
      <div class="footer-section">
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
      <div class="text-center">
        <div class="row">
          <div class="col-12">
            <p class="white-text">
              © <?php echo date('Y'); ?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <br><br><br><br>
  </footer>
  <script src="<?php echo JS_URL; ?>footer.js"></script>
</body>
</html>