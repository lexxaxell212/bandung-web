<?php
$lib_path = dirname(__DIR__) . '/lib/functions.php';
if (!file_exists($lib_path)) die('lib/functions.php missing: ' . $lib_path);
require_once $lib_path;
autoload_core();
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true) ?: $_POST;

if (!isset($data['consent_given'])) {
    echo json_encode(['error' => 'Missing consent data']);
    exit;
}

$pdo = $GLOBALS['pdo'];

// Simpan consent
$stmt = $pdo->prepare("
    INSERT INTO user_consents 
    (session_id, consent_given, categories, ip_address, user_agent) 
    VALUES (?, ?, ?, ?, ?)
");
$stmt->execute([
    session_id(),
    $data['consent_given'],
    json_encode($data['categories'] ?? []),
    $_SERVER['REMOTE_ADDR'],
    $_SERVER['HTTP_USER_AGENT'] ?? ''
]);

// Set cookies (1 tahun)
$expire = time() + 365 * 24 * 3600;
setcookie('consent_accepted', $data['consent_given'] ? '1' : '0', $expire, '/', '', true, true);
setcookie('consent_categories', json_encode($data['categories'] ?? []), $expire, '/', '', true, true);

echo json_encode([
    'success' => true,
    'message' => 'Consent saved',
    'cookies_set' => ['consent_accepted', 'consent_categories']
]);
?>