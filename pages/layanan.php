<?php 
$page_title = 'Layanan';
require '../includes/header.php'; 
?>
<div class="container">
     <style>
        .section-title-custom {
            color: var(--blue-900);
            border-bottom: 2px solid var(--blue-200);
            padding-bottom: 0.75rem;
            margin-bottom: 2.5rem;
        }

        .transport-card {
          background: var(--blue-50);
            border-left: 4px solid var(--blue-300);
            box-shadow: 0 8px 25px rgba(59,130,246,0.1);
            transition: all 0.2s;
            border-radius: 12px !important;
        }

        .transport-card:hover {
            box-shadow: 0 8px 25px rgba(59,130,246,0.2);
            transform: translateY(-2px);
        }

        .transport-logo-custom {
            width: 50px;
            height: 50px;
            object-fit: contain;
            background: var(--blue-50);
            padding: 8px;
            border-radius: 8px;
        }

        .table-custom {
            box-shadow: 0 8px 25px rgba(59,130,246,0.1);
            border-radius: 12px;
            overflow: hidden;
            background: var(--blue-50);
        }

        .table-header-custom, .table-header-custom h5 {
            background: var(--blue-200);
            color: var(--blue-600);
            font-weight: 600;
            border-bottom: 2px solid #var(--blue-100);
        }
        
    </style>
    
    <div>
        
        <!-- Hero -->
        <section class="py-5 text-center mb-5">
            <div class="container">
                <h1 class="text-primary display-4 font-semibold mb-3">Layanan Transportasi Bandung</h1>
                <p>
                    Temukan opsi transportasi tercepat, termurah, dan terpercaya di Kota Kembang.
                </p>
            </div>
        </section>

        <!-- Online Transport -->
        <section class="py-10">
            <h2 class="h2 font-semibold section-title-custom d-flex align-items-center gap-2">
                <i class="fas fa-mobile-screen-button"></i>
                Online Transportasi
            </h2>
            <div class="row g-4">
              
                <!-- Gojek -->
                <div class="col-xl-4 col-lg-6">
                    <div class="card h-100 transport-card p-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Logo_Gojek.svg/200px-Logo_Gojek.svg.png" 
                                 alt="Gojek" class="transport-logo-custom me-3">
                            <div>
                                <h5 class="mb-1 font-semibold">Gojek</h5>
                            </div>
                        </div>
                        <p class="mb-3">Pilihan terpopuler. Driver terbanyak, promo harian.</p>
                        <a href="https://gojek.com" class="btn btn-outline-primary btn-sm  px-4" target="_blank">
                            <i class="fas fa-download me-1"></i> Buka Gojek
                        </a>
                    </div>
                </div>

            </div>
        </section>
        
         <!-- Airport & Station -->
        <section>
            <h2 class="h2 font-semibold section-title-custom d-flex align-items-center gap-2">
                <i class="fas fa-plane"></i>
                Bandara & Stasiun
            </h2>
            <div class="row g-4">
              
                <div id="card-airportstation" class="col-lg-6">
                    <div class="card h-100 transport-card p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="text-primary fs-1 me-3 p-3 rounded-3">
                                <i class="fas fa-plane"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 font-semibold">Bandara Husein Snd</h5>
                                <span class="text-secondary">15 menit ke kota</span>
                            </div>
                        </div>
                        <a href="" class="btn btn-outline-primary btn-sm  px-4" target="_blank">
                            <i class="fas fa-map me-1"></i> Buka Map
                        </a>
                    </div>
                </div>
                
            </div>
        </section>

        <!-- Public Transport -->
        <section class="py-10">
            <h2 class="h2 font-semibold section-title-custom d-flex align-items-center gap-2">
                <i class="fas fa-bus"></i>
                Angkot & TMB
            </h2>
            <div class="card table-custom">
                <div class="card-header table-header-custom py-3 px-4">
                    <h5 class="mb-0">Rute Populer Bandung</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row"><strong>01 Cihampelas ↔ Pasirluyu</strong></th>
                                    <td>05:00-21:00</td>
                                    <td><span class="badge bg-primary">Rp 3.600</span></td>
                                    <td>Lengkong</td>
                                </tr>
                                <tr>
                                    <th scope="row"><strong>03 Dago ↔ Cicaheum</strong></th>
                                    <td>05:00-22:00</td>
                                    <td><span class="badge bg-primary">Rp 3.600</span></td>
                                    <td>Cicaheum</td>
                                </tr>
                                <tr>
                                    <th scope="row"><strong>TMB Route 1</strong></th>
                                    <td>06:00-20:00</td>
                                    <td><span class="badge bg-primary">Rp 4.000</span></td>
                                    <td>Leuwipanjang</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        
    </div>

</div>
<?php
require '../includes/footer.php';
?>