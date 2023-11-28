-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 01:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_dashboard`
--

CREATE TABLE `admin_dashboard` (
  `id` int(6) UNSIGNED NOT NULL,
  `requestedBloodType` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

CREATE TABLE `blood_requests` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `patient_email` varchar(255) NOT NULL,
  `requested_blood_type` varchar(5) NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_requests`
--

INSERT INTO `blood_requests` (`id`, `patient_name`, `patient_email`, `requested_blood_type`, `request_time`) VALUES
(1, 'Joseph Olorbida', 'olorbidajoseph05@gmail.com', 'A-', '2023-11-22 13:29:05'),
(2, 'Joseph Olorbida', 'olorbidajoseph05@gmail.com', 'B+', '2023-11-24 07:41:09');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `id` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phoneNumber` varchar(12) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `bloodType` varchar(5) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `bagsOfBlood` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`id`, `age`, `address`, `phoneNumber`, `sex`, `email`, `bloodType`, `weight`, `firstName`, `lastName`, `timestamp`, `bagsOfBlood`) VALUES
(2, 21, 'Montebello ', '09104811904', 'male', 'olorbidajoseph05@gmail.com', 'A+', 78, 'Joseph', 'Olorbida', '2023-11-22 13:27:17', 3),
(3, 22, 'CapDowns', '09103123123', 'male', 'ravigel@gmail.com', 'A-', 70, 'Ravigel ', 'Ablen', '2023-11-24 07:39:40', 3);

-- --------------------------------------------------------

--
-- Table structure for table `requester_info`
--

CREATE TABLE `requester_info` (
  `id` int(11) NOT NULL,
  `requester_name` varchar(255) NOT NULL,
  `requester_email` varchar(255) NOT NULL,
  `requester_number` varchar(20) NOT NULL,
  `requested_blood_type` varchar(5) NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requester_info`
--

INSERT INTO `requester_info` (`id`, `requester_name`, `requester_email`, `requester_number`, `requested_blood_type`, `request_time`) VALUES
(1, 'Joseph', 'joseph.olorbida@evsu.edu.ph', '09104811904', 'A+', '2023-11-19 08:36:42'),
(2, 'Joseph', 'joseph05@gmail.com', '09104811904', 'A+', '2023-11-22 13:27:41'),
(3, 'Ravigel Ablen', 'Ravigel@gmail.com', '0910213123', 'A+', '2023-11-22 13:37:11'),
(4, 'Joseph Olorbida', 'olorbidajoseph05@gmail.com', '09104811904', 'A-', '2023-11-24 07:41:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_dashboard`
--
ALTER TABLE `admin_dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requester_info`
--
ALTER TABLE `requester_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_dashboard`
--
ALTER TABLE `admin_dashboard`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blood_requests`
--
ALTER TABLE `blood_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requester_info`
--
ALTER TABLE `requester_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
