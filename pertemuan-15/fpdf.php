<?php
include 'config.php';

$kelas = $_GET['kelas'];
$kelas_safe = mysqli_real_escape_string($koneksi, $kelas);

$query = "SELECT * FROM siswa WHERE kelas = '$kelas_safe' ORDER BY nis ASC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Data Siswa</title>
    <link rel="stylesheet" href="fpdf.css">
</head>
<body>

<div class="print-button">
    <button onclick="window.print()">Cetak PDF</button>
    <a href="index.php">← Kembali</a>
</div>

<div class="container">
    <h2 style="text-align:center;">DAFTAR SISWA</h2>
    <p style="text-align:center;">
        Jurusan: Rekayasa Perangkat Lunak<br>
        Kelas: <?= htmlspecialchars($kelas) ?>
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nis']) ?></td>
                    <td><?= htmlspecialchars($row['nama_siswa']) ?></td>
                    <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                    <td><?= htmlspecialchars($row['kelas']) ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center;">Data tidak ditemukan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <p style="margin-top:15px;font-size:12px;">
        Dicetak pada: <?= date('d-m-Y H:i:s') ?>
    </p>
</div>

<?php mysqli_close($koneksi); ?>
</body>
</html>
