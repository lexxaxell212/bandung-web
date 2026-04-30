<?php
$lib_path = dirname(__DIR__) . '/../lib/functions.php';
if (!file_exists($lib_path)) die('../lib/functions.php missing: ' . $lib_path);
require_once $lib_path;
autoload_core();
require_once 'functions.php';
session_start();

if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}

// ===== CSRF & ANTI RESUBMISSION =====
function generate_csrf_token() {
    if(empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Handle form
$message = '';
$success_redirect = false;
$csrf_token = generate_csrf_token();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf_token($_POST['csrf_token'] ?? '')) {
    $title = trim($_POST['title']);
    $base_slug = strtolower(preg_replace('/[^a-z0-9-]+/', '-', $title));
    $slug = generateUniqueSlug($pdo, $base_slug);
    $html_content = $_POST['html_content'];
    
    $stmt = $pdo->prepare("INSERT INTO pages (title, slug, html_content) VALUES (?, ?, ?) 
                          ON DUPLICATE KEY UPDATE title=VALUES(title), html_content=VALUES(html_content), updated_at=NOW()");
    $saved = $stmt->execute([$title, $slug, $html_content]);
    
    if($saved && generateStaticPage($slug, $html_content)) {
        $message = "✅ Page <strong>/pages/$slug/</strong> berhasil disimpan!";
        $success_redirect = true;
    } else {
        $message = "❌ Gagal menyimpan page!";
    }
}

// DELETE PAGE
if (isset($_GET['delete']) && verify_csrf_token($_GET['csrf_delete'] ?? '')) {
    $stmt = $pdo->prepare("SELECT slug FROM pages WHERE slug = ?");
    $stmt->execute([$_GET['delete']]);
    $page_to_delete = $stmt->fetch();
    
    if ($page_to_delete) {
        deletePageFiles($page_to_delete['slug']);
        $stmt = $pdo->prepare("DELETE FROM pages WHERE slug = ?");
        $stmt->execute([$_GET['delete']]);
        $message = "🗑️ Page <strong>" . $_GET['delete'] . "</strong> berhasil dihapus!";
        // Redirect ke list setelah delete
        header('Location: ?');
        exit;
    }
}

// LOAD DATA - FIXED VERSION ✅
// SELALU load recent pages TERLEBIH DAHULU
$list_pages = [];
$stmt = $pdo->query("SELECT * FROM pages ORDER BY updated_at DESC LIMIT 10");
$list_pages = $stmt->fetchAll();

// Load page untuk edit jika ada
$page = null;
if(isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM pages WHERE slug = ?");
    $stmt->execute([$_GET['edit']]);
    $page = $stmt->fetch();
}

// REDIRECT AFTER SAVE
if ($success_redirect) {
    $redirect_slug = isset($_GET['edit']) ? $_GET['edit'] : $slug;
    header("Location: ?edit=" . urlencode($redirect_slug));
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pages Builder - <?= htmlspecialchars($page['title'] ?? 'New Page'); ?></title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/theme/dracula.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/addon/fold/foldgutter.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
   <style>
    :root {
        --bg-primary: #0f172a;
        --bg-secondary: #1e293b;
        --bg-card: rgba(30, 41, 59, 0.95);
        --text-primary: #f8fafc;
        --text-secondary: #94a3b8;
        --accent: #3b82f6;
    }
    
    * {
        box-sizing: border-box;
    }
    
    body {
        background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);
        min-height: 100vh;
        font-family: system-ui, -apple-system, sans-serif;
        overflow-x: hidden;
        color: var(--text-primary);
    }
    
    .header {
        background: rgba(30, 41, 59, 0.98) !important;
        backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    
    .sidebar {
        background: var(--bg-card) !important;
        backdrop-filter: blur(20px);
        border-radius: 20px !important;
        height: fit-content;
        position: sticky;
        top: 20px;
        z-index: 10;
    }
    
    .main-card {
        background: var(--bg-card) !important;
        backdrop-filter: blur(20px);
        border-radius: 20px !important;
        border: 1px solid rgba(255,255,255,0.1);
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }
    
    .CodeMirror {
        border-radius: 15px !important;
        box-shadow: inset 0 4px 20px rgba(0,0,0,0.4);
        font-size: 14px;
        border: 1px solid rgba(255,255,255,0.1);
    }
    
    .CodeMirror-scroll {
        min-height: 400px;
    }
    
    /* RECENT PAGES - PERFECT HOVER FIX */
    .page-item {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 12px;
        margin-bottom: 8px;
        color: var(--text-primary) !important;
        border: 1px solid rgba(255,255,255,0.1);
        background: rgba(255,255,255,0.03) !important;
    }
    
    .page-item:hover {
        background: rgba(59, 130, 246, 0.25) !important;
        transform: translateX(6px) scale(1.02);
        box-shadow: 0 12px 35px rgba(59, 130, 246, 0.4);
        color: var(--text-primary) !important;
        border-color: rgba(59, 130, 246, 0.6);
    }
    
    .page-item.current {
        background: rgba(59, 130, 246, 0.35) !important;
        border-color: var(--accent) !important;
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
    }
    
    .page-item.current:hover {
        background: rgba(59, 130, 246, 0.45) !important;
        transform: translateX(8px) scale(1.03);
        box-shadow: 0 16px 45px rgba(59, 130, 246, 0.5);
    }
    
    .page-slug {
        color: rgba(59, 130, 246, 0.9) !important;
    }
    
    .btn-modern {
        border-radius: 12px;
        font-weight: 600;
        padding: 10px 20px;
        border: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
        font-size: 0.875rem;
    }
    
    .btn-modern:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 15px 40px rgba(0,0,0,0.4) !important;
    }
    
    /* PLACEHOLDER WHITE - PERFECT FIX */
    input::placeholder {
        color: #cbd5e1 !important;
        opacity: 1 !important;
    }
    
    input:focus::placeholder {
        color: #94a3b8 !important;
    }
    
    .form-control::placeholder {
        color: #94a3b8 !important;
    }
    
    .bg-transparent::placeholder {
        color: #94a3b8 !important;
    }
    
    .bg-secondary.bg-opacity-50::placeholder {
        color: #e2e8f0 !important;
    }
    
    /* RESPONSIVE FIX */
    .preview-container {
        position: relative;
        width: 100%;
        height: 300px;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.4);
        background: var(--bg-primary);
        border: 1px solid rgba(255,255,255,0.1);
    }
    
    #previewFrame {
        width: 100%;
        height: 100%;
        border: none;
        border-radius: 15px;
    }
    
    /* CUSTOM SCROLLBAR - SIDEBAR */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(255,255,255,0.05);
        border-radius: 3px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: var(--accent);
        border-radius: 3px;
        transition: background 0.2s;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #60a5fa;
    }
    
    /* MOBILE RESPONSIVE */
    @media (max-width: 991.98px) {
        .sidebar {
            position: relative !important;
            top: 0 !important;
            margin-bottom: 2rem;
        }
        
        .CodeMirror {
            font-size: 13px !important;
        }
        
        .CodeMirror-scroll {
            min-height: 300px !important;
        }
        
        .preview-container {
            height: 250px !important;
        }
    }
    
    @media (max-width: 767.98px) {
        .container-fluid {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
        
        .header .container {
            padding-left: 0;
            padding-right: 0;
        }
        
        .navbar-brand {
            font-size: 1.5rem !important;
        }
        
        .btn-modern {
            padding: 8px 16px;
            font-size: 0.8rem;
        }
        
        .CodeMirror {
            font-size: 12px !important;
        }
        
        .CodeMirror-scroll {
            min-height: 250px !important;
        }
        
        .preview-container {
            height: 200px !important;
        }
        
        .page-item .btn-group {
            flex-direction: column;
            gap: 2px;
        }
        
        .page-item .btn-group .btn {
            padding: 4px 8px !important;
            font-size: 0.7rem !important;
        }
        
        .page-item:hover {
            transform: translateX(3px) scale(1.01);
        }
    }
    
    @media (max-width: 575.98px) {
        .preview-container {
            height: 180px !important;
        }
        
        .CodeMirror-scroll {
            min-height: 200px !important;
        }
        
        .page-item {
            margin-bottom: 6px;
        }
    }
    
    /* Smooth scroll */
    html {
        scroll-behavior: smooth;
    }
    
    /* Global scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: rgba(255,255,255,0.1);
    }
    
    ::-webkit-scrollbar-thumb {
        background: var(--accent);
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #60a5fa;
    }
    
    /* Form control enhancements */
    .form-control {
        background: rgba(255,255,255,0.08) !important;
        border: 1px solid rgba(255,255,255,0.2) !important;
        color: var(--text-primary) !important;
        backdrop-filter: blur(10px);
    }
    
    .form-control:focus {
        background: rgba(255,255,255,0.12) !important;
        border-color: var(--accent) !important;
        box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25) !important;
        color: var(--text-primary) !important;
    }
    
    .form-label {
        color: var(--text-primary) !important;
    }
