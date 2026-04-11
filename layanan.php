<?php 
$page_title = "Teknologi dan Transportasi - MyApp";
require_once 'config/config.php';
require_once 'includes/header.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #1e293b;
            line-height: 1.6;
            font-size: 16px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Minimal */
        header {
            background: #1e40af;
            color: white;
            padding: 2rem 0;
            text-align: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .tagline {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Hero */
        .hero {
            text-align: center;
            padding: 4rem 0;
            background: white;
            margin: 2rem 0;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #1e40af;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            color: #64748b;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Section */
        .section {
            margin: 4rem 0;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #1e40af;
            margin-bottom: 2rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Transport List */
        .transport-list {
            display: grid;
            gap: 1.5rem;
        }

        .transport-item {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            border-left: 4px solid #3b82f6;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.2s;
        }

        .transport-item:hover {
            box-shadow: 0 8px 25px rgba(59,130,246,0.1);
            transform: translateY(-2px);
        }

        .transport-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .transport-logo {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: contain;
            background: #f1f5f9;
            padding: 8px;
        }

        .transport-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1e293b;
        }

        .transport-type {
            background: #eff6ff;
            color: #1d4ed8;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .transport-info {
            color: #64748b;
            margin-bottom: 1.5rem;
        }

        .transport-price {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1e40af;
            margin-bottom: 1rem;
        }

        .transport-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .transport-cta:hover {
            background: #eff6ff;
            border-color: #3b82f6;
        }

        /* Public Transport Table */
        .public-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            margin-top: 2rem;
        }

        .table-header {
            background: #f8fafc;
            padding: 1.25rem 2rem;
            font-weight: 600;
            color: #1e40af;
            border-bottom: 2px solid #e2e8f0;
        }

        .table-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            padding: 1.25rem 2rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-row:last-child {
            border-bottom: none;
        }

        .table-row:hover {
            background: #f8fafc;
        }

        /* Stats */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
            text-align: center;
        }

        .stat-item {
            padding: 2rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #3b82f6;
            margin-bottom: 0.5rem;
        }

        /* CTA */
        .cta {
            background: white;
            text-align: center;
            padding: 3rem 2rem;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(59,130,246,0.1);
            margin: 4rem 0;
        }

        .cta h2 {
            font-size: 2rem;
            color: #1e40af;
            margin-bottom: 1rem;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(59,130,246,0.3);
        }

        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59,130,246,0.4);
        }

        /* Footer */
        footer {
            background: #1e293b;
            color: #94a3b8;
            text-align: center;
            padding: 2rem 0;
            margin-top: 4rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 { font-size: 2rem; }
            .table-row { 
                grid-template-columns: 1fr; 
                gap: 0.5rem;
                text-align: left;
                padding: 1rem;
            }
            .cta-buttons { flex-direction: column; align-items: center; }
            .container { padding: 0 16px; }
        }
    </style>
</head>

<body>

