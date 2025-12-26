<?php
require 'functions.php';

$id = intval($_GET['id'] ?? 0);

$cat = $conn->prepare("SELECT * FROM categories WHERE id=?");
$cat->bind_param("i", $id);
$cat->execute();
$category = $cat->get_result()->fetch_assoc();
if (!$category)
    die("Category not found");

$news = $conn->prepare(
    "SELECT id,title,published_at
  FROM news WHERE category_id=? AND status='published'
  ORDER BY published_at DESC"
);
$news->bind_param("i", $id);
$news->execute();
$result = $news->get_result();
?>
<!doctype html>
<html>

<body>
    <h1>Category: <?php echo $category['name']; ?></h1>

    <?php while ($n = $result->fetch_assoc()): ?>
        <article>
            <h3><a href="news.php?id=<?php echo $n['id']; ?>">
                    <?php echo htmlspecialchars($n['title']); ?>
                </a></h3>
            <p><?php echo $n['published_at']; ?></p>
        </article>
    <?php endwhile; ?>

    <a href="index.php">Home</a>
</body>

</html>