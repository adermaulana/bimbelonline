-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 10:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_bimbel_221047`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_221047`
--

CREATE TABLE `jadwal_221047` (
  `id_221047` int(11) NOT NULL,
  `id_kelas_221047` int(11) NOT NULL,
  `hari_221047` varchar(255) NOT NULL,
  `jam_mulai_221047` time NOT NULL,
  `jam_selesai_221047` time NOT NULL,
  `link_meet_221047` varchar(255) NOT NULL,
  `created_at_221047` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_221047`
--

INSERT INTO `jadwal_221047` (`id_221047`, `id_kelas_221047`, `hari_221047`, `jam_mulai_221047`, `jam_selesai_221047`, `link_meet_221047`, `created_at_221047`) VALUES
(3, 2, 'Senin', '20:09:00', '21:09:00', 'https://github.com/adermaulanaudin', '2024-11-05 09:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_221047`
--

CREATE TABLE `kelas_221047` (
  `id_221047` int(11) NOT NULL,
  `id_pengajar_221047` int(11) NOT NULL,
  `nama_kelas_221047` varchar(100) NOT NULL,
  `deskripsi_221047` text DEFAULT NULL,
  `harga_221047` int(11) NOT NULL,
  `status_221047` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at_221047` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas_221047`
--

INSERT INTO `kelas_221047` (`id_221047`, `id_pengajar_221047`, `nama_kelas_221047`, `deskripsi_221047`, `harga_221047`, `status_221047`, `created_at_221047`) VALUES
(2, 3, 'Matematika Dasar', 'Matematika Dasar', 500000, 'aktif', '2024-11-01 18:34:46'),
(3, 3, 'Matematika Lanjutan', 'Matematika Lanjutan', 1000000, 'aktif', '2024-11-01 19:07:21'),
(4, 3, 'Pemrograman Dasar', 'Pemrograman Dasar adalah pengenalan dan pembelajaran konsep dasar dalam pemrograman komputer yang mencakup cara menulis, memahami, dan menjalankan kode. Materi ini biasanya meliputi pengenalan algoritma, struktur data dasar, dan sintaksis bahasa pemrograman. Di dalam Pemrograman Dasar, siswa belajar memahami logika pemrograman, penggunaan variabel, tipe data, operasi logika, perulangan, dan percabangan. Tujuan dari Pemrograman Dasar adalah agar siswa dapat membuat program sederhana dan memiliki dasar pemikiran algoritmis yang diperlukan untuk memecahkan masalah dalam konteks pemrograman. Pembelajaran ini sering menggunakan bahasa pemrograman seperti Python, Java, atau C++ untuk memperkenalkan sintaksis dasar dan konsep yang umum dalam berbagai bahasa pemrograman.', 500000, 'aktif', '2024-11-05 09:04:17');

-- --------------------------------------------------------

--
-- Table structure for table `materi_221047`
--

CREATE TABLE `materi_221047` (
  `id_221047` int(11) NOT NULL,
  `id_kelas_221047` int(11) NOT NULL,
  `judul_221047` varchar(100) NOT NULL,
  `deskripsi_221047` text NOT NULL,
  `file_materi_221047` varchar(255) DEFAULT NULL,
  `created_at_221047` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materi_221047`
--

INSERT INTO `materi_221047` (`id_221047`, `id_kelas_221047`, `judul_221047`, `deskripsi_221047`, `file_materi_221047`, `created_at_221047`) VALUES
(2, 3, 'Algoritma', 'Algoritma', '20241101202037_67252a051e0d0.docx', '2024-11-01 19:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_221047`
--

CREATE TABLE `pendaftaran_221047` (
  `id_221047` int(11) NOT NULL,
  `id_siswa_221047` int(11) NOT NULL,
  `id_kelas_221047` int(11) NOT NULL,
  `tanggal_daftar_221047` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_bayar_221047` enum('pending','lunas') DEFAULT 'pending',
  `status_221047` enum('aktif','nonaktif') NOT NULL DEFAULT 'nonaktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran_221047`
--

INSERT INTO `pendaftaran_221047` (`id_221047`, `id_siswa_221047`, `id_kelas_221047`, `tanggal_daftar_221047`, `status_bayar_221047`, `status_221047`) VALUES
(1, 4, 2, '2024-11-01 18:41:56', 'lunas', 'aktif'),
(2, 4, 3, '2024-11-01 19:56:44', 'lunas', 'aktif'),
(5, 4, 4, '2024-11-05 09:09:33', 'lunas', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `sistem_221047`
--

CREATE TABLE `sistem_221047` (
  `id_221047` int(11) NOT NULL,
  `logo_221047` varchar(255) NOT NULL,
  `nama_221047` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sistem_221047`
--

INSERT INTO `sistem_221047` (`id_221047`, `logo_221047`, `nama_221047`) VALUES
(2, 'uploads/Screenshot (1).png', 'Bimbel Online');

-- --------------------------------------------------------

--
-- Table structure for table `users_221047`
--

CREATE TABLE `users_221047` (
  `id_221047` int(11) NOT NULL,
  `password_221047` varchar(255) NOT NULL,
  `nama_lengkap_221047` varchar(100) NOT NULL,
  `email_221047` varchar(100) NOT NULL,
  `role_221047` enum('admin','pengajar','siswa') NOT NULL,
  `no_hp_221047` varchar(15) DEFAULT NULL,
  `created_at_221047` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_221047`
--

INSERT INTO `users_221047` (`id_221047`, `password_221047`, `nama_lengkap_221047`, `email_221047`, `role_221047`, `no_hp_221047`, `created_at_221047`) VALUES
(2, '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin@gmail.com', 'admin', '09543', '2024-11-01 18:04:59'),
(3, '696ed7534349804cf5050ae88bc994ba', 'pengajar', 'pengajar@gmail.com', 'pengajar', '2332', '2024-11-01 18:08:29'),
(4, 'bcd724d15cde8c47650fda962968f102', 'siswa', 'siswa@gmail.com', 'siswa', '1212', '2024-11-01 18:13:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal_221047`
--
ALTER TABLE `jadwal_221047`
  ADD PRIMARY KEY (`id_221047`),
  ADD KEY `id_kelas_221047` (`id_kelas_221047`);

--
-- Indexes for table `kelas_221047`
--
ALTER TABLE `kelas_221047`
  ADD PRIMARY KEY (`id_221047`),
  ADD KEY `id_pengajar_221047` (`id_pengajar_221047`);

--
-- Indexes for table `materi_221047`
--
ALTER TABLE `materi_221047`
  ADD PRIMARY KEY (`id_221047`),
  ADD KEY `kelas_id_221047` (`id_kelas_221047`);

--
-- Indexes for table `pendaftaran_221047`
--
ALTER TABLE `pendaftaran_221047`
  ADD PRIMARY KEY (`id_221047`),
  ADD KEY `kelas_id_221047` (`id_kelas_221047`),
  ADD KEY `id_siswa_221047` (`id_siswa_221047`,`id_kelas_221047`);

--
-- Indexes for table `sistem_221047`
--
ALTER TABLE `sistem_221047`
  ADD PRIMARY KEY (`id_221047`);

--
-- Indexes for table `users_221047`
--
ALTER TABLE `users_221047`
  ADD PRIMARY KEY (`id_221047`),
  ADD UNIQUE KEY `email_221047` (`email_221047`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal_221047`
--
ALTER TABLE `jadwal_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas_221047`
--
ALTER TABLE `kelas_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `materi_221047`
--
ALTER TABLE `materi_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pendaftaran_221047`
--
ALTER TABLE `pendaftaran_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sistem_221047`
--
ALTER TABLE `sistem_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_221047`
--
ALTER TABLE `users_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal_221047`
--
ALTER TABLE `jadwal_221047`
  ADD CONSTRAINT `jadwal_221047_ibfk_1` FOREIGN KEY (`id_kelas_221047`) REFERENCES `kelas_221047` (`id_221047`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas_221047`
--
ALTER TABLE `kelas_221047`
  ADD CONSTRAINT `kelas_221047_ibfk_1` FOREIGN KEY (`id_pengajar_221047`) REFERENCES `users_221047` (`id_221047`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materi_221047`
--
ALTER TABLE `materi_221047`
  ADD CONSTRAINT `materi_221047_ibfk_1` FOREIGN KEY (`id_kelas_221047`) REFERENCES `kelas_221047` (`id_221047`);

--
-- Constraints for table `pendaftaran_221047`
--
ALTER TABLE `pendaftaran_221047`
  ADD CONSTRAINT `pendaftaran_221047_ibfk_1` FOREIGN KEY (`id_siswa_221047`) REFERENCES `users_221047` (`id_221047`),
  ADD CONSTRAINT `pendaftaran_221047_ibfk_2` FOREIGN KEY (`id_kelas_221047`) REFERENCES `kelas_221047` (`id_221047`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
