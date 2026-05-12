<?php
$page_title = "Home - Ayokebandung.id";
require_once "includes/header.php";
?>
<style>
.main-content { padding-top: var(--navbar-height) !important; }
</style>

<script src="<?= JS_URL ?>hero.js" defer></script>
<script src="<?= JS_URL ?>autoslides.js" defer></script>
<script src="<?= JS_URL ?>card-slider.js" defer></script>

<?php
function safe_include($file_path, $fallback_title = "Konten")
{
  if (!file_exists($file_path)) {
    echo fallback_card($fallback_title);
    return;
  }
  ob_start();
  try {
    include $file_path;
    ob_end_flush();
  } catch (Throwable $e) {
    ob_end_clean();
    echo fallback_card($fallback_title);
  }
}
function fallback_card($title = "Konten")
{
  return '
    <div class="container py-6">
      <div class="row mx-auto">
        <div class="col-12">
            <div class="card card-glass">
                <div class="card-body text-center py-5">
                    <i class="fas fa-circle-notch fa-spin fa-1x text-muted mb-3"></i>
                    <h5 class="text-muted mb-1">' .
    htmlspecialchars($title) .
    '</h5>
                    <p class="text-muted small mb-0">Sedang dalam perbaikan.</p>
                </div>
            </div>
        </div>
      </div>
    </div>';
}
safe_include("parts/hero.php", "Parts Hero Section");
safe_include("parts/kenapa-bandung.php", "Parts Kenapa Bandung");
safe_include("parts/blog-card.php", "Parts Artikel Terbaru");
safe_include("parts/update-card.php", "Parts Update Terkini");
?>

<?php require "includes/footer.php";
?>