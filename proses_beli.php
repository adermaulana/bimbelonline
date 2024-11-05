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
$harga = $_POST['harga']; // Jika harga perlu disimpan, bisa ditambahkan di tabel atau digunakan di proses pembayaran
$id_siswa = $_SESSION['id_admin'];  // ID siswa yang sedang login

// Buat ID transaksi unik atau gunakan sistem auto increment di database
$id_transaksi = uniqid('TRX');

// Insert data transaksi ke tabel transaksi_221047
$query = "INSERT INTO pendaftaran_221047 (id_221047, id_siswa_221047, id_kelas_221047, tanggal_daftar_221047, status_bayar_221047, status_221047) 
          VALUES ('$id_transaksi', '$id_siswa', '$id_kelas', NOW(), 'pending', 'aktif')";

$result = mysqli_query($koneksi, $query);

if ($result) {
    // Jika berhasil, arahkan ke halaman konfirmasi atau pembayaran
    header("Location: siswa/index.php?id_transaksi=$id_transaksi");
    exit;
} else {
    echo "Gagal melakukan pembelian. Silakan coba lagi.";
}
?>