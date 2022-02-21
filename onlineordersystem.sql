-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2022 at 05:30 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineordersystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Code` varchar(255) NOT NULL,
  `IsActive` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) NOT NULL,
  `UpdatedDate` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `UpdatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Id`, `Name`, `Code`, `IsActive`, `CreatedDate`, `CreatedBy`, `UpdatedDate`, `UpdatedBy`) VALUES
(1, 'Soup', 'SOUP-0001', 1, '2021-10-12 07:08:36', 1, '2021-10-13 13:55:10', 1),
(2, 'Cool Drinks', 'Drink-0003', 1, '2021-10-12 10:34:20', 0, '2021-10-12 16:48:40', 0),
(3, 'Soft Drinks', 'SOFT-001', 1, '2021-10-12 10:39:17', 0, '2021-10-13 07:23:29', 0),
(4, 'test232', 'test01', 1, '2021-10-12 10:48:14', 0, '2021-10-12 18:22:36', 0),
(5, 'Thai Food', 'adsfds', 1, '2021-10-12 10:52:22', 1, NULL, 0),
(6, 'Fried Rice', 'FRR-004', 1, '2021-10-12 16:59:02', 1, NULL, 0),
(7, 'testing', 'test-004546', 0, '2021-10-13 07:31:06', 1, '2021-10-13 07:50:18', 0),
(8, 'swal testing', '343refdsf', 1, '2021-10-13 07:38:29', 1, NULL, 0),
(14, 'Thai Soup', 'th-009', 0, '2021-10-13 08:10:40', 1, NULL, 0),
(15, 'Pasta', 'pasta-0035', 1, '2021-11-14 22:19:09', 15, NULL, 0),
(16, 'Chicken Grill', 'CHCKN-001', 1, '2022-01-12 20:34:02', 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `FoodItemId` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fooditem`
--

CREATE TABLE `fooditem` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Discount` decimal(10,0) NOT NULL,
  `IsAvailable` int(11) NOT NULL,
  `IsActive` int(11) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `SubCategoryId` int(11) NOT NULL,
  `DisplayPicture` varchar(255) DEFAULT NULL,
  `Description` text NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdatedBy` int(11) NOT NULL,
  `UpdatedDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fooditem`
--

