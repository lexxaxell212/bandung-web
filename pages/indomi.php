<?php
$lib_path = dirname(__DIR__) . "/lib/loader.php";
if (!file_exists($lib_path)) die("lib/loader.php missing: " . $lib_path);
require_once $lib_path;
autoload_core();
?>
<h1>
 Loaded.
</h1>
