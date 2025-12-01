<?php
require_once 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $cabang = $_POST['cabang'];
    $kelas = $_POST['kelas'];

    if (isset($_FILES['bukti_pembayaran']) && $_FILES['bukti_pembayaran']['error'] == 0) {
        $upload_dir = 'uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_name = time() . '_' . basename($_FILES['bukti_pembayaran']['name']);
        $target_file = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['bukti_pembayaran']['tmp_name'], $target_file)) {

            $stmt = $pdo->prepare("INSERT INTO pendaftaran (nama, email, telepon, cabang, kelas, bukti_pembayaran) VALUES (?, ?, ?, ?, ?, ?)");

            if ($stmt->execute([$nama, $email, $telepon, $cabang, $kelas, $file_name])) {
                $message = "Pendaftaran berhasil!";
            } else {
                $message = "Error: Gagal menyimpan data.";
            }
        } else {
            $message = "Error: Gagal upload file.";
        }
    } else {
        $message = "Error: File bukti pembayaran harus diupload.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Pendaftaran Siswa</title>
</head>

<body>
    <h1>Form Pendaftaran Siswa</h1>

    <?php if ($message): ?>
        <p><strong><?php echo $message; ?></strong></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <p>
            <label>Nama Lengkap:</label><br>
            <input type="text" name="nama" required>
        </p>

        <p>
            <label>Email:</label><br>
            <input type="email" name="email" required>
        </p>

        <p>
            <label>Telepon:</label><br>
            <input type="text" name="telepon" required>
        </p>

        <p>
            <label>Cabang:</label><br>
            <select name="cabang" required>
                <option value="">-- Pilih Cabang --</option>
                <option value="Jakarta">Jakarta</option>
                <option value="Bandung">Bandung</option>
                <option value="Surabaya">Surabaya</option>
                <option value="Medan">Medan</option>
            </select>
        </p>

        <p>
            <label>Kelas:</label><br>
            <select name="kelas" required>
                <option value="">-- Pilih Kelas --</option>
                <option value="Kelas A">Kelas A</option>
                <option value="Kelas B">Kelas B</option>
                <option value="Kelas C">Kelas C</option>
            </select>
        </p>

        <p>
            <label>Bukti Pembayaran:</label><br>
            <input type="file" name="bukti_pembayaran" accept="image/*,.pdf" required>
        </p>

        <p>
            <button type="submit">Daftar</button>
        </p>
    </form>

    <p><a href="index.php">Kembali ke Halaman Utama</a></p>
</body>

</html>