<?php 
$page_title = 'Privacy policy';
require '../includes/header.php'; 
?>

<div class="container">
<style>
  .privacy-header {
    padding: 4rem 1rem;
    color: var(--blue-900);
  }

  .privacy-container {
    padding: 2rem 1rem;
    margin: 0 auto;
  }

  .privacy-section {
    margin-bottom: 4rem;
  }

  .privacy-highlight {
    background: var(--blue-200);
    border-left: 5px solid var(--blue-300);
    padding: 1.75rem 2rem;
    margin-bottom: 4rem;
    color: var(--blue-900);
    border-radius: 0 12px 12px 0;
  }

  .privacy-contact {
    text-align: center;
    padding: 2.5rem;
    background: rgba(0,0,0, 0.03);
    border-radius: 16px;
    margin: 3rem auto;
    color: var(--blue-900);
    border: 2px solid rgba(59, 130, 246, 0.1);
    transition: all 0.3s ease;
  }

  .privacy-contact:hover {
    background: rgba(0,0,0, 0.05);
    border-color: var(--blue-300);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
  }

  .privacy-email {
    font-weight: 700;
    font-size: 1.25rem;
    text-decoration: none;
    color: var(--blue-900);
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }

  .privacy-email:hover {
    color: #1d4ed8;
    transform: translateX(5px);
  }

  .privacy-icon {
    width: 48px;
    height: 48px;
    background: var(--blue-200);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--blue-900);
    font-size: 1.25rem;
    margin-bottom: 1rem;
  }

  @media (max-width: 768px) {
    .privacy-header {
      padding: 2.5rem 1rem;
    }
    .privacy-container {
      padding: 1.5rem 1rem;
    }
  }
</style>
<section class="privacy-header text-center">
  <div class="container">
    <i class="fas fa-shield-halved fa-4x mb-4 opacity-90"></i>
    <h1 class="privacy-title mb-3">Kebijakan Privasi</h1>
    <p class="mb-0">
      Kami berkomitmen melindungi data pribadi Anda
    </p>
  </div>
