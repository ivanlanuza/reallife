-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 166.62.8.17
-- Generation Time: May 01, 2014 at 02:57 AM
-- Server version: 5.5.33
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbreallife`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_config_general`
--

CREATE TABLE `tb_config_general` (
  `conf_spend_year` int(4) NOT NULL,
  `conf_coll_allow` int(8) NOT NULL,
  `conf_hs_allow` int(8) NOT NULL,
  `conf_voc_allow` int(8) NOT NULL,
  `conf_coll_freq` int(2) NOT NULL,
  `conf_hs_freq` int(2) NOT NULL,
  `conf_voc_freq` int(2) NOT NULL,
  `conf_coll_max_spend` int(6) NOT NULL,
  `conf_hs_max_spend` int(6) NOT NULL,
  `conf_voc_max_spend` int(6) NOT NULL,
  `conf_coll_allow_last_run` date NOT NULL,
  `conf_hs_allow_last_run` date NOT NULL,
  `conf_voc_allow_last_run` date NOT NULL,
  `conf_ac_allow` int(8) NOT NULL,
  `conf_coll_weeks` int(8) NOT NULL,
  `conf_hs_weeks` int(8) NOT NULL,
  `conf_voc_weeks` int(8) NOT NULL,
  PRIMARY KEY (`conf_spend_year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_config_general`
--

INSERT INTO `tb_config_general` VALUES(2014, 700, 500, 500, 7, 14, 14, 50000, 40000, 40000, '2014-04-01', '2014-04-01', '2014-04-01', 2000, 42, 40, 40);

-- --------------------------------------------------------

--
-- Table structure for table `tb_config_listing`
--

CREATE TABLE `tb_config_listing` (
  `category` varchar(32) NOT NULL,
  `id` int(4) NOT NULL,
  `option` varchar(128) NOT NULL,
  PRIMARY KEY (`category`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_config_listing`
--

INSERT INTO `tb_config_listing` VALUES('liquidation_purpose', 1, 'Administrative Needs (printing, shipping cost, etc...');
INSERT INTO `tb_config_listing` VALUES('liquidation_purpose', 2, 'Christmas Allotment');
INSERT INTO `tb_config_listing` VALUES('liquidation_purpose', 3, 'Communication Allowance for Life Coach / Area Coor...');
INSERT INTO `tb_config_listing` VALUES('liquidation_purpose', 4, 'House Visits');
INSERT INTO `tb_config_listing` VALUES('liquidation_purpose', 5, 'Meetings / Orientation for Scholars and Volunteers');
INSERT INTO `tb_config_listing` VALUES('liquidation_purpose', 6, 'Scholar Allowance');
INSERT INTO `tb_config_listing` VALUES('liquidation_purpose', 7, 'Scholar OJT / Training / Seminar Fees');
INSERT INTO `tb_config_listing` VALUES('liquidation_purpose', 8, 'Scholar Tuition & Fees');
INSERT INTO `tb_config_listing` VALUES('liquidation_purpose', 9, 'Manual Adjustments');
INSERT INTO `tb_config_listing` VALUES('liquidation_purpose', 10, 'Deposit from REAL LIFE');
INSERT INTO `tb_config_listing` VALUES('request_category', 1, 'Tuition and Fees');
INSERT INTO `tb_config_listing` VALUES('request_category', 2, 'Reimbursement');
INSERT INTO `tb_config_listing` VALUES('request_category', 3, 'Miscellaneous');
INSERT INTO `tb_config_listing` VALUES('request_type', 1, 'Tuition and Fees');
INSERT INTO `tb_config_listing` VALUES('request_type', 2, 'Books and Reading Materials');
INSERT INTO `tb_config_listing` VALUES('request_type', 3, 'Uniform and Shoes');
INSERT INTO `tb_config_listing` VALUES('request_type', 4, 'OJT / Training / Seminar Fees');
INSERT INTO `tb_config_listing` VALUES('request_type', 5, 'Additional Meal / Transpo / Boarding Allowance');
INSERT INTO `tb_config_listing` VALUES('request_type', 6, 'Graduation Requirements');
INSERT INTO `tb_config_listing` VALUES('request_type', 7, 'Other School Expenses');
INSERT INTO `tb_config_listing` VALUES('request_type', 8, 'Minor Incidentals (school supplies, printing, etc)');
INSERT INTO `tb_config_listing` VALUES('scholar_level', 1, 'COLLEGE');
INSERT INTO `tb_config_listing` VALUES('scholar_level', 2, 'HIGH SCHOOL');
INSERT INTO `tb_config_listing` VALUES('scholar_level', 3, 'VOCATIONAL');
INSERT INTO `tb_config_listing` VALUES('scholar_status', 1, 'ACTIVE');
INSERT INTO `tb_config_listing` VALUES('scholar_status', 2, 'PROBATION');
INSERT INTO `tb_config_listing` VALUES('scholar_status', 3, 'EXPELLED');
INSERT INTO `tb_config_listing` VALUES('scholar_status', 4, 'GRADUATED');
INSERT INTO `tb_config_listing` VALUES('user_access_type', 1, 'AC');
INSERT INTO `tb_config_listing` VALUES('user_access_type', 2, 'RLS');
INSERT INTO `tb_config_listing` VALUES('user_area', 1, 'Bacolod');
INSERT INTO `tb_config_listing` VALUES('user_area', 2, 'Batangas');
INSERT INTO `tb_config_listing` VALUES('user_area', 3, 'Cabanatuan');
INSERT INTO `tb_config_listing` VALUES('user_area', 4, 'Caloocan');
INSERT INTO `tb_config_listing` VALUES('user_area', 5, 'Cebu');
INSERT INTO `tb_config_listing` VALUES('user_area', 6, 'Dasmarinas');
INSERT INTO `tb_config_listing` VALUES('user_area', 7, 'General Santos');
INSERT INTO `tb_config_listing` VALUES('user_area', 8, 'Imus');
INSERT INTO `tb_config_listing` VALUES('user_area', 9, 'Laoag');
INSERT INTO `tb_config_listing` VALUES('user_area', 10, 'Lipa');
INSERT INTO `tb_config_listing` VALUES('user_area', 11, 'Makati');
INSERT INTO `tb_config_listing` VALUES('user_area', 12, 'Malate');
INSERT INTO `tb_config_listing` VALUES('user_area', 13, 'Metro East');
INSERT INTO `tb_config_listing` VALUES('user_area', 14, 'Muntinlupa');
INSERT INTO `tb_config_listing` VALUES('user_area', 15, 'Novaliches');
INSERT INTO `tb_config_listing` VALUES('user_area', 16, 'Ortigas');
INSERT INTO `tb_config_listing` VALUES('user_area', 17, 'Pasig');
INSERT INTO `tb_config_listing` VALUES('user_area', 18, 'Quezon City');
INSERT INTO `tb_config_listing` VALUES('user_area', 19, 'Roxas City');
INSERT INTO `tb_config_listing` VALUES('user_area', 20, 'Taguig');
INSERT INTO `tb_config_listing` VALUES('user_area', 21, 'Tuguegarao');
INSERT INTO `tb_config_listing` VALUES('user_area', 22, 'Urdaneta');
INSERT INTO `tb_config_listing` VALUES('user_area', 23, 'Zamboanga');
INSERT INTO `tb_config_listing` VALUES('user_status', 1, 'ACTIVE');
INSERT INTO `tb_config_listing` VALUES('user_status', 2, 'INACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `tb_config_listing_request_category`
--

CREATE TABLE `tb_config_listing_request_category` (
  `id` int(4) NOT NULL,
  `category` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_config_listing_request_category`
--

INSERT INTO `tb_config_listing_request_category` VALUES(1, 'Tuition & Fees');
INSERT INTO `tb_config_listing_request_category` VALUES(2, 'Reimbursements');
INSERT INTO `tb_config_listing_request_category` VALUES(3, 'Miscellaneous');

-- --------------------------------------------------------

--
-- Table structure for table `tb_config_listing_request_type`
--

CREATE TABLE `tb_config_listing_request_type` (
  `id` int(4) NOT NULL,
  `type` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_config_listing_request_type`
--

INSERT INTO `tb_config_listing_request_type` VALUES(1, 'Tuition and Fees');
INSERT INTO `tb_config_listing_request_type` VALUES(2, 'Books and Reading Materials');
INSERT INTO `tb_config_listing_request_type` VALUES(3, 'Uniform and Shoes');
INSERT INTO `tb_config_listing_request_type` VALUES(4, 'OJT / Training / Seminar Fees');
INSERT INTO `tb_config_listing_request_type` VALUES(5, 'Additional Meal / Transpo / Boarding Allowance');
INSERT INTO `tb_config_listing_request_type` VALUES(6, 'Graduation Requirements');
INSERT INTO `tb_config_listing_request_type` VALUES(7, 'Other School Expenses');
INSERT INTO `tb_config_listing_request_type` VALUES(8, 'Minor Incidentals (school supplies, printing, etc)');

-- --------------------------------------------------------

--
-- Table structure for table `tb_liquidation_info`
--

CREATE TABLE `tb_liquidation_info` (
  `liq_id` int(16) NOT NULL,
  `liq_area` varchar(16) NOT NULL,
  `liq_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `liq_expense_or_deposit` varchar(3) NOT NULL,
  `liq_description` varchar(128) NOT NULL,
  `liq_purpose` varchar(64) NOT NULL,
  `liq_amount` float NOT NULL,
  `liq_rem_balance` float NOT NULL,
  `liq_expense_date` date NOT NULL,
  `liq_user_id` int(8) NOT NULL,
  PRIMARY KEY (`liq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_liquidation_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `tb_request_history`
--

CREATE TABLE `tb_request_history` (
  `req_id_hist` int(16) NOT NULL,
  `req_item_id_hist` int(4) NOT NULL,
  `req_status_hist` varchar(16) NOT NULL,
  `req_date_hist` date NOT NULL,
  `req_user_id_hist` int(8) NOT NULL,
  PRIMARY KEY (`req_id_hist`,`req_item_id_hist`,`req_status_hist`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_request_history`
--


-- --------------------------------------------------------

--
-- Table structure for table `tb_request_info`
--

CREATE TABLE `tb_request_info` (
  `req_id` int(16) NOT NULL,
  `req_item_id` int(4) NOT NULL,
  `req_cat` varchar(32) NOT NULL,
  `req_type` varchar(32) NOT NULL,
  `req_ac_id` int(8) NOT NULL,
  `req_scholar_id` int(8) NOT NULL,
  `req_status` varchar(16) NOT NULL,
  `req_description` varchar(128) NOT NULL,
  `req_attachment` varchar(128) NOT NULL,
  `req_spend_year` int(4) NOT NULL,
  `req_amount_requested` int(8) NOT NULL,
  `req_amount_approved` int(8) NOT NULL,
  `req_rejection_reason` varchar(128) NOT NULL,
  `req_date_approved` date NOT NULL,
  `req_date_requested` date NOT NULL,
  PRIMARY KEY (`req_id`,`req_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_request_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `tb_scholar_info`
--

CREATE TABLE `tb_scholar_info` (
  `scholar_id` int(8) NOT NULL,
  `scholar_first_name` varchar(16) NOT NULL,
  `scholar_last_name` varchar(16) NOT NULL,
  `scholar_pic` varchar(64) NOT NULL,
  `scholar_level` varchar(16) NOT NULL,
  `scholar_status` varchar(16) NOT NULL,
  `scholar_area` varchar(16) NOT NULL,
  `scholar_total_spend` int(8) NOT NULL,
  PRIMARY KEY (`scholar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_scholar_info`
--

INSERT INTO `tb_scholar_info` VALUES(10000001, 'Liam', 'Lanuza', 'pic/scholar/10000001.jpg', 'COLLEGE', 'ACTIVE', 'Bacolod', 0);
INSERT INTO `tb_scholar_info` VALUES(10000002, 'Adam', 'Lanuza', 'pic/scholar/10000002.jpg', 'COLLEGE', 'ACTIVE', 'Bacolod', 0);
INSERT INTO `tb_scholar_info` VALUES(10000003, 'Frances', 'Lanuza', 'pic/scholar/10000003.jpg', 'HIGH SCHOOL', 'ACTIVE', 'Bacolod', 0);
INSERT INTO `tb_scholar_info` VALUES(10000004, 'Ivan', 'Lanuza', 'pic/scholar/10000004.jpg', 'VOCATIONAL', 'ACTIVE', 'Pasig', 0);
INSERT INTO `tb_scholar_info` VALUES(10000005, 'Belle', 'Lanuza', 'pic/scholar/10000005.jpg', 'HIGH SCHOOL', 'GRADUATED', 'Taguig', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_info`
--

CREATE TABLE `tb_user_info` (
  `user_id` int(8) NOT NULL,
  `user_email` varchar(32) NOT NULL,
  `user_access_type` varchar(4) NOT NULL,
  `user_area` varchar(16) NOT NULL,
  `user_pic` varchar(64) NOT NULL,
  `user_first_name` varchar(16) NOT NULL,
  `user_last_name` varchar(16) NOT NULL,
  `user_status` varchar(8) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user_info`
--

INSERT INTO `tb_user_info` VALUES(80000000, 'ivancdlanuza@gmail.com', 'RLS', 'Bacolod', '', 'Ivan', 'Lanuza', 'ACTIVE');
INSERT INTO `tb_user_info` VALUES(80000001, 'mabellelanuza@gmail.com', 'AC', 'Bacolod', 'pic/user/80000001.jpg', 'Belle', 'Lanuza', 'ACTIVE');
