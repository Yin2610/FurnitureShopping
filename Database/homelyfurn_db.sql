-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Oct 10, 2021 at 06:09 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homelyfurn_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `BrandID` int(11) NOT NULL,
  `BrandName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`BrandID`, `BrandName`) VALUES
(1, 'Christina Furniture'),
(3, 'Ashley Furniture'),
(5, 'Wayfair'),
(6, 'Pinnarp');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(30) NOT NULL,
  `CustomerGender` varchar(6) NOT NULL,
  `CustomerPhone` varchar(20) NOT NULL,
  `CustomerEmail` varchar(25) NOT NULL,
  `CustomerAddress` varchar(100) NOT NULL,
  `CustomerPassword` varchar(10) NOT NULL,
  `CustomerCreditCard` varchar(20) NOT NULL,
  `CVC` varchar(3) NOT NULL,
  `ExpirationDate` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `CustomerName`, `CustomerGender`, `CustomerPhone`, `CustomerEmail`, `CustomerAddress`, `CustomerPassword`, `CustomerCreditCard`, `CVC`, `ExpirationDate`) VALUES
(1, 'Polly', 'Female', '0945657565', 'polly@gmail.com', 'Botahtaung', 'polly', '1234 8956 4859 2309', '457', '12/2022'),
(2, 'May', 'Female', '09645524330', 'may@gmail.com', 'Pansodan', 'may', '1209 3405 1983 4502', '792', '10/2021'),
(8, 'Jasmine', 'Female', '09647982678', 'jasmine@gmail.com', 'No.(68), 49th Street, Kyauktada', 'jasmine', '4354 5645 5756 6456', '645', '10/2022');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `DeliveryID` varchar(10) NOT NULL,
  `DeliveryDate` date NOT NULL,
  `DeliveryTownship` varchar(50) NOT NULL,
  `DeliveryStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `furniture`
--

