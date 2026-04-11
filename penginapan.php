<?php 
$page_title = "Penginapan - MyApp";
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

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .stat {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #3b82f6;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.95rem;
            margin-top: 0.25rem;
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

        /* Filter */
        .filters {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.75rem 1.5rem;
            border: 2px solid #e2e8f0;
            background: white;
            border-radius: 25px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            color: #64748b;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        /* Hotel Cards */
        .hotel-grid {
            display: grid;
            gap: 1.5rem;
        }

        .hotel-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.2s;
            border-left: 4px solid #3b82f6;
        }

        .hotel-card:hover {
            box-shadow: 0 8px 25px rgba(59,130,246,0.1);
            transform: translateY(-2px);
        }

        .hotel-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .hotel-content {
            padding: 1.5rem;
        }

        .hotel-name {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .hotel-location {
            color: #3b82f6;
            font-weight: 500;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.95rem;
        }

        .hotel-rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            color: #f59e0b;
        }

        .hotel-facilities {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }

        .facility {
            background: #eff6ff;
            color: #1d4ed8;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .hotel-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 1rem;
        }

        .hotel-book {
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
            width: 100%;
            justify-content: center;
        }

        .hotel-book:hover {
            background: #eff6ff;
            border-color: #3b82f6;
        }

        /* Budget Section */
        .budget-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin: 3rem 0;
        }

        .budget-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            border-top: 4px solid #3b82f6;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .budget-price {
            font-size: 2rem;
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 1rem;
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
            .filters { justify-content: center; }
            .hotel-grid { grid-template-columns: 1fr; }
            .hero-stats { flex-direction: column; gap: 1.5rem; }
        }
    </style>
</head>

<body>