INSERT INTO `fooditem` (`Id`, `Name`, `Price`, `Discount`, `IsAvailable`, `IsActive`, `CategoryId`, `SubCategoryId`, `DisplayPicture`, `Description`, `CreatedBy`, `CreatedDate`, `UpdatedBy`, `UpdatedDate`) VALUES
(1, 'Test1', '400', '10', 1, 1, 8, 1, '', ' some description here', 1, '2021-10-13 16:28:00', 0, '2021-10-14 06:37:35'),
(3, 'ddgfdg', '400', '40', 1, 1, 8, 1, 'public/image/1634170873items.jpg', ' dgfdgfhgf', 1, '2021-10-13 16:36:27', 0, '2021-10-14 06:24:36'),
(4, 'new image', '300', '10', 1, 1, 3, 1, 'public/image/1634170873items.jpg', ' some changes', 1, '2021-10-13 16:38:29', 0, '2021-10-14 06:24:32'),
(5, 'vfdgdfgdfg', '200', '6', 1, 1, 2, 1, 'public/image/1634170873items.jpg', ' sdfdgfdg', 1, '2021-10-13 16:41:04', 0, '2021-10-14 06:24:28'),
(7, 'french fry', '200', '1', 1, 1, 6, 1, 'public/image/1634170873items.jpg', ' some test', 1, '2021-10-14 06:21:13', 0, '0000-00-00 00:00:00'),
(8, 'validation', '200', '10', 0, 0, 8, 1, 'public/image/1634172183items.jpg', ' some changes', 1, '2021-10-14 06:43:03', 0, '0000-00-00 00:00:00'),
(9, 'All Images', '500', '4', 1, 1, 6, 1, 'public/image/1634172954items.jpg', ' All picture test', 1, '2021-10-14 06:55:54', 0, '0000-00-00 00:00:00'),
(10, 'somfdfdf', '4545', '4', 1, 1, 8, 1, 'public/image/1634173303items.jpg', ' dsfdsfsdfds', 1, '2021-10-14 07:01:43', 0, '0000-00-00 00:00:00'),
(12, 'xvfdgd', '34', '2', 1, 1, 8, 1, 'public/image/1634173380items.jpg', ' fsdfdsfdsf', 1, '2021-10-14 07:03:00', 0, '0000-00-00 00:00:00'),
(13, 'xvfdgd4rtrtre', '34', '2', 1, 1, 8, 1, 'public/image/1634173461items.jpg', ' fsdfdsfdsf', 1, '2021-10-14 07:04:21', 0, '0000-00-00 00:00:00'),
(14, 'sfdsfdgfdg', '500', '5', 1, 1, 3, 1, 'public/image/1634173580items.jpg', ' sddgfdgfdg', 1, '2021-10-14 07:06:20', 0, '0000-00-00 00:00:00'),
(15, 'lets see', '400', '4', 0, 0, 3, 1, 'public/image/1634173922items.jpg', ' sdsdgfdgfdgfg', 1, '2021-10-14 07:12:02', 0, '0000-00-00 00:00:00'),
(17, 'sacdsvsvsv', '3456', '4', 0, 0, 8, 1, 'public/image/1634174068items.jpg', ' asdasdsad', 1, '2021-10-14 07:14:28', 0, '0000-00-00 00:00:00'),
(18, 'sacdsvsvsvsfdfdsg', '3456', '4', 1, 0, 8, 1, 'public/image/1634174125items.jpg', ' asdasdsad', 1, '2021-10-14 07:15:25', 0, '2021-10-14 07:51:10'),
(19, 'asafdgfhgfhgjhgj', '3456', '4', 1, 0, 8, 1, 'public/image/1634174466items.jpg', ' asdasdsad', 1, '2021-10-14 07:21:06', 0, '0000-00-00 00:00:00'),
(20, 'zxvcxbvrewerqwrew', '450', '4', 1, 1, 8, 1, 'public/image/1634174502items.jpg', ' dfdgfhgfh', 1, '2021-10-14 07:21:42', 0, '2021-10-14 07:51:14'),
(21, 'xzcx', '450', '5', 1, 1, 8, 1, 'public/image/1634174610items.jpg', ' fsdfdsfsdf', 1, '2021-10-14 07:23:30', 0, '0000-00-00 00:00:00'),
(22, 'zxcxcfgfgfg', '4500', '5', 1, 1, 8, 1, 'public/image/1634174712items.jpg', ' cxvvcbvcb', 1, '2021-10-14 07:25:12', 0, '0000-00-00 00:00:00'),
(23, 'zxcxvdfg', '543', '4', 1, 1, 8, 1, 'public/image/1634174754items.jpg', ' assdasdsad', 1, '2021-10-14 07:25:54', 0, '0000-00-00 00:00:00'),
(24, 'ddsfsd', '456', '4', 1, 1, 8, 1, 'public/image/1634174870items.jpg', ' zdsfsdgdfdsf', 1, '2021-10-14 07:27:50', 0, '0000-00-00 00:00:00'),
(25, 'final test', '230', '34', 1, 1, 8, 1, 'public/image/1634174961items.jpg', ' safsdfdsg we ertre trtert we tryw rtyewr ewyrytreyewt erhrthtretertrytr yeywryewy wywryrtrhgfhsertrtryterte', 1, '2021-10-14 07:29:21', 0, '2021-10-16 09:25:01'),
(26, 'final test1', '3808', '4', 1, 1, 8, 1, 'public/image/1634175100items.jpg', ' dsfsdfdg', 1, '2021-10-14 07:31:40', 0, '0000-00-00 00:00:00'),
(27, 'zdsadvddfg', '467', '5', 1, 1, 8, 1, 'public/image/1634175214items.jpg', ' xzvvdsf', 1, '2021-10-14 07:33:34', 0, '0000-00-00 00:00:00'),
(28, 'xzcxvcxv', '456', '2', 1, 1, 8, 1, 'public/image/1634175756items.jpg', ' fsdfdsfdsgdfg', 1, '2021-10-14 07:42:36', 0, '0000-00-00 00:00:00'),
(29, 'sdafds345', '300', '56', 0, 0, 4, 2, 'public/image/1634347836items.jpg', 'asfsdfdsf ssfdf', 1, '2021-10-14 07:46:10', 1, '2021-10-16 09:58:37'),
(30, 'Pasta pasta', '350', '1', 1, 1, 15, 3, 'public/image/1636907058items.jpg', 'some test', 15, '2021-11-14 22:24:18', 15, '2021-11-14 22:25:10'),
(31, 'Thai Chicken Grill', '320', '1', 1, 1, 16, 4, 'public/image/1641998136items.jpg', 'delicious', 1, '2022-01-12 20:35:36', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `Id` int(11) NOT NULL,
  `FoodItemId` int(11) NOT NULL,
  `PhotoUrl` varchar(255) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`Id`, `FoodItemId`, `PhotoUrl`, `CreatedDate`, `CreatedBy`) VALUES
