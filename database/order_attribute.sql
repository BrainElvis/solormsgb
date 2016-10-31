-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2016 at 09:45 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sadia1_ieat_v3`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_attribute`
--

CREATE TABLE IF NOT EXISTS `order_attribute` (
  `OrderAttrId` int(11) NOT NULL AUTO_INCREMENT,
  `OrderDetailId` int(11) NOT NULL,
  `OrderCat` int(11) DEFAULT NULL,
  `OrderBase` int(11) DEFAULT NULL,
  `OrderSelection` int(11) DEFAULT NULL,
  `OrderAttrName` varchar(250) DEFAULT NULL,
  `AttrQty` int(11) NOT NULL,
  `OrderAttrUnitPrice` double NOT NULL,
  `special` enum('0','1','2') DEFAULT NULL,
  `CartAttrGenID` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`OrderAttrId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
