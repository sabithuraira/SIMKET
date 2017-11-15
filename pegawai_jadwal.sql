-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 15, 2017 at 04:31 AM
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
-- Table structure for table `jadwal_tugas`
--

CREATE TABLE `jadwal_tugas` (
  `id` int(11) NOT NULL,
  `nama_kegiatan` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `pegawai_id` char(18) NOT NULL,
  `penjelasan` text NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_tugas`
--

INSERT INTO `jadwal_tugas` (`id`, `nama_kegiatan`, `tanggal_mulai`, `tanggal_berakhir`, `pegawai_id`, `penjelasan`, `created_time`, `updated_time`, `created_by`, `updated_by`) VALUES
(1, 'Task Force SE2016', '2017-11-07', '2017-11-09', '196507311989011001', 'Pengawasan Task Force SE UMB UMK', '2017-11-07 06:20:12', '2017-11-07 06:20:12', 1, 1),
(2, 'Pengawasan GIS Capacity Building', '2017-10-26', '2017-10-28', '198908232012111001', 'Pengawasan GIS Capacity Building\r\ndi Kabupaten Empat Lawang', '2017-11-12 09:54:05', '2017-11-12 09:54:05', 1, 1),
(3, 'Pengawasan Susenas Semester 1', '2017-05-02', '2017-05-05', '196507311989011001', 'Pengawasan Susenas Lapangan\r\nKe Kabupaten OKU Timur', '2017-11-12 10:16:45', '2017-11-12 10:16:45', 1, 1),
(4, 'lkslf', '2017-11-01', '2017-11-04', '196507311989011001', 'zcs', '2017-11-14 10:32:37', '2017-11-14 10:32:37', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` char(18) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `unit_kerja` int(11) NOT NULL,
  `golongan` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama`, `unit_kerja`, `golongan`, `jabatan`, `created_time`, `updated_time`, `created_by`, `updated_by`) VALUES
('196507311989011001', 'PM Hamonangan', 2, 'IV/a', 'Kasi Jaringan dan Rujukan Statistik', '2017-11-07 02:45:04', '2017-11-07 02:45:04', 1, 1),
('198908232012111001', 'Sabit Huraira', 2, 'III/b', 'Staff Jaringan dan Rujukan Statistik', '2017-11-07 02:12:16', '2017-11-07 02:12:16', 1, 1);

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal_tugas`
--
ALTER TABLE `jadwal_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal_tugas`
--
ALTER TABLE `jadwal_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `unit_kerja`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
