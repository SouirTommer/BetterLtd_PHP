-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2022 at 05:54 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdb`
--
CREATE DATABASE IF NOT EXISTS `projectdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `projectdb`;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerEmail` varchar(50) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerEmail`, `customerName`, `phoneNumber`) VALUES
('mary@gmail.com', 'Mary', '58674321'),
('tom@gmail.com', 'Tom', '57568291');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `itemID` int(11) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `itemDescription` text DEFAULT NULL,
  `stockQuantity` int(11) NOT NULL DEFAULT 0,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`itemID`, `itemName`, `itemDescription`, `stockQuantity`, `price`) VALUES
(1, 'NOVEL NF4091 9”All-way Strong Wind Circulation Fan', 'Simple Design with 3D stereo blower Turbo super strong wind up', 50, 500),
(2, 'CS-RZ24YKA 2.5 HP \"Inverter\" Split Type Heat Pump Air-Conditioner', '2.5 HP (Heat Pump Model - With Remote Control)', 100, 20000),
(3, 'QN100B Neo QLED 2K LED LCD TV', 'Infinity Screen, More immersive viewing experience', 80, 13000),
(4, 'M33 5G Smartphone', '6.6” FHD+ Infinity-V Display, 120Hz refresh rate 50MP main camera equipped with small ', 300, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `itemorders`
--

CREATE TABLE `itemorders` (
  `orderID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `orderQuantity` int(5) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemorders`
--

INSERT INTO `itemorders` (`orderID`, `itemID`, `orderQuantity`, `price`) VALUES
(1, 1, 2, 1000),
(1, 4, 1, 2000),
(2, 3, 1, 13000),
(3, 1, 1, 500);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `customerEmail` varchar(50) NOT NULL,
  `staffID` varchar(50) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deliveryAddress` varchar(255) DEFAULT NULL,
  `deliveryDate` date DEFAULT NULL,
  `totalPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `customerEmail`, `staffID`, `dateTime`, `deliveryAddress`, `deliveryDate`, `totalPrice`) VALUES
(1, 'mary@gmail.com', 's0001', '2022-03-24 13:12:13', NULL, NULL, 2910),
(2, 'tom@gmail.com', 's0001', '2022-04-10 14:10:20', 'Flat 8, Chates Farm Court, John Street, Hong Kong', '2022-04-15', 11440),
(3, 'mary@gmail.com', 's003', '2022-04-12 14:10:20', NULL, NULL, 500);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` varchar(50) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `staffName`, `password`, `position`) VALUES
('s0001', 'Chan Tai Man', 'a123', 'Staff'),
('s0002', 'Wong Ka Ho', 'b123', 'Manager'),
('s003', 'Chan ka Chung', 'c123', 'Staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerEmail`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `itemorders`
--
ALTER TABLE `itemorders`
  ADD PRIMARY KEY (`orderID`,`itemID`),
  ADD KEY `FKItemOrders932280` (`itemID`),
  ADD KEY `FKItemOrders159103` (`orderID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `FKOrders837071` (`customerEmail`),
  ADD KEY `FKOrders846725` (`staffID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `itemorders`
--
ALTER TABLE `itemorders`
  ADD CONSTRAINT `FKItemOrders159103` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `FKItemOrders932280` FOREIGN KEY (`itemID`) REFERENCES `item` (`itemID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FKOrders837071` FOREIGN KEY (`customerEmail`) REFERENCES `customer` (`customerEmail`),
  ADD CONSTRAINT `FKOrders846725` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