<div class="page-container mt-5">
    
    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <h1>Hotel & Penginapan Bandung</h1>
            <p>Temukan akomodasi terbaik dari budget hingga bintang 5 di seluruh wilayah Bandung.</p>
            <div class="hero-stats">
                <div class="stat">
                    <div class="stat-number">150+</div>
                    <div>Hotel Tersedia</div>
                </div>
                <div class="stat">
                    <div class="stat-number">Rp 150K</div>
                    <div>Harga Terendah</div>
                </div>
                <div class="stat">
                    <div class="stat-number">4.7⭐</div>
                    <div>Rata-rata Rating</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter -->
    <section class="section">
        <div class="container">
            <div class="filters">
                <button class="filter-btn active" data-filter="all">Semua</button>
                <button class="filter-btn" data-filter="budget">Budget</button>
                <button class="filter-btn" data-filter="mid">Menengah</button>
                <button class="filter-btn" data-filter="luxury">Luxury</button>
                <button class="filter-btn" data-filter="lembang">Lembang</button>
                <button class="filter-btn" data-filter="dago">Dago</button>
            </div>
        </div>
    </section>

    <!-- Hotel Grid -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">
                <i class="fas fa-building"></i>
                Rekomendasi Hotel
            </h2>
            <div class="hotel-grid">
                <!-- Ibis Budget -->
                <div class="hotel-card" data-filter="budget kota">
                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/123456789.jpg?k=abc123" alt="Ibis Budget" class="hotel-image">
                    <div class="hotel-content">
                        <div class="hotel-name">Ibis Budget Bandung Airport</div>
                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Bandara (5 menit)
                        </div>
                        <div class="hotel-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                            4.2 (1.2K)
                        </div>
                        <div class="hotel-facilities">
                            <span class="facility">WiFi</span>
                            <span class="facility">AC</span>
                            <span class="facility">Parkir</span>
                        </div>
                        <div class="hotel-price">Rp 189.000 / malam</div>
                        <a href="#" class="hotel-book">Pesan Sekarang</a>
                    </div>
                </div>

                <!-- Favehotel -->
                <div class="hotel-card" data-filter="budget kota">
                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/234567890.jpg?k=def456" alt="Favehotel" class="hotel-image">
                    <div class="hotel-content">
                        <div class="hotel-name">Favehotel Hyper Square</div>
                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Pasir Kaliki
                        </div>
                        <div class="hotel-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            4.5 (2.8K)
                        </div>
                        <div class="hotel-facilities">
                            <span class="facility">Breakfast</span>
                            <span class="facility">WiFi</span>
                            <span class="facility">AC</span>
                        </div>
                        <div class="hotel-price">Rp 299.000 / malam</div>
                        <a href="#" class="hotel-book">Pesan Sekarang</a>
                    </div>
                </div>

                <!-- The 1O1 -->
                <div class="hotel-card" data-filter="mid dago">
                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/345678901.jpg?k=ghi789" alt="The 1O1" class="hotel-image">
                    <div class="hotel-content">
                        <div class="hotel-name">The 1O1 Bandung Dago</div>
                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Dago
                        </div>
                        <div class="hotel-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            4.6 (1.9K)
                        </div>
                        <div class="hotel-facilities">
                            <span class="facility">Pool</span>
                            <span class="facility">Restaurant</span>
                            <span class="facility">Spa</span>
                        </div>
                        <div class="hotel-price">Rp 489.000 / malam</div>
                        <a href="#" class="hotel-book">Pesan Sekarang</a>
                    </div>
                </div>

                <!-- Novotel -->
                <div class="hotel-card" data-filter="luxury kota">
                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/456789012.jpg?k=jkl012" alt="Novotel" class="hotel-image">
                    <div class="hotel-content">
                        <div class="hotel-name">Novotel Bandung</div>
                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Pasteur
                        </div>
                        <div class="hotel-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            4.7 (3.2K)
                        </div>
                        <div class="hotel-facilities">
                            <span class="facility">Pool</span>
                            <span class="facility">Gym</span>
                            <span class="facility">Spa</span>
                            <span class="facility">Buffet</span>
                        </div>
                        <div class="hotel-price">Rp 899.000 / malam</div>
                        <a href="#" class="hotel-book">Pesan Sekarang</a>
                    </div>
                </div>

                <!-- GH Universal -->
                <div class="hotel-card" data-filter="mid lembang">
                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/567890123.jpg?k=mno345" alt="GH Universal" class="hotel-image">
                    <div class="hotel-content">
                        <div class="hotel-name">GH Universal</div>
                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Lembang
                        </div>
                        <div class="hotel-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                            4.4 (2.1K)
                        </div>
                        <div class="hotel-facilities">
                            <span class="facility">View</span>
                            <span class="facility">Pool</span>
                            <span class="facility">Restaurant</span>
                        </div>
                        <div class="hotel-price">Rp 599.000 / malam</div>
                        <a href="#" class="hotel-book">Pesan Sekarang</a>
                    </div>
                </div>

                <!-- Aston Tropicana -->
                <div class="hotel-card" data-filter="luxury dago">
                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/678901234.jpg?k=pqr678" alt="Aston Tropicana" class="hotel-image">
                    <div class="hotel-content">
                        <div class="hotel-name">Aston Tropicana</div>
                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Riau
                        </div>
                        <div class="hotel-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            4.8 (4.5K)
                        </div>
                        <div class="hotel-facilities">
                            <span class="facility">Rooftop Pool</span>
                            <span class="facility">Spa</span>
                            <span class="facility">Gym</span>
                        </div>
                        <div class="hotel-price">Rp 1.299.000 / malam</div>
                        <a href="#" class="hotel-book">Pesan Sekarang</a>
                    </div>
                </div>

                <!-- Homestay Lembang -->
                <div class="hotel-card" data-filter="budget lembang">
                    <img src="https://images.unsplash.com/photo-1571896349842-33b873c4ee8e?w=400&h=200&fit=crop" alt="Homestay Lembang" class="hotel-image">
                    <div class="hotel-content">
                        <div class="hotel-name">Homestay Lembang View</div>
                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Lembang
                        </div>
                        <div class="hotel-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            4.6 (856)
                        </div>
                        <div class="hotel-facilities">
                            <span class="facility">BBQ</span>
                            <span class="facility">View</span>
                            <span class="facility">Kitchen</span>
                        </div>
                        <div class="hotel-price">Rp 450.000 / malam</div>
                        <a href="#" class="hotel-book">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Budget Guide -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">
                <i class="fas fa-wallet"></i>
                Pilih Sesuai Budget
            </h2>
            <div class="budget-section">
                <div class="budget-card">
                    <div class="budget-price">Rp 150K - 300K</div>
                    <h3>Budget</h3>
                    <p>Ibis, Favehotel, RedDoorz. Bersih, strategis, lengkap dasar.</p>
                </div>
                <div class="budget-card">
                    <div class="budget-price">Rp 400K - 800K</div>
                    <h3>Menengah</h3>
                    <p>The 1O1, Zest, GH Universal. Pool, breakfast, view bagus.</p>
                </div>
                <div class="budget-card">
                    <div class="budget-price">Rp 1M+</div>
                    <h3>Luxury</h3>
                    <p>Novotel, Aston, Intercontinental. Spa, rooftop, layanan premium.</p>
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