</section>
<div class="privacy-container">
  <div class="privacy-section">
    <div class="privacy-icon">
      <i class="fas fa-database"></i>
    </div>
    <h2 class="h4 font-bold mb-4">
      1. Informasi yang Kami Kumpulkan
    </h2>
    <p class="mb-4">
      Kami mengumpulkan informasi berikut untuk memberikan layanan terbaik:
    </p>
    <div class="row g-3">
      <div class="col-md-4">
        <div class="text-center p-4 border rounded-3 glass">
          <i class="fas fa-user fa-2x text-muted mb-2"></i>
          <div>
            <strong class="h6">Nama & Email</strong>
          </div>
          <small class="text-muted">Saat mendaftar</small>
        </div>
      </div>
      <div class="col-md-4">
        <div class="text-center p-4 border rounded-3 glass">
          <i class="fas fa-globe fa-2x text-muted mb-2"></i>
          <div>
            <strong class="h6">Data Kunjungan</strong>
          </div>
          <small class="text-muted">IP, browser</small>
        </div>
      </div>
      <div class="col-md-4">
        <div class="text-center p-4 border rounded-3 glass">
          <i class="fas fa-cookie-bite fa-2x text-muted mb-2"></i>
          <div>
            <strong class="h6">Cookie</strong>
          </div>
          <small class="text-muted">Analitik</small>
        </div>
      </div>
    </div>
  </div>

  <div class="privacy-section">
    <div class="privacy-icon">
      <i class="fas fa-gears"></i>
    </div>
    <h2 class="h4 font-bold mb-4">
      2. Penggunaan Data
    </h2>
    <p class="mb-4">
      Data digunakan HANYA untuk:
    </p>
    <ul class="glass p-6">
      <li class="list-group-item px-0 border-0 py-2 text-primary">
        <i class="fas fa-check-circle text-success me-3"></i>
        Menyediakan layanan optimal
      </li>
      <li class="list-group-item px-0 border-0 py-2 text-primary">
        <i class="fas fa-check-circle text-success me-3"></i>
        Kirim berita & event terbaru
      </li>
      <li class="list-group-item px-0 border-0 py-2 text-primary">
        <i class="fas fa-check-circle text-success me-3"></i>
        Analisis pengunjung (anonim)
      </li>
    </ul>
  </div>

  <div class="privacy-highlight text-center">
    <i class="fas fa-handshake fa-2x me-3 mb-3 text-secondary align-middle"></i>
    <strong class="d-inline-block">
      Kami <span class="text-decoration-underline text-danger">TIDAK</span> menjual data pribadi Anda.
    </strong>
  </div>

  <div class="privacy-section">
    <div class="privacy-icon">
      <i class="fas fa-share-nodes"></i>
    </div>
    <h2 class="h4 font-bold mb-4">
      3. Berbagi Data
    </h2>
    <p class="mb-4">
      Data dibagikan TERBATAS dengan:
    </p>
    <div class="row g-3">
      <div class="col-lg-4 col-md-6">
        <div class="glass h-100">
          <div class="text-center p-4">
            <i class="fas fa-server fa-2x text-secondary mb-3"></i>
            <h6 class="font-semibold">Penyedia Layanan</h6>
            <small class="text-muted">Hosting, email service</small>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="glass h-100">
          <div class="text-center p-4">
            <i class="fab fa-google fa-2x text-secondary mb-3"></i>
            <h6 class="font-semibold">Google Analytics</h6>
            <small class="text-muted">Data anonim</small>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-12">
        <div class="glass h-100">
          <div class="text-center p-4">
            <i class="fas fa-gavel fa-2x text-secondary mb-3"></i>
            <h6 class="font-semibold">Otoritas Hukum</h6>
            <small class="text-muted">Jika diminta resmi</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="privacy-section">
    <div class="privacy-icon">
      <i class="fas fa-cookie"></i>
    </div>
    <h2 class="h4 font-bold mb-4">
      4. Cookie
    </h2>
    <p class="mb-4">
      Kami menggunakan cookie untuk pengalaman terbaik.
      <strong>Anda bisa nonaktifkan di pengaturan browser kapan saja.</strong>
    </p>
  </div>

  <div class="privacy-section">
    <div class="privacy-icon">
      <i class="fas fa-user-check"></i>
    </div>
    <h2 class="h4 font-bold mb-4">
      5. Hak Anda
    </h2>
    <div class="row g-3">
      <div class="col-md-6">
        <div class="d-flex align-items-center p-6 glass">
          <i class="fas fa-eye fa-2x me-3 text-secondary"></i>
          <div>
            <strong class="h6">Lihat Data Anda</strong>
            <small class="d-block text-muted">Request kapan saja</small>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="d-flex align-items-center p-6 glass">
          <i class="fas fa-bell-slash fa-2x text-secondary me-3"></i>
          <div>
            <strong class="h6">Batal Langganan</strong>
            <small class="d-block text-muted">Unsubscribe email</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="privacy-section">
    <div class="privacy-icon">
      <i class="fas fa-lock"></i>
    </div>
    <h2 class="h4 font-bold mb-4">
      6. Keamanan
    </h2>
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="glass p-6">
          <i class="text-primary fas fa-lock-open me-2"></i>
          <strong class="h6">SSL Encryption</strong><br>
          <p>
            Semua data dienkripsi end-to-end
          </p>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="glass p-6">
          <i class="text-primary fas fa-exclamation-triangle me-2"></i>
          <strong class="h6">Waspada Phishing</strong><br>
          <p>
            Jangan klik link mencurigakan
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="privacy-contact">
  <h3 class="mb-4 font-bold">
    <i class="fas fa-question-circle text-secondary me-2"></i>Pertanyaan?
  </h3>
  <p class="mb-4">
    Hubungi tim kami untuk informasi lebih lanjut
  </p>
  <div class="h3 mb-0">
    <a href="mailto:admin@ayokebandung.com" class="privacy-email">
      <i class="fas fa-envelope"></i>
      admin@ayokebandung.com
    </a>
  </div>
</div>
</div>
<?php
require '../includes/footer.php';
?>