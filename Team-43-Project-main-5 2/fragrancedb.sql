-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2023 at 05:53 PM
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
-- Database: `fragrancedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `basketID` int(11) NOT NULL,
  `sessionID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customeraddress`
--

CREATE TABLE `customeraddress` (
  `addressID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `addressLine1` varchar(50) NOT NULL,
  `addressLine2` varchar(50) DEFAULT NULL,
  `postcode` varchar(8) NOT NULL,
  `country` varchar(15) DEFAULT 'UK'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discountID` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `itemID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(6,2) NOT NULL,
  `bottleSize` int(11) DEFAULT NULL,
  `engraving` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `paymentID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `total` decimal(6,2) NOT NULL,
  `discountID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(11) NOT NULL,
  `paymentType` varchar(255) NOT NULL,
  `cardNumber` int(11) NOT NULL,
  `expiryDate` year(4) NOT NULL,
  `CVV` int(11) NOT NULL,
  `paymentName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `saleID` int(11) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `colour` varchar(255) DEFAULT NULL,
  `scent` varchar(255) DEFAULT NULL,
  `season` varchar(255) DEFAULT NULL,
  `images` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productinventory`
--

CREATE TABLE `productinventory` (
  `inventoryID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `reviewID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `saleID` int(11) NOT NULL,
  `salePercentage` float NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shoppingsession`
--

CREATE TABLE `shoppingsession` (
  `sessionID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`basketID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `sessionID` (`sessionID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `customeraddress`
--
ALTER TABLE `customeraddress`
  ADD PRIMARY KEY (`addressID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discountID`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `paymentID` (`paymentID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `discountID` (`discountID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `categoryID` (`categoryID`),
  ADD KEY `saleID` (`saleID`);

--
-- Indexes for table `productinventory`
--
ALTER TABLE `productinventory`
  ADD PRIMARY KEY (`inventoryID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`saleID`);

--
-- Indexes for table `shoppingsession`
--
ALTER TABLE `shoppingsession`
  ADD PRIMARY KEY (`sessionID`),
  ADD KEY `customerID` (`customerID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`),
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`sessionID`) REFERENCES `shoppingsession` (`sessionID`);

--
-- Constraints for table `customeraddress`
--
ALTER TABLE `customeraddress`
  ADD CONSTRAINT `customeraddress_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `orderitem_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`paymentID`) REFERENCES `payment` (`paymentID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`discountID`) REFERENCES `discount` (`discountID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`saleID`) REFERENCES `sale` (`saleID`);

--
-- Constraints for table `productinventory`
--
ALTER TABLE `productinventory`
  ADD CONSTRAINT `productinventory_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);

--
-- Constraints for table `shoppingsession`
--
ALTER TABLE `shoppingsession`
  ADD CONSTRAINT `shoppingsession_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
