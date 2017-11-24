-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 23, 2017 at 02:35 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mongkia2`
--

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja_daerah`
--

CREATE TABLE `unit_kerja_daerah` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_kerja_daerah`
--

INSERT INTO `unit_kerja_daerah` (`id`, `nama`, `kode`, `created_time`, `updated_time`, `created_by`, `updated_by`) VALUES
(1, 'Kepala BPS Kabupaten/Kota', 9280, '2017-11-23 08:30:45', '2017-11-23 08:30:45', 74, 74),
(2, 'Kasubbag Tata Usaha', 9281, '2017-11-23 08:31:04', '2017-11-23 08:31:04', 74, 74),
(3, 'Kasie Statistik Sosial', 9282, '2017-11-23 08:31:18', '2017-11-23 08:31:18', 74, 74),
(4, 'Kasie Statistik Produksi', 9283, '2017-11-23 08:31:32', '2017-11-23 08:31:32', 74, 74),
(5, 'Kasie Statistik Distribusi', 9284, '2017-11-23 08:31:51', '2017-11-23 08:31:51', 74, 74),
(6, 'Kasie Neraca Wilayah dan Analisis Statistik', 9285, '2017-11-23 08:32:23', '2017-11-23 08:32:23', 74, 74),
(7, 'Kasie Integrasi Pengolahan dan Diseminasi Statistik', 9286, '2017-11-23 08:33:18', '2017-11-23 08:33:18', 74, 74);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `unit_kerja_daerah`
--
ALTER TABLE `unit_kerja_daerah`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `unit_kerja_daerah`
--
ALTER TABLE `unit_kerja_daerah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `pegawai` ADD `unit_kerja_kab` INT NULL AFTER `jabatan`;
ALTER TABLE `jadwal_tugas` ADD `print_no` VARCHAR(255) NULL AFTER `updated_by`, ADD `print_unit_kerja` VARCHAR(10) NULL AFTER `print_no`, ADD `print_ttd` INT NULL AFTER `print_unit_kerja`;