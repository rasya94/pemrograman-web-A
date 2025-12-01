<?php
session_start();
require_once 'config.php';

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();
    
    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

// Check if logged in
if (!isset($_SESSION['admin_logged_in'])) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Login Admin</title>
    </head>
    <body>
        <h1>Login Admin</h1>
        
        <?php if (isset($error)): ?>
            <p><strong><?php echo $error; ?></strong></p>
        <?php endif; ?>
        
        <form method="POST">
            <p>
                <label>Username:</label><br>
                <input type="text" name="username" required>
            </p>
            <p>
                <label>Password:</label><br>
                <input type="password" name="password" required>
            </p>
            <p>
                <button type="submit" name="login">Login</button>
            </p>
        </form>
        
        <p><a href="index.php">Kembali ke Halaman Utama</a></p>
        <p><em>Default: username = admin, password = admin123</em></p>
    </body>
    </html>
    <?php
    exit;
}

// Fetch all registrations
$stmt = $pdo->query("SELECT * FROM pendaftaran ORDER BY tanggal_daftar DESC");
$pendaftaran = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard - Data Pendaftaran Siswa</h1>
    
    <p><a href="admin.php?logout=1">Logout</a></p>
    
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Cabang</th>
                <th>Kelas</th>
                <th>Bukti Pembayaran</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($pendaftaran) > 0): ?>
                <?php foreach ($pendaftaran as $row): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['telepon']); ?></td>
                        <td><?php echo htmlspecialchars($row['cabang']); ?></td>
                        <td><?php echo htmlspecialchars($row['kelas']); ?></td>
                        <td>
                            <?php 
                            $file_ext = strtolower(pathinfo($row['bukti_pembayaran'], PATHINFO_EXTENSION));
                            if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif'])):
                            ?>
                                <img src="uploads/<?php echo $row['bukti_pembayaran']; ?>" width="200">
                            <?php else: ?>
                                <a href="uploads/<?php echo $row['bukti_pembayaran']; ?>" target="_blank">
                                    Lihat PDF
                                </a>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $row['tanggal_daftar']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Belum ada data pendaftaran</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>