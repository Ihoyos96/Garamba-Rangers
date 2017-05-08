-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 08, 2017 at 12:58 PM
-- Server version: 5.6.33
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `answrboo_theBook`
--

-- --------------------------------------------------------

--
-- Table structure for table `garamba`
--

CREATE TABLE IF NOT EXISTS `garamba` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` varchar(11) NOT NULL,
  `longitude` varchar(11) NOT NULL,
  `type` text NOT NULL,
  `date` date NOT NULL,
  `reporter` text NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `garamba`
--

INSERT INTO `garamba` (`id`, `latitude`, `longitude`, `type`, `date`, `reporter`, `comment`) VALUES
(1, '4.533', '31.663', 'WildFire', '2017-04-11', 'NASA', 'N/A'),
(2, '3.503', '30.377', 'WildFire', '2017-04-11', 'NASA', 'N/A'),
(3, '3.585', '30.507', 'WildFire', '2017-04-11', 'NASA', 'N/A'),
(4, '4.782', '28.108', 'WildFire', '2017-04-11', 'NASA', 'N/A'),
(5, '4.69', '31.925', 'WildFire', '2017-04-13', 'NASA', 'N/A'),
(6, '4.615', '31.298', 'WildFire', '2017-04-13', 'NASA', 'N/A'),
(7, '3.623', '29.716', 'WildFire', '2017-04-13', 'NASA', 'N/A'),
(8, '3.89', '29.116', 'WildFire', '2017-04-13', 'NASA', 'N/A'),
(9, '4.544', '29.575', 'WildFire', '2017-04-13', 'NASA', 'N/A'),
(10, '4.544', '29.57', 'WildFire', '2017-04-13', 'NASA', 'N/A'),
(11, '4.603', '28.174', 'WildFire', '2017-04-13', 'NASA', 'N/A'),
(12, '3.661', '29.725', 'WildFire', '2017-04-16', 'NASA', 'N/A'),
(13, '3.558', '30.147', 'WildFire', '2017-04-16', 'NASA', 'N/A'),
(14, '3.772', '28.749', 'WildFire', '2017-04-16', 'NASA', 'N/A'),
(15, '3.771', '28.739', 'WildFire', '2017-04-16', 'NASA', 'N/A'),
(16, '3.727', '28.867', 'WildFire', '2017-04-18', 'NASA', 'N/A'),
(17, '4.449', '28.307', 'WildFire', '2017-04-18', 'NASA', 'N/A'),
(18, '4.448', '28.298', 'WildFire', '2017-04-18', 'NASA', 'N/A'),
(19, '3.526', '28.418', 'WildFire', '2017-04-18', 'NASA', 'N/A'),
(20, '3.525', '28.408', 'WildFire', '2017-04-18', 'NASA', 'N/A'),
(21, '3.893', '30.138', 'WildFire', '2017-04-18', 'NASA', 'N/A'),
(22, '3.719', '28.86', 'WildFire', '2017-04-18', 'NASA', 'N/A'),
(23, '4.473', '31.484', 'WildFire', '2017-04-20', 'NASA', 'N/A'),
(24, '3.596', '30.369', 'WildFire', '2017-04-20', 'NASA', 'N/A'),
(25, '3.594', '30.379', 'WildFire', '2017-04-20', 'NASA', 'N/A'),
(26, '3.503', '30.311', 'WildFire', '2017-04-20', 'NASA', 'N/A'),
(27, '3.628', '30.374', 'WildFire', '2017-04-20', 'NASA', 'N/A'),
(28, '3.633', '30.378', 'WildFire', '2017-04-20', 'NASA', 'N/A'),
(29, '3.881', '30.486', 'WildFire', '2017-04-20', 'NASA', 'N/A'),
(30, '3.88', '30.476', 'WildFire', '2017-04-20', 'NASA', 'N/A'),
(31, '4.626', '28.521', 'WildFire', '2017-04-20', 'NASA', 'N/A'),
(32, '4.964', '29.431', 'WildFire', '2017-04-20', 'NASA', 'N/A'),
(33, '4.965', '29.437', 'WildFire', '2017-04-20', 'NASA', 'N/A'),
(34, '4.963', '29.425', 'WildFire', '2017-04-20', 'NASA', 'N/A'),
(35, '3.815', '28.611', 'WildFire', '2017-04-21', 'NASA', 'N/A'),
(36, '4.169', '30.627', 'WildFire', '2017-04-27', 'NASA', 'N/A'),
(37, '4.285', '30.74', 'WildFire', '2017-04-27', 'NASA', 'N/A'),
(38, '4.745', '31.903', 'WildFire', '2017-04-27', 'NASA', 'N/A'),
(39, '4.108', '30.566', 'WildFire', '2017-05-02', 'NASA', 'N/A'),
(40, '4.429', '29.975', 'WildFire', '2017-05-02', 'NASA', 'N/A'),
(41, '3.556', '30.511', 'WildFire', '2017-05-04', 'NASA', 'N/A'),
(42, '3.523', '29.696', 'WildFire', '2017-05-04', 'NASA', 'N/A'),
(43, '3.65', '30.2', 'WildFire', '2017-05-04', 'NASA', 'N/A'),
(44, '3.648', '30.191', 'WildFire', '2017-05-04', 'NASA', 'N/A'),
(45, '3.769', '30.067', 'WildFire', '2017-05-04', 'NASA', 'N/A'),
(46, '3.855', '30.03', 'WildFire', '2017-05-04', 'NASA', 'N/A'),
(47, '3.769', '31.088', 'WildFire', '2017-05-06', 'NASA', 'N/A'),
(48, '3.923', '30.418', 'WildFire', '2017-05-06', 'NASA', 'N/A'),
(49, '4.17', '29.5', 'Animal Carcass', '2017-05-08', 'Keyan', 'asdasdasd'),
(50, '4.3', '19.8', 'Signs of Poaching', '2017-05-08', 'Test Ranger', ''),
(51, '4.3', '29.8', 'Signs of Poaching', '2017-05-08', 'Test Ranger', ''),
(52, '4.13', '29.03', 'Animal Carcass', '2017-05-07', 'Ian Hoyos', ''),
(53, '4.23', '29.7', 'Animal Carcass', '2017-05-07', 'Ian Hoyos', ''),
(54, '3.5', '29.5', 'Animal Carcass', '2017-05-07', 'Ian Hoyos', ''),
(55, '4', '29.2', 'Animal Carcass', '2009-01-19', 'Paul', 'n/a');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
