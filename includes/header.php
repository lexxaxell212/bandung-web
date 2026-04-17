<?php 
// Page title default
$page_title = isset($page_title) ? $page_title : 'MyApp';
require_once ROOT_PATH . 'config/config.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title; ?></title>
  <meta http-equiv="Content-Language" content="id-ID">
  <meta name="language" content="Indonesian">
  <!-- Bootstrap 5.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="<?php echo CSS_URL; ?>header.css" rel="stylesheet">
  <link href="<?php echo CSS_URL; ?>float-chat.css" rel="stylesheet">
  <link href="<?php echo CSS_URL; ?>style.css" rel="stylesheet">
  <link rel="icon" href="<?php echo IMG_URL; ?>favicon.ico">
</head>

<body>

  <!-- chatbot fab -->

  <div class="fab-chatbot-container">
    <div class="fab-chatbot-label">
      <i></i>Hai, Aku Asisten Web. Siap bantu kamu!
    </div>
    <button class="fab-chatbot" id="chatbotFabBtn">
      <i class="fas fa-comment-dots"></i>
    </button>
  </div>

  <div class="chatbot offcanvas offcanvas-end" id="chatbot">
    <div class="offcanvas-header bg-primary">
      <div class="chatbot-header container">
        <h6 style="color:white" class="offcanvas-title mb-0">
          <!-- Topic -->
          <option class="fas fa-solid fa-circle-user me-2" value="Bandung" id="topic-select"></option>Asisten Website
        </h6>
        <button class="close-btn" onclick="closeChatbot()"><i class="fa-solid fa-xmark"></i></button>
      </div>
    </div>
    <div class="offcanvas-body p-0">
      <!-- Messages -->
      <div class="chat-messages p-3" id="chat-messages">
      </div>
      <!-- Input Area -->
      <div class="p-3 border-top bottom-area">
        <div class="input-group">
          <input type="text" id="message-input" class="form-control" placeholder="Ketik pertanyaanmu disini..">
          <button class="btn btn-primary" onclick="sendMessage()">
            <i class="fas fa-paper-plane"></i>
          </button>
          <button class="btn btn-outline-secondary" onclick="clearChat()" title="Clear">
            <i class="fas fa-trash"></i>
          </button>
        </div>
        <div class="status-bar mt-2 resizer-o">
          <span id="token-count">Tokens: 0</span> |
          <span id="response-time">-</span> |
          <span id="model-used">-</span>
        </div>
        <div class="status-bar mt-2 resizer">
          <span>Powered by GROCK.AI</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Navbar  -->
  <div class="navbar">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand" href="<?php echo BASE_URL; ?>">
        <img class="logo-navbar" src="<?php echo IMG_URL; ?>logo.png" alt="logo" loading="lazy">
      </a>

      <!-- Actions -->
      <div class="navbar-actions">
        <button class="search-btn" id="searchBtn" title="Search">
          <i class="fas fa-magnifying-glass"></i>
        </button>
        <button class="navbar-toggler" type="button" id="navbarToggler">
          <div class="hamburger"></div>
        </button>
      </div>
      <!-- Overlay -->
      <div class="menu-overlay" id="menuOverlay"></div>

      <!-- Menu Content -->
      <div class="navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-grip"></i> Menu
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>sejarah"><i class="fa-solid fa-landmark m-2"></i>Sejarah</a></li>
              <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>budaya"><i class="fa-solid fa-broom-ball m-2"></i>Budaya</a></li>
              <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>kuliner"><i class="fa-solid fa-bowl-rice m-2"></i>Kuliner</a></li>
              <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>layanan"><i class="fa-solid fa-bus m-2"></i>Layanan</a></li>
              <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>wisata"><i class="fa-solid fa-map-location-dot m-2"></i>Wisata</a></li>
              <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>penginapan"><i class="fa-solid fa-hotel m-2"></i>Penginapan</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>informasi-terkini">
              <i class="fa-regular fa-newspaper"></i>Informasi Terkini
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>panduan-maps">
              <i class="fa-solid fa-location-dot"></i>Panduan Maps
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>kritik-dan-saran">
              <i class="fa-solid fa-envelope"></i>Kritik dan Saran
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>search">
              <i class="fa-solid fa-magnifying-glass"></i>Telusuri
            </a>
          </li>

          <!-- dark mode -->
          <div class="toggle">
            <div class="switch" onclick="toggleDark(this)">
              <span></span>
            </div>
            <span>Mode Gelap</span>
          </div>
        </ul>
      </div>
    </div>
  </div>

  <!-- search modal -->

  <div class="search-body" id="searchBody">
    <div class="search-container" id="searchModalBackdrop">
      <!-- DIV 2: SEARCH-HEADER - 20% height, fixed top -->
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
          <input type="text" class="search-input" id="searchInput" placeholder="Apa yang pengin kamu cari... ">
          
        </div>
        <div id="typing" class="typing" style="display:none;">
          </div>
        <div id="stats" class="stats-search" style="display:none;">
          <strong id="count">0</strong> hasil untuk <span id="query"></span>
        </div>
        <div class="result" id="results"></div>
          <div id="noResults" class="no-results" style="display:none;">
            <p class="mb-0">Start typing to search</p>
          </div>

      </div>
    </div>
  </div>

  <script src="<?php echo JS_URL; ?>navbar.js"></script>
  <script src="<?php echo JS_URL; ?>chat.js"></script>
  <script src="<?php echo JS_URL; ?>search.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>