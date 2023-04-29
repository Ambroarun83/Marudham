-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2023 at 12:14 PM
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
(23, 5, 'Arun', 'Father', '', '', 25, '2343 5345 5625', 9654566456, 'IT', 6554454, 'A', 0),
(24, 5, 'Kumari', 'Mother', '', '', 23, '4654 6546 5465', 9654654654, 'IT', 150000, 'B', 0),
(25, 4, 'Jegatheesh', 'Brother', '', ' ', 15, '5646-5465-4654', 1565465465, 'School', 0, 'o', 0),
(26, 5, 'Kumar', 'Brother', '', ' ', 25, '9846 5131 6546', 98465654, 'ds', 5432, 'df', 0),
(27, 16, 'Appa', 'Father', '', ' ', 45, '6546 5465 4654', 9454654654, 'sfd', 54000, 's', 0),
(28, 18, 'Arun', 'Son', '', ' ', 24, '8745 5454 8745', 7441852454, 'IT', 500000, 'A+ve', 0),
(29, 18, 'Anto', 'Brother', '', ' ', 25, '8944 5454 5465', 7444845445, 'IT', 751211, 'A+ve', 0),
(30, 17, 'Kumar', 'Father', '', ' ', 45, '6546 5654 654', 9551616516, 'Business', 150000, 'O', 0),
(31, 17, 'Manimegalai', 'Mother', '', ' ', 40, '9846 5156 5653', 9846546546, 'HW', 0, 'AB+', 0),
(32, 15, 'Sivasamy', 'Brother', '', '', 46, '4654 6546 5465', 9846546546, 'Electronics', 50000, 'B+', 0),
(33, 15, 'Arun', 'Father', '', ' ', 25, '2343 5345 5625', 9654566456, 'IT', 25000, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `verification_family_info`
--
ALTER TABLE `verification_family_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `verification_family_info`
--
ALTER TABLE `verification_family_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
