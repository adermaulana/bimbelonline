<?php
session_start();
require_once '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pendaftaran = $_POST['id_pendaftaran'];
    
    // Cek apakah ada file yang diupload
    if (isset($_FILES['bukti']) && $_FILES['bukti']['error'] == 0) {
        $file = $_FILES['bukti'];
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
        $max_size = 2 * 1024 * 1024; // 2MB
        
        // Validasi tipe file
        if (!in_array($file['type'], $allowed_types)) {
            $_SESSION['error'] = "Tipe file tidak diizinkan. Harap upload file JPG, JPEG, atau PNG.";
            header("Location: form-upload.php?id=" . $id_pendaftaran);
            exit();
        }
        
        // Validasi ukuran file
        if ($file['size'] > $max_size) {
            $_SESSION['error'] = "Ukuran file terlalu besar. Maksimal 2MB.";
            header("Location: form-upload.php?id=" . $id_pendaftaran);
            exit();
        }
        
        // Generate nama file unik
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'payment_' . time() . '_' . uniqid() . '.' . $extension;
        $upload_path = 'uploads/bukti_pembayaran/' . $filename;
        
        // Buat direktori jika belum ada
        if (!file_exists('uploads/bukti_pembayaran/')) {
            mkdir('uploads/bukti_pembayaran/', 0777, true);
        }
        
        // Upload file
        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            // Update database
            $query = "UPDATE pendaftaran_221047 SET 
                        bukti_pembayaran_221047 = ?,
                        status_bayar_221047 = 'pending'
                     WHERE id_221047 = ?";
            
            $stmt = mysqli_prepare($koneksi, $query);
            mysqli_stmt_bind_param($stmt, "si", $filename, $id_pendaftaran);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['success'] = "Bukti pembayaran berhasil diupload. Silakan tunggu konfirmasi dari admin.";
                header("Location: pembayaran.php");
                exit();
            } else {
                $_SESSION['error'] = "Terjadi kesalahan saat menyimpan data ke database.";
                unlink($upload_path); // Hapus file jika gagal update database
            }
        } else {
            $_SESSION['error'] = "Gagal mengupload file. Silakan coba lagi.";
        }
    } else {
        $_SESSION['error'] = "Harap pilih file untuk diupload.";
    }
    
    header("Location: form-upload.php?id=" . $id_pendaftaran);
    exit();
}
?>