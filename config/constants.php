<?php
if (defined("CONSTANTS_LOADED")) return;
define("CONSTANTS_LOADED", true);

// https / http
$protocol = (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== 'off') ? "https" : "http";
$host = $_SERVER["HTTP_HOST"];
$base_url = $protocol . "://" . $host . "/public/";

// Base url
if (!defined("BASE_URL")) define("BASE_URL", $base_url);

// Base path
define("ROOT_PATH", __DIR__ . "/");

// Site name
define("SITE_NAME", "AYOKEBANDUNG.ID");

// Assets
define("ASSETS_URL", BASE_URL . "assets/");
define("CSS_URL",    ASSETS_URL . "css/");
define("JS_URL",     ASSETS_URL . "js/");
define("IMG_URL",    ASSETS_URL . "images/");
define("FONTS_URL",  ASSETS_URL . "fonts/");
define("UPLOADS_URL",  BASE_URL . "uploads/");

// Pages
define("PAGES_URL", BASE_URL . "pages/");
define("BLOGS_URL",  BASE_URL . "blogs/");

// Admin dashboard
define("ADMIN_URL", BASE_URL . "admin/");
define("BASE_UPLOAD_URL", ADMIN_URL );

// Core
define("LOGS_PATH",     ROOT_PATH . "errors/");
define("LIB_PATH",      ROOT_PATH . "lib/");
define("API_PATH",      ROOT_PATH . "api/");
define("CONFIG_PATH",   ROOT_PATH . "config/");
define("RESOURCES_PATH", ROOT_PATH . "resources/views/");

// Etc
define("APP_TIMEZONE", "Asia/Jakarta");
define("DEBUG_MODE", in_array($_SERVER["SERVER_NAME"], ["localhost", "127.0.0.1"]));
date_default_timezone_set(APP_TIMEZONE);