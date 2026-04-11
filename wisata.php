<?php 
$page_title = "Wisata - MyApp";
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

        /* Header */
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

        /* Wisata Cards */
        .wisata-grid {
            display: grid;
            gap: 1.5rem;
        }

        .wisata-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.2s;
            border-left: 4px solid #3b82f6;
        }

        .wisata-card:hover {
            box-shadow: 0 8px 25px rgba(59,130,246,0.1);
            transform: translateY(-2px);
        }

        .wisata-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .wisata-content {
            padding: 1.75rem;
        }

        .wisata-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.75rem;
        }

        .wisata-location {
            color: #3b82f6;
            font-weight: 500;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .wisata-info {
            color: #64748b;
            margin-bottom: 1.25rem;
            font-size: 0.95rem;
        }

        .wisata-price {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e40af;
            margin-bottom: 1rem;
        }

        .wisata-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .tag {
            background: #eff6ff;
            color: #1d4ed8;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* Category Filter */
        .categories {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .category-btn {
            padding: 0.75rem 1.5rem;
            border: 2px solid #e2e8f0;
            background: white;
            border-radius: 25px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            color: #64748b;
        }

        .category-btn.active,
        .category-btn:hover {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        /* Stats */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.5rem;
            margin: 3rem 0;
            text-align: center;
        }

        .stat-item {
            padding: 1.5rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: #3b82f6;
            margin-bottom: 0.25rem;
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
            .container { padding: 0 16px; }
            .cta-buttons { flex-direction: column; align-items: center; }
            .categories { justify-content: center; }
        }
    </style>
</head>

<body>

<div class="page-container mt-5">

    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <h1>20+ Wisata Bandung Terpopuler</h1>
            <p>Temukan destinasi wisata alam, kuliner, dan budaya terbaik di Kota Kembang.</p>
        </div>
    </section>

    <!-- Categories -->
    <section class="section">
        <div class="container">
            <div class="categories">
                <button class="category-btn active" data-category="all">Semua</button>
                <button class="category-btn" data-category="alam">Alam</button>
                <button class="category-btn" data-category="kuliner">Kuliner</button>
                <button class="category-btn" data-category="outdoor">Outdoor</button>
                <button class="category-btn" data-category="indoor">Indoor</button>
            </div>
        </div>
    </section>

    <!-- Wisata Grid -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">
                <i class="fas fa-map-location-dot"></i>
                Destinasi Wisata
            </h2>
            <div class="wisata-grid">
                <!-- Lembang -->
                <div class="wisata-card" data-category="alam outdoor">
                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=220&fit=crop" alt="Farmhouse Lembang" class="wisata-image">
                    <div class="wisata-content">
                        <div class="wisata-name">Farmhouse Susu Lembang</div>
                        <div class="wisata-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Lembang
                        </div>
                        <p class="wisata-info">Foto Instagramable dengan tema Eropa. Susu segar & area bermain anak.</p>
                        <div class="wisata-price">Rp 30.000</div>
                        <div class="wisata-tags">
                            <span class="tag">Foto</span>
                            <span class="tag">Family</span>
                            <span class="tag">Alam</span>
                        </div>
                    </div>
                </div>

                <!-- Floating Market -->
                <div class="wisata-card" data-category="kuliner outdoor">
                    <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400&h=220&fit=crop" alt="Floating Market" class="wisata-image">
                    <div class="wisata-content">
                        <div class="wisata-name">Floating Market Lembang</div>
                        <div class="wisata-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Lembang
                        </div>
                        <p class="wisata-info">Wahana perahu, kuliner nusantara, live music. Buka hingga malam.</p>
                        <div class="wisata-price">Rp 30.000 + makanan</div>
                        <div class="wisata-tags">
                            <span class="tag">Kuliner</span>
                            <span class="tag">Family</span>
                            <span class="tag">Night</span>
                        </div>
                    </div>
                </div>

                <!-- Tangkuban Perahu -->
                <div class="wisata-card" data-category="alam outdoor">
                    <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?w=400&h=220&fit=crop" alt="Tangkuban Perahu" class="wisata-image">
                    <div class="wisata-content">
                        <div class="wisata-name">Kawah Tangkuban Perahu</div>
                        <div class="wisata-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Subang (1 jam)
                        </div>
                        <p class="wisata-info">Gunung berapi aktif. Kawah utara & queen. Udara dingin sejuk.</p>
                        <div class="wisata-price">Rp 200.000/mobil</div>
                        <div class="wisata-tags">
                            <span class="tag">Alam</span>
                            <span class="tag">Adventure</span>
                        </div>
                    </div>
                </div>

                <!-- Gedung Sate -->
                <div class="wisata-card" data-category="indoor">
                    <img src="https://images.unsplash.com/photo-1583305890070-7de7628b8537?w=400&h=220&fit=crop" alt="Gedung Sate" class="wisata-image">
                    <div class="wisata-content">
                        <div class="wisata-name">Gedung Sate</div>
                        <div class="wisata-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Dago
                        </div>
                        <p class="wisata-info">Ikona kota Bandung. Museum konferensi Asia Afrika. Gratis foto luar.</p>
                        <div class="wisata-price">Gratis / Rp 10.000</div>
                        <div class="wisata-tags">
                            <span class="tag">History</span>
                            <span class="tag">Photo</span>
                        </div>
                    </div>
                </div>

                <!-- Trans Studio -->
                <div class="wisata-card" data-category="indoor">
                    <img src="https://images.unsplash.com/photo-1578631618386-9c2f4057e62d?w=400&h=220&fit=crop" alt="Trans Studio" class="wisata-image">
                    <div class="wisata-content">
                        <div class="wisata-name">Trans Studio Bandung</div>
                        <div class="wisata-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Setiabudi
                        </div>
                        <p class="wisata-info">Wahana indoor terlengkap. Roller coaster, teater 4D. Hujan-friendly.</p>
                        <div class="wisata-price">Rp 300.000</div>
                        <div class="wisata-tags">
                            <span class="tag">Family</span>
                            <span class="tag">Thrill</span>
                        </div>
                    </div>
                </div>

                <!-- Ciwidey -->
                <div class="wisata-card" data-category="alam outdoor">
                    <img src="https://images.unsplash.com/photo-1570549717069-33bed2eb6f45?w=400&h=220&fit=crop" alt="Ciwidey" class="wisata-image">
                    <div class="wisata-content">
                        <div class="wisata-name">Kawah Putih Ciwidey</div>
                        <div class="wisata-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Ciwidey (2 jam)
                        </div>
                        <p class="wisata-info">Danau vulkanik berwarna putih. Spot foto epik. Udara dingin 10°C.</p>
                        <div class="wisata-price">Rp 50.000</div>
                        <div class="wisata-tags">
                            <span class="tag">Alam</span>
                            <span class="tag">Photo</span>
                        </div>
                    </div>
                </div>

                <!-- Dago Dream Park -->
                <div class="wisata-card" data-category="outdoor">
                    <img src="https://images.unsplash.com/photo-1603398937357-f959f5ee62ec?w=400&h=220&fit=crop" alt="Dago Dream Park" class="wisata-image">
                    <div class="wisata-content">
                        <div class="wisata-name">Dago Dream Park</div>
                        <div class="wisata-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Dago Pakar
                        </div>
                        <p class="wisata-info">Pemandangan kota + gunung. Flying fox, sepeda udara.</p>
                        <div class="wisata-price">Rp 40.000</div>
                        <div class="wisata-tags">
                            <span class="tag">View</span>
                            <span class="tag">Adventure</span>
                        </div>
                    </div>
                </div>

                <!-- Pasar Baru -->
                <div class="wisata-card" data-category="kuliner">
                    <img src="https://images.unsplash.com/photo-1571896349840-fd50b4a793a5?w=400&h=220&fit=crop" alt="Pasar Baru" class="wisata-image">
                    <div class="wisata-content">
                        <div class="wisata-name">Pasar Baru Trade Center</div>
                        <div class="wisata-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Alun-alun
                        </div>
                        <p class="wisata-info">Belanja fashion murah + kuliner Sunda. Pusat kota.</p>
                        <div class="wisata-price">Gratis masuk</div>
                        <div class="wisata-tags">
                            <span class="tag">Shopping</span>
                            <span class="tag">Kuliner</span>
                        </div>
                    </div>
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

