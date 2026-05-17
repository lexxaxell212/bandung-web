<?php
require_once dirname(__DIR__, 3) . "/bootstrap.php";
autoload_core();
$redirectout = $_SESSION['redirect_after_logout'] ?? '/';
unset($_SESSION['redirect_after_logout']);
session_destroy();
session_start();
$_SESSION['flash'] = ['type' => 'success', 'message' => 'Berhasil logout'];
header('Location: ' . $redirectout);
exit;