(1, 14, 'public/image/1634173580items.jpg', '2021-10-14 07:06:20', 1),
(2, 14, 'public/image/1634173580items.jpg', '2021-10-14 07:06:20', 1),
(3, 14, 'public/image/1634173580items.jpg', '2021-10-14 07:06:20', 1),
(4, 14, 'public/image/1634173580items.jpg', '2021-10-14 07:06:20', 1),
(5, 14, 'public/image/1634173580items.jpg', '2021-10-14 07:06:20', 1),
(6, 15, 'public/image/1634173922items.jpg', '2021-10-14 07:12:02', 1),
(7, 15, 'public/image/1634173922items.jpg', '2021-10-14 07:12:02', 1),
(8, 15, 'public/image/1634173922items.jpg', '2021-10-14 07:12:02', 1),
(9, 15, 'public/image/1634173922items.jpg', '2021-10-14 07:12:02', 1),
(10, 15, 'public/image/1634173922items.jpg', '2021-10-14 07:12:02', 1),
(11, 17, 'public/image/1634174068items.jpg', '2021-10-14 07:14:28', 1),
(12, 17, 'public/image/1634174068items.jpg', '2021-10-14 07:14:28', 1),
(13, 17, 'public/image/1634174068items.jpg', '2021-10-14 07:14:28', 1),
(14, 17, 'public/image/1634174068items.jpg', '2021-10-14 07:14:28', 1),
(15, 17, 'public/image/1634174068items.jpg', '2021-10-14 07:14:28', 1),
(16, 18, 'public/image/1634174125items.jpg', '2021-10-14 07:15:25', 1),
(17, 18, 'public/image/1634174125items.jpg', '2021-10-14 07:15:25', 1),
(18, 18, 'public/image/1634174125items.jpg', '2021-10-14 07:15:25', 1),
(19, 18, 'public/image/1634174125items.jpg', '2021-10-14 07:15:25', 1),
(20, 18, 'public/image/1634174125items.jpg', '2021-10-14 07:15:25', 1),
(21, 24, 'public/image/1634174871items_f_3.jpg', '2021-10-14 07:27:51', 1),
(22, 24, 'public/image/1634174872items_f_2.jpg', '2021-10-14 07:27:52', 1),
(23, 24, 'public/image/1634174873items_f_1.jpg', '2021-10-14 07:27:53', 1),
(24, 25, 'public/image/1634174961items.jpg', '2021-10-14 07:29:21', 1),
(25, 25, 'public/image/1634174962items.jpg', '2021-10-14 07:29:22', 1),
(26, 25, 'public/image/1634174963items.jpg', '2021-10-14 07:29:23', 1),
(27, 25, 'public/image/1634174964items.jpg', '2021-10-14 07:29:24', 1),
(28, 25, 'public/image/1634174965items.jpg', '2021-10-14 07:29:25', 1),
(29, 26, 'public/image/1634175100items.jpg', '2021-10-14 07:31:40', 1),
(30, 26, 'public/image/1634175101items.jpg', '2021-10-14 07:31:41', 1),
(31, 26, 'public/image/1634175102items.jpg', '2021-10-14 07:31:42', 1),
(32, 26, 'public/image/1634175103items.jpg', '2021-10-14 07:31:43', 1),
(33, 26, 'public/image/1634175104items.jpg', '2021-10-14 07:31:44', 1),
(34, 27, 'public/image/1634175214items.jpg', '2021-10-14 07:33:34', 1),
(35, 27, 'public/image/1634175215items.jpg', '2021-10-14 07:33:35', 1),
(36, 27, 'public/image/1634175216items.jpg', '2021-10-14 07:33:36', 1),
(37, 27, 'public/image/1634175217items.jpg', '2021-10-14 07:33:37', 1),
(38, 27, 'public/image/1634175218items.jpg', '2021-10-14 07:33:38', 1),
(39, 28, 'public/image/20211014074236items.jpg', '2021-10-14 07:42:36', 1),
(40, 28, 'public/image/20211014074237items.jpg', '2021-10-14 07:42:37', 1),
(41, 28, 'public/image/20211014074238items.jpg', '2021-10-14 07:42:38', 1),
(42, 28, 'public/image/20211014074239items.jpg', '2021-10-14 07:42:39', 1),
(43, 28, 'public/image/20211014074240items.jpg', '2021-10-14 07:42:40', 1),
(50, 29, 'public/image/20211016095837items.jpg', '2021-10-16 09:58:37', 1),
(51, 29, 'public/image/20211016095838items.jpg', '2021-10-16 09:58:38', 1),
(52, 29, 'public/image/20211016095840items.jpg', '2021-10-16 09:58:40', 1),
(53, 29, 'public/image/20211016095841items.jpg', '2021-10-16 09:58:41', 1),
(58, 30, 'public/image/20211114222510items.', '2021-11-14 22:25:10', 15),
(59, 31, 'public/image/20220112203537items.jpg', '2022-01-12 20:35:37', 1),
(60, 31, 'public/image/20220112203538items.jpg', '2022-01-12 20:35:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invocedetail`
--

CREATE TABLE `invocedetail` (
  `Id` int(11) NOT NULL,
  `InvoiceId` int(11) NOT NULL,
  `InvoiceNumber` varchar(255) DEFAULT NULL,
  `FoodItemId` int(11) NOT NULL,
  `UnitPrice` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Discount` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invocedetail`
--

INSERT INTO `invocedetail` (`Id`, `InvoiceId`, `InvoiceNumber`, `FoodItemId`, `UnitPrice`, `Quantity`, `Discount`, `Price`, `CreatedDate`) VALUES
(1, 1, 'INV-000001', 28, 456, 2, 2, 894, '2022-02-21 22:16:19'),
(2, 1, 'INV-000001', 30, 350, 3, 1, 1039, '2022-02-21 22:16:19'),
(3, 1, 'INV-000001', 25, 230, 1, 34, 152, '2022-02-21 22:16:19');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `Id` int(11) NOT NULL,
  `InvoiceNumber` varchar(30) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `Phone` text DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `DeliveryManId` int(11) DEFAULT NULL,
  `OrderDate` date NOT NULL,
  `DeliveryDate` date NOT NULL,
  `OrderTakenDate` date NOT NULL,
  `SubTotal` double NOT NULL,
  `GrandTotal` double NOT NULL,
  `Discount` double NOT NULL,
  `DeliveryCharge` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) NOT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`Id`, `InvoiceNumber`, `CustomerId`, `Phone`, `Address`, `DeliveryManId`, `OrderDate`, `DeliveryDate`, `OrderTakenDate`, `SubTotal`, `GrandTotal`, `Discount`, `DeliveryCharge`, `Status`, `Remarks`, `CreatedDate`, `CreatedBy`, `UpdatedDate`, `UpdatedBy`) VALUES
