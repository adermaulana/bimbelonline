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

  $id_periode = $_GET['id'] ?? '';

  // Fetch periode data along with kelas information
  $query_periode = mysqli_query($koneksi, "SELECT p.*, k.nama_kelas_221047, k.harga_221047, u.nama_lengkap_221047 as nama_pengajar 
                                          FROM periode_kelas_221047 p
                                          JOIN kelas_221047 k ON p.id_kelas_221047 = k.id_221047
                                          JOIN users_221047 u ON k.id_pengajar_221047 = u.id_221047
                                          WHERE p.id_periode_221047 = '$id_periode'");
  $data_periode = mysqli_fetch_array($query_periode);
  
  
  if (isset($_POST['update_periode'])) {
      $id_periode = $_POST['id_periode_221047'];
      $id_kelas = $_POST['id_kelas_221047'];
      $tanggal_mulai = $_POST['tanggal_mulai_221047'];
      $tanggal_selesai = $_POST['tanggal_selesai_221047'];
      $durasi_bulan = $_POST['durasi_bulan_221047'];
      $kuota = $_POST['kuota_221047'];
      // Check if there's already an entry for the same class in the same month (excluding current record)
      $month_start = date('Y-m', strtotime($tanggal_mulai));
      $check_query = mysqli_query($koneksi, 
          "SELECT * FROM periode_kelas_221047 
          WHERE id_kelas_221047 = '$id_kelas' 
          AND DATE_FORMAT(tanggal_mulai_221047, '%Y-%m') = '$month_start'
          AND durasi_bulan_221047 = '$durasi_bulan'
          AND id_periode_221047 != '$id_periode'"
      );
      
      if (mysqli_num_rows($check_query) > 0) {
          echo "<script>
                  alert('Periode dengan durasi yang sama di bulan yang sama sudah ada!');
                  history.back();
                </script>";
      } else {
          $update = mysqli_query($koneksi, 
              "UPDATE periode_kelas_221047 
              SET tanggal_mulai_221047 = '$tanggal_mulai',
                  tanggal_selesai_221047 = '$tanggal_selesai',
                  durasi_bulan_221047 = '$durasi_bulan',
                  kuota_221047 = '$kuota'
              WHERE id_periode_221047 = '$id_periode'"
          );
          
          if ($update) {
              echo "<script>
                      alert('Data periode berhasil diupdate!');
                      window.location.href = 'periode.php?id_kelas=" . $data_periode['id_kelas_221047'] . "';
                    </script>";
          } else {
              echo "<script>
                      alert('Gagal mengupdate data periode!');
                      history.back();
                    </script>";
          }
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
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Periode untuk Kelas: <?= $data_periode['nama_kelas_221047'] ?></h5>
                        <p>Pengajar: <?= $data_periode['nama_pengajar'] ?></p>
                        <p>Harga per Bulan: Rp <?= number_format($data_periode['harga_221047'], 0, ',', '.') ?></p>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <input type="hidden" name="id_periode_221047" value="<?= $id_periode ?>">
                            <input type="hidden" name="id_kelas_221047" value="<?= $data_periode['id_kelas_221047'] ?>">
                            
                            <div class="mb-3">
                                <label for="durasi_bulan_221047" class="form-label">Durasi</label>
                                <select class="form-select" id="durasi_bulan_221047" name="durasi_bulan_221047" required onchange="updateTanggalSelesai()">
                                    <option value="" disabled>Pilih Durasi</option>
                                    <option value="1" <?= $data_periode['durasi_bulan_221047'] == 1 ? 'selected' : '' ?>>1 Bulan</option>
                                    <option value="6" <?= $data_periode['durasi_bulan_221047'] == 6 ? 'selected' : '' ?>>6 Bulan (Diskon 5%)</option>
                                    <option value="12" <?= $data_periode['durasi_bulan_221047'] == 12 ? 'selected' : '' ?>>12 Bulan (Diskon 10%)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="kuota_221047" class="form-label">Kuota</label>
                                <input type="number" value="<?=  $data_periode['kuota_221047'] ?>" class="form-control" id="kuota_221047" name="kuota_221047"required>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_mulai_221047" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="tanggal_mulai_221047" name="tanggal_mulai_221047" 
                                       value="<?= $data_periode['tanggal_mulai_221047'] ?>" required onchange="updateTanggalSelesai()">
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_selesai_221047" class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="tanggal_selesai_221047" name="tanggal_selesai_221047" 
                                       value="<?= $data_periode['tanggal_selesai_221047'] ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Total Harga</label>
                                <div id="total_harga" class="form-control-plaintext">-</div>
                            </div>

                            <button type="submit" name="update_periode" class="btn btn-primary">Update Periode</button>
                            <a href="periode.php?id_kelas=<?= $data_periode['id_kelas_221047'] ?>" class="btn btn-secondary">Kembali</a>
                        </form>
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

  <script>
    function updateTanggalSelesai() {
        const tanggalMulai = document.getElementById('tanggal_mulai_221047').value;
        const durasi = document.getElementById('durasi_bulan_221047').value;
        const hargaPerBulan = <?= $data_periode['harga_221047'] ?>;
        
        if (tanggalMulai && durasi) {
            // Hitung tanggal selesai
            const startDate = new Date(tanggalMulai);
            const endDate = new Date(startDate);
            endDate.setMonth(endDate.getMonth() + parseInt(durasi));
            
            // Format tanggal selesai untuk input date
            const formattedDate = endDate.toISOString().split('T')[0];
            document.getElementById('tanggal_selesai_221047').value = formattedDate;
            
            // Hitung total harga dengan diskon
            let diskon = 0;
            if (durasi == 6) diskon = 0.05;
            if (durasi == 12) diskon = 0.10;
            
            const totalHarga = hargaPerBulan * durasi * (1 - diskon);
            document.getElementById('total_harga').innerHTML = 
                `Rp ${new Intl.NumberFormat('id-ID').format(totalHarga)}` +
                (diskon > 0 ? ` (Termasuk diskon ${diskon * 100}%)` : '');
        }
    }

    // Call updateTanggalSelesai on page load to show initial total
    window.onload = function() {
        updateTanggalSelesai();
    }
    </script>


</body>

</html>
