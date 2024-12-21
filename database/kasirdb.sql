-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 01:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasirdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kode_barang` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `harga`, `jumlah`, `kode_barang`) VALUES
(1, 'Iphone XR', 4000000, 10, 'B0059'),
(2, 'Iphone XS Max', 5000000, 10, 'B0057'),
(3, 'iphone 16 Pro Max', 18000000, 20, 'B0055'),
(4, 'iphone 16 Pro', 12000000, 10, 'B0054'),
(5, 'iphone 16 Plus', 13000000, 10, 'B0053'),
(6, 'iphone 15 Pro Max', 22000000, 10, 'B0056'),
(7, 'iphone 15 Pro ', 18000000, 10, 'B0052'),
(8, 'iphone 15 Plus', 15000000, 10, 'B0051'),
(9, 'iphone 14 Pro Max', 25000000, 10, 'B0040'),
(10, 'iphone 14 Pro ', 20000000, 10, 'B0088'),
(11, 'iphone 14 Plus', 13000000, 3, 'B0034'),
(12, 'Iphone 11 Pro Max ', 6000000, 5, 'B0001');

-- --------------------------------------------------------

--
-- Table structure for table `disbarang`
--

CREATE TABLE `disbarang` (
  `id` int(11) UNSIGNED NOT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `potongan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disbarang`
--

INSERT INTO `disbarang` (`id`, `barang_id`, `qty`, `potongan`) VALUES
(1, 3, 5, 2000),
(3, 7, 10, 5000),
(4, 4, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `nama`) VALUES
(1, 'Admin'),
(2, 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal_waktu` datetime NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `total` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal_waktu`, `nomor`, `total`, `nama`, `bayar`, `kembali`) VALUES
(8, '2020-02-25 16:05:22', '734687', 84000, 'Novia Pramudia', 100000, 16000),
(9, '2020-02-25 16:37:31', '237413', 52000, 'Novia Pramudia', 60000, 8000),
(10, '2020-07-02 06:28:53', '311124', 12000, 'Novia Pramudia', 15000, 3000),
(11, '2020-07-02 06:37:11', '123793', 14000, 'Novia Pramudia', 15000, 1000),
(13, '2024-12-12 09:24:26', '243513', 0, 'Novia Pramudia', 50000, 50000),
(14, '2024-12-12 09:28:12', '112960', 0, 'Novia Pramudia', 50000, 50000),
(15, '2024-12-12 10:06:38', '416969', 0, 'Noval Krisna', 4000000, 4000000),
(16, '2024-12-12 10:17:28', '727585', 10000000, 'Noval Krisna', 11000000, 1000000),
(17, '2024-12-12 10:35:58', '246746', 9000000, 'Noval Krisna', 10000000, 1000000),
(18, '2024-12-12 10:40:25', '930660', 4000000, 'Noval Krisna', 5000000, 1000000),
(19, '2024-12-13 03:51:31', '445956', 46000000, 'Noval Krisna', 47000000, 1000000),
(20, '2024-12-14 11:07:11', '869219', 13000000, 'Noval Krisna', 14000000, 1000000),
(21, '2024-12-14 11:18:00', '770220', 5000000, 'Noval Krisna', 5000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `diskon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_barang`, `harga`, `qty`, `total`, `diskon`) VALUES
(24, 8, 3, 2000, 5, 10000, 2000),
(25, 8, 4, 16000, 1, 16000, 0),
(26, 8, 1, 60000, 1, 60000, 0),
(27, 9, 3, 2000, 10, 20000, 4000),
(28, 9, 6, 10000, 2, 20000, 0),
(29, 9, 4, 16000, 1, 16000, 0),
(30, 10, 3, 2000, 1, 2000, 0),
(31, 10, 6, 10000, 1, 10000, 0),
(32, 11, 3, 2000, 2, 4000, 0),
(33, 11, 6, 10000, 1, 10000, 0),
(34, 16, 1, 4000000, 1, 4000000, 0),
(35, 16, 12, 6000000, 1, 6000000, 0),
(36, 17, 2, 5000000, 1, 5000000, 0),
(37, 17, 1, 4000000, 1, 4000000, 0),
(38, 18, 1, 4000000, 1, 4000000, 0),
(39, 19, 2, 5000000, 2, 10000000, 0),
(40, 19, 3, 18000000, 2, 36000000, 0),
(41, 20, 1, 4000000, 2, 8000000, 0),
(42, 20, 2, 5000000, 1, 5000000, 0),
(43, 21, 2, 5000000, 1, 5000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `role_id`) VALUES
(1, 'Ariadi', 'addeye', 'addeye27', 1),
(2, 'Novia Pramudia', 'novia', 'addeye27', 2),
(3, 'Noval Krisna', 'valgremory', '12345678', 2),
(4, 'dzaky tri saputra', 'Jack', '12345678', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `disbarang`
--
ALTER TABLE `disbarang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `disbarang`
--
ALTER TABLE `disbarang`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
