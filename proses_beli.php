<?php
include 'koneksi.php';
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}

// Ambil data dari form pembelian
$id_kelas = $_POST['id_kelas'];
$durasi = $_POST['durasi'];
$harga = $_POST['harga']; // Jika harga perlu disimpan, bisa ditambahkan di tabel atau digunakan di proses pembayaran
$id_siswa = $_SESSION['id_admin'];  // ID siswa yang sedang login

// Periksa apakah siswa sudah membeli kelas tersebut
$check_query = "SELECT * FROM pendaftaran_221047 WHERE id_siswa_221047 = '$id_siswa' AND id_kelas_221047 = '$id_kelas'";
$check_result = mysqli_query($koneksi, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    // Jika sudah pernah membeli kelas, tampilkan alert
    echo "<script>
            alert('Anda sudah membeli kelas ini.');
            window.location.href = 'kelas.php';
          </script>";
    exit;
}

// Buat ID transaksi unik atau gunakan sistem auto increment di database
$id_transaksi = uniqid('TRX');

// Insert data transaksi ke tabel pendaftaran_221047
$query = "INSERT INTO pendaftaran_221047 (id_221047, id_siswa_221047, id_kelas_221047, tanggal_daftar_221047, status_bayar_221047, status_221047, durasi_221047) 
          VALUES ('$id_transaksi', '$id_siswa', '$id_kelas', NOW(), 'pending', 'aktif','$durasi')";

$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<script>
            alert('Berhasil melakukan transaksi! Tunggu Konfirmasi Admin');
            window.location.href = 'siswa/index.php?id_transaksi=$id_transaksi';
          </script>";
    exit;
} else {
    echo "Gagal melakukan pembelian. Silakan coba lagi.";
}
?>
