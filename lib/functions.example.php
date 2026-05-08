<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

if (!function_exists("autoload_core")) {
  function autoload_core()
  {
    $dir = __DIR__;
    foreach (["", "../", "../../"] as $level) {
      $setup = $dir . "/" . $level . "setup.php";
      $conf = $dir . "/" . $level . "config.php";
      if (file_exists($setup)) {
        require_once $setup;
      }
      if (file_exists($conf)) {
        require_once $conf;
      }
    }
  }
}

// SESSION START AUTOMATICALLY
if (session_status() === PHP_SESSION_NONE) {
  session_start([
    "cookie_httponly" => true,
    "cookie_secure" => isset($_SERVER["HTTPS"]),
    "cookie_samesite" => "Lax",
  ]);
}

/**
 * FUNGSI SENTRAL KIRIM EMAIL (SMTP)
 * Pengganti fungsi mail() bawaan PHP
 */

function kirimEmailAyo($ke, $subjek, $pesan_html) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mail@gmail.com';
        $mail->Password   = 'pw'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('noreply@ayokebandung.id', 'Ayokebandung.id');
        $mail->addAddress($ke);

        $mail->isHTML(true);
        $mail->Subject = $subjek;
        $mail->Body    = $pesan_html;
        $mail->AltBody = strip_tags($pesan_html);

        return $mail->send();
    } catch (Exception $e) {
        return false;
    }
}


// Generate subscriber token
function generateUnsubscribeToken($pdo, $subscriber_id)
{
  $token = bin2hex(random_bytes(32)); 
  $expires = date("Y-m-d H:i:s", strtotime("+5 years"));

  $stmt = $pdo->prepare(
    "UPDATE subscribers SET unsubscribe_token = ?, token_expires = ? WHERE id = ?",
  );
  $stmt->execute([$token, $expires, $subscriber_id]);

  return $token;
}
?>
