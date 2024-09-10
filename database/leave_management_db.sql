-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2024 at 09:23 AM
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
-- Database: `leave_management_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `emp_doj` varchar(255) NOT NULL,
  `emp_password` varchar(10) NOT NULL,
  `emp_mobile` varchar(11) NOT NULL,
  `created_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_name`, `emp_email`, `emp_doj`, `emp_password`, `emp_mobile`, `created_time`) VALUES
(1, 'Rudra Jena', 'radura@gmail.com', '2024-01-03', '123', '6352902956', '2024-01-03 10:45:04'),
(3, 'Balram Panda', 'bal@gmail.com', '2024-01-03', '123', '6352902955', '2024-01-03 11:02:45'),
(4, 'Biku Swain', 'biku@gmail.com', '2024-01-04', '123456', '6352902957', '2024-01-03 11:13:51'),
(5, 'sunita Das', 'sunita@gmail.com', '2024-01-05', '123', '6352902959', '2024-01-04 10:06:49'),
(6, 'Rani swain', 'rani@gmail.com', '2024-01-06', '123', '6352902950', '2024-01-04 10:08:14'),
(7, 'Umasankar Dash', 'Umasankar@gmail.com', '2024-01-05', '123', '6352902944', '2024-01-04 10:09:44'),
(8, 'shyam shau', 'shyam@gmail.com', '2024-01-08', '123', '6352902946', '2024-01-04 10:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `employeeadd`
--

CREATE TABLE `employeeadd` (
  `empa_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `manage_id` int(11) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employeeadd`
--

INSERT INTO `employeeadd` (`empa_id`, `emp_id`, `manage_id`, `created_time`) VALUES
(3, 4, 2, '2024-01-03 14:29:30'),
(4, 5, 1, '2024-01-04 04:37:12'),
(7, 6, 3, '2024-01-16 05:37:54'),
(8, 8, 1, '2024-01-16 09:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE `employee_details` (
  `empd_id` int(11) NOT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(10) DEFAULT NULL,
  `postal_code` int(6) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `emp_id` int(11) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`empd_id`, `dob`, `gender`, `address`, `city`, `country`, `postal_code`, `about`, `emp_id`, `created_time`) VALUES
(1, '2024-01-04', 'Man', 'balisira ganjam', 'Ganjam', 'India', 761115, 'I am Balram Panda a passionate web developer with a keen interest in full-stack development.', 3, '2024-01-03 07:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave_count`
--

