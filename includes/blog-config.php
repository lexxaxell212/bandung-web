<?php
// Call me if u catch Blog Content
function getBlogPosts($pdo, $limit = 12, $category = null, $search = null)
{
  $where = ['p.status="active"'];
  $params = [];
  if ($category) {
    $where[] = "c.slug=?";
    $params[] = $category;
  }
  if ($search) {
    $where[] = "(p.title LIKE ? OR p.content LIKE ?)";
    $params[] = "%" . $search . "%";
    $params[] = "%" . $search . "%";
  }
  $where_sql = $where ? "WHERE " . implode(" AND ", $where) : "";
  $sql = "SELECT p.*, c.name cat_name, c.slug cat_slug 
            FROM allcontent_posts p 
            LEFT JOIN allcontent_categories c ON p.category_id = c.id 
            $where_sql 
            ORDER BY p.created_at DESC 
            LIMIT ?";
  $stmt = $pdo->prepare($sql);
  $params[] = $limit;
  $stmt->execute($params);
  return $stmt->fetchAll();
}
function getCategories($pdo)
{
  $stmt = $pdo->prepare("
        SELECT c.*, COUNT(p.id) post_count 
        FROM allcontent_categories c 
        LEFT JOIN allcontent_posts p ON c.id=p.category_id AND p.status='active' 
        GROUP BY c.id ORDER BY c.name
    ");
  $stmt->execute();
  return $stmt->fetchAll();
}
function getPost($pdo, $id)
{
  $stmt = $pdo->prepare('
        SELECT p.*, c.name cat_name, c.slug cat_slug 
        FROM allcontent_posts p 
        LEFT JOIN allcontent_categories c ON p.category_id = c.id 
        WHERE p.id = ? AND p.status = "active"
    ');
  $stmt->execute([$id]);
  $post = $stmt->fetch();
  if ($post) {
    $pdo
      ->prepare("UPDATE allcontent_posts SET views = views + 1 WHERE id = ?")
      ->execute([$id]);
  }
  return $post;
}
function getRecentPosts($pdo, $limit = 5)
{
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
function safe_get_post(PDO $pdo, int $id): array|false
{
  $stmt = $pdo->prepare(
    'SELECT p.*, c.name AS cat_name, p.image_url AS image
         FROM allcontent_posts p
         LEFT JOIN allcontent_categories c ON p.category_id = c.id
         WHERE p.id = ? AND p.status = ?',
  );
  $stmt->execute([(int) $id, "active"]);
  return $stmt->fetch();
}
function safe_get_posts(
  PDO $pdo,
  int $limit,
  int $offset,
  int $cat_id = 0,
): array {
  $limit = max(1, (int) $limit);
  $offset = max(0, (int) $offset);
  $cat_id = (int) $cat_id;
  if ($cat_id > 0) {
    $sql = "
            SELECT p.id, p.title, p.excerpt, p.content, p.created_at, p.views,
            p.category_id, p.image_url AS image, c.name AS cat_name 
            FROM allcontent_posts p
            LEFT JOIN allcontent_categories c ON p.category_id = c.id
            WHERE p.status = 'active' AND p.category_id = $cat_id
            ORDER BY p.created_at DESC 
            LIMIT $limit OFFSET $offset
        ";
  } else {
    $sql = "
            SELECT p.id, p.title, p.excerpt, p.content, p.created_at, p.views,
            p.category_id, p.image_url AS image, c.name AS cat_name 
            FROM allcontent_posts p
            LEFT JOIN allcontent_categories c ON p.category_id = c.id
            WHERE p.status = 'active'
            ORDER BY p.created_at DESC 
            LIMIT $limit OFFSET $offset
        ";
  }
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function safe_count_posts(PDO $pdo, int $cat_id = 0): int
{
  if ($cat_id > 0) {
    $stmt = $pdo->prepare(
      "SELECT COUNT(*) FROM allcontent_posts WHERE status = ? AND category_id = ?",
    );
    $stmt->execute(["active", $cat_id]);
  } else {
    $stmt = $pdo->prepare(
      "SELECT COUNT(*) FROM allcontent_posts WHERE status = ?",
    );
    $stmt->execute(["active"]);
  }
  return (int) $stmt->fetchColumn();
}
function safe_get_categories(PDO $pdo): array
{
  $stmt = $pdo->prepare(
    'SELECT c.*, COUNT(p.id) AS post_count
         FROM allcontent_categories c
         LEFT JOIN allcontent_posts p ON p.category_id = c.id AND p.status = ?
         GROUP BY c.id ORDER BY c.name',
  );
  $stmt->execute(["active"]);
  return $stmt->fetchAll();
}
// HELPER FUNCTIONS (Universal)
function fix_image_paths(string $html, string $post_title = ""): string
{
  $base = rtrim(BASE_UPLOAD_URL, "/") . "/";
  $safe_alt = htmlspecialchars(
    $post_title ?: "Gambar artikel",
    ENT_QUOTES,
    "UTF-8",
  );
  return preg_replace_callback(
    '/<img([^>]*?)\ssrc="uploads\/([^"]*)"([^>]*?)(\s*\/?>)/i',
    function (array $m) use ($base, $safe_alt): string {
      [$full, $before, $filename, $after, $close] = $m;
      if (!preg_match('/^[\w\-\.]+\.(jpg|jpeg|png|gif|webp)$/i', $filename)) {
        return "";
      }
      $safe_src = htmlspecialchars($base . $filename, ENT_QUOTES, "UTF-8");
      $has_alt = (bool) preg_match("/\balt\s*=/i", $before . $after);
      $alt_attr = $has_alt ? "" : ' alt="' . $safe_alt . '"';
      return "<img" .
        $before .
        ' src="' .
        $safe_src .
        '"' .
        $after .
        $alt_attr .
        $close;
    },
    $html,
  ) ?? $html;
}
function sanitize_content(string $html, string $post_title = ""): string
{
  $allowed =
    "<p><br><b><i><u><s><strong><em><ul><ol><li><blockquote><h1><h2><h3><h4><h5><h6><a><img><span><div><figure><figcaption><table><thead><tbody><tr><th><td>";
  return fix_image_paths(strip_tags($html, $allowed), $post_title);
}

function safe_excerpt(string $raw, int $max = 160): string
{
  $plain = strip_tags($raw);
  if (mb_strlen($plain) > $max) {
    $cut = mb_substr($plain, 0, $max);
    $last_space = mb_strrpos($cut, " ");
    $plain =
      ($last_space !== false ? mb_substr($cut, 0, $last_space) : $cut) . "…";
  }
  return htmlspecialchars($plain, ENT_QUOTES, "UTF-8");
}

function fmt_date(string $val, string $fmt = "d M Y"): string
{
  $ts = strtotime($val);
  return $ts !== false ? date($fmt, $ts) : "-";
}
?>