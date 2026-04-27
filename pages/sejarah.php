<?php 
$page_title = 'Sejarah';
require '../includes/header.php'; 
?>
<div class="container">
<style>
      .sejarah-timeline-card {
        background: linear-gradient(235deg, var(--blue-50) 0%, var(--blue-200) 100%);
        border: 1px solid var(--blue-300);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease-in-out;
      }

      .sejarah-timeline-card:hover {
        transform: translateY(-3px);
      }

      .sejarah-date {
        background: var(--blue-900);
        color: var(--blue-50);
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 1rem;
      }

      .sejarah-icon {
        width: 40px;
        height: 40px;
        background: var(--blue-800);
        color: var(--blue-50);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        margin-right: 1rem;
        flex-shrink: 0;
      }

      .sejarah-title {
        color: var(--blue-950);
        font-weight: 600;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
      }

      .sejarah-section-title {
        color: var(--blue-900);
        font-weight: 600;
        font-size: 1.8rem;
        margin: 3rem 0 2rem 0;
        position: relative;
        padding-bottom: 0.5rem;
      }

      .sejarah-section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 70px;
        height: 3px;
        background: var(--blue-800);
      }

      .sejarah-highlight {
        background: #e7f3ff;
        border-left: 4px solid #0d6efd;
        padding: 1rem;
        border-radius: 8px;
        margin: 1rem 0;
        font-size: 0.95rem;
        color: #172554;
      }

      .sejarah-important {
        background: #fff3cd;
        border-left: 4px solid #ffc107;
        color: #172554;
        padding: 1rem;
        border-radius: 8px;
        margin: 1rem 0;
      }

      @media (max-width: 768px) {
        .sejarah-timeline-card {
          padding: 1.25rem;
        }
      }
    </style>
    <div class="container-fluid py-5">
      <div class="container">
        <div id="sejarah-content">
          <h2 class="sejarah-section-title text-center mb-5">Masa Pra-Sejarah</h2>

          <div class="row g-4">
            <div class="col-12">
              <div class="sejarah-timeline-card">
                <div class="sejarah-date">
                  10.000 SM
                </div>
                <h5 class="sejarah-title"><i class="fas fa-mountain me-2"></i>Manusia Purba</h5>
                <p class="mb-0">
                  Fosil <strong>Homo erectus</strong> ditemukan di Dago dan Lembang. Bukti hunian manusia purba di dataran tinggi Bandung.
                </p>
              </div>
            </div>
          </div>

          <h2 class="sejarah-section-title text-center">Kerajaan Hindu-Buddha</h2>

          <div class="row g-4">
            <div class="col-lg-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-temple"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    Abad ke-4
                  </div>
                  <h5 class="sejarah-title">Kerajaan Tarumanagara</h5>
                  <p class="mb-0">
                    Raja Purnawarman. Prasasti Tugu, Ciaruteun, dan Kebon Kopi ditemukan. Batujaya jadi pusat peradaban.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-stupa"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    Abad ke-8
                  </div>
                  <h5 class="sejarah-title">Kerajaan Sunda Galuh</h5>
                  <p class="mb-0">
                    Sanghyang Siksa Kandang Karesian ditulis. Kerajaan Islam pertama di Jawa Barat.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-crown"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    1350
                  </div>
                  <h5 class="sejarah-title">Kerajaan Pajajaran</h5>
                  <p class="mb-0">
                    Prabu Siliwangi pindah ibukota ke Pakuan Pajajaran (Bogor). Bandung jadi wilayah agraris penting.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <h2 class="sejarah-section-title text-center">Masuk Islam & VOC</h2>

          <div class="row g-4">
            <div class="col-lg-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-mosque"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    1527
                  </div>
                  <h5 class="sejarah-title">Kerajaan Banten</h5>
                  <p class="mb-0">
                    Sunan Gunung Jati kuasai Priangan. Islam masuk ke Bandung.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-ship"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    1677
                  </div>
                  <h5 class="sejarah-title">VOC Kuasai Priangan</h5>
                  <p class="mb-0">
                    VOC dapat hak monopoli kopi, teh, dan lada dari Sultan Banten.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <h2 class="sejarah-section-title text-center">Kolonial Modern</h2>

          <div class="row g-4">
            <div class="col-xl-4 col-lg-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-road"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    1810
                  </div>
                  <h5 class="sejarah-title">Postweg Daendels</h5>
                  <p class="mb-0">
                    Jalan Rembang-Cirebon dibangun. Tuanku Imamullah dirikan Kampung Empas (Dayeuh Sundanese).
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    1813
                  </div>
                  <h5 class="sejarah-title">Dayang Sumbi</h5>
                  <p class="mb-0">
                    Gubernur Nahuys pindah ibukota ke Dayang Sumbi (Dago). Bandung jadi pusat pemerintahan.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-university"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    1884
                  </div>
                  <h5 class="sejarah-title">THS Bandoeng</h5>
                  <p class="mb-0">
                    <strong>Institut Teknologi Bandung</strong> didirikan sebagai sekolah teknik pertama Hindia Belanda.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-hotel"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    1906
                  </div>
                  <h5 class="sejarah-title">Preanger Hotel</h5>
                  <p class="mb-0">
                    Hotel bersejarah pertama di Asia Afrika. Simbol kemewahan kolonial.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-landmark"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    1920
                  </div>
                  <h5 class="sejarah-title">Gedung Sate</h5>
                  <p class="mb-0">
                    Awal pembangunan Gedung Sate (1920-1929). Simbol arsitektur Bandung.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-star"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    1920-an
                  </div>
                  <h5 class="sejarah-title">Paris van Java</h5>
                  <div class="sejarah-highlight">
                    <strong>"Paris van Java"</strong><br>
                    Art Deco + kehidupan elit Eropa
                  </div>
                </div>
              </div>
            </div>
          </div>

          <h2 class="sejarah-section-title text-center">PD II & Kemerdekaan</h2>

          <div class="row g-4">
            <div class="col-xl-3 col-lg-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-flag-checkered"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    1942
                  </div>
                  <h5 class="sejarah-title">Jepang Datang</h5>
                  <p class="mb-0">
                    Bandung diduduki Jepang 3,5 tahun.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-flag"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    17 Agt 1945
                  </div>
                  <h5 class="sejarah-title">Proklamasi</h5>
                  <p class="mb-0">
                    Bandung rayakan kemerdekaan RI.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-fire"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    23 Mar 1946
                  </div>
                  <h5 class="sejarah-title">Bandung Lautan Api</h5>
                  <div class="sejarah-important">
                      <strong>"Lebih baik hangus!"</strong><br>
                      200.000 jiwa bakar kota lawan Belanda
                  </div>
                </div>
              </div>
            </div>
          </div>

          <h2 class="sejarah-section-title text-center">Pasca Kemerdekaan</h2>

          <div class="row g-4">
            <div class="col-xl-4 col-lg-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-building-government"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    1949
                  </div>
                  <h5 class="sejarah-title">Ibu Kota Propinsi</h5>
                  <p class="mb-0">
                    Bandung jadi ibukota Jawa Barat.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-globe"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    Apr 1955
                  </div>
                  <h5 class="sejarah-title">KAA Bandung</h5>
                  <p class="mb-0">
                    <strong>Konferensi Asia-Afrika</strong> di Gedung Merdeka. Bandung jadi panggung dunia!
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-users"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    1966
                  </div>
                  <h5 class="sejarah-title">Supersemar</h5>
                  <p class="mb-0">
                    Peristiwa Supersemar ditandatangani di Gedung Dasaad.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-city"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    1 Jul 2005
                  </div>
                  <h5 class="sejarah-title">Kota Otonom</h5>
                  <p class="mb-0">
                    Status Kota Bandung dengan 30 kecamatan, 154 kelurahan.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-6">
              <div class="sejarah-timeline-card d-flex">
                <div class="sejarah-icon">
                  <i class="fas fa-chart-line"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="sejarah-date">
                    2023
                  </div>
                  <h5 class="sejarah-title">2,5 Juta Jiwa</h5>
                  <p class="mb-0">
                    Populasi Bandung Raya capai 2,5 juta. Kota kreatif UNESCO.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<?php
require '../includes/footer.php';
?>