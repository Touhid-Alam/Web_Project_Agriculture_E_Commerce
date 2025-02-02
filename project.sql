-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2025 at 11:57 AM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `AccountID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `usertype` varchar(100) DEFAULT NULL,
  `totalbalance` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`AccountID`, `username`, `usertype`, `totalbalance`) VALUES
(1, 'seller12345', 'Seller', 0.00),
(2, 'jalal123', 'Seller', 0.00),
(3, 'buyer123', 'buyer', 7540.00),
(4, 'touhidalam', 'Seller', 210000.00),
(5, 'tanvirahmed', 'Seller', 0.00),
(7, 'touhidalamalam', 'Seller', 0.00),
(8, 'kamalmia', 'Seller', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminUsername` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Fullname` varchar(100) DEFAULT NULL,
  `NID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminUsername`, `Email`, `Password`, `Fullname`, `NID`) VALUES
('admin123', 'kamal@gmail.com', 'Admin@123', 'Admin Alam', '../../images/admin123.jpg');

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
  `AccountID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`BuyerUsername`, `Email`, `Password`, `Fullname`, `Phone`, `DateOfBirth`, `AccountID`) VALUES
('buyer123', 'jalal@gmail.com', 'Buyer@123', 'Buyer Ahmed', '01995194964', '2025-01-14', NULL);

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
  `Age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliveryman`
--

INSERT INTO `deliveryman` (`DeliveryUsername`, `Email`, `Password`, `Fullname`, `Phone`, `Vehicle`, `CV`, `Age`) VALUES
('delivery123', '22-46330-1@student.aiub.edu', 'Delivery@123', 'Touhid Alam', '01995194964', 'yes', 'images/delivery123.pdf', 22);

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
  `Age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeUsername`, `Password`, `Email`, `Fullname`, `NID`, `Phone`, `WorkShift`, `CV`, `Age`) VALUES
('employee123', 'Employee@123', '22-46330-1@student.aiub.edu', 'Touhid Alam', NULL, '01995194964', '5-10', '../../images/employee123.pdf', 22);

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
  `order_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `seller_username` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderedproduct`
--

INSERT INTO `orderedproduct` (`order_id`, `pid`, `quantity`, `price`, `seller_username`) VALUES
(1, 1, 2, 100.00, 'seller12345'),
(1, 6, 3, 200.00, 'jalal123'),
(2, 1, 2, 100.00, 'seller12345'),
(2, 6, 2, 200.00, 'jalal123'),
(3, 6, 2, 200.00, 'jalal123'),
(4, 6, 2, 200.00, 'jalal123'),
(4, 15, 2, 100.00, 'touhidalam'),
(4, 17, 2, 30.00, 'kamalmia');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OID` int(11) NOT NULL,
  `BuyerUsername` varchar(100) DEFAULT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL,
  `DeliveryUsername` varchar(100) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OID`, `BuyerUsername`, `TotalPrice`, `DeliveryUsername`, `Status`) VALUES
(1, 'buyer123', 800.00, 'delivery123', 'completed'),
(2, 'buyer123', 600.00, 'delivery123', 'completed'),
(3, 'buyer123', 400.00, 'delivery123', 'completed'),
(4, 'buyer123', 660.00, 'delivery123', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `PID` int(11) NOT NULL,
  `SellerUsername` varchar(100) DEFAULT NULL,
  `PName` varchar(100) NOT NULL,
  `Price` varchar(100) DEFAULT NULL,
  `Quantity` varchar(100) DEFAULT NULL,
  `Picture` varchar(100) DEFAULT NULL,
  `Details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`PID`, `SellerUsername`, `PName`, `Price`, `Quantity`, `Picture`, `Details`) VALUES
(1, 'seller12345', 'mango', '100', '196', 'pid_1.jpg', 'good quality mango'),
(5, 'seller12345', 'tomato', '40', '200', 'pid_5.jpg', 'very nice quality tomato'),
(6, 'jalal123', 'Rice', '200', '491', 'pid_6.jpg', 'Very Nice quality of rice.'),
(7, 'jalal123', 'Tomato', '20', '200', 'pid_7.jpg', ''),
(15, 'touhidalam', 'Jute', '100', '298', 'pid_15.jpg', 'Very nice qualitly jute'),
(16, 'kamalmia', 'Alu', '40', '500', 'pid_16.jpg', 'Very nice quality alu'),
(17, 'kamalmia', 'Lal Tomato', '30', '198', 'pid_17.jpg', 'Very round tomatos');

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
  `AccountID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`SellerUsername`, `Email`, `Password`, `BusinessName`, `ProductType`, `Fullname`, `Phone`, `Address`, `District`, `NID`, `AccountID`) VALUES
('jalal123', 'jalal@gmail.com', 'Jalal123', 'Jalal Kitchen', 'Fresh Produce', 'Jalal Uddin', '01995194964', 'Madhabdi, Narsingdi.', 'DHAKA', '../../images/jalal123.jpg', 0),
('kamalmia', 'kamal@gmail.com', 'Kamal@123', 'kamal123', 'Fresh Produce', 'Kamalmiah', '01234567891', 'asdf', 'DHAKA', '../../images/kamalmia.jpg', 8),
('seller12345', 'touhid.bd21@gmail.com', 'Seller@123', 'Touhid Farm', 'Fresh Produce', 'Touhid Alam', '01995194964', 'Birampur, Narsingdi, Dhaka', 'DHAKA', '../../images/seller12345.jpg', 0),
('tanvirahmed', 'touhid@gmail.com', 'Tanvir@123', 'Touhid Farm', 'Fresh Produce', 'Touhid Alam', '01234567891', 'asdf', 'KHULNA', '../../images/tanvirahmed.jpg', 0),
('touhidalam', 'touhid@gmail.com', 'touhid@123', 'Touhid Farm', 'Fresh Produce', 'Touhid Alam', '01234567891', 'asdf', 'DHAKA', '../../images/touhidalam.jpg', 0),
('touhidalamalam', 'touhid@gmail.com', 'Touhid@123', 'Touhid Farm', 'Fresh Produce', 'Touhid Alam', '01234567891', 'asdf', 'DHAKA', '../../images/touhidalamalam.jpg', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`AccountID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminUsername`);

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`BuyerUsername`);

--
-- Indexes for table `deliveryman`
--
ALTER TABLE `deliveryman`
  ADD PRIMARY KEY (`DeliveryUsername`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeUsername`);

--
-- Indexes for table `orderedproduct`
--
ALTER TABLE `orderedproduct`
  ADD PRIMARY KEY (`order_id`,`pid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OID`),
  ADD KEY `orders_ibfk_1` (`BuyerUsername`),
  ADD KEY `orders_ibfk_2` (`DeliveryUsername`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`PID`),
  ADD KEY `product_ibfk_1` (`SellerUsername`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`SellerUsername`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `AccountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
