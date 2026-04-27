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

include '../includes/blog-config.php';

// 🛡️ NULL SAFETY - Fix deprecated htmlspecialchars(NULL)
$_POST['excerpt'] = $_POST['excerpt'] ?? '';
$_POST['title'] = $_POST['title'] ?? '';
$_POST['content'] = $_POST['content'] ?? '';

$action = $_GET['action'] ?? 'list';
$msg = $_GET['msg'] ?? '';
$edit_id = $_GET['edit'] ?? 0;
$edit_post = null;

// FORM HANDLER
if ($_POST) {
    if (isset($_POST['delete'])) {
        $pdo->prepare('DELETE FROM allcontent_posts WHERE id=?')->execute([$_POST['id']]);
        header('Location: ?msg=Post dihapus');
        exit;
    }
    if (isset($_POST['save'])) {
        $content = $_POST['content'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $img_path = 'uploads/' . uniqid() . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $img_path);
            $content .= '<br><img src="' . $img_path . '" class="img-fluid my-3" alt="Uploaded">';
        }
        $pdo->prepare('UPDATE allcontent_posts SET category_id=?,title=?,excerpt=?,content=?,status=? WHERE id=?')->execute([
            $_POST['category_id'], $_POST['title'], $_POST['excerpt'], $content, $_POST['status'], $_POST['id']
        ]);
        header('Location: ?msg=Post diupdate');
        exit;
    }
    if (isset($_POST['add'])) {
        $content = $_POST['content'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $img_path = 'uploads/' . uniqid() . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $img_path);
            $content .= '<br><img src="' . $img_path . '" class="img-fluid my-3" alt="Uploaded">';
        }
        $pdo->prepare('INSERT INTO allcontent_posts(category_id,title,excerpt,content,url_main,status) VALUES(?,?,?,?,?,?)')->execute([
            $_POST['category_id'], $_POST['title'], $_POST['excerpt'], $content, $_POST['url_main'], $_POST['status']
        ]);
        header('Location: ?msg=Post ditambahkan');
        exit;
    }
}

// DATA
if ($action == 'edit' || $edit_id) {
    $stmt = $pdo->prepare('SELECT p.*,c.name cat_name FROM allcontent_posts p LEFT JOIN allcontent_categories c ON p.category_id=c.id WHERE p.id=?');
    $stmt->execute([$edit_id]);
    $edit_post = $stmt->fetch();
    // 🛡️ Fix NULL fields
    $edit_post['excerpt'] = $edit_post['excerpt'] ?? '';
    $edit_post['title'] = $edit_post['title'] ?? '';
    $edit_post['content'] = $edit_post['content'] ?? '';
}

$q = $_POST['q'] ?? $_GET['q'] ?? '';
if ($q) {
    $stmt = $pdo->prepare('SELECT p.*,c.name cat_name FROM allcontent_posts p LEFT JOIN allcontent_categories c ON p.category_id=c.id WHERE p.title LIKE ? OR p.content LIKE ? ORDER BY p.created_at DESC LIMIT 50');
    $stmt->execute(['%' . $q . '%', '%' . $q . '%']);
    $posts = $stmt->fetchAll();
} else {
    $posts = $pdo->query('SELECT p.*,c.name cat_name FROM allcontent_posts p LEFT JOIN allcontent_categories c ON p.category_id=c.id ORDER BY p.created_at DESC LIMIT 50')->fetchAll();
}

$categories = $pdo->query('SELECT * FROM allcontent_categories ORDER BY name')->fetchAll();

// Create uploads directory
if (!is_dir('uploads')) {
    mkdir('uploads', 0777, true);
}

