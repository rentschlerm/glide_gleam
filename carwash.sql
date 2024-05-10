-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 01:07 PM
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
  `password` varchar(100) NOT NULL,
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
(42, 'test@email.com', '123', '2', 'Accept re'),
(66, 'test11111@email.com', '123123', '2', 'Accept re'),
(67, 'guiang.vwasdf@gmail.com', '123123123', '1', 'Accept re'),
(70, 'guiang.vw123123@gmail.com', '$2y$10$zaOvD8SuNMGB6AHzd3', '1', 'Accept re'),
(71, 'bersotto18@gmail.com', '$2y$10$YTNc.XuNZ3RVb1fSXpCPVukGl7wwGs/u21ln8PFzLXwEdWuW4/PI6', '1', 'Accept re'),
(73, 'bersotto28@gmail.com', '$2y$10$kLs3zVbXXZniFcy52A8niuV0BO5zhD9JQF.HovWo8OxtZZVV3MbIi', '2', 'Accept re'),
(74, 'bersotto20@gmail.com', '$2y$10$KUGLpfpZ96h1Oy9XTlj1Cu1zOttCitJB9.UWJu9QNR2kTKDgxr1tG', '2', 'Accept re'),
(76, '', '$2y$10$r8rxlqXxs0HlS5M1Yfa61.oFRdfSIMhP4gbnINIO1eBOCeldyLQFq', '1', 'Accept re'),
(77, 'bersotto188@gmail.com', '$2y$10$2O2tbDsOgFVkt/VdfTK53.HHpZw1RWFBgJS3ZCyXVRvC5xA8AdZrK', '1', 'Accept re'),
(82, 'bersotto118@gmail.com', '$2y$10$iZxVXmJ1XMsZ4fEOXZjYJeACx7jcx9ZUgb4fVgokHiOzpH9GrjXfW', '1', 'Accept re');

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
  `license_plate` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `vehicle_owner_id`, `shop_info_id`, `queue_number`, `appointment_date`, `status`, `service_id`, `vehicle_type`, `vehicle_size`, `license_plate`) VALUES
