VARIABEL

// getBlogPosts() & getPost() return:
Array (
    [id] => 1
    [category_id] => 1
    [title] => "Judul Blog"
    [excerpt] => "Ringkasan singkat..."
    [content] => "<p>Konten lengkap HTML...</p>"
    [url_main] => "https://source.com/post"
    [url_second] => "https://backup.com/post"
    [source_domain] => "blogbandung.com"
    [published_date] => "2024-01-15 10:30:00"
    [author] => "John Doe"
    [image_url] => "https://example.com/image.jpg"
    [status] => "active"
    [views] => 1250
    [created_at] => "2024-01-15 10:30:00"
    [updated_at] => "2024-01-15 10:30:00"
    [cat_name] => "Wisata Bandung"      ← JOIN category
    [cat_slug] => "wisata-bandung"     ← JOIN category
)


EXAMPLE :

<?php 
$lib_path = dirname(__DIR__) . '/lib/functions.php';
if (!file_exists($lib_path)) die('lib/functions.php missing: ' . $lib_path);
require_once $lib_path;
autoload_core();
session_start(); //USE LIB/FUNCTIONS DIR 

require_once '../includes/blog-config.php';// VARIBEL DEFINE 

$id = $_GET['id'] ?? 0; //id post
$post = getPost($pdo, $id); // Ambil Single post

if (!$post) die('Post not found');

?>

<div class="container">
 <h1><?= htmlspecialchars($post['title']) ?></h1>
 
 <!-- IMAGE -->
 <?php if ($post['image_url']): ?>
  <img src="<?= $post['image_url'] ?>" class="img-fluid mb-4" alt="">
 <?php endif; ?>
 
 <!-- EXCERPT -->
 <?php if ($post['excerpt']): ?>
  <div class="alert alert-info"><?= $post['excerpt'] ?></div>
 <?php endif; ?>
 
 <!-- KONTEN UTAMA (HTML langsung) -->
 <div class="post-content">
  <?= $post['content'] ?>
 </div>
 
 <!-- META -->
 <div class="mt-4 p-3 bg-light rounded">
  <small>
   Kategori: <strong><?= $post['cat_name'] ?></strong><br>
   Penulis: <?= $post['author'] ?? 'Admin' ?><br>
   Dipublikasi: <?= date('d M Y H:i', strtotime($post['published_date'] ?? $post['created_at'])) ?><br>
   Dibaca: <?= number_format($post['views']) ?> kali<br>
   <a href="<?= $post['url_main'] ?>" target="_blank">Sumber asli</a>
  </small>
 </div>
</div>