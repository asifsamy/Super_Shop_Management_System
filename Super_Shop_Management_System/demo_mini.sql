-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2017 at 05:50 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_mini`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `account_no` varchar(5) NOT NULL,
  `pin_no` varchar(3) NOT NULL,
  `ammount` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `account_no`, `pin_no`, `ammount`) VALUES
(1, '12345', '123', 20000),
(2, '10000', '123', 2000),
(3, '20000', '123', 30);

-- --------------------------------------------------------

--
-- Table structure for table `buying_table`
--

CREATE TABLE `buying_table` (
  `purchase_id` int(11) NOT NULL,
  `product_code` varchar(30) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buying_table`
--

INSERT INTO `buying_table` (`purchase_id`, `product_code`, `product_quantity`) VALUES
(1, 'P1', 5),
(2, 'P1', 30),
(3, 'P3', 1),
(4, 'P6', 1),
(4, 'P7', 1),
(4, 'P3', 3),
(5, 'P6', 1),
(6, 'P45', 15),
(6, 'P7', 12),
(7, 'P334', 1),
(7, 'P29', 2),
(8, 'P45', 2),
(98, 'P23', 1),
(97, 'P45', 1),
(96, 'P99', 1),
(95, 'P99', 1),
(94, 'P23', 1),
(93, '019288', 1),
(92, '019288', 1),
(91, 'P45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_code` varchar(60) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `products_available` int(11) NOT NULL,
  `products_supplier` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_code`, `product_name`, `price`, `products_available`, `products_supplier`) VALUES
(21, 'P23', 'Cow Milk', '70.00', 35, 'Arong'),
(20, 'P29', 'Cow Meat', '315.00', 92, 'Arong'),
(19, 'P334', 'Coffee 250gm', '240.00', 114, 'Boost'),
(18, 'P45', 'Aluz Chips', '15.00', 0, ''),
(16, 'P7', 'Potato', '15.00', 0, ''),
(22, '019288', 'Lux Soap 200g', '50.00', 91, NULL),
(23, 'P99', 'Moneybag', '345.00', 18, 'Laoksi');

-- --------------------------------------------------------

--
-- Table structure for table `total_purchase`
--

CREATE TABLE `total_purchase` (
  `purchase_id` int(11) NOT NULL,
  `purchase_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `purchase_total` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `total_purchase`
--

INSERT INTO `total_purchase` (`purchase_id`, `purchase_date`, `purchase_total`, `user_id`) VALUES
(1, '2017-03-17 05:24:15', 76, 'Employee1'),
(2, '2017-03-18 05:45:49', 457, 'Employee1'),
(3, '2017-03-20 08:13:02', 39, 'Employee1'),
(4, '2017-03-20 08:25:05', 543, 'Employee1'),
(5, '2017-03-20 08:28:22', 410, 'Employee2'),
(6, '2017-03-20 10:04:57', 474, 'Employee3'),
(7, '2017-07-22 13:35:50', 1006, 'Employee1'),
(8, '2017-07-22 13:57:37', 36, 'Employee1'),
(98, '2017-08-06 16:50:31', 82, 'Employee1'),
(97, '2017-08-05 05:53:14', 18, 'Employee2'),
(96, '2017-08-05 05:21:25', 403, 'Employee2'),
(95, '2017-08-05 05:16:48', 403, 'Employee2'),
(94, '2017-08-05 05:13:16', 82, 'Employee2'),
(93, '2017-08-05 05:11:36', 59, 'Employee2'),
(92, '2017-08-05 05:10:25', 59, 'Employee2'),
(91, '2017-08-05 05:07:54', 18, 'Employee2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_name` varchar(30) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `user_type` varchar(30) NOT NULL,
  `user_pass` varchar(30) NOT NULL,
  `user_address` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_name`, `user_id`, `user_type`, `user_pass`, `user_address`) VALUES
('Arif-Ul-Islam', 'Employee1', 'Employee', '1234', 'Link Road , Dhaka .Comilla'),
('Rafiqul Islam', 'Employee3', 'Employee', '1234', 'Gulshan , Dhaka .'),
('Kulsum Begum', 'Employee2', 'Employee', '1234', 'Uttara , Dhaka .'),
('Kalam Hosen', 'Employee4', 'Employee', '1234', 'Faridabad , Rangpur .');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- Indexes for table `total_purchase`
--
ALTER TABLE `total_purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `total_purchase`
--
ALTER TABLE `total_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
