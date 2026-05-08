<?php
$lib_path = dirname(__DIR__) . "/lib/functions.php";
if (!file_exists($lib_path)) {
  die("lib/functions.php missing: " . $lib_path);
}
require_once $lib_path;
autoload_core();

$page_title = $_POST["title"] ?? ($page_title ?? "Ayokebandung.id");
$page_title = htmlspecialchars($page_title);
?>

<!DOCTYPE html>
<html lang="ID, EN">
<head>
  <title><?php echo $page_title; ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Language" content="id-ID, en-EN">
  <meta name="language" content="Indonesian, English">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link href="<?php echo CSS_URL; ?>glassmorphism-blue3.css" rel="stylesheet">
  <link href="<?php echo CSS_URL; ?>style.css" rel="stylesheet">
  <link href="<?php echo CSS_URL; ?>live-search.css" rel="stylesheet">
  <link rel="icon" href="<?php echo IMG_URL; ?>favicon.ico">
</head>
<body>
  <div class="navbar">
    <div class="container">
      <a class="navbar-brand" href="<?php echo BASE_URL; ?>">
        <div class="logo-navbar"></div>
      </a>
      <div class="navbar-actions">
        <button class="search-btn" id="btn-search" title="Search">
          <i class="fas fa-magnifying-glass"></i>
        </button>
        <button class="navbar-toggler" type="button" id="navbarToggler">
          <div class="hamburger"></div>
        </button>
      </div>
      <div class="menu-overlay" id="menuOverlay"></div>
      <div class="navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mb-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-grip"></i> Pintasan
            </a>
            <ul class="dropdown-menu p-5 me-2">
              <li><a class="dropdown-item" href="<?php echo PAGES_URL; ?>sejarah"><i class="fa-solid fa-landmark m-2"></i>Sejarah</a></li>
              <li><a class="dropdown-item" href="<?php echo PAGES_URL; ?>budaya"><i class="fa-solid fa-broom-ball m-2"></i>Budaya</a></li>
              <li><a class="dropdown-item" href="<?php echo PAGES_URL; ?>kuliner"><i class="fa-solid fa-bowl-rice m-2"></i>Kuliner</a></li>
              <li><a class="dropdown-item" href="<?php echo PAGES_URL; ?>layanan"><i class="fa-solid fa-bus m-2"></i>Layanan</a></li>
              <li><a class="dropdown-item" href="<?php echo PAGES_URL; ?>wisata"><i class="fa-solid fa-map-location-dot m-2"></i>Wisata</a></li>
              <li><a class="dropdown-item" href="<?php echo PAGES_URL; ?>penginapan"><i class="fa-solid fa-hotel m-2"></i>Penginapan</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo PAGES_URL; ?>informasi-terkini">
              <i class="fa-solid fa-newspaper"></i>Informasi Terkini
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BLOG_URL; ?>">
              <i class="fa-solid fa-book"></i>Blog
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo PAGES_URL; ?>panduan-maps">
              <i class="fa-solid fa-location-dot"></i>Panduan Maps
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo PAGES_URL; ?>kritik-dan-saran">
              <i class="fa-solid fa-envelope"></i>Kritik dan Saran
            </a>
          </li>
          <div class="toggle">
            <div class="switch" onclick="toggleDark(this)">
              <span></span>
            </div>
            <span>Mode Gelap</span>
          </div>
          <div class="weather" id="w">
                <small>Mengambil data cuaca..</small>
          </div>
        </ul>
      </div>
    </div>
  </div>
  <div id="live-search-wrapper">
    <div class="search-input-bar">
      <input type="text" class="" id=searchInput2 placeholder="Apa yang ingin kamu cari ?">
      <div id="live-search-dropdown"></div>
    </div>
  </div>
  <div class="chatbot offcanvas" id="chatbot">
    <div class="offcanvas-header">
      <div class="chatbot-header container">
        <h6 class="offcanvas-title mb-0">
          <i class="fas fa-solid fa-circle-user me-2"></i>
          Asisten Web
        </h6>
        <button class="close-btn" data-bs-dismiss="offcanvas"><i class="fa-solid fa-xmark"></i></button>
      </div>
    </div>
    <div class="offcanvas-body p-3">
      <div class="chat-messages p-0" id="chat-messages">
      </div>
      <div class="border-top bottom-area p-2">
        <div class="input-group">
          <input type="text" id="message-input" class="input-chat"
          placeholder="Tanyakan ...">
        </div>
        <div class="button-group gap-2">
          <button class="btn btn-primary btn-sm" onclick="sendMessage()">
            <i class="fas fa-paper-plane"></i>
          </button>
          <button class="btn btn-accent btn-sm" onclick="clearChat()" title="Clear">
            <i class="fas fa-trash"></i>
          </button>
        </div>
        <div class="status-bar resizer text-muted">
          <span>* Histori pesan <strong>tidak</strong> pernah tersimpan</span>
        </div>
      </div>
    </div>
  </div>
  <button class="fab-chatbot" id="chatbotFabBtn"><i class="fas fa-comment-dots"></i></button>
  <button id="scrollTopBtn" class="scroll-top-btn">↑</button>
  <div class="main-content">
