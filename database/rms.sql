-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2016 at 05:03 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rms`
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
('address', 'Unit 27, Bessemer Market,Bessemer Rd,Cardiff ,CF11 8BE'),
('api_host', 'http://localhost/ieat/'),
('api_id', '14'),
('api_key', 'a6bc997ee8d1259119b663020813a40252676f1d'),
('api_name', 'Mama Mia'),
('api_password', '123456'),
('api_username', 'zaman'),
('api_website', 'http://localhost/ieat/menu/mama-mia/'),
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
('email', 'info@rms.co.uk'),
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
('website', 'http://localhost/rms/');

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
  `configuration_id` int(11) NOT NULL AUTO_INCREMENT,
  `configuration_title` text,
  `configuration_key` varchar(255) DEFAULT NULL,
  `configuration_value` text,
  `configuration_description` text,
  `configuration_group_id` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(5) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT '0001-01-01 00:00:00',
  `use_function` text,
  `set_function` text,
  PRIMARY KEY (`configuration_id`),
  UNIQUE KEY `unq_config_key_zen` (`configuration_key`),
  KEY `idx_key_value_zen` (`configuration_key`,`configuration_value`(10)),
  KEY `idx_cfg_grp_id_zen` (`configuration_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=340 ;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`configuration_id`, `configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES
(85, 'Installed Modules', 'MODULE_PAYMENT_INSTALLED', 'cod|Helcim|PayPal', 'This is automatically updated. No need to edit.', 6, NULL, NULL, '0000-00-00 00:00:00', NULL, NULL),
(112, 'Enable this Payment Module', 'MODULE_PAYMENT_PAYPALDP_STATUS', 'True', 'Do you want to enable this payment module?', 6, 25, NULL, '2010-01-26 14:24:30', NULL, 'form_radios(''keys[MODULE_PAYMENT_PAYPALDP_STATUS]'',array(''True'', ''False''), '),
(113, 'Live or Sandbox', 'MODULE_PAYMENT_PAYPALDP_SERVER', 'live', '<strong>Live: </strong> Used to process Live transactions<br><strong>Sandbox: </strong>For developers and testing', 6, 25, NULL, '2010-01-26 14:24:30', NULL, 'form_radios(''keys[MODULE_PAYMENT_PAYPALDP_SERVER]'',array(''live'', ''sandbox''), '),
(114, 'Sort order of display.', 'MODULE_PAYMENT_PAYPALDP_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 25, NULL, '2010-01-26 14:24:30', NULL, NULL),
(115, 'Payment Action', 'MODULE_PAYMENT_PAYPALDP_TRANSACTION_MODE', 'Final Sale', 'How do you want to obtain payment?<br /><strong>Default: Final Sale</strong>', 6, 25, NULL, '2010-01-26 14:24:30', NULL, 'form_radios(''keys[MODULE_PAYMENT_PAYPALDP_TRANSACTION_MODE]'', array(''Auth Only'', ''Final Sale''), '),
(116, 'Transaction Currency', 'MODULE_PAYMENT_PAYPALDP_CURRENCY', 'GBP', 'Which currency should the order be sent to PayPal as? <br />NOTE: if an unsupported currency is sent to PayPal, it will be auto-converted to USD (or GBP if using UK account)<br /><strong>Default: GBP</strong>', 6, 25, NULL, '2010-01-26 14:24:30', NULL, ''),
(117, 'API Signature -- Username', 'MODULE_PAYMENT_PAYPALWPP_APIUSERNAME', '', 'The API Username from your PayPal API Signature settings under *API Access*. This value typically looks like an email address and is case-sensitive.', 6, 25, NULL, '2010-01-26 14:24:30', NULL, NULL),
(118, 'API Signature -- Password', 'MODULE_PAYMENT_PAYPALWPP_APIPASSWORD', '', 'The API Password from your PayPal API Signature settings under *API Access*. This value is a 16-character code and is case-sensitive.', 6, 25, NULL, '2010-01-26 14:24:30', 'zen_cfg_password_display', ''),
(119, 'API Signature -- Signature Code', 'MODULE_PAYMENT_PAYPALWPP_APISIGNATURE', '', 'The API Signature from your PayPal API Signature settings under *API Access*. This value is a 56-character code, and is case-sensitive.', 6, 25, NULL, '2010-01-26 14:24:30', NULL, NULL),
(198, 'Customer registration welcome email', 'EMAIL_CUSTOMER_REGISTRATION', '1||1', 'Dear CUSTOMER_NAME,\n\nThanks for joining munchnow. We take great pleasure in welcoming you to munchnow family.\n\nPlease find your account login information below:\n\nEmail: USER_NAME\nPassword: ******\n\nIn order to be able to place orders and add restaurants as favorites,You need to activate your account with the following link: ACCOUNT_ACTIVATION_LINK\n\nPlease visit www.munchnow.co.uk to experience an all new way of ordering food online.\n\nThanks,\nSITE_NAME', 5, NULL, NULL, '0001-02-11 00:00:00', 'CUSTOMER_NAME, USER_NAME, PASSWORD, CUSTOMER_EMAIL, CUSTOMER_ADDRESS, SITE_NAME', NULL),
(199, 'Email to friends', 'EMAIL_TELL_FRIEND', '1||1', '<p>Hi XXXXXXX</p>\n<p>Have you ever taken service from SITE_URL ? If NO, then you are missing something special. My first choice is SITE_NAME when I need any Takeout or Delivery. Very easily you can order for foods and it gives you the full menus of all the takeouts in your area. Moreover you can pay online or on delivery. Every time I order food on there, I earn points which I can reuse on further ordering. Besides, you can get your money back in case of any inconvenience.</p>\n<p>You can register yourself from here REGISTRATION_URL</p>\n<p>Don''t miss it!!! Just try once!!</p>\n<p>CUSTOMER_NAME</p>', 5, NULL, NULL, '0001-02-11 00:00:00', 'CUSTOMER_NAME, REGISTRATION_URL, SITE_NAME', NULL),
(200, 'Customer verification email', 'EMAIL_CUSTOMER_VERIFICATION', '1||1', 'Dear CUSTOMER_NAME,<br><br>\n\n<font color="red">Thanks for creating munchnow Account</font> <br><br>Please click on the following link to verify your account<br><br> VERIFICATION_URL\n<br><br>\nRegards,\nSITE_NAME Team', 5, NULL, NULL, '0001-02-11 00:00:00', 'VERIFICATION_URL, SITE_NAME', NULL),
(201, 'Restaurant registration email notification', 'EMAIL_RESTAURANT_REGISTRATION', '1|1|', 'Hi OWNER_NAME,\n\nThank you for registering RESTAURANT_NAME with SITE_NAME.\nHere''s the details of your registration.\nEmail: OWNER_EMAIL\nLogin User: LOGIN_USERNAME\nPassword: LOGIN_PASSWORD\nLogin URL: LOGIN_URL\n\nThanks,\nSITE_NAME', 5, NULL, NULL, '0001-02-11 00:00:00', 'OWNER_NAME, RESTAURANT_NAME, OWNER_EMAIL, RESTAURANT_ADDRESS, SITE_NAME, LOGIN_USERNAME, LOGIN_PASSWORD, LOGIN_URL', ' '),
(202, 'Customer orders status notification', 'EMAIL_ORDER_STATUS_NOTIFICATION', '1|1|1', 'Order Status Notification\n\nCUSTOMER_NAME\nUSER_NAME\nCUSTOMER_EMAIL\nORDER_ID\nORDER_STATUS\nCUSTOMER_ADDRESS\nSITE_NAME', 5, NULL, NULL, '0001-02-11 00:00:00', 'CUSTOMER_NAME, USER_NAME, CUSTOMER_EMAIL, ORDER_ID, ORDER_STATUS, CUSTOMER_ADDRESS, SITE_NAME ', NULL),
(203, 'Customer feedback notification', 'EMAIL_FEEDBACK_NOTIFICATION', '1||1', 'Hi CUSTOMER_NAME, \n\nThank you for rating the service of your order ORDER_ID from SITE_NAME.\n\n***\nFEEDBACK\n***\n\nRegards,\nSITE_NAME', 5, NULL, NULL, '0001-02-11 00:00:00', 'CUSTOMER_NAME, ORDER_ID, FEEDBACK, SITE_NAME', NULL),
(204, 'Customer account banned notification', 'EMAIL_ACCOUNT_BANNED_NOTIFICATION', '1||1', 'Your account is banned\n\nCUSTOMER_NAME\nUSER_NAME\nCUSTOMER_EMAIL\nCUSTOMER_ADDRESS\nSITE_NAME\nBANCOMMENTS', 5, NULL, NULL, '0001-02-11 00:00:00', 'CUSTOMER_NAME, USER_NAME, CUSTOMER_EMAIL, CUSTOMER_ADDRESS, SITE_NAME, BANCOMMENTS', NULL),
(205, 'Affiliates earning notification', 'EMAIL_AFFILIATE_EARNING_NOTIFICATION', '1||1', 'Dear CUSTOMER_NAME,\n\nYou have earned EARNS today which brings your total affiliates earnings to TOTAL_EARNS.\n\nRegards\n\nSITE_NAME', 5, NULL, NULL, '0001-02-11 00:00:00', 'CUSTOMER_NAME, USER_NAME, CUSTOMER_EMAIL, ORDER_ID, EARNS, TOTAL_EARNS, CUSTOMER_ADDRESS, SITE_NAME', NULL),
(207, 'Email Template', 'EMAIL_TEMPLATE', '<table  border="0" cellspacing="0" cellpadding="0" bgcolor="#d4d4d4">\n<tbody>\n<tr>\n<td align="center">\n<table>\n<tbody>\n<tr>\n<td><br /><br /></td>\n</tr>\n</tbody>\n</table>\n <table  border="0" cellspacing="0" cellpadding="0">\n<tbody>\n<tr>\n<td>\n <table  border="0" cellspacing="0" cellpadding="0">\n<tbody>\n<tr>\n <td><img  src="http://codealpine.com/tinyMCEImage/UserFiles/Image/logo.png" alt="" width="196" height="100" /></td>\n</tr>\n</tbody>\n</table>\nBODY_TEXT</td>\n</tr>\n</tbody>\n</table>\n <table  border="0" cellspacing="0" cellpadding="0">\n<tbody>\n<tr>\n <td  width="240" align="right">&nbsp;</td>\n <td  align="right">&nbsp;</td>\n</tr>\n</tbody>\n</table>\n</td>\n</tr>\n</tbody>\n</table>', '', 0, NULL, NULL, '0001-01-01 00:00:00', NULL, NULL),
(208, 'Enable Google Checkout Module', 'MODULE_PAYMENT_GOOGLECHECKOUT_STATUS', 'False', 'Do you want to accept Google Checkout payments?', 6, 0, NULL, '0000-00-00 00:00:00', NULL, 'form_radios(''keys[MODULE_PAYMENT_GOOGLECHECKOUT_STATUS]'', array(''True'', ''False''), '),
(209, 'Login ID', 'MODULE_PAYMENT_GOOGLECHECKOUT_LOGIN', 'testing', 'The API Login ID used for the google checkout service', 6, 0, NULL, '2011-01-14 10:33:56', NULL, NULL),
(210, 'Transaction Key', 'MODULE_PAYMENT_GOOGLECHECKOUT_TXNKEY', 'Test', 'Transaction Key used for encrypting sent transaction data', 6, 0, NULL, '2011-01-14 10:33:56', '', NULL),
(211, 'Transaction Mode', 'MODULE_PAYMENT_GOOGLECHECKOUT_TESTMODE', 'Test', 'Transaction mode used for processing orders', 6, 0, NULL, '2011-01-14 10:33:56', NULL, 'form_radios(''keys[MODULE_PAYMENT_GOOGLECHECKOUT_TESTMODE]'', array(''Test'', ''Production''), '),
(212, 'Sort order of display.', 'MODULE_PAYMENT_GOOGLECHECKOUT_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2011-01-14 10:33:56', NULL, NULL),
(213, 'Currency', 'CURRENCY', '&pound;', '', 0, 0, NULL, '2011-01-25 16:31:28', NULL, ''),
(214, 'Customer orders rejected notification', 'EMAIL_ORDER_REJECTED_NOTIFICATION', '1|1|1', 'Dear CUSTOMER_NAME,\n\nUnfortunately your order #ORDER_ID has been REJECTED by the restaurant. \n\nReject reason: REJECT_REASON\n\nIf you have question please contact at \ninfo@munchnow.co.uk\n\nThanks,\nSITE_NAME', 5, 6, NULL, '0001-01-01 00:00:00', 'CUSTOMER_NAME, USER_NAME, CUSTOMER_EMAIL, ORDER_ID, ORDER_STATUS, CUSTOMER_ADDRESS, SITE_NAME ', NULL),
(215, 'Order confirmation notification', 'EMAIL_ORDER_CONFIRMATION_NOTIFICATION', '1|1|1', 'Dear CUSTOMER_NAME,\n\nYour order ORDER_ID has been accepted.\nHere''s details of your order:\n\nOrder Address: CUSTOMER_ADDRESS\n\nDelivery Time: DELIVERY_TIME\n\nMessage from Restaurant:\nCONFIRMATION_MESSAGE\n\nThanks,\nSITE_NAME', 5, 5, NULL, '0001-01-01 00:00:00', 'CUSTOMER_NAME, USER_NAME, CUSTOMER_EMAIL, ORDER_ID, ORDER_STATUS, CUSTOMER_ADDRESS, SITE_NAME, DELIVERY_TIME, CONFIRMATION_MESSAGE ', NULL),
(216, 'Enable Authorize.net Module', 'MODULE_PAYMENT_AUTHORIZENET_STATUS', 'False', 'Do you want to accept Authorize.net payments?', 6, 0, NULL, '2011-03-15 13:52:49', NULL, 'form_radios(''keys[MODULE_PAYMENT_AUTHORIZENET_STATUS]'', array(''True'', ''False''), '),
(217, 'Login ID', 'MODULE_PAYMENT_AUTHORIZENET_LOGIN', 'testing', 'The API Login ID used for the Authorize.net service', 6, 0, NULL, '2011-03-15 13:52:49', NULL, NULL),
(218, 'Transaction Key', 'MODULE_PAYMENT_AUTHORIZENET_TXNKEY', 'Test', 'Transaction Key used for encrypting sent transaction data', 6, 0, NULL, '2011-03-15 13:52:49', 'zen_cfg_password_display', NULL),
(219, 'MD5 Hash', 'MODULE_PAYMENT_AUTHORIZENET_MD5HASH', '*Set A Hash Value at AuthNet Admin*', 'Encryption key used for validating received transaction data (MAX 20 CHARACTERS)', 6, 0, NULL, '2011-03-15 13:52:49', 'zen_cfg_password_display', NULL),
(220, 'Transaction Mode', 'MODULE_PAYMENT_AUTHORIZENET_TESTMODE', 'Test', 'Transaction mode used for processing orders', 6, 0, NULL, '2011-03-15 13:52:49', NULL, 'form_radios(''keys[MODULE_PAYMENT_AUTHORIZENET_TESTMODE]'', array(''Test'', ''Production''), '),
(221, 'Transaction Method', 'MODULE_PAYMENT_AUTHORIZENET_METHOD', 'Credit Card', 'Transaction method used for processing orders', 6, 0, NULL, '2011-03-15 13:52:49', NULL, 'form_radios(''keys[MODULE_PAYMENT_AUTHORIZENET_METHOD]'', array(''Credit Card''), '),
(222, 'Authorization Type', 'MODULE_PAYMENT_AUTHORIZENET_AUTHORIZATION_TYPE', 'Authorize', 'Do you want submitted credit card transactions to be authorized only, or captured immediately?', 6, 0, NULL, '2011-03-15 13:52:49', NULL, 'form_radios(''keys[MODULE_PAYMENT_AUTHORIZENET_AUTHORIZATION_TYPE]'', array(''Authorize'', ''Capture''), '),
(223, 'Request CVV Number', 'MODULE_PAYMENT_AUTHORIZENET_USE_CVV', 'False', 'Do you want to ask the customer for the card''s CVV number', 6, 0, NULL, '2011-03-15 13:52:49', NULL, 'form_radios(''keys[MODULE_PAYMENT_AUTHORIZENET_USE_CVV]'', array(''True'', ''False''), '),
(224, 'Customer Notifications', 'MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER', 'False', 'Should Authorize.Net email a receipt to the customer?', 6, 0, NULL, '2011-03-15 13:52:49', NULL, 'form_radios(''keys[MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER]'', array(''True'', ''False''), '),
(225, 'Sort order of display.', 'MODULE_PAYMENT_AUTHORIZENET_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2011-03-15 13:52:49', NULL, NULL),
(226, 'Gateway Mode', 'MODULE_PAYMENT_AUTHORIZENET_GATEWAY_MODE', 'offsite', 'Where should customer credit card info be collected?<br /><b>onsite</b> = here (requires SSL)<br /><b>offsite</b> = authorize.net site', 6, 0, NULL, '2011-03-15 13:52:49', NULL, 'form_radios(''keys[MODULE_PAYMENT_AUTHORIZENET_GATEWAY_MODE]'', array(''onsite'', ''offsite''), '),
(227, 'Enable Database Storage', 'MODULE_PAYMENT_AUTHORIZENET_STORE_DATA', 'True', 'Do you want to save the gateway communications data to the database?', 6, 0, NULL, '2011-03-15 13:52:49', NULL, 'form_radios(''keys[MODULE_PAYMENT_AUTHORIZENET_STORE_DATA]'', array(''True'', ''False''), '),
(284, 'Enable COD Module', 'MODULE_PAYMENT_COD_STATUS', 'True', 'Do you want to accept COD payments?', 6, 0, NULL, '0000-00-00 00:00:00', NULL, 'form_radios(''keys[MODULE_PAYMENT_COD_STATUS]'', array(''True'', ''False''), '),
(285, 'Sort order of display.', 'MODULE_PAYMENT_COD_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2012-06-29 12:59:27', NULL, NULL),
(286, 'Enable PayPal Module', 'MODULE_PAYMENT_PAYPAL_STATUS', 'True', 'Do you want to accept PayPal payments?', 6, 0, NULL, '0000-00-00 00:00:00', NULL, 'form_radios(''keys[MODULE_PAYMENT_PAYPAL_STATUS]'', array(''True'', ''False''), '),
(287, 'Business ID', 'MODULE_PAYMENT_PAYPAL_BUSINESS_ID', 'jahid_rassel-facilitator@yahoo.com', 'Primary email address for your PayPal account.<br />NOTE: This must match <strong>EXACTLY </strong>the primary email address on your PayPal account settings.  It <strong>IS case-sensitive</strong>, so please check your PayPal profile preferences at paypal.com and be sure to enter the EXACT same primary email address here.', 6, 2, NULL, '2012-06-29 12:59:49', NULL, NULL),
(288, 'Transaction Currency', 'MODULE_PAYMENT_PAYPAL_CURRENCY', 'GBP', 'Which currency should the order be sent to PayPal as? <br />NOTE: if an unsupported currency is sent to PayPal, it will be auto-converted to USD.', 6, 3, NULL, '2012-06-29 12:59:49', NULL, ''),
(289, 'Sort order of display.', 'MODULE_PAYMENT_PAYPAL_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 8, NULL, '2012-06-29 12:59:49', NULL, NULL),
(290, 'Mode for PayPal web services<br /><br />Default:<br /><code>www.paypal.com/cgi-bin/webscr</code><br />or<br /><code>www.paypal.com/us/cgi-bin/webscr</code><br />or for the UK,<br /><code>www.paypal.com/uk/cgi-bin/webscr</code>', 'MODULE_PAYMENT_PAYPAL_HANDLER', 'www.sandbox.paypal.com/cgi-bin/webscr', 'Choose the URL for PayPal live processing', 6, 73, NULL, '2012-06-29 12:59:49', NULL, ''),
(291, 'PDT Token (Payment Data Transfer)', 'MODULE_PAYMENT_PAYPAL_PDTTOKEN', '', 'Enter your PDT Token value here in order to activate transactions immediately after processing (if they pass validation).', 6, 25, NULL, '2012-06-29 12:59:49', 'zen_cfg_password_display', NULL),
(327, 'Enable Helcim Module', 'MODULE_PAYMENT_HELCIM_STATUS', 'True', 'Do you want to accept payments via Helcim? ', 6, 0, NULL, '2012-11-22 18:19:13', NULL, 'form_radios(''keys[MODULE_PAYMENT_HELCIM_STATUS]'', array(''True'', ''False''), '),
(328, 'Merchant ID(Merchant DBA:)', 'MODULE_PAYMENT_HELCIM_MERCHANT_ID', '9999874544', 'Set this value to the Merchant ID assigned to you by Helcim', 6, 0, NULL, '2012-11-22 18:19:13', NULL, NULL),
(329, 'Merchant PIN', 'MODULE_PAYMENT_HELCIM_MERCHANT_PIN', 'g95ehi2i5a1fd8f658', 'Set this value to the Virtual Merchant PIN as configured within VirtualMerchant', 6, 0, NULL, '2012-11-22 18:19:13', NULL, NULL),
(330, 'User ID (Account ID)', 'MODULE_PAYMENT_HELCIM_USER_ID', '9999874544', 'Set this value to User ID as configured on VirtualMerchant', 6, 0, NULL, '2012-11-22 18:19:13', NULL, NULL),
(331, 'Gate Way MOde', 'MODULE_PAYMENT_HELCIM_GATEWAY_MODE', 'TEST', 'Transaction Mode', 6, 0, NULL, '2012-11-22 18:19:13', NULL, 'form_radios(''keys[MODULE_PAYMENT_HELCIM_GATEWAY_MODE]'', array(''TEST'', ''LIVE''), '),
(332, 'Enable CARDSAVE Module', 'MODULE_PAYMENT_CARDSAVE_STATUS', 'False', 'Do you want to accept payments via card save?', 6, 0, NULL, '2012-11-26 19:45:32', NULL, 'form_radios(''keys[MODULE_PAYMENT_CARDSAVE_STATUS]'', array(''True'', ''False''), '),
(333, 'Merchant ID', 'MODULE_PAYMENT_CARDSAVE_MERCHANT_ID', 'Merchant ID goes here', 'The merchant id assigned to you by card save or chosen when you applied', 6, 0, NULL, '2012-11-26 19:45:32', NULL, NULL),
(334, 'Password', 'MODULE_PAYMENT_CARDSAVE_PASSWORD', 'Pass goes here', 'The password choosen when you applied', 6, 0, NULL, '2012-11-26 19:45:32', NULL, NULL),
(335, 'Gate Way MOde', 'MODULE_PAYMENT_CARDSAVE_GATEWAY_MODE', 'TEST', 'Transaction Mode', 6, 0, NULL, '2012-11-26 19:45:32', NULL, 'form_radios(''keys[MODULE_PAYMENT_CARDSAVE_GATEWAY_MODE]'', array(''TEST'', ''LIVE''), '),
(336, 'Enable Helcim Module', 'MODULE_PAYMENT_PSIGATE_STATUS', 'False', 'Do you want to accept payments via Helcim? ', 6, 0, NULL, '2012-12-25 17:01:13', NULL, 'form_radios(''keys[MODULE_PAYMENT_PSIGATE_STATUS]'', array(''True'', ''False''), '),
(337, 'Store ID:)', 'MODULE_PAYMENT_PSIGATE_STORE_ID', 'store id goes here', 'PSiGate provides the StoreID within\r\nthe PSiGate Welcome Email.', 6, 0, NULL, '2012-12-25 17:01:13', NULL, NULL),
(338, 'Pass phrase', 'MODULE_PAYMENT_PSIGATE_PASS_PHRASE', 'password goes here', 'PSiGate provides the Passphrase\r\nwithin the PSiGate Welcome Email.', 6, 0, NULL, '2012-12-25 17:01:13', NULL, NULL),
(339, 'Gate Way MOde', 'MODULE_PAYMENT_PSIGATE_GATEWAY_MODE', 'TEST', 'Transaction Mode', 6, 0, NULL, '2012-12-25 17:01:13', NULL, 'form_radios(''keys[MODULE_PAYMENT_PSIGATE_GATEWAY_MODE]'', array(''TEST'', ''LIVE''), ');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `sent_at` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
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
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `CustId` int(10) NOT NULL AUTO_INCREMENT,
  `CustGender` varchar(20) DEFAULT NULL,
  `CustFirstName` varchar(32) DEFAULT NULL,
  `Title` varchar(30) DEFAULT NULL,
  `CustLastName` varchar(32) DEFAULT NULL,
  `CustDOB` varchar(20) DEFAULT NULL,
  `CustEmail` varchar(96) DEFAULT NULL,
  `CustUserName` varchar(512) DEFAULT NULL,
  `CustAdd1` varchar(250) DEFAULT NULL,
  `CustAdd2` varchar(250) DEFAULT NULL,
  `CustTown` varchar(250) DEFAULT NULL,
  `CustArea` varchar(300) DEFAULT NULL,
  `CustState` varchar(250) DEFAULT NULL,
  `County` varchar(250) DEFAULT NULL,
  `CustPostcode` varchar(250) DEFAULT NULL,
  `CustBuild` varchar(200) DEFAULT NULL,
  `CustFloor` varchar(200) DEFAULT NULL,
  `CustDoorbell` varchar(200) DEFAULT NULL,
  `CustComments` varchar(400) DEFAULT NULL,
  `CustTelephone` varchar(32) DEFAULT NULL,
  `CustMobile` varchar(50) DEFAULT NULL,
  `CustFax` varchar(32) DEFAULT NULL,
  `CustPassword` varchar(40) DEFAULT NULL,
  `CustCCode` varchar(20) DEFAULT NULL,
  `CustHowHear` varchar(100) DEFAULT NULL,
  `CustAddLabel` varchar(100) DEFAULT NULL,
  `CustStatus` enum('0','1','2','3') DEFAULT '1',
  `CustomerIp` varchar(30) DEFAULT '0.0.0.0',
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `baned` varchar(3) DEFAULT '000',
  `bancomments` varchar(1024) DEFAULT NULL,
  `guest` int(11) NOT NULL DEFAULT '0',
  `IsAffiliate` tinyint(1) DEFAULT '0',
  `affiliate_from` int(11) NOT NULL,
  `TotalAffEarning` double(7,2) DEFAULT '0.00',
  `verified` enum('0','1','2') DEFAULT NULL,
  `verifytxt` varchar(100) DEFAULT NULL,
  `PImage` varchar(200) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL,
  `last_paypal_orderid` int(11) NOT NULL,
  `document_number` varchar(200) DEFAULT NULL,
  `RestId` int(11) NOT NULL,
  PRIMARY KEY (`CustId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustId`, `CustGender`, `CustFirstName`, `Title`, `CustLastName`, `CustDOB`, `CustEmail`, `CustUserName`, `CustAdd1`, `CustAdd2`, `CustTown`, `CustArea`, `CustState`, `County`, `CustPostcode`, `CustBuild`, `CustFloor`, `CustDoorbell`, `CustComments`, `CustTelephone`, `CustMobile`, `CustFax`, `CustPassword`, `CustCCode`, `CustHowHear`, `CustAddLabel`, `CustStatus`, `CustomerIp`, `add_date`, `baned`, `bancomments`, `guest`, `IsAffiliate`, `affiliate_from`, `TotalAffEarning`, `verified`, `verifytxt`, `PImage`, `lat`, `lon`, `last_paypal_orderid`, `document_number`, `RestId`) VALUES
(1, NULL, 'Aktaruz', NULL, 'zaman', NULL, 'aktar.bd84@gmail.com', NULL, 'Bomford, Bairmingham', NULL, '1', '1', NULL, NULL, 'B322TX', NULL, NULL, NULL, NULL, NULL, '017171037', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 'Primary', '1', '0.0.0.0', '0000-00-00 00:00:00', '000', NULL, 0, 0, 0, 0.00, '1', NULL, NULL, NULL, NULL, 0, NULL, 14);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE IF NOT EXISTS `customer_address` (
  `CustAddId` int(10) NOT NULL AUTO_INCREMENT,
  `CustId` int(10) NOT NULL DEFAULT '0',
  `CustFirstName` varchar(100) NOT NULL,
  `CustLastName` varchar(100) NOT NULL,
  `CustAdd1` varchar(250) DEFAULT NULL,
  `CustAdd2` varchar(250) DEFAULT NULL,
  `CustPhone` varchar(15) DEFAULT NULL,
  `County` varchar(200) DEFAULT NULL,
  `CustTown` varchar(250) DEFAULT NULL,
  `CustArea` varchar(300) DEFAULT NULL,
  `CustBuild` varchar(200) DEFAULT NULL,
  `CustFloor` varchar(200) DEFAULT NULL,
  `CustDoorbell` varchar(200) DEFAULT NULL,
  `CustComments` varchar(300) DEFAULT NULL,
  `CustState` varchar(250) DEFAULT NULL,
  `CustCountry` varchar(250) DEFAULT NULL,
  `CustPostcode` varchar(250) DEFAULT NULL,
  `CustAddLabel` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`CustAddId`),
  KEY `CustId` (`CustId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`CustAddId`, `CustId`, `CustFirstName`, `CustLastName`, `CustAdd1`, `CustAdd2`, `CustPhone`, `County`, `CustTown`, `CustArea`, `CustBuild`, `CustFloor`, `CustDoorbell`, `CustComments`, `CustState`, `CustCountry`, `CustPostcode`, `CustAddLabel`) VALUES
