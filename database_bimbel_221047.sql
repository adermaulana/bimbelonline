-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 02:07 PM
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
-- Table structure for table `jawaban_siswa_221047`
--

CREATE TABLE `jawaban_siswa_221047` (
  `id_221047` int(11) NOT NULL,
  `ujian_id_221047` int(11) DEFAULT NULL,
  `siswa_id_221047` int(11) DEFAULT NULL,
  `soal_id_221047` int(11) DEFAULT NULL,
  `jawaban_221047` enum('a','b','c','d') DEFAULT NULL,
  `benar_221047` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_221047`
--

CREATE TABLE `kelas_221047` (
  `id_221047` int(11) NOT NULL,
  `pengajar_id_221047` int(11) DEFAULT NULL,
  `judul_221047` varchar(255) NOT NULL,
  `deskripsi_221047` text DEFAULT NULL,
  `kuota_221047` int(11) DEFAULT 0,
  `jadwal_mulai_221047` date DEFAULT NULL,
  `jadwal_selesai_221047` date DEFAULT NULL,
  `status_221047` enum('Aktif','Nonaktif') DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas_221047`
--

INSERT INTO `kelas_221047` (`id_221047`, `pengajar_id_221047`, `judul_221047`, `deskripsi_221047`, `kuota_221047`, `jadwal_mulai_221047`, `jadwal_selesai_221047`, `status_221047`) VALUES
(4, 3, 'Kelas', NULL, 30, '2000-12-12', '2001-02-01', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `materi_221047`
--

CREATE TABLE `materi_221047` (
  `id_221047` int(11) NOT NULL,
  `kelas_id_221047` int(11) DEFAULT NULL,
  `judul_221047` varchar(255) NOT NULL,
  `deskripsi_221047` text DEFAULT NULL,
  `file_path_221047` varchar(255) DEFAULT NULL,
  `type_221047` enum('pdf','video','text') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paket_221047`
--

CREATE TABLE `paket_221047` (
  `id_221047` int(10) NOT NULL,
  `nama_paket_221047` varchar(255) NOT NULL,
  `harga_221047` decimal(10,2) NOT NULL,
  `durasi_221047` enum('minggu','bulan','tahun') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat_221047`
--

CREATE TABLE `sertifikat_221047` (
  `id_221047` int(11) NOT NULL,
  `siswa_id_221047` int(11) DEFAULT NULL,
  `kelas_id_221047` int(11) DEFAULT NULL,
  `file_path_221047` varchar(255) NOT NULL,
  `tanggal_terbit_221047` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sistem`
--

CREATE TABLE `sistem` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sistem`
--

INSERT INTO `sistem` (`id`, `logo`, `nama`) VALUES
(4, 'uploads/Screenshot (2).png', 'sfsfsfsfs');

-- --------------------------------------------------------

--
-- Table structure for table `soal_ujian_221047`
--

CREATE TABLE `soal_ujian_221047` (
  `id_221047` int(11) NOT NULL,
  `ujian_id_221047` int(11) DEFAULT NULL,
  `pertanyaan_221047` text DEFAULT NULL,
  `opsi_a_221047` varchar(255) DEFAULT NULL,
  `opsi_b_221047` varchar(255) DEFAULT NULL,
  `opsi_c_221047` varchar(255) DEFAULT NULL,
  `opsi_d_221047` varchar(255) DEFAULT NULL,
  `jawaban_benar_221047` enum('a','b','c','d') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_221047`
--

CREATE TABLE `transaksi_221047` (
  `id_221047` int(11) NOT NULL,
  `user_id_221047` int(11) DEFAULT NULL,
  `materi_id_221047` int(11) DEFAULT NULL,
  `paket_id_221047` int(11) DEFAULT NULL,
  `jenis_transaksi _221047` enum('pembelian_materi','langganan_paket') NOT NULL,
  `tanggal_transaksi_221047` date NOT NULL,
  `tanggal_berakhir_221047` date NOT NULL,
  `status` enum('Sudah Bayar','Belum Bayar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ujian_221047`
--

CREATE TABLE `ujian_221047` (
  `id_221047` int(11) NOT NULL,
  `nama_ujian_221047` varchar(255) DEFAULT NULL,
  `deskripsi_ujian_221047` text DEFAULT NULL,
  `tanggal_mulai_221047` datetime DEFAULT NULL,
  `tanggal_selesai_221047` datetime DEFAULT NULL,
  `status_ujian_221047` enum('aktif','selesai') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_221047`
--

CREATE TABLE `users_221047` (
  `id_221047` int(11) NOT NULL,
  `name_221047` varchar(100) NOT NULL,
  `email_221047` varchar(100) NOT NULL,
  `password_221047` varchar(255) NOT NULL,
  `role_221047` enum('siswa','pengajar','admin') NOT NULL,
  `phone_221047` varchar(15) DEFAULT NULL,
  `status_221047` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_221047`
--

INSERT INTO `users_221047` (`id_221047`, `name_221047`, `email_221047`, `password_221047`, `role_221047`, `phone_221047`, `status_221047`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', '0853', 'active'),
(3, 'Pengajar', 'pengajar@gmail.com', '696ed7534349804cf5050ae88bc994ba', 'pengajar', '09432', 'active'),
(4, 'Siswa', 'siswa@gmail.com', 'bcd724d15cde8c47650fda962968f102', 'siswa', '20230', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jawaban_siswa_221047`
--
ALTER TABLE `jawaban_siswa_221047`
  ADD PRIMARY KEY (`id_221047`),
  ADD KEY `ujian_id_221047` (`ujian_id_221047`),
  ADD KEY `soal_id_221047` (`soal_id_221047`);

--
-- Indexes for table `kelas_221047`
--
ALTER TABLE `kelas_221047`
  ADD PRIMARY KEY (`id_221047`),
  ADD KEY `pengajar_id_221047` (`pengajar_id_221047`);

--
-- Indexes for table `materi_221047`
--
ALTER TABLE `materi_221047`
  ADD PRIMARY KEY (`id_221047`),
  ADD KEY `kelas_id_221047` (`kelas_id_221047`);

--
-- Indexes for table `paket_221047`
--
ALTER TABLE `paket_221047`
  ADD PRIMARY KEY (`id_221047`);

--
-- Indexes for table `sertifikat_221047`
--
ALTER TABLE `sertifikat_221047`
  ADD PRIMARY KEY (`id_221047`),
  ADD KEY `siswa_id_221047` (`siswa_id_221047`),
  ADD KEY `kelas_id_221047` (`kelas_id_221047`);

--
-- Indexes for table `sistem`
--
ALTER TABLE `sistem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soal_ujian_221047`
--
ALTER TABLE `soal_ujian_221047`
  ADD PRIMARY KEY (`id_221047`),
  ADD KEY `ujian_id_221047` (`ujian_id_221047`);

--
-- Indexes for table `transaksi_221047`
--
ALTER TABLE `transaksi_221047`
  ADD PRIMARY KEY (`id_221047`),
  ADD KEY `user_id_221047` (`user_id_221047`,`materi_id_221047`,`paket_id_221047`),
  ADD KEY `kelas_id_221047` (`materi_id_221047`),
  ADD KEY `paket_id_221047` (`paket_id_221047`);

--
-- Indexes for table `ujian_221047`
--
ALTER TABLE `ujian_221047`
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
-- AUTO_INCREMENT for table `jawaban_siswa_221047`
--
ALTER TABLE `jawaban_siswa_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas_221047`
--
ALTER TABLE `kelas_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `materi_221047`
--
ALTER TABLE `materi_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paket_221047`
--
ALTER TABLE `paket_221047`
  MODIFY `id_221047` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sertifikat_221047`
--
ALTER TABLE `sertifikat_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sistem`
--
ALTER TABLE `sistem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `soal_ujian_221047`
--
ALTER TABLE `soal_ujian_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_221047`
--
ALTER TABLE `transaksi_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ujian_221047`
--
ALTER TABLE `ujian_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_221047`
--
ALTER TABLE `users_221047`
  MODIFY `id_221047` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jawaban_siswa_221047`
--
ALTER TABLE `jawaban_siswa_221047`
  ADD CONSTRAINT `jawaban_siswa_221047_ibfk_1` FOREIGN KEY (`ujian_id_221047`) REFERENCES `ujian_221047` (`id_221047`),
  ADD CONSTRAINT `jawaban_siswa_221047_ibfk_2` FOREIGN KEY (`soal_id_221047`) REFERENCES `soal_ujian_221047` (`id_221047`);

--
-- Constraints for table `kelas_221047`
--
ALTER TABLE `kelas_221047`
  ADD CONSTRAINT `kelas_221047_ibfk_1` FOREIGN KEY (`pengajar_id_221047`) REFERENCES `users_221047` (`id_221047`);

--
-- Constraints for table `materi_221047`
--
ALTER TABLE `materi_221047`
  ADD CONSTRAINT `materi_221047_ibfk_1` FOREIGN KEY (`kelas_id_221047`) REFERENCES `kelas_221047` (`id_221047`);

--
-- Constraints for table `sertifikat_221047`
--
ALTER TABLE `sertifikat_221047`
  ADD CONSTRAINT `sertifikat_221047_ibfk_1` FOREIGN KEY (`siswa_id_221047`) REFERENCES `users_221047` (`id_221047`),
  ADD CONSTRAINT `sertifikat_221047_ibfk_2` FOREIGN KEY (`kelas_id_221047`) REFERENCES `kelas_221047` (`id_221047`);

--
-- Constraints for table `soal_ujian_221047`
--
ALTER TABLE `soal_ujian_221047`
  ADD CONSTRAINT `soal_ujian_221047_ibfk_1` FOREIGN KEY (`ujian_id_221047`) REFERENCES `ujian_221047` (`id_221047`);

--
-- Constraints for table `transaksi_221047`
--
ALTER TABLE `transaksi_221047`
  ADD CONSTRAINT `transaksi_221047_ibfk_1` FOREIGN KEY (`materi_id_221047`) REFERENCES `kelas_221047` (`id_221047`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_221047_ibfk_2` FOREIGN KEY (`user_id_221047`) REFERENCES `users_221047` (`id_221047`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_221047_ibfk_3` FOREIGN KEY (`paket_id_221047`) REFERENCES `paket_221047` (`id_221047`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
