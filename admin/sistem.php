<?php

include '../koneksi.php';

session_start();

if($_SESSION['status'] != 'login'){

    session_unset();
    session_destroy();

    header("location:../");

}

$id = 2;

$cek = mysqli_query($koneksi, "SELECT * FROM sistem_221047 WHERE id_221047 = '$id'");
$data = mysqli_fetch_array($cek);
if($data){
    $logo = $data['logo_221047'];
    $nama = $data['nama_221047'];
}

if (isset($_POST['simpan'])) {
  // Folder penyimpanan gambar
  $target_dir = "uploads/";
  $logo = $_FILES['logo']['name'];
  $target_file = $target_dir . basename($logo);
  $uploadOk = 1;

  // Mendapatkan tipe file untuk memastikan hanya file gambar yang diupload
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Validasi: hanya izinkan format file tertentu
  $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
  if (!in_array($imageFileType, $allowed_types)) {
      echo "<script>alert('Hanya file gambar JPG, JPEG, PNG & GIF yang diperbolehkan.');</script>";
      $uploadOk = 0;
  }

  // Proses upload file jika lolos validasi
  if ($uploadOk && move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
      // File berhasil diupload, ambil data dari form
      $id = 2;
      $nama = $_POST['nama'];
      // Cek apakah data dengan nama ini sudah ada di database
      $cek = mysqli_query($koneksi, "SELECT * FROM sistem_221047 WHERE id_221047 = '$id'");
      $data = mysqli_fetch_array($cek);
      if($data){
          $logo = $data['logo_221047'];
          $nama = $data['nama_221047'];
      }
      if (mysqli_num_rows($cek) > 0) {
          // Jika data sudah ada, update

          

          $update = mysqli_query($koneksi, "UPDATE sistem_221047 SET logo_221047 = '$target_file',nama_221047 = '$nama' WHERE id_221047 = '$id'");
          if ($update) {
              echo "<script>
                      alert('Data dan logo berhasil diperbarui!');
                      document.location='sistem.php';
                    </script>";
          } else {
              echo "<script>
                      alert('Gagal memperbarui data di database!');
                      document.location='sistem.php';
                    </script>";
          }
      } else {
          // Jika data belum ada, insert
          $simpan = mysqli_query($koneksi, "INSERT INTO sistem_221047 (nama_221047, logo_221047) VALUES ('$nama', '$target_file')");
          if ($simpan) {
              echo "<script>
                      alert('Data dan logo berhasil disimpan!');
                      document.location='sistem.php';
                    </script>";
          } else {
              echo "<script>
                      alert('Gagal menyimpan data ke database!');
                      document.location='sistem.php';
                    </script>";
          }
      }
  } else {
      echo "<script>
              alert('Gagal mengupload logo!');
              document.location='sistem.php';
            </script>";
  }
}



?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dahsboard Admin</title>
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
                href="user.php"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-warning rounded-3">
                  <i class="ti ti-article fs-7 text-warning"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Data User</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link danger-hover-bg"
                href="kelas.php"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-danger rounded-3">
                  <i class="ti ti-alert-circle fs-7 text-danger"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Data Kelas</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link success-hover-bg"
                href="pembayaran.php"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-success rounded-3">
                  <i class="ti ti-cards fs-7 text-success"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Data Pembayaran</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link primary-hover-bg"
                href="sistem.php"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-primary rounded-3">
                  <i class="ti ti-file-description fs-7 text-primary"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Sistem Aplikasi</span>
              </a>
            </li>

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
              <h5 class="card-title fw-semibold mb-4">Tambah Data</h5>
              <div class="card">
                <div class="card-body col-6">
                  <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                      <label for="logo" class="form-label">Logo</label>
                      <input type="file" class="form-control" id="logo" value="<?= $logo ?>" name="logo" required>
                    </div>
                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama Perusahaan</label>
                      <input type="text" class="form-control" id="nama" value="<?= $nama ?>" name="nama" required>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">Tambah</button>
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
