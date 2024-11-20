<?php

include '../koneksi.php';

session_start();

$id_siswa = $_SESSION['id_admin'];
$id_kelas = $_GET['id_kelas'];
$query_kelas = mysqli_query($koneksi, "SELECT nama_kelas_221047 FROM kelas_221047 WHERE id_221047 = '$id_kelas'");
$data_kelas = mysqli_fetch_assoc($query_kelas);


if($_SESSION['status'] != 'login'){

    session_unset();
    session_destroy();

    header("location:../");

}

if ($_SESSION['role_admin'] != 'siswa') {
 
    header("location:../");
    exit();
  }

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Siswa</title>
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
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link primary-hover-bg"
                href="../kelas.php"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-primary rounded-3">
                  <i class="ti ti-layout-dashboard fs-7 text-primary"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Beli Kelas</span>
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
                href="jadwal.php"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-danger rounded-3">
                  <i class="ti ti-alert-circle fs-7 text-danger"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Data Jadwal</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link danger-hover-bg"
                href="pembayaran.php"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-danger rounded-3">
                  <i class="ti ti-layout-dashboard fs-7 text-danger"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Data Pembayaran</span>
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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold">Daftar Siswa Kelas: <?= $data_kelas['nama_kelas_221047'] ?></h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Tanggal Bergabung</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT 
                                                                  users_221047.nama_lengkap_221047,
                                                                  users_221047.email_221047,
                                                                  users_221047.no_hp_221047,
                                                                  pendaftaran_221047.status_bayar_221047,
                                                                  pendaftaran_221047.status_221047,
                                                                  pendaftaran_221047.tanggal_daftar_221047,
                                                                  pendaftaran_221047.id_221047
                                                               FROM 
                                                                  pendaftaran_221047
                                                               JOIN 
                                                                  users_221047 ON pendaftaran_221047.id_siswa_221047 = users_221047.id_221047
                                                               WHERE 
                                                                  pendaftaran_221047.id_kelas_221047 = '$id_kelas'
                                                               ORDER BY 
                                                                  pendaftaran_221047.tanggal_daftar_221047 DESC");
                                while($data = mysqli_fetch_array($query)):
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['nama_lengkap_221047'] ?></td>
                                    <td><?= $data['email_221047'] ?></td>
                                    <td><?= $data['no_hp_221047'] ?></td>
                                    <td><?= date('d/m/Y', strtotime($data['tanggal_daftar_221047'])) ?></td>
                                </tr>
                                <?php endwhile; ?>

                                <?php if(mysqli_num_rows($query) == 0): ?>
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada siswa yang terdaftar</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Card Ringkasan -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Ringkasan Kelas</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Total Siswa</h6>
                                    <?php
                                    $query_total = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pendaftaran_221047 WHERE id_kelas_221047 = '$id_kelas'");
                                    $total_siswa = mysqli_fetch_assoc($query_total)['total'];
                                    ?>
                                    <h4 class="card-text"><?= $total_siswa ?> Siswa</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Siswa Aktif</h6>
                                    <?php
                                    $query_aktif = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pendaftaran_221047 WHERE id_kelas_221047 = '$id_kelas' AND status_221047 = 'aktif'");
                                    $siswa_aktif = mysqli_fetch_assoc($query_aktif)['total'];
                                    ?>
                                    <h4 class="card-text"><?= $siswa_aktif ?> Siswa</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Sudah Bayar</h6>
                                    <?php
                                    $query_lunas = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pendaftaran_221047 WHERE id_kelas_221047 = '$id_kelas' AND status_bayar_221047 = 'lunas'");
                                    $siswa_lunas = mysqli_fetch_assoc($query_lunas)['total'];
                                    ?>
                                    <h4 class="card-text"><?= $siswa_lunas ?> Siswa</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Belum Bayar</h6>
                                    <?php
                                    $query_belum = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pendaftaran_221047 WHERE id_kelas_221047 = '$id_kelas' AND status_bayar_221047 = 'pending'");
                                    $siswa_belum = mysqli_fetch_assoc($query_belum)['total'];
                                    ?>
                                    <h4 class="card-text"><?= $siswa_belum ?> Siswa</h4>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="kelas.php" class="btn btn-secondary">Kembali</a>
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
