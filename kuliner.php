<?php 
$page_title = "kuliner - MyApp";
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
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            font-size: 2rem;
            color: #4fc3f7;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-links a:hover {
            color: #4fc3f7;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background: white;
            margin: 3px 0;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(30,60,114,0.9), rgba(42,82,152,0.9)), url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><rect fill="%234fc3f7" width="1200" height="600"/><circle fill="%232a5298" opacity="0.3" cx="200" cy="150" r="100"/><circle fill="%231e3c72" opacity="0.2" cx="900" cy="400" r="150"/><circle fill="%234fc3f7" opacity="0.4" cx="600" cy="250" r="80"/></svg>');
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            margin-top: 80px;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            max-width: 600px;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(45deg, #4fc3f7, #29b6f6);
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .cta-button:hover {
            background: linear-gradient(45deg, #29b6f6, #4fc3f7);
        }

        /* Section */
        .section {
            padding: 100px 0;
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            color: #1e3c72;
            position: relative;
        }

        .section-title::after {
            content: '';
            width: 80px;
            height: 4px;
            background: linear-gradient(45deg, #4fc3f7, #29b6f6);
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        /* Kuliner Grid */
        .kuliner-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 4rem;
        }

        .kuliner-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        }

        .kuliner-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .card-content {
            padding: 2rem;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e3c72;
            margin-bottom: 0.5rem;
        }

        .card-desc {
            color: #666;
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .price {
            font-size: 1.3rem;
            font-weight: 700;
            color: #4fc3f7;
        }

        .location {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #888;
            font-size: 0.9rem;
        }

        /* Stats Section */
        .stats {
            background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
            color: white;
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .stat-item {
            padding: 2rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: #4fc3f7;
            display: block;
        }

        .stat-label {
            font-size: 1.1rem;
            margin-top: 0.5rem;
            opacity: 0.9;
        }

        /* Contact Section */
        .contact {
            background: #f8fbff;
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .contact-info h3 {
            color: #1e3c72;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .contact-item i {
            background: linear-gradient(45deg, #4fc3f7, #29b6f6);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        /* Footer */
        footer {
            background: #1e3c72;
            color: white;
            text-align: center;
            padding: 3rem 0 1rem;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .social-links a {
            width: 50px;
            height: 50px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
        }

        .social-links a:hover {
            background: #4fc3f7;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hamburger {
                display: flex;
            }

            .nav-links {
                display: none;
            }

            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-content p {
                font-size: 1.1rem;
            }

            .kuliner-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .contact-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .section {
                padding: 60px 1rem;
            }
        }

        /* Mobile menu styles */
        .nav-links.active {
            display: flex;
            position: fixed;
            top: 80px;
            left: 0;
            width: 100%;
            background: rgba(30, 60, 114, 0.98);
            flex-direction: column;
            padding: 2rem;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }
    </style>
</head>

<body>

<div class="page-container mt-5">
    

    <!-- Kuliner Section -->
    <section id="kuliner" class="section">
        <h2 class="section-title">Kuliner Khas Bandung</h2>
        <div class="kuliner-grid">
            <div class="kuliner-card">
                <img src="https://images.unsplash.com/photo-1579586140626-7173086fc5eb?w=400&h=250&fit=crop" alt="Seblak">
                <div class="card-content">
                    <h3 class="card-title">Seblak</h3>
                    <p class="card-desc">Mie kenyal dengan kuah pedas gurih, topping kerupuk, sosis, dan telur. Sensasi pedas yang bikin nagih!</p>
                    <div class="card-footer">
                        <span class="price">Rp 15.000</span>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Alun-alun</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kuliner-card">
                <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400&h=250&fit=crop" alt="Batagor">
                <div class="card-content">
                    <h3 class="card-title">Batagor</h3>
                    <p class="card-desc">Bakso tahu goreng dengan bumbu kacang kental yang khas Bandung. Renyah di luar, lembut di dalam!</p>
                    <div class="card-footer">
                        <span class="price">Rp 12.000</span>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Dago</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kuliner-card">
                <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=400&h=250&fit=crop" alt="Cimol">
                <div class="card-content">
                    <h3 class="card-title">Cimol</h3>
                    <p class="card-desc">Tepung tapioka kenyal dengan berbagai rasa. Camilan wajib saat jalan-jalan di Bandung!</p>
                    <div class="card-footer">
                        <span class="price">Rp 5.000</span>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Cihampelas</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kuliner-card">
                <img src="https://images.unsplash.com/photo-1579758906977-2cde735f960e?w=400&h=250&fit=crop" alt="Nasi Timbel">
                <div class="card-content">
                    <h3 class="card-title">Nasi Timbel</h3>
                    <p class="card-desc">Nasi dengan daun pisang, lauk pauk lengkap, sambal dadak. Makanan tradisional Sunda yang lezat!</p>
                    <div class="card-footer">
                        <span class="price">Rp 25.000</span>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Lembang</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kuliner-card">
                <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=400&h=250&fit=crop" alt="Kue Cubit">
                <div class="card-content">
                    <h3 class="card-title">Kue Cubit</h3>
                    <p class="card-desc">Kue cubit mini dengan topping coklat, keju, dan meses. Manis dan renyah!</p>
                    <div class="card-footer">
                        <span class="price">Rp 8.000</span>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Pasir Kaliki</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kuliner-card">
                <img src="https://images.unsplash.com/photo-1542994893-e18a11c44d8f?w=400&h=250&fit=crop" alt="Mie Kocok">
                <div class="card-content">
                    <h3 class="card-title">Mie Kocok</h3>
                    <p class="card-desc">Mie dengan kuah kaldu sapi kental, kikil, dan bakso. Hangat dan mengenyangkan!</p>
                    <div class="card-footer">
                        <span class="price">Rp 18.000</span>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Cihideung</span>
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

