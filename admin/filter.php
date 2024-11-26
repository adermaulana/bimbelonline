<?php
include '../koneksi.php';
session_start();

if($_SESSION['status'] != 'login'){
    session_unset();
    session_destroy();
    header("location:../");
}

$where = "1=1";

// Filter by date range
if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $where .= " AND DATE(p.tanggal_daftar_221047) BETWEEN '$start_date' AND '$end_date'";
}

// Filter by payment status
if (!empty($_GET['status_bayar'])) {
    $status_bayar = $_GET['status_bayar'];
    $where .= " AND p.status_bayar_221047 = '$status_bayar'";
}

// Filter by active status
if (!empty($_GET['status_aktif'])) {
    $status_aktif = $_GET['status_aktif'];
    $where .= " AND p.status_221047 = '$status_aktif'";
}

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
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);