(1, 'INV-000001', 11, '8802434545', 'new address', NULL, '0000-00-00', '2022-02-22', '0000-00-00', 2192, 2085, 0, 60, 'Pending', 'Initialy Order Place', '2022-02-21 22:16:19', 2022, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoicehistory`
--

CREATE TABLE `invoicehistory` (
  `Id` int(11) NOT NULL,
  `InvoiceId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Remarks` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoicehistory`
--

INSERT INTO `invoicehistory` (`Id`, `InvoiceId`, `UserId`, `Status`, `Remarks`, `CreatedDate`) VALUES
(1, 1, 11, 1, 0, '2022-02-21 22:16:19');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `Id` int(11) NOT NULL,
  `RoleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`Id`, `RoleName`) VALUES
(1, 'Admin'),
(2, 'DeliveryMan');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `FoodItemId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdatedBy` int(11) DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Code` varchar(255) NOT NULL,
  `IsActive` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) NOT NULL,
  `UpdatedDate` datetime NOT NULL,
  `UpdatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`Id`, `Name`, `Code`, `IsActive`, `CreatedDate`, `CreatedBy`, `UpdatedDate`, `UpdatedBy`) VALUES
(1, 'Soup1', 'sop-0010', 1, '2021-10-13 08:11:37', 1, '2021-10-13 13:54:33', 1),
(2, 'Soup 23', '4ffgcc', 1, '2021-10-13 08:12:06', 1, '2021-10-16 06:57:59', 1),
(3, 'Spicy pasta', 'sp-003545', 1, '2021-11-14 22:20:11', 15, '0000-00-00 00:00:00', 0),
(4, 'Chicken Grill', 'CHK-001', 1, '2022-01-12 20:34:35', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` text NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Address` text NOT NULL,
  `RoleName` varchar(255) NOT NULL,
  `IsActive` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) NOT NULL,
  `UpdatedBy` int(11) NOT NULL,
  `UpdatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Name`, `Email`, `Password`, `Phone`, `Address`, `RoleName`, `IsActive`, `CreatedDate`, `CreatedBy`, `UpdatedBy`, `UpdatedDate`) VALUES
(1, 'Super Admin', 'superadmin@gmail.com', 'b715f831f1fee468d6b1760226035b29', '01343454664', '', 'SuperAdmin', 1, '2021-10-11 16:25:35', 0, 1, '2021-10-30 21:55:49'),
(2, 'Delivery Man 1', 'deliveryman1@gmail.com', '202cb962ac59075b964b07152d234b70', '013434546645656', '', 'DeliveryMan', 0, '2021-10-19 08:39:47', 1, 1, '2021-10-27 10:58:10'),
(3, 'Delivery Man 2', 'deliveryman2@gmail.com', '202cb962ac59075b964b07152d234b70', '01343435466', '', 'DeliveryMan', 1, '2021-10-19 08:47:43', 1, 0, '0000-00-00 00:00:00'),
(4, 'Delivery Man 3', 'deliveryman3@gmail.com', '202cb962ac59075b964b07152d234b70', '0134343445', '', 'DeliveryMan', 1, '2021-10-19 08:54:05', 1, 0, '0000-00-00 00:00:00'),
(6, 'Delivery Man 4', 'deliveryman4@gmail.com', '202cb962ac59075b964b07152d234b70', '01334345466', '', 'DeliveryMan', 1, '2021-10-23 07:34:44', 1, 0, '0000-00-00 00:00:00'),
(7, 'admin1', 'admin1@gmail.com', '202cb962ac59075b964b07152d234b70', '013356754', '', 'Admin', 1, '2021-10-25 16:56:31', 1, 0, '0000-00-00 00:00:00'),
(8, 'admin2', 'admin2@gmail.com', '202cb962ac59075b964b07152d234b70', '117867686879', '', 'Admin', 1, '2021-10-25 17:05:08', 1, 0, '0000-00-00 00:00:00'),
(9, 'admin3', 'admin3@gmail.com', '202cb962ac59075b964b07152d234b70', '544654654', '', 'Admin', 1, '2021-10-26 09:02:33', 1, 0, '0000-00-00 00:00:00'),
(10, 'customer1', 'customer1@gmail.com', '202cb962ac59075b964b07152d234b70', '012345', 'some address', 'Customer', 1, '2021-10-27 11:41:49', 1, 0, '0000-00-00 00:00:00'),
(11, 'customer2', 'customer2@gmail.com', '202cb962ac59075b964b07152d234b70', '012345', 'some address', 'Customer', 1, '2021-10-27 11:41:49', 1, 0, '0000-00-00 00:00:00'),
(12, 'customer3', 'customer3@gmail.com', '202cb962ac59075b964b07152d234b70', '012345', 'some address', 'Customer', 1, '2021-10-27 11:41:49', 1, 0, '0000-00-00 00:00:00'),
(13, 'customer4', 'customer4@gmail.com', '202cb962ac59075b964b07152d234b70', '012345', 'some address', 'Customer', 1, '2021-10-27 11:41:49', 1, 0, '0000-00-00 00:00:00'),
(14, 'customer5', 'customer5@gmail.com', '202cb962ac59075b964b07152d234b70', '012345', 'some address', 'Customer', 1, '2021-10-27 11:41:49', 1, 0, '0000-00-00 00:00:00'),
(15, 'Konica', 'konica@gmail.com', '202cb962ac59075b964b07152d234b70', '325446', '', 'Admin', 1, '2021-11-14 22:15:20', 1, 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Code` (`Code`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `fooditem`
--
ALTER TABLE `fooditem`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `invocedetail`
--
ALTER TABLE `invocedetail`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `invoicehistory`
--
ALTER TABLE `invoicehistory`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `EMAIL` (`Email`),
  ADD UNIQUE KEY `Email_2` (`Email`),
  ADD UNIQUE KEY `Email_3` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fooditem`
--
ALTER TABLE `fooditem`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `invocedetail`
--
ALTER TABLE `invocedetail`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
