<?php 
$page_title = "Informasi Terkini - MyApp";
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
            --primary-blue: #1e40af;
            --blue-light: #3b82f6;
            --blue-lighter: #60a5fa;
            --white: #ffffff;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-500: #64748b;
            --gray-700: #334155;
            --gray-900: #0f172a;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --shadow-hero: 0 35px 60px -15px rgb(0 0 0 / 0.3);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-50);
            color: var(--gray-900);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* HEADER */
        .header {
            background: var(--white);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header__inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-blue), var(--blue-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav__link {
            color: var(--gray-700);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav__link:hover {
            color: var(--primary-blue);
        }

        /* HERO SECTION */
        .hero {
            text-align: center;
            padding: 4rem 0 2rem;
            background: linear-gradient(135deg, var(--white) 0%, var(--gray-100) 100%);
        }

        .hero__title {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-blue), var(--blue-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .hero__subtitle {
            color: var(--gray-500);
            font-size: 1.25rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* NEWS SECTION */
        .news-section {
            padding: 0 0 4rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .section-subtitle {
            color: var(--gray-500);
            font-size: 1.1rem;
        }

        /* TOP NEWS SPECIAL CARD */
        .top-news {
            grid-column: 1 / -1;
            background: linear-gradient(135deg, var(--white) 0%, var(--gray-50) 100%);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: var(--shadow-hero);
            border: 2px solid var(--blue-light);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .top-news::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--blue-light), var(--blue-lighter));
        }

        .top-news:hover {
            transform: translateY(-16px);
            box-shadow: 0 50px 100px -20px rgb(59, 130, 246 / 0.4);
        }

        .top-news__inner {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 3rem;
            align-items: center;
            padding: 3rem;
            min-height: 320px;
        }

        .top-news__image {
            height: 100%;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
        }

        .top-news__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .top-news:hover .top-news__image img {
            transform: scale(1.15);
        }

        .top-news__content {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .top-news__badge {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: linear-gradient(135deg, var(--primary-blue), var(--blue-light));
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            align-self: flex-start;
            box-shadow: 0 4px 15px rgb(59, 130, 246 / 0.3);
        }

        .top-news__title {
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: var(--gray-900);
            line-height: 1.2;
            margin-bottom: 0;
        }

        .top-news__title:hover {
            background: linear-gradient(135deg, var(--primary-blue), var(--blue-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .top-news__excerpt {
            color: var(--gray-700);
            font-size: 1.125rem;
            line-height: 1.7;
        }

        .top-news__meta {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            color: var(--gray-500);
            font-size: 1rem;
        }

        .top-news__meta i {
            color: var(--blue-light);
            width: 18px;
        }

        /* REGULAR POSTS */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
            gap: 2rem;
        }

        .artikel-post {
            background: var(--white);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--gray-200);
        }

        .artikel-post:hover {
            transform: translateY(-12px);
            box-shadow: var(--shadow-xl);
            border-color: var(--blue-light);
        }

        .artikel-post__image {
            height: 240px;
            overflow: hidden;
            position: relative;
        }

        .artikel-post__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .artikel-post:hover .artikel-post__image img {
            transform: scale(1.1);
        }

        .artikel-post__content {
            padding: 2rem;
        }

        .artikel-post__category {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, var(--primary-blue), var(--blue-light));
            color: var(--white);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1.25rem;
        }

        .artikel-post__title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .artikel-post__title:hover {
            color: var(--primary-blue);
        }

        .artikel-post__meta {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            color: var(--gray-500);
            font-size: 0.9rem;
            margin-bottom: 1.25rem;
        }

        .artikel-post__meta i {
            color: var(--blue-light);
            width: 16px;
        }

        .artikel-post__excerpt {
            color: var(--gray-700);
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .artikel-post__footer {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }

        .artikel-post__readmore {
            color: var(--primary-blue);
            font-weight: 600;
            text-decoration: none;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .artikel-post__readmore:hover {
            color: var(--blue-light);
            transform: translateX(4px);
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .top-news__inner {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 2rem;
                padding: 2.5rem;
            }
            
            .top-news__badge {
                align-self: center;
            }
        }

        @media (max-width: 768px) {
            .header__inner {
                flex-direction: column;
                gap: 1rem;
                padding: 1.5rem 0;
            }

            .nav {
                gap: 1.5rem;
            }

            .container {
                padding: 0 1rem;
            }

            .news-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .top-news {
                margin-bottom: 2rem;
            }

            .artikel-post__content {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .section-title {
                font-size: 2rem;
            }

            .artikel-post__meta,
            .top-news__meta {
                flex-direction: column;
                gap: 0.75rem;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

<div class="page-container mt-5">
    
    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <h1 class="hero__title">Berita Terbaru</h1>
            <p class="hero__subtitle">Temukan informasi terkini dan terpercaya dari seluruh dunia</p>
        </div>
    </section>

    <!-- NEWS SECTION -->
    <section class="news-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Artikel Terbaru</h2>
                <p class="section-subtitle">Update setiap hari - 24/7</p>
            </div>

            <div class="news-grid">
                <!-- 🔥 TOP NEWS SPECIAL CARD -->
                <article class="top-news">
                    <div class="top-news__inner">
                        <div class="top-news__image">
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Breaking News">
                        </div>
                        <div class="top-news__content">
                            <span class="top-news__badge">
                                <i class="fas fa-bolt"></i>
                                Breaking News
                            </span>
                            <h3 class="top-news__title">Pemerintah Umumkan Libur Nasional Tambahan 3 Hari Akhir Tahun!</h3>
                            <p class="top-news__excerpt">
                                Menteri Sekretaris Negara mengumumkan penambahan 3 hari libur nasional pada akhir tahun 2024 untuk mendukung pemulihan ekonomi pasca-pandemi dan meningkatkan produktivitas masyarakat.
                            </p>
                            <div class="top-news__meta">
                                <span><i class="fas fa-calendar"></i> 21 Januari 2024</span>
                                <span><i class="fas fa-user"></i> Menko Perekonomian</span>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- ARTIKEL POST 1 -->
                <article class="artikel-post">
                    <div class="artikel-post__image">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="AI Technology">
                    </div>
                    <div class="artikel-post__content">
                        <span class="artikel-post__category">
                            <i class="fas fa-robot"></i>
                            Teknologi
                        </span>
                        <h3 class="artikel-post__title">Revolusi AI: ChatGPT-5 Siap Diluncurkan Bulan Depan</h3>
                        
                        <div class="artikel-post__meta">
                            <span><i class="fas fa-calendar"></i> 20 Januari 2024</span>
                            <span><i class="fas fa-user"></i> Dr. Andi Pratama</span>
                        </div>

                        <p class="artikel-post__excerpt">
                            OpenAI mengumumkan peluncuran ChatGPT-5 yang diklaim 10x lebih pintar dari versi sebelumnya. Model baru ini mampu memproses video, audio, dan dokumen kompleks secara real-time.
                        </p>

                        <div class="artikel-post__footer">
                            <a href="#" class="artikel-post__readmore">
                                Baca Lengkap
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- ARTIKEL POST 2 -->
                <article class="artikel-post">
                    <div class="artikel-post__image">
                        <img src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Electric Car">
                    </div>
                    <div class="artikel-post__content">
                        <span class="artikel-post__category">
                            <i class="fas fa-car"></i>
                            Otomotif
                        </span>
                        <h3 class="artikel-post__title">Tesla Cybertruck Resmi Dijual di Indonesia Rp 2,5 Miliar</h3>
                        
                        <div class="artikel-post__meta">
                            <span><i class="fas fa-calendar"></i> 19 Januari 2024</span>
                            <span><i class="fas fa-user"></i> Rina Susanti</span>
                        </div>

                        <p class="artikel-post__excerpt">
                            Tesla akhirnya membuka pre-order Cybertruck di pasar Indonesia. Mobil listrik futuristik ini hadir dengan harga mulai Rp 2,5 miliar dan baterai berkapasitas 123 kWh yang mampu tempuh 800 km sekali charge.
                        </p>

                                                <div class="artikel-post__footer">
                            <a href="#" class="artikel-post__readmore">
                                Baca Lengkap
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
    
</div>

</body>

</html>


<?php 

/* Footer */

require_once 'includes/footer.php'; ?>

