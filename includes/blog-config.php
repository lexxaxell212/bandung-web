<?php
function getBlogPosts($pdo, $limit=12, $category=null, $search=null) {
    $where = ['p.status="active"'];
    $params = [];
    
    if ($category) {
        $where[] = 'c.slug=?';
        $params[] = $category;
    }
    if ($search) {
        $where[] = '(p.title LIKE ? OR p.content LIKE ?)';
        $params[] = '%'.$search.'%';
        $params[] = '%'.$search.'%';
    }
    
    $where_sql = $where ? 'WHERE ' . implode(' AND ', $where) : '';
    
    $sql = "SELECT p.*, c.name cat_name, c.slug cat_slug 
            FROM allcontent_posts p 
            LEFT JOIN allcontent_categories c ON p.category_id = c.id 
            $where_sql 
            ORDER BY p.created_at DESC 
            LIMIT $limit";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function getCategories($pdo) {
    return $pdo->query("SELECT c.*, COUNT(p.id) post_count 
                       FROM allcontent_categories c 
                       LEFT JOIN allcontent_posts p ON c.id=p.category_id AND p.status='active' 
                       GROUP BY c.id ORDER BY c.name")->fetchAll();
}

function getPost($pdo, $id) {
    $stmt = $pdo->prepare('
        SELECT p.*, c.name cat_name, c.slug cat_slug 
        FROM allcontent_posts p 
        LEFT JOIN allcontent_categories c ON p.category_id = c.id 
        WHERE p.id = ? AND p.status = "active"
    ');
    $stmt->execute([$id]);
    $post = $stmt->fetch();
    
    if ($post) {
        // Update views HANYA jika post ditemukan
        $pdo->prepare('UPDATE allcontent_posts SET views = views + 1 WHERE id = ?')->execute([$id]);
    }
    
    return $post;
}

// 🆕 Bonus: Get recent posts untuk sidebar
function getRecentPosts($pdo, $limit=5) {
    $stmt = $pdo->prepare('
        SELECT id, title, excerpt, created_at, views 
        FROM allcontent_posts 
        WHERE status = "active" 
        ORDER BY created_at DESC 
        LIMIT ?
    ');
    $stmt->execute([$limit]);
    return $stmt->fetchAll();
}

?>