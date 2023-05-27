-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 11:48 AM
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

--
-- Dumping data for table `acknowledgement_loan_cal_category`
--

INSERT INTO `acknowledgement_loan_cal_category` (`cat_id`, `req_id`, `loan_cal_id`, `category`) VALUES
(39, '17', '11', 'Fridge'),
(40, '17', '11', 'Fridge'),
(49, '18', '10', 'Vankozhi'),
(50, '18', '10', 'Nerupu kozhi'),
(51, '18', '10', 'Naatu Kozhi'),
(52, '15', '13', 'Mobile sales'),
(53, '15', '13', 'Car dealing'),
(54, '15', '13', 'Wood'),
(55, '10', '14', 'Fridge'),
(56, '10', '14', 'VCSM'),
(57, '11', '15', 'News Channel'),
(60, '20', '17', 'Onleplus'),
(61, '2', '18', 'Medical shop');

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

--
-- Dumping data for table `acknowlegement_customer_profile`
--

INSERT INTO `acknowlegement_customer_profile` (`id`, `req_id`, `cus_id`, `cus_name`, `gender`, `dob`, `age`, `blood_group`, `mobile1`, `mobile2`, `whatsapp`, `cus_pic`, `guarentor_name`, `guarentor_relation`, `guarentor_photo`, `cus_type`, `cus_exist_type`, `residential_type`, `residential_details`, `residential_address`, `residential_native_address`, `occupation_type`, `occupation_details`, `occupation_income`, `occupation_address`, `area_confirm_type`, `area_confirm_state`, `area_confirm_district`, `area_confirm_taluk`, `area_confirm_area`, `area_confirm_subarea`, `area_group`, `area_line`, `communication`, `com_audio`, `verification_person`, `verification_location`, `cus_status`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(2, '2', '885558978787', 'Remo', '1', '1997-05-15', '26', 'A1B+ve', '9696988888', '8788787874', '8788787874', 'pondicherry-has-beautiful-coast-india-famous-unexplored-beaches-beautiful-coastline-india-123124828.jpg', '4', 'Brother', 'photo-1541963463532-d68292c34b19.jpg', 'New', '', '0', 'House', 'Chennai', 'Chennai', '2', 'IT', '650000', 'Chennai', '0', 'TamilNadu', 'Chennai', 'Mylapore', '1', '1', 'GB', 'GB', '1', '', '3,4', '0', '10', NULL, '28', '28', NULL, '2023-04-13 11:56:13', '2023-04-19 14:56:55'),
(4, '18', '945454646565', 'Praveen', '1', '2009-04-17', '14', 'O+', '9844654654', '9846546546', '', 'wallpaperflare.com_wallpaper.jpg', '29', 'Brother', 'Order_ID_4479904631.jpg', 'New', '', '1', 'Vandavasi', 'Vandavasi', 'Vandavasi', '', '', '', '', '0', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '6', '11', 'G4', 'L4', '1', '', '28,29', '0', '10', NULL, '28', '28', NULL, '2023-04-20 10:58:38', '2023-04-21 10:16:27'),
(7, '17', '646546546546', 'Rajesh', '1', '1999-02-10', '24', 'O+', '9565565465', '9651321321', '', 'pexels-cesar-perez-733745.jpg', '31', 'Mother', 'programming-funny-jokes-e1600486875722.jpg', 'New', '', 'Select Residential Type', '', '', '', '2', 'Pondy', '15000', 'Pondy', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '6', '12', 'G4', 'L4', '1', '', '30', '1', '10', NULL, '28', NULL, NULL, '2023-04-20 17:27:28', '2023-04-20 17:27:28'),
(8, '15', '546546546465', 'Kuppusamy', '1', '1999-03-29', '24', 'AB+', '9646465546', '94654654', '', 'pexels-jakub-novacek-924824.jpg', '32', 'Father', 'WhatsApp Image 2023-01-20 at 11.43.56 AM.jpeg', 'Existing', '', '0', 'MG road', 'MG road', 'MG road', '', '', '', '', '0', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'G1', 'L2', '1', '', '32', '1', '10', NULL, '28', '28', NULL, '2023-04-21 09:56:49', '2023-04-21 10:15:22'),
(11, '10', '123456789101', 'Triple H', '1', '1999-07-15', '24', '', '9565654654', '', '', 'pexels-hansen-tang-13435926.jpg', '34', 'Father', 'creative-mars-collage.jpg', 'Existing', '', '0', 'Vandavasi', 'MG road', 'MG road', '', '', '', '', '0', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'G1', 'L2', '1', '', '34', '0', '10', NULL, '28', NULL, NULL, '2023-04-28 16:40:54', '2023-04-28 16:40:54'),
(12, '11', '123456789101', 'Triple H', '1', '1999-07-15', '24', '', '9565654654', '', '', 'pexels aleksandar pasaric 325185.jpg', '35', 'Brother', 'ecpXIUeY_400x400.jpg', 'Existing', '', '3', 'MG road', 'MG road', 'MG road', '', '', '', '', '0', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'G1', 'L2', '1', '', '35', '1', '10', NULL, '25', NULL, NULL, '2023-04-29 15:42:46', '2023-04-29 15:42:46'),
(14, '20', '105806052023', 'Rakesh', '1', '1990-06-06', '33', '', '8783565696', '9648123657', '', 'rakesh.png', '38', 'Mother', 'janaki.png', 'New', '', 'Select Residential Type', '', '', '', '3', 'Coconut shop', '15000', 'Bussy street, pondicherry', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'G1', 'L2', '1', '', '38', '0', '10', NULL, '21', NULL, NULL, '2023-05-06 11:08:43', '2023-05-06 11:08:43');

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

--
-- Dumping data for table `acknowlegement_documentation`
--

INSERT INTO `acknowlegement_documentation` (`id`, `req_id`, `cus_id_doc`, `customer_name`, `cus_profile_id`, `doc_id`, `mortgage_process`, `mortgage_process_noc`, `Propertyholder_type`, `Propertyholder_name`, `Propertyholder_relationship_name`, `doc_property_relation`, `doc_property_type`, `doc_property_measurement`, `doc_property_location`, `doc_property_value`, `mortgage_name`, `mortgage_dsgn`, `mortgage_nuumber`, `reg_office`, `mortgage_value`, `mortgage_document`, `mortgage_document_noc`, `mortgage_document_used`, `mortgage_document_upd`, `mortgage_document_pending`, `endorsement_process`, `endorsement_process_noc`, `owner_type`, `owner_name`, `ownername_relationship_name`, `en_relation`, `vehicle_type`, `vehicle_process`, `en_Company`, `en_Model`, `vehicle_reg_no`, `endorsement_name`, `en_RC`, `en_RC_noc`, `en_RC_used`, `Rc_document_upd`, `Rc_document_pending`, `en_Key`, `en_Key_noc`, `en_Key_used`, `gold_info`, `gold_sts`, `gold_type`, `Purity`, `gold_Count`, `gold_Weight`, `gold_Value`, `document_name`, `document_details`, `document_type`, `doc_info_upload`, `doc_info_upload_noc`, `doc_info_upload_used`, `document_holder`, `docholder_name`, `docholder_relationship_name`, `doc_relation`, `cus_status`, `status`, `submitted`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(1, '2', '885558978787', 'Remo', '2', 'DOC-101', '1', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', NULL, NULL, '1', '0', '', '', '', '', '', '', '', '', '', '', '', '0', '0', NULL, NULL, '', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XYZ', 'ABC', '0', NULL, '0', '0', '2', '', '3', 'Brother', '11', '0', NULL, '1', '1', NULL, '2023-04-17 17:51:47', '2023-04-17 17:51:47'),
(3, '18', '945454646565', 'Praveen', '4', 'DOC-102', '1', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '', 'YES', '1', '0', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '', 'YES', '', '0', '0', '1', '', '', '', '', '', '', 'Adhar', '123', '0', 'Invoice_4479904631.pdf', '0', '0', '0', 'Praveen', '', 'NIL', '11', '0', '1', '28', '1', NULL, '2023-04-20 13:20:51', '2023-04-20 13:20:51'),
(4, '17', '646546546546', 'Rajesh', '7', 'DOC-103', '1', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '', 'YES', '1', '0', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '', 'YES', '', '0', '0', '1', '', '', '', '', '', '', 'Adhar', '123', '0', '', '0', '0', '2', '', '30', 'Father', '11', '0', '1', '28', '1', NULL, '2023-04-20 17:30:15', '2023-04-20 17:30:15'),
(5, '15', '546546546465', 'Kuppusamy', '8', 'DOC-104', '1', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '', 'YES', '1', '0', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '', 'YES', '', '0', '0', '1', '', '', '', '', '', '', 'House Document', 'House Document', '0', ',', '0', '0', '0', 'Kuppusamy', '', 'NIL', '11', '0', '1', '1', '1', NULL, '2023-04-28 16:36:15', '2023-04-28 16:36:15'),
(6, '10', '123456789101', 'Triple H', '11', 'DOC-105', '1', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '', 'YES', '1', '0', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '', 'YES', '', '0', '0', '0', '0', 'TT', '24k', '2', '233', '54000', 'Adhar', '123', '0', 'loan_issue.sql', '0', '0', '2', '', '34', 'Father', '11', '0', '1', '28', '1', NULL, '2023-04-28 16:42:03', '2023-04-28 16:42:03'),
(7, '11', '123456789101', 'Triple H', '12', 'DOC-106', '0', '0', '0', 'Triple H', '', 'NIL', 'Building', '1651', 'Chennai', '12345', 'gfgfddgh', 'gghd', '4654654', 'hfgh', '646545', '1', '0', '0', '', 'YES', '1', '0', '', '', '', '', '', '', '', '', '', '', NULL, '0', '0', '', 'YES', NULL, '0', '0', '1', '', '', '', '', '', '', 'Adhar', '123', '1', ',', '0', '0', '1', 'Under taker', '', 'Brother', '11', '0', '1', '25', '1', NULL, '2023-04-29 15:43:43', '2023-04-29 15:43:43'),
(9, '20', '105806052023', 'Rakesh', '14', 'DOC-108', '0', '0', '0', 'Rakesh', '', 'NIL', 'Construction', '1845', 'Coimbatore', '542126', 'Const', 'rrr', '654528', 'CB', '984654', '0', '0', '0', '', 'NO', '0', '0', '', '', '', '', '', '', '', '', '', '', NULL, '0', '0', '', 'YES', '0', '0', '0', '0', '0', 'Necklace', '24k', '1', '0.586g', '47500', 'DL', 'License', '0', 'rakesh.png', '0', '0', '0', 'Rakesh', '', 'NIL', '11', '0', '1', '21', '28', NULL, '2023-05-06 11:10:41', '2023-05-06 11:10:41');

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

--
-- Dumping data for table `acknowlegement_loan_calculation`
--

INSERT INTO `acknowlegement_loan_calculation` (`loan_cal_id`, `req_id`, `cus_id_loan`, `cus_name_loan`, `cus_data_loan`, `mobile_loan`, `pic_loan`, `loan_category`, `sub_category`, `tot_value`, `ad_amt`, `loan_amt`, `profit_type`, `due_method_calc`, `due_type`, `profit_method`, `calc_method`, `due_method_scheme`, `day_scheme`, `scheme_name`, `int_rate`, `due_period`, `doc_charge`, `proc_fee`, `loan_amt_cal`, `principal_amt_cal`, `int_amt_cal`, `tot_amt_cal`, `due_amt_cal`, `doc_charge_cal`, `proc_fee_cal`, `net_cash_cal`, `due_start_from`, `maturity_month`, `collection_method`, `cus_status`, `insert_login_id`, `update_login_id`, `create_date`, `update_date`) VALUES
(10, '18', '945454646565', 'Praveen', 'New', '9844654654', 'wallpaperflare.com_wallpaper.jpg', '2', 'Business', '50000', '5000', '45000', '2', '', '', '', '', '3', '', '3', '10', '100', '15', '10', '45000', '40500', '4500', '45000', '450', '15', '10', '40475', '2023-05-05', '2023-06-05', '1', '12', '1', '1', '2023-04-20 17:19:26', '2023-04-21 09:48:19'),
(11, '17', '646546546546', 'Rajesh', 'New', '9565565465', 'pexels-cesar-perez-733745.jpg', '5', 'Multi Things', '25000', '5000', '20000', '2', 'Monthly', '', '', '', '3', '', '8', '10', '22', '1500', '1500', '20000', '18000', '2000', '20000', '909.0909090909091', '1500', '1500', '15000', '2023-05-05', '2023-08-13', '2', '12', '28', NULL, '2023-04-20 17:53:38', '2023-04-20 17:53:38'),
(13, '15', '546546546465', 'Kuppusamy', 'Existing', '9646465546', 'pexels-jakub-novacek-924824.jpg', '2', 'Business', '94654', '7504', '87150', '1', 'Monthly', 'Interest', '', 'Monthly', '', '', '', '2', '2', '2', '2', '87150', '87150', '1745', '', '', '1743', '1743', '83664', '2023-04-07', '2023-06-07', '1', '12', '1', NULL, '2023-04-28 16:36:56', '2023-04-28 16:36:56'),
(14, '10', '123456789101', 'Triple H', 'Existing', '9565654654', 'pexels-hansen-tang-13435926.jpg', '5', 'Multi Things', '24864', '943', '23921', '2', '', '', '', '', '1', '', '4', '5', '9', '1000', '1242', '23921', '22725', '1200', '23921', '2657', '1000', '1242', '20483', '2023-05-06', '2024-01-05', '2', '12', '28', NULL, '2023-04-28 16:43:27', '2023-04-28 16:43:27'),
(15, '11', '123456789101', 'Triple H', 'Existing', '9565654654', 'pexels-hansen-tang-13435926.jpg', '2', 'Business', '50000', '5000', '45000', '2', '', '', '', '', '3', '', '3', '10', '100', '20', '10', '45000', '40500', '4500', '45000', '450', '20', '10', '40470', '2023-05-06', '2023-08-13', '1', '12', '25', NULL, '2023-04-29 15:44:10', '2023-04-29 15:44:10'),
(17, '20', '105806052023', 'Rakesh', 'New', '8783565696', 'rakesh.png', '5', 'Mobile', '23500', '3500', '20000', '2', '', '', '', '', '1', '', '11', '0.7', '10', '1500', '1500', '20000', '19860', '140', '20000', '2000', '1500', '1500', '16860', '2023-05-03', '2024-03-03', '1', '12', '21', NULL, '2023-05-06 11:20:14', '2023-05-06 11:20:14'),
(18, '2', '885558978787', 'Remo', 'New', '9696988888', 'pondicherry-has-beautiful-coast-india-famous-unexplored-beaches-beautiful-coastline-india-123124828.jpg', '2', 'Business', '15000', '5000', '10000', '1', 'Monthly', 'Interest', '', 'Monthly', '', '', '', '1.5', '3', '1.5', '1.8', '10000', '10000', '150', '', '', '150', '180', '9670', '2023-06-02', '2023-09-02', '1', '12', '28', NULL, '2023-05-18 12:39:07', '2023-05-18 12:39:07');

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
(71, '1', 'Arun', 'Manager', '2342342342', '4234234234'),
(72, '1', 'Kumar ', 'Assistant Manager', '9565654234', '4654234234'),
(73, '27', 'asf', 'asdf', '2343534545', '4565656565'),
(78, '25', 'asdf', 'as', '1243', '234'),
(79, '24', 'asdf', 'asdf', '24', '34'),
(80, '15', 'Dinesh', 'Director', '9446665465', '9654654646'),
(82, '28', 'Dinesh', 'Manager', '9964655665', '9465465645'),
(83, '29', 'Arun', 'Leader', '9446546546', '9486546546'),
(84, '30', 'Suresh', 'TL', '9565465465', '9494654654'),
(86, '31', 'Kumar', 'Hr', '9454654654', '9464654654'),
(90, '32', '', '', '', ''),
(91, '33', '', '', '', ''),
(92, '34', '', '', '', ''),
(93, '16', 'Thirugnana samanthar', 'Director', '96969695', '94518445');

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
(16, 'AG-103', 'Alangar', '15', '1', '', 'test1@email.com', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vandavasi', '606566', '5', 'Multi Things', '4,8', '1', '1', '0', 'KVB', 'Vandavasi', '13213165465321', 'KVB123456', 'THIRUGNANA SAMANTHAR', 'More Info', 0, '1', '1', NULL, '2023-03-15 17:21:25', '2023-04-26 17:44:09'),
(28, 'AG-104', 'Darling & Co', '24', '1', '', '', 'TamilNadu', 'Ariyalur', 'Andimadam', 'Ambatur', '606564', '2', 'Business', '3', '1', '0', '1', 'Indian Bank', 'Guindy', '64654654654654', 'IB1234654', 'DINESH', '', 0, '1', '1', NULL, '2023-03-29 15:18:14', '2023-03-29 15:18:39'),
(29, 'AG-105', 'Alangar & Co', '15', '1', '', '', 'TamilNadu', 'Chennai', 'Alandur', 'Vandavasi', '606546', '5', 'Laptops,Electronics', '6', '0', '1', '0', 'Indian Bank', 'Guindy', '545676856785', 'KVB123456', 'ARUN NATARAJAN', '', 0, '1', NULL, NULL, '2023-03-29 15:21:11', '2023-03-29 15:21:11'),
(30, 'AG-106', 'Laksmi Electronics', '22', '1', '', '', 'TamilNadu', 'Chennai', 'Egmore', 'Guindy', '654654', '5', 'Laptops', '', '1', '0', '1', 'KVB', 'Ambatur', '56465464654', 'KVB123456', 'Suresh', '', 0, '1', NULL, NULL, '2023-03-29 15:22:50', '2023-03-29 15:22:50'),
(31, 'AG-107', 'AS&co', '25', '4', '', '', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Birdhur', '609599', '2,5', 'Electronics,Business', '6', '0', '1', '0', 'Indian Bank', 'Guindy', '334534534535', 'KVB123456', 'Kumar', '', 0, '1', '28', NULL, '2023-04-17 12:27:14', '2023-04-21 11:19:03');

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
(24, 'Darling & Co', '0'),
(25, 'AS', '0');

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
(5, 'L6', '7,9', '13', '1', '2', '0', '1', '1', NULL, '2023-04-10 16:04:25', '2023-05-25 15:13:56');

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
(3, 'Indian Bank', 'IB', '1684984654654', 'IB1234654', 'MG road', 'qrcode.png', '9465465486', '2', '3', '0', '1', '1', NULL, '2023-05-24 14:02:26', '2023-05-24 14:02:26'),
(5, 'Laxhmi Vilas Bank', 'LVB', '9486541321312', 'LVB31321', 'Vandavasi', '', '', '1', '1,2', '0', '1', '1', '1', '2023-05-24 14:08:25', '2023-05-24 14:08:25'),
(6, 'Karur Vaisya Bank', 'KVB', '61321681651313', 'KVB123456', 'Mahe', '', '6965132132', '2', '3', '0', '1', '1', NULL, '2023-05-24 14:09:39', '2023-05-24 14:09:39');

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

--
-- Dumping data for table `cash_tally_modes`
--

INSERT INTO `cash_tally_modes` (`id`, `modes`, `admin_access`, `handcredit`, `bankcredit`, `handdebit`, `bankdebit`) VALUES
(1, 'Collection', '1', '0', '0', '1', '1'),
(2, 'Bank Withdrawal', '1', '0', '1', '1', '1'),
(3, 'Other Income', '1', '0', '0', '1', '1'),
(4, 'Exchange', '1', '0', '0', '0', '0'),
(5, 'Cash Deposit', '1', '1', '0', '1', '1'),
(6, 'Bank Deposit', '1', '1', '1', '0', '1'),
(7, 'Cash Withdrawal', '1', '1', '1', '1', '0'),
(8, 'Agent', '1', '0', '0', '0', '0'),
(9, 'Investment', '0', '0', '0', '0', '0'),
(10, 'Deposit', '0', '0', '0', '0', '0'),
(11, 'EL', '0', '0', '0', '0', '0'),
(12, 'Excess Fund', '0', '1', '1', '1', '0'),
(13, 'Issued', '1', '1', '1', '0', '0'),
(14, 'Expenses', '1', '1', '1', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `cheque_info`
--

CREATE TABLE `cheque_info` (
  `id` int(11) NOT NULL,
  `req_id` varchar(50) DEFAULT NULL,
  `cus_profile_id` varchar(50) DEFAULT NULL,
  `holder_type` varchar(255) DEFAULT NULL,
  `holder_name` varchar(255) DEFAULT NULL,
  `holder_relationship_name` varchar(255) DEFAULT NULL,
  `cheque_relation` varchar(255) DEFAULT NULL,
  `chequebank_name` varchar(255) DEFAULT NULL,
  `cheque_count` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cheque_info`
--

INSERT INTO `cheque_info` (`id`, `req_id`, `cus_profile_id`, `holder_type`, `holder_name`, `holder_relationship_name`, `cheque_relation`, `chequebank_name`, `cheque_count`) VALUES
(2, '2', '2', '1', 'Ini', '', 'Father', 'ICICI', '4'),
(3, '2', '2', '2', '', '3', 'Brother', 'IOB', '6'),
(6, '2', '2', '0', 'Remo', '', 'NIL', 'TMB', '12'),
(7, '18', '11', '0', 'Praveen', '', 'NIL', 'jkdfd', '34'),
(8, '17', '7', '1', 'Manimegalai', '', 'Mother', 'ION', '3'),
(9, '15', '8', '0', 'Kuppusamy', '', 'NIL', 'IOb', '2'),
(10, '10', '11', '2', 'Dad', '34', 'Father', 'FF', '1'),
(11, '20', '14', '2', 'Delhi Babu', '37', 'Father', 'HDFC', '1'),
(12, '20', '14', '0', 'Rakesh', '', 'NIL', 'KVB', '1'),
(13, '14', '15', '1', 'Magesh', '', 'Brother', 'ION', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cheque_no_list`
--

CREATE TABLE `cheque_no_list` (
  `id` int(11) NOT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `cheque_table_id` varchar(255) DEFAULT NULL,
  `cheque_holder_type` varchar(255) DEFAULT NULL,
  `cheque_holder_name` varchar(255) DEFAULT NULL,
  `cheque_no` varchar(200) DEFAULT NULL,
  `used_status` varchar(255) NOT NULL DEFAULT '0',
  `noc_given` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cheque_no_list`
--

INSERT INTO `cheque_no_list` (`id`, `req_id`, `cheque_table_id`, `cheque_holder_type`, `cheque_holder_name`, `cheque_no`, `used_status`, `noc_given`) VALUES
(1, '17', '8', ' 1', 'Manimegalai', '2343', '0', '0'),
(2, '17', '8', ' 1', 'Manimegalai', '2345', '0', '0'),
(3, '17', '8', ' 1', 'Manimegalai', '345', '0', '0'),
(4, '10', NULL, '2', 'Dad', '84654654654', '0', '0'),
(5, '20', '12', ' 0', 'Rakesh', '27123', '0', '0'),
(6, '20', '11', ' 2', '37', '8338', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cheque_upd`
--

CREATE TABLE `cheque_upd` (
  `id` int(11) NOT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `cheque_table_id` varchar(255) DEFAULT NULL,
  `upload_cheque_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cheque_upd`
--

INSERT INTO `cheque_upd` (`id`, `req_id`, `cheque_table_id`, `upload_cheque_name`) VALUES
(1, '3', '7', 'the-interior-of-the-repair-interior-design-159045.jpeg'),
(2, '3', '7', 'herbs-flavoring-seasoning-cooking.jpg'),
(3, '3', '7', 'sample.gif'),
(4, '3', '7', 'kevin-ku-w7ZyuGYNpRQ-unsplash.jpg'),
(5, '15', '9', 'verification_family_info (1).sql'),
(6, '15', '9', 'verification_family_info.sql'),
(7, '10', '10', 'loan_issue.sql'),
(11, '17', '8', 'loan_issue.sql'),
(12, '17', '8', 'ramasamy-periyar.jpg'),
(13, '17', '8', 'ecpXIUeY_400x400.jpg'),
(14, '20', '12', 'rakesh.png'),
(15, '20', '11', 'ramasamy-periyar.jpg');

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

--
-- Dumping data for table `closed_status`
--

INSERT INTO `closed_status` (`id`, `req_id`, `cus_id`, `closed_sts`, `consider_level`, `remark`, `cus_sts`, `insert_login_id`, `update_login_id`, `created_date`, `updated_date`) VALUES
(1, '20', '105806052023', '1', '5', 'Ok', '20', '1', '1', '2023-05-11 18:33:37', '2023-05-11 18:33:37');

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

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`coll_id`, `coll_code`, `req_id`, `cus_id`, `cus_name`, `branch`, `area`, `sub_area`, `line`, `loan_category`, `sub_category`, `coll_status`, `coll_sub_status`, `tot_amt`, `paid_amt`, `bal_amt`, `due_amt`, `pending_amt`, `payable_amt`, `penalty`, `coll_charge`, `coll_mode`, `cheque_no`, `trans_id`, `trans_date`, `coll_location`, `coll_date`, `due_amt_track`, `penalty_track`, `coll_charge_track`, `total_paid_track`, `pre_close_waiver`, `penalty_waiver`, `coll_charge_waiver`, `total_waiver`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(29, 'COL-101', '10', '123456789101', 'Triple H', '2', '1', '3', '2', '5', 'Multi Things', 'Present', 'Pending', '23921', '0', '23921', '2657', '2657', '2657', '0', '0', '1', '', '', '0000-00-00', '3', '2023-05-16 00:00:00', '2657', '', '', '2657', '', '', '', '', '1', NULL, NULL, '2023-05-16 09:50:33', '2023-05-16 09:50:33'),
(31, 'COL-102', '11', '123456789101', 'Triple H', '2', '1', '3', '2', '2', 'Business', 'Present', 'Pending', '45000', '0', '45000', '450', '9000', '9450', '207', '0', '2', '', '', '0000-00-00', '2', '2023-05-26 00:00:00', '450', '', '', '450', '', '', '', '', '28', NULL, NULL, '2023-05-26 18:25:41', '2023-05-26 18:25:41'),
(32, 'COL-103', '11', '123456789101', 'Triple H', '2', '1', '3', '2', '2', 'Business', 'Present', 'Pending', '45000', '450', '44550', '450', '8550', '9000', '207', '0', '1', '', '', '0000-00-00', '2', '2023-05-26 00:00:00', '450', '', '', '450', '', '', '', '', '28', NULL, NULL, '2023-05-26 18:25:54', '2023-05-26 18:25:54'),
(33, 'COL-104', '11', '123456789101', 'Triple H', '2', '1', '3', '2', '2', 'Business', 'Present', 'Pending', '45000', '900', '44100', '450', '8100', '8550', '207', '0', '1', '', '', '0000-00-00', '3', '2023-05-26 00:00:00', '450', '', '', '450', '', '', '', '', '28', NULL, NULL, '2023-05-26 18:26:05', '2023-05-26 18:26:05'),
(34, 'COL-105', '11', '123456789101', 'Triple H', '2', '1', '3', '2', '2', 'Business', 'Present', 'Pending', '45000', '1350', '43650', '450', '7650', '8100', '207', '0', '1', '', '', '0000-00-00', '1', '2023-05-26 00:00:00', '450', '', '', '450', '', '', '', '', '24', NULL, NULL, '2023-05-26 18:26:18', '2023-05-26 18:26:18'),
(35, 'COL-106', '11', '123456789101', 'Triple H', '3', '1', '3', '2', '2', 'Business', 'Present', 'Pending', '45000', '1800', '43200', '450', '7200', '7650', '207', '0', '1', '', '', '0000-00-00', '1', '2023-05-26 00:00:00', '450', '', '', '450', '', '', '', '', '28', NULL, NULL, '2023-05-26 18:26:30', '2023-05-26 18:26:30'),
(36, 'COL-107', '11', '123456789101', 'Triple H', '2', '1', '3', '2', '2', 'Business', 'Present', 'Pending', '45000', '2250', '42750', '450', '6750', '7200', '207', '0', '3', '', '', '0000-00-00', '1', '2023-05-26 00:00:00', '450', '', '', '450', '', '', '', '', '28', NULL, NULL, '2023-05-26 18:26:48', '2023-05-26 18:26:48'),
(37, 'COL-108', '11', '123456789101', 'Triple H', '2', '1', '3', '2', '2', 'Business', 'Present', 'Pending', '45000', '2700', '42300', '450', '6300', '6750', '207', '0', '2', '', '', '0000-00-00', '2', '2023-05-26 00:00:00', '450', '', '', '450', '', '', '', '', '1', NULL, NULL, '2023-05-26 18:28:03', '2023-05-26 18:28:03'),
(38, 'COL-109', '11', '123456789101', 'Triple H', '2', '1', '3', '2', '2', 'Business', 'Present', 'Pending', '45000', '3150', '41850', '450', '5850', '6300', '207', '0', '1', '', '', '0000-00-00', '1', '2023-05-26 00:00:00', '900', '', '', '900', '', '', '', '', '24', NULL, NULL, '2023-05-26 18:28:15', '2023-05-26 18:28:15');

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
(1, 'Darling', 'MG road', 'Chinnakadai', 'Puducherry', 'Puducherry', 'Villianur', 'Bussy Street', '605100', '', '', '', '', '', '0', 1, 1, '2023-03-11 14:34:40', '2023-03-17 15:52:47'),
(2, 'ABC Furnitures', 'Bussy street', 'line 2', 'TamilNadu', 'Ariyalur', 'Sendurai', 'Tamilnadu', '605312', '', '', '', '', '', '0', 1, 1, '2023-03-11 14:41:09', '2023-03-17 15:53:11'),
(4, 'as motors', 'bussy street', 'pondicherry', 'Puducherry', 'Puducherry', 'Oulgaret', 'Pondicherry', '123', '', '', '', '', '', '0', 1, 1, '2023-03-17 15:51:56', '2023-03-17 15:53:17');

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

--
-- Dumping data for table `concern_creation`
--

INSERT INTO `concern_creation` (`id`, `raising_for`, `self_name`, `self_code`, `staff_name`, `staff_dept_name`, `staff_team_name`, `ag_name`, `ag_grp`, `cus_id`, `cus_name`, `cus_area`, `cus_sub_area`, `cus_group`, `cus_line`, `com_date`, `com_code`, `branch_name`, `concern_to`, `to_dept_name`, `to_team_name`, `com_sub`, `com_remark`, `com_priority`, `staff_assign_to`, `status`, `solution_date`, `communication`, `uploads`, `solution_remark`, `feedback_date`, `feedback_rating`, `insert_user_id`, `update_user_id`, `delete_user_id`, `created_date`, `updated_date`) VALUES
(1, '4', '', '', '', '', '', '', '', '546546546465', 'Kuppusamy', 'Vandavasi', 'Pudhu Street', 'G1', 'L2', '2023-05-25', 'CC-101', '1', '1', 'Sales', '', '1', 'Bad behaviour', '2', '7', 1, '2023-05-25', '2', '', 'gook', NULL, NULL, '21', '29', NULL, '2023-05-25 14:54:50', '2023-05-25 14:56:16');

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

--
-- Dumping data for table `concern_subject`
--

INSERT INTO `concern_subject` (`concern_sub_id`, `concern_subject`, `status`, `insert_user_id`, `update_user_id`, `delete_user_id`, `created_date`, `updated_date`) VALUES
(1, 'Behaviour', 0, NULL, NULL, NULL, '2023-05-25 14:54:38', '2023-05-25 14:54:38');

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

--
-- Dumping data for table `customer_profile`
--

INSERT INTO `customer_profile` (`id`, `req_id`, `cus_id`, `cus_name`, `gender`, `dob`, `age`, `blood_group`, `mobile1`, `mobile2`, `whatsapp`, `cus_pic`, `guarentor_name`, `guarentor_relation`, `guarentor_photo`, `cus_type`, `cus_exist_type`, `residential_type`, `residential_details`, `residential_address`, `residential_native_address`, `occupation_type`, `occupation_details`, `occupation_income`, `occupation_address`, `area_confirm_type`, `area_confirm_state`, `area_confirm_district`, `area_confirm_taluk`, `area_confirm_area`, `area_confirm_subarea`, `area_group`, `area_line`, `communication`, `com_audio`, `verification_person`, `verification_location`, `cus_status`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(1, '1', '874589565541', 'Azil', '1', '1997-09-18', '25', 'A+ve', '7418522211', '7878754545', '7010101010', 'tree-736885__480.jpg', '2', 'Sister', 'pexels-pixabay-268533.jpg', 'New', '', '0', 'Individual House', 'St.Thomas Mount,  Chennai', 'St.Thomas Mount, Chennai', '', '', '', '', '0', 'TamilNadu', 'Chennai', 'Mylapore', '1', '1', NULL, NULL, '1', '', '1,2', '0', '2', NULL, '28', NULL, NULL, '2023-04-11 17:10:30', '2023-04-19 14:40:00'),
(2, '2', '885558978787', 'Remo', '1', '1997-05-15', '26', 'A1B+ve', '9696988888', '8788787874', '8788787874', 'pondicherry-has-beautiful-coast-india-famous-unexplored-beaches-beautiful-coastline-india-123124828.jpg', '4', 'Brother', 'photo-1541963463532-d68292c34b19.jpg', 'New', '', '0', 'House', 'Chennai', 'Chennai', '2', 'IT', '650000', 'Chennai', '0', 'TamilNadu', 'Chennai', 'Mylapore', '1', '1', 'GB', 'GB', '1', '', '3,4', '0', '10', NULL, '28', '28', NULL, '2023-04-13 11:56:13', '2023-04-19 14:56:55'),
(4, '18', '945454646565', 'Praveen', '1', '2009-04-17', '14', 'O+', '9844654654', '9846546546', '', 'wallpaperflare.com_wallpaper.jpg', '29', 'Brother', 'Order_ID_4479904631.jpg', 'New', '', '1', 'Vandavasi', 'Vandavasi', 'Vandavasi', '', '', '', '', '0', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '6', '11', 'G4', 'L4', '1', '', '28,29', '0', '10', NULL, '28', '28', NULL, '2023-04-20 10:58:38', '2023-04-21 10:16:27'),
(7, '17', '646546546546', 'Rajesh', '1', '1999-02-10', '24', 'O+', '9565565465', '9651321321', '', 'pexels-cesar-perez-733745.jpg', '31', 'Mother', 'programming-funny-jokes-e1600486875722.jpg', 'New', '', 'Select Residential Type', '', '', '', '2', 'Pondy', '15000', 'Pondy', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '6', '12', 'G4', 'L4', '1', '', '30', '1', '10', NULL, '28', NULL, NULL, '2023-04-20 17:27:28', '2023-04-20 17:27:28'),
(8, '15', '546546546465', 'Kuppusamy', '1', '1999-03-29', '24', 'AB+', '9646465546', '94654654', '', 'pexels-jakub-novacek-924824.jpg', '32', 'Father', 'WhatsApp Image 2023-01-20 at 11.43.56 AM.jpeg', 'Existing', '', '0', 'MG road', 'MG road', 'MG road', '', '', '', '', '0', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'G1', 'L2', '1', '', '32', '1', '10', NULL, '28', '28', NULL, '2023-04-21 09:56:49', '2023-04-21 10:15:22'),
(11, '10', '123456789101', 'Triple H', '1', '1999-07-15', '24', '', '9565654654', '', '', 'pexels-hansen-tang-13435926.jpg', '34', 'Father', 'creative-mars-collage.jpg', 'Existing', '', '0', 'Vandavasi', 'MG road', 'MG road', '', '', '', '', '0', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'G1', 'L2', '1', '', '34', '0', '10', NULL, '28', NULL, NULL, '2023-04-28 16:40:54', '2023-04-28 16:40:54'),
(12, '11', '123456789101', 'Triple H', '1', '1999-07-15', '24', '', '9565654654', '', '', 'pexels-hansen-tang-13435926.jpg', '35', 'Brother', 'ecpXIUeY_400x400.jpg', 'Existing', '', '3', 'MG road', 'MG road', 'MG road', '', '', '', '', '0', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'G1', 'L2', '1', '', '35', '1', '10', NULL, '25', NULL, NULL, '2023-04-29 15:42:46', '2023-04-29 15:42:46'),
(13, '3', '546546546465', 'Kuppusamy', '1', '2023-03-29', '0', '', '9646465546', '94654654', '', 'pexels-jakub-novacek-924824.jpg', '36', 'Other', 'ramasamy-periyar.jpg', 'New', '', 'Select Residential Type', '', '', '', '4', 'Pondy', '15654', 'Pondy', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'G1', 'L2', '1', '', '36', '0', '10', NULL, '25', NULL, NULL, '2023-04-29 15:54:50', '2023-04-29 15:54:50'),
(14, '20', '105806052023', 'Rakesh', '1', '1990-06-06', '33', '', '8783565696', '9648123657', '', 'rakesh.png', '38', 'Mother', 'janaki.png', 'New', '', 'Select Residential Type', '', '', '', '3', 'Coconut shop', '15000', 'Bussy street, pondicherry', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'G1', 'L2', '1', '', '38', '0', '10', NULL, '21', NULL, NULL, '2023-05-06 11:08:43', '2023-05-06 11:08:43'),
(15, '14', '546546546465', 'Kuppusamy', '1', '2023-03-29', '0', '', '9646465546', '94654654', '', 'pexels-jakub-novacek-924824.jpg', '39', 'Brother', 'cheque_no_list.sql', 'Existing', '', '1', 'Vandavasi', 'MG road', 'MG road', '', '', '', '', '0', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '6', '12', 'G4', 'L4', '1', '', '39', '0', '10', NULL, '28', NULL, NULL, '2023-05-06 11:24:51', '2023-05-06 11:24:51');

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

--
-- Dumping data for table `customer_register`
--

INSERT INTO `customer_register` (`cus_reg_id`, `req_ref_id`, `cus_id`, `customer_name`, `dob`, `age`, `gender`, `blood_group`, `state`, `district`, `taluk`, `area`, `sub_area`, `address`, `mobile1`, `mobile2`, `father_name`, `mother_name`, `marital`, `spouse`, `occupation_type`, `occupation`, `pic`, `how_to_know`, `loan_count`, `first_loan_date`, `travel_with_company`, `monthly_income`, `other_income`, `support_income`, `commitment`, `monthly_due_capacity`, `loan_limit`, `about_customer`, `residential_type`, `residential_details`, `residential_address`, `residential_native_address`, `occupation_info_occ_type`, `occupation_details`, `occupation_income`, `occupation_address`, `area_confirm_type`, `area_confirm_state`, `area_confirm_district`, `area_confirm_taluk`, `area_confirm_area`, `area_confirm_subarea`, `area_group`, `area_line`, `cus_status`, `create_time`) VALUES
(2, '2', '213132132132', 'Logeshwaran', '1981-01-28', '42', '2', 'O+', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'Check', '9969696969', '9695494996', 'Kuppusamy', 'Mariyamma', '1', 'Selvi', '7', 'KMC', 'pexels-markus-spiske-4383298.jpg', '0', '', '', '', '234', '234', '234', '12', '2', '1', 'sdfg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', '2023-04-01 11:39:58'),
(3, '3', '546546546465', 'Kuppusamy', '2023-03-29', '0', '1', '', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9646465546', '94654654', 'Karuppan', 'Jekkamma', '2', '', '2', 'KMC', 'pexels-jakub-novacek-924824.jpg', '1', '', '', '', '23344', '0', '0', '0', '2620', '26000', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2023-04-01 13:19:58'),
(4, '5', '289499396919', 'Arun', '1999-04-27', '24', '1', NULL, 'Puducherry', 'Puducherry', 'Puducherry', '8', '7', 'Chinnakadai', '9654566456', '', 'Natarajan', 'Parameswari', '2', '', '3', 'Developer', 'pexels aleksandar pasaric 325185.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2023-04-03 12:29:54'),
(7, '6', '123456789101', 'Triple H', '1999-07-15', '24', '1', '', 'Puducherry', 'Puducherry', 'Puducherry', '8', '8', 'MG road', '9565654654', '', 'Roman reigns', 'Nikki', '1', 'Manju warrior', '4', 'Uzhavan', 'pexels-hansen-tang-13435926.jpg', '2', '', '', '', '6546', '654', '984', '654', '654', '94401', 'Ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2023-04-03 13:35:26'),
(8, '7', '123456789102', 'Swetha', '2005-05-02', '18', '2', NULL, 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'Pudhu street', '9694999999', '', 'Thookudurai', 'Niranjana', '2', '', '4', 'Actor', 'wallpaperflare.com_wallpaper.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', '2023-04-03 13:39:44'),
(12, '12', '546546546465', 'Kuppusamy', '2023-03-29', '0', '1', '', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9646465546', '94654654', 'Karuppan', 'Jekkamma', '2', '', '2', 'KMC', 'pexels-jakub-novacek-924824.jpg', '1', '', '', '', '23344', '0', '0', '0', '2620', '26000', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-04-04 10:56:10'),
(13, '13', '963852741123', 'Kumaran', '2023-03-16', '0', '1', NULL, 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '2353645675', '', 'Eeswaran', 'Mahalakshmi', '1', 'Mythili', '7', 'Boxer', 'WhatsApp Image 2023-01-20 at 11.43.56 AM.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-04-04 12:28:32'),
(14, '16', '963852741236', 'Ambi', '2023-03-31', '0', '1', NULL, 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '6', '10', 'bussy street', '9654811325', '9456465465', 'Parthasarathy Iyengar', 'Susheela', '2', '', '7', 'Anniyan', 'images.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', '2023-04-10 15:01:23'),
(16, '4', '213132132132', 'Logeshwaran', '2021-10-13', '1', '2', NULL, 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'Check', '3456455765', '253465465', 'Kuppusamy', 'Mariyamma', '1', 'Selvi', '7', 'KMC', 'programming-funny-jokes-e1600486875722.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2023-04-13 14:14:07'),
(17, '17', '646546546546', 'Rajesh', '1999-02-10', '24', '1', 'O+', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '6', '10', 'Birdur', '9565565465', '9651321321', 'Appa', 'Amma', '2', '', '2', 'ABC', 'pexels-cesar-perez-733745.jpg', '3', '', '', '', '654', '645', '654', '654', '654', '6465', '  sadf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', '2023-04-13 16:52:26'),
(18, '18', '945454646565', 'Praveen', '2009-04-17', '14', '1', 'O+', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9844654654', '9846546546', 'Appa', 'Amma', '2', '', '4', 'MM', 'wallpaperflare.com_wallpaper.jpg', '2', '', '', '', '3121', '321', '321', '231', '31', '21', '     Ok   ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', '2023-04-13 17:01:11'),
(20, '19', '132132132132', 'Rajesh', '2023-04-04', '0', '1', NULL, 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '6', '12', 'Birdur', '9846546546', '94654654', 'Appa', 'Amma', '2', '', '1', 'ABC', 'pexels-cesar-perez-733745.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-04-26 10:40:41'),
(21, '20', '105806052023', 'Rakesh', '1990-06-06', '33', '1', '', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', '58,Pudhu street,vandavasi', '8783565696', '9648123657', 'Delhi Babu', 'Janaki', '2', '', '3', 'Coconut shop', 'rakesh.png', '0', '', '', '', '15000', '0', '0', '0', '3000', '25000', 'Polite', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', '2023-05-06 11:02:00'),
(22, '21', '784512895623', 'Mark henry', '1978-10-10', '45', '1', NULL, 'Puducherry', 'Puducherry', 'Puducherry', '8', '7', 'bussy street', '7347437356', '4563456735', 'Ernest Henry', 'Barbara Jean', '1', 'Jana Henry', '7', 'WWE', 'ramasamy-periyar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2023-05-22 15:46:34'),
(23, '7', '123456789102', 'Swetha', '2005-05-02', '18', '2', NULL, 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'Pudhu street', '9694999999', '', 'Thookudurai', 'Niranjana', '2', '', '4', 'Actor', 'WhatsApp Image 2023-01-18 at 11.14.15 AM.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-05-27 12:21:58');

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
-- Table structure for table `document_info`
--

CREATE TABLE `document_info` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
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

--
-- Dumping data for table `document_info`
--

INSERT INTO `document_info` (`id`, `req_id`, `doc_name`, `doc_detail`, `doc_type`, `doc_holder`, `holder_name`, `relation_name`, `relation`, `doc_upload`, `doc_info_upload_noc`, `doc_info_upload_used`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(3, '20', 'House Document', 'House Document', '0', '1', 'Magesh', '', 'Brother', 'kevin-ku-w7ZyuGYNpRQ-unsplash.jpg', 1, 0, '28', '28', NULL, '2023-05-18 16:47:50', '2023-05-18 16:47:50'),
(6, '20', 'House Document', 'House Document', '0', '1', 'Magesh', '', 'Brother', 'kevin-ku-w7ZyuGYNpRQ-unsplash.jpg', 0, 0, '28', '28', NULL, '2023-05-27 16:47:50', '2023-05-27 16:47:50');

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
(3, '6', 'Education', '6,7', '0', '1', '1', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, '2', 'Business', '1,2,5', '0', '28', NULL, NULL, '0000-00-00 00:00:00', '2023-05-18 12:47:26');

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

--
-- Dumping data for table `fingerprints`
--

INSERT INTO `fingerprints` (`id`, `adhar_num`, `name`, `hand`, `ansi_template`, `bitmap_data`, `insert_user_id`, `update_user_id`, `created_date`, `updated_date`) VALUES
(1, '894454545465', 'Anto', '2', 'Rk1SACAyMAAA7AA1AA0AAAE8AWIAxQDFAQAAACgiQHoA82IAQHUBCwoAQIoBHAQAQFMBE2wAQD0A3WsAQI4AmU8AgGIBQncAQC4AsW4AQK8BVmQAgBoAxhQAgBYAtBQAQO4BSVIAQIsA+mUAQGMA+wgAQLcA41QAQL4BDKwAQHMAn6sAQNMAzlIAQKIBS7IAgLIBTlsAQPIBFLAAgCwAng0AgMYAgU4AQIoA1FcAQKUBCV4AgIEAtlIAQI8Ap1IAgDUA1A0AgDIBFGcAQLwBPloAQD8AmWYAQNMBQqwAQPABH1QAQE8AbFcAAAA=', NULL, '1', '1', '2023-05-10 17:29:36', '2023-05-10 17:34:52'),
(2, '945454646565', 'Praveen', '1', 'Rk1SACAyMAABlAA1AA0AAAE8AWIAxQDFAQAAACg+QIYAvmoAQLkAxAsAQHoAoWkAQIUBA3AAQFUAxGwAQIkBDgwAQK4BEZQAgKsAgGgAgOEAlq8AQEMAlWgAQN0BE48AQPQA/JQAQC4AoQ4AQIsBQxwAgEIAdg8AQBgA22MAQHABTY8AQNoBSoIAQQYAb64AQJEALhQAQHIAGHEAQHEA1m4AgKkA864AgMIAumcAQJ8BBWUAQNMA2qIAgFEAumwAQMMBBpYAgEEAyxMAQFEBE3YAQKIBM3gAQL4AcQsAgHMBMhwAgGYBOIYAQFsAZWkAQC8Ah2cAQE0BOn8AgNkAXAoAgKwBW3MAgOABTYcAQGIAKhYAQIIADxcAQHUA3xAAgI4A+ggAgLQAogkAQIcAkQ0AgJ0BDqQAgNgAtqwAgIcBGXMAgJsBJncAQF0BHRkAQEgBDXMAQO8AolsAgHkAYw8AgKwBQ3UAQC0BCBgAgMwBPH8AQO4AcWMAQLwARQgAQMkAR2EAQP4BPI0AQPAAPA8AAAA=', NULL, '1', NULL, '2023-05-10 17:34:52', '2023-05-10 17:34:52'),
(3, '874554548745', 'Arun', '1', 'Rk1SACAyMAABLgA1AA0AAAE8AWIAxQDFAQAAACgtQGQA2KoAQEcAzAsAgIABC5cAgGEAlgMAQFIBGpoAQD0BJXkAQC0BIBQAgKkBK5QAQFABP4AAgLoAfKoAQNYAo00AgF8BUH8AQDQBUSUAQD8ASmUAQGgAORAAQGIAtrMAgJEA75sAQHMAmmAAQLMAz54AQD4BEW4AgMsAwaQAQGoAbmcAQDwAdQ8AgCoBLX8AQJUBQY0AQFcAXw4AgLkBO5kAgCEBSyYAQDMASAsAQBoBVosAgEwAvmwAQGEBCJ4AgEIA/QIAQDcAqRAAgLAAoKgAQH0BNokAQCQAiW4AgD4BNoAAQIsBQ4sAQIQAZbAAgKMAZ1UAQKEBSZMAQKUAUawAQJIAQAQAQOIAWVEAAAA=', NULL, '1', NULL, '2023-05-11 13:20:59', '2023-05-11 13:24:03'),
(4, '105806052023', 'Rakesh', '1', 'Rk1SACAyMAAAAAFcAAABPAFiAMUAxQEAAAAoNYCPANanAECBALmjAICCAPiqAEDjAN7wAEBnAOumAIC8AHocAIB1AHcgAIBTAPknAIClAS4pAEA2ALOdAIC7ATjKAED5AR7TAECyAEcWAEEAAGP8AECzAVG8AEBSAEgpAEDcAV5RAEChABckAIC1AKcaAIDMAMObAECMAQEmAECpAIagAIBgAOGmAICoARoZAED1AJ2LAEC8ASadAEBWAIChAIBCAJkhAEDpAGmYAIDSAFcXAEBpAT2uAEDFAUzFAICBAUwuAIDyAVDBAEBgADGnAEEMADgEAEDHANITAECMAKMfAIDjALb9AIDAAQkFAIDiAJUDAEBMALyjAIDZARndAICkASevAEA6ANEjAEELAP/bAIC0AT23AICmAUGwAEC/AEaUAEBwAUmwAECBADomAEDkADIaAEBrACIrAAAA', NULL, '1', '1', '2023-05-12 16:56:49', '2023-05-12 16:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `gold_info`
--

CREATE TABLE `gold_info` (
  `id` int(11) NOT NULL,
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

--
-- Dumping data for table `gold_info`
--

INSERT INTO `gold_info` (`id`, `req_id`, `gold_sts`, `gold_type`, `Purity`, `gold_Count`, `gold_Weight`, `gold_Value`, `noc_given`, `used_status`) VALUES
(1, '20', '1', 'Bar', '18k', '1', '56', '37869', '1', '0'),
(2, '20', '0', 'Chain', '21k', '1', '108', '45156', '1', '0');

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

--
-- Dumping data for table `in_acknowledgement`
--

INSERT INTO `in_acknowledgement` (`id`, `req_id`, `cus_id`, `cus_status`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_on`) VALUES
(1, '18', '945454646565', '20', '0', '1', '1', NULL, '2023-04-28 15:17:53'),
(2, '10', '123456789101', '14', '0', '1', '1', NULL, '2023-04-28 17:17:43'),
(3, '11', '123456789101', '14', '0', '1', '1', NULL, '2023-04-29 15:57:07'),
(5, '11', '123456789101', '14', '0', '1', '1', NULL, '2023-04-29 15:58:29'),
(6, '15', '546546546465', '13', '0', '1', NULL, NULL, '2023-04-29 15:58:39'),
(7, '17', '646546546546', '3', '0', '1', NULL, NULL, '2023-05-03 12:10:30'),
(8, '20', '105806052023', '14', '0', '28', '1', NULL, '2023-05-06 11:21:02'),
(9, '2', '213132132132', '3', '0', '28', NULL, NULL, '2023-05-18 12:46:04');

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

--
-- Dumping data for table `in_approval`
--

INSERT INTO `in_approval` (`req_id`, `cus_id`, `cus_status`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`) VALUES
('17', '646546546546', '3', '0', '28', '1', NULL),
('18', '945454646565', '20', '0', '1', '1', NULL),
('15', '546546546465', '13', '0', '1', NULL, NULL),
('10', '123456789101', '14', '0', '28', '1', NULL),
('11', '123456789101', '14', '0', '25', '1', NULL),
('3', '546546546465', '2', '0', '25', NULL, NULL),
('20', '105806052023', '14', '0', '21', '1', NULL),
('2', '213132132132', '3', '0', '28', NULL, NULL);

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

--
-- Dumping data for table `in_issue`
--

INSERT INTO `in_issue` (`id`, `req_id`, `cus_id`, `cus_status`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(1, '18', '945454646565', '20', '0', '1', '1', NULL, '2023-04-28 17:19:16', '2023-05-10 12:34:39'),
(5, '15', '546546546465', '13', '0', '1', NULL, NULL, '2023-04-29 16:02:28', NULL),
(6, '11', '123456789101', '14', '0', '1', '1', NULL, '2023-04-29 16:06:26', '2023-04-30 13:11:49'),
(7, '10', '123456789101', '14', '0', '1', '1', NULL, '2023-05-01 11:04:42', '2023-05-05 18:49:21'),
(8, '20', '105806052023', '21', '0', '28', '1', NULL, '2023-05-06 11:26:56', '2023-05-09 12:46:06');

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

--
-- Dumping data for table `in_verification`
--

INSERT INTO `in_verification` (`req_id`, `user_type`, `user_name`, `agent_id`, `responsible`, `remarks`, `declaration`, `req_code`, `dor`, `cus_reg_id`, `cus_id`, `cus_data`, `cus_name`, `dob`, `age`, `gender`, `blood_group`, `state`, `district`, `taluk`, `area`, `sub_area`, `address`, `mobile1`, `mobile2`, `father_name`, `mother_name`, `marital`, `spouse_name`, `occupation_type`, `occupation`, `pic`, `loan_category`, `sub_category`, `tot_value`, `ad_amt`, `ad_perc`, `loan_amt`, `poss_type`, `due_amt`, `due_period`, `cus_status`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(2, 'Staff', 'Kumar', NULL, '', '123', '', 'REQ-101', '2023-04-01', '2', '213132132132', 'New', 'Logeshwaran', '2021-10-13', '1', '2', NULL, 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'Check', '3456455765', '253465465', 'Kuppusamy', 'Mariyamma', '1', 'Selvi', '7', 'KMC', 'programming-funny-jokes-e1600486875722.jpg', '2', 'Business', '15000', '5000', '33.3', '10000', '1', '2750', '', '3', '0', '21', '28', NULL, '2023-04-01 11:39:58', '2023-04-01 11:39:58'),
(3, 'Director', 'Big show', '', '1', '', 'Declaration', 'REQ-102', '2023-04-01', NULL, '546546546465', 'New', 'Kuppusamy', '2023-03-29', '0', '1', '', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9646465546', '94654654', 'Karuppan', 'Jekkamma', '2', '', '2', 'KMC', 'pexels-jakub-novacek-924824.jpg', '5', 'Furniture', '', '', '', '15000', '1', '1500', '', '2', '0', '25', '25', NULL, '2023-04-01 13:19:58', '2023-04-01 13:19:58'),
(4, 'Agent', 'Darling & Co', '28', '0', '', 'v', 'REQ-103', '2023-04-01', NULL, '213132132132', 'Existing', 'Logeshwaran', '2021-10-13', '1', '2', NULL, 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'Check', '3456455765', '253465465', 'Kuppusamy', 'Mariyamma', '1', 'Selvi', '7', 'KMC', 'programming-funny-jokes-e1600486875722.jpg', '2', 'Business', '15000', '5000', '33.3', '10000', '2', '', '12', '1', '0', '24', '1', '24', '2023-04-01 15:09:46', '0000-00-00 00:00:00'),
(5, 'Staff', 'Kumar', '', '', 'test remarks', '', 'REQ-104', '2023-04-03', NULL, '289499396919', 'New', 'Arun', '1999-04-27', '24', '1', NULL, 'Puducherry', 'Puducherry', 'Puducherry', '8', '7', 'Chinnakadai', '9654566456', '', 'Natarajan', 'Parameswari', '2', '', '3', 'Developer', 'pexels aleksandar pasaric 325185.jpg', '5', 'Mobile', '25000', '5000', '20.0', '20000', '1', '2583', '', '1', '0', '21', '1', NULL, '2023-04-03 12:29:54', '2023-04-03 12:29:54'),
(10, 'Director', 'Big show', '', '1', '', 'Declaration', 'REQ-107', '2023-04-03', NULL, '123456789101', 'Existing', 'Triple H', '1999-07-15', '24', '1', '', 'Puducherry', 'Puducherry', 'Puducherry', '8', '8', 'MG road', '9565654654', '', 'Roman reigns', 'Nikki', '1', 'Manju warrior', '4', 'Uzhavan', 'pexels-hansen-tang-13435926.jpg', '5', 'Furniture', '', '', '', '40000', '1', '5333', '', '14', '0', '25', '1', NULL, '2023-04-03 16:31:07', '2023-04-03 16:31:07'),
(11, 'Staff', 'Kumar', '28', '', 'test remarks', '', 'REQ-108', '2023-04-03', '7', '123456789101', 'Existing', 'Triple H', '1999-07-15', '24', '1', '', 'Puducherry', 'Puducherry', 'Puducherry', '8', '8', 'MG road', '9565654654', '', 'Roman reigns', 'Nikki', '1', 'Manju warrior', '4', 'Uzhavan', 'pexels-hansen-tang-13435926.jpg', '2', 'Business', '50000', '5000', '10.0', '45000', '2', '', '24', '14', '0', '21', '1', NULL, '2023-04-03 16:34:56', '2023-04-03 16:34:56'),
(14, 'Agent', 'Darling & Co', '28', '1', '', 'Test Declaration', 'REQ-111', '2023-04-05', NULL, '546546546465', 'Existing', 'Kuppusamy', '2023-03-29', '0', '1', '', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9646465546', '94654654', 'Karuppan', 'Jekkamma', '2', '', '2', 'KMC', 'pexels-jakub-novacek-924824.jpg', '2', 'Business', '234345', '234', '0.1', '234111', '1', '43', '', '10', '0', '24', '1', NULL, '2023-04-05 16:53:21', '2023-04-05 16:53:21'),
(15, 'Staff', 'Kumar', '28', '', 'Remarks', '', 'REQ-112', '2023-04-06', NULL, '546546546465', 'Existing', 'Kuppusamy', '1999-03-29', '24', '1', 'AB+', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9646465546', '94654654', 'Karuppan', 'Jekkamma', '2', '', '2', 'KMC', 'pexels-jakub-novacek-924824.jpg', '2', 'Business', '80000', '15000', '18.8', '65000', '1', '1000', '', '13', '0', '21', '1', NULL, '2023-04-06 12:55:46', '2023-04-06 12:55:46'),
(17, 'Director', 'Chithambaram', '', '0', '', 'Declare', 'REQ-114', '2023-04-13', NULL, '646546546546', 'New', 'Rajesh', '1999-02-10', '24', '1', 'O+', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '6', '10', 'Birdur', '9565565465', '9651321321', 'Appa', 'Amma', '2', '', '2', 'ABC', 'pexels-cesar-perez-733745.jpg', '6', 'Education', '15000', '1000', '6.7', '14000', '1', '1500', '', '3', '0', '28', '1', '1', '2023-04-13 16:52:26', '2023-04-13 16:52:26'),
(18, 'Director', 'Chithambaram', '', '1', '', 'Declaration', 'REQ-115', '2023-04-13', NULL, '945454646565', 'New', 'Praveen', '2009-04-17', '14', '1', 'O+', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9844654654', '9846546546', 'Appa', 'Amma', '2', '', '4', 'MM', 'wallpaperflare.com_wallpaper.jpg', '5', 'Multi Things', '20000', '10000', '50.0', '10000', '2', '', '15', '20', '0', '28', '1', NULL, '2023-04-13 17:01:11', '2023-04-13 17:01:11'),
(20, 'Staff', 'Kumar', '', '', 'Final Remark', '', 'REQ-117', '2023-05-06', '21', '105806052023', 'New', 'Rakesh', '1990-06-06', '33', '1', '', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', '58,Pudhu street,vandavasi', '8783565696', '9648123657', 'Delhi Babu', 'Janaki', '2', '', '3', 'Coconut shop', 'rakesh.png', '5', 'Mobile', '23500', '3500', '14.9', '20000', '1', '2167', '', '14', '0', '21', '1', NULL, '2023-05-06 11:02:00', '2023-05-06 11:02:00'),
(21, 'Staff', 'Gokul', '30', '', 'Remarks', '', 'REQ-118', '2023-05-22', '22', '784512895623', 'New', 'Mark henry', '1978-10-10', '45', '1', NULL, 'Puducherry', 'Puducherry', 'Puducherry', '8', '7', 'bussy street', '7347437356', '4563456735', 'Ernest Henry', 'Barbara Jean', '1', 'Jana Henry', '7', 'WWE', 'ramasamy-periyar.jpg', '5', 'Furniture', '', '', '', '150657', '1', '9290', '', '1', '0', '29', '29', NULL, '2023-05-22 15:46:34', '2023-05-22 15:46:34');

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
(1, '2', 'Business', 'Monthly', 'intrest', '', 'Monthly', '1.5', '2.5', '0', '5', '1.5', '2.5', '1.5', '2.5', '156654', '', '', '2', '2', 'Yes', 0, 1, 28, NULL, '2023-03-14 16:00:43', '2023-03-14 16:00:43'),
(2, '5', 'Mobile', 'Monthly', 'emi', 'pre_intrest,after_intrest', '', '1.6', '1.6', '1.6', '1.6', '1.6', '1.6', '1.6', '1.6', '30000', '', '', '1.5', '1.6', 'Yes', 0, 1, 1, NULL, '2023-03-14 16:02:51', '2023-03-14 16:02:51'),
(3, '5', 'Furniture', 'Monthly', 'intrest', '', 'Monthly', '10', '20', '15', '18', '10', '12', '5', '10', '156654', '', '', '3', '3', 'No', 0, 1, 25, NULL, '2023-03-23 12:17:56', '2023-03-23 12:17:56'),
(5, '5', 'Multi Things', 'Monthly', 'emi', 'pre_intrest,after_intrest', '', '0', '10', '5', '15', '2', '10', '0', '5', '2334333', '', '', '0.3', '0.3', 'Yes', 0, 1, NULL, NULL, '2023-03-23 13:28:40', '2023-03-23 13:28:40'),
(6, '6', 'Education', 'Monthly', 'emi', 'pre_intrest', '', '5', '5', '5', '5', '5', '5', '5', '5', '50000', '', '', '2.4', '2.4', 'Yes', 0, 1, 1, NULL, '2023-03-23 13:38:13', '2023-03-23 13:38:13');

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
-- Table structure for table `loan_issue`
--

CREATE TABLE `loan_issue` (
  `id` int(11) NOT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `issued_to` varchar(255) DEFAULT NULL,
  `agent_id` varchar(255) DEFAULT NULL,
  `issued_mode` varchar(50) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `cash` varchar(255) DEFAULT NULL,
  `cheque_no` varchar(255) DEFAULT NULL,
  `cheque_value` varchar(255) DEFAULT NULL,
  `cheque_remark` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `transaction_value` varchar(255) DEFAULT NULL,
  `transaction_remark` varchar(255) DEFAULT NULL,
  `balance_amount` varchar(255) DEFAULT NULL,
  `loan_amt` varchar(255) DEFAULT NULL,
  `net_cash` varchar(255) DEFAULT NULL,
  `cash_guarentor_name` varchar(255) DEFAULT NULL,
  `relationship` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `insert_login_id` varchar(50) DEFAULT NULL,
  `update_login_id` varchar(50) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_issue`
--

INSERT INTO `loan_issue` (`id`, `req_id`, `cus_id`, `issued_to`, `agent_id`, `issued_mode`, `payment_type`, `cash`, `cheque_no`, `cheque_value`, `cheque_remark`, `transaction_id`, `transaction_value`, `transaction_remark`, `balance_amount`, `loan_amt`, `net_cash`, `cash_guarentor_name`, `relationship`, `status`, `insert_login_id`, `update_login_id`, `created_date`) VALUES
(5, '11', '123456789101', 'Triple H', '', '0', '', '15007', '6651', '2546', 'Nothing', '', '', '', '22917', '45000', '40470', '35', 'Brother', '0', '1', NULL, '2023-04-29 16:17:21'),
(6, '11', '123456789101', 'Triple H', '', '1', '0', '22917', '', '', '', '', '', '', '0', '45000', '40470', '35', 'Brother', '0', '1', NULL, '2023-04-29 16:22:25'),
(7, '18', '945454646565', 'Praveen', '', '0', '', '4000', '1234', '3647', 'IOB', '', '', '', '32828', NULL, '40475', '28', 'Son', '0', '1', NULL, '2023-05-01 09:45:17'),
(8, '18', '945454646565', 'Praveen', '', '1', '1', '', '321', '32828', '321', '', '', '', '0', '45000', '40475', '29', 'Brother', '0', '1', NULL, '2023-05-01 09:45:48'),
(9, '10', '123456789101', 'Triple H', '', '1', '2', '', '', '', '', '984984', '20483', 'IB', '0', '23921', '20483', '34', 'Father', '0', '1', NULL, '2023-05-01 11:05:19'),
(10, '20', '105806052023', 'Rakesh', '', '1', '0', '16860', '', '', '', '', '', '', '0', '20000', '16860', '38', 'Mother', '0', '21', NULL, '2023-05-06 11:27:41');

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
(1, 'Monthly scheme', '', '1', 'Property', 'monthly', 'pre_intrest', '15', '5', '0', '5', 'percentage', '10', '20', 'percentage', '0', '0', '', '1.1', '', '', 0, 1, 1, NULL, '2023-03-14 16:04:05', '2023-04-11 12:34:32'),
(2, 'Weekly scheme', 'Weekly 10', '1', 'Property', 'weekly', 'pre_intrest', '10', NULL, NULL, '10', 'amt', '10', '20', 'amt', '0', '10', '', '2', NULL, NULL, 0, 1, 1, NULL, '2023-03-14 16:08:05', '2023-03-27 11:52:01'),
(3, 'Daily scheme', 'Daily 100', '2', 'Business', 'daily', 'pre_intrest', '10', NULL, NULL, '100', 'amt', '10', '20', 'amt', '0', '10', NULL, '2.3', NULL, NULL, 0, 1, 1, NULL, '2023-03-14 16:08:49', '2023-03-27 11:52:12'),
(4, 'AB3', 'AB3', '5', 'Multi Things', 'monthly', 'pre_intrest', '5', '10', '1', '9', 'amt', '1000', '1500', 'amt', '1000', '1500', '', '2', '', '', 0, 1, NULL, NULL, '2023-03-24 15:42:47', '2023-03-24 15:42:47'),
(5, '2W', '2W', '3', '2 Wheeler', 'monthly', 'pre_intrest', '2', '15', '1', '14', 'amt', '2000', '2500', 'amt', '2000', '2500', '', '0.3', '', '', 0, 1, NULL, NULL, '2023-03-24 15:43:19', '2023-03-24 15:43:19'),
(6, 'E2', 'E2', '5', 'Electronics', 'weekly', 'pre_intrest', '1', NULL, NULL, '15', 'amt', '1000', '1500', 'amt', '1500', '1500', '', '0.5', NULL, NULL, 0, 1, NULL, NULL, '2023-03-24 15:43:47', '2023-03-24 15:43:47'),
(7, '2WW', '2WW', '3', '2 Wheeler', 'weekly', 'pre_intrest', '5', NULL, NULL, '10', 'amt', '1000', '1000', 'amt', '1500', '1500', '', '1.3', NULL, NULL, 0, 1, NULL, NULL, '2023-03-24 15:44:20', '2023-03-24 15:44:20'),
(8, 'D02', 'd', '5', 'Multi Things', 'daily', 'pre_intrest', '10', NULL, NULL, '22', 'amt', '1500', '1500', 'amt', '1500', '1500', NULL, '2.1', NULL, NULL, 0, 1, NULL, NULL, '2023-03-24 15:44:55', '2023-03-24 15:44:55'),
(9, 'D03', 'dd', '3', '2 Wheeler', 'daily', 'pre_intrest', '7', NULL, NULL, '15', 'amt', '1500', '1500', 'amt', '100', '1500', NULL, '3.5', NULL, NULL, 0, 1, NULL, NULL, '2023-03-24 15:45:19', '2023-03-24 15:45:19'),
(10, 'AM4211', '4211', '5', 'Multi Things', 'weekly', 'pre_intrest', '10', NULL, NULL, '24', 'percentage', '5', '10', 'percentage', '10', '15', '', '0.9', NULL, NULL, 0, 1, NULL, NULL, '2023-04-18 10:24:38', '2023-04-18 10:24:38'),
(11, 'MB247', '247', '5', 'Mobile', 'monthly', 'pre_intrest', '0.7', '12', '2', '10', 'amt', '1000', '1500', 'amt', '1500', '1800', '', '2', '', '', 0, 1, NULL, NULL, '2023-05-06 11:18:23', '2023-05-06 11:18:23');

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

--
-- Dumping data for table `loan_summary_feedback`
--

INSERT INTO `loan_summary_feedback` (`id`, `req_id`, `cus_id`, `feedback_label`, `cus_feedback`, `feedback_remark`) VALUES
(3, '18', '945454646565', 'Check Three', '5', 'Three 3'),
(4, '18', '945454646565', 'Check Four', '1', 'Four 4');

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

--
-- Dumping data for table `noc`
--

INSERT INTO `noc` (`noc_id`, `req_id`, `cus_id`, `sign_checklist`, `cheque_checklist`, `gold_checklist`, `mort_checklist`, `endorse_checklist`, `doc_checklist`, `noc_date`, `noc_member`, `mem_name`, `cus_status`, `insert_login_id`, `update_login_id`, `created_date`, `updated_date`) VALUES
(15, '20', '105806052023', '', '6', '', '', '', '', '2023-05-13', '1', 'Rakesh', '21', '1', NULL, '2023-05-13 19:08:43', '2023-05-13 19:08:43'),
(16, '20', '105806052023', '', '', '', '', '', '3', '2023-05-27', '1', 'Rakesh', '21', '1', NULL, '2023-05-27 11:06:24', '2023-05-27 11:06:24');

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

--
-- Dumping data for table `penalty_charges`
--

INSERT INTO `penalty_charges` (`req_id`, `penalty_date`, `penalty`, `paid_date`, `paid_amnt`, `waiver_amnt`, `created_date`, `updated_time`) VALUES
('18', '2023-05-05', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-06', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-07', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-08', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-09', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-10', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-11', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-12', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-13', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-14', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-15', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-16', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-17', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-18', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-19', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-20', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-21', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-22', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-23', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('18', '2023-05-24', '10.35', NULL, '0', '0', '2023-05-25 14:47:50', '2023-05-25 14:47:50'),
('11', '2023-05-06', '10.35', NULL, '0', '0', '2023-05-27 11:50:28', '2023-05-27 11:50:28'),
('11', '2023-05-07', '10.35', NULL, '0', '0', '2023-05-27 11:50:28', '2023-05-27 11:50:28'),
('11', '2023-05-08', '10.35', NULL, '0', '0', '2023-05-27 11:50:28', '2023-05-27 11:50:28'),
('11', '2023-05-09', '10.35', NULL, '0', '0', '2023-05-27 11:50:28', '2023-05-27 11:50:28'),
('11', '2023-05-10', '10.35', NULL, '0', '0', '2023-05-27 11:50:28', '2023-05-27 11:50:28'),
('11', '2023-05-11', '10.35', NULL, '0', '0', '2023-05-27 11:50:28', '2023-05-27 11:50:28'),
('11', '2023-05-12', '10.35', NULL, '0', '0', '2023-05-27 11:50:28', '2023-05-27 11:50:28'),
('11', '2023-05-13', '10.35', NULL, '0', '0', '2023-05-27 11:50:28', '2023-05-27 11:50:28'),
('11', '2023-05-14', '10.35', NULL, '0', '0', '2023-05-27 11:50:28', '2023-05-27 11:50:28'),
('11', '2023-05-15', '10.35', NULL, '0', '0', '2023-05-27 11:50:28', '2023-05-27 11:50:28'),
('11', '2023-05-16', '10.35', NULL, '0', '0', '2023-05-27 11:50:28', '2023-05-27 11:50:28'),
('11', '2023-05-17', '10.35', NULL, '0', '0', '2023-05-27 11:50:28', '2023-05-27 11:50:28'),
('11', '2023-05-18', '10.35', NULL, '0', '0', '2023-05-27 11:50:29', '2023-05-27 11:50:29'),
('11', '2023-05-19', '10.35', NULL, '0', '0', '2023-05-27 11:50:29', '2023-05-27 11:50:29'),
('11', '2023-05-20', '10.35', NULL, '0', '0', '2023-05-27 11:50:29', '2023-05-27 11:50:29'),
('11', '2023-05-21', '10.35', NULL, '0', '0', '2023-05-27 11:50:29', '2023-05-27 11:50:29'),
('11', '2023-05-22', '10.35', NULL, '0', '0', '2023-05-27 11:50:29', '2023-05-27 11:50:29'),
('11', '2023-05-23', '10.35', NULL, '0', '0', '2023-05-27 11:50:29', '2023-05-27 11:50:29'),
('11', '2023-05-24', '10.35', NULL, '0', '0', '2023-05-27 11:50:29', '2023-05-27 11:50:29'),
('11', '2023-05-25', '10.35', NULL, '0', '0', '2023-05-27 11:50:29', '2023-05-27 11:50:29');

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
(30, '16', 'Car tyre'),
(32, '4', 'Juice shop'),
(33, '4', 'News Channel'),
(34, '4', 'Production company'),
(35, '17', 'KSR'),
(36, '17', '10'),
(37, '17', 'A'),
(38, '17', 'KSR'),
(39, '17', '11'),
(40, '17', 'B'),
(41, '17', 'KSR'),
(42, '17', '12'),
(43, '17', 'C'),
(44, '18', 'TV'),
(45, '18', 'MI'),
(46, '18', 'TV'),
(47, '18', 'Samsung'),
(51, '19', 'VCSM'),
(52, '19', '1'),
(53, '19', 'BCA'),
(54, '20', 'Onleplus'),
(55, '21', 'Wardrobe'),
(56, '21', 'Godrej'),
(57, '21', 'Dressing table'),
(58, '21', 'Ideal'),
(59, '7', 'Supermarket');

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

--
-- Dumping data for table `request_creation`
--

INSERT INTO `request_creation` (`req_id`, `user_type`, `user_name`, `agent_id`, `responsible`, `remarks`, `declaration`, `req_code`, `dor`, `cus_reg_id`, `cus_id`, `cus_data`, `cus_name`, `dob`, `age`, `gender`, `state`, `district`, `taluk`, `area`, `sub_area`, `address`, `mobile1`, `mobile2`, `father_name`, `mother_name`, `marital`, `spouse_name`, `occupation_type`, `occupation`, `pic`, `loan_category`, `sub_category`, `tot_value`, `ad_amt`, `ad_perc`, `loan_amt`, `poss_type`, `due_amt`, `due_period`, `cus_status`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(2, 'Staff', 'Kumar', NULL, '', '123', '', 'REQ-101', '2023-04-01', '2', '213132132132', 'New', 'Logeshwaran', '2021-10-13', '1', '2', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'Check', '3456455765', '253465465', 'Kuppusamy', 'Mariyamma', '1', 'Selvi', '7', 'KMC', 'programming-funny-jokes-e1600486875722.jpg', '2', 'Business', '15000', '5000', '33.3', '10000', '1', '2750', '', '3', '0', '21', '28', NULL, '2023-04-01 11:39:58', '2023-04-01 11:39:58'),
(3, 'Director', 'Big show', '', '1', '', 'Declaration', 'REQ-102', '2023-04-01', NULL, '546546546465', 'New', 'Kuppusamy', '2023-03-29', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9646465546', '94654654', 'Karuppan', 'Jekkamma', '2', '', '2', 'KMC', 'pexels-jakub-novacek-924824.jpg', '5', 'Furniture', '', '', '', '15000', '1', '1500', '', '2', '0', '25', '25', NULL, '2023-04-01 13:19:58', '2023-04-01 13:19:58'),
(4, 'Agent', 'Darling & Co', '28', '0', '', 'v', 'REQ-103', '2023-04-01', NULL, '213132132132', 'Existing', 'Logeshwaran', '2021-10-13', '1', '2', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'Check', '3456455765', '253465465', 'Kuppusamy', 'Mariyamma', '1', 'Selvi', '7', 'KMC', 'programming-funny-jokes-e1600486875722.jpg', '2', 'Business', '15000', '5000', '33.3', '10000', '2', '', '12', '1', '0', '24', '1', '24', '2023-04-01 15:09:46', '0000-00-00 00:00:00'),
(5, 'Staff', 'Kumar', '', '', 'test remarks', '', 'REQ-104', '2023-04-03', NULL, '289499396919', 'New', 'Arun', '1999-04-27', '24', '1', 'Puducherry', 'Puducherry', 'Puducherry', '8', '7', 'Chinnakadai', '9654566456', '', 'Natarajan', 'Parameswari', '2', '', '3', 'Developer', 'pexels aleksandar pasaric 325185.jpg', '5', 'Mobile', '25000', '5000', '20.0', '20000', '1', '2583', '', '1', '0', '21', '1', NULL, '2023-04-03 12:29:54', '2023-04-03 12:29:54'),
(6, 'Director', 'Big show', '16', '1', '', 'Test Declaration', 'REQ-105', '2023-04-03', NULL, '123456789101', 'New', 'Triple H', '1999-07-15', '24', '1', 'Puducherry', 'Puducherry', 'Puducherry', '8', '8', 'MG road', '9565654654', '', 'Roman reigns', 'Nikki', '1', 'Manju warrior', '4', 'Uzhavan', 'pexels-hansen-tang-13435926.jpg', '5', 'Furniture', '', '', '', '20000', '1', '15000', NULL, '0', '1', '25', '1', '1', '2023-04-03 12:35:27', '0000-00-00 00:00:00'),
(7, 'Agent', 'Darling & Co', '28', '0', '', 'Test Declaration', 'REQ-106', '2023-04-03', NULL, '123456789102', 'New', 'Swetha', '2005-05-02', '18', '2', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'Pudhu street', '9694999999', '', 'Thookudurai', 'Niranjana', '2', '', '4', 'Actor', 'WhatsApp Image 2023-01-18 at 11.14.15 AM.jpeg', '2', 'Business', '300000', '10000', '3.3', '290000', '1', '67666', '', '0', '0', '24', '28', NULL, '2023-04-03 12:50:01', '0000-00-00 00:00:00'),
(10, 'Director', 'Big show', '', '1', '', 'Declaration', 'REQ-107', '2023-04-03', NULL, '123456789101', 'Existing', 'Triple H', '1999-07-15', '24', '1', 'Puducherry', 'Puducherry', 'Puducherry', '8', '8', 'MG road', '9565654654', '', 'Roman reigns', 'Nikki', '1', 'Manju warrior', '4', 'Uzhavan', 'pexels-hansen-tang-13435926.jpg', '5', 'Furniture', '', '', '', '40000', '1', '5333', '', '14', '0', '25', '1', NULL, '2023-04-03 16:31:07', '2023-04-03 16:31:07'),
(11, 'Staff', 'Kumar', '28', '', 'test remarks', '', 'REQ-108', '2023-04-03', '7', '123456789101', 'Existing', 'Triple H', '1999-07-15', '24', '1', 'Puducherry', 'Puducherry', 'Puducherry', '8', '8', 'MG road', '9565654654', '', 'Roman reigns', 'Nikki', '1', 'Manju warrior', '4', 'Uzhavan', 'pexels-hansen-tang-13435926.jpg', '2', 'Business', '50000', '5000', '10.0', '45000', '2', '', '24', '14', '0', '21', '1', NULL, '2023-04-03 16:34:56', '2023-04-03 16:34:56'),
(12, 'Agent', 'Darling & Co', '28', '0', '', 'Declaration', 'REQ-109', '2023-04-04', NULL, '546546546465', 'Existing', 'Kuppusamy', '2023-03-29', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9646465546', '94654654', 'Karuppan', 'Jekkamma', '2', '', '2', 'KMC', 'pexels-jakub-novacek-924824.jpg', '2', 'Business', '24234', '34', '0.1', '24200', '1', '343434', '', '0', '0', '24', '24', NULL, '2023-04-04 10:51:47', '0000-00-00 00:00:00'),
(13, 'Agent', 'Darling & Co', '28', '1', '', 'Test Declaration', 'REQ-110', '2023-04-04', NULL, '963852741123', 'New', 'Kumaran', '2023-03-16', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '2353645675', '', 'Eeswaran', 'Mahalakshmi', '1', 'Mythili', '7', 'Boxer', 'WhatsApp Image 2023-01-20 at 11.43.56 AM.jpeg', '2', 'Business', '15000', '1000', '6.7', '14000', '1', '1000', '', '0', '0', '24', NULL, NULL, '2023-04-04 12:28:32', '2023-04-04 12:28:32'),
(14, 'Agent', 'Darling & Co', '28', '1', '', 'Test Declaration', 'REQ-111', '2023-04-05', NULL, '546546546465', 'Existing', 'Kuppusamy', '2023-03-29', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9646465546', '94654654', 'Karuppan', 'Jekkamma', '2', '', '2', 'KMC', 'pexels-jakub-novacek-924824.jpg', '2', 'Business', '234345', '234', '0.1', '234111', '1', '43', '', '10', '0', '24', '1', NULL, '2023-04-05 16:53:21', '2023-04-05 16:53:21'),
(15, 'Staff', 'Kumar', '28', '', 'Remarks', '', 'REQ-112', '2023-04-06', NULL, '546546546465', 'Existing', 'Kuppusamy', '2023-03-29', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9646465546', '94654654', 'Karuppan', 'Jekkamma', '2', '', '2', 'KMC', 'pexels-jakub-novacek-924824.jpg', '2', 'Business', '80000', '15000', '18.8', '65000', '1', '1000', '', '13', '0', '21', '1', NULL, '2023-04-06 12:55:46', '2023-04-06 12:55:46'),
(16, 'Agent', 'Darling & Co', '28', '1', '', 'Test', 'REQ-113', '2023-04-10', NULL, '963852741236', 'New', 'Ambi', '2023-03-31', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '6', '10', 'bussy street', '9654811325', '9456465465', 'Parthasarathy Iyengar', 'Susheela', '2', '', '7', 'Anniyan', 'images.jpg', '2', 'Business', '15000', '100', '0.7', '14900', '1', '1500', '', '4', '0', '24', '1', NULL, '2023-04-10 15:01:23', '2023-04-10 15:01:23'),
(17, 'Director', 'Chithambaram', '', '0', '', 'Declare', 'REQ-114', '2023-04-13', NULL, '646546546546', 'New', 'Rajesh', '1999-02-10', '24', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '6', '10', 'Birdur', '9565565465', '9651321321', 'Appa', 'Amma', '2', '', '2', 'ABC', 'wallpaperflare.com_wallpaper.jpg', '6', 'Education', '15000', '1000', '6.7', '14000', '1', '1500', '', '3', '0', '28', '1', '1', '2023-04-13 16:52:26', '2023-04-13 16:52:26'),
(18, 'Director', 'Chithambaram', '', '1', '', 'Declaration', 'REQ-115', '2023-04-13', NULL, '945454646565', 'New', 'Praveen', '2009-04-17', '14', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', 'bussy street', '9844654654', '9846546546', 'Appa', 'Amma', '2', '', '4', 'MM', 'wallpaperflare.com_wallpaper.jpg', '5', 'Multi Things', '20000', '10000', '50.0', '10000', '2', '', '15', '20', '0', '28', '1', NULL, '2023-04-13 17:01:11', '2023-04-13 17:01:11'),
(19, 'Director', 'Chithambaram', '', '0', '', 'Declare', 'REQ-116', '2023-04-26', NULL, '132132132132', 'New', 'Rajesh', '2023-04-04', '0', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '6', '12', 'Birdur', '9846546546', '94654654', 'Appa', 'Amma', '2', '', '1', 'ABC', 'pexels-cesar-perez-733745.jpg', '6', 'Education', '50000', '5000', '10.0', '45000', '1', '4125.00', '', '0', '0', '28', '28', NULL, '2023-04-26 10:40:27', '0000-00-00 00:00:00'),
(20, 'Staff', 'Kumar', '', '', 'Final Remark', '', 'REQ-117', '2023-05-06', '21', '105806052023', 'New', 'Rakesh', '1990-06-06', '33', '1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', '1', '3', '58,Pudhu street,vandavasi', '8783565696', '9648123657', 'Delhi Babu', 'Janaki', '2', '', '3', 'Coconut shop', 'rakesh.png', '5', 'Mobile', '23500', '3500', '14.9', '20000', '1', '2167', '', '14', '0', '21', '1', NULL, '2023-05-06 11:02:00', '2023-05-06 11:02:00'),
(21, 'Staff', 'Gokul', '30', '', 'Remarks', '', 'REQ-118', '2023-05-22', '22', '784512895623', 'New', 'Mark henry', '1978-10-10', '45', '1', 'Puducherry', 'Puducherry', 'Puducherry', '8', '7', 'bussy street', '7347437356', '4563456735', 'Ernest Henry', 'Barbara Jean', '1', 'Jana Henry', '7', 'WWE', 'ramasamy-periyar.jpg', '5', 'Furniture', '', '', '', '150657', '1', '9290', '', '1', '0', '29', '29', NULL, '2023-05-22 15:46:34', '2023-05-22 15:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `signed_doc`
--

CREATE TABLE `signed_doc` (
  `id` int(11) NOT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `signed_doc_id` varchar(255) DEFAULT NULL,
  `upload_doc_name` varchar(255) DEFAULT NULL,
  `noc_given` varchar(10) NOT NULL DEFAULT '0',
  `used_status` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signed_doc`
--

INSERT INTO `signed_doc` (`id`, `req_id`, `signed_doc_id`, `upload_doc_name`, `noc_given`, `used_status`) VALUES
(1, '18', '8', 'Mantra_RD_Service_Manual_Windows.pdf', '0', '0'),
(2, '18', '8', 'verification_family_info.sql', '0', '0'),
(3, '15', '9', 'ecpXIUeY_400x400.jpg', '0', '0'),
(4, '10', '10', 'loan_issue.sql', '0', '0'),
(5, '20', '13', 'rakesh.png', '0', '0'),
(6, '20', '12', 'janaki.png', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `signed_doc_info`
--

CREATE TABLE `signed_doc_info` (
  `id` int(11) NOT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `sign_type` varchar(255) DEFAULT NULL,
  `signType_relationship` varchar(255) DEFAULT NULL,
  `doc_Count` varchar(255) DEFAULT NULL,
  `req_id` varchar(150) DEFAULT NULL,
  `cus_profile_id` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signed_doc_info`
--

INSERT INTO `signed_doc_info` (`id`, `doc_name`, `sign_type`, `signType_relationship`, `doc_Count`, `req_id`, `cus_profile_id`) VALUES
(2, '1', '3', '4', '5', '2', '2'),
(5, '2', '3', '3', '6', '2', '2'),
(6, '1', '2', NULL, '3', '3', '4'),
(7, '1', '1', '37', '2', '17', '7'),
(8, '2', '1', '', '2', '18', '4'),
(9, '1', '1', '', '1', '15', '8'),
(10, '2', '0', '', '1', '10', '11'),
(11, '0', '0', '', '2', '11', '12'),
(12, '1', '1', '', '1', '20', '14'),
(13, '0', '2', '', '1', '20', '14'),
(14, '0', '0', '', '1', '14', '15'),
(16, '1', '2', '', '1', '4', ''),
(17, '1', '1', '39', '1', '14', '15');

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
(6, 'ST-102', 'Lalitha', '4', 'A 1', 'TamilNadu', 'Tiruvannamalai', 'Vandavasi', 'Vandavasi', '606565', '', '', '', '', '1234234', '2', 'Sales', 'AirCraft', 'Senior', '0', '1', '1', NULL, '2023-03-18 16:07:42', '2023-03-18 16:08:21'),
(7, 'ST-103', 'Gokul', '5', 'MG road', 'TamilNadu', 'Chennai', 'Aminjikarai', 'Aminjikarai', '606565', '', '', '', '', '', '1', 'Sales', 'Atlaasian', 'TL', '0', '1', NULL, NULL, '2023-05-22 15:26:21', '2023-05-22 15:26:21');

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
(4, 'Senior', '0'),
(5, 'TL', '0');

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

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `fullname`, `title`, `emailid`, `user_name`, `user_password`, `role`, `role_type`, `dir_id`, `ag_id`, `staff_id`, `company_id`, `branch_id`, `agentforstaff`, `line_id`, `group_id`, `mastermodule`, `company_creation`, `branch_creation`, `loan_category`, `loan_calculation`, `loan_scheme`, `area_creation`, `area_mapping`, `area_approval`, `adminmodule`, `director_creation`, `agent_creation`, `staff_creation`, `manage_user`, `doc_mapping`, `bank_creation`, `requestmodule`, `request`, `request_list_access`, `verificationmodule`, `verification`, `approvalmodule`, `approval`, `acknowledgementmodule`, `acknowledgement`, `loanissuemodule`, `loan_issue`, `collectionmodule`, `collection`, `collection_access`, `closedmodule`, `closed`, `nocmodule`, `noc`, `concernmodule`, `concern_creation`, `concern_solution`, `concern_feedback`, `accountsmodule`, `cash_tally`, `bank_details`, `cash_tally_admin`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(1, 'Super', 'Admin', 'Super Admin', 'Super Admin', 'support@feathertechnology.in', 'support@feathertechnology.in', 'admin@123', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, '0', '0', NULL, NULL, NULL, '2021-04-17 17:08:00', '2023-03-21 09:51:34'),
(21, NULL, NULL, 'Kumar', NULL, '', 'kumar@gmail.com', '123', '3', '3', '', '', '5', '1', '1,2', '28,29', '1,2,4', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '1', '0', '0', '', '1', '0', '1', '28', NULL, '2023-03-21 12:23:50', '2023-05-26 10:17:00'),
(24, NULL, NULL, 'Darling & Co', NULL, '', 'darling@gmail.com', '123', '2', '', '', '28', '', '1', '1', '', '1', '1,5', '0', '1', '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1', '0', '0', '1', '0', '0', '1', '1', '1', '1', '1', '1', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '1', '0', '1', '28', '1', '2023-03-21 15:12:31', '2023-05-26 18:53:10'),
(25, NULL, NULL, 'Big show', NULL, '', 'bigshow@gmail.com', '123', '1', '12', '3', '', '', '1', '1,2', '', '1,2,3', '1,6', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '1', '0', '0', '1', '1', '1', '1', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', NULL, '1', '0', '1', '25', NULL, '2023-03-31 12:03:21', '0000-00-00 00:00:00'),
(27, NULL, NULL, 'Alangar', NULL, 'test1@email.com', 'test1@email.com', '123', '2', '', '', '16', '', '1', '2', '', '', '6', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '1', '0', '0', '', '', '', '', NULL, NULL, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', NULL, '1', '0', '1', NULL, NULL, '2023-04-10 15:32:34', '2023-04-10 15:32:34'),
(28, NULL, NULL, 'Chithambaram', NULL, '', 'director@gmail.com', '123', '1', '11', '1', '', '', '1', '1,2', '', '1,2,3,4,5', '1,5,6', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '3', '0', '0', '1', '28', NULL, '2023-04-13 16:49:09', '2023-05-26 10:15:24'),
(29, NULL, NULL, 'Gokul', NULL, '', 'goku', '123', '3', '5', '', '', '7', '1', '1,2', '30', '3,4', '6', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '1', '1', '', '1', '0', '1', '1', NULL, '2023-05-22 15:27:11', '2023-05-25 14:55:39');

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
(6, 4, 'Indian Bank', 'Pondicherry', 'Jegatheesh', 5464654321321321, 'IB314654'),
(7, 16, 'IOB', 'Vilupuram', 'Appa', 6546546546, '654654'),
(8, 18, 'Indian Bank', 'Chennai', 'Arun', 456546544, 'IVDVHSDH23'),
(9, 17, 'ION', 'Pondy', 'Kumar', 9654654654, '984654'),
(10, 15, 'IB', 'Pondy', 'Sivasamy', 1656546546, '65465');

-- --------------------------------------------------------

--
-- Table structure for table `verification_cus_feedback`
--

CREATE TABLE `verification_cus_feedback` (
  `id` int(11) NOT NULL,
  `req_id` varchar(255) DEFAULT NULL,
  `feedback_label` varchar(255) DEFAULT NULL,
  `cus_feedback` varchar(255) DEFAULT NULL,
  `feedback_remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verification_cus_feedback`
--

INSERT INTO `verification_cus_feedback` (`id`, `req_id`, `feedback_label`, `cus_feedback`, `feedback_remark`) VALUES
(3, '2', 'Relationship', '5', NULL),
(4, '2', 'Approach', '4', NULL),
(6, '2', 'Character', '3', NULL),
(7, '18', 'Character', '3', 'Remake'),
(8, '17', 'Character', '5', NULL),
(9, '15', 'Approach', '4', NULL),
(10, '15', 'Character', '5', 'Remarks'),
(11, '10', 'Personality', '3', ''),
(12, '11', 'General', '5', ''),
(13, '3', 'Character', '2', ''),
(14, '20', 'Character', '4', 'Polite'),
(15, '14', 'Apperance', '3', 'ok');

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

--
-- Dumping data for table `verification_documentation`
--

INSERT INTO `verification_documentation` (`id`, `req_id`, `cus_id_doc`, `customer_name`, `cus_profile_id`, `doc_id`, `mortgage_process`, `Propertyholder_type`, `Propertyholder_name`, `Propertyholder_relationship_name`, `doc_property_relation`, `doc_property_type`, `doc_property_measurement`, `doc_property_location`, `doc_property_value`, `mortgage_name`, `mortgage_dsgn`, `mortgage_nuumber`, `reg_office`, `mortgage_value`, `mortgage_document`, `mortgage_document_upd`, `mortgage_document_pending`, `endorsement_process`, `owner_type`, `owner_name`, `ownername_relationship_name`, `en_relation`, `vehicle_type`, `vehicle_process`, `en_Company`, `en_Model`, `vehicle_reg_no`, `endorsement_name`, `en_RC`, `Rc_document_upd`, `Rc_document_pending`, `en_Key`, `gold_info`, `gold_sts`, `gold_type`, `Purity`, `gold_Count`, `gold_Weight`, `gold_Value`, `document_name`, `document_details`, `document_type`, `document_holder`, `docholder_name`, `docholder_relationship_name`, `doc_relation`, `cus_status`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`) VALUES
(1, '2', '885558978787', 'Remo', '2', 'DOC-101', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '1', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '1', '', '', '', '', '', '', 'XYZ', 'ABC', '0', '2', '', '3', 'Brother', '11', '0', '1', '1', NULL, '2023-04-17 17:51:47', '2023-04-17 17:51:47'),
(3, '18', '945454646565', 'Praveen', '4', 'DOC-102', '1', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '', '', '', '', '', 'Adhar', '123', '0', '0', 'Praveen', '', 'NIL', '11', '0', '28', '1', NULL, '2023-04-20 13:20:51', '2023-04-20 13:20:51'),
(4, '17', '646546546546', 'Rajesh', '7', 'DOC-103', '1', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '', '', '', '', '', 'Adhar', '123', '0', '2', '', '30', 'Father', '11', '0', '28', '1', NULL, '2023-04-20 17:30:15', '2023-04-20 17:30:15'),
(5, '15', '546546546465', 'Kuppusamy', '8', 'DOC-104', '1', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '', '', '', '', '', 'House Document', 'House Document', '0', '0', 'Kuppusamy', '', 'NIL', '11', NULL, '1', NULL, NULL, '2023-04-28 16:36:15', '2023-04-28 16:36:15'),
(6, '10', '123456789101', 'Triple H', '11', 'DOC-105', '1', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 'TT', '24k', '2', '233', '54000', 'Adhar', '123', '0', '2', '', '34', 'Father', '11', NULL, '28', NULL, NULL, '2023-04-28 16:42:03', '2023-04-28 16:42:03'),
(7, '11', '123456789101', 'Triple H', '12', 'DOC-106', '0', '0', 'Triple H', '', 'NIL', 'Building', '1651', 'Chennai', '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '', '', '', '', '', 'Adhar', '123', '1', '1', 'Under taker', '', 'Brother', '11', NULL, '25', NULL, NULL, '2023-04-29 15:43:43', '2023-04-29 15:43:43'),
(8, '3', '546546546465', 'Kuppusamy', '13', 'DOC-107', '1', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '', '', '', '', '', 'PAN', '123', '0', '0', 'Kuppusamy', '', 'NIL', '11', NULL, '25', NULL, NULL, '2023-04-29 15:55:15', '2023-04-29 15:55:15'),
(9, '20', '105806052023', 'Rakesh', '14', 'DOC-108', '1', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 'Necklace', '24k', '1', '0.586g', '47500', 'DL', 'License', '0', '0', 'Rakesh', '', 'NIL', '11', NULL, '21', NULL, NULL, '2023-05-06 11:10:41', '2023-05-06 11:10:41');

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

--
-- Dumping data for table `verification_family_info`
--

INSERT INTO `verification_family_info` (`id`, `cus_id`, `req_id`, `famname`, `relationship`, `other_remark`, `other_address`, `relation_age`, `relation_aadhar`, `relation_Mobile`, `relation_Occupation`, `relation_Income`, `relation_Blood`, `status`) VALUES
(23, NULL, 5, 'Arun', 'Father', '', '', 25, '234353455625', 9654566456, 'IT', 6554454, 'A', 0),
(24, NULL, 5, 'Kumari', 'Mother', '', '', 23, '465465465465', 9654654654, 'IT', 150000, 'B', 0),
(25, NULL, 4, 'Jegatheesh', 'Brother', '', ' ', 15, '5646-5465-4654', 1565465465, 'School', 0, 'o', 0),
(26, NULL, 5, 'Kumar', 'Brother', '', ' ', 25, '984651316546', 98465654, 'ds', 5432, 'df', 0),
(27, NULL, 16, 'Appa', 'Father', '', ' ', 45, '654654654654', 9454654654, 'sfd', 54000, 's', 0),
(28, NULL, 18, 'Arun', 'Son', '', ' ', 24, '874554548745', 7441852454, 'IT', 500000, 'A+ve', 0),
(29, NULL, 18, 'Anto', 'Brother', '', ' ', 25, '894454545465', 7444845445, 'IT', 751211, 'A+ve', 0),
(30, NULL, 17, 'Kumar', 'Father', '', ' ', 45, '65465654654', 9551616516, 'Business', 150000, 'O', 0),
(31, NULL, 17, 'Manimegalai', 'Mother', '', ' ', 40, '984651565653', 9846546546, 'HW', 0, 'AB+', 0),
(32, NULL, 15, 'Sivasamy', 'Brother', '', '', 46, '465465465465', 9846546546, 'Electronics', 50000, 'B+', 0),
(33, NULL, 15, 'Arun', 'Father', '', ' ', 25, '234353455625', 9654566456, 'IT', 25000, '', 0),
(34, NULL, 10, 'Dad', 'Father', '', ' ', 56, '946546546545', 946546546, 'Kooli', 15000, '', 0),
(35, NULL, 11, 'Under taker', 'Brother', '', ' ', 12, '646465454654', 694654654, 'WWE', 655000, '', 0),
(36, NULL, 3, 'Ramasamy', 'Other', 'Cousin', 'OKKK ', 25, '646546546546', 9465132132, 'It', 151312, '', 0),
(37, NULL, 20, 'Delhi Babu', 'Father', '', ' ', 49, '110206052023', 9456513213, 'Kooli', 8000, '', 0),
(38, NULL, 20, 'Janaki', 'Mother', '', ' ', 45, '110406052023', 8546546546, 'House wife', 0, '', 0),
(39, NULL, 14, 'Magesh', 'Brother', '', ' ', 26, '984653213213', 8946546465, 'Student', 0, '', 0);

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
(8, 5, 'Arun', 15, '564654654654', 9456465465, '1', 'TL'),
(9, 5, 'Kumari', 23, '984654653213', 9465432132, '2', 'Employe'),
(10, 4, 'Jegatheesh', 36, '184654656546', 9465451321, '1', 'TL'),
(11, 16, 'Amma', 45, '654654654654', 9846546546, '2', 'sdf'),
(12, 18, 'Siva', 25, '778974545454', 8858555822, '1', 'IT'),
(13, 17, 'Manoj', 20, '651132132132', 9151656546, '1', 'Founder'),
(14, 15, 'Mahalakshmi', 40, '654654654654', 9846546546, '2', 'Employee');

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
(29, 4, '1', '4', '84654564', '1451868.png'),
(30, 18, '2', '2', '454564654', 'Order_ID_4479904631.pdf'),
(31, 17, '1', '1', '9846546', 'Order_ID_4479904631.jpg'),
(32, 15, '1', '2', '64654', 'Order_ID_4479904631.pdf'),
(33, 10, '1', '2', '654646546', 'creative-mars-collage.jpg'),
(34, 11, '3', '2', '43345', 'ecpXIUeY_400x400.jpg'),
(35, 3, '3', '2', '24345', 'ramasamy-periyar.jpg'),
(36, 20, '0', '1', '105806052023', 'rakesh.png'),
(37, 20, '1', '1', '110406052023', 'janaki.png'),
(38, 14, '1', '1', '3425345', 'ecpXIUeY_400x400.jpg');

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

--
-- Dumping data for table `verification_loan_calculation`
--

INSERT INTO `verification_loan_calculation` (`loan_cal_id`, `req_id`, `cus_id_loan`, `cus_name_loan`, `cus_data_loan`, `mobile_loan`, `pic_loan`, `loan_category`, `sub_category`, `tot_value`, `ad_amt`, `loan_amt`, `profit_type`, `due_method_calc`, `due_type`, `profit_method`, `calc_method`, `due_method_scheme`, `day_scheme`, `scheme_name`, `int_rate`, `due_period`, `doc_charge`, `proc_fee`, `loan_amt_cal`, `principal_amt_cal`, `int_amt_cal`, `tot_amt_cal`, `due_amt_cal`, `doc_charge_cal`, `proc_fee_cal`, `net_cash_cal`, `due_start_from`, `maturity_month`, `collection_method`, `cus_status`, `insert_login_id`, `update_login_id`, `create_date`, `update_date`) VALUES
(10, '18', '945454646565', 'Praveen', 'New', '9844654654', 'wallpaperflare.com_wallpaper.jpg', '2', 'Business', '50000', '5000', '45000', '2', '', '', '', '', '3', '', '3', '10', '100', '15', '10', '45000', '40500', '4500', '45000', '450', '15', '10', '40475', '2023-05-05', '2023-08-13\n', '1', '12', '1', '1', '2023-04-20 17:19:26', '2023-04-21 09:48:19'),
(11, '17', '646546546546', 'Rajesh', 'New', '9565565465', 'pexels-cesar-perez-733745.jpg', '5', 'Multi Things', '25000', '5000', '20000', '2', 'Monthly', '', '', '', '3', '', '8', '10', '22', '1500', '1500', '20000', '18000', '2000', '20000', '909.0909090909091', '1500', '1500', '15000', '2023-05-05', '2023-08-13', '2', '12', '28', NULL, '2023-04-20 17:53:38', '2023-04-20 17:53:38'),
(13, '15', '546546546465', 'Kuppusamy', 'Existing', '9646465546', 'pexels-jakub-novacek-924824.jpg', '2', 'Business', '94654', '7504', '87150', '1', 'Monthly', 'Interest', '', 'Monthly', '', '', '', '2', '2', '2', '2', '87150', '87150', '1745', '', '', '1743', '1743', '83664', '2023-04-07', '2023-06-07', '1', '12', '1', NULL, '2023-04-28 16:36:56', '2023-04-28 16:36:56'),
(14, '10', '123456789101', 'Triple H', 'Existing', '9565654654', 'pexels-hansen-tang-13435926.jpg', '5', 'Multi Things', '24864', '943', '23921', '2', '', '', '', '', '1', '', '4', '5', '9', '1000', '1242', '23921', '22725', '1200', '23921', '2657', '1000', '1242', '20483', '2023-05-05', '2024-02-05', '2', '12', '28', NULL, '2023-04-28 16:43:27', '2023-04-28 16:43:27'),
(15, '11', '123456789101', 'Triple H', 'Existing', '9565654654', 'pexels-hansen-tang-13435926.jpg', '2', 'Business', '50000', '5000', '45000', '2', '', '', '', '', '3', '', '3', '10', '100', '20', '10', '45000', '40500', '4500', '45000', '450', '20', '10', '40470', '2023-05-05', '2023-08-13', '1', '12', '25', NULL, '2023-04-29 15:44:10', '2023-04-29 15:44:10'),
(16, '3', '546546546465', 'Kuppusamy', 'New', '9646465546', 'pexels-jakub-novacek-924824.jpg', '5', 'Furniture', '', '', '15000', '1', 'Monthly', 'Interest', '', 'Monthly', '', '', '', '10', '15', '10', '6', '15000', '15000', '1500', '', '', '1500', '900', '12600', '2023-05-05', '2024-08-05', '2', '12', '25', NULL, '2023-04-29 15:56:28', '2023-04-29 15:56:28'),
(17, '20', '105806052023', 'Rakesh', 'New', '8783565696', 'rakesh.png', '5', 'Mobile', '23500', '3500', '20000', '2', '', '', '', '', '1', '', '11', '0.7', '10', '1500', '1500', '20000', '19860', '140', '20000', '2000', '1500', '1500', '16860', '2023-06-03', '2024-04-03', '1', '12', '21', NULL, '2023-05-06 11:20:14', '2023-05-06 11:20:14'),
(18, '2', '885558978787', 'Remo', 'New', '9696988888', 'pondicherry-has-beautiful-coast-india-famous-unexplored-beaches-beautiful-coastline-india-123124828.jpg', '2', 'Business', '15000', '5000', '10000', '1', 'Monthly', 'Interest', '', 'Monthly', '', '', '', '1.5', '3', '1.5', '1.8', '10000', '10000', '150', '', '', '150', '180', '9670', '2023-06-02', '2023-09-02', '1', '12', '28', NULL, '2023-05-18 12:39:07', '2023-05-18 12:39:07');

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
(10, 4, 'House', '10*10', '15000', 'Jegatheesh'),
(11, 16, 'Prop', '45', '94654', 'Appa'),
(12, 18, 'House', '3500 sq.ft', '237434', 'Anto'),
(13, 17, 'House', '15', '150000', 'Kumar'),
(14, 15, 'Apartment', '15', '654654', 'Sivasamy');

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
-- Dumping data for table `verif_loan_cal_category`
--

INSERT INTO `verif_loan_cal_category` (`cat_id`, `req_id`, `loan_cal_id`, `category`) VALUES
(39, '17', '11', 'Fridge'),
(40, '17', '11', 'Fridge'),
(49, '18', '10', 'Vankozhi'),
(50, '18', '10', 'Nerupu kozhi'),
(51, '18', '10', 'Naatu Kozhi'),
(52, '15', '13', 'Mobile sales'),
(53, '15', '13', 'Car dealing'),
(54, '15', '13', 'Wood'),
(55, '10', '14', 'Fridge'),
(56, '10', '14', 'VCSM'),
(57, '11', '15', 'News Channel'),
(58, '3', '16', 'Sofa'),
(59, '3', '16', 'Samsung'),
(60, '20', '17', 'Onleplus'),
(61, '2', '18', 'Medical shop');

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
-- Indexes for table `branch_creation`
--
ALTER TABLE `branch_creation`
  ADD PRIMARY KEY (`branch_id`);

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
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `acknowlegement_customer_profile`
--
ALTER TABLE `acknowlegement_customer_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `acknowlegement_documentation`
--
ALTER TABLE `acknowlegement_documentation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `acknowlegement_loan_calculation`
--
ALTER TABLE `acknowlegement_loan_calculation`
  MODIFY `loan_cal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `agent_communication_details`
--
ALTER TABLE `agent_communication_details`
  MODIFY `comm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `agent_creation`
--
ALTER TABLE `agent_creation`
  MODIFY `ag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `agent_group_creation`
--
ALTER TABLE `agent_group_creation`
  MODIFY `agent_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
-- AUTO_INCREMENT for table `bank_creation`
--
ALTER TABLE `bank_creation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `branch_creation`
--
ALTER TABLE `branch_creation`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cash_tally_modes`
--
ALTER TABLE `cash_tally_modes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cheque_info`
--
ALTER TABLE `cheque_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cheque_no_list`
--
ALTER TABLE `cheque_no_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cheque_upd`
--
ALTER TABLE `cheque_upd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `closed_status`
--
ALTER TABLE `closed_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `coll_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `collection_charges`
--
ALTER TABLE `collection_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company_creation`
--
ALTER TABLE `company_creation`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `concern_creation`
--
ALTER TABLE `concern_creation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `concern_subject`
--
ALTER TABLE `concern_subject`
  MODIFY `concern_sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customer_register`
--
ALTER TABLE `customer_register`
  MODIFY `cus_reg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `director_creation`
--
ALTER TABLE `director_creation`
  MODIFY `dir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `document_info`
--
ALTER TABLE `document_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doc_mapping`
--
ALTER TABLE `doc_mapping`
  MODIFY `doc_map_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fingerprints`
--
ALTER TABLE `fingerprints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gold_info`
--
ALTER TABLE `gold_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `in_acknowledgement`
--
ALTER TABLE `in_acknowledgement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `in_issue`
--
ALTER TABLE `in_issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- AUTO_INCREMENT for table `loan_issue`
--
ALTER TABLE `loan_issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `loan_scheme`
--
ALTER TABLE `loan_scheme`
  MODIFY `scheme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `loan_summary_feedback`
--
ALTER TABLE `loan_summary_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `noc`
--
ALTER TABLE `noc`
  MODIFY `noc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `request_category_info`
--
ALTER TABLE `request_category_info`
  MODIFY `cat_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `request_creation`
--
ALTER TABLE `request_creation`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `signed_doc`
--
ALTER TABLE `signed_doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `signed_doc_info`
--
ALTER TABLE `signed_doc_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `staff_creation`
--
ALTER TABLE `staff_creation`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `staff_type_creation`
--
ALTER TABLE `staff_type_creation`
  MODIFY `staff_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_area_list_creation`
--
ALTER TABLE `sub_area_list_creation`
  MODIFY `sub_area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `verification_bank_info`
--
ALTER TABLE `verification_bank_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `verification_cus_feedback`
--
ALTER TABLE `verification_cus_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `verification_documentation`
--
ALTER TABLE `verification_documentation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `verification_family_info`
--
ALTER TABLE `verification_family_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `verification_group_info`
--
ALTER TABLE `verification_group_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `verification_kyc_info`
--
ALTER TABLE `verification_kyc_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `verification_loan_calculation`
--
ALTER TABLE `verification_loan_calculation`
  MODIFY `loan_cal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `verification_property_info`
--
ALTER TABLE `verification_property_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `verif_loan_cal_category`
--
ALTER TABLE `verif_loan_cal_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
