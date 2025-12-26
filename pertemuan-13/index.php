<?php
require 'functions.php';

$result = $conn->query(
    "SELECT n.id,n.title,n.image,n.published_at,c.name
   FROM news n
   LEFT JOIN categories c ON c.id=n.category_id
   WHERE n.status='published'
   ORDER BY n.published_at DESC"
);
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Simple News Portal</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="top-header">
        <h1 style="color: white;">News Portal</h1>
    </div>
    <h2 style=" padding-left: 20px;">Berita Terkini</h2>

    <div style="padding-left:20px;">
        <?php while ($n = $result->fetch_assoc()): ?>
            <article class="news-thumbnail"
                style="margin-bottom:12px; display:flex; gap:12px; align-items:flex-start; background: #e9e9e9; padding:10px;">

                <img src="uploads/<?php echo htmlspecialchars($n['image']); ?>">

                <div>
                    <h3 style="margin:0 0 6px 0;">
                        <a href="news.php?id=<?php echo (int) $n['id']; ?>">
                            <?php echo htmlspecialchars($n['title']); ?>
                        </a>
                    </h3>
                    <p style="margin:0;color:#333;font-size:0.95em;">
                        <?php echo htmlspecialchars($n['name']); ?> — <?php echo htmlspecialchars($n['published_at']); ?>
                    </p>
                </div>
            </article>
        <?php endwhile; ?>
    </div>

</body>

</html>