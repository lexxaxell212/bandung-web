// 1. Exclude multiple kategori
AND category NOT IN ('blog', 'event', 'page')

// 2. Hanya tampil kategori tertentu
AND category IN ('alam', 'kuliner', 'fashion')

// 3. Exclude + limit
AND category NOT IN ('blog') 
LIMIT 20

// 4. Exclude + kondisi lain
AND category NOT IN ('blog') 
AND excerpt != ''

contoh

<?php 
$page_title = 'Wisata Bandung';
require '../includes/header.php';
require_once '../includes/blog-config.php';

// 🔥 QUERY EXCLUDE KATEGORI TERTENTU
$stmt = $pdo->prepare("
    SELECT * FROM admin_items 
    WHERE status = 'active' 
    AND category NOT IN ('blog', 'event', 'page', 'trending')  // Exclude ini //
    ORDER BY RAND()
");
$stmt->execute();
$all_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>/