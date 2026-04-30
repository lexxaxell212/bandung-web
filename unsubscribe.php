<?php
require_once 'lib/functions.php';
autoload_core();

if (!isset($_GET['token']) || empty($_GET['token'])) {
    $status = "error";
    $message = "❌ Token tidak ditemukan.";
} else {
    $token = trim($_GET['token']);
    
    // Cari subscriber by token
    $stmt = $pdo->prepare("SELECT id, email, status, token_expires FROM subscribers WHERE unsubscribe_token = ? AND status = 'active'");
    $stmt->execute([$token]);
    $subscriber = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$subscriber) {
        $status = "error";
        $message = "❌ Token tidak valid atau sudah dipakai.";
    } else {
        // Cek expiry
        $now = date('Y-m-d H:i:s');
        $is_expired = $subscriber['token_expires'] && $subscriber['token_expires'] < $now;
        
        if ($is_expired) {
            $status = "expired";
            $message = "⚠️ Token kadaluarsa (" . date('d M Y', strtotime($subscriber['token_expires'])) . ").<br>
                       <strong>Status Anda masih aktif.</strong><br><br>
                       <a href='https://ayokebandung.id/subscribe.php?email=" . urlencode($subscriber['email']) . "&action=renew' style='color:#3b82f6'>🔄 Perbarui Token</a>";
        } else {
            // UNSUBSCRIBE!
            $stmt = $pdo->prepare("UPDATE subscribers SET status = 'unsubscribed', unsubscribed_at = NOW(), unsubscribe_token = NULL, token_expires = NULL WHERE id = ?");
            $result = $stmt->execute([$subscriber['id']]);
            
            if ($result) {
                // Kirim email konfirmasi
                $to_email = $subscriber['email'];
                $subject = "✅ Berhasil Unsubscribe - Ayoke Bandung";
                
                $message_html = "
                <html>
                <body style='font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, sans-serif; line-height: 1.6; color: #374151; max-width: 600px; margin: 0 auto; padding: 20px; background: #f9fafb;'>
                    <div style='background: white; margin: 20px 0; padding: 40px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); text-align: center;'>
                        <div style='font-size: 64px; color: #10b981; margin-bottom: 20px;'>✅</div>
                        <h1 style='font-size: 28px; font-weight: 700; color: #1f2937; margin-bottom: 16px;'>Unsubscribe Berhasil!</h1>
                        <p style='font-size: 18px; margin-bottom: 24px;'>
                            Anda telah <strong>berhasil keluar</strong> dari newsletter Ayoke Bandung.
                        </p>
                        <div style='background: #f3f4f6; padding: 16px; border-radius: 12px; margin: 24px 0;'>
                            <strong>📧 Email:</strong> " . htmlspecialchars($to_email) . "<br>
                            <strong>⏰ Waktu:</strong> " . date('d M Y H:i') . "
                        </div>
                        <p style='color: #6b7280; font-size: 14px;'>
                            Token unsubscribe telah dihapus untuk keamanan.
                        </p>
                        <hr style='margin: 30px 0; border: none; height: 1px; background: #e5e7eb;'>
                        <p style='color: #9ca3af; font-size: 14px;'>
                            © " . date('Y') . " Ayokebandung.id<br>
                            <a href='https://ayokebandung.id' style='color: #ccc; text-decoration: none;'>← Kembali ke Website</a>
                        </p>
                    </div>
                </body>
                </html>";
                
                $headers = [
                    'MIME-Version: 1.0',
                    'From: Ayoke Bandung <noreply@ayokebandung.id>',
                    'Reply-To: noreply@ayokebandung.id',
                    'Content-Type: text/html; charset=UTF-8',
                    'X-Mailer: PHP/' . phpversion()
                ];
                
                mail($to_email, $subject, $message_html, implode("\r\n", $headers));
                
                $status = "success";
                $message = "✅ Berhasil unsubscribe!<br>Email konfirmasi terkirim ke <strong>" . htmlspecialchars($subscriber['email']) . "</strong>";
            } else {
                $status = "error";
                $message = "❌ Gagal memproses unsubscribe.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($status ?? 'error') == 'success' ? 'Unsubscribe Berhasil' : 'Unsubscribe'; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:system-ui,-apple-system,sans-serif;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;line-height:1.6}
        .container{max-width:500px;width:100%;background:white;border-radius:20px;box-shadow:0 20px 40px rgba(0,0,0,0.1);overflow:hidden}
        .header{padding:40px 30px;text-align:center;background:linear-gradient(135deg,#4facfe 0%,#00f2fe 100%);color:white}
        .header i{font-size:64px;margin-bottom:16px;opacity:0.9}
        .header h1{font-size:28px;font-weight:700;margin-bottom:8px}
        .content{padding:40px 30px;text-align:center}
        .status-icon{font-size:72px;margin-bottom:24px}
        .success .status-icon{color:#10b981}
        .error .status-icon{color:#ef4444}
        .expired .status-icon{color:#f59e0b}
        .message{font-size:18px;color:#374151;margin-bottom:24px;line-height:1.6}
        .btn-group{display:flex;gap:12px;justify-content:center;flex-wrap:wrap;margin-top:24px}
        .btn{display:inline-block;padding:14px 24px;border-radius:12px;font-weight:600;font-size:16px;text-decoration:none;transition:all 0.3s;text-align:center;min-width:140px}
        .btn-primary{background:linear-gradient(135deg,#4facfe 0%,#00f2fe 100%);color:white;box-shadow:0 4px 14px rgba(79,172,254,0.4)}
        .btn-secondary{background:#6b7280;color:white}
        .btn:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(0,0,0,0.2)}
        a{color:#3b82f6;text-decoration:none;font-weight:600}
        a:hover{text-decoration:underline}
        @media (max-width:480px){.container{margin:10px;border-radius:16px}.header,.content{padding:30px 20px}.btn-group{flex-direction:column}}
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <i class="fas fa-envelope-open"></i>
            <h1>Newsletter</h1>
            <p>Ayoke Bandung</p>
        </div>
        <div class="content <?php echo $status ?? 'error'; ?>">
            <div class="status-icon">
                <?php if ($status == 'success'): ?>
                    <i class="fas fa-check-circle"></i>
                <?php elseif ($status == 'expired'): ?>
                    <i class="fas fa-clock"></i>
                <?php else: ?>
                    <i class="fas fa-exclamation-triangle"></i>
                <?php endif; ?>
            </div>
            <div class="message"><?php echo $message ?? ''; ?></div>
            
            <?php if ($status == 'expired'): ?>
            <div class="btn-group">
                <a href="https://ayokebandung.id/subscribe.php?email=<?php echo urlencode($subscriber['email'] ?? ''); ?>&action=renew" class="btn btn-primary">
                    <i class="fas fa-redo"></i> Perbarui Token
                </a>
                <a href="https://ayokebandung.id" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Kembali
                </a>
            </div>
            <?php else: ?>
            <a href="https://ayokebandung.id" class="btn btn-primary">
                <i class="fas fa-home"></i> Kembali ke Website
            </a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>