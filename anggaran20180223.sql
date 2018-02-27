
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
-- Table structure for table `value_anggaran_target`
--

TRUNCATE `value_anggaran`;
ALTER TABLE `value_anggaran` DROP `seri_kegiatan`;
ALTER TABLE `value_anggaran` ADD `jenis` INT NOT NULL AFTER `kegiatan`;




CREATE TABLE `induk_kegiatan` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `induk_kegiatan`
--
ALTER TABLE `induk_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `induk_kegiatan`
--
ALTER TABLE `induk_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;




CREATE TABLE `kegiatan_for_anggaran` (
  `id` int(11) NOT NULL,
  `id_induk` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kegiatan_for_anggaran`
--
ALTER TABLE `kegiatan_for_anggaran`
  ADD PRIMARY KEY (`id`);


CREATE TABLE `value_anggaran_target` (
  `id` int(11) NOT NULL,
  `unit_kerja` int(11) NOT NULL,
  `kegiatan` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `jumlah` decimal(20,0) NOT NULL,
  `created_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `value_anggaran_target`
--
ALTER TABLE `value_anggaran_target`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `value_anggaran_target`
--
ALTER TABLE `value_anggaran_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `induk_kegiatan` ADD `tahun` INT NOT NULL AFTER `updated_time`;
ALTER TABLE `value_anggaran_target` CHANGE `jenis` `jenis` INT(11) NULL;
ALTER TABLE `value_anggaran` CHANGE `jenis` `jenis` INT(11) NULL;
ALTER TABLE `value_anggaran` ADD `bulan` INT NOT NULL AFTER `keterangan`;