CREATE TABLE `employee_leave_count` (
  `employee_leave_count_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `total_casual_leave` float NOT NULL DEFAULT 6,
  `total_sick_leave` float NOT NULL DEFAULT 6,
  `total_paid_leave` float NOT NULL DEFAULT 12,
  `total_use_casual_leave` float NOT NULL DEFAULT 0,
  `total_use_sick_leave` float NOT NULL DEFAULT 0,
  `total_use_paid_leave` float NOT NULL DEFAULT 0,
  `left_casual_leave` float NOT NULL DEFAULT 6,
  `left_sick_leave` float NOT NULL DEFAULT 6,
  `left_paid_leave` float NOT NULL DEFAULT 12,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_leave_count`
--

INSERT INTO `employee_leave_count` (`employee_leave_count_id`, `emp_id`, `total_casual_leave`, `total_sick_leave`, `total_paid_leave`, `total_use_casual_leave`, `total_use_sick_leave`, `total_use_paid_leave`, `left_casual_leave`, `left_sick_leave`, `left_paid_leave`, `created_time`) VALUES
(1, 3, 3, 3, 3, 0, 0, 0, 3, 3, 3, '2024-01-18 04:25:55'),
(2, 4, 3, 3, 3, 0, 0, 0, 3, 3, 3, '2024-01-18 04:25:55'),
(3, 1, 3, 3, 3, 0, 0, 0, 3, 3, 3, '2024-01-18 04:25:55'),
(4, 5, 3, 3, 3, 0, 0, 0, 3, 3, 3, '2024-01-18 04:25:55'),
(5, 6, 3, 3, 3, 0, 0, 0, 3, 3, 3, '2024-01-18 04:25:55'),
(6, 7, 3, 3, 3, 0, 0, 0, 3, 3, 3, '2024-01-18 04:25:55'),
(7, 8, 3, 3, 3, 0, 0, 2, 3, 3, 1, '2024-01-18 04:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave_count2`
--

CREATE TABLE `employee_leave_count2` (
  `employee_leave_count2_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `total_casual_leave` float NOT NULL,
  `total_sick_leave` float NOT NULL,
  `total_paid_leave` float NOT NULL DEFAULT 12,
  `total_use_casual_leave` float NOT NULL,
  `total_use_sick_leave` float NOT NULL,
  `total_use_paid_leave` float NOT NULL,
  `left_casual_leave` float NOT NULL,
  `left_sick_leave` float DEFAULT NULL,
  `left_paid_leave` float NOT NULL DEFAULT 12,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave_request_table`
--

CREATE TABLE `employee_leave_request_table` (
  `emp_le_re_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `manage_id` int(11) NOT NULL,
  `leave_id` int(11) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `duration` varchar(150) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `total_day` float NOT NULL,
  `reason` varchar(255) NOT NULL,
  `statue` tinyint(4) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_leave_request_table`
--

INSERT INTO `employee_leave_request_table` (`emp_le_re_id`, `emp_id`, `manage_id`, `leave_id`, `from_date`, `duration`, `to_date`, `total_day`, `reason`, `statue`, `created_time`) VALUES
(1, 8, 1, 3, '2024-01-05', 'Fullday', '2024-01-06', 0, 'Normal data', 2, '2024-01-16 05:16:46'),
(2, 8, 1, 3, '2024-01-04', 'Fullday', '2024-01-06', 1, 'normal day', 3, '2024-01-16 05:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `holidays_id` int(11) NOT NULL,
  `holidays_date` date NOT NULL,
  `holidays_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`holidays_id`, `holidays_date`, `holidays_name`) VALUES
(1, '2024-01-01', 'New Year '),
(2, '2024-01-26', 'Republic Day'),
(3, '2024-01-07', 'sunday'),
(4, '2024-01-14', 'sunday'),
(5, '2024-01-21', 'sunday'),
(6, '2024-01-28', 'sunday'),
(7, '2024-01-06', 'Saturday'),
(8, '2024-01-27', 'Saturday'),
(9, '2024-02-05', 'Guru Ravidas Jayanti'),
(10, '2024-02-19', ' Chhatrapati Shivaji Maharaj Jayanti'),
(11, '2024-02-04', 'sunday'),
(12, '2024-02-11', 'sunday'),
(13, '2024-01-21', 'sunday'),
(14, '2024-02-25', 'sunday'),
(15, '2024-02-03', 'Saturday'),
(16, '2024-02-24', 'Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `leave_table`
--

CREATE TABLE `leave_table` (
  `leave_id` int(11) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `leave_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_table`
--

INSERT INTO `leave_table` (`leave_id`, `leave_type`, `leave_value`) VALUES
(1, 'Casual Leave', 6),
(2, 'Sick Leave', 6),
(3, 'Paid Leave', 12);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `manage_id` int(11) NOT NULL,
  `manage_name` varchar(255) NOT NULL,
  `manage_email` varchar(255) NOT NULL,
  `manage_password` varchar(255) NOT NULL,
  `manage_mob` varchar(11) NOT NULL,
  `manage_doj` varchar(255) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`manage_id`, `manage_name`, `manage_email`, `manage_password`, `manage_mob`, `manage_doj`, `created_time`) VALUES
(1, 'milan DAS', 'milan@gmail.com', '123', '6352902958', '2024-01-04', '2024-01-16 05:15:43'),
(2, 'Rajesh panda', 'rajesha@gmail.com', '123456', '6352902959', '2024-01-05', '2024-01-03 14:28:28'),
(3, 'Balram Panda', 'balrampanda61@gmail.com', '123456', '7894561230', '2024-01-17', '2024-01-16 05:23:38');

-- --------------------------------------------------------

--
-- Table structure for table `manage_details`
--

CREATE TABLE `manage_details` (
  `managede_id` int(11) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(10) NOT NULL,
  `country` varchar(10) NOT NULL,
  `postal_code` int(6) NOT NULL,
  `about` varchar(225) NOT NULL,
  `manage_id` int(11) NOT NULL,
  `created_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manage_details`
--

INSERT INTO `manage_details` (`managede_id`, `dob`, `gender`, `address`, `city`, `country`, `postal_code`, `about`, `manage_id`, `created_time`) VALUES
(1, '2024-01-02', 'Man', 'Ram Nagar', 'surat', 'india', 394221, 'I am Milan DAS a Passionate web developer with a keen Interest in Full-Stack Development.', 1, 2147483647),
(2, '2024-01-18', 'Man', 'balisira ganjam', 'Ganjam', 'India', 761115, 'hello sir', 3, 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `employeeadd`
--
ALTER TABLE `employeeadd`
  ADD PRIMARY KEY (`empa_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `manage_id` (`manage_id`);

--
-- Indexes for table `employee_details`
--
ALTER TABLE `employee_details`
  ADD PRIMARY KEY (`empd_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `employee_leave_count`
--
ALTER TABLE `employee_leave_count`
  ADD PRIMARY KEY (`employee_leave_count_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `employee_leave_count2`
--
ALTER TABLE `employee_leave_count2`
  ADD PRIMARY KEY (`employee_leave_count2_id`);

--
-- Indexes for table `employee_leave_request_table`
--
ALTER TABLE `employee_leave_request_table`
  ADD PRIMARY KEY (`emp_le_re_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `leave_id` (`leave_id`),
  ADD KEY `manage_id` (`manage_id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`holidays_id`);

--
-- Indexes for table `leave_table`
--
ALTER TABLE `leave_table`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`manage_id`),
  ADD UNIQUE KEY `manage_email` (`manage_email`),
  ADD UNIQUE KEY `manage_mob` (`manage_mob`);

--
-- Indexes for table `manage_details`
--
ALTER TABLE `manage_details`
  ADD PRIMARY KEY (`managede_id`),
  ADD KEY `manage_id` (`manage_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employeeadd`
--
ALTER TABLE `employeeadd`
  MODIFY `empa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee_details`
--
ALTER TABLE `employee_details`
  MODIFY `empd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_leave_count`
--
ALTER TABLE `employee_leave_count`
  MODIFY `employee_leave_count_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee_leave_count2`
--
ALTER TABLE `employee_leave_count2`
  MODIFY `employee_leave_count2_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `employee_leave_request_table`
--
ALTER TABLE `employee_leave_request_table`
  MODIFY `emp_le_re_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `holidays_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `leave_table`
--
ALTER TABLE `leave_table`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `manage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manage_details`
--
ALTER TABLE `manage_details`
  MODIFY `managede_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employeeadd`
--
ALTER TABLE `employeeadd`
  ADD CONSTRAINT `employeeadd_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `employeeadd_ibfk_2` FOREIGN KEY (`manage_id`) REFERENCES `manager` (`manage_id`);

--
-- Constraints for table `employee_details`
--
ALTER TABLE `employee_details`
  ADD CONSTRAINT `employee_details_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `employee_leave_count`
--
ALTER TABLE `employee_leave_count`
  ADD CONSTRAINT `employee_leave_count_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `employee_leave_request_table`
--
ALTER TABLE `employee_leave_request_table`
  ADD CONSTRAINT `employee_leave_request_table_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `employee_leave_request_table_ibfk_2` FOREIGN KEY (`leave_id`) REFERENCES `leave_table` (`leave_id`),
  ADD CONSTRAINT `employee_leave_request_table_ibfk_3` FOREIGN KEY (`manage_id`) REFERENCES `manager` (`manage_id`);

--
-- Constraints for table `manage_details`
--
ALTER TABLE `manage_details`
  ADD CONSTRAINT `manage_details_ibfk_1` FOREIGN KEY (`manage_id`) REFERENCES `manager` (`manage_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
