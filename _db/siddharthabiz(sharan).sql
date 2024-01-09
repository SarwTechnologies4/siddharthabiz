-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2023 at 04:09 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siddharthabiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activities`
--

CREATE TABLE `tbl_activities` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parentOf` int(11) NOT NULL,
  `destinationId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_brief` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `brief` blob NOT NULL,
  `content` blob NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `meta_keywords` tinytext NOT NULL,
  `meta_description` tinytext NOT NULL,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_activities`
--

INSERT INTO `tbl_activities` (`id`, `slug`, `parentOf`, `destinationId`, `title`, `title_brief`, `image`, `banner_image`, `brief`, `content`, `status`, `meta_keywords`, `meta_description`, `sortorder`, `added_date`) VALUES
(1, 'trekking', 0, 0, 'Trekking', '', '', '', '', '', 1, '', '', 2, '2021-09-29 13:34:13'),
(2, 'hiking', 0, 0, 'Hiking', '', '', '', '', '', 1, '', '', 1, '2021-09-29 13:34:22'),
(3, 'mountaineering', 0, 0, 'Mountaineering', '', '', '', '', '', 1, '', '', 0, '2021-09-29 13:34:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advertisement`
--

CREATE TABLE `tbl_advertisement` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `linktype` int(1) NOT NULL,
  `linksrc` varchar(150) CHARACTER SET utf8 NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `added_date` varchar(50) CHARACTER SET utf8 NOT NULL,
  `sortorder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_advertisement`
--

INSERT INTO `tbl_advertisement` (`id`, `title`, `image`, `linktype`, `linksrc`, `status`, `added_date`, `sortorder`) VALUES
(1, 'become a member', 'UEjHh-add.jpg', 0, 'page/about-us', 1, '2021-09-24 11:59:08', 2),
(2, 'room', 'H9UkF-three.jpg', 1, 'page/siddhartha-business-group-of-br-hospitality-pvt-ltd', 1, '2021-09-24 12:05:58', 1),
(3, 'new year 2080', 'dZhLv-two.jpg', 0, 'page/siddhartha-business-group-of-br-hospitality-pvt-ltd', 1, '2021-09-24 12:06:11', 0),
(4, 'rooom', '070mc-aone.jpg', 0, 'page/siddhartha-business-group-of-br-hospitality-pvt-ltd', 1, '2023-09-26 07:58:45', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_apibooking`
--

CREATE TABLE `tbl_apibooking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hotel_code` varchar(50) NOT NULL,
  `booking_code` varchar(50) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `nights` tinyint(4) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `flightname` varchar(100) NOT NULL,
  `arrivaltime` varchar(30) NOT NULL,
  `personal_request` text NOT NULL,
  `booking_date` date NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `pay_type` varchar(255) NOT NULL,
  `pay_invoice` varchar(50) NOT NULL,
  `pay_code` varchar(100) NOT NULL,
  `pay_pan` varchar(50) NOT NULL,
  `has_payment` tinyint(4) NOT NULL,
  `payment_date` date NOT NULL,
  `subtotal` float NOT NULL,
  `currency` varchar(20) NOT NULL,
  `currency_symbol` varchar(20) NOT NULL,
  `grand_total` float NOT NULL,
  `tax_amount` float NOT NULL,
  `service_charge` float NOT NULL,
  `approved` tinyint(4) NOT NULL,
  `approved_by` int(11) NOT NULL DEFAULT 0,
  `approved_date` date NOT NULL,
  `status` enum('inquiry','approved','checkin','checkout','cancelled','unapproved') NOT NULL,
  `card_holder` varchar(100) NOT NULL,
  `card_number` varchar(50) NOT NULL,
  `card_expire` varchar(10) NOT NULL,
  `card_cvv` varchar(5) NOT NULL,
  `nabil_orderid` int(11) NOT NULL,
  `nabil_sessionid` tinytext NOT NULL,
  `nabil_prn` varchar(100) NOT NULL,
  `nabil_pan` varchar(100) NOT NULL,
  `nabil_card` varchar(100) NOT NULL,
  `nabil_cardholder` varchar(100) NOT NULL,
  `nabil_order_status` varchar(100) NOT NULL,
  `nabil_response_desc` tinytext NOT NULL,
  `nabil_marchant_id` tinytext NOT NULL,
  `nabil_order_desc` tinytext NOT NULL,
  `nabil_approved_id` varchar(50) NOT NULL,
  `nabil_approved_amt` varchar(50) NOT NULL,
  `nabil_approved_currency` varchar(10) NOT NULL,
  `nabil_approved_datetime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_apibooking`
--

INSERT INTO `tbl_apibooking` (`id`, `user_id`, `hotel_code`, `booking_code`, `checkin_date`, `checkout_date`, `nights`, `first_name`, `last_name`, `address`, `city`, `zipcode`, `country`, `country_code`, `email`, `contact_no`, `flightname`, `arrivaltime`, `personal_request`, `booking_date`, `transaction_id`, `pay_type`, `pay_invoice`, `pay_code`, `pay_pan`, `has_payment`, `payment_date`, `subtotal`, `currency`, `currency_symbol`, `grand_total`, `tax_amount`, `service_charge`, `approved`, `approved_by`, `approved_date`, `status`, `card_holder`, `card_number`, `card_expire`, `card_cvv`, `nabil_orderid`, `nabil_sessionid`, `nabil_prn`, `nabil_pan`, `nabil_card`, `nabil_cardholder`, `nabil_order_status`, `nabil_response_desc`, `nabil_marchant_id`, `nabil_order_desc`, `nabil_approved_id`, `nabil_approved_amt`, `nabil_approved_currency`, `nabil_approved_datetime`) VALUES
(1, 169, '5m1eav', 'U56DLod', '2021-07-20', '2021-07-21', 1, 'Swarna', 'Shakya', 'Lagan', 'ktm', '44600', 'Nepal', 'NP', 'swarna@longtail.info', '9849482842', '', '', '', '2021-07-20', '', 'himalayanBank', '', '', '', 0, '0000-00-00', 55, 'USD', 'USD', 68.37, 7.87, 5.5, 0, 0, '0000-00-00', 'inquiry', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 169, '5m1eav', 'JGtlpuq', '2021-09-14', '2021-09-15', 1, 'Swarna', 'Shakya', 'Lagan', 'ktm', '44600', 'Nepal', 'NP', 'swarna@longtail.info', '9849482842', '', '', '', '2021-09-07', '', 'himalayanBank', '', '', '', 0, '0000-00-00', 55, 'USD', 'USD', 68.37, 7.87, 5.5, 0, 0, '0000-00-00', 'inquiry', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 169, '5m1eav', 'lQHtH5j', '2021-09-28', '2021-09-29', 1, 'Swarna', 'Shakya', 'Lagan', 'ktm', '44600', 'Nepal', 'NP', 'swarna@longtail.info', '9849482842', '', '', '', '2021-09-09', '', 'himalayanBank', '', '', '', 0, '0000-00-00', 55, 'USD', 'USD', 68.37, 7.87, 5.5, 0, 0, '0000-00-00', 'inquiry', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 169, '5m1eav', 'Yj8iBhg', '2021-11-16', '2021-11-17', 1, 'Swarna', 'Shakya', 'Lagan', 'ktm', '44600', 'Nepal', 'NP', 'swarna@longtail.info', '9849482842', '', '', '', '2021-11-11', '', 'pay_later', '', '', '', 0, '0000-00-00', 55, 'USD', 'USD', 68.37, 7.87, 5.5, 0, 0, '0000-00-00', 'inquiry', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 169, '5m1eav', 'rxekuLl', '2021-11-22', '2021-11-23', 1, 'Swarna', 'Shakya', 'Lagan', 'ktm', '44600', 'Nepal', 'NP', 'swarna@longtail.info', '9849482842', '', '', '', '2021-11-11', '', 'pay_later', '', '', '', 0, '0000-00-00', 55, 'USD', 'USD', 68.37, 7.87, 5.5, 0, 0, '0000-00-00', 'inquiry', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_apibooking_child`
--

CREATE TABLE `tbl_apibooking_child` (
  `id` int(11) NOT NULL,
  `master_id` int(11) NOT NULL,
  `room_type` varchar(200) NOT NULL,
  `room_label` varchar(255) NOT NULL,
  `no_of_room` int(11) NOT NULL,
  `amount_type` tinyint(4) NOT NULL DEFAULT 1,
  `currency` varchar(10) NOT NULL,
  `price` double NOT NULL,
  `adult` tinyint(4) NOT NULL,
  `child` tinyint(4) NOT NULL,
  `extra_bed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_apibooking_child`
--

INSERT INTO `tbl_apibooking_child` (`id`, `master_id`, `room_type`, `room_label`, `no_of_room`, `amount_type`, `currency`, `price`, `adult`, `child`, `extra_bed`) VALUES
(1, 1, '1', 'Deluxe Room', 1, 1, 'USD', 55, 1, 0, 0),
(2, 2, '1', 'Deluxe Room', 1, 1, 'USD', 55, 1, 0, 0),
(3, 3, '1', 'Deluxe Room', 1, 1, 'USD', 55, 1, 0, 0),
(4, 4, '1', 'Deluxe Room', 1, 1, 'USD', 55, 1, 0, 0),
(5, 5, '1', 'Deluxe Room', 1, 1, 'USD', 55, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_apihotel`
--

CREATE TABLE `tbl_apihotel` (
  `id` int(11) NOT NULL,
  `star` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `long_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `hotel_type` varchar(20) NOT NULL,
  `destinationId` int(11) NOT NULL,
  `feature` text NOT NULL,
  `image` text NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `home_image` varchar(255) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `inquiry_email` varchar(200) NOT NULL,
  `inquiry_type` tinyint(1) NOT NULL DEFAULT 1,
  `street` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `zone` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `country` varchar(10) NOT NULL DEFAULT 'Nepal',
  `contact_person` varchar(255) NOT NULL,
  `contact_person_contact_no` varchar(50) NOT NULL,
  `contact_person_email` varchar(150) NOT NULL,
  `website` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `content` text NOT NULL,
  `added_date` date NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `payment_type` tinyint(1) NOT NULL DEFAULT 1,
  `merchant_id` tinytext NOT NULL,
  `merchant_key` tinytext NOT NULL,
  `nabil_mode` tinyint(1) NOT NULL DEFAULT 1,
  `twpg_cert_file` tinytext NOT NULL,
  `twpg_key_file` tinytext NOT NULL,
  `homepage` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `pay_type` tinyint(1) NOT NULL DEFAULT 0,
  `rd_note` tinytext NOT NULL,
  `nrd_note` tinytext NOT NULL,
  `meta_keywords` tinytext NOT NULL,
  `meta_description` tinytext NOT NULL,
  `map` text NOT NULL,
  `map_embed` text NOT NULL,
  `cleaning` text NOT NULL,
  `about_property` text NOT NULL,
  `note` varchar(255) NOT NULL,
  `faq` text NOT NULL,
  `policy` text NOT NULL,
  `imp_info` text NOT NULL,
  `nearby_attractions` text NOT NULL,
  `weddinghall` text NOT NULL,
  `rest` text NOT NULL,
  `restaurant` text NOT NULL,
  `brief` text NOT NULL,
  `hotel_rooms` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `customers_per_year` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `distance_to_center` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `resta` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `ota_booking_com` varchar(255) NOT NULL,
  `ota_trip_advisor` varchar(255) NOT NULL,
  `ota_expedia` varchar(255) NOT NULL,
  `social_facebook` varchar(255) NOT NULL,
  `social_instagram` varchar(255) NOT NULL,
  `social_tiktok` varchar(255) NOT NULL,
  `prop_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_apihotel`
--

INSERT INTO `tbl_apihotel` (`id`, `star`, `user_id`, `title`, `long_name`, `slug`, `code`, `logo`, `hotel_type`, `destinationId`, `feature`, `image`, `banner_image`, `home_image`, `contact_no`, `email`, `inquiry_email`, `inquiry_type`, `street`, `city`, `zone`, `district`, `country`, `contact_person`, `contact_person_contact_no`, `contact_person_email`, `website`, `detail`, `content`, `added_date`, `featured`, `payment_type`, `merchant_id`, `merchant_key`, `nabil_mode`, `twpg_cert_file`, `twpg_key_file`, `homepage`, `status`, `pay_type`, `rd_note`, `nrd_note`, `meta_keywords`, `meta_description`, `map`, `map_embed`, `cleaning`, `about_property`, `note`, `faq`, `policy`, `imp_info`, `nearby_attractions`, `weddinghall`, `rest`, `restaurant`, `brief`, `hotel_rooms`, `customers_per_year`, `distance_to_center`, `resta`, `ota_booking_com`, `ota_trip_advisor`, `ota_expedia`, `social_facebook`, `social_instagram`, `social_tiktok`, `prop_code`) VALUES
(1, 5, 175, 'Siddhartha Cottage', 'Siddhartha Cottage', 'siddhartha-cottage', '5m1eav', 'GK4C7-sarathi.png', '', 30, 'YToyOntpOjU7YTozOntzOjI6ImlkIjtpOjU7czo0OiJuYW1lIjtzOjE4OiJQb3B1bGFyIEZhY2lsaXRpZXMiO3M6ODoiZmVhdHVyZXMiO2E6ODp7aTo2O2E6Mzp7czoyOiJpZCI7czoxOiI2IjtzOjEwOiJpY29uX2NsYXNzIjtzOjExOiJmYWwgZmEtd2lmaSI7czo1OiJ0aXRsZSI7czo5OiJGcmVlIFdpZmkiO31pOjc7YTozOntzOjI6ImlkIjtzOjE6IjciO3M6MTA6Imljb25fY2xhc3MiO3M6MTM6ImZhbCBmYS1yb2NrZXQiO3M6NToidGl0bGUiO3M6MjA6IkVsZXZhdG9yIGluIGJ1aWxkaW5nIjt9aTo4O2E6Mzp7czoyOiJpZCI7czoxOiI4IjtzOjEwOiJpY29uX2NsYXNzIjtzOjE0OiJmYWwgZmEtcGFya2luZyI7czo1OiJ0aXRsZSI7czoxMjoiRnJlZSBQYXJraW5nIjt9aTo5O2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNjoiZmFsIGZhLXNub3dmbGFrZSI7czo1OiJ0aXRsZSI7czoxNToiQWlyIENvbmRpdGlvbmVkIjt9aToxMDthOjM6e3M6MjoiaWQiO3M6MjoiMTAiO3M6MTA6Imljb25fY2xhc3MiO3M6MTI6ImZhbCBmYS1wbGFuZSI7czo1OiJ0aXRsZSI7czoxNToiQWlycG9ydCBTaHV0dGxlIjt9aToxMTthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTA6ImZhbCBmYS1wYXciO3M6NToidGl0bGUiO3M6MTI6IlBldCBGcmllbmRseSI7fWk6MTI7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE1OiJmYWwgZmEtdXRlbnNpbHMiO3M6NToidGl0bGUiO3M6MTc6IlJlc3RhdXJhbnQgSW5zaWRlIjt9aToxMzthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTc6ImZhbCBmYS13aGVlbGNoYWlyIjtzOjU6InRpdGxlIjtzOjE5OiJXaGVlbGNoYWlyIEZyaWVuZGx5Ijt9fX1pOjE0O2E6Mzp7czoyOiJpZCI7aToxNDtzOjQ6Im5hbWUiO3M6MTk6IlByb3BlcnR5IEZhY2lsaXRpZXMiO3M6ODoiZmVhdHVyZXMiO2E6ODp7aToxNTthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTE6ImZhbCBmYS13aWZpIjtzOjU6InRpdGxlIjtzOjk6IkZyZWUgV2lmaSI7fWk6MTY7YTozOntzOjI6ImlkIjtzOjI6IjE2IjtzOjEwOiJpY29uX2NsYXNzIjtzOjEzOiJmYWwgZmEtcm9ja2V0IjtzOjU6InRpdGxlIjtzOjIwOiJFbGV2YXRvciBpbiBidWlsZGluZyI7fWk6MTc7YTozOntzOjI6ImlkIjtzOjI6IjE3IjtzOjEwOiJpY29uX2NsYXNzIjtzOjE0OiJmYWwgZmEtcGFya2luZyI7czo1OiJ0aXRsZSI7czoxMjoiRnJlZSBQYXJraW5nIjt9aToxODthOjM6e3M6MjoiaWQiO3M6MjoiMTgiO3M6MTA6Imljb25fY2xhc3MiO3M6MTY6ImZhbCBmYS1zbm93Zmxha2UiO3M6NToidGl0bGUiO3M6MTU6IkFpciBDb25kaXRpb25lZCI7fWk6MTk7YTozOntzOjI6ImlkIjtzOjI6IjE5IjtzOjEwOiJpY29uX2NsYXNzIjtzOjEyOiJmYWwgZmEtcGxhbmUiO3M6NToidGl0bGUiO3M6MTU6IkFpcnBvcnQgU2h1dHRsZSI7fWk6MjA7YTozOntzOjI6ImlkIjtzOjI6IjIwIjtzOjEwOiJpY29uX2NsYXNzIjtzOjEwOiJmYWwgZmEtcGF3IjtzOjU6InRpdGxlIjtzOjEyOiJQZXQgRnJpZW5kbHkiO31pOjIxO2E6Mzp7czoyOiJpZCI7czoyOiIyMSI7czoxMDoiaWNvbl9jbGFzcyI7czoxNToiZmFsIGZhLXV0ZW5zaWxzIjtzOjU6InRpdGxlIjtzOjE3OiJSZXN0YXVyYW50IEluc2lkZSI7fWk6MjI7YTozOntzOjI6ImlkIjtzOjI6IjIyIjtzOjEwOiJpY29uX2NsYXNzIjtzOjE3OiJmYWwgZmEtd2hlZWxjaGFpciI7czo1OiJ0aXRsZSI7czoxOToiV2hlZWxjaGFpciBGcmllbmRseSI7fX19fQ==', 'YToxOntpOjA7czoyNToiUHg1VXktM29pcWFfZ3JhbmRsb2dvLnBuZyI7fQ==', '', '', '071-533140', 'butwal@siddharthahospitality.com', '', 1, 'Milanchwok,Butwal', 'Dhulikhel', 'Bagmati', 'Kavrepalanchok/Dhulikhel', 'Nepal', 'Bikash Bajgain', '+977-11-490884', 'info@sarathihotel.com', '', 'A relatively new establishment in the field of hospitality, located in the heart of Dhulikhel and 32 K.M. east from Kathmandu ', '<p>\r\n	asd</p>\r\n', '2021-07-16', 0, 3, '', '', 1, '', '', 0, 1, 0, '', '', '', '', 'asd', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3535.2813502183612!2d85.56600411502684!3d27.615801682830067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb09ac466da337%3A0xce7ebdd6103b890b!2sHotel%20Sarathi%20Pvt%20Ltd!5e0!3m2!1sen!2snp!4v1631516245231!5m2!1sen!2snp', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDEiO31pOjI7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDIiO31pOjM7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDMiO319', '', 'danger text', 'YTozOntpOjE7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAxIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjI7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAyIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjM7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAzIjtzOjY6ImFuc3dlciI7czowOiIiO319', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjg6IlBvbGljeSAxIjt9aToyO2E6MTp7czo1OiJ0aXRsZSI7czo4OiJQb2xpY3kgMiI7fWk6MzthOjE6e3M6NToidGl0bGUiO3M6ODoiUG9saWN5IDMiO319', '', '<p>\r\n	as</p>\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 3, 174, 'Hotel Siddhartha, Nepalgunj', 'Hotel Siddhartha, Nepalgunj', 'hotel-siddhartha-nepalgunj', 'hhP8DD', 'wySzE-flamingo.png', 'Cafe', 15, 'YToyOntpOjU7YTozOntzOjI6ImlkIjtpOjU7czo0OiJuYW1lIjtzOjE0OiJIb3RlbCBTZXJ2aWNlcyI7czo4OiJmZWF0dXJlcyI7YTo4OntpOjY7YTozOntzOjI6ImlkIjtzOjE6IjYiO3M6MTA6Imljb25fY2xhc3MiO3M6MTE6ImZhbCBmYS13aWZpIjtzOjU6InRpdGxlIjtzOjk6IkZyZWUgV2lmaSI7fWk6NzthOjM6e3M6MjoiaWQiO3M6MToiNyI7czoxMDoiaWNvbl9jbGFzcyI7czoxMzoiZmFsIGZhLXJvY2tldCI7czo1OiJ0aXRsZSI7czoyMDoiRWxldmF0b3IgaW4gYnVpbGRpbmciO31pOjg7YTozOntzOjI6ImlkIjtzOjE6IjgiO3M6MTA6Imljb25fY2xhc3MiO3M6MTQ6ImZhbCBmYS1wYXJraW5nIjtzOjU6InRpdGxlIjtzOjEyOiJGcmVlIFBhcmtpbmciO31pOjk7YTozOntzOjI6ImlkIjtzOjE6IjkiO3M6MTA6Imljb25fY2xhc3MiO3M6MTY6ImZhbCBmYS1zbm93Zmxha2UiO3M6NToidGl0bGUiO3M6MTU6IkFpciBDb25kaXRpb25lZCI7fWk6MTA7YTozOntzOjI6ImlkIjtzOjI6IjEwIjtzOjEwOiJpY29uX2NsYXNzIjtzOjEyOiJmYWwgZmEtcGxhbmUiO3M6NToidGl0bGUiO3M6MTU6IkFpcnBvcnQgU2h1dHRsZSI7fWk6MTE7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEwOiJmYWwgZmEtcGF3IjtzOjU6InRpdGxlIjtzOjEyOiJQZXQgRnJpZW5kbHkiO31pOjEyO2E6Mzp7czoyOiJpZCI7czoyOiIxMiI7czoxMDoiaWNvbl9jbGFzcyI7czoxNToiZmFsIGZhLXV0ZW5zaWxzIjtzOjU6InRpdGxlIjtzOjE3OiJSZXN0YXVyYW50IEluc2lkZSI7fWk6MTM7YTozOntzOjI6ImlkIjtzOjI6IjEzIjtzOjEwOiJpY29uX2NsYXNzIjtzOjE3OiJmYWwgZmEtd2hlZWxjaGFpciI7czo1OiJ0aXRsZSI7czoxOToiV2hlZWxjaGFpciBGcmllbmRseSI7fX19aToxNDthOjM6e3M6MjoiaWQiO2k6MTQ7czo0OiJuYW1lIjtzOjU6IkV4dHJhIjtzOjg6ImZlYXR1cmVzIjthOjg6e2k6MTU7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjExOiJmYWwgZmEtd2lmaSI7czo1OiJ0aXRsZSI7czo5OiJGcmVlIFdpZmkiO31pOjE2O2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMzoiZmFsIGZhLXJvY2tldCI7czo1OiJ0aXRsZSI7czoyMDoiRWxldmF0b3IgaW4gYnVpbGRpbmciO31pOjE3O2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNDoiZmFsIGZhLXBhcmtpbmciO3M6NToidGl0bGUiO3M6MTI6IkZyZWUgUGFya2luZyI7fWk6MTg7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE2OiJmYWwgZmEtc25vd2ZsYWtlIjtzOjU6InRpdGxlIjtzOjE1OiJBaXIgQ29uZGl0aW9uZWQiO31pOjE5O2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMjoiZmFsIGZhLXBsYW5lIjtzOjU6InRpdGxlIjtzOjE1OiJBaXJwb3J0IFNodXR0bGUiO31pOjIwO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMDoiZmFsIGZhLXBhdyI7czo1OiJ0aXRsZSI7czoxMjoiUGV0IEZyaWVuZGx5Ijt9aToyMTthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTU6ImZhbCBmYS11dGVuc2lscyI7czo1OiJ0aXRsZSI7czoxNzoiUmVzdGF1cmFudCBJbnNpZGUiO31pOjIyO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNzoiZmFsIGZhLXdoZWVsY2hhaXIiO3M6NToidGl0bGUiO3M6MTk6IldoZWVsY2hhaXIgRnJpZW5kbHkiO319fX0=', 'YToxOntpOjA7czoyNToiRWZ5Qk4tM29pcWFfZ3JhbmRsb2dvLnBuZyI7fQ==', '', '1qfIV-3oiqa_grandlogo.png', '+977-81-551200', 'hotelnpj@siddharthahospitality.com', '', 1, 'Nepalgunj, Banke', 'Butwal', 'Lumbini', 'Rupandehi/Bhairahawa', 'Nepal', 'Prakash Khanal', '9802668907', 'online@hoteldaflamingo.com', 'www.hoteldaflamingo.com', 'A prominent addition to the hospitality destination ideally situated in the prominent location of Yogikuti, Butwal.', '<p>\r\n	<span style=\"color: rgb(119, 119, 119); font-family: Poppins, sans-serif; font-size: 14px;\">as</span></p>\r\n', '2021-07-16', 0, 3, '', '', 1, '', '', 0, 1, 0, '', '', '', '', 'map', '', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDEiO31pOjI7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDIiO31pOjM7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDMiO319', '', '', 'YTozOntpOjE7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAxIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjI7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAyIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjM7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAzIjtzOjY6ImFuc3dlciI7czowOiIiO319', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjg6IlBvbGljeSAxIjt9aToyO2E6MTp7czo1OiJ0aXRsZSI7czo4OiJQb2xpY3kgMiI7fWk6MzthOjE6e3M6NToidGl0bGUiO3M6ODoiUG9saWN5IDMiO319', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 5, 172, 'Hotel Siddhartha, Tikapur', 'Hotel Siddhartha, Tikapur', 'hotel-siddhartha-tikapur', '2Nbuos', 'vCxyr-logo.jpg', 'Hotel & Resort', 25, 'YToyOntpOjU7YTozOntzOjI6ImlkIjtpOjU7czo0OiJuYW1lIjtzOjE0OiJIb3RlbCBTZXJ2aWNlcyI7czo4OiJmZWF0dXJlcyI7YTo4OntpOjY7YTozOntzOjI6ImlkIjtzOjE6IjYiO3M6MTA6Imljb25fY2xhc3MiO3M6MTE6ImZhbCBmYS13aWZpIjtzOjU6InRpdGxlIjtzOjk6IkZyZWUgV2lmaSI7fWk6NzthOjM6e3M6MjoiaWQiO3M6MToiNyI7czoxMDoiaWNvbl9jbGFzcyI7czoxMzoiZmFsIGZhLXJvY2tldCI7czo1OiJ0aXRsZSI7czoyMDoiRWxldmF0b3IgaW4gYnVpbGRpbmciO31pOjg7YTozOntzOjI6ImlkIjtzOjE6IjgiO3M6MTA6Imljb25fY2xhc3MiO3M6MTQ6ImZhbCBmYS1wYXJraW5nIjtzOjU6InRpdGxlIjtzOjEyOiJGcmVlIFBhcmtpbmciO31pOjk7YTozOntzOjI6ImlkIjtzOjE6IjkiO3M6MTA6Imljb25fY2xhc3MiO3M6MTY6ImZhbCBmYS1zbm93Zmxha2UiO3M6NToidGl0bGUiO3M6MTU6IkFpciBDb25kaXRpb25lZCI7fWk6MTA7YTozOntzOjI6ImlkIjtzOjI6IjEwIjtzOjEwOiJpY29uX2NsYXNzIjtzOjEyOiJmYWwgZmEtcGxhbmUiO3M6NToidGl0bGUiO3M6MTU6IkFpcnBvcnQgU2h1dHRsZSI7fWk6MTE7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEwOiJmYWwgZmEtcGF3IjtzOjU6InRpdGxlIjtzOjEyOiJQZXQgRnJpZW5kbHkiO31pOjEyO2E6Mzp7czoyOiJpZCI7czoyOiIxMiI7czoxMDoiaWNvbl9jbGFzcyI7czoxNToiZmFsIGZhLXV0ZW5zaWxzIjtzOjU6InRpdGxlIjtzOjE3OiJSZXN0YXVyYW50IEluc2lkZSI7fWk6MTM7YTozOntzOjI6ImlkIjtzOjI6IjEzIjtzOjEwOiJpY29uX2NsYXNzIjtzOjE3OiJmYWwgZmEtd2hlZWxjaGFpciI7czo1OiJ0aXRsZSI7czoxOToiV2hlZWxjaGFpciBGcmllbmRseSI7fX19aToxNDthOjM6e3M6MjoiaWQiO2k6MTQ7czo0OiJuYW1lIjtzOjU6IkV4dHJhIjtzOjg6ImZlYXR1cmVzIjthOjg6e2k6MTU7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjExOiJmYWwgZmEtd2lmaSI7czo1OiJ0aXRsZSI7czo5OiJGcmVlIFdpZmkiO31pOjE2O2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMzoiZmFsIGZhLXJvY2tldCI7czo1OiJ0aXRsZSI7czoyMDoiRWxldmF0b3IgaW4gYnVpbGRpbmciO31pOjE3O2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNDoiZmFsIGZhLXBhcmtpbmciO3M6NToidGl0bGUiO3M6MTI6IkZyZWUgUGFya2luZyI7fWk6MTg7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE2OiJmYWwgZmEtc25vd2ZsYWtlIjtzOjU6InRpdGxlIjtzOjE1OiJBaXIgQ29uZGl0aW9uZWQiO31pOjE5O2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMjoiZmFsIGZhLXBsYW5lIjtzOjU6InRpdGxlIjtzOjE1OiJBaXJwb3J0IFNodXR0bGUiO31pOjIwO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMDoiZmFsIGZhLXBhdyI7czo1OiJ0aXRsZSI7czoxMjoiUGV0IEZyaWVuZGx5Ijt9aToyMTthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTU6ImZhbCBmYS11dGVuc2lscyI7czo1OiJ0aXRsZSI7czoxNzoiUmVzdGF1cmFudCBJbnNpZGUiO31pOjIyO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNzoiZmFsIGZhLXdoZWVsY2hhaXIiO3M6NToidGl0bGUiO3M6MTk6IldoZWVsY2hhaXIgRnJpZW5kbHkiO319fX0=', 'YTowOnt9', '', 'pzQyH-rectangle_6.jpg', '091-560777', 'tika@siddharthahsopitality.com', '', 0, 'Tikapur,Kailali', 'pokhara', 'Gandaki', 'Kaski/Pokhara', 'Nepal', 'Prakash Karki', ' +977 61 420077', 'info@cultureresortpokhara.com', 'www.cultureresortpokhara.com', 'Ringed by verdant green hills on the side of Fewa lake, Its an amazing place infused with traditional element and blended with modern comfort.', '<p style=\"text-align: center; \">\r\n	<font color=\"#151515\" face=\"Poppins, sans-serif\"><span style=\"font-size: 15px;\">asd</span></font></p>\r\n', '2021-07-16', 0, 3, '', '', 1, '', '', 0, 1, 0, '', '', '', '', 'map', '', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDEiO31pOjI7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDIiO31pOjM7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDMiO319', '', '', 'YTozOntpOjE7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAxIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjI7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAyIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjM7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAzIjtzOjY6ImFuc3dlciI7czowOiIiO319', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjg6IlBvbGljeSAxIjt9aToyO2E6MTp7czo1OiJ0aXRsZSI7czo4OiJQb2xpY3kgMiI7fWk6MzthOjE6e3M6NToidGl0bGUiO3M6ODoiUG9saWN5IDMiO319', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 4, 171, 'Siddhartha River Side Resort, Chumlingtar', 'Siddhartha River Side Resort, Chumlingtar', 'siddhartha-river-side-resort-chumlingtar', 'YDMIi7', 'BXGGC-logo.jpg', 'Cafe', 12, 'YToyOntpOjU7YTozOntzOjI6ImlkIjtpOjU7czo0OiJuYW1lIjtzOjE0OiJIb3RlbCBTZXJ2aWNlcyI7czo4OiJmZWF0dXJlcyI7YTo4OntpOjY7YTozOntzOjI6ImlkIjtzOjE6IjYiO3M6MTA6Imljb25fY2xhc3MiO3M6MTE6ImZhbCBmYS13aWZpIjtzOjU6InRpdGxlIjtzOjk6IkZyZWUgV2lmaSI7fWk6NzthOjM6e3M6MjoiaWQiO3M6MToiNyI7czoxMDoiaWNvbl9jbGFzcyI7czoxMzoiZmFsIGZhLXJvY2tldCI7czo1OiJ0aXRsZSI7czoyMDoiRWxldmF0b3IgaW4gYnVpbGRpbmciO31pOjg7YTozOntzOjI6ImlkIjtzOjE6IjgiO3M6MTA6Imljb25fY2xhc3MiO3M6MTQ6ImZhbCBmYS1wYXJraW5nIjtzOjU6InRpdGxlIjtzOjEyOiJGcmVlIFBhcmtpbmciO31pOjk7YTozOntzOjI6ImlkIjtzOjE6IjkiO3M6MTA6Imljb25fY2xhc3MiO3M6MTY6ImZhbCBmYS1zbm93Zmxha2UiO3M6NToidGl0bGUiO3M6MTU6IkFpciBDb25kaXRpb25lZCI7fWk6MTA7YTozOntzOjI6ImlkIjtzOjI6IjEwIjtzOjEwOiJpY29uX2NsYXNzIjtzOjEyOiJmYWwgZmEtcGxhbmUiO3M6NToidGl0bGUiO3M6MTU6IkFpcnBvcnQgU2h1dHRsZSI7fWk6MTE7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEwOiJmYWwgZmEtcGF3IjtzOjU6InRpdGxlIjtzOjEyOiJQZXQgRnJpZW5kbHkiO31pOjEyO2E6Mzp7czoyOiJpZCI7czoyOiIxMiI7czoxMDoiaWNvbl9jbGFzcyI7czoxNToiZmFsIGZhLXV0ZW5zaWxzIjtzOjU6InRpdGxlIjtzOjE3OiJSZXN0YXVyYW50IEluc2lkZSI7fWk6MTM7YTozOntzOjI6ImlkIjtzOjI6IjEzIjtzOjEwOiJpY29uX2NsYXNzIjtzOjE3OiJmYWwgZmEtd2hlZWxjaGFpciI7czo1OiJ0aXRsZSI7czoxOToiV2hlZWxjaGFpciBGcmllbmRseSI7fX19aToxNDthOjM6e3M6MjoiaWQiO2k6MTQ7czo0OiJuYW1lIjtzOjU6IkV4dHJhIjtzOjg6ImZlYXR1cmVzIjthOjg6e2k6MTU7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjExOiJmYWwgZmEtd2lmaSI7czo1OiJ0aXRsZSI7czo5OiJGcmVlIFdpZmkiO31pOjE2O2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMzoiZmFsIGZhLXJvY2tldCI7czo1OiJ0aXRsZSI7czoyMDoiRWxldmF0b3IgaW4gYnVpbGRpbmciO31pOjE3O2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNDoiZmFsIGZhLXBhcmtpbmciO3M6NToidGl0bGUiO3M6MTI6IkZyZWUgUGFya2luZyI7fWk6MTg7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE2OiJmYWwgZmEtc25vd2ZsYWtlIjtzOjU6InRpdGxlIjtzOjE1OiJBaXIgQ29uZGl0aW9uZWQiO31pOjE5O2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMjoiZmFsIGZhLXBsYW5lIjtzOjU6InRpdGxlIjtzOjE1OiJBaXJwb3J0IFNodXR0bGUiO31pOjIwO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMDoiZmFsIGZhLXBhdyI7czo1OiJ0aXRsZSI7czoxMjoiUGV0IEZyaWVuZGx5Ijt9aToyMTthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTU6ImZhbCBmYS11dGVuc2lscyI7czo1OiJ0aXRsZSI7czoxNzoiUmVzdGF1cmFudCBJbnNpZGUiO31pOjIyO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNzoiZmFsIGZhLXdoZWVsY2hhaXIiO3M6NToidGl0bGUiO3M6MTk6IldoZWVsY2hhaXIgRnJpZW5kbHkiO319fX0=', 'YToxOntpOjA7czoyNToiYTI3TXMtM29pcWFfZ3JhbmRsb2dvLnBuZyI7fQ==', '', 'V4Yo3-3oiqa_grandlogo.png', '+9779851176325', 'chumlingtar@siddharthahospitality.com', '', 0, 'Chumlingtar,Chitwan', 'Kohalpur', 'Bheri', 'Banke/Nepalgunj', 'Nepal', 'Sanjay Shrestha', '+977 081 542077', 'info@hotelmaxx.com.np', 'www.hotelmaxx.com.np', 'A business Class Hotel with 4 star facilities in Kohalpur offering the best in modern amenities with traditional Nepalese hospitality', '<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 15px; font-size: 16px; font-family: Muli, sans-serif; color: rgb(122, 126, 154);\">\r\n	as</p>\r\n', '2021-07-16', 0, 3, '', '', 1, '', '', 0, 1, 0, '', '', '', '', 'map', '', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDEiO31pOjI7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDIiO31pOjM7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDMiO319', '', '', 'YTozOntpOjE7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAxIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjI7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAyIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjM7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAzIjtzOjY6ImFuc3dlciI7czowOiIiO319', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjg6IlBvbGljeSAxIjt9aToyO2E6MTp7czo1OiJ0aXRsZSI7czo4OiJQb2xpY3kgMiI7fWk6MzthOjE6e3M6NToidGl0bGUiO3M6ODoiUG9saWN5IDMiO319', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 5, 168, 'Siddhartha Boutique Hotel, Boudha', 'Siddhartha Boutique Hotel, Boudha', 'siddhartha-boutique-hotel-boudha', '9n2T4c', 'rd4g6-logo.jpg', '', 10, 'YToyOntpOjU7YTozOntzOjI6ImlkIjtpOjU7czo0OiJuYW1lIjtzOjE0OiJIb3RlbCBTZXJ2aWNlcyI7czo4OiJmZWF0dXJlcyI7YTo4OntpOjY7YTozOntzOjI6ImlkIjtzOjE6IjYiO3M6MTA6Imljb25fY2xhc3MiO3M6MTE6ImZhbCBmYS13aWZpIjtzOjU6InRpdGxlIjtzOjk6IkZyZWUgV2lmaSI7fWk6NzthOjM6e3M6MjoiaWQiO3M6MToiNyI7czoxMDoiaWNvbl9jbGFzcyI7czoxMzoiZmFsIGZhLXJvY2tldCI7czo1OiJ0aXRsZSI7czoyMDoiRWxldmF0b3IgaW4gYnVpbGRpbmciO31pOjg7YTozOntzOjI6ImlkIjtzOjE6IjgiO3M6MTA6Imljb25fY2xhc3MiO3M6MTQ6ImZhbCBmYS1wYXJraW5nIjtzOjU6InRpdGxlIjtzOjEyOiJGcmVlIFBhcmtpbmciO31pOjk7YTozOntzOjI6ImlkIjtzOjE6IjkiO3M6MTA6Imljb25fY2xhc3MiO3M6MTY6ImZhbCBmYS1zbm93Zmxha2UiO3M6NToidGl0bGUiO3M6MTU6IkFpciBDb25kaXRpb25lZCI7fWk6MTA7YTozOntzOjI6ImlkIjtzOjI6IjEwIjtzOjEwOiJpY29uX2NsYXNzIjtzOjEyOiJmYWwgZmEtcGxhbmUiO3M6NToidGl0bGUiO3M6MTU6IkFpcnBvcnQgU2h1dHRsZSI7fWk6MTE7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEwOiJmYWwgZmEtcGF3IjtzOjU6InRpdGxlIjtzOjEyOiJQZXQgRnJpZW5kbHkiO31pOjEyO2E6Mzp7czoyOiJpZCI7czoyOiIxMiI7czoxMDoiaWNvbl9jbGFzcyI7czoxNToiZmFsIGZhLXV0ZW5zaWxzIjtzOjU6InRpdGxlIjtzOjE3OiJSZXN0YXVyYW50IEluc2lkZSI7fWk6MTM7YTozOntzOjI6ImlkIjtzOjI6IjEzIjtzOjEwOiJpY29uX2NsYXNzIjtzOjE3OiJmYWwgZmEtd2hlZWxjaGFpciI7czo1OiJ0aXRsZSI7czoxOToiV2hlZWxjaGFpciBGcmllbmRseSI7fX19aToxNDthOjM6e3M6MjoiaWQiO2k6MTQ7czo0OiJuYW1lIjtzOjU6IkV4dHJhIjtzOjg6ImZlYXR1cmVzIjthOjg6e2k6MTU7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjExOiJmYWwgZmEtd2lmaSI7czo1OiJ0aXRsZSI7czo5OiJGcmVlIFdpZmkiO31pOjE2O2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMzoiZmFsIGZhLXJvY2tldCI7czo1OiJ0aXRsZSI7czoyMDoiRWxldmF0b3IgaW4gYnVpbGRpbmciO31pOjE3O2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNDoiZmFsIGZhLXBhcmtpbmciO3M6NToidGl0bGUiO3M6MTI6IkZyZWUgUGFya2luZyI7fWk6MTg7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE2OiJmYWwgZmEtc25vd2ZsYWtlIjtzOjU6InRpdGxlIjtzOjE1OiJBaXIgQ29uZGl0aW9uZWQiO31pOjE5O2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMjoiZmFsIGZhLXBsYW5lIjtzOjU6InRpdGxlIjtzOjE1OiJBaXJwb3J0IFNodXR0bGUiO31pOjIwO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMDoiZmFsIGZhLXBhdyI7czo1OiJ0aXRsZSI7czoxMjoiUGV0IEZyaWVuZGx5Ijt9aToyMTthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTU6ImZhbCBmYS11dGVuc2lscyI7czo1OiJ0aXRsZSI7czoxNzoiUmVzdGF1cmFudCBJbnNpZGUiO31pOjIyO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNzoiZmFsIGZhLXdoZWVsY2hhaXIiO3M6NToidGl0bGUiO3M6MTk6IldoZWVsY2hhaXIgRnJpZW5kbHkiO319fX0=', 'YTowOnt9', '', 'k6P2p-grid5.jpg', '01-4820071, +9779851326963', 'sales.boudha@siddharthahospitality.com', '', 0, 'Boudha, Simaltar, Kathmandu', 'Banke', 'Bheri', 'Banke/Nepalgunj', 'Nepal', 'Yub Raj', ' 081410140', 'info@hotelcentralplaza.com', 'www.hotelcentralplaza.com', 'Five star hotel in Kohalpur. Best for every sort of guests; be it holidays or destination wedding, business guests or someone on the way to Kailash', '', '2021-07-18', 0, 3, '', '', 1, '', '', 0, 1, 0, '', '', '', '', '', '', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDEiO31pOjI7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDIiO31pOjM7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDMiO319', '', '', 'YTozOntpOjE7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAxIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjI7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAyIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjM7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAzIjtzOjY6ImFuc3dlciI7czowOiIiO319', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjg6IlBvbGljeSAxIjt9aToyO2E6MTp7czo1OiJ0aXRsZSI7czo4OiJQb2xpY3kgMiI7fWk6MzthOjE6e3M6NToidGl0bGUiO3M6ODoiUG9saWN5IDMiO319', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 5, 163, 'Siddhartha Hotel Grand City, Birtamode', 'Siddhartha Hotel Grand City, Birtamode', 'siddhartha-hotel-grand-city-birtamode', '4dLW7d', 'ln6Ok-d7sut_logo_himalaya.png', 'Restaurant', 32, 'YToyOntpOjU7YTozOntzOjI6ImlkIjtpOjU7czo0OiJuYW1lIjtzOjE0OiJIb3RlbCBTZXJ2aWNlcyI7czo4OiJmZWF0dXJlcyI7YTo4OntpOjY7YTozOntzOjI6ImlkIjtzOjE6IjYiO3M6MTA6Imljb25fY2xhc3MiO3M6MTE6ImZhbCBmYS13aWZpIjtzOjU6InRpdGxlIjtzOjk6IkZyZWUgV2lmaSI7fWk6NzthOjM6e3M6MjoiaWQiO3M6MToiNyI7czoxMDoiaWNvbl9jbGFzcyI7czoxMzoiZmFsIGZhLXJvY2tldCI7czo1OiJ0aXRsZSI7czoyMDoiRWxldmF0b3IgaW4gYnVpbGRpbmciO31pOjg7YTozOntzOjI6ImlkIjtzOjE6IjgiO3M6MTA6Imljb25fY2xhc3MiO3M6MTQ6ImZhbCBmYS1wYXJraW5nIjtzOjU6InRpdGxlIjtzOjEyOiJGcmVlIFBhcmtpbmciO31pOjk7YTozOntzOjI6ImlkIjtzOjE6IjkiO3M6MTA6Imljb25fY2xhc3MiO3M6MTY6ImZhbCBmYS1zbm93Zmxha2UiO3M6NToidGl0bGUiO3M6MTU6IkFpciBDb25kaXRpb25lZCI7fWk6MTA7YTozOntzOjI6ImlkIjtzOjI6IjEwIjtzOjEwOiJpY29uX2NsYXNzIjtzOjEyOiJmYWwgZmEtcGxhbmUiO3M6NToidGl0bGUiO3M6MTU6IkFpcnBvcnQgU2h1dHRsZSI7fWk6MTE7YTozOntzOjI6ImlkIjtzOjI6IjExIjtzOjEwOiJpY29uX2NsYXNzIjtzOjEwOiJmYWwgZmEtcGF3IjtzOjU6InRpdGxlIjtzOjEyOiJQZXQgRnJpZW5kbHkiO31pOjEyO2E6Mzp7czoyOiJpZCI7czoyOiIxMiI7czoxMDoiaWNvbl9jbGFzcyI7czoxNToiZmFsIGZhLXV0ZW5zaWxzIjtzOjU6InRpdGxlIjtzOjE3OiJSZXN0YXVyYW50IEluc2lkZSI7fWk6MTM7YTozOntzOjI6ImlkIjtzOjI6IjEzIjtzOjEwOiJpY29uX2NsYXNzIjtzOjE3OiJmYWwgZmEtd2hlZWxjaGFpciI7czo1OiJ0aXRsZSI7czoxOToiV2hlZWxjaGFpciBGcmllbmRseSI7fX19aToxNDthOjM6e3M6MjoiaWQiO2k6MTQ7czo0OiJuYW1lIjtzOjU6IkV4dHJhIjtzOjg6ImZlYXR1cmVzIjthOjg6e2k6MTU7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjExOiJmYWwgZmEtd2lmaSI7czo1OiJ0aXRsZSI7czo5OiJGcmVlIFdpZmkiO31pOjE2O2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMzoiZmFsIGZhLXJvY2tldCI7czo1OiJ0aXRsZSI7czoyMDoiRWxldmF0b3IgaW4gYnVpbGRpbmciO31pOjE3O2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNDoiZmFsIGZhLXBhcmtpbmciO3M6NToidGl0bGUiO3M6MTI6IkZyZWUgUGFya2luZyI7fWk6MTg7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE2OiJmYWwgZmEtc25vd2ZsYWtlIjtzOjU6InRpdGxlIjtzOjE1OiJBaXIgQ29uZGl0aW9uZWQiO31pOjE5O2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMjoiZmFsIGZhLXBsYW5lIjtzOjU6InRpdGxlIjtzOjE1OiJBaXJwb3J0IFNodXR0bGUiO31pOjIwO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMDoiZmFsIGZhLXBhdyI7czo1OiJ0aXRsZSI7czoxMjoiUGV0IEZyaWVuZGx5Ijt9aToyMTthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTU6ImZhbCBmYS11dGVuc2lscyI7czo1OiJ0aXRsZSI7czoxNzoiUmVzdGF1cmFudCBJbnNpZGUiO31pOjIyO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNzoiZmFsIGZhLXdoZWVsY2hhaXIiO3M6NToidGl0bGUiO3M6MTk6IldoZWVsY2hhaXIgRnJpZW5kbHkiO319fX0=', 'YToxOntpOjA7czoyNToiN2hFVkEtM29pcWFfZ3JhbmRsb2dvLnBuZyI7fQ==', '', '37Swp-grid4.jpg', '+977-23-590517', 'grandcity@siddharthahospitality.com', '', 1, 'Ujyalo Ekata Tol, Birtamode-4, Jhapa', 'Kupondole', 'Bagmati', 'Lalitpur/Patan', 'Nepal', 'Narayan Wagle', '9851139592', 'fom@hotelhimalaya.com.np', ' http://hotelhimalaya.com.np/', 'Situated in the epicenter of Kathmandu valley, offering great value for money with superb rooms and a wonderful dining experience. Come and stay with us and allow us to make you feel at home with true Nepalese hospitability!\r\n', '', '2021-08-25', 1, 1, '', '', 1, '', '', 0, 1, 0, '', '', '', '', '', '', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDEiO31pOjI7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDIiO31pOjM7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDMiO319', '', '', 'YTozOntpOjE7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAxIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjI7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAyIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjM7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAzIjtzOjY6ImFuc3dlciI7czowOiIiO319', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjg6IlBvbGljeSAxIjt9aToyO2E6MTp7czo1OiJ0aXRsZSI7czo4OiJQb2xpY3kgMiI7fWk6MzthOjE6e3M6NToidGl0bGUiO3M6ODoiUG9saWN5IDMiO319', '', '', '', '', '', '', '23', '', '', 'Yes', '', '', '', '', '', '', ''),
(7, 4, 162, 'Siddhartha Hotel New Anand, Mahendranagar', 'Siddhartha Hotel New Anand, Mahendranagar', 'siddhartha-hotel-new-anand-mahendranagar', 'awT6Zw', '', 'Hotel & Resort', 31, 'YToyOntpOjU7YTozOntzOjI6ImlkIjtpOjU7czo0OiJuYW1lIjtzOjE0OiJIb3RlbCBTZXJ2aWNlcyI7czo4OiJmZWF0dXJlcyI7YTo4OntpOjY7YTozOntzOjI6ImlkIjtzOjE6IjYiO3M6MTA6Imljb25fY2xhc3MiO3M6MTE6ImZhbCBmYS13aWZpIjtzOjU6InRpdGxlIjtzOjk6IkZyZWUgV2lmaSI7fWk6NzthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTM6ImZhbCBmYS1yb2NrZXQiO3M6NToidGl0bGUiO3M6MjA6IkVsZXZhdG9yIGluIGJ1aWxkaW5nIjt9aTo4O2E6Mzp7czoyOiJpZCI7czoxOiI4IjtzOjEwOiJpY29uX2NsYXNzIjtzOjE0OiJmYWwgZmEtcGFya2luZyI7czo1OiJ0aXRsZSI7czoxMjoiRnJlZSBQYXJraW5nIjt9aTo5O2E6Mzp7czoyOiJpZCI7czoxOiI5IjtzOjEwOiJpY29uX2NsYXNzIjtzOjE2OiJmYWwgZmEtc25vd2ZsYWtlIjtzOjU6InRpdGxlIjtzOjE1OiJBaXIgQ29uZGl0aW9uZWQiO31pOjEwO2E6Mzp7czoyOiJpZCI7czoyOiIxMCI7czoxMDoiaWNvbl9jbGFzcyI7czoxMjoiZmFsIGZhLXBsYW5lIjtzOjU6InRpdGxlIjtzOjE1OiJBaXJwb3J0IFNodXR0bGUiO31pOjExO2E6Mzp7czoyOiJpZCI7czoyOiIxMSI7czoxMDoiaWNvbl9jbGFzcyI7czoxMDoiZmFsIGZhLXBhdyI7czo1OiJ0aXRsZSI7czoxMjoiUGV0IEZyaWVuZGx5Ijt9aToxMjthOjM6e3M6MjoiaWQiO3M6MjoiMTIiO3M6MTA6Imljb25fY2xhc3MiO3M6MTU6ImZhbCBmYS11dGVuc2lscyI7czo1OiJ0aXRsZSI7czoxNzoiUmVzdGF1cmFudCBJbnNpZGUiO31pOjEzO2E6Mzp7czoyOiJpZCI7czoyOiIxMyI7czoxMDoiaWNvbl9jbGFzcyI7czoxNzoiZmFsIGZhLXdoZWVsY2hhaXIiO3M6NToidGl0bGUiO3M6MTk6IldoZWVsY2hhaXIgRnJpZW5kbHkiO319fWk6MTQ7YTozOntzOjI6ImlkIjtpOjE0O3M6NDoibmFtZSI7czowOiIiO3M6ODoiZmVhdHVyZXMiO2E6ODp7aToxNTthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTE6ImZhbCBmYS13aWZpIjtzOjU6InRpdGxlIjtzOjk6IkZyZWUgV2lmaSI7fWk6MTY7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEzOiJmYWwgZmEtcm9ja2V0IjtzOjU6InRpdGxlIjtzOjIwOiJFbGV2YXRvciBpbiBidWlsZGluZyI7fWk6MTc7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE0OiJmYWwgZmEtcGFya2luZyI7czo1OiJ0aXRsZSI7czoxMjoiRnJlZSBQYXJraW5nIjt9aToxODthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTY6ImZhbCBmYS1zbm93Zmxha2UiO3M6NToidGl0bGUiO3M6MTU6IkFpciBDb25kaXRpb25lZCI7fWk6MTk7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEyOiJmYWwgZmEtcGxhbmUiO3M6NToidGl0bGUiO3M6MTU6IkFpcnBvcnQgU2h1dHRsZSI7fWk6MjA7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEwOiJmYWwgZmEtcGF3IjtzOjU6InRpdGxlIjtzOjEyOiJQZXQgRnJpZW5kbHkiO31pOjIxO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNToiZmFsIGZhLXV0ZW5zaWxzIjtzOjU6InRpdGxlIjtzOjE3OiJSZXN0YXVyYW50IEluc2lkZSI7fWk6MjI7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE3OiJmYWwgZmEtd2hlZWxjaGFpciI7czo1OiJ0aXRsZSI7czoxOToiV2hlZWxjaGFpciBGcmllbmRseSI7fX19fQ==', 'YTowOnt9', '', 'CLqq7-grid3.jpg', '+977 099-521693, 9858750693', 'anand@siddharthahospitality.com', '', 1, 'Mahendranagar,Kanchanpur', 'Kathmandu', 'Bagmati', 'Kathmandu', 'Nepal', 'Rojin Sapkota', '+977-1-4451212', 'info@gokarna.net', 'https://gokarna.com', 'Gokarna Forest Resort offers accommodation with breathtaking views of the Forest, a protected sanctuary that once used to be a private hunting ground for the former royals of Nepal.', '', '2021-08-26', 1, 3, '', '', 1, '', '', 0, 1, 0, '', '', '', '', '', '', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDEiO31pOjI7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDIiO31pOjM7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDMiO319', '', '', 'YTozOntpOjE7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAxIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjI7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAyIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjM7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAzIjtzOjY6ImFuc3dlciI7czowOiIiO319', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjg6IlBvbGljeSAxIjt9aToyO2E6MTp7czo1OiJ0aXRsZSI7czo4OiJQb2xpY3kgMiI7fWk6MzthOjE6e3M6NToidGl0bGUiO3M6ODoiUG9saWN5IDMiO319', '', '', '', '', '', '', '12', '', '', 'Yes', '', '', '', '', '', '', ''),
(11, 5, 161, 'Siddhartha Sunny Resort, Surkhet', 'Siddhartha Sunny Resort, Surkhet', 'siddhartha-sunny-resort-surkhet', '3vdU4t', '', '', 37, 'YToyOntpOjU7YTozOntzOjI6ImlkIjtpOjU7czo0OiJuYW1lIjtzOjA6IiI7czo4OiJmZWF0dXJlcyI7YTo4OntpOjY7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjExOiJmYWwgZmEtd2lmaSI7czo1OiJ0aXRsZSI7czo5OiJGcmVlIFdpZmkiO31pOjc7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEzOiJmYWwgZmEtcm9ja2V0IjtzOjU6InRpdGxlIjtzOjIwOiJFbGV2YXRvciBpbiBidWlsZGluZyI7fWk6ODthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTQ6ImZhbCBmYS1wYXJraW5nIjtzOjU6InRpdGxlIjtzOjEyOiJGcmVlIFBhcmtpbmciO31pOjk7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE2OiJmYWwgZmEtc25vd2ZsYWtlIjtzOjU6InRpdGxlIjtzOjE1OiJBaXIgQ29uZGl0aW9uZWQiO31pOjEwO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMjoiZmFsIGZhLXBsYW5lIjtzOjU6InRpdGxlIjtzOjE1OiJBaXJwb3J0IFNodXR0bGUiO31pOjExO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMDoiZmFsIGZhLXBhdyI7czo1OiJ0aXRsZSI7czoxMjoiUGV0IEZyaWVuZGx5Ijt9aToxMjthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTU6ImZhbCBmYS11dGVuc2lscyI7czo1OiJ0aXRsZSI7czoxNzoiUmVzdGF1cmFudCBJbnNpZGUiO31pOjEzO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNzoiZmFsIGZhLXdoZWVsY2hhaXIiO3M6NToidGl0bGUiO3M6MTk6IldoZWVsY2hhaXIgRnJpZW5kbHkiO319fWk6MTQ7YTozOntzOjI6ImlkIjtpOjE0O3M6NDoibmFtZSI7czoxNDoiT3RoZXIgU2VydmljZXMiO3M6ODoiZmVhdHVyZXMiO2E6ODp7aToxNTthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTE6ImZhbCBmYS13aWZpIjtzOjU6InRpdGxlIjtzOjk6IkZyZWUgV2lmaSI7fWk6MTY7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEzOiJmYWwgZmEtcm9ja2V0IjtzOjU6InRpdGxlIjtzOjIwOiJFbGV2YXRvciBpbiBidWlsZGluZyI7fWk6MTc7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE0OiJmYWwgZmEtcGFya2luZyI7czo1OiJ0aXRsZSI7czoxMjoiRnJlZSBQYXJraW5nIjt9aToxODthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTY6ImZhbCBmYS1zbm93Zmxha2UiO3M6NToidGl0bGUiO3M6MTU6IkFpciBDb25kaXRpb25lZCI7fWk6MTk7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEyOiJmYWwgZmEtcGxhbmUiO3M6NToidGl0bGUiO3M6MTU6IkFpcnBvcnQgU2h1dHRsZSI7fWk6MjA7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEwOiJmYWwgZmEtcGF3IjtzOjU6InRpdGxlIjtzOjEyOiJQZXQgRnJpZW5kbHkiO31pOjIxO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNToiZmFsIGZhLXV0ZW5zaWxzIjtzOjU6InRpdGxlIjtzOjE3OiJSZXN0YXVyYW50IEluc2lkZSI7fWk6MjI7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE3OiJmYWwgZmEtd2hlZWxjaGFpciI7czo1OiJ0aXRsZSI7czoxOToiV2hlZWxjaGFpciBGcmllbmRseSI7fX19fQ==', 'YTowOnt9', '', '', '083-520922/520168', 'srsurkhet@siddharthahospitality.com', '', 0, 'srsurkhet@siddharthahospitality.com', '', '', '', 'Nepal', '', '', '', '', '', '', '2021-09-29', 0, 0, '', '', 0, '', '', 0, 0, 0, '', '', '', '', '', '', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDEiO31pOjI7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDIiO31pOjM7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDMiO319', '', '', 'YTozOntpOjE7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAxIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjI7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAyIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjM7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAzIjtzOjY6ImFuc3dlciI7czowOiIiO319', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjg6IlBvbGljeSAxIjt9aToyO2E6MTp7czo1OiJ0aXRsZSI7czo4OiJQb2xpY3kgMiI7fWk6MzthOjE6e3M6NToidGl0bGUiO3M6ODoiUG9saWN5IDMiO319', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(12, 5, 159, 'Siddhartha Resort, Chisapani', 'Siddhartha Resort, Chisapani', 'siddhartha-resort-chisapani', 'x2uulY', '', '', 38, 'YToyOntpOjU7YTozOntzOjI6ImlkIjtpOjU7czo0OiJuYW1lIjtzOjA6IiI7czo4OiJmZWF0dXJlcyI7YTo4OntpOjY7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjExOiJmYWwgZmEtd2lmaSI7czo1OiJ0aXRsZSI7czo5OiJGcmVlIFdpZmkiO31pOjc7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEzOiJmYWwgZmEtcm9ja2V0IjtzOjU6InRpdGxlIjtzOjIwOiJFbGV2YXRvciBpbiBidWlsZGluZyI7fWk6ODthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTQ6ImZhbCBmYS1wYXJraW5nIjtzOjU6InRpdGxlIjtzOjEyOiJGcmVlIFBhcmtpbmciO31pOjk7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE2OiJmYWwgZmEtc25vd2ZsYWtlIjtzOjU6InRpdGxlIjtzOjE1OiJBaXIgQ29uZGl0aW9uZWQiO31pOjEwO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMjoiZmFsIGZhLXBsYW5lIjtzOjU6InRpdGxlIjtzOjE1OiJBaXJwb3J0IFNodXR0bGUiO31pOjExO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMDoiZmFsIGZhLXBhdyI7czo1OiJ0aXRsZSI7czoxMjoiUGV0IEZyaWVuZGx5Ijt9aToxMjthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTU6ImZhbCBmYS11dGVuc2lscyI7czo1OiJ0aXRsZSI7czoxNzoiUmVzdGF1cmFudCBJbnNpZGUiO31pOjEzO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNzoiZmFsIGZhLXdoZWVsY2hhaXIiO3M6NToidGl0bGUiO3M6MTk6IldoZWVsY2hhaXIgRnJpZW5kbHkiO319fWk6MTQ7YTozOntzOjI6ImlkIjtpOjE0O3M6NDoibmFtZSI7czowOiIiO3M6ODoiZmVhdHVyZXMiO2E6ODp7aToxNTthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTE6ImZhbCBmYS13aWZpIjtzOjU6InRpdGxlIjtzOjk6IkZyZWUgV2lmaSI7fWk6MTY7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEzOiJmYWwgZmEtcm9ja2V0IjtzOjU6InRpdGxlIjtzOjIwOiJFbGV2YXRvciBpbiBidWlsZGluZyI7fWk6MTc7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE0OiJmYWwgZmEtcGFya2luZyI7czo1OiJ0aXRsZSI7czoxMjoiRnJlZSBQYXJraW5nIjt9aToxODthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTY6ImZhbCBmYS1zbm93Zmxha2UiO3M6NToidGl0bGUiO3M6MTU6IkFpciBDb25kaXRpb25lZCI7fWk6MTk7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEyOiJmYWwgZmEtcGxhbmUiO3M6NToidGl0bGUiO3M6MTU6IkFpcnBvcnQgU2h1dHRsZSI7fWk6MjA7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEwOiJmYWwgZmEtcGF3IjtzOjU6InRpdGxlIjtzOjEyOiJQZXQgRnJpZW5kbHkiO31pOjIxO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNToiZmFsIGZhLXV0ZW5zaWxzIjtzOjU6InRpdGxlIjtzOjE3OiJSZXN0YXVyYW50IEluc2lkZSI7fWk6MjI7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE3OiJmYWwgZmEtd2hlZWxjaGFpciI7czo1OiJ0aXRsZSI7czoxOToiV2hlZWxjaGFpciBGcmllbmRseSI7fX19fQ==', 'YToxOntpOjA7czoyNToiRFYzaVUtM29pcWFfZ3JhbmRsb2dvLnBuZyI7fQ==', '', '', '+977 091-414000', 'chisapani@siddharthahospitality.com', '', 1, 'Chisapani, Nepal', 'ktm', '', '', 'Nepal', 'Swarna Shakya', 'Swarna Shakya', 'swarna@longtail.info', '', '', '', '2021-09-29', 0, 3, '', '', 1, '', '', 0, 0, 0, '', '', '', '', '', '', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDEiO31pOjI7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDIiO31pOjM7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDMiO319', '', '', 'YTozOntpOjE7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAxIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjI7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAyIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjM7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAzIjtzOjY6ImFuc3dlciI7czowOiIiO319', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjg6IlBvbGljeSAxIjt9aToyO2E6MTp7czo1OiJ0aXRsZSI7czo4OiJQb2xpY3kgMiI7fWk6MzthOjE6e3M6NToidGl0bGUiO3M6ODoiUG9saWN5IDMiO319', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(13, 5, 158, 'Siddhartha Hotel Water Tower, Nuwakot', 'Siddhartha Hotel Water Tower, Nuwakot', 'siddhartha-hotel-water-tower-nuwakot', 'BJTXr3', '', '', 23, 'YToyOntpOjU7YTozOntzOjI6ImlkIjtpOjU7czo0OiJuYW1lIjtzOjA6IiI7czo4OiJmZWF0dXJlcyI7YTo4OntpOjY7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjExOiJmYWwgZmEtd2lmaSI7czo1OiJ0aXRsZSI7czo5OiJGcmVlIFdpZmkiO31pOjc7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEzOiJmYWwgZmEtcm9ja2V0IjtzOjU6InRpdGxlIjtzOjIwOiJFbGV2YXRvciBpbiBidWlsZGluZyI7fWk6ODthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTQ6ImZhbCBmYS1wYXJraW5nIjtzOjU6InRpdGxlIjtzOjEyOiJGcmVlIFBhcmtpbmciO31pOjk7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE2OiJmYWwgZmEtc25vd2ZsYWtlIjtzOjU6InRpdGxlIjtzOjE1OiJBaXIgQ29uZGl0aW9uZWQiO31pOjEwO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMjoiZmFsIGZhLXBsYW5lIjtzOjU6InRpdGxlIjtzOjE1OiJBaXJwb3J0IFNodXR0bGUiO31pOjExO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMDoiZmFsIGZhLXBhdyI7czo1OiJ0aXRsZSI7czoxMjoiUGV0IEZyaWVuZGx5Ijt9aToxMjthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTU6ImZhbCBmYS11dGVuc2lscyI7czo1OiJ0aXRsZSI7czoxNzoiUmVzdGF1cmFudCBJbnNpZGUiO31pOjEzO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNzoiZmFsIGZhLXdoZWVsY2hhaXIiO3M6NToidGl0bGUiO3M6MTk6IldoZWVsY2hhaXIgRnJpZW5kbHkiO319fWk6MTQ7YTozOntzOjI6ImlkIjtpOjE0O3M6NDoibmFtZSI7czowOiIiO3M6ODoiZmVhdHVyZXMiO2E6ODp7aToxNTthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTE6ImZhbCBmYS13aWZpIjtzOjU6InRpdGxlIjtzOjk6IkZyZWUgV2lmaSI7fWk6MTY7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEzOiJmYWwgZmEtcm9ja2V0IjtzOjU6InRpdGxlIjtzOjIwOiJFbGV2YXRvciBpbiBidWlsZGluZyI7fWk6MTc7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE0OiJmYWwgZmEtcGFya2luZyI7czo1OiJ0aXRsZSI7czoxMjoiRnJlZSBQYXJraW5nIjt9aToxODthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTY6ImZhbCBmYS1zbm93Zmxha2UiO3M6NToidGl0bGUiO3M6MTU6IkFpciBDb25kaXRpb25lZCI7fWk6MTk7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEyOiJmYWwgZmEtcGxhbmUiO3M6NToidGl0bGUiO3M6MTU6IkFpcnBvcnQgU2h1dHRsZSI7fWk6MjA7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEwOiJmYWwgZmEtcGF3IjtzOjU6InRpdGxlIjtzOjEyOiJQZXQgRnJpZW5kbHkiO31pOjIxO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNToiZmFsIGZhLXV0ZW5zaWxzIjtzOjU6InRpdGxlIjtzOjE3OiJSZXN0YXVyYW50IEluc2lkZSI7fWk6MjI7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE3OiJmYWwgZmEtd2hlZWxjaGFpciI7czo1OiJ0aXRsZSI7czoxOToiV2hlZWxjaGFpciBGcmllbmRseSI7fX19fQ==', 'YToxOntpOjA7czoyNToiYXhPb1ctM29pcWFfZ3JhbmRsb2dvLnBuZyI7fQ==', '', '', '+9779851334130', 'watertower@siddharthahospitality.com', '', 0, 'Battar,Nuwakot', '', '', '', 'Nepal', '', '', '', '', '', '', '2021-10-11', 0, 3, '', '', 1, '', '', 0, 0, 0, '', '', '', '', '', '', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDEiO31pOjI7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDIiO31pOjM7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDMiO319', '', '', 'YTozOntpOjE7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAxIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjI7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAyIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjM7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAzIjtzOjY6ImFuc3dlciI7czowOiIiO319', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjg6IlBvbGljeSAxIjt9aToyO2E6MTp7czo1OiJ0aXRsZSI7czo4OiJQb2xpY3kgMiI7fWk6MzthOjE6e3M6NToidGl0bGUiO3M6ODoiUG9saWN5IDMiO319', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(14, 5, 157, 'Siddhartha Resort, Chandrauta', 'Siddhartha Resort, Chandrauta', 'siddhartha-resort-chandrauta', 'hQLp8f', '', 'Hotel & Resort', 39, 'YToyOntpOjU7YTozOntzOjI6ImlkIjtpOjU7czo0OiJuYW1lIjtzOjA6IiI7czo4OiJmZWF0dXJlcyI7YTo4OntpOjY7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjExOiJmYWwgZmEtd2lmaSI7czo1OiJ0aXRsZSI7czo5OiJGcmVlIFdpZmkiO31pOjc7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEzOiJmYWwgZmEtcm9ja2V0IjtzOjU6InRpdGxlIjtzOjIwOiJFbGV2YXRvciBpbiBidWlsZGluZyI7fWk6ODthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTQ6ImZhbCBmYS1wYXJraW5nIjtzOjU6InRpdGxlIjtzOjEyOiJGcmVlIFBhcmtpbmciO31pOjk7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE2OiJmYWwgZmEtc25vd2ZsYWtlIjtzOjU6InRpdGxlIjtzOjE1OiJBaXIgQ29uZGl0aW9uZWQiO31pOjEwO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMjoiZmFsIGZhLXBsYW5lIjtzOjU6InRpdGxlIjtzOjE1OiJBaXJwb3J0IFNodXR0bGUiO31pOjExO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMDoiZmFsIGZhLXBhdyI7czo1OiJ0aXRsZSI7czoxMjoiUGV0IEZyaWVuZGx5Ijt9aToxMjthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTU6ImZhbCBmYS11dGVuc2lscyI7czo1OiJ0aXRsZSI7czoxNzoiUmVzdGF1cmFudCBJbnNpZGUiO31pOjEzO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNzoiZmFsIGZhLXdoZWVsY2hhaXIiO3M6NToidGl0bGUiO3M6MTk6IldoZWVsY2hhaXIgRnJpZW5kbHkiO319fWk6MTQ7YTozOntzOjI6ImlkIjtpOjE0O3M6NDoibmFtZSI7czowOiIiO3M6ODoiZmVhdHVyZXMiO2E6ODp7aToxNTthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTE6ImZhbCBmYS13aWZpIjtzOjU6InRpdGxlIjtzOjk6IkZyZWUgV2lmaSI7fWk6MTY7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEzOiJmYWwgZmEtcm9ja2V0IjtzOjU6InRpdGxlIjtzOjIwOiJFbGV2YXRvciBpbiBidWlsZGluZyI7fWk6MTc7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE0OiJmYWwgZmEtcGFya2luZyI7czo1OiJ0aXRsZSI7czoxMjoiRnJlZSBQYXJraW5nIjt9aToxODthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTY6ImZhbCBmYS1zbm93Zmxha2UiO3M6NToidGl0bGUiO3M6MTU6IkFpciBDb25kaXRpb25lZCI7fWk6MTk7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEyOiJmYWwgZmEtcGxhbmUiO3M6NToidGl0bGUiO3M6MTU6IkFpcnBvcnQgU2h1dHRsZSI7fWk6MjA7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEwOiJmYWwgZmEtcGF3IjtzOjU6InRpdGxlIjtzOjEyOiJQZXQgRnJpZW5kbHkiO31pOjIxO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNToiZmFsIGZhLXV0ZW5zaWxzIjtzOjU6InRpdGxlIjtzOjE3OiJSZXN0YXVyYW50IEluc2lkZSI7fWk6MjI7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE3OiJmYWwgZmEtd2hlZWxjaGFpciI7czo1OiJ0aXRsZSI7czoxOToiV2hlZWxjaGFpciBGcmllbmRseSI7fX19fQ==', 'YTowOnt9', '', '', '076-540698,9857055128', 'sales.chandrauta@siddharthahospitality.com', '', 1, 'Shivraj-2 Chandrauta', 'KTM', '', '', 'Nepal', 'ME', '9849', 'swarnashakya95@gmail.com', '', '', '', '2023-08-25', 1, 1, '', '', 1, '', '', 0, 1, 0, '', '', '', '', '', '', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDEiO31pOjI7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDIiO31pOjM7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDMiO319', '', '', 'YTozOntpOjE7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAxIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjI7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAyIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjM7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAzIjtzOjY6ImFuc3dlciI7czowOiIiO319', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjg6IlBvbGljeSAxIjt9aToyO2E6MTp7czo1OiJ0aXRsZSI7czo4OiJQb2xpY3kgMiI7fWk6MzthOjE6e3M6NToidGl0bGUiO3M6ODoiUG9saWN5IDMiO319', '', '', '', '', '', 'asd', '', '', '', '', '', '', '', '', '', '', 'SID_123'),
(17, 0, 157, 'Siddhartha Lumbini Green Resort', 'Siddhartha Lumbini Green Resort', 'siddhartha-lumbini-green-resort', 'b913D2', 'f8eLm-cresent.jpg', 'Cafe', 19, 'YToyOntpOjU7YTozOntzOjI6ImlkIjtpOjU7czo0OiJuYW1lIjtzOjE3OiJQcm9wZXJ0eSBTZXJ2aWNlcyI7czo4OiJmZWF0dXJlcyI7YTo4OntpOjY7YTozOntzOjI6ImlkIjtzOjE6IjYiO3M6MTA6Imljb25fY2xhc3MiO3M6MTE6ImZhbCBmYS13aWZpIjtzOjU6InRpdGxlIjtzOjk6IkZyZWUgV2lmaSI7fWk6NzthOjM6e3M6MjoiaWQiO3M6MToiNyI7czoxMDoiaWNvbl9jbGFzcyI7czoxMzoiZmFsIGZhLXJvY2tldCI7czo1OiJ0aXRsZSI7czoyMDoiRWxldmF0b3IgaW4gYnVpbGRpbmciO31pOjg7YTozOntzOjI6ImlkIjtzOjE6IjgiO3M6MTA6Imljb25fY2xhc3MiO3M6MTQ6ImZhbCBmYS1wYXJraW5nIjtzOjU6InRpdGxlIjtzOjEyOiJGcmVlIFBhcmtpbmciO31pOjk7YTozOntzOjI6ImlkIjtzOjE6IjkiO3M6MTA6Imljb25fY2xhc3MiO3M6MTY6ImZhbCBmYS1zbm93Zmxha2UiO3M6NToidGl0bGUiO3M6MTU6IkFpciBDb25kaXRpb25lZCI7fWk6MTA7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEyOiJmYWwgZmEtcGxhbmUiO3M6NToidGl0bGUiO3M6MTU6IkFpcnBvcnQgU2h1dHRsZSI7fWk6MTE7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEwOiJmYWwgZmEtcGF3IjtzOjU6InRpdGxlIjtzOjEyOiJQZXQgRnJpZW5kbHkiO31pOjEyO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNToiZmFsIGZhLXV0ZW5zaWxzIjtzOjU6InRpdGxlIjtzOjE3OiJSZXN0YXVyYW50IEluc2lkZSI7fWk6MTM7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE3OiJmYWwgZmEtd2hlZWxjaGFpciI7czo1OiJ0aXRsZSI7czoxOToiV2hlZWxjaGFpciBGcmllbmRseSI7fX19aToxNDthOjM6e3M6MjoiaWQiO2k6MTQ7czo0OiJuYW1lIjtzOjE0OiJPdGhlciBTZXJ2aWNlcyI7czo4OiJmZWF0dXJlcyI7YTo4OntpOjE1O2E6Mzp7czoyOiJpZCI7czoyOiIxNSI7czoxMDoiaWNvbl9jbGFzcyI7czoxMToiZmFsIGZhLXdpZmkiO3M6NToidGl0bGUiO3M6OToiRnJlZSBXaWZpIjt9aToxNjthOjM6e3M6MjoiaWQiO3M6MjoiMTYiO3M6MTA6Imljb25fY2xhc3MiO3M6MTM6ImZhbCBmYS1yb2NrZXQiO3M6NToidGl0bGUiO3M6MjA6IkVsZXZhdG9yIGluIGJ1aWxkaW5nIjt9aToxNzthOjM6e3M6MjoiaWQiO3M6MjoiMTciO3M6MTA6Imljb25fY2xhc3MiO3M6MTQ6ImZhbCBmYS1wYXJraW5nIjtzOjU6InRpdGxlIjtzOjEyOiJGcmVlIFBhcmtpbmciO31pOjE4O2E6Mzp7czoyOiJpZCI7czoyOiIxOCI7czoxMDoiaWNvbl9jbGFzcyI7czoxNjoiZmFsIGZhLXNub3dmbGFrZSI7czo1OiJ0aXRsZSI7czoxNToiQWlyIENvbmRpdGlvbmVkIjt9aToxOTthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTI6ImZhbCBmYS1wbGFuZSI7czo1OiJ0aXRsZSI7czoxNToiQWlycG9ydCBTaHV0dGxlIjt9aToyMDthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTA6ImZhbCBmYS1wYXciO3M6NToidGl0bGUiO3M6MTI6IlBldCBGcmllbmRseSI7fWk6MjE7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE1OiJmYWwgZmEtdXRlbnNpbHMiO3M6NToidGl0bGUiO3M6MTc6IlJlc3RhdXJhbnQgSW5zaWRlIjt9aToyMjthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTc6ImZhbCBmYS13aGVlbGNoYWlyIjtzOjU6InRpdGxlIjtzOjE5OiJXaGVlbGNoYWlyIEZyaWVuZGx5Ijt9fX19', 'YToxOntpOjA7czoyMToiSkUxbW0tcm9vbV9iYW5uZXIuanBnIjt9', '', '', '9861369900', 'sadsa@gmail.com', '', 0, 'lumbini', '', '', '', 'Nepal', '', '', '', '', '', '<div class=\"overview-one\">\r\n	<div class=\"row\">\r\n		<div class=\"col-lg-6 col-md-6 col-sm-12\">\r\n			<h4>\r\n				Overview</h4>\r\n			<p>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n		</div>\r\n		<div class=\"col-lg-6 col-md-6 col-sm-12\">\r\n			<div class=\"overview-img\">\r\n				<img src=\"template/nepalhotel/images/banner.jpg\" /></div>\r\n		</div>\r\n	</div>\r\n</div>\r\n', '2023-09-22', 1, 0, '', '', 1, '', '', 0, 1, 0, '', '', '', '', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56513.29302210564!2d85.2364743486328!3d27.71479099999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb18fd73ade555%3A0x2c5f331413ee6cd8!2sYatri%20Suites%20%26%20Spa%20P.%20Ltd.!5e0!3m2!1sen!2snp!4v1695808187398!5m2!1sen!2snp', '', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDEiO31pOjI7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDIiO31pOjM7YToxOntzOjU6InRpdGxlIjtzOjMwOiJjbGVhbmluZyBhbmQgc2FmZXR5IHByYWN0aWNlIDMiO319', '', '', 'YTozOntpOjE7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAxIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjI7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAyIjtzOjY6ImFuc3dlciI7czowOiIiO31pOjM7YToyOntzOjg6InF1ZXN0aW9uIjtzOjU6IkZBUSAzIjtzOjY6ImFuc3dlciI7czowOiIiO319', 'YTozOntpOjE7YToxOntzOjU6InRpdGxlIjtzOjg6IlBvbGljeSAxIjt9aToyO2E6MTp7czo1OiJ0aXRsZSI7czo4OiJQb2xpY3kgMiI7fWk6MzthOjE6e3M6NToidGl0bGUiO3M6ODoiUG9saWN5IDMiO319', '<div class=\"overview-one\">\r\n	<h4>\r\n		Fitness</h4>\r\n	<div class=\"room-outer\">\r\n		<div class=\"row feature-slider\">\r\n			<div class=\"col-md-3 col-sm-6 col-xs-12 mar-bottom-30\">\r\n				<div class=\"room-item\">\r\n					<div class=\"room-image\">\r\n						<img alt=\"image\" src=\"images/room-list/grid1.jpg\" /></div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-3 col-sm-6 col-xs-12 mar-bottom-30\">\r\n				<div class=\"room-item\">\r\n					<div class=\"room-image\">\r\n						<img alt=\"image\" src=\"images/room-list/grid2.jpg\" /></div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-3 col-sm-6 col-xs-12 mar-bottom-30\">\r\n				<div class=\"room-item\">\r\n					<div class=\"room-image\">\r\n						<img alt=\"image\" src=\"images/room-list/grid3.jpg\" /></div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-3 col-sm-6 col-xs-12 mar-bottom-30\">\r\n				<div class=\"room-item\">\r\n					<div class=\"room-image\">\r\n						<img alt=\"image\" src=\"images/room-list/grid4.jpg\" /></div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</div>\r\n', '<div class=\"overview-one\">\r\n	<h4>\r\n		Meeting Hall</h4>\r\n	<div class=\"row\">\r\n		<div class=\"col-lg-6 col-md-6 col-sm-12\">\r\n			<div class=\"overview-img\">\r\n				<img src=\"images/banner.jpg\" /></div>\r\n		</div>\r\n		<div class=\"col-lg-6 col-md-6 col-sm-12\">\r\n			<p>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,</p>\r\n			<p>\r\n				remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n		</div>\r\n	</div>\r\n</div>\r\n', '<div class=\"overview-one\">\r\n	<h4>\r\n		Weddings</h4>\r\n	<div class=\"room-outer\">\r\n		<div class=\"row feature-slider\">\r\n			<div class=\"col-md-3 col-sm-6 col-xs-12 mar-bottom-30\">\r\n				<div class=\"room-item\">\r\n					<div class=\"room-image\">\r\n						<img alt=\"image\" src=\"images/room-list/grid1.jpg\" /></div>\r\n					<div class=\"room-content\">\r\n						<div class=\"room-title\">\r\n							<h4>\r\n								<a href=\"#\">Siddhartha Lumbini Green Resort</a></h4>\r\n							<p>\r\n								Siddhartha Lumbini Green Resort located in land of charauta</p>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-3 col-sm-6 col-xs-12 mar-bottom-30\">\r\n				<div class=\"room-item\">\r\n					<div class=\"room-image\">\r\n						<img alt=\"image\" src=\"images/room-list/grid2.jpg\" /></div>\r\n					<div class=\"room-content\">\r\n						<div class=\"room-title\">\r\n							<h4>\r\n								Siddhartha Lumbini Green Resort</h4>\r\n							<p>\r\n								Siddhartha Lumbini Green Resort located in land of charauta</p>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-3 col-sm-6 col-xs-12 mar-bottom-30\">\r\n				<div class=\"room-item\">\r\n					<div class=\"room-image\">\r\n						<img alt=\"image\" src=\"images/room-list/grid3.jpg\" /></div>\r\n					<div class=\"room-content\">\r\n						<div class=\"room-title\">\r\n							<h4>\r\n								Siddhartha Hotel Grand City</h4>\r\n							<p>\r\n								This Hotel is located at the heart of bustling city of Birtamod in Jhapa</p>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-3 col-sm-6 col-xs-12 mar-bottom-30\">\r\n				<div class=\"room-item\">\r\n					<div class=\"room-image\">\r\n						<img alt=\"image\" src=\"images/room-list/grid4.jpg\" /></div>\r\n					<div class=\"room-content\">\r\n						<div class=\"room-title\">\r\n							<h4>\r\n								Siddhartha Hotel New Anand</h4>\r\n							<p>\r\n								Located in mahendra nagar of bhimdutta municipality in the far-western of Nepal</p>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</div>\r\n', '', '<div class=\"overview-one\">\r\n	<h4>\r\n		Restauarnt</h4>\r\n	<div class=\"row\">\r\n		<div class=\"col-lg-6 col-md-6 col-sm-12\">\r\n			<div class=\"overview-img\">\r\n				<img src=\"images/banner.jpg\" /></div>\r\n		</div>\r\n		<div class=\"col-lg-6 col-md-6 col-sm-12\">\r\n			<p>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,</p>\r\n			<p>\r\n				remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n		</div>\r\n	</div>\r\n</div>\r\n', 'asdasdasdasd', '', '', '', '', '', '', '', '', '', '', 'SID-test');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attractions`
--

CREATE TABLE `tbl_attractions` (
  `id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `sortorder` varchar(25) NOT NULL,
  `meta_keywords` tinytext CHARACTER SET utf8 NOT NULL,
  `meta_description` tinytext CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_attractions`
--

INSERT INTO `tbl_attractions` (`id`, `destination_id`, `title`, `slug`, `image`, `content`, `status`, `sortorder`, `meta_keywords`, `meta_description`) VALUES
(1, 14, 'Attraction 3', 'attraction-3', 'xAHaA-1.jpg', '<p>\r\n	asdasd</p>\r\n', 1, '3', '', ''),
(2, 14, 'Attration 2', 'attration-2', 'YKBSu-1.jpg', '<p>\r\n	dfdghhj</p>\r\n', 1, '2', '', ''),
(3, 14, 'Attraction 1', 'attraction-1', 'Ar6ZH-1.jpg', '<p>\r\n	asdsadasrhry</p>\r\n', 1, '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookinginfo`
--

CREATE TABLE `tbl_bookinginfo` (
  `id` int(11) NOT NULL,
  `pkg_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `subpkg_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fixed_date_id` int(11) NOT NULL,
  `trip_date` date NOT NULL,
  `trip_currency` varchar(10) NOT NULL,
  `date_rate` int(11) NOT NULL,
  `trip_pax` int(11) NOT NULL,
  `trip_flight` varchar(10) NOT NULL,
  `accesskey` varchar(20) NOT NULL,
  `person_title` varchar(10) NOT NULL,
  `person_fname` varchar(200) NOT NULL,
  `person_mname` varchar(100) NOT NULL,
  `person_lname` varchar(200) NOT NULL,
  `person_email` tinytext NOT NULL,
  `person_country` varchar(100) NOT NULL,
  `person_country_code` varchar(100) NOT NULL,
  `person_city` varchar(200) NOT NULL,
  `person_address` tinytext NOT NULL,
  `person_postal` varchar(30) NOT NULL,
  `person_phone` varchar(100) NOT NULL,
  `person_ctype` varchar(50) NOT NULL,
  `person_hear` varchar(100) NOT NULL,
  `person_comment` mediumtext NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `pay_type` varchar(50) NOT NULL,
  `pay_by` tinytext NOT NULL,
  `pay_amt` int(11) NOT NULL,
  `transaction_code` varchar(100) NOT NULL,
  `pan` varchar(255) NOT NULL,
  `hbl_invoiceNo` varchar(255) NOT NULL,
  `hbl_amount` varchar(255) NOT NULL,
  `tranRef` varchar(255) NOT NULL,
  `approvalCode` varchar(255) NOT NULL,
  `hbl_dateTime` varchar(50) NOT NULL,
  `statusofpayment` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(20) NOT NULL,
  `confirm_ip` varchar(20) NOT NULL,
  `confirm_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_bookinginfo`
--

INSERT INTO `tbl_bookinginfo` (`id`, `pkg_id`, `vendor_id`, `subpkg_id`, `user_id`, `fixed_date_id`, `trip_date`, `trip_currency`, `date_rate`, `trip_pax`, `trip_flight`, `accesskey`, `person_title`, `person_fname`, `person_mname`, `person_lname`, `person_email`, `person_country`, `person_country_code`, `person_city`, `person_address`, `person_postal`, `person_phone`, `person_ctype`, `person_hear`, `person_comment`, `ip_address`, `pay_type`, `pay_by`, `pay_amt`, `transaction_code`, `pan`, `hbl_invoiceNo`, `hbl_amount`, `tranRef`, `approvalCode`, `hbl_dateTime`, `statusofpayment`, `status`, `sortorder`, `added_date`, `confirm_ip`, `confirm_date`) VALUES
(1, 1, 0, 0, 169, 0, '2021-10-19', 'USD', 0, 2, '', 'qJQsxYEIzFijpSc', '', 'Swarna', '', 'Shakya', 'swarna@longtail.info', 'Nepal', 'NP', 'ktm', '', '', '9849482842', '', '', 'test', '::1', 'Inquiry', '', 240, '', '', '', '', '', '', '', '', 0, 1, '2021-09-30 17:46:20', '', ''),
(3, 3, 174, 0, 169, 0, '2021-10-12', 'USD', 0, 3, '', 'MTNNyq5zVGrCLZZ', '', 'Swarna', '', 'Shakya', 'swarna@longtail.info', 'Nepal', 'NP', 'ktm', '', '', '9849482842', '', '', 'etstsada', '::1', 'Inquiry', '', 600, '', '', '', '', '', '', '', '', 0, 2, '2021-10-11 16:16:27', '', ''),
(4, 3, 174, 0, 169, 0, '2021-10-12', 'USD', 0, 3, '', 'rzxjpdSNPgb2LEI', '', 'Swarna', '', 'Shakya', 'swarna@longtail.info', 'Nepal', 'NP', 'ktm', '', '', '9849482842', '', '', 'etstsada', '::1', 'Inquiry', '', 600, '', '', '', '', '', '', '', '', 0, 3, '2021-10-11 16:17:22', '', ''),
(5, 3, 174, 0, 169, 0, '2021-10-12', 'USD', 0, 3, '', '2oRJ7mYF17qd6pL', '', 'Swarna', '', 'Shakya', 'swarna@longtail.info', 'Nepal', 'NP', 'ktm', '', '', '9849482842', '', '', 'dsgffg', '::1', 'Inquiry', '', 600, '', '', '', '', '', '', '', '', 0, 4, '2021-10-11 16:18:54', '', ''),
(6, 3, 174, 0, 169, 0, '2021-10-12', 'USD', 0, 3, '', 'tKrE2cruIiF3Y5Y', '', 'Swarna', '', 'Shakya', 'swarna@longtail.info', 'Nepal', 'NP', 'ktm', '', '', '9849482842', '', '', 'tdg', '::1', 'Inquiry', '', 600, '', '', '', '', '', '', '', '', 0, 5, '2021-10-11 16:20:02', '', ''),
(7, 3, 174, 0, 169, 0, '2021-10-12', 'USD', 0, 3, '', 'kBSYLfTKcPHbQAF', '', 'Swarna', '', 'Shakya', 'swarna@longtail.info', 'Nepal', 'NP', 'ktm', '', '', '9849482842', '', '', 'tdg', '::1', 'Inquiry', '', 600, '', '', '', '', '', '', '', '', 0, 6, '2021-10-11 16:20:37', '', ''),
(8, 3, 172, 0, 169, 0, '2021-10-12', 'USD', 0, 3, '', '7dKphs1PPQYdV63', '', 'Swarna', '', 'Shakya', 'swarna@longtail.info', 'Nepal', 'NP', 'ktm', '', '', '9849482842', '', '', 'asdasd', '::1', 'Inquiry', '', 600, '', '', '', '', '', '', '', '', 0, 7, '2021-10-11 16:22:51', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookinginfo_additional`
--

CREATE TABLE `tbl_bookinginfo_additional` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_bookinginfo_additional`
--

INSERT INTO `tbl_bookinginfo_additional` (`id`, `booking_id`, `name`, `email`, `age`) VALUES
(1, 0, 'Swarna Shakya', 'sms@sms.sms', 23),
(2, 0, 'Swarna', 'sms@sms.smsms', 25),
(3, 0, 'Swarna Shakya', 'swarna@longtail.info', 5),
(4, 0, 'Swarna Shakya', 'swarna@longtail.info', 6),
(5, 7, 'Swarna Shakya', 'swarna@longtail.info', 5),
(6, 7, 'Swarna Shakya', 'swarna@longtail.info', 5),
(7, 8, 'Swarna Shakya', 'swarna@longtail.info', 67),
(8, 8, 'Swarna Shakya', 'swarna@longtail.info', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookinginfo_vehicle`
--

CREATE TABLE `tbl_bookinginfo_vehicle` (
  `id` int(11) NOT NULL,
  `vehicle_id_qnt` mediumtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `route_from` int(11) NOT NULL DEFAULT 0,
  `route_to` int(11) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `currency` varchar(10) NOT NULL,
  `pax` int(11) NOT NULL,
  `accesskey` varchar(20) NOT NULL,
  `person_fname` varchar(200) NOT NULL,
  `person_lname` varchar(200) NOT NULL,
  `person_email` tinytext NOT NULL,
  `person_country` varchar(100) NOT NULL,
  `person_country_code` varchar(100) NOT NULL,
  `person_city` varchar(200) NOT NULL,
  `person_address` tinytext NOT NULL,
  `person_phone` varchar(100) NOT NULL,
  `person_comment` mediumtext NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `pay_type` varchar(50) NOT NULL,
  `pay_by` tinytext NOT NULL,
  `pay_amt` int(11) NOT NULL,
  `transaction_code` varchar(100) NOT NULL,
  `pan` varchar(255) NOT NULL,
  `hbl_invoiceNo` varchar(255) NOT NULL,
  `hbl_amount` varchar(255) NOT NULL,
  `tranRef` varchar(255) NOT NULL,
  `approvalCode` varchar(255) NOT NULL,
  `hbl_dateTime` varchar(50) NOT NULL,
  `statusofpayment` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(20) NOT NULL,
  `confirm_ip` varchar(20) NOT NULL,
  `confirm_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_bookinginfo_vehicle`
--

INSERT INTO `tbl_bookinginfo_vehicle` (`id`, `vehicle_id_qnt`, `user_id`, `route_from`, `route_to`, `date`, `currency`, `pax`, `accesskey`, `person_fname`, `person_lname`, `person_email`, `person_country`, `person_country_code`, `person_city`, `person_address`, `person_phone`, `person_comment`, `ip_address`, `pay_type`, `pay_by`, `pay_amt`, `transaction_code`, `pan`, `hbl_invoiceNo`, `hbl_amount`, `tranRef`, `approvalCode`, `hbl_dateTime`, `statusofpayment`, `status`, `sortorder`, `added_date`, `confirm_ip`, `confirm_date`) VALUES
(1, '', 169, 3, 4, '2021-10-20', 'USD', 10, 'aVHORkxHBiK5t4H', 'Swarna', 'Shakya', 'swarna@longtail.info', 'Nepal', 'NP', 'ktm', '', '9849482842', 'mesage', '::1', 'Inquiry', '', 0, '', '', '', '', '', '', '', '', 0, 1, '2021-10-01 20:40:44', '', ''),
(2, '', 169, 3, 4, '2021-10-20', 'USD', 10, 'ghSMMfhvzcYwXtA', 'Swarna', 'Shakya', 'swarna@longtail.info', 'Nepal', 'NP', 'ktm', '', '9849482842', 'mesage', '::1', 'Inquiry', '', 40, '', '', '', '', '', '', '', '', 0, 2, '2021-10-01 20:42:37', '', ''),
(3, '', 169, 3, 4, '2021-10-20', 'USD', 10, 'dUnMUTjmhhZ2lgY', 'Swarna', 'Shakya', 'swarna@longtail.info', 'Nepal', 'NP', 'ktm', '', '9849482842', 'asdad', '::1', 'Inquiry', '', 40, '', '', '', '', '', '', '', '', 0, 3, '2021-10-01 20:44:19', '', ''),
(4, '', 169, 3, 4, '2021-10-19', 'USD', 10, 'oSQEY6NKb6E88rc', 'Swarna', 'Shakya', 'swarna@longtail.info', 'Nepal', 'NP', 'ktm', '', '9849482842', 'req testing', '::1', 'Inquiry', '', 150, '', '', '', '', '', '', '', '', 0, 4, '2021-10-12 15:31:25', '', ''),
(5, '', 169, 3, 4, '2021-10-19', 'USD', 10, 'maOT3jXjIV7rcEP', 'Swarna', 'Shakya', 'swarna@longtail.info', 'Afghanistan', 'AF', 'ktm', '', '9849482842', 'asdasd', '::1', 'Inquiry', '', 150, '', '', '', '', '', '', '', '', 0, 5, '2021-10-12 15:33:28', '', ''),
(6, '', 169, 3, 4, '2021-10-19', 'USD', 10, 'KjxY8UppXzDNRsl', 'Swarna', 'Shakya', 'swarna@longtail.info', 'Bahrain', 'BH', 'ktm', '', '9849482842', 'fdghgj', '::1', 'Inquiry', '', 85, '', '', '', '', '', '', '', '', 0, 6, '2021-10-12 15:36:29', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookinginfo_vehicle_extra`
--

CREATE TABLE `tbl_bookinginfo_vehicle_extra` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `vehicle_price` int(11) NOT NULL,
  `vehicle_qnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bookinginfo_vehicle_extra`
--

INSERT INTO `tbl_bookinginfo_vehicle_extra` (`id`, `booking_id`, `vendor_id`, `vehicle_id`, `vehicle_price`, `vehicle_qnt`) VALUES
(1, 1, 0, 8, 20, 1),
(2, 1, 0, 6, 10, 2),
(3, 2, 0, 8, 20, 1),
(4, 2, 0, 6, 10, 2),
(5, 3, 0, 8, 20, 1),
(6, 3, 0, 6, 10, 2),
(7, 4, 174, 14, 50, 3),
(8, 6, 174, 14, 50, 1),
(9, 6, 0, 10, 35, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calendar_price`
--

CREATE TABLE `tbl_calendar_price` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `one_person` int(11) NOT NULL,
  `two_person` int(11) NOT NULL,
  `three_person` int(11) NOT NULL,
  `extra_bed` int(11) NOT NULL,
  `reserve_date` date NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cleaning_safety`
--

CREATE TABLE `tbl_cleaning_safety` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 NOT NULL,
  `status` int(1) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cleaning_safety`
--

INSERT INTO `tbl_cleaning_safety` (`id`, `title`, `status`, `sortorder`, `added_date`) VALUES
(1, 'cleaning and safety practice 1', 1, 1, '2021-10-25 12:16:42'),
(2, 'cleaning and safety practice 2', 1, 2, '2021-10-25 12:16:49'),
(3, 'cleaning and safety practice 3', 1, 3, '2021-10-25 12:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_configs`
--

CREATE TABLE `tbl_configs` (
  `id` int(11) NOT NULL,
  `sitetitle` varchar(200) NOT NULL,
  `icon_upload` varchar(200) NOT NULL,
  `logo_upload` varchar(200) NOT NULL,
  `fb_upload` varchar(255) NOT NULL,
  `twitter_upload` varchar(255) NOT NULL,
  `sitename` varchar(50) NOT NULL,
  `location_type` tinyint(1) NOT NULL DEFAULT 1,
  `location_map` mediumtext NOT NULL,
  `location_image` varchar(250) NOT NULL,
  `fiscal_address` tinytext NOT NULL,
  `mail_address` tinytext NOT NULL,
  `contact_info` tinytext NOT NULL,
  `contact_phone` varchar(200) NOT NULL,
  `email_address` tinytext NOT NULL,
  `breif` text NOT NULL,
  `copyright` varchar(200) NOT NULL,
  `site_keywords` varchar(500) NOT NULL,
  `site_description` varchar(500) NOT NULL,
  `google_anlytics` text NOT NULL,
  `template` varchar(100) NOT NULL,
  `admin_template` varchar(100) NOT NULL,
  `headers` text DEFAULT NULL,
  `footer` text DEFAULT NULL,
  `search_box` text DEFAULT NULL,
  `search_result` text DEFAULT NULL,
  `action` tinyint(1) NOT NULL DEFAULT 0,
  `fb_messenger` text NOT NULL,
  `pixel_code` text NOT NULL,
  `schema_code` text NOT NULL,
  `robot_txt` text NOT NULL,
  `meta_title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_configs`
--

INSERT INTO `tbl_configs` (`id`, `sitetitle`, `icon_upload`, `logo_upload`, `fb_upload`, `twitter_upload`, `sitename`, `location_type`, `location_map`, `location_image`, `fiscal_address`, `mail_address`, `contact_info`, `contact_phone`, `email_address`, `breif`, `copyright`, `site_keywords`, `site_description`, `google_anlytics`, `template`, `admin_template`, `headers`, `footer`, `search_box`, `search_result`, `action`, `fb_messenger`, `pixel_code`, `schema_code`, `robot_txt`, `meta_title`) VALUES
(1, 'Siddhartha Hospitality', 'KLonB-grandlogo.png', 'SjSXa-logo.png', '', '', 'Siddhartha Hospitality', 1, 'map', '', 'Tinkune, Kathmandu, Nepal', 'info@siddharthahospitality.com', '', '+977 1 5199327', 'info@siddharthahospitality.com', '<div class=\"info-item \">\r\n	<div class=\"info-icon\">\r\n		<h5>\r\n			Address:</h5>\r\n	</div>\r\n	<div class=\"info-content\">\r\n		<p>\r\n			Tinkune, Kathmandu, Nepal</p>\r\n	</div>\r\n</div>\r\n<div class=\"info-item info-item-or\">\r\n	<div class=\"info-icon\">\r\n		<h5>\r\n			Phone:</h5>\r\n	</div>\r\n	<div class=\"info-content\">\r\n		<p>\r\n			+977 1 5199327</p>\r\n	</div>\r\n</div>\r\n<div class=\"info-item mar-bottom-30\">\r\n	<div class=\"info-icon\">\r\n		<h5>\r\n			Email:</h5>\r\n	</div>\r\n	<div class=\"info-content\">\r\n		<p>\r\n			info@siddharthahospitality.com</p>\r\n	</div>\r\n</div>\r\n<div class=\"info-item info-item-or mar-bottom-30\">\r\n	<div class=\"info-icon1\">\r\n		<h5>\r\n			Connect With Us:</h5>\r\n		<p>\r\n			facebook</p>\r\n	</div>\r\n</div>\r\n<div class=\"info-item info-item-or mar-bottom-30\">\r\n	<div class=\"info-icon1\">\r\n		<h5>\r\n			Reservation:</h5>\r\n		<p>\r\n			info@siddharthahospitality.com</p>\r\n	</div>\r\n</div>\r\n<div class=\"info-item info-item-or\">\r\n	<div class=\"info-icon1\">\r\n		<h5>\r\n			Meeting &amp; Banquet:</h5>\r\n		<p>\r\n			info@siddharthahospitality.com</p>\r\n	</div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', '© Siddhartha Hospitality {year} . All rights reserved.', 'Siddhartha Hospitality', 'Siddhartha Hospitality', '', 'nepalhotel', 'blue', '', '', 'Develop By Amit prajapati', 'Develop By Amit prajapati', 0, '', '', '', '', 'Siddhartha Hospitality');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

CREATE TABLE `tbl_countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`id`, `country_code`, `country_name`, `status`) VALUES
(1, 'AF', 'Afghanistan', 1),
(2, 'AL', 'Albania', 1),
(3, 'DZ', 'Algeria', 1),
(4, 'DS', 'American Samoa', 1),
(5, 'AD', 'Andorra', 1),
(6, 'AO', 'Angola', 1),
(7, 'AI', 'Anguilla', 1),
(8, 'AQ', 'Antarctica', 1),
(9, 'AG', 'Antigua and Barbuda', 1),
(10, 'AR', 'Argentina', 1),
(11, 'AM', 'Armenia', 1),
(12, 'AW', 'Aruba', 1),
(13, 'AU', 'Australia', 1),
(14, 'AT', 'Austria', 1),
(15, 'AZ', 'Azerbaijan', 1),
(16, 'BS', 'Bahamas', 1),
(17, 'BH', 'Bahrain', 1),
(18, 'BD', 'Bangladesh', 1),
(19, 'BB', 'Barbados', 1),
(20, 'BY', 'Belarus', 1),
(21, 'BE', 'Belgium', 1),
(22, 'BZ', 'Belize', 1),
(23, 'BJ', 'Benin', 1),
(24, 'BM', 'Bermuda', 1),
(25, 'BT', 'Bhutan', 1),
(26, 'BO', 'Bolivia', 1),
(27, 'BA', 'Bosnia and Herzegovina', 1),
(28, 'BW', 'Botswana', 1),
(29, 'BV', 'Bouvet Island', 1),
(30, 'BR', 'Brazil', 1),
(31, 'IO', 'British Indian Ocean Territory', 1),
(32, 'BN', 'Brunei Darussalam', 1),
(33, 'BG', 'Bulgaria', 1),
(34, 'BF', 'Burkina Faso', 1),
(35, 'BI', 'Burundi', 1),
(36, 'KH', 'Cambodia', 1),
(37, 'CM', 'Cameroon', 1),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 1),
(40, 'KY', 'Cayman Islands', 1),
(41, 'CF', 'Central African Republic', 1),
(42, 'TD', 'Chad', 1),
(43, 'CL', 'Chile', 1),
(44, 'CN', 'China', 1),
(45, 'CX', 'Christmas Island', 1),
(46, 'CC', 'Cocos (Keeling) Islands', 1),
(47, 'CO', 'Colombia', 1),
(48, 'KM', 'Comoros', 1),
(49, 'CG', 'Congo', 1),
(50, 'CK', 'Cook Islands', 1),
(51, 'CR', 'Costa Rica', 1),
(52, 'HR', 'Croatia (Hrvatska)', 1),
(53, 'CU', 'Cuba', 1),
(54, 'CY', 'Cyprus', 1),
(55, 'CZ', 'Czech Republic', 1),
(56, 'DK', 'Denmark', 1),
(57, 'DJ', 'Djibouti', 1),
(58, 'DM', 'Dominica', 1),
(59, 'DO', 'Dominican Republic', 1),
(60, 'TP', 'East Timor', 1),
(61, 'EC', 'Ecuador', 1),
(62, 'EG', 'Egypt', 1),
(63, 'SV', 'El Salvador', 1),
(64, 'GQ', 'Equatorial Guinea', 1),
(65, 'ER', 'Eritrea', 1),
(66, 'EE', 'Estonia', 1),
(67, 'ET', 'Ethiopia', 1),
(68, 'FK', 'Falkland Islands (Malvinas)', 1),
(69, 'FO', 'Faroe Islands', 1),
(70, 'FJ', 'Fiji', 1),
(71, 'FI', 'Finland', 1),
(72, 'FR', 'France', 1),
(73, 'FX', 'France, Metropolitan', 1),
(74, 'GF', 'French Guiana', 1),
(75, 'PF', 'French Polynesia', 1),
(76, 'TF', 'French Southern Territories', 1),
(77, 'GA', 'Gabon', 1),
(78, 'GM', 'Gambia', 1),
(79, 'GE', 'Georgia', 1),
(80, 'DE', 'Germany', 1),
(81, 'GH', 'Ghana', 1),
(82, 'GI', 'Gibraltar', 1),
(83, 'GK', 'Guernsey', 1),
(84, 'GR', 'Greece', 1),
(85, 'GL', 'Greenland', 1),
(86, 'GD', 'Grenada', 1),
(87, 'GP', 'Guadeloupe', 1),
(88, 'GU', 'Guam', 1),
(89, 'GT', 'Guatemala', 1),
(90, 'GN', 'Guinea', 1),
(91, 'GW', 'Guinea-Bissau', 1),
(92, 'GY', 'Guyana', 1),
(93, 'HT', 'Haiti', 1),
(94, 'HM', 'Heard and Mc Donald Islands', 1),
(95, 'HN', 'Honduras', 1),
(96, 'HK', 'Hong Kong', 1),
(97, 'HU', 'Hungary', 1),
(98, 'IS', 'Iceland', 1),
(99, 'IN', 'India', 1),
(100, 'IM', 'Isle of Man', 1),
(101, 'ID', 'Indonesia', 1),
(102, 'IR', 'Iran (Islamic Republic of)', 1),
(103, 'IQ', 'Iraq', 1),
(104, 'IE', 'Ireland', 1),
(105, 'IL', 'Israel', 1),
(106, 'IT', 'Italy', 1),
(107, 'CI', 'Ivory Coast', 1),
(108, 'JE', 'Jersey', 1),
(109, 'JM', 'Jamaica', 1),
(110, 'JP', 'Japan', 1),
(111, 'JO', 'Jordan', 1),
(112, 'KZ', 'Kazakhstan', 1),
(113, 'KE', 'Kenya', 1),
(114, 'KI', 'Kiribati', 1),
(115, 'KP', 'Korea, Democratic People\'s Republic of', 1),
(116, 'KR', 'Korea, Republic of', 1),
(117, 'XK', 'Kosovo', 1),
(118, 'KW', 'Kuwait', 1),
(119, 'KG', 'Kyrgyzstan', 1),
(120, 'LA', 'Lao People\'s Democratic Republic', 1),
(121, 'LV', 'Latvia', 1),
(122, 'LB', 'Lebanon', 1),
(123, 'LS', 'Lesotho', 1),
(124, 'LR', 'Liberia', 1),
(125, 'LY', 'Libyan Arab Jamahiriya', 1),
(126, 'LI', 'Liechtenstein', 1),
(127, 'LT', 'Lithuania', 1),
(128, 'LU', 'Luxembourg', 1),
(129, 'MO', 'Macau', 1),
(130, 'MK', 'Macedonia', 1),
(131, 'MG', 'Madagascar', 1),
(132, 'MW', 'Malawi', 1),
(133, 'MY', 'Malaysia', 1),
(134, 'MV', 'Maldives', 1),
(135, 'ML', 'Mali', 1),
(136, 'MT', 'Malta', 1),
(137, 'MH', 'Marshall Islands', 1),
(138, 'MQ', 'Martinique', 1),
(139, 'MR', 'Mauritania', 1),
(140, 'MU', 'Mauritius', 1),
(141, 'TY', 'Mayotte', 1),
(142, 'MX', 'Mexico', 1),
(143, 'FM', 'Micronesia, Federated States of', 1),
(144, 'MD', 'Moldova, Republic of', 1),
(145, 'MC', 'Monaco', 1),
(146, 'MN', 'Mongolia', 1),
(147, 'ME', 'Montenegro', 1),
(148, 'MS', 'Montserrat', 1),
(149, 'MA', 'Morocco', 1),
(150, 'MZ', 'Mozambique', 1),
(151, 'MM', 'Myanmar', 1),
(152, 'NA', 'Namibia', 1),
(153, 'NR', 'Nauru', 1),
(154, 'NP', 'Nepal', 1),
(155, 'NL', 'Netherlands', 1),
(156, 'AN', 'Netherlands Antilles', 1),
(157, 'NC', 'New Caledonia', 1),
(158, 'NZ', 'New Zealand', 1),
(159, 'NI', 'Nicaragua', 1),
(160, 'NE', 'Niger', 1),
(161, 'NG', 'Nigeria', 1),
(162, 'NU', 'Niue', 1),
(163, 'NF', 'Norfolk Island', 1),
(164, 'MP', 'Northern Mariana Islands', 1),
(165, 'NO', 'Norway', 1),
(166, 'OM', 'Oman', 1),
(167, 'PK', 'Pakistan', 1),
(168, 'PW', 'Palau', 1),
(169, 'PS', 'Palestine', 1),
(170, 'PA', 'Panama', 1),
(171, 'PG', 'Papua New Guinea', 1),
(172, 'PY', 'Paraguay', 1),
(173, 'PE', 'Peru', 1),
(174, 'PH', 'Philippines', 1),
(175, 'PN', 'Pitcairn', 1),
(176, 'PL', 'Poland', 1),
(177, 'PT', 'Portugal', 1),
(178, 'PR', 'Puerto Rico', 1),
(179, 'QA', 'Qatar', 1),
(180, 'RE', 'Reunion', 1),
(181, 'RO', 'Romania', 1),
(182, 'RU', 'Russian Federation', 1),
(183, 'RW', 'Rwanda', 1),
(184, 'KN', 'Saint Kitts and Nevis', 1),
(185, 'LC', 'Saint Lucia', 1),
(186, 'VC', 'Saint Vincent and the Grenadines', 1),
(187, 'WS', 'Samoa', 1),
(188, 'SM', 'San Marino', 1),
(189, 'ST', 'Sao Tome and Principe', 1),
(190, 'SA', 'Saudi Arabia', 1),
(191, 'SN', 'Senegal', 1),
(192, 'RS', 'Serbia', 1),
(193, 'SC', 'Seychelles', 1),
(194, 'SL', 'Sierra Leone', 1),
(195, 'SG', 'Singapore', 1),
(196, 'SK', 'Slovakia', 1),
(197, 'SI', 'Slovenia', 1),
(198, 'SB', 'Solomon Islands', 1),
(199, 'SO', 'Somalia', 1),
(200, 'ZA', 'South Africa', 1),
(201, 'GS', 'South Georgia South Sandwich Islands', 1),
(202, 'ES', 'Spain', 1),
(203, 'LK', 'Sri Lanka', 1),
(204, 'SH', 'St. Helena', 1),
(205, 'PM', 'St. Pierre and Miquelon', 1),
(206, 'SD', 'Sudan', 1),
(207, 'SR', 'Suriname', 1),
(208, 'SJ', 'Svalbard and Jan Mayen Islands', 1),
(209, 'SZ', 'Swaziland', 1),
(210, 'SE', 'Sweden', 1),
(211, 'CH', 'Switzerland', 1),
(212, 'SY', 'Syrian Arab Republic', 1),
(213, 'TW', 'Taiwan', 1),
(214, 'TJ', 'Tajikistan', 1),
(215, 'TZ', 'Tanzania, United Republic of', 1),
(216, 'TH', 'Thailand', 1),
(217, 'TG', 'Togo', 1),
(218, 'TK', 'Tokelau', 1),
(219, 'TO', 'Tonga', 1),
(220, 'TT', 'Trinidad and Tobago', 1),
(221, 'TN', 'Tunisia', 1),
(222, 'TR', 'Turkey', 1),
(223, 'TM', 'Turkmenistan', 1),
(224, 'TC', 'Turks and Caicos Islands', 1),
(225, 'TV', 'Tuvalu', 1),
(226, 'UG', 'Uganda', 1),
(227, 'UA', 'Ukraine', 1),
(228, 'AE', 'United Arab Emirates', 1),
(229, 'GB', 'United Kingdom', 1),
(230, 'US', 'United States', 1),
(231, 'UM', 'United States minor outlying islands', 1),
(232, 'UY', 'Uruguay', 1),
(233, 'UZ', 'Uzbekistan', 1),
(234, 'VU', 'Vanuatu', 1),
(235, 'VA', 'Vatican City State', 1),
(236, 'VE', 'Venezuela', 1),
(237, 'VN', 'Vietnam', 1),
(238, 'VG', 'Virgin Islands (British)', 1),
(239, 'VI', 'Virgin Islands (U.S.)', 1),
(240, 'WF', 'Wallis and Futuna Islands', 1),
(241, 'EH', 'Western Sahara', 1),
(242, 'YE', 'Yemen', 1),
(243, 'ZR', 'Zaire', 1),
(244, 'ZM', 'Zambia', 1),
(245, 'ZW', 'Zimbabwe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_destination`
--

CREATE TABLE `tbl_destination` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_brief` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  `gallery` blob NOT NULL,
  `brief` blob NOT NULL,
  `content` blob NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `meta_keywords` tinytext NOT NULL,
  `meta_description` tinytext NOT NULL,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_destination`
--

INSERT INTO `tbl_destination` (`id`, `slug`, `title`, `title_brief`, `image`, `gallery`, `brief`, `content`, `status`, `meta_keywords`, `meta_description`, `sortorder`, `added_date`) VALUES
(10, 'kathmandu', 'Kathmandu', 'Kathmandu', 'fTqeP-kathmandu.jpg', 0x613a313a7b693a303b733a31393a22676d714d762d6b6174686d616e64752e6a7067223b7d, '', 0x4361706974616c20636974792e20546865206d6f73742076696272616e742063697479206f66204e6570616c, 1, '', '', 0, ''),
(11, 'pokhara', 'Pokhara', 'Pokhara', 'VdOXz-pokhara.jpg', 0x613a313a7b693a303b733a31373a226e394841562d706f6b686172612e6a7067223b7d, '', 0x537572726f756e6465642077697468207363656e6963206265617574792061732061206d616a6f722064657374696e6174696f6e, 1, '', '', 1, '2020-04-29 10:17:40'),
(12, 'chitwan', 'Chitwan', 'Chitwan', 'bI5Sj-chitwan.jpg', 0x613a313a7b693a303b733a31373a2276565956682d6368697477616e2e6a7067223b7d, '', 0x466f722077696c646c69666520616e6420736166617269206c6f76657273206174207468652043656e747265206f66204e6570616c, 1, '', '', 4, '2020-04-29 10:17:52'),
(13, 'nagarkot', 'Nagarkot', 'Nagarkot', 'y8bmD-nagarkot.jpg', 0x613a313a7b693a303b733a31383a2238686d71382d6e616761726b6f742e6a7067223b7d, '', 0x3c703e0d0a09546865206e6561726573742068696c6c2073746174696f6e2066726f6d204b6174686d616e64756e3c2f703e0d0a, 1, '', '', 3, '2021-02-10 10:11:33'),
(14, 'dhulikhel', 'Dhulikhel', 'Dhulikhel', 'btQVK-dhulikhel.jpg', 0x613a313a7b693a303b733a31393a2246386935742d6468756c696b68656c2e6a7067223b7d, '', 0x3c703e0d0a094d6f756e7461696e732c2056696577732c20416374697669746965732c2054656d706c65732c2048696b696e6720616e64204d6f72652e2e2e2e3c2f703e0d0a, 1, '', '', 5, '2021-02-10 10:12:09'),
(15, 'nepalgunj', 'Nepalgunj', 'Nepalgunjs', 'gAiLQ-nepalgunj.jpg', 0x613a313a7b693a303b733a31393a224863426b482d6e6570616c67756e6a2e6a7067223b7d, '', 0x3c703e0d0a094761746577617920746f2052617261204c616b652e204120627573696e65737320687562206f66204e6570616c2e3c2f703e0d0a, 1, '', '', 10, '2021-02-10 10:12:44'),
(16, 'lalitpur', 'Lalitpur', '', '2D6kV-lalitpur.jpg', 0x613a313a7b693a303b733a31383a2246443344722d6c616c69747075722e6a7067223b7d, '', 0x3c703e0d0a0943697479206f662074656d706c65732e3c2f703e0d0a, 1, '', '', 2, '2021-02-14 00:16:36'),
(17, 'solukhumbhu', 'Solukhumbhu', '', 'ZwA1J-namche.jpg', '', '', '', 1, '', '', 9, '2021-02-14 16:21:40'),
(18, 'bardiya', 'Bardiya', '', 'etNm9-bardiya.jpg', '', '', '', 1, '', '', 8, '2021-02-23 11:49:47'),
(19, 'lumbini', 'Lumbini', '', 'YZxmI-lumbini.jpg', '', '', '', 1, '', '', 7, '2021-02-23 12:20:28'),
(20, 'bhaktapur', 'Bhaktapur', '', 'oEC5E-bhaktapur.jpg', '', '', '', 1, '', '', 6, '2021-02-23 12:57:20'),
(21, 'palpa', 'Palpa', '', 'UHWD8-palpa.jpg', '', '', '', 1, '', '', 11, '2021-02-23 13:13:15'),
(22, 'dhangadi', 'Dhangadi', '', 'l37xa-dhangadhi.jpg', '', '', '', 1, '', '', 12, '2021-02-23 14:03:25'),
(23, 'nuwakot', 'Nuwakot', '', 'ZLU7L-nuwakot.jpg', '', '', '', 1, '', '', 13, '2021-02-23 14:57:30'),
(24, 'itahari', 'Itahari', '', 'jAkYS-itahari.jpg', '', '', '', 1, '', '', 14, '2021-07-11 10:24:09'),
(25, 'birgunj', 'Birgunj', '', '3ZPQA-birgunj.jpg', '', '', '', 1, '', '', 15, '2021-07-11 10:27:07'),
(26, 'hetauda', 'Hetauda', '', 'LTmMy-hetauda.jpg', '', '', '', 1, '', '', 16, '2021-07-11 10:33:09'),
(27, 'biratnagar', 'Biratnagar', '', 'cN31J-biratnagar.jpg', '', '', '', 1, '', '', 17, '2021-07-11 10:42:35'),
(28, 'kohalpur', 'Kohalpur', '', 'ENrTn-kohalp[ur.jpg', '', '', '', 1, '', '', 18, '2021-07-11 10:44:30'),
(29, 'bhairahawa', 'bhairahawa', '', 'Tzk2n-bhairahawa.jpg', '', '', '', 1, '', '', 19, '2021-07-11 10:48:52'),
(30, 'butwal', 'Butwal', '', 'EgsnQ-butwal.jpg', '', '', '', 1, '', '', 20, '2021-07-11 10:53:41'),
(31, 'mahedranagar', 'Mahedranagar', '', 'fsRJ7-mahendranagar.jpg', '', '', '', 1, '', '', 21, '2021-07-11 10:56:26'),
(32, 'jhapa', 'jhapa', '', 'E5wdf-jhapa.jpg', '', '', '', 1, '', '', 22, '2021-07-11 10:58:30'),
(33, 'gorkha', 'Gorkha', '', 'eLBDF-gorkha.jpg', '', '', '', 1, '', '', 23, '2021-07-11 11:02:32'),
(34, 'lamjung', 'Lamjung', '', 'z9iuM-lamjung.jpg', '', '', '', 1, '', '', 24, '2021-07-11 11:03:32'),
(35, 'bandipur', 'Bandipur', '', 'Y6qSF-bandipur.jpg', '', '', '', 1, '', '', 25, '2021-07-11 11:04:40'),
(36, 'lukla', 'Lukla', '', 'CVWCi-lukla.jpg', '', '', '', 1, '', '', 26, '2021-07-11 11:07:10'),
(37, 'surkhet', 'Surkhet', '', '', '', '', '', 1, '', '', 27, '2023-09-03 12:20:23'),
(38, 'chisapani', 'Chisapani', '', '', '', '', '', 1, '', '', 28, '2023-09-03 12:33:44'),
(39, 'chandrauta', 'Chandrauta', '', '', '', '', '', 1, '', '', 29, '2023-09-03 12:56:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dining_hall`
--

CREATE TABLE `tbl_dining_hall` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` int(1) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) NOT NULL,
  `modified_date` varchar(50) NOT NULL,
  `meta_keywords` varchar(250) NOT NULL,
  `meta_description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_dining_hall`
--

INSERT INTO `tbl_dining_hall` (`id`, `hotel_id`, `title`, `slug`, `image`, `content`, `status`, `sortorder`, `added_date`, `modified_date`, `meta_keywords`, `meta_description`) VALUES
(10, 14, 'as', 'as', '', '<p>\r\n	asd</p>\r\n', 1, 1, '2023-09-01 15:53:09', '2023-09-01 15:57:58', 'asd', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE `tbl_event` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` int(1) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) NOT NULL,
  `modified_date` varchar(50) NOT NULL,
  `meta_keywords` varchar(250) NOT NULL,
  `meta_description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_event`
--

INSERT INTO `tbl_event` (`id`, `hotel_id`, `category_id`, `title`, `slug`, `image`, `content`, `status`, `sortorder`, `added_date`, `modified_date`, `meta_keywords`, `meta_description`) VALUES
(4, 14, 4, 'asd', 'asd', '', '<p>\r\n	asd</p>\r\n', 1, 1, '2023-09-01 16:09:25', '2023-09-01 16:10:28', 'asdas', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_category`
--

CREATE TABLE `tbl_event_category` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` int(1) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) NOT NULL,
  `modified_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_event_category`
--

INSERT INTO `tbl_event_category` (`id`, `slug`, `title`, `content`, `status`, `sortorder`, `added_date`, `modified_date`) VALUES
(4, 'cat-1', 'cat 1', '', 1, 1, '2023-08-30 16:24:19', '2023-08-30 16:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_hall`
--

CREATE TABLE `tbl_event_hall` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `theater` varchar(255) NOT NULL,
  `circular` varchar(255) NOT NULL,
  `u_shaped` varchar(255) NOT NULL,
  `board_room` varchar(255) NOT NULL,
  `class_room` varchar(255) NOT NULL,
  `reception` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` int(1) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) NOT NULL,
  `modified_date` varchar(50) NOT NULL,
  `meta_keywords` varchar(250) NOT NULL,
  `meta_description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_event_hall`
--

INSERT INTO `tbl_event_hall` (`id`, `hotel_id`, `title`, `slug`, `image`, `area`, `theater`, `circular`, `u_shaped`, `board_room`, `class_room`, `reception`, `content`, `status`, `sortorder`, `added_date`, `modified_date`, `meta_keywords`, `meta_description`) VALUES
(1, 6, 'asdasd', 'asdasd', 'NCofJ-abc.jpg', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', '<p>\r\n	asd</p>\r\n', 1, 1, '2023-08-29 14:52:31', '2023-08-29 14:53:44', '', ''),
(4, 14, 'test', 'test', '', '', '', '', '', '', '', '', '', 1, 2, '2023-09-01 16:06:12', '2023-09-01 16:06:12', 'qwe', 'qwe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_galleries`
--

CREATE TABLE `tbl_galleries` (
  `id` int(11) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `title_gr` varchar(250) NOT NULL,
  `image` varchar(50) NOT NULL,
  `detail` varchar(200) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `sortorder` int(11) NOT NULL,
  `registered` varchar(50) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery_images`
--

CREATE TABLE `tbl_gallery_images` (
  `id` int(11) NOT NULL,
  `galleryid` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `detail` varchar(200) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `registered` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group_type`
--

CREATE TABLE `tbl_group_type` (
  `id` int(11) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `group_type` varchar(20) NOT NULL,
  `authority` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=>Frontend,2=>Personality,3=>Backend,4=>Both',
  `description` tinytext NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_group_type`
--

INSERT INTO `tbl_group_type` (`id`, `group_name`, `group_type`, `authority`, `description`, `status`) VALUES
(1, 'Administrator', '1', 1, '', 1),
(2, 'General Admin', '1', 1, '', 1),
(3, 'Hotel Users', '2', 1, 'Hotel Users Type', 1),
(4, 'General Users', '3', 1, 'General Users', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hotel_faqs`
--

CREATE TABLE `tbl_hotel_faqs` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 NOT NULL,
  `content` text NOT NULL,
  `status` int(1) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_hotel_faqs`
--

INSERT INTO `tbl_hotel_faqs` (`id`, `title`, `content`, `status`, `sortorder`, `added_date`) VALUES
(1, 'FAQ 1', '<p>\r\n	asdadsdfdsgv</p>\r\n', 1, 1, '2021-10-25 13:33:22'),
(2, 'FAQ 2', '', 1, 2, '2021-10-25 13:33:28'),
(3, 'FAQ 3', '', 1, 3, '2021-10-25 13:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_itinerary`
--

CREATE TABLE `tbl_itinerary` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `day` varchar(100) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `breakfast` int(11) NOT NULL,
  `lunch` int(11) NOT NULL,
  `dinner` int(11) NOT NULL,
  `hotel1` varchar(200) NOT NULL,
  `hotel2` varchar(200) NOT NULL,
  `hotel3` varchar(200) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_itinerary`
--

INSERT INTO `tbl_itinerary` (`id`, `package_id`, `title`, `day`, `slug`, `image`, `content`, `breakfast`, `lunch`, `dinner`, `hotel1`, `hotel2`, `hotel3`, `sortorder`, `status`) VALUES
(1, 1, ' Day 1 : Arrival in Kathmandu   ', '', 'day-1-arrival-in-kathmandu', '', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.</p>\r\n', 0, 0, 0, '', '', '', 1, 1),
(2, 1, ' Day 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit.   ', '', 'day-2-lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.', 0, 0, 0, '', '', '', 2, 1),
(3, 1, ' Day 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. ', '', 'day-3-lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.', 0, 0, 0, '', '', '', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_level`
--

CREATE TABLE `tbl_level` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `point` int(50) NOT NULL,
  `date1` date NOT NULL,
  `date2` date NOT NULL,
  `image` varchar(200) NOT NULL,
  `source` varchar(250) NOT NULL,
  `linktype` varchar(150) NOT NULL,
  `linksrc` varchar(250) NOT NULL,
  `position` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `exptime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_level`
--

INSERT INTO `tbl_level` (`id`, `title`, `point`, `date1`, `date2`, `image`, `source`, `linktype`, `linksrc`, `position`, `status`, `sortorder`, `type`, `slug`, `exptime`) VALUES
(9, 'Level 0', 1000, '0000-00-00', '0000-00-00', '', '', '', '', 0, 1, 1, 0, 'level-0', 10),
(10, 'Level 2', 2000, '0000-00-00', '0000-00-00', '', '', '', '', 0, 1, 2, 0, 'level-2', 20),
(11, 'Level 23', 3000, '0000-00-00', '0000-00-00', '', '', '', '', 0, 1, 3, 0, 'level-23', 30),
(12, 'LEvel24', 10000, '0000-00-00', '0000-00-00', '', '', '', '', 0, 1, 4, 0, '10000', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `id` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `registered` varchar(50) NOT NULL,
  `userid` int(11) NOT NULL,
  `user_action` int(11) NOT NULL,
  `ip_track` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`id`, `action`, `registered`, `userid`, `user_action`, `ip_track`) VALUES
(1, 'User [Sarathi  Hotel] login Created Data has added', '2021-07-16 13:45:12', 1, 3, '110.44.118.211'),
(2, 'Login: admin   logged in.', '2021-07-16 13:46:11', 1, 1, '103.254.185.138'),
(3, 'Roomtype [Deluxe Tree]Data has added successfully.', '2021-07-16 13:52:18', 1, 3, '103.254.185.138'),
(4, 'Changes on Config \'Gundri Booking | From Nepal \' h', '2021-07-16 13:55:53', 1, 4, '103.254.185.138'),
(5, 'Hotel \'Online Booking\' has added successfully.', '2021-07-16 13:57:48', 1, 3, '110.44.118.211'),
(6, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-07-16 13:58:30', 1, 4, '110.44.118.211'),
(7, 'Login: admin   logged in.', '2021-07-16 15:27:07', 1, 1, '110.44.118.211'),
(8, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-07-16 15:31:46', 1, 4, '110.44.118.211'),
(9, 'Roomtype [Deluxe Room]Data has added successfully.', '2021-07-16 15:42:21', 1, 3, '110.44.118.211'),
(10, 'Room \'Deluxe Room\' has added successfully.', '2021-07-16 15:46:37', 1, 3, '110.44.118.211'),
(11, 'Changes on Room \'Deluxe Room\' has been saved succe', '2021-07-16 15:50:51', 1, 4, '110.44.118.211'),
(12, 'Login: admin   logged in.', '2021-07-16 16:12:42', 1, 1, '27.34.17.165'),
(13, 'Changes on Config \'Gundri Booking | From Nepal \' h', '2021-07-16 16:13:44', 1, 4, '27.34.17.165'),
(14, 'Changes on Config \'Gundri Booking | From Nepal \' h', '2021-07-16 16:14:22', 1, 4, '27.34.17.165'),
(15, 'Changes on Config \'Gundri Booking | From Nepal \' h', '2021-07-16 16:14:54', 1, 4, '27.34.17.165'),
(16, 'Changes on Config \'Gundri Booking | From Nepal \' h', '2021-07-16 16:15:15', 1, 4, '27.34.17.165'),
(17, 'Changes on Config \'Gundri Booking | From Nepal \' h', '2021-07-16 16:18:07', 1, 4, '27.34.17.165'),
(18, 'Login: admin   logged in.', '2021-07-16 17:31:27', 1, 1, '110.44.118.211'),
(19, 'User [flamingo  hotel] login Created Data has adde', '2021-07-16 17:33:52', 1, 3, '110.44.118.211'),
(20, 'Hotel \'Hotel Da Flamingo\' has added successfully.', '2021-07-16 17:53:13', 1, 3, '110.44.118.211'),
(21, 'Roomtype [Superior Room]Data has added successfull', '2021-07-16 17:54:38', 1, 3, '110.44.118.211'),
(22, 'Room \'Superior Room\' has added successfully.', '2021-07-16 17:56:28', 1, 3, '110.44.118.211'),
(23, 'Changes on Room \'Superior Room\' has been saved suc', '2021-07-16 17:58:06', 1, 4, '110.44.118.211'),
(24, 'Hotel [Hotel Da Flamingo] Edit Successfully', '2021-07-16 17:58:58', 1, 4, '110.44.118.211'),
(25, 'Hotel [Hotel Da Flamingo] Edit Successfully', '2021-07-16 18:00:38', 1, 4, '110.44.118.211'),
(26, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-07-16 18:01:03', 1, 4, '110.44.118.211'),
(27, 'User [Culture  Resort] login Created Data has adde', '2021-07-16 18:36:24', 1, 3, '110.44.118.211'),
(28, 'Hotel \'Culture Resort Pokhara\' has added successfu', '2021-07-16 18:47:42', 1, 3, '110.44.118.211'),
(29, 'Roomtype [Deluxe Room]Data has added successfully.', '2021-07-16 18:48:55', 1, 3, '110.44.118.211'),
(30, 'Room \'Deluxe Room with Lake View\' has added succes', '2021-07-16 18:50:10', 1, 3, '110.44.118.211'),
(31, 'User [Maxx  Hotel] login Created Data has added su', '2021-07-16 18:51:57', 1, 3, '110.44.118.211'),
(32, 'Login: admin   logged in.', '2021-07-16 18:58:50', 1, 1, '110.44.118.211'),
(33, 'Hotel \'Hotel Maxx\' has added successfully.', '2021-07-16 19:02:31', 1, 3, '110.44.118.211'),
(34, 'Roomtype [Suite]Data has added successfully.', '2021-07-16 19:03:49', 1, 3, '110.44.118.211'),
(35, 'Room \'Suite Room\' has added successfully.', '2021-07-16 19:05:16', 1, 3, '110.44.118.211'),
(36, 'Login: admin   logged in.', '2021-07-16 19:32:55', 1, 1, '110.44.118.211'),
(37, 'Login: admin   logged in.', '2021-07-18 10:32:40', 1, 1, '27.34.17.165'),
(38, 'Login: admin   logged in.', '2021-07-18 10:52:29', 1, 1, '110.44.122.143'),
(39, 'User [Central  Plaza] login Created Data has added', '2021-07-18 10:58:22', 1, 3, '110.44.122.143'),
(40, 'Hotel \'Hotel Central Plaza\' has added successfully', '2021-07-18 11:12:45', 1, 3, '110.44.122.143'),
(41, 'Login: admin   logged in.', '2021-07-18 12:21:28', 1, 1, '27.34.17.165'),
(42, 'Login: admin   logged in.', '2021-07-20 11:00:10', 1, 1, '27.34.17.165'),
(43, 'Changes on Config \'Gundri Booking | From Nepal \' h', '2021-07-20 11:05:41', 1, 4, '27.34.17.165'),
(44, 'Login: admin   logged in.', '2021-07-22 14:18:09', 1, 1, '110.44.125.140'),
(45, 'Login: admin   logged in.', '2021-07-22 14:27:12', 1, 1, '110.44.125.140'),
(46, 'Login: admin   logged in.', '2021-07-22 15:03:50', 1, 1, '103.254.185.138'),
(47, 'Login: admin   logged in.', '2021-07-22 15:32:46', 1, 1, '103.254.185.138'),
(48, 'Login: admin   logged in.', '2021-07-23 10:47:40', 1, 1, '103.254.185.138'),
(49, 'Login: admin   logged in.', '2021-07-23 11:34:02', 1, 1, '103.254.185.138'),
(50, 'Login: admin   logged in.', '2021-07-23 12:01:20', 1, 1, '103.254.185.138'),
(51, 'Login: admin   logged in.', '2021-07-26 13:22:21', 1, 1, '103.254.185.138'),
(52, 'Login: admin   logged in.', '2021-08-24 14:06:16', 1, 1, '150.107.107.41'),
(53, 'Login: admin   logged in.', '2021-08-24 19:31:29', 1, 1, '150.107.107.226'),
(54, 'Login: admin   logged in.', '2021-08-25 14:58:53', 1, 1, '27.34.27.111'),
(55, 'Login: admin   logged in.', '2021-08-25 14:59:11', 1, 1, '103.254.185.138'),
(56, 'User [Hotel Himalaya  ] login Created Data has add', '2021-08-25 15:05:55', 1, 3, '103.254.185.138'),
(57, 'Hotel \'Hotel Himalaya\' has added successfully.', '2021-08-25 16:13:52', 1, 3, '103.254.185.138'),
(58, 'Login: admin   logged in.', '2021-08-25 16:14:16', 1, 1, '103.254.185.138'),
(59, 'Hotel [Hotel Himalaya] Edit Successfully', '2021-08-25 16:20:13', 1, 4, '103.254.185.138'),
(60, 'Login: admin   logged in.', '2021-08-25 16:28:36', 1, 1, '103.254.185.138'),
(61, 'Roomtype [Junior Suits]Data has added successfully', '2021-08-25 16:39:25', 1, 3, '103.254.185.138'),
(62, 'Room \'Junior Suits\' has added successfully.', '2021-08-25 16:49:09', 1, 3, '103.254.185.138'),
(63, 'Roomtype [Deluxe Room]Data has added successfully.', '2021-08-25 16:52:18', 1, 3, '103.254.185.138'),
(64, 'Room \'Deluxe Room\' has added successfully.', '2021-08-25 16:55:08', 1, 3, '103.254.185.138'),
(65, 'Login: admin   logged in.', '2021-08-26 12:54:17', 1, 1, '27.34.25.104'),
(66, 'Login: admin   logged in.', '2021-08-26 13:00:43', 1, 1, '103.254.185.138'),
(67, 'Features [Private Bathroom]Data has added successf', '2021-08-26 13:02:39', 1, 3, '27.34.25.104'),
(68, 'Features [Flat Screen TV]Data has added successful', '2021-08-26 13:03:57', 1, 3, '27.34.25.104'),
(69, 'Features [WiFi]Data has added successfully.', '2021-08-26 13:04:36', 1, 3, '27.34.25.104'),
(70, 'Login: admin   logged in.', '2021-08-26 14:07:57', 1, 1, '103.254.185.138'),
(71, 'User [Gokarna Forest Resort] login Created Data ha', '2021-08-26 14:09:49', 1, 3, '103.254.185.138'),
(72, 'Hotel \'Gokarna Forest Resort\' has added successful', '2021-08-26 16:11:28', 1, 3, '103.254.185.138'),
(73, 'Login: admin   logged in.', '2021-08-26 16:11:39', 1, 1, '103.254.185.138'),
(74, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-08-26 16:19:43', 1, 4, '103.254.185.138'),
(75, 'Roomtype [Premier Suite]Data has added successfull', '2021-08-26 16:26:31', 1, 3, '103.254.185.138'),
(76, 'Roomtype [Club Room]Data has added successfully.', '2021-08-26 16:27:48', 1, 3, '103.254.185.138'),
(77, 'Roomtype [ Premier Room]Data has added successfull', '2021-08-26 16:28:36', 1, 3, '103.254.185.138'),
(78, 'Room \'Premier Room\'s\' has added successfully.', '2021-08-26 16:36:18', 1, 3, '103.254.185.138'),
(79, 'Login: admin   logged in.', '2021-08-26 16:45:05', 1, 1, '103.254.185.138'),
(80, 'Login: admin   logged in.', '2021-08-26 16:46:46', 1, 1, '103.254.185.138'),
(81, 'Login: admin   logged in.', '2021-08-27 13:40:14', 1, 1, '27.34.25.32'),
(82, 'Login: admin   logged in.', '2021-09-02 15:17:20', 1, 1, '27.34.27.151'),
(83, 'Login: admin   logged in.', '2021-09-02 15:30:57', 1, 1, '110.44.122.142'),
(84, 'Menu [Stays] Edit Successfully', '2021-09-02 15:32:42', 1, 4, '110.44.122.142'),
(85, 'Login: admin   logged in.', '2021-09-03 10:49:49', 1, 1, '27.34.20.247'),
(86, 'Login: admin   logged in.', '2021-09-03 12:06:23', 1, 1, '::1'),
(87, 'User [Swarna Man Shakya] login Created Data has ad', '2021-09-03 13:13:20', 1, 3, '::1'),
(88, 'User [Swarna Man Shakya] login Created Data has ad', '2021-09-03 13:18:06', 1, 3, '::1'),
(89, 'Login: admin   logged in.', '2021-09-03 14:23:11', 1, 1, '::1'),
(90, 'User [Swarna Man Shakya] login Created Data has ad', '2021-09-03 16:51:38', 1, 3, '::1'),
(91, 'User [Swarna Man Shakya] login Created Data has ad', '2021-09-03 16:55:25', 1, 3, '::1'),
(92, 'User [Swarna Man Shakya] login Created Data has ad', '2021-09-03 16:57:28', 1, 3, '::1'),
(93, 'Login: admin   logged in.', '2021-09-03 16:58:25', 1, 1, '::1'),
(94, 'Login: Swarna Man Shakya logged in.', '2021-09-03 17:02:16', 1, 1, '::1'),
(95, 'Hotel \'Hotel SMS\' has added successfully.', '2021-09-03 17:05:19', 1, 3, '::1'),
(96, 'Login: admin   logged in.', '2021-09-03 17:06:01', 1, 1, '::1'),
(97, 'Login: Swarna Man Shakya logged in.', '2021-09-03 17:09:41', 1, 1, '::1'),
(98, 'Roomtype [Deluxe Room]Data has added successfully.', '2021-09-03 17:10:07', 1, 3, '::1'),
(99, 'Room \'Deluxe Room\' has added successfully.', '2021-09-03 17:10:39', 1, 3, '::1'),
(100, 'Login: admin   logged in.', '2021-09-03 17:12:38', 1, 1, '::1'),
(101, 'Login: admin   logged in.', '2021-09-05 10:06:59', 1, 1, '::1'),
(102, 'User [Swarna Shakya] login Created Data has added ', '2021-09-05 11:18:41', 1, 3, '::1'),
(103, 'Login: admin   logged in.', '2021-09-05 11:42:13', 1, 1, '::1'),
(104, 'Login: admin   logged in.', '2021-09-05 12:16:08', 1, 1, '::1'),
(105, 'Login: admin   logged in.', '2021-09-05 12:19:25', 1, 1, '::1'),
(106, 'Login: admin   logged in.', '2021-09-05 16:52:32', 1, 1, '::1'),
(107, 'Login: Swarna Man Shakya logged in.', '2021-09-05 16:52:44', 1, 1, '::1'),
(108, 'Login: admin   logged in.', '2021-09-05 16:57:10', 1, 1, '::1'),
(109, 'Login: Swarna Man Shakya logged in.', '2021-09-05 17:03:41', 1, 1, '::1'),
(110, 'Login: admin   logged in.', '2021-09-05 17:12:19', 1, 1, '::1'),
(111, 'Login: Swarna Man Shakya logged in.', '2021-09-05 17:29:16', 1, 1, '::1'),
(112, 'Login: admin   logged in.', '2021-09-05 17:29:23', 1, 1, '::1'),
(113, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-09-06 11:34:15', 1, 4, '::1'),
(114, 'Login: admin   logged in.', '2021-09-06 13:36:17', 1, 1, '::1'),
(115, 'Login: Swarna Shakya   logged in.', '2021-09-06 13:51:04', 1, 1, '::1'),
(116, 'Login: admin   logged in.', '2021-09-07 11:35:02', 1, 1, '::1'),
(117, 'Login: admin   logged in.', '2021-09-07 12:14:16', 1, 1, '::1'),
(118, 'User [Swarna Shakya] Edit Successfully', '2021-09-07 13:06:57', 1, 4, '::1'),
(119, 'User [Swarna Shakya] Edit Successfully', '2021-09-07 13:20:55', 1, 4, '::1'),
(120, 'User [Swarna Shakya] Edit Successfully', '2021-09-07 13:25:26', 1, 4, '::1'),
(121, 'User [Swarna Shakya] Edit Successfully', '2021-09-07 13:26:58', 1, 4, '::1'),
(122, 'User [Swarna Shakya] Edit Successfully', '2021-09-07 13:32:01', 1, 4, '::1'),
(123, 'User [Swarna Shakya] Edit Successfully', '2021-09-07 13:32:12', 1, 4, '::1'),
(124, 'User [Swarna Shakya] Edit Successfully', '2021-09-10 14:45:13', 1, 4, '::1'),
(125, 'Login: admin   logged in.', '2021-09-12 15:32:08', 1, 1, '::1'),
(126, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-09-13 12:42:58', 1, 4, '::1'),
(127, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-09-13 12:43:53', 1, 4, '::1'),
(128, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-13 12:44:24', 1, 4, '::1'),
(129, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-09-13 13:16:46', 1, 4, '::1'),
(130, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-09-13 13:17:52', 1, 4, '::1'),
(131, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-13 13:20:00', 1, 4, '::1'),
(132, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-13 13:23:50', 1, 4, '::1'),
(133, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-13 13:31:29', 1, 4, '::1'),
(134, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-13 13:33:33', 1, 4, '::1'),
(135, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-13 13:35:32', 1, 4, '::1'),
(136, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-13 13:40:02', 1, 4, '::1'),
(137, 'Services  [Extra]Data has deleted successfully.', '2021-09-13 13:44:31', 1, 6, '::1'),
(138, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-13 13:44:50', 1, 4, '::1'),
(139, 'Services [Extra]Data has added successfully.', '2021-09-13 13:45:10', 1, 3, '::1'),
(140, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-13 13:47:46', 1, 4, '::1'),
(141, 'Login: admin   logged in.', '2021-09-22 13:17:53', 1, 1, '::1'),
(142, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-09-22 14:44:45', 1, 4, '::1'),
(143, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-09-22 14:59:11', 1, 4, '::1'),
(144, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-09-22 14:59:27', 1, 4, '::1'),
(145, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-09-22 15:56:15', 1, 4, '::1'),
(146, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-09-22 16:20:05', 1, 4, '::1'),
(147, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-09-22 16:20:15', 1, 4, '::1'),
(148, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-09-22 16:22:22', 1, 4, '::1'),
(149, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-09-22 16:22:39', 1, 4, '::1'),
(150, 'Login: admin   logged in.', '2021-09-22 16:25:08', 1, 1, '::1'),
(151, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-23 10:59:04', 1, 4, '::1'),
(152, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-23 11:11:46', 1, 4, '::1'),
(153, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-23 11:12:12', 1, 4, '::1'),
(154, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-23 11:12:53', 1, 4, '::1'),
(155, 'Features [Room Features]Data has added successfull', '2021-09-23 11:17:03', 1, 3, '::1'),
(156, 'Features [Private Bathroom] Edit Successfully', '2021-09-23 11:44:03', 1, 4, '::1'),
(157, 'Features [Flat Screen TV] Edit Successfully', '2021-09-23 11:44:11', 1, 4, '::1'),
(158, 'Features [WiFi] Edit Successfully', '2021-09-23 11:44:17', 1, 4, '::1'),
(159, 'Changes on Room \'Deluxe Room\' has been saved succe', '2021-09-23 11:44:37', 1, 4, '::1'),
(160, 'Changes on Room \'Deluxe Room\' has been saved succe', '2021-09-23 11:53:38', 1, 4, '::1'),
(161, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-23 11:58:08', 1, 4, '::1'),
(162, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-23 11:58:18', 1, 4, '::1'),
(163, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-23 12:05:20', 1, 4, '::1'),
(164, 'Login: admin   logged in.', '2021-09-23 16:46:49', 1, 1, '::1'),
(165, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-23 16:47:40', 1, 4, '::1'),
(166, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-23 17:09:09', 1, 4, '::1'),
(167, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-23 17:10:04', 1, 4, '::1'),
(168, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-23 17:10:53', 1, 4, '::1'),
(169, 'Advertisement [Adv 1]Data has added successfully.', '2021-09-24 11:59:08', 1, 3, '::1'),
(170, 'Advertisement [adv 2]Data has added successfully.', '2021-09-24 12:05:58', 1, 3, '::1'),
(171, 'Advertisement [adv 3]Data has added successfully.', '2021-09-24 12:06:11', 1, 3, '::1'),
(172, 'Advertisement [Adv 1] Edit Successfully', '2021-09-24 12:07:50', 1, 4, '::1'),
(173, 'Advertisement [adv 2] Edit Successfully', '2021-09-24 12:08:03', 1, 4, '::1'),
(174, 'Review []Data has added successfully.', '2021-09-24 17:00:02', 1, 3, '::1'),
(175, 'Review [2]Data has added successfully.', '2021-09-24 17:06:32', 1, 3, '::1'),
(176, 'Review [1] Edit Successfully', '2021-09-24 17:11:58', 1, 4, '::1'),
(177, 'Review  []Data has deleted successfully.', '2021-09-24 17:17:10', 1, 6, '::1'),
(178, 'Review  []Data has deleted successfully.', '2021-09-24 17:17:19', 1, 6, '::1'),
(179, 'Review [Swarna Shakya]Data has added successfully.', '2021-09-24 17:21:33', 1, 3, '::1'),
(180, 'Review [Swarna Man Shakya] Edit Successfully', '2021-09-24 17:21:45', 1, 4, '::1'),
(181, 'Review [Swarna Man Shakya] Edit Successfully', '2021-09-24 17:21:52', 1, 4, '::1'),
(182, 'Login: admin   logged in.', '2021-09-27 12:16:12', 1, 1, '127.0.0.1'),
(183, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-09-27 12:45:09', 1, 4, '127.0.0.1'),
(184, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-09-27 13:14:03', 1, 4, '127.0.0.1'),
(185, 'Login: admin   logged in.', '2021-09-29 10:57:42', 1, 1, '::1'),
(186, 'User [Swarna  Shakya] login Created Data has added', '2021-09-29 11:09:04', 1, 3, '::1'),
(187, 'User [Swarna  Shakya] login Created Data has added', '2021-09-29 11:11:03', 1, 3, '::1'),
(188, 'Login: Swarna  Shakya logged in.', '2021-09-29 11:23:16', 1, 1, '::1'),
(189, 'Login: admin   logged in.', '2021-09-29 11:26:51', 1, 1, '::1'),
(190, 'Login: Swarna  Shakya logged in.', '2021-09-29 11:29:04', 1, 1, '::1'),
(191, 'Login: admin   logged in.', '2021-09-29 11:35:48', 1, 1, '::1'),
(192, 'Login: Swarna  Shakya logged in.', '2021-09-29 11:39:54', 1, 1, '::1'),
(193, 'Login: Swarna  Shakya logged in.', '2021-09-29 11:42:18', 1, 1, '::1'),
(194, 'Login: admin   logged in.', '2021-09-29 11:43:39', 1, 1, '::1'),
(195, 'Hotel [Hotel 2] Edit Successfully', '2021-09-29 11:54:15', 1, 4, '::1'),
(196, 'Hotel [Hotel 2] Edit Successfully', '2021-09-29 11:54:35', 1, 4, '::1'),
(197, 'Hotel [Hotel 2] Edit Successfully', '2021-09-29 11:54:41', 1, 4, '::1'),
(198, 'Login: Swarna  Shakya logged in.', '2021-09-29 11:56:30', 1, 1, '::1'),
(199, 'Login: Swarna  Shakya logged in.', '2021-09-29 11:57:01', 1, 1, '::1'),
(200, 'Login: Swarna  Shakya logged in.', '2021-09-29 11:57:47', 1, 1, '::1'),
(201, 'Login: admin   logged in.', '2021-09-29 12:18:06', 1, 1, '::1'),
(202, 'Activities \'Trekking\' has added successfully.', '2021-09-29 13:34:13', 1, 3, '::1'),
(203, 'Activities \'Hiking\' has added successfully.', '2021-09-29 13:34:22', 1, 3, '::1'),
(204, 'Activities \'Mountaineering\' has added successfully', '2021-09-29 13:34:34', 1, 3, '::1'),
(205, 'Package [Test Package]Data has added successfully.', '2021-09-29 14:08:02', 1, 3, '::1'),
(206, ' Package Gallery Image [1]Data has added successfu', '2021-09-29 14:14:40', 1, 3, '::1'),
(207, 'Package [2 Night 3 Day Langtang Trek] Edit Success', '2021-09-29 14:24:32', 1, 4, '::1'),
(208, 'Package [2 Night 3 Day Langtang Trek] Edit Success', '2021-09-29 14:36:36', 1, 4, '::1'),
(209, 'Package [2 Night 3 Day Langtang Trek] Edit Success', '2021-09-29 14:37:24', 1, 4, '::1'),
(210, 'Package [2 Night 3 Day Langtang Trek] Edit Success', '2021-09-29 16:15:11', 1, 4, '::1'),
(211, 'Package [test package]Data has added successfully.', '2021-09-29 17:27:27', 1, 3, '::1'),
(212, 'Package [2 Night 3 Day Langtang Trek] Edit Success', '2021-09-29 17:27:37', 1, 4, '::1'),
(213, ' Package Gallery Image [2]Data has added successfu', '2021-09-29 17:34:45', 1, 3, '::1'),
(214, ' Package Gallery Image [3]Data has added successfu', '2021-09-29 17:35:03', 1, 3, '::1'),
(215, ' Package Gallery Image [4]Data has added successfu', '2021-09-29 17:35:03', 1, 3, '::1'),
(216, ' Package Gallery Image [5]Data has added successfu', '2021-09-29 17:35:03', 1, 3, '::1'),
(217, ' Package Gallery Image [6]Data has added successfu', '2021-09-29 17:35:03', 1, 3, '::1'),
(218, 'Vehicle \'I-10\' has added successfully.', '2021-10-01 13:28:44', 1, 3, '::1'),
(219, 'Vehicle \'Maruti\' has added successfully.', '2021-10-01 13:29:40', 1, 3, '::1'),
(220, 'Vehicle \'Jeep 1\' has added successfully.', '2021-10-01 13:32:42', 1, 3, '::1'),
(221, 'Vehicle \'hiace 1\' has added successfully.', '2021-10-01 13:33:39', 1, 3, '::1'),
(222, 'Vehicle \'Mini bus 1\' has added successfully.', '2021-10-01 13:34:19', 1, 3, '::1'),
(223, 'Vehicle \'Big Bus 1\' has added successfully.', '2021-10-01 13:34:51', 1, 3, '::1'),
(224, 'Vehicle route price. has added successfully.', '2021-10-01 14:24:16', 1, 3, '::1'),
(225, 'Changes on Vehicle route price. has been saved suc', '2021-10-01 14:24:33', 1, 4, '::1'),
(226, 'Login: admin   logged in.', '2021-10-03 11:00:38', 1, 1, '::1'),
(227, 'Page \'Popular Hire Brands\' has added successfully.', '2021-10-03 17:18:43', 1, 3, '::1'),
(228, 'Page \'FAQ vehicle with Adv\' has added successfully', '2021-10-03 17:20:07', 1, 3, '::1'),
(229, 'Login: admin   logged in.', '2021-10-04 14:17:12', 1, 1, '::1'),
(230, 'Changes on Page \'Popular Hire Brands\' has been sav', '2021-10-04 14:30:54', 1, 4, '::1'),
(231, 'Changes on Page \'Popular Hire Brands\' has been sav', '2021-10-04 14:31:47', 1, 4, '::1'),
(232, 'Changes on Page \'FAQ vehicle with Adv\' has been sa', '2021-10-04 14:33:29', 1, 4, '::1'),
(233, 'Route [Pokhara]Data has added successfully.', '2021-10-04 14:45:55', 1, 3, '::1'),
(234, 'Route [Kathmandu] Edit Successfully', '2021-10-04 14:46:08', 1, 4, '::1'),
(235, 'Route [Chitwan]Data has added successfully.', '2021-10-04 14:46:28', 1, 3, '::1'),
(236, 'Route [Lumbini]Data has added successfully.', '2021-10-04 14:46:49', 1, 3, '::1'),
(237, 'Route [Lakeside]Data has added successfully.', '2021-10-04 14:47:28', 1, 3, '::1'),
(238, 'Route [Sarangkot]Data has added successfully.', '2021-10-04 14:47:42', 1, 3, '::1'),
(239, 'Route [Tourist Bus Park]Data has added successfull', '2021-10-04 14:48:08', 1, 3, '::1'),
(240, 'Route [Lumbini gate]Data has added successfully.', '2021-10-04 14:48:27', 1, 3, '::1'),
(241, 'Route [Parsa Chowk]Data has added successfully.', '2021-10-04 14:48:35', 1, 3, '::1'),
(242, 'Changes on Vehicle route price. has been saved suc', '2021-10-04 15:22:00', 1, 4, '::1'),
(243, 'Changes on Vehicle route price. has been saved suc', '2021-10-04 15:22:20', 1, 4, '::1'),
(244, 'Changes on Vehicle route price. has been saved suc', '2021-10-04 15:22:31', 1, 4, '::1'),
(245, 'Vehicle route price. has added successfully.', '2021-10-07 13:28:38', 1, 3, '::1'),
(246, 'Login: admin   logged in.', '2021-10-08 10:38:08', 1, 1, '::1'),
(247, 'Services [Free Wifi] Edit Successfully', '2021-10-08 16:40:31', 1, 4, '::1'),
(248, 'Services [Popular Facilities] Edit Successfully', '2021-10-08 16:45:39', 1, 4, '::1'),
(249, 'Services [Property Facilities] Edit Successfully', '2021-10-08 16:45:53', 1, 4, '::1'),
(250, 'Services [Free Wifi]Data has added successfully.', '2021-10-08 16:47:07', 1, 3, '::1'),
(251, 'Services [Elevator in building]Data has added succ', '2021-10-08 16:50:52', 1, 3, '::1'),
(252, 'Services [Free Parking]Data has added successfully', '2021-10-08 16:51:03', 1, 3, '::1'),
(253, 'Services [Air Conditioned]Data has added successfu', '2021-10-08 16:51:12', 1, 3, '::1'),
(254, 'Services [Airport Shuttle]Data has added successfu', '2021-10-08 16:51:22', 1, 3, '::1'),
(255, 'Services [Pet Friendly]Data has added successfully', '2021-10-08 16:51:31', 1, 3, '::1'),
(256, 'Services [Restaurant Inside]Data has added success', '2021-10-08 16:51:40', 1, 3, '::1'),
(257, 'Services [Wheelchair Friendly]Data has added succe', '2021-10-08 16:51:50', 1, 3, '::1'),
(258, 'Services [Property Facilities] Edit Successfully', '2021-10-08 16:51:59', 1, 4, '::1'),
(259, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-08 16:53:36', 1, 4, '::1'),
(260, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-08 16:54:56', 1, 4, '::1'),
(261, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-08 17:05:44', 1, 4, '::1'),
(262, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-08 17:08:32', 1, 4, '::1'),
(263, 'Rating \'1\' has added successfully.', '2021-10-08 18:02:48', 1, 3, '::1'),
(264, 'Rating \'2\' has added successfully.', '2021-10-08 18:02:53', 1, 3, '::1'),
(265, 'Rating \'3\' has added successfully.', '2021-10-08 18:02:59', 1, 3, '::1'),
(266, 'Rating \'4\' has added successfully.', '2021-10-08 18:03:02', 1, 3, '::1'),
(267, 'Rating \'5\' has added successfully.', '2021-10-08 18:03:05', 1, 3, '::1'),
(268, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-10-08 18:08:02', 1, 4, '::1'),
(269, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-10 11:20:31', 1, 4, '::1'),
(270, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-10 11:44:56', 1, 4, '::1'),
(271, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-10 11:45:03', 1, 4, '::1'),
(272, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-10 12:02:33', 1, 4, '::1'),
(273, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-10 12:02:43', 1, 4, '::1'),
(274, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-10 12:03:04', 1, 4, '::1'),
(275, 'Changes on Room \'Deluxe Room\' has been saved succe', '2021-10-10 12:43:30', 1, 4, '::1'),
(276, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-10 13:50:49', 1, 4, '::1'),
(277, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-10 13:50:56', 1, 4, '::1'),
(278, 'Login: admin   logged in.', '2021-10-10 17:28:37', 1, 1, '::1'),
(279, 'Hotel [Hotel Da Flamingo] Edit Successfully', '2021-10-10 17:28:48', 1, 4, '::1'),
(280, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-10 17:29:24', 1, 4, '::1'),
(281, 'Login: admin   logged in.', '2021-10-11 11:52:07', 1, 1, '::1'),
(282, 'Login: admin   logged in.', '2021-10-11 12:09:21', 1, 1, '::1'),
(283, 'User [Tester  1] login Created Data has added succ', '2021-10-11 13:31:17', 1, 3, '::1'),
(284, 'Login: admin   logged in.', '2021-10-11 13:39:05', 1, 1, '::1'),
(285, 'Vehicle \'my car\' has added successfully.', '2021-10-11 14:46:14', 1, 3, '::1'),
(286, 'Changes on Vehicle \'my car\' has been saved success', '2021-10-11 14:48:40', 1, 4, '::1'),
(287, 'Menu [Vehicle] Edit Successfully', '2021-10-11 14:55:12', 1, 4, '::1'),
(288, 'Menu [Attractions] Edit Successfully', '2021-10-11 14:55:39', 1, 4, '::1'),
(289, 'Menu [Vehicle] Edit Successfully', '2021-10-11 14:55:52', 1, 4, '::1'),
(290, 'Package [ktm pkg]Data has added successfully.', '2021-10-11 15:01:29', 1, 3, '::1'),
(291, 'Vehicle route price. has added successfully.', '2021-10-12 11:25:46', 1, 3, '::1'),
(292, 'Login: admin   logged in.', '2021-10-12 15:44:30', 1, 1, '::1'),
(293, 'Login: admin   logged in.', '2021-10-24 13:45:40', 1, 1, '::1'),
(294, 'Hotel [Gokarna Forest Resort] Edit Successfully', '2021-10-25 11:19:13', 1, 4, '::1'),
(295, 'Practice \'cleaning and safety practice 1\' has adde', '2021-10-25 12:16:42', 1, 3, '::1'),
(296, 'Practice \'cleaning and safety practice 2\' has adde', '2021-10-25 12:16:49', 1, 3, '::1'),
(297, 'Practice \'cleaning and safety practice 3\' has adde', '2021-10-25 12:17:01', 1, 3, '::1'),
(298, 'Policy \'Policy 1\' has added successfully.', '2021-10-25 12:28:31', 1, 3, '::1'),
(299, 'Policy \'Policy 2\' has added successfully.', '2021-10-25 12:28:38', 1, 3, '::1'),
(300, 'Policy \'Policy 3\' has added successfully.', '2021-10-25 12:28:43', 1, 3, '::1'),
(301, 'Hotel FAQ \'FAQ 1\' has added successfully.', '2021-10-25 13:33:22', 1, 3, '::1'),
(302, 'Hotel FAQ \'FAQ 2\' has added successfully.', '2021-10-25 13:33:28', 1, 3, '::1'),
(303, 'Hotel FAQ \'FAQ 3\' has added successfully.', '2021-10-25 13:33:33', 1, 3, '::1'),
(304, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 13:52:34', 1, 4, '::1'),
(305, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 13:52:41', 1, 4, '::1'),
(306, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 14:11:34', 1, 4, '::1'),
(307, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 14:12:23', 1, 4, '::1'),
(308, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 14:12:38', 1, 4, '::1'),
(309, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 14:12:50', 1, 4, '::1'),
(310, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 14:13:01', 1, 4, '::1'),
(311, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 14:27:11', 1, 4, '::1'),
(312, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 14:29:06', 1, 4, '::1'),
(313, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 14:29:16', 1, 4, '::1'),
(314, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 14:51:14', 1, 4, '::1'),
(315, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 14:52:07', 1, 4, '::1'),
(316, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 14:53:29', 1, 4, '::1'),
(317, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 14:55:52', 1, 4, '::1'),
(318, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 14:56:40', 1, 4, '::1'),
(319, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 14:59:29', 1, 4, '::1'),
(320, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-10-25 15:01:28', 1, 4, '::1'),
(321, 'Login: admin   logged in.', '2021-10-31 11:19:07', 1, 1, '::1'),
(322, 'Login: admin   logged in.', '2021-10-31 11:22:20', 1, 1, '::1'),
(323, 'Offers [test]Data has added successfully.', '2021-11-01 14:08:18', 1, 3, '::1'),
(324, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-11-01 14:09:49', 1, 4, '::1'),
(325, 'Login: admin   logged in.', '2021-11-11 14:50:30', 1, 1, '::1'),
(326, 'Hotel [Hotel Sarathi] Edit Successfully', '2021-11-11 15:04:19', 1, 4, '::1'),
(327, 'Login: Swarna Man Shakya logged in.', '2021-11-11 15:17:12', 1, 1, '::1'),
(328, 'Login: Tester  1 logged in.', '2021-11-11 15:18:00', 1, 1, '::1'),
(329, 'Login: admin   logged in.', '2021-11-12 17:11:36', 1, 1, '::1'),
(330, 'Login: admin   logged in.', '2021-11-12 17:37:19', 1, 1, '::1'),
(331, 'Login: admin   logged in.', '2022-04-27 13:37:25', 1, 1, '::1'),
(332, 'Login: admin   logged in.', '2022-06-05 11:24:59', 1, 1, '::1'),
(333, 'Login: admin   logged in.', '2023-08-24 15:02:58', 1, 1, '::1'),
(334, 'Services [Popular Facilities] Edit Successfully', '2023-08-24 15:30:58', 1, 4, '::1'),
(335, 'Changes on Room \'Premier Room\'s\' has been saved su', '2023-08-24 15:56:08', 1, 4, '::1'),
(336, 'Changes on Room \'Premier Room\'s\' has been saved su', '2023-08-24 15:56:20', 1, 4, '::1'),
(337, 'Login: admin   logged in.', '2023-08-24 16:44:16', 1, 1, '::1'),
(338, 'Login: admin   logged in.', '2023-08-24 16:44:45', 1, 1, '::1'),
(339, 'Login: admin   logged in.', '2023-08-24 16:45:10', 1, 1, '::1'),
(340, 'Login: admin   logged in.', '2023-08-25 12:43:33', 1, 1, '::1'),
(341, 'Changes on Config \'Gundri Booking | From Nepal \' h', '2023-08-25 15:22:34', 1, 4, '::1'),
(342, 'Changes on Config \'Gundri Booking | From Nepal \' h', '2023-08-25 15:22:41', 1, 4, '::1'),
(343, 'Changes on Config \'Gundri Booking | From Nepal \' h', '2023-08-25 15:22:47', 1, 4, '::1'),
(344, 'Changes on Config \'Gundri Booking | From Nepal \' h', '2023-08-25 16:06:12', 1, 4, '::1'),
(345, 'Changes on Config \'Gundri Booking\' has been saved ', '2023-08-25 16:33:37', 1, 4, '::1'),
(346, 'Hotel \'asdasd\' has added successfully.', '2023-08-25 16:47:49', 1, 3, '::1'),
(347, 'Changes on Config \'Gundri Booking\' has been saved ', '2023-08-25 16:55:14', 1, 4, '::1'),
(348, 'Login: admin   logged in.', '2023-08-27 11:17:04', 1, 1, '::1'),
(349, 'Gallery [asdasd]Data has added successfully.', '2023-08-27 11:51:59', 1, 3, '::1'),
(350, 'Sub Gallery Image [asd]Data has added successfully', '2023-08-27 11:53:24', 1, 3, '::1'),
(351, 'Sub Gallery Image  [asd]Data has deleted successfu', '2023-08-27 11:59:49', 1, 6, '::1'),
(352, 'Gallery Image  [asdasd]Data has deleted successful', '2023-08-27 12:00:03', 1, 6, '::1'),
(353, 'Video [h]Data has added successfully.', '2023-08-27 14:25:14', 1, 3, '::1'),
(354, 'Video [h]Data has added successfully.', '2023-08-27 14:25:28', 1, 3, '::1'),
(355, 'Video [Sunday morning ð?° Chill morning songs to ', '2023-08-27 14:27:50', 1, 3, '::1'),
(356, 'Video  [h]Data has deleted successfully.', '2023-08-27 14:28:38', 1, 6, '::1'),
(357, 'Login: admin   logged in.', '2023-08-28 10:47:14', 1, 1, '::1'),
(358, 'Offers [Gokarna Offer]Data has added successfully.', '2023-08-28 12:12:32', 1, 3, '::1'),
(359, 'Gallery [test]Data has added successfully.', '2023-08-28 14:52:15', 1, 3, '::1'),
(360, 'Sub Gallery Image [1]Data has added successfully.', '2023-08-28 14:52:26', 1, 3, '::1'),
(361, 'Sub Gallery Image [2]Data has added successfully.', '2023-08-28 14:52:26', 1, 3, '::1'),
(362, 'Sub Gallery Image [3]Data has added successfully.', '2023-08-28 14:52:26', 1, 3, '::1'),
(363, 'Sub Gallery Image  [3]Data has deleted successfull', '2023-08-28 15:01:21', 1, 6, '::1'),
(364, 'Sub Gallery Image  []Data has deleted successfully', '2023-08-28 15:01:24', 1, 6, '::1'),
(365, 'Sub Gallery Image  [1]Data has deleted successfull', '2023-08-28 15:01:24', 1, 6, '::1'),
(366, 'Sub Gallery Image  []Data has deleted successfully', '2023-08-28 15:01:26', 1, 6, '::1'),
(367, 'Sub Gallery Image  []Data has deleted successfully', '2023-08-28 15:01:26', 1, 6, '::1'),
(368, 'Sub Gallery Image  [2]Data has deleted successfull', '2023-08-28 15:01:26', 1, 6, '::1'),
(369, 'Gallery Image  [test]Data has deleted successfully', '2023-08-28 15:01:30', 1, 6, '::1'),
(370, 'Login: admin   logged in.', '2023-08-29 12:56:21', 1, 1, '::1'),
(371, 'Dining Hall \'asd\' has added successfully.', '2023-08-29 12:58:37', 1, 3, '::1'),
(372, 'Dining Hall \'2\' has added successfully.', '2023-08-29 12:58:42', 1, 3, '::1'),
(373, 'Dining Hall \'3\' has added successfully.', '2023-08-29 12:58:45', 1, 3, '::1'),
(374, 'Dining Hall \'cp 1\' has added successfully.', '2023-08-29 13:03:55', 1, 3, '::1'),
(375, 'Dining Hall \'cp 2\' has added successfully.', '2023-08-29 13:04:01', 1, 3, '::1'),
(376, 'Dining Hall \'cp 3\' has added successfully.', '2023-08-29 13:04:04', 1, 3, '::1'),
(377, 'Dining Hall [cp 3]Data has deleted successfully.', '2023-08-29 13:06:37', 1, 6, '::1'),
(378, 'Dining Hall [2]Data has deleted successfully.', '2023-08-29 13:08:31', 1, 6, '::1'),
(379, 'Changes on Dining Hall \'asd\' has been saved succes', '2023-08-29 13:08:43', 1, 4, '::1'),
(380, 'Dining Hall [asd]Data has deleted successfully.', '2023-08-29 13:09:09', 1, 6, '::1'),
(381, 'Event Hall \'asdasd\' has added successfully.', '2023-08-29 14:52:31', 1, 3, '::1'),
(382, 'Event Hall \'y\' has added successfully.', '2023-08-29 14:53:07', 1, 3, '::1'),
(383, 'Event Hall \'m\\\' has added successfully.', '2023-08-29 14:53:12', 1, 3, '::1'),
(384, 'Changes on Event Hall \'m\' has been saved successfu', '2023-08-29 14:53:18', 1, 4, '::1'),
(385, 'Event Hall [m]Data has deleted successfully.', '2023-08-29 14:53:30', 1, 6, '::1'),
(386, 'Changes on Event Hall \'asdasd\' has been saved succ', '2023-08-29 14:53:44', 1, 4, '::1'),
(387, 'Review [Swarna Man Shakya] Edit Successfully', '2023-08-29 16:20:06', 1, 4, '::1'),
(388, 'Review [Swarna Man Shakya] Edit Successfully', '2023-08-29 16:20:14', 1, 4, '::1'),
(389, 'Review [Swarna Man Shakya] Edit Successfully', '2023-08-29 16:20:35', 1, 4, '::1'),
(390, 'Review [new 1]Data has added successfully.', '2023-08-29 16:21:05', 1, 3, '::1'),
(391, 'Review [new 1] Edit Successfully', '2023-08-29 16:21:16', 1, 4, '::1'),
(392, 'Review  [new 1]Data has deleted successfully.', '2023-08-29 16:21:31', 1, 6, '::1'),
(393, 'Hotel [asdasd] Edit Successfully', '2023-08-29 17:06:44', 1, 4, '::1'),
(394, 'Hotel \'sfadfsd\' has added successfully.', '2023-08-29 17:07:16', 1, 3, '::1'),
(395, 'Hotel [asdasd] Edit Successfully', '2023-08-29 17:35:13', 1, 4, '::1'),
(396, 'Login: admin   logged in.', '2023-08-30 11:16:11', 1, 1, '::1'),
(397, 'User [sdfsdfsdf sdfsdf sdfsdf] login Created Data ', '2023-08-30 11:56:48', 1, 3, '::1'),
(398, 'User [sdfsdfsdf sdfsdf sdfsdf] Edit Successfully', '2023-08-30 11:56:56', 1, 4, '::1'),
(399, 'Menu [Swarna] CreatedData has added successfully.', '2023-08-30 11:58:56', 1, 3, '::1'),
(400, 'Menu [Swarna] Edit Successfully', '2023-08-30 11:59:01', 1, 4, '::1'),
(401, 'Menu [Swarna] Edit Successfully', '2023-08-30 11:59:04', 1, 4, '::1'),
(402, 'Menu  [Swarna]Data has deleted successfully.', '2023-08-30 11:59:09', 1, 6, '::1'),
(403, 'Slideshow [fghh]Data has added successfully.', '2023-08-30 12:02:59', 1, 3, '::1'),
(404, 'Slideshows  [fghh]Data has deleted successfully.', '2023-08-30 12:03:03', 1, 6, '::1'),
(405, 'Slideshow  [fghh]Data has deleted successfully.', '2023-08-30 12:03:03', 1, 6, '::1'),
(406, 'Changes on Hotel FAQ \'FAQ 1\' has been saved succes', '2023-08-30 12:27:17', 1, 4, '::1'),
(407, 'Changes on Hotel FAQ \'FAQ 1\' has been saved succes', '2023-08-30 12:27:35', 1, 4, '::1'),
(408, 'Offers [1]Data has added successfully.', '2023-08-30 13:17:45', 1, 3, '::1'),
(409, 'Offers [2]Data has added successfully.', '2023-08-30 13:17:52', 1, 3, '::1'),
(410, 'Offers [3]Data has added successfully.', '2023-08-30 13:17:57', 1, 3, '::1'),
(411, 'Offerss  [3]Data has deleted successfully.', '2023-08-30 13:18:14', 1, 6, '::1'),
(412, 'Offers  [3]Data has deleted successfully.', '2023-08-30 13:18:14', 1, 6, '::1'),
(413, 'Offers  [2]Data has deleted successfully.', '2023-08-30 13:18:18', 1, 6, '::1'),
(414, 'Offers [1] Edit Successfully', '2023-08-30 13:18:24', 1, 4, '::1'),
(415, 'Offerss  [1]Data has deleted successfully.', '2023-08-30 13:18:43', 1, 6, '::1'),
(416, 'Offers  [1]Data has deleted successfully.', '2023-08-30 13:18:43', 1, 6, '::1'),
(417, 'Event Category \'1\' has added successfully.', '2023-08-30 16:07:07', 1, 3, '::1'),
(418, 'Event Category \'2\' has added successfully.', '2023-08-30 16:07:10', 1, 3, '::1'),
(419, 'Event Category \'3\' has added successfully.', '2023-08-30 16:07:13', 1, 3, '::1'),
(420, 'Event Category []Data has deleted successfully.', '2023-08-30 16:07:28', 1, 6, '::1'),
(421, 'Changes on Event Category \'1fukyuk\' has been saved', '2023-08-30 16:07:36', 1, 4, '::1'),
(422, 'Event Category []Data has deleted successfully.', '2023-08-30 16:07:39', 1, 6, '::1'),
(423, 'Event Category \'cat 1\' has added successfully.', '2023-08-30 16:24:19', 1, 3, '::1'),
(424, 'Dining Hall \'1\' has added successfully.', '2023-08-30 16:25:56', 1, 3, '::1'),
(425, 'Dining Hall \'2\' has added successfully.', '2023-08-30 16:26:03', 1, 3, '::1'),
(426, 'Dining Hall \'3\' has added successfully.', '2023-08-30 16:26:09', 1, 3, '::1'),
(427, 'Event \'1\' has added successfully.', '2023-08-30 16:27:53', 1, 3, '::1'),
(428, 'Event \'2\' has added successfully.', '2023-08-30 16:27:59', 1, 3, '::1'),
(429, 'Event \'3\' has added successfully.', '2023-08-30 16:28:08', 1, 3, '::1'),
(430, 'Event [2]Data has deleted successfully.', '2023-08-30 16:28:24', 1, 6, '::1'),
(431, 'Changes on Event \'1\' has been saved successfully.', '2023-08-30 16:28:42', 1, 4, '::1'),
(432, 'Changes on Event \'1\' has been saved successfully.', '2023-08-30 16:28:46', 1, 4, '::1'),
(433, 'Event [1]Data has deleted successfully.', '2023-08-30 16:29:08', 1, 6, '::1'),
(434, 'User [admin  ] Edit Successfully', '2023-08-30 16:38:06', 1, 4, '::1'),
(435, 'User [sdfsdfsdf sdfsdf sdfsdf] Edit Successfully', '2023-08-30 16:43:05', 1, 4, '::1'),
(436, 'User [admin  ] Edit Successfully', '2023-08-30 16:56:11', 1, 4, '::1'),
(437, 'User [admin  ] Edit Successfully', '2023-08-30 16:56:14', 1, 4, '::1'),
(438, 'Login: admin   logged in.', '2023-09-01 11:07:26', 1, 1, '::1'),
(439, 'Services [Hotel Services] Edit Successfully', '2023-09-01 11:24:45', 1, 4, '::1'),
(440, 'Services [Other Services] Edit Successfully', '2023-09-01 11:25:04', 1, 4, '::1'),
(441, 'Changes on Config \'Siddhartha Hospitality\' has bee', '2023-09-01 11:30:32', 1, 4, '::1'),
(442, 'Login: admin   logged in.', '2023-09-01 11:36:15', 1, 1, '::1'),
(443, 'Login: admin   logged in.', '2023-09-01 12:20:12', 1, 1, '::1'),
(444, 'Login: admin   logged in.', '2023-09-01 12:53:59', 1, 1, '::1'),
(445, 'Hotel [hotel tester 1] Edit Successfully', '2023-09-01 13:31:06', 1, 4, '::1'),
(446, 'Hotel [hotel tester 1] Edit Successfully', '2023-09-01 13:40:22', 1, 4, '::1'),
(447, 'Login: admin   logged in.', '2023-09-01 15:05:30', 1, 1, '::1'),
(448, 'Login: admin   logged in.', '2023-09-01 15:06:09', 1, 1, '::1'),
(449, 'Roomtype [test]Data has added successfully.', '2023-09-01 15:26:25', 1, 3, '::1'),
(450, 'Roomtype  [test]Data has deleted successfully.', '2023-09-01 15:26:54', 1, 6, '::1'),
(451, 'Room type  [test]Data has deleted successfully.', '2023-09-01 15:26:54', 1, 6, '::1'),
(452, 'Roomtype [test]Data has added successfully.', '2023-09-01 15:26:59', 1, 3, '::1'),
(453, 'Roomtype  [test]Data has deleted successfully.', '2023-09-01 15:27:04', 1, 6, '::1'),
(454, 'Room type  [test]Data has deleted successfully.', '2023-09-01 15:27:04', 1, 6, '::1'),
(455, 'Room \'testin\' has added successfully.', '2023-09-01 15:34:03', 1, 3, '::1'),
(456, 'Room [testin]Data has deleted successfully.', '2023-09-01 15:34:30', 1, 6, '::1'),
(457, 'Room \'test\' has added successfully.', '2023-09-01 15:44:01', 1, 3, '::1'),
(458, 'Room [test]Data has deleted successfully.', '2023-09-01 15:44:18', 1, 6, '::1'),
(459, 'Dining Hall \'as\' has added successfully.', '2023-09-01 15:53:09', 1, 3, '::1'),
(460, 'Changes on Dining Hall \'as\' has been saved success', '2023-09-01 15:54:14', 1, 4, '::1'),
(461, 'Changes on Dining Hall \'as\' has been saved success', '2023-09-01 15:54:47', 1, 4, '::1'),
(462, 'Changes on Dining Hall \'as\' has been saved success', '2023-09-01 15:57:29', 1, 4, '::1'),
(463, 'Changes on Dining Hall \'as\' has been saved success', '2023-09-01 15:57:58', 1, 4, '::1'),
(464, 'Event Hall \'test\' has added successfully.', '2023-09-01 16:06:12', 1, 3, '::1'),
(465, 'Event \'asd\' has added successfully.', '2023-09-01 16:09:25', 1, 3, '::1'),
(466, 'Changes on Event \'asd\' has been saved successfully', '2023-09-01 16:10:28', 1, 4, '::1'),
(467, 'Review [testsetset]Data has added successfully.', '2023-09-01 16:29:00', 1, 3, '::1'),
(468, 'Hotel [Siddhartha Cottage] Edit Successfully', '2023-09-01 16:43:38', 1, 4, '::1'),
(469, 'Hotel [Siddhartha Cottage] Edit Successfully', '2023-09-01 16:44:15', 1, 4, '::1'),
(470, 'Property [Siddhartha Cottage] Edit Successfully', '2023-09-01 16:46:50', 1, 4, '::1'),
(471, 'Property [Siddhartha Cottage] Edit Successfully', '2023-09-01 16:47:41', 1, 4, '::1'),
(472, 'Property [Siddhartha Cottage] Edit Successfully', '2023-09-01 16:54:48', 1, 4, '::1'),
(473, 'Property [Hotel Siddhartha, Nepalgunj] Edit Succes', '2023-09-01 16:56:52', 1, 4, '::1'),
(474, 'Property [Hotel Siddhartha, Tikapur] Edit Successf', '2023-09-01 16:59:39', 1, 4, '::1'),
(475, 'Property [Hotel Siddhartha, Tikapur] Edit Successf', '2023-09-01 17:00:03', 1, 4, '::1'),
(476, 'Property [Siddhartha River Side Resort, Chumlingta', '2023-09-01 17:01:47', 1, 4, '::1'),
(477, 'Property \'test\' has added successfully.', '2023-09-01 17:04:06', 1, 3, '::1'),
(478, 'Property [test] Edit Successfully', '2023-09-01 17:04:23', 1, 4, '::1'),
(479, 'Roomtype [asd]Data has added successfully.', '2023-09-01 17:05:18', 1, 3, '::1'),
(480, 'Roomtype [asdasd]Data has added successfully.', '2023-09-01 17:05:49', 1, 3, '::1'),
(481, 'Roomtype [testsetset]Data has added successfully.', '2023-09-01 17:06:49', 1, 3, '::1'),
(482, 'Roomtype [testsdtsdf]Data has added successfully.', '2023-09-01 17:07:37', 1, 3, '::1'),
(483, 'Dining Hall \'asdas\' has added successfully.', '2023-09-01 17:08:45', 1, 3, '::1'),
(484, 'Dining Hall [asdas]Data has deleted successfully.', '2023-09-01 17:08:55', 1, 6, '::1'),
(485, 'Review [tesdf]Data has added successfully.', '2023-09-01 17:09:15', 1, 3, '::1'),
(486, 'Services [Property Services] Edit Successfully', '2023-09-03 11:20:53', 1, 4, '::1'),
(487, 'Changes on Room \'Deluxe Room\' has been saved succe', '2023-09-03 11:25:28', 1, 4, '::1'),
(488, 'Changes on Room \'Deluxe Room\' has been saved succe', '2023-09-03 11:26:05', 1, 4, '::1'),
(489, 'Changes on Room \'Deluxe Room\' has been saved succe', '2023-09-03 11:27:00', 1, 4, '::1'),
(490, 'Changes on Room \'Deluxe Room\' has been saved succe', '2023-09-03 11:27:32', 1, 4, '::1'),
(491, 'Changes on Room \'Junior Suits\' has been saved succ', '2023-09-03 11:30:09', 1, 4, '::1'),
(492, 'Changes on Room \'Premier Room\'s\' has been saved su', '2023-09-03 11:31:02', 1, 4, '::1'),
(493, 'Login: admin   logged in.', '2023-09-03 11:47:19', 1, 1, '::1'),
(494, 'Property [Siddhartha Boutique Hotel, Boudha] Edit ', '2023-09-03 12:15:59', 1, 4, '::1'),
(495, 'Property [Siddhartha Hotel Grand City, Birtamode] ', '2023-09-03 12:17:17', 1, 4, '::1'),
(496, 'Property [Siddhartha Boutique Hotel, Boudha] Edit ', '2023-09-03 12:17:29', 1, 4, '::1'),
(497, 'Property [Siddhartha Hotel New Anand, Mahendranaga', '2023-09-03 12:18:58', 1, 4, '::1'),
(498, 'Destination \'Surkhet\' has added successfully.', '2023-09-03 12:20:23', 1, 3, '::1'),
(499, 'Property [Siddhartha Sunny Resort, Surkhet] Edit S', '2023-09-03 12:27:15', 1, 4, '::1'),
(500, 'Property [Siddhartha Sunny Resort, Surkhet] Edit S', '2023-09-03 12:28:12', 1, 4, '::1'),
(501, 'Property [Siddhartha Resort, Chisapani] Edit Succe', '2023-09-03 12:33:04', 1, 4, '::1'),
(502, 'Destination \'Chisapani\' has added successfully.', '2023-09-03 12:33:44', 1, 3, '::1'),
(503, 'Property [Siddhartha Resort, Chisapani] Edit Succe', '2023-09-03 12:34:00', 1, 4, '::1'),
(504, 'Property [Siddhartha Hotel Water Tower, Nuwakot] E', '2023-09-03 12:54:57', 1, 4, '::1'),
(505, 'Property [Siddhartha Resort, Chandrauta] Edit Succ', '2023-09-03 12:56:13', 1, 4, '::1'),
(506, 'Destination \'Chandrauta\' has added successfully.', '2023-09-03 12:56:52', 1, 3, '::1'),
(507, 'Property [Siddhartha Resort, Chandrauta] Edit Succ', '2023-09-03 12:57:40', 1, 4, '::1'),
(508, 'User [test1 sdfsdf sdfsdf] Edit Successfully', '2023-09-03 13:28:13', 1, 4, '::1'),
(509, 'User [test1  ] Edit Successfully', '2023-09-03 13:28:27', 1, 4, '::1'),
(510, 'User [Test3  ] Edit Successfully', '2023-09-03 13:37:03', 1, 4, '::1'),
(511, 'User [Test 4   ] Edit Successfully', '2023-09-03 13:37:13', 1, 4, '::1'),
(512, 'User [Tester 2  ] Edit Successfully', '2023-09-03 13:37:31', 1, 4, '::1'),
(513, 'User [Test 5  Man ] Edit Successfully', '2023-09-03 13:37:41', 1, 4, '::1'),
(514, 'User [Test 6  ] Edit Successfully', '2023-09-03 13:37:58', 1, 4, '::1'),
(515, 'User [Test 7  ] Edit Successfully', '2023-09-03 13:38:10', 1, 4, '::1'),
(516, 'User [Test 8  ] Edit Successfully', '2023-09-03 13:38:21', 1, 4, '::1'),
(517, 'User [Test 8  ] Edit Successfully', '2023-09-03 13:38:32', 1, 4, '::1'),
(518, 'User [test 9   ] Edit Successfully', '2023-09-03 13:38:41', 1, 4, '::1'),
(519, 'User [test 10  hotel] Edit Successfully', '2023-09-03 13:38:50', 1, 4, '::1'),
(520, 'User [tse11  Hotel] Edit Successfully', '2023-09-03 13:39:00', 1, 4, '::1'),
(521, 'Question Category  [Test 8  ]Data has deleted succ', '2023-09-03 13:39:19', 1, 6, '::1'),
(522, 'User [Siddhartha  Cottage] Edit Successfully', '2023-09-03 13:40:39', 1, 4, '::1'),
(523, 'Property [Siddhartha Cottage] Edit Successfully', '2023-09-03 13:41:11', 1, 4, '::1'),
(524, 'User [Hotel Siddhartha, Nepalgunj  ] Edit Successf', '2023-09-03 13:43:28', 1, 4, '::1'),
(525, 'User [Hotel Siddhartha, Tikapur  ] Edit Successful', '2023-09-03 13:44:12', 1, 4, '::1'),
(526, 'User [Siddhartha River Side Resort, Chumlingtar  ]', '2023-09-03 13:48:39', 1, 4, '::1'),
(527, 'User [Siddhartha River Side Resort, Chumlingtar  ]', '2023-09-03 13:49:24', 1, 4, '::1'),
(528, 'Login: admin   logged in.', '2023-09-03 15:06:17', 1, 1, '::1'),
(529, 'User [Siddhartha Boutique Hotel, Boudha Man ] Edit', '2023-09-03 15:07:39', 1, 4, '::1'),
(530, 'User [Siddhartha Hotel Grand City, Birtamode  ] Ed', '2023-09-03 15:08:18', 1, 4, '::1'),
(531, 'User [Siddhartha Hotel New Anand, Mahendranagar  ]', '2023-09-03 15:08:54', 1, 4, '::1'),
(532, 'User [Siddhartha Sunny Resort, Surkhet  ] Edit Suc', '2023-09-03 15:09:34', 1, 4, '::1'),
(533, 'User [Siddhartha Resort, Chisapani  ] Edit Success', '2023-09-03 15:10:12', 1, 4, '::1'),
(534, 'User [Siddhartha Hotel Water Tower, Nuwakot  ] Edi', '2023-09-03 15:11:05', 1, 4, '::1'),
(535, 'User [Siddhartha Resort, Chandrauta  ] Edit Succes', '2023-09-03 15:11:53', 1, 4, '::1'),
(536, 'Property [Siddhartha Resort, Chandrauta] Edit Succ', '2023-09-03 15:12:14', 1, 4, '::1'),
(537, 'Property [Siddhartha Hotel Water Tower, Nuwakot] E', '2023-09-03 15:12:23', 1, 4, '::1'),
(538, 'Property [Siddhartha Resort, Chisapani] Edit Succe', '2023-09-03 15:12:42', 1, 4, '::1'),
(539, 'Property [Siddhartha Sunny Resort, Surkhet] Edit S', '2023-09-03 15:12:55', 1, 4, '::1'),
(540, 'Property [Siddhartha Hotel New Anand, Mahendranaga', '2023-09-03 15:13:05', 1, 4, '::1'),
(541, 'Property [Siddhartha Hotel Grand City, Birtamode] ', '2023-09-03 15:13:16', 1, 4, '::1'),
(542, 'Property [Siddhartha Boutique Hotel, Boudha] Edit ', '2023-09-03 15:13:37', 1, 4, '::1'),
(543, 'Property [Siddhartha River Side Resort, Chumlingta', '2023-09-03 15:13:51', 1, 4, '::1'),
(544, 'Property [Hotel Siddhartha, Tikapur] Edit Successf', '2023-09-03 15:14:02', 1, 4, '::1'),
(545, 'Property [Hotel Siddhartha, Nepalgunj] Edit Succes', '2023-09-03 15:14:11', 1, 4, '::1'),
(546, 'User [Siddhartha Boutique Hotel, Boudha  ] Edit Su', '2023-09-03 15:14:40', 1, 4, '::1'),
(547, 'Login: admin   logged in.', '2023-09-22 14:29:25', 1, 1, '::1'),
(548, 'Slideshow [Look Ahead Book Ahead.]Data has added s', '2023-09-22 15:21:00', 1, 3, '::1'),
(549, 'Slideshow [Look Ahead Book Ahead.] Edit Successful', '2023-09-22 15:27:54', 1, 4, '::1'),
(550, 'Changes on Page \'About Us\' has been saved successf', '2023-09-22 15:47:19', 1, 4, '::1'),
(551, 'Changes on Page \'About Us\' has been saved successf', '2023-09-22 15:49:59', 1, 4, '::1'),
(552, 'Changes on Page \'SIDDHARTHA Business Group of<br/>', '2023-09-22 15:50:22', 1, 4, '::1'),
(553, 'Property \'Siddhartha Lumbini Green Resort\' has add', '2023-09-22 16:49:03', 1, 3, '::1'),
(554, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-22 16:50:32', 1, 4, '::1'),
(555, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-22 16:51:36', 1, 4, '::1'),
(556, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-22 16:52:14', 1, 4, '::1'),
(557, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-22 16:52:39', 1, 4, '::1'),
(558, 'Property [Siddhartha Resort, Chandrauta] Edit Succ', '2023-09-22 16:54:45', 1, 4, '::1'),
(559, 'Property [Siddhartha Hotel New Anand, Mahendranaga', '2023-09-22 16:55:03', 1, 4, '::1'),
(560, 'Property [Siddhartha Hotel Grand City, Birtamode] ', '2023-09-22 16:55:20', 1, 4, '::1'),
(561, 'Property [Siddhartha Boutique Hotel, Boudha] Edit ', '2023-09-22 16:55:36', 1, 4, '::1'),
(562, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-22 17:03:11', 1, 4, '::1'),
(563, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-22 17:24:10', 1, 4, '::1'),
(564, 'Property [Siddhartha Resort, Chandrauta] Edit Succ', '2023-09-22 17:26:19', 1, 4, '::1'),
(565, 'Property [Siddhartha Hotel New Anand, Mahendranaga', '2023-09-22 17:32:20', 1, 4, '::1'),
(566, 'Property [Siddhartha Hotel Grand City, Birtamode] ', '2023-09-22 17:32:37', 1, 4, '::1'),
(567, 'Property [Siddhartha River Side Resort, Chumlingta', '2023-09-22 17:32:52', 1, 4, '::1');
INSERT INTO `tbl_logs` (`id`, `action`, `registered`, `userid`, `user_action`, `ip_track`) VALUES
(568, 'Property [Hotel Siddhartha, Tikapur] Edit Successf', '2023-09-22 17:33:13', 1, 4, '::1'),
(569, 'Property [Hotel Siddhartha, Nepalgunj] Edit Succes', '2023-09-22 17:33:25', 1, 4, '::1'),
(570, 'Offers [Save 10% discount on teej]Data has added s', '2023-09-22 20:07:22', 1, 3, '::1'),
(571, 'Offers [Mileage card 20% off]Data has added succes', '2023-09-22 20:07:44', 1, 3, '::1'),
(572, 'Offers [10% food leverage]Data has added successfu', '2023-09-22 20:08:02', 1, 3, '::1'),
(573, 'Offers [heavy discount on dashain<]Data has added ', '2023-09-22 20:08:20', 1, 3, '::1'),
(574, 'Offers [randome offer test wow looks great]Data ha', '2023-09-22 20:08:41', 1, 3, '::1'),
(575, 'Login: admin   logged in.', '2023-09-24 13:50:47', 1, 1, '::1'),
(576, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-24 14:07:04', 1, 4, '::1'),
(577, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-24 14:07:35', 1, 4, '::1'),
(578, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-24 14:08:57', 1, 4, '::1'),
(579, 'Login: admin   logged in.', '2023-09-25 11:19:19', 1, 1, '::1'),
(580, 'Login: admin   logged in.', '2023-09-25 17:46:39', 1, 1, '::1'),
(581, 'User [admin  ] Edit Successfully', '2023-09-26 07:40:01', 1, 4, '::1'),
(582, 'Advertisement [become a member] Edit Successfully', '2023-09-26 07:57:01', 1, 4, '::1'),
(583, 'Advertisement [room] Edit Successfully', '2023-09-26 07:57:55', 1, 4, '::1'),
(584, 'Advertisement [new year 2080] Edit Successfully', '2023-09-26 07:58:26', 1, 4, '::1'),
(585, 'Advertisement [rooom]Data has added successfully.', '2023-09-26 07:58:45', 1, 3, '::1'),
(586, 'Menu [home] Edit Successfully', '2023-09-26 08:52:27', 1, 4, '::1'),
(587, 'Menu [hotels] Edit Successfully', '2023-09-26 08:55:17', 1, 4, '::1'),
(588, 'Menu [HOTELS AND RESORTS] CreatedData has added su', '2023-09-26 08:55:44', 1, 3, '::1'),
(589, 'Menu [RESTAURANT] CreatedData has added successful', '2023-09-26 08:58:50', 1, 3, '::1'),
(590, 'Menu [SCAFE] CreatedData has added successfully.', '2023-09-26 08:59:10', 1, 3, '::1'),
(591, 'Menu [home] Edit Successfully', '2023-09-26 10:08:30', 1, 4, '::1'),
(592, 'Menu [home] Edit Successfully', '2023-09-26 10:08:47', 1, 4, '::1'),
(593, 'Menu [home] Edit Successfully', '2023-09-26 10:09:49', 1, 4, '::1'),
(594, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-26 10:37:39', 1, 4, '::1'),
(595, 'Login: admin   logged in.', '2023-09-26 10:37:43', 1, 1, '::1'),
(596, 'Login: admin   logged in.', '2023-09-26 10:45:11', 1, 1, '::1'),
(597, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-26 10:53:21', 1, 4, '::1'),
(598, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-26 10:54:13', 1, 4, '::1'),
(599, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-26 11:13:04', 1, 4, '::1'),
(600, 'Menu [In the news] CreatedData has added successfu', '2023-09-26 11:55:55', 1, 3, '::1'),
(601, 'Login: admin   logged in.', '2023-09-26 12:05:53', 1, 1, '::1'),
(602, 'Menu [pricing] CreatedData has added successfully.', '2023-09-26 12:06:14', 1, 3, '::1'),
(603, 'Menu [action] CreatedData has added successfully.', '2023-09-26 12:06:47', 1, 3, '::1'),
(604, 'Menu [home] Edit Successfully', '2023-09-26 12:49:59', 1, 4, '::1'),
(605, 'Menu [contact] CreatedData has added successfully.', '2023-09-26 12:51:48', 1, 3, '::1'),
(606, 'Login: admin   logged in.', '2023-09-26 13:32:46', 1, 1, '::1'),
(607, 'Menu [find a hotel] CreatedData has added successf', '2023-09-26 13:33:11', 1, 3, '::1'),
(608, 'Login: admin   logged in.', '2023-09-26 13:36:24', 1, 1, '::1'),
(609, 'Login: admin   logged in.', '2023-09-26 14:48:58', 1, 1, '27.34.76.138'),
(610, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-26 14:58:58', 1, 4, '27.34.76.138'),
(611, 'Login: admin   logged in.', '2023-09-26 16:55:11', 1, 1, '103.10.29.70'),
(612, 'Menu [Find a Hotel] Edit Successfully', '2023-09-26 16:55:52', 1, 4, '103.10.29.70'),
(613, 'Menu [Membership] Edit Successfully', '2023-09-26 16:56:17', 1, 4, '103.10.29.70'),
(614, 'Menu [Meeting & Events] Edit Successfully', '2023-09-26 16:57:44', 1, 4, '103.10.29.70'),
(615, 'Menu [Offers] Edit Successfully', '2023-09-26 16:58:02', 1, 4, '103.10.29.70'),
(616, 'Menu  [Vehicle]Data has deleted successfully.', '2023-09-26 16:58:35', 1, 6, '103.10.29.70'),
(617, 'Menu  [Attractions]Data has deleted successfully.', '2023-09-26 16:58:38', 1, 6, '103.10.29.70'),
(618, 'Menu  [Contact Us]Data has deleted successfully.', '2023-09-26 16:58:41', 1, 6, '103.10.29.70'),
(619, 'Menu [About Us] Edit Successfully', '2023-09-26 16:59:00', 1, 4, '103.10.29.70'),
(620, 'Menu  [contact]Data has deleted successfully.', '2023-09-26 16:59:18', 1, 6, '103.10.29.70'),
(621, 'Menu  [action]Data has deleted successfully.', '2023-09-26 16:59:30', 1, 6, '103.10.29.70'),
(622, 'Menu [Meeting & Events] Edit Successfully', '2023-09-26 17:01:50', 1, 4, '103.10.29.70'),
(623, 'Menu [Offers] Edit Successfully', '2023-09-26 17:02:00', 1, 4, '103.10.29.70'),
(624, 'Menu [Hotel Siddhartha Nepalgunj] CreatedData has ', '2023-09-26 17:02:57', 1, 3, '103.10.29.70'),
(625, 'Menu [Hotel Vilasa Banbas] CreatedData has added s', '2023-09-26 17:03:40', 1, 3, '103.10.29.70'),
(626, 'Menu [Hotel & Resort] CreatedData has added succes', '2023-09-26 17:04:04', 1, 3, '103.10.29.70'),
(627, 'Menu [Hotel Siddhartha Nepalgunj] Edit Successfull', '2023-09-26 17:04:27', 1, 4, '103.10.29.70'),
(628, 'Menu [Hotel Vilasa Banbas] Edit Successfully', '2023-09-26 17:04:51', 1, 4, '103.10.29.70'),
(629, 'Menu [Restaurants] CreatedData has added successfu', '2023-09-26 17:05:13', 1, 3, '103.10.29.70'),
(630, 'Menu [Cafes] CreatedData has added successfully.', '2023-09-26 17:05:44', 1, 3, '103.10.29.70'),
(631, 'Menu [Siddhartha Boutique Hotel, Bouddhanath Kathm', '2023-09-26 17:07:03', 1, 3, '103.10.29.70'),
(632, 'Menu [Siddhartha Cottage Restaurant, Nepalgunj] Cr', '2023-09-26 17:07:46', 1, 3, '103.10.29.70'),
(633, 'Menu [Siddhartha Cottage Restaurant, Butwal] Creat', '2023-09-26 17:08:05', 1, 3, '103.10.29.70'),
(634, 'Menu [Siddhartha Foodland, Old Baneshwor ] Created', '2023-09-26 17:08:30', 1, 3, '103.10.29.70'),
(635, 'Changes on Page \'SIDDHARTHA Business Group of<br/>', '2023-09-26 17:09:54', 1, 4, '103.10.29.70'),
(636, 'Changes on Page \'SIDDHARTHA Business Group of<br/>', '2023-09-26 17:10:48', 1, 4, '103.10.29.70'),
(637, 'Changes on Page \'SIDDHARTHA Business Group of<br/>', '2023-09-26 17:11:46', 1, 4, '103.10.29.70'),
(638, 'Property [Hotel Siddhartha, Tikapur] Edit Successf', '2023-09-26 17:18:04', 1, 4, '103.10.29.70'),
(639, 'Login: admin   logged in.', '2023-09-26 17:21:57', 1, 1, '27.34.2.119'),
(640, 'Advertisement [new year 2080] Edit Successfully', '2023-09-26 17:25:22', 1, 4, '103.10.29.70'),
(641, 'Advertisement [room] Edit Successfully', '2023-09-26 17:25:43', 1, 4, '103.10.29.70'),
(642, 'Advertisement [rooom] Edit Successfully', '2023-09-26 17:26:21', 1, 4, '103.10.29.70'),
(643, 'Offers [randome offer test wow looks great] Edit S', '2023-09-26 17:27:18', 1, 4, '103.10.29.70'),
(644, 'Offers [heavy discount on dashain<] Edit Successfu', '2023-09-26 17:27:54', 1, 4, '103.10.29.70'),
(645, 'Offers [10% food leverage] Edit Successfully', '2023-09-26 17:29:19', 1, 4, '103.10.29.70'),
(646, 'Offers [Mileage card 20% off] Edit Successfully', '2023-09-26 17:29:38', 1, 4, '103.10.29.70'),
(647, 'Advertisement [rooom] Edit Successfully', '2023-09-26 17:54:58', 1, 4, '103.10.29.70'),
(648, 'Advertisement [room] Edit Successfully', '2023-09-26 17:56:55', 1, 4, '103.10.29.70'),
(649, 'Advertisement [new year 2080] Edit Successfully', '2023-09-26 17:57:21', 1, 4, '103.10.29.70'),
(650, 'Changes on Config \'Siddhartha Hospitality\' has bee', '2023-09-26 18:04:45', 1, 4, '27.34.2.119'),
(651, 'Changes on Config \'Siddhartha Hospitality\' has bee', '2023-09-26 18:05:45', 1, 4, '27.34.2.119'),
(652, 'Changes on Config \'Siddhartha Hospitality\' has bee', '2023-09-26 18:18:09', 1, 4, '103.10.29.70'),
(653, 'Changes on Config \'Siddhartha Hospitality\' has bee', '2023-09-26 18:20:25', 1, 4, '103.10.29.70'),
(654, 'Menu [Contact Us] Edit Successfully', '2023-09-26 18:21:17', 1, 4, '103.10.29.70'),
(655, 'Menu [About Siddhartha Hospitality] CreatedData ha', '2023-09-26 18:21:33', 1, 3, '103.10.29.70'),
(656, 'Login: admin   logged in.', '2023-09-26 18:21:40', 1, 1, '113.199.255.159'),
(657, 'Menu [Careers] CreatedData has added successfully.', '2023-09-26 18:21:44', 1, 3, '103.10.29.70'),
(658, 'Menu [Download Our App] CreatedData has added succ', '2023-09-26 18:21:58', 1, 3, '103.10.29.70'),
(659, 'Menu [Become a member] CreatedData has added succe', '2023-09-26 18:22:09', 1, 3, '103.10.29.70'),
(660, 'Menu [Development/Franchisee Opportunities] Create', '2023-09-26 18:22:21', 1, 3, '103.10.29.70'),
(661, 'Menu [Blog] CreatedData has added successfully.', '2023-09-26 18:22:40', 1, 3, '103.10.29.70'),
(662, 'Menu [In the news] CreatedData has added successfu', '2023-09-26 18:22:54', 1, 3, '103.10.29.70'),
(663, 'Menu [FAQs] CreatedData has added successfully.', '2023-09-26 18:23:05', 1, 3, '103.10.29.70'),
(664, 'Menu [Deals and Offers] CreatedData has added succ', '2023-09-26 18:23:15', 1, 3, '103.10.29.70'),
(665, 'Menu [Sitemap] CreatedData has added successfully.', '2023-09-26 18:23:29', 1, 3, '103.10.29.70'),
(666, 'Menu [Contact Us] Edit Successfully', '2023-09-26 18:29:41', 1, 4, '103.10.29.70'),
(667, 'SocialNetworking [Facebook] Edit Successfully', '2023-09-26 18:30:23', 1, 4, '103.10.29.70'),
(668, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-26 18:34:47', 1, 4, '27.34.2.119'),
(669, 'Changes on Config \'Siddhartha Hospitality\' has bee', '2023-09-26 18:39:20', 1, 4, '103.10.29.70'),
(670, 'Changes on Config \'Siddhartha Hospitality\' has bee', '2023-09-26 18:44:29', 1, 4, '103.10.29.70'),
(671, 'Menu [Privacy Policy] Edit Successfully', '2023-09-26 18:47:47', 1, 4, '103.10.29.70'),
(672, 'Changes on Page \'privacy\' has been saved successfu', '2023-09-26 19:02:02', 1, 4, '103.10.29.70'),
(673, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-27 00:03:41', 1, 4, '::1'),
(674, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-27 00:05:16', 1, 4, '::1'),
(675, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-27 00:12:20', 1, 4, '::1'),
(676, 'Login: admin   logged in.', '2023-09-27 15:37:20', 1, 1, '::1'),
(677, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-27 15:38:08', 1, 4, '::1'),
(678, 'Property [Siddhartha Lumbini Green Resort] Edit Su', '2023-09-27 15:49:58', 1, 4, '::1'),
(679, 'User [admin  ] Edit Successfully', '2023-09-27 15:50:21', 1, 4, '::1'),
(680, 'Level \'Level 0\' has added successfully.', '2023-09-27 15:50:37', 1, 3, '::1'),
(681, 'Level \'Level 1\' has added successfully.', '2023-09-27 15:50:48', 1, 3, '::1'),
(682, 'Price range \'\' has added successfully.', '2023-09-27 15:51:04', 1, 3, '::1'),
(683, 'Price range \'\' has added successfully.', '2023-09-27 15:51:25', 1, 3, '::1'),
(684, 'Reward \'test\' has added successfully.', '2023-09-27 15:53:09', 1, 3, '::1'),
(685, 'Changes on Level \'Level 1\' has been saved successf', '2023-09-27 16:00:29', 1, 4, '::1'),
(686, 'Changes on Level \'Level 1\' has been saved successf', '2023-09-27 16:01:33', 1, 4, '::1'),
(687, 'Points \'\' has added successfully.', '2023-09-27 16:26:04', 1, 3, '::1'),
(688, 'Level \'ets\' has added successfully.', '2023-09-27 16:38:54', 1, 3, '::1'),
(689, 'Changes on Points \'\' has been saved successfully.', '2023-09-27 16:39:02', 1, 4, '::1'),
(690, 'Level  [ets]Data has deleted successfully.', '2023-09-27 16:39:34', 1, 6, '::1'),
(691, 'Changes on Points \'\' has been saved successfully.', '2023-09-27 16:39:41', 1, 4, '::1'),
(692, 'Level \'asd\' has added successfully.', '2023-09-27 16:39:51', 1, 3, '::1'),
(693, 'Changes on Points \'\' has been saved successfully.', '2023-09-27 16:39:58', 1, 4, '::1'),
(694, 'Level  [asd]Data has deleted successfully.', '2023-09-27 16:40:03', 1, 6, '::1'),
(695, 'Changes on Points \'\' has been saved successfully.', '2023-09-27 16:40:10', 1, 4, '::1'),
(696, 'Reward \'sadasd\' has added successfully.', '2023-09-27 16:48:15', 1, 3, '::1'),
(697, 'Prize \'asdasd\' has added successfully.', '2023-09-27 16:49:46', 1, 3, '::1'),
(698, 'Prize  [asdasd]Data has deleted successfully.', '2023-09-27 16:49:52', 1, 6, '::1'),
(699, 'Prize \'erasdasd\' has added successfully.', '2023-09-27 16:56:11', 1, 3, '::1'),
(700, 'Login: admin   logged in.', '2023-09-29 11:33:52', 1, 1, '::1'),
(701, 'User [Swarna Shakya  ] Edit Successfully', '2023-09-29 11:40:15', 1, 4, '::1'),
(702, 'User [admin  ] Edit Successfully', '2023-09-29 11:51:59', 1, 4, '::1'),
(703, 'User [Swarna Shakya  ] Edit Successfully', '2023-09-29 12:19:59', 1, 4, '::1'),
(704, 'User [Sharan  ] login Created Data has added succe', '2023-09-29 12:34:07', 1, 3, '::1'),
(705, 'User [Swarna Shakya  ] Edit Successfully', '2023-09-29 12:35:56', 1, 4, '::1'),
(706, 'User [Sharan  ] Edit Successfully', '2023-09-29 12:36:03', 1, 4, '::1'),
(707, 'User [asdasd  ] login Created Data has added succe', '2023-09-29 12:36:21', 1, 3, '::1'),
(708, 'User [test  ] login Created Data has added success', '2023-09-29 12:42:01', 1, 3, '::1'),
(709, 'User [sadasdasd  ] login Created Data has added su', '2023-09-29 12:47:11', 1, 3, '::1'),
(710, 'User [asdasd  ] Edit Successfully', '2023-09-29 12:48:06', 1, 4, '::1'),
(711, 'User [asdasd  ]Data has deleted successfully.', '2023-09-29 12:48:12', 1, 6, '::1'),
(712, 'User [  ]Data has deleted successfully.', '2023-09-29 12:48:14', 1, 6, '::1'),
(713, 'User [sadasdasd  ]Data has deleted successfully.', '2023-09-29 12:48:14', 1, 6, '::1'),
(714, 'User [test123`  ] login Created Data has added suc', '2023-09-29 12:51:54', 1, 3, '::1'),
(715, 'User [test123`  ] Edit Successfully', '2023-09-29 12:53:23', 1, 4, '::1'),
(716, 'User [testadasd  ] login Created Data has added su', '2023-09-29 12:54:05', 1, 3, '::1'),
(717, 'User [Sharan  ] Edit Successfully', '2023-09-29 13:40:36', 1, 4, '::1'),
(718, 'User [Test 8  ] login Created Data has added succe', '2023-09-29 13:41:33', 1, 3, '::1'),
(719, 'Level \'tsed\' has added successfully.', '2023-09-29 13:51:09', 1, 3, '::1'),
(720, 'User [Test 8  ] Edit Successfully', '2023-09-29 14:01:48', 1, 4, '::1'),
(721, 'User [Test 8  ] Edit Successfully', '2023-09-29 14:02:19', 1, 4, '::1'),
(722, 'User [Test 8  ] Edit Successfully', '2023-09-29 14:03:00', 1, 4, '::1'),
(723, 'Property [Siddhartha Resort, Chandrauta] Edit Succ', '2023-09-29 14:40:27', 1, 4, '::1'),
(724, 'User [Test 8  ] Edit Successfully', '2023-09-29 15:04:47', 1, 4, '::1'),
(725, 'User [Test 8  ] Edit Successfully', '2023-09-29 15:06:01', 1, 4, '::1'),
(726, 'User [Test 8  ] Edit Successfully', '2023-09-29 15:07:17', 1, 4, '::1'),
(727, 'User [Test 8  ] Edit Successfully', '2023-09-29 15:07:33', 1, 4, '::1'),
(728, 'User [Sharan  ] Edit Successfully', '2023-09-29 15:08:58', 1, 4, '::1'),
(729, 'User [Sharan  ] Edit Successfully', '2023-09-29 15:09:40', 1, 4, '::1'),
(730, 'Login: admin   logged in.', '2023-09-29 15:24:42', 1, 1, '::1'),
(731, 'User [Test 8  ] Edit Successfully', '2023-09-29 17:11:23', 1, 4, '::1'),
(732, 'User [Test 8  ] Edit Successfully', '2023-09-29 17:11:31', 1, 4, '::1'),
(733, 'User [Test 8  ] Edit Successfully', '2023-09-29 17:13:06', 1, 4, '::1'),
(734, 'User [Test 8  ] Edit Successfully', '2023-09-29 17:13:26', 1, 4, '::1'),
(735, 'User [Test 8  ] Edit Successfully', '2023-09-29 17:13:54', 1, 4, '::1'),
(736, 'User [Test 8  ] Edit Successfully', '2023-09-29 17:14:00', 1, 4, '::1'),
(737, 'User [Sharan  ] Edit Successfully', '2023-09-29 17:33:43', 1, 4, '::1'),
(738, 'Login: admin   logged in.', '2023-09-29 19:37:08', 1, 1, '::1'),
(739, 'User [Test 8  ] login Created Data has added succe', '2023-09-29 21:46:11', 1, 3, '::1'),
(740, 'User [Test 8  ]Data has deleted successfully.', '2023-09-29 21:55:00', 1, 6, '::1'),
(741, 'Login: admin   logged in.', '2023-09-30 09:24:45', 1, 1, '::1'),
(742, 'Login: admin   logged in.', '2023-10-01 11:36:34', 1, 1, '::1'),
(743, 'Changes on Points \'\' has been saved successfully.', '2023-10-01 12:33:41', 1, 4, '::1'),
(744, 'Level  [tsed]Data has deleted successfully.', '2023-10-01 12:45:08', 1, 6, '::1'),
(745, 'User [] Edit Successfully', '2023-10-01 13:04:52', 1, 4, '::1'),
(746, 'User [] Edit Successfully', '2023-10-01 13:06:05', 1, 4, '::1'),
(747, 'User [] Edit Successfully', '2023-10-01 13:13:56', 1, 4, '::1'),
(748, 'User [] Edit Successfully', '2023-10-01 13:14:22', 1, 4, '::1'),
(749, 'User [] Edit Successfully', '2023-10-01 13:15:44', 1, 4, '::1'),
(750, 'User [] Edit Successfully', '2023-10-01 13:33:00', 1, 4, '::1'),
(751, 'User [] Edit Successfully', '2023-10-01 13:34:06', 1, 4, '::1'),
(752, 'User [] Edit Successfully', '2023-10-01 13:35:05', 1, 4, '::1'),
(753, 'User [] Edit Successfully', '2023-10-01 13:36:09', 1, 4, '::1'),
(754, 'User [] Edit Successfully', '2023-10-01 13:36:31', 1, 4, '::1'),
(755, 'User [] Edit Successfully', '2023-10-01 13:40:12', 1, 4, '::1'),
(756, 'Level \'Level 3\' has added successfully.', '2023-10-01 13:44:09', 1, 3, '::1'),
(757, 'Points \'\' has added successfully.', '2023-10-01 13:44:54', 1, 3, '::1'),
(758, 'Changes on Points \'\' has been saved successfully.', '2023-10-01 13:45:05', 1, 4, '::1'),
(759, 'Changes on Points \'\' has been saved successfully.', '2023-10-01 13:45:10', 1, 4, '::1'),
(760, 'Changes on Points \'\' has been saved successfully.', '2023-10-01 13:45:15', 1, 4, '::1'),
(761, 'Prize \'asdasd\' has added successfully.', '2023-10-01 13:47:27', 1, 3, '::1'),
(762, 'Level \'Level 2\' has added successfully.', '2023-10-01 13:49:10', 1, 3, '::1'),
(763, 'Level  [Level 2]Data has deleted successfully.', '2023-10-01 13:52:26', 1, 6, '::1'),
(764, 'User [] Edit Successfully', '2023-10-01 13:53:19', 1, 4, '::1'),
(765, 'User [] Edit Successfully', '2023-10-01 13:53:43', 1, 4, '::1'),
(766, 'User [] Edit Successfully', '2023-10-01 13:54:05', 1, 4, '::1'),
(767, 'User [] Edit Successfully', '2023-10-01 13:56:04', 1, 4, '::1'),
(768, 'User [] Edit Successfully', '2023-10-01 13:56:35', 1, 4, '::1'),
(769, 'User [] Edit Successfully', '2023-10-01 13:56:59', 1, 4, '::1'),
(770, 'User [] Edit Successfully', '2023-10-01 13:57:37', 1, 4, '::1'),
(771, 'User [] Edit Successfully', '2023-10-01 13:57:56', 1, 4, '::1'),
(772, 'User [] Edit Successfully', '2023-10-01 14:01:53', 1, 4, '::1'),
(773, 'User [] Edit Successfully', '2023-10-01 14:02:20', 1, 4, '::1'),
(774, 'User [] Edit Successfully', '2023-10-01 14:03:35', 1, 4, '::1'),
(775, 'Prize  [asdasd]Data has deleted successfully.', '2023-10-01 14:40:28', 1, 6, '::1'),
(776, 'Prize \'LEvel 3 reward\' has added successfully.', '2023-10-01 14:40:42', 1, 3, '::1'),
(777, 'Prize  []Data has deleted successfully.', '2023-10-01 14:43:28', 1, 6, '::1'),
(778, 'Prize  [LEvel 3 reward]Data has deleted successful', '2023-10-01 14:43:28', 1, 6, '::1'),
(779, 'Prize \'level 3 \' has added successfully.', '2023-10-01 14:45:17', 1, 3, '::1'),
(780, 'Prize \'level3 asd\' has added successfully.', '2023-10-01 14:46:00', 1, 3, '::1'),
(781, 'Level \'Level 4\' has added successfully.', '2023-10-01 14:48:34', 1, 3, '::1'),
(782, 'Points \'\' has added successfully.', '2023-10-01 14:48:58', 1, 3, '::1'),
(783, 'Prize \'level4\' has added successfully.', '2023-10-01 14:49:23', 1, 3, '::1'),
(784, 'Changes on Prize \'level4\' has been saved successfu', '2023-10-01 14:52:41', 1, 4, '::1'),
(785, 'Changes on Prize \'level 3 \' has been saved success', '2023-10-01 14:53:37', 1, 4, '::1'),
(786, 'User [TEst10  ] login Created Data has added succe', '2023-10-01 14:54:24', 1, 3, '::1'),
(787, 'User [] Edit Successfully', '2023-10-01 14:55:02', 1, 4, '::1'),
(788, 'User [] Edit Successfully', '2023-10-01 15:00:15', 1, 4, '::1'),
(789, 'User [] Edit Successfully', '2023-10-01 15:02:45', 1, 4, '::1'),
(790, 'User [TESTI  ] login Created Data has added succes', '2023-10-01 15:05:35', 1, 3, '::1'),
(791, 'Changes on Prize \'erasdasd\' has been saved success', '2023-10-01 15:10:49', 1, 4, '::1'),
(792, 'Changes on Prize \'level4\' has been saved successfu', '2023-10-01 15:11:02', 1, 4, '::1'),
(793, 'Changes on Prize \'level3 asd\' has been saved succe', '2023-10-01 15:11:07', 1, 4, '::1'),
(794, 'User [Sharan  ]Data has deleted successfully.', '2023-10-01 15:19:45', 1, 6, '::1'),
(795, 'User [  ]Data has deleted successfully.', '2023-10-01 15:19:46', 1, 6, '::1'),
(796, 'User [TEst10  ]Data has deleted successfully.', '2023-10-01 15:19:46', 1, 6, '::1'),
(797, 'User [  ]Data has deleted successfully.', '2023-10-01 15:19:48', 1, 6, '::1'),
(798, 'User [  ]Data has deleted successfully.', '2023-10-01 15:19:48', 1, 6, '::1'),
(799, 'User [TESTI  ]Data has deleted successfully.', '2023-10-01 15:19:48', 1, 6, '::1'),
(800, 'User [  ]Data has deleted successfully.', '2023-10-01 15:19:50', 1, 6, '::1'),
(801, 'User [  ]Data has deleted successfully.', '2023-10-01 15:19:50', 1, 6, '::1'),
(802, 'User [  ]Data has deleted successfully.', '2023-10-01 15:19:51', 1, 6, '::1'),
(803, 'User [Test 8  ]Data has deleted successfully.', '2023-10-01 15:19:51', 1, 6, '::1'),
(804, 'User [  ]Data has deleted successfully.', '2023-10-01 15:19:53', 1, 6, '::1'),
(805, 'User [  ]Data has deleted successfully.', '2023-10-01 15:19:53', 1, 6, '::1'),
(806, 'User [  ]Data has deleted successfully.', '2023-10-01 15:19:53', 1, 6, '::1'),
(807, 'User [  ]Data has deleted successfully.', '2023-10-01 15:19:53', 1, 6, '::1'),
(808, 'User [testadasd  ]Data has deleted successfully.', '2023-10-01 15:19:53', 1, 6, '::1'),
(809, 'Level  [Level 4]Data has deleted successfully.', '2023-10-01 15:20:00', 1, 6, '::1'),
(810, 'Level \'Level 0\' has added successfully.', '2023-10-01 15:20:13', 1, 3, '::1'),
(811, 'Level \'Level 2\' has added successfully.', '2023-10-01 15:20:30', 1, 3, '::1'),
(812, 'Level \'Level 23\' has added successfully.', '2023-10-01 15:20:48', 1, 3, '::1'),
(813, 'Points \'\' has added successfully.', '2023-10-01 15:21:04', 1, 3, '::1'),
(814, 'Points \'\' has added successfully.', '2023-10-01 15:21:18', 1, 3, '::1'),
(815, 'Prize \'prize1\' has added successfully.', '2023-10-01 15:21:35', 1, 3, '::1'),
(816, 'Prize \'Prize 2\' has added successfully.', '2023-10-01 15:22:02', 1, 3, '::1'),
(817, 'Prize \'PRize 3\' has added successfully.', '2023-10-01 15:22:17', 1, 3, '::1'),
(818, 'User [Test1  ] login Created Data has added succes', '2023-10-01 15:22:50', 1, 3, '::1'),
(819, 'User [Test1  ] Edit Successfully', '2023-10-01 15:24:31', 1, 4, '::1'),
(820, 'User [] Edit Successfully', '2023-10-01 15:24:52', 1, 4, '::1'),
(821, 'User [] Edit Successfully', '2023-10-01 15:27:37', 1, 4, '::1'),
(822, 'User [] Edit Successfully', '2023-10-01 15:30:11', 1, 4, '::1'),
(823, 'User [] Edit Successfully', '2023-10-01 15:32:00', 1, 4, '::1'),
(824, 'Login: admin   logged in.', '2023-10-01 15:37:40', 1, 1, '::1'),
(825, 'Login: admin   logged in.', '2023-10-01 15:54:52', 1, 1, '::1'),
(826, 'User [] Edit Successfully', '2023-10-01 16:47:53', 1, 4, '::1'),
(827, 'User [Test1  ] Edit Successfully', '2023-10-01 16:55:29', 1, 4, '::1'),
(828, 'User [] Edit Successfully', '2023-10-01 17:07:23', 1, 4, '::1'),
(829, 'Level \'10000\' has added successfully.', '2023-10-01 17:12:18', 1, 3, '::1'),
(830, 'User [Test 8  ] login Created Data has added succe', '2023-10-01 17:15:54', 1, 3, '::1'),
(831, 'User [] Edit Successfully', '2023-10-01 17:16:49', 1, 4, '::1'),
(832, 'User [] Edit Successfully', '2023-10-01 17:16:59', 1, 4, '::1'),
(833, 'User [] Edit Successfully', '2023-10-01 17:17:25', 1, 4, '::1'),
(834, 'User [Test 8  ] Edit Successfully', '2023-10-01 17:17:49', 1, 4, '::1'),
(835, 'User [] Edit Successfully', '2023-10-01 17:18:24', 1, 4, '::1'),
(836, 'User [] Edit Successfully', '2023-10-01 17:25:30', 1, 4, '::1'),
(837, 'User [] Edit Successfully', '2023-10-01 17:25:47', 1, 4, '::1'),
(838, 'User [] Edit Successfully', '2023-10-01 17:30:29', 1, 4, '::1'),
(839, 'User [] Edit Successfully', '2023-10-01 17:31:33', 1, 4, '::1'),
(840, 'User [] Edit Successfully', '2023-10-01 17:31:44', 1, 4, '::1'),
(841, 'User [] Edit Successfully', '2023-10-01 17:32:29', 1, 4, '::1'),
(842, 'User [Test 45  ] login Created Data has added succ', '2023-10-01 17:33:25', 1, 3, '::1'),
(843, 'User [Test 45  ] Edit Successfully', '2023-10-01 17:33:41', 1, 4, '::1'),
(844, 'User [] Edit Successfully', '2023-10-01 17:33:51', 1, 4, '::1'),
(845, 'User [] Edit Successfully', '2023-10-01 17:34:13', 1, 4, '::1'),
(846, 'User [] Edit Successfully', '2023-10-01 17:34:27', 1, 4, '::1'),
(847, 'User [] Edit Successfully', '2023-10-01 17:34:45', 1, 4, '::1'),
(848, 'User [] Edit Successfully', '2023-10-01 17:35:32', 1, 4, '::1'),
(849, 'User [] Edit Successfully', '2023-10-01 17:39:24', 1, 4, '::1'),
(850, 'Points \'\' has added successfully.', '2023-10-01 18:12:47', 1, 3, '::1'),
(851, 'User [] Edit Successfully', '2023-10-01 18:14:50', 1, 4, '::1'),
(852, 'User [sadasd  ] login Created Data has added succe', '2023-10-01 18:18:30', 1, 3, '::1'),
(853, 'User [] Edit Successfully', '2023-10-01 18:28:30', 1, 4, '::1'),
(854, 'User [sadasd  ] Edit Successfully', '2023-10-01 18:46:27', 1, 4, '::1'),
(855, 'User [asd  ] login Created Data has added successf', '2023-10-01 18:47:23', 1, 3, '::1'),
(856, 'User [asd  ]Data has deleted successfully.', '2023-10-01 18:48:03', 1, 6, '::1'),
(857, 'User [Test 4   ] login Created Data has added succ', '2023-10-01 18:53:28', 1, 3, '::1'),
(858, 'User [asdasdasd  ] login Created Data has added su', '2023-10-01 18:56:12', 1, 3, '::1'),
(859, 'User [asdasdasd  ]Data has deleted successfully.', '2023-10-01 18:57:11', 1, 6, '::1'),
(860, 'User [  ]Data has deleted successfully.', '2023-10-01 18:57:14', 1, 6, '::1'),
(861, 'User [Swarna Shakya  ]Data has deleted successfull', '2023-10-01 18:57:14', 1, 6, '::1'),
(862, 'User [  ]Data has deleted successfully.', '2023-10-01 18:57:16', 1, 6, '::1'),
(863, 'User [  ]Data has deleted successfully.', '2023-10-01 18:57:16', 1, 6, '::1'),
(864, 'User [test123`  ]Data has deleted successfully.', '2023-10-01 18:57:16', 1, 6, '::1'),
(865, 'User [  ]Data has deleted successfully.', '2023-10-01 18:57:18', 1, 6, '::1'),
(866, 'User [  ]Data has deleted successfully.', '2023-10-01 18:57:18', 1, 6, '::1'),
(867, 'User [  ]Data has deleted successfully.', '2023-10-01 18:57:18', 1, 6, '::1'),
(868, 'User [test  ]Data has deleted successfully.', '2023-10-01 18:57:18', 1, 6, '::1'),
(869, 'User [Test 4   ] Edit Successfully', '2023-10-01 19:00:48', 1, 4, '::1'),
(870, 'User [] Edit Successfully', '2023-10-01 19:00:58', 1, 4, '::1'),
(871, 'User [] Edit Successfully', '2023-10-01 19:01:06', 1, 4, '::1'),
(872, 'User [] Edit Successfully', '2023-10-01 19:13:18', 1, 4, '::1'),
(873, 'Login: admin   logged in.', '2023-10-01 19:30:33', 1, 1, '::1'),
(874, 'Level \'Level1231\' has added successfully.', '2023-10-01 19:43:02', 1, 3, '::1'),
(875, 'User [] Edit Successfully', '2023-10-01 19:45:34', 1, 4, '::1'),
(876, 'User [] Edit Successfully', '2023-10-01 19:47:14', 1, 4, '::1'),
(877, 'User [] Edit Successfully', '2023-10-01 19:47:37', 1, 4, '::1'),
(878, 'User [] Edit Successfully', '2023-10-01 19:48:41', 1, 4, '::1'),
(879, 'User [] Edit Successfully', '2023-10-01 19:48:58', 1, 4, '::1'),
(880, 'User [] Edit Successfully', '2023-10-01 19:49:07', 1, 4, '::1'),
(881, 'User [] Edit Successfully', '2023-10-01 19:49:15', 1, 4, '::1'),
(882, 'User [] Edit Successfully', '2023-10-01 19:49:45', 1, 4, '::1'),
(883, 'User [] Edit Successfully', '2023-10-01 19:50:37', 1, 4, '::1'),
(884, 'User [] Edit Successfully', '2023-10-01 19:50:53', 1, 4, '::1'),
(885, 'User [] Edit Successfully', '2023-10-01 19:51:11', 1, 4, '::1'),
(886, 'Changes on Points \'\' has been saved successfully.', '2023-10-01 19:53:19', 1, 4, '::1'),
(887, 'Level  [Level1231]Data has deleted successfully.', '2023-10-01 19:53:57', 1, 6, '::1'),
(888, 'Changes on Points \'\' has been saved successfully.', '2023-10-01 19:54:27', 1, 4, '::1'),
(889, 'User [] Edit Successfully', '2023-10-01 19:54:30', 1, 4, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs_action`
--

CREATE TABLE `tbl_logs_action` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `bgcolor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_logs_action`
--

INSERT INTO `tbl_logs_action` (`id`, `title`, `icon`, `bgcolor`) VALUES
(1, 'Login', 'icon-sign-in', 'bg-blue'),
(2, 'Logout', 'icon-sign-out', 'primary-bg'),
(3, 'Add', 'icon-plus-circle', 'bg-green'),
(4, 'Edit', 'icon-edit', 'bg-blue-alt'),
(5, 'Copy', 'icon-copy', 'ui-state-default'),
(6, 'Delete', 'icon-clock-os-circle', 'bg-red');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `linksrc` varchar(150) NOT NULL,
  `parentOf` int(11) NOT NULL DEFAULT 0,
  `linktype` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) NOT NULL,
  `style` tinyint(4) NOT NULL DEFAULT 0,
  `module` varchar(255) NOT NULL,
  `module_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `name`, `linksrc`, `parentOf`, `linktype`, `status`, `sortorder`, `added_date`, `style`, `module`, `module_id`, `type`, `icon`) VALUES
(5, 'Meeting & Events', '#', 0, '0', 1, 2, '2017-07-10 11:23:15', 0, 'undefined', 0, 1, ''),
(16, 'Blog', '#', 0, '0', 1, 9, '2017-07-10 14:58:16', 0, 'undefined', 0, 2, ''),
(17, 'Privacy Policy', 'page/privacy', 0, '0', 1, 8, '2017-07-10 14:58:28', 0, 'undefined', 0, 2, ''),
(19, 'Services', 'pages/services', 19, '0', 1, 6, '2017-07-14 12:42:54', 0, 'articles', 2, 2, ''),
(91, 'Hotel Vilasa Banbas', '#', 92, '0', 1, 2, '2023-09-26 17:03:40', 0, '', 0, 1, ''),
(59, 'Offers', '#', 0, '0', 1, 3, '2017-08-14 14:58:08', 0, 'undefined', 0, 1, ''),
(77, 'Contact Us', 'contact', 0, '0', 1, 7, '2018-11-26 20:58:38', 0, 'None', 0, 2, ''),
(93, 'Restaurants', '#', 89, '0', 1, 4, '2023-09-26 17:05:13', 0, '', 0, 1, ''),
(92, 'Hotel & Resort', '#', 89, '0', 1, 3, '2023-09-26 17:04:04', 0, '', 0, 1, ''),
(82, 'HOTELS AND RESORTS', '#', 59, '0', 0, 1, '2023-09-26 08:55:44', 0, '', 0, 1, ''),
(83, 'RESTAURANT', '#', 59, '0', 0, 2, '2023-09-26 08:58:50', 0, '', 0, 1, ''),
(84, 'SCAFE', '#', 59, '0', 0, 3, '2023-09-26 08:59:10', 0, '', 0, 1, ''),
(85, 'In the news', 'page/siddhartha-business-group-of-br-hospitality-pvt-ltd', 0, '0', 1, 10, '2023-09-26 11:55:55', 0, '', 0, 3, ''),
(86, 'About Us', '#', 0, '0', 1, 11, '2023-09-26 12:06:14', 0, '', 0, 1, ''),
(90, 'Hotel Siddhartha Nepalgunj', '#', 92, '0', 1, 1, '2023-09-26 17:02:57', 0, '', 0, 1, ''),
(89, 'Find a Hotel', '#', 0, '0', 1, 1, '2023-09-26 13:33:11', 0, '', 0, 1, ''),
(94, 'Cafes', '#', 89, '0', 1, 5, '2023-09-26 17:05:44', 0, '', 0, 1, ''),
(95, 'Siddhartha Boutique Hotel, Bouddhanath Kathmandu ', '#', 92, '0', 1, 3, '2023-09-26 17:07:03', 0, '', 0, 1, ''),
(96, 'Siddhartha Cottage Restaurant, Nepalgunj', '#', 93, '0', 1, 1, '2023-09-26 17:07:46', 0, '', 0, 1, ''),
(97, 'Siddhartha Cottage Restaurant, Butwal', '#', 93, '0', 1, 2, '2023-09-26 17:08:05', 0, '', 0, 1, ''),
(98, 'Siddhartha Foodland, Old Baneshwor ', '#', 94, '0', 1, 1, '2023-09-26 17:08:30', 0, '', 0, 1, ''),
(99, 'About Siddhartha Hospitality', '#', 0, '0', 1, 12, '2023-09-26 18:21:33', 0, '', 0, 2, ''),
(100, 'Careers', '#', 0, '0', 1, 13, '2023-09-26 18:21:44', 0, '', 0, 2, ''),
(101, 'Download Our App', '#', 0, '0', 1, 14, '2023-09-26 18:21:58', 0, '', 0, 2, ''),
(102, 'Become a member', '#', 0, '0', 1, 15, '2023-09-26 18:22:09', 0, '', 0, 2, ''),
(103, 'Development/Franchisee Opportunities', '@', 0, '0', 1, 16, '2023-09-26 18:22:21', 0, '', 0, 2, ''),
(104, 'Blog', '#', 0, '0', 1, 17, '2023-09-26 18:22:40', 0, '', 0, 3, ''),
(105, 'In the news', '#', 0, '0', 1, 18, '2023-09-26 18:22:54', 0, '', 0, 3, ''),
(106, 'FAQs', '#', 0, '0', 1, 19, '2023-09-26 18:23:05', 0, '', 0, 3, ''),
(107, 'Deals and Offers', '#', 0, '0', 1, 20, '2023-09-26 18:23:15', 0, '', 0, 3, ''),
(108, 'Sitemap', '#', 0, '0', 1, 21, '2023-09-26 18:23:29', 0, '', 0, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_modules`
--

CREATE TABLE `tbl_modules` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL DEFAULT 'dashboard',
  `mode` varchar(20) NOT NULL,
  `icon_link` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `sortorder` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `properties` varchar(255) NOT NULL,
  `type` enum('admin','hotel') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_modules`
--

INSERT INTO `tbl_modules` (`id`, `parent_id`, `name`, `link`, `mode`, `icon_link`, `status`, `sortorder`, `added_date`, `properties`, `type`) VALUES
(1, 74, 'Admin Users', 'user/list', 'user', 'icon-users', 1, 1, '0000-00-00', '', 'admin'),
(12, 0, 'Setting Mgmt', '', '', 'icon-gear', 1, 13, '0000-00-00', '', 'admin'),
(30, 0, 'Rooms Management', 'roomapi/list', 'roomapi', 'icon-gear', 1, 1, '2016-03-23', '', 'hotel'),
(31, 30, 'Rooms', 'roomapi/list', 'roomapi', 'icon-gear', 0, 2, '2016-03-23', '', 'hotel'),
(32, 30, 'Add Room', 'roomapi/form', 'roomapi', 'icon-gear', 0, 1, '2016-03-23', '', 'hotel'),
(33, 44, 'Room Type', 'roomtype/list', 'roomtype', 'icon-gear', 1, 4, '2016-03-23', '', 'admin'),
(34, 44, 'Room Features', 'roomfeatures/list', 'roomfeatures', 'icon-gear', 0, 4, '2016-03-23', '', 'admin'),
(35, 0, 'Booking Management', 'reservation/list', 'reservation', 'icon-bullhorn', 1, 20, '2016-03-24', '', 'hotel'),
(36, 35, 'Inquiry Reservation', 'reservation/inquiry', 'reservation', 'icon-gear', 1, 1, '2016-03-24', '', 'hotel'),
(37, 35, 'Approved Reservation', 'reservation/approved', 'reservation', 'icon-gear', 1, 2, '2016-03-24', '', 'hotel'),
(38, 35, 'Active Reservation', 'reservation/active', 'reservation', 'icon-gear', 0, 3, '2016-03-24', '', 'hotel'),
(39, 35, 'Paid Reservation', 'reservation/paid', 'reservation', 'icon-gear', 0, 4, '2016-03-24', '', 'hotel'),
(40, 35, 'Search/Report Reservation', 'reservation/report', 'reservation', 'icon-gear', 1, 5, '2016-03-24', '', 'hotel'),
(41, 30, 'Season', 'season/list', 'season', 'icon-gear', 0, 5, '2016-03-28', '', 'hotel'),
(42, 30, 'Offers', 'roomoffers/list', 'roomoffers', 'icon-gear', 0, 6, '2016-03-29', '', 'hotel'),
(43, 35, 'Calender Booking', 'calenderbooking/list', 'calenderbooking', 'icon-gear', 1, 6, '2016-03-29', '', 'hotel'),
(44, 0, 'Property Mgmt', 'hotelapi/list', 'hotel', 'icon-hospital-o', 1, 3, '2016-04-03', '', 'admin'),
(45, 74, 'Property Users', 'hoteluser/list', 'hoteluser', 'icon-gear', 1, 1, '2016-04-03', '', 'admin'),
(46, 44, 'Property', 'hotelapi/list', 'hotels', 'icon-gear', 1, 2, '2016-04-03', '', 'admin'),
(47, 44, 'Booking Mgmt', 'reservation/report', 'reservation', 'icon-bullhorn', 0, 4, '2016-05-01', '', 'admin'),
(48, 61, 'Menu Mgmt', 'menu/list', 'menu', 'icon-list', 1, 1, '2016-07-17', 'a:1:{s:5:\"level\";s:1:\"2\";}', 'admin'),
(49, 61, 'Page Mgmt', 'page/list', 'page', 'icon-adn', 1, 2, '2016-07-17', 'a:2:{s:8:\"imgwidth\";s:4:\"1100\";s:9:\"imgheight\";s:3:\"600\";}', 'admin'),
(50, 61, 'Slideshow Mgmt', 'slideshow/list', 'slideshow', 'icon-film', 1, 4, '2016-07-17', 'a:2:{s:8:\"imgwidth\";s:4:\"1920\";s:9:\"imgheight\";s:3:\"800\";}', 'admin'),
(51, 61, 'Social Link Mgmt', 'social/list', 'social', 'icon-google-plus', 1, 21, '2016-07-17', 'a:2:{s:8:\"imgwidth\";s:2:\"14\";s:9:\"imgheight\";s:2:\"13\";}', 'admin'),
(52, 61, 'Testimonial Mgmt', 'testimonial/list', 'testimonial', 'icon-list-alt', 0, 18, '2016-07-17', 'a:2:{s:8:\"imgwidth\";s:3:\"100\";s:9:\"imgheight\";s:3:\"100\";}', 'admin'),
(53, 61, 'Subscribers Mgmt', 'subscribers/list', 'subscribers', 'icon-comments', 0, 19, '2016-07-17', '', 'admin'),
(54, 12, 'Preference Mgmt', 'preference/list', 'preference', 'icon-gear', 1, 1, '2016-07-18', 'a:4:{s:8:\"imgwidth\";s:2:\"50\";s:9:\"imgheight\";s:2:\"50\";s:9:\"simgwidth\";s:3:\"125\";s:10:\"simgheight\";s:2:\"80\";}', 'admin'),
(55, 12, 'Office Info/Location', 'location/list', 'location', 'icon-gear', 1, 2, '2016-07-18', '', 'admin'),
(56, 61, 'News Mgmt', 'news/list', 'news', 'icon-list-alt', 0, 20, '2016-07-18', 'a:2:{s:8:\"imgwidth\";s:3:\"300\";s:9:\"imgheight\";s:3:\"300\";}', 'admin'),
(57, 0, 'Offers Mgmt', 'hoteloffer/list', 'hoteloffer', 'icon-gear', 0, 21, '2016-07-18', '', 'admin'),
(58, 0, 'Offers List', 'roomoffers/list', 'roomoffers', 'icon-gear', 0, 20, '2016-07-18', '', 'admin'),
(59, 44, 'Destination', 'destination/list', 'destination', 'icon-plane', 1, 1, '2021-02-11', '', 'admin'),
(60, 44, 'Service Mgmt', 'hotelservices/list', 'hotelservices', 'icon-gear', 1, 3, '2021-02-02', '', 'admin'),
(61, 0, 'CMS', 'dashboard', '', 'icon-gear', 1, 3, '2021-09-05', '', 'admin'),
(62, 44, 'Advertisement Mgmt', 'advertisement/list', 'advertisement', 'icon-indent', 1, 5, '2021-09-24', '', 'admin'),
(63, 44, 'Review Mgmt', 'review/list', 'review', 'icon-list', 0, 6, '2021-09-24', '', 'admin'),
(64, 0, 'Vehicle Service', '', '', 'icon-gear', 0, 60, '2021-02-02', '', 'admin'),
(65, 64, 'Route Manage', 'route/list', 'route', 'icon-gear', 1, 60, '2021-02-02', '', 'admin'),
(66, 64, 'Vehicle Manage', 'vehicle/list', 'vehicle', 'icon-gear', 1, 60, '2021-02-02', '', 'admin'),
(67, 64, 'Route & Rate', 'vprice/list', 'vprice', 'icon-gear', 1, 60, '2021-02-02', '', 'admin'),
(68, 0, 'Trip', '', '', 'icon-gift', 0, 4, '2021-09-29', '', 'admin'),
(69, 68, 'Activities Mgmt', 'activities/list', 'activities', 'icon-tags', 1, 2, '2021-09-29', 'a:6:{s:8:\"imgwidth\";s:3:\"380\";s:9:\"imgheight\";s:3:\"450\";s:11:\"mapimgwidth\";s:3:\"600\";s:12:\"mapimgheight\";s:3:\"500\";s:15:\"galleryimgwidth\";s:3:\"770\";s:16:\"galleryimgheight\";s:3:\"390\";}', 'admin'),
(70, 68, 'Package Mgmt', 'package/list', 'package', 'icon-gift', 1, 3, '2021-09-29', 'a:6:{s:8:\"imgwidth\";s:3:\"370\";s:9:\"imgheight\";s:3:\"220\";s:11:\"mapimgwidth\";s:3:\"770\";s:12:\"mapimgheight\";s:3:\"510\";s:15:\"galleryimgwidth\";s:4:\"1170\";s:16:\"galleryimgheight\";s:3:\"560\";}', 'admin'),
(71, 68, 'Booking Info mgmt', 'bookinginfo/list', 'bookinginfo', 'icon-exchange', 1, 4, '2021-10-03', '', 'admin'),
(72, 64, 'Booking Info mgmt', 'bookinginfovehicle/list', 'bookinginfovehicle', 'icon-exchange', 1, 61, '2021-10-03', '', 'admin'),
(73, 74, 'General Users', 'generaluser/list', 'generaluser', 'icon-user', 1, 2, '2021-10-03', '', 'admin'),
(74, 0, 'Users', '', '', 'icon-users', 1, 1, '2021-10-03', '', 'admin'),
(75, 44, 'Rating Mgmt', 'starrating/list', 'starrating', 'icon-star', 0, 3, '2021-10-08', '', 'admin'),
(76, 0, 'Vehicle Service', '', '', 'icon-gear', 0, 60, '2021-02-02', '', 'hotel'),
(77, 76, 'Route Manage', 'route/list', 'route', 'icon-gear', 1, 60, '2021-02-02', '', 'hotel'),
(78, 76, 'Vehicle Manage', 'vehicle/list', 'vehicle', 'icon-gear', 1, 60, '2021-02-02', '', 'hotel'),
(79, 76, 'Route & Rate', 'vprice/list', 'vprice', 'icon-gear', 1, 60, '2021-02-02', '', 'hotel'),
(80, 0, 'Trip', '', '', 'icon-gift', 0, 4, '2021-09-29', '', 'hotel'),
(81, 80, 'Activities Mgmt', 'activities/list', 'activities', 'icon-tags', 1, 2, '2021-09-29', 'a:6:{s:8:\"imgwidth\";s:3:\"380\";s:9:\"imgheight\";s:3:\"450\";s:11:\"mapimgwidth\";s:3:\"600\";s:12:\"mapimgheight\";s:3:\"500\";s:15:\"galleryimgwidth\";s:3:\"770\";s:16:\"galleryimgheight\";s:3:\"390\";}', 'hotel'),
(82, 80, 'Package Mgmt', 'package/list', 'package', 'icon-gift', 1, 3, '2021-09-29', 'a:6:{s:8:\"imgwidth\";s:3:\"370\";s:9:\"imgheight\";s:3:\"220\";s:11:\"mapimgwidth\";s:3:\"770\";s:12:\"mapimgheight\";s:3:\"510\";s:15:\"galleryimgwidth\";s:4:\"1170\";s:16:\"galleryimgheight\";s:3:\"560\";}', 'hotel'),
(83, 80, 'Booking Info mgmt', 'bookinginfo/list', 'bookinginfo', 'icon-exchange', 1, 4, '2021-10-03', '', 'hotel'),
(84, 76, 'Booking Info mgmt', 'bookinginfovehicle/list', 'bookinginfovehicle', 'icon-exchange', 1, 61, '2021-10-03', '', 'hotel'),
(85, 44, 'Cleaning & Safety Practices', 'cleaningsafety/list', 'cleaningsafety', 'icon-gear', 0, 5, '2021-10-25', '', 'admin'),
(86, 44, 'Policies Mgmt', 'policies/list', 'policies', 'icon-gear', 0, 5, '2021-10-25', '', 'admin'),
(87, 61, 'FAQ Mgmt', 'hotelfaq/list', 'hotelfaq', 'icon-list', 1, 5, '2021-10-25', '', 'admin'),
(88, 61, 'Gallery Mgmt', 'gallery/list', 'gallery', 'icon-picture-o', 0, 4, '2023-08-27', 'a:4:{s:8:\"imgwidth\";s:3:\"800\";s:9:\"imgheight\";s:3:\"600\";s:9:\"simgwidth\";s:3:\"400\";s:10:\"simgheight\";s:3:\"350\";}', 'admin'),
(89, 61, 'Video Mgmt', 'video/list', 'video', 'icon-hdd-o', 0, 5, '2023-08-27', '', 'admin'),
(90, 61, 'Popup Mgmt', 'popup/list', 'popup', 'icon-list', 1, 6, '2023-08-27', 'a:2:{s:8:\"imgwidth\";s:3:\"300\";s:9:\"imgheight\";s:3:\"300\";}', 'admin'),
(91, 0, 'Dining Hall', 'dininghall/list', 'dininghall', 'icon-h-square', 1, 2, '2023-08-27', '', 'hotel'),
(92, 0, 'Event Hall', 'eventhall/list', 'eventhall', 'icon-h-square', 1, 3, '2023-08-27', '', 'hotel'),
(93, 0, 'Fitness Mgmt', 'fitness/lits', 'fitness', 'icon-list', 0, 4, '2023-08-27', '', 'hotel'),
(94, 0, 'Review Mgmt', 'review/list', 'review', 'icon-list', 1, 5, '2023-08-27', '', 'hotel'),
(95, 61, 'Offers Mgmt', 'offers/list', 'offers', 'icon-tags', 1, 6, '2023-08-30', 'a:2:{s:8:\"imgwidth\";s:3:\"200\";s:9:\"imgheight\";s:3:\"200\";}', 'admin'),
(96, 44, 'Event Category', 'eventcategory/list', 'eventcategory', 'icon-gear', 1, 7, '2023-08-30', '', 'admin'),
(97, 0, 'Event Mgmt', 'event/list', 'event', 'icon-gear', 1, 4, '2023-08-30', '', 'hotel'),
(100, 0, 'Mileage Mgmt', '', '', 'icon-gear', 1, 5, '2023-09-24', '', 'admin'),
(101, 100, 'Levels', 'level/list', 'level', 'icon-tags', 1, 1, '2023-09-25', '', 'admin'),
(102, 100, 'Point Mgmt', 'pricerange/list', 'pricerange', 'icon-tags', 1, 7, '2023-09-25', '', 'admin'),
(103, 100, 'Prize', 'reward/list', 'reward', 'icon-tags', 1, 9, '2023-09-27', '', 'admin'),
(109, 74, 'Registered Users', 'registereduser/list', 'registereduser', 'icon-gear', 1, 9, '2023-09-29', '', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(250) NOT NULL,
  `author` varchar(100) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `brief` text NOT NULL,
  `gallery` text NOT NULL,
  `content` text NOT NULL,
  `news_date` date NOT NULL,
  `archive_date` date DEFAULT NULL,
  `sortorder` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `popular` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `source` mediumtext NOT NULL,
  `type` int(11) NOT NULL,
  `viewcount` int(11) NOT NULL DEFAULT 0,
  `meta_keywords` varchar(250) NOT NULL,
  `meta_description` varchar(250) NOT NULL,
  `added_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` (`id`, `slug`, `title`, `author`, `tags`, `brief`, `gallery`, `content`, `news_date`, `archive_date`, `sortorder`, `status`, `popular`, `image`, `source`, `type`, `viewcount`, `meta_keywords`, `meta_description`, `added_date`) VALUES
(1, '12-best-things-to-do-in-chitwan', '12 best things to do in Chitwan ', 'Nepalhotel', 'Travels', 'South-central Nepal offers a beautiful tourist location in the form of Chitwan National Park, in the banks of Rapti and Narayani River flood plains. ', 'a:0:{}', '<div class=\"content\">\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Allocate one-horned rhinos, great Bengal tigers, various antelopes, wild buffalos, and bulls and you can also see our feathered friends like giant hornbill, can be identified in the park. Moreover, the northern Rapti River features a crocodile sanctuary. All in all, once you are in the Chitwan area, you will be bamboozled by the things to do in Chiwan and you will surely feel as if you are in the Savanna forest of Africa.<br style=\"box-sizing: border-box;\" />\r\n		&nbsp;&nbsp; &nbsp;<br style=\"box-sizing: border-box;\" />\r\n		As there are many activities that any visitor in Chitwan can enjoy,&nbsp; In the tabloid&nbsp; here, you can find the 12 best things to do in Chitwan National Park and its surrounding, to help you understand the Plain lands of Nepal.</p>\r\n	<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		1) Jeep Safari in Chitwan National Park</h4>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Discover the dense forest of chitwan on a jeep safari to the very center of the dense jungle. Naturalists in the Jeep will tell you about the history of Chitwan National Park, its residents, and its flora and fauna.<br style=\"box-sizing: border-box;\" />\r\n		Sightings of spotted deers, wild hogs, barking deer and sambar birds are very common but as the safari Jeep is quite noisy, animals usually get scared and the chances of sighting various rare animals decrease when you are taking a Jeep safari. But with a bit of luck, the leopard, and even Bengal Tiger can be caught in your Cameras.</p>\r\n	<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		2) Elephant safari</h4>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		One of the major things to do in Chitwan National Park is enjoying the elephant rides offered in Chitwan National Park. Elephant safari is the most common activity that Chitwan National Park has to offer to its visitors. It is also the most famous and exciting way to score any wild animal encounter. The activity particularly features a rare one-horned rhino, and elusive Royal Bengal Tigers, as well as hundreds of bird species and a variety of reptiles.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		The experienced Mahouts employed in the park will take you deep into the woods to ensure that you see as many animals as possible from the closest yet safe distance.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Beside elephant safari, you can even include Elephant breeding centre and Elephant bathing visit in your things to do list while you are in Chitwan.</p>\r\n	<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		3) Jungle Walk and Bird Watching</h4>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Chitwan National Park&rsquo;s other attraction is the majestic &ldquo;Twenty Thousand Lake&rsquo; where you get the chance to see some rarest birds while walking into the jungle. Chitwan is the home for a total of 540 bird species.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		This walk also puts you on a path to see various wild animals up close. Likewise, the view towers you see while exploring the trails will allow you to climb up and take an aerial look of the Jungle as well. Walking is still the safest way to observe birds. The experience gets even sweeter if you get a chance to see the himalyan migratory birds sheltering in Chitwan for Winter.</p>\r\n	<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		4) 20000 Lakes Tour</h4>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		The famous 20000 Lakes which falls in Sauraha, is a Ramsar site in Chitwan and is considered as the heaven for bird lovers. Till the date, it is one of the best places to visit in Chitwan and people say the colorful birds in 20,000 Lakes Chitwan, features a wide variety of migrating and resident bird species.</p>\r\n	<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		5) Visit Ranipokhari</h4>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Ranipokhari is one of Chitwan&#39;s newest booming tourist destinations, spread over four Bigahas in Bharatpur-19, Kirangunj. Though it was officially promoted as a tourist location almost 14 years ago; now it has been transformed into an open-air art museum and is well-known for picnics.</p>\r\n	<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		6) Canoe Rides In Rapti</h4>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		One of the many highlights in Chitwan is the Canoe Ride in a slow current Rapti River, which gives life to many water creatures. Slow canoe travel on the gentle rivers is a rare opportunity to see the waterfront scenery, but it is also the best way to see crocodiles and other marine creatures.</p>\r\n	<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		7) Crocodile Breeding Facility</h4>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		One of the most pleasant programs included in the Jeep Safari in Chitwan National Park is the visit to the Crocodile Breeding Center. Fish-eating Gharials and mugger crocodiles in the breeding center are enlisted as the rarest and endangered amphibians . The breeding center is situated in a remote area away from the crowd and the safari will take you there in around 20 minutes ride. You will be delighted to see the small crocodile hatching from their eggs here.</p>\r\n	<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		8) Visit Jalbire Waterfall</h4>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Jalbire Waterfall is a waterfall in Jalbire, Nepal. The waterfall at Chandi bhanjyang VDC-9 is around a hower ride from Sauraha and an almost twenty-minute walk from the Jalbire temple on the Narayangarh-Mugling road. This waterfall, which drops 100 meters, is a famous tourist place where visitors can enjoy bathing in the waterfall. The place is equally famous for canoe rides. Likewise, it also has various Gurung homestays.</p>\r\n	<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		9) See the Sunrise from Chiraichalai Hill</h4>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		The astonishing sunrise from Chiraichalai hill at 946 meters in elevation is also a very beautiful experience for people who have enough time to stroll around Chitwan. Chiraichalai Hill is one of the most famous places to visit while you are in Chitwan.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		You can access the region by taking a private or public vehicle towards Prithivi Highway&nbsp; towards Hattiban, or Shaktikhor highways. Those who want to see the sunrise must first spend the night in Hattiban. The sunrise point is about an hour&#39;s walk from there to a famous lookout point with views of a stunning, unfolding mountain range.</p>\r\n	<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		10) A stroll through the village</h4>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		The rainforest in Chitwan National Park includes more than just scenery, birds, and animals. The Tharus, the indigenous locals, are also of great interest. If you want to stroll through the settlers living near the national park then you should take a tour to the park&#39;s adjacent villages and gain insights into Tharu culture.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		If you have enough time to travel Chitwan, you should visit the Madi Village as well. Madi is a unique village where Gurungs of middle hills, Brahmins-Chhetris, and Tharus live in harmony. The place has a lot to offer in terms of cultural diversity. Examine an epicenter of Tharu, Gurung, and Brahmin culture in the central Terai, where all the culture is open to spectators and has maintained a great religious harmony till this day.</p>\r\n	<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		11) Ox cart or Pony Ride Chitwan</h4>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		One of the best ways to visit the Tharu village in Sauraha, Chitwan, is to take an ox cart or pony ride. One Ox cart can hold upto 6 people at a time, and the tour guide will clarify the indigenous Tharu community&#39;s culture and lifestyle, among other things. The ox cart and pony ride are both environmentally friendly and entertaining ways to explore the Tharu village.</p>\r\n	<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		12) Cultural Programs</h4>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Another highlight that awaits in the happening city of Sauraha would be a cultural program by the Tharus. In the cultural program, indegenous Nepalese Tharus in colorful traditional costumes, showcase their dresses and show you various dances and skills that they developed over the years, living in the forest.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		After reading this, you may get pumped to get to Chitwan. Many questions regarding transportation, best time to travel to the sanctuary, where is it, how to get there may arise in your mind. Right?</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		<em style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">You can know more about&nbsp;<a href=\"https://gundri.com/blog/conservation-areas-of-nepal#chitwan_national_park\" style=\"box-sizing: border-box; color: rgb(255, 45, 84); text-decoration-line: none; background-color: transparent; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; outline: none; transition: all 0.3s ease-out 0s; overflow: hidden;\" target=\"_blank\">Chitwan National Park</a>&nbsp;by reading this blog</em></p>\r\n	<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		<em style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">Enjoy at the luxurious Hotels in Sauraha</em></h4>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		After a tiresomeand excitment journey of the day, enjoy your night at some of the best hotels and resorts in Chitwan. The national park has a wide range of hotels offering every luxury that you can imagine of. Likewise, the hotels also have many customized packages for their guests, so if you get to Chitwan and check-in straight into a hotel they sell all the above-mentioned activities in Packages as well.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		One of the things to do in Chitwan can be stay at the best accommodation; the place offers a huge number of luxury resorts to boutique hotels, meaning you can choose your accommodation as per your budget. The place has a lot to offer, even if you are traveling with a limited amount of cash. The place isn&rsquo;t as budget heavy as you think. So, pack your bags and set out for a jungle trip of your life, and to ease your trip even more, choose<a href=\"https://gundri.com/\" style=\"box-sizing: border-box; color: rgb(255, 45, 84); text-decoration-line: none; background-color: transparent; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; outline: none; transition: all 0.3s ease-out 0s; overflow: hidden;\" target=\"_blank\">&nbsp;Gundri.com</a>, which allows you to plan your trip, flights and stay from the place you are at, right now.</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', '2021-02-05', '0000-00-00', 1, 1, 1, 'q1rKu-blog_2.jpg', '', 1, 6, '', '', '2015-11-05 12:36:58'),
(2, '11-reasons-to-visit-nepal-once-in-a-lifetime', '11 Reasons to visit Nepal once in a lifetime', 'Nepalhotel', 'Tourism', 'Nepal is a colorful country, which houses various religions, real culture and a place with the taste of authentic ethnic experience. ', 'a:2:{i:0;s:13:\"qMad2-bud.jpg\";i:1;s:13:\"mJUys-ann.jpg\";}', '<div>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Eleven incredible national parks with some of the rarest animals like one-horned rhino, Asiatic elephants, Bengal Tiger, Snow Leopard, Red Panda can definitely amaze you hwew in Nepal.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Nepal has a total of 880 species of birds singing in the mountains and 651 types of butterflies. When you are trekking in the trails of the country through the woods, you will feel like you are walking in a natural red carpet because you will get summer-showered by three types of Rhododendrons on your way to the base camp. Nepal also is an origin place of Buddhism as Lord Gautam Buddha was born in Nepal. Alongside that, you will be able to spot the rarest barking deers, Bangal Tigers and the majestic one horned Rhinos here.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		If you are confused on why to visit Nepal then here are 11 reasons about why should you choose Nepal as your vacation destination.</p>\r\n</div>\r\n<div>\r\n	<h2 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		1<u style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">)</u>&nbsp;Experience Adventurous Activities&nbsp;</h2>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Nepal is one of the most peaceful countries in the world. Known as the epicenter of tantric meditation, the country is filled with prayer flags and peaceful people but the geography in Nepal makes it a perfect destination for many adventure sports.&nbsp;</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Some of the most famous adventure sports for adrenaline junkies available in Nepal are bungee jumping and swing, paragliding, ziplining, skydiving, white water rafting, rock climbing and canyoning. Recently, the barren land of Mustang and Manang is getting famous among the bike riders all over the world. So, if you want to find out how adventurous you are, then&nbsp;<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Nepal is definitely a place that you should visit.</span></p>\r\n	<h2 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		2<u style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">)</u>&nbsp;The Magical Mountains</h2>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		People compare Nepal&rsquo;s climatic conditions with Switzerland&rsquo;s, however, the Ural range and Nepalese mountain range are two different geographic phenomena. There are numerous tall mountains to trek in Nepal. Mostly, If you want to see the tallest mountain in the world; Mt. Everest should be on your bucket list which seats at an elevation of 8846.86 meters. Everest region is one of the world&rsquo;s most famous places for trekking and expeditions.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Beside the tallest mountain, the nation houses other seven peaks over 8000 meters and enlisted as Kanchanjunga (8598 meters), Lothse (8516 meters), Makalu (8463 meters), Cho-Oyu (8201 meters), Dhaulagiri (8167 Meters), Manaslu (8163 Meters), and Annapurna (8091 meters).</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		It&rsquo;s not just about the majestic mountains, the trails also feature some of the world&rsquo;s biggest glacier rivers,&nbsp; highest lakes, and snow-covered passes filled with snow all seasons. There are still a million undiscovered locations in this nation, many world records left unset and a million stories unwritten, so if you are planning for a vacation, you should definitely give a thought on Nepal, the actual heaven on earth.</p>\r\n	<h2 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		3<u style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">)</u>&nbsp;Insight To A Diversified Cultural Mix&nbsp;</h2>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Surprisingly 147,516 sq.km of area encloses so many cultural varieties that you will be totally blown away. The variable culture from the valley of Kathmandu to the beautiful tharu culture in Chitwan, Nepal is a country with a varying culture.&nbsp;</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Kathmandu valley alone has over 130 important monuments. You will witness variety in culture from Terrai to the top of the mountains. Various subcultures such as Helmu, Sherpas, Thakali, Limbu, including Bramhins and chhetris enhabit the hills and himalayas where as Tharu, Satar, Madeshis and various other smaller groups live in the plain lands of Nepal.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		From colorful wall paintings of Terai to the pauwas in Kathmandu, and Thangkas in the himalayas, the cultural variety of Nepal is just beyond explanation.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Also imagine; being in Pashupatinath, which is one of the main hindu pilgrim and then just at 2.1 Km distance, you will see Boudhanath; a buddhist pilgrim site. Likewise, the living goddess Kumari is chosen from the Buddhist Newa community and worshipped by hindus all over Nepal which shows the nation&rsquo;s unity in diversity. So, tour in Nepal isn&rsquo;t all about mountains its also about the cultural mix of the South Asian Region.</p>\r\n	<h2 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		4) Abundance Of Wildlife &amp; Bird Watching Destination&nbsp;</h2>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Nepal homes various migratory himalyan birds roaming in many of its Ramsar sites like Koshi Tappu Wildlife reserve, Rara lake, Khaptad area and Phoksundo lake. Nepalese skies offer you a perfect bird watching experience for sure. Spiny Babblers, and Tibetan Snowcock, Lophophorus, Peahen, and birds of prey like vultures, eagles, and owls are not very rare here.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Likewise, our national parks also have various rare animal species along with Asiatic elephants and predators such as bengal tigers, and Indian Leopards. You will also get a chance to hunt a few Ghorals, and Himalyan Tahrs if you decide to travel to Dhorpatan, the only sanctuary open for game hunting. So, if you are not familiar with the wilder side of the himalyan country, then visiting Nepal is highly suggested.</p>\r\n	<h2 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		5) Natural Beauty, River and Lakes&nbsp;</h2>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Unlike other countries, Nepal experiences 6 seasons resulting in variable climatic conditions. The small country experiences six seasons termed as Basanta (Spring), Grishma (Early Summer), Barkha (Summer Monsoon), Sharad (Early Autumn), Hemanta (Late Autumn) and Shishir(Winter). This climatic variation makes the vegetation&nbsp;fairly different in the country.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		You can see tropical rain forests to deserts mountains in Nepal. From the flood plains to freshwater lakes at the highest altitudes like Gokyo, Rara, Phoksundo, and Gosaikunda will make you fall in love with the country&rsquo;s geography.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Likewise, you will get to witness the hissing Seti-Gandaki in Pokhara, and raft in fast flowing Bhote Koshi and bird watching in safari in the mighty Karnali can be a few water adventure for the nature lovers, here in Nepal.</p>\r\n	<h2 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		6) Colorful Festivals</h2>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Nepal is also known for its colorful festivals. Though the nation is small, it celebrates various festivals. Kathmandu valley alone celebrates festivities like Indra Jatra, Biska Jatra, Rato Machindranath Jatra, and Ghode Jatra. The pilgrim sites in Kathmandu fill up on occasions like Buddha Jayanti, Shiva ratri and hari bodhani ekadashi. Likewise, dolakha holds the majestic Bhimeshwor Jatra. Similarly, Terai is famous for its majestic holi festival, and Chat Parva. Likewise, Dashain and bright Tihar are the nation&rsquo;s biggest festival occasions and Nepal celebrates a national holiday in Mid September and early October for Dasai and Tihar.</p>\r\n	<h2 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		7<u style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">)</u>&nbsp;Architectural handicrafts and art works&nbsp;</h2>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Take nothing but photographs, leave nothing but footprints, has been the country&rsquo;s tourism slogan for a very long time but the nation offers a million handicraft artifacts that you can take with you as a suvernere. The classic khwapas, Khukuris, and tiki jhya frames are the most known artworks that you can take along with you. Likewise, the nation also exports carpets which are highly valued in the western world.&nbsp;</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		The nation itself is an architectural delight. The delightful palaces in Kathmandu along with various other small forts all over Nepal will give you an idea about the history of Nepal which was never colonised by any country ever.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Likewise, the nation is an artistic delight. From Pauwas, Thankas to the Mithila drawings carved in the walls of every village in Terai, you will see the original Asian arts that inspired various nations in Asia in its actual form in Nepal.</p>\r\n	<h2 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		8<u style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">)</u>&nbsp;Delicious variety of cuisines&nbsp;</h2>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Nepal has accepted both Indian and chinese cuisines yet the country offers a wide range of its own indigenous food that you can experience nowhere else. Be it the Bhakka roti from tharu community, or chatamari from Newari ethnic group, the variety of food in Nepal is diverse for sure. You can taste the thakali Dal-Bhat, and eat indian dahi-puri after eating a hot choila here in Nepal. You will get to taste the hardest mountain cheese of the himalaya and also get a bite of Syavale or momo, which has developed as a food culture over the years.</p>\r\n	<h2 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		9<u style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">)</u>&nbsp;A Place Of Religious Tolerance&nbsp;</h2>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Although Nepal is a fairly small nation, it has over 4 casts and 36 sub casts. Likewise, it&#39;s a multi-ethnic nation as well. The country has a huge number of Hindus yet it respects and shares values with buddhust culture. Manjushree temple in Swayambhunath is worshipped by both hindus and buddhists. Buddha is considered as an incarnation of Vishnu and is worshipped at Patan Krishna mandir along with 10 avatars of Lord Vishnu. Likewise, Shiva is termed as Guru in buddhist community and many hindu temples have Magar, and Tharu priests, which isn&rsquo;t seen elsewhere in the world.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		The nation shares a huge religious tolerance and Nepal should be the only country in the world with zero segregation in the name of religion.</p>\r\n	<h2 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		10<u style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">)</u>&nbsp;Family Friendly And Safe Destination&nbsp;</h2>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		The environment of Nepal is totally family friendly. The people living in Nepal are very welcoming and the country offers various outdoor activities that suit every age group. It&#39;s a beautiful vacation location and also a perfect spot to enjoy your honeymoon. Imagine a night out at Nagarkot, Ghandruk at the base of annapurna, or at the lake side pokhara, the country offers a peaceful environment and adorable natural beauty. Likewise, if regulating children&#39;s demands and keeping them occupied is your priority, you and Nepal will get along pretty well.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Nepal provides an eclectic variety of activities like trekking, wildlife safari, jungle walks and many family oriented activities to keep your kids occupied.</p>\r\n	<h2 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		11<u style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">)</u>&nbsp;Budget Friendly&nbsp;</h2>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		Despite being rich in culture, Nepal is not very prosperous in terms of economy. The country is a &nbsp;budget friendly vacation destination and has a variety of options to choose from, in concern to hotels and homestays. You can get fully organised clean rooms for around $20 or even less. Likewise, with the recent development in Technology, OTP sites such as gundri.com allows you to choose from a variety of hotels, from cheap ones to expensive hotels. So, if you are searching for accommodation while you are in Nepal, you can choose from the wide range of starred hotels to boutique hotels right after you read this article.</p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\"><em style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">What are you waiting for?</em></span></p>\r\n	<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n		You will obviously enjoy your vaccation in Nepal with your friends and family. These 11 reasons are enough for you to make Nepal your next vaccation destination.</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', '2021-04-05', '0000-00-00', 2, 1, 1, '1xFrC-blog_1.jpg', '', 1, 20, '', '', '2015-11-05 12:56:26'),
(3, 'sagarmatha-national-park-all-you-need-to-know-before-you-travel', 'Sagarmatha National Park | All you need to Know before you travel', '', 'Travel', 'Nepal is the country with 3 distinct geographical regions, and it has a large variety of flora and fauna in all these regions', 'a:0:{}', '<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1;\">Sagarmatha National Park</span>&nbsp;visit is an exceptional opportunity to see the natural beauty, wildlife and vegetation of the roof of the world. Sagarmatha National Park encompasses Mount Everest Massif and was Nepal&rsquo;s first-ever national park to be inscribed as a Natural World Heritage Site by UNESCO. It was established in 1976 AD, and was recorded as the natural world heritage three years after its establishment in 1979. The park lies in the Khumbu region and covers an area of 1,148 sq.km (443 sq.mi) in the Solukhumbu District.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1;\">Sagarmatha National park</span>&nbsp;mostly has deep gorges and high Himalayas, with elevations ranging from 2,845 meters at Monjo to the world&rsquo;s highest mountain Sagarmatha (Mount Everest) 8,848.86 meters above sea level.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Beside Sagarmatha, other notable mountains in the region include Lhotse, Nuptse, Amadablam, Thamserku, Cho Oyu, and Pumori. Extending from the Dudh Koshi river&rsquo;s upper portions, the national park lies in the eastern realms of Nepal and encompasses the Bhotekoshi river basin and beautiful Gokyo Lake.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1;\">Sagarmatha National Park&nbsp;</span>features 69% barran, dry and rocky mountains above 5,000 meters. 28% of the rest of the area flaunts grazing land for yaks and various antelope. However, 3% of the national park&#39;s land is covered with sub tropical and sub alpine forest.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Its vegetation directly starts in a sub-alpine environment and consists of Fir, Himalayan birch, Juniper, and Rhododendron. After 4000 meter&rsquo;s elevation, the vegetation found here features Mosses and Lichens. Various shrubs and flowering plants cover the bare mountains in November. In November, more than 1,000 floral species cover the trails to the National Park.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1;\">Sagarmatha National Park</span>&nbsp;remains an important bird-watching site and is noted as an &ldquo;important Bird Area (IBA) by Birdlife International. This National Park is the house of 208 bird species and some endangered birds such as bearded vulture, Impeyan Pheasant, Snowcock, and Alpine Chough, Blood Pheasant, Eared Grebe, Oriental Turtle-Dove, Himalayan Cuckoo, Himalayan Swiftlet and more.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	The grazing areas or Kharkas are usually filled up with Yaks, and other cattle animals which are found in the Himalayas. The national park area also preserves antelopes such as Himalayan tahr, Musk deer. Weasel, pikka (mouse hare) and jackals usually appear while trekking in these regions but people also encounter Himalayan black bear, wolf, lynx, snow leopard, and Indian Leopard rarely.</p>\r\n<h4 style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	Why Should you visit&nbsp;<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">Sagarmatha National Park</span>?</h4>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	First of all, Mount Everest is the peak of the world, which means its one of the most famous places among tourists of the entire world community. The place is best for expeditions and even trekking. As the whole national park is a sanctuary in itself, you will experience both natural beauty and the national park&rsquo;s preserved ecology.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Mount Everest base camp named after George Everest who surveyed it as the highest peak in the world, is a very unique National park. As said earlier, it&#39;s a UNESCO site, Important Bird Area, and unlike many other National Parks, it has settlements in its boundaries. In the national park, there are six mountains over 8000 meters/ over 23000 ft. It&#39;s still very easily accessible.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Valleys, Suspension bridges, Dudhkoshi river gorge and high-lands beside Dudhkoshi and over 4000 people enheaditing in the reason, who are fully dependent on Mount Everest will amaze you as well.&nbsp; Beautiful Namche Bazar, which is considered as a trading center for the mountain people shows the lifestyle of the locals. Likewise, the vegetation that changes along your foot trails will show the variety in ecology every 1000 meters or so.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Not all national parks should include deadly predators, Nepal does have various national parks with tigers, leopards, and crocodiles. But, Sagarmatha is a combination of an aesthetic scenery, beautiful rivers, welcoming people, big mountains, and colorful birds over the clouds.</p>\r\n<h4 style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	How to reach&nbsp;<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">Sagarmatha National Park</span>?</h4>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Sagarmatha National park&rsquo;s headquarter is about 10 minutes walking distance from Lukla Airport so you can directly fly to Lukla and hike to reach the headquarter and explore the National Park.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	If you love trekking then you can travel up to Jiri by vehicle and start the trek up to the headquarter of Sagarmatha National Park by following the trails of over Kilometers.</p>\r\n<h4 style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	When should you Plan your&nbsp;<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">Sagarmatha National park</span>&nbsp;visit?</h4>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Sagarmatha national park and its adjacent Makalu Barun national park have a fairly similar environment and are best to visit around October-November where the place is filled with snow yet, the snow kind of melts a little making the trails easy by then. Likewise, the autumn in Nepal which starts from March and lasts till May, will give you a proper taste of vegetation, greeneries, wild flowers and beautiful birds along with barren mountains above 5000 meters and snow covered peaks above it.</p>\r\n<h4 style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	Do you need a guide?</h4>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Sagarmatha region is one of the most unexpected trails, as it features rain forests to barren lands and has various big mountains with no human settlement. The place elevates from the deep gorge of Bhotekoshi to the highest peak in the world. It has fairly difficult trails, so it&rsquo;s always better to have someone who knows the route. As the place is religiously, culturally and geographically significant, you must hire a guide while you plan to visit Sagarmatha National Park.</p>\r\n', '2021-02-05', '0000-00-00', 3, 1, 1, 'zYWBg-blog_3.jpg', '', 1, 0, '', '', '2021-05-12 17:56:50');
INSERT INTO `tbl_news` (`id`, `slug`, `title`, `author`, `tags`, `brief`, `gallery`, `content`, `news_date`, `archive_date`, `sortorder`, `status`, `popular`, `image`, `source`, `type`, `viewcount`, `meta_keywords`, `meta_description`, `added_date`) VALUES
(4, 'read-this-before-you-plan-to-visit-annapurna-region', 'Read this before you plan to visit Annapurna Region', '', 'Travel', 'Diverse destination surrounded by high altitude mountains, with a variety of flora and fauna and diverse ethnic culture.', 'a:0:{}', '<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	The paradise on the earth, Annapurna Region is full of pristine lakes along spiritual sites.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Annapurna has been a fascinating circuit for all backpackers for ages. For years, people have trekked to Annapurna base camp and some daring backpackers have even taken the risk of going through with its circuit. The whole circuit is a wonderful experience for many travelers and is surely a once-in-a-lifetime experience for people who love travelling and exploring new places.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	If you are planning to visit Annapurna Region, read this and make a list of places to visit and things to do in this region since Annapurna region is huge to explore in just one vacation.</p>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">Ghandruk</span></h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Ghorepani features all the mountains of the Annapurna range, however, Sunrise from Ghandruk is equally imagistic because you can see the sun rising beside Mt. Macchapucchre, it also is the best place to relax after a long trek in and out of ABC. The Thakali culture at Ghandruk will be a fascinating experience for people who like to explore Nepalese culture.</p>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">Ghorepani Poonhill</span></h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Usually, people start the circuit trekking from the new bridge and then climb towards Ghorepani. Ghorepani is a very interesting place that features the Annapurna range flaunting itself on the west. Regarded as the most popular trekking trail in Nepal, Ghorepani has a viewpoint at Poonhill which is very popular among hiking lovers in Nepal.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Personally speaking, when I went trekking in this region, I vividly remember jumping into an ice-cold glacier river on my way to Poonhill. I was carrying a heavy backpack and was sweating like a pig, I just got my clothes off and jumped into the small river, the water was so cold and I nearly froze to death. It was my very first trekking experience and I had no clue that the water would be freezing cold. Dangerous for a first-time traveler, right?</p>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">The Beautiful City Of Jomsom</span></h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Jomsom is the valley on the bank of Kaligandaki Gorge which is the deepest gorge in the world and settles on either side of Kali Gandaki and the town itself is at the alleviation of 2760 meters, which means it is one of the rare cities at the highest altitude.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	It is a Himalayan town spread between two Mountains Annapurna and Dhaulagiri and is separated by the Kaligandaki River. The city is a once-in-a-lifetime cultural experience and offers you various attractions in itself. Jomsom features the famous Glacier lake Dhumba Lake, and two religious monasteries popular among Buddhist communities Marpha and Chhairo monasteries, which is why you should include Jomsom in your list of places to visit in Annapurna Range.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	The place experiences rain shadows on the west side and the eastern side of the gorge remains dry, and mostly experiences rainshadow and remains lifeless, which makes it a boon for rock Climbers.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Planes don&rsquo;t fly over Jomsom since the place experiences heavy wind every day blowing from the Kali Gandaki gorge making flights dangerous. Hence, tourists mostly reach the place on a Motorcycle and the place is getting famous among bikers in recent days.</p>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">Manang</span></h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Manang is another distinct place where you will experience Mountains with rainfall and rain shadows, chilly wind, numerous naturally forming waterfalls, gravel roads, Pony trails, and sheep farming. Manang offers beautiful views of Manasalu Mountain, Narphu, and Ney Sang Valleys where you can camp out.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Manang mostly offers adventure rides for bike lovers as well. The place also has started Ice skating, so if you love wearing ice skates and like sliding over frozen lands then a few places offer you these adventure sports as well.</p>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">Tilicho Lake</span></h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	After you reach Manang, another beautiful geographic wonder awaits you in the form of Lake Tilicho. Unlike GosainKunda, Tilicho lake is all about scenic beauty. Situated at 5416 meters, the lake is surrounded by some snow-covered mountains above 7000 meters. Its environment is somewhere between Subtropical and Semi alpine, and in October the whole lake freezes and many people say that they can even walk through it.</p>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">Thorong-La Pass</span></h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	The highest pass in the world, Thorong-La is one of the famous trails for trekkers and traders. The pass is at&nbsp; 5416 meters elevation and further east to the pass, you will reach Muktinath Temple. The scenery from Thorong-La can not be explained in words, which is why you should visit the place for yourself. So if you are planning to do the circuit trek in Annapurna, Thorong-La, a pass created by Khatung Mountain and Yaskawa mountain would surely be on your itinerary.</p>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">Detour to Marpha and Kagbeni</span></h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Your Detour at Marpha and Kagbeni can be one divine experience as you&rsquo;d see the lifestyle of the valley, yaks, and ponies. You will be delighted by the scenic beauty, the gentle wind on your cheeks, the plane lands on the base of big mountains, and the rhododendron forest on your way to Kagbeni is just amazing.</p>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">Muktinath</span></h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Annapurna Region isn&rsquo;t just a place where Buddhist people live, it&rsquo;s holy for many Hindu deities and is a very sacred place for religious travelers as well. Trek to Muktinath and then call your trek off for a day, at Muktinath you can also take a bath in its natural hot spring water, and also take a tour of its surroundings. You will see some of the best photogenic spots on your way there. A fun fact is that Muktinath now has black tarred road access, meaning you can start your trek from Muktinath and get to the new bridge as well.</p>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	Gosaikunda and Damodar Kunda</h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	You must visit two religious lakes; Gosaikunda and Damodar Kunda, while in the Annapurna Region. Besides having a great scenic experience, these lakes also hold a huge religious significance. Gosaikunda is regarded as a sacred Hindu place where lord shiva rested after drinking venom which came out from the ocean while gods created the universe.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Likewise, Brahmins believe if they die in Damodar Kunda, they will receive nirvana, hence people from Nepal and its surroundings visit these glacier lakes.</p>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	The most preserved Upper Mustang Lo Manthang</h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Known as the kingdom of Lo, a place restricted till 1992, enjoy the trance-Himalayan climate of Lo Manthang at upper Mustang. Visit Gyakar Valley with dry and rocky mountains, also see the majestic Nilgiri mountain, and capture a very Tibetan-like lifestyle prevalent here.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	However, you&rsquo;d need $500 to enter Upper Mustang and the permit is valid for 10 days.</p>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	Don&rsquo;t forget to have Mustang Apple Brandy (Marpha)</h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Mustang is famous for apple and apple products. Taste the sweetest apples in Mustang. Due to transportation problems, most people dry the apples and you can also buy a few packets for snacks. Likewise, apple brandy in Mustang can be your second thing to check out. No chemicals and 100 percent made out of the best apples Mustang Brandy is definitely taste-worthy.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Also, see the leopard cave and visit Rodhighars at mustang in the evening time, to feel delighted.</p>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	Traverse the Seven Majestic Mountains</h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Annapurna Massif is one hell of an experience for nature lovers. Though Fishtail and Annapurna 1 is very common for people who will hike from the new bridge crossing Bamboo forests, Annapurna Massif has a lot to offer. The 34 miles Massif has one pick over 7000 meters, and thirteen snow-covered peaks over 7000 meters from the sea level. While you trek through the circuit you&rsquo;d see sixteen mountains over 6000 meters as well.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	While you start your ABC-MBC trek, You will get to enjoy the spectacular view of Kaligandaki, Marsyangdi and as the place is a sanctuary, you will see many rare and adorable creatures of nature roaming around in the wilderness as well. However, you can either enjoy the spectacular view from Poonhill&rsquo;s top or you have to do the whole circuit which is around 21 days to catch all the peaks up close.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Annapurna I is the highest peak of the circuit measuring 8091 meters and is the 10th highest peak in the world. Expeditions camps run rarely in Annapurna as the expedition in this region is fairly difficult and is categorized as a level four-zone by the government of Nepal.So, once you are in Annapurna circuit trails surpassing Machhapuchhre Base Camp and Annapurna Base Camp, you&rsquo;d see other world-famous peaks enlisted below, if you do go on a 21 days circuit Trekking in the region.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	&nbsp;</p>\r\n<h3 style=\"box-sizing: border-box; margin: 25px 0px 10px; font-weight: normal; line-height: 1.15; font-size: 30px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	List of the&nbsp;Highest Seven Peaks in Annapurna Range</h3>\r\n<div style=\"box-sizing: border-box; margin: 0px 0px 0px 0pt; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	<table style=\"border-collapse: collapse; margin: 0px; padding: 0px; border-width: medium; border-style: none; border-color: initial; font-family: inherit; vertical-align: baseline; zoom: 1; height: 398px; width: 453px;\">\r\n		<tbody style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n			<tr style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						Peaks</p>\r\n				</td>\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						Alleviation in meters</p>\r\n				</td>\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						Alleviation in foot</p>\r\n				</td>\r\n			</tr>\r\n			<tr style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						Annapurna I</p>\r\n				</td>\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						8,051 m</p>\r\n				</td>\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						26,414 ft</p>\r\n				</td>\r\n			</tr>\r\n			<tr style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						Annapurna East</p>\r\n				</td>\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						8,010 m</p>\r\n				</td>\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						26,280 ft</p>\r\n				</td>\r\n			</tr>\r\n			<tr style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						Khangsar Kang</p>\r\n				</td>\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						7,485 m</p>\r\n				</td>\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						24,557 ft</p>\r\n				</td>\r\n			</tr>\r\n			<tr style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						Tarke Kang</p>\r\n				</td>\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						7,201 m</p>\r\n				</td>\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						23,629 ft</p>\r\n				</td>\r\n			</tr>\r\n			<tr style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						Lachenal Peak</p>\r\n				</td>\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						7,140 m</p>\r\n				</td>\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						23,425 ft</p>\r\n				</td>\r\n			</tr>\r\n			<tr style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						Tilicho Peak</p>\r\n				</td>\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						7,135 m</p>\r\n				</td>\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						23,409 ft</p>\r\n				</td>\r\n			</tr>\r\n			<tr style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						Nilgiri Himal</p>\r\n				</td>\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						7,061 m</p>\r\n				</td>\r\n				<td style=\"box-sizing: border-box; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: top; zoom: 1;\">\r\n					<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\">\r\n						23,116 ft</p>\r\n				</td>\r\n			</tr>\r\n		</tbody>\r\n	</table>\r\n</div>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	&nbsp;</h2>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">Take a mountain Flight</span></h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	The whole Circuit is some 7000 square miles in area, meaning you will have to choose routes and ditch certain peaks or villages, and if you feel guilty about letting some peaks go, then you can always take a mountain flight from Pokhara and take a hard look before you say goodbye to the mountain Paradise of Annapurna range.</p>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">Enjoy Rock Climbing</span></h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	If you are in the Annapurna Region and return back without going honey hunting in Manang, you will feel something is incomplete during your travels. So while you are here, gear up to climb a rocky mountain and also carve some honey from the rocks. Kept aside expedition, the Adventure of rock climbing is no less thrilling here.</p>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">Join An Expedition</span></h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	If you are someone into mountain climbing, you would surely love Annapurna&rsquo;s variety. Climbing Annapurna is fairly expensive and extremely dangerous as per Tourism Board of Nepal. However, people with guide, potters, equipment, and gear along with the medical team usually travel in groups and successfully complete Annapurna 1 expeditions from time to time.</p>\r\n<h2 style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: &quot;Muli Bold&quot;; vertical-align: baseline; zoom: 1; color: rgb(33, 33, 33); -webkit-font-smoothing: antialiased;\">\r\n	<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">Who can forget about Annapurna Circuit Trek ?</span></h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Since the Annapurna circuit trek covers almost every part of Annapurna region, you can obviously go to Annapurna Circuit trek to enjoy the beauty of this region. If you love traveling through the woods and exploring mountains, you will never regret going to Annapurna Circuit Trek. Since the difficulty level is high, be prepared to face all of the problems and complete the circuit trek.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	No doubt, you can visit almost all places mentioned above in the circuit trek but talking about what activities does it covers, it all depends on with whom are you travelling? For the hassle free travel experience travel with Gundri. You can even customize your package here.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-size: 14px; font-family: &quot;Muli Regular&quot;, sans-serif; vertical-align: baseline; zoom: 1; color: rgb(81, 82, 99);\">\r\n	Time is running. When are you visiting Annapurna Region?</p>\r\n', '2021-04-15', '0000-00-00', 4, 1, 1, 'JBIHW-blog_4.jpg', '', 1, 0, '', '', '2021-05-12 18:00:34');
INSERT INTO `tbl_news` (`id`, `slug`, `title`, `author`, `tags`, `brief`, `gallery`, `content`, `news_date`, `archive_date`, `sortorder`, `status`, `popular`, `image`, `source`, `type`, `viewcount`, `meta_keywords`, `meta_description`, `added_date`) VALUES
(5, 'national-parks-in-nepal', 'National Parks in Nepal ', '', 'Travel', 'Encompassing a diverse range of animal habitats and protecting vast biodiversity in between some 880 km of land,', 'a:0:{}', '<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n	Nepal is a country with a unique geodiversity. Nepal&rsquo;s elevation starts from 67 meters in the south to 8,848 meters in the north. The intense altitude of the Himalayas has resulted in 11 bio-climatic zones, 36 vegetation groups, 1,120 non-flowering plant species, and 5,160 flowering plant species (10th in the world in terms of flowering plant).</p>\r\n<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n	The nation is a common home for 181 mammal species, 844 bird species, 100 reptile species, 43 amphibian species, 185 freshwater fish species, and 635 colorful butterfly species.Nepal preserves its natural flora and fauna in its original state for various environmental research purposes and also for recreational activities, in the form of conservation area. All together, Nepal has 12 national parks, 1 hunting reserve, and 1 wildlife reserve created with an intention to save the natural flora and fauna found in Nepal.</p>\r\n<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n	Here you can find the information about the national parks, hunting reserve and wildlife reserve of Nepal.</p>\r\n<h2 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n	<u style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\"><a href=\"https://gundri.com/blog/conservation-areas-of-nepal#NP\" style=\"box-sizing: border-box; color: rgb(33, 33, 33); text-decoration-line: none; background-color: transparent; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; outline: none; transition: all 0.3s ease-out 0s; overflow: hidden; line-height: 1.2; -webkit-font-smoothing: antialiased;\">National Parks</a></u></h2>\r\n<ol color:=\"\" line-height:=\"\" list-style:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px 20px; padding-right: 0px; padding-left: 0px; border: 0px; font-size: 14px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n	<li style=\"box-sizing: border-box; margin: 0px 0px 7px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; list-style-type: decimal-leading-zero;\">\r\n		<div style=\"box-sizing: border-box; margin: 0px; padding: 5px 10px; border: 1px solid rgb(204, 204, 204); font-family: inherit; vertical-align: baseline; zoom: 1; background: rgb(238, 238, 238);\">\r\n			Shey Phoksundo National Park</div>\r\n	</li>\r\n	<li style=\"box-sizing: border-box; margin: 0px 0px 7px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; list-style-type: decimal-leading-zero;\">\r\n		<div style=\"box-sizing: border-box; margin: 0px; padding: 5px 10px; border: 1px solid rgb(204, 204, 204); font-family: inherit; vertical-align: baseline; zoom: 1; background: rgb(238, 238, 238);\">\r\n			&nbsp;Langtang National Park</div>\r\n	</li>\r\n	<li style=\"box-sizing: border-box; margin: 0px 0px 7px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; list-style-type: decimal-leading-zero;\">\r\n		<div style=\"box-sizing: border-box; margin: 0px; padding: 5px 10px; border: 1px solid rgb(204, 204, 204); font-family: inherit; vertical-align: baseline; zoom: 1; background: rgb(238, 238, 238);\">\r\n			Makalu Barun National Park</div>\r\n	</li>\r\n	<li style=\"box-sizing: border-box; margin: 0px 0px 7px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; list-style-type: decimal-leading-zero;\">\r\n		<div style=\"box-sizing: border-box; margin: 0px; padding: 5px 10px; border: 1px solid rgb(204, 204, 204); font-family: inherit; vertical-align: baseline; zoom: 1; background: rgb(238, 238, 238);\">\r\n			Sagarmatha National Park</div>\r\n	</li>\r\n	<li style=\"box-sizing: border-box; margin: 0px 0px 7px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; list-style-type: decimal-leading-zero;\">\r\n		<div style=\"box-sizing: border-box; margin: 0px; padding: 5px 10px; border: 1px solid rgb(204, 204, 204); font-family: inherit; vertical-align: baseline; zoom: 1; background: rgb(238, 238, 238);\">\r\n			Bardiya National Park</div>\r\n	</li>\r\n	<li style=\"box-sizing: border-box; margin: 0px 0px 7px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; list-style-type: decimal-leading-zero;\">\r\n		<div style=\"box-sizing: border-box; margin: 0px; padding: 5px 10px; border: 1px solid rgb(204, 204, 204); font-family: inherit; vertical-align: baseline; zoom: 1; background: rgb(238, 238, 238);\">\r\n			Chitwan National Park</div>\r\n	</li>\r\n	<li style=\"box-sizing: border-box; margin: 0px 0px 7px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; list-style-type: decimal-leading-zero;\">\r\n		<div style=\"box-sizing: border-box; margin: 0px; padding: 5px 10px; border: 1px solid rgb(204, 204, 204); font-family: inherit; vertical-align: baseline; zoom: 1; background: rgb(238, 238, 238);\">\r\n			Parsa National Park</div>\r\n	</li>\r\n	<li style=\"box-sizing: border-box; margin: 0px 0px 7px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; list-style-type: decimal-leading-zero;\">\r\n		<div style=\"box-sizing: border-box; margin: 0px; padding: 5px 10px; border: 1px solid rgb(204, 204, 204); font-family: inherit; vertical-align: baseline; zoom: 1; background: rgb(238, 238, 238);\">\r\n			Banke National Park</div>\r\n	</li>\r\n	<li style=\"box-sizing: border-box; margin: 0px 0px 7px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; list-style-type: decimal-leading-zero;\">\r\n		<div style=\"box-sizing: border-box; margin: 0px; padding: 5px 10px; border: 1px solid rgb(204, 204, 204); font-family: inherit; vertical-align: baseline; zoom: 1; background: rgb(238, 238, 238);\">\r\n			Shuklaphanta National Park</div>\r\n	</li>\r\n	<li style=\"box-sizing: border-box; margin: 0px 0px 7px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; list-style-type: decimal-leading-zero;\">\r\n		<div style=\"box-sizing: border-box; margin: 0px; padding: 5px 10px; border: 1px solid rgb(204, 204, 204); font-family: inherit; vertical-align: baseline; zoom: 1; background: rgb(238, 238, 238);\">\r\n			Khaptad National Park</div>\r\n	</li>\r\n	<li style=\"box-sizing: border-box; margin: 0px 0px 7px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; list-style-type: decimal-leading-zero;\">\r\n		<div style=\"box-sizing: border-box; margin: 0px; padding: 5px 10px; border: 1px solid rgb(204, 204, 204); font-family: inherit; vertical-align: baseline; zoom: 1; background: rgb(238, 238, 238);\">\r\n			Shivapuri Nagarjun National Park</div>\r\n	</li>\r\n	<li style=\"box-sizing: border-box; margin: 0px 0px 7px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; list-style-type: decimal-leading-zero;\">\r\n		<div style=\"box-sizing: border-box; margin: 0px; padding: 5px 10px; border: 1px solid rgb(204, 204, 204); font-family: inherit; vertical-align: baseline; zoom: 1; background: rgb(238, 238, 238);\">\r\n			Rara National Park</div>\r\n		<h2 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<u style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\"><a href=\"https://gundri.com/blog/conservation-areas-of-nepal#HR\" style=\"box-sizing: border-box; color: rgb(33, 33, 33); text-decoration-line: none; background-color: transparent; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; outline: none; transition: all 0.3s ease-out 0s; overflow: hidden; line-height: 1.2; -webkit-font-smoothing: antialiased;\">Hunting reserve</a></u></h2>\r\n		<ul color:=\"\" line-height:=\"\" list-style-image:=\"\" list-style-position:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px 20px; padding-right: 0px; padding-left: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<li style=\"box-sizing: border-box; margin: 0px 0px 7px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; list-style-type: circle;\">\r\n				<div style=\"box-sizing: border-box; margin: 0px; padding: 5px 10px; border: 1px solid rgb(204, 204, 204); font-family: inherit; vertical-align: baseline; zoom: 1; background: rgb(238, 238, 238);\">\r\n					Dhorpatan Hunting Reserve</div>\r\n			</li>\r\n		</ul>\r\n		<h2 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<u style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1;\"><a href=\"https://gundri.com/blog/conservation-areas-of-nepal#WR\" style=\"box-sizing: border-box; color: rgb(33, 33, 33); text-decoration-line: none; background-color: transparent; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; outline: none; transition: all 0.3s ease-out 0s; overflow: hidden; line-height: 1.2; -webkit-font-smoothing: antialiased;\">Wildlife Reserve</a></u></h2>\r\n		<ul color:=\"\" line-height:=\"\" list-style-image:=\"\" list-style-position:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px 20px; padding-right: 0px; padding-left: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<li style=\"box-sizing: border-box; margin: 0px 0px 7px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; list-style-type: circle;\">\r\n				<div style=\"box-sizing: border-box; margin: 0px; padding: 5px 10px; border: 1px solid rgb(204, 204, 204); font-family: inherit; vertical-align: baseline; zoom: 1; background: rgb(238, 238, 238);\">\r\n					Koshi-Tappu wildlife reserve</div>\r\n			</li>\r\n		</ul>\r\n		<h2 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 18px; font-weight: normal; line-height: 1.4; font-size: 38px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<a id=\"NP\" name=\"NP\" style=\"box-sizing: border-box; color: inherit; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: baseline; zoom: 1; outline: none; transition: all 0.3s ease-out 0s; overflow: hidden; line-height: 1.2; -webkit-font-smoothing: antialiased;\">National Parks</a></h2>\r\n		<h3 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 10px; font-weight: normal; line-height: 1.15; font-size: 30px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			1) Shey Phoksundo National Park</h3>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Shey Phoksundo National Park is Nepal&rsquo;s biggest national park consisting of snow-filled mountain trails, famous for some of the rarest natural creatures. Though only 5% of the national park falls into the subtropical region it offers a huge range of vegetation, wildlife, and birdlife, which flourishes in its rocky, snow-filled peaks.&nbsp;</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Area:&nbsp;</span>3,555 sq.km (1,373 sq mi)&nbsp;</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Established:</span>&nbsp;1984 AD</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Districts:&nbsp;</span>Dolpa and Mugu</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Attractions:&nbsp;</span>Phoksundo Lake, Dolpo region, Kanjiroba massifs, Shey Gompa, Thashung Gompa</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Activities:&nbsp;</span>Bird watching, Trekking, Religious Pilgrim, site seeing&nbsp;</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Vegetations:</span>&nbsp; Only about 5% of the park is covered in trees, and the vegetation in Shey Phoksundo national park includes Rhododendron, Caragana Shrubs, Salix, Juniper, White Himalayan Birch, Blue Pine, Spruce, Hemlock, Cedar, Silver Fir</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Wildlife:</span>&nbsp;Snow Leopard, Gray Wolf, Musk Deer, Blue Sheep, Great Tibetan Sheep, Himalayan Tahr, Leopard</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Butterflies:</span>&nbsp;29 butterfly varieties, including the highest flying butterfly in the world - Paralasa Nepalaica.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Birds:</span>&nbsp;Over 200 bird species including Tibetan Partridge, Wood Snipe, White-Throated Tit, Wood Accentor</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">How to get to Shey Phoksundo National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Reach to Nepalgung via air or road then catch a vehicle to Radi and hike up to the entrance of the National Park.</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">When to Travel to Shey Phoksundo National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			It&#39;s open throughout the year but April to September is the best months to travel.</p>\r\n		<h3 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 10px; font-weight: normal; line-height: 1.15; font-size: 30px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			2) Langtang National Park</h3>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Langtang National Park is the nation&rsquo;s second-oldest conservation site and Nepal&#39;s first transhimalayan national park. Langtang range covers a huge area and has a hilly to alpine environment friendly for various flora and fauna. It is the most scenic national park which offers an eye-catching view of mountains filled with some rarest animals. The national park has one of the most diverse climate zones on the planet. (Sub-Tropical to Alpine Environment)</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Area:</span>&nbsp;1,710 sq.km (660 sq.mi)</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Established:</span>&nbsp;1976 AD</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Districts:</span>&nbsp;Rasuwa, Nuwakot, and Sindhupalchok</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Attractions:</span>&nbsp;Langtang-Helambu Range, Panch Pokhari, Ganja-La Pass, Gosainkunda&nbsp;</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Activities:&nbsp;</span>Trekking, Bird Watching, Pilgrim Visit, Photography, Camping, and Expedition</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Vegetations:</span>&nbsp; Chirpine, Rhododendron, Birch, Silver Fir, Sorbus Micropyle, Twisted Rhododendron, Bamboo Forests, Meadows Alpine Grassland above 4000 meters</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Wildlife:&nbsp;</span>Musk deer, Himalayan tahr, Red pandas, Himalayan black bears, snow leopards, wild dogs, Ghoral, Serow</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Birds:</span>&nbsp;250 species of birds such as Ruddy Shelduck, Common Pochard, Hill Partridge, Indian Peafowl, Himalayan Monal</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">How to get to Langtang National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			The national park is accessible via bus; Hire a personal vehicle or take a bus to Syabrubesi then hike for around 15 minutes to reach the entrance of Langtang National Park.</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">When to Travel to Langtang National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			The best time to travel to Langtang national park is from September till November.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			&nbsp;</p>\r\n		<h3 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 10px; font-weight: normal; line-height: 1.15; font-size: 30px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			3) Makalu Barun National Park</h3>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Makalu Barun National park is regarded as one of the most dangerous national parks in Nepal with respect to its trails because its routes are fairly slippery and consist of some rockfall areas. Established in 1992, people visit the national park despite the danger for its scenic beauty and the wide range of plants and animals preserved in Makalu Barun Nationalpark.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Area:</span>&nbsp;1,500 sq.km (580 sq mi)</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Established:</span>&nbsp;1992 AD</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Districts</span>: Solukhumbu and Sankhuwasabha</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Attractions:</span>&nbsp;Mount Makalu, Arun Valley, 830 sq.km buffer zone, Chamalang (7,319 m / 24,012 ft), Baruntse (7,129 m / 23,389 ft), and Mera Peak (6,654 m / 21,831 ft)</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Activities:</span>&nbsp;Sightseeing, Bird watching, Trekking, Pilgrim Visits, Site Seeing</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Vegetations:</span>&nbsp;Oak, Maple, Magnolia, Sal, Schima, and Castanopsis, Himalayan birch, Himalayan Fir, Juniper, and 3,128 species of flowering plants</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Wildlife:</span>&nbsp;Asian Golden Cat, Snow Leopard, Indian Leopard, Clouded Leopard, Leopard Cat, Golden Jackal, Himalayan Wolf, Red Panda, Black Bear, Musk Deer, Barking Deer</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Birds:&nbsp;</span>440 bird species, with 16 endangered species of birds such as Tibetan Snowcock, Blood Pheasant, Satyr Tragopan, Rock Pigeon, Large Hawk-Cuckoo</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">How to get to Makalu Barun National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			The place is covered with various aromatic wildflowers from September till November.</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">When to Travel to Makalu Barun National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Take a flight to either Lukla or Phaplu. The national park is about 15 minutes walk from Lukla Airport and about 45 minutes walk from Phaplu.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Or Take a bus ride from Lamidanda, Bhojpur, or Tumlingtar to the national park.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Do you need a guide?</span></p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Yes, you are not allowed to Trek without a guide.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			&nbsp;</p>\r\n		<h3 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 10px; font-weight: normal; line-height: 1.15; font-size: 30px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			4) Sagarmatha National Park</h3>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Known as the roof of the world,&nbsp;<a href=\"https://gundri.com/blog/sagarmatha-national-park\" style=\"box-sizing: border-box; color: rgb(255, 45, 84); text-decoration-line: none; background-color: transparent; margin: 0px; padding: 0px; border: 0px; font-family: inherit; vertical-align: baseline; zoom: 1; outline: none; transition: all 0.3s ease-out 0s; overflow: hidden;\" target=\"_blank\">Sagarmatha national park</a>&nbsp;offers a beautiful experience in the alpine environment. Sagarmatha national park has one of the busiest trekking trails in Nepal and it properly preserves the beauty, vegetation, and wildlife of Mt.Everest and its surrounding area.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Area:</span>&nbsp;1,148 sq.km (443 sq.mi)</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Established:</span>&nbsp;1976 AD</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">District:</span>&nbsp;Solukhumbu</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Attractions:&nbsp;</span>Kala Patthar, Mount Everest, Bhote Koshi, Gokyo Valley, Lhotse, Nuptse, Amadablam, Thamserku Cho Oyu, and Pumori.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Activities:&nbsp;</span>Trekking, Expedition, Bird watching, Pilgrim Visit, Site Seeing</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Vegetations:</span>&nbsp;3% Forest, 28% Kharkas (Grazing Land), Mosses and lichens in the barren mountain</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Wildlife:</span>&nbsp;Himalayan Tahr, Musk Deer, Snow Leopard, and Indian Leopard</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Birds:</span>&nbsp;Lesser Whistling-Duck, Bar-headed Goose, Northern Shoveler, Chukar, Kalij Pheasant</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">How to get to Sagarmatha National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Take a flight to Lukla, Sagarmatha National park is about 10 minutes walk from the Airport.</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">When to Travel to Sagarmatha National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Sagarmatha national park is a four-season trail but it&rsquo;s better to travel from early October till the end of November and from March till May.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Do you need a guide?</span></p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Yes, Sagarmatha Nationalpark is a difficult trail, so you will need a guide.</p>\r\n		<h3 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 10px; font-weight: normal; line-height: 1.15; font-size: 30px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			5) Bardia National Park</h3>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Bardia National Park offers a huge opportunity for people who love seeing wildlife. As it is a national park with very little human interference, the ecology in Bardia is totally unaltered and untouched. The dense forest of Bardia is famous for Bengal Tiger (largest tiger in the cat family), Asiatic elephant, Indian Leopards, and various antelopes.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Area:</span>&nbsp;968 sq.km (374 sq mi)</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Established:</span>&nbsp;1988 AD</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">District:</span>&nbsp;Bardia</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Attractions</span>: This national Park is famous for big cats like tiger and leopards.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Activities:</span>&nbsp;Elephant back riding, Jungle safari, Bird Watching, Locating Tigers</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Vegetation:</span>&nbsp;839 species of plant, tropical rainforest</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Wildlife:</span>&nbsp;Royal Bengal Tiger, Rusty-Spotted Cat, Fishing Cat, Swamp Deer, and Gangetic Dolphin in Karnali river</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Birds:&nbsp;</span>407 species of nestlings and 11 endangered species of birds such as Greylag Goose, Knob-billed Duck, Garganey, Northern Shoveler, Mallard</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Aquatic:</span>&nbsp;125 types of fishes</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Amphibians and Reptiles:</span>&nbsp;Gharial, Mugger crocodiles, and 23 types of reptiles.</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">How to get to&nbsp;Bardia National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Fly to the Nepalgunj and take a vehiche to the national park. Bardia National park is around 84 km away from Nepalgunj Airport.</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">When to Travel to Bardia National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			The best time to visit Bardia National Park is from February to July and from September till December.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Do you need a guide?</span></p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			It&#39;s not mandatory, but the area is a dense forest, the locals also complain of being attacked by wild animals. It is always better to hire one who knows the jungle well.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			&nbsp;</p>\r\n		<h3 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 10px; font-weight: normal; line-height: 1.15; font-size: 30px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<a id=\"chitwan_national_park\" name=\"chitwan_national_park\" style=\"box-sizing: border-box; color: inherit; margin: 0px; padding: 0px; border-width: 0px; border-style: initial; border-color: initial; font-family: inherit; vertical-align: baseline; zoom: 1; outline: none; transition: all 0.3s ease-out 0s; overflow: hidden; line-height: 1.2; -webkit-font-smoothing: antialiased;\"></a>6) Chitwan National Park</h3>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Chitwan National Park is the oldest National Park in Nepal and is enlisted as the UNESCO world heritage site. This national park has the biggest number of One-Horned rhinos in Nepal and is equally famous for Bengal Tigers. Likewise, the tropical terrain region has various grasslands favoring the flourish of Antalops.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Area:</span>&nbsp; 952.63 sq.km (367.81 sq.mi)</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Established:</span>&nbsp;1973 AD</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Districts:&nbsp;</span>Chitwan, Nawalparasi, Parsa and Makwanpur</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Attractions:</span>&nbsp;Sightseeing, Canyoning, jungle safari, Animal watching, Bird watching, Elephant breeding center, Gharial, and Maggar crocodile protection project, Learning the culture of tharu community, Homestays, and many more</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Vegetation:&nbsp;</span>Tropical Terrain rainforest&nbsp;</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Wildlife:</span>&nbsp;68 species of mammals, including Tigers, Leopards, Deer, Indian Bulls, Blue Bulls, One-Horned Rhinos</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Birds:&nbsp;</span>544 species of birds including Bar-headed Goose, Greater White-fronted Goose, Mandarin Duck, Gadwall, Northern Pintail, Peacocks, Blue-breasted Quail</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Aquatic:</span>&nbsp;56 species of herpetofauna and 126 species of fish.</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">How to get to Chitwan National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Chitwan National Park is 15 minutes drive from Bharatpur Airport.</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">When to Travel to Chitwan National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Chitwan National Park is open for four seasons but the best time to travel is from early October till late February.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Do you need a Guide?</span></p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Getting a guide is Optional in Chitwan National Park, but the hotels you stay at often hook you with a guide.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			&nbsp;</p>\r\n		<h3 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 10px; font-weight: normal; line-height: 1.15; font-size: 30px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			7) Parsa National Park</h3>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Previously a wildlife reserve, Parsa National Park is an easily accessible national park on Mahendra highway, and has its entrance point at Amlekhgunj. The national park is famous for a few Bengal tigers, Asiatic elephants, one-horned rhinos and is open all seasons.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Area:&nbsp;</span>637 sq.km (246 sq.mi)</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Established:</span>&nbsp;Declared as a Wildlife reserve in 1984 AD, and National Park in 2017 AD</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Districts:</span>&nbsp;Parsa, Bara, Makwanpur</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Attractions:</span>&nbsp;Elephant Back riding, Sightseeing, researching on terrain vegetation and its medicinal values. Seeing the foothills of the Churiya range.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Vegetation:</span>&nbsp;Tropical Terrain rainforest, Mixed Subtropical forest in Churiya</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Wildlife:</span>&nbsp;500 species of mammals such as blue bulls, Sambar, Hog deer, striped hyena, jungle cat, palm civet, one-horned rhino, Indian leopard, Leopard cat, Bengal Tiger</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Birds:</span>&nbsp;over 400 species of birds including Common Merganser, Common Goldeneye, Tufted Duck, Red Junglefowl, Kalij Pheasant</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">How to get to Parsa National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			It&rsquo;s around 30 minutes drive towards the Mahendra highway from Hetauda and 15 minutes from Simara Airport crossing Prithivi highway.</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">When to Travel to Parsa National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			February to July and September to December can be considered as an ideal time for travelers to visit Parsa national park.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Do you need a guide?</span></p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			It&#39;s not mandatory. If you intend to know the significance of the vegetation and animal life flourishing in the foothills of the Churiya Bhavar, you might hire one.</p>\r\n		<h3 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 10px; font-weight: normal; line-height: 1.15; font-size: 30px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			8) Banke National Park</h3>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Declared as &lsquo;Gift to the Earth&rsquo; by IUCN (International Union for Conservation of Nature) and promoted as Nepal&#39;s strict tiger protection zone, Banke National Park is once in a lifetime experience for people interested in wildlife and botany.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Area:</span>&nbsp;550 sq.km (210 sq.mi)</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Established:&nbsp;</span>2010 AD</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Districts:</span>&nbsp;Banke, Dang, and Salyan districts</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Attractions:&nbsp;</span>Tropical forest, variety of birds and animals, tiger conservation, bird watching, Jungle safari</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Activities:</span>&nbsp;Jungle safari, Animal watching, Birdwatching, locating tigers, visiting local villages</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Vegetation:&nbsp;</span>Tropical rainforest and Savanna zone and 124 plants</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Wildlife:</span>&nbsp;34 mammals, Including, Tigers, Leopards, Elephants, One-Horned Rhinos</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Birds:</span>&nbsp;300 birds, such as Gadwall, Northern Pintail, Peacocks, Blue-breasted Quail, Bar-headed Goose, Greater White-fronted Goose, and more</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Amphibians and Reptiles:</span>&nbsp;Golden tortoise, Mugger Crocs, Gharial Crocs, all together 7 amphibians and 24 reptiles</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">How to get to Banke National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Fly to Nepalgunj then take a taxi or public vehicle to the National Park. (about 1hrs 30 mins from the airport)</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">When to Travel to Banke National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			You can visit throughout the year.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Do you need a guide?</span></p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			It&#39;s recommended that you must get a guide, whenever you are planning to travel deep into the forest.</p>\r\n		<h3 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 25px 0px 10px; font-weight: normal; line-height: 1.15; font-size: 30px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			9) Shuklaphanta National Park</h3>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Biggest grasslands of Nepal supporting some of the rare and deadliest animals, Suklaphanta (meaning grassland in Nepali) is the best place to experience the Savanna environment, wildlife, and biodiversity.&nbsp;</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Area:&nbsp;</span>305 sq.km (118 sq.mi)</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Established</span>: 1976 AD as a Wildlife Reserve, 2017 AD as a National Park</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">District:</span>&nbsp;Kanchanpur&nbsp;</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Activities:</span>&nbsp;Jungle Safari, Elephant bathing, Elephant back riding, boating, cultural tours, and more</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Vegetation</span>: 16 Km long Grassland and tropical forest</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Wildlife:</span>&nbsp;Bengal tiger, Indian leopard, Sloth Bear, Elephants, Swamp Deer, Hispid, and Rhinos.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Birds:</span>&nbsp;432 species of bird including Common Shelduck, Graylag Goose, Eurasian Wigeon, Mallard, Northern Pintail, Red-crested Pochard</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">How to get to Shuklaphanta National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			Fly from Kathmandu to Dhangadi and catch a taxi or a public vehicle to the national park&#39;s entrance.</p>\r\n		<h4 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 18px 0px 12px; font-weight: normal; line-height: 1.4; font-size: 24px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; zoom: 1;\">When to Travel to Shuklaphanta National Park?</span></h4>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			March till June is the best time to visit Shuklaphanta National Park.</p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			<span muli=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">Do you need a guide?</span></p>\r\n		<p color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n			No,&nbsp; it&#39;s not mandatory&nbsp; but it&#39;s a place famous for big cats, so having someone who knows the place is always better.&nbsp;</p>\r\n	</li>\r\n</ol>\r\n', '2021-04-28', '0000-00-00', 5, 1, 1, 'VWnt6-blog_5.jpg', '', 1, 0, '', '', '2021-05-12 18:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offers`
--

CREATE TABLE `tbl_offers` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `list_image` varchar(255) NOT NULL,
  `adults` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `linksrc` varchar(255) NOT NULL,
  `linktype` tinyint(1) NOT NULL DEFAULT 0,
  `rate` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `brief` tinytext NOT NULL,
  `content` longtext NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `added_date` varchar(50) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_offers`
--

INSERT INTO `tbl_offers` (`id`, `slug`, `title`, `image`, `list_image`, `adults`, `children`, `linksrc`, `linktype`, `rate`, `discount`, `brief`, `content`, `status`, `added_date`, `sortorder`, `type`, `meta_keywords`, `meta_description`) VALUES
(4, 'save-10-discount-on-teej', 'Save 10% discount on teej', 'juOOj-img1.jpg', '', 0, 0, '', 0, 0, 0, '', '<p>\r\n	Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>\r\n', 1, '2023-09-22 20:07:22', 1, 0, '', ''),
(5, 'mileage-card-20-off', 'Mileage card 20% off', 'L9U9A-rectangle_8.jpg', '', 0, 0, '', 0, 0, 0, '', '<p>\r\n	Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>\r\n', 1, '2023-09-22 20:07:44', 2, 0, '', ''),
(6, '10-food-leverage', '10% food leverage', 'C1MFA-rectangle_7.jpg', '', 0, 0, '', 0, 0, 0, '', '<p>\r\n	Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>\r\n', 1, '2023-09-22 20:08:02', 3, 0, '', ''),
(7, 'heavy-discount-on-dashain', 'heavy discount on dashain<', 'NYQlb-rectangle_9.jpg', '', 0, 0, '', 0, 0, 0, '', '<p>\r\n	Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>\r\n', 1, '2023-09-22 20:08:20', 4, 0, '', ''),
(8, 'randome-offer-test-wow-looks-great', 'randome offer test wow looks great', 'gNB3X-rectangle_6.jpg', '', 0, 0, '', 0, 0, 0, '', '<p>\r\n	randome offer test wow looks greatrandome offer test wow looks greatrandome offer test wow looks great</p>\r\n', 1, '2023-09-22 20:08:41', 5, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer_child`
--

CREATE TABLE `tbl_offer_child` (
  `offer_id` int(11) NOT NULL,
  `offer_pax` varchar(200) NOT NULL,
  `offer_usd` varchar(10) NOT NULL,
  `offer_inr` varchar(10) NOT NULL,
  `offer_npr` varchar(10) NOT NULL,
  `offer_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package`
--

CREATE TABLE `tbl_package` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `banner_image` varchar(300) NOT NULL,
  `itenaryfile` mediumtext NOT NULL,
  `destinationId` int(11) NOT NULL,
  `activityId` int(11) NOT NULL,
  `regionId` int(11) NOT NULL,
  `expert_id` varchar(200) NOT NULL,
  `price` varchar(50) NOT NULL,
  `group_size_price1` varchar(200) NOT NULL,
  `discount1` varchar(200) NOT NULL,
  `offers` enum('Hot Deals','Early Bird','Special Offers') NOT NULL,
  `offer_price` int(11) NOT NULL,
  `accomodation` varchar(255) NOT NULL,
  `group_size` varchar(255) NOT NULL,
  `group_size_price2` varchar(100) NOT NULL,
  `group_size_price3` varchar(100) NOT NULL,
  `group_size_price4` varchar(100) NOT NULL,
  `group_size_price5` varchar(100) NOT NULL,
  `discount2` varchar(100) NOT NULL,
  `discount3` varchar(100) NOT NULL,
  `discount4` varchar(100) NOT NULL,
  `discount5` varchar(100) NOT NULL,
  `transportation` varchar(255) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `days` varchar(200) NOT NULL,
  `maptype` int(11) NOT NULL,
  `mapimage` varchar(255) NOT NULL,
  `mapgoogle` text NOT NULL,
  `videolink` int(11) NOT NULL,
  `breif` blob NOT NULL,
  `overview` blob NOT NULL,
  `itinerary` blob NOT NULL,
  `incexc` blob NOT NULL,
  `availability` blob NOT NULL,
  `others` blob NOT NULL,
  `guide` blob NOT NULL,
  `booking_info` blob NOT NULL,
  `other_info` blob NOT NULL,
  `altitude` varchar(50) NOT NULL,
  `difficulty` enum('Easy','Moderate','Moderate To Strenous','Strenous','Very Strenous') NOT NULL,
  `gread` varchar(20) NOT NULL,
  `season` varchar(50) NOT NULL,
  `pdate` varchar(50) NOT NULL,
  `startpoint` varchar(255) NOT NULL,
  `endpoint` varchar(255) NOT NULL,
  `gallery` blob NOT NULL,
  `expackage` text NOT NULL,
  `tags` varchar(50) NOT NULL,
  `color` varchar(20) NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `lastminutes` tinyint(1) NOT NULL DEFAULT 0,
  `homepage` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `fixed` tinyint(1) NOT NULL DEFAULT 0,
  `date` varchar(50) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) NOT NULL,
  `meta_keywords` blob NOT NULL,
  `meta_description` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_package`
--

INSERT INTO `tbl_package` (`id`, `slug`, `title`, `image`, `banner_image`, `itenaryfile`, `destinationId`, `activityId`, `regionId`, `expert_id`, `price`, `group_size_price1`, `discount1`, `offers`, `offer_price`, `accomodation`, `group_size`, `group_size_price2`, `group_size_price3`, `group_size_price4`, `group_size_price5`, `discount2`, `discount3`, `discount4`, `discount5`, `transportation`, `currency`, `days`, `maptype`, `mapimage`, `mapgoogle`, `videolink`, `breif`, `overview`, `itinerary`, `incexc`, `availability`, `others`, `guide`, `booking_info`, `other_info`, `altitude`, `difficulty`, `gread`, `season`, `pdate`, `startpoint`, `endpoint`, `gallery`, `expackage`, `tags`, `color`, `featured`, `lastminutes`, `homepage`, `status`, `added_by`, `fixed`, `date`, `sortorder`, `added_date`, `meta_keywords`, `meta_description`) VALUES
(1, '2-night-3-day-langtang-trek', '2 Night 3 Day Langtang Trek', 'IszDB-1.jpg', 'a:1:{i:0;s:11:\"wIQEg-3.jpg\";}', '', 34, 1, 0, 'a:0:{}', '120', '', '', '', 0, 'Kathmandu - pokhara', '10-20', '', '', '', '', '', '', '', '', '', 'USD', '21', 0, '', 'https://goo.gl/maps/tVDjcwVACVvrTTq16', 0, '', 0x3c703e0d0a0954686520446861756c61676972692c20616c6f6e67207769746820616e6f746865722065696768742074686f7573616e6465722c2074686520416e6e617075726e612c206361727665732074686520776f726c64262333393b73206465657065737420676f726765206f66204b616c6967616e64616b692e20546865207472656b20616c736f2063726f737365732074776f206869676820706173736573202d20746865204672656e636820706173732028352c3234306d2f31372c31393266742920616e642074686520546861706120706173732028352c3135356d2f31362c3931336674292e204d6f72656f7665722c2077652077696c6c20616c736f20657870657269656e636520736e6f7720616e6420676c61636965722077616c6b696e672c20657370656369616c6c792061726f756e64204974616c69616e20426173652043616d7020616e6420446861756c6167697269204e6f72746820426173652043616d702e20416c6f6e6720746865207761792c20776520656e6a6f792073706563746163756c6172207669657773206f6620446861756c61676972692c2054686f726f6e67207065616b2c20416e6e617075726e6120616e64204b616c692047616e64616b6920526976657220776974682074686520776f726c64206465657065737420676f7267652e204f6e2074686520747261696c2c207765206d617920616c736f20656e636f756e7465722073656d692d77696c642079616b2068657264732c206d6f756e7461696e20736865657020696e207468652072656d6f74652076616c6c657973206f66207468697320726567696f6e2e2042657369646573207468652077696c64206e61747572652c20776520616c736f20656e6a6f79207468652073686f70732c20746561686f757365732c20616e64206c6966657374796c65206f66204e6570616c262333393b73206574686e69632070656f706c65207375636820617320477572756e672c20436868657472692c20616e64204d61676172732e3c2f703e0d0a, '', 0x3c703e0d0a094c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e73656374657475722061646970697363696e6720656c69742e204d616563656e617320696e2070756c76696e6172206e657175652e204e756c6c612066696e69627573206c6f626f727469732070756c76696e61722e20446f6e6563206120636f6e7365637465747572206e756c6c612e204e756c6c6120706f73756572652073617069656e207669746165206c65637475732073757363697069742c2065742070756c76696e6172206e6973692074696e636964756e742e20416c697175616d206572617420766f6c75747061742e2043757261626974757220636f6e76616c6c6973206672696e67696c6c61206469616d2073656420616c697175616d2e205365642074656d706f7220696163756c6973206d6173736120666175636962757320666575676961742e20496e206665726d656e74756d20666163696c69736973206d617373612c206120636f6e73657175617420707572757320766976657272612e3c2f703e0d0a, '', '', '', 0x3c703e0d0a094c6f72656d20697073756d20646f6c6f722c2073697420616d657420636f6e7365637465747572206164697069736963696e6720656c69742e20426561746165206d61676e69206e656d6f206574206172636869746563746f2c206173706572696f72657320656f7320646f6c6f72652076656c2c20616d657420636f6e73657175617475722c206469676e697373696d6f7320656c6967656e6469206675676961742074656d706f726520646f6c6f72756d206e6f6e20706172696174757220636f6e736563746574757220696e2071756165726174206465736572756e743f3c2f703e0d0a, '', '', 'Easy', '2', 'Summer', '', '', '', '', '', '', '', 1, 0, 1, 1, 0, 0, '', 1, '2021-09-29 14:08:02', '', ''),
(2, 'test-package', 'test package', 'p1C5P-1.jpg', 'a:1:{i:0;s:11:\"eZZPy-2.jpg\";}', '', 28, 1, 0, '', '10', '', '', '', 0, 'ktm > chit', '12', '', '', '', '', '', '', '', '', '', 'USD', '3', 0, '', 'https://goo.gl/maps/tVDjcwVACVvrTTq16', 0, 0x3c703e0d0a0962726965643c2f703e0d0a, 0x3c703e0d0a096173646173643c2f703e0d0a, '', 0x3c703e0d0a09676664676664673c2f703e0d0a, '', '', '', 0x3c703e0d0a09686a6b686a6b686a6b3c2f703e0d0a, '', '', 'Easy', '4', 'Summer', '', '', '', '', '', '', '', 0, 0, 0, 1, 0, 0, '', 2, '2021-09-29 17:27:27', '', ''),
(3, 'ktm-pkg', 'ktm pkg', '', 'a:0:{}', '', 10, 1, 0, '', '200', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', 'USD', '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '0', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 174, 0, '', 3, '2021-10-11 15:01:29', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package_date`
--

CREATE TABLE `tbl_package_date` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `package_currency` varchar(10) NOT NULL,
  `package_rate` int(11) NOT NULL,
  `package_date` date NOT NULL,
  `package_closure` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package_images`
--

CREATE TABLE `tbl_package_images` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `packageid` int(11) NOT NULL,
  `detail` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `registered` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_package_images`
--

INSERT INTO `tbl_package_images` (`id`, `title`, `packageid`, `detail`, `status`, `sortorder`, `registered`, `image`) VALUES
(1, '1', 1, '', 1, 1, '2021-09-29 14:14:40', 'lMr47-uc.png'),
(2, '2', 1, '', 1, 2, '2021-09-29 17:34:45', 'JMerZ-1.jpg'),
(3, '3', 1, '', 1, 4, '2021-09-29 17:35:03', '5vREK-4.jpg'),
(4, '4', 1, '', 1, 3, '2021-09-29 17:35:03', 'FuDKf-2.jpg'),
(5, '5', 1, '', 1, 5, '2021-09-29 17:35:03', 'sl3vH-rama.jpg'),
(6, '6', 1, '', 1, 6, '2021-09-29 17:35:03', 'ktvUL-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page`
--

CREATE TABLE `tbl_page` (
  `id` int(11) NOT NULL,
  `slug` tinytext NOT NULL,
  `title` tinytext NOT NULL,
  `content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `meta_keywords` varchar(250) NOT NULL,
  `meta_description` varchar(250) NOT NULL,
  `type` int(11) NOT NULL,
  `added_date` varchar(50) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `homepage` int(11) NOT NULL DEFAULT 0,
  `image` blob NOT NULL,
  `date` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `slug`, `title`, `content`, `status`, `meta_keywords`, `meta_description`, `type`, `added_date`, `sortorder`, `homepage`, `image`, `date`, `category`) VALUES
(1, 'siddhartha-business-group-of-br-hospitality-pvt-ltd', 'SIDDHARTHA Business Group of<br/>Hospitality Pvt. Ltd', '<p>\r\n	SIDDHARTHA Business Group of Hospitality (SBGH) is a hospitality enterprise focused in food and hospitality as well as travel and trade. Hence, SBGH has surpassed its services from fooding and lodging to a prominent hospitality enterprise engaging in an array of activities that help bolster national economy. With twenty-five years of experience in restaurant.</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 1, '', '', 0, '2016-08-20 15:28:12', 1, 1, 0x613a313a7b693a303b733a31333a2249656656412d616e6e2e6a7067223b7d, '', ''),
(2, 'privacy', 'privacy', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ullamcorper dui ut magna congue, id mollis turpis ultricies. Maecenas ex velit, dictum id nunc id, molestie accumsan massa. Morbi placerat erat et nisl sodales sodales in lacinia augue. Nunc pulvinar lacus sit amet lobortis consequat. Nunc pellentesque lobortis tincidunt. Suspendisse potenti. Nullam bibendum pretium venenatis. Sed tristique pharetra odio, quis rhoncus nibh porta ut. Quisque pellentesque ac neque nec auctor. Sed sollicitudin elit sed velit iaculis, mattis iaculis est sollicitudin. Curabitur quis blandit tellus. Curabitur consequat, tellus nec pellentesque fermentum, sem velit consequat ex, a faucibus magna augue id ipsum. Pellentesque ultrices a nisi nec facilisis. Nullam eget ex sed urna porttitor tempor. Integer pellentesque blandit tincidunt.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">\r\n	Fusce aliquam cursus blandit. Vivamus rhoncus ligula eu ipsum iaculis vulputate. Integer sem velit, tincidunt sit amet urna ac, lobortis volutpat sem. Etiam tincidunt ultricies maximus. Morbi congue neque non nisi ultricies, quis feugiat justo interdum. Ut commodo eros nec blandit convallis. Etiam nec sagittis diam. Proin at dolor et nibh semper lacinia et iaculis dolor. Suspendisse ligula est, iaculis nec enim non, lobortis semper massa. Fusce at neque ex. Nunc congue metus nisi, et ornare sem mollis ac.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">\r\n	Phasellus eget nunc quis odio varius pellentesque ac quis tortor. Phasellus elementum porttitor tortor eget pellentesque. Curabitur efficitur, leo sit amet tristique rhoncus, diam ligula vehicula erat, vitae maximus lorem justo et tellus. Nunc iaculis facilisis dui, a imperdiet erat ultrices a. Nullam urna justo, tincidunt sed molestie id, blandit ut erat. Donec egestas velit dolor, ut convallis purus blandit non. Donec purus dui, ultricies sit amet tincidunt et, egestas vitae nibh. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse potenti. Praesent massa libero, pharetra ut lacinia id, bibendum sed ligula. Proin vulputate posuere dolor eu mattis. Donec a auctor massa, eget mollis dolor. Aliquam accumsan, mi sed egestas bibendum, nibh neque aliquet erat, ut pharetra orci dolor vel sapien.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">\r\n	Vivamus luctus viverra est nec tincidunt. Nunc eleifend velit leo, vitae cursus sem interdum a. Aliquam eu felis lectus. Nulla luctus mollis orci at rhoncus. Suspendisse sit amet mauris non risus ullamcorper iaculis ac congue ligula. Nulla rhoncus tristique eleifend. Aliquam blandit efficitur venenatis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget nunc at nisl dignissim porta. Aenean in nibh cursus, lobortis ipsum a, iaculis ligula. Vestibulum ullamcorper justo diam, ac pretium tellus placerat vitae. Nullam porttitor lacus non euismod finibus.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">\r\n	In eu egestas lectus. Vivamus in eros a eros eleifend lacinia. Phasellus sed vehicula arcu. Maecenas semper, orci ac consectetur commodo, est massa ultricies odio, cursus semper nunc tellus nec ipsum. Etiam ipsum libero, lobortis sed enim eget, posuere auctor ipsum. Ut magna dolor, tincidunt vitae porttitor vel, dapibus sed nisi. In purus lectus, accumsan quis purus quis, suscipit condimentum sapien. Sed at dolor ullamcorper risus volutpat cursus vitae sit amet nisi. Fusce semper metus a dolor auctor posuere. Duis et venenatis urna. Vestibulum at condimentum quam, eget placerat lacus.</p>\r\n', 1, '', '', 0, '2017-01-11 16:36:00', 2, 0, 0x613a303a7b7d, '', ''),
(3, 'terms', 'terms', '<p>\r\n	<strong>APPLICABILITY&nbsp;</strong></p>\r\n<p>\r\n	This User Agreement along with Terms Of Service (collectively, the &quot;User Agreement&quot;) forms the terms and conditions for the use of services and products of Samrat Holidays (Nepal) Private Limited (&quot;SH&quot;).</p>\r\n<p>\r\n	Any person (&quot;User&quot;) who inquiries about or purchases any products or services of SH through its websites, mobile applications, sales persons, offices, call centers, branch offices, franchisees, agents etc. (all the aforesaid platforms collectively referred to as &quot;Sales Channels&quot;) agree to be governed by this User Agreement. The websites and the mobile applications of SH are collectively referred to as &#39;Website&#39;.</p>\r\n<p>\r\n	Both User and SH are individually referred to as &#39;Party&#39; and collectively referred to as &#39;Parties&#39; to the User Agreement.</p>\r\n<p>\r\n	&quot;Terms of Service&quot; available on SH&#39;s website details out terms &amp; conditions applicable on various services or products facilitated by SH. The User should refer to the relevant Terms of Service applicable for the given product or service as booked by the User. Such Terms of Service are binding on the User.</p>\r\n<p>\r\n	<strong>ELIGIBILITY TO USE&nbsp;</strong></p>\r\n<p>\r\n	The User must be at least 18 years of age and must possess the legal authority to enter into an agreement so as become a User and use the services of SH.</p>\r\n<p>\r\n	Before using the Website, approaching any Sales Channels or procuring the services of SH, the Users shall compulsorily read and understand this User Agreement, and shall be deemed to have accepted this User Agreement as a binding document that governs User&#39;s dealings and transactions with SH. If the User does not agree with any part of this Agreement, then the User must not avail SH&#39;s services and must not access or approach the Sales Channels of SH.</p>\r\n<p>\r\n	All rights and liabilities of the User and SH with respect to any services or product facilitated by SH shall be restricted to the scope of this User Agreement.</p>\r\n<p>\r\n	<strong>CONTENT&nbsp;</strong></p>\r\n<p>\r\n	All content provided through various Sales Channels, including but not limited to audio, images, software, text, icons and such similar content (&quot;Content&quot;), are registered by SH and protected under applicable intellectual property laws. User cannot use this Content for any other purpose, except as specified herein.</p>\r\n<p>\r\n	User agrees to follow all instructions provided by SH which will prescribe the way such User may use the Content.</p>\r\n<p>\r\n	There are a number of proprietary logos, service marks and trademarks displayed on the Website and through other Sales Channels of SH, as may be applicable. SH does not grant the User a license, right or authority to utilize such proprietary logos, service marks, or trademarks in any manner. Any unauthorized use of the Content, will be in violation of the applicable law.</p>\r\n<p>\r\n	SH respects the intellectual property rights of others. If you notice any act of infringement on the Website, you are requested to send us a written notice/ intimation which must include the following information;&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Clear identification of such copyrighted work that you claim has been infringed;</li>\r\n	<li>\r\n		Location of the material on the Website, including but not limited to the link of the infringing material;</li>\r\n	<li>\r\n		The proof that the alleged copyrighted work is owned by you;</li>\r\n	<li>\r\n		Contact information;</li>\r\n</ul>\r\n<p>\r\n	<strong>WEBSITE&nbsp;</strong></p>\r\n<p>\r\n	The Website is meant to be used by bonafide User(s) for a lawful use.&nbsp;<br />\r\n	<br />\r\n	User shall not distribute exchange, modify, sell or transmit anything from the Website, including but not limited to any text, images, audio and video, for any business, commercial or public purpose.&nbsp;<br />\r\n	<br />\r\n	The User Agreement grants a limited, non-exclusive, non-transferable right to use this Website as expressly permitted in this User Agreement. The User agrees not to interrupt or attempt to interrupt the operation of the Website in any manner whatsoever.&nbsp;<br />\r\n	<br />\r\n	Access to certain features of the Website may only be available to registered User(s). The process of registration, may require the User to answer certain questions or provide certain information that may or may not be personal in nature. Some such fields may be mandatory or optional. User represents and warrants that all information supplied to SH is true and accurate.&nbsp;<br />\r\n	<br />\r\n	SH reserves the right, in its sole discretion, to terminate the access to the Website and the services offered on the same or any portion thereof at any time, without notice, for general maintenance or any other reason whatsoever.&nbsp;<br />\r\n	<br />\r\n	SH will always make its best endeavors to ensure that the content on its websites or other sales channels are free of any virus or such other malwares. However, any data or information downloaded or otherwise obtained through the use of the Website or any other Sales Channel is done entirely at the User&#39;s own discretion and risk and they will be solely responsible for any damage to their computer systems or loss of data that may result from the download of such data or information.&nbsp;<br />\r\n	<br />\r\n	SH reserves the right to periodically make improvements or changes in its Website at any time without any prior notice to the User. User(s) are requested to report any content on the Website which is deemed to be unlawful, objectionable, libelous, defamatory, obscene, harassing, invasive to privacy, abusive, fraudulent, against any religious beliefs, spam, or is violative of any applicable law to email. On receiving such report, SH reserves the right to investigate and/or take such action as the Company may deem appropriate.</p>\r\n<p>\r\n	<strong>LIMITED LIABILITY OF SH&nbsp;</strong></p>\r\n<p>\r\n	Unless SH explicitly acts as a reseller in certain scenarios, SH always acts as a facilitator by connecting the User with the respective service providers like airlines, hotels, restaurants, bus operators etc. (collectively referred to as &quot;Service Providers&quot;). SH&#39;s liability is limited to providing the User with a confirmed booking as selected by the User.</p>\r\n<p>\r\n	Any issues or concerns faced by the User at the time of availing any such services shall be the sole responsibility of the Service Provider. SH will have no liability with respect to the acts, omissions, errors, representations, warranties, breaches or negligence on part of any Service Provider.</p>\r\n<p>\r\n	Unless explicitly committed by SH as a part of any product or service:</p>\r\n<ul>\r\n	<li>\r\n		SH assumes no liability for the standard of services as provided by the respective Service Providers.</li>\r\n	<li>\r\n		SH provides no guarantee with regard to their quality or fitness as represented.</li>\r\n	<li>\r\n		SH doesn&#39;t guarantee the availability of any services as listed by a Service Provider.</li>\r\n</ul>\r\n<p>\r\n	By making a booking, User understands SH merely provides a technology platform for booking of services and products and the ultimate liability rests on the respective Service Provider and not SH. Thus the ultimate contract of service is between User and Service Provider.</p>\r\n<p>\r\n	<strong>USER&#39;S RESPONSIBILITY&nbsp;</strong></p>\r\n<p>\r\n	Users are advised to check the description of the services and products carefully before making a booking. User(s) agree to be bound by all the conditions as contained in booking confirmation or as laid out in the confirmed booking voucher. These conditions are also to be read in consonance with the User Agreement.&nbsp;<br />\r\n	<br />\r\n	If a User intends to make a booking on behalf of another person, it shall be the responsibility of the User to inform such person about the terms of this Agreement, including all rules and restrictions applicable thereto.&nbsp;<br />\r\n	<br />\r\n	The User warrants that they will abide by all such additional procedures and guidelines, as modified from time to time, in connection with the use of the services. The User further warrants that they will comply with all applicable laws and regulations of the concerned jurisdiction regarding use of the services for each transaction.&nbsp;</p>\r\n<p>\r\n	<strong>SECURITY AND ACCOUNT RELATED INFORMATION&nbsp;</strong></p>\r\n<p>\r\n	While registering on the Website, the User will have to choose a password to access that User&#39;s account and User shall be solely responsible for maintaining the confidentiality of both the password and the account as well as for all activities on the account. It is the duty of the User to notify SH immediately in writing of any unauthorized use of their password or account or any other breach of security. SH will not be liable for any loss that may be incurred by the User as a result of unauthorized use of the password or account, either with or without the User&#39;s knowledge. The User shall not use anyone else&#39;s account at any time.&nbsp;<br />\r\n	<br />\r\n	User understands that any information that is provided to this Website may be read or intercepted by others due to any breach of security at the User&#39;s end.</p>\r\n<p>\r\n	SH keeps all the data in relation to credit card, debit card, bank information etc. secured and in an encrypted form in compliance with the applicable laws and regulations. However, for cases of fraud detection, offering bookings on credit (finance) etc., SH may at times verify certain information of its Users like their credit score, as and when required.&nbsp;<br />\r\n	<br />\r\n	SH adopts the best industry standard to secure the information as provided by the User. However, SH cannot guarantee that there will never be any security breach of its systems which may have an impact on User&#39;s information too.&nbsp;<br />\r\n	<br />\r\n	The data of the User as available with SH may be shared with concerned law enforcement agencies for any lawful or investigation purpose without the consent of the User.&nbsp;</p>\r\n<p>\r\n	<strong>FEES AND PAYMENT&nbsp;</strong></p>\r\n<p>\r\n	In addition to the cost of booking as charged by the Service Providers, SH reserves the right to charge certain fees in the nature of convenience fees or service fees. SH further reserves the right to alter any and all fees from time to time. Any such additional fees, including fee towards any modifications thereof, will be displayed to the User before confirming the booking or collecting the payment from such User.&nbsp;<br />\r\n	<br />\r\n	In cases of short charging of the booking amount, taxes, statutory fee, convenience fee etc., owing to any technical error or other reason, SH shall reserve the right to deduct, charge or claim the balance amount from the User and the User shall pay such balance amount to SH. In cases where the short charge is claimed prior to the utilization of the booking, SH will be at liberty to cancel such bookings if the amount is not paid before the utilization date.&nbsp;<br />\r\n	<br />\r\n	Any increase in the price charged by SH on account of change in rate of taxes or imposition of new taxes, levies by Government shall have to be borne by the User. Such imposition of taxes, levies may be without prior notice and could also be retrospective but will always be as per applicable law.&nbsp;<br />\r\n	<br />\r\n	In the rare circumstance of a booking not getting confirmed for any reason whatsoever, SH will process the refund of the booking amount paid by the User and intimate the User about the same. SH is not under any obligation to provide an alternate booking in lieu of or to compensate or replace the unconfirmed booking. All subsequent bookings will be treated as new transactions. Any applicable refund will be processed as per the defined policies of the service provider and SH as the case may be.&nbsp;<br />\r\n	<br />\r\n	The User shall be completely responsible for all charges, fees, duties, taxes, and assessments arising out of the use of the service, as per the applicable laws&nbsp;<br />\r\n	<br />\r\n	The User agrees and understands that all payments shall only be made to bank accounts of SH. SH or its agents, representatives or employees shall never ask a customer to transfer money to any private account or to an account not held in the name of SH. The User agrees that if that user transfers any amount against any booking or transaction to any bank account that is not legitimately held by SH or to any personal account of any person, SH shall not be held liable for the same. User shall not hold any right to recover from SH any amount which is transferred by the User to any third party.&nbsp;<br />\r\n	<br />\r\n	The User will not share his personal sensitive information like credit/debit card number, CVV, OTP, card expiry date, user IDs, passwords etc. with any person including the agents, employees or representatives of SH. The User shall immediately inform SH if such details are demanded by any of its agents&#39; employees or representatives. SH shall not be liable for any loss that the User incurs for sharing the aforesaid details.&nbsp;<br />\r\n	<br />\r\n	Refunds, if any, on cancelled bookings will always be processed to the respective account or the banking instrument (credit card, wallet etc.) from which payment was made for that booking.&nbsp;<br />\r\n	<br />\r\n	Booking(s) made by the User through SH are subject to the applicable cancellation policy as set out on the booking page or as communicated to the customers in writing.</p>\r\n<p>\r\n	<strong>USAGE OF THE MOBILE NUMBER, COMMUNICATION DETAILS OF THE USER BY SH&nbsp;</strong></p>\r\n<p>\r\n	SH will send booking confirmation, itinerary information, cancellation, payment confirmation, refund status, schedule change or any such other information relevant for the transaction or booking made by the User, via SMS, internet-based messaging applications like WhatsApp, voice call, e-mail or any other alternate communication detail provided by the User at the time of booking.</p>\r\n<p>\r\n	SH may also contact the User through the modes mentioned above for any pending or failed bookings, to know the preference of the User for concluding the booking and also to help the User for the same.</p>\r\n<p>\r\n	The User hereby unconditionally consents that such communications via SMS, internet-based messaging applications like WhatsApp, voice call, email or any other mode by SH are:&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		upon the request and authorization of the User;</li>\r\n	<li>\r\n		&#39;transactional&#39; and not an &#39;unsolicited commercial communication&#39; as per the guidelines of Nepal Telecommunication Authority (NTA), and</li>\r\n	<li>\r\n		in compliance with the relevant guidelines of NTA or such other authority in Nepal and abroad.</li>\r\n</ul>\r\n<p>\r\n	The User will indemnify SH against all types of losses and damages incurred by SH due to any action taken by NTA, Access Providers (as per NTA regulations) or any other authority due to any erroneous complaint raised by the User on SH with respect to the communications mentioned above or due to a wrong number or email id being provided by the User for any reason whatsoever.</p>\r\n<p>\r\n	<strong>INSURANCE&nbsp;</strong></p>\r\n<p>\r\n	Unless explicitly provided by SH in any specific service or deliverable, obtaining sufficient insurance coverage is the obligation or on the option of the user. SH doesn&#39;t accept any claims arising out of such liabilities arising in connection to the insurance.<br />\r\n	<br />\r\n	If any insurance provided as a part of the service or products by SH, It &nbsp;shall be as per the terms and conditions of the insuring company. The User shall contact the insurance company directly for any claims or dispute.<br />\r\n	<br />\r\n	SH shall not provide any express or implied undertakings for acceptance of the claims by the insurance company.</p>\r\n<p>\r\n	<strong>OBLIGATION TO OBTAIN VISA&nbsp;</strong></p>\r\n<p>\r\n	The travel bookings done by SH &nbsp;are subject to the applicable requirements of Visa which are to be obtained by the individual traveler. SH is not responsible for any issues, including inability to travel, arising out of such Visa requirements and is also not liable to refund for the untraveled bookings due to any such reason.</p>\r\n<p>\r\n	<strong>FORCE MAJEURE&nbsp;</strong></p>\r\n<p>\r\n	There can be exceptional circumstances where SH and / or the Service Providers may be unable to honor the confirmed bookings due to various reasons like act of God, labor unrest, insolvency, business exigencies, government decisions, terrorist activity, any operational and technical issues, route and flight cancellations etc. or any other reason beyond the control of SH. If SH has advance knowledge of any such situations where dishonor of bookings may happen, it will make its best efforts to provide similar alternative to the User or refund the booking amount after deducting applicable service charges, if supported and refunded by that respective service operators. The User agrees that SH being merely a facilitator of the services and products booked, cannot be held responsible for any such Force Majeure circumstance. The User has to contact the Service Provider directly for any further resolutions and refunds.&nbsp;<br />\r\n	<br />\r\n	The User agrees that in the event of non-confirmation of booking due to any technical reasons (like network downtime, disconnection with third party platforms such as payment gateways, banks etc.) or any other similar failures, SH&#39;s obligation shall be limited refunding the booking amount, if any, received from the customer. Such refund shall completely discharge SH from all liabilities with respect to that transaction. Additional liabilities, if any, shall be borne by the User.&nbsp;<br />\r\n	<br />\r\n	In no event shall SH and be liable for any direct, indirect, punitive, incidental, special or consequential damages, and any other damages like damages for loss of use, data or profits, arising out of or in any way connected with the use or performance of the Website or any other Sales Channel.&nbsp;</p>\r\n<p>\r\n	<strong>RIGHT TO REFUSE&nbsp;</strong></p>\r\n<p>\r\n	SH at its sole discretion reserves the right to not accept any booking without assigning any reason thereof.</p>\r\n<p>\r\n	SH will not provide any service or share confirmed booking details till such time the complete consideration is received from the User.</p>\r\n<p>\r\n	In addition to other remedies and recourse available to SH under this User Agreement or under applicable law, SH may limit the User&#39;s activity, warn other users of the User&#39;s actions, immediately suspend or terminate the User&#39;s registration, or refuse to provide the User with access to the Website if:</p>\r\n<ul>\r\n	<li>\r\n		The User is in breach of this User Agreement; or</li>\r\n	<li>\r\n		SH is unable to verify or authenticate any information provided by the User; or</li>\r\n	<li>\r\n		SH believes that the User&#39;s actions may infringe on any third-party rights or breach any applicable law or otherwise result in any liability for the User, other users of SH, or SH itself.</li>\r\n</ul>\r\n<p>\r\n	Once a User has been suspended or terminated, such User shall not register or attempt to register with SH with different credentials, or use the Website in any manner whatsoever until such User is reinstated by SH. SH may at any time in its sole discretion reinstate suspended users.</p>\r\n<p>\r\n	If a User breaches this User Agreement, SH reserves the right to recover any amounts due to be paid by the User to SH, and to take appropriate legal action as it deems necessary.</p>\r\n<p>\r\n	The User shall not write or send any content to SH which is, or communicate with SH using language or content which is:</p>\r\n<ul>\r\n	<li>\r\n		abusive, threatening, offensive, defamatory, coercive, obscene, belligerent, glorifying violence, vulgar, sexually explicit, pornographic, illicit or otherwise objectionable;</li>\r\n	<li>\r\n		contrary to any applicable law;</li>\r\n	<li>\r\n		violates third parties&#39; intellectual property rights;</li>\r\n	<li>\r\n		in breach of any other part of these terms and conditions of use.</li>\r\n</ul>\r\n<p>\r\n	If the User violates any of the aforesaid terms, SH shall be at liberty to take appropriate legal action against the User.</p>\r\n<p>\r\n	<strong>RIGHT TO CANCEL&nbsp;</strong></p>\r\n<p>\r\n	The User expressly undertakes to provide SH with correct and valid information while making use of the Website under this User Agreement, and not to make any misrepresentation of facts. Any default on part of the User would disentitle the User from availing the services from SH.&nbsp;<br />\r\n	<br />\r\n	In case SH discovers or has reasons to believe at any time during or after receiving a request for services from the User that the request for services is either unauthorized or the information provided by the User or any of the travelers is not correct or that any fact has been misrepresented by that User, SH shall be entitled to appropriate legal remedies against the User, including cancellation of the bookings, without any prior intimation to the User. In such an event, SH shall not be responsible or liable for any loss or damage that may be caused to the User or any other person in the booking, as a consequence of such cancellation of booking or services.&nbsp;<br />\r\n	<br />\r\n	If any judicial, quasi-judicial, investigation agency, government authority approaches SH to cancel any booking, SH will cancel the same without approaching the concerned User whose booking has been cancelled.&nbsp;<br />\r\n	<br />\r\n	The User shall not hold SH responsible for any loss or damage arising out of measures taken by SH for safeguarding its own interest and that of its genuine customers. This would also include SH denying or cancelling any bookings on account of suspected fraud transactions.</p>\r\n<p>\r\n	<strong>INDEMNIFICATION&nbsp;</strong></p>\r\n<p>\r\n	The User agrees to indemnify, defend and hold harmless SH, its affiliates and their respective officers, directors, lawful successors and assigns from and against any and all losses, liabilities, claims, damages, costs and expenses (including legal fees and disbursements in connection therewith and interest chargeable thereon) asserted against or incurred by such indemnified persons, that arise out of, result from, or may be payable by virtue of, any breach of any representation or warranty provided by the User, or non-performance of any covenant by the User.&nbsp;<br />\r\n	<br />\r\n	The User shall be solely liable for any breach of any country specific rules and regulations or general code of conduct and SH cannot be held responsible for the same.</p>\r\n<p>\r\n	<strong>MISCLLEANEOUS&nbsp;</strong></p>\r\n<p>\r\n	<strong>SEVERABILITY</strong>: If any provision of this User Agreement is determined to be invalid or unenforceable in whole or in part, such invalidity or unenforceability shall attach only to such provision or part of such provision and the remaining part of such provision and all other provisions of this User Agreement shall continue to be in full force and effect.&nbsp;<br />\r\n	<br />\r\n	<strong>AMENDMENT TO THE USER AGREEMENT</strong>: SH reserves the right to change the User Agreement from time to time. The User is responsible for regularly reviewing the User Agreement.&nbsp;<br />\r\n	<br />\r\n	<strong>CONFIDENTIALITY</strong>: Any information which is specifically mentioned by SH as confidential shall be maintained confidentially by the User and shall not be disclosed unless as required by law or to serve the purpose of this User Agreement and the obligations of both the parties herein.&nbsp;<br />\r\n	<br />\r\n	<strong>PRIVACY POLICY</strong>: User shall also refer to SH&#39;s Privacy Policy available on SH&#39;s website which governs use of the Websites. By using the Website, User agrees to the terms of the Privacy Policy and accordingly consents to the use of the User&rsquo;s personal information by SH and its affiliates in accordance with the terms of the Privacy Policy.&nbsp;</p>\r\n<p>\r\n	<strong>ROLE&nbsp; AND LIMITATION OF LIABILITY OF SH</strong></p>\r\n<p>\r\n	SH acts as a facilitator and merely provides an online platform to the User to select and book a particular hotel. Hotels in this context includes all categories of accommodations such as hotels, home-stays, bed and breakfast stays, farm-houses and any other alternate accommodations.</p>\r\n<p>\r\n	All the information pertaining to the hotel including the category of the hotel, images, room type, amenities and facilities available at the hotel are as per the information provided by the hotel to SH. This information is for reference only. Any discrepancy that may exist between the website pictures and actual settings of the hotel shall be raised by the User with the hotel directly, and shall be resolved between the User and hotel. SH will have no responsibility in that process of resolution, and shall not take any liability for such discrepancies.</p>\r\n<p>\r\n	<strong>INFORMATION FROM THE HOTEL AND THE TERMS OF THE HOTEL</strong></p>\r\n<p>\r\n	The hotel booking voucher which SH issues to a User is solely based on the information provided or updated by the hotel regarding the inventory availability. In no circumstances can SH be held liable for failure on part of a hotel to accommodate the User with a confirmed booking, the standard of service or any insufficiency in the services, or any other service related issues at the hotel. The liability of SH in case of denial of check-in by a hotel for any reason what-so-ever including over-booking, system or technical errors, or unavailability of rooms etc., will be limited to either providing a similar alternate accommodation at the discretion of SH (subject to availability at that time), or refunding the booking amount (to the extent paid) to the User. Any other service related issues should be directly resolved by the User with the hotel.</p>\r\n<p>\r\n	Hotels reserves the sole right of admission and SH has no say whatsoever in admission or denial for admission by the hotel. Unmarried or unrelated couples may not be allowed to check-in by some hotels as per their policies. Similarly, accommodation may be denied to guests posing as a couple if suitable proof of identification is not presented at the time check-in. Some hotels may also not allow local residents to check-in as guests. SH will not be responsible for any check-in denied by the hotel due to the aforesaid reasons or any other reason not under the control of SH. No refund would be applicable in case the hotel denies check-in under such circumstances.</p>\r\n<p>\r\n	<strong>RESPONSIBILITIES OF THE USER</strong></p>\r\n<p>\r\n	The User would be liable to make good any damage(s) caused by any act of him/ her/ or their accompanying guests (willful/negligent) to the property of the hotel in any manner whatsoever. The extent and the amount of the damage so caused would be determined by the concerned hotel. SH would not, in any way, intervene in the same.</p>\r\n<p>\r\n	The primary guest must be at least 18 years old to be able to check into the hotel.</p>\r\n<p>\r\n	The User has to be in possession of a valid identity proof and address proof, at the time of check-in. The hotel shall be within its rights to deny check-in to a User if a valid identity proof is not presented at the time of check-in.</p>\r\n<p>\r\n	Check-in time, check-out time, and any changes in those timings, will be as per hotel policy &amp; terms. Early check-in or late check-out request is subject to availability and the hotel may charge an additional fee for providing such services.</p>\r\n<p>\r\n	<strong>ADDITIONAL CHARGES BY THE HOTEL</strong></p>\r\n<p>\r\n	The booking amount paid by the User is only for stay at the hotel. Some bookings may include breakfast and/ or meals as confirmed at the time of booking. Any other services utilized by the User at the hotel, including laundry, room service, internet, telephone, extra food, drinks, beverages etc. shall be paid by the User directly to the hotel.</p>\r\n<p>\r\n	Hotels may charge a mandatory meal surcharge on festive periods like Christmas, New Year&#39;s Eve or other festivals as decided by the hotel. All additional charges (including mandatory meal surcharges) need to be cleared directly at the hotel. SH will have no control over waiving the same.</p>\r\n<p>\r\n	<strong>PAYMENT FOR BOOKINGS AND ANY ADDITIONAL PAYMENTS</strong></p>\r\n<p>\r\n	Booking of a hotel will be Prepaid on the Website of SH.</p>\r\n<p>\r\n	On Prepaid, the total booking amount is paid by the User at the time of booking itself. Such total booking amount includes the hotel reservation rate, taxes, service fees as may be charged on behalf of the actual service provider, and any additional booking fee or convenience fee charged by SH.</p>\r\n<p>\r\n	At the hotel&#39;s or SH&#39;s sole discretion on case to case basis, the User may also be provided with an option to make a part payment to SH at the time of confirmation of a booking. The balance booking amount shall be paid as per the terms of the bookings. For security purposes, the User must provide SH with correct credit or debit card details. SH may cancel the booking at its sole discretion in case such bank or credit card details as provided by the User are found incorrect.</p>\r\n<p>\r\n	Some banks and card issuing companies charge their account holders a transaction fee when the card issuer and the merchant location (as defined by the card brand, e.g. Visa, MasterCard, American Express) are in different countries. If a User has any questions about the fees or any exchange rate applied, they may contact their bank or the card issuing company through which payment was made.</p>\r\n<p>\r\n	Some accommodation suppliers may require User and/or the other persons, on behalf of whom the booking is made, to present a credit card or cash deposit upon check-in to cover additional expenses that may be incurred during their stay. Such deposit is unrelated to any payment received by SH and solely at the behest of the Hotel.</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 0, '', '', 0, '2017-01-11 16:36:18', 3, 0, 0x613a303a7b7d, '', ''),
(4, 'popular-hire-brands', 'Popular Hire Brands', '<h2 class=\"fs-4\">\r\n	<strong>Popular Hire Brands</strong></h2>\r\n<div class=\"hirebrand my-3 d-flex \">\r\n	<div class=\"flex-fill text-center mx-3 my-1\">\r\n		<img alt=\"\" src=\"/ckfinder/userfiles/images/1.jpg\" /></div>\r\n	<div class=\"flex-fill text-center mx-3 my-1\">\r\n		<img alt=\"\" src=\"/ckfinder/userfiles/images/2.jpg\" /></div>\r\n	<div class=\"flex-fill text-center mx-3 my-1\">\r\n		<img alt=\"\" src=\"/ckfinder/userfiles/images/3.jpg\" /></div>\r\n	<div class=\"flex-fill text-center mx-3 my-1\">\r\n		<img alt=\"\" src=\"/ckfinder/userfiles/images/4.jpg\" /></div>\r\n	<div class=\"flex-fill text-center mx-3 my-1\">\r\n		<img alt=\"\" src=\"/ckfinder/userfiles/images/5.jpg\" /></div>\r\n</div>\r\n<!-- content end -->', 1, '', '', 0, '2021-10-03 17:18:43', 4, 0, 0x613a303a7b7d, '', ''),
(5, 'faq-vehicle-with-adv', 'FAQ vehicle with Adv', '<div class=\"col-sm-12\">\r\n	<h2 class=\"fs-4 mb-4 text-start\">\r\n		<strong>Frequently Asked Questions</strong></h2>\r\n</div>\r\n<div class=\"col-sm-8\">\r\n	<div class=\"accordion\" id=\"accordionExample\">\r\n		<div class=\"accordion-item\">\r\n			<h2 class=\"accordion-header\" id=\"headingOne\">\r\n				<button aria-controls=\"collapseOne\" aria-expanded=\"true\" class=\"accordion-button\" data-bs-target=\"#collapseOne\" data-bs-toggle=\"collapse\" type=\"button\"><strong>What do i need to rent a vehicle?</strong></button></h2>\r\n			<div aria-labelledby=\"headingOne\" class=\"accordion-collapse collapse show\" data-bs-parent=\"#accordionExample\" id=\"collapseOne\">\r\n				<div class=\"accordion-body\">\r\n					When you&rsquo;re booking the car, you just need a debit or credit card. At the rental counter, you&rsquo;ll need: Your passport Your voucher Each driver&rsquo;s driving licence The main driver&rsquo;s credit card (some rental companies also accept debit cards, but most don&rsquo;t). Important: Please make sure you check the car&rsquo;s rental terms as well, as each rental company has its own rules. For example? They might need to see some extra ID. They might not accept certain types of credit card. Or they might not rent to any driver who hasn&rsquo;t held their driving licence for 36 months or more.</div>\r\n			</div>\r\n		</div>\r\n		<div class=\"accordion-item\">\r\n			<h2 class=\"accordion-header\" id=\"headingTwo\">\r\n				<button aria-controls=\"collapseTwo\" aria-expanded=\"false\" class=\"accordion-button collapsed\" data-bs-target=\"#collapseTwo\" data-bs-toggle=\"collapse\" type=\"button\"><strong>Is there any age restriction for rent vehicle?</strong></button></h2>\r\n			<div aria-labelledby=\"headingTwo\" class=\"accordion-collapse collapse\" data-bs-parent=\"#accordionExample\" id=\"collapseTwo\">\r\n				<div class=\"accordion-body\">\r\n					Most companies will rent you a car if you&rsquo;re at least 21 (and some will rent to younger drivers). But if you&rsquo;re under 25, you might still have to pay a &lsquo;young driver fee&rsquo;.</div>\r\n			</div>\r\n		</div>\r\n		<div class=\"accordion-item\">\r\n			<h2 class=\"accordion-header\" id=\"headingThree\">\r\n				<button aria-controls=\"collapseThree\" aria-expanded=\"false\" class=\"accordion-button collapsed\" data-bs-target=\"#collapseThree\" data-bs-toggle=\"collapse\" type=\"button\"><strong>Can I book a vehicle for my partner, friend, colleague, etc?</strong></button></h2>\r\n			<div aria-labelledby=\"headingThree\" class=\"accordion-collapse collapse\" data-bs-parent=\"#accordionExample\" id=\"collapseThree\">\r\n				<div class=\"accordion-body\">\r\n					Of course. Just put their details in the &lsquo;Driver Details&rsquo; form when you&rsquo;re booking the car.</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div class=\"col-sm-4\">\r\n	<div class=\"ms-3 rounded-3 overflow-hidden\">\r\n		<img alt=\"\" class=\"img-fluid\" src=\"/ckfinder/userfiles/images/adv.jpg\" /></div>\r\n</div>\r\n<!-- content end -->', 1, '', '', 0, '2021-10-03 17:20:07', 5, 0, 0x613a303a7b7d, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permission`
--

CREATE TABLE `tbl_permission` (
  `id` int(11) NOT NULL,
  `type` varchar(5) CHARACTER SET utf8 NOT NULL,
  `group_id` varchar(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_id` varchar(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_points`
--

CREATE TABLE `tbl_points` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `actual_point` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `usable_point` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `reg_date` date NOT NULL,
  `ip_track` varchar(255) NOT NULL,
  `propertyid` varchar(255) NOT NULL,
  `point` int(11) NOT NULL,
  `options` int(11) NOT NULL,
  `particulars` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_points`
--

INSERT INTO `tbl_points` (`id`, `user_id`, `actual_point`, `trans_id`, `usable_point`, `status`, `reg_date`, `ip_track`, `propertyid`, `point`, `options`, `particulars`) VALUES
(41, '187', 1000, 0, 0, 1, '2023-10-01', '', '157', 500, 0, 'by cash'),
(42, '187', 1500, 0, 500, 1, '2023-10-01', '', '157', 500, 0, 'by cash'),
(43, '187', 2000, 0, 1000, 1, '2023-10-01', '', '157', 500, 0, 'by cash'),
(44, '187', 2500, 0, 1500, 1, '2023-10-01', '', '157', 500, 0, 'by cash'),
(45, '188', 0, 0, 0, 1, '2023-10-01', '', '157', 500, 0, 'by cash'),
(46, '188', 500, 0, 500, 1, '2023-10-01', '', '157', 800, 0, 'by cashasd'),
(47, '188', 1300, 0, 1300, 2, '2023-10-01', '', '157', 500, 0, 'By Points Test'),
(48, '188', 1300, 0, 800, 3, '2023-10-01', '', '157', 600, 0, 'By Points Testasdasd'),
(49, '188', 1300, 0, 200, 2, '2023-10-01', '', '157', 500, 0, 'by cash'),
(50, '188', 800, 0, -800, 2, '2023-10-01', '', '157', 500, 0, 'by cash(EDITED)'),
(51, '188', 800, 0, -800, 1, '2023-10-01', '', '157', 10000, 0, 'asdasd'),
(52, '189', 0, 0, 0, 1, '2023-10-01', '', '', 500, 0, 'asd'),
(53, '191', 0, 0, 0, 1, '2023-10-01', '', '157', 300, 0, 'test'),
(54, '191', 300, 0, 300, 2, '2023-10-01', '', '157', 300, 0, 'test(EDITED)'),
(55, '191', 0, 0, -300, 1, '2023-10-01', '', '157', 10000, 0, 'test'),
(56, '189', 10100, 0, 1010, 1, '2023-10-01', '', '157', 10000, 0, 'asdasd'),
(57, '189', 20100, 0, 11010, 1, '2023-10-01', '', '157', 0, 0, 'asdasd'),
(58, '189', 20100, 0, 11010, 2, '2023-10-01', '', '157', 10000, 0, 'asd'),
(59, '189', 20100, 0, 21010, 2, '2023-10-01', '', '157', 0, 0, 'asd(EDITED)'),
(60, '189', 20100, 0, 31010, 2, '2023-10-01', '', '157', 10000, 0, 'asd'),
(61, '189', 20100, 0, 21010, 2, '2023-10-01', '', '157', 10000, 0, 'test'),
(62, '189', 20100, 0, 11010, 2, '2023-10-01', '', '157', 10000, 0, 'asd'),
(63, '189', 20100, 0, 1010, 1, '2023-10-01', '', '157', 0, 0, 'asd(EDITED)'),
(64, '189', 20100, 0, 11010, 2, '2023-10-01', '', '157', 10000, 0, 'asd(EDITED)'),
(65, '189', 20100, 0, 1010, 2, '2023-10-01', '', '157', 0, 0, 'asd'),
(66, '189', 20100, 0, 1010, 2, '2023-10-01', '', '157', 0, 0, 'asd'),
(67, '189', 20100, 0, 1010, 2, '2023-10-01', '', '157', 100, 0, 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_policies`
--

CREATE TABLE `tbl_policies` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 NOT NULL,
  `status` int(1) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_policies`
--

INSERT INTO `tbl_policies` (`id`, `title`, `status`, `sortorder`, `added_date`) VALUES
(1, 'Policy 1', 1, 1, '2021-10-25 12:28:31'),
(2, 'Policy 2', 1, 2, '2021-10-25 12:28:38'),
(3, 'Policy 3', 1, 3, '2021-10-25 12:28:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_popup`
--

CREATE TABLE `tbl_popup` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `date1` date NOT NULL,
  `date2` date NOT NULL,
  `image` varchar(200) NOT NULL,
  `source` varchar(250) NOT NULL,
  `linktype` varchar(150) NOT NULL,
  `linksrc` varchar(250) NOT NULL,
  `position` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `slug` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pricerange`
--

CREATE TABLE `tbl_pricerange` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `fromrange` varchar(200) NOT NULL,
  `torange` varchar(200) NOT NULL,
  `feature` text NOT NULL,
  `point` varchar(50) NOT NULL,
  `date1` date NOT NULL,
  `date2` date NOT NULL,
  `image` varchar(200) NOT NULL,
  `source` varchar(250) NOT NULL,
  `linktype` varchar(150) NOT NULL,
  `linksrc` varchar(250) NOT NULL,
  `position` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pricerange`
--

INSERT INTO `tbl_pricerange` (`id`, `title`, `fromrange`, `torange`, `feature`, `point`, `date1`, `date2`, `image`, `source`, `linktype`, `linksrc`, `position`, `status`, `sortorder`, `type`, `slug`, `description`) VALUES
(6, '', '1000', '2000', 'YTozOntpOjk7YTozOntzOjI6ImlkIjtzOjE6IjkiO3M6NToidGl0bGUiO3M6NzoiTGV2ZWwgMCI7czoxMjoicmV3YXJkX3BvaW50IjtzOjM6IjMwMCI7fWk6MTA7YTozOntzOjI6ImlkIjtzOjI6IjEwIjtzOjU6InRpdGxlIjtzOjc6IkxldmVsIDIiO3M6MTI6InJld2FyZF9wb2ludCI7czozOiI0MDAiO31pOjExO2E6Mzp7czoyOiJpZCI7czoyOiIxMSI7czo1OiJ0aXRsZSI7czo4OiJMZXZlbCAyMyI7czoxMjoicmV3YXJkX3BvaW50IjtzOjM6IjUwMCI7fX0=', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 1, 1, 0, '', 'adasd'),
(7, '', '2000', '3000', 'YTo0OntpOjk7YTozOntzOjI6ImlkIjtzOjE6IjkiO3M6NToidGl0bGUiO3M6NzoiTGV2ZWwgMCI7czoxMjoicmV3YXJkX3BvaW50IjtzOjM6IjYwMCI7fWk6MTA7YTozOntzOjI6ImlkIjtzOjI6IjEwIjtzOjU6InRpdGxlIjtzOjc6IkxldmVsIDIiO3M6MTI6InJld2FyZF9wb2ludCI7czozOiI3MDAiO31pOjExO2E6Mzp7czoyOiJpZCI7czoyOiIxMSI7czo1OiJ0aXRsZSI7czo4OiJMZXZlbCAyMyI7czoxMjoicmV3YXJkX3BvaW50IjtzOjM6IjgwMCI7fWk6MTI7YTozOntzOjI6ImlkIjtzOjI6IjEyIjtzOjU6InRpdGxlIjtzOjc6IkxFdmVsMjQiO3M6MTI6InJld2FyZF9wb2ludCI7czozOiIxMDAiO319', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 1, 2, 0, '', 'asdasd'),
(8, '', '100000', 'asdasd', 'YTo1OntpOjk7YTozOntzOjI6ImlkIjtzOjE6IjkiO3M6NToidGl0bGUiO3M6NzoiTGV2ZWwgMCI7czoxMjoicmV3YXJkX3BvaW50IjtzOjU6IjEwMDAwIjt9aToxMDthOjM6e3M6MjoiaWQiO3M6MjoiMTAiO3M6NToidGl0bGUiO3M6NzoiTGV2ZWwgMiI7czoxMjoicmV3YXJkX3BvaW50IjtzOjU6IjEwMDAwIjt9aToxMTthOjM6e3M6MjoiaWQiO3M6MjoiMTEiO3M6NToidGl0bGUiO3M6ODoiTGV2ZWwgMjMiO3M6MTI6InJld2FyZF9wb2ludCI7czo1OiIxMDAwMCI7fWk6MTI7YTozOntzOjI6ImlkIjtzOjI6IjEyIjtzOjU6InRpdGxlIjtzOjU6IjEwMDAwIjtzOjEyOiJyZXdhcmRfcG9pbnQiO3M6NToiMTAwMDAiO31pOjEzO2E6Mzp7czoyOiJpZCI7czoyOiIxMyI7czo1OiJ0aXRsZSI7czo5OiJMZXZlbDEyMzEiO3M6MTI6InJld2FyZF9wb2ludCI7czozOiIxMjMiO319', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 1, 3, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `hotel_id` int(11) NOT NULL DEFAULT 0,
  `review` text CHARACTER SET utf8 NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `rating` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`id`, `user_id`, `title`, `hotel_id`, `review`, `status`, `sortorder`, `added_date`, `name`, `email`, `country`, `subject`, `message`, `rating`) VALUES
(3, 0, 'Swarna Man Shakya', 6, 'htftfdthasdasdsaASASDASD', 1, 1, '2021-09-24 17:21:33', '', '', '', '', '', ''),
(5, 0, 'testsetset', 14, '', 1, 2, '2023-09-01 16:29:00', 'tset', 'sharan@longtail.info', 'nepol', 'sad', 'asdasd', '3'),
(6, 0, 'tesdf', 1, 'asd', 1, 3, '2023-09-01 17:09:15', 'sdfsdf', 'aa@sdf.fgh', 'asdasd', 'asdas', 'asdasd', '4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reward`
--

CREATE TABLE `tbl_reward` (
  `id` int(11) NOT NULL,
  `level` varchar(200) NOT NULL,
  `title` varchar(250) NOT NULL,
  `point` varchar(50) NOT NULL,
  `date1` date NOT NULL,
  `date2` date NOT NULL,
  `image` varchar(200) NOT NULL,
  `source` varchar(250) NOT NULL,
  `linktype` varchar(150) NOT NULL,
  `linksrc` varchar(250) NOT NULL,
  `position` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reward`
--

INSERT INTO `tbl_reward` (`id`, `level`, `title`, `point`, `date1`, `date2`, `image`, `source`, `linktype`, `linksrc`, `position`, `status`, `sortorder`, `type`, `slug`, `description`) VALUES
(27, 'level-0', 'prize1', '100', '0000-00-00', '0000-00-00', '', '', '', '', 0, 1, 1, 0, 'prize1', '123\r\n'),
(28, 'level-2', 'Prize 2', '400', '0000-00-00', '0000-00-00', '', '', '', '', 0, 1, 2, 0, 'prize-2', 'asdasd'),
(29, 'level-23', 'PRize 3', '600', '0000-00-00', '0000-00-00', '', '', '', '', 0, 1, 3, 0, 'prize-3', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roomapi`
--

CREATE TABLE `tbl_roomapi` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `room_type` int(11) NOT NULL,
  `max_people` int(11) NOT NULL,
  `max_child` int(11) NOT NULL,
  `no_rooms` int(11) NOT NULL,
  `room_size` varchar(50) NOT NULL,
  `room_size_label` enum('meters','feet') NOT NULL,
  `smoking` enum('yes','no','both') NOT NULL,
  `single_bed` tinyint(4) NOT NULL,
  `double_bed` tinyint(4) NOT NULL,
  `large_double` tinyint(4) NOT NULL,
  `extra_large_double` tinyint(4) NOT NULL,
  `bunk_bed` tinyint(4) NOT NULL,
  `sofa_bed` tinyint(4) NOT NULL,
  `futon_mat` tinyint(4) NOT NULL,
  `extra_bed` int(11) NOT NULL,
  `image` text NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `feature` text NOT NULL,
  `detail` text NOT NULL,
  `content` text NOT NULL,
  `sortorder` tinyint(4) NOT NULL,
  `added_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `bed_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roomapi`
--

INSERT INTO `tbl_roomapi` (`id`, `hotel_id`, `title`, `slug`, `room_type`, `max_people`, `max_child`, `no_rooms`, `room_size`, `room_size_label`, `smoking`, `single_bed`, `double_bed`, `large_double`, `extra_large_double`, `bunk_bed`, `sofa_bed`, `futon_mat`, `extra_bed`, `image`, `banner_image`, `currency`, `feature`, `detail`, `content`, `sortorder`, `added_date`, `modified_date`, `status`, `bed_type`) VALUES
(1, 1, 'Deluxe Room', 'deluxe-room', 2, 2, 0, 10, '200', 'feet', 'both', 2, 0, 0, 0, 0, 0, 0, 0, 'YToxOntpOjA7czoxOToiVU85WXMtc2FyYXRoaV85LmpwZyI7fQ==', '', 'USD', 'YToyOntpOjU7YTozOntzOjI6ImlkIjtpOjU7czo0OiJuYW1lIjtzOjE3OiJQcm9wZXJ0eSBTZXJ2aWNlcyI7czo4OiJmZWF0dXJlcyI7YTo4OntpOjY7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjExOiJmYWwgZmEtd2lmaSI7czo1OiJ0aXRsZSI7czo5OiJGcmVlIFdpZmkiO31pOjc7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEzOiJmYWwgZmEtcm9ja2V0IjtzOjU6InRpdGxlIjtzOjIwOiJFbGV2YXRvciBpbiBidWlsZGluZyI7fWk6ODthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTQ6ImZhbCBmYS1wYXJraW5nIjtzOjU6InRpdGxlIjtzOjEyOiJGcmVlIFBhcmtpbmciO31pOjk7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE2OiJmYWwgZmEtc25vd2ZsYWtlIjtzOjU6InRpdGxlIjtzOjE1OiJBaXIgQ29uZGl0aW9uZWQiO31pOjEwO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMjoiZmFsIGZhLXBsYW5lIjtzOjU6InRpdGxlIjtzOjE1OiJBaXJwb3J0IFNodXR0bGUiO31pOjExO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMDoiZmFsIGZhLXBhdyI7czo1OiJ0aXRsZSI7czoxMjoiUGV0IEZyaWVuZGx5Ijt9aToxMjthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTU6ImZhbCBmYS11dGVuc2lscyI7czo1OiJ0aXRsZSI7czoxNzoiUmVzdGF1cmFudCBJbnNpZGUiO31pOjEzO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNzoiZmFsIGZhLXdoZWVsY2hhaXIiO3M6NToidGl0bGUiO3M6MTk6IldoZWVsY2hhaXIgRnJpZW5kbHkiO319fWk6MTQ7YTozOntzOjI6ImlkIjtpOjE0O3M6NDoibmFtZSI7czoxNDoiT3RoZXIgU2VydmljZXMiO3M6ODoiZmVhdHVyZXMiO2E6ODp7aToxNTthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTE6ImZhbCBmYS13aWZpIjtzOjU6InRpdGxlIjtzOjk6IkZyZWUgV2lmaSI7fWk6MTY7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEzOiJmYWwgZmEtcm9ja2V0IjtzOjU6InRpdGxlIjtzOjIwOiJFbGV2YXRvciBpbiBidWlsZGluZyI7fWk6MTc7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE0OiJmYWwgZmEtcGFya2luZyI7czo1OiJ0aXRsZSI7czoxMjoiRnJlZSBQYXJraW5nIjt9aToxODthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTY6ImZhbCBmYS1zbm93Zmxha2UiO3M6NToidGl0bGUiO3M6MTU6IkFpciBDb25kaXRpb25lZCI7fWk6MTk7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEyOiJmYWwgZmEtcGxhbmUiO3M6NToidGl0bGUiO3M6MTU6IkFpcnBvcnQgU2h1dHRsZSI7fWk6MjA7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEwOiJmYWwgZmEtcGF3IjtzOjU6InRpdGxlIjtzOjEyOiJQZXQgRnJpZW5kbHkiO31pOjIxO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNToiZmFsIGZhLXV0ZW5zaWxzIjtzOjU6InRpdGxlIjtzOjE3OiJSZXN0YXVyYW50IEluc2lkZSI7fWk6MjI7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE3OiJmYWwgZmEtd2hlZWxjaGFpciI7czo1OiJ0aXRsZSI7czoxOToiV2hlZWxjaGFpciBGcmllbmRseSI7fX19fQ==', 'Mountain view rooms short details', '<p>\r\n	Room Contents</p>\r\n', 12, '2023-09-03 11:27:32', '0000-00-00 00:00:00', 1, 'bed ko type ni'),
(2, 2, 'Superior Room', 'superior-room', 3, 2, 0, 10, '200', 'feet', 'no', 2, 0, 0, 0, 0, 0, 0, 0, 'YToxOntpOjA7czoxOToiMm04aHotZmxhbWluZ28yLmpwZyI7fQ==', '', 'USD', 'YTowOnt9', 'Meticulously designed Superior Rooms in Hotel Da Flamingo are comfortable, elegant and offers high standard amenities.\r\n\r\nSize: 32 sqm (approximate size) King or Twin', '<p style=\"box-sizing: border-box; margin: 0px; font-family: Poppins, sans-serif; color: rgb(119, 119, 119); line-height: 28px; font-size: 14px;\">\r\n	Meticulously designed Superior Rooms in Hotel Da Flamingo are comfortable, elegant and offers high standard amenities.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; font-family: Poppins, sans-serif; color: rgb(119, 119, 119); line-height: 28px; font-size: 14px;\">\r\n	Size: 32 sqm (approximate size) King or Twin</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; font-family: Poppins, sans-serif; color: rgb(119, 119, 119); line-height: 28px; font-size: 14px;\">\r\n	&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; font-family: Poppins, sans-serif; color: rgb(119, 119, 119); line-height: 28px; font-size: 14px;\">\r\n	WITH OUR COMPLIMENTS<br style=\"box-sizing: border-box;\" />\r\n	&bull; Complimentary unlimited WiFi access<br style=\"box-sizing: border-box;\" />\r\n	&bull; Tea/Coffee maker<br style=\"box-sizing: border-box;\" />\r\n	&bull; 2 bottles mineral water<br style=\"box-sizing: border-box;\" />\r\n	&bull; Toiletries</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; font-family: Poppins, sans-serif; color: rgb(119, 119, 119); line-height: 28px; font-size: 14px;\">\r\n	&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; font-family: Poppins, sans-serif; color: rgb(119, 119, 119); line-height: 28px; font-size: 14px;\">\r\n	IN-ROOM DINING</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; font-family: Poppins, sans-serif; color: rgb(119, 119, 119); line-height: 28px; font-size: 14px;\">\r\n	Hotel Da Flamingo offers the comfort and convenience of private dining in your own room or suite. Room service is available daily from 7.30am to 10pm, for breakfast, all-day dining, and late-night noshing.</p>\r\n', 1, '2021-07-16 17:58:06', '0000-00-00 00:00:00', 1, ''),
(3, 3, 'Deluxe Room with Lake View', 'deluxe-room-with-lake-view', 4, 2, 0, 6, '210', 'feet', 'no', 0, 0, 1, 0, 0, 0, 0, 0, 'YToyOntpOjA7czoxODoiSDhlTEYtY3VsdHVyZTUuanBnIjtpOjE7czoxODoiWTUyYUYtY3VsdHVyZTQuanBnIjt9', '', 'USD', 'YTowOnt9', 'Our spacious Deluxe Rooms offer refined contemporary accommodation where every detail is carefully and tastefully taken care. ', '<p>\r\n	<span style=\"color: rgb(21, 21, 21); font-family: Poppins, sans-serif; font-size: 14px;\">Our spacious Deluxe Rooms offer refined contemporary accommodation where every detail is carefully and tastefully taken care. With a relaxing blend of natural tones and rich comfortable furnishings, these rooms are perfect for business or leisure. Equipped with a desk and complimentary internet connectivity.</span></p>\r\n', 2, '2021-07-16 18:50:10', '0000-00-00 00:00:00', 1, ''),
(4, 4, 'Suite Room', 'suite-room', 5, 2, 0, 2, '310', 'feet', 'no', 0, 0, 0, 1, 0, 0, 0, 0, 'YTozOntpOjA7czoxNToiTTNoWXYtbWF4eDcuanBnIjtpOjE7czoxNToiamNQMWotbWF4eDYuanBnIjtpOjI7czoxNToiY2VIbTktbWF4eDguanBnIjt9', '', 'USD', 'YTowOnt9', 'With the bed featuring a pillow-top mattress, luxurious fine linens and duvets with..', '<p>\r\n	<span style=\"color: rgb(122, 126, 154); font-family: Muli, sans-serif; font-size: 16px;\">With the bed featuring a pillow-top mattress, luxurious fine linens and duvets with..</span></p>\r\n', 3, '2021-07-16 19:05:16', '0000-00-00 00:00:00', 1, ''),
(5, 6, 'Junior Suits', 'junior-suits', 6, 2, 1, 3, '30', 'meters', 'no', 0, 0, 0, 0, 0, 0, 0, 1, 'YToxOntpOjA7czozMjoiZGRURkIteXc3NGdfbzZtNGpfdW50aXRsZWRfMS5qcGciO30=', '', 'USD', 'YToyOntpOjU7YTozOntzOjI6ImlkIjtpOjU7czo0OiJuYW1lIjtzOjE3OiJQcm9wZXJ0eSBTZXJ2aWNlcyI7czo4OiJmZWF0dXJlcyI7YTo4OntpOjY7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjExOiJmYWwgZmEtd2lmaSI7czo1OiJ0aXRsZSI7czo5OiJGcmVlIFdpZmkiO31pOjc7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEzOiJmYWwgZmEtcm9ja2V0IjtzOjU6InRpdGxlIjtzOjIwOiJFbGV2YXRvciBpbiBidWlsZGluZyI7fWk6ODthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTQ6ImZhbCBmYS1wYXJraW5nIjtzOjU6InRpdGxlIjtzOjEyOiJGcmVlIFBhcmtpbmciO31pOjk7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE2OiJmYWwgZmEtc25vd2ZsYWtlIjtzOjU6InRpdGxlIjtzOjE1OiJBaXIgQ29uZGl0aW9uZWQiO31pOjEwO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMjoiZmFsIGZhLXBsYW5lIjtzOjU6InRpdGxlIjtzOjE1OiJBaXJwb3J0IFNodXR0bGUiO31pOjExO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMDoiZmFsIGZhLXBhdyI7czo1OiJ0aXRsZSI7czoxMjoiUGV0IEZyaWVuZGx5Ijt9aToxMjthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTU6ImZhbCBmYS11dGVuc2lscyI7czo1OiJ0aXRsZSI7czoxNzoiUmVzdGF1cmFudCBJbnNpZGUiO31pOjEzO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNzoiZmFsIGZhLXdoZWVsY2hhaXIiO3M6NToidGl0bGUiO3M6MTk6IldoZWVsY2hhaXIgRnJpZW5kbHkiO319fWk6MTQ7YTozOntzOjI6ImlkIjtpOjE0O3M6NDoibmFtZSI7czoxNDoiT3RoZXIgU2VydmljZXMiO3M6ODoiZmVhdHVyZXMiO2E6ODp7aToxNTthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTE6ImZhbCBmYS13aWZpIjtzOjU6InRpdGxlIjtzOjk6IkZyZWUgV2lmaSI7fWk6MTY7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEzOiJmYWwgZmEtcm9ja2V0IjtzOjU6InRpdGxlIjtzOjIwOiJFbGV2YXRvciBpbiBidWlsZGluZyI7fWk6MTc7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE0OiJmYWwgZmEtcGFya2luZyI7czo1OiJ0aXRsZSI7czoxMjoiRnJlZSBQYXJraW5nIjt9aToxODthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTY6ImZhbCBmYS1zbm93Zmxha2UiO3M6NToidGl0bGUiO3M6MTU6IkFpciBDb25kaXRpb25lZCI7fWk6MTk7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEyOiJmYWwgZmEtcGxhbmUiO3M6NToidGl0bGUiO3M6MTU6IkFpcnBvcnQgU2h1dHRsZSI7fWk6MjA7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEwOiJmYWwgZmEtcGF3IjtzOjU6InRpdGxlIjtzOjEyOiJQZXQgRnJpZW5kbHkiO31pOjIxO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNToiZmFsIGZhLXV0ZW5zaWxzIjtzOjU6InRpdGxlIjtzOjE3OiJSZXN0YXVyYW50IEluc2lkZSI7fWk6MjI7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE3OiJmYWwgZmEtd2hlZWxjaGFpciI7czo1OiJ0aXRsZSI7czoxOToiV2hlZWxjaGFpciBGcmllbmRseSI7fX19fQ==', '', '<p>\r\n	<span font-size:=\"\" muli=\"\" style=\"color: rgb(81, 82, 99); font-family: \">Our most spacious room category, the Junior Suites boast of plush beds with finest linen, sufficient working space, comfortable lounge area and en-suite bathrooms featuring bathtub. All these &lsquo;suites&rsquo; are situated in the extreme corners of the floors for its quietness, offering windows on two sides with the views of lush green landscaped gardens on one side and city as well as Himalayas on the other. The most opulent rooms that we offer, you won&rsquo;t wish to leave once you&rsquo;ve stepped inside.</span></p>\r\n', 13, '2023-09-03 11:30:09', '0000-00-00 00:00:00', 1, ''),
(6, 6, 'Deluxe Room', 'deluxe-room', 7, 2, 1, 10, '32', 'meters', 'no', 0, 0, 0, 0, 0, 0, 0, 1, 'YToxOntpOjA7czoyODoiQ1lvaTYtd2tncHhfZmJxeXBfZGVsdXhlLmpwZyI7fQ==', 'XQvXc-wkgpx_fbqyp_deluxe.jpg', 'USD', 'YTowOnt9', '', '<p>\r\n	We offer deluxe room with a king-size and Twin bed well equipped with all the facilities and equipments you need for a comfortable stay. Spend quality time in our room fulfilled with a luxurious bathroom along with view of mountains and city. Spend your leisure time and make your stay a memorable stay. Feel like home and away in a silent environment.</p>\r\n', 5, '2021-08-25 16:55:08', '0000-00-00 00:00:00', 1, ''),
(7, 7, 'Premier Room\'s', 'premier-rooms', 10, 2, 1, 3, '32', 'feet', 'no', 100, 127, 127, 127, 0, 0, 0, 1, 'YToxOntpOjA7czoyMToiNFo3SkQtYmVhY2hfdmlsbGEuanBnIjt9', 'FEHEi-beach_villa.jpg', 'USD', 'YToyOntpOjU7YTozOntzOjI6ImlkIjtpOjU7czo0OiJuYW1lIjtzOjE3OiJQcm9wZXJ0eSBTZXJ2aWNlcyI7czo4OiJmZWF0dXJlcyI7YTo4OntpOjY7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjExOiJmYWwgZmEtd2lmaSI7czo1OiJ0aXRsZSI7czo5OiJGcmVlIFdpZmkiO31pOjc7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEzOiJmYWwgZmEtcm9ja2V0IjtzOjU6InRpdGxlIjtzOjIwOiJFbGV2YXRvciBpbiBidWlsZGluZyI7fWk6ODthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTQ6ImZhbCBmYS1wYXJraW5nIjtzOjU6InRpdGxlIjtzOjEyOiJGcmVlIFBhcmtpbmciO31pOjk7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE2OiJmYWwgZmEtc25vd2ZsYWtlIjtzOjU6InRpdGxlIjtzOjE1OiJBaXIgQ29uZGl0aW9uZWQiO31pOjEwO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMjoiZmFsIGZhLXBsYW5lIjtzOjU6InRpdGxlIjtzOjE1OiJBaXJwb3J0IFNodXR0bGUiO31pOjExO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxMDoiZmFsIGZhLXBhdyI7czo1OiJ0aXRsZSI7czoxMjoiUGV0IEZyaWVuZGx5Ijt9aToxMjthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTU6ImZhbCBmYS11dGVuc2lscyI7czo1OiJ0aXRsZSI7czoxNzoiUmVzdGF1cmFudCBJbnNpZGUiO31pOjEzO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNzoiZmFsIGZhLXdoZWVsY2hhaXIiO3M6NToidGl0bGUiO3M6MTk6IldoZWVsY2hhaXIgRnJpZW5kbHkiO319fWk6MTQ7YTozOntzOjI6ImlkIjtpOjE0O3M6NDoibmFtZSI7czoxNDoiT3RoZXIgU2VydmljZXMiO3M6ODoiZmVhdHVyZXMiO2E6ODp7aToxNTthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTE6ImZhbCBmYS13aWZpIjtzOjU6InRpdGxlIjtzOjk6IkZyZWUgV2lmaSI7fWk6MTY7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEzOiJmYWwgZmEtcm9ja2V0IjtzOjU6InRpdGxlIjtzOjIwOiJFbGV2YXRvciBpbiBidWlsZGluZyI7fWk6MTc7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE0OiJmYWwgZmEtcGFya2luZyI7czo1OiJ0aXRsZSI7czoxMjoiRnJlZSBQYXJraW5nIjt9aToxODthOjI6e3M6MTA6Imljb25fY2xhc3MiO3M6MTY6ImZhbCBmYS1zbm93Zmxha2UiO3M6NToidGl0bGUiO3M6MTU6IkFpciBDb25kaXRpb25lZCI7fWk6MTk7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEyOiJmYWwgZmEtcGxhbmUiO3M6NToidGl0bGUiO3M6MTU6IkFpcnBvcnQgU2h1dHRsZSI7fWk6MjA7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjEwOiJmYWwgZmEtcGF3IjtzOjU6InRpdGxlIjtzOjEyOiJQZXQgRnJpZW5kbHkiO31pOjIxO2E6Mjp7czoxMDoiaWNvbl9jbGFzcyI7czoxNToiZmFsIGZhLXV0ZW5zaWxzIjtzOjU6InRpdGxlIjtzOjE3OiJSZXN0YXVyYW50IEluc2lkZSI7fWk6MjI7YToyOntzOjEwOiJpY29uX2NsYXNzIjtzOjE3OiJmYWwgZmEtd2hlZWxjaGFpciI7czo1OiJ0aXRsZSI7czoxOToiV2hlZWxjaGFpciBGcmllbmRseSI7fX19fQ==', 'Our premier rooms come equipped with all the amenities to make your stay as relaxing and productive.', '<h5 -webkit-font-smoothing:=\"\" color:=\"\" muli=\"\" style=\"box-sizing: border-box; margin: 0px; font-weight: normal; line-height: 1.4; font-size: 19px; padding: 0px; border: 0px; font-family: \" vertical-align:=\"\" zoom:=\"\">\r\n	Our premier rooms come equipped with all the amenities to make your stay as relaxing and productive as possible including a mini bar, tea/coffee making facility, an LCD cable Television, a bathtub, an electronic safe box, wireless internet connection, a ceiling fan, organic soap, herbal shampoo and an air conditioner. - Content</h5>\r\n', 14, '2023-09-03 11:31:02', '0000-00-00 00:00:00', 1, ''),
(8, 8, 'Deluxe Room', 'deluxe-room', 11, 1, 0, 10, '100', 'meters', 'yes', 0, 0, 0, 0, 0, 0, 0, 0, 'YTowOnt9', '', '', 'YTowOnt9', '', '', 6, '2021-09-03 17:10:39', '0000-00-00 00:00:00', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roomapi_offers`
--

CREATE TABLE `tbl_roomapi_offers` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `discount` tinyint(4) NOT NULL,
  `apply_for` enum('all','room_type','room') NOT NULL,
  `apply_id` tinyint(4) NOT NULL COMMENT '0=>all,integer for room id',
  `image` varchar(255) NOT NULL,
  `linksrc` varchar(255) NOT NULL,
  `linktype` tinyint(1) NOT NULL DEFAULT 0,
  `content` longtext NOT NULL,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `homepage` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roomapi_offers`
--

INSERT INTO `tbl_roomapi_offers` (`id`, `hotel_id`, `title`, `date_from`, `date_to`, `discount`, `apply_for`, `apply_id`, `image`, `linksrc`, `linktype`, `content`, `sortorder`, `added_date`, `status`, `homepage`) VALUES
(1, 37, 'Dashain', '2019-09-27', '2019-09-30', 10, 'all', 0, 'XjpqD-everestimage.jpg', '', 0, '', 1, '2019-09-27 15:23:19', 0, 0),
(2, 37, 'Tihar', '2019-09-27', '2019-09-30', 14, 'all', 0, 'J25pL-image.jpg', '', 0, '', 2, '2019-09-27 15:23:59', 0, 1),
(3, 1, 'test', '2021-11-01', '2021-11-05', 5, 'all', 0, 'HFwfM-image.png', '', 0, '', 3, '2021-11-01 14:08:18', 1, 1),
(4, 7, 'Gokarna Offer', '2023-08-28', '2023-08-29', 10, 'all', 0, '8ogJE-beach_villa.jpg', '', 0, '<p>\r\n	asd</p>\r\n', 4, '2023-08-28 12:12:32', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roomapi_price`
--

CREATE TABLE `tbl_roomapi_price` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `season_id` int(11) NOT NULL,
  `one_person` int(11) NOT NULL,
  `two_person` int(11) NOT NULL,
  `three_person` int(11) NOT NULL,
  `extra_bed` int(11) NOT NULL,
  `registered` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roomapi_price`
--

INSERT INTO `tbl_roomapi_price` (`id`, `room_id`, `season_id`, `one_person`, `two_person`, `three_person`, `extra_bed`, `registered`) VALUES
(1, 1, 0, 55, 60, 0, 0, '2021-07-16 15:46:37'),
(2, 2, 0, 45, 50, 0, 0, '2021-07-16 17:56:28'),
(3, 2, 2, 0, 0, 0, 0, '2021-07-16 17:56:28'),
(4, 3, 0, 40, 45, 0, 0, '2021-07-16 18:50:10'),
(5, 4, 0, 150, 150, 0, 0, '2021-07-16 19:05:16'),
(6, 5, 0, 200, 10, 0, 50, '2021-08-25 16:49:09'),
(7, 6, 0, 100, 0, 0, 50, '2021-08-25 16:55:08'),
(8, 7, 0, 135, 150, 0, 50, '2021-08-26 16:36:18'),
(9, 8, 0, 10, 0, 0, 10, '2021-09-03 17:10:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roomfeatures`
--

CREATE TABLE `tbl_roomfeatures` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL,
  `icon_class` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roomfeatures`
--

INSERT INTO `tbl_roomfeatures` (`id`, `parent_id`, `title`, `icon_class`, `image`, `status`, `sortorder`, `added_date`) VALUES
(1, 4, 'Private Bathroom', 'f2cd', '', 1, 1, '2021-08-26 13:02:39'),
(2, 4, 'Flat Screen TV', 'f26c', '', 1, 2, '2021-08-26 13:03:57'),
(3, 4, 'WiFi', 'f1eb', '', 1, 3, '2021-08-26 13:04:36'),
(4, 0, 'Room Features', '', '', 1, 4, '2021-09-23 11:17:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roomtype`
--

CREATE TABLE `tbl_roomtype` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sortorder` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roomtype`
--

INSERT INTO `tbl_roomtype` (`id`, `hotel_id`, `title`, `slug`, `description`, `sortorder`, `added_date`, `status`) VALUES
(1, 0, 'Deluxe Tree', 'deluxe-tree', 'thi is siao ka laknslk aso oasmokcasmo kas', 1, '2021-07-16 13:52:18', 1),
(2, 1, 'Deluxe Room', 'deluxe-room', 'Deluxe', 2, '2021-07-16 15:42:21', 1),
(3, 2, 'Superior Room', 'superior-room', 'Superior Room', 3, '2021-07-16 17:54:38', 1),
(4, 3, 'Deluxe Room', 'deluxe-room', 'Deluxe Room', 4, '2021-07-16 18:48:55', 1),
(5, 4, 'Suite', 'suite', 'Suite', 5, '2021-07-16 19:03:49', 1),
(6, 6, 'Junior Suits', 'junior-suits', 'Junior Suits', 6, '2021-08-25 16:39:25', 1),
(7, 6, 'Deluxe Room', 'deluxe-room', 'Deluxe Room', 7, '2021-08-25 16:52:18', 1),
(8, 7, 'Premier Suite', 'premier-suite', 'Includes an exclusive balcony that gives breathtaking views of the Golf Course, the Gokarna Forest, and our resort courtyard. Our spacious bathrooms filled with the aroma of the finest organic soaps and herbal shampoos and 24 hours hot water shower with a traditional square bathtub give you full relaxation and comfort. Comfortable beds with soft mattresses invite you to tuck in for a good sleep. A large wardrobe and electronic safe box enable you to enjoy your time with us to the fullest without having to worry about your belongings.', 8, '2021-08-26 16:26:31', 1),
(9, 7, 'Club Room', 'club-room', 'With the option of having either a view of the splendid courtyard or the lush vibrant forest, the Club Rooms are designed to give you a jungle experience with a level of comfort unmatched by any resort in Nepal. Each room comes fully equipped with an air conditioner, ceiling fan, LCD television, finest organic soap, and herbal shampoo. The rooms have 24 hours hot water, a bathtub, electronic safe box, mini bar, and a facility for making coffee and tea.', 9, '2021-08-26 16:27:48', 1),
(10, 7, ' Premier Room', 'premier-room', 'Our premier rooms come equipped with all the amenities to make your stay as relaxing and productive as possible including a mini bar, tea/coffee making facility, an LCD cable Television, a bathtub, an electronic safe box, wireless internet connection, a ceiling fan, organic soap, herbal shampoo and an air conditioner.', 10, '2021-08-26 16:28:36', 1),
(11, 8, 'Deluxe Room', 'deluxe-room', 'Deluxe Room', 11, '2021-09-03 17:10:07', 1),
(14, 0, 'asd', 'asd', '', 12, '2023-09-01 17:05:18', 1),
(15, 0, 'asdasd', 'asdasd', '', 13, '2023-09-01 17:05:49', 1),
(16, 0, 'testsetset', 'testsetset', '', 14, '2023-09-01 17:06:49', 1),
(17, 0, 'testsdtsdf', 'testsdtsdf', '', 15, '2023-09-01 17:07:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_calender`
--

CREATE TABLE `tbl_room_calender` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `reserve_date` date NOT NULL,
  `room_id` tinyint(4) NOT NULL,
  `no_rooms` tinyint(4) NOT NULL,
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_route`
--

CREATE TABLE `tbl_route` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL,
  `icon_class` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_route`
--

INSERT INTO `tbl_route` (`id`, `parent_id`, `title`, `icon_class`, `image`, `status`, `added_by`, `sortorder`, `added_date`) VALUES
(1, 0, 'Kathmandu', '', 'Rnx55-kathmandu.jpg', 1, 0, 1, '2021-09-28 22:25:54'),
(2, 1, 'Satdobato', '', '', 1, 0, 1, '2021-09-28 22:26:49'),
(3, 1, 'B&B', '', '', 1, 0, 2, '2021-09-28 22:27:31'),
(4, 1, 'Gwarko', '', '', 1, 0, 3, '2021-09-28 22:27:44'),
(5, 1, 'Khariboat', '', '', 1, 0, 4, '2021-09-28 22:28:03'),
(6, 1, 'Balkumari', '', '', 1, 0, 5, '2021-09-28 22:28:17'),
(7, 1, 'Koteshwor', '', '', 1, 0, 6, '2021-09-28 22:28:46'),
(8, 1, 'Tinkunae', '', '', 1, 0, 7, '2021-09-28 22:29:03'),
(9, 1, 'Minbhawan', '', '', 1, 0, 8, '2021-09-28 22:29:33'),
(10, 1, 'Baneshwor', '', '', 1, 0, 9, '2021-09-28 22:30:10'),
(11, 1, 'Babar Mahal', '', '', 1, 0, 10, '2021-09-28 22:30:25'),
(12, 1, 'Matighar', '', '', 1, 0, 11, '2021-09-28 22:30:43'),
(13, 1, 'Thapathali', '', '', 1, 0, 12, '2021-09-28 22:31:04'),
(14, 1, 'Tripureshwor', '', '', 1, 0, 13, '2021-09-28 22:31:30'),
(15, 1, 'Takue', '', '', 1, 0, 14, '2021-09-28 22:31:48'),
(16, 1, 'Kalimati', '', '', 1, 0, 15, '2021-09-28 22:32:04'),
(17, 1, 'Soltimod', '', '', 1, 0, 16, '2021-09-28 22:32:19'),
(18, 1, 'Nakap', '', '', 1, 0, 17, '2021-09-28 22:32:50'),
(19, 1, 'Gurju Dhara', '', '', 1, 0, 18, '2021-09-28 22:33:15'),
(20, 0, 'Pokhara', '', '2XylQ-pokhara.jpg', 1, 0, 2, '2021-10-04 14:45:55'),
(21, 0, 'Chitwan', '', 's1bx6-chitwan.jpg', 1, 0, 3, '2021-10-04 14:46:28'),
(22, 0, 'Lumbini', '', 'wPwyO-lumbini.jpg', 1, 0, 4, '2021-10-04 14:46:49'),
(23, 20, 'Lakeside', '', '', 1, 0, 1, '2021-10-04 14:47:28'),
(24, 20, 'Sarangkot', '', '', 1, 0, 2, '2021-10-04 14:47:42'),
(25, 21, 'Tourist Bus Park', '', '', 1, 0, 1, '2021-10-04 14:48:08'),
(26, 22, 'Lumbini gate', '', '', 1, 0, 1, '2021-10-04 14:48:27'),
(27, 22, 'Parsa Chowk', '', '', 1, 0, 2, '2021-10-04 14:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_season`
--

CREATE TABLE `tbl_season` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `season` varchar(255) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `sortorder` int(11) NOT NULL,
  `added_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_season`
--

INSERT INTO `tbl_season` (`id`, `hotel_id`, `season`, `date_from`, `date_to`, `status`, `sortorder`, `added_date`) VALUES
(1, 17, 'Summer Special', '2017-08-10', '2017-08-31', 1, 1, '2017-08-24'),
(2, 2, 'Summer', '2021-04-01', '2021-07-31', 1, 2, '2021-05-23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `id` int(11) NOT NULL,
  `hotelid` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL,
  `icon_class` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`id`, `hotelid`, `parent_id`, `title`, `icon_class`, `image`, `status`, `sortorder`, `added_date`) VALUES
(7, 0, 5, 'Elevator in building', 'fal fa-rocket', '', 1, 2, '2021-02-16 17:14:57'),
(6, 0, 5, 'Free Wifi', 'fal fa-wifi', '', 1, 1, '2021-02-16 17:14:39'),
(5, 0, 0, 'Property Services', '', 're4ca-beach_villa.jpg', 1, 1, '2021-02-16 17:13:26'),
(8, 0, 5, 'Free Parking', 'fal fa-parking', '', 1, 3, '2021-02-16 17:15:09'),
(9, 0, 5, 'Air Conditioned', 'fal fa-snowflake', '', 1, 4, '2021-02-16 17:15:26'),
(10, 0, 5, 'Airport Shuttle', 'fal fa-plane', '', 1, 5, '2021-02-16 17:15:41'),
(11, 0, 5, 'Pet Friendly', 'fal fa-paw', '', 1, 6, '2021-02-16 17:15:59'),
(12, 0, 5, 'Restaurant Inside', 'fal fa-utensils', '', 1, 7, '2021-02-16 17:16:26'),
(13, 0, 5, 'Wheelchair Friendly', 'fal fa-wheelchair', '', 1, 8, '2021-02-16 17:16:48'),
(14, 0, 0, 'Other Services', '', '', 1, 2, '2021-07-07 12:58:05'),
(15, 0, 14, 'Free Wifi', 'fal fa-wifi', '', 1, 1, '2021-10-08 16:47:07'),
(16, 0, 14, 'Elevator in building', 'fal fa-rocket', '', 1, 2, '2021-10-08 16:50:52'),
(17, 0, 14, 'Free Parking', 'fal fa-parking', '', 1, 3, '2021-10-08 16:51:03'),
(18, 0, 14, 'Air Conditioned', 'fal fa-snowflake', '', 1, 4, '2021-10-08 16:51:12'),
(19, 0, 14, 'Airport Shuttle', 'fal fa-plane', '', 1, 5, '2021-10-08 16:51:22'),
(20, 0, 14, 'Pet Friendly', 'fal fa-paw', '', 1, 6, '2021-10-08 16:51:31'),
(21, 0, 14, 'Restaurant Inside', 'fal fa-utensils', '', 1, 7, '2021-10-08 16:51:40'),
(22, 0, 14, 'Wheelchair Friendly', 'fal fa-wheelchair', '', 1, 8, '2021-10-08 16:51:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slideshow`
--

CREATE TABLE `tbl_slideshow` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `linksrc` varchar(255) NOT NULL,
  `linktype` tinyint(1) NOT NULL DEFAULT 0,
  `content` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `added_date` varchar(50) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_slideshow`
--

INSERT INTO `tbl_slideshow` (`id`, `title`, `image`, `linksrc`, `linktype`, `content`, `status`, `added_date`, `sortorder`, `type`) VALUES
(1, 'Landmark Chitwan', 'cbbA9-landmark_chitwan.jpg', '', 0, '', 0, '2016-07-17 14:32:58', 2, 1),
(2, 'Landmark Pokhara', '2BByu-landmark_pokhara.jpg', '', 0, '', 0, '2019-02-07 10:46:10', 1, 1),
(3, 'Landmark Kathmandu', 'lh7PR-landmark_kathmandu.jpg', '', 0, '', 0, '2020-03-30 06:54:39', 3, 1),
(4, 'Rupakot Resort', 'XBv7U-rupakot_resort.jpg', '', 0, '', 0, '2020-03-30 06:56:57', 6, 1),
(5, 'Bouddha Boutique Hotel', 'G46UA-bouddha_boutique_hotel.jpg', '', 0, '', 0, '2020-03-30 07:21:07', 7, 1),
(6, 'Ichchha Hotel', 'VrwSe-ichchha.jpg', '', 0, '', 0, '2020-03-30 07:33:51', 5, 1),
(7, 'Vivanta', 'W3U2k-vivanta.jpg', '', 0, '', 0, '2020-03-30 07:36:30', 4, 1),
(8, 'Siddhartha Nepalgunj', 'O7DH2-siddhartha_nepalgunj.jpg', '', 0, '', 0, '2020-03-30 07:42:57', 8, 1),
(9, 'Slides 1', 'NOhUn-z5qff_2.jpg', '', 0, '', 0, '2021-02-11 09:44:54', 9, 1),
(11, 'Look Ahead Book Ahead.', 'GAljN-slider1.jpg', 'page/about-us', 0, '<p>\r\n	Look Ahead.<br />\r\n	Book Ahead.</p>\r\n', 1, '2023-09-22 15:21:00', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_social_networking`
--

CREATE TABLE `tbl_social_networking` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `linksrc` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `sortorder` int(11) NOT NULL,
  `registered` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_social_networking`
--

INSERT INTO `tbl_social_networking` (`id`, `title`, `image`, `linksrc`, `status`, `sortorder`, `registered`) VALUES
(1, 'Facebook', 'fab fa-facebook', 'https://www.facebook.com/', 1, 1, ''),
(2, 'Linkedin', 'fab fa-linkedin', 'https://www.linkedin.com', 1, 2, ''),
(3, 'instagram', 'fab fa-instagram', 'https://www.instagram.com/', 1, 3, ''),
(4, 'Youtube', 'fab fa-youtube', 'https://www.youtube.com', 1, 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_starrating`
--

CREATE TABLE `tbl_starrating` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_starrating`
--

INSERT INTO `tbl_starrating` (`id`, `title`, `status`, `sortorder`, `added_date`) VALUES
(1, '1', 1, 1, '2021-10-08 18:02:48'),
(2, '2', 1, 2, '2021-10-08 18:02:53'),
(3, '3', 1, 3, '2021-10-08 18:02:59'),
(4, '4', 1, 4, '2021-10-08 18:03:02'),
(5, '5', 1, 5, '2021-10-08 18:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscribers`
--

CREATE TABLE `tbl_subscribers` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `mailaddress` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_subscribers`
--

INSERT INTO `tbl_subscribers` (`id`, `title`, `mailaddress`, `status`, `sortorder`, `added_date`) VALUES
(2, '', 'amit@longtail.info', 1, 0, '2016-06-10 16:11:46'),
(3, '', 'tst@test.com', 1, 0, '2016-07-17 18:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_testimonial`
--

CREATE TABLE `tbl_testimonial` (
  `id` int(11) NOT NULL,
  `parentOf` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(225) NOT NULL,
  `linksrc` tinytext NOT NULL,
  `content` text NOT NULL,
  `sortorder` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `via_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_testimonial`
--

INSERT INTO `tbl_testimonial` (`id`, `parentOf`, `name`, `image`, `linksrc`, `content`, `sortorder`, `status`, `country`, `via_type`) VALUES
(1, 0, 'a', '2pCXZ-flruj_3.jpg', '', '\"I booked through them for my daughter last bday a 4day trip. We were able to experience our life time memory with gundri.com. Hotel welcomed us like king when we arrived and the stay was awesome experience. The call from gundri.com representative made us feel special during our stay.\"', 1, 1, 'Unitied State', ''),
(2, 0, 'Emma Graham ', 'pnj5X-uub0k_1.jpg', '', '<p>\r\n	I booked through them for my daughter last bday a 4day trip. We were able to experience our life time memory with gundri.com. Hotel welcomed us like king when we arrived and the stay was awesome experience. The call from gundri.com representative made us feel special during our stay.</p>\r\n', 2, 1, 'Unitied State', ''),
(3, 0, 'Emma Grahamsss', 'leFcb-gk93z_2.jpg', '', '\"I booked through them for my daughter last bday a 4day trip. We were able to experience our life time memory with gundri.com. Hotel welcomed us like king when we arrived and the stay was awesome experience. The call from gundri.com representative made us feel special during our stay.\"', 3, 1, 'Nepal', ''),
(4, 0, 'Gallery', 'AjIlP-gk93z_2.jpg', '', '\"I booked through them for my daughter last bday a 4day trip. We were able to experience our life time memory with gundri.com. Hotel welcomed us like king when we arrived and the stay was awesome experience. The call from gundri.com representative made us feel special during our stay.\"', 4, 1, 'Nepal', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `prop_id` varchar(200) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `optional_email` mediumtext NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(65) NOT NULL,
  `accesskey` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `hotels_no` int(11) NOT NULL DEFAULT 1,
  `group_id` int(11) NOT NULL,
  `type` enum('admin','hotel','general') NOT NULL,
  `access_code` varchar(255) NOT NULL,
  `facebook_uid` varchar(255) NOT NULL,
  `facebook_accesstoken` varchar(255) NOT NULL,
  `facebook_tokenexpire` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email_verified` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `package_status` tinyint(1) NOT NULL DEFAULT 0,
  `vehicle_status` tinyint(1) NOT NULL DEFAULT 0,
  `sortorder` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `for_hotel` int(1) NOT NULL DEFAULT 0,
  `for_package` int(1) NOT NULL DEFAULT 0,
  `for_vehicle` int(1) NOT NULL DEFAULT 0,
  `trip_company_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `trip_contact_no` varchar(50) CHARACTER SET utf8 NOT NULL,
  `trip_company_address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vehicle_vendor_type` varchar(50) CHARACTER SET utf8 NOT NULL,
  `vehicle_company_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vehicle_no` int(11) NOT NULL DEFAULT 1,
  `vehicle_company_contact_no` varchar(50) CHARACTER SET utf8 NOT NULL,
  `vehicle_vendor_address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `permission` text NOT NULL,
  `actual_point` int(11) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `usable_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `prop_id`, `first_name`, `middle_name`, `last_name`, `contact`, `email`, `address`, `optional_email`, `username`, `password`, `accesskey`, `image`, `hotels_no`, `group_id`, `type`, `access_code`, `facebook_uid`, `facebook_accesstoken`, `facebook_tokenexpire`, `email_verified`, `status`, `package_status`, `vehicle_status`, `sortorder`, `added_date`, `for_hotel`, `for_package`, `for_vehicle`, `trip_company_name`, `trip_contact_no`, `trip_company_address`, `vehicle_vendor_type`, `vehicle_company_name`, `vehicle_no`, `vehicle_company_contact_no`, `vehicle_vendor_address`, `permission`, `actual_point`, `dob`, `gender`, `user_id`, `usable_point`) VALUES
(1, '', 'admin', '', '', '', 'info@gundri.com', '', 'info@longtail.info;support@longtail.info', 'admin', '32b9da145699ea9058dd7d6669e6bcc5', 'PbuSDZGPGMElBVe4JuO3dqcIY', '', 1, 1, 'admin', 'jx3PtXqKso', '', '', '2021-09-03 00:31:43', 0, 1, 0, 0, 1, '2014-03-26', 0, 0, 0, '', '', '', '', '', 1, '', '', 'a:27:{i:0;s:2:\"74\";i:1;s:1:\"1\";i:2;s:2:\"45\";i:3;s:2:\"73\";i:4;s:3:\"109\";i:5;s:2:\"44\";i:6;s:2:\"59\";i:7;s:2:\"46\";i:8;s:2:\"60\";i:9;s:2:\"33\";i:10;s:2:\"62\";i:11;s:2:\"96\";i:12;s:2:\"61\";i:13;s:2:\"48\";i:14;s:2:\"49\";i:15;s:2:\"50\";i:16;s:2:\"87\";i:17;s:2:\"90\";i:18;s:2:\"95\";i:19;s:2:\"51\";i:20;s:3:\"100\";i:21;s:3:\"101\";i:22;s:3:\"102\";i:23;s:3:\"103\";i:24;s:2:\"12\";i:25;s:2:\"54\";i:26;s:2:\"55\";}', 0, '', 0, '', 0),
(157, '', 'Siddhartha Resort, Chandrauta', '', '', '076-540698,9857055128', 'sales.chandrauta@siddharthahospitality.com', '', 'online@sarathihotel.com', 'Chandrauta', '83f711a01b17dc449388b211fc9e5515', 'KZklDt', '', 1, 2, 'hotel', '', '', '', '2023-08-30 10:59:11', 0, 1, 0, 0, 2, '2021-07-16', 0, 0, 0, '', '', '', '', '', 1, '', '', 'a:11:{i:0;s:2:\"30\";i:1;s:2:\"31\";i:2;s:2:\"91\";i:3;s:2:\"92\";i:4;s:2:\"97\";i:5;s:2:\"94\";i:6;s:2:\"35\";i:7;s:2:\"36\";i:8;s:2:\"37\";i:9;s:2:\"40\";i:10;s:2:\"43\";}', 0, '', 0, '', 0),
(158, '', 'Siddhartha Hotel Water Tower, Nuwakot', '', '', '+9779851334130', 'watertower@siddharthahospitality.com', '', 'info@hoteldaflamingo.com', 'SidWater', '83f711a01b17dc449388b211fc9e5515', 'vL6vGN', '', 1, 2, 'hotel', '', '', '', '2023-08-30 10:59:11', 0, 1, 0, 0, 3, '2021-07-16', 0, 0, 0, '', '', '', '', '', 1, '', '', 'a:11:{i:0;s:2:\"30\";i:1;s:2:\"31\";i:2;s:2:\"91\";i:3;s:2:\"92\";i:4;s:2:\"97\";i:5;s:2:\"94\";i:6;s:2:\"35\";i:7;s:2:\"36\";i:8;s:2:\"37\";i:9;s:2:\"40\";i:10;s:2:\"43\";}', 0, '', 0, '', 0),
(159, '', 'Siddhartha Resort, Chisapani', '', '', '+977 091-414000', 'chisapani@siddharthahospitality.com', '', 'info@cultureresortpokhara.com', 'Chisapani', '83f711a01b17dc449388b211fc9e5515', 'a1TMq5', '', 1, 2, 'hotel', '', '', '', '2023-08-30 10:59:11', 0, 1, 0, 0, 4, '2021-07-16', 0, 0, 0, '', '', '', '', '', 1, '', '', 'a:11:{i:0;s:2:\"30\";i:1;s:2:\"31\";i:2;s:2:\"91\";i:3;s:2:\"92\";i:4;s:2:\"97\";i:5;s:2:\"94\";i:6;s:2:\"35\";i:7;s:2:\"36\";i:8;s:2:\"37\";i:9;s:2:\"40\";i:10;s:2:\"43\";}', 0, '', 0, '', 0),
(161, '', 'Siddhartha Sunny Resort, Surkhet', '', '', '083-520922/520168', 'srsurkhet@siddharthahospitality.com', '', '', 'SidSunny', '83f711a01b17dc449388b211fc9e5515', 'oWF1M9', '', 1, 2, 'hotel', '', '', '', '2023-09-03 07:54:19', 0, 1, 0, 0, 5, '2021-07-18', 0, 0, 0, '', '', '', '', '', 1, '', '', 'a:11:{i:0;s:2:\"30\";i:1;s:2:\"31\";i:2;s:2:\"91\";i:3;s:2:\"92\";i:4;s:2:\"97\";i:5;s:2:\"94\";i:6;s:2:\"35\";i:7;s:2:\"36\";i:8;s:2:\"37\";i:9;s:2:\"40\";i:10;s:2:\"43\";}', 0, '', 0, '', 0),
(162, '', 'Siddhartha Hotel New Anand, Mahendranagar', '', '', '+977 099-521693, 9858750693', 'anand@siddharthahospitality.com', '', '', 'SidAnand', '25f9e794323b453885f5181f1b624d0b', 'nqE4Im', '', 1, 2, 'hotel', '', '', '', '2023-09-03 07:54:19', 0, 1, 0, 0, 6, '2021-08-25', 0, 0, 0, '', '', '', '', '', 1, '', '', 'a:11:{i:0;s:2:\"30\";i:1;s:2:\"31\";i:2;s:2:\"91\";i:3;s:2:\"92\";i:4;s:2:\"97\";i:5;s:2:\"94\";i:6;s:2:\"35\";i:7;s:2:\"36\";i:8;s:2:\"37\";i:9;s:2:\"40\";i:10;s:2:\"43\";}', 0, '', 0, '', 0),
(163, '', 'Siddhartha Hotel Grand City, Birtamode', '', '', '+977-23-590517', 'grandcity@siddharthahospitality.com', '', '', 'SidGrand', '25f9e794323b453885f5181f1b624d0b', 'NDe6b8', '', 1, 2, 'hotel', '', '', '', '2023-09-03 07:54:19', 0, 1, 0, 0, 7, '2021-08-26', 0, 0, 0, '', '', '', '', '', 1, '', '', 'a:11:{i:0;s:2:\"30\";i:1;s:2:\"31\";i:2;s:2:\"91\";i:3;s:2:\"92\";i:4;s:2:\"97\";i:5;s:2:\"94\";i:6;s:2:\"35\";i:7;s:2:\"36\";i:8;s:2:\"37\";i:9;s:2:\"40\";i:10;s:2:\"43\";}', 0, '', 0, '', 0),
(168, '', 'Siddhartha Boutique Hotel, Boudha', '', '', '01-4820071, +9779851326963', 'sales.boudha@siddharthahospitality.com', '', '', 'Boutique', '32b9da145699ea9058dd7d6669e6bcc5', '234rPr', '', 1, 2, 'hotel', 'ex38okFD5z', '', '', '2023-09-03 07:54:19', 0, 1, 0, 0, 8, '2021-09-03', 0, 0, 0, '', '', '', '', '', 1, '', '', 'a:11:{i:0;s:2:\"30\";i:1;s:2:\"31\";i:2;s:2:\"91\";i:3;s:2:\"92\";i:4;s:2:\"97\";i:5;s:2:\"94\";i:6;s:2:\"35\";i:7;s:2:\"36\";i:8;s:2:\"37\";i:9;s:2:\"40\";i:10;s:2:\"43\";}', 0, '', 0, '', 0),
(171, '', 'Siddhartha River Side Resort, Chumlingtar', '', '', '+9779851176325', 'chumlingtar@siddharthahospitality.com', '', '', 'RiverSide', '32b9da145699ea9058dd7d6669e6bcc5', 'fsU6TY', '', 2, 2, 'hotel', '', '', '', '2023-10-01 13:12:14', 0, 1, 0, 0, 9, '2021-09-29', 0, 0, 0, '', '', '', '', '', 1, '', '', 'a:11:{i:0;s:2:\"30\";i:1;s:2:\"31\";i:2;s:2:\"91\";i:3;s:2:\"92\";i:4;s:2:\"97\";i:5;s:2:\"94\";i:6;s:2:\"35\";i:7;s:2:\"36\";i:8;s:2:\"37\";i:9;s:2:\"40\";i:10;s:2:\"43\";}', 0, '', 0, '', 0),
(172, '', 'Hotel Siddhartha, Tikapur', '', '', '091-560777', 'tika@siddharthahsopitality.com', '', '', 'TikapurSid', '25d55ad283aa400af464c76d713c07ad', 'qxuOrc', '', 1, 2, 'hotel', '', '', '', '2023-10-01 13:12:14', 0, 1, 1, 1, 10, '2021-10-10', 0, 0, 0, '', '', '', '', '', 1, '', '', 'a:11:{i:0;s:2:\"30\";i:1;s:2:\"31\";i:2;s:2:\"91\";i:3;s:2:\"92\";i:4;s:2:\"97\";i:5;s:2:\"94\";i:6;s:2:\"35\";i:7;s:2:\"36\";i:8;s:2:\"37\";i:9;s:2:\"40\";i:10;s:2:\"43\";}', 0, '', 0, '', 0),
(174, '', 'Hotel Siddhartha, Nepalgunj', '', '', '+977-81-551200', 'hotelnpj@siddharthahospitality.com', '', '', 'HotelSid', '32b9da145699ea9058dd7d6669e6bcc5', 'tVxTYn', '', 1, 2, 'hotel', '', '', '', '2023-10-01 13:12:14', 0, 1, 1, 1, 11, '2021-10-11', 1, 1, 1, 'Longtail', '989898', 'Lagan', 'company', 'Longtail', 1, '9849482842', 'Lagan', 'a:11:{i:0;s:2:\"30\";i:1;s:2:\"31\";i:2;s:2:\"91\";i:3;s:2:\"92\";i:4;s:2:\"97\";i:5;s:2:\"94\";i:6;s:2:\"35\";i:7;s:2:\"36\";i:8;s:2:\"37\";i:9;s:2:\"40\";i:10;s:2:\"43\";}', 0, '', 0, '', 0),
(175, '', 'Siddhartha', '', 'Cottage', '071-533140', 'butwal@siddharthahospitality.com', '', '', 'SidCottage', '912ec803b2ce49e4a541068d495ab570', 'glFq1I', '', 0, 2, 'hotel', '', '', '', '2023-10-01 13:12:14', 0, 1, 0, 0, 12, '2023-08-30', 0, 0, 0, '', '', '', '', '', 0, '', '', 'a:11:{i:0;s:2:\"30\";i:1;s:2:\"31\";i:2;s:2:\"91\";i:3;s:2:\"92\";i:4;s:2:\"97\";i:5;s:2:\"94\";i:6;s:2:\"35\";i:7;s:2:\"36\";i:8;s:2:\"37\";i:9;s:2:\"40\";i:10;s:2:\"43\";}', 0, '', 0, '', 0),
(186, '157', 'Test1', '', '', '9860307452', 'shak@test.oj', 'Lazimpat, Kathmandu, Nepal', '', 'test1232', '81dc9bdb52d04dc20036dbd8313ed055', 's3uSTw', '', 0, 3, 'general', '', '', '', '2023-10-01 13:12:18', 0, 1, 0, 0, 13, '2023-10-01', 0, 0, 0, '', '', '', '', '', 0, '', '', '', 3200, '2021/12/12', 0, 'SID_123-186', 400),
(187, '157', 'Test 8', '', '', '98172318273', 'test@test.com', 'asdasd', '', 'qwe', '76d80224611fc919a5d54f0ff9fba446', 'LXbfVq', '', 0, 3, 'general', '', '', '', '2023-10-01 13:12:18', 0, 1, 0, 0, 14, '2023-10-01', 0, 0, 0, '', '', '', '', '', 0, '', '', '', 3000, '2021/12/12', 0, 'SID_123-187', 2000),
(188, '157', 'Test 45', '', '', '9860307452', 'shakyasaran100@gmail.com', 'asd', '', 'admin5', '32b9da145699ea9058dd7d6669e6bcc5', 'PFZVZn', '', 0, 3, 'general', '', '', '', '2023-10-01 13:12:18', 0, 1, 0, 0, 15, '2023-10-01', 0, 0, 0, '', '', '', '', '', 0, '', '', '', 10800, '2021/12/12', 0, 'SID_123-188', 9200),
(189, '157', 'sadasd', '', '', '+977-81-551200', 'tika@siddharthahsopitality.com', 'Patan', '', 'aasdasda', '81dc9bdb52d04dc20036dbd8313ed055', 'bHViTc', '', 0, 3, 'general', '', '', '', '2023-10-01 14:09:30', 0, 1, 0, 0, 16, '2023-10-01', 0, 0, 0, '', '', '', '', '', 0, '', '', '', 20100, '2021/12/12', 0, 'SID_123-189', 910),
(191, '157', 'Test 4 ', '', '', '+977-23-590517', 'test@test.com', 'asdasd', '', 'sms', '32b9da145699ea9058dd7d6669e6bcc5', '55f9hq', '', 0, 3, 'general', '', '', '', '2023-10-01 13:28:18', 0, 0, 0, 0, 17, '2023-10-01', 0, 0, 0, '', '', '', '', '', 0, '', '', '', 10000, '2021/12/12', 0, 'SID_123-191', 9700);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_info`
--

CREATE TABLE `tbl_user_info` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `email2` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `zodic_sign` varchar(100) NOT NULL,
  `current_city` tinytext NOT NULL,
  `education` tinytext NOT NULL,
  `home_town` tinytext NOT NULL,
  `phone_res` varchar(30) NOT NULL,
  `phone_office` varchar(30) NOT NULL,
  `mobile_no` varchar(30) NOT NULL,
  `mobile_no2` varchar(30) NOT NULL,
  `children_name` tinytext NOT NULL,
  `pet_name` tinytext NOT NULL,
  `nick_name` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `birth_place` varchar(100) NOT NULL,
  `maritial_status` enum('married','single','divorced') NOT NULL,
  `spouse_name` varchar(100) NOT NULL,
  `publish_spoush_name` tinyint(1) NOT NULL,
  `publish_children_name` varchar(255) NOT NULL,
  `career_start_date` date NOT NULL,
  `facebook_link` varchar(255) NOT NULL,
  `facebook_page` tinytext NOT NULL,
  `twitter_link` tinytext NOT NULL,
  `google_plus` tinytext NOT NULL,
  `linkedin` tinytext NOT NULL,
  `skpye_address` varchar(255) NOT NULL,
  `short_desc` text NOT NULL,
  `website` varchar(255) NOT NULL,
  `other_profession` tinytext NOT NULL,
  `question_set` int(11) NOT NULL,
  `answer_status` tinyint(1) NOT NULL COMMENT '0=>Not finished,1=>finised,2=>ongoing review,3=>complete review,',
  `notification` varchar(50) NOT NULL COMMENT 'notification for answer status complete.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_info`
--

INSERT INTO `tbl_user_info` (`id`, `person_id`, `email2`, `dob`, `zodic_sign`, `current_city`, `education`, `home_town`, `phone_res`, `phone_office`, `mobile_no`, `mobile_no2`, `children_name`, `pet_name`, `nick_name`, `gender`, `birth_place`, `maritial_status`, `spouse_name`, `publish_spoush_name`, `publish_children_name`, `career_start_date`, `facebook_link`, `facebook_page`, `twitter_link`, `google_plus`, `linkedin`, `skpye_address`, `short_desc`, `website`, `other_profession`, `question_set`, `answer_status`, `notification`) VALUES
(6, 169, '', '0000-00-00', '', '', '', 'address', '', '', '', '', '', '', '', '', '', '', '', 0, '', '0000-00-00', 'facevook', '', 'twitter', 'VK', '', '', 'my bio', 'website', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vcombine`
--

CREATE TABLE `tbl_vcombine` (
  `id` int(11) NOT NULL,
  `vp_id` int(11) NOT NULL DEFAULT 0,
  `vehicle_id` int(11) NOT NULL DEFAULT 0,
  `vehicle_price` double NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_vcombine`
--

INSERT INTO `tbl_vcombine` (`id`, `vp_id`, `vehicle_id`, `vehicle_price`) VALUES
(1, 1, 1, 10),
(2, 1, 2, 20),
(3, 2, 1, 20),
(4, 2, 2, 30),
(5, 2, 3, 50),
(6, 3, 1, 50),
(7, 3, 2, 70),
(8, 3, 3, 100),
(31, 7, 14, 50),
(30, 6, 6, 10),
(29, 5, 10, 35),
(28, 5, 8, 20),
(27, 5, 7, 15),
(26, 5, 6, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle`
--

CREATE TABLE `tbl_vehicle` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `slug` tinytext NOT NULL,
  `title` tinytext NOT NULL,
  `max_pax` int(11) NOT NULL DEFAULT 0,
  `content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `added_by` int(11) DEFAULT 0,
  `added_date` varchar(50) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `image` blob NOT NULL,
  `date` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `reg_no` varchar(255) NOT NULL,
  `make_year` int(11) NOT NULL,
  `bill_book_image` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_vehicle`
--

INSERT INTO `tbl_vehicle` (`id`, `parent_id`, `slug`, `title`, `max_pax`, `content`, `status`, `added_by`, `added_date`, `sortorder`, `image`, `date`, `category`, `reg_no`, `make_year`, `bill_book_image`) VALUES
(1, 0, 'car', 'CAR', 3, '<p>\r\n	Car faciltiy list</p>\r\n', 1, 0, '2021-09-28 22:37:04', 1, 0x613a303a7b7d, '', '', '', 0, ''),
(2, 0, 'jeep', 'JEEP', 4, '<p>\r\n	Jeep facility</p>\r\n', 1, 0, '2021-09-28 22:38:35', 2, 0x613a303a7b7d, '', '', '', 0, ''),
(3, 0, 'hiace-van', 'HIACE VAN', 10, '<p>\r\n	Hiace van facility</p>\r\n', 1, 0, '2021-09-28 22:39:11', 3, 0x613a303a7b7d, '', '', '', 0, ''),
(4, 0, 'bus-mini', 'BUS (MINI)', 30, '<p>\r\n	Mini Bus facility</p>\r\n', 1, 0, '2021-09-28 22:39:48', 4, 0x613a303a7b7d, '', '', '', 0, ''),
(5, 0, 'big-bus', 'BIG BUS', 40, '<p>\r\n	Bus facility</p>\r\n', 1, 0, '2021-09-28 22:40:28', 5, 0x613a303a7b7d, '', '', '', 0, ''),
(6, 1, 'i-10', 'I-10', 3, '<p>\r\n	brief</p>\r\n', 1, 0, '2021-10-01 13:28:44', 6, 0x613a313a7b693a303b733a31333a22677931506f2d6361722e6a7067223b7d, '', '', '', 0, ''),
(7, 1, 'maruti', 'Maruti', 3, '', 1, 0, '2021-10-01 13:29:40', 7, 0x613a313a7b693a303b733a31343a225a5a5165772d6a6565702e6a7067223b7d, '', '', '', 0, ''),
(8, 2, 'jeep-1', 'Jeep 1', 4, '', 1, 0, '2021-10-01 13:32:42', 8, 0x613a313a7b693a303b733a31343a2278625479302d6a6565702e6a7067223b7d, '', '', '', 0, ''),
(9, 3, 'hiace-1', 'hiace 1', 10, '<p>\r\n	facility</p>\r\n', 1, 0, '2021-10-01 13:33:39', 9, 0x613a313a7b693a303b733a31343a2263574647792d6a6565702e6a7067223b7d, '', '', '', 0, ''),
(10, 4, 'mini-bus-1', 'Mini bus 1', 30, '<p>\r\n	facility</p>\r\n', 1, 0, '2021-10-01 13:34:19', 10, 0x613a313a7b693a303b733a31333a2261344337312d6361722e6a7067223b7d, '', '', '', 0, ''),
(11, 5, 'big-bus-1', 'Big Bus 1', 40, '<p>\r\n	facility</p>\r\n', 1, 0, '2021-10-01 13:34:51', 11, 0x613a303a7b7d, '', '', '', 0, ''),
(12, 1, '123', '123', 2, '', 1, 172, '2021-10-11 00:06:27', 12, 0x613a303a7b7d, '', '', '', 0, ''),
(13, 1, 'i20', 'i20', 4, '', 1, 172, '2021-10-11 00:14:39', 13, 0x613a303a7b7d, '', '', '', 0, ''),
(14, 1, 'my-car', 'my car', 4, '<p>\r\n	brief</p>\r\n', 1, 174, '2021-10-11 14:46:14', 14, 0x613a313a7b693a303b733a31393a2274614d52712d61346337315f6361722e6a7067223b7d, '', '', 'asdasd 708', 1995, 0x613a313a7b693a303b733a31393a22486b3945662d61346337315f6361722e6a7067223b7d);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

CREATE TABLE `tbl_video` (
  `id` int(11) NOT NULL,
  `source` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `url_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `thumb_image` longtext COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `host` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vprice`
--

CREATE TABLE `tbl_vprice` (
  `id` int(11) NOT NULL,
  `route_from` int(11) NOT NULL DEFAULT 0,
  `route_to` int(11) NOT NULL DEFAULT 0,
  `route_combine` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `sortorder` int(11) NOT NULL,
  `added_date` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_vprice`
--

INSERT INTO `tbl_vprice` (`id`, `route_from`, `route_to`, `route_combine`, `status`, `added_by`, `sortorder`, `added_date`) VALUES
(1, 2, 3, '2,3', 1, 0, 1, '2021-09-29 11:45:10'),
(2, 2, 4, '2,4', 1, 0, 2, '2021-09-29 11:45:29'),
(3, 2, 5, '2,5', 1, 0, 3, '2021-09-29 11:45:51'),
(4, 2, 2, '2,2', 1, 0, 4, '2021-10-01 14:20:57'),
(5, 3, 4, '3,4', 1, 0, 5, '2021-10-01 14:24:16'),
(6, 23, 25, '23,25', 1, 0, 6, '2021-10-07 13:28:38'),
(7, 3, 4, '3,4', 1, 174, 7, '2021-10-12 11:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_zone_district`
--

CREATE TABLE `tbl_zone_district` (
  `id` int(11) NOT NULL,
  `parent_id` smallint(6) NOT NULL,
  `zone_district` varchar(255) NOT NULL,
  `code` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_zone_district`
--

INSERT INTO `tbl_zone_district` (`id`, `parent_id`, `zone_district`, `code`, `status`) VALUES
(1, 0, 'Mechi', '101', 1),
(2, 1, 'Ilam', '102', 1),
(3, 1, 'Jhapa/Chandragadhi', '103', 1),
(4, 1, 'Panchthar/Phidim', '104', 1),
(5, 1, 'Taplejung', '105', 1),
(6, 0, 'Rapti', '106', 1),
(7, 6, 'Dang Deukhuri/Ghorahi', '107', 1),
(8, 6, 'Pyuthan/Pyuthan Khalanga', '108', 1),
(9, 6, 'Rolpa/Liwang', '109', 1),
(10, 6, 'Rukum/Musikot', '110', 1),
(11, 6, 'Salyan/Salyan Khalanga', '111', 1),
(12, 0, 'Bagmati', '112', 1),
(13, 12, 'Bhaktapur', '113', 1),
(14, 12, 'Dhading/Dhading Besi', '114', 1),
(15, 12, 'Kathmandu', '115', 1),
(16, 12, 'Kavrepalanchok/Dhulikhel', '116', 1),
(17, 12, 'Lalitpur/Patan', '117', 1),
(18, 12, 'Nuwakot/Bidur', '118', 1),
(19, 12, 'Rasuwa/Dhunche', '119', 1),
(20, 12, 'Sindhupalchok/Chautara', '120', 1),
(21, 0, 'Karnali', '121', 1),
(22, 21, 'Dolpa', '122', 1),
(23, 21, 'Humla/Simikot', '123', 1),
(24, 21, 'Jumla/Jumla Khalanga', '124', 1),
(25, 21, 'Kalikot', '125', 1),
(26, 21, 'Mugu/Gamgadhi', '126', 1),
(27, 0, 'Sagarmatha', '127', 1),
(28, 27, 'Khotang/Diktel', '128', 1),
(29, 27, 'Okhaldhunga', '129', 1),
(30, 27, 'Saptari/Rajbiraj', '130', 1),
(31, 27, 'Siraha', '131', 1),
(32, 27, 'Solukhumbu/Salleri', '132', 1),
(33, 27, 'Udayapur/Gaighat', '133', 1),
(34, 0, 'Koshi', '134', 1),
(35, 34, 'Bhojpur', '135', 1),
(36, 34, 'Dhankuta', '136', 1),
(37, 34, 'Morang/Biratnagar', '137', 1),
(38, 34, 'Sankhuwasabha/Khandbari', '138', 1),
(39, 34, 'Sunsari/Inaruwa', '139', 1),
(40, 34, 'Terhathum/Manglung', '140', 1),
(41, 0, 'Narayani', '141', 1),
(42, 41, 'Bara/Kalaiya', '142', 1),
(43, 41, 'Chitwan/Bharatpur', '143', 1),
(44, 41, 'Makwanpur/Hetauda', '144', 1),
(45, 41, 'Parsa/Birgunj', '145', 1),
(46, 41, 'Rautahat/Gaur', '146', 1),
(47, 0, 'Mahakali', '147', 1),
(48, 47, 'Baitadi', '148', 1),
(49, 47, 'Dadeldhura', '149', 1),
(50, 47, 'Darchula', '150', 1),
(51, 47, 'Kanchanpur/Mahendara Nagar', '151', 1),
(52, 0, 'Gandaki', '152', 1),
(53, 52, 'Gorkha/Gorkha', '153', 1),
(54, 52, 'Kaski/Pokhara', '154', 1),
(55, 52, 'Lamjung/Bensi Sahar', '155', 1),
(56, 52, 'Manang/Chame', '156', 1),
(57, 52, 'Syangja', '157', 1),
(58, 52, 'Tanahu/Damauli', '158', 1),
(59, 0, 'Janakpur', '159', 1),
(60, 59, 'Dhanusa/Janakpur', '160', 1),
(61, 59, 'Dholkha/Charikot', '161', 1),
(62, 59, 'Mahottari/Jaleswor', '162', 1),
(63, 59, 'Ramechhap/Manthali', '163', 1),
(64, 59, 'Sarlahi/Malangwa', '164', 1),
(65, 59, 'Sindhuli/Sindhuli Madhi', '165', 1),
(66, 0, 'Lumbini', '166', 1),
(67, 66, 'Arghakhanchi/Sandhikharka', '167', 1),
(68, 66, 'Gulmi/Tamghas', '168', 1),
(69, 66, 'Kapilvastu/Taulihawa', '169', 1),
(70, 66, 'Nawalparasi/Parasi', '170', 1),
(71, 66, 'Palpa/Tansen', '171', 1),
(72, 66, 'Rupandehi/Bhairahawa', '172', 1),
(73, 0, 'Seti', '173', 1),
(74, 73, 'Achham/Mangalsen', '174', 1),
(75, 73, 'Bajhang/Chainpur', '175', 1),
(76, 73, 'Bajura/Martadi', '176', 1),
(77, 73, 'Doti/Dipayal', '177', 1),
(78, 73, 'Kailali/Dhangadhi', '178', 1),
(79, 0, 'Bheri', '179', 1),
(80, 79, 'Banke/Nepalgunj', '180', 1),
(81, 79, 'Bardiya/Gulariya', '181', 1),
(82, 79, 'Dailekh/Dullu', '182', 1),
(83, 79, 'Jajarkot/Khalanga', '183', 1),
(84, 79, 'Surkhet', '184', 1),
(85, 0, 'Dhawalagiri', '185', 1),
(86, 85, 'Baglung', '186', 1),
(87, 85, 'Mustang/Jomsom', '187', 1),
(88, 85, 'Myagdi/Beni', '188', 1),
(89, 85, 'Parbat/Kusma', '189', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_activities`
--
ALTER TABLE `tbl_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_advertisement`
--
ALTER TABLE `tbl_advertisement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_apibooking`
--
ALTER TABLE `tbl_apibooking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_apibooking_child`
--
ALTER TABLE `tbl_apibooking_child`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_apihotel`
--
ALTER TABLE `tbl_apihotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_attractions`
--
ALTER TABLE `tbl_attractions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bookinginfo`
--
ALTER TABLE `tbl_bookinginfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bookinginfo_additional`
--
ALTER TABLE `tbl_bookinginfo_additional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bookinginfo_vehicle`
--
ALTER TABLE `tbl_bookinginfo_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bookinginfo_vehicle_extra`
--
ALTER TABLE `tbl_bookinginfo_vehicle_extra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_calendar_price`
--
ALTER TABLE `tbl_calendar_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cleaning_safety`
--
ALTER TABLE `tbl_cleaning_safety`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_configs`
--
ALTER TABLE `tbl_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_destination`
--
ALTER TABLE `tbl_destination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_dining_hall`
--
ALTER TABLE `tbl_dining_hall`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_event`
--
ALTER TABLE `tbl_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_event_category`
--
ALTER TABLE `tbl_event_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_event_hall`
--
ALTER TABLE `tbl_event_hall`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_galleries`
--
ALTER TABLE `tbl_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_gallery_images`
--
ALTER TABLE `tbl_gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_group_type`
--
ALTER TABLE `tbl_group_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_hotel_faqs`
--
ALTER TABLE `tbl_hotel_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_itinerary`
--
ALTER TABLE `tbl_itinerary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_level`
--
ALTER TABLE `tbl_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_logs_action`
--
ALTER TABLE `tbl_logs_action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_offers`
--
ALTER TABLE `tbl_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_offer_child`
--
ALTER TABLE `tbl_offer_child`
  ADD KEY `offer_id` (`offer_id`);

--
-- Indexes for table `tbl_package`
--
ALTER TABLE `tbl_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_package_date`
--
ALTER TABLE `tbl_package_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_package_images`
--
ALTER TABLE `tbl_package_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_page`
--
ALTER TABLE `tbl_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_permission`
--
ALTER TABLE `tbl_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_points`
--
ALTER TABLE `tbl_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_policies`
--
ALTER TABLE `tbl_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_popup`
--
ALTER TABLE `tbl_popup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pricerange`
--
ALTER TABLE `tbl_pricerange`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reward`
--
ALTER TABLE `tbl_reward`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roomapi`
--
ALTER TABLE `tbl_roomapi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roomapi_offers`
--
ALTER TABLE `tbl_roomapi_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roomapi_price`
--
ALTER TABLE `tbl_roomapi_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roomfeatures`
--
ALTER TABLE `tbl_roomfeatures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roomtype`
--
ALTER TABLE `tbl_roomtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_room_calender`
--
ALTER TABLE `tbl_room_calender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_route`
--
ALTER TABLE `tbl_route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_season`
--
ALTER TABLE `tbl_season`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slideshow`
--
ALTER TABLE `tbl_slideshow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_social_networking`
--
ALTER TABLE `tbl_social_networking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_starrating`
--
ALTER TABLE `tbl_starrating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subscribers`
--
ALTER TABLE `tbl_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_testimonial`
--
ALTER TABLE `tbl_testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vcombine`
--
ALTER TABLE `tbl_vcombine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_video`
--
ALTER TABLE `tbl_video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vprice`
--
ALTER TABLE `tbl_vprice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_zone_district`
--
ALTER TABLE `tbl_zone_district`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_activities`
--
ALTER TABLE `tbl_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_advertisement`
--
ALTER TABLE `tbl_advertisement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_apibooking`
--
ALTER TABLE `tbl_apibooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_apibooking_child`
--
ALTER TABLE `tbl_apibooking_child`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_apihotel`
--
ALTER TABLE `tbl_apihotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_attractions`
--
ALTER TABLE `tbl_attractions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_bookinginfo`
--
ALTER TABLE `tbl_bookinginfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_bookinginfo_additional`
--
ALTER TABLE `tbl_bookinginfo_additional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_bookinginfo_vehicle`
--
ALTER TABLE `tbl_bookinginfo_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_bookinginfo_vehicle_extra`
--
ALTER TABLE `tbl_bookinginfo_vehicle_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_calendar_price`
--
ALTER TABLE `tbl_calendar_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cleaning_safety`
--
ALTER TABLE `tbl_cleaning_safety`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_configs`
--
ALTER TABLE `tbl_configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `tbl_destination`
--
ALTER TABLE `tbl_destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_dining_hall`
--
ALTER TABLE `tbl_dining_hall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_event`
--
ALTER TABLE `tbl_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_event_category`
--
ALTER TABLE `tbl_event_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_event_hall`
--
ALTER TABLE `tbl_event_hall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_galleries`
--
ALTER TABLE `tbl_galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_gallery_images`
--
ALTER TABLE `tbl_gallery_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_group_type`
--
ALTER TABLE `tbl_group_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_hotel_faqs`
--
ALTER TABLE `tbl_hotel_faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_itinerary`
--
ALTER TABLE `tbl_itinerary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_level`
--
ALTER TABLE `tbl_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=890;

--
-- AUTO_INCREMENT for table `tbl_logs_action`
--
ALTER TABLE `tbl_logs_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_offers`
--
ALTER TABLE `tbl_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_package`
--
ALTER TABLE `tbl_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_package_date`
--
ALTER TABLE `tbl_package_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_package_images`
--
ALTER TABLE `tbl_package_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_page`
--
ALTER TABLE `tbl_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_permission`
--
ALTER TABLE `tbl_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_points`
--
ALTER TABLE `tbl_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tbl_policies`
--
ALTER TABLE `tbl_policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_popup`
--
ALTER TABLE `tbl_popup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pricerange`
--
ALTER TABLE `tbl_pricerange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_reward`
--
ALTER TABLE `tbl_reward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_roomapi`
--
ALTER TABLE `tbl_roomapi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_roomapi_offers`
--
ALTER TABLE `tbl_roomapi_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_roomapi_price`
--
ALTER TABLE `tbl_roomapi_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_roomfeatures`
--
ALTER TABLE `tbl_roomfeatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_roomtype`
--
ALTER TABLE `tbl_roomtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_room_calender`
--
ALTER TABLE `tbl_room_calender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_route`
--
ALTER TABLE `tbl_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_season`
--
ALTER TABLE `tbl_season`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_slideshow`
--
ALTER TABLE `tbl_slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_social_networking`
--
ALTER TABLE `tbl_social_networking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_starrating`
--
ALTER TABLE `tbl_starrating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_subscribers`
--
ALTER TABLE `tbl_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_testimonial`
--
ALTER TABLE `tbl_testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_vcombine`
--
ALTER TABLE `tbl_vcombine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_video`
--
ALTER TABLE `tbl_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_vprice`
--
ALTER TABLE `tbl_vprice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_zone_district`
--
ALTER TABLE `tbl_zone_district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
