<?php

    include 'koneksi.php';

    session_start();

    if (isset($_SESSION['status']) && $_SESSION['status'] == 'login') {

      if ($_SESSION['role_admin'] == 'admin') {
          header("location:admin");
          exit();
      } else if ($_SESSION['role_admin'] == 'pengajar') {
          header("location:pengajar");
          exit();
      } else {
          header("location:siswa");
          exit();
      }
  
  }
  

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
    
        $login = mysqli_query($koneksi, "SELECT * FROM `users_221047`
                                    WHERE `email_221047` = '$email'
                                    AND `password_221047` = '$password'
                                    AND `role_221047` = 'admin'
                                    AND `status_221047` = 'active'");
        $cek = mysqli_num_rows($login);

        $loginPengajar = mysqli_query($koneksi, "SELECT * FROM `users_221047`
                                    WHERE `email_221047` = '$email'
                                    AND `password_221047` = '$password'
                                    AND `role_221047` = 'pengajar'
                                    AND `status_221047` = 'active'");
        $cekPengajar = mysqli_num_rows($loginPengajar);

        $loginSiswa = mysqli_query($koneksi, "SELECT * FROM `users_221047`
                                    WHERE `email_221047` = '$email'
                                    AND `password_221047` = '$password'
                                    AND `role_221047` = 'siswa'
                                    AND `status_221047` = 'active'");
        $cekSiswa = mysqli_num_rows($loginSiswa);
    
        if ($cek > 0) {
            // Ambil data user
            $admin_data = mysqli_fetch_assoc($login);
            // Simpan data ke dalam session
            $_SESSION['id_admin'] = $admin_data['id_221047']; // Pastikan sesuai dengan nama kolom di database
            $_SESSION['nama_admin'] = $admin_data['name_221047']; // Pastikan sesuai dengan nama kolom di database
            $_SESSION['email_admin'] = $email;
            $_SESSION['role_admin'] = $admin_data['role_221047'];
            $_SESSION['status'] = "login";
            // Redirect ke halaman admin
            header('location:admin');

        } else if ($cekPengajar > 0) {
          // Ambil data user
          $admin_data = mysqli_fetch_assoc($loginPengajar);
          // Simpan data ke dalam session
          $_SESSION['id_admin'] = $admin_data['id_221047']; // Pastikan sesuai dengan nama kolom di database
          $_SESSION['nama_admin'] = $admin_data['name_221047']; // Pastikan sesuai dengan nama kolom di database
          $_SESSION['email_admin'] = $email;
          $_SESSION['role_admin'] = $admin_data['role_221047'];
          $_SESSION['status'] = "login";
          // Redirect ke halaman admin
          header('location:pengajar');
      } else if ($cekSiswa > 0) {
        // Ambil data user
        $admin_data = mysqli_fetch_assoc($loginSiswa);
        // Simpan data ke dalam session
        $_SESSION['id_admin'] = $admin_data['id_221047']; // Pastikan sesuai dengan nama kolom di database
        $_SESSION['nama_admin'] = $admin_data['name_221047']; // Pastikan sesuai dengan nama kolom di database
        $_SESSION['email_admin'] = $email;
        $_SESSION['role_admin'] = $admin_data['role_221047'];
        $_SESSION['status'] = "login";
        // Redirect ke halaman admin
        header('location:siswa');
    }  else {
            echo "<script>
                alert('Login Gagal, Periksa Username dan Password Anda!');
                window.location.href = 'login.php';
                 </script>";
        }
    }
    

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Spike Free</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="index.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="assets/images/logos/dark-logo.svg" width="180" alt="">
                </a>
                <p class="text-center">Your Social Campaigns</p>
                <form method="POST">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                  </div>

                  <button type="submit" name="login" class="btn btn-primary w-100 fs-4 mb-4 rounded-2">Sign In</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Belum punya akun?</p>
                    <a class="text-primary fw-bold ms-2" href="registrasi.php">Registrasi</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>