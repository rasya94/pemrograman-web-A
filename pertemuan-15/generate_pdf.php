<?php
include 'config.php';
require('fpdf.php');

$kelas = isset($_GET['kelas']) ? trim($_GET['kelas']) : '';
$safe_kelas = mysqli_real_escape_string($koneksi, $kelas);

$query = "SELECT * FROM siswa";
if ($kelas !== '') {
    $query .= " WHERE kelas = '$safe_kelas'";
}
$query .= " ORDER BY nis ASC";

$result = mysqli_query($koneksi, $query);

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 8, 'DAFTAR SISWA', 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$subtitle = ($kelas !== '') ? 'Kelas: ' . $kelas : 'Semua Kelas';
$pdf->Cell(0, 6, $subtitle, 0, 1, 'C');
$pdf->Ln(4);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(220, 230, 240);
$pdf->Cell(10, 8, 'No', 1, 0, 'C', true);
$pdf->Cell(30, 8, 'NIS', 1, 0, 'C', true);
$pdf->Cell(80, 8, 'Nama Siswa', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Jenis Kelamin', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Kelas', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 10);
if ($result && mysqli_num_rows($result) > 0) {
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(10, 7, $no++, 1, 0, 'C');
        $pdf->Cell(30, 7, $row['nis'], 1, 0, 'C');
        $pdf->Cell(80, 7, $row['nama_siswa'], 1, 0, 'L');
        $pdf->Cell(35, 7, $row['jenis_kelamin'], 1, 0, 'C');
        $pdf->Cell(35, 7, $row['kelas'], 1, 1, 'C');
    }
} else {
    $pdf->Cell(190, 7, 'Tidak ada data siswa.', 1, 1, 'C');
}

$pdf->Ln(6);
$pdf->SetFont('Arial', 'I', 9);
$pdf->Cell(0, 5, 'Dicetak pada: ' . date('d-m-Y H:i:s'), 0, 1, 'L');

$filename = ($kelas !== '')
    ? 'DaftarSiswa_' . preg_replace('/\s+/', '_', $kelas) . '.pdf' : 'DaftarSiswa_SemuaKelas.pdf';

$pdf->Output('I', $filename);

$koneksi->close();
