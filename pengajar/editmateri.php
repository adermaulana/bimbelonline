<?php

include '../koneksi.php';

session_start();

if($_SESSION['status'] != 'login'){

    session_unset();
    session_destroy();

    header("location:../");

}

if ($_SESSION['role_admin'] != 'pengajar') {
 
    header("location:../");
    exit();
  }


  if(isset($_GET['hal'])){
    if($_GET['hal'] == "edit"){
        $tampil = mysqli_query($koneksi, "SELECT * FROM materi_221047 WHERE id_221047 = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if($data){
            $id = $data['id_221047'];
            $kelas = $data['judul_221047'];
            $kelas_id = $data['kelas_id_221047'];
            $file = $data['file_path_221047'];
            $deskripsi = $data['deskripsi_221047'];
        }
    }
}

if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $id = $_GET['id']; // Ambil ID dari URL untuk pengeditan
    $judul = $_POST['name_221047']; // Mengambil judul materi
    $kelas_id = $_POST['kelas_id_221047']; // Mengambil ID kelas
    $deskripsi = $_POST['deskripsi_221047']; // Mengambil deskripsi

    // Variabel untuk menyimpan path file yang akan diupdate
    $filePathLama = ''; 

    // Ambil data file lama dari database
    $query = mysqli_query($koneksi, "SELECT file_path_221047 FROM materi_221047 WHERE id_221047='$id'");
    if ($query) {
        $data = mysqli_fetch_assoc($query);
        $filePathLama = $data['file_path_221047'];
    }

    // Proses upload file
    $uploadOk = 1;

    // Cek jika ada file baru diupload
    if ($_FILES["file_path_221047"]["name"]) {
        $target_dir = "uploads/"; // Tentukan direktori penyimpanan
        $target_file = $target_dir . basename($_FILES["file_path_221047"]["name"]);
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Hanya izinkan format file PDF
        if ($fileType != "pdf") {
            echo "<script>alert('Maaf, hanya file PDF yang diizinkan.');</script>";
            $uploadOk = 0;
        }

        // Cek apakah file sudah ada
        if (file_exists($target_file)) {
            echo "<script>alert('Maaf, file sudah ada.');</script>";
            $uploadOk = 0;
        }

        // Batasi ukuran file (misalnya, maksimal 5MB)
        if ($_FILES["file_path_221047"]["size"] > 5000000) { // 5MB
            echo "<script>alert('Maaf, ukuran file terlalu besar.');</script>";
            $uploadOk = 0;
        }

        // Cek apakah $uploadOk di-set ke 0 oleh kesalahan
        if ($uploadOk == 0) {
            echo "<script>alert('Maaf, file tidak dapat diupload.');</script>";
        } else {
            // Jika semua ok, coba untuk upload file
            if (move_uploaded_file($_FILES["file_path_221047"]["tmp_name"], $target_file)) {
                // Jika berhasil upload file baru, update path file di database
                $filePathLama = $target_file; // Ganti dengan file baru
            } else {
                echo "<script>alert('Maaf, terjadi kesalahan saat mengupload file.');</script>";
            }
        }
    } else {
        // Jika tidak ada file baru, gunakan file lama
        $filePathLama = $filePathLama; // Tidak ada perubahan
    }

    // Lakukan query untuk menyimpan data ke database
    $simpan = mysqli_query($koneksi, "UPDATE materi_221047 SET judul_221047='$judul', kelas_id_221047='$kelas_id', file_path_221047='$filePathLama', deskripsi_221047='$deskripsi' WHERE id_221047='$id'");

    if ($simpan) {
        echo "<script>
                alert('Update data sukses!');
                document.location='materi.php';
              </script>";
    } else {
        echo "<script>
                alert('Update data Gagal!');
                document.location='materi.php';
              </script>";
    }
}




?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Pengajar</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar" data-simplebar>
        <div class="d-flex mb-4 align-items-center justify-content-between">
            <a href="index.php" class="text-nowrap logo-img ms-0 ms-md-1">
              <img src="" width="180" alt="">
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
              <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav" class="mb-4 pb-2">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link primary-hover-bg"
                href="index.php"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-primary rounded-3">
                  <i class="ti ti-layout-dashboard fs-7 text-primary"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
              <span class="hide-menu">Fitur</span>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link warning-hover-bg"
                href="kelas.php"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-warning rounded-3">
                  <i class="ti ti-article fs-7 text-warning"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Kelas</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link danger-hover-bg"
                href="materi.php"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-danger rounded-3">
                  <i class="ti ti-alert-circle fs-7 text-danger"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Data Materi</span>
              </a>
            </li>
            <!-- <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link success-hover-bg"
                href="ujian.php"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-success rounded-3">
                  <i class="ti ti-cards fs-7 text-success"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Data Ujian</span>
              </a>
            </li> -->

          </ul>

        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../assets/images/profile/user1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block shadow-none">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Tambah Materi</h5>
              <div class="card">
                <div class="card-body col-6">
                  <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                      <label for="name_221047" class="form-label">Judul Materi</label>
                      <input type="text" class="form-control" id="name_221047" value="<?= $kelas ?>" name="name_221047" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelas_id_221047" class="form-label">Kelas</label>
                        <select class="form-select" id="kelas_id_221047" name="kelas_id_221047" required>
                            <option value="" disabled>Pilih Kelas</option>
                            <?php
                            $tampil_kelas = mysqli_query($koneksi, "SELECT * FROM kelas_221047");
                            while ($kelas = mysqli_fetch_array($tampil_kelas)):
                                // Menandai kelas yang dipilih
                                $selected = ($kelas['id_221047'] == $kelas_id) ? 'selected' : '';
                            ?>
                            <option value="<?= $kelas['id_221047'] ?>" <?= $selected ?>><?= $kelas['judul_221047'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="file_path_221047" class="form-label">File</label>
                        <input type="file" class="form-control" id="file_path_221047" name="file_path_221047">
                        <!-- Tampilkan nama file saat ini jika ada -->
                        <?php if (!empty($file)): ?>
                            <small class="text-muted">File saat ini: <?= basename($file) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                      <label for="deskripsi_221047" class="form-label">Deskripsi</label>
                      <textarea class="form-control" name="deskripsi_221047" name="" id="" rows="4"><?= $deskripsi ?></textarea>
                    </div>

                    <button type="submit" name="simpan" class="btn btn-primary">Edit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
</body>

</html>