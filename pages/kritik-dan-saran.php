<?php 
$page_title = 'Kritik dan Saran';
require '../includes/header.php'; 
?>

<div class="container">
<style>
:root {
      --success-gradient: linear-gradient(135deg, #198754, #20c997);
    }
      .feedback-hero-title {
        font-size: 2.5rem;
      }
      .feedback-feedbackForm {
        padding: 25px 10px;
        margin-top: 70px;
        margin-bottom: 100px;
        border-radius: 18px;
        box-shadow: 0 10px 20px rgba(127,127,190, 0.5);
      }
      .feedback-success-card {
        background: var(--success-gradient);
        color: white;
        border-radius: 15px;
        border: none;
        display: none;
      }
      .feedback-loading-spinner {
        width: 20px;
        height: 20px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #0d6efd;
        border-radius: 50%;
        animation: spin 1s linear infinite;
      }
      @keyframes spin {
        0% {
          transform: rotate(0deg);
        }
        100% {
          transform: rotate(360deg);
        }
      }
      @media (max-width: 768px) {
        .feedback-hero-title {
          font-size: 2rem;
        }
      }
    </style>
    <section class="p-5 mb-5 mt-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center mt-5">
            <i class="fas fa-comments fa-3x mb-4 opacity-75"></i>
            <h1 class="feedback-hero-title text-title mb-3">Kritik & Saran</h1>
            <p>
              Bantu kami menjadi lebih baik dengan feedback Anda
            </p>
          </div>
        </div>
      </div>
    </section>
    <div id="feedback-successMsg" class="feedback-success-card mx-auto mb-5" style="max-width: 700px;">
      <div class="card-body py-5">
        <div class="text-center">
          <i class="fas fa-check-circle fa-3x mb-4"></i>
          <h2 class="text-primary mb-4">Terima Kasih!</h2>
          <p class="mb-4">
            Kritik & saran Anda telah berhasil terkirim.
          </p>
          <div class="alert alert-light border-0 mb-4">
            <strong>Detail:</strong><br>
            <small id="feedback-summaryDetail" class="text-dark"></small>
          </div>
          <button class="btn btn-light btn-lg px-4" onclick="location.reload()">
            <i class="fas fa-redo me-2"></i>Kirim Feedback Lagi
          </button>
        </div>
      </div>
    </div>
    <div id="feedback-feedbackForm" class="mx-auto feedback-feedbackForm" style="max-width: 700px;">
      <div class="p-5 m-5">
        <div class="text-center mb-6">
          <h3 class="mb-3">
            <i class="fas fa-edit text-primary me-2"></i>
            Isi Form Kritik & Saran
          </h3>
          <p class="mb-6">
            Kritik dan Saran anda sangat berarti bagi kami.
          </p>
        </div>

        <form id="feedback-feedbackFormMain">
          <div class="row g-4 mt-6">

            <div class="col-12 mt-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="feedback-nama" name="nama" placeholder="Nama" required>
                <label for="feedback-nama">
                  <span class="text-muted"><i class="fas fa-user me-2"></i>Nama</span>
                </label>
              </div>
            </div>

            <div class="col-12 mb-6">
              <div class="form-floating">
                <input type="email" class="form-control" id="feedback-email" name="email" placeholder="Email" required>
                <label for="feedback-email">
                  <span class="text-muted"><i class="fas fa-envelope me-2"></i>Email</span>
                </label>
              </div>
            </div>

            <div class="col-12 mb-6 mt-6">
              <label class="form-label fw-bold mb-3">
                <i class="fas fa-star me-2"></i>Skor Website (1-10)
              </label>
              <div class="d-flex align-items-center gap-3 mb-2">
                <input type="range" class="form-range flex-grow-1" id="feedback-rating" name="rating" min="1" max="10" value="8">
                <span id="feedback-ratingValue" class="badge bg-primary fs-6 px-3 py-2 fw-bold">8</span>
              </div>
              <small class="text-muted">Rating Anda akan membantu kami prioritas perbaikan</small>
            </div>

            <div class="col-12 mb-6">
              <label class="form-label fw-bold mb-3">
                <i class="fas fa-tags me-2"></i>Kategori Masalah
              </label>
              <select class="form-select form-select-md" name="kategori" required>
                <option value="">Pilih Kategori</option>
                <option value="desain">Desain & UI/UX</option>
                <option value="konten">Konten & Informasi</option>
                <option value="fungsional">Fungsionalitas</option>
                <option value="performance">Performance & Speed</option>
                <option value="seo">SEO & Sharing</option>
                <option value="mobile">Mobile Responsif</option>
                <option value="lainnya">Lainnya</option>
              </select>
            </div>

            <div class="col-12 mb-6">
              <label class="form-label fw-bold mb-3">
                <i class="fas fa-exclamation-triangle me-2"></i>Kritik & Kekurangan
              </label>
              <textarea class="form-control" id="feedback-kritik" name="kritik" rows="4"
                placeholder="Apa yang perlu diperbaiki? Contoh: 'Loading lambat di mobile', 'Tombol kurang jelas', 'Konten kurang lengkap'..." required></textarea>
            </div>

            <div class="col-12 mb-6">
              <label class="form-label fw-bold mb-3">
                <i class="fas fa-lightbulb me-2"></i>Saran Perbaikan
              </label>
              <textarea class="form-control" id="feedback-saran" name="saran" rows="4"
                placeholder="Fitur apa yang ingin ditambahkan? Contoh: 'Dark mode', 'Search bar', 'Galeri foto historis'... " required></textarea>
              <div class="mt-1">
                <small class="text-muted">
                Ide kreatif Anda sangat berharga!
                </small>
              </div>
            </div>

            <div class="col-12 mb-6">
              <div class="d-grid mb-6">
                <button type="submit" class="btn btn-primary feedback-btn-send mb-6 mx-auto">
                  <i class="fas fa-paper-plane me-2"></i>
                  <span id="feedback-btnText">Kirim Feedback</span>
                  <span id="feedback-loadingSpinner" class="feedback-loading-spinner d-none ms-2"></span>
                </button>
              </div>
              <div class="text-center mt-6">
                <small class="text-muted mt-6">
                  <i class="fas fa-lock me-1"></i>
                  Data aman & private • Dikirim ke admin@ayokebandung.id
                </small>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <script>
      function sanitize(str) {
        const map = {
          '&': '&amp;',
          '<': '&lt;',
          '>': '&gt;',
          '"': '&quot;',
          "'": '&#039;'
        };
        return str.replace(/[&<>"']/g, m => map[m]);
        }

          let lastSubmit = 0;
          const RATE_LIMIT_MS = 5000;

          document.getElementById('feedback-rating').addEventListener('input', function() {
            const val = Math.max(1, Math.min(10, parseInt(this.value)));
            const ratingValue = document.getElementById('feedback-ratingValue');
            ratingValue.textContent = val;

            ratingValue.className = `badge ${
            val >= 8 ? 'bg-success':
            val >= 6 ? 'bg-warning': 'bg-danger'
            } fs-6 px-3 py-2 fw-bold`;
          });

          document.getElementById('feedback-feedbackFormMain').addEventListener('submit', async function(e) {
            e.preventDefault();

            if (Date.now() - lastSubmit < RATE_LIMIT_MS) {
              const remaining = Math.ceil((RATE_LIMIT_MS - (Date.now() - lastSubmit)) / 1000);
              alert(`Tunggu ${remaining} detik sebelum kirim lagi`);
              return;
            }
            lastSubmit = Date.now();

            const form = document.getElementById('feedback-feedbackForm');
            const successMsg = document.getElementById('feedback-successMsg');
            const submitBtn = this.querySelector('.feedback-btn-send');
            const btnTextEl = document.getElementById('feedback-btnText');
            const spinner = document.getElementById('feedback-loadingSpinner');

            submitBtn.disabled = true;
            const originalBtnText = btnTextEl.textContent;
            btnTextEl.textContent = 'Mengirim...';
            spinner.classList.remove('d-none');

            try {
              const formData = new FormData(this);
              const controller = new AbortController();

              const timeoutId = setTimeout(() => controller.abort(), 10000);

              const response = await fetch('feedback-send-feedback.php', {
                method: 'POST',
                body: formData,
                signal: controller.signal
              });

              clearTimeout(timeoutId);

              const data = await response.json();

              if (data.status === 'success') {
                // Show success
                document.getElementById('feedback-summaryDetail').innerHTML =
                `Nama: ${sanitize(data.data.nama)}<br>` +
                `Rating: ${sanitize(data.data.rating)}/10<br>` +
                `Kategori: ${sanitize(data.data.kategori)}<br>` +
                `Waktu: ${new Date().toLocaleString('id-ID')}`;

                form.classList.add('d-none');
                successMsg.style.display = 'block';
                successMsg.scrollIntoView({
                  behavior: 'smooth'
                });
              } else {
                throw new Error(data.message || 'Server error');
              }
            } catch (error) {
              let errorMsg = '❌ Gagal mengirim feedback';

              if (error.name === 'AbortError') {
                errorMsg = '⏰ Timeout 10 detik. Cek koneksi internet';
              } else if (error.name === 'TypeError' && error.message.includes('fetch')) {
                errorMsg = '❌ Tidak bisa connect ke server';
              } else {
                errorMsg += ': ' + error.message;
              }

              alert(errorMsg);
            } finally {
              submitBtn.disabled = false;
              btnTextEl.textContent = originalBtnText;
              spinner.classList.add('d-none');
            }
          });

          document.addEventListener('DOMContentLoaded', () => {
            const namaField = document.getElementById('feedback-nama');
            if (namaField) namaField.focus();
          });
        </script>

</div>
<?php
require '../includes/footer.php';
?>