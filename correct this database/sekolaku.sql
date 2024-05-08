-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 04:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sekolaku`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_sekolaku`
--

CREATE TABLE `data_sekolaku` (
  `id` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `telp` int(14) NOT NULL,
  `tgl_lahir` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jurusan` varchar(35) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `status_guest` tinyint(1) NOT NULL DEFAULT 0,
  `terkirim` tinyint(4) NOT NULL DEFAULT 2,
  `status_barang` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_sekolaku`
--

INSERT INTO `data_sekolaku` (`id`, `nama`, `email`, `telp`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `jurusan`, `kode`, `status_guest`, `terkirim`, `status_barang`) VALUES
(5, 'febyeka', 'febyekapradiyanto@gmail.com', 2147483647, '01-01-2023', 'L', 'jl. lorem ipsum', 'Teknik Instalasi Tenaga Listrik', '98248', 1, 1, 1),
(6, 'feby', 'feby@mail.com', 4875983, '10-10-2023', 'L', 'jl. lorem', 'Rekayasa Perangkat Lunak', '56791', 0, 1, 0),
(7, 'Budi', 'jingga@gmail.com', 2147483647, '21-06-2023', 'L', 'Jl. jingga 1/10', 'Teknik Mesin', '51077', 1, 1, 1),
(8, 'Adi', 'jingga@gmail.com', 2147483647, '23-06-2023', 'L', 'Jl. jingga 1/10', 'Rekayasa Perangkat Lunak', '26899', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$OWSsZg8app0I5W3zYWXr5u.09RKxFSxQeGLMmZbW8IGbbgCkPjPAG', 1),
(2, 'Jingga Jil Carissa', '$2y$10$veljG2Ziyuv7NDbgCVKJC.aXp8Sn0kVU5520RUAzmrjJ6zEe2cyCm', 0),
(3, 'Bambang', '$2y$10$8yilQy66e1ieULeCEn.1AePFZMeZv3Ed0QaL83QEO1c70MmeENljy', 0),
(4, 'febyeka', '$2y$10$wOW.tlc4fvUpgxy5gkRMdekhJEtL/3FDdINL7uQ2JeW6u6Jo/PE.G', 0),
(5, 'feby', '$2y$10$I4h/L4M9o3yaXw7w3WQIN.cxTK1O9coriaGWO6jN5Mmlkn8p8DMgm', 0),
(6, 'Budi', '$2y$10$pYWz/iZshqHV4Kchl3B5iehHfMoBVqzwYusUyW3JaIxO9vnvEo6yi', 0),
(7, 'Adi', '$2y$10$KdT7gelL/0kAmXdNXk1pX.opoHguODVsb7TOgKhthBl19GIavXVYy', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_sekolaku`
--
ALTER TABLE `data_sekolaku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_sekolaku`
--
ALTER TABLE `data_sekolaku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
