-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2023 at 03:05 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marudham`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountsgroup`
--

CREATE TABLE `accountsgroup` (
  `Id` int(11) NOT NULL,
  `AccountsName` longtext DEFAULT NULL,
  `ParentId` int(11) DEFAULT 0,
  `status` int(11) DEFAULT 0,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accountsgroup`
--

INSERT INTO `accountsgroup` (`Id`, `AccountsName`, `ParentId`, `status`, `order_id`) VALUES
(1, 'Capital Account', 0, 0, 1),
(2, 'Current Liabilities', 0, 0, 2),
(3, 'Current Assets', 0, 0, 4),
(4, 'Purchase Accounts', 0, 0, 5),
(5, 'Direct Income', 0, 0, 6),
(6, 'Direct Expenses', 0, 0, 7),
(7, 'Indirect Income', 0, 0, 8),
(8, 'Indirect Expenses', 0, 0, 9),
(9, 'Profit & Loss A/c', 0, 0, 10),
(10, 'Diff. in Opening Balances', 0, 0, 11),
(11, 'Reserve & Surplus', 1, 0, 12),
(12, 'Sundry Creditors', 2, 0, 13),
(13, 'Loans(Liability)', 2, 0, 14),
(14, 'Bank OD', 2, 0, 15),
(15, 'Opening Stock', 3, 0, 16),
(16, 'Cash-in-hand', 3, 0, 17),
(17, 'Bank Accounts', 3, 0, 18),
(18, 'Investments', 3, 0, 19),
(19, 'Loans and Advances', 3, 0, 20),
(40, 'Sundry Debtors', 3, 0, 35),
(42, 'Fixed Assets', 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `agent_communication_details`
--

CREATE TABLE `agent_communication_details` (
  `comm_id` int(11) NOT NULL,
  `agent_reff_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agent_communication_details`
--

INSERT INTO `agent_communication_details` (`comm_id`, `agent_reff_id`, `name`, `designation`, `mobile`, `whatsapp`) VALUES
(61, '26', 'asdf', 'asdf', '12', '123'),
(68, '16', 'Thirugnana samanthar', 'Director', '96969695', '94518445'),
(71, '1', 'Arun', 'Manager', '2342342342', '4234234234'),
(72, '1', 'Kumar ', 'Assistant Manager', '9565654234', '4654234234'),
(73, '27', 'asf', 'asdf', '2343534545', '4565656565'),
(78, '25', 'asdf', 'as', '1243', '234'),
(79, '24', 'asdf', 'asdf', '24', '34'),
(80, '15', 'Dinesh', 'Director', '9446665465', '9654654646'),
(82, '28', 'Dinesh', 'Manager', '9964655665', '9465465645'),
(83, '29', 'Arun', 'Leader', '9446546546', '9486546546'),
(84, '30', 'Suresh', 'TL', '9565465465', '9494654654');

-- --------------------------------------------------------

--
-- Table structure for table `agent_creation`
--

CREATE TABLE `agent_creation` (
  `ag_id` int(11) NOT NULL,
  `ag_code` varchar(255) DEFAULT NULL,
  `ag_name` varchar(255) DEFAULT NULL,
  `ag_group_id` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `taluk` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `loan_category` varchar(255) DEFAULT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `scheme` varchar(255) DEFAULT NULL,
  `loan_payment` varchar(255) DEFAULT NULL,
  `responsible` varchar(255) DEFAULT NULL,
  `collection_point` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_branch_name` varchar(255) DEFAULT NULL,
  `acc_no` varchar(255) DEFAULT NULL,
  `ifsc` varchar(255) DEFAULT NULL,
  `holder_name` varchar(255) DEFAULT NULL,
  `more_info` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agent_creation`
--

INSERT INTO `agent_creation` (`ag_id`, `ag_code`, `ag_name`, `ag_group_id`, `company_id`, `branch_id`, `mail`, `state`, `district`, `taluk`, `place`, `pincode`, `loan_category`, `sub_category`, `scheme`, `loan_payment`, `responsible`, `collection_point`, `bank_name`, `bank_branch_name`, `acc_no`, `ifsc`, `holder_name`, `more_info`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(16, 'AG-103', 'Alangar', '15', '1', '', 'test1@email.com', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vandavasi', '606566', '5', 'Multi Things', '4,8', '1', '1', '0', 'KVB', 'Vandavasi', '13213165465321', 'KVB123456', 'THIRUGNANA SAMANTHAR', 'More Info', 0, '1', '1', NULL, '2023-03-15 17:21:25', '2023-03-27 11:11:42'),
(28, 'AG-104', 'Darling & Co', '24', '1', '', '', 'TamilNadu', 'Ariyalur', 'Andimadam', 'Ambatur', '606564', '2', 'Business', '3', '1', '0', '1', 'Indian Bank', 'Guindy', '64654654654654', 'IB1234654', 'DINESH', '', 0, '1', '1', NULL, '2023-03-29 15:18:14', '2023-03-29 15:18:39'),
(29, 'AG-105', 'Alangar & Co', '15', '1', '', '', 'TamilNadu', 'Chennai', 'Alandur', 'Vandavasi', '606546', '5', 'Laptops,Electronics', '6', '0', '1', '0', 'Indian Bank', 'Guindy', '545676856785', 'KVB123456', 'ARUN NATARAJAN', '', 0, '1', NULL, NULL, '2023-03-29 15:21:11', '2023-03-29 15:21:11'),
(30, 'AG-106', 'Laksmi Electronics', '22', '1', '', '', 'TamilNadu', 'Chennai', 'Egmore', 'Guindy', '654654', '5', 'Laptops', '', '1', '0', '1', 'KVB', 'Ambatur', '56465464654', 'KVB123456', 'Suresh', '', 0, '1', NULL, NULL, '2023-03-29 15:22:50', '2023-03-29 15:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `agent_group_creation`
--

CREATE TABLE `agent_group_creation` (
  `agent_group_id` int(11) NOT NULL,
  `agent_group_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agent_group_creation`
--

INSERT INTO `agent_group_creation` (`agent_group_id`, `agent_group_name`, `status`) VALUES
(1, 'Darling', '0'),
(15, 'Alangar', '0'),
(22, 'Laksmi Electronics', '0'),
(23, 'Laksmi Electronics', '0'),
(24, 'Darling & Co', '0');

-- --------------------------------------------------------

--
-- Table structure for table `area_creation`
--

CREATE TABLE `area_creation` (
  `area_creation_id` int(11) NOT NULL,
  `area_name_id` varchar(255) DEFAULT NULL,
  `sub_area` varchar(255) DEFAULT NULL,
  `taluk` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `enable` varchar(255) NOT NULL DEFAULT '0',
  `status` int(11) DEFAULT 0,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL,
  `created_date` varchar(255) DEFAULT NULL,
  `updated_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area_creation`
--

INSERT INTO `area_creation` (`area_creation_id`, `area_name_id`, `sub_area`, `taluk`, `district`, `state`, `pincode`, `enable`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(1, '1', '1,2,3', 'Vandavasi', 'Tiruvannamalai', 'TamilNadu', '604408', '0', 0, '1', NULL, NULL, '2023-03-14 16:12:04', NULL),
(2, '2', '5', 'Vandavasi', 'Tiruvannamalai', 'TamilNadu', '', '', 0, '1', '1', NULL, '2023-03-14 16:12:32', '2023-03-28 14:15:35'),
(3, '8', '7,8,9', 'Puducherry', 'Puducherry', 'Puducherry', '605001', '0', 0, '25', NULL, NULL, '2023-04-03 12:24:13', NULL),
(4, '6', '11,12,10', 'Vandavasi', 'Tiruvannamalai', 'TamilNadu', '', '0', 0, '1', NULL, NULL, '2023-04-04 17:24:58', NULL),
(5, '7', '13', 'Vandavasi', 'Tiruvannamalai', 'TamilNadu', '605001', '0', 0, '1', NULL, NULL, '2023-04-07 14:12:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `area_group_mapping`
--

CREATE TABLE `area_group_mapping` (
  `map_id` int(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `area_id` varchar(255) DEFAULT NULL,
  `sub_area_id` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT '0',
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `area_group_mapping`
--

INSERT INTO `area_group_mapping` (`map_id`, `group_name`, `area_id`, `sub_area_id`, `company_id`, `branch_id`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(1, 'G1', '1,2', '3,4', '1', '1', '0', '1', '1', NULL, '2023-03-16 14:44:19', '2023-03-23 18:19:14'),
(2, 'G2', '1', '1', '2', '3', '0', '1', '1', NULL, '2023-03-20 16:43:40', '2023-03-23 18:25:45'),
(3, 'G3', '1,2', '2,5', '2', '3', '0', '1', '1', NULL, '2023-03-23 18:25:31', '2023-03-23 18:25:52'),
(5, 'G4', '6', '10,11,12', '1', '1', '0', '1', '1', NULL, '2023-03-29 10:07:58', '2023-04-04 17:25:34'),
(6, 'G5', '8', '7,8,9', '1', '2', '0', '25', NULL, NULL, '2023-04-03 12:24:33', '2023-04-03 12:24:33');

-- --------------------------------------------------------

--
-- Table structure for table `area_line_mapping`
--

CREATE TABLE `area_line_mapping` (
  `map_id` int(11) NOT NULL,
  `line_name` varchar(255) DEFAULT NULL,
  `area_id` varchar(255) DEFAULT NULL,
  `sub_area_id` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT '0',
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `area_line_mapping`
--

INSERT INTO `area_line_mapping` (`map_id`, `line_name`, `area_id`, `sub_area_id`, `company_id`, `branch_id`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(1, 'L1', '1,2', '1,4', '1', '1', '0', '1', '1', NULL, '2023-03-16 14:44:01', '2023-03-24 11:35:51'),
(2, 'L2', '1', '2,3', '1', '2', '0', '1', '1', NULL, '2023-03-20 16:36:51', '2023-03-23 18:26:13'),
(3, 'L4', '6', '10,11,12', '1', '1', '0', '1', '1', NULL, '2023-03-29 10:08:25', '2023-04-04 17:25:43'),
(4, 'L5', '8', '7,8,9', '1', '2', '0', '25', NULL, NULL, '2023-04-03 12:24:47', '2023-04-03 12:24:47'),
(5, 'L5', '7,9', '13', '1', '2', '0', '1', NULL, NULL, '2023-04-10 16:04:25', '2023-04-10 16:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `area_list_creation`
--

CREATE TABLE `area_list_creation` (
  `area_id` int(11) NOT NULL,
  `area_name` varchar(255) DEFAULT NULL,
  `taluk` varchar(255) DEFAULT NULL,
  `area_enable` int(11) NOT NULL DEFAULT 0,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area_list_creation`
--

INSERT INTO `area_list_creation` (`area_id`, `area_name`, `taluk`, `area_enable`, `status`) VALUES
(1, 'Vandavasi', 'Vandavasi', 0, 0),
(2, 'Venkundram', 'Vandavasi', 0, 0),
(3, 'Mel Padhiri', 'Vandavasi', 0, 0),
(4, 'Kil Padhiri', 'Vandavasi', 0, 0),
(5, 'Venkundram Colony', 'Vandavasi', 0, 0),
(6, 'Birudhur', 'Vandavasi', 0, 0),
(7, 'Birudhur Colony', 'Vandavasi', 0, 0),
(8, 'Chinnakadai', 'Puducherry', 0, 0),
(9, 'Jipmar', 'Puducherry', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `branch_creation`
--

CREATE TABLE `branch_creation` (
  `branch_id` int(11) NOT NULL,
  `branch_code` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `address1` text DEFAULT NULL,
  `address2` text DEFAULT NULL,
  `whatsapp_number` text DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `landline_number` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `taluk` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `insert_login_id` int(11) DEFAULT NULL,
  `update_login_id` int(11) DEFAULT NULL,
  `delete_login_id` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch_creation`
--

INSERT INTO `branch_creation` (`branch_id`, `branch_code`, `branch_name`, `company_name`, `mobile_number`, `address1`, `address2`, `whatsapp_number`, `place`, `pincode`, `email_id`, `landline_number`, `state`, `district`, `taluk`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(1, 'D-101', 'Darling Outlet 1', '1', '', 'Address 1', 'Address 2', '', 'Pondicherry', '605002', '', '', 'Puducherry', 'Puducherry', 'Bahour', 0, 1, 1, 1, '2023-03-11 14:42:28', '2023-03-11 14:42:28'),
(2, 'D-102', 'Darling Outlet 2', '1', '', 'Address 1', 'Address 2', '', 'Ambatur', '631513', '', '', 'TamilNadu', 'Ariyalur', 'Andimadam', 0, 1, NULL, NULL, '2023-03-11 15:04:29', '2023-03-11 15:04:29'),
(3, 'A-103', 'ABC Outlet 1', '2', '', '', '', '', 'Ambatur', '243543', '', '', 'TamilNadu', 'Ariyalur', 'Ariyalur', 0, 1, NULL, NULL, '2023-03-20 16:33:52', '2023-03-20 16:33:52');

-- --------------------------------------------------------

--
-- Table structure for table `company_creation`
--

CREATE TABLE `company_creation` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `taluk` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `mailid` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `landline` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `insert_user_id` int(11) DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_creation`
--

INSERT INTO `company_creation` (`company_id`, `company_name`, `address1`, `address2`, `state`, `district`, `taluk`, `place`, `pincode`, `website`, `mailid`, `mobile`, `whatsapp`, `landline`, `status`, `insert_user_id`, `update_user_id`, `created_date`, `updated_date`) VALUES
(1, 'Darling', 'MG road', 'Chinnakadai', 'Puducherry', 'Puducherry', 'Villianur', 'Bussy Street', '605100', '', '', '', '', '', '0', 1, 1, '2023-03-11 14:34:40', '2023-03-17 15:52:47'),
(2, 'ABC Furnitures', 'Bussy street', 'line 2', 'TamilNadu', 'Ariyalur', 'Sendurai', 'Tamilnadu', '605312', '', '', '', '', '', '0', 1, 1, '2023-03-11 14:41:09', '2023-03-17 15:53:11'),
(4, 'as motors', 'bussy street', 'pondicherry', 'Puducherry', 'Puducherry', 'Oulgaret', 'Pondicherry', '123', '', '', '', '', '', '0', 1, 1, '2023-03-17 15:51:56', '2023-03-17 15:53:17');

-- --------------------------------------------------------

--
-- Table structure for table `costcentre`
--

CREATE TABLE `costcentre` (
  `costcentreid` int(11) NOT NULL,
  `costcentrename` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `costcentre`
--

INSERT INTO `costcentre` (`costcentreid`, `costcentrename`, `status`) VALUES
(1, 'Celebration Charges', '0'),
(2, 'Faculty Bus', '0'),
(3, 'Sale', '0'),
(4, 'Purchase', '0'),
(5, 'Salary', '0'),
(6, 'Admin', '0'),
(7, 'test', '0');

-- --------------------------------------------------------

--
-- Table structure for table `customer_profile`
--

CREATE TABLE `customer_profile` (
  `id` int(11) NOT NULL,
  `req_id` varchar(50) DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `cus_name` varchar(255) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `age` varchar(50) DEFAULT NULL,
  `blood_group` varchar(50) DEFAULT NULL,
  `mobile1` varchar(50) DEFAULT NULL,
  `mobile2` varchar(50) DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `cus_pic` varchar(255) DEFAULT NULL,
  `guarentor_name` varchar(255) DEFAULT NULL,
  `guarentor_relation` varchar(100) DEFAULT NULL,
  `guarentor_photo` varchar(255) DEFAULT NULL,
  `cus_type` varchar(50) DEFAULT NULL,
  `cus_exist_type` varchar(50) DEFAULT NULL,
  `residential_type` varchar(50) DEFAULT NULL,
  `residential_details` varchar(255) DEFAULT NULL,
  `residential_address` varchar(255) DEFAULT NULL,
  `residential_native_address` varchar(255) DEFAULT NULL,
  `occupation_type` varchar(50) DEFAULT NULL,
  `occupation_details` varchar(255) DEFAULT NULL,
  `occupation_income` varchar(255) DEFAULT NULL,
  `occupation_address` varchar(255) DEFAULT NULL,
  `area_confirm_type` varchar(50) DEFAULT NULL,
  `area_confirm_state` varchar(100) DEFAULT NULL,
  `area_confirm_district` varchar(100) DEFAULT NULL,
  `area_confirm_taluk` varchar(100) DEFAULT NULL,
  `area_confirm_area` varchar(255) DEFAULT NULL,
  `area_confirm_subarea` varchar(255) DEFAULT NULL,
  `communication` varchar(50) DEFAULT NULL,
  `com_audio` varchar(255) DEFAULT NULL,
  `verification_person` varchar(255) DEFAULT NULL,
  `verification_location` varchar(255) DEFAULT NULL,
  `cus_status` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `insert_login_id` varchar(100) DEFAULT NULL,
  `update_login_id` varchar(100) DEFAULT NULL,
  `delete_login_id` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_register`
--

CREATE TABLE `customer_register` (
  `cus_reg_id` int(11) NOT NULL COMMENT 'Primary Key',
  `req_ref_id` varchar(255) DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `taluk` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `sub_area` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile1` varchar(255) DEFAULT NULL,
  `mobile2` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `marital` varchar(255) DEFAULT NULL,
  `spouse` varchar(255) DEFAULT NULL,
  `occupation_type` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `how_to_know` varchar(100) DEFAULT NULL,
  `loan_count` varchar(50) DEFAULT NULL,
  `first_loan_date` varchar(255) DEFAULT NULL,
  `travel_with_company` varchar(255) DEFAULT NULL,
  `monthly_income` varchar(255) DEFAULT NULL,
  `other_income` varchar(255) DEFAULT NULL,
  `support_income` varchar(255) DEFAULT NULL,
  `commitment` varchar(255) DEFAULT NULL,
  `monthly_due_capacity` varchar(255) DEFAULT NULL,
  `loan_limit` varchar(255) DEFAULT NULL,
  `cus_character` varchar(255) DEFAULT NULL,
  `approach` varchar(255) DEFAULT NULL,
  `relationship` varchar(255) DEFAULT NULL,
  `attitude` varchar(255) DEFAULT NULL,
  `behavior` varchar(255) DEFAULT NULL,
  `incident_remark` varchar(255) DEFAULT NULL,
  `about_customer` varchar(255) DEFAULT NULL,
  `cus_status` varchar(255) DEFAULT '0',
  `create_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer_register`
--

INSERT INTO `customer_register` (`cus_reg_id`, `req_ref_id`, `cus_id`, `customer_name`, `dob`, `age`, `gender`, `state`, `district`, `taluk`, `area`, `sub_area`, `address`, `mobile1`, `mobile2`, `father_name`, `mother_name`, `marital`, `spouse`, `occupation_type`, `occupation`, `pic`, `how_to_know`, `loan_count`, `first_loan_date`, `travel_with_company`, `monthly_income`, `other_income`, `support_income`, `commitment`, `monthly_due_capacity`, `loan_limit`, `cus_character`, `approach`, `relationship`, `attitude`, `behavior`, `incident_remark`, `about_customer`, `cus_status`, `create_time`) VALUES
(2, '2', '213132132132', 'Logeshwaran', '2021-10-13', '1', '2', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'Check', '3456455765', '253465465', 'Kuppusamy', 'Mariyamma', '1', 'Selvi', '7', 'KMC', 'programming-funny-jokes-e1600486875722.jpg', '0', '', '', '', '34', '345', '435', '345', '43', '15000', 'sdfg', 'dsfg', 'dsfg', 'dsfg', 'dfg', 'dfg', 'dgf', '8', '2023-04-01 11:39:58'),
(3, '3', '546546546465', 'Kuppusamy', '2023-03-29', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9646465546', '94654654', 'Karuppan', 'Jekkamma', '2', '', '2', 'KMC', 'pexels-jakub-novacek-924824.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2023-04-01 13:19:58'),
(4, '5', '289499396919', 'Arun', '1999-04-27', '24', '1', 'Puducherry', 'Puducherry', 'Puducherry', '8', '7', 'Chinnakadai', '9654566456', '', 'Natarajan', 'Parameswari', '2', '', '3', 'Developer', 'pexels-aleksandar-pasaric-325185.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2023-04-03 12:29:54'),
(7, '6', '123456789101', 'Triple H', '1999-07-15', '24', '1', 'Puducherry', 'Puducherry', 'Puducherry', '8', '8', 'MG road', '9565654654', '', 'Roman reigns', 'Nikki', '1', 'Manju warrior', '4', 'Uzhavan', 'pexels-hansen-tang-13435926.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2023-04-03 13:35:26'),
(8, '7', '123456789102', 'Swetha', '2005-05-02', '18', '2', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'Pudhu street', '9694999999', '', 'Thookudurai', 'Niranjana', '2', '', '4', 'Actor', 'wallpaperflare.com_wallpaper.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', '2023-04-03 13:39:44'),
(11, '7', '123456789102', 'Swetha', '2005-05-02', '18', '2', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'Pudhu street', '9694999999', '', 'Thookudurai', 'Niranjana', '2', '', '4', 'Actor', 'wallpaperflare.com_wallpaper.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-04-03 14:46:05'),
(12, '12', '546546546465', 'Kuppusamy', '2023-03-29', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9646465546', '94654654', 'Karuppan', 'Jekkamma', '2', '', '2', 'KMC', 'pexels-jakub-novacek-924824.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-04-04 10:56:10'),
(13, '13', '963852741123', 'Kumaran', '2023-03-16', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '2353645675', '', 'Eeswaran', 'Mahalakshmi', '1', 'Mythili', '7', 'Boxer', 'WhatsApp Image 2023-01-20 at 11.43.56 AM.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-04-04 12:28:32'),
(14, '16', '963852741236', 'Ambi', '2023-03-31', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '6', '10', 'bussy street', '9654811325', '9456465465', 'Parthasarathy Iyengar', 'Susheela', '2', '', '7', 'Anniyan', 'images.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2023-04-10 15:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `director_creation`
--

CREATE TABLE `director_creation` (
  `dir_id` int(11) NOT NULL,
  `dir_code` varchar(255) DEFAULT NULL,
  `dir_type` varchar(255) DEFAULT NULL,
  `dir_name` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `taluk` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `mail_id` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `whatsapp_no` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT '0',
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `director_creation`
--

INSERT INTO `director_creation` (`dir_id`, `dir_code`, `dir_type`, `dir_name`, `company_id`, `branch_id`, `address1`, `address2`, `state`, `district`, `taluk`, `place`, `pincode`, `mail_id`, `mobile_no`, `whatsapp_no`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(1, 'D-101', '1', 'Chithambaram', '1', '2', '', '', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vandavasi', '606456', '', '9948846498', '', '0', '1', NULL, NULL, '2023-03-14 16:20:36', '2023-03-14 16:20:36'),
(2, 'EXD-102', '2', 'John cena', '1', '1', '', '', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Trivannamalai', '635464', '', '', '', '0', '1', NULL, NULL, '2023-03-14 16:22:52', '2023-03-14 16:22:52'),
(3, 'EXD-103', '2', 'Big show', '1', '2', 'bussy street', '', 'Puducherry', 'Puducherry', 'Villianur', 'sdf', '34', '', '23423', '24324', '0', '1', '1', NULL, '2023-03-16 15:14:40', '2023-03-17 15:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `doc_mapping`
--

CREATE TABLE `doc_mapping` (
  `doc_map_id` int(11) NOT NULL,
  `loan_category` varchar(255) DEFAULT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `doc_creation` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT '0',
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doc_mapping`
--

INSERT INTO `doc_mapping` (`doc_map_id`, `loan_category`, `sub_category`, `doc_creation`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(1, '3', '4 Wheeler', '1,3', '0', '1', '1', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '5', 'Multi Things', '2,4', '0', '1', NULL, NULL, '0000-00-00 00:00:00', '2023-03-22 10:03:56'),
(3, '6', 'Education', '6,7', '0', '1', '1', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `in_approval`
--

CREATE TABLE `in_approval` (
  `req_id` varchar(255) DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `cus_status` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT '0',
  `insert_login_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `in_verification`
--

CREATE TABLE `in_verification` (
  `req_id` int(11) NOT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `agent_id` varchar(255) DEFAULT NULL,
  `responsible` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `declaration` varchar(255) DEFAULT NULL,
  `req_code` varchar(255) DEFAULT NULL,
  `dor` date DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `cus_data` varchar(255) DEFAULT NULL,
  `cus_name` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `taluk` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `sub_area` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile1` varchar(255) DEFAULT NULL,
  `mobile2` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `marital` varchar(255) DEFAULT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `occupation_type` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `loan_category` varchar(255) DEFAULT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `tot_value` varchar(255) DEFAULT NULL,
  `ad_amt` varchar(255) DEFAULT NULL,
  `ad_perc` varchar(255) DEFAULT NULL,
  `loan_amt` varchar(255) DEFAULT NULL,
  `poss_type` varchar(255) DEFAULT NULL,
  `due_amt` varchar(255) DEFAULT NULL,
  `due_period` varchar(255) DEFAULT NULL,
  `cus_status` varchar(255) DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '0',
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `in_verification`
--

INSERT INTO `in_verification` (`req_id`, `user_type`, `user_name`, `agent_id`, `responsible`, `remarks`, `declaration`, `req_code`, `dor`, `cus_id`, `cus_data`, `cus_name`, `dob`, `age`, `gender`, `state`, `district`, `taluk`, `area`, `sub_area`, `address`, `mobile1`, `mobile2`, `father_name`, `mother_name`, `marital`, `spouse_name`, `occupation_type`, `occupation`, `pic`, `loan_category`, `sub_category`, `tot_value`, `ad_amt`, `ad_perc`, `loan_amt`, `poss_type`, `due_amt`, `due_period`, `cus_status`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(4, 'Agent', 'Darling & Co', '28', '0', '', 'v', 'REQ-103', '2023-04-01', '213132132132', 'Existing', 'Logeshwaran', '2021-10-13', '1', '2', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'Check', '3456455765', '253465465', 'Kuppusamy', 'Mariyamma', '1', 'Selvi', '7', 'KMC', 'programming-funny-jokes-e1600486875722.jpg', '2', 'Business', '15000', '5000', '33.3', '10000', '2', '', '12', '1', '0', '24', '24', '24', '2023-04-01 15:09:46', '2023-04-01 15:09:46'),
(5, 'Staff', 'Kumar', '', '', 'test remarks', '', 'REQ-104', '2023-04-03', '289499396919', 'New', 'Arun', '1999-04-27', '24', '1', 'Puducherry', 'Puducherry', 'Puducherry', '8', '7', 'Chinnakadai', '9654566456', '', 'Natarajan', 'Parameswari', '2', '', '3', 'Developer', 'pexels-aleksandar-pasaric-325185.jpg', '5', 'Mobile', '25000', '5000', '20.0', '20000', '1', '2583', '', '1', '0', '21', NULL, NULL, '2023-04-03 12:29:54', '2023-04-03 12:29:54'),
(6, 'Director', 'Big show', '16', '1', '', 'Test Declaration', 'REQ-105', '2023-04-03', '123456789101', 'New', 'Triple H', '1999-07-15', '24', '1', 'Puducherry', 'Puducherry', 'Puducherry', '8', '8', 'MG road', '9565654654', '', 'Roman reigns', 'Nikki', '1', 'Manju warrior', '4', 'Uzhavan', 'pexels-hansen-tang-13435926.jpg', '5', 'Furniture', '', '', '', '20000', '1', '15000', NULL, '5', '0', '25', '1', '1', '2023-04-03 12:35:27', '0000-00-00 00:00:00'),
(16, 'Agent', 'Darling & Co', '28', '1', '', 'Test', 'REQ-113', '2023-04-10', '963852741236', 'New', 'Ambi', '2023-03-31', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '6', '10', 'bussy street', '9654811325', '9456465465', 'Parthasarathy Iyengar', 'Susheela', '2', '', '7', 'Anniyan', 'images.jpg', '2', 'Business', '15000', '100', '0.7', '14900', '1', '1500', '', '1', '0', '24', NULL, NULL, '2023-04-10 15:01:23', '2023-04-10 15:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `ledgerid` int(11) NOT NULL,
  `ledgername` varchar(255) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `subgroupname` varchar(255) DEFAULT NULL,
  `inventory` varchar(255) DEFAULT NULL,
  `costcentre` varchar(255) DEFAULT NULL,
  `openingbalancedr` varchar(200) DEFAULT NULL,
  `opening_credit` varchar(255) DEFAULT NULL,
  `opening_debit` varchar(255) DEFAULT NULL,
  `openingbalance` int(200) DEFAULT 0,
  `status` varchar(255) DEFAULT '0',
  `exciseduty` varchar(255) DEFAULT NULL,
  `pan` varchar(255) DEFAULT NULL,
  `tin` varchar(255) DEFAULT NULL,
  `servicetax` varchar(255) DEFAULT NULL,
  `contactperson` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `address3` varchar(255) DEFAULT NULL,
  `address4` varchar(255) DEFAULT NULL,
  `contactnumber` varchar(255) DEFAULT NULL,
  `AccountRefId` int(11) DEFAULT NULL,
  `ServiceTaxNumber` varchar(255) DEFAULT NULL,
  `ExciseDutyReg` varchar(255) DEFAULT NULL,
  `DebitCredit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ledger`
--

INSERT INTO `ledger` (`ledgerid`, `ledgername`, `groupname`, `subgroupname`, `inventory`, `costcentre`, `openingbalancedr`, `opening_credit`, `opening_debit`, `openingbalance`, `status`, `exciseduty`, `pan`, `tin`, `servicetax`, `contactperson`, `address1`, `address2`, `address3`, `address4`, `contactnumber`, `AccountRefId`, `ServiceTaxNumber`, `ExciseDutyReg`, `DebitCredit`) VALUES
(3, 'SBI', '3', '17', 'No', 'No', 'CR', '0', '0', 0, '0', '', '', '', '', '', '', '', '', '', '', 17, NULL, NULL, NULL),
(4, 'Mukesh', '3', '3', 'No', 'No', 'CR', '50000', '0', 50000, '0', '', '', '', '', '', '', '', '', '', '', 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_calculation`
--

CREATE TABLE `loan_calculation` (
  `loan_cal_id` int(11) NOT NULL,
  `loan_category` varchar(250) DEFAULT NULL,
  `sub_category` varchar(250) DEFAULT NULL,
  `due_method` varchar(250) DEFAULT NULL,
  `due_type` varchar(250) DEFAULT NULL,
  `profit_method` varchar(250) DEFAULT NULL,
  `calculate_method` varchar(250) DEFAULT NULL,
  `intrest_rate_min` varchar(250) DEFAULT NULL,
  `intrest_rate_max` varchar(250) DEFAULT NULL,
  `due_period_min` varchar(250) DEFAULT NULL,
  `due_period_max` varchar(250) DEFAULT NULL,
  `document_charge_min` varchar(250) DEFAULT NULL,
  `document_charge_max` varchar(250) DEFAULT NULL,
  `processing_fee_min` varchar(250) DEFAULT NULL,
  `processing_fee_max` varchar(250) DEFAULT NULL,
  `loan_limit` varchar(255) DEFAULT NULL,
  `due_date` varchar(250) DEFAULT NULL,
  `grace_period` varchar(250) DEFAULT NULL,
  `penalty` varchar(250) DEFAULT NULL,
  `overdue` varchar(250) DEFAULT NULL,
  `collection_info` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `insert_login_id` int(11) DEFAULT NULL,
  `update_login_id` int(11) DEFAULT NULL,
  `delete_login_id` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_calculation`
--

INSERT INTO `loan_calculation` (`loan_cal_id`, `loan_category`, `sub_category`, `due_method`, `due_type`, `profit_method`, `calculate_method`, `intrest_rate_min`, `intrest_rate_max`, `due_period_min`, `due_period_max`, `document_charge_min`, `document_charge_max`, `processing_fee_min`, `processing_fee_max`, `loan_limit`, `due_date`, `grace_period`, `penalty`, `overdue`, `collection_info`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(1, '2', 'Business', 'Monthly', 'intrest', '', 'day', '1.5', '1.6', '1.5', '1.6', '1.5', '1.6', '1.5', '1.6', '156654', '', '', '', '', 'Yes', 0, 1, 1, NULL, '2023-03-14 16:00:43', '2023-03-14 16:00:43'),
(2, '5', 'Mobile', 'Monthly', 'emi', 'pre_intrest,after_intrest', '', '1.6', '1.6', '1.6', '1.6', '1.6', '1.6', '1.6', '1.6', '30000', '', '', '', '1.6', 'Yes', 0, 1, 1, NULL, '2023-03-14 16:02:51', '2023-03-14 16:02:51'),
(3, '5', 'Furniture', 'Monthly', 'intrest', '', 'monthly', '11', '1', '1', '1', '1', '1', '1', '1', '156654', '', '', '', '', 'No', 0, 1, NULL, NULL, '2023-03-23 12:17:56', '2023-03-23 12:17:56'),
(5, '5', 'Multi Things', 'Monthly', 'emi', 'pre_intrest,after_intrest', '', '2', '2', '2', '2', '2', '2', '2', '2', '2334333', '', '', '', '', 'Yes', 0, 1, NULL, NULL, '2023-03-23 13:28:40', '2023-03-23 13:28:40'),
(6, '6', 'Education', 'Monthly', 'emi', 'pre_intrest', '', '5', '5', '5', '5', '5', '5', '5', '5', '50000', '', '', '', '', 'Yes', 0, 1, 1, NULL, '2023-03-23 13:38:13', '2023-03-23 13:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `loan_category`
--

CREATE TABLE `loan_category` (
  `loan_category_id` int(11) NOT NULL,
  `loan_category_name` varchar(255) DEFAULT NULL,
  `sub_category_name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `insert_user_id` int(11) DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `delete_user_id` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_category`
--

INSERT INTO `loan_category` (`loan_category_id`, `loan_category_name`, `sub_category_name`, `status`, `insert_user_id`, `update_user_id`, `delete_user_id`, `created_date`, `updated_date`) VALUES
(1, '5', 'Electronics', 0, 1, NULL, NULL, '2023-03-14 15:56:07', '2023-03-14 15:56:07'),
(2, '7', 'Personal', 0, 1, NULL, NULL, '2023-03-14 15:56:26', '2023-03-14 15:56:26'),
(3, '3', '4 Wheeler', 0, 1, NULL, NULL, '2023-03-14 15:56:39', '2023-03-14 15:56:39'),
(4, '5', 'Mobile', 0, 1, NULL, NULL, '2023-03-14 15:57:19', '2023-03-14 15:57:19'),
(5, '6', 'Education', 0, 1, NULL, NULL, '2023-03-14 15:57:46', '2023-03-14 15:57:46'),
(6, '5', 'Furniture', 0, 1, NULL, NULL, '2023-03-14 15:58:09', '2023-03-14 15:58:09'),
(7, '5', 'Multi Things', 0, 1, NULL, NULL, '2023-03-14 15:58:31', '2023-03-14 15:58:31'),
(8, '4', 'Gold', 0, 1, NULL, NULL, '2023-03-14 15:58:52', '2023-03-14 15:58:52'),
(9, '3', '2 Wheeler', 0, 1, NULL, NULL, '2023-03-14 15:59:11', '2023-03-14 15:59:11'),
(10, '2', 'Business', 0, 1, NULL, NULL, '2023-03-14 15:59:25', '2023-03-14 15:59:25'),
(11, '1', 'Property', 0, 1, NULL, NULL, '2023-03-14 15:59:55', '2023-03-14 15:59:55'),
(12, '5', 'Laptops', 0, 1, NULL, 1, '2023-03-23 13:29:39', '2023-03-23 13:29:39');

-- --------------------------------------------------------

--
-- Table structure for table `loan_category_creation`
--

CREATE TABLE `loan_category_creation` (
  `loan_category_creation_id` int(11) NOT NULL,
  `loan_category_creation_name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `insert_user_id` int(11) DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `delete_user_id` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_category_creation`
--

INSERT INTO `loan_category_creation` (`loan_category_creation_id`, `loan_category_creation_name`, `status`, `insert_user_id`, `update_user_id`, `delete_user_id`, `created_date`, `updated_date`) VALUES
(1, 'Property', 0, NULL, NULL, NULL, '2023-03-14 15:54:00', '2023-03-14 15:54:00'),
(2, 'Business', 0, NULL, NULL, NULL, '2023-03-14 15:54:04', '2023-03-14 15:54:04'),
(3, 'Vehicle', 0, NULL, NULL, NULL, '2023-03-14 15:54:08', '2023-03-14 15:54:08'),
(4, 'Gold', 0, NULL, NULL, NULL, '2023-03-14 15:54:11', '2023-03-14 15:54:11'),
(5, 'Appliance', 0, NULL, NULL, NULL, '2023-03-14 15:54:15', '2023-03-14 15:54:15'),
(6, 'Education', 0, NULL, NULL, NULL, '2023-03-14 15:54:22', '2023-03-14 15:54:22'),
(7, 'Personal', 0, NULL, NULL, NULL, '2023-03-14 15:54:27', '2023-03-14 15:54:27'),
(8, 'Housing', 0, NULL, NULL, NULL, '2023-03-14 15:55:17', '2023-03-14 15:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `loan_category_ref`
--

CREATE TABLE `loan_category_ref` (
  `loan_category_ref_id` int(11) NOT NULL,
  `loan_category_ref_name` varchar(255) DEFAULT NULL,
  `loan_category_id` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `insert_user_id` int(11) DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `delete_user_id` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_category_ref`
--

INSERT INTO `loan_category_ref` (`loan_category_ref_id`, `loan_category_ref_name`, `loan_category_id`, `status`, `insert_user_id`, `update_user_id`, `delete_user_id`, `created_date`, `updated_date`) VALUES
(1, 'Product', '1', 0, NULL, NULL, NULL, '2023-03-14 15:56:07', '2023-03-14 15:56:07'),
(2, 'Company', '1', 0, NULL, NULL, NULL, '2023-03-14 15:56:07', '2023-03-14 15:56:07'),
(5, 'Product', '3', 0, NULL, NULL, NULL, '2023-03-14 15:56:52', '2023-03-14 15:56:52'),
(6, 'Company', '3', 0, NULL, NULL, NULL, '2023-03-14 15:56:52', '2023-03-14 15:56:52'),
(12, 'Product', '6', 0, NULL, NULL, NULL, '2023-03-14 15:58:09', '2023-03-14 15:58:09'),
(13, 'Company', '6', 0, NULL, NULL, NULL, '2023-03-14 15:58:09', '2023-03-14 15:58:09'),
(14, 'Product', '7', 0, NULL, NULL, NULL, '2023-03-14 15:58:31', '2023-03-14 15:58:31'),
(15, 'Company', '7', 0, NULL, NULL, NULL, '2023-03-14 15:58:31', '2023-03-14 15:58:31'),
(18, 'Product', '9', 0, NULL, NULL, NULL, '2023-03-14 15:59:11', '2023-03-14 15:59:11'),
(19, 'Company', '9', 0, NULL, NULL, NULL, '2023-03-14 15:59:11', '2023-03-14 15:59:11'),
(25, 'Property type', '11', 0, NULL, NULL, NULL, '2023-03-27 11:20:30', '2023-03-27 11:20:30'),
(26, 'Area Sq ft', '11', 0, NULL, NULL, NULL, '2023-03-27 11:20:30', '2023-03-27 11:20:30'),
(27, 'Value', '11', 0, NULL, NULL, NULL, '2023-03-27 11:20:30', '2023-03-27 11:20:30'),
(31, 'Business name', '10', 0, NULL, NULL, NULL, '2023-03-27 11:29:14', '2023-03-27 11:29:14'),
(32, 'Jewel Name', '8', 0, NULL, NULL, NULL, '2023-03-27 11:29:20', '2023-03-27 11:29:20'),
(33, 'Weight', '8', 0, NULL, NULL, NULL, '2023-03-27 11:29:20', '2023-03-27 11:29:20'),
(34, 'Institute Name', '5', 0, NULL, NULL, NULL, '2023-03-27 11:29:27', '2023-03-27 11:29:27'),
(35, 'Class', '5', 0, NULL, NULL, NULL, '2023-03-27 11:29:27', '2023-03-27 11:29:27'),
(36, 'Class Detail', '5', 0, NULL, NULL, NULL, '2023-03-27 11:29:27', '2023-03-27 11:29:27'),
(40, 'Company', '4', 0, NULL, NULL, NULL, '2023-03-31 11:33:53', '2023-03-31 11:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `loan_scheme`
--

CREATE TABLE `loan_scheme` (
  `scheme_id` int(11) NOT NULL,
  `scheme_name` varchar(255) DEFAULT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `loan_category` varchar(255) DEFAULT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `due_method` varchar(255) DEFAULT NULL,
  `profit_method` varchar(255) DEFAULT NULL,
  `intrest_rate` varchar(255) DEFAULT NULL,
  `total_due` varchar(255) DEFAULT NULL,
  `advance_due` varchar(255) DEFAULT NULL,
  `due_period` varchar(255) DEFAULT NULL,
  `doc_charge_type` varchar(255) DEFAULT NULL,
  `doc_charge_min` varchar(255) DEFAULT NULL,
  `doc_charge_max` varchar(255) DEFAULT NULL,
  `proc_fee_type` varchar(255) DEFAULT NULL,
  `proc_fee_min` varchar(255) DEFAULT NULL,
  `proc_fee_max` varchar(255) DEFAULT NULL,
  `due_date` varchar(255) DEFAULT NULL,
  `overdue` varchar(255) DEFAULT NULL,
  `grace_period` varchar(255) DEFAULT NULL,
  `penalty` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `insert_login_id` int(11) DEFAULT NULL,
  `update_login_id` int(11) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_scheme`
--

INSERT INTO `loan_scheme` (`scheme_id`, `scheme_name`, `short_name`, `loan_category`, `sub_category`, `due_method`, `profit_method`, `intrest_rate`, `total_due`, `advance_due`, `due_period`, `doc_charge_type`, `doc_charge_min`, `doc_charge_max`, `proc_fee_type`, `proc_fee_min`, `proc_fee_max`, `due_date`, `overdue`, `grace_period`, `penalty`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(1, 'Monthly scheme', '', '1', 'Property', 'monthly', 'pre_intrest', '15', '5', '0', '5', 'percentage', '10', '20', 'percentage', '0', '0', '', '', '', '', 0, 1, 1, NULL, '2023-03-14 16:04:05', '2023-04-11 12:34:32'),
(2, 'Weekly scheme', 'Weekly 10', '1', 'Property', 'weekly', 'pre_intrest', '10', NULL, NULL, '10', 'amt', '10', '20', 'amt', '0', '10', '', '2', NULL, NULL, 0, 1, 1, NULL, '2023-03-14 16:08:05', '2023-03-27 11:52:01'),
(3, 'Daily scheme', 'Daily 100', '2', 'Business', 'daily', 'pre_intrest', '10', NULL, NULL, '100', 'amt', '10', '20', 'amt', '0', '10', NULL, '3', NULL, NULL, 0, 1, 1, NULL, '2023-03-14 16:08:49', '2023-03-27 11:52:12'),
(4, 'AB3', 'AB3', '5', 'Multi Things', 'monthly', 'pre_intrest', '5', '10', '1', '9', 'amt', '1000', '1500', 'amt', '1000', '1500', '', '', '', '', 0, 1, NULL, NULL, '2023-03-24 15:42:47', '2023-03-24 15:42:47'),
(5, '2W', '2W', '3', '2 Wheeler', 'monthly', 'pre_intrest', '2', '15', '1', '14', 'amt', '2000', '2500', 'amt', '2000', '2500', '', '', '', '', 0, 1, NULL, NULL, '2023-03-24 15:43:19', '2023-03-24 15:43:19'),
(6, 'E2', 'E2', '5', 'Electronics', 'weekly', 'pre_intrest', '1', NULL, NULL, '15', 'amt', '1000', '1500', 'amt', '1500', '1500', '', '', NULL, NULL, 0, 1, NULL, NULL, '2023-03-24 15:43:47', '2023-03-24 15:43:47'),
(7, '2WW', '2WW', '3', '2 Wheeler', 'weekly', 'pre_intrest', '5', NULL, NULL, '10', 'amt', '1000', '1000', 'amt', '1500', '1500', '', '', NULL, NULL, 0, 1, NULL, NULL, '2023-03-24 15:44:20', '2023-03-24 15:44:20'),
(8, 'D02', 'd', '5', 'Multi Things', 'daily', 'pre_intrest', '10', NULL, NULL, '22', 'amt', '1500', '1500', 'amt', '1500', '1500', NULL, '', NULL, NULL, 0, 1, NULL, NULL, '2023-03-24 15:44:55', '2023-03-24 15:44:55'),
(9, 'D03', 'dd', '3', '2 Wheeler', 'daily', 'pre_intrest', '7', NULL, NULL, '15', 'amt', '1500', '1500', 'amt', '100', '1500', NULL, '', NULL, NULL, 0, 1, NULL, NULL, '2023-03-24 15:45:19', '2023-03-24 15:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `purpose`
--

CREATE TABLE `purpose` (
  `purposeid` int(11) NOT NULL,
  `purposename` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purpose`
--

INSERT INTO `purpose` (`purposeid`, `purposename`, `status`) VALUES
(1, 'test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `request_category_info`
--

CREATE TABLE `request_category_info` (
  `cat_info` int(11) NOT NULL,
  `req_ref_id` varchar(255) DEFAULT NULL,
  `category_info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `request_category_info`
--

INSERT INTO `request_category_info` (`cat_info`, `req_ref_id`, `category_info`) VALUES
(3, '2', 'Medical shop'),
(4, '3', 'Sofa'),
(5, '3', 'Samsung'),
(7, '5', 'Oneplus'),
(13, '6', 'AC'),
(14, '6', 'Sansui'),
(18, '7', 'Supermarket'),
(19, '10', 'Chair'),
(20, '10', 'SS'),
(21, '11', 'News Channel'),
(23, '12', 'Sansui'),
(24, '13', 'Club'),
(25, '14', 'Sofa'),
(26, '15', 'Mobile sales'),
(27, '15', 'Car dealing'),
(28, '15', 'Wood'),
(29, '16', 'Tyre punchure'),
(30, '16', 'Car tyre');

-- --------------------------------------------------------

--
-- Table structure for table `request_creation`
--

CREATE TABLE `request_creation` (
  `req_id` int(11) NOT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `agent_id` varchar(255) DEFAULT NULL,
  `responsible` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `declaration` varchar(255) DEFAULT NULL,
  `req_code` varchar(255) DEFAULT NULL,
  `dor` date DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `cus_data` varchar(255) DEFAULT NULL,
  `cus_name` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `taluk` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `sub_area` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile1` varchar(255) DEFAULT NULL,
  `mobile2` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `marital` varchar(255) DEFAULT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `occupation_type` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `loan_category` varchar(255) DEFAULT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `tot_value` varchar(255) DEFAULT NULL,
  `ad_amt` varchar(255) DEFAULT NULL,
  `ad_perc` varchar(255) DEFAULT NULL,
  `loan_amt` varchar(255) DEFAULT NULL,
  `poss_type` varchar(255) DEFAULT NULL,
  `due_amt` varchar(255) DEFAULT NULL,
  `due_period` varchar(255) DEFAULT NULL,
  `cus_status` varchar(255) DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '0',
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_creation`
--

INSERT INTO `request_creation` (`req_id`, `user_type`, `user_name`, `agent_id`, `responsible`, `remarks`, `declaration`, `req_code`, `dor`, `cus_id`, `cus_data`, `cus_name`, `dob`, `age`, `gender`, `state`, `district`, `taluk`, `area`, `sub_area`, `address`, `mobile1`, `mobile2`, `father_name`, `mother_name`, `marital`, `spouse_name`, `occupation_type`, `occupation`, `pic`, `loan_category`, `sub_category`, `tot_value`, `ad_amt`, `ad_perc`, `loan_amt`, `poss_type`, `due_amt`, `due_period`, `cus_status`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(2, 'Staff', 'Kumar', NULL, '', '123', '', 'REQ-101', '2023-04-01', '213132132132', 'New', 'Logeshwaran', '2021-10-13', '1', '2', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'Check', '3456455765', '253465465', 'Kuppusamy', 'Mariyamma', '1', 'Selvi', '7', 'KMC', 'programming-funny-jokes-e1600486875722.jpg', '2', 'Business', '15000', '5000', '33.3', '10000', '1', '2750', '', '0', '0', '21', '21', NULL, '2023-04-01 11:39:58', '2023-04-01 11:39:58'),
(3, 'Director', 'Big show', '', '1', '', 'Declaration', 'REQ-102', '2023-04-01', '546546546465', 'New', 'Kuppusamy', '2023-03-29', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9646465546', '94654654', 'Karuppan', 'Jekkamma', '2', '', '2', 'KMC', 'pexels-jakub-novacek-924824.jpg', '5', 'Furniture', '', '', '', '15000', '1', '1500', '', '0', '0', '25', '25', NULL, '2023-04-01 13:19:58', '2023-04-01 13:19:58'),
(4, 'Agent', 'Darling & Co', '28', '0', '', 'v', 'REQ-103', '2023-04-01', '213132132132', 'Existing', 'Logeshwaran', '2021-10-13', '1', '2', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'Check', '3456455765', '253465465', 'Kuppusamy', 'Mariyamma', '1', 'Selvi', '7', 'KMC', 'programming-funny-jokes-e1600486875722.jpg', '2', 'Business', '15000', '5000', '33.3', '10000', '2', '', '12', '1', '0', '24', '24', '24', '2023-04-01 15:09:46', '2023-04-01 15:09:46'),
(5, 'Staff', 'Kumar', '', '', 'test remarks', '', 'REQ-104', '2023-04-03', '289499396919', 'New', 'Arun', '1999-04-27', '24', '1', 'Puducherry', 'Puducherry', 'Puducherry', '8', '7', 'Chinnakadai', '9654566456', '', 'Natarajan', 'Parameswari', '2', '', '3', 'Developer', 'pexels-aleksandar-pasaric-325185.jpg', '5', 'Mobile', '25000', '5000', '20.0', '20000', '1', '2583', '', '1', '0', '21', '1', NULL, '2023-04-03 12:29:54', '2023-04-03 12:29:54'),
(6, 'Director', 'Big show', '16', '1', '', 'Test Declaration', 'REQ-105', '2023-04-03', '123456789101', 'New', 'Triple H', '1999-07-15', '24', '1', 'Puducherry', 'Puducherry', 'Puducherry', '8', '8', 'MG road', '9565654654', '', 'Roman reigns', 'Nikki', '1', 'Manju warrior', '4', 'Uzhavan', 'pexels-hansen-tang-13435926.jpg', '5', 'Furniture', '', '', '', '20000', '1', '15000', NULL, '5', '1', '25', '1', '1', '2023-04-03 12:35:27', '0000-00-00 00:00:00'),
(7, 'Agent', 'Darling & Co', '28', '0', '', 'Test Declaration', 'REQ-106', '2023-04-03', '123456789102', 'New', 'Swetha', '2005-05-02', '18', '2', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'Pudhu street', '9694999999', '', 'Thookudurai', 'Niranjana', '2', '', '4', 'Actor', 'wallpaperflare.com_wallpaper.jpg', '2', 'Business', '300000', '10000', '3.3', '290000', '1', '67666', '', '0', '0', '24', '24', NULL, '2023-04-03 12:50:01', '0000-00-00 00:00:00'),
(10, 'Director', 'Big show', '', '1', '', 'Declaration', 'REQ-107', '2023-04-03', '123456789101', 'Existing', 'Triple H', '1999-07-15', '24', '1', 'Puducherry', 'Puducherry', 'Puducherry', '8', '8', 'MG road', '9565654654', '', 'Roman reigns', 'Nikki', '1', 'Manju warrior', '4', 'Uzhavan', 'pexels-hansen-tang-13435926.jpg', '5', 'Furniture', '', '', '', '40000', '1', '5333', '', '4', '0', '25', '25', NULL, '2023-04-03 16:31:07', '2023-04-03 16:31:07'),
(11, 'Staff', 'Kumar', '28', '', 'test remarks', '', 'REQ-108', '2023-04-03', '123456789101', 'Existing', 'Triple H', '1999-07-15', '24', '1', 'Puducherry', 'Puducherry', 'Puducherry', '8', '8', 'MG road', '9565654654', '', 'Roman reigns', 'Nikki', '1', 'Manju warrior', '4', 'Uzhavan', 'pexels-hansen-tang-13435926.jpg', '2', 'Business', '50000', '5000', '10.0', '45000', '2', '', '24', '4', '0', '21', '21', NULL, '2023-04-03 16:34:56', '2023-04-03 16:34:56'),
(12, 'Agent', 'Darling & Co', '28', '0', '', 'Declaration', 'REQ-109', '2023-04-04', '546546546465', 'Existing', 'Kuppusamy', '2023-03-29', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9646465546', '94654654', 'Karuppan', 'Jekkamma', '2', '', '2', 'KMC', 'pexels-jakub-novacek-924824.jpg', '2', 'Business', '24234', '34', '0.1', '24200', '1', '343434', '', '0', '0', '24', '24', NULL, '2023-04-04 10:51:47', '0000-00-00 00:00:00'),
(13, 'Agent', 'Darling & Co', '28', '1', '', 'Test Declaration', 'REQ-110', '2023-04-04', '963852741123', 'New', 'Kumaran', '2023-03-16', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '2353645675', '', 'Eeswaran', 'Mahalakshmi', '1', 'Mythili', '7', 'Boxer', 'WhatsApp Image 2023-01-20 at 11.43.56 AM.jpeg', '2', 'Business', '15000', '1000', '6.7', '14000', '1', '1000', '', '0', '0', '24', NULL, NULL, '2023-04-04 12:28:32', '2023-04-04 12:28:32'),
(14, 'Agent', 'Darling & Co', '28', '1', '', 'Test Declaration', 'REQ-111', '2023-04-05', '546546546465', 'Existing', 'Kuppusamy', '2023-03-29', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9646465546', '94654654', 'Karuppan', 'Jekkamma', '2', '', '2', 'KMC', 'pexels-jakub-novacek-924824.jpg', '2', 'Business', '234345', '234', '0.1', '234111', '1', '43', '', '0', '0', '24', NULL, NULL, '2023-04-05 16:53:21', '2023-04-05 16:53:21'),
(15, 'Staff', 'Kumar', '28', '', 'Remarks', '', 'REQ-112', '2023-04-06', '546546546465', 'Existing', 'Kuppusamy', '2023-03-29', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9646465546', '94654654', 'Karuppan', 'Jekkamma', '2', '', '2', 'KMC', 'pexels-jakub-novacek-924824.jpg', '2', 'Business', '80000', '15000', '18.8', '65000', '1', '1000', '', '1', '0', '21', NULL, NULL, '2023-04-06 12:55:46', '2023-04-06 12:55:46'),
(16, 'Agent', 'Darling & Co', '28', '1', '', 'Test', 'REQ-113', '2023-04-10', '963852741236', 'New', 'Ambi', '2023-03-31', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '6', '10', 'bussy street', '9654811325', '9456465465', 'Parthasarathy Iyengar', 'Susheela', '2', '', '7', 'Anniyan', 'images.jpg', '2', 'Business', '15000', '100', '0.7', '14900', '1', '1500', '', '1', '0', '24', NULL, NULL, '2023-04-10 15:01:23', '2023-04-10 15:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `staff_creation`
--

CREATE TABLE `staff_creation` (
  `staff_id` int(11) NOT NULL,
  `staff_code` varchar(255) DEFAULT NULL,
  `staff_name` varchar(255) DEFAULT NULL,
  `staff_type` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `taluk` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `mobile1` varchar(255) DEFAULT NULL,
  `mobile2` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `cug_no` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `team` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT '0',
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `staff_creation`
--

INSERT INTO `staff_creation` (`staff_id`, `staff_code`, `staff_name`, `staff_type`, `address`, `state`, `district`, `taluk`, `place`, `pincode`, `mail`, `mobile1`, `mobile2`, `whatsapp`, `cug_no`, `company_id`, `department`, `team`, `designation`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(5, 'ST-101', 'Kumar', '3', 'bussy street', 'Puducherry', 'Puducherry', 'Oulgaret', 'Pondicherry', '234544', '', '', '', '', '23235', '1', 'HR', 'WildFire', 'CH', '0', '1', '1', NULL, '2023-03-18 16:01:01', '2023-03-18 16:08:13'),
(6, 'ST-102', 'Lalitha', '4', 'A 1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vandavasi', '606565', '', '', '', '', '1234234', '2', 'Sales', 'AirCraft', 'Senior', '0', '1', '1', NULL, '2023-03-18 16:07:42', '2023-03-18 16:08:21');

-- --------------------------------------------------------

--
-- Table structure for table `staff_type_creation`
--

CREATE TABLE `staff_type_creation` (
  `staff_type_id` int(11) NOT NULL,
  `staff_type_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `staff_type_creation`
--

INSERT INTO `staff_type_creation` (`staff_type_id`, `staff_type_name`, `status`) VALUES
(1, 'Test Staff type', '1'),
(2, 'gfhgj', '1'),
(3, 'Junior', '0'),
(4, 'Senior', '0');

-- --------------------------------------------------------

--
-- Table structure for table `sub_area_list_creation`
--

CREATE TABLE `sub_area_list_creation` (
  `sub_area_id` int(11) NOT NULL,
  `area_id_ref` varchar(255) DEFAULT NULL,
  `sub_area_name` varchar(255) DEFAULT NULL,
  `sub_area_enable` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sub_area_list_creation`
--

INSERT INTO `sub_area_list_creation` (`sub_area_id`, `area_id_ref`, `sub_area_name`, `sub_area_enable`, `status`) VALUES
(1, '1', 'Gandhi Road', 0, '0'),
(2, '1', 'Pottinaidu Street', 0, '0'),
(3, '1', 'Pudhu Street', 0, '0'),
(4, '2', 'Theradi', 1, '0'),
(5, '2', 'Arni Road', 0, '0'),
(6, '1', 'Gandhi Street', 0, '1'),
(7, '8', 'Bussy street', 0, '0'),
(8, '8', 'MG road', 0, '0'),
(9, '8', 'Nehru street', 0, '0'),
(10, '6', 'Birdhur area 1', 0, '0'),
(11, '6', 'Birdhur area 2', 0, '0'),
(12, '6', 'Birdhur area 3', 0, '0'),
(13, '7', 'Birdhur Colony', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `emailid` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `role_type` varchar(255) DEFAULT NULL,
  `dir_id` varchar(255) DEFAULT NULL,
  `ag_id` varchar(255) DEFAULT NULL,
  `staff_id` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `agentforstaff` varchar(255) DEFAULT NULL,
  `line_id` varchar(255) DEFAULT NULL,
  `group_id` varchar(255) DEFAULT NULL,
  `mastermodule` varchar(255) DEFAULT '1',
  `company_creation` varchar(255) DEFAULT '1',
  `branch_creation` varchar(255) DEFAULT '1',
  `loan_category` varchar(255) DEFAULT '1',
  `loan_calculation` varchar(255) DEFAULT '1',
  `loan_scheme` varchar(255) DEFAULT '1',
  `area_creation` varchar(255) DEFAULT '1',
  `area_mapping` varchar(255) DEFAULT '1',
  `area_approval` varchar(255) DEFAULT '1',
  `adminmodule` varchar(255) DEFAULT '1',
  `director_creation` varchar(255) DEFAULT '1',
  `agent_creation` varchar(255) DEFAULT '1',
  `staff_creation` varchar(255) DEFAULT '1',
  `manage_user` varchar(255) DEFAULT '1',
  `doc_mapping` varchar(255) NOT NULL DEFAULT '1',
  `requestmodule` varchar(255) DEFAULT '1',
  `request` varchar(255) DEFAULT '1',
  `verificationmodule` varchar(255) DEFAULT '1',
  `verification` varchar(255) DEFAULT '1',
  `status` varchar(255) NOT NULL DEFAULT '0',
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `fullname`, `title`, `emailid`, `user_name`, `user_password`, `role`, `role_type`, `dir_id`, `ag_id`, `staff_id`, `company_id`, `branch_id`, `agentforstaff`, `line_id`, `group_id`, `mastermodule`, `company_creation`, `branch_creation`, `loan_category`, `loan_calculation`, `loan_scheme`, `area_creation`, `area_mapping`, `area_approval`, `adminmodule`, `director_creation`, `agent_creation`, `staff_creation`, `manage_user`, `doc_mapping`, `requestmodule`, `request`, `verificationmodule`, `verification`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(1, 'Super', 'Admin', 'Super Admin', 'Super Admin', 'support@feathertechnology.in', 'support@feathertechnology.in', 'admin@123', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, NULL, NULL, '2021-04-17 17:08:00', '2023-03-21 09:51:34'),
(21, NULL, NULL, 'Kumar', NULL, '', 'kumar@gmail.com', '123', '3', '3', '', '', '5', '1', '1,2', '28,29', '1,2,4', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', NULL, '2023-03-21 12:23:50', '0000-00-00 00:00:00'),
(24, NULL, NULL, 'Darling & Co', NULL, '', 'darling@gmail.com', '123', '2', '', '', '28', '', '1', '1', '', '1', '1,5', '0', '1', '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '1', '1', '1', '2023-03-21 15:12:31', '0000-00-00 00:00:00'),
(25, NULL, NULL, 'Big show', NULL, '', 'bigshow@gmail.com', '123', '1', '12', '3', '', '', '1', '1,2', '', '1,2,3', '6', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '25', NULL, '2023-03-31 12:03:21', '0000-00-00 00:00:00'),
(27, NULL, NULL, 'Alangar', NULL, 'test1@email.com', 'test1@email.com', '123', '2', '', '', '16', '', '1', '2', '', '', '6', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '1', NULL, NULL, '2023-04-10 15:32:34', '2023-04-10 15:32:34');

-- --------------------------------------------------------

--
-- Table structure for table `verification_bank_info`
--

CREATE TABLE `verification_bank_info` (
  `id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `acc_holder_name` varchar(100) NOT NULL,
  `acc_no` bigint(20) NOT NULL,
  `ifsc_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verification_bank_info`
--

INSERT INTO `verification_bank_info` (`id`, `req_id`, `bank_name`, `branch_name`, `acc_holder_name`, `acc_no`, `ifsc_code`) VALUES
(6, 4, 'Indian Bank', 'Pondicherry', 'Jegatheesh', 5464654321321321, 'IB314654');

-- --------------------------------------------------------

--
-- Table structure for table `verification_family_info`
--

CREATE TABLE `verification_family_info` (
  `id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `famname` varchar(100) NOT NULL,
  `relationship` text NOT NULL,
  `other_remark` varchar(100) DEFAULT NULL,
  `other_address` varchar(200) DEFAULT NULL,
  `relation_age` int(11) NOT NULL,
  `relation_aadhar` varchar(50) NOT NULL,
  `relation_Mobile` double NOT NULL,
  `relation_Occupation` text NOT NULL,
  `relation_Income` double NOT NULL,
  `relation_Blood` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verification_family_info`
--

INSERT INTO `verification_family_info` (`id`, `req_id`, `famname`, `relationship`, `other_remark`, `other_address`, `relation_age`, `relation_aadhar`, `relation_Mobile`, `relation_Occupation`, `relation_Income`, `relation_Blood`, `status`) VALUES
(23, 5, 'Arun', 'Father', '', '', 25, '2343-5345-5625', 9654566456, 'IT', 6554454, 'A', 0),
(24, 5, 'Kumari', 'Mother', '', '', 23, '4654 6546 5465', 9654654654, 'IT', 150000, 'B', 0),
(25, 4, 'Jegatheesh', 'Brother', '', ' ', 15, '5646-5465-4654', 1565465465, 'School', 0, 'o', 0),
(26, 5, 'Kumar', 'Brother', '', ' ', 25, '9846 5131 6546', 98465654, 'ds', 5432, 'df', 0);

-- --------------------------------------------------------

--
-- Table structure for table `verification_group_info`
--

CREATE TABLE `verification_group_info` (
  `id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `group_age` int(11) NOT NULL,
  `group_aadhar` text NOT NULL,
  `group_mobile` double NOT NULL,
  `group_gender` text NOT NULL,
  `group_designation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verification_group_info`
--

INSERT INTO `verification_group_info` (`id`, `req_id`, `group_name`, `group_age`, `group_aadhar`, `group_mobile`, `group_gender`, `group_designation`) VALUES
(8, 5, 'Arun', 15, '5646 5465 4654', 9456465465, '1', 'TL'),
(9, 5, 'Kumari', 23, '9846 5465 3213', 9465432132, '2', 'Employe'),
(10, 4, 'Jegatheesh', 36, '1846 5465 6546', 9465451321, '1', 'TL');

-- --------------------------------------------------------

--
-- Table structure for table `verification_kyc_info`
--

CREATE TABLE `verification_kyc_info` (
  `id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `proofOf` varchar(50) NOT NULL,
  `proof_type` varchar(50) NOT NULL,
  `proof_no` varchar(50) NOT NULL,
  `upload` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verification_kyc_info`
--

INSERT INTO `verification_kyc_info` (`id`, `req_id`, `proofOf`, `proof_type`, `proof_no`, `upload`) VALUES
(22, 5, '0', '2', '123456', 'Order_ID_4479904631.jpg'),
(26, 5, '2', '7', '666666', 'pexels-jakub-novacek-924824.jpg'),
(27, 4, '0', '1', '6846431321321', 'Order_ID_4479904631.jpg'),
(28, 4, '0', '4', '646543545', 'images.jpg'),
(29, 4, '1', '4', '84654564', '1451868.png');

-- --------------------------------------------------------

--
-- Table structure for table `verification_property_info`
--

CREATE TABLE `verification_property_info` (
  `id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `property_type` varchar(50) NOT NULL,
  `property_measurement` varchar(50) NOT NULL,
  `property_value` varchar(50) NOT NULL,
  `property_holder` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verification_property_info`
--

INSERT INTO `verification_property_info` (`id`, `req_id`, `property_type`, `property_measurement`, `property_value`, `property_holder`) VALUES
(9, 5, 'Land', '1 acre', '123331', 'Arun'),
(10, 4, 'House', '10*10', '15000', 'Jegatheesh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountsgroup`
--
ALTER TABLE `accountsgroup`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `agent_communication_details`
--
ALTER TABLE `agent_communication_details`
  ADD PRIMARY KEY (`comm_id`);

--
-- Indexes for table `agent_creation`
--
ALTER TABLE `agent_creation`
  ADD PRIMARY KEY (`ag_id`);

--
-- Indexes for table `agent_group_creation`
--
ALTER TABLE `agent_group_creation`
  ADD PRIMARY KEY (`agent_group_id`);

--
-- Indexes for table `area_creation`
--
ALTER TABLE `area_creation`
  ADD PRIMARY KEY (`area_creation_id`);

--
-- Indexes for table `area_group_mapping`
--
ALTER TABLE `area_group_mapping`
  ADD PRIMARY KEY (`map_id`);

--
-- Indexes for table `area_line_mapping`
--
ALTER TABLE `area_line_mapping`
  ADD PRIMARY KEY (`map_id`);

--
-- Indexes for table `area_list_creation`
--
ALTER TABLE `area_list_creation`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `branch_creation`
--
ALTER TABLE `branch_creation`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `company_creation`
--
ALTER TABLE `company_creation`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `costcentre`
--
ALTER TABLE `costcentre`
  ADD PRIMARY KEY (`costcentreid`);

--
-- Indexes for table `customer_profile`
--
ALTER TABLE `customer_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_register`
--
ALTER TABLE `customer_register`
  ADD PRIMARY KEY (`cus_reg_id`);

--
-- Indexes for table `director_creation`
--
ALTER TABLE `director_creation`
  ADD PRIMARY KEY (`dir_id`);

--
-- Indexes for table `doc_mapping`
--
ALTER TABLE `doc_mapping`
  ADD PRIMARY KEY (`doc_map_id`);

--
-- Indexes for table `in_verification`
--
ALTER TABLE `in_verification`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`ledgerid`);

--
-- Indexes for table `loan_calculation`
--
ALTER TABLE `loan_calculation`
  ADD PRIMARY KEY (`loan_cal_id`);

--
-- Indexes for table `loan_category`
--
ALTER TABLE `loan_category`
  ADD PRIMARY KEY (`loan_category_id`);

--
-- Indexes for table `loan_category_creation`
--
ALTER TABLE `loan_category_creation`
  ADD PRIMARY KEY (`loan_category_creation_id`);

--
-- Indexes for table `loan_category_ref`
--
ALTER TABLE `loan_category_ref`
  ADD PRIMARY KEY (`loan_category_ref_id`);

--
-- Indexes for table `loan_scheme`
--
ALTER TABLE `loan_scheme`
  ADD PRIMARY KEY (`scheme_id`);

--
-- Indexes for table `purpose`
--
ALTER TABLE `purpose`
  ADD PRIMARY KEY (`purposeid`);

--
-- Indexes for table `request_category_info`
--
ALTER TABLE `request_category_info`
  ADD PRIMARY KEY (`cat_info`);

--
-- Indexes for table `request_creation`
--
ALTER TABLE `request_creation`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `staff_creation`
--
ALTER TABLE `staff_creation`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `staff_type_creation`
--
ALTER TABLE `staff_type_creation`
  ADD PRIMARY KEY (`staff_type_id`);

--
-- Indexes for table `sub_area_list_creation`
--
ALTER TABLE `sub_area_list_creation`
  ADD PRIMARY KEY (`sub_area_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `verification_bank_info`
--
ALTER TABLE `verification_bank_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification_family_info`
--
ALTER TABLE `verification_family_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification_group_info`
--
ALTER TABLE `verification_group_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification_kyc_info`
--
ALTER TABLE `verification_kyc_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification_property_info`
--
ALTER TABLE `verification_property_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountsgroup`
--
ALTER TABLE `accountsgroup`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `agent_communication_details`
--
ALTER TABLE `agent_communication_details`
  MODIFY `comm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `agent_creation`
--
ALTER TABLE `agent_creation`
  MODIFY `ag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `agent_group_creation`
--
ALTER TABLE `agent_group_creation`
  MODIFY `agent_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `area_creation`
--
ALTER TABLE `area_creation`
  MODIFY `area_creation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `area_group_mapping`
--
ALTER TABLE `area_group_mapping`
  MODIFY `map_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `area_line_mapping`
--
ALTER TABLE `area_line_mapping`
  MODIFY `map_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `area_list_creation`
--
ALTER TABLE `area_list_creation`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `branch_creation`
--
ALTER TABLE `branch_creation`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company_creation`
--
ALTER TABLE `company_creation`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `costcentre`
--
ALTER TABLE `costcentre`
  MODIFY `costcentreid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_register`
--
ALTER TABLE `customer_register`
  MODIFY `cus_reg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `director_creation`
--
ALTER TABLE `director_creation`
  MODIFY `dir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doc_mapping`
--
ALTER TABLE `doc_mapping`
  MODIFY `doc_map_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `in_verification`
--
ALTER TABLE `in_verification`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `ledgerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loan_calculation`
--
ALTER TABLE `loan_calculation`
  MODIFY `loan_cal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loan_category`
--
ALTER TABLE `loan_category`
  MODIFY `loan_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `loan_category_creation`
--
ALTER TABLE `loan_category_creation`
  MODIFY `loan_category_creation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `loan_category_ref`
--
ALTER TABLE `loan_category_ref`
  MODIFY `loan_category_ref_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `loan_scheme`
--
ALTER TABLE `loan_scheme`
  MODIFY `scheme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purpose`
--
ALTER TABLE `purpose`
  MODIFY `purposeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request_category_info`
--
ALTER TABLE `request_category_info`
  MODIFY `cat_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `request_creation`
--
ALTER TABLE `request_creation`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `staff_creation`
--
ALTER TABLE `staff_creation`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff_type_creation`
--
ALTER TABLE `staff_type_creation`
  MODIFY `staff_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_area_list_creation`
--
ALTER TABLE `sub_area_list_creation`
  MODIFY `sub_area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `verification_bank_info`
--
ALTER TABLE `verification_bank_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `verification_family_info`
--
ALTER TABLE `verification_family_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `verification_group_info`
--
ALTER TABLE `verification_group_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `verification_kyc_info`
--
ALTER TABLE `verification_kyc_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `verification_property_info`
--
ALTER TABLE `verification_property_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
