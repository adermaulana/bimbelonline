<?php

include '../koneksi.php';

session_start();

if ($_SESSION['status'] != 'login') {
    session_unset();
    session_destroy();

    header('location:../');
}

if (isset($_POST['simpan'])) {
    // Check if email already exists
    $email = $_POST['email_221047'];
    $checkEmail = mysqli_query($koneksi, "SELECT * FROM users_221047 WHERE email_221047='$email'");

    if (mysqli_num_rows($checkEmail) > 0) {
        echo "<script>
                alert('Email sudah terdaftar!');
                document.location='tambahuser.php';
              </script>";
    } else {
        // Hash the password using md5
        $hashedPassword = md5($_POST['password_221047']);

        // Insert new user into the database
        $simpan = mysqli_query($koneksi, "INSERT INTO users_221047 (nama_lengkap_221047, email_221047, no_hp_221047	, role_221047, password_221047) VALUES ('$_POST[name_221047]', '$email','$_POST[phone_221047]','$_POST[role_221047]', '$hashedPassword')");

        if ($simpan) {
            echo "<script>
                    alert('Simpan data sukses!');
                    document.location='user.php';
                </script>";
        } else {
            echo "<script>
                    alert('Simpan data Gagal!');
                    document.location='user.php';
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
    <title>Dahsboard Admin</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />

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
                            <a class="sidebar-link sidebar-link primary-hover-bg" href="index.php"
                                aria-expanded="false">
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
                            <a class="sidebar-link sidebar-link warning-hover-bg" href="user.php" aria-expanded="false">
                                <span class="aside-icon p-2 bg-light-warning rounded-3">
                                    <i class="ti ti-article fs-7 text-warning"></i>
                                </span>
                                <span class="hide-menu ms-2 ps-1">Data User</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link danger-hover-bg" href="kelas.php" aria-expanded="false">
                                <span class="aside-icon p-2 bg-light-danger rounded-3">
                                    <i class="ti ti-alert-circle fs-7 text-danger"></i>
                                </span>
                                <span class="hide-menu ms-2 ps-1">Data Kelas</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link success-hover-bg" href="pembayaran.php"
                                aria-expanded="false">
                                <span class="aside-icon p-2 bg-light-success rounded-3">
                                    <i class="ti ti-cards fs-7 text-success"></i>
                                </span>
                                <span class="hide-menu ms-2 ps-1">Data Pembayaran</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link primary-hover-bg" href="laporan.php"
                                aria-expanded="false">
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
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
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
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../assets/images/profile/user1.jpg" alt="" width="35"
                                        height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>
                                        <a href="logout.php"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block shadow-none">Logout</a>
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
                            <h5 class="card-title fw-semibold mb-4">Tambah User</h5>
                            <div class="card">
                                <div class="card-body col-6">
                                    <form method="POST">
                                        <div class="mb-3">
                                            <label for="name_221047" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="name_221047"
                                                name="name_221047" required>
                                            <div id="namaError" class="error-message">Nama harus diisi</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email_221047" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email_221047"
                                                name="email_221047" required>
                                            <div id="emailError" class="error-message">Email tidak valid</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone_221047" class="form-label">Telepon</label>
                                            <input type="number" class="form-control" id="phone_221047"
                                                name="phone_221047" required>
                                            <div id="phoneError" class="error-message">Nomor telepon tidak valid</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role_221047" class="form-label">Role</label>
                                            <select class="form-select" id="role_221047" name="role_221047" required>
                                                <option value="" disabled selected>Pilih Role</option>
                                                <option value="admin">Admin</option>
                                                <option value="pengajar">Pengajar</option>
                                                <option value="siswa">Siswa</option>
                                            </select>
                                            <div id="roleError" class="error-message">Pilih role pengguna</div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="password_221047" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password_221047"
                                                name="password_221047" required>
                                            <div id="passwordError" class="error-message">Password tidak memenuhi
                                                persyaratan</div>
                                        </div>
                                        <button type="submit" name="simpan" id="submitButton" class="btn btn-primary"
                                            >Tambah</button>
                                    </form>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('tambahUserForm');
            const nama = document.getElementById('name_221047');
            const email = document.getElementById('email_221047');
            const phone = document.getElementById('phone_221047');
            const role = document.getElementById('role_221047');
            const password = document.getElementById('password_221047');
            const submitButton = document.getElementById('submitButton');

            // Error message elements
            const namaError = document.getElementById('namaError');
            const emailError = document.getElementById('emailError');
            const phoneError = document.getElementById('phoneError');
            const roleError = document.getElementById('roleError');
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

            function validatePhone() {
                const phoneRegex = /^(^\+62|62|0)(\d{9,13})$/;
                if (!phoneRegex.test(phone.value)) {
                    phoneError.textContent = 'Gunakan format Indonesia (dimulai 08, +62, atau 62)';
                    phoneError.style.display = 'block';
                    return false;
                }
                phoneError.style.display = 'none';
                return true;
            }

            function validateRole() {
                if (role.value === '') {
                    roleError.style.display = 'block';
                    return false;
                }
                roleError.style.display = 'none';
                return true;
            }

            function validatePassword() {
                if (password.value.length < 8) {
                    passwordError.textContent = 'Password minimal 8 karakter';
                    passwordError.style.display = 'block';
                    return false;
                }

                passwordError.style.display = 'none';
                return true;
            }

            // Check overall form validity
            function checkFormValidity() {
                const isNamaValid = validateNama();
                const isEmailValid = validateEmail();
                const isPhoneValid = validatePhone();
                const isRoleValid = validateRole();
                const isPasswordValid = validatePassword();

                // Enable or disable the submit button based on all validations
                if (isNamaValid && isEmailValid && isPhoneValid && isRoleValid && isPasswordValid) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }
            }

            // Real-time validation
            nama.addEventListener('input', checkFormValidity);
            email.addEventListener('input', checkFormValidity);
            phone.addEventListener('input', checkFormValidity);
            role.addEventListener('change', checkFormValidity);
            password.addEventListener('input', checkFormValidity);

            // Form submission validation
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                checkFormValidity();

                if (!submitButton.disabled) {
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>
