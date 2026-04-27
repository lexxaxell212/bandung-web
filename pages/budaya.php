<?php 
$page_title = 'Budaya';
require '../includes/header.php'; 
?>

<div class="container">
    <style>
      .budaya-hero-section {
        background-image:
        linear-gradient(135deg, rgba(155,155,255, 0.08) 0%, rgba(155,255,255, 0.08) 100%),
        url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 400'%3E%3Crect fill='%23f8fafc' width='1200' height='400'/%3E%3Cpath fill='%233b82f6' opacity='0.05' d='M0 200Q300 50 600 200T1200 200V400H0Z'/%3E%3C/svg%3E");
      }
      [data-dark] {
        .budaya-hero-section {
          background-image:
          linear-gradient(135deg, rgba(50,50,150, 0.08) 0%, rgba(50,150,150, 0.08) 100%),
          url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 400'%3E%3Crect fill='%231e1b4b' width='1200' height='400'/%3E%3Cpath fill='%2360a5fa' opacity='0.1' d='M0 200Q300 50 600 200T1200 200V400H0Z'/%3E%3C/svg%3E");
        }
      }
      .budaya-card-custom {
        border-radius: 24px;
        overflow: hidden;
        height: 100%;
      }
      .budaya-card-custom:hover {
        transform: translateY(-12px);
      }
      .budaya-card-img-custom {
        height: 240px;
        object-fit: cover;
        transition: transform 0.5s ease;
      }
      .budaya-card-custom:hover .budaya-card-img-custom {
        transform: scale(1.08);
      }
      .transition-ease {
        transition: transform 0.3s ease;
      }
      .btn:hover .arrow-icon {
        transform: translateX(3px);
      }
    </style>
    <section class="budaya-hero-section text-center p-6">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <h1 class="display-3 font-bold mb-4">Warisan Kebudayaan Bandung</h1>
            <p class="fs-5">
              Kekayaan seni, tradisi, dan kearifan lokal Sunda yang telah diwariskan turun-temurun dan diakui dunia internasional.
            </p>
          </div>
        </div>
      </div>
    </section>
    <section class="py-10">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-lg-8">
            <h2 class="text-primary display-4 font-semibold mb-4">
              Musik Tradisional
            </h2>
            <p>
              Alat musik bambu dan perkusi khas Sunda yang mencerminkan harmoni alam dan kehidupan masyarakat.
            </p>
          </div>
        </div>

        <div class="row g-4">
          <div class="col-lg-4 col-md-6">
            <div class="card-glass budaya-card-custom h-100">
              <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=240&fit=crop" class="card-img-top budaya-card-img-custom" alt="Angklung Bandung">
              <div class="p-5">
                <h5 class="font-semibold">
                  Angklung
                </h5>
                <p>
                  Alat musik bambu yang dimainkan dengan cara digoyang. Suaranya unik dan harmonis, diakui UNESCO sebagai Warisan Budaya Takbenda Dunia pada 2010.
                </p>
                <a href="#" class="btn btn-primary">
                  Pelajari Lebih Lanjut
                  <i class="fas fa-arrow-right arrow-icon ms-1"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card-glass budaya-card-custom h-100">
              <img src="https://images.unsplash.com/photo-1614256378406-15660e9797d0?w=800&h=240&fit=crop" class="card-img-top budaya-card-img-custom" alt="Calung">
              <div class="p-5">
                <h5 class="font-semibold">
                  Calung
                </h5>
                <p>
                  Alat musik idiofon dari bambu yang dimainkan dengan dipukul. Biasa digunakan dalam kesenian Calung dan pantun Sunda.
                </p>
                <a href="#" class="btn btn-primary">
                  Pelajari Lebih Lanjut
                  <i class="fas fa-arrow-right arrow-icon ms-1"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card-glass budaya-card-custom h-100">
              <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=800&h=240&fit=crop" class="card-img-top budaya-card-img-custom" alt="Kendang">
              <div class="p-5">
                <h5 class="font-semibold">
                  Kendang
                </h5>
                <p>
                  Gendang kulit kayu yang menjadi pengatur irama dalam berbagai kesenian Sunda seperti Jaipong dan Wayang Golek.
                </p>
                <a href="#" class="btn btn-primary">
                  Pelajari Lebih Lanjut
                  <i class="fas fa-arrow-right arrow-icon ms-1"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-lg-8">
            <h2 class="text-primary display-4 font-semibold mb-4">
              Tari Tradisional
            </h2>
          </div>
        </div>

        <div class="row g-4">
          <div class="col-lg-6">
            <div class="card-glass budaya-card-custom h-100">
              <img src="https://images.unsplash.com/photo-1606853738075-0b4f1298e3a1?w=800&h=240&fit=crop" class="card-img-top budaya-card-img-custom" alt="Jaipong">
              <div class="p-5">
                <h5 class="text-primary font-semibold">
                  Jaipong
                </h5>
                <p>
                  Tarian dinamis ciptaan Haji Suanda yang menggabungkan gerakan pencak silat, ketuk tilu, dan gaya ronggeng. Simbol kegembiraan rakyat Sunda.
                </p>
                <a href="#" class="btn btn-primary">
                  Pelajari Lebih Lanjut
                  <i class="fas fa-arrow-right arrow-icon ms-1"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card-glass budaya-card-custom h-100">
              <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=240&fit=crop" class="card-img-top budaya-card-img-custom" alt="Kecapi Suling">
              <div class="p-5">
                <h5 class="text-primary font-semibold">
                  Tari Kecapi Suling
                </h5>
                <p>
                  Tarian romantis yang mengiringi musik gamelan degung. Menggambarkan kisah cinta dan keindahan alam Priangan.
                </p>
                <a href="#" class="btn btn-primary">
                  Pelajari Lebih Lanjut
                  <i class="fas fa-arrow-right arrow-icon ms-1"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="my-10">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="glass glass-hover text-center p-6">
              <h2 class="text-primary display-4 font-semibold mb-6 mt-6">
                Wayang Golek
              </h2>
              <div class="mt-5 p-5">
                <img class="rounded w-100" src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=240&fit=crop" class="card-img-top budaya-card-img-custom" alt="Kecapi Suling">
              </div>
              <p class="p-4">
                Wayang kulit dari kayu sebagai media penyampai ajaran moral, filsafat hidup, dan hiburan rakyat. Lebih dari 500 karakter wayang Sunda.
              </p>
              <a href="#" class="btn btn-primary">
                Pelajari Lebih Lanjut
                <i class="fas fa-arrow-right arrow-icon ms-1"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-lg-8">
            <h2 class="display-4 font-semibold text-primary mb-4">
              Arsitektur & Kerajinan
            </h2>
            <p class="p-4">
              Bangunan bersejarah dan kerajinan tangan yang menjadi identitas visual Kota Kembang.
            </p>
          </div>
        </div>

        <div class="row g-4">
          <div class="col-lg-4 col-md-6">
            <div class="card-glass budaya-card-custom h-100">
              <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800&h=240&fit=crop" class="card-img-top budaya-card-img-custom" alt="Rumah Adat Sunda">
              <div class="p-5">
                <h5 class="text-primary font-semibold">
                  Rumah Adat Sunda
                </h5>
                <p>
                  Rumah panggung dengan atap julang ngapak (bentuk burung phoenix) dan struktur kayu jati. Simbol filosofi hidup Sunda.
                </p>
                <a href="#" class="btn btn-primary">
                  Pelajari Lebih Lanjut
                  <i class="fas fa-arrow-right arrow-icon ms-1"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card-glass budaya-card-custom h-100">
              <img src="https://images.unsplash/photo-1571896349840-0d711be9d7b1?w=800&h=240&fit=crop" class="card-img-top budaya-card-img-custom" alt="Batik Bandung">
              <div class="p-5">
                <h5 class="text-primary font-semibold">
                  Batik & Kain
                </h5>
                <p>
                  Batik modern dengan motif parahyangan seperti kawung, mega mendung, dan pula kembang. Pusatnya di Kampung Batik Cipadu.
                </p>
                <a href="#" class="btn btn-primary">
                  Pelajari Lebih Lanjut
                  <i class="fas fa-arrow-right arrow-icon ms-1"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card-glass budaya-card-custom h-100">
              <img src="https://images.unsplash.com/photo-1580130684518-6f4a38f3f3d8?w=800&h=240&fit=crop" class="card-img-top budaya-card-img-custom" alt="Keramik">
              <div class="p-5">
                <h5 class="text-primary font-semibold">
                  Gerabah & Keramik
                </h5>
                <p>
                  Kerajinan tanah liat khas Plered dan Cigadung dengan motif tradisional Sunda yang indah dan fungsional.
                </p>
                <a href="#" class="btn btn-primary">
                  Pelajari Lebih Lanjut
                  <i class="fas fa-arrow-right arrow-icon ms-1"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    </div>
<?php
require '../includes/footer.php';
?>