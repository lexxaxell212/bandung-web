<?php
require_once __DIR__ . "/../bootstrap.php";
autoload_core();

// Jalankan Router
require_once __DIR__ . "/router.php"; 

$page_title = $page_title ?? "Ayokebandung.id";

require_once SRC_PATH . "header.php";
?>

<style>
.main-content { padding-top: var(--navbar-height) !important; }
</style>

<div class="main-content">
    <?php 
    if (isset($view_content) && file_exists($view_content)) {
        require_once $view_content;
    } else {
        require_once SRC_PATH . "errors/404.php";
    }
    ?>
</div>

<?php 
require_once SRC_PATH . "footer.php"; 
?>
