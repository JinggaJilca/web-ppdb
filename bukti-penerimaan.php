<?php
require_once "core/init.php";
require_once "fpdf/fpdf.php";

if (!isset($_SESSION['user'])) {
    $_SESSION['msg'] = "";
    $error = "Anda Harus Masuk Terlebih Dahulu";
    header('Location: masuk.php');
}

if (isset($_SESSION['logout'])) {
    $error = "Anda Harus Keluar Terlebih Dahulu";
    unset($_SESSION['logout']);
}

$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 20);
// Space
$pdf->Cell(189, 30, '', 0, 1);

// Logo
$image = "asset/logo.png";
$pdf->Image($image, 95, 22, 17, 17);

//Judul
$pdf->Cell(189, 15, 'BUKTI PENERIMAAN', 0, 1, 'C');

//Sub Judul
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(189, 0, 'Peserta Didik Baru SMK Negeri 1 Kertosono', 0, 1, 'C');

// Space
$pdf->Cell(189, 10, '', 0, 1);

//Contents
$pdf->SetFont('helvetica', '', 12);

if (cek_role($_SESSION['user'])) {
    $id = $_GET['id'];
    $table = tampilkan('id', $id);
    while ($row = mysqli_fetch_assoc($table)) {

        $pdf->Cell(25, 10, '', 0, 0);
        $pdf->Cell(50, 10, 'Nama Lengkap', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0);
        $pdf->Cell(84, 10, $row['nama'], 0, 1);
        //Line Baru
        $pdf->Cell(25, 10, '', 0, 0);
        $pdf->Cell(50, 10, 'Email', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0);
        $pdf->Cell(84, 10, $row['email'], 0, 1);
        //Line Baru
        $pdf->Cell(25, 10, '', 0, 0);
        $pdf->Cell(50, 10, 'Tanggal Lahir', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0);
        $pdf->Cell(84, 10, $row['tanggal'], 0, 1);
        //Line Baru
        $pdf->Cell(25, 10, '', 0, 0);
        $pdf->Cell(50, 10, 'No.Telepon', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0);
        $pdf->Cell(84, 10, $row['telp'], 0, 1);
        //Line Baru
        $pdf->Cell(25, 10, '', 0, 0);
        $pdf->Cell(50, 10, 'Jenis Kelamin (L/P)', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0);
        $pdf->Cell(84, 10, $row['gender'], 0, 1);
        //Line Baru
        $pdf->Cell(25, 10, '', 0, 0);
        $pdf->Cell(50, 10, 'Alamat Rumah', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0);
        $pdf->Cell(84, 10, $row['alamat'], 0, 1);
        //Line Baru
        $pdf->Cell(25, 10, '', 0, 0);
        $pdf->Cell(50, 10, 'Kode Seragam', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0);
        $pdf->Cell(84, 10, $row['kode_seragam'], 0, 1);
        //Line Baru
        $pdf->Cell(25, 10, '', 0, 0);
        $pdf->Cell(50, 10, 'Kode Buku', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0);
        $pdf->Cell(84, 10, $row['kode_buku'], 0, 1);
        //Line Baru

        // Space
        $pdf->Cell(189, 10, '', 0, 1);
        
        //Status Penerimaan                
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(189, 7, 'STATUS PENERIMAAN', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(189, 7, "Diterima di", 0, 1, "C");

        // Jurusan
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(189, 7, 'SMK NEGERI 1 KERTOSONO', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(189, 7, $row['jurusan'], 0, 1, "C");
    }
} else {
    $table = tampilkan_single($_SESSION['user']);
    while ($row = mysqli_fetch_assoc($table)) {

        $pdf->Cell(25, 10, '', 0, 0);
        $pdf->Cell(50, 10, 'Nama Lengkap', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0);
        $pdf->Cell(84, 10, $row['nama'], 0, 1);
        //Line Baru
        $pdf->Cell(25, 10, '', 0, 0);
        $pdf->Cell(50, 10, 'Email', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0);
        $pdf->Cell(84, 10, $row['email'], 0, 1);
        //Line Baru
        $pdf->Cell(25, 10, '', 0, 0);
        $pdf->Cell(50, 10, 'Tanggal Lahir', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0);
        $pdf->Cell(84, 10, $row['tanggal'], 0, 1);
        //Line Baru
        $pdf->Cell(25, 10, '', 0, 0);
        $pdf->Cell(50, 10, 'No.Telepon', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0);
        $pdf->Cell(84, 10, $row['telp'], 0, 1);
        //Line Baru
        $pdf->Cell(25, 10, '', 0, 0);
        $pdf->Cell(50, 10, 'Jenis Kelamin (L/P)', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0);
        $pdf->Cell(84, 10, $row['gender'], 0, 1);
        //Line Baru
        $pdf->Cell(25, 10, '', 0, 0);
        $pdf->Cell(50, 10, 'Alamat Rumah', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0);
        $pdf->Cell(84, 10, $row['alamat'], 0, 1);
        //Line Baru
        $pdf->Cell(25, 10, '', 0, 0);
        $pdf->Cell(50, 10, 'Kode Seragam', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0);
        $pdf->Cell(84, 10, $row['kode_seragam'], 0, 1);
        //Line Baru
        $pdf->Cell(25, 10, '', 0, 0);
        $pdf->Cell(50, 10, 'Kode Buku', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0);
        $pdf->Cell(84, 10,'*'.$row['kode_buku'], 0, 1);
        //Line Baru

        //Status Penerimaan
        $pdf->Cell(25, 15, '', 0, 1);
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(189, 7, 'STATUS PENERIMAAN', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(189, 7, "Diterima di", 0, 1, "C");

        // Jurusan
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(189, 7, 'SMK NEGERI 1 KERTOSONO', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(189, 7, $row['jurusan'], 0, 1, "C");

    }
}
$pdf->SetFont('helvetica','I', 10);
$pdf->Cell(150,25,"*Pengukuran seragam menunggu informasi lebih lanjut.",0,1);

$pdf->Output("Bukti Penerimaan.pdf", "I");
?>