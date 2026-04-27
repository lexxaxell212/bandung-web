<?php
require_once '../includes/header.php';
require_once '../includes/blog-config.php';

$id = $_GET['id'] ?? 0;

if ($id && is_numeric($id)) {
    $post = getPost($pdo, $id);
    if (!$post) {
        http_response_code(404);
        include '404.php';
        exit;
    }
    $posts = [];
} else {
    $posts = getBlogPosts($pdo, 12);
    $post = null;
}
$categories = getCategories($pdo);

?>

<title><?= $post ? htmlspecialchars($post['title']) . ' - ' : '' ?>Blog</title>


<div class="container mt-4">
 <?php if ($post): // SINGLE POST VIEW ?>
  <!-- Single post HTML  -->
  <div class="row">
   <div class="col-lg-8">
    <h1><?= htmlspecialchars($post['title']) ?></h1>
    <div><?= $post['content'] ?></div>
    <a href="/blogs/" class="mt-5 btn btn-primary">Kembali</a>
   </div>
  </div>
  
 <?php else: // BLOG LIST ?>
  <div class="row">
   <div class="col-md-8">
    <div class="mb-4">
      <h1 class="text-title">Blogs</h1>
    </div>
    <?php foreach ($posts as $p): ?>
     <div class="card card-glass mb-3">
      <div class="card-body">
       <h5><a href="/blogs/?id=<?= $p['id'] ?>"><?= htmlspecialchars($p['title']) ?></a></h5>
       <small><?= $p['cat_name'] ?> • <?= date('d M Y', strtotime($p['created_at'])) ?></small>
      </div>
     </div>
    <?php endforeach; ?>
   </div>
   <div class="col-md-4 mt-6">
    <h6 class="mt-6">Kategori</h6>
    <?php foreach ($categories as $cat): ?>
     <a href="#" class="mb-3 text-white badge bg-primary"><?= $cat['name'] ?> (<?= $cat['post_count'] ?>)</a><br>
    <?php endforeach; ?>
   </div>
  </div>
 <?php endif; ?>
</div>

<?php 
require '../includes/footer.php';
?>