<?php
// verifikasi.php
include '../koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Update status pembayaran menjadi lunas
    $query = mysqli_query($koneksi, "
        UPDATE pendaftaran_221047 
        SET status_bayar_221047 = 'lunas', 
            status_221047 = 'aktif' 
        WHERE id_221047 = '$id'
    ");
    
    if($query) {
        echo "<script>
            alert('Pembayaran berhasil diverifikasi!');
            window.location.href = 'pembayaran.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal memverifikasi pembayaran!');
            window.location.href = 'pembayaran.php';
        </script>";
    }
}
?>