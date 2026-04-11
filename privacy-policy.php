<?php 
$page_title = "Privasi policy - MyApp";
require_once 'config/config.php';
require_once 'includes/header.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
       
        h1 {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.5rem;
            color: var(--c-dark);
        }

        h2 {
            font-size: 1.3rem;
            font-weight: 600;
            margin: 2rem 0 1rem 0;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #3b82f6;
            color: var(--c-dark);
        }

        p, li {
            font-size: 1rem;
            margin-bottom: 1rem;
            color: var(--c-dark);
        }

        ul {
            padding-left: 1rem;
            margin-bottom: 1rem;
        }

        .highlight {
            background: rgba(0,0,0, 0.07);
            border-left: 4px solid #3b82f6;
            padding: 1rem 1.25rem;
            margin: 1.5rem 0;
            color: var(--c-dark);
        }

        .contact {
            text-align: center;
            padding: 2rem;
            background: rgba(0,0,0, 0.07);
            border-radius: 8px;
            margin-top: 3rem;
            color: var(--c-dark);
        }

        .email {
            font-weight: 600;
            text-decoration: none;
            color: var(--c-dark);
        }

    </style>
</head>

<body>


<div class="menu-container mt-5">

    <h1>Kebijakan Privasi</h1>

    <h2>1. Informasi yang Kami Kumpulkan</h2>
    <p>Kami mengumpulkan:</p>
    <ul>
        <li>Nama dan email saat mendaftar</li>
        <li>Data kunjungan (IP, browser)</li>
        <li>Cookie untuk analitik</li>
    </ul>

    <h2>2. Penggunaan Data</h2>
    <p>Data digunakan untuk:</p>
    <ul>
        <li>Menyediakan layanan</li>
        <li>Kirim berita & event</li>
        <li>Analisis pengunjung</li>
    </ul>

    <div class="highlight">
        <strong>Kami TIDAK menjual data pribadi Anda.</strong>
    </div>

    <h2>3. Berbagi Data</h2>
    <p>Data dibagikan dengan:</p>
    <ul>
        <li>Penyedia layanan (hosting, email)</li>
        <li>Google Analytics</li>
        <li>Otoritas hukum (jika diminta)</li>
    </ul>

    <h2>4. Cookie</h2>
    <p>Gunakan cookie untuk pengalaman terbaik. Nonaktifkan di browser jika tidak ingin.</p>

    <h2>5. Hak Anda</h2>
    <ul>
        <li>Lihat data Anda</li>
        <li>Hapus data</li>
        <li>Batal langganan</li>
    </ul>

    <h2>6. Keamanan</h2>
    <p>Data dienkripsi SSL. Tetap waspada terhadap phishing.</p>

    <div class="contact">
        <h2>Pertanyaan?</h2>
        <p><a href="mailto:admin@website.com" class="email">admin@website.com</a></p>
    </div>

    
</div>

</body>

</html>


<?php 

/* Footer */

require_once 'includes/footer.php'; ?>

