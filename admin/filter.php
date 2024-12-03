<?php
include '../koneksi.php';

// Get filter parameters
$start_date = $_GET['start_date'] ?? '';
$end_date = $_GET['end_date'] ?? '';
$status_bayar = $_GET['status_bayar'] ?? '';
$status_aktif = $_GET['status_aktif'] ?? '';
$nama_kelas = $_GET['nama_kelas'] ?? '';

// Build dynamic query
$query = "SELECT 
        p.*,
        u.nama_lengkap_221047 as nama_siswa,
        k.nama_kelas_221047,
        k.harga_221047
    FROM pendaftaran_221047 p
    JOIN users_221047 u ON p.id_siswa_221047 = u.id_221047
    JOIN kelas_221047 k ON p.id_kelas_221047 = k.id_221047
    WHERE 1=1
";

// Add conditions based on filter parameters
if (!empty($start_date)) {
    $query .= " AND p.tanggal_daftar_221047 >= '$start_date'";
}

if (!empty($end_date)) {
    $query .= " AND p.tanggal_daftar_221047 <= '$end_date'";
}

if (!empty($status_bayar)) {
    $query .= " AND p.status_bayar_221047 = '$status_bayar'";
}

if (!empty($status_aktif)) {
    $query .= " AND p.status_221047 = '$status_aktif'";
}

if (!empty($nama_kelas)) {
    $query .= " AND k.nama_kelas_221047 = '$nama_kelas'";
}

$query .= " ORDER BY p.tanggal_daftar_221047 DESC";

$result = mysqli_query($koneksi, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>