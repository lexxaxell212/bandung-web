<?php
// Maintenance toggle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'toggle_maintenance') {
    validate_csrf();
    $current = $pdo->query("SELECT setting_value FROM admin_setting WHERE setting_key = 'maintenance_mode'")->fetchColumn();
    $newVal  = $current === '1' ? '0' : '1';
    $pdo->prepare("
        INSERT INTO admin_setting (setting_key, setting_value) VALUES ('maintenance_mode', :val)
        ON DUPLICATE KEY UPDATE setting_value = :val
    ")->execute([':val' => $newVal]);
    regenerate_csrf_token();
    header('Location: /admin/setting?saved=1');
    exit;
}