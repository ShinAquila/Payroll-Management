-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2024 at 05:07 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_info`
--

CREATE TABLE `account_info` (
  `acc_info_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `days_full_day` int(11) NOT NULL,
  `days_half_day` int(11) NOT NULL,
  `days_absent` int(11) NOT NULL,
  `total_overtime_hours` int(11) NOT NULL,
  `bonus` decimal(11,2) NOT NULL,
  `benefits_deductions` decimal(11,2) NOT NULL,
  `tax_deductions` decimal(11,2) NOT NULL,
  `total_deductions` decimal(11,2) NOT NULL,
  `total_gross_pay` decimal(11,2) NOT NULL,
  `total_net_pay` decimal(11,2) NOT NULL,
  `start_pay_period` date NOT NULL,
  `end_pay_period` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_info`
--

INSERT INTO `account_info` (`acc_info_id`, `employee_id`, `days_full_day`, `days_half_day`, `days_absent`, `total_overtime_hours`, `bonus`, `benefits_deductions`, `tax_deductions`, `total_deductions`, `total_gross_pay`, `total_net_pay`, `start_pay_period`, `end_pay_period`) VALUES
(120, 9, 21, 3, 3, 5, '1000.00', '8775.00', '6908.40', '15683.40', '58500.00', '42816.60', '2024-03-01', '2024-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `overtime_hrs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `employee_id`, `date`, `status`, `overtime_hrs`) VALUES
(1, 32, '2024-02-01', 'FULL DAY', 2),
(5, 32, '2024-02-02', 'HALF DAY', 0),
(6, 32, '2024-02-03', 'FULL DAY', 0),
(8, 32, '2024-02-05', 'ABSENT', 0),
(9, 32, '2024-02-06', 'FULL DAY', 1),
(10, 32, '2024-02-07', 'FULL DAY', 0),
(11, 32, '2024-02-08', 'ABSENT', 0),
(12, 32, '2024-02-09', 'FULL DAY', 0),
(13, 32, '2024-02-10', 'FULL DAY', 0),
(15, 32, '2024-02-12', 'FULL DAY', 0),
(16, 32, '2024-02-13', 'FULL DAY', 0),
(17, 32, '2024-02-14', 'FULL DAY', 0),
(18, 32, '2024-02-15', 'FULL DAY', 0),
(19, 32, '2024-02-16', 'FULL DAY', 0),
(20, 32, '2024-02-17', 'FULL DAY', 3),
(22, 32, '2024-02-19', 'ABSENT', 0),
(23, 32, '2024-02-20', 'FULL DAY', 0),
(24, 32, '2024-02-21', 'FULL DAY', 0),
(25, 32, '2024-02-22', 'FULL DAY', 0),
(26, 32, '2024-02-23', 'FULL DAY', 0),
(27, 32, '2024-02-24', 'FULL DAY', 0),
(28, 32, '2024-02-26', 'FULL DAY', 1),
(29, 32, '2024-02-27', 'HALF DAY', 0),
(30, 32, '2024-02-28', 'FULL DAY', 0),
(31, 32, '2024-02-29', 'FULL DAY', 0),
(32, 6, '2024-02-01', 'FULL DAY', 0),
(33, 6, '2024-02-02', 'FULL DAY', 0),
(34, 6, '2024-02-03', 'FULL DAY', 0),
(37, 6, '2024-02-05', 'FULL DAY', 5),
(38, 6, '2024-02-06', 'HALF DAY', 0),
(39, 6, '2024-02-07', 'FULL DAY', 0),
(40, 6, '2024-02-08', 'ABSENT', 0),
(41, 6, '2024-02-09', 'FULL DAY', 0),
(42, 6, '2024-02-10', 'FULL DAY', 0),
(43, 6, '2024-02-12', 'HALF DAY', 0),
(44, 6, '2024-02-13', 'FULL DAY', 0),
(45, 6, '2024-02-14', 'ABSENT', 0),
(46, 6, '2024-02-15', 'FULL DAY', 0),
(47, 6, '2024-02-16', 'FULL DAY', 0),
(48, 6, '2024-02-17', 'FULL DAY', 0),
(49, 6, '2024-02-19', 'FULL DAY', 0),
(50, 6, '2024-02-20', 'FULL DAY', 0),
(51, 6, '2024-02-21', 'FULL DAY', 0),
(52, 6, '2024-02-22', 'HALF DAY', 0),
(53, 6, '2024-02-23', 'FULL DAY', 0),
(54, 6, '2024-02-24', 'FULL DAY', 0),
(55, 6, '2024-02-26', 'ABSENT', 0),
(56, 6, '2024-02-27', 'FULL DAY', 2),
(57, 6, '2024-02-28', 'FULL DAY', 0),
(58, 6, '2024-02-29', 'HALF DAY', 0),
(60, 9, '2024-03-01', 'FULL DAY', 0),
(61, 9, '2024-03-02', 'FULL DAY', 0),
(62, 9, '2024-03-04', 'FULL DAY', 0),
(63, 9, '2024-03-05', 'FULL DAY', 3),
(64, 9, '2024-03-06', 'HALF DAY', 0),
(65, 9, '2024-03-07', 'FULL DAY', 0),
(66, 9, '2024-03-08', 'FULL DAY', 0),
(67, 9, '2024-03-09', 'ABSENT', 0),
(68, 9, '2024-03-11', 'FULL DAY', 0),
(69, 9, '2024-03-12', 'FULL DAY', 0),
(70, 9, '2024-03-13', 'ABSENT', 0),
(71, 9, '2024-03-14', 'FULL DAY', 2),
(72, 9, '2024-03-15', 'FULL DAY', 0),
(73, 9, '2024-03-16', 'ABSENT', 0),
(74, 9, '2024-03-18', 'HALF DAY', 0),
(75, 9, '2024-03-19', 'FULL DAY', 0),
(76, 9, '2024-03-20', 'FULL DAY', 0),
(77, 9, '2024-03-21', 'FULL DAY', 0),
(78, 9, '2024-03-22', 'HALF DAY', 0),
(79, 9, '2024-03-23', 'FULL DAY', 0),
(80, 9, '2024-03-25', 'FULL DAY', 0),
(81, 9, '2024-03-25', 'FULL DAY', 0),
(82, 9, '2024-03-26', 'FULL DAY', 0),
(83, 9, '2024-03-27', 'FULL DAY', 0),
(84, 9, '2024-03-28', 'FULL DAY', 0),
(85, 9, '2024-03-29', 'FULL DAY', 0),
(86, 9, '2024-03-30', 'FULL DAY', 0);

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `deduction_id` int(5) NOT NULL,
  `deduction_name` varchar(100) NOT NULL,
  `deduction_percent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`deduction_id`, `deduction_name`, `deduction_percent`) VALUES
(1, 'PHILHEALTH', 5),
(3, 'GSIS', 9),
(4, 'PAGIBIG', 2),
(5, 'SSS', 14);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(250) DEFAULT NULL,
  `dept_salary_rate` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `dept_salary_rate`) VALUES
(0, 'NOT SET', '0.00'),
(2, 'UX Designer', '2000.00'),
(7, 'Software Developer', '3000.00'),
(8, 'Mobile Developer', '2750.00'),
(9, 'Database Manager', '2250.00'),
(10, 'Web Developer', '3250.00'),
(18, 'IT Technician', '2500.00');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(10) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dept` int(30) NOT NULL,
  `has_philhealth` int(5) NOT NULL,
  `has_gsis` int(5) NOT NULL,
  `has_pagibig` int(5) NOT NULL,
  `has_sss` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `lname`, `fname`, `gender`, `email`, `dept`, `has_philhealth`, `has_gsis`, `has_pagibig`, `has_sss`) VALUES
