-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 02:31 AM
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
  `overtime_hours` int(11) NOT NULL,
  `bonus` decimal(11,2) NOT NULL,
  `philhealth_check` varchar(20) NOT NULL,
  `gsis_check` varchar(20) NOT NULL,
  `pagibig_check` varchar(20) NOT NULL,
  `sss_check` varchar(20) NOT NULL,
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

INSERT INTO `account_info` (`acc_info_id`, `employee_id`, `days_full_day`, `days_half_day`, `days_absent`, `overtime_hours`, `bonus`, `philhealth_check`, `gsis_check`, `pagibig_check`, `sss_check`, `benefits_deductions`, `tax_deductions`, `total_deductions`, `total_gross_pay`, `total_net_pay`, `start_pay_period`, `end_pay_period`) VALUES
(35, 32, 20, 2, 3, 2, '500.00', '0', '1', '1', '0', '3520.00', '8008.40', '11528.40', '64000.00', '52471.60', '2024-02-01', '2024-02-29'),
(36, 6, 18, 4, 3, 4, '250.00', '1', '0', '0', '1', '5818.75', '7458.40', '13277.15', '61250.00', '47972.85', '2024-02-01', '2024-02-29');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `employee_id`, `date`, `status`) VALUES
(1, 32, '2024-02-01', 'FULL DAY'),
(5, 32, '2024-02-02', 'HALF DAY'),
(6, 32, '2024-02-03', 'FULL DAY'),
(8, 32, '2024-02-05', 'ABSENT'),
(9, 32, '2024-02-06', 'FULL DAY'),
(10, 32, '2024-02-07', 'FULL DAY'),
(11, 32, '2024-02-08', 'ABSENT'),
(12, 32, '2024-02-09', 'FULL DAY'),
(13, 32, '2024-02-10', 'FULL DAY'),
(15, 32, '2024-02-12', 'FULL DAY'),
(16, 32, '2024-02-13', 'FULL DAY'),
(17, 32, '2024-02-14', 'FULL DAY'),
(18, 32, '2024-02-15', 'FULL DAY'),
(19, 32, '2024-02-16', 'FULL DAY'),
(20, 32, '2024-02-17', 'FULL DAY'),
(22, 32, '2024-02-19', 'ABSENT'),
(23, 32, '2024-02-20', 'FULL DAY'),
(24, 32, '2024-02-21', 'FULL DAY'),
(25, 32, '2024-02-22', 'FULL DAY'),
(26, 32, '2024-02-23', 'FULL DAY'),
(27, 32, '2024-02-24', 'FULL DAY'),
(28, 32, '2024-02-26', 'FULL DAY'),
(29, 32, '2024-02-27', 'HALF DAY'),
(30, 32, '2024-02-28', 'FULL DAY'),
(31, 32, '2024-02-29', 'FULL DAY'),
(32, 6, '2024-02-01', 'FULL DAY'),
(33, 6, '2024-02-02', 'FULL DAY'),
(34, 6, '2024-02-03', 'FULL DAY'),
(37, 6, '2024-02-05', 'FULL DAY'),
(38, 6, '2024-02-06', 'HALF DAY'),
(39, 6, '2024-02-07', 'FULL DAY'),
(40, 6, '2024-02-08', 'ABSENT'),
(41, 6, '2024-02-09', 'FULL DAY'),
(42, 6, '2024-02-10', 'FULL DAY'),
(43, 6, '2024-02-12', 'HALF DAY'),
(44, 6, '2024-02-13', 'FULL DAY'),
(45, 6, '2024-02-14', 'ABSENT'),
(46, 6, '2024-02-15', 'FULL DAY'),
(47, 6, '2024-02-16', 'FULL DAY'),
(48, 6, '2024-02-17', 'FULL DAY'),
(49, 6, '2024-02-19', 'FULL DAY'),
(50, 6, '2024-02-20', 'FULL DAY'),
(51, 6, '2024-02-21', 'FULL DAY'),
(52, 6, '2024-02-22', 'HALF DAY'),
(53, 6, '2024-02-23', 'FULL DAY'),
(54, 6, '2024-02-24', 'FULL DAY'),
(55, 6, '2024-02-26', 'ABSENT'),
(56, 6, '2024-02-27', 'FULL DAY'),
(57, 6, '2024-02-28', 'FULL DAY'),
(58, 6, '2024-02-29', 'HALF DAY'),
(59, 37, '2024-03-01', 'FULL DAY');

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
  `dept_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
(0, 'NOT SET'),
(2, 'UX Designer'),
(7, 'Software Developer'),
(8, 'Mobile Developer'),
(9, 'Database Manager'),
(10, 'Web Developer'),
(18, 'IT Technician');

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
  `dept` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `lname`, `fname`, `gender`, `email`, `dept`) VALUES
(6, 'Sabit', 'Jessa', 'Female', 'sabit@gmail.com', 7),
(8, 'Pasadas', 'Renz', 'Male', 'pasadas@gmail.com', 10),
(9, 'Maglangit', 'Karen', 'Female', 'maglangit@gmail.com', 18),
(11, 'Leonida', 'Fritzie Apple', 'Male', 'leonida@gmail.com', 2),
(13, 'Corpuz', 'Allan', 'Male', 'corpuz@gmail.com', 10),
(14, 'Bueno', 'Kyll John', 'Male', 'bueno@gmail.com', 2),
(15, 'Albarracin', 'Brent', 'Male', 'albarracin@gmail.com', 7),
(17, 'Rivera', 'Vincent Ace', 'Male', 'ace@gmail.com', 9),
(18, 'Cardo', 'Dalisay', 'Male', 'CardoDali@gmail.com', 9),
(19, 'Sy', 'Leisha', 'Female', 'Leishy@gmail.com', 10),
(20, 'Hens', 'Kelra', 'Male', 'KelraHel@gmail.com', 8),
(21, 'Max', 'Lisha', 'Female', 'Lishamax@gmail.com', 2),
(22, 'Pacquaio', 'Manny', 'Male', 'pacman@gmail.com', 2),
(23, 'Tate', 'Lesley', 'Female', 'LesleyTate@gmail.com', 18),
(24, 'Donut', 'Boi', 'Male', 'Nadonut@gmail.com', 18),
(25, 'Lazada', 'Renz', 'Male', 'renzshopping@gmail.com', 8),
(27, 'Corn', 'Dog', 'Other', 'corndog@gmail.com', 10),
(28, 'Rojin', 'Carl', 'Male', 'carlrojin@gmail.com', 18),
(31, 'Penduko', 'Pedro', 'Male', 'penduko@gmail.com', 8),
(32, 'Bravo', 'Johnny', 'Male', 'fafa@gmail.com', 2),
(37, 'Bravo', 'S', 'Other', 's@gmail.com', 7);

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
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `salary_id` int(10) NOT NULL,
  `salary_rate` int(10) NOT NULL,
  `none` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`salary_id`, `salary_rate`, `none`) VALUES
(1, 3000, 0);

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
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salary_id`);

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
  MODIFY `acc_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `deduction_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `ot_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `salary_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
