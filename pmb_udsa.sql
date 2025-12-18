-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2025 at 10:46 PM
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
-- Database: `pmb_udsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporan_bulanan`
--

CREATE TABLE `laporan_bulanan` (
  `id` int(11) NOT NULL,
  `tahun_akademik` varchar(9) NOT NULL,
  `bulan` tinyint(4) NOT NULL,
  `tahun` year(4) NOT NULL,
  `total_pendaftar` int(11) NOT NULL DEFAULT 0,
  `total_lolos` int(11) NOT NULL DEFAULT 0,
  `total_daftar_ulang` int(11) NOT NULL DEFAULT 0,
  `total_tidak_lolos` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_bulanan`
--

INSERT INTO `laporan_bulanan` (`id`, `tahun_akademik`, `bulan`, `tahun`, `total_pendaftar`, `total_lolos`, `total_daftar_ulang`, `total_tidak_lolos`, `created_at`, `updated_at`) VALUES
(1, '2025/2026', 1, '2026', 1900, 1500, 750, 400, '2025-12-16 20:39:53', '2025-12-16 20:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_bulanan_prodi`
--

CREATE TABLE `laporan_bulanan_prodi` (
  `id` int(11) NOT NULL,
  `laporan_bulanan_id` int(11) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL,
  `pendaftar` int(11) NOT NULL DEFAULT 0,
  `lolos_seleksi` int(11) NOT NULL DEFAULT 0,
  `daftar_ulang` int(11) NOT NULL DEFAULT 0,
  `kapasitas` int(11) NOT NULL DEFAULT 0,
  `keterangan` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_bulanan_prodi`
--

INSERT INTO `laporan_bulanan_prodi` (`id`, `laporan_bulanan_id`, `nama_prodi`, `pendaftar`, `lolos_seleksi`, `daftar_ulang`, `kapasitas`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Teknologi Informasi', 400, 350, 190, 200, 'Overload', '2025-12-16 20:41:01', '2025-12-16 20:41:01'),
(2, 1, 'Data Science', 380, 240, 130, 150, 'Tinggi Minat', '2025-12-16 20:41:01', '2025-12-16 20:41:01'),
(3, 1, 'Akuntansi', 300, 300, 140, 200, 'Tinggi Minat', '2025-12-16 20:41:01', '2025-12-16 20:41:01'),
(4, 1, 'Bahasa Inggris', 250, 190, 110, 150, 'Cukup Stabil', '2025-12-16 20:41:01', '2025-12-16 20:41:01'),
(5, 1, 'Fisika', 210, 160, 90, 120, 'Stabil', '2025-12-16 20:41:01', '2025-12-16 20:41:01'),

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_snbp`
--

CREATE TABLE `pendaftaran_snbp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(120) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `email` varchar(120) NOT NULL,
  `hp` varchar(25) NOT NULL,
  `tgllahir` date DEFAULT NULL,
  `tempatlahir` varchar(120) NOT NULL,
  `asal` varchar(150) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `provinsi` varchar(120) NOT NULL,
  `kabupaten` varchar(120) NOT NULL,
  `kecamatan` varchar(120) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `prodi1` varchar(120) NOT NULL,
  `prodi2` varchar(120) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `nama` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `nama`) VALUES
(4, 'Biologi'),
(3, 'Data Science'),
(6, 'Fisika'),
(5, 'Matematika'),
(2, 'Sistem Informasi'),
(1, 'Teknik Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `review_text` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `likes` int(11) DEFAULT 0,
  `dislikes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `username`, `rating`, `review_text`, `created_at`, `likes`, `dislikes`) VALUES
(2, 'feronikarisa', 5, '​\"Proses pendaftaran melalui Web PMB sangat mudah dan cepat. \r\nTampilan website bersih dan informatif, sehingga saya tidak kesulitan mencari \r\npanduan pendaftaran atau jadwal penting. Saya sangat mengapresiasi \r\nkemudahan upload dokumen dan konfirmasi pembayaran yang real-time.\"', '2025-12-17 00:19:39', 0, 0),
(3, 'Lestariayu', 5, '\"Fitur upload dokumen sangat bermasalah. Saya sudah mencoba beberapa\r\n kali dengan format dan ukuran file yang sesuai, namun selalu gagal di tengah jalan. \r\nMohon segera diperbaiki.\"', '2025-12-17 00:20:04', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporan_bulanan`
--
ALTER TABLE `laporan_bulanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unik_bulan` (`tahun_akademik`,`bulan`,`tahun`);

--
-- Indexes for table `laporan_bulanan_prodi`
--
ALTER TABLE `laporan_bulanan_prodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_laporan_bulanan` (`laporan_bulanan_id`);

--
-- Indexes for table `pendaftaran_snbp`
--
ALTER TABLE `pendaftaran_snbp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_nisn` (`nisn`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_prodi1` (`prodi1`),
  ADD KEY `idx_prodi2` (`prodi2`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporan_bulanan`
--
ALTER TABLE `laporan_bulanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laporan_bulanan_prodi`
--
ALTER TABLE `laporan_bulanan_prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pendaftaran_snbp`
--
ALTER TABLE `pendaftaran_snbp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan_bulanan_prodi`
--
ALTER TABLE `laporan_bulanan_prodi`
  ADD CONSTRAINT `fk_laporan_bulanan` FOREIGN KEY (`laporan_bulanan_id`) REFERENCES `laporan_bulanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
