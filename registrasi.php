<?php

include 'koneksi.php';

session_start();

if (isset($_SESSION['status']) && $_SESSION['status'] == 'login') {
    if ($_SESSION['role_admin'] == 'admin') {
        header('location:admin');
        exit();
    } elseif ($_SESSION['role_admin'] == 'pengajar') {
        header('location:pengajar');
        exit();
    } else {
        header('location:siswa');
        exit();
    }
}

if (isset($_POST['registrasi'])) {
    // Validate telephone number
    $telepon = $_POST['telepon'];
    if (!preg_match('/^(^\+62|62|0)(\d{9,13})$/', $telepon)) {
        echo "<script>
                alert('Nomor telepon tidak valid. Gunakan format Indonesia (dimulai 08, atau 62).');
                document.location='registrasi.php';
            </script>";
        exit();
    }

    // Validate password strength
    $password = $_POST['password'];
    if (strlen($password) < 8) {
        echo "<script>
                alert('Password minimal 8 karakter.');
                document.location='registrasi.php';
            </script>";
        exit();
    }

    $password = md5($_POST['password']);
    $email = $_POST['email'];

    // Check if the username already exists
    $checkEmail = mysqli_query($koneksi, "SELECT * FROM users_221047 WHERE email_221047='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
        echo "<script>
                alert('Email sudah digunakan, pilih Email lain.');
                document.location='registrasi.php';
            </script>";
        exit(); // Stop further execution
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

    <style>
        .error-message {
            color: red;
            font-size: 0.8rem;
            margin-top: 5px;
            display: none;
        }
    </style>

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
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            aria-describedby="nama" required>
                                        <div id="namaError" class="error-message">Nama harus diisi</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            aria-describedby="emailHelp" required>
                                        <div id="emailError" class="error-message">Email tidak valid</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telepon" class="form-label">Telepon</label>
                                        <input type="number" class="form-control" id="telepon" name="telepon"
                                            aria-describedby="emailHelp" required>
                                        <div id="teleponError" class="error-message">Nomor telepon tidak valid</div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>
                                        <div id="passwordError" class="error-message">Password tidak memenuhi
                                            persyaratan</div>
                                    </div>

                                    <button type="submit" name="registrasi"
                                        class="btn btn-primary w-100 fs-4 mb-4 rounded-2">Sign Up</button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registrationForm');
            const nama = document.getElementById('nama');
            const email = document.getElementById('email');
            const telepon = document.getElementById('telepon');
            const password = document.getElementById('password');

            // Error message elements
            const namaError = document.getElementById('namaError');
            const emailError = document.getElementById('emailError');
            const teleponError = document.getElementById('teleponError');
            const passwordError = document.getElementById('passwordError');

            // Validation functions
            function validateNama() {
                if (nama.value.trim() === '') {
                    namaError.style.display = 'block';
                    return false;
                }
                namaError.style.display = 'none';
                return true;
            }

            function validateEmail() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email.value)) {
                    emailError.style.display = 'block';
                    return false;
                }
                emailError.style.display = 'none';
                return true;
            }

            function validateTelepon() {
                const teleponRegex = /^(^\+62|62|0)(\d{9,13})$/;
                if (!teleponRegex.test(telepon.value)) {
                    teleponError.textContent = 'Gunakan format Indonesia (dimulai 08, atau 62)';
                    teleponError.style.display = 'block';
                    return false;
                }
                teleponError.style.display = 'none';
                return true;
            }

            function validatePassword() {
                // Password must be at least 8 characters long
                // Must contain at least one uppercase, one lowercase, one number, and one special character
                const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

                if (password.value.length < 8) {
                    passwordError.textContent = 'Password minimal 8 karakter';
                    passwordError.style.display = 'block';
                    return false;
                }

                passwordError.style.display = 'none';
                return true;
            }

            // Real-time validation
            nama.addEventListener('input', validateNama);
            email.addEventListener('input', validateEmail);
            telepon.addEventListener('input', validateTelepon);
            password.addEventListener('input', validatePassword);

            // Form submission validation
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const isNamaValid = validateNama();
                const isEmailValid = validateEmail();
                const isTeleponValid = validateTelepon();
                const isPasswordValid = validatePassword();

                if (isNamaValid && isEmailValid && isTeleponValid && isPasswordValid) {
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>
