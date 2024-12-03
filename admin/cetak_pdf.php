<?php
require_once('../tcpdf/tcpdf.php');
include '../koneksi.php';
session_start();

if($_SESSION['status'] != 'login'){
    session_unset();
    session_destroy();
    header("location:../");
}

class MYPDF extends TCPDF {
    public function Header() {
        $this->SetFont('helvetica', 'B', 16);
        $this->Cell(0, 30, 'Laporan Pembayaran Kursus', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Halaman '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C');
    }
}

// Create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Course Payment System');
$pdf->SetAuthor('Administrator');
$pdf->SetTitle('Laporan Pembayaran Kursus');

// Set margins
$pdf->SetMargins(15, 40, 15);
$pdf->SetHeaderMargin(20);
$pdf->SetFooterMargin(10);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 25);

// Add a page
$pdf->AddPage();

if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(0, 10, 'Periode: '.date('d/m/Y', strtotime($_GET['start_date'])).' - '.date('d/m/Y', strtotime($_GET['end_date'])), 0, 1, 'L');
    $pdf->Ln(5); // Spacing
}

// Fetch kelas data for price table
$query_kelas = "SELECT * FROM kelas_221047 ORDER BY nama_kelas_221047";
$result_kelas = mysqli_query($koneksi, $query_kelas);

// Add Price Information Section
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Daftar Harga Kursus', 0, 1, 'L');
$pdf->Ln(2);

// Price Table Header
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetFillColor(230, 236, 240);
$pdf->SetDrawColor(128, 128, 128);

// Define width for price table
$w_price = array(10, 50, 40, 40, 40);
$header_price = array('No', 'Nama Kelas', 'Harga/Bulan', '6 Bulan (5%)', '12 Bulan (10%)');

// Print price table header
foreach($header_price as $i => $h) {
    $pdf->Cell($w_price[$i], 8, $h, 1, 0, 'C', true);
}
$pdf->Ln();

// Price Table Content
$pdf->SetFont('helvetica', '', 9);
$pdf->SetFillColor(245, 248, 250);
$no = 1;
$fill = false;

while($row = mysqli_fetch_array($result_kelas)) {
    $harga_normal = $row['harga_221047'];
    $harga_6_bulan = $harga_normal * 6 * 0.95; // 5% discount
    $harga_12_bulan = $harga_normal * 12 * 0.9; // 10% discount
    
    $pdf->Cell($w_price[0], 7, $no++, 1, 0, 'C', $fill);
    $pdf->Cell($w_price[1], 7, $row['nama_kelas_221047'], 1, 0, 'L', $fill);
    $pdf->Cell($w_price[2], 7, 'Rp '.number_format($harga_normal, 0, ',', '.'), 1, 0, 'R', $fill);
    $pdf->Cell($w_price[3], 7, 'Rp '.number_format($harga_6_bulan, 0, ',', '.'), 1, 0, 'R', $fill);
    $pdf->Cell($w_price[4], 7, 'Rp '.number_format($harga_12_bulan, 0, ',', '.'), 1, 0, 'R', $fill);
    $pdf->Ln();
    $fill = !$fill;
}

// Add note about discount
$pdf->SetFont('helvetica', 'I', 8);
$pdf->Cell(0, 6, '* Diskon 5% untuk pendaftaran 6 bulan dan 10% untuk pendaftaran 12 bulan', 0, 1, 'L');
$pdf->Ln(10);

// Main Report Section
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Data Pembayaran Kursus', 0, 1, 'L');
$pdf->Ln(2);

// Build the WHERE clause based on filters
$where = "1=1";
if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $where .= " AND DATE(p.tanggal_daftar_221047) BETWEEN '$start_date' AND '$end_date'";
}
if (!empty($_GET['status_bayar'])) {
    $status_bayar = $_GET['status_bayar'];
    $where .= " AND p.status_bayar_221047 = '$status_bayar'";
}
if (!empty($_GET['status_aktif'])) {
    $status_aktif = $_GET['status_aktif'];
    $where .= " AND p.status_221047 = '$status_aktif'";
}

if (!empty($_GET['nama_kelas'])) {
    $nama_kelas = $_GET['nama_kelas'];
    $where .= " AND k.nama_kelas_221047 = '$nama_kelas'";
}

// Fetch payment data
$query = "SELECT 
    p.*,
    u.nama_lengkap_221047 as nama_siswa,
    k.nama_kelas_221047,
    k.harga_221047
