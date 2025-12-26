<?php
require '../config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s",$_POST['username']);
    $stmt->execute();
    $u = $stmt->get_result()->fetch_assoc();

    if ($u && password_verify($_POST['password'], $u['password'])) {
        $_SESSION['user_id'] = $u['id'];
        header("Location: dashboard.php");
        exit;
    }
    $error = "Login failed";
}
?>
<!doctype html>
<html>
<body>
<h1>Admin Login</h1>
<?php if($error): ?><p><?php echo $error; ?></p><?php endif; ?>
<form method="post">
  <input name="username" placeholder="Username" required><br>
  <input type="password" name="password" placeholder="Password" required><br>
  <button>Login</button>
</form>
</body>
</html>
