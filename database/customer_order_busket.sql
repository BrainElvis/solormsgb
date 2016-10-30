-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2016 at 03:33 PM
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
-- Table structure for table `customer_order_busket`
--

CREATE TABLE IF NOT EXISTS `customer_order_busket` (
  `OrderId` int(10) NOT NULL AUTO_INCREMENT,
  `Status` enum('0','1','2','3','4','5') DEFAULT NULL,
  `CustId` int(10) NOT NULL DEFAULT '0',
  `RestId` int(10) NOT NULL DEFAULT '0',
  `OrderPolicyId` int(11) NOT NULL,
  `CustFirstName` varchar(100) DEFAULT NULL,
  `CustLastName` varchar(100) DEFAULT NULL,
  `OrderAdd1` varchar(250) DEFAULT NULL,
  `CustBuild` varchar(200) DEFAULT NULL,
  `CustFloor` varchar(200) DEFAULT NULL,
  `CustDoorbell` varchar(200) DEFAULT NULL,
  `CustComments1` varchar(300) DEFAULT NULL,
  `OrderAdd2` varchar(250) DEFAULT NULL,
  `OrderAddTown` varchar(250) DEFAULT NULL,
  `OrderAddArea` varchar(300) DEFAULT NULL,
  `OrderAddState` varchar(250) DEFAULT NULL,
  `OrderAddCountry` varchar(250) DEFAULT NULL,
  `OrderAddPostcode` varchar(250) DEFAULT NULL,
  `CustComments` varchar(250) DEFAULT NULL,
  `CustTelephone` varchar(200) DEFAULT NULL,
  `PaymentMethod` varchar(250) DEFAULT NULL,
  `PayStatus` enum('0','1','2') DEFAULT NULL,
  `DeliveryStatus` int(10) NOT NULL DEFAULT '0',
  `ComFee` double NOT NULL DEFAULT '0',
  `ComFeeStatus` int(5) NOT NULL DEFAULT '0',
  `HandlingFee` double DEFAULT '0',
  `Vat` double NOT NULL DEFAULT '0',
  `OrderDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryTime` varchar(250) DEFAULT NULL,
  `CCFee` double NOT NULL DEFAULT '0',
  `DeliveryCost` double DEFAULT '0',
  `AuthorizationCode` varchar(250) DEFAULT NULL,
  `total_price` float NOT NULL DEFAULT '0',
  `BalanceDeduction` float(10,2) NOT NULL DEFAULT '0.00',
  `statementstatus` enum('0','1') DEFAULT NULL,
  `invoicestatus` int(11) NOT NULL,
  `aff_from_res` int(11) DEFAULT '0',
  `rest_aff_amount` double NOT NULL DEFAULT '0',
  `aff_cust_id` int(11) NOT NULL DEFAULT '0',
  `cust_aff_amount` double NOT NULL DEFAULT '0',
  `ord_ip` varchar(30) DEFAULT '0.0.0.0',
  `rated_by_customer` enum('0','1','2') DEFAULT NULL,
  `cc_owner` varchar(64) DEFAULT NULL,
  `cc_number` varchar(32) DEFAULT NULL,
  `cc_expires` varchar(5) DEFAULT NULL,
  `cc_cvv` blob NOT NULL,
  `charity_id` int(11) NOT NULL DEFAULT '0',
  `OrderTotalDiscount` double DEFAULT '0',
  `DeliveryDiscount` double DEFAULT '0',
  `Promocode` varchar(100) DEFAULT NULL,
  `PromocodeProvider` varchar(255) DEFAULT NULL,
  `PromocodePrice` double NOT NULL DEFAULT '0',
  `Summery` text,
  `OrderPoint` int(11) DEFAULT '0',
  `GrandTotal` double DEFAULT '0',
  `ComRate` double DEFAULT '0',
  `VatRate` double DEFAULT '0',
  `OrderCommission` double DEFAULT '0',
  `CreditAmount` double DEFAULT '0',
  `ActualBalance` double DEFAULT '0',
  `ComAmount` double DEFAULT '0',
  `last_message` varchar(512) DEFAULT NULL,
  `sms_sent` int(11) DEFAULT '0',
  `OrderLang` varchar(50) NOT NULL,
  PRIMARY KEY (`OrderId`),
  KEY `RestId` (`RestId`),
  KEY `CustId` (`CustId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=116 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