FROM pendaftaran_221047 p
JOIN users_221047 u ON p.id_siswa_221047 = u.id_221047
JOIN kelas_221047 k ON p.id_kelas_221047 = k.id_221047
WHERE $where
ORDER BY p.tanggal_daftar_221047 DESC";

$result = mysqli_query($koneksi, $query);

// Payment Table Header
$pdf->SetFont('helvetica', 'B', 10);
$header = array('No', 'Nama Siswa', 'Kelas', 'Durasi', 'Tanggal Daftar', 'Status Bayar', 'Status Aktif', 'Total');
$w = array(7, 25, 29, 15, 28, 25, 25, 27);

// Print payment table header
foreach($header as $i => $h) {
    $pdf->Cell($w[$i], 8, $h, 1, 0, 'C', true);
}
$pdf->Ln();

// Payment Table Content
$pdf->SetFont('helvetica', '', 9);
$no = 1;
$fill = false;
$total_keseluruhan = 0;
$total_belum_lunas = 0;

while($row = mysqli_fetch_array($result)) {
    $hargaPerBulan = $row['harga_221047'];
    if ($row['durasi_221047'] == 12) {
        $hargaTotal = $hargaPerBulan * 12 * 0.9;
    } elseif ($row['durasi_221047'] == 6) {
        $hargaTotal = $hargaPerBulan * 6 * 0.95;
    } else {
        $hargaTotal = $hargaPerBulan;
    }
    
    if($row['status_bayar_221047'] == 'lunas') {
        $total_keseluruhan += $hargaTotal;
    } else {
        $total_belum_lunas += $hargaTotal;
    }

    $pdf->Cell($w[0], 7, $no++, 1, 0, 'C', $fill);
    $pdf->Cell($w[1], 7, $row['nama_siswa'], 1, 0, 'L', $fill);
    $pdf->Cell($w[2], 7, $row['nama_kelas_221047'], 1, 0, 'L', $fill);
    $pdf->Cell($w[3], 7, $row['durasi_221047'].' Bulan', 1, 0, 'C', $fill);
    $pdf->Cell($w[4], 7, date('d/m/Y', strtotime($row['tanggal_daftar_221047'])), 1, 0, 'C', $fill);
    $pdf->Cell($w[5], 7, ucfirst($row['status_bayar_221047']), 1, 0, 'C', $fill);
    $pdf->Cell($w[6], 7, ucfirst($row['status_221047']), 1, 0, 'C', $fill);
    $pdf->Cell($w[7], 7, 'Rp '.number_format($hargaTotal, 0, ',', '.'), 1, 0, 'R', $fill);
    $pdf->Ln();
    $fill = !$fill;
}

// Membuat garis penutup tabel
$pdf->Cell(array_sum($w), 0, '', 'T');
$pdf->Ln();

// Print Ringkasan Total dengan format yang lebih baik
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetFillColor(230, 236, 240);

// Total Pembayaran Lunas
$pdf->Cell(array_sum($w)-35, 7, 'Total Pembayaran Lunas:', 1, 0, 'R', true);
$pdf->Cell(35, 7, 'Rp '.number_format($total_keseluruhan, 0, ',', '.'), 1, 1, 'R', true);

// Total Pembayaran Belum Lunas
$pdf->Cell(array_sum($w)-35, 7, 'Total Pembayaran Belum Lunas:', 1, 0, 'R', true);
$pdf->Cell(35, 7, 'Rp '.number_format($total_belum_lunas, 0, ',', '.'), 1, 1, 'R', true);

// Grand Total
$pdf->SetFillColor(220, 230, 240); // Warna berbeda untuk grand total
$pdf->Cell(array_sum($w)-35, 7, 'Total Keseluruhan:', 1, 0, 'R', true);
$pdf->Cell(35, 7, 'Rp '.number_format($total_keseluruhan + $total_belum_lunas, 0, ',', '.'), 1, 1, 'R', true);

// Menambahkan catatan
$pdf->Ln(5);
$pdf->SetFont('helvetica', 'I', 8);
$pdf->Cell(0, 5, '* Total keseluruhan merupakan jumlah dari pembayaran lunas dan belum lunas', 0, 1, 'L');

// Output PDF
$pdf->Output('laporan_pembayaran.pdf', 'I');