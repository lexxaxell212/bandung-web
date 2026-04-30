<?php
require_once 'lib/functions.php';
autoload_core();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$response = [
    'success' => false,
    'message' => '',
    'type' => 'error',
    'email_value' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email'])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    
    // Validasi 
    if (!isValidEmailDomain($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Email tidak valid atau domain tidak didukung!';
        $response['email_value'] = $_POST['email'];
    } else {
        // MAGIC 1 QUERY 
        $stmt = $pdo->prepare("
            INSERT INTO subscribers (email, status, subscribed_at) 
            VALUES (?, 'active', NOW())
            ON DUPLICATE KEY UPDATE 
                status = 'active', 
                subscribed_at = NOW(), 
                unsubscribe_token = NULL
        ");
        
        if ($stmt->execute([$email])) {
            // Selalu success
            $response['success'] = true;
            $response['message'] = 'Berhasil berlangganan newsletter!';
            $response['type'] = 'success';
            
            // Generate token 
            $subscriber_id = $pdo->lastInsertId();
            if ($subscriber_id) {
                generateUnsubscribeToken($pdo, $subscriber_id);
            }
        } else {
            $response['message'] = 'Gagal menyimpan data!';
        }
    }
}

echo json_encode($response);

// DOMAIN VALIDATION 
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
?>