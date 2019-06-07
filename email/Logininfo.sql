-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Host: tethys.cse.buffalo.edu:3306
-- Generation Time: Jun 07, 2019 at 05:53 PM
-- Server version: 5.1.65-log
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cse442_542_2019_summer_teamb_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Logininfo`
--

CREATE TABLE IF NOT EXISTS `Logininfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentname` varchar(32) NOT NULL,
  `emailaddress` varchar(32) NOT NULL,
  `confirmationcode` varchar(13) DEFAULT NULL,
  `coursrenumber` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `Logininfo`
--

INSERT INTO `Logininfo` (`id`, `studentname`, `emailaddress`, `confirmationcode`, `coursrenumber`) VALUES
(1, 'Shikhar Chaure', 'schaure@buffalo.edu', NULL, 'CSE542'),
(3, 'Amanda Pellechia', 'aepellec@buffalo.edu', NULL, 'CSE542'),
(2, 'Lingbo Hu', 'lingbohu@buffalo.edu', NULL, 'CSE542');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
