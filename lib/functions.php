<?php
if (!function_exists('autoload_core')) {
    function autoload_core() {
        $dir = __DIR__;
        foreach (['', '../', '../../'] as $level) {
            $setup = $dir.'/'.$level.'setup.php';
            $conf = $dir.'/'.$level.'config.php';
            if (file_exists($setup)) require_once $setup;
            if (file_exists($conf)) require_once $conf;
        }
    }
}
// generate subscriber token
function generateUnsubscribeToken($pdo, $subscriber_id) {
    $token = bin2hex(random_bytes(32)); // 64 char
    $expires = date('Y-m-d H:i:s', strtotime('+5 years')); // 30 hari valid
    
    $stmt = $pdo->prepare("UPDATE subscribers SET unsubscribe_token = ?, token_expires = ? WHERE id = ?");
    $stmt->execute([$token, $expires, $subscriber_id]);
    
    return $token;
}
// Saat user subscribe baru, panggil:
// generateUnsubscribeToken($pdo, $new_subscriber_id);
?>