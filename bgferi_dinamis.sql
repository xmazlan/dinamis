-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2020 at 09:14 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bgferi_dinamis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hoby`
--

CREATE TABLE IF NOT EXISTS `tbl_hoby` (
  `rincian_hoby` varchar(50) DEFAULT NULL,
  `jenis_hoby` varchar(30) DEFAULT NULL,
  `id_karyawan` int(10) DEFAULT NULL COMMENT 'FK tbl_karyawan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hoby`
--

INSERT INTO `tbl_hoby` (`rincian_hoby`, `jenis_hoby`, `id_karyawan`) VALUES
('Ngoding', 'Utama', 1),
('Cari duit', 'Utama', 1),
('Makan', 'Sambilan', 1),
('minum', 'Utama', 2),
('Jalan-jalan', 'Sambilan', 2),
('Main game', 'Sambilan', 3),
('satu', 'Utama', 16),
('Dua', 'Sambilan', 16),
('Tiga', 'Sambilan', 16);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_karyawan`
--

CREATE TABLE IF NOT EXISTS `tbl_karyawan` (
  `id_karyawan` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_karyawan` varchar(50) DEFAULT NULL,
  `umur_karyawan` int(19) DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_karyawan`
--

INSERT INTO `tbl_karyawan` (`id_karyawan`, `nama_karyawan`, `umur_karyawan`) VALUES
(1, 'Mazlan', 27),
(2, 'Contoh lagi', 20),
(3, 'Contoh Terus', 21),
(16, 'dd', 43);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
