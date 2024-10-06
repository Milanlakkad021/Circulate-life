-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 12:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usertype` varchar(5) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `email`, `usertype`) VALUES
(2, 'Milan Lakkad', 'admin', '$2y$10$mM54bClyuupaWHp/XaH2IuiAdY4alk1sXqeDT0QMSKb9.HZCa.fhi', 'milanlakkadstdy3@gmail.com', 'recip');

-- --------------------------------------------------------

--
-- Table structure for table `blood_donation`
--

CREATE TABLE `blood_donation` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','O+','O-','AB+','AB-') NOT NULL,
  `unit` int(11) NOT NULL,
  `donation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_donation`
--

INSERT INTO `blood_donation` (`id`, `username`, `blood_group`, `unit`, `donation_date`) VALUES
(1, 'donor', 'O+', 2, '2024-10-06 08:27:12');

-- --------------------------------------------------------

--
-- Table structure for table `blood_request`
--

CREATE TABLE `blood_request` (
  `id` int(11) NOT NULL,
  `donor_username` varchar(255) DEFAULT NULL,
  `recipient_username` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `reason_for_blood` text NOT NULL,
  `when_required` date NOT NULL,
  `unit` int(11) NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `file_upload` varchar(255) DEFAULT NULL,
  `status` enum('pending','accept','reject') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_request`
--

INSERT INTO `blood_request` (`id`, `donor_username`, `recipient_username`, `name`, `age`, `blood_group`, `reason_for_blood`, `when_required`, `unit`, `hospital_name`, `doctor_name`, `gender`, `address`, `pincode`, `contact`, `email`, `file_upload`, `status`) VALUES
(1, NULL, 'user', 'Milan Lakkad', 20, '', 'acc', '2022-02-02', 2, 'sdfg', 'sadsdf', 'male', 'Nareshbhai Lakkad Patel Street Kotamoi', '364280', '9328458502', 'milanlakkadstdy@gmail.com', 'Yoga.txt', 'pending'),
(2, NULL, 'user', 'Milan Lakkad', 20, 'A+', 'acc', '2022-02-02', 2, 'asdfghjkl;', 'sadsdf', 'male', 'Nareshbhai Lakkad Patel Street Kotamoi', '364280', '9328458502', 'milanlakkadstdy@gmail.com', 'Yoga.txt', 'pending'),
(9, 'donor', NULL, 'Milan Lakkad', 20, 'A+', 'acc', '0000-00-00', 2, 'sdfg', 'sadsdf', 'male', 'Nareshbhai Lakkad Patel Street Kotamoi', '364280', '9328458502', 'milanlakkadstdy@gmail.com', 'Yoga.txt', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `blood_storage`
--

CREATE TABLE `blood_storage` (
  `id` int(11) NOT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_storage`
--

INSERT INTO `blood_storage` (`id`, `blood_group`, `unit`) VALUES
(1, 'A+', 6),
(2, 'A-', 3),
(3, 'B+', 8),
(4, 'B-', 5),
(5, 'AB+', 3),
(6, 'AB-', 2),
(7, 'O+', 12),
(8, 'O-', 6),
(9, 'O+', 2);

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usertype` varchar(5) DEFAULT 'donor',
  `body_weight` decimal(5,2) DEFAULT NULL,
  `body_height` decimal(5,2) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `blood_group` enum('A+','A-','B+','B-','O+','O-','AB+','AB-') NOT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `file_upload` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`id`, `name`, `username`, `password`, `email`, `usertype`, `body_weight`, `body_height`, `age`, `blood_group`, `gender`, `dob`, `address`, `pincode`, `contact`, `file_upload`) VALUES
(1, 'Milan Lakkad', 'donor', '$2y$10$7puF/IefzCLoBPRShYLyu.9BTkoMiiR2fVs7i8VNXiKpvPkRqHrCm', 'milanlakkadstdy@gmail.com', 'donor', 55.00, 5.00, 20, 'O-', 'Male', '0000-00-00', 'Patel street , kotamoi,\r\nTa: jesar dist.: Bhavangar', '364280', '8974561325', 'Yoga.txt');

-- --------------------------------------------------------

--
-- Table structure for table `recipient`
--

CREATE TABLE `recipient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usertype` varchar(10) DEFAULT 'recipient'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipient`
--

INSERT INTO `recipient` (`id`, `name`, `username`, `password`, `email`, `usertype`) VALUES
(1, 'Milan Lakkad', 'user', '$2y$10$diGzTpgveDtXEAa/Bka7UOJFrBD2eswVWLl.w10J7mog/dUa3.F/a', 'milanlakkadstdy1@gmail.com', 'recipient');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `blood_donation`
--
ALTER TABLE `blood_donation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `blood_request`
--
ALTER TABLE `blood_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_donor` (`donor_username`),
  ADD KEY `fk_recipient` (`recipient_username`);

--
-- Indexes for table `blood_storage`
--
ALTER TABLE `blood_storage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `recipient`
--
ALTER TABLE `recipient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blood_donation`
--
ALTER TABLE `blood_donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blood_request`
--
ALTER TABLE `blood_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `blood_storage`
--
ALTER TABLE `blood_storage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `recipient`
--
ALTER TABLE `recipient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_donation`
--
ALTER TABLE `blood_donation`
  ADD CONSTRAINT `blood_donation_ibfk_1` FOREIGN KEY (`username`) REFERENCES `donor` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `blood_request`
--
ALTER TABLE `blood_request`
  ADD CONSTRAINT `fk_donor` FOREIGN KEY (`donor_username`) REFERENCES `donor` (`username`),
  ADD CONSTRAINT `fk_recipient` FOREIGN KEY (`recipient_username`) REFERENCES `recipient` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
