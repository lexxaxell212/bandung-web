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

$posts = getBlogPosts($pdo, 10); //Ambil semua konten dengan grid/list
?>


<!-- Tampilkan KONTEN -->
<?php foreach($posts as $post): ?>
<div class="card mb-3">
 <div class="card-body">
  <h5><?= htmlspecialchars($post['title']) ?></h5>
  
  <!-- Excerpt (ringkasan) -->
  <p><?= htmlspecialchars($post['excerpt'] ?: substr(strip_tags($post['content']), 0, 150)) ?>...</p>
  
  <!-- Konten FULL (HTML OK) -->
  <div class="post-content"><?= $post['content'] ?></div>
  
  <!-- Meta data -->
  <small class="text-muted">
   <?= $post['cat_name'] ?> | 
   <?= date('d M Y', strtotime($post['created_at'])) ?> | 
   <?= $post['views'] ?> views | 
   <a href="<?= $post['url_main'] ?>" target="_blank"><?= $post['source_domain'] ?></a>
  </small>
  
  <a href="blog-detail.php?id=<?= $post['id'] ?>">Baca lengkap</a>
 </div>
</div>
<?php endforeach; ?>