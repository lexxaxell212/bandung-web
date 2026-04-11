<?php
http_response_code(404);
$page_title = "404 - MyApp";
require_once 'config/config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    
</head>

<body>

    <div class="page-container mt-5">
        <div class="row justify-content-center text-center">
            <div class="col-md-6">
                <h1>404</h1>
                <h2>Halaman Yang Kamu Cari Tidak Ada</h2>
            </div>
        </div>
    </div>
    
    <div style="margin-top:-120px">
    <?php
    
    require_once 'search.php'; ?>
    </div>

</body>

</html>