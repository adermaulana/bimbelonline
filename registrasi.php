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


  if (isset($_POST['registrasi'])) {
    $password = md5($_POST['password']);
    $email = $_POST['email'];

    // Check if the username already exists
    $checkEmail = mysqli_query($koneksi, "SELECT * FROM users_221047 WHERE email_221047='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
        echo "<script>
                alert('Email sudah digunakan, pilih Email lain.');
                document.location='registrasi.php';
            </script>";
        exit; // Stop further execution
    }

    $role = 'siswa';

    // If the username is not taken, proceed with the registration
    $simpan = mysqli_query($koneksi, "INSERT INTO users_221047 (nama_lengkap_221047, email_221047 , no_hp_221047, role_221047, password_221047) VALUES ('$_POST[nama]','$_POST[email]','$_POST[telepon]','$role','$password')");

    if ($simpan) {
        echo "<script>
                alert('Berhasil Registrasi!');
                document.location='index.php';
            </script>";
    } else {
        echo "<script>
                alert('Gagal!');
                document.location='registrasi.php';
            </script>";
    }
}
  

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrasi</title>
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
                  <img src="" width="180" alt="">
                </a>
                <p class="text-center">Registrasi</p>
                <form method="POST">
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" aria-describedby="nama" required>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                  </div>
                  <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="number" class="form-control" id="telepon" name="telepon" aria-describedby="emailHelp" required>
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>

                  <button type="submit" name="registrasi" class="btn btn-primary w-100 fs-4 mb-4 rounded-2">Sign Up</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Sudah punya akun?</p>
                    <a class="text-primary fw-bold ms-2" href="login.php">Login</a>
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