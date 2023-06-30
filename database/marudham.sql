-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2023 at 02:50 PM
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
-- Table structure for table `acknowledgement_loan_cal_category`
--

CREATE TABLE `acknowledgement_loan_cal_category` (
  `cat_id` int(11) NOT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `loan_cal_id` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acknowlegement_customer_profile`
--

CREATE TABLE `acknowlegement_customer_profile` (
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
  `area_group` varchar(255) DEFAULT NULL,
  `area_line` varchar(255) DEFAULT NULL,
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
-- Table structure for table `acknowlegement_documentation`
--

CREATE TABLE `acknowlegement_documentation` (
  `id` int(11) NOT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `cus_id_doc` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `cus_profile_id` varchar(255) DEFAULT NULL,
  `doc_id` varchar(255) DEFAULT NULL,
  `mortgage_process` varchar(100) DEFAULT NULL,
  `mortgage_process_noc` varchar(10) NOT NULL DEFAULT '0',
  `Propertyholder_type` varchar(100) DEFAULT NULL,
  `Propertyholder_name` varchar(255) DEFAULT NULL,
  `Propertyholder_relationship_name` varchar(100) DEFAULT NULL,
  `doc_property_relation` varchar(100) DEFAULT NULL,
  `doc_property_type` varchar(255) DEFAULT NULL,
  `doc_property_measurement` varchar(255) DEFAULT NULL,
  `doc_property_location` varchar(255) DEFAULT NULL,
  `doc_property_value` varchar(255) DEFAULT NULL,
  `mortgage_name` varchar(255) DEFAULT NULL,
  `mortgage_dsgn` varchar(255) DEFAULT NULL,
  `mortgage_nuumber` varchar(255) DEFAULT NULL,
  `reg_office` varchar(255) DEFAULT NULL,
  `mortgage_value` varchar(255) DEFAULT NULL,
  `mortgage_document` varchar(255) DEFAULT NULL,
  `mortgage_document_noc` varchar(10) NOT NULL DEFAULT '0',
  `mortgage_document_used` varchar(10) NOT NULL DEFAULT '0',
  `mortgage_document_upd` varchar(255) DEFAULT NULL,
  `mortgage_document_pending` varchar(150) DEFAULT NULL,
  `endorsement_process` varchar(50) DEFAULT NULL,
  `endorsement_process_noc` varchar(10) NOT NULL DEFAULT '0',
  `owner_type` varchar(100) DEFAULT NULL,
  `owner_name` varchar(200) DEFAULT NULL,
  `ownername_relationship_name` varchar(100) DEFAULT NULL,
  `en_relation` varchar(100) DEFAULT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `vehicle_process` varchar(50) DEFAULT NULL,
  `en_Company` varchar(200) DEFAULT NULL,
  `en_Model` varchar(200) DEFAULT NULL,
  `vehicle_reg_no` varchar(150) DEFAULT NULL,
  `endorsement_name` varchar(255) DEFAULT NULL,
  `en_RC` varchar(50) DEFAULT NULL,
  `en_RC_noc` varchar(10) NOT NULL DEFAULT '0',
  `en_RC_used` varchar(10) NOT NULL DEFAULT '0',
  `Rc_document_upd` varchar(255) DEFAULT NULL,
  `Rc_document_pending` varchar(150) DEFAULT NULL,
  `en_Key` varchar(50) DEFAULT NULL,
  `en_Key_noc` varchar(10) NOT NULL DEFAULT '0',
  `en_Key_used` varchar(10) NOT NULL DEFAULT '0',
  `gold_info` varchar(50) DEFAULT NULL,
  `gold_sts` varchar(50) DEFAULT NULL,
  `gold_type` varchar(255) DEFAULT NULL,
  `Purity` varchar(255) DEFAULT NULL,
  `gold_Count` varchar(255) DEFAULT NULL,
  `gold_Weight` varchar(255) DEFAULT NULL,
  `gold_Value` varchar(255) DEFAULT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `document_details` varchar(255) DEFAULT NULL,
  `document_type` varchar(50) DEFAULT NULL,
  `doc_info_upload` varchar(255) DEFAULT NULL,
  `doc_info_upload_noc` varchar(10) NOT NULL DEFAULT '0',
  `doc_info_upload_used` varchar(10) NOT NULL DEFAULT '0',
  `document_holder` varchar(50) DEFAULT NULL,
  `docholder_name` varchar(255) DEFAULT NULL,
  `docholder_relationship_name` varchar(50) DEFAULT NULL,
  `doc_relation` varchar(50) DEFAULT NULL,
  `cus_status` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `submitted` varchar(10) DEFAULT NULL,
  `insert_login_id` varchar(50) DEFAULT NULL,
  `update_login_id` varchar(50) DEFAULT NULL,
  `delete_login_id` varchar(50) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acknowlegement_loan_calculation`
--

CREATE TABLE `acknowlegement_loan_calculation` (
  `loan_cal_id` int(11) NOT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `cus_id_loan` varchar(255) DEFAULT NULL,
  `cus_name_loan` varchar(255) DEFAULT NULL,
  `cus_data_loan` varchar(255) DEFAULT NULL,
  `mobile_loan` varchar(255) DEFAULT NULL,
  `pic_loan` varchar(255) DEFAULT NULL,
  `loan_category` varchar(255) DEFAULT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `tot_value` varchar(255) DEFAULT NULL,
  `ad_amt` varchar(255) DEFAULT NULL,
  `loan_amt` varchar(255) DEFAULT NULL,
  `profit_type` varchar(255) DEFAULT NULL,
  `due_method_calc` varchar(255) DEFAULT NULL,
  `due_type` varchar(255) DEFAULT NULL,
  `profit_method` varchar(255) DEFAULT NULL,
  `calc_method` varchar(255) DEFAULT NULL,
  `due_method_scheme` varchar(255) DEFAULT NULL,
  `day_scheme` varchar(255) DEFAULT NULL,
  `scheme_name` varchar(255) DEFAULT NULL,
  `int_rate` varchar(255) DEFAULT NULL,
  `due_period` varchar(255) DEFAULT NULL,
  `doc_charge` varchar(255) DEFAULT NULL,
  `proc_fee` varchar(255) DEFAULT NULL,
  `loan_amt_cal` varchar(255) DEFAULT NULL,
  `principal_amt_cal` varchar(255) DEFAULT NULL,
  `int_amt_cal` varchar(255) DEFAULT NULL,
  `tot_amt_cal` varchar(255) DEFAULT NULL,
  `due_amt_cal` varchar(255) DEFAULT NULL,
  `doc_charge_cal` varchar(255) DEFAULT NULL,
  `proc_fee_cal` varchar(255) DEFAULT NULL,
  `net_cash_cal` varchar(255) DEFAULT NULL,
  `due_start_from` varchar(255) DEFAULT NULL,
  `maturity_month` varchar(255) DEFAULT NULL,
  `collection_method` varchar(255) DEFAULT NULL,
  `cus_status` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp(),
  `update_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(1, 'Home Appliance', '0'),
(2, 'Digital products', '0'),
(3, 'Home appliances & Digital products', '0'),
(4, 'Two wheeler', '0'),
(5, 'Gold loan', '0'),
(6, 'DCC', '0'),
(7, 'Agent Broker', '0'),
(8, 'Sky', '0'),
(9, 'Education Loan', '0'),
(10, 'XYZ', '0'),
(11, 'Finance R', '0'),
(12, 'Gold Agent R', '0');

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
(1, '1', '1,5,2,4,3', 'Vandavasi', 'Tiruvannamalai', 'TamilNadu', '604408', '', 0, '1', '1', NULL, '2023-05-10 15:30:08', '2023-05-11 18:00:35'),
(2, '2', '7,6,9,8,10', 'Uthiramerur', 'Kancheepuram', 'TamilNadu', '603406', '0', 0, '1', NULL, NULL, '2023-05-11 18:04:28', NULL),
(3, '3', '15,16,11,13,12,14', 'Chetpet', 'Tiruvannamalai', 'TamilNadu', '600031', '0', 1, '1', NULL, '1', '2023-05-11 18:07:03', NULL),
(4, '3', '15,16,11,13,12,14', 'Chetpet', 'Tiruvannamalai', 'TamilNadu', '600031', '0', 0, '1', NULL, NULL, '2023-05-11 18:07:08', NULL),
(5, '4', '17', 'Vandavasi', 'Tiruvannamalai', 'TamilNadu', '604407', '0', 0, '1', NULL, NULL, '2023-05-12 15:57:37', NULL),
(6, '6', '20,19,18', 'Vandavasi', 'Tiruvannamalai', 'TamilNadu', '604408', '0', 0, '1', NULL, NULL, '2023-05-12 15:59:09', NULL),
(7, '8', '22,21', 'Vandavasi', 'Tiruvannamalai', 'TamilNadu', '604405', '0', 0, '1', NULL, NULL, '2023-05-12 16:00:31', NULL),
(8, '7', '23', 'Vandavasi', 'Tiruvannamalai', 'TamilNadu', '604404', '0', 0, '1', NULL, NULL, '2023-05-12 16:16:34', NULL),
(9, '5', '24,25', 'Vandavasi', 'Tiruvannamalai', 'TamilNadu', '604407', '0', 0, '1', NULL, NULL, '2023-05-12 16:17:55', NULL);

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
(1, 'Apple', '1', '1,2,3,4,5', '1', '3', '0', '1', '1', NULL, '2023-05-10 15:30:27', '2023-05-12 12:31:25'),
(2, 'Watermelon', '2', '6,7,9', '1', '2', '0', '1', '1', NULL, '2023-05-11 18:14:02', '2023-05-12 12:32:33'),
(3, 'Watermelon 2', '2', '8,10', '1', '2', '0', '1', '1', NULL, '2023-05-11 18:14:20', '2023-05-12 12:33:08'),
(4, 'Mango', '3', '11,12,13,14,15,16', '1', '1', '0', '1', '1', NULL, '2023-05-11 18:14:49', '2023-05-12 12:33:38'),
(5, 'GA 1', '4,5,6,7,8', '17,18,19,20,21,22,23,24,25', '1', '3', '0', '1', '1', NULL, '2023-05-12 16:22:16', '2023-05-12 16:22:34');

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
(1, 'Banana 1', '1', '1,5', '1', '3', '0', '1', '1', NULL, '2023-05-11 18:12:10', '2023-05-12 12:34:15'),
(2, 'Banana 2', '1', '2,3,4', '1', '3', '0', '1', '1', NULL, '2023-05-11 18:12:41', '2023-05-12 12:35:03'),
(3, 'Jackfruit', '2', '6,7,8,9,10', '1', '2', '0', '1', '1', NULL, '2023-05-11 18:21:27', '2023-05-12 12:36:02'),
(4, 'Pine apple 1', '3', '15,16', '1', '1', '0', '1', '1', NULL, '2023-05-11 18:22:00', '2023-05-12 12:36:48'),
(5, 'Pine apple 2', '3', '11,12,13,14', '1', '1', '0', '1', '1', NULL, '2023-05-11 18:22:28', '2023-05-12 12:37:02'),
(6, 'LA1', '4,5,6,7,8', '17,18,19,20,21,22,23,24,25', '1', '3', '0', '1', NULL, NULL, '2023-05-12 16:21:49', '2023-05-12 16:21:49');

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
(2, 'Uthiramerur', 'Uthiramerur', 0, 0),
(3, 'Chetpet', 'Chetpet', 0, 0),
(4, 'Purisai', 'Vandavasi', 0, 0),
(5, 'Echur', 'Vandavasi', 0, 0),
(6, 'Ponnur', 'Vandavasi', 0, 0),
(7, 'Manamathy', 'Vandavasi', 0, 0),
(8, 'Thellar', 'Vandavasi', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bank_creation`
--

CREATE TABLE `bank_creation` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `bank_name` varchar(255) DEFAULT NULL,
  `short_name` varchar(255) NOT NULL,
  `acc_no` varchar(255) DEFAULT NULL,
  `ifsc` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `gpay` varchar(255) DEFAULT NULL,
  `company` varchar(255) NOT NULL,
  `under_branch` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT '0',
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bank_creation`
--

INSERT INTO `bank_creation` (`id`, `bank_name`, `short_name`, `acc_no`, `ifsc`, `branch`, `qr_code`, `gpay`, `company`, `under_branch`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(1, 'City Union Bank', 'CUB', '6541348435987', 'CUB001654', 'Chennai', '', '', '1', '2', '0', '1', NULL, NULL, '2023-06-30 12:13:08', '2023-06-30 12:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `bank_stmt`
--

CREATE TABLE `bank_stmt` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `bank_id` varchar(255) DEFAULT NULL,
  `trans_date` date DEFAULT NULL,
  `narration` varchar(255) NOT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `credit` varchar(255) DEFAULT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `clr_status` varchar(10) NOT NULL DEFAULT '0' COMMENT '0 - unclear,1-cleared',
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(1, 'M-101', 'Chetpet', '1', '9944430311', 'Chetpet', '', '', 'Chetpet', '606801', 'mcchetpet@gmail.com', '', 'TamilNadu', 'Tiruvannamalai', 'Chetpet', 0, 1, NULL, NULL, '2023-06-30 10:25:34', '2023-06-30 10:25:34'),
(2, 'M-102', 'Uthiramerur', '1', '9944430322', 'No 26', '', '', 'Uthiramerur', '603406', 'mcuthiramerur@gmail.com', '', 'TamilNadu', 'Kancheepuram', 'Kancheepuram', 0, 1, 1, NULL, '2023-06-30 10:25:34', '2023-06-30 10:25:34'),
(3, 'M-103', 'Vandavasi', '1', '9944430300', 'NO.25', '', '', 'Vandavasi', '604408', 'marudhamcapitals@gmail.com', '', 'TamilNadu', 'Tiruvannamalai', 'Thiruvannamalai', 0, 1, 1, NULL, '2023-06-30 10:25:34', '2023-06-30 10:25:34'),
(4, 'M-104', 'Polur', '2', '9842398422', 'Polur', '', '984398422', 'Tiruvannamalai road', '632601', 'polur@marudhamcapitals.com', '0442102103', 'TamilNadu', 'Tiruvannamalai', 'Polur', 0, 1, 1, NULL, '2023-06-30 10:25:34', '2023-06-30 10:25:34'),
(6, 'R-106', 'R Uzhavan Vsi', '4', '994430300', '25 Gandhi road Vandavasi', '', '994430300', 'vandavasi', '604408', 'Ruzhavan@gmail.com', '0418222222', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 0, 1, 1, NULL, '2023-06-30 10:25:34', '2023-06-30 10:25:34'),
(7, 'M-107', 'Vandavasi', '5', '9944430300', '25 Gandhi road Vandavasi', '', '9944430300', 'Vandavasi', '604408', 'www.vsimarudhamgolds.com', '0418222222', 'TamilNadu', 'Tiruvannamalai', 'Thiruvannamalai', 0, 1, NULL, NULL, '2023-06-30 10:25:34', '2023-06-30 10:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `cash_tally`
--

CREATE TABLE `cash_tally` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `op_hand` varchar(255) DEFAULT NULL,
  `op_date` varchar(10) NOT NULL,
  `op_bank` varchar(255) DEFAULT NULL,
  `op_agent` varchar(255) DEFAULT NULL,
  `opening_bal` varchar(255) DEFAULT NULL,
  `cl_date` varchar(10) NOT NULL,
  `cl_hand` varchar(255) DEFAULT NULL,
  `cl_bank` varchar(255) DEFAULT NULL,
  `bank_untrkd` varchar(255) NOT NULL,
  `cl_agent` varchar(255) DEFAULT NULL,
  `closing_bal` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_tally_modes`
--

CREATE TABLE `cash_tally_modes` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `modes` varchar(255) DEFAULT NULL,
  `admin_access` varchar(10) NOT NULL DEFAULT '1',
  `handcredit` varchar(10) NOT NULL DEFAULT '1',
  `bankcredit` varchar(10) NOT NULL DEFAULT '1',
  `handdebit` varchar(10) NOT NULL DEFAULT '1',
  `bankdebit` varchar(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cheque_info`
--

CREATE TABLE `cheque_info` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(250) DEFAULT NULL,
  `req_id` varchar(50) DEFAULT NULL,
  `cus_profile_id` varchar(50) DEFAULT NULL,
  `holder_type` varchar(255) DEFAULT NULL,
  `holder_name` varchar(255) DEFAULT NULL,
  `holder_relationship_name` varchar(255) DEFAULT NULL,
  `cheque_relation` varchar(255) DEFAULT NULL,
  `chequebank_name` varchar(255) DEFAULT NULL,
  `cheque_count` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cheque_no_list`
--

CREATE TABLE `cheque_no_list` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(250) DEFAULT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `cheque_table_id` varchar(255) DEFAULT NULL,
  `cheque_holder_type` varchar(255) DEFAULT NULL,
  `cheque_holder_name` varchar(255) DEFAULT NULL,
  `cheque_no` varchar(200) DEFAULT NULL,
  `used_status` varchar(255) NOT NULL DEFAULT '0',
  `noc_given` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cheque_upd`
--

CREATE TABLE `cheque_upd` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(250) DEFAULT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `cheque_table_id` varchar(255) DEFAULT NULL,
  `upload_cheque_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `closed_status`
--

CREATE TABLE `closed_status` (
  `id` int(11) NOT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `closed_sts` varchar(50) DEFAULT NULL,
  `consider_level` varchar(50) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `cus_sts` varchar(50) DEFAULT NULL,
  `insert_login_id` varchar(100) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `coll_id` int(11) NOT NULL COMMENT 'Primary Key',
  `coll_code` varchar(255) DEFAULT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `cus_name` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `sub_area` varchar(255) DEFAULT NULL,
  `line` varchar(255) DEFAULT NULL,
  `loan_category` varchar(255) DEFAULT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `coll_status` varchar(255) DEFAULT NULL,
  `coll_sub_status` varchar(255) DEFAULT NULL,
  `tot_amt` varchar(255) DEFAULT NULL,
  `paid_amt` varchar(255) DEFAULT NULL,
  `bal_amt` varchar(255) DEFAULT NULL,
  `due_amt` varchar(255) DEFAULT NULL,
  `pending_amt` varchar(255) DEFAULT NULL,
  `payable_amt` varchar(255) DEFAULT NULL,
  `penalty` varchar(255) DEFAULT NULL,
  `coll_charge` varchar(255) DEFAULT NULL,
  `coll_mode` varchar(255) DEFAULT NULL,
  `bank_id` varchar(10) NOT NULL,
  `cheque_no` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `trans_date` date DEFAULT NULL,
  `coll_location` varchar(255) DEFAULT NULL,
  `coll_date` datetime DEFAULT current_timestamp(),
  `due_amt_track` varchar(255) NOT NULL DEFAULT '0',
  `penalty_track` varchar(255) NOT NULL DEFAULT '0',
  `coll_charge_track` varchar(255) NOT NULL DEFAULT '0',
  `total_paid_track` varchar(255) NOT NULL DEFAULT '0',
  `pre_close_waiver` varchar(255) NOT NULL DEFAULT '0',
  `penalty_waiver` varchar(255) NOT NULL DEFAULT '0',
  `coll_charge_waiver` varchar(255) NOT NULL DEFAULT '0',
  `total_waiver` varchar(255) NOT NULL DEFAULT '0',
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL COMMENT 'Create Time',
  `updated_date` datetime DEFAULT current_timestamp() COMMENT 'Update Time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collection_charges`
--

CREATE TABLE `collection_charges` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `req_id` varchar(255) DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `coll_date` varchar(255) DEFAULT NULL,
  `coll_purpose` varchar(255) DEFAULT NULL,
  `coll_charge` varchar(255) NOT NULL DEFAULT '0',
  `paid_date` varchar(255) DEFAULT NULL,
  `paid_amnt` varchar(255) DEFAULT '0',
  `waiver_amnt` varchar(255) DEFAULT '0',
  `status` int(11) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL COMMENT 'Create Time',
  `updated_date` datetime DEFAULT current_timestamp() COMMENT 'Update Time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(1, 'Marudham Capitals', 'NO.25', '', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vadavasi', '604408', 'www.marudhamcapitals.in', 'www.marudhamcapitals@gmail.com', '9944430300', '', '', '0', 1, 1, '2023-06-30 10:05:54', '2023-06-30 10:23:15');

-- --------------------------------------------------------

--
-- Table structure for table `concern_creation`
--

CREATE TABLE `concern_creation` (
  `id` int(11) NOT NULL,
  `raising_for` varchar(50) DEFAULT NULL,
  `self_name` varchar(255) DEFAULT NULL,
  `self_code` varchar(150) DEFAULT NULL,
  `staff_name` varchar(255) DEFAULT NULL,
  `staff_dept_name` varchar(255) DEFAULT NULL,
  `staff_team_name` varchar(255) DEFAULT NULL,
  `ag_name` varchar(255) DEFAULT NULL,
  `ag_grp` varchar(255) DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `cus_name` varchar(255) DEFAULT NULL,
  `cus_area` varchar(255) DEFAULT NULL,
  `cus_sub_area` varchar(255) DEFAULT NULL,
  `cus_group` varchar(255) DEFAULT NULL,
  `cus_line` varchar(255) DEFAULT NULL,
  `com_date` varchar(50) DEFAULT NULL,
  `com_code` varchar(50) DEFAULT NULL,
  `branch_name` varchar(50) DEFAULT NULL,
  `concern_to` varchar(50) DEFAULT NULL,
  `to_dept_name` varchar(255) DEFAULT NULL,
  `to_team_name` varchar(255) DEFAULT NULL,
  `com_sub` varchar(50) DEFAULT NULL,
  `com_remark` varchar(255) DEFAULT NULL,
  `com_priority` varchar(10) DEFAULT NULL,
  `staff_assign_to` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `solution_date` varchar(50) DEFAULT NULL,
  `communication` varchar(50) DEFAULT NULL,
  `uploads` varchar(255) DEFAULT NULL,
  `solution_remark` varchar(255) DEFAULT NULL,
  `feedback_date` varchar(10) DEFAULT NULL,
  `feedback_rating` varchar(10) DEFAULT NULL,
  `insert_user_id` varchar(50) DEFAULT NULL,
  `update_user_id` varchar(50) DEFAULT NULL,
  `delete_user_id` varchar(50) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `concern_subject`
--

CREATE TABLE `concern_subject` (
  `concern_sub_id` int(11) NOT NULL,
  `concern_subject` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `insert_user_id` int(11) DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `delete_user_id` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_bank_collection`
--

CREATE TABLE `ct_bank_collection` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `bank_id` varchar(255) DEFAULT NULL,
  `credited_amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_cr_bag`
--

CREATE TABLE `ct_cr_bag` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `ag_id` varchar(10) NOT NULL,
  `bank_id` varchar(255) DEFAULT NULL,
  `ref_code` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_cr_bank_withdraw`
--

CREATE TABLE `ct_cr_bank_withdraw` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `db_ref_id` varchar(255) DEFAULT NULL,
  `ref_code` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `from_bank_id` varchar(20) DEFAULT NULL,
  `cheque_no` varchar(35) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_dae` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_cr_bdeposit`
--

CREATE TABLE `ct_cr_bdeposit` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `bank_id` varchar(255) DEFAULT NULL,
  `ref_code` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `name_id` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `ident` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_cr_bel`
--

CREATE TABLE `ct_cr_bel` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `bank_id` varchar(255) DEFAULT NULL,
  `ref_code` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `name_id` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `ident` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_cr_bexchange`
--

CREATE TABLE `ct_cr_bexchange` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `db_ref_id` varchar(255) DEFAULT NULL,
  `from_bank_id` varchar(10) NOT NULL,
  `to_bank_id` varchar(10) NOT NULL,
  `from_user_id` varchar(10) NOT NULL,
  `to_user_id` varchar(10) NOT NULL,
  `ref_code` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `remark` varchar(255) NOT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_cr_binvest`
--

CREATE TABLE `ct_cr_binvest` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `bank_id` varchar(255) DEFAULT NULL,
  `ref_code` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `name_id` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `ident` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_cr_boti`
--

CREATE TABLE `ct_cr_boti` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `ref_code` varchar(255) DEFAULT NULL,
  `to_bank_id` varchar(10) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_cr_cash_deposit`
--

CREATE TABLE `ct_cr_cash_deposit` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `db_ref_id` varchar(255) DEFAULT NULL,
  `to_bank_id` varchar(20) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `ref_code` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(10) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_cr_hag`
--

CREATE TABLE `ct_cr_hag` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `ag_id` varchar(10) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_cr_hdeposit`
--

CREATE TABLE `ct_cr_hdeposit` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `name_id` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `ident` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_cr_hel`
--

CREATE TABLE `ct_cr_hel` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `name_id` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `ident` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_cr_hexchange`
--

CREATE TABLE `ct_cr_hexchange` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `db_ref_id` varchar(255) DEFAULT NULL,
  `to_user_id` varchar(10) NOT NULL,
  `from_user_id` varchar(10) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_cr_hinvest`
--

CREATE TABLE `ct_cr_hinvest` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `name_id` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `ident` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_cr_hoti`
--

CREATE TABLE `ct_cr_hoti` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `category` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_bag`
--

CREATE TABLE `ct_db_bag` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `ag_id` varchar(10) NOT NULL,
  `bank_id` varchar(255) DEFAULT NULL,
  `ref_code` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_bank_deposit`
--

CREATE TABLE `ct_db_bank_deposit` (
  `id` int(11) NOT NULL,
  `to_bank_id` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `received` int(10) NOT NULL DEFAULT 1,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_bdeposit`
--

CREATE TABLE `ct_db_bdeposit` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `bank_id` varchar(255) DEFAULT NULL,
  `ref_code` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `name_id` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `ident` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_bel`
--

CREATE TABLE `ct_db_bel` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `bank_id` varchar(255) DEFAULT NULL,
  `ref_code` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `name_id` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `ident` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_bexchange`
--

CREATE TABLE `ct_db_bexchange` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `ref_code` varchar(255) DEFAULT NULL,
  `from_acc_id` varchar(255) DEFAULT NULL,
  `to_bank_id` varchar(255) DEFAULT NULL,
  `to_user_id` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `received` int(10) NOT NULL DEFAULT 1,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_bexpense`
--

CREATE TABLE `ct_db_bexpense` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `username` varchar(255) DEFAULT NULL,
  `usertype` varchar(255) DEFAULT NULL,
  `ref_code` varchar(255) DEFAULT NULL,
  `bank_id` varchar(10) NOT NULL,
  `cat` varchar(255) DEFAULT NULL,
  `part` varchar(255) DEFAULT NULL,
  `vou_id` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) NOT NULL,
  `rec_per` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `upload` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_binvest`
--

CREATE TABLE `ct_db_binvest` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `bank_id` varchar(255) DEFAULT NULL,
  `ref_code` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `name_id` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `ident` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_bissued`
--

CREATE TABLE `ct_db_bissued` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `ref_code` varchar(255) DEFAULT NULL,
  `li_id` varchar(10) NOT NULL,
  `li_user_id` varchar(255) DEFAULT NULL,
  `li_bank_id` varchar(10) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `usertype` varchar(255) DEFAULT NULL,
  `cheque_no` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `netcash` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_cash_withdraw`
--

CREATE TABLE `ct_db_cash_withdraw` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `ref_code` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `from_bank_id` varchar(255) DEFAULT NULL,
  `cheque_no` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `received` varchar(10) NOT NULL DEFAULT '1',
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_exf`
--

CREATE TABLE `ct_db_exf` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `username` varchar(255) DEFAULT NULL,
  `usertype` varchar(255) DEFAULT NULL,
  `bank_id` varchar(10) NOT NULL,
  `ucl_ref_code` varchar(255) DEFAULT NULL,
  `ref_code` varchar(255) DEFAULT NULL,
  `ucl_trans_id` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_hag`
--

CREATE TABLE `ct_db_hag` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `ag_id` varchar(10) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_hdeposit`
--

CREATE TABLE `ct_db_hdeposit` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `name_id` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `ident` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_hel`
--

CREATE TABLE `ct_db_hel` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `name_id` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `ident` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_hexchange`
--

CREATE TABLE `ct_db_hexchange` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `to_user_id` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `received` int(10) NOT NULL DEFAULT 1,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_hexpense`
--

CREATE TABLE `ct_db_hexpense` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `username` varchar(255) DEFAULT NULL,
  `usertype` varchar(255) DEFAULT NULL,
  `cat` varchar(255) DEFAULT NULL,
  `part` varchar(255) DEFAULT NULL,
  `vou_id` varchar(255) DEFAULT NULL,
  `rec_per` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `upload` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_hinvest`
--

CREATE TABLE `ct_db_hinvest` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `name_id` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `ident` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_db_hissued`
--

CREATE TABLE `ct_db_hissued` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `li_user_id` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `netcash` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(10) NOT NULL,
  `update_login_id` varchar(10) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_hand_collection`
--

CREATE TABLE `ct_hand_collection` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `user_id` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `line_id` varchar(255) DEFAULT NULL,
  `pre_bal` varchar(255) DEFAULT NULL,
  `coll_amt` varchar(255) DEFAULT NULL,
  `tot_amt` varchar(255) DEFAULT NULL,
  `rec_amt` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `area_group` varchar(255) DEFAULT NULL,
  `area_line` varchar(255) DEFAULT NULL,
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
  `blood_group` varchar(255) DEFAULT NULL,
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
  `about_customer` varchar(255) DEFAULT NULL,
  `residential_type` varchar(10) DEFAULT NULL,
  `residential_details` varchar(150) DEFAULT NULL,
  `residential_address` varchar(255) DEFAULT NULL,
  `residential_native_address` varchar(255) DEFAULT NULL,
  `occupation_info_occ_type` varchar(10) DEFAULT NULL,
  `occupation_details` varchar(255) DEFAULT NULL,
  `occupation_income` varchar(255) DEFAULT NULL,
  `occupation_address` varchar(255) DEFAULT NULL,
  `area_confirm_type` varchar(50) DEFAULT NULL,
  `area_confirm_state` varchar(50) DEFAULT NULL,
  `area_confirm_district` varchar(50) DEFAULT NULL,
  `area_confirm_taluk` varchar(50) DEFAULT NULL,
  `area_confirm_area` varchar(50) DEFAULT NULL,
  `area_confirm_subarea` varchar(50) DEFAULT NULL,
  `area_group` varchar(50) DEFAULT NULL,
  `area_line` varchar(50) DEFAULT NULL,
  `cus_status` varchar(255) DEFAULT '0',
  `create_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(1, 'D-101', '1', 'Will Smith', '1', '', '26', '', 'TamilNadu', 'Kancheepuram', 'Uthiramerur', 'Uthiramerur', '603406', 'www.saravanan@gmail.com', '9842301827', '', '0', '1', NULL, NULL, '2023-06-30 11:51:01', '2023-06-30 11:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `document_info`
--

CREATE TABLE `document_info` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `cus_id` varchar(250) DEFAULT NULL,
  `req_id` varchar(255) NOT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `doc_detail` varchar(255) DEFAULT NULL,
  `doc_type` varchar(255) DEFAULT NULL,
  `doc_holder` varchar(255) DEFAULT NULL,
  `holder_name` varchar(255) DEFAULT NULL,
  `relation_name` varchar(255) NOT NULL,
  `relation` varchar(255) DEFAULT NULL,
  `doc_upload` varchar(255) DEFAULT NULL,
  `doc_info_upload_noc` int(11) DEFAULT 0,
  `doc_info_upload_used` int(11) DEFAULT 0,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE `expense_category` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fingerprints`
--

CREATE TABLE `fingerprints` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `adhar_num` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `hand` varchar(50) DEFAULT NULL,
  `ansi_template` longtext NOT NULL,
  `bitmap_data` longtext DEFAULT NULL,
  `insert_user_id` varchar(50) DEFAULT NULL,
  `update_user_id` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gold_info`
--

CREATE TABLE `gold_info` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(250) DEFAULT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `gold_sts` varchar(255) DEFAULT NULL,
  `gold_type` varchar(255) DEFAULT NULL,
  `Purity` varchar(255) DEFAULT NULL,
  `gold_Count` varchar(255) DEFAULT NULL,
  `gold_Weight` varchar(255) DEFAULT NULL,
  `gold_Value` varchar(255) DEFAULT NULL,
  `noc_given` varchar(10) NOT NULL DEFAULT '0',
  `used_status` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `in_acknowledgement`
--

CREATE TABLE `in_acknowledgement` (
  `id` int(11) NOT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `cus_status` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `insert_login_id` varchar(50) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `in_approval`
--

CREATE TABLE `in_approval` (
  `req_id` varchar(255) DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `cus_status` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT '0',
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `in_issue`
--

CREATE TABLE `in_issue` (
  `id` int(11) NOT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `cus_status` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `insert_login_id` varchar(50) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `delete_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT current_timestamp()
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
  `cus_reg_id` varchar(255) DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `cus_data` varchar(255) DEFAULT NULL,
  `cus_name` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
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
(1, '1', 'Personal', 'Monthly', 'intrest', '', 'Monthly', '1', '2', '10', '12', '1', '2', '1', '2', NULL, '', '', '', '3', 'Yes', 0, 1, 1, NULL, '2023-05-10 15:28:57', '2023-05-10 15:28:57'),
(2, '1', 'Education loan', 'Monthly', 'intrest', '', 'Monthly', '0', '1', '10', '12', '0', '1', '0', '1', NULL, '', '', '', '1', 'No', 0, 0, 1, NULL, '2023-05-11 17:31:55', '2023-05-11 17:31:55'),
(3, '4', 'Coin', 'Monthly', 'intrest', '', 'Monthly', '0', '2', '10', '12', '1', '2', '1', '2', NULL, '', '', '', '3', 'No', 0, 1, 1, NULL, '2023-05-11 17:34:49', '2023-05-11 17:34:49'),
(4, '5', 'AC', 'Monthly', 'emi', 'after_intrest', '', '1', '2', '6', '12', '1', '2', '1', '2', NULL, '', '', '', '3', 'Yes', 0, 1, 1, NULL, '2023-05-11 17:37:01', '2023-05-11 17:37:01'),
(5, '2', 'Bike', 'Monthly', 'emi', 'after_intrest', '', '1', '2', '10', '12', '1', '2', '1', '2', NULL, '', '', '', '3', 'Yes', 0, 1, 1, NULL, '2023-05-11 17:39:26', '2023-05-11 17:39:26'),
(6, '5', 'AC', 'Monthly', 'emi', 'pre_intrest,after_intrest', '', '1', '2', '5', '10', '1', '2', '1', '2', NULL, '', '', '', '3', 'No', 0, 1, 1, NULL, '2023-05-11 18:49:16', '2023-05-11 18:49:16'),
(7, '6', 'Mobiles', 'Monthly', 'emi', 'pre_intrest', '', '1', '2', '5', '10', '1', '2', '1', '2', NULL, '', '', '', '3', 'No', 0, 1, NULL, NULL, '2023-05-11 18:50:52', '2023-05-11 18:50:52'),
(8, '6', 'Tab', 'Monthly', 'emi', 'pre_intrest', '', '1', '2', '5', '10', '1', '2', '1', '2', NULL, '', '', '', '3', 'No', 0, 1, NULL, NULL, '2023-05-11 18:51:55', '2023-05-11 18:51:55'),
(9, '7', 'Small Business', 'Monthly', 'emi', 'pre_intrest,after_intrest', '', '1.5', '3', '5', '18', '1', '2', '0', '1', NULL, '', '', '', '3', 'No', 0, 1, 1, NULL, '2023-05-12 15:27:55', '2023-05-12 15:27:55'),
(10, '8', 'Plot Purchase', 'Monthly', 'emi', 'after_intrest', '', '1.5', '3', '12', '24', '2', '3', '1', '2', NULL, '', '', '', '2', 'Yes', 0, 1, NULL, NULL, '2023-05-12 15:42:34', '2023-05-12 15:42:34'),
(11, '5', 'TV', 'Monthly', 'emi', 'pre_intrest,after_intrest', '', '1', '2', '5', '10', '1', '2', '1', '2', NULL, '', '', '', '3', 'Yes', 0, 1, NULL, NULL, '2023-05-13 15:16:48', '2023-05-13 15:16:48'),
(12, '5', 'fridge', 'Monthly', 'emi', 'pre_intrest,after_intrest', '', '1', '2', '6', '10', '1', '2', '1', '2', NULL, '', '', '', '3', 'No', 0, 1, 1, NULL, '2023-05-13 16:03:56', '2023-05-13 16:03:56'),
(13, '9', 'Education', 'Monthly', 'intrest', '', 'Monthly', '1', '2', '10', '18', '1', '2', '1', '2', NULL, '', '', '', '3', 'No', 0, 1, 1, NULL, '2023-05-14 13:16:55', '2023-05-14 13:16:55'),
(14, '10', 'Home loan', 'Monthly', 'intrest', '', 'Monthly', '1', '2', '12', '18', '1', '2', '1', '2', NULL, '', '', '', '3', 'Yes', 0, 1, 1, NULL, '2023-05-15 16:44:29', '2023-05-15 16:44:29'),
(15, '11', 'Personal loan R', 'Monthly', 'emi', 'pre_intrest', '', '0', '2', '5', '10', '0', '2', '0', '2', NULL, '', '', '', '2', 'No', 0, 1, NULL, NULL, '2023-06-13 11:37:20', '2023-06-13 11:37:20'),
(16, '5', 'AC Pre R ', 'Monthly', 'emi', 'pre_intrest', '', '0', '2', '5', '10', '0', '2', '0', '2', NULL, '', '', '', '2', 'Yes', 0, 1, NULL, NULL, '2023-06-13 11:39:00', '2023-06-13 11:39:00'),
(17, '5', 'TV After R', 'Monthly', 'emi', 'after_intrest', '', '0', '2', '5', '10', '0', '2', '0', '2', NULL, '', '', '', '2', 'Yes', 0, 1, NULL, NULL, '2023-06-13 11:40:56', '2023-06-13 11:40:56'),
(18, '11', 'Interest R', 'Monthly', 'intrest', '', 'Monthly', '0', '2', '5', '10', '0', '2', '0', '2', NULL, '', '', '', '2', 'No', 0, 1, NULL, NULL, '2023-06-13 11:46:45', '2023-06-13 11:46:45'),
(19, '4', 'Chain Pre aftr R', 'Monthly', 'emi', 'pre_intrest,after_intrest', '', '0', '2', '5', '10', '0', '2', '0', '2', NULL, '', '', '', '2', 'No', 0, 1, NULL, NULL, '2023-06-13 11:48:50', '2023-06-13 11:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `loan_category`
--

CREATE TABLE `loan_category` (
  `loan_category_id` int(11) NOT NULL,
  `loan_category_name` varchar(255) DEFAULT NULL,
  `sub_category_name` varchar(255) DEFAULT NULL,
  `loan_limit` varchar(255) NOT NULL,
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

INSERT INTO `loan_category` (`loan_category_id`, `loan_category_name`, `sub_category_name`, `loan_limit`, `status`, `insert_user_id`, `update_user_id`, `delete_user_id`, `created_date`, `updated_date`) VALUES
(38, '1', 'Education loan', '52351', 0, 1, NULL, 1, '2023-05-11 17:19:08', '2023-05-11 17:19:08'),
(39, '4', 'Coin', '65230', 0, 1, NULL, NULL, '2023-05-11 17:22:20', '2023-05-11 17:22:20'),
(40, '2', 'Bike', '79094', 0, 1, NULL, NULL, '2023-05-11 17:24:40', '2023-05-11 17:24:40'),
(41, '2', 'Scooty', '64779', 0, 1, NULL, NULL, '2023-05-11 17:25:33', '2023-05-11 17:25:33'),
(42, '4', 'Chain', '86615', 0, 1, NULL, NULL, '2023-05-11 17:28:02', '2023-05-11 17:28:02'),
(43, '5', 'TV', '58737', 0, 1, NULL, NULL, '2023-05-11 18:40:07', '2023-05-11 18:40:07'),
(44, '6', 'Mobiles', '78841', 0, 1, NULL, NULL, '2023-05-11 18:45:07', '2023-05-11 18:45:07'),
(45, '6', 'Tab', '82993', 0, 1, NULL, NULL, '2023-05-11 18:45:33', '2023-05-11 18:45:33'),
(46, '5', 'AC', '88442', 0, 1, NULL, NULL, '2023-05-11 18:47:54', '2023-05-11 18:47:54'),
(47, '5', 'Mobile', '58231', 0, 1, NULL, NULL, '2023-05-12 14:59:38', '2023-05-12 14:59:38'),
(48, '7', 'Small Business', '70829', 0, 1, NULL, NULL, '2023-05-12 15:01:54', '2023-05-12 15:01:54'),
(49, '7', 'Medium Business', '89451', 0, 1, NULL, NULL, '2023-05-12 15:02:33', '2023-05-12 15:02:33'),
(50, '7', 'Large Business', '54767', 0, 1, NULL, NULL, '2023-05-12 15:03:20', '2023-05-12 15:03:20'),
(51, '8', 'Plot Purchase', '50485', 0, 1, NULL, NULL, '2023-05-12 15:05:48', '2023-05-12 15:05:48'),
(52, '8', 'Construction Loan', '88124', 0, 1, NULL, NULL, '2023-05-12 15:08:00', '2023-05-12 15:08:00'),
(53, '1', 'Educarion', '64162', 0, 1, NULL, NULL, '2023-05-12 15:51:50', '2023-05-12 15:51:50'),
(54, '5', 'Fridge', '56438', 0, 1, NULL, NULL, '2023-05-13 16:02:40', '2023-05-13 16:02:40'),
(55, '9', 'Education', '89708', 0, 1, NULL, NULL, '2023-05-14 12:27:16', '2023-05-14 12:27:16'),
(56, '1', 'Personal', '54221', 0, 1, NULL, NULL, '2023-05-15 15:59:27', '2023-05-15 15:59:27'),
(57, '10', 'Home loan', '46984', 0, 1, NULL, NULL, '2023-05-15 16:43:15', '2023-05-15 16:43:15'),
(58, '7', 'SME Loan', '72256', 0, 1, NULL, NULL, '2023-06-08 11:35:08', '2023-06-08 11:35:08'),
(59, '2', 'Car Loan', '85330', 0, 1, NULL, NULL, '2023-06-08 11:40:10', '2023-06-08 11:40:10'),
(60, '8', 'Agri Land', '74879', 0, 1, NULL, NULL, '2023-06-08 11:42:16', '2023-06-08 11:42:16'),
(61, '3', 'Construction Loan', '73406', 0, 1, NULL, NULL, '2023-06-08 11:43:49', '2023-06-08 11:43:49'),
(62, '11', 'Personal loan R', '52392', 0, 1, NULL, NULL, '2023-06-13 11:11:33', '2023-06-13 11:11:33'),
(63, '5', 'AC Pre R ', '86746', 0, 1, NULL, NULL, '2023-06-13 11:15:46', '2023-06-13 11:15:46'),
(64, '5', 'TV After R', '51548', 0, 1, NULL, NULL, '2023-06-13 11:21:38', '2023-06-13 11:21:38'),
(65, '4', 'Chain Pre aftr R', '87506', 0, 1, NULL, NULL, '2023-06-13 11:33:16', '2023-06-13 11:33:16'),
(66, '11', 'Interest R', '57881', 0, 1, NULL, NULL, '2023-06-13 11:34:58', '2023-06-13 11:34:58'),
(67, '9', 'asdfa', '71890', 0, 1, NULL, NULL, '2023-06-29 15:52:36', '2023-06-29 15:52:36'),
(68, '1', 'Personal', '65509', 0, 1, NULL, NULL, '2023-06-30 17:08:42', '2023-06-30 17:08:42');

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
(1, 'Personal', 0, NULL, NULL, NULL, '2023-05-10 02:57:14', '2023-05-10 02:57:14'),
(2, 'Vehicle loan', 0, NULL, NULL, NULL, '2023-05-11 04:46:41', '2023-05-11 04:46:41'),
(3, 'Housing loan', 0, NULL, NULL, NULL, '2023-05-11 04:46:54', '2023-05-11 04:46:54'),
(4, 'Gold loan', 0, NULL, NULL, NULL, '2023-05-11 04:47:07', '2023-05-11 04:47:07'),
(5, 'Home Appliance', 0, NULL, NULL, NULL, '2023-05-11 06:05:51', '2023-05-11 06:05:51'),
(6, 'Digital products', 0, NULL, NULL, NULL, '2023-05-11 06:06:34', '2023-05-11 06:06:34'),
(7, 'Business', 0, NULL, NULL, NULL, '2023-05-12 02:30:02', '2023-05-12 02:30:02'),
(8, 'Property ', 0, NULL, NULL, NULL, '2023-05-12 02:33:55', '2023-05-12 02:33:55'),
(9, 'Education', 0, NULL, NULL, NULL, '2023-05-13 23:55:50', '2023-05-13 23:55:50'),
(10, 'Home ', 0, NULL, NULL, NULL, '2023-05-15 04:07:47', '2023-05-15 04:07:47'),
(11, 'Finance R', 0, NULL, NULL, NULL, '2023-06-12 22:39:15', '2023-06-12 22:39:15');

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
(77, 'Company', '4', 0, NULL, NULL, NULL, '2023-05-11 17:24:40', '2023-05-11 17:24:40'),
(78, 'Model', '4', 0, NULL, NULL, NULL, '2023-05-11 17:24:40', '2023-05-11 17:24:40'),
(79, 'Gold Type', '3', 0, NULL, NULL, NULL, '2023-05-11 17:27:14', '2023-05-11 17:27:14'),
(80, 'Gram / sovereign', '3', 0, NULL, NULL, NULL, '2023-05-11 17:27:14', '2023-05-11 17:27:14'),
(81, 'Market value', '3', 0, NULL, NULL, NULL, '2023-05-11 17:27:14', '2023-05-11 17:27:14'),
(82, 'Brand', '11', 0, NULL, NULL, NULL, '2023-05-12 14:59:38', '2023-05-12 14:59:38'),
(83, 'Model', '11', 0, NULL, NULL, NULL, '2023-05-12 14:59:38', '2023-05-12 14:59:38'),
(84, 'IMEI Number', '11', 0, NULL, NULL, NULL, '2023-05-12 14:59:38', '2023-05-12 14:59:38'),
(85, 'Business type', '12', 0, NULL, NULL, NULL, '2023-05-12 15:01:54', '2023-05-12 15:01:54'),
(86, 'Ownership', '12', 0, NULL, NULL, NULL, '2023-05-12 15:01:54', '2023-05-12 15:01:54'),
(87, 'Business type', '13', 0, NULL, NULL, NULL, '2023-05-12 15:02:33', '2023-05-12 15:02:33'),
(88, 'Ownership', '13', 0, NULL, NULL, NULL, '2023-05-12 15:02:33', '2023-05-12 15:02:33'),
(89, 'CIN', '14', 0, NULL, NULL, NULL, '2023-05-12 15:03:20', '2023-05-12 15:03:20'),
(90, 'Business Type', '14', 0, NULL, NULL, NULL, '2023-05-12 15:03:20', '2023-05-12 15:03:20'),
(91, 'PAN', '14', 0, NULL, NULL, NULL, '2023-05-12 15:03:20', '2023-05-12 15:03:20'),
(92, 'Plot Dimension', '15', 0, NULL, NULL, NULL, '2023-05-12 15:05:48', '2023-05-12 15:05:48'),
(93, 'Sq ft', '15', 0, NULL, NULL, NULL, '2023-05-12 15:05:48', '2023-05-12 15:05:48'),
(94, 'Plot Value', '15', 0, NULL, NULL, NULL, '2023-05-12 15:05:48', '2023-05-12 15:05:48'),
(95, 'Total Value For Construction', '16', 0, NULL, NULL, NULL, '2023-05-12 15:08:00', '2023-05-12 15:08:00'),
(96, 'Ownership Detail', '16', 0, NULL, NULL, NULL, '2023-05-12 15:08:00', '2023-05-12 15:08:00'),
(97, 'Company', '5', 0, NULL, NULL, NULL, '2023-05-12 15:37:17', '2023-05-12 15:37:17'),
(98, 'Model', '5', 0, NULL, NULL, NULL, '2023-05-12 15:37:17', '2023-05-12 15:37:17'),
(99, 'Company', '10', 0, NULL, NULL, NULL, '2023-05-12 15:43:12', '2023-05-12 15:43:12'),
(100, 'AC capacity', '10', 0, NULL, NULL, NULL, '2023-05-12 15:43:12', '2023-05-12 15:43:12'),
(101, 'AC type', '10', 0, NULL, NULL, NULL, '2023-05-12 15:43:12', '2023-05-12 15:43:12'),
(102, 'Brand', '9', 0, NULL, NULL, NULL, '2023-05-12 15:47:30', '2023-05-12 15:47:30'),
(103, 'Screen size', '9', 0, NULL, NULL, NULL, '2023-05-12 15:47:30', '2023-05-12 15:47:30'),
(104, 'Brand', '8', 0, NULL, NULL, NULL, '2023-05-12 15:48:00', '2023-05-12 15:48:00'),
(105, 'Screen size', '8', 0, NULL, NULL, NULL, '2023-05-12 15:48:00', '2023-05-12 15:48:00'),
(106, 'Passed out ', '17', 0, NULL, NULL, NULL, '2023-05-12 15:53:44', '2023-05-12 15:53:44'),
(107, 'percentage', '17', 0, NULL, NULL, NULL, '2023-05-12 15:53:44', '2023-05-12 15:53:44'),
(108, 'Brand ', '7', 0, NULL, NULL, NULL, '2023-05-13 15:15:44', '2023-05-13 15:15:44'),
(109, 'Screen size', '7', 0, NULL, NULL, NULL, '2023-05-13 15:15:44', '2023-05-13 15:15:44'),
(110, 'TV Type', '7', 0, NULL, NULL, NULL, '2023-05-13 15:15:44', '2023-05-13 15:15:44'),
(111, 'Brand', '18', 0, NULL, NULL, NULL, '2023-05-13 16:23:16', '2023-05-13 16:23:16'),
(112, 'Door', '18', 0, NULL, NULL, NULL, '2023-05-13 16:23:16', '2023-05-13 16:23:16'),
(113, 'Institute', '19', 0, NULL, NULL, NULL, '2023-05-15 11:02:43', '2023-05-15 11:02:43'),
(114, 'Class', '19', 0, NULL, NULL, NULL, '2023-05-15 11:02:43', '2023-05-15 11:02:43'),
(115, 'Current salary', '20', 0, NULL, NULL, NULL, '2023-05-15 15:59:27', '2023-05-15 15:59:27'),
(116, 'Business Type', '22', 0, NULL, NULL, NULL, '2023-06-08 11:35:52', '2023-06-08 11:35:52'),
(117, 'Bussiness Value', '22', 0, NULL, NULL, NULL, '2023-06-08 11:35:52', '2023-06-08 11:35:52'),
(118, 'Business Location', '22', 0, NULL, NULL, NULL, '2023-06-08 11:35:52', '2023-06-08 11:35:52'),
(119, '', '22', 0, NULL, NULL, NULL, '2023-06-08 11:35:52', '2023-06-08 11:35:52'),
(120, 'Brand', '23', 0, NULL, NULL, NULL, '2023-06-08 11:40:10', '2023-06-08 11:40:10'),
(121, 'Model', '23', 0, NULL, NULL, NULL, '2023-06-08 11:40:10', '2023-06-08 11:40:10'),
(122, 'Acre', '24', 0, NULL, NULL, NULL, '2023-06-08 11:42:16', '2023-06-08 11:42:16'),
(123, 'Borewel type', '24', 0, NULL, NULL, NULL, '2023-06-08 11:42:16', '2023-06-08 11:42:16'),
(124, 'Harvesting type', '24', 0, NULL, NULL, NULL, '2023-06-08 11:42:16', '2023-06-08 11:42:16'),
(125, 'Quotation Value', '25', 0, NULL, NULL, NULL, '2023-06-08 11:43:49', '2023-06-08 11:43:49'),
(126, 'Current Designation', '26', 0, NULL, NULL, NULL, '2023-06-13 11:12:10', '2023-06-13 11:12:10'),
(127, 'No. of months working', '26', 0, NULL, NULL, NULL, '2023-06-13 11:12:10', '2023-06-13 11:12:10'),
(128, 'Salary', '26', 0, NULL, NULL, NULL, '2023-06-13 11:12:10', '2023-06-13 11:12:10'),
(129, 'Company', '27', 0, NULL, NULL, NULL, '2023-06-13 11:20:35', '2023-06-13 11:20:35'),
(130, 'Model', '27', 0, NULL, NULL, NULL, '2023-06-13 11:20:35', '2023-06-13 11:20:35'),
(131, 'Year', '27', 0, NULL, NULL, NULL, '2023-06-13 11:20:35', '2023-06-13 11:20:35'),
(132, 'Company', '28', 0, NULL, NULL, NULL, '2023-06-13 11:21:38', '2023-06-13 11:21:38'),
(133, 'Model', '28', 0, NULL, NULL, NULL, '2023-06-13 11:21:38', '2023-06-13 11:21:38'),
(134, 'Year', '28', 0, NULL, NULL, NULL, '2023-06-13 11:21:38', '2023-06-13 11:21:38'),
(135, 'Purity', '29', 0, NULL, NULL, NULL, '2023-06-13 11:33:16', '2023-06-13 11:33:16'),
(136, 'Gram', '29', 0, NULL, NULL, NULL, '2023-06-13 11:33:16', '2023-06-13 11:33:16'),
(137, 'Current designation', '30', 0, NULL, NULL, NULL, '2023-06-13 11:34:58', '2023-06-13 11:34:58'),
(138, 'No. of months working', '30', 0, NULL, NULL, NULL, '2023-06-13 11:34:58', '2023-06-13 11:34:58'),
(139, 'Salary', '30', 0, NULL, NULL, NULL, '2023-06-13 11:34:58', '2023-06-13 11:34:58'),
(140, 'ertert', '31', 0, NULL, NULL, NULL, '2023-06-29 15:52:36', '2023-06-29 15:52:36'),
(141, 'Operation', '68', 0, NULL, NULL, NULL, '2023-06-30 17:08:42', '2023-06-30 17:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `loan_issue`
--

CREATE TABLE `loan_issue` (
  `id` int(11) NOT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `issued_to` varchar(255) NOT NULL,
  `agent_id` varchar(255) NOT NULL,
  `issued_mode` varchar(50) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `cash` varchar(255) NOT NULL,
  `bank_id` varchar(10) NOT NULL,
  `cheque_no` varchar(255) NOT NULL,
  `cheque_value` varchar(255) NOT NULL,
  `cheque_remark` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `transaction_value` varchar(255) NOT NULL,
  `transaction_remark` varchar(255) NOT NULL,
  `balance_amount` varchar(255) NOT NULL,
  `loan_amt` varchar(255) NOT NULL,
  `net_cash` varchar(255) NOT NULL,
  `cash_guarentor_name` varchar(255) NOT NULL,
  `relationship` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `insert_login_id` varchar(50) DEFAULT NULL,
  `update_login_id` varchar(50) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `loan_summary_feedback`
--

CREATE TABLE `loan_summary_feedback` (
  `id` int(11) NOT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `feedback_label` varchar(255) DEFAULT NULL,
  `cus_feedback` varchar(255) DEFAULT NULL,
  `feedback_remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `name_detail_creation`
--

CREATE TABLE `name_detail_creation` (
  `name_id` int(11) NOT NULL COMMENT 'Primary Key',
  `name` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `ident` varchar(255) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT '0',
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `noc`
--

CREATE TABLE `noc` (
  `noc_id` int(11) NOT NULL COMMENT 'Primary Key',
  `req_id` varchar(255) DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `sign_checklist` varchar(255) DEFAULT NULL,
  `cheque_checklist` varchar(255) DEFAULT NULL,
  `gold_checklist` varchar(255) DEFAULT NULL,
  `mort_checklist` varchar(255) DEFAULT NULL,
  `endorse_checklist` varchar(255) DEFAULT NULL,
  `doc_checklist` varchar(255) DEFAULT NULL,
  `noc_date` varchar(255) DEFAULT NULL,
  `noc_member` varchar(255) DEFAULT NULL,
  `mem_name` varchar(255) DEFAULT NULL,
  `cus_status` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penalty_charges`
--

CREATE TABLE `penalty_charges` (
  `req_id` varchar(255) DEFAULT NULL,
  `penalty_date` varchar(255) DEFAULT NULL,
  `penalty` varchar(255) DEFAULT NULL,
  `paid_date` varchar(255) DEFAULT NULL,
  `paid_amnt` varchar(255) DEFAULT '0',
  `waiver_amnt` varchar(255) DEFAULT '0',
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_category_info`
--

CREATE TABLE `request_category_info` (
  `cat_info` int(11) NOT NULL,
  `req_ref_id` varchar(255) DEFAULT NULL,
  `category_info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `cus_reg_id` varchar(255) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `signed_doc`
--

CREATE TABLE `signed_doc` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(250) DEFAULT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `signed_doc_id` varchar(255) DEFAULT NULL,
  `upload_doc_name` varchar(255) DEFAULT NULL,
  `noc_given` varchar(10) NOT NULL DEFAULT '0',
  `used_status` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signed_doc_info`
--

CREATE TABLE `signed_doc_info` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(250) DEFAULT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `sign_type` varchar(255) DEFAULT NULL,
  `signType_relationship` varchar(255) DEFAULT NULL,
  `doc_Count` varchar(255) DEFAULT NULL,
  `req_id` varchar(150) DEFAULT NULL,
  `cus_profile_id` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'ST-122', 'Arun', '4', '58', 'TamilNadu', 'Karur', 'Karur', 'karur', '639001', 'arunfeather27@gmail.com', '7845123265', '', '7845123265', '', '1', 'Development', 'PHP', 'Software Developer', '0', '1', '1', NULL, '2023-06-30 12:05:24', '2023-06-30 12:05:33'),
(2, 'ST-101', 'J Prakash Kumar', '1', '25', 'TamilNadu', 'Tiruvannamalai', 'Thiruvannamalai', 'Vandavasi', '604408', 'hariprakash1292@gmail.com', '7530037575', '', '', '', '1', 'Sales', 'Apple', 'TL', '0', '1', '1', NULL, '2023-05-12 11:08:47', '2023-05-12 11:35:22'),
(3, 'ST-102', 'E Kathiravan', '1', '25', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vandavasi', '604408', 'Kathiravan.logon@gmail.com', '9597058101', '', '', '', '1', 'Collection', '', 'TL', '0', '1', '1', NULL, '2023-05-12 11:15:16', '2023-05-25 18:17:49'),
(4, 'ST-103', 'A Vinoth Kumar', '2', '25', 'TamilNadu', 'Tiruvannamalai', 'Chetpet', 'Vandavasi', '606801', 'vinoar07@gmail.com', '900342641607', '', '', '', '1', 'Sales', 'Apple', 'Executive', '0', '1', '1', NULL, '2023-05-12 11:19:35', '2023-05-12 11:38:15'),
(5, 'ST-104', 'E Deepak', '2', '25', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vandavasi', '604408', 'deepakadh66@gmail.com', '8667769300', '', '', '', '1', 'Collection', 'Banana 1', 'Executive', '0', '1', '1', NULL, '2023-05-12 11:21:47', '2023-05-12 13:25:38'),
(6, 'ST-104', 'E Deepak', '2', '25', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vandavasi', '604408', 'deepakadh66@gmail.com', '8667769300', '', '', '', '1', 'Sales', 'Kurunji beta ', 'Executive', '1', '1', '1', NULL, '2023-05-12 11:21:48', '2023-05-12 11:21:48'),
(7, 'ST-105', 'K Harisankar', '1', '26', 'TamilNadu', 'Tiruvannamalai', 'Chetpet', 'chetpet', '606801', 'harisankar1770@gmail.com', '9944062263', '', '', '', '1', 'Sales', 'Mango', 'TL', '0', '1', '1', NULL, '2023-05-12 11:23:40', '2023-06-22 16:02:05'),
(8, 'ST-106', 'P Prakash', '2', '26', 'TamilNadu', 'Tiruvannamalai', 'Chetpet', 'chetpet', '606801', 'prakashpp02@gmail.com', '9942882229', '', '', '', '1', 'Sales', 'Mango', 'Executive', '0', '1', '1', NULL, '2023-05-12 11:27:20', '2023-05-12 11:39:06'),
(9, 'ST-107', 'J Manivannan', '1', '26', 'TamilNadu', 'Tiruvannamalai', 'Chetpet', 'chetpet', '606801', 'madhanj5685@gmail.com', '6369515985', '', '', '', '1', 'Collection', 'Pine apple 1', 'TL', '0', '1', '1', NULL, '2023-05-12 11:28:49', '2023-06-22 16:02:17'),
(10, 'ST-108', 'S Vijayan', '2', '26', 'TamilNadu', 'Tiruvannamalai', 'Chetpet', 'chetpet', '606801', 'suijayan06@gmail.com', '7010608919', '', '', '', '1', 'Collection', 'Pine apple 1', 'Executive', '0', '1', '1', NULL, '2023-05-12 11:30:08', '2023-05-12 13:34:09'),
(11, 'ST-109', 'B Dhakshnamoorthi', '1', '27', 'TamilNadu', 'Kancheepuram', 'Uthiramerur', 'Uthiramerur', '603406', 'ashwinbeukah1989@gmail.com', '8675606936', '', '', '', '1', 'Sales', 'Water melon 1', 'TL', '0', '1', '1', NULL, '2023-05-12 11:33:00', '2023-05-12 12:39:29'),
(12, 'ST-110', 'J Prabakaran', '2', '27', 'TamilNadu', 'Kancheepuram', 'Uthiramerur', 'Uthiramerur', '603406', 'jpraba1994@gmail.com', '9500288723', '', '', '', '1', 'Sales', 'Water melon 1', 'Executive', '0', '1', '1', NULL, '2023-05-12 11:34:24', '2023-05-12 12:40:18'),
(13, 'ST-111', 'M Sathishkumar', '1', '27', 'TamilNadu', 'Kancheepuram', 'Kancheepuram', 'Uthiramerur', '603406', 'sathish19051992@gmail.com', '9500809268', '', '', '', '1', 'Collection', 'Jack fruit', 'TL', '0', '1', NULL, NULL, '2023-05-12 11:42:17', '2023-05-12 11:42:17'),
(14, 'ST-112', 'M Vignesh', '2', '27', 'TamilNadu', 'Kancheepuram', 'Uthiramerur', 'Uthiramerur', '603406', 'lingeshvicky3@gmail.com', '7639806909', '', '', '', '1', 'Collection', 'Jackfruit', 'Executive', '0', '1', NULL, NULL, '2023-05-12 11:44:20', '2023-05-12 11:44:20'),
(15, 'ST-113', 'C Chinnadurai', '2', '25', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vandavasi', '604404', 'Chinnadurai.v309@gmail.com', '9080424365', '', '', '', '1', 'Sales', 'Apple', 'Executive', '0', '1', NULL, NULL, '2023-05-12 11:47:39', '2023-05-12 11:47:39'),
(16, 'ST-114', 'V Ramesh', '2', '25', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vandavasi', '604408', 'kvramesh34@gmail.com', '8124426133', '', '', '', '1', 'Sales', 'Apple', 'Executive', '0', '1', NULL, NULL, '2023-05-12 11:49:33', '2023-05-12 11:49:33'),
(17, 'ST-115', 'V Arun Kumar', '2', '25', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vandavasi', '604408', 'arunv2219@gmail.com', '9952616003', '', '', '', '1', 'Collection', 'Banana 1', 'Executive', '0', '1', '1', NULL, '2023-05-12 11:51:23', '2023-05-12 13:25:47'),
(18, 'ST-116', 'S Siva', '2', '26', 'TamilNadu', 'Kancheepuram', 'Uthiramerur', 'Uthiramerur', '603406', 'ss7967018@gmail.com', '6380949704', '', '', '', '1', 'Sales', 'Watermelon', 'Executive', '0', '1', NULL, NULL, '2023-05-12 12:13:17', '2023-05-12 12:13:17'),
(19, 'ST-117', 'G Ramachandran', '2', '26', 'TamilNadu', 'Kancheepuram', 'Uthiramerur', 'Uthiramerur', '603406', 'indianfivestar@gmail.com', '9626344296', '', '', '', '1', 'Sales', 'Water melon 1', 'Executive', '0', '1', '1', NULL, '2023-05-12 12:15:12', '2023-05-12 12:39:53'),
(20, 'ST-118', 'S Dinesh', '2', '26', 'TamilNadu', 'Kancheepuram', 'Uthiramerur', 'Uthiramerur', '603406', 'dinesh0871995@gmail.com', '9597579939', '', '', '', '1', 'Collection', 'Jackfruit', 'Executive', '0', '1', NULL, NULL, '2023-05-12 12:17:16', '2023-05-12 12:17:16'),
(21, 'ST-117', 'G Ramachandran', '2', '26', 'TamilNadu', 'Tiruvannamalai', 'Chetpet', 'chetpet', '606801', 'tamilarasananjalai@gmail.com', '9597347847', '', '', '', '1', 'Sales', 'Mango', 'Executive', '0', '1', '1', NULL, '2023-05-12 12:19:09', '2023-05-12 12:21:33'),
(22, 'ST-118', 'C Pushparaj', '2', '27', 'TamilNadu', 'Tiruvannamalai', 'Chetpet', 'chetpet', '606801', 'Pushparajc678@gmail.com', '9715418670', '', '', '', '1', 'Collection', 'Pine apple 1', 'Executive', '0', '1', '1', NULL, '2023-05-12 12:23:06', '2023-05-12 13:33:50'),
(24, 'ST-119', 'S Parthiban', '1', '26', 'TamilNadu', 'Kancheepuram', 'Uthiramerur', 'Uthiramerur', '603406', '', '9790722953', '', '', '', '1', 'Sales', 'Water melon 2', 'TL', '0', '1', NULL, NULL, '2023-05-12 13:22:58', '2023-05-12 13:22:58'),
(25, 'ST-120', 'R Sathish Kumar', '2', '26', 'TamilNadu', 'Kancheepuram', 'Uthiramerur', 'Uthiramerur', '603406', '', '7871361549', '', '', '', '1', 'Sales', 'Water melon 2', 'Executive', '0', '1', NULL, NULL, '2023-05-12 13:24:07', '2023-05-12 13:24:07'),
(26, 'ST-121', 'A Karthick', '1', '25', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vandavasi', '604408', '', '9080597463', '', '', '', '1', 'Collection', 'Banana 2', 'TL', '0', '1', NULL, NULL, '2023-05-12 13:28:55', '2023-05-12 13:28:55'),
(27, 'ST-122', 'E Divakar', '2', '25', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vandavasi', '604408', '', '7708946686', '', '', '', '1', 'Collection', 'Banana 2', 'Executive', '0', '1', NULL, NULL, '2023-05-12 13:30:16', '2023-05-12 13:30:16'),
(28, 'ST-123', 'Jafar', '1', '27', 'TamilNadu', 'Tiruvannamalai', 'Chetpet', 'chetpet', '606801', '', '9655678668', '', '', '', '1', 'Collection', 'Pine apple 2', 'TL', '0', '1', NULL, NULL, '2023-05-12 13:35:46', '2023-05-12 13:35:46'),
(29, 'ST-124', 'Anwar', '2', '27', 'TamilNadu', 'Tiruvannamalai', 'Chetpet', 'chetpet', '606801', '', '9655678558', '', '', '', '1', 'Collection', 'Pine apple 2', 'Executive', '0', '1', NULL, NULL, '2023-05-12 13:36:38', '2023-05-12 13:36:38'),
(30, 'ST-125', 'Malik', '2', '27', 'SelectState', '', '', 'chetpet', '606801', '', '9655678448', '', '', '', '1', 'Collection', 'Pine apple 2', 'Executive', '0', '1', NULL, NULL, '2023-05-12 13:37:19', '2023-05-12 13:37:19'),
(31, 'ST-126', 'Marudhu', '1', '25', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vandavasi', '604408', '', '9597072411', '', '', '', '1', 'Collection', 'Banana1', 'TL', '0', '1', '1', NULL, '2023-05-26 10:10:06', '2023-05-26 10:10:49'),
(32, 'ST-127', 'Vasanth', '2', '25', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vandavasi', '604408', '', '9597072422', '', '', '', '1', 'Collection', 'Banana2', 'Executive', '0', '1', NULL, NULL, '2023-05-26 10:17:07', '2023-05-26 10:17:07'),
(33, 'ST-128', 'Jagan', '3', '25', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vandavasi', '604408', '', '9597072433', '', '', '', '1', 'Office assistant', 'Office', 'Accountant', '0', '1', '1', NULL, '2023-05-26 11:10:49', '2023-05-26 11:11:43'),
(34, 'ST-129', 'Tester', '4', 'check address', 'TamilNadu', 'Coimbatore', 'Aanaimalai', 'cbe', '632132', '', '', '', '', '', '1', 'test', 'test', 'test', '0', '1', '1', NULL, '2023-06-29 17:17:09', '2023-06-29 17:18:03');

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
(1, 'TL', '0'),
(2, 'Executive', '0'),
(3, 'Accountant', '0'),
(4, 'Developer', '0');

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
(1, '1', 'Sub Area', 0, '0'),
(2, '2', 'Chetpet', 0, '0'),
(3, '1', 'Gandhi road', 0, '0'),
(4, '1', 'old bustand', 0, '0'),
(5, '1', 'sannathi st', 0, '0'),
(6, '1', 'Pottinaidu st', 0, '0'),
(7, '1', 'KVT nagar', 0, '0'),
(8, '2', 'Endathur road', 0, '0'),
(9, '2', 'Chinarasampettai road', 0, '0'),
(10, '2', 'mettu street', 0, '0'),
(11, '2', 'karuneegar st', 0, '0'),
(12, '2', 'periya sengunthar st', 0, '0'),
(13, '3', 'EVR road', 0, '0'),
(14, '3', 'Mayor ramanathan salai', 0, '0'),
(15, '3', 'Harington road', 0, '0'),
(16, '3', 'MGR salai', 0, '0'),
(17, '3', 'Anna nagar', 0, '0'),
(18, '3', 'Chinna theru', 0, '0'),
(19, '4', 'Purisai', 0, '0'),
(20, '6', 'Ponnur', 0, '0'),
(21, '6', 'Paiyanur', 0, '0'),
(22, '6', 'Anniyur', 0, '0'),
(23, '8', 'Thellar', 0, '0'),
(24, '8', 'Koot Road', 1, '0'),
(25, '7', 'Manamathy', 0, '0'),
(26, '5', 'Echur', 0, '0'),
(27, '5', 'Sugar mill', 0, '0');

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
  `bank_creation` varchar(10) NOT NULL DEFAULT '1',
  `requestmodule` varchar(255) DEFAULT '1',
  `request` varchar(255) DEFAULT '1',
  `request_list_access` varchar(255) NOT NULL DEFAULT '1',
  `verificationmodule` varchar(255) DEFAULT '1',
  `verification` varchar(255) DEFAULT '1',
  `approvalmodule` varchar(255) NOT NULL DEFAULT '1',
  `approval` varchar(255) NOT NULL DEFAULT '1',
  `acknowledgementmodule` varchar(255) NOT NULL DEFAULT '1',
  `acknowledgement` varchar(255) NOT NULL DEFAULT '1',
  `loanissuemodule` varchar(255) DEFAULT '1',
  `loan_issue` varchar(255) DEFAULT '1',
  `collectionmodule` varchar(25) NOT NULL DEFAULT '1',
  `collection` varchar(25) NOT NULL DEFAULT '1',
  `collection_access` varchar(25) NOT NULL DEFAULT '1',
  `closedmodule` varchar(10) NOT NULL DEFAULT '1',
  `closed` varchar(10) NOT NULL DEFAULT '1',
  `nocmodule` varchar(10) NOT NULL DEFAULT '1',
  `noc` varchar(10) NOT NULL DEFAULT '1',
  `concernmodule` varchar(10) DEFAULT '1',
  `concern_creation` varchar(10) DEFAULT '1',
  `concern_solution` varchar(10) DEFAULT '1',
  `concern_feedback` varchar(50) DEFAULT '1',
  `accountsmodule` varchar(10) NOT NULL DEFAULT '1',
  `cash_tally` varchar(10) NOT NULL DEFAULT '1',
  `bank_details` varchar(255) DEFAULT NULL,
  `cash_tally_admin` varchar(10) NOT NULL DEFAULT '1',
  `bank_clearance` varchar(10) NOT NULL DEFAULT '1',
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

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `fullname`, `title`, `emailid`, `user_name`, `user_password`, `role`, `role_type`, `dir_id`, `ag_id`, `staff_id`, `company_id`, `branch_id`, `agentforstaff`, `line_id`, `group_id`, `mastermodule`, `company_creation`, `branch_creation`, `loan_category`, `loan_calculation`, `loan_scheme`, `area_creation`, `area_mapping`, `area_approval`, `adminmodule`, `director_creation`, `agent_creation`, `staff_creation`, `manage_user`, `doc_mapping`, `bank_creation`, `requestmodule`, `request`, `request_list_access`, `verificationmodule`, `verification`, `approvalmodule`, `approval`, `acknowledgementmodule`, `acknowledgement`, `loanissuemodule`, `loan_issue`, `collectionmodule`, `collection`, `collection_access`, `closedmodule`, `closed`, `nocmodule`, `noc`, `concernmodule`, `concern_creation`, `concern_solution`, `concern_feedback`, `accountsmodule`, `cash_tally`, `bank_details`, `cash_tally_admin`, `bank_clearance`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(1, 'Super', 'Admin', 'Super Admin', 'Super Admin', 'support@feathertechnology.in', 'support@feathertechnology.in', 'admin@123', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, '0', '0', '0', NULL, NULL, NULL, '2021-04-17 17:08:00', '2023-03-21 09:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `verification_bank_info`
--

CREATE TABLE `verification_bank_info` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(250) DEFAULT NULL,
  `req_id` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `acc_holder_name` varchar(100) NOT NULL,
  `acc_no` bigint(20) NOT NULL,
  `ifsc_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verification_cus_feedback`
--

CREATE TABLE `verification_cus_feedback` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(250) DEFAULT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `feedback_label` varchar(255) DEFAULT NULL,
  `cus_feedback` varchar(255) DEFAULT NULL,
  `feedback_remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verification_documentation`
--

CREATE TABLE `verification_documentation` (
  `id` int(11) NOT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `cus_id_doc` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `cus_profile_id` varchar(255) DEFAULT NULL,
  `doc_id` varchar(255) DEFAULT NULL,
  `mortgage_process` varchar(100) DEFAULT NULL,
  `Propertyholder_type` varchar(100) DEFAULT NULL,
  `Propertyholder_name` varchar(255) DEFAULT NULL,
  `Propertyholder_relationship_name` varchar(100) DEFAULT NULL,
  `doc_property_relation` varchar(100) DEFAULT NULL,
  `doc_property_type` varchar(255) DEFAULT NULL,
  `doc_property_measurement` varchar(255) DEFAULT NULL,
  `doc_property_location` varchar(255) DEFAULT NULL,
  `doc_property_value` varchar(255) DEFAULT NULL,
  `mortgage_name` varchar(255) DEFAULT NULL,
  `mortgage_dsgn` varchar(255) DEFAULT NULL,
  `mortgage_nuumber` varchar(255) DEFAULT NULL,
  `reg_office` varchar(255) DEFAULT NULL,
  `mortgage_value` varchar(255) DEFAULT NULL,
  `mortgage_document` varchar(255) DEFAULT NULL,
  `mortgage_document_upd` varchar(255) DEFAULT NULL,
  `mortgage_document_pending` varchar(150) DEFAULT NULL,
  `endorsement_process` varchar(50) DEFAULT NULL,
  `owner_type` varchar(100) DEFAULT NULL,
  `owner_name` varchar(200) DEFAULT NULL,
  `ownername_relationship_name` varchar(100) DEFAULT NULL,
  `en_relation` varchar(100) DEFAULT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `vehicle_process` varchar(50) DEFAULT NULL,
  `en_Company` varchar(200) DEFAULT NULL,
  `en_Model` varchar(200) DEFAULT NULL,
  `vehicle_reg_no` varchar(150) DEFAULT NULL,
  `endorsement_name` varchar(255) DEFAULT NULL,
  `en_RC` varchar(50) DEFAULT NULL,
  `Rc_document_upd` varchar(255) DEFAULT NULL,
  `Rc_document_pending` varchar(150) DEFAULT NULL,
  `en_Key` varchar(50) DEFAULT NULL,
  `gold_info` varchar(50) DEFAULT NULL,
  `gold_sts` varchar(50) DEFAULT NULL,
  `gold_type` varchar(255) DEFAULT NULL,
  `Purity` varchar(255) DEFAULT NULL,
  `gold_Count` varchar(255) DEFAULT NULL,
  `gold_Weight` varchar(255) DEFAULT NULL,
  `gold_Value` varchar(255) DEFAULT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `document_details` varchar(255) DEFAULT NULL,
  `document_type` varchar(50) DEFAULT NULL,
  `document_holder` varchar(50) DEFAULT NULL,
  `docholder_name` varchar(255) DEFAULT NULL,
  `docholder_relationship_name` varchar(50) DEFAULT NULL,
  `doc_relation` varchar(50) DEFAULT NULL,
  `cus_status` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `insert_login_id` varchar(50) DEFAULT NULL,
  `update_login_id` varchar(50) DEFAULT NULL,
  `delete_login_id` varchar(50) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verification_family_info`
--

CREATE TABLE `verification_family_info` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(100) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `verification_group_info`
--

CREATE TABLE `verification_group_info` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(250) DEFAULT NULL,
  `req_id` int(11) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `group_age` int(11) NOT NULL,
  `group_aadhar` text NOT NULL,
  `group_mobile` double NOT NULL,
  `group_gender` text NOT NULL,
  `group_designation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verification_kyc_info`
--

CREATE TABLE `verification_kyc_info` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(250) DEFAULT NULL,
  `req_id` int(11) NOT NULL,
  `proofOf` varchar(50) NOT NULL,
  `proof_type` varchar(50) NOT NULL,
  `proof_no` varchar(50) NOT NULL,
  `upload` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verification_loan_calculation`
--

CREATE TABLE `verification_loan_calculation` (
  `loan_cal_id` int(11) NOT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `cus_id_loan` varchar(255) DEFAULT NULL,
  `cus_name_loan` varchar(255) DEFAULT NULL,
  `cus_data_loan` varchar(255) DEFAULT NULL,
  `mobile_loan` varchar(255) DEFAULT NULL,
  `pic_loan` varchar(255) DEFAULT NULL,
  `loan_category` varchar(255) DEFAULT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `tot_value` varchar(255) DEFAULT NULL,
  `ad_amt` varchar(255) DEFAULT NULL,
  `loan_amt` varchar(255) DEFAULT NULL,
  `profit_type` varchar(255) DEFAULT NULL,
  `due_method_calc` varchar(255) DEFAULT NULL,
  `due_type` varchar(255) DEFAULT NULL,
  `profit_method` varchar(255) DEFAULT NULL,
  `calc_method` varchar(255) DEFAULT NULL,
  `due_method_scheme` varchar(255) DEFAULT NULL,
  `day_scheme` varchar(255) DEFAULT NULL,
  `scheme_name` varchar(255) DEFAULT NULL,
  `int_rate` varchar(255) DEFAULT NULL,
  `due_period` varchar(255) DEFAULT NULL,
  `doc_charge` varchar(255) DEFAULT NULL,
  `proc_fee` varchar(255) DEFAULT NULL,
  `loan_amt_cal` varchar(255) DEFAULT NULL,
  `principal_amt_cal` varchar(255) DEFAULT NULL,
  `int_amt_cal` varchar(255) DEFAULT NULL,
  `tot_amt_cal` varchar(255) DEFAULT NULL,
  `due_amt_cal` varchar(255) DEFAULT NULL,
  `doc_charge_cal` varchar(255) DEFAULT NULL,
  `proc_fee_cal` varchar(255) DEFAULT NULL,
  `net_cash_cal` varchar(255) DEFAULT NULL,
  `due_start_from` varchar(255) DEFAULT NULL,
  `maturity_month` varchar(255) DEFAULT NULL,
  `collection_method` varchar(255) DEFAULT NULL,
  `cus_status` varchar(255) DEFAULT NULL,
  `insert_login_id` varchar(255) DEFAULT NULL,
  `update_login_id` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp(),
  `update_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verification_property_info`
--

CREATE TABLE `verification_property_info` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(250) DEFAULT NULL,
  `req_id` int(11) NOT NULL,
  `property_type` varchar(50) NOT NULL,
  `property_measurement` varchar(50) NOT NULL,
  `property_value` varchar(50) NOT NULL,
  `property_holder` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verif_loan_cal_category`
--

CREATE TABLE `verif_loan_cal_category` (
  `cat_id` int(11) NOT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `loan_cal_id` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acknowledgement_loan_cal_category`
--
ALTER TABLE `acknowledgement_loan_cal_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `acknowlegement_customer_profile`
--
ALTER TABLE `acknowlegement_customer_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acknowlegement_documentation`
--
ALTER TABLE `acknowlegement_documentation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acknowlegement_loan_calculation`
--
ALTER TABLE `acknowlegement_loan_calculation`
  ADD PRIMARY KEY (`loan_cal_id`);

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
-- Indexes for table `bank_creation`
--
ALTER TABLE `bank_creation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_stmt`
--
ALTER TABLE `bank_stmt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_creation`
--
ALTER TABLE `branch_creation`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `cash_tally`
--
ALTER TABLE `cash_tally`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_tally_modes`
--
ALTER TABLE `cash_tally_modes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cheque_info`
--
ALTER TABLE `cheque_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cheque_no_list`
--
ALTER TABLE `cheque_no_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cheque_upd`
--
ALTER TABLE `cheque_upd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `closed_status`
--
ALTER TABLE `closed_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`coll_id`);

--
-- Indexes for table `collection_charges`
--
ALTER TABLE `collection_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_creation`
--
ALTER TABLE `company_creation`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `concern_creation`
--
ALTER TABLE `concern_creation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `concern_subject`
--
ALTER TABLE `concern_subject`
  ADD PRIMARY KEY (`concern_sub_id`);

--
-- Indexes for table `ct_bank_collection`
--
ALTER TABLE `ct_bank_collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_cr_bag`
--
ALTER TABLE `ct_cr_bag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_cr_bank_withdraw`
--
ALTER TABLE `ct_cr_bank_withdraw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_cr_bdeposit`
--
ALTER TABLE `ct_cr_bdeposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_cr_bel`
--
ALTER TABLE `ct_cr_bel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_cr_bexchange`
--
ALTER TABLE `ct_cr_bexchange`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_cr_binvest`
--
ALTER TABLE `ct_cr_binvest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_cr_boti`
--
ALTER TABLE `ct_cr_boti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_cr_cash_deposit`
--
ALTER TABLE `ct_cr_cash_deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_cr_hag`
--
ALTER TABLE `ct_cr_hag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_cr_hdeposit`
--
ALTER TABLE `ct_cr_hdeposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_cr_hel`
--
ALTER TABLE `ct_cr_hel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_cr_hexchange`
--
ALTER TABLE `ct_cr_hexchange`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_cr_hinvest`
--
ALTER TABLE `ct_cr_hinvest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_cr_hoti`
--
ALTER TABLE `ct_cr_hoti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_bag`
--
ALTER TABLE `ct_db_bag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_bank_deposit`
--
ALTER TABLE `ct_db_bank_deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_bdeposit`
--
ALTER TABLE `ct_db_bdeposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_bel`
--
ALTER TABLE `ct_db_bel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_bexchange`
--
ALTER TABLE `ct_db_bexchange`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_bexpense`
--
ALTER TABLE `ct_db_bexpense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_binvest`
--
ALTER TABLE `ct_db_binvest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_bissued`
--
ALTER TABLE `ct_db_bissued`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_cash_withdraw`
--
ALTER TABLE `ct_db_cash_withdraw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_exf`
--
ALTER TABLE `ct_db_exf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_hag`
--
ALTER TABLE `ct_db_hag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_hdeposit`
--
ALTER TABLE `ct_db_hdeposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_hel`
--
ALTER TABLE `ct_db_hel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_hexchange`
--
ALTER TABLE `ct_db_hexchange`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_hexpense`
--
ALTER TABLE `ct_db_hexpense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_hinvest`
--
ALTER TABLE `ct_db_hinvest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_db_hissued`
--
ALTER TABLE `ct_db_hissued`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_hand_collection`
--
ALTER TABLE `ct_hand_collection`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `document_info`
--
ALTER TABLE `document_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_mapping`
--
ALTER TABLE `doc_mapping`
  ADD PRIMARY KEY (`doc_map_id`);

--
-- Indexes for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fingerprints`
--
ALTER TABLE `fingerprints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gold_info`
--
ALTER TABLE `gold_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_acknowledgement`
--
ALTER TABLE `in_acknowledgement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_issue`
--
ALTER TABLE `in_issue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_verification`
--
ALTER TABLE `in_verification`
  ADD PRIMARY KEY (`req_id`);

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
-- Indexes for table `loan_issue`
--
ALTER TABLE `loan_issue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_scheme`
--
ALTER TABLE `loan_scheme`
  ADD PRIMARY KEY (`scheme_id`);

--
-- Indexes for table `loan_summary_feedback`
--
ALTER TABLE `loan_summary_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `name_detail_creation`
--
ALTER TABLE `name_detail_creation`
  ADD PRIMARY KEY (`name_id`);

--
-- Indexes for table `noc`
--
ALTER TABLE `noc`
  ADD PRIMARY KEY (`noc_id`);

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
-- Indexes for table `signed_doc`
--
ALTER TABLE `signed_doc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signed_doc_info`
--
ALTER TABLE `signed_doc_info`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `verification_cus_feedback`
--
ALTER TABLE `verification_cus_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification_documentation`
--
ALTER TABLE `verification_documentation`
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
-- Indexes for table `verification_loan_calculation`
--
ALTER TABLE `verification_loan_calculation`
  ADD PRIMARY KEY (`loan_cal_id`);

--
-- Indexes for table `verification_property_info`
--
ALTER TABLE `verification_property_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verif_loan_cal_category`
--
ALTER TABLE `verif_loan_cal_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acknowledgement_loan_cal_category`
--
ALTER TABLE `acknowledgement_loan_cal_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acknowlegement_customer_profile`
--
ALTER TABLE `acknowlegement_customer_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acknowlegement_documentation`
--
ALTER TABLE `acknowlegement_documentation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acknowlegement_loan_calculation`
--
ALTER TABLE `acknowlegement_loan_calculation`
  MODIFY `loan_cal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agent_communication_details`
--
ALTER TABLE `agent_communication_details`
  MODIFY `comm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agent_creation`
--
ALTER TABLE `agent_creation`
  MODIFY `ag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agent_group_creation`
--
ALTER TABLE `agent_group_creation`
  MODIFY `agent_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `area_creation`
--
ALTER TABLE `area_creation`
  MODIFY `area_creation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `area_group_mapping`
--
ALTER TABLE `area_group_mapping`
  MODIFY `map_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `area_line_mapping`
--
ALTER TABLE `area_line_mapping`
  MODIFY `map_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `area_list_creation`
--
ALTER TABLE `area_list_creation`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bank_creation`
--
ALTER TABLE `bank_creation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_stmt`
--
ALTER TABLE `bank_stmt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `branch_creation`
--
ALTER TABLE `branch_creation`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cash_tally`
--
ALTER TABLE `cash_tally`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `cash_tally_modes`
--
ALTER TABLE `cash_tally_modes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `cheque_info`
--
ALTER TABLE `cheque_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cheque_no_list`
--
ALTER TABLE `cheque_no_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cheque_upd`
--
ALTER TABLE `cheque_upd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `closed_status`
--
ALTER TABLE `closed_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `coll_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `collection_charges`
--
ALTER TABLE `collection_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `company_creation`
--
ALTER TABLE `company_creation`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `concern_creation`
--
ALTER TABLE `concern_creation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `concern_subject`
--
ALTER TABLE `concern_subject`
  MODIFY `concern_sub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ct_bank_collection`
--
ALTER TABLE `ct_bank_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_cr_bag`
--
ALTER TABLE `ct_cr_bag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_cr_bank_withdraw`
--
ALTER TABLE `ct_cr_bank_withdraw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_cr_bdeposit`
--
ALTER TABLE `ct_cr_bdeposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_cr_bel`
--
ALTER TABLE `ct_cr_bel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_cr_bexchange`
--
ALTER TABLE `ct_cr_bexchange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_cr_binvest`
--
ALTER TABLE `ct_cr_binvest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_cr_boti`
--
ALTER TABLE `ct_cr_boti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_cr_cash_deposit`
--
ALTER TABLE `ct_cr_cash_deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_cr_hag`
--
ALTER TABLE `ct_cr_hag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_cr_hdeposit`
--
ALTER TABLE `ct_cr_hdeposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_cr_hel`
--
ALTER TABLE `ct_cr_hel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_cr_hexchange`
--
ALTER TABLE `ct_cr_hexchange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_cr_hinvest`
--
ALTER TABLE `ct_cr_hinvest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_cr_hoti`
--
ALTER TABLE `ct_cr_hoti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_db_bag`
--
ALTER TABLE `ct_db_bag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_db_bank_deposit`
--
ALTER TABLE `ct_db_bank_deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ct_db_bdeposit`
--
ALTER TABLE `ct_db_bdeposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_db_bel`
--
ALTER TABLE `ct_db_bel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_db_bexchange`
--
ALTER TABLE `ct_db_bexchange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_db_bexpense`
--
ALTER TABLE `ct_db_bexpense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_db_binvest`
--
ALTER TABLE `ct_db_binvest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_db_bissued`
--
ALTER TABLE `ct_db_bissued`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_db_cash_withdraw`
--
ALTER TABLE `ct_db_cash_withdraw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_db_exf`
--
ALTER TABLE `ct_db_exf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_db_hag`
--
ALTER TABLE `ct_db_hag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_db_hdeposit`
--
ALTER TABLE `ct_db_hdeposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_db_hel`
--
ALTER TABLE `ct_db_hel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_db_hexchange`
--
ALTER TABLE `ct_db_hexchange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_db_hexpense`
--
ALTER TABLE `ct_db_hexpense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_db_hinvest`
--
ALTER TABLE `ct_db_hinvest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_db_hissued`
--
ALTER TABLE `ct_db_hissued`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `ct_hand_collection`
--
ALTER TABLE `ct_hand_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_register`
--
ALTER TABLE `customer_register`
  MODIFY `cus_reg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `director_creation`
--
ALTER TABLE `director_creation`
  MODIFY `dir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `document_info`
--
ALTER TABLE `document_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `doc_mapping`
--
ALTER TABLE `doc_mapping`
  MODIFY `doc_map_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `fingerprints`
--
ALTER TABLE `fingerprints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `gold_info`
--
ALTER TABLE `gold_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `in_acknowledgement`
--
ALTER TABLE `in_acknowledgement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `in_issue`
--
ALTER TABLE `in_issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_calculation`
--
ALTER TABLE `loan_calculation`
  MODIFY `loan_cal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `loan_category`
--
ALTER TABLE `loan_category`
  MODIFY `loan_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `loan_category_creation`
--
ALTER TABLE `loan_category_creation`
  MODIFY `loan_category_creation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `loan_category_ref`
--
ALTER TABLE `loan_category_ref`
  MODIFY `loan_category_ref_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `loan_issue`
--
ALTER TABLE `loan_issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_scheme`
--
ALTER TABLE `loan_scheme`
  MODIFY `scheme_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_summary_feedback`
--
ALTER TABLE `loan_summary_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `name_detail_creation`
--
ALTER TABLE `name_detail_creation`
  MODIFY `name_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `noc`
--
ALTER TABLE `noc`
  MODIFY `noc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `request_category_info`
--
ALTER TABLE `request_category_info`
  MODIFY `cat_info` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_creation`
--
ALTER TABLE `request_creation`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signed_doc`
--
ALTER TABLE `signed_doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signed_doc_info`
--
ALTER TABLE `signed_doc_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_creation`
--
ALTER TABLE `staff_creation`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `staff_type_creation`
--
ALTER TABLE `staff_type_creation`
  MODIFY `staff_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_area_list_creation`
--
ALTER TABLE `sub_area_list_creation`
  MODIFY `sub_area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `verification_bank_info`
--
ALTER TABLE `verification_bank_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verification_cus_feedback`
--
ALTER TABLE `verification_cus_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verification_documentation`
--
ALTER TABLE `verification_documentation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verification_family_info`
--
ALTER TABLE `verification_family_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verification_group_info`
--
ALTER TABLE `verification_group_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verification_kyc_info`
--
ALTER TABLE `verification_kyc_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verification_loan_calculation`
--
ALTER TABLE `verification_loan_calculation`
  MODIFY `loan_cal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verification_property_info`
--
ALTER TABLE `verification_property_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verif_loan_cal_category`
--
ALTER TABLE `verif_loan_cal_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
