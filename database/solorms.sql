-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2016 at 03:07 PM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

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
`id` int(3) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `description` varchar(100) NOT NULL
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
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`key`, `value`) VALUES
('address', 'Unit 27, Bessemer Market,Bessemer Rd,Cardiff ,CF11 8BE'),
('api_host', 'http://localhost/munchnow.co.uk/'),
('api_id', '14'),
('api_key', 'a6bc997ee8d1259119b663020813a40252676f1d'),
('api_name', 'Mama Mia'),
('api_password', '123456'),
('api_username', 'zaman'),
('api_website', 'http://localhost/munchnow.co.uk/menu/mama-mia/'),
('barcode_height', '120'),
('barcode_num_in_row', '10'),
('barcode_page_cellspacing', '10'),
('barcode_page_width', '100'),
('barcode_quality', '100'),
('barcode_second_row', 'item_code'),
('barcode_third_row', 'unit_price'),
('barcode_type', 'Code39'),
('barcode_width', '300'),
('company', 'Ready Food'),
('company_logo', 'company_logo10.png'),
('currency_decimals', '2'),
('currency_side', '0'),
('currency_symbol', '£'),
('custom10_name', ''),
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
('home_menucarousel', 'on'),
('home_ourfeatures', 'on'),
('home_promotime', 'on'),
('home_slider', 'on'),
('home_testimonials', 'on'),
('home_weserve', 'on'),
('language', 'en'),
('lines_per_page', '25'),
('msg_msg', 'Thanks for buying with us  '),
('msg_pwd', 'ecse100200152'),
('msg_src', 'GK-POS'),
('msg_uid', 'admin'),
('online_book', 'off'),
('online_review', 'off'),
('payment_cod', 'payment_cod'),
('payment_gateway', 'Paypal'),
('payment_merchant_id', 'aktar.bd84@gmail.com'),
('payment_mode', 'Live'),
('payment_online', 'payment_online'),
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
('return_policy', 'Thank you for your oder, Your attention is drawn to our terms and conditions of trading overleaf.'),
('tax_decimals', '0'),
('tax_included', '0'),
('thousands_separator', ''),
('timeformat', 'H:i:s'),
('timezone', 'Europe/Amsterdam'),
('vatreg', '1212'),
('website', 'http://fortunacashcarry.co.uk/');

-- --------------------------------------------------------

--
-- Table structure for table `config_1`
--

CREATE TABLE IF NOT EXISTS `config_1` (
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config_1`
--

INSERT INTO `config_1` (`key`, `value`) VALUES
('address', 'Unit 27, Bessemer Market,Bessemer Rd,Cardiff ,CF11 8BE'),
('api_host', 'http://localhost/munchnow.co.uk/'),
('api_id', '14'),
('api_key', 'a6bc997ee8d1259119b663020813a40252676f1d'),
('api_name', 'Mama Mia'),
('api_password', '123456'),
('api_username', 'zaman'),
('api_website', 'http://localhost/munchnow.co.uk/menu/mama-mia/'),
('barcode_font', 'fontawesome-webfont.ttf'),
('barcode_font_size', '10'),
('barcode_height', '120'),
('barcode_num_in_row', '10'),
('barcode_page_cellspacing', '10'),
('barcode_page_width', '100'),
('barcode_quality', '100'),
('barcode_second_row', 'item_code'),
('barcode_third_row', 'unit_price'),
('barcode_type', 'Code39'),
('barcode_width', '300'),
('company', 'Ready Food'),
('company_logo', 'company_logo10.png'),
('currency_decimals', '2'),
('currency_side', '0'),
('currency_symbol', '£'),
('custom10_name', ''),
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
('home_menucarousel', 'off'),
('home_ourfeatures', 'off'),
('home_promotime', 'on'),
('home_slider', 'off'),
('home_testimonials', 'off'),
('home_weserve', 'on'),
('language', 'en'),
('lines_per_page', '25'),
('msg_msg', 'Thanks for buying with us  '),
('msg_pwd', 'ecse100200152'),
('msg_src', 'GK-POS'),
('msg_uid', 'admin'),
('payment_cod', 'payment_cod'),
('payment_gateway', 'Nochex'),
('payment_merchant_id', ''),
('payment_mode', 'Live'),
('payment_online', ''),
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
('return_policy', 'Thank you for your oder, Your attention is drawn to our terms and conditions of trading overleaf.'),
('tax_decimals', '0'),
('tax_included', '0'),
('thousands_separator', ''),
('timeformat', 'H:i:s'),
('timezone', 'Europe/Amsterdam'),
('vatreg', '1212'),
('website', 'http://fortunacashcarry.co.uk/');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `sent_at` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `phone`, `email`, `message`, `sent_at`) VALUES
(1, 'Mr zaman', '01717103734', 'info@gksoft.co.uk', 'this is a test message ', '16161616-1010-1010 0'),
(2, 'Mr zaman', '329234324', 'asdasd@gksoft.co.uk', 'tasjdjas;dasd', '2016-10-10 14:05:38'),
(3, 'happy sing', '23-48932-94', 'happ@ldjlsdjf.com', 'lasdjsa''dpasidjpo p oijdfpoiasjd ', '2016-10-10 14:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE IF NOT EXISTS `gallery_images` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `name`, `deleted`, `status`) VALUES
(17, 'orderstep3.png', 0, 1),
(18, 'orderstep2.png', 0, 1),
(19, 'orderstep4.png', 0, 1),
(20, 'orderstep1.png', 0, 1),
(21, 'orderstep2.png', 0, 1),
(22, 'orderstep3.png', 0, 1),
(23, 'orderstep2.png', 0, 1),
(24, 'orderstep1.png', 0, 1),
(25, 'orderstep3.png', 0, 1),
(26, 'orderstep4.png', 0, 1),
(27, 'orderstep1.png', 0, 1),
(28, 'orderstep2.png', 0, 1),
(29, 'orderstep3.png', 0, 1),
(30, 'orderstep4.png', 0, 1),
(31, 'orderstep2.png', 0, 1),
(32, 'orderstep1.png', 0, 1),
(33, 'orderstep3.png', 0, 1),
(34, 'orderstep4.png', 0, 1),
(35, 'orderstep3.png', 0, 1),
(36, 'orderstep3.png', 0, 1),
(37, 'orderstep4.png', 0, 1),
(38, 'orderstep3.png', 0, 1),
(39, 'orderstep2.png', 0, 1),
(40, 'orderstep4.png', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
 ADD PRIMARY KEY (`key`);

--
-- Indexes for table `config_1`
--
ALTER TABLE `config_1`
 ADD PRIMARY KEY (`key`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
