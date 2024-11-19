-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 06:53 PM
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
(5, 6, 'Matematika', 'keren', 500000, 'aktif', '2024-11-17 22:13:03'),
(6, 7, 'Matematika Dasar', 'kerren', 2000000, 'aktif', '2024-11-17 22:21:49');

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
  `durasi_221047` varchar(255) DEFAULT NULL,
  `status_221047` enum('aktif','nonaktif') NOT NULL DEFAULT 'nonaktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran_221047`
--

INSERT INTO `pendaftaran_221047` (`id_221047`, `id_siswa_221047`, `id_kelas_221047`, `tanggal_daftar_221047`, `status_bayar_221047`, `durasi_221047`, `status_221047`) VALUES
(19, 8, 5, '2024-11-17 22:19:20', 'lunas', '6', 'aktif'),
(20, 8, 6, '2024-11-17 22:22:53', 'lunas', '12', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `periode_kelas_221047`
--

CREATE TABLE `periode_kelas_221047` (
  `id_periode_221047` int(11) NOT NULL,
  `id_kelas_221047` int(11) DEFAULT NULL,
  `tanggal_mulai_221047` date DEFAULT NULL,
  `tanggal_selesai_221047` date DEFAULT NULL,
  `durasi_bulan_221047` int(11) DEFAULT NULL,
  `kuota_221047` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode_kelas_221047`
--

INSERT INTO `periode_kelas_221047` (`id_periode_221047`, `id_kelas_221047`, `tanggal_mulai_221047`, `tanggal_selesai_221047`, `durasi_bulan_221047`, `kuota_221047`) VALUES
(8, 5, '2024-12-01', '2025-06-01', 6, 15),
(9, 6, '2025-01-01', '2026-01-01', 12, 20);

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
(6, '696ed7534349804cf5050ae88bc994ba', 'Dr. Ahmad Zaky, M.Sc.', 'ahmad@gmail.com', 'pengajar', '0843', '2024-11-17 22:12:19'),
(7, '696ed7534349804cf5050ae88bc994ba', 'M. Ridwan Satria, S.S., M.A.', 'ridwan@gmail.com', 'pengajar', '08543', '2024-11-17 22:12:42'),
(8, 'bcd724d15cde8c47650fda962968f102', 'siswa', 'siswa@gmail.com', 'siswa', '0853', '2024-11-17 22:15:23');

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
  ADD KEY `materi_221047_ibfk_1` (`id_kelas_221047`);

--
-- Indexes for table `pendaftaran_221047`
--
ALTER TABLE `pendaftaran_221047`
  ADD PRIMARY KEY (`id_221047`),
  ADD KEY `id_siswa_221047` (`id_siswa_221047`,`id_kelas_221047`),
  ADD KEY `pendaftaran_221047_ibfk_2` (`id_kelas_221047`);

--
-- Indexes for table `periode_kelas_221047`
--
ALTER TABLE `periode_kelas_221047`
  ADD PRIMARY KEY (`id_periode_221047`),
  ADD KEY `periode_kelas_221047_ibfk_1` (`id_kelas_221047`);

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
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelas_221047`
--
ALTER TABLE `kelas_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `materi_221047`
--
ALTER TABLE `materi_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pendaftaran_221047`
--
ALTER TABLE `pendaftaran_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `periode_kelas_221047`
--
ALTER TABLE `periode_kelas_221047`
  MODIFY `id_periode_221047` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sistem_221047`
--
ALTER TABLE `sistem_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_221047`
--
ALTER TABLE `users_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  ADD CONSTRAINT `materi_221047_ibfk_1` FOREIGN KEY (`id_kelas_221047`) REFERENCES `kelas_221047` (`id_221047`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pendaftaran_221047`
--
ALTER TABLE `pendaftaran_221047`
  ADD CONSTRAINT `pendaftaran_221047_ibfk_1` FOREIGN KEY (`id_siswa_221047`) REFERENCES `users_221047` (`id_221047`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_221047_ibfk_2` FOREIGN KEY (`id_kelas_221047`) REFERENCES `kelas_221047` (`id_221047`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `periode_kelas_221047`
--
ALTER TABLE `periode_kelas_221047`
  ADD CONSTRAINT `periode_kelas_221047_ibfk_1` FOREIGN KEY (`id_kelas_221047`) REFERENCES `kelas_221047` (`id_221047`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
