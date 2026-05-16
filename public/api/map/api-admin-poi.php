<?php
require_once dirname(__DIR__, 3) . '/bootstrap.php';
autoload_core();
require_once LIB_PATH . 'poi-actions.php';
header('Content-Type: application/json');

if (!isset($_SESSION['admin_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

verify_ajax_request('POST');
validate_csrf();

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'add':
        $result = add_poi($_POST);
        if ($result) {
            echo json_encode(['success' => true, 'poi_id' => $result, 'message' => 'Lokasi berhasil ditambahkan!']);
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Nama, kategori, dan koordinat wajib diisi']);
        }
        break;

    case 'delete':
        $id     = (int)($_POST['poi_id'] ?? 0);
        $result = delete_poi($id);
        if ($result === false) {
            http_response_code(409);
            echo json_encode(['success' => false, 'message' => 'Lokasi ini dipakai di trip planner, tidak bisa dihapus']);
        } elseif ($result) {
            echo json_encode(['success' => true, 'message' => 'Lokasi berhasil dihapus']);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Lokasi tidak ditemukan']);
        }
        break;

    case 'toggle':
        $id     = (int)($_POST['poi_id'] ?? 0);
        $result = toggle_poi_status($id);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Status berhasil diubah']);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Lokasi tidak ditemukan']);
        }
        break;

    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Action tidak valid']);
}