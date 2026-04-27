<?php
$lib_path = dirname(__DIR__) . '/lib/functions.php';
if (!file_exists($lib_path)) die('lib/functions.php missing: ' . $lib_path);
require_once $lib_path;
autoload_core();
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit('Redirecting...');
}

// Pastikan PDO connection ada
if (!isset($pdo)) {
    die('Database connection missing!');
}

// Proses kirim newsletter
if (isset($_POST['send_newsletter'])) {
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    
    if ($subject && $message) {
        // 1. Simpan draft ke database dulu
        $stmt = $pdo->prepare("INSERT INTO newsletters (subject, message, total_recipients, status) VALUES (?, ?, 0, 'draft')");
        $stmt->execute([$subject, $message]);
        $newsletter_id = $pdo->lastInsertId();
        
        // 2. Kirim email ke subscribers
        $stmt = $pdo->query('SELECT id, email FROM subscribers WHERE status = "active"');
        $sent = 0; $total = 0;
        
        while ($sub = $stmt->fetch()) {
            // Generate token unsubscribe
            $unsubscribe_token = generateUnsubscribeToken($pdo, $sub['id']);
            
            // MODERN EMAIL TEMPLATE
            $html_message = '
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . htmlspecialchars($subject) . '</title>
</head>
<body style="margin:0;padding:0;background:#0f172a;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,\'Helvetica Neue\',Arial,sans-serif">
    <div style="max-width:600px;margin:0 auto;background:#0f172a">
        <!-- Header Hero -->
        <div style="background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);padding:40px 30px;text-align:center">
            <h1 style="color:white;margin:0;font-size:28px;font-weight:700;letter-spacing:-0.5px">📩 Ayoke Bandung</h1>
            <p style="color:#e2e8f0;margin:8px 0 0;font-size:16px">Update terbaru untuk Anda</p>
        </div>
        
        <!-- Main Content -->
        <div style="background:white;padding:40px 30px">
            <!-- Subject -->
            <div style="border-left:4px solid #667eea;padding-left:20px;margin-bottom:30px">
                <h2 style="color:#1e293b;margin:0;font-size:24px;font-weight:600">' . htmlspecialchars($subject) . '</h2>
                <p style="color:#64748b;margin:8px 0 0;font-size:14px">Dikirim pada ' . date('d M Y, H:i') . '</p>
            </div>
            
            <!-- Message Content -->
            <div style="line-height:1.7;color:#1e293b;font-size:16px;margin-bottom:30px">
                ' . nl2br(htmlspecialchars($message)) . '
            </div>
            
            <!-- CTA Button (Optional - bisa ditambahkan) -->
            <div style="text-align:center;margin:30px 0">
                <a href="https://ayokebandung.id" style="display:inline-block;padding:16px 32px;background:linear-gradient(135deg,#667eea,#764ba2);color:white;text-decoration:none;border-radius:12px;font-weight:600;font-size:16px;box-shadow:0 8px 25px rgba(102,126,234,0.3)">🔥 Lihat Sekarang</a>
            </div>
        </div>
        
        <!-- Footer -->
        <div style="background:#1e293b;padding:30px 30px 20px;color:#94a3b3;font-size:14px;line-height:1.6">
            <div style="max-width:500px;margin:0 auto;text-align:center">
                <p style="margin:0 0 16px">© ' . date('Y') . ' Ayoke Bandung. Semua hak dilindungi.</p>
                <p style="margin:0 0 20px">
                    <a href="https://ayokebandung.id" style="color:#cbd5e1;text-decoration:none">🌐 ayokebandung.id</a> | 
                    <a href="mailto:noreply@ayokebandung.id" style="color:#cbd5e1;text-decoration:none">📧 Kontak</a>
                </p>
                <hr style="border:none;height:1px;background:#334155;margin:0 0 20px">
                <p style="margin:0 0 8px;font-size:13px">
                    <strong>Anda menerima email ini karena sudah berlangganan newsletter kami.</strong>
                </p>
                <p style="margin:0;font-size:13px">
                    <a href="https://ayokebandung.id/unsubscribe.php?token=' . urlencode($unsubscribe_token) . '" style="color:#60a5fa;text-decoration:underline;font-weight:500">❌ Berhenti berlangganan</a> | 
                    <a href="https://ayokebandung.id/privacy" style="color:#60a5fa;text-decoration:underline;font-weight:500">🔒 Privasi</a>
                </p>
            </div>
        </div>
        
        <!-- Spacer -->
        <div style="height:40px;background:#0f172a"></div>
    </div>
</body>
</html>';

            // Email headers yang benar
            $headers = "MIME-Version: 1.0\r\n" .
                      "From: Ayoke Bandung <noreply@ayokebandung.id>\r\n" .
                      "Reply-To: noreply@ayokebandung.id\r\n" .
                      "X-Mailer: PHP/" . phpversion() . "\r\n" .
                      "Content-Type: text/html; charset=UTF-8\r\n";
            
            if (mail($sub['email'], $subject, $html_message, $headers)) {
                $sent++;
            }
            $total++;
            usleep(200000); // Rate limiting 5 email/detik
        }
        
        // 3. Update database dengan hasil final
        $stmt = $pdo->prepare("UPDATE newsletters SET total_recipients = ?, sent_recipients = ?, status = 'sent', sent_at = NOW() WHERE id = ?");
        $stmt->execute([$total, $sent, $newsletter_id]);
        
        $_SESSION['newsletter_success'] = "Newsletter berhasil terkirim ke <strong>$sent/$total</strong> subscribers. <a href='#history' style='color:#fff;font-weight:600'>Lihat Riwayat →</a>";
        header('Location: ' . $_SERVER['PHP_SELF'] . '#history');
        exit;
    } else {
        $_SESSION['newsletter_error'] = 'Subject & pesan tidak boleh kosong!';
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Hitung statistik subscribers
$total_active = $pdo->query("SELECT COUNT(*) FROM subscribers WHERE status='active'")->fetchColumn();
$total_unsub = $pdo->query("SELECT COUNT(*) FROM subscribers WHERE status='unsubscribed'")->fetchColumn();
$total_deleted = $pdo->query("SELECT COUNT(*) FROM subscribers WHERE status='deleted'")->fetchColumn();
$total_all = $pdo->query("SELECT COUNT(*) FROM subscribers")->fetchColumn();

// Filter subscribers - FIXED SQL INJECTION
$active_filter = isset($_GET['status']) ? $_GET['status'] : 'active';
$status_map = [
    'active' => ['status = ?', ['active']],
    'unsubscribed' => ['status = ?', ['unsubscribed']], 
    'deleted' => ['status = ?', ['deleted']],
    'all' => ['1=1', []]
];
$filter_config = $status_map[$active_filter] ?? $status_map['active'];

$stmt = $pdo->prepare("SELECT * FROM subscribers WHERE " . $filter_config[0] . " ORDER BY unsubscribed_at DESC, subscribed_at DESC LIMIT 50");
$stmt->execute($filter_config[1]);
$subscribers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fix total_subs berdasarkan filter
$status_counts = [
    'active' => $total_active,
    'unsubscribed' => $total_unsub,
    'deleted' => $total_deleted,
    'all' => $total_all
];
$total_subs = $status_counts[$active_filter] ?? $total_all;

// Ambil data newsletters
$newsletters_stmt = $pdo->query('SELECT * FROM newsletters ORDER BY sent_at DESC LIMIT 10');
$newsletters = $newsletters_stmt->fetchAll(PDO::FETCH_ASSOC);

// Delete subscriber
if (isset($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("UPDATE subscribers SET status = 'deleted' WHERE id = ? AND status = 'active'");
    if ($stmt->execute([$delete_id])) {
        $_SESSION['newsletter_success'] = "Subscriber berhasil dihapus!";
    } else {
        $_SESSION['newsletter_error'] = "Gagal menghapus subscriber!";
    }
    header('Location: ' . $_SERVER['PHP_SELF'] . '#subscribers');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Newsletter - Ayoke Bandung</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<style>
:root{--p:#667eea;--s:#64748b;--bg:#f8fafc;--card:#fff;--sh:0 4px 20px rgba(0,0,0,.08);--radius:16px}*{margin:0;padding:0;box-sizing:border-box}body{font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif;background:var(--bg);color:#1e293b;line-height:1.6;min-height:100vh;padding:20px}@media (min-width:768px){body{padding:40px}}.container{max-width:1200px;margin:0 auto;padding:0 16px}.section{background:var(--card);border-radius:var(--radius);box-shadow:var(--sh);margin-bottom:24px;overflow:hidden}.section-header{padding:24px;background:linear-gradient(135deg,var(--p),#764ba2);color:#fff}.section-header h2{font-size:24px;font-weight:600;margin:0;display:flex;align-items:center;gap:12px}.section-header p{margin:4px 0 0;font-size:14px;opacity:.95}.content{padding:32px}@media (max-width:768px){.content{padding:24px}}.form-group{margin-bottom:24px}.form-label{font-size:14px;font-weight:600;color:#475569;margin-bottom:8px;display:flex;align-items:center;gap:8px}.form-control{width:100%;padding:14px 16px;border:2px solid #e2e8f0;border-radius:12px;font-size:16px;transition:all .2s;font-family:inherit;box-sizing:border-box}.form-control:focus{outline:0;border-color:var(--p);box-shadow:0 0 0 3px rgba(102,126,234,.1)}.form-control::placeholder{color:#94a3b8}.btn-send{width:100%;padding:16px 24px;background:linear-gradient(135deg,var(--p),#764ba2);color:#fff;border:0;border-radius:12px;font-size:16px;font-weight:600;cursor:pointer;transition:all .2s;display:flex;align-items:center;justify-content:center;gap:8px;box-shadow:0 4px 14px rgba(102,126,234,.3);font-family:inherit}@media (min-width:480px){.btn-send{width:auto}}.btn-send:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(102,126,234,.4)}.btn-send:active{transform:translateY(0)}.table-responsive{overflow-x:auto;margin-top:16px}.table{width:100%;border-collapse:collapse;font-size:14px}.table th{padding:16px 12px;background:#f1f5f9;color:#475569;font-weight:600;text-align:left;border-bottom:2px solid #e2e8f0}.table td{padding:16px 12px;border-bottom:1px solid #f1f5f9}.table-danger{background:#fef2f2}.badge{display:inline-block;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600}.badge-primary{background:#dbeafe;color:#1e40af}.badge-success{background:#d1fae5;color:#166534}.badge-info{background:#bae6fd;color:#0e7490}.badge-warning{background:#fef3c7;color:#92400e}.badge-danger{background:#fecaca;color:#991b1b}.badge-secondary{background:#f1f5f9;color:#64748b}.btn-delete{padding:8px 16px;background:#ef4444;color:#fff;border:0;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;transition:.2s;text-decoration:none;display:inline-flex;align-items:center;gap:6px}.btn-delete:hover{background:#dc2626;transform:translateY(-1px)}.stats{display:flex;gap:16px;margin:24px 0;flex-wrap:wrap}@media (max-width:480px){.stats{flex-direction:column;gap:12px}}.stat-card{background:var(--card);padding:24px;border-radius:var(--radius);box-shadow:var(--sh);flex:1;min-width:200px;text-align:center;border:1px solid #f1f5f9;transition:transform .2s}.stat-card:hover{transform:translateY(-4px)}.stat-number{font-size:36px;font-weight:700;color:var(--p);margin-bottom:8px}.stat-label{color:#64748b;font-size:14px;font-weight:500}.empty-state{padding:60px 40px;text-align:center;color:#64748b}@media (max-width:480px){.empty-state{padding:40px 20px}}.empty-icon{font-size:64px;margin-bottom:16px;opacity:.5}.alert{position:relative;padding:16px 20px;margin-bottom:24px;border-radius:12px;font-weight:500;display:flex;align-items:center;gap:12px;animation:slideIn .3s ease;max-width:800px;margin-left:auto;margin-right:auto}.alert-success{background:#d1fae5;border:1px solid #a7f3d0;color:#166534}.alert-danger{background:#fee2e2;border:1px solid #fecaca;color:#991b1b}.alert a{color:#059669;font-weight:600;text-decoration:none}.alert a:hover{text-decoration:underline}@keyframes slideIn{from{opacity:0;transform:translateY(-10px)}to{opacity:1;transform:translateY(0)}}@media (max-width:768px){.container{padding:0 16px}.section{margin-bottom:20px}.stats{flex-direction:column}}
</style>
</head>

 <?php
 include 'includes/header.php';
 ?>
 
<div class="container">

<?php
// Notifikasi session
if (isset($_SESSION['newsletter_success'])) {
    echo '<div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            ' . $_SESSION['newsletter_success'] . '
          </div>';
    unset($_SESSION['newsletter_success']);
}
if (isset($_SESSION['newsletter_error'])) {
    echo '<div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            ' . $_SESSION['newsletter_error'] . '
          </div>';
    unset($_SESSION['newsletter_error']);
}
?>

<!-- Newsletter Sender -->
<div class="section">
<div class="section-header">
<h2><i class="fas fa-paper-plane"></i> Kirim Newsletter</h2>
<p><strong>Kirim ke <?php echo number_format($total_active); ?> subscribers aktif</strong></p>
</div>
<div class="content">
<form method="POST">
<div class="form-group">
<label class="form-label"><i class="fas fa-tag"></i> Subject</label>
<input type="text" class="form-control" name="subject" placeholder="Promo Spesial 50% OFF Semua Produk!" required>
</div>
<div class="form-group">
<label class="form-label"><i class="fas fa-edit"></i> Pesan</label>
<textarea class="form-control" name="message" rows="6" placeholder="Tulis pesan newsletter Anda disini...&#10;&#10;Gunakan format sederhana, HTML akan otomatis diterapkan." required></textarea>
</div>
<button type="submit" name="send_newsletter" class="btn-send">
<i class="fas fa-rocket"></i> 🚀 Kirim Sekarang
</button>
</form>
</div>
</div>

<!-- Stats Cards -->
<div class="stats">
<div class="stat-card">
<div class="stat-number" style="color:#10b981"><?php echo number_format($total_active); ?></div>
<div class="stat-label">✅ Subscribers Aktif</div>
</div>
<div class="stat-card">
<div class="stat-number"><?php echo number_format($total_all); ?></div>
<div class="stat-label">📊 Total Subscribers</div>
</div>
<div class="stat-card">
<div class="stat-number"><?php echo count($newsletters); ?></div>
<div class="stat-label">📬 Newsletter Terkirim</div>
</div>
</div>

<!-- Riwayat Newsletter -->
<div class="section" id="history">
<div class="section-header">
<h2><i class="fas fa-history"></i> Riwayat Newsletter</h2>
<p>📋 Riwayat pengiriman newsletter terakhir 10x</p>
</div>
<div class="content">
<?php if (count($newsletters) > 0): ?>
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<th>ID</th>
<th>Subject</th>
<th>Status</th>
<th>Penerima</th>
<th>Tanggal</th>
</tr>
</thead>
<tbody>
<?php foreach ($newsletters as $nl): ?>
<tr>
<td><span class="badge badge-primary">#<?php echo $nl['id']; ?></span></td>
<td>
<div style="max-width:300px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?php echo htmlspecialchars($nl['subject']); ?>">
<?php echo htmlspecialchars($nl['subject']); ?>
</div>
</td>
<td>
<?php if ($nl['status'] == 'sent'): ?>
<span class="badge badge-success"><?php echo $nl['sent_recipients']; ?>/<?php echo $nl['total_recipients']; ?> Terkirim</span>
<?php else: ?>
<span class="badge badge-danger">Draft</span>
<?php endif; ?>
</td>
<td><?php echo number_format($nl['total_recipients']); ?></td>
<td><?php echo date('d/m/Y H:i', strtotime($nl['sent_at'] ?? 'now')); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<?php else: ?>
<div class="empty-state">
<i class="fas fa-clock empty-icon"></i>
<h3>Belum ada newsletter yang dikirim</h3>
<p>Kirim newsletter pertama Anda sekarang!</p>
</div>
<?php endif; ?>
</div>
</div>

<!-- Subscribers Table -->
<div class="section" id="subscribers">
<div class="section-header">
<h2><i class="fas fa-users"></i> Daftar Subscribers</h2>
<p style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;font-size:13px;">
    <a href="?status=active#subscribers" class="badge badge-primary <?php echo $active_filter=='active' ? 'badge-success' : ''; ?>">✅ Aktif (<?php echo number_format($total_active); ?>)</a>
    <a href="?status=unsubscribed#subscribers" class="badge badge-warning <?php echo $active_filter=='unsubscribed' ? 'badge-success' : ''; ?>">❌ Unsubscribe (<?php echo number_format($total_unsub); ?>)</a>
    <a href="?status=deleted#subscribers" class="badge badge-danger <?php echo $active_filter=='deleted' ? 'badge-success' : ''; ?>">🗑️ Dihapus (<?php echo number_format($total_deleted); ?>)</a>
    <a href="?status=all#subscribers" class="badge badge-secondary <?php echo $active_filter=='all' ? 'badge-success' : ''; ?>">📊 Semua (<?php echo number_format($total_all); ?>)</a>
</p>
</div>
<div class="content">
<?php if (count($subscribers) > 0): ?>
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<th style="width:80px">ID</th>
<th>Email</th>
<th style="width:100px">Status</th>
<th style="width:140px">Tanggal</th>
<th style="width:120px">Aksi</th>
</tr>
</thead>
<tbody>
<?php foreach ($subscribers as $sub): ?>
<tr <?php echo $sub['status'] != 'active' ? 'class="table-danger"' : ''; ?>>
<td><span class="badge badge-primary">#<?php echo $sub['id']; ?></span></td>
<td>
<i class="fas fa-envelope text-muted me-2" style="width:16px"></i>
<?php echo htmlspecialchars($sub['email']); ?>
</td>
<td>
<?php if ($sub['status'] == 'active'): ?>
<span class="badge badge-success">✅ Aktif</span>
<?php elseif ($sub['status'] == 'unsubscribed'): ?>
<span class="badge badge-warning">❌ Unsubscribe</span>
<?php else: ?>
<span class="badge badge-danger">🗑️ Dihapus</span>
<?php endif; ?>
</td>
<td>
<?php if ($sub['status'] == 'active'): ?>
<span class="badge badge-info"><?php echo date('d/m/Y', strtotime($sub['subscribed_at'])); ?></span>
<?php else: ?>
<span class="badge badge-secondary"><?php echo date('d/m/Y H:i', strtotime($sub['unsubscribed_at'] ?? $sub['subscribed_at'])); ?></span>
<?php endif; ?>
</td>
<td>
<?php if ($sub['status'] == 'active'): ?>
<a href="?delete=<?php echo $sub['id']; ?>&status=<?php echo urlencode($active_filter); ?>#subscribers" 
class="btn-delete" 
onclick="return confirm('Hapus <?php echo htmlspecialchars($sub['email']); ?> dari daftar?\n\nEmail ini tidak akan menerima newsletter lagi.');">
<i class="fas fa-trash"></i> Hapus
</a>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<?php else: ?>
<div class="empty-state">
<i class="fas fa-users-slash empty-icon"></i>
<h3>Tidak ada subscribers</h3>
<p><?php echo ucfirst(str_replace('_', ' ', $active_filter)); ?> subscribers kosong</p>
</div>
<?php endif; ?>
</div>
</div>

</div>

 <?php
 include 'includes/footer.php';
 ?>