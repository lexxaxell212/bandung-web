<?php
$lib_path = dirname(__DIR__) . '/lib/functions.php';
if (!file_exists($lib_path)) die('lib/functions.php missing: ' . $lib_path);
require_once $lib_path;
autoload_core();
session_start();

$page_title = $_POST['title'] ?? $page_title ?? 'Ayokebandung.id';
$page_title = htmlspecialchars($page_title);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <title><?php echo $page_title; ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Language" content="id-ID">
  <meta name="language" content="Indonesian">
  <!-- load assets -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link href="<?php echo CSS_URL; ?>glassmorphism-blue3.css" rel="stylesheet">
  <link href="<?php echo CSS_URL; ?>float-chat.css" rel="stylesheet">
  <link href="<?php echo CSS_URL; ?>style.css" rel="stylesheet">
  <link href="<?php echo CSS_URL; ?>footer.css" rel="stylesheet">
  <link rel="icon" href="<?php echo IMG_URL; ?>favicon.ico">
</head>
<body>
  
   <button class="fab-chatbot" id="chatbotFabBtn">
      <i class="fas fa-comment-dots"></i>
    </button>
    
    <style>
     .scroll-top-btn {
    position: fixed;
    bottom: 100px;
    right: clamp(14px, 3.8vw, 26px);
    z-index: 1064;
    width: 46px;
    height: 46px;
    background: var(--blue-100);
    border: 1px solid var(--blue-200);
    border-radius: 50%;
    color: var(--blue-900);
    font-size: 1rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    opacity: 0;
    visibility: hidden;
    transform: scale(0.8) translateY(20px) rotate(-180deg);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.scroll-top-btn:hover {
    transform: scale(1.01) !important;
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
}

@keyframes scrollTopSlideIn {
    0% { 
        opacity: 0; 
        transform: scale(0.9) translateY(20px) rotate(-180deg); 
    }
    50% { 
        transform: scale(1) rotate(360deg); 
    }
    100% { 
        opacity: 1; 
        transform: scale(1) translateY(0) rotate(0deg); 
    }
}
@media (min-width: 768px) {
            .scroll-top-btn { right: clamp(24px, 4.5vw, 45px); }
        }
        @media (min-width: 992px) { 
            .scroll-top-btn { 
                right: clamp(65px, 6vw, 90px);
            }
        }
        @media (min-width: 1200px) { 
            .scroll-top-btn { 
                right: clamp(120px, 8vw, 160px);
            }
        }
    </style>
    <button id="scrollTopBtn" class="scroll-top-btn">↑</button>
 
  <div class="chatbot offcanvas offcanvas-end" id="chatbot">
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
          <input type="text" id="message-input" class="input-chat" placeholder="message ...">
        </div>
        <div class="button-group gap-2">
          <button class="btn btn-primary" onclick="sendMessage()">
            <i class="fas fa-paper-plane"></i>
          </button>
          <button class="btn btn-accent" onclick="clearChat()" title="Clear">
            <i class="fas fa-trash"></i>
          </button>
        </div>
        <div class="status-bar resizer">
          <span>Powered by <strong>GROCK.AI</strong></span>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar">
    <div class="container">
      <a class="navbar-brand" href="<?php echo BASE_URL; ?>">
        <div class="logo-navbar"></div>
      </a>
      <div class="navbar-actions">
        <button class="search-btn" id="searchBtn" title="Search">
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
              <i class="fa-regular fa-newspaper"></i>Informasi Terkini
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
                <div>Weather Loads...</div>
          </div>
        </ul>
      </div>
    </div>
  </div>
  <div class="search-body" id="searchBody">
    <div class="search-container" id="searchModalBackdrop">
      <div class="search-header">
        <h5 class="search-modal-title">
          <i class="fas fa-magnifying-glass me-2"></i>Search
        </h5>
        <button class="search-modal-close" id="searchModalClose">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="search-content" id="searchModalContainer">
        <div class="search-input-wrapper">
          <i class="fas fa-magnifying-glass search-input-icon"></i>
          <input type="text" class="search-input" id="searchInput" placeholder="Apa yang ingin kamu cari ?">
        </div>
        <div id="typing" class="typing" style="display:none;">
        </div>
        <div id="stats" class="stats-search" style="display:none;">
          <strong id="count">0</strong> hasil untuk <span id="query"></span>
        </div>
        <div class="result" id="results"></div>
        <div id="noResults" class="no-results" style="display:none;">
          <p class="mb-0">
            Start typing to search
          </p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="main-content">