<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../bootstrap.php";
autoload_core();

require_once SRC_PATH . "header.php";

$page_title = "Home - Ayokebandung.id";
?>

<style>
.main-content { padding-top: var(--navbar-height) !important; }
</style>

<script src="<?= JS_URL ?>hero.js" defer></script>
<script src="<?= JS_URL ?>autoslides.js" defer></script>
<script src="<?= JS_URL ?>card-slider.js" defer></script>

<?php

safe_include(SRC_PATH . "partials/hero.php", "Parts Hero Section");
safe_include(SRC_PATH . "partials/kenapa-bandung.php", "Parts Kenapa Bandung");
safe_include(SRC_PATH . "partials/blog-card.php", "Parts Artikel Terbaru");
safe_include(SRC_PATH . "partials/update-card.php", "Parts Update Terkini");
?>
<h1>Is work?</h1>
<?php
require_once SRC_PATH . "footer.php";
?>