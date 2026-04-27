<?php
if (!isset($_SESSION['admin_id'])) exit;

// CREATE TABLE IF NOT EXISTS
$pdo->exec("CREATE TABLE IF NOT EXISTS posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    excerpt TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// ADD POST
if (isset($_POST['add_post'])) {
    $pdo->prepare("INSERT INTO posts (title, excerpt) VALUES (?, ?)")
        ->execute([$_POST['title'], $_POST['excerpt']]);
    echo "<div class='alert alert-success d-flex align-items-center mb-3'>
            <i class='bi bi-check-circle-fill me-2'></i>Post berhasil ditambahkan!
          </div>";
}

// DELETE POST
if (isset($_GET['delete_post'])) {
    $pdo->prepare("DELETE FROM posts WHERE id = ?")->execute([$_GET['delete_post']]);
    echo "<div class='alert alert-success d-flex align-items-center mb-3'>
            <i class='bi bi-check-circle-fill me-2'></i>Post berhasil dihapus!
          </div>";
}

// SEARCH
$search_results = [];
if (isset($_GET['search'])) {
    $search = '%' . $_GET['search'] . '%';
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE title LIKE ? OR excerpt LIKE ? ORDER BY created_at DESC");
    $stmt->execute([$search, $search]);
    $search_results = $stmt->fetchAll();
}

$posts = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC LIMIT 50")->fetchAll();
?>

<div class="section">
  <div class="section-header">
    <h2 class="h4 mb-0"><i class="bi bi-search me-2"></i>Search Posts</h2>
    <p class="mb-0 opacity-75">Cari berdasarkan title atau excerpt</p>
  </div>
  
  <!-- Search Form -->
  <div class="p-4 border-bottom">
    <form method="GET" class="row g-3">
      <div class="col-md-8">
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-search"></i></span>
          <input type="text" class="form-control" name="search" 
                 value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>" 
                 placeholder="Cari title atau excerpt...">
          <button class="btn btn-primary" type="submit">
            <i class="bi bi-arrow-right-short"></i>
          </button>
        </div>
      </div>
      <div class="col-md-4">
        <a href="?clear=1" class="btn btn-outline-secondary w-100">
          <i class="bi bi-arrow-clockwise"></i> Clear
        </a>
      </div>
    </form>
  </div>

  <!-- Results -->
  <div class="p-4">
    <?php if (!empty($search_results)): ?>
      <h5 class="mb-3"><i class="bi bi-funnel me-1"></i><?php echo count($search_results); ?> hasil ditemukan</h5>
      <?php $display_posts = $search_results; ?>
    <?php else: ?>
      <h5 class="mb-3">Post Terbaru (<?php echo count($posts); ?>)</h5>
      <?php $display_posts = $posts; ?>
    <?php endif; ?>

    <div class="row g-3">
      <?php foreach ($display_posts as $post): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm border-start border-primary border-4">
          <div class="card-body">
            <h6 class="card-title fw-bold"><?php echo htmlspecialchars($post['title']); ?></h6>
            <p class="card-text text-muted small"><?php echo substr(htmlspecialchars($post['excerpt']), 0, 100); ?>...</p>
            <div class="d-flex justify-content-between align-items-end">
              <small class="text-muted"><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></small>
              <div>
                <a href="?delete_post=<?php echo $post['id']; ?>" 
                   class="btn btn-sm btn-outline-danger"
                   onclick="return confirm('Hapus post ini?')">
                  <i class="bi bi-trash"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>