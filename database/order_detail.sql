-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2016 at 09:44 AM
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
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `OrderItermId` int(10) NOT NULL AUTO_INCREMENT,
  `OrderId` int(10) NOT NULL DEFAULT '0',
  `ResId` int(11) NOT NULL,
  `CatId` int(11) DEFAULT NULL,
  `CatName` varchar(200) DEFAULT NULL,
  `BaseId` int(11) DEFAULT NULL,
  `BaseName` varchar(250) DEFAULT NULL,
  `BaseQty` int(11) NOT NULL,
  `BaseUnitPrice` double NOT NULL,
  `SelectionId` int(11) DEFAULT NULL,
  `SelectionName` varchar(250) DEFAULT NULL,
  `SelectionQty` int(11) NOT NULL,
  `SelectionUnitPrice` double DEFAULT NULL,
  `item_name` varchar(200) DEFAULT NULL,
  `total_qty` int(11) NOT NULL,
  `Special` int(11) DEFAULT '0',
  `BaseMainPrice` double DEFAULT '0',
  `SelectionMainPrice` double DEFAULT '0',
  `item_comments` varchar(500) DEFAULT NULL,
  `CartGenID` varchar(200) DEFAULT NULL,
  `CartSelGenID` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`OrderItermId`),
  KEY `OrderId` (`OrderId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=256 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