CREATE TABLE `furniture` (
  `FurnitureID` varchar(15) NOT NULL,
  `FurnitureName` varchar(50) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Description` varchar(130) NOT NULL,
  `FurnitureImage1` varchar(255) NOT NULL,
  `FurnitureImage2` varchar(255) NOT NULL,
  `FurnitureImage3` varchar(255) NOT NULL,
  `BrandID` int(11) NOT NULL,
  `FurnitureTypeID` int(11) NOT NULL,
  `MaterialID` int(11) NOT NULL,
  `UsePlace` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `furniture`
--

INSERT INTO `furniture` (`FurnitureID`, `FurnitureName`, `Quantity`, `Price`, `Description`, `FurnitureImage1`, `FurnitureImage2`, `FurnitureImage3`, `BrandID`, `FurnitureTypeID`, `MaterialID`, `UsePlace`) VALUES
('F-00001', 'Ashley table', 19, 150000, 'Ashley table width: 18.12\" \r\nheight: 21.87\"\r\n2-drawer chest\r\nmade with wood', 'FurnitureImage/_bedside_table1.jpg', 'FurnitureImage/_bedside_table2.jpg', 'FurnitureImage/_bedside_table3.jpg', 3, 7, 1, 'Bedroom'),
('F-00002', 'Ashley living room sofa', 30, 100000, 'Soft and comfortable to sit. ', 'FurnitureImage/_sofa-1.jpg', 'FurnitureImage/_sofa-2.jpg', 'FurnitureImage/_sofa-3.jpg', 3, 5, 1, 'Living room'),
('F-00003', 'Pinnarp counter', 11, 50000, 'Put things on it.', 'FurnitureImage/_pinnarp-counter.jpg', 'FurnitureImage/_pinnarp-counter2.jpg', 'FurnitureImage/_pinnarp-counter3.jpg', 6, 9, 1, 'Kitchen');

-- --------------------------------------------------------

--
-- Table structure for table `furnitureorder`
--

CREATE TABLE `furnitureorder` (
  `OrderSubQuantity` int(11) NOT NULL,
  `OrderSubPrice` int(11) NOT NULL,
  `FurnitureID` varchar(15) NOT NULL,
  `OrderID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `furnitureorder`
--

INSERT INTO `furnitureorder` (`OrderSubQuantity`, `OrderSubPrice`, `FurnitureID`, `OrderID`) VALUES
(1, 300000, 'F-00001', 'ORD-000001'),
(1, 300000, 'F-00001', 'ORD-000002'),
(1, 300000, 'F-00001', 'ORD-000003'),
(2, 250000, 'F-00003', 'ORD-000004'),
(1, 50000, 'F-00002', 'ORD-000004'),
(1, 150000, 'F-00001', 'ORD-000005'),
(1, 250000, 'F-00003', 'ORD-000006'),
(1, 150000, 'F-00001', 'ORD-000006');

-- --------------------------------------------------------

--
-- Table structure for table `furniturepurchase`
--

CREATE TABLE `furniturepurchase` (
  `PurchaseSubQuantity` int(11) NOT NULL,
  `PurchaseSubPrice` int(11) NOT NULL,
  `PurchaseID` varchar(10) NOT NULL,
  `FurnitureID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `furniturepurchase`
--

INSERT INTO `furniturepurchase` (`PurchaseSubQuantity`, `PurchaseSubPrice`, `PurchaseID`, `FurnitureID`) VALUES
(7, 1400, 'PF-00001', 'F-00002'),
(10, 1000, 'PF-00001', 'F-00003'),
(4, 1200, 'PF-00002', 'F-00003'),
(6, 2000, 'PF-00003', 'F-00001');

-- --------------------------------------------------------

--
-- Table structure for table `furnituretype`
--

CREATE TABLE `furnituretype` (
  `FurnitureTypeID` int(11) NOT NULL,
  `FurnitureType` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `furnituretype`
--

INSERT INTO `furnituretype` (`FurnitureTypeID`, `FurnitureType`) VALUES
(1, 'Dining chair'),
(3, 'Bed'),
(5, 'Sofa'),
(7, 'Bedside table'),
(8, 'Bedside lamp'),
(9, 'Counter'),
(10, 'Bookcase');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `MaterialID` int(11) NOT NULL,
  `Material` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`MaterialID`, `Material`) VALUES
(1, 'Wood'),
(2, 'Metal'),
(5, 'Plastic'),
(6, 'Steel');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` varchar(10) NOT NULL,
  `OrderDate` date NOT NULL,
  `TotalQuantity` int(11) NOT NULL,
  `GrandTotal` int(11) NOT NULL,
  `VAT` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `ReceiverName` varchar(20) NOT NULL,
  `ReceiverPhone` varchar(20) NOT NULL,
  `ReceiverEmail` varchar(20) NOT NULL,
  `ReceiverAddress` varchar(200) NOT NULL,
  `OrderStatus` varchar(15) NOT NULL,
  `DeliveryEstimate` date NOT NULL,
  `DeliveryStatus` varchar(20) NOT NULL,
  `DeliveryNotes` varchar(200) NOT NULL,
  `PaymentID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `OrderDate`, `TotalQuantity`, `GrandTotal`, `VAT`, `CustomerID`, `ReceiverName`, `ReceiverPhone`, `ReceiverEmail`, `ReceiverAddress`, `OrderStatus`, `DeliveryEstimate`, `DeliveryStatus`, `DeliveryNotes`, `PaymentID`) VALUES
('ORD-000001', '2021-09-30', 1, 316500, 15000, 1, 'Lily', '09414453984', 'lily@gmail.com', '34th Street, Kyauktada township', 'CONFIRMED', '2021-10-10', 'DONE', 'This is a gift for Lily. Please pack it nicely.', 'PM-000002'),
('ORD-000002', '2021-09-30', 1, 316500, 15000, 1, 'Polly', '0945657565', 'polly@gmail.com', 'Botahtaung', 'CONFIRMED', '2021-10-10', 'DONE', '', 'PM-000003'),
('ORD-000003', '2021-09-30', 1, 316500, 15000, 1, 'Polly', '0945657565', 'polly@gmail.com', 'Botahtaung', 'CONFIRMED', '2021-10-10', 'DONE', '', 'PM-000004'),
('ORD-000004', '2021-10-04', 3, 579000, 27500, 8, 'Jasmine', '09647982678', 'jasmine@gmail.com', 'No.(68), 49th Street, Kyauktada', 'CONFIRMED', '2021-10-14', 'DONE', '', 'PM-000005'),
('ORD-000005', '2021-10-08', 1, 159000, 7500, 8, 'Jasmine', '09647982678', 'jasmine@gmail.com', 'No.(68), 49th Street, Kyauktada', 'CONFIRMED', '2021-10-18', 'NOT DONE', '', 'PM-000006'),
('ORD-000006', '2021-10-09', 2, 421500, 20000, 1, 'Polly', '0945657565', 'polly@gmail.com', 'Botahtaung', 'NOT CONFIRMED', '2021-10-19', 'NOT DONE', '', 'PM-000007');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` varchar(10) NOT NULL,
  `PaymentType` varchar(10) NOT NULL,
  `CreditCardType` varchar(20) NOT NULL,
  `CreditCardNo` varchar(20) NOT NULL,
  `CVC` varchar(3) NOT NULL,
  `CardExpDate` varchar(7) NOT NULL,
  `PayPhoneNo` varchar(20) NOT NULL,
  `TransactionNo` varchar(20) NOT NULL,
  `PaymentStatus` varchar(10) NOT NULL,
  `OrderID` varchar(10) NOT NULL,
  `CustomerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `PaymentType`, `CreditCardType`, `CreditCardNo`, `CVC`, `CardExpDate`, `PayPhoneNo`, `TransactionNo`, `PaymentStatus`, `OrderID`, `CustomerID`) VALUES
('PM-000002', 'CARD', 'AmericanExpress', '1234 3453 6546 9843', '498', '03/2024', '', '', 'PAID', 'ORD-000001', 1),
('PM-000003', 'WAVEPAY', '', '', '', '', '09325325423', '43102374132403243704', 'PAID', 'ORD-000002', 1),
('PM-000004', 'WAVEPAY', '', '', '', '', '09325325423', '43102374132403243704', 'PAID', 'ORD-000003', 1),
('PM-000005', 'COD', '', '', '', '', '', '', 'PAID', 'ORD-000004', 8),
('PM-000006', 'KPAY', '', '', '', '', '09543856072', '41276426350248370732', 'PAID', 'ORD-000005', 8),
('PM-000007', 'COD', '', '', '', '', '', '', 'NOT PAID', 'ORD-000006', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `PurchaseID` varchar(10) NOT NULL,
  `PurchaseDate` varchar(20) NOT NULL,
  `TotalAmount` int(11) NOT NULL,
  `TotalQuantity` int(11) NOT NULL,
  `TaxAmount` int(11) NOT NULL,
  `GrandTotal` int(11) NOT NULL,
  `PurchaseStatus` varchar(10) NOT NULL,
  `SupplierID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`PurchaseID`, `PurchaseDate`, `TotalAmount`, `TotalQuantity`, `TaxAmount`, `GrandTotal`, `PurchaseStatus`, `SupplierID`, `StaffID`) VALUES
('PF-00001', '2021-10-10', 19800, 17, 990, 20790, 'PENDING', 4, 7),
('PF-00002', '2021-09-21', 4800, 4, 240, 5040, 'CONFIRMED', 5, 7),
('PF-00003', '2021-09-02', 12000, 6, 600, 12600, 'PENDING', 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `StaffName` varchar(30) NOT NULL,
  `StaffEmail` varchar(30) NOT NULL,
  `StaffPhone` varchar(20) NOT NULL,
  `StaffPassword` varchar(10) NOT NULL,
  `StaffGender` varchar(6) NOT NULL,
  `StaffAddress` varchar(255) NOT NULL,
  `PositionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `StaffName`, `StaffEmail`, `StaffPhone`, `StaffPassword`, `StaffGender`, `StaffAddress`, `PositionID`) VALUES
(1, 'Yin', 'yin@gmail.com', '092345438', 'yin', 'Female', 'Latha Road, Latha', 1),
(7, 'Sally', 'sally@gmail.com', '09464756901', 'sally', 'Female', 'Mahabandoola Road, Latha', 2),
(8, 'Nicholas', 'nicho@gmail.com', '09368764432', 'nicholas', 'Male', 'Mandalay', 3),
(9, 'Alexa', 'alexa@gmail.com', '094643538762', 'alexa', 'Male', 'Thanlyin', 1),
(10, 'Patricia', 'patricia@gmail.com', '09564526470', 'patricia', 'Female', 'Mawlamyine', 5);

-- --------------------------------------------------------

--
-- Table structure for table `staffposition`
--

CREATE TABLE `staffposition` (
  `PositionID` int(11) NOT NULL,
  `PositionName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffposition`
--

INSERT INTO `staffposition` (`PositionID`, `PositionName`) VALUES
(1, 'General manager'),
(2, 'Purchasing manager'),
(3, 'Delivery manager'),
(5, 'Delivery staff');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupplierID` int(11) NOT NULL,
  `SupplierName` varchar(30) NOT NULL,
  `SupplierPhone` varchar(20) NOT NULL,
  `SupplierAddress` varchar(50) NOT NULL,
  `SupplierEmail` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `SupplierPhone`, `SupplierAddress`, `SupplierEmail`) VALUES
(1, 'Christina', '085346324', 'Italy', 'christina@gmail.com'),
(3, 'Gazu', '085346323', 'America', 'gazu@gmail.com'),
(4, 'Ashley', '0345654654', 'China', 'ashley@gmail.com'),
(5, 'Pinnarp', '09564526470', 'China', 'pinnarp@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`BrandID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`DeliveryID`);

--
-- Indexes for table `furniture`
--
ALTER TABLE `furniture`
  ADD PRIMARY KEY (`FurnitureID`);

--
-- Indexes for table `furnituretype`
--
ALTER TABLE `furnituretype`
  ADD PRIMARY KEY (`FurnitureTypeID`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`MaterialID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`PurchaseID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `staffposition`
--
ALTER TABLE `staffposition`
  ADD PRIMARY KEY (`PositionID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `BrandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `furnituretype`
--
ALTER TABLE `furnituretype`
  MODIFY `FurnitureTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `MaterialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `staffposition`
--
ALTER TABLE `staffposition`
  MODIFY `PositionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `SupplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