(17, 39, 5, 1, '2024-04-22 08:00:00', 'Completed', 17, '', '', ''),
(18, 39, 5, 2, '2024-04-22 09:00:00', 'Not Completed', 20, '', '', ''),
(19, 39, 5, 3, '2024-04-22 08:00:00', 'Cancelled', 17, '', '', ''),
(20, 39, 5, 4, '2024-04-22 10:00:00', 'Cancelled', 17, '', '', ''),
(21, 39, 5, 5, '2024-04-22 11:00:00', 'Cancelled', 17, '', '', ''),
(22, 39, 5, 6, '2024-04-23 12:00:00', 'Completed', 25, '', '', ''),
(23, 39, 5, 7, '2024-04-23 12:00:00', 'Completed', 33, '', '', ''),
(24, 39, 5, 8, '2024-04-23 08:00:00', 'Completed', 17, '', '', ''),
(25, 39, 5, 9, '2024-04-23 11:00:00', 'Completed', 17, '', '', ''),
(26, 39, 5, 10, '2024-04-23 15:00:00', 'Not Completed', 36, '', '', ''),
(27, 39, 5, 11, '2024-04-23 18:00:00', 'Not Completed', 20, '', '', ''),
(28, 74, 6, 1, '2024-05-07 17:00:00', 'Cancelled', 40, '', '', ''),
(29, 74, 6, 2, '2024-05-09 13:00:00', 'Not Completed', 15, '', '', ''),
(30, 74, 12, 1, '2024-06-06 09:00:00', 'Cancelled', 23, '', '', ''),
(31, 74, 12, 2, '2024-05-10 08:00:00', 'Cancelled', 15, '', '', ''),
(32, 74, 12, 3, '2024-05-10 10:00:00', 'Completed', 40, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `user_name`, `user_rating`, `user_review`, `datetime`, `appointment_id`) VALUES
(1, 'dsdsddsd', 3, 'ewew', 1715280775, NULL),
(2, 'dsdsd', 2, 'dsdsd', 1715280884, NULL),
(3, 'dsdsd', 2, 'dsdsd', 1715280956, NULL),
(4, 'dsdsd', 2, 'dsdsd', 1715280962, NULL),
(5, 'dsdsddsddd', 5, 'dsds', 1715281095, NULL),
(6, 'sotto', 3, 'dididi', 1715319843, NULL),
(7, 'iverson', 2, 'eer', 1715320940, NULL),
(8, 'stst', 2, '1233', 1715321180, NULL),
(9, 'fdfdfd', 2, 'tttt', 2147483647, 31),
(10, 'honey', 2, 'tttt', 2147483647, 31),
(11, 'kill', 2, 'ff', 2147483647, 30),
(12, 'fdfdf', 2, 'ffffffffffffffffffffffffffff', 2147483647, 30),
(13, 'fdfdf', 2, 'ffffffffffffffffffffffffffff', 2147483647, 30),
(14, 'kol', 5, 'kol\n', 2147483647, 30);

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
(62, 5, 'test', 12, 'Small', 'Automobile'),
(66, 8, 'boxxx', 120, 'Small', 'Automobile'),
(67, 9, 'fafsafa', 10, 'Small', 'Automobile'),
(68, 9, 'sadasd', 155, 'Small', 'Automobile');

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
(6, 41, 'Max', 'Lapu-Lapu', '08:00:00', '17:00:00'),
(12, 71, 'uyy', 'mandaue', '05:25:00', '05:25:00');

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
(67, '123123', '123123', 2147483647),
(68, '123123', '123123', 2147483647),
(70, 'Von Wilhelm', 'Guiang', 2147483647),
(71, 'Iverson', 'Sotto', 2147483647),
(72, 'Iverson', 'Sotto', 2147483647),
(73, 'Iverson', 'Sotto', 2147483647),
(76, '', '', 0),
(77, 'Iverson', 'Sotto', 2147483647),
(78, '', '', 0),
(79, 'Iverson', 'Sotto', 2147483647),
(82, 'Iverson', 'Sotto', 2147483647);

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
(39, 0, 'Rentschler', 'Capacite', '09265305143', 'Suzuki', 'Jimny', '2024', 'GTA1231', 'Medium', 'White', 'Automobile'),
(42, 0, '123123', 'jkhkjh', '12312312', 'Nissan', '123123', '0000', '1231231', 'Small', 'Black', 'Automobile'),
(43, 0, '123123', '123123', '123123', 'Toyota', '123123', '0000', '1231231', 'Large', 'White', 'Automobile'),
(44, 0, '123123', '123123', '123123', 'Toyota', '123123', '0000', '1231231', 'Large', 'White', 'Automobile'),
(45, 0, '123123', '123123', '123123', 'Toyota', '123123', '0000', '1231231', 'Medium', 'Black', 'Motorcycle'),
(46, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Medium', 'White', 'Motorcycle'),
(47, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Medium', 'White', 'Motorcycle'),
(48, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Medium', 'White', 'Motorcycle'),
(49, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Medium', 'White', 'Motorcycle'),
(50, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Small', 'Black', 'Automobile'),
(51, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Small', 'Black', 'Automobile'),
(52, 0, '123123', '123123', '123123', 'Nissan', '123123', '0000', '1231231', 'Medium', 'Black', 'Automobile'),
(53, 0, '123123', '123123', '123123', 'Nissan', '123123', '0000', '1231231', 'Medium', 'Black', 'Automobile'),
(54, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Large', 'Silver', 'Automobile'),
(55, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Large', 'Silver', 'Automobile'),
(56, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Large', 'Silver', 'Automobile'),
(57, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Large', 'Silver', 'Automobile'),
(58, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Large', 'Silver', 'Automobile'),
(59, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Large', 'Silver', 'Automobile'),
(60, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Large', 'Silver', 'Automobile'),
(61, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Large', 'Silver', 'Automobile'),
(62, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Large', 'Silver', 'Automobile'),
(63, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Large', 'Silver', 'Automobile'),
(64, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Small', 'Black', 'Automobile'),
(66, 0, '123123', '123123', '123123', 'Kia', '123123', '0000', '1231231', 'Large', 'White', 'Motorcycle'),
(67, 0, '123123', '123123', '123123', 'Toyota', '123123', '0000', '1231231', 'Medium', 'Silver', 'Automobile'),
(73, 0, 'Iverson', 'Sotto', '09458054983', 'Suzuki', 'dsdsdsd', '0000', '12', 'Medium', 'Yellow', 'Motorcycle'),
(74, 0, 'Iverson', 'Sotto', '09458054983', 'Honda', 'dsdsdsd', '0000', '23123', 'Medium', 'Red', 'Motorcycle'),
(75, 0, '', '', '', '', '', '0000', '', '', '', ''),
(76, 0, '', '', '', '', '', '0000', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `shop_info_id` (`shop_info_id`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_appointment_id` (`appointment_id`);

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
  MODIFY `account_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `shop_info`
--
ALTER TABLE `shop_info`
  MODIFY `shop_info_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `shop_owners`
--
ALTER TABLE `shop_owners`
  MODIFY `shop_owner_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `vehicle_owners`
--
ALTER TABLE `vehicle_owners`
  MODIFY `vehicle_owner_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`shop_info_id`) REFERENCES `shop_info` (`shop_info_id`);

--
-- Constraints for table `review_table`
--
ALTER TABLE `review_table`
  ADD CONSTRAINT `fk_appointment_id` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`appointment_id`);

--
-- Constraints for table `shop_info`
--
ALTER TABLE `shop_info`
  ADD CONSTRAINT `shop_info Foreign key` FOREIGN KEY (`shop_owner_id`) REFERENCES `shop_owners` (`shop_owner_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
