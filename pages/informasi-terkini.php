<?php 
$page_title = 'Informasi Terkini';
require '../includes/header.php'; 
?>

<div class="container">
<style>
  .informasi-latest {
    background: linear-gradient(135deg, var(--blue-50) 0%, var(--blue-100) 100%);
    border-radius: 15px;
    border: 2px solid var(--blue-300);
    box-shadow: 0 35px 60px -15px rgb(0 0 0 / 0.1);
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
  }
  .informasi-latest:hover {
    transform: translateY(-20px);
    box-shadow: 0 50px 100px -20px rgb(59 130 246 / 0.4);
    border: 2px solid var(--blue-400);
  }
  .informasi-latest-image {
    overflow: hidden;
    transition: transform 0.5s ease;
    height: 340px;
    transform: scale(1);
  }
  .informasi-latest-image img {
    transition: transform 0.5s ease;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .informasi-latest:hover .informasi-latest-image {
    transform: scale(1.02);
  }
  .informasi-latest-badge {
    background: var(--blue-500);
    color: white;
    padding: 10px 18px;
    border-radius: 12px;
    font-size: 0.9rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 15px rgb(59 130 246 / 0.3);
  }
  .informasi-post-card {
    border-radius: 24px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    background: linear-gradient ( var(--blue-100) 0%, var(--blue-200) 100%);
    box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
    color: var(--blue-900);
    border: 1px solid var(--blue-300);
  }
  .informasi-post-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
  }
  .informasi-post-card-image {
    height: 240px;
    overflow: hidden;
  }
  .informasi-post-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
  }
  .informasi-post-card:hover .informasi-post-card-image img {
    transform: scale(1.1);
  }
</style>
<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center mt-3">
        <h2 class="display-4 font-bold mb-3 text-primary">INFORMASI TERKINI</h2>
        <p>
          Update Kabar dan Event Bandung
        </p>
      </div>
    </div>

    <div class="row g-4">

      <div class="col-12 my-10">
        <article class="informasi-latest h-100">
          <div class="row g-0 h-100">
            <div class="col-md-5">
              <div class="informasi-latest-image h-100">
                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Informasi terbaru">
              </div>
            </div>
            <div class="col-md-7 p-5">
              <span class="informasi-latest-badge mt-2 mb-4 d-inline-block">
                <i class="fas fa-bolt me-2"></i>Terbaru
              </span>
              <h2 class="display-5 font-bold mb-4">
                Pemerintah Umumkan Libur Nasional Tambahan 3 Hari Akhir Tahun!
              </h2>
              <div class="text-muted small mb-4">
                <i class="fas fa-calendar-alt me-2"></i>
                21 Januari 2024
                <i class="fas fa-user ms-3 me-2"></i>
                Admin
              </div>
              <p class="mb-4">
                Menteri Sekretaris Negara mengumumkan penambahan 3 hari libur nasional pada akhir tahun 2024 untuk mendukung pemulihan ekonomi pasca-pandemi...
              </p>
              <a href="#" class="btn btn-primary font-semibold">
                Baca Lengkap <i class="fas fa-arrow-right ms-1"></i>
              </a>
            </div>
          </div>
        </article>
      </div>

      <div class="col-lg-6">
        <article class="informasi-post-card h-100">
          <div class="informasi-post-card-image">
            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="AI Technology">
          </div>
          <div class="p-4">
            <h3 class="h4 font-bold mb-3">
              Revolusi AI: ChatGPT-5 Siap Diluncurkan Bulan Depan
            </h3>
            <div class="text-muted small mb-3">
              <i class="fas fa-calendar-alt me-1"></i>20 Januari 2024
              <i class="fas fa-user ms-3 me-1"></i>Admin
            </div>
            <p class="mb-4">
              OpenAI mengumumkan peluncuran ChatGPT-5 yang diklaim 10x lebih pintar dari versi sebelumnya...
            </p>
            <a href="#" class="btn btn-primary font-semibold">
              Baca Lengkap <i class="fas fa-arrow-right ms-1"></i>
            </a>
          </div>
        </article>
      </div>

      <div class="col-lg-6">
        <article class="informasi-post-card h-100 ">
          <div class="informasi-post-card-image">
            <img src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Electric Car">
          </div>
          <div class="p-4">
            <h3 class="h4 fw-bold mb-3">
              Tesla Cybertruck Resmi Dijual di Indonesia Rp 2,5 Miliar
            </h3>
            <div class="text-muted small mb-3">
              <i class="fas fa-calendar-alt me-1"></i>19 Januari 2024
              <i class="fas fa-user ms-3 me-1"></i>Admin
            </div>
            <p class="mb-4">
              Tesla akhirnya membuka pre-order Cybertruck di pasar Indonesia. Mobil listrik futuristik ini hadir dengan harga mulai Rp 2,5 miliar...
            </p>
            <a href="#" class="btn btn-primary font-semibold">
              Baca Lengkap <i class="fas fa-arrow-right ms-1"></i>
            </a>
          </div>
        </article>
      </div>

    </div>
  </div>
</section>

</div>
<?php
require '../includes/footer.php';
?>