<div class="page-container mt-5">
    
    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <h1>Layanan Transportasi Bandung</h1>
            <p>Temukan opsi transportasi tercepat, termurah, dan terpercaya di Kota Kembang.</p>
        </section>
    </div>

    <!-- Online Transport -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">
                <i class="fas fa-mobile-screen-button"></i>
                Online Transportasi
            </h2>

            <div class="transport-list">
                <div class="transport-item">
                    <div class="transport-header">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Logo_Gojek.svg/200px-Logo_Gojek.svg.png" alt="Gojek" class="transport-logo">
                        <div>
                            <div class="transport-name">Gojek</div>
                            <span class="transport-type">GoRide / GoCar</span>
                        </div>
                    </div>
                    <p class="transport-info">Pilihan terpopuler. Driver terbanyak, promo harian.</p>
                    <div class="transport-price">GoRide: Rp 5.000 • GoCar: Rp 15.000</div>
                    <a href="https://gojek.com" class="transport-cta" target="_blank">
                        <i class="fas fa-download"></i> Buka Gojek
                    </a>
                </div>

                <div class="transport-item">
                    <div class="transport-header">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/Grab_logo.svg/200px-Grab_logo.svg.png" alt="Grab" class="transport-logo">
                        <div>
                            <div class="transport-name">Grab</div>
                            <span class="transport-type">GrabBike / GrabCar</span>
                        </div>
                    </div>
                    <p class="transport-info">Armada premium, kenyamanan lebih.</p>
                    <div class="transport-price">GrabBike: Rp 6.000 • GrabCar: Rp 18.000</div>
                    <a href="https://grab.com" class="transport-cta" target="_blank">
                        <i class="fas fa-download"></i> Buka Grab
                    </a>
                </div>

                <div class="transport-item">
                    <div class="transport-header">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Logo_Max.svg/200px-Logo_Max.svg.png" alt="Maxim" class="transport-logo">
                        <div>
                            <div class="transport-name">Maxim</div>
                            <span class="transport-type">Termurah</span>
                        </div>
                    </div>
                    <p class="transport-info">Tarif paling hemat di Bandung.</p>
                    <div class="transport-price">Rp 4.000 • Rp 8.000</div>
                    <a href="https://maxim.app" class="transport-cta" target="_blank">
                        <i class="fas fa-download"></i> Buka Maxim
                    </a>
                </div>

                <div class="transport-item">
                    <img src="https://inride.id/wp-content/uploads/2022/07/logo-inDrive.png" alt="inDrive" class="transport-logo" style="width: 60px; height: 60px; margin-bottom: 1rem;">
                    <div class="transport-header">
                        <div class="transport-name" style="margin-left: 0;">inDrive</div>
                        <span class="transport-type">Tawar Harga</span>
                    </div>
                    <p class="transport-info">Nego langsung dengan driver.</p>
                    <div class="transport-price">Hemat hingga 40%</div>
                    <a href="https://indrive.com" class="transport-cta" target="_blank">
                        <i class="fas fa-download"></i> Buka inDrive
                    </a>
                </div>

                                <div class="transport-item">
                    <div class="transport-header">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Logo_Blue_Bird_Group.svg/200px-Logo_Blue_Bird_Group.svg.png" alt="Blue Bird" class="transport-logo">
                        <div>
                            <div class="transport-name">Blue Bird</div>
                            <span class="transport-type">Taxi Premium</span>
                        </div>
                    </div>
                    <p class="transport-info">Taxi konvensional terpercaya. Bandara & hotel.</p>
                    <div class="transport-price">Minimum Rp 25.000</div>
                    <a href="tel:1700" class="transport-cta">
                        <i class="fas fa-phone"></i> Call 1700
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Public Transport -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">
                <i class="fas fa-bus"></i>
                Angkot & TMB
            </h2>
            <div class="public-table">
                <div class="table-header">
                    Rute Populer Bandung
                </div>
                <div class="table-row">
                    <div><strong>01 Cihampelas ↔ Pasirluyu</strong></div>
                    <div>05:00-21:00</div>
                    <div>Rp 3.600</div>
                    <div>Lengkong</div>
                </div>
                <div class="table-row">
                    <div><strong>03 Dago ↔ Cicaheum</strong></div>
                    <div>05:00-22:00</div>
                    <div>Rp 3.600</div>
                    <div>Cicaheum</div>
                </div>
                <div class="table-row">
                    <div><strong>TMB Route 1</strong></div>
                    <div>06:00-20:00</div>
                    <div>Rp 4.000</div>
                    <div>Leuwipanjang</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Airport & Station -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">
                <i class="fas fa-plane"></i>
                Bandara & Stasiun
            </h2>
            <div class="transport-list">
                <div class="transport-item">
                    <div class="transport-header">
                        <i class="fas fa-plane" style="font-size: 2rem; color: #3b82f6; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background: #eff6ff; border-radius: 8px;"></i>
                        <div>
                            <div class="transport-name">Bandara Husein Snd</div>
                            <span class="transport-type">15 menit ke kota</span>
                        </div>
                    </div>
                    <p class="transport-info">Taxi Rp 60K | Damri Rp 40K | GoCar Rp 45K</p>
                </div>
                <div class="transport-item">
                    <div class="transport-header">
                        <i class="fas fa-train" style="font-size: 2rem; color: #3b82f6; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background: #eff6ff; border-radius: 8px;"></i>
                        <div>
                            <div class="transport-name">Stasiun Bandung</div>
                            <span class="transport-type">KAI Commuter</span>
                        </div>
                    </div>
                    <p class="transport-info">Taxi Rp 25K | GoRide Rp 12K | Angkot Rp 3.6K</p>
                </div>
            </div>
        </div>
    </section>
    
</div>

</body>

</html>


<?php 

/* Footer */

require_once 'includes/footer.php'; ?>

