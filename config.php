<?php
// config.php - DATABASE ONLY (No overlap dengan setup.php)
if (defined('CONFIG_LOADED')) return;
define('CONFIG_LOADED', true);

if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_NAME')) define('DB_NAME', '');
if (!defined('DB_USER')) define('DB_USER', '');
if (!defined('DB_PASS')) define('DB_PASS', '');

try {
    $GLOBALS['pdo'] = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER, DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage(), 3, LOGS_PATH . 'db.log');
    $GLOBALS['pdo'] = null;
}
?>