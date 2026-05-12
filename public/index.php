<?php
require_once __DIR__ . "/../bootstrap.php";
autoload_core();

require_once __DIR__ . "/router.php";
resolve_route();

// setelah ini baru home content
$page_title = "Home - Ayokebandung.id";
require_once SRC_PATH . "header.php";
require_once LIB_PATH . "mailer.php";
require_once LIB_PATH . "subscriber.php";
?>
<style>
.main-content { padding-top: var(--navbar-height) !important; }
</style>
<script src="<?= JS_URL ?>hero.js" defer></script>
<script src="<?= JS_URL ?>autoslides.js" defer></script>
<script src="<?= JS_URL ?>card-slider.js" defer></script>
<?php
safe_include(SRC_PATH . "partials/part-hero.php", "Parts Hero Section");
safe_include(SRC_PATH . "partials/part-kenapa.php", "Parts Kenapa Bandung");
safe_include(SRC_PATH . "partials/part-blogs.php", "Parts Artikel Terbaru");
safe_include(SRC_PATH . "partials/part-informasi.php", "Parts Update Terkini");
?>
<?php require_once SRC_PATH . "footer.php"; ?>