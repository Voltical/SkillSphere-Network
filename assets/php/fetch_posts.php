<?php
// Include database connection (same as above)

$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$stmt = $pdo->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post) {
    echo "<div>";
    echo "<p><strong>User ID:</strong> " . htmlspecialchars($post['user_id']) . "</p>";
    echo "<p>" . nl2br(htmlspecialchars($post['content'])) . "</p>";
    echo "<p><small><em>Posted on: " . $post['created_at'] . "</em></small></p>";
    echo "</div><hr>";
}
?>
