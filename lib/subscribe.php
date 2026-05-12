<?php
// Unsubscribe token
function generateUnsubscribeToken($subscriber_id) {
    $pdo     = $GLOBALS['pdo'];
    $token   = bin2hex(random_bytes(32));
    $expires = date("Y-m-d H:i:s", strtotime("+5 years"));
    $stmt    = $pdo->prepare("UPDATE subscribers SET unsubscribe_token = ?, token_expires = ? WHERE id = ?");
    $stmt->execute([$token, $expires, $subscriber_id]);
    return $token;
}