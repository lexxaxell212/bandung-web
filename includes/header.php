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
    
    <!-- Oxygen font google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    
    
</head>

<body>
    
    <!-- Navbar section -->
    
    <nav class="navbar">
        <div class="container">
            <!-- Logo -->
           
            <a class="navbar-brand" href="<?php echo BASE_URL; ?>">
                <i class="fas fa-bolt me-2"></i>
                MyApp
            </a>
            
            <!-- Overlay -->
            <div class="menu-overlay" id="menuOverlay"></div>

            <!-- Menu -->
            
            <button class="navbar-toggler no-outline-button" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarNav" aria-controls="navbarNav" 
                    aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
            

            <!-- Menu Content -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-grip"></i> Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>sejarah"><i class="fa-solid fa-landmark"></i>Sejarah</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>budaya"><i class="fa-solid fa-broom-ball"></i>Budaya</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>kuliner"><i class="fa-solid fa-bowl-rice"></i>Kuliner</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>layanan"><i class="fa-solid fa-bus"></i></i>Layanan</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>wisata"><i class="fa-solid fa-map-location-dot"></i>Wisata</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>penginapan"><i class="fa-solid fa-hotel"></i></i>Penginapan</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>informasi-terkini">
                            <i class="fa-regular fa-newspaper"></i>Informasi Terkini
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>kenapa-harus-bandung">
                            <i class="fa-regular fa-circle-question"></i>Kenapa Harus Bandung
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>panduan-maps">
                            <i class="fa-solid fa-location-dot"></i>Panduan Maps
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>kritik-dan-saran">
                            <i class="fa-solid fa-envelopes-bulk"></i>Kritik dan Saran
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>search">
                            <i class="fa-solid fa-magnifying-glass"></i>Telusuri
                        </a>
                    </li>
                    
                    
                    <!-- Darkmode -->
                    
                    
                    <div class="toggle">
                    <div class="switch" onclick="toggleDark(this)">
                        <span></span>
                    </div>
                    <span>Mode Gelap</span>
                    </div>
                    
                    <script>
                        
                        function toggleDark(el) {
                            document.documentElement.toggleAttribute('data-dark');
                            el.classList.toggle('on');
                            localStorage.dark = document.documentElement.hasAttribute('data-dark');
                        }
                        if(localStorage.dark==='true') document.documentElement.setAttribute('data-dark','');
                    </script>
                    
                    
                    <!-- CTA 
                    <li class="nav-item">
                        <a class="btn btn-cta" href="#get-started">
                            <i class="fas fa-arrow-right"></i> Get Started
                        </a>
                    </li>
                    -->
                    
                </ul>
            </div>
        </div>
    </nav>
    
    <script src="<?php echo JS_URL; ?>navbar.js"></script>
    
    <!-- Navbar section end -->
    
    <!-- Floating Button for chatbot  -->
    
    <button class="btn btn-primary floating-btn shadow-lg" onclick="toggleChatbot()" title="Chat">
        <i class="fa-solid fa-comments"></i>
    </button>
    
    <!-- Chatbot -->
    <div class="chatbot offcanvas offcanvas-end shadow-lg" id="chatbot">
        
        <div class="offcanvas-header bg-primary text-white p-3">
            <h6 style="color:white" class="offcanvas-title mb-0">
                <!-- Topic -->
                <option class="fas fa-solid fa-circle-user me-2" value="Bandung" id="topic-select"></option>Asisten Website
            </h6>
            <button class="btn-close btn-close-white" onclick="closeChatbot()"></button>
        </div>
        
        <div class="offcanvas-body p-0">
            <!-- Messages -->
            <div class="chat-messages p-3" id="chat-messages">
                
            </div>
            
            <!-- Input Area -->
            <div class="p-3 border-top bottom-area">
                <div class="input-group">
                        <input type="text" id="message-input" class="form-control" 
                               placeholder="Ketik pertanyaanmu disini..">
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
                        <span >Powered by GROCK.AI</span>
                    </div>
            </div>
        </div>
    </div>
    
    
    
    
    <script src="<?php echo JS_URL; ?>chat.js"></script>
    
    <script>
    
    let chatbotModal;
    
    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        chatbotModal = new bootstrap.Offcanvas(document.getElementById('chatbot'));
    });
    
    function toggleChatbot() {
        chatbotModal.toggle();
        if (chatbotModal._isShown()) {
            document.getElementById('chat-input').focus();
        }
    }
    
    function closeChatbot() {
        chatbotModal.hide();
    }
    
    </script>
    
    
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>
