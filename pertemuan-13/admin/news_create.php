<?php
require '../functions.php';
require_login();

$categories = $conn->query("SELECT id,name FROM categories");
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $category_id = intval($_POST['category_id']);
    $status = $_POST['status'];
    $slug = slugify($title);
    $image = null;

    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'png', 'webp'])) {
            $error = "Invalid image type";
        } else {
            $image = time() . '_' . $slug . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/$image");
        }
    }

    if (!$error) {
        $stmt = $conn->prepare(
            "INSERT INTO news
           (title,slug,content,image,category_id,author_id,status,published_at)
           VALUES (?,?,?,?,?,?,?,NOW())"
        );
        $stmt->bind_param(
            "ssssiss",
            $title,
            $slug,
            $content,
            $image,
            $category_id,
            $user_id,
            $status
        );
        $stmt->execute();
        header("Location: dashboard.php");
        exit;
    }
}
?>
<!doctype html>
<html>

<body>
    <h1>Create News</h1>
    <?php if ($error): ?>
        <p><?php echo $error; ?></p><?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <input name="title" placeholder="Title" required><br>

        <select name="category_id">
            <?php while ($c = $categories->fetch_assoc()): ?>
                <option value="<?php echo $c['id']; ?>">
                    <?php echo $c['name']; ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        <textarea name="content" rows="8" placeholder="Content"></textarea><br>
        <input type="file" name="image"><br>

        <select name="status">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select><br>

        <button>Save</button>
    </form>
</body>

</html>