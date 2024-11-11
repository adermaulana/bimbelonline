<?php
  include 'koneksi.php';

  session_start();

  if(isset($_SESSION['status']) != 'login'){

    session_unset();
    session_destroy();

    echo "<script>
    alert('Login terlebih dahulu untuk membeli kelas!');
    document.location='login.php';
         </script>";

}

  $id_materi = $_GET['id'];
  $id_siswa = $_SESSION['id_admin'];

  $query = mysqli_query($koneksi, "SELECT kelas_221047.*, users_221047.nama_lengkap_221047
                                 FROM kelas_221047 
                                 INNER JOIN users_221047 
                                 ON kelas_221047.id_pengajar_221047 = users_221047.id_221047 
                                 WHERE kelas_221047.id_221047 = $id_materi AND users_221047.role_221047 = 'pengajar'");

$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan, tampilkan pesan atau redirect
if (!$data) {
    echo "Detail materi tidak ditemukan.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Bimbel Online</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/home/img/favicon.png" rel="icon">
  <link href="assets/home/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/home/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/home/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/home/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/home/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/home/css/main2.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mentor
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="courses-page">

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">BIMBEL ONLINE</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" class="active">Home<br></a></li>
          <li><a href="kelas.php">Kelas</a></li>
          <li><a href="kontak.php">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="login.php">Login</a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Beli Kelas</h1>
                    <p class="mb-0"><?= $data['nama_kelas_221047'] ?></p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
        <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">Detail Materi</li>
        </ol>
        </div>
    </nav>
    </div><!-- End Page Title -->


    <section id="courses-course-details" class="courses-course-details section">
    <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-8">
                    <img src="assets/home/img/course-details.jpg" class="img-fluid" alt="">
                    <h3><?= $data['nama_kelas_221047'] ?></h3>
                    <p><?= $data['deskripsi_221047'] ?></p>
                </div>
                <div class="col-lg-4">
                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Pengajar</h5>
                        <p><?= $data['nama_lengkap_221047'] ?></p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Harga</h5>
                        <p id="harga">Rp <?= number_format($data['harga_221047'], 0, ',', '.'); ?></p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Nama Pembeli</h5>
                        <p><?= $_SESSION['nama_admin'] ?></p>
                    </div>


                    <!-- Tambahkan tombol konfirmasi pembelian -->
                    <div class="text-center mt-4">
                        <form action="proses_beli.php" method="POST">
                            <input type="hidden" name="id_siswa" value="<?= $id_siswa ?>">
                            <input type="hidden" name="id_kelas" value="<?= $data['id_221047'] ?>">
                            <input type="hidden" name="harga" id="harga_hidden" value="<?= $data['harga_221047'] ?>">
                            <select name="durasi" id="durasi" class="form-select mb-3" required>
                              <option value="" disabled selected>Pilih Durasi</option>
                              <option value="1">1 Bulan</option>
                              <option value="6">6 Bulan</option>
                              <option value="12">12 Bulan</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-lg">Konfirmasi Pembelian</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
  </main>

  <footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Mentor</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="materi.php">Materi</a></li>
            <li><a href="paket.php">Paket</a></li>
            <li><a href="kontak.php">Kontak</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Our Newsletter</h4>
          <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
          <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Mentor</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/home/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/home/vendor/php-email-form/validate.js"></script>
  <script src="assets/home/vendor/aos/aos.js"></script>
  <script src="assets/home/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/home/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/home/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/home/js/main.js"></script>

  <script>
    // Harga per bulan (tanpa diskon)
    const hargaPerBulan = <?= $data['harga_221047'] ?>;

    // Elemen harga dan select durasi
    const hargaElement = document.getElementById("harga");
    const hargaHidden = document.getElementById("harga_hidden");
    const durasiSelect = document.getElementById("durasi");

    // Fungsi untuk update harga
    durasiSelect.addEventListener("change", function() {
        let hargaTerbaru = hargaPerBulan;

        // Tentukan harga berdasarkan durasi
        if (durasiSelect.value === "12") {
            // Jika 12 bulan, total harga dengan diskon 10%
            hargaTerbaru = hargaPerBulan * 12 * 0.9;
        } else if (durasiSelect.value === "6") {
            hargaTerbaru = hargaPerBulan * 6 * 0.95;
        } else if (durasiSelect.value === "1") {
            // Jika 1 bulan, harga tetap per bulan
            hargaTerbaru = hargaPerBulan;
        }

        // Format harga dengan rupiah
        hargaElement.innerText = "Rp " + new Intl.NumberFormat("id-ID").format(hargaTerbaru);
        hargaHidden.value = hargaTerbaru; // Update hidden input harga
    });
</script>

</body>

</html>