function safe_html($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Blog Manager - <?= safe_html($_SESSION['admin_name'] ?? 'Admin') ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
 :root{--primary:#1A56DB;--primary-dark:#233876;}
.card{box-shadow:0 .125rem .25rem rgba(0,0,0,.075);border:none;border-radius:.5rem;}
.table-hover tbody tr:hover{background:rgba(var(--primary),.05);}border-color:var(--primary);}
.btn-primary:focus{box-shadow:0 0 0 .25rem rgba(var(--primary),.25);}
.ql-container{min-height:200px;border-radius:0 0 .375rem .375rem;}
.ql-toolbar{border-radius:.375rem .375rem 0 0;border-color:#dee2e6;}
.ql-editor{font-size:1rem;line-height:1.6;}
.image-upload{position:relative;display:inline-block;width:100%;}
.image-upload input[type=file]{position:absolute;left:-9999px;}
.image-upload-label{display:flex;align-items:center;padding:8px 12px;border:2px dashed #0d6efd;border-radius:.375rem;background:#f8f9ff;cursor:pointer;transition:all .2s;}
.image-upload-label:hover{background:#e3f2fd;}
.image-upload-label i{font-size:1.2rem;margin-right:8px;}
summary{cursor:pointer;font-weight:500;}
.fs-2rem{font-size:1.1rem;}
@keyframes slideDown{from{opacity:0;transform:translateY(-10px);}to{opacity:1;transform:translateY(0);}}
</style>
</head>

<?php
include 'includes/header.php';
?>

<div class="container mt-4">
 <?php if ($msg): ?>
  <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
   <i class="bi bi-check-circle-fill me-2"></i><?= safe_html($msg) ?>
   <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
 <?php endif; ?>

 <!-- Stats -->
 <div class="row mb-4 g-3">
  <div class="col-md-3">
   <div class="card text-center h-100">
    <div class="card-body">
     <i class="bi bi-file-earmark-text fs-1" style="color:var(--primary)"></i>
     <div class="h4 mb-0"><?= is_array($posts) ? count($posts) : 0 ?></div>
     <div class="text-muted small">Posts</div>
    </div>
   </div>
  </div>
  <div class="col-md-3">
   <div class="card text-center h-100" style="background:rgba(25,135,84,.1)">
    <div class="card-body">
     <i class="bi bi-eye-fill fs-1" style="color:#198754"></i>
     <div class="h4 mb-0" style="color:#198754"><?= $pdo->query("SELECT COUNT(*) FROM allcontent_posts WHERE status='active'")->fetchColumn() ?></div>
     <div class="text-muted small">Active</div>
    </div>
   </div>
  </div>
  <div class="col-md-3">
   <div class="card text-center h-100">
    <div class="card-body">
     <i class="bi bi-tags-fill fs-1" style="color:#0dcaf0"></i>
     <div class="h4 mb-0" style="color:#0dcaf0"><?= count($categories) ?></div>
     <div class="text-muted small">Kategori</div>
    </div>
   </div>
  </div>
  <div class="col-md-3">
   <div class="card text-center h-100" style="background:rgba(255,193,7,.1)">
    <div class="card-body">
     <i class="bi bi-scrape-clipboard fs-1" style="color:#ffc107"></i>
     <div class="h4 mb-0" style="color:#ffc107"><?= $pdo->query("SELECT COUNT(*) FROM allcontent_posts WHERE source_domain IS NOT NULL")->fetchColumn() ?></div>
     <div class="text-muted small">Scrapped</div>
    </div>
   </div>
  </div>
 </div>

 <?php if ($edit_post): // EDIT MODE ?>
  <div class="card mb-4">
   <div class="card-header d-flex justify-content-between align-items-center bg-primary bg-opacity-10">
    <h5 class="mb-0 text-primary">
     <i class="bi bi-pencil-square me-2"></i>Edit Post #<?= $edit_post['id'] ?>
    </h5>
    <a href="?" class="btn btn-sm btn-outline-primary">
     <i class="bi bi-list-ul"></i> Daftar
    </a>
   </div>
   <div class="card-body">
    <form method="POST" enctype="multipart/form-data">
     <input type="hidden" name="id" value="<?= $edit_post['id'] ?>">
     <div class="row g-3 mb-3">
      <div class="col-md-6">
       <label class="form-label fw-semibold">Kategori</label>
       <select name="category_id" class="form-select" required>
        <?php foreach ($categories as $c): ?>
         <option value="<?= $c['id'] ?>" <?= ($edit_post['category_id'] ?? 0) == $c['id'] ? 'selected' : '' ?>>
          <?= safe_html($c['name']) ?>
         </option>
        <?php endforeach; ?>
       </select>
      </div>
      <div class="col-md-6">
       <label class="form-label fw-semibold">Status</label>
       <select name="status" class="form-select">
        <option value="active" <?= ($edit_post['status'] ?? '') == 'active' ? 'selected' : '' ?>>✅ Active</option>
        <option value="inactive" <?= ($edit_post['status'] ?? '') == 'inactive' ? 'selected' : '' ?>>⏸️ Inactive</option>
        <option value="pending" <?= ($edit_post['status'] ?? '') == 'pending' ? 'selected' : '' ?>>⏳ Pending</option>
       </select>
      </div>
     </div>
     <div class="mb-3">
      <label class="form-label fw-semibold">Judul <span class="text-danger">*</span></label>
      <input type="text" name="title" class="form-control" value="<?= safe_html($edit_post['title']) ?>" required>
     </div>
     <div class="mb-3">
      <label class="form-label">Excerpt</label>
      <textarea name="excerpt" class="form-control" rows="2"><?= safe_html($edit_post['excerpt']) ?></textarea>
     </div>
     <div class="mb-4">
      <label class="form-label fw-semibold">Konten <span class="text-danger">*</span></label>
      <div id="quill-editor"><?= ($edit_post['content']) ?></div>
      <input type="hidden" name="content" id="quill-content">
     </div>
     <div class="image-upload mb-4">
      <label for="image" class="image-upload-label">
       <i class="bi bi-image"></i>
       <span>Tambah Gambar</span>
       <input type="file" id="image" name="image" accept="image/*">
      </label>
     </div>
     <div class="d-flex gap-2">
      <button name="save" class="btn btn-primary px-4">
       <i class="bi bi-check2-square me-2"></i>Update Post
      </button>
      <a href="?" class="btn btn-outline-secondary">Batal</a>
     </div>
    </form>
   </div>
  </div>

 <?php else: // LIST MODE ?>
  <!-- Search -->
  <div class="card mb-4">
   <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
     <div class="col-md-8">
      <input type="search" name="q" class="form-control" placeholder="🔍 Cari judul atau konten..." value="<?= safe_html($q) ?>">
     </div>
     <div class="col-md-2">
      <button class="btn btn-primary w-100">
       <i class="bi bi-search"></i> Cari
      </button>
     </div>
     <?php if ($q): ?>
     <div class="col-md-2">
      <a href="?" class="btn btn-outline-secondary w-100">Clear</a>
     </div>
     <?php endif; ?>
    </form>
   </div>
  </div>

  <!-- ADD FORM -->
  <details class="mb-4">
   <summary class="btn btn-primary w-100 text-start ps-4 py-3 fw-semibold">
    <i class="bi bi-plus-circle-fill me-2"></i>Tambah Post Baru
   </summary>
   <div class="card mt-3">
    <div class="card-body p-4">
     <form method="POST" enctype="multipart/form-data">
      <div class="row g-3">
       <div class="col-md-3">
        <label class="form-label small">Kategori *</label>
        <select name="category_id" class="form-select" required>
         <option value="">Pilih...</option>
         <?php foreach ($categories as $c): ?>
          <option value="<?= $c['id'] ?>"><?= safe_html($c['name']) ?></option>
         <?php endforeach; ?>
        </select>
       </div>
       <div class="col-md-3">
        <label class="form-label small">Status</label>
        <select name="status" class="form-select">
         <option value="pending">⏳ Pending</option>
         <option value="active">✅ Active</option>
        </select>
       </div>
       <div class="col-md-6">
        <label class="form-label small">Judul *</label>
        <input type="text" name="title" class="form-control" placeholder="Judul post" required>
       </div>
       <div class="col-12">
        <label class="form-label small">URL Sumber *</label>
        <input type="url" name="url_main" class="form-control" placeholder="https://example.com/post" required>
       </div>
       <div class="col-md-6">
        <label class="form-label small">Excerpt</label>
        <textarea name="excerpt" class="form-control" rows="2" placeholder="Ringkasan..."></textarea>
       </div>
      </div>
      <div class="mt-3">
       <label class="form-label fw-semibold">Konten *</label>
       <div id="quill-add-editor"></div>
       <input type="hidden" name="content" id="quill-add-content">
      </div>
      <div class="image-upload mt-3">
       <label for="add-image" class="image-upload-label">
        <i class="bi bi-image"></i>
        <span>Tambah Gambar</span>
        <input type="file" id="add-image" name="image" accept="image/*">
       </label>
      </div>
      <button name="add" class="btn btn-primary mt-3 px-4">
       <i class="bi bi-plus-circle me-2"></i>Tambah Post
      </button>
     </form>
    </div>
   </div>
  </details>

  <!-- TABLE -->
  <div class="card">
   <div class="card-header d-flex justify-content-between bg-primary bg-opacity-10">
    <h6 class="mb-0 text-primary">
     <i class="bi bi-table me-2"></i>Daftar Posts 
     <?php if ($q): ?>
      <span class="badge bg-primary"><?= safe_html($q) ?></span>
     <?php endif; ?>
    </h6>
    <small class="text-muted"><?= is_array($posts) ? count($posts) : 0 ?> posts</small>
   </div>
   <div class="table-responsive">
    <table class="table table-hover mb-0">
     <thead class="table-light">
      <tr>
       <th width="60">#</th>
       <th>Judul</th>
       <th width="90">Status</th>
       <th width="70">Views</th>
       <th width="90">Tanggal</th>
       <th width="220">Aksi</th>
      </tr>
     </thead>
     <tbody>
      <?php if (empty($posts)): ?>
       <tr>
        <td colspan="6" class="text-center py-5 text-muted">
         <i class="bi bi-inbox fs-1 d-block mb-3 opacity-50"></i>
         <div>Belum ada post</div>
         <small>Gunakan form tambah diatas</small>
        </td>
       </tr>
      <?php else: ?>
       <?php foreach ($posts as $p): ?>
        <tr>
         <td><strong>#<?= $p['id'] ?></strong></td>
         <td>
          <div class="fw-semibold" style="max-width:250px;" title="<?= safe_html($p['title']) ?>">
           <?= safe_html(substr($p['title'] ?? '', 0, 45)) ?><?= strlen($p['title'] ?? '') > 45 ? '...' : '' ?>
          </div>
         </td>
         <td>
          <span class="badge fs-2rem <?= ($p['status'] ?? '') == 'active' ? 'bg-success' : (($p['status'] ?? '') == 'pending' ? 'bg-warning' : 'bg-secondary') ?>">
           <?= ($p['status'] ?? '') == 'active' ? '✅' : (($p['status'] ?? '') == 'pending' ? '⏳' : '⏸️') ?>
          </span>
         </td>
         <td><?= number_format($p['views'] ?? 0) ?></td>
         <td>
          <small class="text-muted"><?= date('d M Y', strtotime($p['created_at'] ?? 'now')) ?></small>
         </td>
         <td>
          <div class="btn-group btn-group-sm" role="group">
           <a href="?edit=<?= $p['id'] ?>" class="btn btn-outline-primary" title="Edit">
            <i class="bi bi-pencil"></i>
           </a>
           <a href="?action=toggle&id=<?= $p['id'] ?>" 
              class="btn <?= ($p['status'] ?? '') == 'active' ? 'btn-outline-danger' : 'btn-outline-success' ?>" 
              onclick="return confirm('<?= ($p['status'] ?? '') == 'active' ? 'Nonaktifkan' : 'Aktifkan' ?>?')" 
              title="Toggle">
            <i class="bi bi-power"></i>
           </a>
           <form method="POST" style="display:inline;" onsubmit="return confirm('Hapus permanen?')">
            <input type="hidden" name="id" value="<?= $p['id'] ?>">
            <button name="delete" class="btn btn-outline-danger" title="Delete">
             <i class="bi bi-trash"></i>
            </button>
           </form>
           <!-- View Post di blogs/ -->
<a href="../blogs/?id=<?= $p['id'] ?>" target="_blank" class="btn btn-primary" title="Lihat Post">
 <i class="bi bi-eye"></i>
</a>
<!-- Source URL -->
<a href="<?= safe_html($p['url_main']) ?>" target="_blank" class="btn btn-outline-secondary" title="Source">
 <i class="bi bi-box-arrow-up-right"></i>
</a>
          </div>
         </td>
        </tr>
       <?php endforeach; ?>
      <?php endif; ?>
     </tbody>
    </table>
   </div>
  </div>

  <div class="text-center mt-4 text-muted small">
   <a href="<?php echo ADMIN_URL; ?>dashboard" class="text-decoration-none">
    <i class="bi bi-house-door"></i> Dashboard
   </a>
  </div>
 <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
// Quill Editor Setup
let quillEdit, quillAdd;

document.addEventListener('DOMContentLoaded', function() {
   // Tambahkan di dalam document.addEventListener('DOMContentLoaded', function() {
if (document.getElementById('quill-editor') && <?= json_encode($edit_post ? true : false) ?>) {
    // Delay sedikit untuk memastikan Quill sudah siap
    setTimeout(() => {
        const content = `<?= addslashes($edit_post['content'] ?? '') ?>`;
        quillEdit.root.innerHTML = content;
        document.getElementById('quill-content').value = content;
    }, 100);
}
    // Edit form Quill
    if (document.getElementById('quill-editor')) {
        quillEdit = new Quill('#quill-editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'image', 'blockquote'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'align': [] }],
                    ['clean']
                ]
            },
            placeholder: 'Mulai menulis konten...'
        });
        
        // Sync hidden input
        quillEdit.on('text-change', function() {
            document.getElementById('quill-content').value = quillEdit.root.innerHTML;
        });
    }

    // Add form Quill
    if (document.getElementById('quill-add-editor')) {
        quillAdd = new Quill('#quill-add-editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'image', 'blockquote'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'align': [] }],
                    ['clean']
                ]
            },
            placeholder: 'Mulai menulis konten...'
        });
        
        // Sync hidden input
        quillAdd.on('text-change', function() {
            document.getElementById('quill-add-content').value = quillAdd.root.innerHTML;
        });
    }
});

// Form submit handlers
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        // Sync Quill content before submit
        if (quillEdit) {
            document.getElementById('quill-content').value = quillEdit.root.innerHTML;
        }
        if (quillAdd) {
            document.getElementById('quill-add-content').value = quillAdd.root.innerHTML;
        }
    });
});

// Smooth animations
document.querySelectorAll('details').forEach(detail => {
    detail.addEventListener('toggle', function() {
        if (this.open) {
            this.querySelector('.card').style.animation = 'slideDown 0.3s ease-out';
        }
    });
});
</script>

<?php
include 'includes/footer.php';
?>
