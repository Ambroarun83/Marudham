-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2023 at 12:40 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

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

INSERT INTO `loan_issue` (`id`, `req_id`, `cus_id`, `issued_to`, `agent_id`, `issued_mode`, `payment_type`, `cash`, `cheque_no`, `cheque_value`, `cheque_remark`, `transaction_id`, `transaction_value`, `transaction_remark`, `balance_amount`, `net_cash`, `cash_guarentor_name`, `relationship`, `status`, `insert_login_id`, `update_login_id`, `created_date`) VALUES
(1, '1', '885558978787', 'GB', '28', '0', '', '', '12121313', '5000', 'Testing', '', '', '', '14880', '19880', '1', 'Brother', '0', '24', NULL, '2023-04-29 14:49:27'),
(2, '1', '885558978787', 'GB', '28', '0', '', '5000', '', '', '', '', '', '', '9880', '19880', '2', 'Brother', '0', '24', NULL, '2023-04-29 14:55:36'),
(3, '1', '885558978787', 'GB', '28', '0', '', '5000', '', '', '', '', '', '', '4880', '19880', '1', 'Brother', '0', '24', NULL, '2023-04-29 15:03:50'),
(4, '1', '885558978787', 'GB', '28', '0', '', '4880', '', '', '', '', '', '', '0', '19880', '2', 'Brother', '0', '24', NULL, '2023-04-29 15:28:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loan_issue`
--
ALTER TABLE `loan_issue`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loan_issue`
--
ALTER TABLE `loan_issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
