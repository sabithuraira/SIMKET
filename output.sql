-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 02, 2018 at 04:55 AM
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
-- Table structure for table `output`
--

CREATE TABLE `output` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `output`
--

INSERT INTO `output` (`id`, `name`, `created_by`, `created_time`, `updated_by`, `updated_time`, `tahun`) VALUES
(1, 'Laporan Diseminasi Statistik', 1, '2018-03-02 04:46:51', 1, '2018-03-02 04:46:51', 2018),
(2, 'Laporan Metadata Statistik', 1, '2018-03-02 04:54:49', 1, '2018-03-02 04:54:59', 2018);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `output`
--
ALTER TABLE `output`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `output`
--
ALTER TABLE `output`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
