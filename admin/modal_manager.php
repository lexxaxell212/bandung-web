<?php
$lib_path = dirname(__DIR__) . '/lib/functions.php';
if (!file_exists($lib_path)) die('lib/functions.php missing: ' . $lib_path);
require_once $lib_path;
autoload_core();
session_start();

if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$pdo = $GLOBALS['pdo'] ?? null;
if (!$pdo) die('Database gagal!');

// 🔥 PREDEFINED CATEGORIES
$categories = [
    'general' => 'Umum',
    'produk' => 'Produk',
    'layanan' => 'Layanan',
    'promo' => 'Promo',
    'portfolio' => 'Portfolio',
    'team' => 'Tim',
    'testimonial' => 'Testimoni',
    'blog' => 'Blog',
    'event' => 'Event'
];

// UPLOAD DIR
$upload_dir = '../assets/images/cards/';
if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

// IMAGE UPLOAD
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $target_file = $upload_dir . time() . '_' . basename($_FILES['image']['name']);
    $ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    if (!in_array($ext, ['jpg','jpeg','png','gif','webp']) || $_FILES['image']['size'] > 5000000) {
        echo json_encode(['success' => false, 'error' => 'Format/size salah!']);
        exit;
    }
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        echo json_encode(['success' => true, 'path' => 'cards/' . basename($target_file)]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Upload gagal']);
    }
    exit;
}

// DATA - FIXED IMAGE PATH
$stmt = $pdo->query("SELECT * FROM admin_items WHERE status = 'active' ORDER BY id DESC");
$items = $stmt->fetchAll();
foreach ($items as &$item) {
    $item['title'] ??= 'Tanpa Judul';
    $item['image'] ??= 'default.jpg';
    $item['excerpt'] ??= '';
    $item['button_link'] ??= '#';
    $item['type'] ??= 'card';
    $item['category'] ??= 'general';
}
unset($item);