</style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark header py-4 mb-4">
        <div class="container-fluid px-3 px-lg-0">
            <a class="navbar-brand fw-bold fs-2" href="#">
                <i class="fas fa-file-code me-3"></i>Pages Builder
            </a>
            <div class="d-flex">
                <a href="../dashboard.php" class="btn btn-primary btn-modern ms-2">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-lg-5 px-3 px-md-4">
        <div class="row g-4 g-lg-5">
            <!-- Sidebar - FIXED ✅ -->
            <div class="col-xl-3 col-lg-4 col-md-12">
                <div class="sidebar card p-4 h-100">
                    <h5 class="fw-bold text-white mb-4 pb-2 border-bottom border-secondary border-opacity-50">
                        <i class="fas fa-list me-2"></i>Recent Pages (<?= count($list_pages) ?>)
                    </h5>
                    <div style="max-height: 450px; overflow-y: auto;" class="custom-scrollbar">
                        <?php if (empty($list_pages)): ?>
                            <div class="text-center py-5 text-muted">
                                <i class="fas fa-file fa-3x mb-3 opacity-50"></i>
                                <p class="mb-0">Belum ada pages</p>
                            </div>
                        <?php else: ?>
                            <?php foreach($list_pages as $p): ?>
                            <?php $is_current = isset($_GET['edit']) && $_GET['edit'] === $p['slug']; ?>
                            <div class="page-item p-3 bg-primary bg-opacity-10 border-start border-primary border-3 <?= $is_current ? 'current' : '' ?>">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="flex-grow-1 me-2">
                                        <div class="fw-semibold text-truncate" style="max-width: 200px;"><?= htmlspecialchars($p['title']) ?></div>
                                        <small class="page-slug d-block text-primary text-truncate" style="max-width: 200px;">
                                            /pages/<?= htmlspecialchars($p['slug']) ?>/
                                            <?php if($is_current): ?>
                                                <i class="fas fa-edit ms-1" title="Sedang diedit"></i>
                                            <?php endif; ?>
                                        </small>
                                    </div>
                                    <div class="btn-group btn-group-sm flex-shrink-0" role="group">
                                        <a href="?edit=<?= urlencode($p['slug']) ?>" class="btn btn-outline-primary btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="../../pages/<?= htmlspecialchars($p['slug']) ?>/" target="_blank" class="btn btn-outline-success btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="?delete=<?= urlencode($p['slug']) ?>&csrf_delete=<?= $csrf_token ?>" 
                                           class="btn btn-outline-danger btn-sm" 
                                           onclick="return confirm('Hapus page «<?= htmlspecialchars($p['title']) ?>» dan file statisnya?')"
                                           title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-xl-9 col-lg-8 col-md-12">
                <?php if($message): ?>
                <div class="alert <?= strpos($message, '✅') !== false || strpos($message, '🗑️') !== false ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show mb-4 shadow-lg" role="alert">
                    <?= $message ?>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>

                <form method="POST" id="pageForm">
                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                    
                    <!-- Page Info -->
                    <div class="main-card p-4 mb-4">
                        <div class="row g-3 align-items-end">
                            <div class="col-lg-8 col-md-7">
                                <label class="form-label fw-bold text-white fs-5">
                                    Page Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-lg bg-transparent border-light" name="title" 
                                       placeholder="Masukkan judul page" 
                                       value="<?= htmlspecialchars($page['title'] ?? '') ?>" required>
                            </div>
                            <div class="col-lg-4 col-md-5">
                                <label class="form-label fw-bold text-white fs-5">Slug Preview</label>
                                <input type="text" class="form-control form-control-lg bg-secondary bg-opacity-50 border-0" 
                                       id="slug-preview" placeholder="auto-generate..." readonly>
                            </div>
                        </div>
                        
                        <!-- Toolbar -->
                        <div class="row g-2 mt-4 pt-3 border-top border-secondary border-opacity-50">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-lg-start">
                                    <button type="button" id="previewBtn" class="btn btn-primary btn-modern">
                                        <i class="fas fa-eye me-1"></i>Live Preview
                                    </button>
                                    <button type="button" id="clearBtn" class="btn btn-danger btn-modern">
                                        <i class="fas fa-trash me-1"></i>Clear Code
                                    </button>
                                    <button type="submit" class="btn btn-success btn-modern">
                                        <i class="fas fa-save me-1"></i>Save Page
                                    </button>
                                    <?php if($page): ?>
                                    <a href="../../pages/<?= htmlspecialchars($page['slug']) ?>/" 
                                       target="_blank" class="btn btn-info btn-modern">
                                        <i class="fas fa-external-link-alt me-1"></i>View Live
                                    </a>
                                    <?php endif; ?>
                                    <a href="?" class="btn btn-outline-light btn-modern">
                                        <i class="fas fa-list me-1"></i>Recent Pages
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Editor & Preview -->
                    <div class="row g-4">
                        <!-- Code Editor -->
                        <div class="col-xl-8 col-lg-7 col-md-12">
                            <div class="main-card p-4">
                                <h6 class="fw-bold text-white mb-4 pb-2 border-bottom border-secondary border-opacity-50">
                                    <i class="fas fa-code me-2 text-primary"></i>Code Editor (HTML/CSS/JS)
                                </h6>
                                <textarea id="htmlEditor" name="html_content"><?= htmlspecialchars($page['html_content'] ?? '') ?></textarea>
                            </div>
                        </div>
                        
                        <!-- Live Preview -->
                        <div class="col-xl-4 col-lg-5 col-md-12">
                            <div class="main-card p-4">
                                <h6 class="fw-bold text-white mb-4 pb-2 border-bottom border-secondary border-opacity-50">
                                    <i class="fas fa-desktop me-2 text-success"></i>Live Preview
                                </h6>
                                <div class="preview-container">
                                    <iframe id="previewFrame" sandbox="allow-scripts allow-same-origin allow-popups allow-forms"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- CodeMirror JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/mode/htmlmixed/htmlmixed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/mode/css/css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/addon/edit/closetag.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/addon/edit/closebrackets.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/addon/fold/foldcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/addon/fold/foldgutter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/addon/fold/xml-fold.min.js"></script>
    
    <script>
        let editor;
        let previewTimeout;

        document.addEventListener('DOMContentLoaded', function() {
            initCodeMirror();
            setupEventListeners();
            resizeEditor();
            
            // Auto preview if content exists
            if(editor && editor.getValue().trim()) {
                setTimeout(updatePreview, 300);
            }
        });

        function initCodeMirror() {
            editor = CodeMirror.fromTextArea(document.getElementById('htmlEditor'), {
                mode: 'htmlmixed',
                theme: 'dracula',
                lineNumbers: true,
                lineWrapping: true,
                foldGutter: true,
                gutters: ['CodeMirror-linenumbers', 'CodeMirror-foldgutter'],
                autoCloseTags: true,
                autoCloseBrackets: true,
                matchTags: {bothTags: true},
                styleActiveLine: true,
                tabSize: 2,
                indentUnit: 2,
                viewportMargin: Infinity,
                extraKeys: {
                    'Ctrl-Space': 'autocomplete',
                    'Ctrl-S': () => document.getElementById('pageForm').dispatchEvent(new Event('submit')),
                    'Cmd-S': () => document.getElementById('pageForm').dispatchEvent(new Event('submit'))
                }
            });

            // Debounced preview update
            editor.on('change', function() {
                clearTimeout(previewTimeout);
                previewTimeout = setTimeout(updatePreview, 500);
            });
        }

        function resizeEditor() {
            if (!editor) return;
            
            const width = window.innerWidth;
            let height = '500px';
            
            if (width < 768) {
                height = '300px';
            } else if (width < 992) {
                height = '400px';
            }
            
            editor.getWrapperElement().style.height = height;
            editor.refresh();
        }

        window.addEventListener('resize', function() {
            resizeEditor();
            // Force refresh iframe on resize
            const iframe = document.getElementById('previewFrame');
            if (iframe && iframe.contentWindow) {
                iframe.contentWindow.location.reload();
            }
        });

        function setupEventListeners() {
            const titleInput = document.querySelector('input[name="title"]');
            const slugPreview = document.getElementById('slug-preview');
            
            if (titleInput) {
                titleInput.oninput = function() {
                    const title = this.value.trim();
                    if (title) {
                        let slug = title.toLowerCase()
                            .replace(/[^a-z0-9\s-]/g, '')
                            .replace(/\s+/g, '-')
                            .replace(/-+/g, '-')
                            .replace(/^-|-$/g, '');
                        slugPreview.value = slug;
                    } else {
                        slugPreview.value = '';
                    }
                };
            }

            document.getElementById('previewBtn').onclick = updatePreview;

            document.getElementById('clearBtn').onclick = function() {
                if (confirm('Hapus semua kode?')) {
                    const title = titleInput?.value || 'Welcome';
                    editor.setValue(`<div class="vh-100 d-flex align-items-center justify-content-center p-5 text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="text-center">
        <h1 class="display-4 fw-bold mb-4">${title}</h1>
        <p class="lead mb-0">🎉 Live Preview - Siap diedit!</p>
    </div>
</div>`);
                    updatePreview();
                }
            };
        }

        function updatePreview() {
            if (!editor) return;
            
            try {
                const content = editor.getValue();
                const iframe = document.getElementById('previewFrame');
                const title = document.querySelector('input[name="title"]')?.value || 'Preview';
                
                const srcdoc = `
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>${title}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { 
            height: 100%; 
            overflow: auto; 
            font-family: system-ui, -apple-system, sans-serif;
        }
        body { padding: 20px; }
    </style>
</head>
<body>
 ${content}
 </body>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</html>`;
                
                iframe.srcdoc = srcdoc;
                
                // Fallback untuk browser yang bermasalah
                iframe.onload = function() {
                    console.log('✅ Preview updated successfully');
                };
                
                iframe.onerror = function() {
                    console.log('⚠️ Preview error, retrying...');
                    setTimeout(updatePreview, 100);
                };
                
            } catch (error) {
                console.error('Preview update failed:', error);
            }
        }
    </script>
</body>
</html>