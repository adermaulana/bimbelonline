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
        $tampil = mysqli_query($koneksi, "SELECT * FROM kelas_221047 WHERE id_221047 = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if($data){
            $id = $data['id_221047'];
            $kelas = $data['judul_221047'];
            $pengajar_id = $data['pengajar_id_221047'];
            $kuota = $data['kuota_221047'];
            $jadwal_mulai = $data['jadwal_mulai_221047'];
            $jadwal_selesai = $data['jadwal_selesai_221047'];
            $status = $data['status_221047'];
        }
    }
}

if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $kelas = $_POST['judul_221047']; // Mengambil nama kelas
    $pengajar_id = $_POST['pengajar_id_221047']; // Mengambil ID pengajar
    $kuota = $_POST['kuota_221047']; // Mengambil kuota
    $jadwal_mulai = $_POST['jadwal_mulai_221047']; // Mengambil jadwal mulai
    $jadwal_selesai = $_POST['jadwal_selesai_221047']; // Mengambil jadwal selesai
    $status = $_POST['status_221047']; // Mengambil status

    // Lakukan query untuk memperbarui data di database
    $update = mysqli_query($koneksi, "UPDATE kelas_221047 SET 
        judul_221047 = '$kelas', 
        pengajar_id_221047 = '$pengajar_id', 
        kuota_221047 = '$kuota', 
        jadwal_mulai_221047 = '$jadwal_mulai', 
        jadwal_selesai_221047 = '$jadwal_selesai', 
        status_221047 = '$status' 
        WHERE id_221047 = '$_GET[id]'");

    if ($update) {
        echo "<script>
                alert('Update data sukses!');
                document.location='kelas.php';
              </script>";
    } else {
        echo "<script>
                alert('Update data Gagal!');
                document.location='kelas.php';
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
              <h5 class="card-title fw-semibold mb-4">Edit Kelas</h5>
              <div class="card">
                <div class="card-body col-6">
                  <form method="POST">
                    <input type="hidden" name="pengajar_id_221047" value="<?= $_SESSION['id_admin'] ?>">
                    <div class="mb-3">
                      <label for="judul_221047" class="form-label">Nama Kelas</label>
                      <input type="text" class="form-control" id="judul_221047" value="<?= $kelas ?>" name="judul_221047" required>
                    </div>
                    <div class="mb-3">
                      <label for="kuota_221047" class="form-label">Kuota</label>
                      <input type="number" class="form-control" id="kuota_221047" value="<?= $kuota ?>" name="kuota_221047" required>
                    </div>
                    <div class="mb-3">
                      <label for="jadwal_mulai_221047" class="form-label">Jadwal Mulai</label>
                      <input type="date" class="form-control" id="jadwal_mulai_221047" value="<?= $jadwal_mulai ?>" name="jadwal_mulai_221047" required>
                    </div>
                    <div class="mb-3">
                      <label for="jadwal_selesai_221047" class="form-label">Jadwal Selesai</label>
                      <input type="date" class="form-control" id="jadwal_selesai_221047" value="<?= $jadwal_selesai ?>" name="jadwal_selesai_221047" required>
                    </div>
                    <div class="mb-3">
                        <label for="status_221047" class="form-label">Status</label>
                        <select class="form-select" id="status_221047" name="status_221047" required>
                            <option value="" disabled>Pilih Status</option>
                            <option value="Aktif" <?= ($status == "Aktif") ? 'selected' : '' ?>>Aktif</option>
                            <option value="Nonaktif" <?= ($status == "Nonaktif") ? 'selected' : '' ?>>Nonaktif</option>
                            <!-- Tambahkan opsi lain sesuai kebutuhan -->
                        </select>
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