(1, 2, 'Gary', 'Pitts', 'address_1', '', '', NULL, '2', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'address_1'),
(2, 2, 'Gary', 'Pitts', 'address_2', '', '902 345 6456', NULL, '4', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'address_2'),
(3, 5, '', '', '1212 Carter Crest Road', '', '780 422 9396', 'Alberta', 'Edmonton', NULL, NULL, NULL, NULL, NULL, NULL, 'Canada', 'T6R 2L8', 'home'),
(4, 2, 'Gary', 'Pitts', 'address_3', '', '902 345 6456', NULL, '6', '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'address_3'),
(5, 1, '', '', '9909 Franklin Ave', '', '78 074 37878', 'Alberta', 'Fort McMurray', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 't9h 2k4', 'Office'),
(6, 5, '', '', '1568 Hector road', '', '7809098706', 'Alberta', 'Edmonton', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T6R 2H2', 'Work'),
(8, 3, '', '', 'test address ', '0', '01717103734', '', '', 'Bromford', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1234567'),
(9, 4, 'golam', 'Kibria', '71 pethybridge Road', '', '', NULL, '4', '6', NULL, NULL, NULL, NULL, NULL, NULL, '3ER 3DE', 'test_1'),
(16, 4, 'golam', 'Kibria', '72', '', '0785445445422', NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, 'RDE 3ED', 'Test_2'),
(14, 15, '', '', 'add neww addess', '', '01819466392', NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'add new address'),
(13, 15, '', '', 't834945965', '', '678787987', NULL, '4', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 't5768'),
(15, 15, 'Tania', 'Noor', 'adding from order place', '0', '0101010101', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'order place'),
(17, 4, 'golam', 'Kibria', 'ajhjhjuah', '', '', NULL, '4', '6', NULL, NULL, NULL, NULL, NULL, NULL, '4RD 23D', 'Test_3'),
(18, 12, 'khairul', 'alam', 'Oxford', '0', '0789888888', NULL, '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'primary'),
(19, 4, 'golam', 'Kibria', '72 Bromford Road', '', '0456654641645', NULL, '1', '11', NULL, NULL, NULL, NULL, NULL, NULL, '6RD 3RG', 'Test_4'),
(20, 2, '', '', 'address_4', '', '', NULL, '4', '6', NULL, NULL, NULL, NULL, NULL, NULL, 'CF5 4DR', 'Test Address');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
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

-- --------------------------------------------------------

--
-- Table structure for table `verification_method`
--

CREATE TABLE IF NOT EXISTS `verification_method` (
  `id` int(200) NOT NULL,
  `verification_by` int(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `verification_method`
--

INSERT INTO `verification_method` (`id`, `verification_by`) VALUES
(1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
