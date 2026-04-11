<?php
session_start();

// DETECT BASE URL & PATH
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$script_dir = dirname($_SERVER['SCRIPT_NAME']);
$base_url = $protocol . '://' . $host . rtrim($script_dir, '/') . '/';

// ROOT PATH
define('BASE_URL', $base_url);
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . $script_dir . '/');

// ASSETS PATH
define('ASSETS_URL', BASE_URL . 'assets/');
define('CSS_URL', ASSETS_URL . 'css/');
define('JS_URL', ASSETS_URL . 'js/');
define('IMG_URL', ASSETS_URL . 'images/');

// PAGES PATH
// define('PAGES_URL', BASE_URL . 'pages/');

// DEBUG
// echo "BASE_URL: " . BASE_URL . "<br>";
// echo "CSS_URL: " . CSS_URL . "<br>";
?>