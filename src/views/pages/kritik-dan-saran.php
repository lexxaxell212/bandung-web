<?php
$page_title = "Kritik dan Saran";
?>

<div class="container py-5">
    <section id="Kritik-dan-saran" class="text-center mb-5">
        <h1 class="mb-3 fs-1">Kritik & Saran</h1>
        <p class="text-muted">Bantu kami menjadi lebih baik dengan feedback Anda</p>
    </section>

    <!-- Success Message -->
    <div id="feedback-successMsg" class="mx-auto mb-5 d-none" style="max-width:700px">
        <div class="card border-0 shadow-sm">
            <div class="card-body py-5 text-center">
                <i class="fas fa-check-circle fa-3x text-success mb-4"></i>
                <h2 class="text-primary mb-3">Terima Kasih!</h2>
                <p class="text-muted mb-4">Kritik & saran Anda telah berhasil terkirim.</p>
                <div class="alert alert-light border mb-4 text-start">
                    <strong>Detail:</strong><br>
                    <small id="feedback-summaryDetail" class="text-dark"></small>
                </div>
                <button class="btn btn-primary px-4" onclick="location.reload()">
                    <i class="fas fa-redo me-2"></i>Kirim Feedback Lagi
                </button>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div id="feedback-feedbackForm" class="mx-auto" style="max-width:700px">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form id="feedback-feedbackFormMain">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="feedback-nama" name="nama" placeholder="Nama" required>
                                <label for="feedback-nama"><i class="fas fa-user me-2"></i>Nama</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="feedback-email" name="email" placeholder="Email" required>
                                <label for="feedback-email"><i class="fas fa-envelope me-2"></i>Email</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-medium"><i class="fas fa-star me-2"></i>Skor Website (1-10)</label>
                            <div class="d-flex align-items-center gap-3">
                                <input type="range" class="form-range flex-grow-1" id="feedback-rating" name="rating" min="1" max="10" value="8">
                                <span id="feedback-ratingValue" class="badge bg-success fs-6 px-3 py-2 fw-bold">8</span>
                            </div>
                            <small class="text-muted">Rating Anda membantu kami prioritas perbaikan</small>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-medium"><i class="fas fa-tags me-2"></i>Kategori</label>
                            <select class="form-select" name="kategori" required>
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

                        <div class="col-12">
                            <label class="form-label fw-medium"><i class="fas fa-exclamation-triangle me-2"></i>Kritik & Kekurangan</label>
                            <textarea class="form-control" name="kritik" rows="4" placeholder="Apa yang perlu diperbaiki?" required></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-medium"><i class="fas fa-lightbulb me-2"></i>Saran Perbaikan</label>
                            <textarea class="form-control" name="saran" rows="4" placeholder="Fitur apa yang ingin ditambahkan?" required></textarea>
                        </div>

                        <div class="col-12 d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>
                                <span id="feedback-btnText">Kirim Feedback</span>
                                <span id="feedback-loadingSpinner" class="d-none ms-2">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </span>
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function sanitize(str) {
    if (!str) return '-';
    const map = { '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;' };
    return String(str).replace(/[&<>"']/g, m => map[m]);
}

let lastSubmit = 0;
const RATE_LIMIT_MS = 5000;

document.getElementById('feedback-rating').addEventListener('input', function() {
    const val = parseInt(this.value);
    const badge = document.getElementById('feedback-ratingValue');
    badge.textContent = val;
    badge.className = `badge fs-6 px-3 py-2 fw-bold ${val >= 8 ? 'bg-success' : val >= 6 ? 'bg-warning' : 'bg-danger'}`;
});

document.getElementById('feedback-feedbackFormMain').addEventListener('submit', async function(e) {
    e.preventDefault();

    if (Date.now() - lastSubmit < RATE_LIMIT_MS) {
        const remaining = Math.ceil((RATE_LIMIT_MS - (Date.now() - lastSubmit)) / 1000);
        alert(`Tunggu ${remaining} detik sebelum kirim lagi`);
        return;
    }
    lastSubmit = Date.now();

    const form      = document.getElementById('feedback-feedbackForm');
    const successMsg = document.getElementById('feedback-successMsg');
    const submitBtn  = this.querySelector('button[type="submit"]');
    const btnTextEl  = document.getElementById('feedback-btnText');
    const spinner    = document.getElementById('feedback-loadingSpinner');

    submitBtn.disabled = true;
    btnTextEl.textContent = 'Mengirim...';
    spinner.classList.remove('d-none');

    try {
        const formData = new FormData(this);
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), 10000);

        const response = await fetch('/api/api-feedback.php', {
            method: 'POST',
            body: formData,
            signal: controller.signal,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        clearTimeout(timeoutId);
        const data = await response.json();

        if (data.success) {
            document.getElementById('feedback-summaryDetail').innerHTML =
                `Nama: ${sanitize(formData.get('nama'))}<br>` +
                `Rating: ${sanitize(String(formData.get('rating')))}/10<br>` +
                `Kategori: ${sanitize(formData.get('kategori'))}<br>` +
                `Waktu: ${new Date().toLocaleString('id-ID')}`;

            form.classList.add('d-none');
            successMsg.classList.remove('d-none');
            successMsg.scrollIntoView({ behavior: 'smooth' });
        } else {
            throw new Error(data.error || 'Server error');
        }
    } catch (error) {
        let errorMsg = 'Gagal mengirim feedback';
        if (error.name === 'AbortError') errorMsg = 'Timeout 10 detik. Cek koneksi internet';
        else if (error.name === 'TypeError') errorMsg = 'Tidak bisa connect ke server';
        else errorMsg += ': ' + error.message;
        alert(errorMsg);
    } finally {
        submitBtn.disabled = false;
        btnTextEl.textContent = 'Kirim Feedback';
        spinner.classList.add('d-none');
    }
});
</script>