-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2016 at 09:32 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `solorms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `username`, `password`, `description`) VALUES
(1, 'admin@example.com', 'admin', '25d55ad283aa400af464c76d713c07ad', 'Mr Zaman');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`key`, `value`) VALUES
('address', 'Unit 27\r\nBessemer Market\r\nBessemer Rd \r\nCardiff \r\nCF11 8BE,\r\nVAT Reg No:229 6600 01'),
('barcode_content', 'number'),
('barcode_first_row', 'not_show'),
('barcode_font', 'fontawesome-webfont.ttf'),
('barcode_font_size', '10'),
('barcode_generate_if_empty', '1'),
('barcode_height', '120'),
('barcode_num_in_row', '10'),
('barcode_page_cellspacing', '10'),
('barcode_page_width', '100'),
('barcode_quality', '100'),
('barcode_second_row', 'item_code'),
('barcode_third_row', 'unit_price'),
('barcode_type', 'Code39'),
('barcode_width', '300'),
('company', 'Fortuna Cash & Carry'),
('company_logo', 'company_logo6.png'),
('currency_decimals', '2'),
('currency_side', '0'),
('currency_symbol', '£ '),
('custom10_name', ''),
('custom1_name', ''),
('custom2_name', ''),
('custom3_name', ''),
('custom4_name', ''),
('custom5_name', ''),
('custom6_name', ''),
('custom7_name', ''),
('custom8_name', ''),
('custom9_name', ''),
('dateformat', 'd/m/Y'),
('decimal_point', '.'),
('default_sales_discount', '0'),
('default_tax_1_name', 'VAT '),
('default_tax_1_rate', '20'),
('default_tax_2_name', ''),
('default_tax_2_rate', ''),
('default_tax_rate', '8'),
('email', 'info@gksoft.co.uk'),
('fax', ''),
('invoice_default_comments', 'Thank you for your oder, Your attention is drawn to our terms and conditions of trading overleaf.'),
('invoice_email_message', 'Dear $CU, In attachment the receipt for sale $INV'),
('invoice_enable', '1'),
('language', 'en'),
('lines_per_page', '25'),
('msg_msg', 'Thanks for buying with us  '),
('msg_pwd', 'ecse100200152'),
('msg_src', 'GK-POS'),
('msg_uid', 'admin'),
('phone', '02920 371109'),
('print_bottom_margin', '0'),
('print_footer', '0'),
('print_header', '0'),
('print_left_margin', '0'),
('print_right_margin', '0'),
('print_silently', '1'),
('print_top_margin', '0'),
('quantity_decimals', '0'),
('receipt_show_description', '0'),
('receipt_show_serialnumber', '1'),
('receipt_show_taxes', '1'),
('receipt_show_total_discount', '1'),
('receiving_calculate_average_price', '0'),
('recv_invoice_format', '$CO'),
('return_policy', 'Thank you for your oder, Your attention is drawn to our terms and conditions of trading overleaf.'),
('sales_invoice_format', '$CO'),
('tax_decimals', '0'),
('tax_included', '0'),
('thousands_separator', ''),
('timeformat', 'H:i:s'),
('timezone', 'Europe/Amsterdam'),
('use_invoice_template', '1'),
('website', 'http://fortunacashcarry.co.uk/');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
