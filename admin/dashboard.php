<?php
$lib_path = dirname(__DIR__) . '/lib/functions.php';
if (!file_exists($lib_path)) die('lib/functions.php missing: ' . $lib_path);
require_once $lib_path;
autoload_core();
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login');
    exit;
}
if (isset($_GET['clear'])) {
    header('Location: dashboard');
    exit;
}
?>

<?php
$total_subs = $pdo->query('SELECT COUNT(*) FROM subscribers')->fetchColumn();
$today_subs = $pdo->query("SELECT COUNT(*) FROM subscribers WHERE DATE(subscribed_at)=CURDATE()")->fetchColumn();
?>

<?php
include 'includes/header.php'; 
?>

<div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon stat-users">
                        </div>
                        <div class="stat-number"><?php echo number_format($total_subs); ?></div>
                        <div class="stat-label">Total Subscriber</div>
                        <div class="stat-change change-up">
                            <i class="fas fa-arrow-up"></i> Today + <?php echo $today_subs; ?>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon stat-users">
                            
                        </div>
                        <div class="stat-number">11,505</div>
                        <div class="stat-label">Total Pengunjung</div>
                        <div class="stat-change change-up">
                            <i class="fas fa-arrow-up"></i> Today +
                        </div>
                    </div>
                </div>
<div class="orders-section">
                    <div class="orders-header">
                        <h3><i class="fas fa-list"></i> Feedback terbaru</h3>
                    </div>
                    <div class="orders-grid">
                        <div class="order-card">
                            <div class="order-header">
                                <div class="order-id">#ORD001</div>
                            </div>
                            <div class="order-details">
                                <div>
                                    <span class="detail-label">Nama:</span
                                    ><span class="detail-value">John Doe</span>
                                </div>
                                <div>
                                    <span class="detail-label">Fedback:</span
                                    ><span class="detail-value"
                                        >Premium Plan</span
                                    >
                                </div>
                                <div>
                                    <span class="detail-label">Date:</span
                                    ><span class="detail-value"
                                        >2024-01-15</span
                                    >
                                </div>
                                <div>
                                    <span class="detail-label">Amount:</span
                                    ><span class="detail-value">$99.99</span>
                                </div>
                            </div>
                            <div class="order-actions">
                                <a href="#" class="action-btn btn-view"
                                    ><i class="fas fa-eye"></i>Actions</a
                                >
                            </div>
                        </div>
                    </div>
                </div>

<?php
include 'includes/footer.php'; 
?>