<?php 
$page_title = "Kritik dan Saran - MyApp";
require_once 'config/config.php';
require_once 'includes/header.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        :root {
            --primary: #0d6efd;
            --success: #198754;
            --warning: #ffc107;
            --danger: #dc3545;
            --light-bg: #f8f9fa;
        }

        body { 
            background: var(--light-bg); 
            font-family: system-ui, -apple-system, sans-serif; 
            line-height: 1.6; 
        }

        .hero-section { 
            background: linear-gradient(135deg, var(--primary) 0%, #0a58ca 100%); 
            color: white; 
            padding: 4rem 0; 
        }

        .hero-title { 
            font-size: 2.5rem; 
            font-weight: 600; 
        }

        .feedback-form { 
            background: white; 
            border-radius: 15px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
            padding: 2.5rem; 
            margin: 3rem auto; 
            max-width: 700px; 
        }

        .form-floating label { color: #6c757d; }

        .btn-send { 
            background: linear-gradient(135deg, var(--primary), #0a58ca); 
            border: none; 
            padding: 0.75rem 2rem; 
            font-weight: 600; 
            border-radius: 50px; 
            color: white; 
        }

        .btn-send:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 8px 25px rgba(13,110,253,0.4); 
            color: white; 
        }

        .success-message { 
            background: linear-gradient(135deg, var(--success), #20c997); 
            color: white; 
            padding: 2.5rem; 
            border-radius: 15px; 
            text-align: center; 
            display: none; 
            max-width: 700px; 
            margin: 3rem auto; 
        }

        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-left: 10px;
        }

        @keyframes spin { 
            0% { transform: rotate(0deg); } 
            100% { transform: rotate(360deg); } 
        }

        @media (max-width: 768px) {
            .hero-title { font-size: 2rem; }
            .feedback-form, .success-message { margin: 1rem; padding: 1.5rem; }
        }
    </style>
</head>

<body>

<div class="page-container mt-5">
    
    <!-- Success Message -->
    <div id="successMsg" class="success-message">
        <div class="container">
            <i class="fas fa-check-circle fa-3x mb-4"></i>
            <h3 class="mb-3">✅ Terima Kasih!</h3>
            <p class="lead mb-4">Kritik & saran Anda telah berhasil terkirim ke tim developer.</p>
            <div class="alert alert-light border-0">
                <strong>Detail:</strong><br>
                <small id="summaryDetail"></small>
            </div>
            <button class="btn btn-light btn-lg px-4 mt-3" onclick="location.reload()">
                <i class="fas fa-redo me-2"></i>Kirim Feedback Lagi
            </button>
        </div>
    </div>

    <!-- Feedback Form -->
    <div id="feedbackForm" class="feedback-form">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center mb-4">
                    <i class="fas fa-edit me-2 text-primary"></i>
                    Isi Form Kritik & Saran
                </h3>
                <p class="text-center text-muted mb-4">Form ini akan dikirim ke email developer (100% aman & private)</p>
                
                <form id="feedbackFormMain" method="POST">
                    <!-- Nama -->
                    <div class="col-12 mb-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                            <label for="nama"><i class="fas fa-user me-2"></i>Nama Lengkap</label>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-12 mb-4">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                        </div>
                    </div>

                    <!-- Rating -->
                    <div class="col-12 mb-4">
                        <label class="form-label fw-bold mb-2">
                            <i class="fas fa-star me-2 text-warning"></i>Skor Website (1-10)
                        </label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="range" class="form-range flex-grow-1" id="rating" name="rating" min="1" max="10" value="8">
                            <span id="ratingValue" class="badge fs-6 px-3 py-2 fw-bold bg-primary">8</span>
                        </div>
                        <small class="text-muted">Rating Anda akan membantu kami prioritas perbaikan</small>
                    </div>

                    <!-- Kategori -->
                    <div class="col-12 mb-4">
                        <label class="form-label fw-bold mb-2">
                            <i class="fas fa-tags me-2"></i>Kategori Masalah
                        </label>
                        <select class="form-select" name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="desain">🎨 Desain & UI/UX</option>
                            <option value="konten">📚 Konten & Informasi</option>
                            <option value="fungsional">⚙️ Fungsionalitas</option>
                            <option value="performance">⚡ Performance & Speed</option>
                            <option value="seo">🔍 SEO & Sharing</option>
                            <option value="mobile">📱 Mobile Responsif</option>
                            <option value="lainnya">❓ Lainnya</option>
                        </select>
                    </div>

                    <!-- Kritik -->
                    <div class="col-12 mb-4">
                        <label class="form-label fw-bold mb-2">
                            <i class="fas fa-exclamation-triangle text-warning me-2"></i>Kritik & Kekurangan
                        </label>
                        <textarea class="form-control" id="kritik" name="kritik" rows="4" 
                                  placeholder="Apa yang perlu diperbaiki? Contoh: 'Loading lambat di mobile', 'Tombol kurang jelas', 'Konten kurang lengkap', dll..." required></textarea>
                        <div class="form-text">Jujur dan spesifik = lebih bermanfaat</div>
                    </div>

                    <!-- Saran -->
                    <div class="col-12 mb-4">
                        <label class="form-label fw-bold mb-2">
                            <i class="fas fa-lightbulb text-success me-2"></i>Saran Perbaikan
                        </label>
                        <textarea class="form-control" id="saran" name="saran" rows="4" 
                                  placeholder="Fitur apa yang ingin ditambahkan? Contoh: 'Dark mode', 'Search bar', 'Galeri foto historis', 'PWA install', dll..." required></textarea>
                        <div class="form-text">Ide kreatif Anda sangat berharga!</div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-send btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>
                                <span id="btnText">Kirim Feedback</span>
                                <div id="loadingSpinner" class="loading-spinner"></div>
                            </button>
                        </div>
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class="fas fa-lock me-1"></i>
                                Data aman & private • Dikirim ke developer@websitefeedback.com
                            </small>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>

</body>

    <script>
        // Rating slider real-time
        const ratingSlider = document.getElementById('rating');
        const ratingValue = document.getElementById('ratingValue');
        
        ratingSlider.addEventListener('input', function() {
            const value = this.value;
            ratingValue.textContent = value;
            
            // Dynamic badge color
            if (value >= 8) {
                ratingValue.className = 'badge bg-success fs-6 px-3 py-2 fw-bold';
            } else if (value >= 6) {
                ratingValue.className = 'badge bg-warning fs-6 px-3 py-2 fw-bold';
            } else {
                ratingValue.className = 'badge bg-danger fs-6 px-3 py-2 fw-bold';
            }
        });

        // Form submission AJAX
        document.getElementById('feedbackFormMain').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const btnText = document.getElementById('btnText');
            const spinner = document.getElementById('loadingSpinner');
            const form = document.getElementById('feedbackForm');
            const successMsg = document.getElementById('successMsg');
            const summaryDetail = document.getElementById('summaryDetail');
            
            // Loading state
            submitBtn.disabled = true;
            btnText.textContent = 'Mengirim...';
            spinner.style.display = 'inline-block';
            
            try {
                const response = await fetch('send-feedback.php', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.status === 'success') {
                    // Summary detail
                    summaryDetail.innerHTML = `
                        Nama: ${data.data.nama}<br>
                        Rating: ${data.data.rating}/10<br>
                        Kategori: ${data.data.kategori}<br>
                        Waktu: ${new Date().toLocaleString('id-ID')}
                    `;
                    
                    // Show success, hide form
                    form.style.display = 'none';
                    successMsg.style.display = 'block';
                    successMsg.scrollIntoView({ behavior: 'smooth' });
                } else {
                    alert('❌ Error: ' + data.message);
                }
            } catch (error) {
                alert('❌ Network Error: ' + error.message);
                console.error('Feedback error:', error);
            } finally {
                // Reset button
                submitBtn.disabled = false;
                btnText.textContent = 'Kirim Feedback';
                spinner.style.display = 'none';
            }
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault();
                const target = document.querySelector(link.getAttribute('href'));
                if (target) target.scrollIntoView({ behavior: 'smooth' });
            });
        });

        // Auto-focus first input
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('nama').focus();
        });
    </script>

</html>


<?php 

/* Footer */

require_once 'includes/footer.php'; ?>

