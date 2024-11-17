<?php

include '../koneksi.php';

session_start();

if($_SESSION['status'] != 'login'){

    session_unset();
    session_destroy();

    header("location:../");

}


$id_kelas = $_GET['id_kelas'] ?? '';

// Ambil informasi kelas
$query_kelas = mysqli_query($koneksi, "SELECT k.*, u.nama_lengkap_221047 as nama_pengajar 
                                      FROM kelas_221047 k 
                                      JOIN users_221047 u ON k.id_pengajar_221047 = u.id_221047 
                                      WHERE k.id_221047 = '$id_kelas'");
$data_kelas = mysqli_fetch_array($query_kelas);

// Hapus periode jika ada request
if(isset($_GET['hapus_periode'])) {
    $id_periode = $_GET['hapus_periode'];
    mysqli_query($koneksi, "DELETE FROM periode_kelas_221047 WHERE id_periode_221047 = '$id_periode'");
    echo "<script>
            alert('Periode berhasil dihapus!');
            document.location='periode.php?id_kelas=$id_kelas';
          </script>";
}

function formatTanggal($date) {
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split = explode('-', date('Y-m-d', strtotime($date)));
    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
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
            <!-- <li class="sidebar-item">
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
            <div class="card-header">
                <h5 class="card-title">Detail Periode Kelas: <?= $data_kelas['nama_kelas_221047'] ?></h5>
                <p>Pengajar: <?= $data_kelas['nama_pengajar'] ?></p>
                <p>Harga per Bulan: Rp <?= number_format($data_kelas['harga_221047'], 0, ',', '.') ?></p>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Durasi</th>
                            <th>Kuota</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_periode = mysqli_query($koneksi, "SELECT * FROM periode_kelas_221047 
                                                            WHERE id_kelas_221047 = '$id_kelas' 
                                                            ORDER BY tanggal_mulai_221047");
                        $no = 1;
                        while($periode = mysqli_fetch_array($query_periode)):
                            // Hitung total harga dengan diskon
                            $harga_per_bulan = $data_kelas['harga_221047'];
                            $durasi = $periode['durasi_bulan_221047'];
                            $diskon = 0;
                            if ($durasi == 6) $diskon = 0.05;
                            if ($durasi == 12) $diskon = 0.10;
                            $total_harga = $harga_per_bulan * $durasi * (1 - $diskon);
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= formatTanggal($periode['tanggal_mulai_221047']) ?></td>
                            <td><?= formatTanggal($periode['tanggal_selesai_221047']) ?></td>
                            <td><?= $periode['durasi_bulan_221047'] ?> bulan</td>
                            <td><?= $periode['kuota_221047'] ?> orang</td>
                            <td>
                                Rp <?= number_format($total_harga, 0, ',', '.') ?>
                                <?php if($diskon > 0): ?>
                                    <span class="badge bg-info">Diskon <?= $diskon * 100 ?>%</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="editperiode.php?id=<?= $periode['id_periode_221047'] ?>" 
                                    class="btn btn-sm btn-warning">Edit</a>
                                    <a href="periode.php?id_kelas=<?= $id_kelas ?>&hapus_periode=<?= $periode['id_periode_221047'] ?>" 
                                    class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus periode ini?')">Hapus</a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                
                <div class="mt-3">
                    <a href="tambahperiode.php?id_kelas=<?= $id_kelas ?>" class="btn btn-primary">Tambah Periode Baru</a>
                    <a href="kelas.php" class="btn btn-secondary">Kembali</a>
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
