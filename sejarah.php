<?php 
$page_title = "Sejarah - MyApp";
require_once 'config/config.php';
require_once 'includes/header.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>

        .sejarah-timeline-card {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .sejarah-timeline-card:hover {
            box-shadow: 0 8px 20px rgba(13,110,253,0.15);
            transform: translateY(-2px);
        }

        .sejarah-date {
            background: #0d6efd;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .sejarah-icon {
            width: 40px;
            height: 40px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .sejarah-title {
            color: #0d6efd;
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .sejarah-section-title {
            color: #0b2a5e;
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
            left: 0;
            width: 50px;
            height: 3px;
            background: #0d6efd;
        }

        .sejarah-highlight {
            background: #e7f3ff;
            border-left: 4px solid #0d6efd;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
            font-size: 0.95rem;
        }

        .sejarah-important {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
        }

        .sejarah-footer {
            background: #0b2a5e;
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }

        @media (max-width: 768px) {
            .sejarah-hero h1 { font-size: 2rem; }
            .sejarah-timeline-card { padding: 1.25rem; }
        }
    </style>
</head>

<body>

<div class="page-container mt-5">
  
    <!-- Content -->
    <div id="sejarah-content">
        <!-- 1. Pra-Sejarah -->
        <h2 class="sejarah-section-title text-center">Masa Pra-Sejarah</h2>
        
        <div class="row g-4">
            <div class="col-md-12">
                <div class="sejarah-timeline-card">
                    <div class="sejarah-date">10.000 SM</div>
                    <h5 class="sejarah-title"><i class="fas fa-mountain me-2"></i>Manusia Purba</h5>
                    <p>Fosil <strong>Homo erectus</strong> ditemukan di Dago dan Lembang. Bukti hunian manusia purba di dataran tinggi Bandung.</p>
                </div>
            </div>
        </div>

        <!-- 2. Hindu-Buddha -->
        <h2 class="sejarah-section-title text-center">Kerajaan Hindu-Buddha</h2>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-temple"></i></div>
                    <div>
                        <div class="sejarah-date">Abad ke-4</div>
                        <h5 class="sejarah-title">Kerajaan Tarumanagara</h5>
                        <p>Raja Purnawarman. Prasasti Tugu, Ciaruteun, dan Kebon Kopi ditemukan. Batujaya jadi pusat peradaban.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-stupa"></i></div>
                    <div>
                        <div class="sejarah-date">Abad ke-8</div>
                        <h5 class="sejarah-title">Kerajaan Sunda Galuh</h5>
                        <p>Sanghyang Siksa Kandang Karesian ditulis. Kerajaan Islam pertama di Jawa Barat.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-crown"></i></div>
                    <div>
                        <div class="sejarah-date">1350</div>
                        <h5 class="sejarah-title">Kerajaan Pajajaran</h5>
                        <p>Prabu Siliwangi pindah ibukota ke Pakuan Pajajaran (Bogor). Bandung jadi wilayah agraris penting.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Islam & VOC -->
        <h2 class="sejarah-section-title text-center">Masuk Islam & VOC</h2>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-mosque"></i></div>
                    <div>
                        <div class="sejarah-date">1527</div>
                        <h5 class="sejarah-title">Kerajaan Banten</h5>
                        <p>Sunan Gunung Jati kuasai Priangan. Islam masuk ke Bandung.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-ship"></i></div>
                    <div>
                        <div class="sejarah-date">1677</div>
                        <h5 class="sejarah-title">VOC Kuasai Priangan</h5>
                        <p>VOC dapat hak monopoli kopi, teh, dan lada dari Sultan Banten.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Kolonial Modern -->
        <h2 class="sejarah-section-title text-center">Kolonial Modern</h2>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-road"></i></div>
                    <div>
                        <div class="sejarah-date">1810</div>
                        <h5 class="sejarah-title">Postweg Daendels</h5>
                        <p>Jalan Rembang-Cirebon dibangun. Tuanku Imamullah dirikan Kampung Empas (Dayeuh Sundanese).</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div class="sejarah-date">1813</div>
                        <h5 class="sejarah-title">Dayang Sumbi</h5>
                        <p>Gubernur Nahuys pindah ibukota ke Dayang Sumbi (Dago). Bandung jadi pusat pemerintahan.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-university"></i></div>
                    <div>
                        <div class="sejarah-date">1884</div>
                        <h5 class="sejarah-title">THS Bandoeng</h5>
                        <p><strong>Institut Teknologi Bandung</strong> didirikan sebagai sekolah teknik pertama Hindia Belanda.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-hotel"></i></div>
                    <div>
                        <div class="sejarah-date">1906</div>
                        <h5 class="sejarah-title">Preanger Hotel</h5>
                        <p>Hotel bersejarah pertama di Asia Afrika. Simbol kemewahan kolonial.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-landmark"></i></div>
                    <div>
                        <div class="sejarah-date">1920</div>
                        <h5 class="sejarah-title">Gedung Sate</h5>
                        <p>Awal pembangunan Gedung Sate (1920-1929). Simbol arsitektur Bandung.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-star"></i></div>
                    <div>
                        <div class="sejarah-date">1920-an</div>
                        <h5 class="sejarah-title">Paris van Java</h5>
                        <div class="sejarah-highlight">
                            <strong>"Paris van Java"</strong><br>
                            Art Deco + kehidupan elit Eropa
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. PD II & Kemerdekaan -->
        <h2 class="sejarah-section-title text-center">PD II & Kemerdekaan</h2>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-flag-checkered"></i></div>
                    <div>
                        <div class="sejarah-date">1942</div>
                        <h5 class="sejarah-title">Jepang Datang</h5>
                        <p>Bandung diduduki Jepang 3,5 tahun.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-flag"></i></div>
                    <div>
                        <div class="sejarah-date">17 Agt 1945</div>
                        <h5 class="sejarah-title">Proklamasi</h5>
                        <p>Bandung rayakan kemerdekaan RI.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-fire"></i></div>
                    <div>
                        <div class="sejarah-date">23 Mar 1946</div>
                        <h5 class="sejarah-title">Bandung Lautan Api</h5>
                        <div class="sejarah-important">
                            <strong>"Lebih baik hangus!"</strong><br>
                            200.000 jiwa bakar kota lawan Belanda
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 6. Pasca Kemerdekaan -->
        <h2 class="sejarah-section-title text-center">Pasca Kemerdekaan</h2>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-building-government"></i></div>
                    <div>
                        <div class="sejarah-date">1949</div>
                        <h5 class="sejarah-title">Ibu Kota Propinsi</h5>
                        <p>Bandung jadi ibukota Jawa Barat.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-globe"></i></div>
                    <div>
                        <div class="sejarah-date">Apr 1955</div>
                        <h5 class="sejarah-title">KAA Bandung</h5>
                        <p><strong>Konferensi Asia-Afrika</strong> di Gedung Merdeka. Bandung jadi panggung dunia!</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-users"></i></div>
                    <div>
                        <div class="sejarah-date">1966</div>
                        <h5 class="sejarah-title">Supersemar</h5>
                        <p>Peristiwa Supersemar ditandatangani di Gedung Dasaad.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-city"></i></div>
                    <div>
                        <div class="sejarah-date">1 Jul 2005</div>
                        <h5 class="sejarah-title">Kota Otonom</h5>
                        <p>Status Kota Bandung dengan 30 kecamatan, 154 kelurahan.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="sejarah-timeline-card d-flex">
                    <div class="sejarah-icon"><i class="fas fa-chart-line"></i></div>
                    <div>
                        <div class="sejarah-date">2023</div>
                        <h5 class="sejarah-title">2,5 Juta Jiwa</h5>
                        <p>Populasi Bandung Raya capai 2,5 juta. Kota kreatif UNESCO.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

</body>

</html>


<?php 

/* Footer */

require_once 'includes/footer.php'; ?>

