<?php
http_response_code(404);
$page_title = '404 page';
require_once '../includes/header.php';
?>
<div class="text-center my-10 flex flex-col justify-center items-center">
  <h1 class="font-bold text-title" style="font-size:6rem;">
    404
  </h1>
  <p class="text-muted">
    Mohon maaf halaman yang kamu cari tidak ada.
  </p>
  <a href="<?php echo BLOG_URL; ?>">
   <button class="btn btn-primary mt-3">
    Kembali
   </button>
  </a>
</div>

<?php
require '../includes/footer.php';
?>