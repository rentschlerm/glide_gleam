-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 02:44 PM
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
-- Database: `carwash2`
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
(75, 'test2@gmail.com', '$2y$10$Qs/hTd776hw1cth/o4uA/.qyOzIZ.TGsF8/443b8B3ZbW8lrxnvtS', '1', 'Accept re'),
(80, 'shopowner3@gmail.com', '$2y$10$b22zQj3jqBC/mcXi1DqrG.6zlSbmFOIHqKcvAS1BdHFZDelTtmGau', '1', 'Accept re'),
(81, 'vehicleowner2@gmail.com', '$2y$10$BEVSKn8iTfpRi1NfkJ.Mp.KsfcjG5sMsNOAglDnu6RyrIrPh4wqeC', '1', 'Accept re'),
(83, 'vehicleowner3@gmail.com', '$2y$10$4UGQDSId7wDw5MYTSlXZWe1Ek2aOedY.u2.EgnVchxJwHcfoofggS', '2', 'Accept re'),
(85, '', '$2y$10$oAogdgLloJ47/A5AMrks3u/avlaazbCb51NxRvlFO7Wlb9INx8Jny', '1', 'Accept re'),
(90, 'Olano@gmail.com', '$2y$10$cyR2Ic6LMH1EADBM.zP6N./khHJCbv042d9E2vHa/tMGtYK2zPvEi', '1', 'Accept re'),
(92, 'MarkOlano@gmail.com', '$2y$10$Ur5P1O6StloXCoe5fHy/yu0aD6oeVBMApjw0Ht9JqI.obkVi5JnX2', '1', 'Accept re'),
(93, 'MarkO@gmail.com', '$2y$10$JKS8FMoMyGsdE.Q.ZQsXaufoHHH/W1ddbBdznmcUmq0cCuzio8s.6', '2', 'Accept re'),
(95, 'SoronoM@gmail.com', '$2y$10$CUfNSGZTtgkmNrFWN27q1OsTauZyjeWd08DCi7WWDJKngHfBDwI02', '2', 'Accept re'),
(96, 'MarkSoro@gmail.com', '$2y$10$8j3.ouu1qQP1tv5.GnNYCeesDJAUy67KGClsHGKm1kJx4PXvxKVoa', '1', 'Accept re'),
(97, 'MarkSoro1@gmail.com', '$2y$10$5x4cjClYM1QayNF.UlAKM.kSZZwhaXCm.Z4PcoTnSGYyPG9Ym4kaC', '1', 'Accept re'),
(98, 'MarkSO@gmail.com', '$2y$10$B55jnebAp6CTFs7620iC7uO9AGglVyLGMtKraTjf2HNc.3k9VGrCO', '2', 'Accept re'),
(99, 'shop123@gmail.com', '$2y$10$Cq.EgDTChAw3z1YjmYQq3uVefFzic89YhZ0aoSDnMW5AkmMJgQ4dy', '2', 'Accept re'),
(100, 'qwerg@gmail.com', '$2y$10$IzNl5w.YkRcqyHByWtOWGu3SKDjij24hlPg1JAay6h.L8V91PoIbu', '1', 'Accept re');

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
(28, 83, 7, 1, '2024-05-10 08:00:00', 'Completed', 18, '', '', ''),
(29, 83, 10, 1, '2024-05-11 08:00:00', 'Cancelled', 18, '', '', ''),
(30, 83, 10, 2, '2024-05-11 09:00:00', 'Cancelled', 34, '', '', ''),
(31, 83, 7, 2, '2024-05-11 12:00:00', 'Completed', 42, '', '', ''),
(32, 83, 7, 3, '2024-05-11 10:00:00', 'Completed', 42, '', '', ''),
(33, 83, 7, 4, '2024-05-11 11:00:00', 'Completed', 55, '', '', ''),
(34, 83, 7, 5, '2024-05-11 18:00:00', 'Completed', 52, '', '', ''),
(35, 83, 7, 6, '2024-05-11 17:00:00', 'Completed', 49, '', '', ''),
(36, 83, 7, 7, '2024-05-11 16:00:00', 'Cancelled', 18, '', '', ''),
(37, 83, 7, 8, '2024-05-11 13:00:00', 'Completed', 69, '', '', ''),
(38, 83, 7, 9, '2024-05-12 08:00:00', 'Completed', 69, '', '', ''),
(39, 83, 7, 10, '2024-05-11 08:00:00', 'Completed', 69, '', '', ''),
(40, 83, 7, 11, '2024-05-11 09:00:00', 'Cancelled', 70, '', '', ''),
(41, 83, 7, 12, '2024-05-11 10:00:00', 'Cancelled', 69, '', '', ''),
(42, 83, 7, 13, '2024-05-12 08:00:00', 'Cancelled', 69, '', '', ''),
(43, 83, 7, 14, '2024-05-11 09:00:00', 'Cancelled', 69, '', '', ''),
(44, 83, 7, 15, '2024-05-14 08:00:00', 'Completed', 69, '', '', ''),
(45, 83, 7, 16, '2024-05-14 09:00:00', 'Completed', 72, '', '', ''),
(46, 83, 7, 17, '2024-05-14 10:00:00', 'Completed', 70, '', '', ''),
(47, 83, 7, 18, '2024-05-14 10:00:00', 'Completed', 69, '', '', ''),
(48, 83, 7, 19, '2024-05-14 11:00:00', 'Completed', 69, '', '', ''),
(49, 83, 7, 20, '2024-05-14 08:00:00', 'Completed', 69, '', '', ''),
(50, 83, 7, 21, '2024-05-14 08:00:00', 'Completed', 69, '', '', ''),
(51, 83, 7, 22, '2024-05-14 15:00:00', 'Not Completed', 70, '', '', ''),
(52, 83, 7, 23, '2024-05-15 08:00:00', 'Cancelled', 69, '', '', ''),
(53, 93, 7, 24, '2024-05-23 08:00:00', 'Cancelled', 69, '', '', ''),
(54, 93, 7, 25, '2024-05-23 08:00:00', 'Cancelled', 69, '', '', ''),
(55, 93, 7, 26, '2024-05-23 08:00:00', 'Cancelled', 69, '', '', ''),
(56, 93, 7, 27, '2024-05-23 08:00:00', 'Cancelled', 69, '', '', ''),
(57, 93, 7, 28, '2024-05-23 08:00:00', 'Cancelled', 69, '', '', ''),
(58, 93, 7, 29, '2024-05-23 08:00:00', 'Cancelled', 69, '', '', ''),
(59, 93, 7, 30, '2024-05-23 08:00:00', 'Cancelled', 69, '', '', ''),
(60, 93, 7, 31, '2024-05-23 08:00:00', 'Cancelled', 69, '', '', ''),
(61, 93, 7, 32, '2024-05-23 08:00:00', 'Cancelled', 69, '', '', ''),
(62, 93, 7, 33, '2024-05-23 08:00:00', 'Cancelled', 69, '', '', ''),
(63, 93, 7, 34, '2024-05-23 08:00:00', 'Cancelled', 69, '', '', ''),
(64, 93, 7, 35, '2024-05-23 08:00:00', 'Cancelled', 69, '', '', ''),
(65, 93, 7, 36, '2024-05-23 08:00:00', 'Cancelled', 69, '', '', ''),
(66, 93, 7, 37, '2024-05-23 08:00:00', 'Cancelled', 69, '', '', ''),
(67, 93, 7, 38, '2024-05-23 08:00:00', 'Cancelled', 69, '', '', ''),
(68, 95, 7, 39, '2024-05-24 08:00:00', 'Not Completed', 69, '', '', ''),
(69, 93, 7, 40, '2024-05-25 08:00:00', 'Not Completed', 69, '', '', ''),
(70, 93, 7, 41, '2024-05-25 09:00:00', 'Cancelled', 69, '', '', ''),
(71, 93, 7, 42, '2024-05-25 09:00:00', 'Cancelled', 69, '', '', ''),
(72, 93, 7, 43, '2024-05-25 09:00:00', 'Cancelled', 69, '', '', ''),
(73, 93, 7, 44, '2024-05-25 09:00:00', 'Cancelled', 69, '', '', ''),
(74, 93, 7, 45, '2024-05-25 09:00:00', 'Cancelled', 69, '', '', ''),
(75, 93, 7, 46, '2024-05-28 08:00:00', 'Cancelled', 69, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_rating` int(11) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `user_name`, `user_rating`, `user_review`, `datetime`, `appointment_id`) VALUES
(1, 'Mercado', 2, 'a', 2147483647, 42),
(2, 'mercado', 5, 'good kaayo', 2147483647, 52);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `shop_info_id` int(11) NOT NULL,
  `dateSold` date NOT NULL,
  `sales` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `appointment_id`, `shop_info_id`, `dateSold`, `sales`) VALUES
(1, 32, 7, '2024-05-10', 390),
(2, 33, 7, '2024-05-11', 950),
(3, 34, 7, '2024-05-11', 600),
(4, 35, 7, '2024-05-10', 280),
(5, 37, 7, '2024-05-11', 110),
(6, 38, 7, '2024-05-11', 110),
(7, 39, 7, '2024-05-11', 110),
(8, 44, 7, '2024-05-13', 110),
(9, 45, 7, '2024-05-14', 70),
(10, 46, 7, '2024-05-14', 150),
(11, 47, 7, '2024-05-14', 110),
(12, 48, 7, '2024-05-14', 110),
(13, 49, 7, '2024-05-14', 110),
(14, 50, 7, '2024-05-14', 110);

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
(63, 0, 'Wax', 110, 'Small', 'Automobile'),
(64, 0, 'Wax', 110, 'Small', 'Automobile'),
(65, 0, 'Wax', 110, 'Small', 'Automobile'),
(66, 0, 'Wax', 110, 'Small', 'Automobile'),
(69, 7, 'Waxs', 120, 'Small', 'Automobile'),
(71, 10, 'Wax', 150, 'Small', 'Automobile'),
(78, 7, 'Body', 99, 'Small', 'Motorcycle');

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
  `operating_to` time NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop_info`
--

INSERT INTO `shop_info` (`shop_info_id`, `shop_owner_id`, `shop_name`, `location`, `operating_from`, `operating_to`, `longitude`, `latitude`) VALUES
(5, 40, 'Washit', 'Sunriser Villa Pusok Lapu-Lapu City', '08:00:00', '17:00:00', 0, 0),
(6, 41, 'Max', 'Lapu-Lapu', '08:00:00', '17:00:00', 0, 0),
(7, 80, 'CoolIT', 'Basak', '08:00:00', '17:00:00', 0, 0),
(10, 83, 'TooCool', 'Basak', '08:00:00', '17:00:00', 0, 0),
(15, 80, 'Test', 'Basak', '08:00:00', '17:00:00', 0, 0),
(16, 81, 'WashHere', '', '00:00:00', '00:00:00', 124.12361157664657, 9.799346974943745),
(42, 80, 'Test2', 'Cordova', '08:00:00', '17:00:00', 123.94839187880538, 10.319281248818433),
(43, 80, 'Test2', 'Cordova', '08:00:00', '17:00:00', 0, 0),
(44, 80, 'Test2', 'Cordova', '08:00:00', '17:00:00', 0, 0),
(45, 80, 'Test6', 'Basak', '08:00:00', '17:00:00', 122.39802372248471, 13.658146249917822),
(46, 92, 'CoolAid', 'Cordova', '08:00:00', '17:00:00', 123.96518189014527, 10.295643732068685),
(47, 92, 'CoolAid1', 'Cordova', '08:00:00', '17:00:00', 121.774, 12.879699999999998),
(48, 92, 'CoolAid1', 'Cordova', '08:00:00', '17:00:00', 121.774, 12.879699999999998),
(49, 92, 'CoolAid12', 'Cordova', '08:00:00', '17:00:00', 121.774, 12.879699999999998),
(50, 92, 'CoolAid1', 'Cordova', '08:00:00', '17:00:00', 121.774, 12.879699999999998);

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
(75, 'Carl', 'Fuentes', 1234567890),
(80, 'Kyle', 'Ebanez', 2147483647),
(81, 'Clayton', 'Mercado', 2147483647),
(83, 'asds', 'dsa', 2147483647),
(85, '', '', 0),
(90, 'Mark', 'Olano', 2147483647),
(91, 'Mark', 'Olano', 2147483647),
(92, 'Mark', 'Olano', 2147483647),
(96, 'Mark', 'Soro', 2147483647),
(97, 'Mark', 'Soro1', 2147483647),
(100, '2345', '12345', 2345678);

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
(75, 0, 'Clayton', 'Mercado', '09265305143', 'Nissan', 'Navara', '2024', 'GTX1235', 'Large', 'Black', 'Automobile'),
(83, 0, 'Clayton', 'Mercado', '09265305143', 'Nissan', 'Navara', '2024', 'GTX1235', 'Large', 'Black', 'Automobile'),
(85, 0, '', '', '', '', '', '0000', '', '', '', ''),
(86, 0, '', '', '', '', '', '0000', '', '', '', ''),
(87, 0, '', '', '', '', '', '0000', '', '', '', ''),
(88, 0, '', '', '', '', '', '0000', '', '', '', ''),
(93, 0, 'Mark', 'Olano', '09265305143', 'Nissan', 'Navara', '2024', 'GTA4213', 'Large', 'Black', 'Automobile'),
(95, 0, 'Mark', 'Sorono', '09265305143', 'Nissan', 'Navara', '2024', 'GTX1322', 'Large', 'Red', 'Automobile'),
(98, 0, 'Mark', 'Sorano', '09265305143', 'Nissan', 'Navara', '2024', 'GDA1234', 'Large', 'Black', 'Automobile'),
(99, 0, 'tester1', 'tester2', '12345678', '', '', '0000', '', '', '', ''),
(100, 0, 'Mark', 'Olano', '09265305143', 'Nissan', 'Navara', '2024', 'GTA4213', 'Large', 'Black', 'Automobile');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

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
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `appointment_id` (`appointment_id`),
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
  ADD PRIMARY KEY (`shop_info_id`);

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
  MODIFY `account_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `shop_info`
--
ALTER TABLE `shop_info`
  MODIFY `shop_info_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `shop_owners`
--
ALTER TABLE `shop_owners`
  MODIFY `shop_owner_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `vehicle_owners`
--
ALTER TABLE `vehicle_owners`
  MODIFY `vehicle_owner_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`shop_info_id`) REFERENCES `shop_info` (`shop_info_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`appointment_id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`shop_info_id`) REFERENCES `shop_info` (`shop_info_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
