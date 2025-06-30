-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2025 at 05:28 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skl_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int NOT NULL,
  `kompetensi_keahlian` varchar(24) DEFAULT NULL,
  `nis` varchar(8) DEFAULT NULL,
  `nisn` varchar(10) DEFAULT NULL,
  `nama` varchar(34) DEFAULT NULL,
  `ttl` varchar(32) DEFAULT NULL,
  `pai` varchar(4) DEFAULT NULL,
  `pkn` varchar(4) DEFAULT NULL,
  `b_ind` varchar(5) DEFAULT NULL,
  `pjok` varchar(4) DEFAULT NULL,
  `sej` varchar(4) DEFAULT NULL,
  `tari` varchar(4) DEFAULT NULL,
  `b_sun` varchar(5) DEFAULT NULL,
  `mat` varchar(4) DEFAULT NULL,
  `b_ing` varchar(5) DEFAULT NULL,
  `info` varchar(4) DEFAULT NULL,
  `ipas` varchar(4) DEFAULT NULL,
  `dpk` varchar(4) DEFAULT NULL,
  `kk` varchar(4) DEFAULT NULL,
  `pkk` varchar(4) DEFAULT NULL,
  `b_jpn` varchar(5) DEFAULT NULL,
  `mpkk` varchar(4) DEFAULT NULL,
  `rata_rata` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
