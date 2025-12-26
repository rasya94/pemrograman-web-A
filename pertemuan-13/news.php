<?php
require 'functions.php';

$id = intval($_GET['id'] ?? 0);

$stmt = $conn->prepare(
    "SELECT n.*,c.name,u.fullname
  FROM news n
  LEFT JOIN categories c ON c.id=n.category_id
  LEFT JOIN users u ON u.id=n.author_id
  WHERE n.id=? AND n.status='published'"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$n = $stmt->get_result()->fetch_assoc();

if (!$n)
    die("News not found");
?>
<!doctype html>
<html>

<body>
    <h1><?php echo htmlspecialchars($n['title']); ?></h1>
    <p><?php echo $n['name']; ?> — <?php echo $n['published_at']; ?> — <?php echo $n['fullname']; ?></p>

    <?php if ($n['image']): ?>
        <img src="uploads/<?php echo $n['image']; ?>">
    <?php endif; ?>

    <p><?php echo nl2br(htmlspecialchars($n['content'])); ?></p>
    <a href="index.php">Back</a>
</body>

</html>