<?php

include 'koneksi.php';

session_start();


if (isset($_SESSION['role_admin']) && $_SESSION['role_admin'] == 'admin') {
  $isLoggedIn = true;
  $namaAdmin = $_SESSION['nama_admin']; // Ambil nama admin dari session
} elseif (isset($_SESSION['role_admin']) && $_SESSION['role_admin'] == 'pengajar') {
  $isLoggedIn = true;
  $namaPelanggan = $_SESSION['nama_admin']; // Ambil nama pengajar dari session
} elseif (isset($_SESSION['role_admin']) && $_SESSION['role_admin'] == 'siswa') {
  $isLoggedIn = true;
  $namaPelanggan = $_SESSION['nama_admin']; // Ambil nama siswa dari session
} else {
  $isLoggedIn = false;
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

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
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

      
      <?php if($isLoggedIn): ?>
                <?php if(isset($_SESSION['role_admin']) && $_SESSION['role_admin'] == 'admin'): ?>
                  <a class="btn-getstarted" href="admin">Dashboard</a>
                  <a class="btn-getstarted" href="logout.php">Logout</a>
                </nav>
                <?php elseif(isset($_SESSION['role_admin']) && $_SESSION['role_admin'] == 'pengajar'): ?>
                  <a class="btn-getstarted" href="pengajar">Dashboard</a>
                  <a class="btn-getstarted" href="logout.php">Logout</a>
                </nav>
                <?php else: ?>
                    <a class="btn-getstarted" href="siswa">Dashboard</a>
                    <a class="btn-getstarted" href="logout.php">Logout</a>
                <?php endif; ?>
                <?php else: ?>
                  <a class="btn-getstarted" href="login.php">Login</a>
                <?php endif; ?>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="assets/home/img/hero-bg.jpg" alt="" data-aos="fade-in">

        <div class="container">
        <h2 data-aos="fade-up" data-aos-delay="100">Belajar Hari Ini,<br>Pemimpin Esok Hari</h2>
        <p data-aos="fade-up" data-aos-delay="200">Bersama kami, tim profesional yang siap membantu Anda membangun masa depan melalui pembelajaran yang terstruktur dan efektif.</p>
        <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
            <a href="materi.php" class="btn-get-started">Mulai Sekarang</a>
        </div>
        </div>


    </section><!-- /Hero Section -->

    <!-- Counts Section -->
    <section id="counts" class="section counts light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="1232" data-purecounter-duration="1" class="purecounter"></span>
              <p>Siswa</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-4 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="64" data-purecounter-duration="1" class="purecounter"></span>
              <p>Materi</p>
            </div>
          </div><!-- End Stats Item -->


          <div class="col-lg-4 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>
              <p>Pengajar</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Counts Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="section why-us">

      <div class="container">

        <div class="row gy-4">

        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="why-box">
            <h3>Mengapa Memilih Bimbel Online Kami?</h3>
            <p>
            Tingkatkan prestasi akademik Anda dengan bimbingan belajar online terbaik! Kami hadir untuk memberikan solusi pembelajaran yang interaktif, praktis, dan sesuai kebutuhan siswa. Dapatkan akses materi lengkap, pengajar profesional, dan metode belajar yang efektif di mana saja, kapan saja.
            </p>
            <div class="text-center">
            <a href="#" class="more-btn"><span>Pelajari Lebih Lanjut</span> <i class="bi bi-chevron-right"></i></a>
            </div>
        </div>
        </div><!-- End Why Box -->

        <div class="col-lg-8 d-flex align-items-stretch">
        <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">

            <div class="col-xl-4">
            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-clipboard-data"></i>
                <h4>Kurikulum Terstruktur & Terbaru</h4>
                <p>Kami menggunakan kurikulum yang disesuaikan dengan standar terbaru, memastikan siswa memahami konsep dengan baik.</p>
            </div>
            </div><!-- End Icon Box -->

            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-gem"></i>
                <h4>Pengajar Berpengalaman & Ahli</h4>
                <p>Pengajar kami adalah ahli di bidangnya yang siap membantu siswa mencapai potensi terbaik mereka dengan bimbingan yang personal.</p>
            </div>
            </div><!-- End Icon Box -->

            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-inboxes"></i>
                <h4>Belajar Fleksibel & Interaktif</h4>
                <p>Dapatkan pengalaman belajar yang fleksibel dan interaktif, yang memudahkan siswa belajar di mana pun dan kapan pun mereka siap.</p>
            </div>
            </div><!-- End Icon Box -->
        </div>
        </div><!-- End Row -->


        </div>

      </div>

    </section><!-- /Why Us Section -->


    <!-- Courses Section -->
    <section id="courses" class="courses section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Materi</h2>
        <p>Materi Terpopular</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row">

        <?php
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT kelas_221047.*, users_221047.nama_lengkap_221047 
                                                              FROM kelas_221047 
                                                              INNER JOIN users_221047 
                                                              ON kelas_221047.id_pengajar_221047 = users_221047.id_221047
                                                              WHERE users_221047.role_221047 = 'pengajar'
                                                              ORDER BY nama_kelas_221047 ASC");
                            while($data = mysqli_fetch_array($tampil)):
                        ?>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
          <div class="course-item">
            <a href="detail_materi.php?id=<?php echo $data['id_221047']; ?>">
              <img src="assets/home/img/course-1.jpg" class="img-fluid" alt="Course Image">
            </a>
            <div class="course-content">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="category">ID: <?php echo $data['id_221047']; ?></p>
                <p class="price">Rp <?php echo number_format($data['harga_221047'], 0, ',', '.'); ?></p>
              </div>

              <h3><a href="detail_materi.php?id=<?php echo $data['id_221047']; ?>">
                <?php echo $data['nama_kelas_221047']; ?>
              </a></h3>
              
              <p class="description"><?php echo $data['deskripsi_221047']; ?></p>
              
              <div class="trainer d-flex justify-content-between align-items-center">
                <div class="trainer-profile d-flex align-items-center">
                  <img src="assets/home/img/trainers/trainer-1-2.jpg" class="img-fluid" alt="Trainer">
                  <span class="trainer-link">
                    <?php 
                      echo $data['nama_lengkap_221047']; 
                    ?>
                  </span>
                </div>
                <div class="trainer-rank d-flex align-items-center">
                  <i class="bi bi-calendar-check"></i>&nbsp;
                  <?php echo date('d/m/Y', strtotime($data['created_at_221047'])); ?>
                  &nbsp;&nbsp;
                  <i class="bi bi-check-circle<?php echo ($data['status_221047'] == 1) ? '-fill' : ''; ?>"></i>&nbsp;
                  <?php echo ($data['status_221047'] == 'aktif') ? 'aktif' : 'nonaktif'; ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php
                            endwhile;
                        ?>

        </div>

      </div>

    </section><!-- /Courses Section -->

    <!-- Trainers Index Section -->
    <section id="trainers-index" class="section trainers-index">

      <div class="container">

        <div class="row">

        <?php
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT id_221047,
                                                                    nama_lengkap_221047,
                                                                    role_221047,
                                                                    no_hp_221047,
                                                                    created_at_221047
                                                              FROM users_221047
                                                              WHERE role_221047 = 'pengajar'");
                            while($data = mysqli_fetch_array($tampil)):
                        ?>

          <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <img src="assets/home/img/trainers/trainer-1.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4><?= $data['nama_lengkap_221047'] ?></h4>
                <span>Web Development</span>
                <p>
                  Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut
                </p>
              </div>
            </div>
          </div><!-- End Team Member -->

          <?php
                            endwhile;
                        ?>

        </div>

      </div>

    </section><!-- /Trainers Index Section -->

  </main>

  <footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.php" class="logo d-flex align-items-center">
            <span class="sitename">Mentor</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jalan Perintis</p>
            <p>Makassar, Indonesia</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+62 853 55488 55</span></p>
            <p><strong>Email:</strong> <span>bimbel@example.com</span></p>
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

</body>

</html>