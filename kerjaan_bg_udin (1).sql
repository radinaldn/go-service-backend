-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 27, 2018 at 09:06 PM
-- Server version: 10.1.30-MariaDB-0ubuntu0.17.10.1
-- PHP Version: 7.1.17-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kerjaan_bg_udin`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_masyarakat`
--

CREATE TABLE `tb_masyarakat` (
  `nik` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `agama` enum('Islam','Kristen','Katholik','Budha','Hindu','Lainnya') NOT NULL,
  `status_kawin` enum('Kawin','Belum Kawin') NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `kewarganegaraan` enum('WNI','WNA') NOT NULL,
  `foto` varchar(100) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `saldo` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_masyarakat`
--

INSERT INTO `tb_masyarakat` (`nik`, `password`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jk`, `alamat`, `agama`, `status_kawin`, `pekerjaan`, `kewarganegaraan`, `foto`, `no_hp`, `saldo`, `created_at`, `updated_at`) VALUES
('1111111111111111', '7c222fb2927d828af22f592134e8932480637c0d', 'udin', 'rgt', '1990-08-17', 'L', 'jl. garyuda', 'Islam', '', 'pengangguran', 'WNA', 'Dummy.jpg', '081234567890', 0, '2018-12-22 15:10:07', '2018-12-22 16:24:24'),
('1402012911960001', '7c222fb2927d828af22f592134e8932480637c0d', 'Radinal Dwiki N', 'Rengat', '1996-11-29', 'L', 'Jl. Azkri Aris Gg. Antasena\r\nRT 02 RW 01\r\nSekip Hulu\r\nRengat', 'Islam', 'Belum Kawin', 'Mahasiswa', 'WNI', '1402012911960001.jpg', '085271988420', 400000, '2018-12-09 01:26:46', '2018-12-21 04:11:59'),
('1409627154298701', '7c222fb2927d828af22f592134e8932480637c0d', 'Iqbal Mard', 'Pekanbaru', '1990-01-01', 'L', 'Jl. Merpati Sakti\nGg. Amal', 'Islam', 'Belum Kawin', 'Mahasiswa', 'WNI', '1409627154298709.jpg', '081345678910', 0, '2018-12-22 13:43:08', '2018-12-22 13:43:08'),
('1409627154298709', '7c222fb2927d828af22f592134e8932480637c0d', 'Iqbal Mard', 'Pekanbaru', '1990-01-01', 'L', 'Jl. Merpati Sakti\nGg. Amal', 'Islam', 'Belum Kawin', 'Mahasiswa', 'WNI', '1409627154298709.jpg', '081345678910', 0, '2018-12-09 08:35:35', '2018-12-09 08:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemesanan`
--

CREATE TABLE `tb_pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `id_teknisi` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `lat` double NOT NULL,
  `keluhan` text NOT NULL,
  `lng` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jenis_servis` varchar(100) NOT NULL,
  `biaya` int(11) DEFAULT NULL,
  `proses` enum('Diproses','Dikerjakan','Selesai','Dibayar') NOT NULL DEFAULT 'Diproses',
  `kategori_bayar` enum('Cash','Saldo') NOT NULL,
  `foto_sebelum` varchar(100) NOT NULL,
  `foto_sesudah` varchar(100) DEFAULT NULL,
  `ket` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pemesanan`
--

INSERT INTO `tb_pemesanan` (`id_pemesanan`, `nik`, `id_teknisi`, `alamat`, `lat`, `keluhan`, `lng`, `created_at`, `updated_at`, `jenis_servis`, `biaya`, `proses`, `kategori_bayar`, `foto_sebelum`, `foto_sesudah`, `ket`) VALUES
(10, '1402012911960001', 2, 'Jl. Raya Pku-Bkn KM 4\nPerum Mustamindo F7', 0.4595731, '1. Kipas tidak bisa menyala\n2. Ada bau hangus di bagian motor kipas\n3. Kabel kipas terkelupas', 101.3542898, '2018-12-20 13:40:15', '2018-12-20 13:42:30', 'TV', 250000, 'Dibayar', 'Saldo', '1402012911960001_2018_02_10_18_08.jpg', '3_post.jpg', 'Rincian biaya :\n1. Motor kipas = Rp 130.000\n2. Kabel = Rp 20.000\n3. Ongkos pasang = Rp 100.000'),
(11, '1402012911960001', 2, 'Jl. Raya Pku-Bkn KM 4\nPerum Mustamindo F7', 0.4595731, '1. Kipas tidak bisa menyala\n2. Ada bau hangus di bagian motor kipas\n3. Kabel kipas terkelupas', 101.3542898, '2018-12-26 04:24:41', '2018-12-26 04:24:41', 'TV', 0, 'Diproses', 'Saldo', '1402012911960001_2018_02_10_18_08.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_teknisi`
--

CREATE TABLE `tb_teknisi` (
  `id_teknisi` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_toko` varchar(150) NOT NULL,
  `nama_pemilik` varchar(150) NOT NULL,
  `nik_pemilik` varchar(16) NOT NULL,
  `layanan` text NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `siu` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status_akun` enum('Aktif','Non Aktif') NOT NULL DEFAULT 'Non Aktif',
  `saldo` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_teknisi`
--

INSERT INTO `tb_teknisi` (`id_teknisi`, `email`, `password`, `nama_toko`, `nama_pemilik`, `nik_pemilik`, `layanan`, `alamat`, `no_hp`, `lat`, `lng`, `siu`, `foto`, `status_akun`, `saldo`, `created_at`, `updated_at`) VALUES
(1, 'dian.siregar@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'Regar Dinamo', 'Dian Siregar', '1402129012647361', 'ac, tv, mesin cuci, mesin air', 'Jl. Merpati Sakti No. 15', '081234567890', 0.47026, 101.37199, '1402129012647361.pdf', '1402129012647361.jpg', 'Aktif', 0, '2018-12-09 01:31:46', '2018-12-09 13:23:53'),
(2, 'dian.simatupang@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'Tupang Dinamo', 'Dian Simatupang', '1402129012647362', 'ac, tv, mesin cuci, mesin air', 'Jl. Mustamindo No. 15', '081234567891', 0.459835, 101.354255, '1402129012647362.pdf', '1402129012647362.jpg', 'Aktif', 0, '2018-12-09 01:31:46', '2018-12-10 01:11:38'),
(3, 'dinal.dinamo@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'Dinal Dinamo', 'Radinal Dwiki N', '1401978675645342', 'ac, mesin cuci, kulkas', 'Jl. Taman Karya', '081231425364', 0.46603, 101.35551, '14019786756453421.pdf', '14019786756453421.jpg', 'Aktif', 0, '2018-12-09 16:05:07', '2018-12-10 01:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `tb_topup`
--

CREATE TABLE `tb_topup` (
  `id_topup` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nominal` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `foto` varchar(100) NOT NULL,
  `proses` enum('Diproses','Diterima','Ditolak') NOT NULL DEFAULT 'Diproses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_topup`
--

INSERT INTO `tb_topup` (`id_topup`, `nik`, `nominal`, `created_at`, `updated_at`, `foto`, `proses`) VALUES
(1, '1402012911960001', 100000, '2018-12-09 01:38:31', '2018-12-21 04:36:49', '1.jpg', 'Diterima'),
(3, '1402012911960001', 300000, '2018-12-10 06:18:58', '2018-12-21 04:36:53', '1402012911960001_2018_12_10_16_13.jpg', 'Diterima'),
(4, '1402012911960001', 300000, '2018-12-10 06:49:42', '2018-12-21 03:53:52', '1402012911960001_2018_12_10_16_13.jpg', 'Ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authKey` varchar(50) NOT NULL,
  `accessToken` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`username`, `password`, `authKey`, `accessToken`) VALUES
('admin', 'admin', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `FK_pemesananMasyarakat` (`nik`),
  ADD KEY `FK_pemesananTeknisi` (`id_teknisi`);

--
-- Indexes for table `tb_teknisi`
--
ALTER TABLE `tb_teknisi`
  ADD PRIMARY KEY (`id_teknisi`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_topup`
--
ALTER TABLE `tb_topup`
  ADD PRIMARY KEY (`id_topup`),
  ADD KEY `FK_TopupMasyarakat` (`nik`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_teknisi`
--
ALTER TABLE `tb_teknisi`
  MODIFY `id_teknisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_topup`
--
ALTER TABLE `tb_topup`
  MODIFY `id_topup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD CONSTRAINT `FK_pemesananMasyarakat` FOREIGN KEY (`nik`) REFERENCES `tb_masyarakat` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_pemesananTeknisi` FOREIGN KEY (`id_teknisi`) REFERENCES `tb_teknisi` (`id_teknisi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_topup`
--
ALTER TABLE `tb_topup`
  ADD CONSTRAINT `FK_TopupMasyarakat` FOREIGN KEY (`nik`) REFERENCES `tb_masyarakat` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
