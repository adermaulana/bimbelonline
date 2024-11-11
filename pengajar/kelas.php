<?php

include '../koneksi.php';

session_start();

$id_pengajar = $_SESSION['id_admin'];

if($_SESSION['status'] != 'login'){

    session_unset();
    session_destroy();

    header("location:../");

}

if ($_SESSION['role_admin'] != 'pengajar') {
 
    header("location:../");
    exit();
  }

  if(isset($_GET['hal']) == "hapus"){

    $hapus = mysqli_query($koneksi, "DELETE FROM kelas_221047 WHERE id_221047 = '$_GET[id]'");
  
    if($hapus){
        echo "<script>
        alert('Hapus data sukses!');
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
                href="jadwal.php"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-danger rounded-3">
                  <i class="ti ti-alert-circle fs-7 text-danger"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Data Jadwal</span>
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
              <h5 class="card-title fw-semibold mb-4">Kelas</h5>
              <a class="btn btn-success mb-2" href="tambahkelas.php">Tambah Data</a>
              <div class="card">
              <div class="table-responsive" data-simplebar>
                  <table
                    class="table table-borderless align-middle text-nowrap"
                  >
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Kelas</th>
                        <th scope="col">Harga / Bulan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT 
                                                                  kelas_221047.*,
                                                                  users_221047.nama_lengkap_221047 AS nama_pengajar
                                                              FROM 
                                                                  kelas_221047
                                                              JOIN 
                                                                  users_221047 ON kelas_221047.id_pengajar_221047 = users_221047.id_221047
                                                              WHERE     
                                                                  kelas_221047.id_pengajar_221047 = '$id_pengajar';
                                                              ");
                            while($data = mysqli_fetch_array($tampil)):
                        ?>
                      <tr>
                        <td>
                          <p class="fs-3 fw-normal mb-0"><?= $no++ ?></p>
                        </td>
                        <td>
                          <p class="fs-3 fw-normal mb-0">
                          <?= $data['nama_kelas_221047'] ?>
                          </p>
                        </td>
                        <td>
                          <p class="fs-3 fw-normal mb-0">
                            Rp <?= number_format($data['harga_221047'], 0, ',', '.') ?>
                          </p>
                        </td>
                        <td>
                          <p class="fs-3 fw-normal mb-0">
                          <?php if ($data['status_221047'] == 'aktif'): ?>
                            <span class="badge bg-success">Aktif</span>
                          <?php else: ?>
                            <span class="badge bg-danger">Nonaktif</span>
                          <?php endif; ?>
                          </p>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-success" href="siswa.php?id_kelas=<?= $data['id_221047']?>">Lihat Siswa</a>
                            <a class="btn btn-sm btn-info"href="materi.php?id_kelas=<?= $data['id_221047']?>">Lihat Materi</a>
                            <a class="btn btn-sm btn-warning" href="editkelas.php?hal=edit&id=<?= $data['id_221047']?>">Edit</a>
                            <a class="btn btn-sm btn-danger" href="kelas.php?hal=hapus&id=<?= $data['id_221047']?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data?')">Hapus</a>
                        </td>
                      </tr>
                      <?php
                            endwhile; 
                        ?>
                    </tbody>
                  </table>
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
