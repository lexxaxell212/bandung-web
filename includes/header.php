<?php
$lib_path = dirname(__DIR__) . '/lib/functions.php';
if (!file_exists($lib_path)) die('lib/functions.php missing: ' . $lib_path);
require_once $lib_path;
autoload_core();
session_start();

$message = $type = $email_value = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email'])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    
    // Validasi
    if (!isValidEmailDomain($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $type = 'error';
        $message = '❌ Email tidak valid atau domain tidak didukung!';
        $email_value = $_POST['email'];
    } else {
        // MAGIC 1 QUERY: INSERT OR REACTIVATE
        $stmt = $pdo->prepare("
            INSERT INTO subscribers (email, status, subscribed_at) 
            VALUES (?, 'active', NOW())
            ON DUPLICATE KEY UPDATE 
                status = 'active', 
                subscribed_at = NOW(), 
                unsubscribe_token = NULL
        ");
        
        if ($stmt->execute([$email])) {
            // Selalu success (insert/update)
            $type = 'success';
            $message = '✅ Berhasil berlangganan newsletter!';
            
            // Generate token baru (untuk reactivate juga)
            $subscriber_id = $pdo->lastInsertId();
            if ($subscriber_id) {
                generateUnsubscribeToken($pdo, $subscriber_id);
            }
        } else {
            $type = 'error';
            $message = '❌ Gagal menyimpan data!';
        }
    }
}

// DOMAIN VALIDATION FUNCTION
function isValidEmailDomain($email) {
    $allowed_domains = [
        'gmail.com', 'googlemail.com',
        'yahoo.com', 'ymail.com', 'rocketmail.com',
        'outlook.com', 'hotmail.com', 'live.com',
        'icloud.com', 'me.com',
        'protonmail.com', 'proton.me'
    ];
    
    $domain = strtolower(substr(strrchr($email, "@"), 1));
    return in_array($domain, $allowed_domains);
}

$page_title ??= SITE_NAME ?? 'AyoKeBandung';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <title><?php echo SITE_NAME; ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Language" content="id-ID">
  <meta name="language" content="Indonesian">
  <!-- load assets -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="<?php echo CSS_URL; ?>glassmorphism-blue.css" rel="stylesheet">
  <link href="<?php echo CSS_URL; ?>float-chat.css" rel="stylesheet">
  <link href="<?php echo CSS_URL; ?>style.css" rel="stylesheet">
  <link href="<?php echo CSS_URL; ?>footer.css" rel="stylesheet">
  <link rel="icon" href="<?php echo IMG_URL; ?>favicon.ico">
</head>
<body>
 <div class="fab-chatbot-container">
    <div class="fab-chatbot-label">
      <p style="color: var(--blue-100);">
        Hai, Aku Asisten. Siap bantu kamu!
      </p>
    </div>
    <button class="fab-chatbot" id="chatbotFabBtn">
      <i class="fas fa-comment-dots"></i>
    </button>
  </div>
  <div class="chatbot offcanvas offcanvas-end" id="chatbot">
    <div class="offcanvas-header">
      <div class="chatbot-header container">
        <h6 class="offcanvas-title mb-0">
          <i class="fas fa-solid fa-circle-user me-2"></i>
          Asisten Website
        </h6>
        <button class="close-btn" onclick="closeChatbot()"><i class="fa-solid fa-xmark"></i></button>
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
                <div>Weather Load...</div>
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