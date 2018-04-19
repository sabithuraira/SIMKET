-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 19, 2018 at 06:30 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mongkia`
--

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_mitra_wilayah`
--

CREATE TABLE `kegiatan_mitra_wilayah` (
  `id` int(11) NOT NULL,
  `kmp_id` int(11) NOT NULL,
  `kegiatan_id` int(11) NOT NULL,
  `mitra_id` int(11) NOT NULL,
  `nks` varchar(255) NOT NULL,
  `bs` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kegiatan_mitra_wilayah`
--
ALTER TABLE `kegiatan_mitra_wilayah`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kegiatan_mitra_wilayah`
--
ALTER TABLE `kegiatan_mitra_wilayah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `mitra_nilai` ADD `wilayah_id` INT NOT NULL AFTER `updated_time`;