// FORM PROCESS
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_FILES['image'])) {
    $action = $_POST['action'] ?? '';
    try {
        if ($action === 'create') {
            $title = trim($_POST['title'] ?? '');
            if (empty($title)) throw new Exception('Judul wajib!');
            $pdo->prepare("INSERT INTO admin_items (title, image, excerpt, button_link, type, category, status) VALUES (?, ?, ?, ?, ?, ?, 'active')")
                ->execute([ 
                    $title, 
                    $_POST['image'] ?? 'default.jpg', 
                    $_POST['excerpt'] ?? '', 
                    $_POST['button_link'] ?? '#', 
                    $_POST['type'] ?? 'card',
                    $_POST['category'] ?? 'general'
                ]);
        } elseif ($action === 'update') {
            $id = (int)$_POST['id'];
            $pdo->prepare("UPDATE admin_items SET title=?, image=?, excerpt=?, button_link=?, type=?, category=?, status=? WHERE id=?")
                ->execute([ 
                    $_POST['title'], 
                    $_POST['image'] ?? 'default.jpg', 
                    $_POST['excerpt'] ?? '', 
                    $_POST['button_link'] ?? '#', 
                    $_POST['type'] ?? 'card',
                    $_POST['category'] ?? 'general',
                    $_POST['status'] ?? 'active', 
                    $id 
                ]);
        } elseif ($action === 'delete') {
            $pdo->prepare("UPDATE admin_items SET status='inactive' WHERE id=?")->execute([(int)$_POST['id']]);
        }
        header("Location: ?success=1");
        exit;
    } catch (Exception $e) {
        $error_msg = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cards Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .upload-zone {border:3px dashed #0d6efd;border-radius:15px;padding:30px;text-align:center;cursor:pointer;transition:all 0.3s;background:#f8f9ff;}
        .upload-zone:hover,.upload-zone.dragover {border-color:#0a58ca;background:#e3f2fd;transform:scale(1.02);}
        .upload-zone i {font-size:2.5rem;color:#0d6efd;margin-bottom:10px;}
        .image-preview {max-width:80px;max-height:80px;border-radius:8px;object-fit:cover;box-shadow:0 2px 10px rgba(0,0,0,0.1);}
        .card {border:none;border-radius:15px;box-shadow:0 5px 20px rgba(13,110,253,0.1);transition:all 0.3s;}
        .card:hover {transform:translateY(-5px);box-shadow:0 15px 40px rgba(13,110,253,0.2);}
        .modal-header {background:linear-gradient(45deg,#0d6efd,#0a58ca);color:white;border-radius:15px 15px 0 0 !important;}
        .category-badge {font-size:0.75rem;padding:0.25rem 0.5rem;border-radius:20px;}
        
        /* Category Colors */
        .cat-general {background-color: #6c757d !important;}
        .cat-produk {background-color: #28a745 !important;}
        .cat-layanan {background-color: #17a2b8 !important;}
        .cat-promo {background-color: #ffc107 !important; color: #000 !important;}
        .cat-portfolio {background-color: #fd7e14 !important;}
        .cat-team {background-color: #6f42c1 !important;}
        .cat-testimonial {background-color: #e83e8c !important;}
        .cat-blog {background-color: #20c997 !important;}
        .cat-event {background-color: #dc3545 !important;}
    </style>
</head>
<body class="bg-light">
<?php include 'includes/header.php'; ?>

<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary mb-3"><i class="fas fa-layer-group me-2"></i>Cards Manager</h1>
        <button class="btn btn-primary btn-lg px-4" data-bs-toggle="modal" data-bs-target="#itemModal" onclick="resetForm()">
            <i class="fas fa-plus me-2"></i>Buat Baru
        </button>
    </div>

    <!-- FILTER BY CATEGORY -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-filter"></i></span>
                <select id="categoryFilter" class="form-select" onchange="filterByCategory()">
                    <option value="">📋 Semua Kategori</option>
                    <?php foreach($categories as $key => $label): ?>
                        <option value="<?= $key ?>"><?= htmlspecialchars($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm">
            <i class="fas fa-check me-2"></i>Sukses disimpan!
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($error_msg)): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4 shadow-sm">
            <i class="fas fa-exclamation me-2"></i><?= $error_msg ?>
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (empty($items)): ?>
        <div class="text-center py-5">
            <i class="fas fa-box fa-4x text-muted mb-3"></i>
            <h4>Belum ada cards aktif</h4>
        </div>
    <?php else: ?>
        <div class="row g-4" id="cardsContainer">
            <?php foreach ($items as $item): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 card-item" data-category="<?= htmlspecialchars(strtolower($item['category'])) ?>">
                    <div class="card h-100 position-relative">
                        <!-- CATEGORY BADGE WITH COLORS -->
                        <span class="position-absolute top-0 start-0 m-2 badge category-badge text-white cat-<?= htmlspecialchars($item['category']) ?>">
                            <?= htmlspecialchars($categories[$item['category']] ?? ucwords($item['category'])) ?>
                        </span>
                        
                        <!-- IMAGE -->
                        <?php if ($item['image'] !== 'default.jpg' && !empty($item['image'])): ?>
                            <img src="../assets/images/cards/<?= htmlspecialchars($item['image']) ?>" 
                                 class="card-img-top" 
                                 style="height:150px; object-fit:cover;"
                                 alt="<?= htmlspecialchars($item['title']) ?>"
                                 onerror="this.src='../assets/images/cards/default.jpg'">
                        <?php else: ?>
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center text-muted" style="height:150px;">
                                <i class="fas fa-image fa-2x"></i>
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body">
                            <h6 class="card-title fw-bold"><?= htmlspecialchars($item['title']) ?></h6>
                            <p class="card-text text-muted small"><?= htmlspecialchars($item['excerpt']) ?></p>
                            <div class="btn-group w-100">
                                <button class="btn btn-warning btn-sm flex-fill me-1" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#itemModal" 
                                        onclick="editItem(<?= $item['id'] ?>,'<?= addslashes($item['title']) ?>','<?= addslashes($item['image']) ?>','<?= addslashes($item['excerpt']) ?>','<?= addslashes($item['button_link']) ?>','<?= $item['type'] ?>','<?= $item['status'] ?>','<?= addslashes($item['category']) ?>')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form method="POST" class="flex-fill ms-1 d-inline" style="margin:0;" onsubmit="return confirm('Arsipkan?')">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-archive"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- MODAL -->
<div class="modal fade" id="itemModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalTitle">Buat Card</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" id="cardForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="action" id="modalAction" value="create">
                    <input type="hidden" name="id" id="modalId">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Judul <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="modalTitleField" class="form-control" required>
                    </div>
                    
                    <!-- UPLOAD IMAGE -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Gambar</label>
                        <div class="upload-zone mb-2" id="uploadZone">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <div>Drag gambar atau <strong>klik disini</strong></div>
                            <small class="text-muted">JPG, PNG, GIF, WebP (max 5MB)</small>
                            <input type="file" id="imageInput" accept="image/*" class="d-none">
                        </div>
                        <div id="previewContainer" class="d-none mb-2 p-2 border rounded">
                            <img id="imagePreview" class="image-preview me-2">
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearImage()">Ganti</button>
                        </div>
                        <input type="hidden" name="image" id="modalImage" value="default.jpg">
                        <div id="uploadStatus" class="alert d-none"></div>
                    </div>
                    
                    <!-- FORM FIELDS -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="excerpt" id="modalExcerpt" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Link</label>
                            <input type="url" name="button_link" id="modalButtonLink" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Tipe</label>
                            <select name="type" id="modalType" class="form-select">
                                <option value="card">Card</option>
                                <option value="modal">Modal</option>
                                <option value="popup">Popup</option>
                                <option value="toast">Toast</option>
                            </select>
                        </div>
                        
                        <!-- 🔥 CATEGORY SELECT DROPDOWN -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Kategori</label>
                            <select name="category" id="modalCategory" class="form-select">
                                <?php foreach($categories as $key => $label): ?>
                                    <option value="<?= $key ?>"><?= htmlspecialchars($label) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-muted">Pilih kategori untuk filter</small>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" id="modalStatus" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
let uploading = false;
const categories = <?= json_encode($categories) ?>;

// Upload functionality (sama seperti sebelumnya)
document.getElementById('uploadZone').addEventListener('click', () => document.getElementById('imageInput').click());
document.getElementById('imageInput').addEventListener('change', handleImageUpload);

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    document.getElementById('uploadZone').addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    document.getElementById('uploadZone').addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    document.getElementById('uploadZone').addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    document.getElementById('uploadZone').classList.add('dragover');
}

function unhighlight(e) {
    document.getElementById('uploadZone').classList.remove('dragover');
}

document.getElementById('uploadZone').addEventListener('drop', handleDrop, false);

function handleImageUpload() {
    const file = document.getElementById('imageInput').files[0];
    if (file) uploadFile(file);
}

function handleDrop(e) {
    const dt = e.dataTransfer;
    const file = dt.files[0];
    if (file && file.type.startsWith('image/')) {
        document.getElementById('imageInput').files = dt.files;
        uploadFile(file);
    }
}

function uploadFile(file) {
    if (uploading) return;
    
    const maxSize = 5 * 1024 * 1024;
    if (file.size > maxSize) {
        showStatus('File terlalu besar! Max 5MB', 'danger');
        return;
    }

    const formData = new FormData();
    formData.append('image', file);

    uploading = true;
    showStatus('Mengunggah...', 'info');

    fetch('', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('modalImage').value = data.path;
            document.getElementById('imagePreview').src = '../assets/images/' + data.path + '?t=' + Date.now();
            document.getElementById('previewContainer').classList.remove('d-none');
            showStatus('Upload berhasil!', 'success');
        } else {
            showStatus(data.error || 'Upload gagal', 'danger');
        }
        uploading = false;
    })
    .catch(() => {
        showStatus('Error koneksi', 'danger');
        uploading = false;
    });
}

function showStatus(message, type) {
    const status = document.getElementById('uploadStatus');
    status.className = `alert alert-${type} d-block`;
    status.textContent = message;
    setTimeout(() => status.classList.add('d-none'), 3000);
}

function clearImage() {
    document.getElementById('imageInput').value = '';
    document.getElementById('modalImage').value = 'default.jpg';
    document.getElementById('previewContainer').classList.add('d-none');
    document.getElementById('uploadZone').classList.remove('dragover');
}

function editItem(id, title, image, excerpt, link, type, status, category) {
    document.getElementById('modalTitle').textContent = 'Edit Card';
    document.getElementById('modalAction').value = 'update';
    document.getElementById('modalId').value = id;
    document.getElementById('modalTitleField').value = title;
    document.getElementById('modalImage').value = image;
    document.getElementById('modalExcerpt').value = excerpt;
    document.getElementById('modalButtonLink').value = link;
    document.getElementById('modalType').value = type;
    document.getElementById('modalStatus').value = status;
    document.getElementById('modalCategory').value = category;
    
    if (image !== 'default.jpg') {
        document.getElementById('imagePreview').src = '../assets/images/cards/' + image + '?t=' + Date.now();
        document.getElementById('previewContainer').classList.remove('d-none');
    }
}

function filterByCategory() {
    const filter = document.getElementById('categoryFilter').value.toLowerCase();
    const cards = document.querySelectorAll('.card-item');
    
    cards.forEach(card => {
        const category = card.dataset.category;
        if (!filter || category === filter) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function resetForm() {
    document.getElementById('modalTitle').textContent = 'Buat Card';
    document.getElementById('modalAction').value = 'create';
    document.querySelectorAll('#cardForm input, #cardForm textarea, #cardForm select').forEach(el => {
        if (el.type === 'checkbox' || el.type === 'radio') {
            el.checked = false;
        } else {
            el.value = '';
        }
    });
    document.getElementById('modalImage').value = 'default.jpg';
    document.getElementById('modalCategory').value = 'general';
    document.getElementById('modalType').value = 'card';
    document.getElementById('modalStatus').value = 'active';
    clearImage();
    document.getElementById('modalTitleField').focus();
}

// Auto filter on page load if category selected
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const category = urlParams.get('category');
    if (category) {
        document.getElementById('categoryFilter').value = category;
        filterByCategory();
    }
});
</script>

<?php include 'includes/footer.php'; ?>
</body>
</html>