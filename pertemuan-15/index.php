<?php
include 'config.php';

$kelas = isset($_GET['kelas']) ? trim($_GET['kelas']) : 'XII';
$safe_kelas = mysqli_real_escape_string($koneksi, $kelas);

$query = "SELECT * FROM siswa WHERE kelas = '$safe_kelas' ORDER BY nis ASC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Daftar Siswa - <?php echo htmlspecialchars($kelas); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="print-button">
        <button onclick="window.print()">🖨️ Cetak PDF</button>
        <a href="index.php" class="back-button">Refresh</a>
    </div>

    <div class="container">
        <header class="header">
            <h1>DAFTAR SISWA</h1>
            <p>SMA Lorem Ipsum — Kelas: <?php echo htmlspecialchars($kelas); ?></p>
        </header>

        <table>
            <thead>
                <tr>
                    <th style="width:5%;">No</th>
                    <th style="width:18%;">NIS</th>
                    <th style="width:45%;">Nama Siswa</th>
                    <th style="width:16%;">Jenis Kelamin</th>
                    <th style="width:16%;">Kelas</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['nis']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_siswa']); ?></td>
                            <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                            <td><?php echo htmlspecialchars($row['kelas']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5" style="text-align:center;">Tidak ada data siswa untuk kelas ini.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php mysqli_close($koneksi); ?>
</body>
</html>
