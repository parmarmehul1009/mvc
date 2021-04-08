-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2021 at 10:36 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cybercom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` tinyint(11) NOT NULL DEFAULT 0,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `userName`, `password`, `status`, `createdDate`) VALUES
(1, 'admin2', '123', 0, '2021-03-18 14:00:51'),
(4, 'admin123', '123', 0, '2021-03-23 10:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `attributeId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `entityTypeId` enum('product','category') NOT NULL,
  `code` varchar(40) NOT NULL,
  `inputType` varchar(40) NOT NULL,
  `backendType` varchar(40) NOT NULL,
  `sortOrder` int(11) NOT NULL,
  `backendModel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attributeId`, `name`, `entityTypeId`, `code`, `inputType`, `backendType`, `sortOrder`, `backendModel`) VALUES
(1, 'Color', 'product', 'color', 'select', 'int', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_option`
--

CREATE TABLE `attribute_option` (
  `optionId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `attributeId` int(11) NOT NULL,
  `sortOrder` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute_option`
--

INSERT INTO `attribute_option` (`optionId`, `name`, `attributeId`, `sortOrder`) VALUES
(1, 'white', 1, 1),
(2, 'black', 1, 2),
(3, 'green', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandId`, `name`, `image`, `status`, `createdDate`) VALUES
(0, 'brand1', '16166896001.jpg', 0, '2021-03-25 16:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `sessionId` varchar(45) NOT NULL,
  `customerId` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `paymentMethodId` int(11) NOT NULL,
  `shippingMethodId` int(11) NOT NULL,
  `shippingAmount` int(10) NOT NULL,
  `grantTotal` decimal(10,0) DEFAULT NULL,
  `createdDate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `sessionId`, `customerId`, `total`, `discount`, `paymentMethodId`, `shippingMethodId`, `shippingAmount`, `grantTotal`, `createdDate`) VALUES
(2, '', 2, '275000', '0', 3, 2, 100, '275100', 2021),
(3, '', 3, '408400', '0', 2, 2, 100, '408500', 2021),
(4, '', 4, '62800', '0', 0, 3, 50, '62850', 2021),
(5, '', 5, '55000', '0', 0, 4, 0, '55000', 2021),
(7, '', 0, '0', '0', 0, 0, 0, NULL, 2021);

-- --------------------------------------------------------

--
-- Table structure for table `cartaddress`
--

CREATE TABLE `cartaddress` (
  `cartAddressId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `firstName` varchar(11) NOT NULL,
  `lastName` varchar(11) NOT NULL,
  `address` varchar(56) NOT NULL,
  `city` varchar(11) NOT NULL,
  `state` varchar(11) NOT NULL,
  `country` varchar(11) NOT NULL,
  `zipCode` int(11) NOT NULL,
  `addressType` varchar(11) NOT NULL,
  `sameAsBilling` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cartaddress`
--

INSERT INTO `cartaddress` (`cartAddressId`, `cartId`, `firstName`, `lastName`, `address`, `city`, `state`, `country`, `zipCode`, `addressType`, `sameAsBilling`) VALUES
(1, 2, 'ravi123', 'parmar', 'ramnagar', 'bhavnagar', 'gujarat', 'India', 364710, 'billing', 0),
(2, 2, 'ravi123', 'parmar', 'ramnagar', 'bhavnagar', 'gujarat', 'India', 364710, 'shipping', 0),
(5, 3, 'mehul', 'parmar', 'gopalnagar', 'botad', 'gujarat', 'India', 364710, 'billing', 0),
(6, 3, 'mehul', 'parmar', 'gopalnagar', 'botad', 'gujarat', 'India', 364710, 'shipping', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `cartItemId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `basePrice` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cartitem`
--

INSERT INTO `cartitem` (`cartItemId`, `cartId`, `productId`, `quantity`, `basePrice`, `discount`, `createdDate`) VALUES
(20, 3, 2, 8, '56000', '1000', '2021-03-27 05:49:29'),
(21, 3, 9, 3, '8000', '200', '2021-03-27 06:46:05'),
(22, 4, 2, 1, '56000', '1000', '2021-03-27 06:46:25'),
(23, 4, 9, 1, '8000', '200', '2021-03-27 06:46:27'),
(24, 1, 2, 2, '56000', '1000', '2021-03-28 00:01:26'),
(29, 5, 2, 1, '56000', '1000', '2021-03-28 06:15:28'),
(30, 2, 2, 5, '56000', '1000', '2021-04-01 09:04:00'),
(32, 0, 0, 5, '0', '0', '2021-04-01 08:45:24'),
(33, 0, 0, 2, '0', '0', '2021-04-01 08:45:24');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(20) NOT NULL,
  `parentId` int(56) DEFAULT NULL,
  `pathId` varchar(100) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `featured` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `parentId`, `pathId`, `name`, `status`, `description`, `featured`) VALUES
(1, 0, '1', 'Living Room', '0', '', ''),
(2, 1, '1=2', 'Sofas & Loveseats', '0', '', ''),
(3, 1, '1=3', 'Sectionals', '0', '', ''),
(4, 1, '1=4', 'Accent Chairs', '0', '', ''),
(5, 1, '1=5', 'End & Side Tables', '0', '', ''),
(6, 1, '1=6', 'Coffee Tables', '0', '', ''),
(7, 1, '1=7', 'TV Stands', '0', '', ''),
(8, 1, '1=8', 'Chairs & Recliners', '0', '', ''),
(9, 1, '1=9', 'Futons & Daybeds', '0', '', ''),
(10, 1, '1=10', 'Living Room Sets', '0', '', ''),
(11, 1, '1=11', 'Chaise Lounges', '0', '', ''),
(12, 1, '1=12', 'Ottomans & Poufs', '0', '', ''),
(13, 1, '1=13', 'Cabinets & Chests', '0', '', ''),
(14, 0, '14', 'Bedroom', '0', '', ''),
(15, 14, '14=15', 'Beds', '0', '', ''),
(16, 14, '14=16', 'Dressers', '0', '', ''),
(17, 1, '1=17', 'Nightstands', '0', '', ''),
(18, 14, '14=18', 'Headboards', '0', '', ''),
(19, 14, '14=19', 'Bed Frames', '0', '', ''),
(20, 14, '14=20', 'Bedroom Sets', '0', '', ''),
(21, 14, '14=21', 'Mattresses & Foundat', '0', '', ''),
(22, 0, '22', 'Kitchen & Dining', '0', '', ''),
(23, 22, '22=23', 'Dining Tables', '0', '', ''),
(24, 22, '22=24', 'Dining Room Sets', '0', '', ''),
(25, 22, '22=25', 'Bar Stools', '0', '', ''),
(26, 22, '22=26', 'Dining Chairs', '0', '', ''),
(27, 22, '22=27', 'Kitchen Islands', '0', '', ''),
(28, 22, '22=28', 'Sideboards & Buffets', '0', '', ''),
(29, 0, '29', 'Entry & Mudroom', '0', '', ''),
(30, 29, '29=30', 'Console Tables', '0', '', ''),
(31, 29, '29=31', 'Storage Benches', '0', '', ''),
(32, 29, '29=32', 'Hall Trees', '0', '', ''),
(33, 29, '29=33', 'Coat Racks', '0', '', ''),
(34, 0, '34', 'Game Room', '0', '', ''),
(35, 34, '34=35', 'Bean Bag Chairs', '0', '', ''),
(36, 34, '34=36', 'Gaming Chairs', '0', '', ''),
(37, 34, '34=37', 'Pool Tables', '0', '', ''),
(38, 0, '38', 'Outdoor & Patio', '0', '', ''),
(39, 38, '38=39', 'Outdoor Lounge Chair', '0', '', ''),
(40, 38, '38=40', 'Patio Dining Sets', '0', '', ''),
(41, 38, '38=41', 'Adirondack Chairs', '0', '', ''),
(42, 38, '38=42', 'Outdoor Seating & Pa', '0', '', ''),
(43, 38, '38=43', 'Patio Rocking Chairs', '0', '', ''),
(44, 38, '38=44', 'Porch Swings', '0', '', ''),
(45, 38, '38=45', 'Hammocks', '0', '', ''),
(46, 38, '38=46', 'Patio Conversation S', '0', '', ''),
(47, 38, '38=47', 'Patio Bar Furniture', '0', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
--

CREATE TABLE `cms_page` (
  `pageId` int(20) NOT NULL,
  `title1` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_page`
--

INSERT INTO `cms_page` (`pageId`, `title1`, `identifier`, `content`, `status`, `createdDate`) VALUES
(1, 'About Us', 'aboutus', '<p><a href=\"http://google.com\"><strong>this is google link</strong></a></p>\n', 0, '2021-03-18 14:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(20) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL,
  `groupId` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `firstName`, `lastName`, `email`, `mobile`, `status`, `password`, `createdDate`, `updatedDate`, `groupId`) VALUES
(2, 'ravi', 'parmar', 'ravi@gmail.com', 2147483647, '0', '122', '2021-03-18 09:56:58', '0000-00-00 00:00:00', 2),
(3, 'mehul', 'parmar', '', 0, '0', '', '2021-03-27 06:17:10', '0000-00-00 00:00:00', 2),
(4, 'jaymin', 'makwana', '', 0, '0', '', '2021-03-27 06:17:19', '0000-00-00 00:00:00', 2),
(5, 'ronak', '', '', 0, '0', '', '2021-03-27 08:00:07', '0000-00-00 00:00:00', 2),
(6, '', '', '', 0, '0', '', '2021-04-01 10:47:04', '0000-00-00 00:00:00', 2),
(7, '', '', '', 0, '0', '', '2021-04-01 10:47:13', '0000-00-00 00:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `addressId` int(11) NOT NULL,
  `customerId` int(10) DEFAULT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zipCode` int(6) NOT NULL,
  `country` varchar(20) NOT NULL,
  `addressType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`addressId`, `customerId`, `address`, `city`, `state`, `zipCode`, `country`, `addressType`) VALUES
(1, 2, 'ramnagar', 'botad11', 'gujarat', 364710, 'India', 'billing'),
(2, 2, 'ramnagar', 'botad11', 'gujarat', 364710, 'India', 'shipping'),
(3, 3, 'gopalnagar', 'botad', 'gujarat', 364710, 'India', 'billing'),
(4, 3, 'gopalnagar', 'botad', 'gujarat', 364710, 'India', 'shipping');

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE `customer_group` (
  `groupId` bigint(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(10) NOT NULL DEFAULT 0,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_group`
--

INSERT INTO `customer_group` (`groupId`, `name`, `status`, `createdDate`) VALUES
(2, 'Wholesale', 0, '2021-03-18 09:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `mediaId` int(20) NOT NULL,
  `productId` int(20) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `small` tinyint(255) DEFAULT NULL,
  `thumb` tinyint(255) DEFAULT NULL,
  `base` tinyint(255) DEFAULT NULL,
  `gallery` tinyint(20) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`mediaId`, `productId`, `label`, `image`, `small`, `thumb`, `base`, `gallery`) VALUES
(1, 2, '', '16160736891.jpg', 1, 0, 1, 1),
(3, 2, '', '16168504941.jpg', 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `methodId` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`methodId`, `name`, `code`, `description`, `status`, `createdDate`) VALUES
(1, 'Creadit Cart', '587496321', 'for creadit cart', '0', '2021-03-18 14:13:12'),
(2, 'Debit Cart', '1234566', 'for debit cart', '0', '2021-03-27 10:32:06'),
(3, 'Paypal', '6523489', 'for paypal', '0', '2021-03-27 10:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(20) NOT NULL,
  `sku` int(20) NOT NULL,
  `name` varchar(60) NOT NULL,
  `price` float NOT NULL,
  `discount` float NOT NULL,
  `quantity` int(10) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL,
  `color` int(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `sku`, `name`, `price`, `discount`, `quantity`, `description`, `status`, `createdDate`, `updatedDate`, `color`) VALUES
(2, 0, 'laptop', 56000, 1000, 1, 'this is laptop', '1', '2021-03-18 14:10:30', '2021-03-27 11:55:48', 0),
(9, 123456, 'mobile', 8000, 200, 10, 'this is mobile', '0', '2021-03-27 08:50:20', '2021-03-27 11:55:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `categoryId` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `productId`, `categoryId`) VALUES
(6, 2, 18),
(7, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_customer_group_price`
--

CREATE TABLE `product_customer_group_price` (
  `entityId` int(50) NOT NULL,
  `productId` int(20) NOT NULL,
  `customerGroupId` bigint(10) DEFAULT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_customer_group_price`
--

INSERT INTO `product_customer_group_price` (`entityId`, `productId`, `customerGroupId`, `price`) VALUES
(1, 2, 2, 11500);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `methodId` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`methodId`, `name`, `code`, `amount`, `description`, `status`, `createdDate`) VALUES
(2, 'Express Delivery 1 Day', '96854135', '100', 'for express delivery', '0', '2021-03-27 10:41:50'),
(3, 'Platinum delivery ', '5698745', '50', 'for platinum delivery', '0', '2021-03-27 10:42:41'),
(4, 'Free Delivery ', '635987451', '0', 'for free delivery', '0', '2021-03-27 10:43:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attributeId`);

--
-- Indexes for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD PRIMARY KEY (`optionId`),
  ADD KEY `attributeId` (`attributeId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `cartaddress`
--
ALTER TABLE `cartaddress`
  ADD PRIMARY KEY (`cartAddressId`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`cartItemId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `cms_page`
--
ALTER TABLE `cms_page`
  ADD PRIMARY KEY (`pageId`),
  ADD UNIQUE KEY `identifier` (`identifier`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `test` (`groupId`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`mediaId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `product_customer_group_price`
--
ALTER TABLE `product_customer_group_price`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `customerGroupId` (`customerGroupId`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`methodId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attribute_option`
--
ALTER TABLE `attribute_option`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cartaddress`
--
ALTER TABLE `cartaddress`
  MODIFY `cartAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `cms_page`
--
ALTER TABLE `cms_page`
  MODIFY `pageId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `groupId` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `mediaId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `methodId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_customer_group_price`
--
ALTER TABLE `product_customer_group_price`
  MODIFY `entityId` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `methodId` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD CONSTRAINT `attribute_option_ibfk_1` FOREIGN KEY (`attributeId`) REFERENCES `attribute` (`attributeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `test` FOREIGN KEY (`groupId`) REFERENCES `customer_group` (`groupId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_category_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_customer_group_price`
--
ALTER TABLE `product_customer_group_price`
  ADD CONSTRAINT `product_customer_group_price_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_customer_group_price_ibfk_2` FOREIGN KEY (`customerGroupId`) REFERENCES `customer_group` (`groupId`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
