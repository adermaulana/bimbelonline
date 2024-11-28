<?php

include '../koneksi.php';

session_start();

if($_SESSION['status'] != 'login'){

    session_unset();
    session_destroy();

    header("location:../");

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
                href="laporan.php"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-primary rounded-3">
                  <i class="ti ti-file-description fs-7 text-primary"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Laporan Pembayaran</span>
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
          <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Filter Data</h5>
                            <form id="filterForm" class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Tanggal Akhir</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Status Bayar</label>
                                    <select class="form-select" name="status_bayar" id="status_bayar">
                                        <option value="">Semua</option>
                                        <option value="pending">Pending</option>
                                        <option value="lunas">Lunas</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Status Aktif</label>
                                    <select class="form-select" name="status_aktif" id="status_aktif">
                                        <option value="">Semua</option>
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">&nbsp;</label>
                                    <div>
                                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                                        <button type="button" class="btn btn-success" id="exportPDF">Export PDF</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Pembayaran</h5>
              <div class="card">
              <div class="table-responsive" data-simplebar>
              <table class="table table-borderless align-middle text-nowrap">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Nama Kelas</th>
                        <th scope="col">Durasi</th>
                        <th scope="col">Tanggal Daftar</th>
                        <th scope="col">Status Bayar</th>
                        <th scope="col">Status Aktif</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $tampil = mysqli_query($koneksi, "
                            SELECT 
                                p.*,
                                u.nama_lengkap_221047 as nama_siswa,
                                k.nama_kelas_221047,
                                k.harga_221047
                            FROM pendaftaran_221047 p
                            JOIN users_221047 u ON p.id_siswa_221047 = u.id_221047
                            JOIN kelas_221047 k ON p.id_kelas_221047 = k.id_221047
                            ORDER BY p.tanggal_daftar_221047 DESC
                        ");
                        while($data = mysqli_fetch_array($tampil)):
                    ?>
                    <tr>
                        <td>
                            <p class="fs-3 fw-normal mb-0"><?= $no++ ?></p>
                        </td>
                        <td>
                            <p class="fs-3 fw-normal mb-0">
                                <?= $data['nama_siswa'] ?>
                            </p>
                        </td>
                        <td>
                            <p class="fs-3 fw-normal mb-0">
                                <?= $data['nama_kelas_221047'] ?>
                                <br>
                                <?php
                                // Harga per bulan
                                $hargaPerBulan = $data['harga_221047'];

                                // Menghitung harga berdasarkan durasi yang dipilih
                                if ($data['durasi_221047'] == 12) {
                                    // Durasi 12 bulan: harga * 12 dan diskon 10%
                                    $hargaTotal = $hargaPerBulan * 12 * 0.9;
                                } elseif ($data['durasi_221047'] == 6) {
                                    // Durasi 6 bulan: harga * 6 dan diskon 5%
                                    $hargaTotal = $hargaPerBulan * 6 * 0.95;
                                } else {
                                    $hargaTotal = $hargaPerBulan;
                                }

                                // Menampilkan harga dengan format rupiah
                                ?>
                                <small class="text-muted">Rp <?= number_format($hargaTotal, 0, ',', '.') ?></small>
                            </p>
                        </td>
                        <td>
                            <p class="fs-3 fw-normal mb-0">
                                <?= $data['durasi_221047'] ?> Bulan
                            </p>
                        </td>
                        <td>
                            <p class="fs-3 fw-normal mb-0">
                                <?= date('d/m/Y', strtotime($data['tanggal_daftar_221047'])) ?>
                            </p>
                        </td>
                        <td>
                            <span class="badge bg-<?= ($data['status_bayar_221047'] == 'lunas') ? 'success' : 'warning' ?>">
                                <?= ucfirst($data['status_bayar_221047']) ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-<?= ($data['status_221047'] == 'aktif') ? 'success' : 'danger' ?>">
                                <?= ucfirst($data['status_221047']) ?>
                            </span>
                        </td>
                        <td>
                            <?php if($data['status_bayar_221047'] == 'pending' && !empty($data['bukti_pembayaran_221047'])): ?>
                                <button type="button" class="btn btn-sm btn-primary view-bukti" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#buktiModal"
                                    data-id="<?= $data['id_221047'] ?>"
                                    data-siswa="<?= $data['nama_siswa'] ?>"
                                    data-kelas="<?= $data['nama_kelas_221047'] ?>"
                                    data-total="<?= number_format($hargaTotal, 0, ',', '.') ?>"
                                    data-bukti="../siswa/uploads/bukti_pembayaran/<?= $data['bukti_pembayaran_221047'] ?>">
                                    Lihat Bukti
                                </button>
                                <a onclick="return confirm('Apakah anda yakin ingin mengkonfirmasi pembayaran ini?')" 
                                    class="btn btn-sm btn-success" 
                                    href="verifikasi.php?id=<?= $data['id_221047'] ?>">
                                    Verifikasi
                                </a>
                            <?php elseif($data['status_bayar_221047'] == 'lunas' && !empty($data['bukti_pembayaran_221047'])): ?>
                                <button type="button" class="btn btn-sm btn-info view-bukti" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#buktiModal"
                                    data-id="<?= $data['id_221047'] ?>"
                                    data-siswa="<?= $data['nama_siswa'] ?>"
                                    data-kelas="<?= $data['nama_kelas_221047'] ?>"
                                    data-total="<?= number_format($hargaTotal, 0, ',', '.') ?>"
                                    data-bukti="../siswa/uploads/bukti_pembayaran/<?= $data['bukti_pembayaran_221047'] ?>">
                                    Lihat Bukti
                                </button>
                            <?php endif; ?>
                            <a class="btn btn-sm btn-info" href="detail.php?id=<?= $data['id_221047'] ?>">
                                Detail
                            </a>
                            <a class="btn btn-sm btn-danger" href="hapus.php?id=<?= $data['id_221047'] ?>" 
                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
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

  <div class="modal fade" id="buktiModal" tabindex="-1" aria-labelledby="buktiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buktiModalLabel">Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <img id="buktiImage" src="" alt="Bukti Pembayaran" class="img-fluid">
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="fw-semibold">Detail Pembayaran</h6>
                                <table class="table">
                                    <tr>
                                        <td width="200">Nama Siswa</td>
                                        <td width="20">:</td>
                                        <td id="namaSiswa"></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Kelas</td>
                                        <td>:</td>
                                        <td id="namaKelas"></td>
                                    </tr>
                                    <tr>
                                        <td>Total Pembayaran</td>
                                        <td>:</td>
                                        <td id="totalPembayaran"></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Upload</td>
                                        <td>:</td>
                                        <td id="tanggalUpload"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
document.addEventListener('DOMContentLoaded', function() {
    // Event delegation for view-bukti buttons
    document.addEventListener('click', function(e) {
        // Check if the clicked element or its parent is a view-bukti button
        const viewBuktiButton = e.target.closest('.view-bukti');
        if (viewBuktiButton) {
            // Prevent default button behavior
            e.preventDefault();

            // Retrieve data attributes
            const bukti = viewBuktiButton.getAttribute('data-bukti');
            const siswa = viewBuktiButton.getAttribute('data-siswa');
            const kelas = viewBuktiButton.getAttribute('data-kelas');
            const total = viewBuktiButton.getAttribute('data-total');

            // Debug logging (can be removed in production)
            console.log('Bukti Path:', bukti);
            console.log('Siswa:', siswa);
            console.log('Kelas:', kelas);
            console.log('Total:', total);

            // Update modal elements
            const buktiImage = document.getElementById('buktiImage');
            const namaSiswa = document.getElementById('namaSiswa');
            const namaKelas = document.getElementById('namaKelas');
            const totalPembayaran = document.getElementById('totalPembayaran');

            // Safely update elements with fallback
            buktiImage.src = bukti || '';
            buktiImage.onerror = function() {
                console.error('Failed to load image:', bukti);
                this.alt = 'Gambar bukti tidak ditemukan';
            };

            namaSiswa.textContent = siswa || 'Tidak tersedia';
            namaKelas.textContent = kelas || 'Tidak tersedia';
            totalPembayaran.textContent = total ? `Rp ${total}` : 'Tidak tersedia';

            // Optional: Add current date as upload date
            const tanggalUpload = document.getElementById('tanggalUpload');
            if (tanggalUpload) {
                tanggalUpload.textContent = new Date().toLocaleDateString('id-ID');
            }
        }
    });

    // Handle form submission for filtering
    const filterForm = document.getElementById('filterForm');
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            loadData();
        });
    }

    // Handle PDF export
    const exportPDFButton = document.getElementById('exportPDF');
    if (exportPDFButton) {
        exportPDFButton.addEventListener('click', function() {
            const form = document.getElementById('filterForm');
            const formData = new FormData(form);
            const queryString = new URLSearchParams(formData).toString();
            window.open(`cetak_pdf.php?${queryString}`, '_blank');
        });
    }

    function loadData() {
        const form = document.getElementById('filterForm');
        const formData = new FormData(form);
        const queryString = new URLSearchParams(formData).toString();

        fetch(`filter.php?${queryString}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const tbody = document.querySelector('tbody');
                tbody.innerHTML = '';

                if (data.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data yang ditemukan</td>
                        </tr>
                    `;
                    return;
                }

                data.forEach((item, index) => {
                    // Price calculation logic (same as previous implementation)
                    let hargaPerBulan = parseFloat(item.harga_221047);
                    let hargaTotal;
                    
                    if (item.durasi_221047 == 12) {
                        hargaTotal = hargaPerBulan * 12 * 0.9;
                    } else if (item.durasi_221047 == 6) {
                        hargaTotal = hargaPerBulan * 6 * 0.95;
                    } else {
                        hargaTotal = hargaPerBulan;
                    }

                    const row = `
                        <tr>
                            <td>
                                <p class="fs-3 fw-normal mb-0">${index + 1}</p>
                            </td>
                            <td>
                                <p class="fs-3 fw-normal mb-0">${item.nama_siswa || 'Tidak diketahui'}</p>
                            </td>
                            <td>
                                <p class="fs-3 fw-normal mb-0">
                                    ${item.nama_kelas_221047 || 'Tidak diketahui'}
                                    <br>
                                    <small class="text-muted">Rp ${hargaTotal.toLocaleString()}</small>
                                </p>
                            </td>
                            <td>
                                <p class="fs-3 fw-normal mb-0">${item.durasi_221047 || '-'} Bulan</p>
                            </td>
                            <td>
                                <p class="fs-3 fw-normal mb-0">
                                    ${item.tanggal_daftar_221047 ? new Date(item.tanggal_daftar_221047).toLocaleDateString('id-ID') : 'Tidak tersedia'}
                                </p>
                            </td>
                            <td>
                                <span class="badge bg-${item.status_bayar_221047 === 'lunas' ? 'success' : 'warning'}">
                                    ${item.status_bayar_221047 ? item.status_bayar_221047.charAt(0).toUpperCase() + item.status_bayar_221047.slice(1) : 'Tidak diketahui'}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-${item.status_221047 === 'aktif' ? 'success' : 'danger'}">
                                    ${item.status_221047 ? item.status_221047.charAt(0).toUpperCase() + item.status_221047.slice(1) : 'Tidak diketahui'}
                                </span>
                            </td>
                            <td>
                                ${item.status_bayar_221047 === 'pending' && item.bukti_pembayaran_221047 ? `
                                    <button type="button" class="btn btn-sm btn-primary view-bukti" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#buktiModal"
                                        data-id="${item.id_221047 || ''}"
                                        data-siswa="${item.nama_siswa || ''}"
                                        data-kelas="${item.nama_kelas_221047 || ''}"
                                        data-total="${hargaTotal.toLocaleString()}"
                                        data-bukti="../siswa/uploads/bukti_pembayaran/${item.bukti_pembayaran_221047}">
                                        Lihat Bukti
                                    </button>
                                    <a onclick="return confirm('Apakah anda yakin ingin mengkonfirmasi pembayaran ini?')" 
                                        class="btn btn-sm btn-success" 
                                        href="verifikasi.php?id=${item.id_221047 || ''}">
                                        Verifikasi
                                    </a>
                                ` : ''}
                                ${item.status_bayar_221047 === 'lunas' && item.bukti_pembayaran_221047 ? `
                                    <button type="button" class="btn btn-sm btn-info view-bukti" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#buktiModal"
                                        data-id="${item.id_221047 || ''}"
                                        data-siswa="${item.nama_siswa || ''}"
                                        data-kelas="${item.nama_kelas_221047 || ''}"
                                        data-total="${hargaTotal.toLocaleString()}"
                                        data-bukti="../siswa/uploads/bukti_pembayaran/${item.bukti_pembayaran_221047}">
                                        Lihat Bukti
                                    </button>
                                ` : ''}
                                <a class="btn btn-sm btn-info" href="detail.php?id=${item.id_221047 || ''}">
                                    Detail
                                </a>
                                <a class="btn btn-sm btn-danger" href="hapus.php?id=${item.id_221047 || ''}" 
                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    `;
                    tbody.insertAdjacentHTML('beforeend', row);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                const tbody = document.querySelector('tbody');
                tbody.innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center text-danger">
                            Gagal memuat data. Silakan coba lagi.
                        </td>
                    </tr>
                `;
            });
    }
});
</script>

</body>

</html>
