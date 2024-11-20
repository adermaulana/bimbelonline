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
$harga = $_POST['harga'];
$id_siswa = $_SESSION['id_admin'];

// Cek kuota kelas di periode yang sesuai
$check_kuota_query = "SELECT 
    pk.kuota_221047,
    pk.tanggal_mulai_221047,
    pk.tanggal_selesai_221047,
    pk.id_periode_221047 as periode_id,
    (SELECT COUNT(*) 
     FROM pendaftaran_221047 p 
     WHERE p.id_kelas_221047 = pk.id_kelas_221047 
     AND p.durasi_221047 = pk.durasi_bulan_221047
     AND p.status_221047 = 'aktif'
     AND p.status_bayar_221047 IN ('lunas', 'pending')) as jumlah_terdaftar
FROM periode_kelas_221047 pk
WHERE pk.id_kelas_221047 = '$id_kelas'
AND pk.durasi_bulan_221047 = '$durasi'";

$kuota_result = mysqli_query($koneksi, $check_kuota_query);
$kuota_data = mysqli_fetch_assoc($kuota_result);

// Debug - tampilkan nilai kuota dan jumlah terdaftar
error_log("Kuota: " . print_r($kuota_data, true));

if (!$kuota_data) {
    echo "<script>
            alert('Periode kelas tidak ditemukan atau sudah tidak tersedia.');
            window.location.href = 'kelas.php';
          </script>";
    exit;
}

$kuota = $kuota_data['kuota_221047'];
$jumlah_terdaftar = $kuota_data['jumlah_terdaftar'];
$periode_id = $kuota_data['periode_id'];

if ($jumlah_terdaftar >= $kuota) {
    echo "<script>
            alert('Maaf, kuota kelas untuk paket ini sudah penuh. (Kuota: $kuota, Terdaftar: $jumlah_terdaftar)');
            window.location.href = 'kelas.php';
          </script>";
    exit;
}

// Periksa apakah siswa sudah membeli kelas tersebut
$check_query = "SELECT * FROM pendaftaran_221047 
                WHERE id_siswa_221047 = '$id_siswa' 
                AND id_kelas_221047 = '$id_kelas' 
                AND durasi_221047 = '$durasi'
                AND status_221047 = 'aktif'
                AND status_bayar_221047 IN ('lunas', 'pending')";

$check_result = mysqli_query($koneksi, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "<script>
            alert('Anda sudah membeli kelas ini.');
            window.location.href = 'kelas.php';
          </script>";
    exit;
}

// Mulai transaksi
mysqli_begin_transaction($koneksi);

try {
    // Buat ID transaksi unik
    $id_transaksi = uniqid('TRX');

    // Insert data transaksi ke tabel pendaftaran_221047
    $query = "INSERT INTO pendaftaran_221047 (id_221047, id_siswa_221047, id_kelas_221047, 
              tanggal_daftar_221047, status_bayar_221047, status_221047, durasi_221047) 
              VALUES ('$id_transaksi', '$id_siswa', '$id_kelas', NOW(), 'pending', 'aktif', '$durasi')";

    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        throw new Exception("Gagal menyimpan data pendaftaran");
    }

    // Update kuota di tabel periode_kelas_221047
    $update_kuota_query = "UPDATE periode_kelas_221047 
                          SET kuota_221047 = kuota_221047 - 1 
                          WHERE id_periode_221047 = '$periode_id' 
                          AND kuota_221047 > 0";

    $update_result = mysqli_query($koneksi, $update_kuota_query);

    if (!$update_result) {
        throw new Exception("Gagal mengupdate kuota");
    }

    // Commit transaksi jika semua operasi berhasil
    mysqli_commit($koneksi);

    echo "<script>
            alert('Berhasil melakukan transaksi! Tunggu Konfirmasi Admin');
            window.location.href = 'siswa/index.php?id_transaksi=$id_transaksi';
          </script>";
    exit;

} catch (Exception $e) {
    // Rollback transaksi jika terjadi kesalahan
    mysqli_rollback($koneksi);
    echo "Gagal melakukan pembelian: " . $e->getMessage();
}
?>