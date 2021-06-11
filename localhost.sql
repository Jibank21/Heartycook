-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2021 at 05:44 AM
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
-- Database: `heartycook`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `admin_username` varchar(30) NOT NULL,
  `fld_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `fld_password`) VALUES
(1, 'admin', 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` bigint(11) NOT NULL,
  `customer_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `customer_id`) VALUES
(11, 6, 'jeevan@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `cook`
--

CREATE TABLE `cook` (
  `cook_id` int(10) NOT NULL,
  `cust_name` varchar(30) NOT NULL,
  `cust_email` varchar(50) NOT NULL,
  `fld_password` varchar(50) NOT NULL,
  `fld_mob` bigint(10) NOT NULL,
  `fld_phone` bigint(10) NOT NULL,
  `fld_address` varchar(50) NOT NULL,
  `pro_image` varchar(250) NOT NULL,
  `email_verification` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cook`
--

INSERT INTO `cook` (`cook_id`, `cust_name`, `cust_email`, `fld_password`, `fld_mob`, `fld_phone`, `fld_address`, `pro_image`, `email_verification`) VALUES
(22, 'Anish Panta', 'cook1@gmail.com', 'cook1', 7503515386, 114565457, 'noida', '46388969.jpg', 0),
(23, 'Sagar Sapkota', 'cook2@gmail.com', 'cook2', 7503515385, 114565457, 'C-33, SWARN PARK, MUNDKA', '46388969.jpg', 0),
(24, 'jeevan', 'jeevan@gmail.com', 'jeevan1', 9807331986, 9807331986, 'campsie', '9c935e14be80fcfa4233736a7d3d5a26.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(10) NOT NULL,
  `cust_name` varchar(30) NOT NULL,
  `cust_email` varchar(30) NOT NULL,
  `cust_phone` bigint(10) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_email`, `cust_phone`, `password`) VALUES
(1, 'ganesh', 'customer1@gmail.com', 7503515382, 'customer1'),
(2, 'sanjay', 'customer2@gmail.com', 7503515386, 'customer2'),
(3, 'saana', 'customer3@gmail.com', 7503515383, 'customer3'),
(4, 'jeevan', 'jeevan@gmail.com', 9807331986, 'jeevan');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_person`
--

CREATE TABLE `delivery_person` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--  Dumping data for table `customer`

INSERT INTO `delivery_person` (`id`, `name`, `email`, `password`,`phone`,`address`) VALUES
(1, 'jiban', 'jiban','jiban@gmail.com','jiban1' 7503515382, 'ccampsie'),


-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `cook_id` int(11) NOT NULL,
  `foodname` varchar(100) NOT NULL,
  `cost` bigint(15) NOT NULL,
  `cuisines` varchar(50) NOT NULL,
  `paymentmode` varchar(50) NOT NULL,
  `fldimage` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `cook_id`, `foodname`, `cost`, `cuisines`, `paymentmode`, `fldimage`) VALUES
(2, 22, 'malai Kofta', 16, 'vegetable,veg', 'COD', '1469258122-malai-kofta.jpg'),
(3, 22, 'shahi panner', 20, 'vegetable', 'COD', 'Shahi-Paneer-Recipe.jpg'),
(4, 22, 'chola kulcha', 16, 'lunch', 'COD', 'maxresdefault.jpg'),
(5, 23, 'Pizza', 15, 'Medium Size, fast food', 'COD', 'phut_0.jpg'),
(6, 23, 'Pizza Full', 20, 'Fast food,full size', 'COD', 'phut_0.jpg'),
(7, 23, 'burger ', 18, 'Fast food', 'COD', 'photo-1534790566855-4cb788d389ec.jpg'),
(8, 24, 'Mushroom Bolognese', 19, 'mushroom', 'Online Payment', 'MushroomBolognese.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `msg_id` int(10) NOT NULL,
  `cust_name` varchar(50) NOT NULL,
  `cust_email` varchar(50) NOT NULL,
  `fld_phone` bigint(10) DEFAULT NULL,
  `fld_msg` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `cart_id` bigint(10) NOT NULL,
  `cook_id` bigint(10) DEFAULT NULL,
  `food_id` bigint(10) DEFAULT NULL,
  `cust_email_id` varchar(50) DEFAULT NULL,
  `payment` varchar(20) DEFAULT NULL,
  `fldstatus` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cart_id`, `cook_id`, `food_id`, `cust_email_id`, `payment`, `fldstatus`) VALUES
(2, 2, 22, 3, 'customer3@gmail.com', '20', 'Delivered'),
(3, 6, 22, 3, 'customer1@gmail.com', '20', 'Delivered'),
(4, 7, 23, 7, 'customer3@gmail.com', '18', 'In Process'),
(5, 8, 22, 3, 'customer3@gmail.com', '20', 'In Process'),
(6, 9, 22, 3, 'jeevan@gmail.com', '20', 'In Process'),
(7, 10, 24, 8, 'jeevan@gmail.com', '19', 'In Process');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `cook`
--
ALTER TABLE `cook`
  ADD PRIMARY KEY (`cook_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `delivery_person`
--
ALTER TABLE `delivery_person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `cook_id` (`cook_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cook`
--
ALTER TABLE `cook`
  MODIFY `cook_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery_person`
--
ALTER TABLE `delivery_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`cook_id`) REFERENCES `cook` (`cook_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
