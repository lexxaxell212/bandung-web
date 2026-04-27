<?php
// setup.php 
if (defined('SETUP_LOADED')) return;
define('SETUP_LOADED', true);

// 1. BASE URL
$protocol = (!empty($_SERVER['HTTPS']) ? 'https' : 'http');
$host = $_SERVER['HTTP_HOST'];
$site_url = $protocol . '://' . $host . '/';

// 2. CORE
define('SITE_NAME', 'AyoKeBandung');
define('SITE_URL', $site_url);
if (!defined('BASE_URL')) define('BASE_URL', $site_url);  // ← CHECK SEBELUM DEFINE

define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . $dir . '/');

// 3. ASSETS
define('ASSETS_URL', SITE_URL . 'assets/');
define('CSS_URL', ASSETS_URL . 'css/');
define('JS_URL', ASSETS_URL . 'js/');
define('IMG_URL', ASSETS_URL . 'images/');
define('FONTS_URL', ASSETS_URL . 'fonts/');

// 4. PAGES
define('PAGES_URL', SITE_URL . 'pages/');
define('ADMIN_URL', SITE_URL . 'admin/');
define('BLOG_URL', SITE_URL . 'blogs/');
define('API_URL', SITE_URL . 'api/');

// 5. FILES
define('UPLOADS_URL', SITE_URL . 'uploads/');
define('UPLOADS_PATH', ROOT_PATH . 'uploads/');

// 6. SYSTEM
define('LOGS_PATH', ROOT_PATH . 'logs/');
define('CONFIG_PATH', ROOT_PATH . 'config/');
define('INCLUDES_PATH', ROOT_PATH . 'includes/');
define('LIB_PATH', ROOT_PATH . 'lib/');

// 7. APP SETTINGS
define('APP_TIMEZONE', 'Asia/Jakarta');
define('DEBUG_MODE', in_array($_SERVER['SERVER_NAME'], ['localhost', '127.0.0.1']));
define('SESSION_TIMEOUT', 3600);

date_default_timezone_set(APP_TIMEZONE);
?>