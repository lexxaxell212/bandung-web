<?php 
$page_title = "Budaya - MyApp";
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.7;
            color: #333;
            background: #ffffff;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 1.5rem 0;
            box-shadow: 0 4px 20px rgba(30, 64, 175, 0.3);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            font-size: 2.2rem;
        }

        .header-text {
            text-align: right;
        }

        .header-title {
            font-size: 1.3rem;
            margin-bottom: 0.2rem;
        }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, rgba(62, 130, 246, 0.1) 0%, rgba(30, 64, 175, 0.05) 100%), 
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 400"><rect fill="%23f8fafc" width="1200" height="400"/><path fill="%233b82f6" opacity="0.05" d="M0 200Q300 50 600 200T1200 200V400H0Z"/></svg>');
            padding: 100px 0;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
        }

        .hero h1 {
            font-size: 3.5rem;
            color: #1e40af;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        .hero-subtitle {
            font-size: 1.4rem;
            color: #64748b;
            max-width: 700px;
            margin: 0 auto 2.5rem;
        }

        /* Section */
        .section {
            padding: 100px 0;
        }

        .section-title {
            text-align: center;
            font-size: 2.8rem;
            color: #1e40af;
            margin-bottom: 4rem;
            position: relative;
            font-weight: 600;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
            border-radius: 2px;
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #64748b;
            max-width: 800px;
            margin: 0 auto 4rem;
        }

        /* Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
            gap: 2.5rem;
        }

        .culture-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(59, 130, 246, 0.12);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #f1f5f9;
        }

        .culture-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 60px rgba(59, 130, 246, 0.2);
        }

        .card-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .culture-card:hover .card-image {
            transform: scale(1.08);
        }

        .card-content {
            padding: 2.5rem;
        }

        .card-category {
            display: inline-block;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
            letter-spacing: 0.5px;
        }

        .card-title {
            color: #1e40af;
            font-size: 1.6rem;
            margin-bottom: 1rem;
            font-weight: 600;
            line-height: 1.4;
        }

        .card-description {
            color: #475569;
            font-size: 1rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .card-learn-more {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
            transition: color 0.3s;
        }

        .card-learn-more:hover {
            color: #1d4ed8;
        }

        /* Featured Section */
        .featured {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 24px;
            padding: 4rem 2.5rem;
            margin: 4rem 0;
            text-align: center;
            border: 1px solid #bfdbfe;
        }

        .featured-icon {
            font-size: 4rem;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
        }

        /* Timeline */
        .timeline {
            position: relative;
            max-width: 900px;
            margin: 0 auto;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, #3b82f6, #1d4ed8);
            border-radius: 2px;
        }

        .timeline-item {
            display: flex;
            margin-bottom: 4rem;
            position: relative;
        }

        .timeline-item:nth-child(odd) {
            justify-content: flex-end;
            padding-left: 0;
            padding-right: 50%;
        }

        .timeline-item:nth-child(even) {
            justify-content: flex-start;
            padding-right: 0;
            padding-left: 50%;
        }

        .timeline-content {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.15);
            width: 100%;
            position: relative;
            border: 1px solid #e2e8f0;
        }

        .timeline-dot {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 16px;
            height: 16px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            z-index: 2;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
            color: white;
            padding: 4rem 0 2rem;
            margin-top: 6rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-title {
            color: #60a5fa;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2.2rem;
            }

            .cards-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .timeline::before {
                left: 20px;
            }

            .timeline-item:nth-child(odd),
            .timeline-item:nth-child(even) {
                flex-direction: column;
                padding-left: 60px !important;
                padding-right: 0 !important;
                width: 100%;
            }

            .timeline-dot {
                left: 16px;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }
    </style>
</head>

<body>

<div class="page-container mt-5">
    
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Warisan Kebudayaan Bandung</h1>
            <p class="hero-subtitle">Kekayaan seni, tradisi, dan kearifan lokal Sunda yang telah diwariskan turun-temurun dan diakui dunia internasional.</p>
        </div>
    </section>

    <!-- Musik Tradisional -->
    <section class="section">
        <div class="container">
            <h2 class="section-title fade-in">Musik Tradisional</h2>
            <p class="section-subtitle fade-in">Alat musik bambu dan perkusi khas Sunda yang mencerminkan harmoni alam dan kehidupan masyarakat.</p>
            
            <div class="cards-grid">
                <div class="culture-card fade-in">
                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=240&fit=crop" alt="Angklung Bandung" class="card-image">
                    <div class="card-content">
                        <span class="card-category">UNESCO Heritage</span>
                        <h3 class="card-title">Angklung</h3>
                        <p class="card-description">Alat musik bambu yang dimainkan dengan cara digoyang. Suaranya unik dan harmonis, diakui UNESCO sebagai Warisan Budaya Takbenda Dunia pada 2010.</p>
                        <a href="#" class="card-learn-more">Pelajari Lebih Lanjut →</a>
                    </div>
                </div>

                <div class="culture-card fade-in">
                    <img src="https://images.unsplash.com/photo-1614256378406-15660e9797d0?w=800&h=240&fit=crop" alt="Calung" class="card-image">
                    <div class="card-content">
                        <span class="card-category">Musik Bambu</span>
                        <h3 class="card-title">Calung</h3>
                        <p class="card-description">Alat musik idiofon dari bambu yang dimainkan dengan dipukul. Biasa digunakan dalam kesenian Calung dan pantun Sunda.</p>
                        <a href="#" class="card-learn-more">Pelajari Lebih Lanjut →</a>
                    </div>
                </div>

                <div class="culture-card fade-in">
                    <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=800&h=240&fit=crop" alt="Kendang" class="card-image">
                    <div class="card-content">
                        <span class="card-category">Perkusi</span>
                        <h3 class="card-title">Kendang</h3>
                        <p class="card-description">Gendang kulit kayu yang menjadi pengatur irama dalam berbagai kesenian Sunda seperti Jaipong dan Wayang Golek.</p>
                        <a href="#" class="card-learn-more">Pelajari Lebih Lanjut →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tari Tradisional -->
    <section class="section">
        <div class="container">
            <h2 class="section-title fade-in">Tari Tradisional</h2>
            <div class="cards-grid">
                <div class="culture-card fade-in">
                    <img src="https://images.unsplash.com/photo-1606853738075-0b4f1298e3a1?w=800&h=240&fit=crop" alt="Jaipong" class="card-image">
                    <div class="card-content">
                        <span class="card-category">Tari Rakyat</span>
                        <h3 class="card-title">Jaipong</h3>
                        <p class="card-description">Tarian dinamis ciptaan Haji Suanda yang menggabungkan gerakan pencak silat, ketuk tilu, dan gaya ronggeng. Simbol kegembiraan rakyat Sunda.</p>
                        <a href="#" class="card-learn-more">Pelajari Lebih Lanjut →</a>
                    </div>
                </div>

                <div class="culture-card fade-in">
                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=240&fit=crop" alt="Kecapi Suling" class="card-image">
                    <div class="card-content">
                        <span class="card-category">Tari Pengiring</span>
                        <h3 class="card-title">Tari Kecapi Suling</h3>
                        <p class="card-description">Tarian romantis yang mengiringi musik gamelan degung. Menggambarkan kisah cinta dan keindahan alam Priangan.</p>
                        <a href="#" class="card-learn-more">Pelajari Lebih Lanjut →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured -->
    <section class="featured">
        <div class="container">
            <div class="featured-icon">🎭</div>
            <h3 style="color: #1e40af; font-size: 2rem; margin-bottom: 1rem;">Wayang Golek</h3>
            <p style="font-size: 1.2rem; color: #475569; max-width: 600px; margin: 0 auto;">
                Wayang kulit dari kayu sebagai media penyampai ajaran moral, filsafat hidup, dan hiburan rakyat. Lebih dari 500 karakter wayang Sunda.
            </p>
        </div>
    </section>

    <!-- Arsitektur & Kerajinan -->
    <section class="section">
        <div class="container">
            <h2 class="section-title fade-in">Arsitektur & Kerajinan</h2>
            <p class="section-subtitle fade-in">Bangunan bersejarah dan kerajinan tangan yang menjadi identitas visual Kota Kembang.</p>
            
            <div class="cards-grid">
                <div class="culture-card fade-in">
                    <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800&h=240&fit=crop" alt="Rumah Adat Sunda" class="card-image">
                    <div class="card-content">
                        <span class="card-category">Arsitektur</span>
                        <h3 class="card-title">Rumah Adat Sunda</h3>
                        <p class="card-description">Rumah panggung dengan atap julang ngapak (bentuk burung phoenix) dan struktur kayu jati. Simbol filosofi hidup Sunda.</p>
                        <a href="#" class="card-learn-more">Pelajari Lebih Lanjut →</a>
                    </div>
                </div>

                <div class="culture-card fade-in">
                    <img src="https://images.unsplash/photo-1571896349840-0d711be9d7b1?w=800&h=240&fit=crop" alt="Batik Bandung" class="card-image">
                    <div class="card-content">
                        <span class="card-category">Kerajinan</span>
                        <h3 class="card-title">Batik & Kain</h3>
                        <p class="card-description">Batik modern dengan motif parahyangan seperti kawung, mega mendung, dan pula kembang. Pusatnya di Kampung Batik Cipadu.</p>
                        <a href="#" class="card-learn-more">Pelajari Lebih Lanjut →</a>
                    </div>
                </div>

                <div class="culture-card fade-in">
                    <img src="https://images.unsplash.com/photo-1580130684518-6f4a38f3f3d8?w=800&h=240&fit=crop" alt="Keramik" class="card-image">
                    <div class="card-content">
                        <span class="card-category">Keramik</span>
                        <h3 class="card-title">Gerabah & Keramik</h3>
                        <p class="card-description">Kerajinan tanah liat khas Plered dan Cigadung dengan motif tradisional Sunda yang indah dan fungsional.</p>
                        <a href="#" class="card-learn-more">Pelajari Lebih Lanjut →</a>
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

