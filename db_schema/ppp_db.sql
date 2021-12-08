-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 06, 2021 at 09:02 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_dimens`
--

DROP TABLE IF EXISTS `product_dimens`;
CREATE TABLE IF NOT EXISTS `product_dimens` (
  `entry_id` int(22) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(15) DEFAULT NULL,
  `length` varchar(10) DEFAULT NULL,
  `width` varchar(10) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`entry_id`),
  UNIQUE KEY `barcode` (`barcode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
