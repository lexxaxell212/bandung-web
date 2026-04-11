<?php
// send-feedback.php - 100% NATIVE PHP (No Library)
date_default_timezone_set('Asia/Jakarta');
header('Content-Type: application/json; charset=UTF-8');

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit(json_encode(['status' => 'error', 'message' => 'Hanya POST diperbolehkan']));
}

// Sanitize function
function sanitize($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Get & sanitize input
$input = [
    'nama' => sanitize($_POST['nama'] ?? ''),
    'email' => $_POST['email'] ?? '',
    'rating' => intval($_POST['rating'] ?? 5),
    'kategori' => sanitize($_POST['kategori'] ?? ''),
    'kritik' => sanitize($_POST['kritik'] ?? ''),
    'saran' => sanitize($_POST['saran'] ?? ''),
    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
    'user_agent' => substr($_SERVER['HTTP_USER_AGENT'] ?? 'unknown', 0, 100)
];

// Validation
$errors = [];
if (strlen($input['nama']) < 2) $errors[] = 'Nama minimal 2 karakter';
if (!validateEmail($input['email'])) $errors[] = 'Format email salah';
if (empty($input['kritik'])) $errors[] = 'Kritik wajib diisi';
if (empty($input['saran'])) $errors[] = 'Saran wajib diisi';
if ($input['rating'] < 1 || $input['rating'] > 10) $errors[] = 'Rating harus 1-10';

if (!empty($errors)) {
    http_response_code(400);
    exit(json_encode(['status' => 'error', 'message' => implode(' | ', $errors)]));
}

// Email Configuration
$to_email = 'lexxaxell@gmail.com';           // ⭐ GANTI INI
$from_email = 'no-reply@bdgkt.web.id'; // Domain Anda
$subject = '📝 Feedback Baru Website Feedback - ' . $input['nama'];

// Dynamic rating styling
$rating_bg = $input['rating'] >= 8 ? '#d4edda' : ($input['rating'] >= 6 ? '#fff3cd' : '#f8d7da');
$rating_color = $input['rating'] >= 8 ? '#155724' : ($input['rating'] >= 6 ? '#856404' : '#721c24');

// HTML Email Template
$html_body = "
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Feedback Baru - Website Feedback</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #0d6efd, #0a58ca); color: white; padding: 2rem; text-align: center; border-radius: 15px; margin-bottom: 2rem; }
        .profile { background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin-bottom: 1.5rem; }
        .kritik { background: #fff3cd; border-left: 5px solid #ffc107; padding: 1.5rem; border-radius: 8px; margin: 1.5rem 0; }
        .saran { background: #e7f3ff; border-left: 5px solid #0d6efd; padding: 1.5rem; border-radius: 8px; margin: 1.5rem 0; }
        .meta { background: #f8f9fa; padding: 1.5rem; border-radius: 8px; font-size: 0.9rem; color: #6c757d; }
        .rating-badge { padding: 0.5rem 1rem; border-radius: 25px; font-weight: bold; font-size: 1.1rem; }
        table { width: 100%; border-collapse: collapse; margin: 1rem 0; }
        th, td { padding: 0.75rem 0; text-align: left; }
        th { font-weight: 600; color: #0d6efd; }
        small { opacity: 0.7; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1 style='margin: 0;'>📝 FEEDBACK BARU</h1>
            <p style='margin: 0.5rem 0 0 0; opacity: 0.95;'>Website Feedback System</p>
        </div>

        <div class='profile'>
            <h3 style='margin-top: 0; color: #0d6efd; border-bottom: 3px solid #0d6efd; padding-bottom: 1rem;'>
                👤 {$input['nama']}
            </h3>
            <table>
                <tr><th>Email:</th><td style='color: #0d6efd; font-weight: 500;'>{$input['email']}</td></tr>
                <tr><th>Rating:</th><td><span class='rating-badge' style='background: {$rating_bg}; color: {$rating_color};'>{$input['rating']}/10</span></td></tr>
                <tr><th>Kategori:</th><td><strong>" . ucfirst($input['kategori']) . "</strong></td></tr>
            </table>
        </div>

        <div class='kritik'>
            <h4 style='margin-top: 0; color: #856404;'>
                <i style='margin-right: 8px;'>&#x26A0;&#xFE0F;</i>KRITIK & KEKURANGAN
            </h4>
            <div style='white-space: pre-wrap;'>" . nl2br($input['kritik']) . "</div>
        </div>

        <div class='saran'>
            <h4 style='margin-top: 0; color: #0c5460;'>
                <i style='margin-right: 8px;'>&#x1F4A1;</i>SARAN PERBAIKAN
            </h4>
            <div style='white-space: pre-wrap;'>" . nl2br($input['saran']) . "</div>
        </div>

        <div class='meta'>
            <strong>📊 Meta Data:</strong><br>
            IP Address: <code>{$input['ip']}</code><br>
            Browser: <code>" . htmlspecialchars($input['user_agent']) . "</code><br>
            <strong>Diterima:</strong> <em>" . date('d M Y H:i:s') . "</em>
        </div>

        <div style='text-align: center; margin-top: 2rem; padding-top: 1.5rem; border-top: 2px solid #e9ecef; color: #6c757d; font-size: 0.9rem;'>
            🚀 Auto-generated by Website Feedback System<br>
            <small>Native PHP Mailer • No External Dependencies</small>
        </div>
    </div>
</body>
</html>";

// Headers untuk HTML email
$headers = [
    "MIME-Version: 1.0",
    "Content-Type: text/html; charset=UTF-8",
    "From: Website Feedback <no-reply@websitefeedback.com>",
    "Reply-To: {$input['email']} ({$input['nama']})",
    "X-Mailer: PHP/" . phpversion(),
    "X-Priority: 1 (Highest)"
];

// Kirim email
$email_sent = mail($to_email, $subject, $html_body, implode("\r\n", $headers));

if ($email_sent) {
    // Log ke file (backup & analytics)
    $log_entry = sprintf(
        "[%s] %s | %s | Rating: %d/%d | %s | IP: %s\n",
        date('Y-m-d H:i:s'),
        $input['nama'],
        $input['email'],
        $input['rating'],
        10,
        substr($input['kategori'], 0, 20),
        $input['ip']
    );
    
    // Simpan log (chmod 666 feedback.log)
    @file_put_contents('feedback.log', $log_entry, FILE_APPEND | LOCK_EX);
    
    // Response sukses JSON
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'message' => '✅ Feedback berhasil dikirim ke developer!',
        'data' => [
            'nama' => $input['nama'],
            'rating' => $input['rating'],
            'kategori' => ucfirst($input['kategori']),
            'timestamp' => date('d M Y H:i')
        ]
    ]);
} else {
    // Log error
    error_log("FEEDBACK MAIL FAILED: " . print_r($input, true));
    
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => '❌ Gagal kirim email. Silakan coba lagi atau hubungi admin@websitefeedback.com'
    ]);
}
?>