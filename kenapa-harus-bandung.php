<?php 
$page_title = "Kenapa Harus Bandung - MyApp";
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

        :root {
            --blue-900: #1e3a8a;
            --blue-800: #1e40af;
            --blue-700: #2563eb;
            --blue-600: #3b82f6;
            --blue-500: #60a5fa;
            --blue-400: #93c5fd;
            --blue-100: #dbeafe;
            --white: #ffffff;
            --gray-100: #f1f5f9;
            --gray-800: #1e293b;
            --shadow: 0 25px 50px -12px rgb(30 58 138 / 0.25);
            --radius: 24px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--blue-100) 0%, #eff6ff 100%);
            color: var(--gray-800);
            min-height: 100vh;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* HEADER */
        .header {
            background: var(--white);
            padding: 3rem 0;
            text-align: center;
            box-shadow: 0 10px 30px rgb(30 58 138 / 0.1);
            border-radius: 0 0 var(--radius) var(--radius);
            margin-bottom: 3rem;
        }

        .header__icon {
            font-size: 4rem;
            background: linear-gradient(135deg, var(--blue-600), var(--blue-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
        }

        .header__title {
            font-size: clamp(2.5rem, 7vw, 4.5rem);
            font-weight: 800;
            background: linear-gradient(135deg, var(--blue-800), var(--blue-600));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            line-height: 1.1;
        }

        .header__subtitle {
            font-size: 1.4rem;
            color: var(--blue-700);
            font-weight: 500;
            max-width: 700px;
            margin: 0 auto;
        }

        /* FEATURED IMAGE */
        .featured {
            background: var(--white);
            border-radius: var(--radius);
            padding: 2rem;
            text-align: center;
            margin-bottom: 4rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(59, 130, 246, 0.1);
        }

        .featured img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgb(30 58 138 / 0.15);
        }

        /* REASONS GRID */
        .reasons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .reason {
            background: var(--white);
            padding: 2.5rem 2rem;
            border-radius: var(--radius);
            text-align: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(59, 130, 246, 0.1);
            position: relative;
            overflow: hidden;
        }

        .reason__image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 16px;
            margin-bottom: 1.5rem;
            box-shadow: 0 10px 30px rgb(30 58 138 / 0.1);
        }

        .reason::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--blue-600), var(--blue-500));
            transition: left 0.4s ease;
        }

        .reason:hover {
            transform: translateY(-12px);
            box-shadow: var(--shadow);
            border-color: var(--blue-600);
        }

        .reason:hover::before {
            left: 0;
        }

        .reason__icon {
            font-size: 3.5rem;
            background: linear-gradient(135deg, var(--blue-600), var(--blue-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
            display: block;
        }

        .reason__number {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 2rem;
            font-weight: 800;
            color: var(--blue-600);
            opacity: 0.8;
        }

        .reason__title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 1rem;
        }

        .reason__desc {
            color: var(--blue-700);
            line-height: 1.7;
            font-size: 1.05rem;
        }

        /* STATS */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin: 4rem 0;
        }

        .stat {
            background: var(--white);
            padding: 2.5rem 2rem;
            border-radius: var(--radius);
            text-align: center;
            box-shadow: var(--shadow);
            border: 1px solid rgba(59, 130, 246, 0.1);
        }

        .stat__icon {
            font-size: 2.5rem;
            color: var(--blue-600);
            margin-bottom: 1rem;
        }

        .stat__number {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--blue-800), var(--blue-600));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: block;
        }

        .stat__label {
            color: var(--blue-700);
            font-weight: 600;
            font-size: 1rem;
        }

        /* CTA */
        .cta {
            background: linear-gradient(135deg, var(--blue-800), var(--blue-600));
            color: white;
            padding: 4rem 2rem;
            border-radius: var(--radius);
            text-align: center;
            margin: 4rem 0;
            box-shadow: var(--shadow);
        }

        .cta__title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .cta__subtitle {
            font-size: 1.25rem;
            opacity: 0.95;
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta__buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .btn-primary {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: white;
        }

        .btn-primary:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgb(59, 130, 246 / 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: white;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }

            .reasons {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .cta__buttons {
                flex-direction: column;
                align-items: center;
            }

            .featured img {
                height: 250px;
            }

            .reason__image {
                height: 150px;
            }
        }

        @media (max-width: 480px) {
            .header {
                padding: 2rem 1rem;
            }

            .header__title {
                font-size: 2.5rem;
            }

            .reason, .stat {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>

<body>

<div class="page-container mt-5">
    
    <!-- HEADER -->
    <header class="header">
        <div class="container">
            <i class="fas fa-mountain-city header__icon"></i>
            <h1 class="header__title">Kenapa Harus ke Bandung?</h1>
            <p class="header__subtitle">Kota Kembang yang Menyimpan Pesona Tak Terbatas</p>
        </div>
    </header>

    <div class="container">
        <!-- FEATURED IMAGE - Pemandangan Bandung -->
        <section class="featured">
            <img src="https://asset.kompas.com/crops/C9ZPsnX6Z3zXGwjO98AZlxUSsfc=/0x0:640x427/1200x800/data/photo/2024/05/14/6642ea1cd3515.jpg" alt="Pemandangan Kota Bandung">
        </section>

        <!-- 7 REASONS WITH IMAGES -->
        <section class="reasons">
            <!-- Reason 1: Alam -->
            <article class="reason">
                <span class="reason__number">01</span>
                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Lembang Bandung" class="reason__image">
                <i class="fas fa-mountain-sun reason__icon"></i>
                <h3 class="reason__title">Alam yang Memesona</h3>
                <p class="reason__desc">Lembang, Ciwidey, Kawah Putih - panorama pegunungan yang bikin hati adem.</p>
            </article>

            <!-- Reason 2: Kuliner -->
            <article class="reason">
                <span class="reason__number">02</span>
                <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Kuliner Sunda" class="reason__image">
                <i class="fas fa-utensils reason__icon"></i>
                <h3 class="reason__title">Kuliner Juara</h3>
                <p class="reason__desc">Sate maranggi, nasi timbel, seblak, cireng - setiap sudut penuh kelezatan khas Sunda.</p>
            </article>

            <!-- Reason 3: Factory Outlet -->
            <article class="reason">
                <span class="reason__number">03</span>
                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Factory Outlet" class="reason__image">
                <i class="fas fa-shopping-bag reason__icon"></i>
                <h3 class="reason__title">Factory Outlet</h3>
                <p class="reason__desc">Rumah Mode, Heritage, Distro Dago - belanja fashion branded harga pabrik.</p>
            </article>

            <!-- Reason 4: Kafe -->
            <article class="reason">
                <span class="reason__number">04</span>
                <img src="https://images.unsplash.com/photo-1512568400610-42fe290ca098?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Kafe Bandung" class="reason__image">
                <i class="fas fa-coffee reason__icon"></i>
                <h3 class="reason__title">Kafe Aesthetic</h3>
                <p class="reason__desc">Ribuan kafe instagramable dengan view pegunungan dan arsitektur unik.</p>
            </article>

            <!-- Reason 5: Arsitektur -->
            <article class="reason">
                <span class="reason__number">05</span>
                <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Gedung Sate" class="reason__image">
                <i class="fas fa-landmark reason__icon"></i>
                <h3 class="reason__title">Arsitektur Kolonial</h3>
                <p class="reason__desc">Gedung Sate, Braga, Asia Afrika - jejak sejarah yang masih terjaga sempurna.</p>
            </article>

            <!-- Reason 6: Seni -->
            <article class="reason">
                <span class="reason__number">06</span>
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Seni Budaya" class="reason__image">
                <i class="fas fa-palette reason__icon"></i>
                <h3 class="reason__title">Seni & Budaya</h3>
                <p class="reason__desc">Museum, galeri seni, komunitas kreatif yang terus berinovasi.</p>
            </article>

            <!-- Reason 7: Hati -->
            <article class="reason">
                <span class="reason__number">07</span>
                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Pemandangan Alam" class="reason__image">
                <i class="fas fa-heart reason__icon"></i>
                <h3 class="reason__title">Home Sweet Home</h3>
                <p class="reason__desc">Suasana sejuk, ramah tamah, dan kangen yang bikin ingin balik lagi.</p>
            </article>
        </section>

        <!-- STATS -->
        <section class="stats">
            <div class="stat">
                <i class="fas fa-users stat__icon"></i>
                <div class="stat__number">5M+</div>
                <div class="stat__label">Wisatawan/Tahun</div>
            </div>
            <div class="stat">
                <i class="fas fa-utensils stat__icon"></i>
                <div class="stat__number">10K+</div>
                <div class="stat__label">Kuliner Khas</div>
            </div>
            <div class="stat">
                <i class="fas fa-store stat__icon"></i>
                <div class="stat__number">500+</div>
                <div class="stat__label">Factory Outlet</div>
            </div>
            <div class="stat">
                <i class="fas fa-mug-hot stat__icon"></i>
                <div class="stat__number">2K+</div>
                <div class="stat__label">Kafe Unik</div>
            </div>
        </section>

        <!-- CTA -->
        <section class="cta">
            <h2 class="cta__title">Siap Petualangan ke Bandung?</h2>
            <p class="cta__subtitle">Jadwal akhir pekan sudah penuh? Booking sekarang sebelum ketinggalan!</p>
            <div class="cta__buttons">
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-plane"></i>
                    Pesan Tiket
                </a>
                <a href="#" class="btn btn-secondary">
                    <i class="fas fa-hotel"></i>
                    Cari Hotel
                               </a>
            </div>
        </section>
    </div>
    
</div>

</body>

</html>


<?php 

/* Footer */

require_once 'includes/footer.php'; ?>

