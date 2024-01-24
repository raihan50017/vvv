-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2024 at 05:49 AM
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
-- Database: `charity_organization`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `amount` int(20) NOT NULL,
  `datetime` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `email` varchar(225) NOT NULL,
  `event_id` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `phone`, `amount`, `datetime`, `email`, `event_id`) VALUES
(1, '', 2000, '2023-09-05 18:19:45.202346', '', 0),
(2, '', 2000, '2023-09-05 18:24:15.383446', '', 0),
(3, '', 200, '2023-09-05 18:25:01.714754', '', 0),
(4, '01726426154', 100, '2023-09-08 16:36:47.206842', 'b@gmail.com', 2),
(5, '01726426154', 200, '2023-09-08 17:19:10.269561', 'admin@gmail.com', 2),
(6, '01726426154', 123, '2023-09-08 17:20:50.502022', 'b@gmail.com', 2),
(7, '01726426154', 500, '2023-09-08 17:29:22.903627', 'b@gmail.com', 2),
(8, '01726426154', 1000, '2023-09-09 03:02:26.562508', 'a@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) NOT NULL,
  `event_name` varchar(225) NOT NULL,
  `event_location` varchar(225) NOT NULL,
  `event_starting_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `event_ending_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `event_description` varchar(225) NOT NULL,
  `event_image` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_location`, `event_starting_time`, `event_ending_time`, `event_description`, `event_image`) VALUES
(2, 'New title', 'Dhaka', '2023-06-22 06:36:00.000000', '2023-06-21 06:36:00.000000', 'Found raising event for orphans', '2.png');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `amount` int(225) NOT NULL,
  `datetime` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `email` varchar(225) NOT NULL,
  `title` varchar(225) NOT NULL,
  `description` varchar(225) NOT NULL,
  `nid` varchar(225) NOT NULL,
  `bkash` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `phone`, `amount`, `datetime`, `email`, `title`, `description`, `nid`, `bkash`, `status`) VALUES
(8, '01726426154', 10000, '2023-09-09 05:32:48.694333', 'b@gmail.com', 'Need a loan for small business', 'I need a loan for my small business, I am very needy for this loan.', '8.pdf', '01726426154', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `loan_pay`
--

CREATE TABLE `loan_pay` (
  `id` int(11) NOT NULL,
  `amount` int(10) NOT NULL,
  `loan_id` int(10) NOT NULL,
  `email` varchar(225) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_pay`
--

INSERT INTO `loan_pay` (`id`, `amount`, `loan_id`, `email`, `datetime`) VALUES
(5, 10000, 8, 'b@gmail.com', '2024-01-23 16:19:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(225) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(225) NOT NULL,
  `address` varchar(225) DEFAULT NULL,
  `photo` varchar(225) DEFAULT NULL,
  `fathers_name` varchar(225) DEFAULT NULL,
  `mothers_name` varchar(225) DEFAULT NULL,
  `nid` int(225) DEFAULT NULL,
  `job_details` varchar(225) DEFAULT NULL,
  `monthly_income` int(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `address`, `photo`, `fathers_name`, `mothers_name`, `nid`, `job_details`, `monthly_income`) VALUES
(39, 'Md Abu Raihan', 'aburaihan50017@gmail.com', '01726426154', '202cb962ac59075b964b', NULL, NULL, NULL, NULL, NULL, '', 0),
(40, 'A', 'a@gmail.com', '01726426154', '202cb962ac59075b964b', NULL, NULL, NULL, NULL, NULL, '', 0),
(41, 'ww', 'b@gmail.com', '01726426154', '202cb962ac59075b964b07152d234b70', 'Trishal, Mymensingh, Dhaka', NULL, NULL, NULL, 2147483647, 'Teacher', 200000),
(45, 'Rokib Hassan', 'c@gmail.com', '8801782736448', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `id` int(10) NOT NULL,
  `volunteer_id` int(10) NOT NULL,
  `event_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_pay`
--
ALTER TABLE `loan_pay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loan_pay`
--
ALTER TABLE `loan_pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
