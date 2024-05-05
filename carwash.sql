-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 02:25 PM
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
-- Database: `carwash`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(4) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `type` varchar(15) NOT NULL,
  `status` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `email`, `password`, `type`, `status`) VALUES
(39, 'vehicleowner@gmail.com', '123', '2', 'Accept re'),
(40, 'shopowner@gmail.com', '123', '1', 'Accept re'),
(41, 'testshop@gmail.com', '123', '1', 'Accept re'),
(42, '', '', '1', 'Accept re'),
(43, '', '', '1', 'Accept re'),
(44, 'bersotto18@gmail.com', '123', '1', 'Accept re'),
(45, 'shopowner@gmail.com', '123', '1', 'Accept re');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(4) NOT NULL,
  `vehicle_owner_id` int(4) NOT NULL,
  `shop_info_id` int(4) NOT NULL,
  `queue_number` int(3) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `status` varchar(15) NOT NULL,
  `service_id` int(5) NOT NULL,
  `vehicle_type` varchar(10) NOT NULL,
  `vehicle_size` varchar(7) NOT NULL,
  `license_plate` varchar(15) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `vehicle_owner_id`, `shop_info_id`, `queue_number`, `appointment_date`, `status`, `service_id`, `vehicle_type`, `vehicle_size`, `license_plate`, `rating`, `comments`) VALUES
