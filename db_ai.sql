-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2023 at 01:49 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ai`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_training`
--

CREATE TABLE `data_training` (
  `kode_pelanggan` int(11) NOT NULL,
  `jml_beli` varchar(25) NOT NULL,
  `waktu` varchar(25) NOT NULL,
  `lokasi` varchar(25) NOT NULL,
  `jp` varchar(10) NOT NULL,
  `target` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_training`
--

INSERT INTO `data_training` (`kode_pelanggan`, `jml_beli`, `waktu`, `lokasi`, `jp`, `target`) VALUES
(1, 'Sangat Banyak', 'Mingguan', 'Dekat', 'Toko', 'Berpotensi'),
(2, 'Sedikit', 'Tidak Pasti', 'Sedang', 'Pribadi', 'Tidak Berpotensi'),
(3, 'Banyak', 'Mingguan', 'Dekat', 'Toko', 'Berpotensi'),
(4, 'Sedikit', 'Tidak Pasti', 'Dekat', 'Pribadi', 'Berpotensi'),
(5, 'Banyak', 'Tidak Pasti', 'Sedang', 'Pribadi', 'Tidak Berpotensi'),
(6, 'Sangat Banyak', 'Tidak Pasti', 'Jauh', 'Pribadi', 'Tidak Berpotensi'),
(7, 'Sangat Banyak', 'Tidak Pasti', 'Jauh', 'Pribadi', 'Tidak Berpotensi'),
(8, 'Sangat Sedikit', 'Tidak Pasti', 'Sedang', 'Pribadi', 'Berpotensi'),
(9, 'Banyak', 'Tidak Pasti', 'Jauh', 'Pribadi', 'Berpotensi'),
(10, 'Sangat Sedikit', 'Tidak Pasti', 'Dekat', 'Pribadi', 'Berpotensi'),
(11, 'Sangat Banyak', 'Mingguan', 'Dekat', 'Toko', 'Berpotensi'),
(12, 'Sedikit', 'Tidak Pasti', 'Sedang', 'Pribadi', 'Tidak Berpotensi'),
(13, 'Banyak', 'Mingguan', 'Dekat', 'Toko', 'Berpotensi'),
(14, 'Sedikit', 'Tidak Pasti', 'Dekat', 'Pribadi', 'Berpotensi'),
(15, 'Banyak', 'Tidak Pasti', 'Sedang', 'Pribadi', 'Tidak Berpotensi'),
(16, 'Sangat Banyak', 'Tidak Pasti', 'Jauh', 'Pribadi', 'Tidak Berpotensi'),
(17, 'Sangat Banyak', 'Tidak Pasti', 'Jauh', 'Pribadi', 'Tidak Berpotensi'),
(18, 'Sangat Sedikit', 'Tidak Pasti', 'Sedang', 'Pribadi', 'Berpotensi'),
(19, 'Banyak', 'Tidak Pasti', 'Jauh', 'Pribadi', 'Berpotensi'),
(20, 'Sangat Sedikit', 'Tidak Pasti', 'Dekat', 'Pribadi', 'Berpotensi');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `user_type`, `address`) VALUES
(1, 'munn', 'munn@gmail.com', 'munn', 'user', 'Klaten'),
(2, 'admin', 'admin@gmail.com', 'admin', 'admin', 'Bantul'),
(3, 'ashel', 'ashel@gmail.com', 'ashel', 'user', 'Disini');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_training`
--
ALTER TABLE `data_training`
  ADD PRIMARY KEY (`kode_pelanggan`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_training`
--
ALTER TABLE `data_training`
  MODIFY `kode_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
