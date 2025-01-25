-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2025 at 02:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT;
SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS;
SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION;

CREATE DATABASE IF NOT EXISTS `project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `project`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `AccountID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `usertype` varchar(100) DEFAULT NULL,
  `totalbalance` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminUsername` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Fullname` varchar(100) DEFAULT NULL,
  `NID` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`AdminUsername`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `BuyerUsername` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Fullname` varchar(100) DEFAULT NULL,
  `Phone` varchar(100) DEFAULT NULL,
  `DateOfBirth` varchar(100) DEFAULT NULL,
  `AccountID` int(11) DEFAULT NULL,
  PRIMARY KEY (`BuyerUsername`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buyer`
--
-- --------------------------------------------------------

--
-- Table structure for table `deliveryman`
--

CREATE TABLE `deliveryman` (
  `DeliveryUsername` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Fullname` varchar(100) DEFAULT NULL,
  `Phone` varchar(100) DEFAULT NULL,
  `Vehicle` varchar(100) DEFAULT NULL,
  `CV` varchar(100) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  PRIMARY KEY (`DeliveryUsername`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliveryman`
--
-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeUsername` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Fullname` varchar(100) DEFAULT NULL,
  `NID` varchar(100) DEFAULT NULL,
  `Phone` varchar(100) DEFAULT NULL,
  `WorkShift` varchar(100) DEFAULT NULL,
  `CV` varchar(100) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  PRIMARY KEY (`EmployeeUsername`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messagebox`
--

CREATE TABLE `messagebox` (
  `MessageID` int(11) NOT NULL,
  `SenderID` int(11) NOT NULL,
  `UserType` varchar(50) NOT NULL,
  `Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderedproduct`
--

CREATE TABLE `orderedproduct` (
  `order_id` int(11) NOT NULL,  -- Ensure this matches the data type of `OID` in `orders`
  `pid` int(11) NOT NULL,       -- Ensure this matches the data type of `PID` in `product`
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `seller_username` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OID` int(11) NOT NULL AUTO_INCREMENT,
  `BuyerUsername` varchar(100) DEFAULT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL,
  `DeliveryUsername` varchar(100) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`OID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `PID` int(11) NOT NULL AUTO_INCREMENT,
  `SellerUsername` varchar(100) DEFAULT NULL,
  `PName` varchar(100) NOT NULL,
  `Price` varchar(100) DEFAULT NULL,
  `Quantity` varchar(100) DEFAULT NULL,
  `Picture` varchar(100) DEFAULT NULL,
  `Details` text DEFAULT NULL,
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `SellerUsername` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `BusinessName` varchar(100) DEFAULT NULL,
  `ProductType` varchar(100) DEFAULT NULL,
  `Fullname` varchar(100) DEFAULT NULL,
  `Phone` varchar(100) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `District` varchar(100) DEFAULT NULL,
  `NID` varchar(100) DEFAULT NULL,
  `AccountID` int(11) DEFAULT NULL,
  PRIMARY KEY (`SellerUsername`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orderedproduct`
--
ALTER TABLE `orderedproduct`
  ADD PRIMARY KEY (`order_id`,`pid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `orders`
--

--
-- Indexes for table `product`
--
-- ALTER TABLE `product`
--   ADD PRIMARY KEY (`PID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderedproduct`
--
ALTER TABLE `orderedproduct`
  ADD CONSTRAINT `orderedproduct_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`OID`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderedproduct_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`PID`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`BuyerUsername`) REFERENCES `buyer` (`BuyerUsername`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`DeliveryUsername`) REFERENCES `deliveryman` (`DeliveryUsername`) ON DELETE SET NULL;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`SellerUsername`) REFERENCES `seller` (`SellerUsername`) ON DELETE SET NULL;

--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
