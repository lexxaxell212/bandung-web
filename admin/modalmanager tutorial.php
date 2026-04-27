// Di web kamu - ambil berdasarkan ID

$id = 5; // ID modal/card yang mau ditampilkan
$stmt = $pdo->prepare("SELECT * FROM admin_items WHERE id=?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if($item) {
    echo "<div class='card'>";
    echo "<img src='uploads/{$item['image']}' alt='{$item['title']}' class='card-img-top'>";
    echo "<div class='card-body'>";
    echo "<h5>{$item['title']}</h5>";
    echo "<p>{$item['excerpt']}</p>";
    echo "<a href='{$item['button_link']}' class='btn btn-primary'>{$item['type']}</a>";
    echo "</div>";
    echo "</div>";
}