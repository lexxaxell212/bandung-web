<?php

function generateUniqueSlug($pdo, $base_slug) {
    $slug = rtrim($base_slug, '-');
    $counter = 1;
    while (true) {
        $check_slug = $counter === 1 ? $slug : $slug . '-' . $counter;
        $stmt = $pdo->prepare("SELECT id FROM pages WHERE slug = ?");
        $stmt->execute([$check_slug]);
        if (!$stmt->fetch()) {
            return $check_slug;
        }
        $counter++;
    }
}

function generateStaticPage($slug, $html_content) {
    $pages_dir = '../../pages/';
    $page_dir = $pages_dir . $slug . '/';
    
    try {
        if (!is_dir($page_dir)) {
            mkdir($page_dir, 0755, true);
        }
        
        $file = $page_dir . 'index.php';
        $content = "<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>" . addslashes($slug) . "</title>
</head>
<body>
    " . $html_content . "
</body>
</html>";
        
        $result = file_put_contents($file, $content);
        
        if ($result === false) {
            return false;
        }
        
        $htaccess = $page_dir . '.htaccess';
        $htaccess_content = "RewriteEngine On
DirectoryIndex index.php";
        file_put_contents($htaccess, $htaccess_content);
        
        chmod($file, 0644);
        chmod($page_dir, 0755);
        
        return true;
        
    } catch (Exception $e) {
        return false;
    }
}

function deletePageFiles($slug) {
    $dir = realpath('../../pages/' . $slug);
    
    if (!$dir || !is_dir($dir)) {
        return true;
    }
    
    try {
        return deleteDirectory($dir);
    } catch (Exception $e) {
        return false;
    }
}

function deleteDirectory($dir) {
    if (!is_dir($dir)) {
        return true;
    }
    
    $files = array_diff(scandir($dir), ['.', '..']);
    
    foreach ($files as $file) {
        $filePath = $dir . '/' . $file;
        
        if (is_dir($filePath)) {
            deleteDirectory($filePath);
        } else {
            unlink($filePath);
        }
    }
    
    return rmdir($dir);
}

?>