(6, 'Sabit', 'Jessa', 'Female', 'sabit@gmail.com', 7, 1, 0, 1, 0),
(9, 'Maglangit', 'Karen', 'Female', 'maglangit@gmail.com', 18, 1, 1, 1, 1),
(11, 'Leonida', 'Fritzie Apple', 'Male', 'leonida@gmail.com', 2, 0, 0, 1, 0),
(13, 'Corpuz', 'Allan', 'Male', 'corpuz@gmail.com', 10, 1, 0, 1, 1),
(14, 'Bueno', 'Kyll John', 'Male', 'bueno@gmail.com', 2, 0, 0, 1, 0),
(15, 'Albarracin', 'Brent', 'Male', 'albarracin@gmail.com', 7, 1, 0, 0, 0),
(17, 'Rivera', 'Vincent Ace', 'Male', 'ace@gmail.com', 9, 0, 0, 1, 1),
(18, 'Cardo', 'Dalisay', 'Male', 'CardoDali@gmail.com', 9, 1, 0, 0, 0),
(32, 'Bravo', 'Johnny', 'Male', 'fafa@gmail.com', 8, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `ot_id` int(10) NOT NULL,
  `rate` int(10) NOT NULL,
  `none` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`ot_id`, `rate`, `none`) VALUES
(1, 250, 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary_history`
--

CREATE TABLE `salary_history` (
  `history_id` int(11) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `department` varchar(250) NOT NULL,
  `salary` decimal(11,2) NOT NULL,
  `overtime_hours` int(5) NOT NULL,
  `start_pay_period` date NOT NULL,
  `end_pay_period` date NOT NULL,
  `total_gross_pay` decimal(11,2) NOT NULL,
  `philhealth` decimal(11,2) NOT NULL,
  `gsis` decimal(11,2) NOT NULL,
  `pagibig` decimal(11,2) NOT NULL,
  `sss` decimal(11,2) NOT NULL,
  `total_benefits_deductions` decimal(11,2) NOT NULL,
  `total_tax_deductions` decimal(11,2) NOT NULL,
  `total_deductions` decimal(11,2) NOT NULL,
  `total_net_pay` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary_history`
--

INSERT INTO `salary_history` (`history_id`, `last_name`, `first_name`, `department`, `salary`, `overtime_hours`, `start_pay_period`, `end_pay_period`, `total_gross_pay`, `philhealth`, `gsis`, `pagibig`, `sss`, `total_benefits_deductions`, `total_tax_deductions`, `total_deductions`, `total_net_pay`) VALUES
(1, 'Maglangit', 'Karen', 'IT Technician', '2500.00', 5, '2024-03-01', '2024-03-31', '58500.00', '1462.50', '2632.50', '585.00', '4095.00', '8775.00', '6908.40', '15683.40', '42816.60');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'ace', '12345'),
(2, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_info`
--
ALTER TABLE `account_info`
  ADD PRIMARY KEY (`acc_info_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`deduction_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `dept` (`dept`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`ot_id`);

--
-- Indexes for table `salary_history`
--
ALTER TABLE `salary_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_info`
--
ALTER TABLE `account_info`
  MODIFY `acc_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `deduction_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `ot_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salary_history`
--
ALTER TABLE `salary_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_info`
--
ALTER TABLE `account_info`
  ADD CONSTRAINT `account_info_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`dept`) REFERENCES `department` (`dept_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