(17, 39, 5, 1, '2024-04-22 08:00:00', 'Completed', 17, '', '', '', 1, 'sdsds'),
(18, 39, 5, 2, '2024-04-22 09:00:00', 'Cancelled', 20, '', '', '', NULL, NULL),
(19, 39, 5, 3, '2024-04-22 08:00:00', 'Cancelled', 17, '', '', '', NULL, NULL),
(20, 39, 5, 4, '2024-04-22 10:00:00', 'Cancelled', 17, '', '', '', NULL, NULL),
(21, 39, 5, 5, '2024-04-22 11:00:00', 'Cancelled', 17, '', '', '', NULL, NULL),
(22, 39, 5, 6, '2024-04-23 12:00:00', 'Completed', 25, '', '', '', NULL, NULL),
(23, 39, 5, 7, '2024-04-23 12:00:00', 'Completed', 33, '', '', '', NULL, NULL),
(24, 39, 5, 8, '2024-04-23 08:00:00', 'Completed', 17, '', '', '', NULL, NULL),
(25, 39, 5, 9, '2024-04-23 11:00:00', 'Completed', 17, '', '', '', NULL, NULL),
(26, 39, 5, 10, '2024-04-23 15:00:00', 'Cancelled', 36, '', '', '', NULL, NULL),
(27, 39, 5, 11, '2024-04-23 18:00:00', 'Cancelled', 20, '', '', '', NULL, NULL),
(28, 39, 6, 1, '2024-04-27 12:00:00', 'Completed', 36, '', '', '', 1, 'sdsds'),
(29, 39, 5, 12, '2024-05-01 17:00:00', 'Cancelled', 25, '', '', '', NULL, NULL),
(30, 39, 6, 2, '2024-04-30 13:00:00', 'Completed', 23, '', '', '', NULL, NULL),
(31, 41, 6, 3, '2024-04-30 13:00:00', 'Not Completed', 23, '', '', '', NULL, NULL),
(32, 39, 6, 4, '2024-05-10 10:00:00', 'Completed', 15, '', '', '', NULL, NULL),
(33, 39, 6, 5, '2024-04-30 11:00:00', 'Completed', 15, '', '', '', NULL, NULL),
(37, 39, 6, 6, '2024-04-30 10:00:00', 'Completed', 15, '', '', '', NULL, NULL),
(38, 39, 6, 7, '2024-04-29 10:00:00', 'Completed', 23, '', '', '', NULL, NULL),
(39, 39, 6, 8, '2024-04-30 14:00:00', 'Completed', 15, '', '', '', NULL, NULL),
(40, 39, 6, 9, '2024-04-29 08:00:00', 'Completed', 40, '', '', '', NULL, NULL),
(41, 39, 6, 10, '2024-04-30 09:00:00', 'Completed', 23, '', '', '', NULL, NULL),
(42, 39, 6, 11, '2024-04-29 14:00:00', 'Completed', 15, '', '', '', NULL, NULL),
(43, 39, 6, 12, '2024-04-30 16:00:00', 'Completed', 23, '', '', '', NULL, NULL),
(44, 39, 6, 13, '2024-04-29 15:00:00', 'Completed', 31, '', '', '', NULL, NULL),
(45, 39, 6, 14, '2024-04-30 08:00:00', 'Completed', 15, '', '', '', NULL, NULL),
(46, 39, 6, 15, '2024-04-30 09:00:00', 'Cancelled', 31, '', '', '', NULL, NULL),
(47, 39, 6, 16, '2024-04-30 10:00:00', 'Completed', 23, '', '', '', NULL, NULL),
(48, 39, 6, 17, '2024-04-30 11:00:00', 'Completed', 15, '', '', '', NULL, NULL),
(49, 39, 6, 18, '2024-04-30 18:00:00', 'Cancelled', 15, '', '', '', NULL, NULL),
(50, 39, 6, 19, '2024-05-22 10:00:00', 'Cancelled', 15, '', '', '', NULL, NULL),
(51, 39, 6, 20, '2024-05-22 09:00:00', 'Cancelled', 31, '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_history`
--

CREATE TABLE `appointment_history` (
  `appointment_id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `queue_number` int(11) DEFAULT NULL,
  `appointment_date` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_history`
--

INSERT INTO `appointment_history` (`appointment_id`, `customer_name`, `shop_name`, `queue_number`, `appointment_date`, `status`) VALUES
(50, NULL, NULL, 19, '2024-05-22 10:00:00', 'Cancelled'),
(51, NULL, NULL, 20, '2024-05-22 09:00:00', 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `shop_info_id` int(11) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `shop_info_id` int(11) NOT NULL,
  `rating` decimal(2,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(4) NOT NULL,
  `shop_info_id` int(3) NOT NULL,
  `serviceName` varchar(25) NOT NULL,
  `service_price` int(5) NOT NULL,
  `vehicle_size` varchar(10) NOT NULL,
  `vehicle_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `shop_info_id`, `serviceName`, `service_price`, `vehicle_size`, `vehicle_type`) VALUES
(14, 3, 'Wax', 70, 'Small', 'Motorcycle'),
(15, 3, 'Wax', 150, 'Medium', 'Motorcycle'),
(16, 3, 'Wax', 150, 'Small', 'Automobile'),
(17, 3, 'Wax', 220, 'Medium', 'Automobile'),
(18, 3, 'Wax', 250, 'Large', 'Automobile'),
(19, 3, 'Body', 110, 'Small', 'Automobile'),
(20, 3, 'Body', 130, 'Medium', 'Automobile'),
(21, 3, 'Body', 140, 'Large', 'Automobile'),
(22, 3, 'Body + Wax', 170, 'Small', 'Motorcycle'),
(23, 3, 'Body + Wax', 220, 'Medium', 'Motorcycle'),
(24, 3, 'Body + Wax', 240, 'Small', 'Automobile'),
(25, 3, 'Body + Wax', 300, 'Medium', 'Automobile'),
(26, 3, 'Body + Wax', 400, 'Large', 'Automobile'),
(27, 3, 'Vacuum', 60, 'Small', 'Automobile'),
(28, 3, 'Vacuum', 90, 'Medium', 'Automobile'),
(29, 3, 'Vacuum', 110, 'Large', 'Automobile'),
(30, 5, 'Wax', 70, 'Small', 'Motorcycle'),
(31, 5, 'Wax', 110, 'Medium', 'Motorcycle'),
(32, 5, 'Wax', 110, 'Small', 'Automobile'),
(33, 5, 'Wax', 220, 'Medium', 'Automobile'),
(34, 5, 'Wax', 310, 'Large', 'Automobile'),
(35, 5, 'Body', 110, 'Small', 'Automobile'),
(36, 5, 'Body', 170, 'Medium', 'Automobile'),
(37, 5, 'Body', 220, 'Large', 'Automobile'),
(38, 5, 'Wax + Body', 250, 'Small', 'Automobile'),
(39, 5, 'Wax + Body', 170, 'Small', 'Motorcycle'),
(40, 5, 'Wax + Body', 220, 'Medium', 'Motorcycle'),
(41, 5, 'Wax + Body', 300, 'Medium', 'Automobile'),
(42, 5, 'Wax + Body', 390, 'Large', 'Automobile'),
(43, 5, 'Vacuum', 60, 'Small', 'Automobile'),
(44, 5, 'Vacuum', 90, 'Medium', 'Automobile'),
(45, 5, 'Vacuum', 150, 'Large', 'Automobile'),
(46, 5, 'Vacuum', 150, 'Large', 'Automobile'),
(47, 5, 'Body + Vacuum', 170, 'Small', 'Automobile'),
(48, 5, 'Body + Vacuum', 220, 'Medium', 'Automobile'),
(49, 5, 'Body + Vacuum', 280, 'Large', 'Automobile'),
(50, 5, 'Body + Vacuum + Wax', 270, 'Small', 'Automobile'),
(51, 5, 'Body + Vacuum + Wax', 500, 'Medium', 'Automobile'),
(52, 5, 'Body + Vacuum + Wax', 600, 'Large', 'Automobile'),
(53, 5, 'Body + Vacuum + Wax and B', 500, 'Small', 'Automobile'),
(54, 5, 'Body + Vacuum + Wax and B', 800, 'Medium', 'Automobile'),
(55, 5, 'Body + Vacuum + Wax and B', 950, 'Large', 'Automobile'),
(56, 5, 'Sample', 12, 'Small', 'Automobile'),
(58, 6, 'wax', 70, 'Small', 'Motorcycle'),
(59, 6, 'Body', 110, 'Small', 'Motorcycle'),
(60, 6, 'Wax', 220, 'Small', 'Automobile'),
(61, 6, 'Body', 110, 'Small', 'Automobile'),
(62, 5, 'test', 12, 'Small', 'Automobile');

-- --------------------------------------------------------

--
-- Table structure for table `shop_info`
--

CREATE TABLE `shop_info` (
  `shop_info_id` int(4) NOT NULL,
  `shop_owner_id` int(4) NOT NULL,
  `shop_name` varchar(25) NOT NULL,
  `location` varchar(50) NOT NULL,
  `operating_from` time NOT NULL,
  `operating_to` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop_info`
--

INSERT INTO `shop_info` (`shop_info_id`, `shop_owner_id`, `shop_name`, `location`, `operating_from`, `operating_to`) VALUES
(5, 40, 'Washit', 'Sunriser Villa Pusok Lapu-Lapu City', '08:00:00', '17:00:00'),
(6, 41, 'Max', 'Lapu-Lapu', '08:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shop_owners`
--

CREATE TABLE `shop_owners` (
  `shop_owner_id` int(4) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop_owners`
--

INSERT INTO `shop_owners` (`shop_owner_id`, `first_name`, `last_name`, `phone`) VALUES
(40, 'Rentschler ', 'Capacite', 2147483647),
(41, 'test', 'shop', 123456789),
(42, '', '', 0),
(43, '', '', 0),
(44, 'Iverson', 'Sotto', 2147483647),
(45, 'Iverson', 'Sotto', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_owners`
--

CREATE TABLE `vehicle_owners` (
  `vehicle_owner_id` int(4) NOT NULL,
  `vehicle_info_id` int(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `brand` varchar(10) NOT NULL,
  `model` varchar(50) NOT NULL,
  `vehicle_year` year(4) NOT NULL,
  `license_plate` varchar(15) NOT NULL,
  `vehicle_size` varchar(10) NOT NULL,
  `color` varchar(10) NOT NULL,
  `vehicle_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_owners`
--

INSERT INTO `vehicle_owners` (`vehicle_owner_id`, `vehicle_info_id`, `first_name`, `last_name`, `phone`, `brand`, `model`, `vehicle_year`, `license_plate`, `vehicle_size`, `color`, `vehicle_type`) VALUES
(39, 0, 'Rentschler', 'Capacite', '09265305143', 'Suzuki', 'Jimny', '2024', 'GTA1231', 'Medium', 'White', 'Automobile');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `shop_info_id` (`shop_info_id`);

--
-- Indexes for table `appointment_history`
--
ALTER TABLE `appointment_history`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `shop_info_id` (`shop_info_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `shop_info_id` (`shop_info_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `shop_info_id` (`shop_info_id`);

--
-- Indexes for table `shop_info`
--
ALTER TABLE `shop_info`
  ADD PRIMARY KEY (`shop_info_id`),
  ADD KEY `shop_info Foreign key` (`shop_owner_id`);

--
-- Indexes for table `shop_owners`
--
ALTER TABLE `shop_owners`
  ADD PRIMARY KEY (`shop_owner_id`);

--
-- Indexes for table `vehicle_owners`
--
ALTER TABLE `vehicle_owners`
  ADD PRIMARY KEY (`vehicle_owner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `appointment_history`
--
ALTER TABLE `appointment_history`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `shop_info`
--
ALTER TABLE `shop_info`
  MODIFY `shop_info_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shop_owners`
--
ALTER TABLE `shop_owners`
  MODIFY `shop_owner_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `vehicle_owners`
--
ALTER TABLE `vehicle_owners`
  MODIFY `vehicle_owner_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`shop_info_id`) REFERENCES `shop_info` (`shop_info_id`);

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`shop_info_id`) REFERENCES `shop_info` (`shop_info_id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`shop_info_id`) REFERENCES `shop_info` (`shop_info_id`);

--
-- Constraints for table `shop_info`
--
ALTER TABLE `shop_info`
  ADD CONSTRAINT `shop_info Foreign key` FOREIGN KEY (`shop_owner_id`) REFERENCES `shop_owners` (`shop_owner_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
