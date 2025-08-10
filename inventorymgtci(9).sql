-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2025 at 07:51 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventorymgtci`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `account_code` varchar(20) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `category` enum('Asset','Liability','Equity','Revenue','Expense','Cost of Goods Sold') NOT NULL,
  `normal_balance` enum('Debit','Credit') NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_code`, `account_name`, `category`, `normal_balance`, `active`, `created_at`) VALUES
(1, '1000', 'Cash', 'Asset', 'Debit', 1, '2025-07-25 07:29:27'),
(2, '1010', 'Bank', 'Asset', 'Debit', 1, '2025-07-25 07:29:27'),
(3, '1100', 'Accounts Receivable', 'Asset', 'Debit', 1, '2025-07-25 07:29:27'),
(4, '1200', 'Inventory', 'Asset', 'Debit', 1, '2025-07-25 07:29:27'),
(5, '1300', 'Prepaid Expenses', 'Asset', 'Debit', 1, '2025-07-25 07:29:27'),
(6, '2000', 'Accounts Payable', 'Liability', 'Credit', 1, '2025-07-25 07:29:27'),
(7, '2100', 'Accrued Expenses', 'Liability', 'Credit', 1, '2025-07-25 07:29:27'),
(8, '2200', 'VAT Payable', 'Liability', 'Credit', 1, '2025-07-25 07:29:27'),
(9, '3000', 'Owner\'s Capital', 'Equity', 'Credit', 1, '2025-07-25 07:29:27'),
(10, '3100', 'Retained Earnings', 'Equity', 'Credit', 1, '2025-07-25 07:29:27'),
(11, '4000', 'Sales Revenue', 'Revenue', 'Credit', 1, '2025-07-25 07:29:27'),
(12, '4100', 'Service Revenue', 'Revenue', 'Credit', 1, '2025-07-25 07:29:27'),
(13, '4200', 'Other Income', 'Revenue', 'Credit', 1, '2025-07-25 07:29:27'),
(14, '5000', 'Cost of Goods Sold', 'Cost of Goods Sold', 'Debit', 1, '2025-07-25 07:29:27'),
(15, '6000', 'Rent Expense', 'Expense', 'Debit', 1, '2025-07-25 07:29:27'),
(16, '6100', 'Utilities Expense', 'Expense', 'Debit', 1, '2025-07-25 07:29:27'),
(17, '6200', 'Salaries Expense', 'Expense', 'Debit', 1, '2025-07-25 07:29:27'),
(18, '6300', 'Office Supplies Expense', 'Expense', 'Debit', 1, '2025-07-25 07:29:27'),
(19, '6400', 'Advertising Expense', 'Expense', 'Debit', 1, '2025-07-25 07:29:27'),
(20, '6500', 'Depreciation Expense', 'Expense', 'Debit', 1, '2025-07-25 07:29:27');

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `details` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `activity`, `details`, `created_at`) VALUES
(1, 15, 'Created Order', 'Order ID: 16', '2025-05-12 14:52:04'),
(2, 1, 'Created Order', 'Order ID: 17', '2025-05-19 14:56:01'),
(3, 15, 'Created Order', 'Order ID: 18', '2025-05-19 15:36:07'),
(4, 15, 'Created Order', 'Order ID: 19', '2025-05-19 16:06:30'),
(5, 15, 'Created Order', 'Order ID: 20', '2025-05-19 16:11:45'),
(6, 1, 'Created Order', 'Order ID: 21', '2025-05-19 17:19:29'),
(7, 16, 'Created Order', 'Order ID: 22', '2025-05-19 18:06:36'),
(8, 16, 'Created Order', 'Order ID: 23', '2025-05-20 08:23:26'),
(9, 16, 'Created Order', 'Order ID: 24', '2025-05-20 09:25:32'),
(10, 16, 'Created Order', 'Order ID: 25', '2025-05-20 09:32:35'),
(11, 16, 'Created Order', 'Order ID: 26', '2025-05-20 09:41:29'),
(12, 16, 'Created Order', 'Order ID: 27', '2025-05-20 09:55:49'),
(13, 16, 'Created Order', 'Order ID: 28', '2025-05-20 10:07:51'),
(14, 16, 'Created Order', 'Order ID: 29', '2025-05-20 10:40:28'),
(15, 16, 'Created Order', 'Order ID: 30', '2025-05-20 10:56:39'),
(16, 16, 'Created Order', 'Order ID: 31', '2025-05-20 11:42:52'),
(17, 16, 'Created Order', 'Order ID: 32', '2025-05-20 12:09:03'),
(18, 16, 'Created Order', 'Order ID: 33', '2025-05-20 12:55:00'),
(19, 16, 'Created Order', 'Order ID: 34', '2025-05-20 13:09:39'),
(20, 16, 'Created Order', 'Order ID: 35', '2025-05-20 13:16:27'),
(21, 16, 'Created Order', 'Order ID: 36', '2025-05-20 13:23:52'),
(22, 16, 'Created Order', 'Order ID: 37', '2025-05-20 13:44:21'),
(23, 16, 'Created Order', 'Order ID: 38', '2025-05-20 13:55:38'),
(24, 16, 'Created Order', 'Order ID: 39', '2025-05-20 14:06:44'),
(25, 16, 'Created Order', 'Order ID: 40', '2025-05-20 14:25:38'),
(26, 16, 'Created Order', 'Order ID: 41', '2025-05-20 14:26:40'),
(27, 16, 'Created Order', 'Order ID: 42', '2025-05-20 14:30:37'),
(28, 16, 'Created Order', 'Order ID: 43', '2025-05-20 14:45:53'),
(29, 16, 'Created Order', 'Order ID: 44', '2025-05-20 15:46:54'),
(30, 16, 'Created Order', 'Order ID: 45', '2025-05-20 15:57:03'),
(31, 16, 'Created Order', 'Order ID: 46', '2025-05-20 16:11:57'),
(32, 16, 'Created Order', 'Order ID: 47', '2025-05-20 16:15:17'),
(33, 16, 'Created Order', 'Order ID: 48', '2025-05-20 16:37:03'),
(34, 16, 'Created Order', 'Order ID: 49', '2025-05-20 16:39:12'),
(35, 16, 'Created Order', 'Order ID: 50', '2025-05-20 16:43:18'),
(36, 16, 'Created Order', 'Order ID: 51', '2025-05-20 16:59:18'),
(37, 16, 'Created Order', 'Order ID: 52', '2025-05-20 17:24:42'),
(38, 16, 'Created Order', 'Order ID: 53', '2025-05-20 17:39:10'),
(39, 16, 'Created Order', 'Order ID: 54', '2025-05-20 17:53:59'),
(40, 15, 'Created Order', 'Order ID: 55', '2025-05-21 08:22:24'),
(41, 15, 'Created Order', 'Order ID: 56', '2025-05-21 09:13:34'),
(42, 15, 'Created Order', 'Order ID: 57', '2025-05-21 09:43:21'),
(43, 15, 'Created Order', 'Order ID: 58', '2025-05-21 10:18:41'),
(44, 15, 'Created Order', 'Order ID: 59', '2025-05-21 10:32:28'),
(45, 15, 'Created Order', 'Order ID: 60', '2025-05-21 10:55:39'),
(46, 15, 'Created Order', 'Order ID: 61', '2025-05-21 11:07:06'),
(47, 15, 'Created Order', 'Order ID: 62', '2025-05-21 11:20:46'),
(48, 15, 'Created Order', 'Order ID: 63', '2025-05-21 11:41:35'),
(49, 15, 'Created Order', 'Order ID: 64', '2025-05-21 11:46:02'),
(50, 15, 'Created Order', 'Order ID: 65', '2025-05-21 12:42:16'),
(51, 15, 'Created Order', 'Order ID: 66', '2025-05-21 12:44:09'),
(52, 15, 'Created Order', 'Order ID: 67', '2025-05-21 12:57:17'),
(53, 15, 'Created Order', 'Order ID: 68', '2025-05-21 13:31:26'),
(54, 15, 'Created Order', 'Order ID: 69', '2025-05-21 13:41:16'),
(55, 15, 'Created Order', 'Order ID: 70', '2025-05-21 13:44:12'),
(56, 15, 'Created Order', 'Order ID: 71', '2025-05-21 14:18:51'),
(57, 15, 'Created Order', 'Order ID: 72', '2025-05-21 15:15:26'),
(58, 15, 'Created Order', 'Order ID: 73', '2025-05-21 15:59:13'),
(59, 15, 'Created Order', 'Order ID: 74', '2025-05-21 16:13:47'),
(60, 15, 'Created Order', 'Order ID: 75', '2025-05-21 16:35:24'),
(61, 15, 'Created Order', 'Order ID: 76', '2025-05-21 18:19:17'),
(62, 15, 'Created Order', 'Order ID: 77', '2025-05-22 08:10:16'),
(63, 15, 'Created Order', 'Order ID: 78', '2025-05-22 09:30:52'),
(64, 15, 'Created Order', 'Order ID: 79', '2025-05-22 10:01:29'),
(65, 15, 'Created Order', 'Order ID: 80', '2025-05-22 10:32:44'),
(66, 15, 'Created Order', 'Order ID: 81', '2025-05-22 11:03:04'),
(67, 15, 'Created Order', 'Order ID: 82', '2025-05-22 11:19:49'),
(68, 19, 'Created Order', 'Order ID: 83', '2025-05-22 11:56:49'),
(69, 19, 'Created Order', 'Order ID: 84', '2025-05-22 12:14:43'),
(70, 19, 'Created Order', 'Order ID: 85', '2025-05-22 12:34:19'),
(71, 19, 'Created Order', 'Order ID: 86', '2025-05-22 12:41:36'),
(72, 19, 'Created Order', 'Order ID: 87', '2025-05-22 13:57:10'),
(73, 19, 'Created Order', 'Order ID: 88', '2025-05-22 14:25:50'),
(74, 19, 'Created Order', 'Order ID: 89', '2025-05-22 14:27:14'),
(75, 19, 'Created Order', 'Order ID: 90', '2025-05-22 14:52:08'),
(76, 19, 'Created Order', 'Order ID: 91', '2025-05-22 16:00:34'),
(77, 19, 'Created Order', 'Order ID: 92', '2025-05-22 16:11:24'),
(78, 19, 'Created Order', 'Order ID: 93', '2025-05-22 16:15:47'),
(79, 19, 'Created Order', 'Order ID: 94', '2025-05-22 16:55:53'),
(80, 19, 'Created Order', 'Order ID: 95', '2025-05-22 17:01:09'),
(81, 19, 'Created Order', 'Order ID: 96', '2025-05-22 17:36:16'),
(82, 19, 'Created Order', 'Order ID: 97', '2025-05-22 18:10:21'),
(83, 15, 'Created Order', 'Order ID: 98', '2025-05-23 09:36:00'),
(84, 15, 'Created Order', 'Order ID: 99', '2025-05-23 10:06:56'),
(85, 15, 'Created Order', 'Order ID: 100', '2025-05-23 10:25:14'),
(86, 15, 'Created Order', 'Order ID: 101', '2025-05-23 10:36:28'),
(87, 15, 'Created Order', 'Order ID: 102', '2025-05-23 11:10:35'),
(88, 15, 'Created Order', 'Order ID: 103', '2025-05-23 11:34:11'),
(89, 15, 'Created Order', 'Order ID: 104', '2025-05-23 11:38:39'),
(90, 15, 'Created Order', 'Order ID: 105', '2025-05-23 11:46:27'),
(91, 15, 'Created Order', 'Order ID: 106', '2025-05-23 11:53:51'),
(92, 15, 'Created Order', 'Order ID: 107', '2025-05-23 12:11:55'),
(93, 15, 'Created Order', 'Order ID: 108', '2025-05-23 12:12:30'),
(94, 15, 'Created Order', 'Order ID: 109', '2025-05-23 12:13:36'),
(95, 15, 'Created Order', 'Order ID: 110', '2025-05-23 12:46:07'),
(96, 15, 'Created Order', 'Order ID: 111', '2025-05-23 12:59:40'),
(97, 15, 'Created Order', 'Order ID: 112', '2025-05-23 14:02:15'),
(98, 15, 'Created Order', 'Order ID: 113', '2025-05-23 14:08:54'),
(99, 15, 'Created Order', 'Order ID: 114', '2025-05-23 14:17:50'),
(100, 15, 'Created Order', 'Order ID: 115', '2025-05-23 14:25:31'),
(101, 15, 'Created Order', 'Order ID: 116', '2025-05-23 14:35:56'),
(102, 15, 'Created Order', 'Order ID: 117', '2025-05-23 15:25:41'),
(103, 15, 'Created Order', 'Order ID: 118', '2025-05-23 16:29:52'),
(104, 15, 'Created Order', 'Order ID: 119', '2025-05-23 16:48:10'),
(105, 15, 'Created Order', 'Order ID: 120', '2025-05-23 16:50:47'),
(106, 15, 'Created Order', 'Order ID: 121', '2025-05-23 17:05:00'),
(107, 15, 'Created Order', 'Order ID: 122', '2025-05-23 17:30:15'),
(108, 15, 'Created Order', 'Order ID: 123', '2025-05-23 18:00:21'),
(109, 15, 'Created Order', 'Order ID: 124', '2025-05-23 18:24:13'),
(110, 15, 'Created Order', 'Order ID: 125', '2025-05-23 18:26:35'),
(111, 15, 'Created Order', 'Order ID: 126', '2025-05-23 18:36:45'),
(112, 15, 'Created Order', 'Order ID: 127', '2025-05-25 08:57:51'),
(113, 15, 'Created Order', 'Order ID: 128', '2025-05-25 09:16:32'),
(114, 15, 'Created Order', 'Order ID: 129', '2025-05-25 10:58:13'),
(115, 15, 'Created Order', 'Order ID: 130', '2025-05-25 12:53:52'),
(116, 15, 'Created Order', 'Order ID: 131', '2025-05-26 11:11:16'),
(117, 15, 'Created Order', 'Order ID: 132', '2025-05-26 13:04:36'),
(118, 15, 'Created Order', 'Order ID: 133', '2025-05-26 13:25:21'),
(119, 15, 'Created Order', 'Order ID: 134', '2025-05-26 14:01:37'),
(120, 15, 'Created Order', 'Order ID: 135', '2025-05-26 14:07:30'),
(121, 15, 'Created Order', 'Order ID: 136', '2025-05-26 14:46:41'),
(122, 15, 'Created Order', 'Order ID: 137', '2025-05-26 15:12:47'),
(123, 15, 'Created Order', 'Order ID: 138', '2025-05-26 15:15:59'),
(124, 15, 'Created Order', 'Order ID: 139', '2025-05-26 15:55:12'),
(125, 15, 'Created Order', 'Order ID: 140', '2025-05-26 17:48:52'),
(126, 15, 'Created Order', 'Order ID: 141', '2025-05-28 09:16:44'),
(127, 15, 'Created Order', 'Order ID: 142', '2025-05-28 09:47:44'),
(128, 15, 'Created Order', 'Order ID: 143', '2025-05-28 09:47:44'),
(129, 15, 'Created Order', 'Order ID: 144', '2025-05-28 09:54:01'),
(130, 15, 'Created Order', 'Order ID: 145', '2025-05-28 10:18:18'),
(131, 15, 'Created Order', 'Order ID: 146', '2025-05-28 10:18:49'),
(132, 15, 'Created Order', 'Order ID: 147', '2025-05-28 10:26:32'),
(133, 15, 'Created Order', 'Order ID: 148', '2025-05-28 11:06:44'),
(134, 15, 'Created Order', 'Order ID: 149', '2025-05-28 11:07:53'),
(135, 15, 'Created Order', 'Order ID: 150', '2025-05-28 13:21:27'),
(136, 15, 'Created Order', 'Order ID: 151', '2025-05-28 13:45:17'),
(137, 15, 'Created Order', 'Order ID: 152', '2025-05-28 14:36:17'),
(138, 15, 'Created Order', 'Order ID: 153', '2025-05-28 15:15:38'),
(139, 15, 'Created Order', 'Order ID: 154', '2025-05-28 16:55:44'),
(140, 15, 'Created Order', 'Order ID: 155', '2025-05-29 09:47:30'),
(141, 15, 'Created Order', 'Order ID: 156', '2025-05-29 09:50:29'),
(142, 15, 'Created Order', 'Order ID: 157', '2025-05-29 10:06:14'),
(143, 15, 'Created Order', 'Order ID: 158', '2025-05-29 13:40:37'),
(144, 15, 'Created Order', 'Order ID: 159', '2025-05-29 13:42:31'),
(145, 15, 'Created Order', 'Order ID: 160', '2025-05-29 15:35:01'),
(146, 15, 'Created Order', 'Order ID: 161', '2025-05-29 16:39:58'),
(147, 15, 'Created Order', 'Order ID: 162', '2025-05-29 19:34:30'),
(148, 15, 'Created Order', 'Order ID: 163', '2025-05-30 10:14:23'),
(149, 15, 'Created Order', 'Order ID: 164', '2025-05-30 10:20:10'),
(150, 15, 'Created Order', 'Order ID: 165', '2025-05-30 12:30:09'),
(151, 15, 'Created Order', 'Order ID: 166', '2025-05-30 12:40:00'),
(152, 15, 'Created Order', 'Order ID: 167', '2025-05-30 12:57:25'),
(153, 15, 'Created Order', 'Order ID: 168', '2025-05-30 14:08:04'),
(154, 15, 'Created Order', 'Order ID: 169', '2025-05-30 14:40:23'),
(155, 15, 'Created Order', 'Order ID: 170', '2025-05-30 14:50:43'),
(156, 15, 'Created Order', 'Order ID: 171', '2025-05-30 15:21:28'),
(157, 15, 'Created Order', 'Order ID: 172', '2025-05-30 17:18:02'),
(158, 19, 'Created Order', 'Order ID: 173', '2025-05-30 17:23:30'),
(159, 15, 'Created Order', 'Order ID: 174', '2025-06-02 09:50:56'),
(160, 15, 'Created Order', 'Order ID: 175', '2025-06-02 09:52:43'),
(161, 15, 'Created Order', 'Order ID: 176', '2025-06-02 11:21:04'),
(162, 15, 'Created Order', 'Order ID: 177', '2025-06-02 12:11:37'),
(163, 15, 'Created Order', 'Order ID: 178', '2025-06-02 12:23:01'),
(164, 15, 'Created Order', 'Order ID: 179', '2025-06-02 12:49:03'),
(165, 15, 'Created Order', 'Order ID: 180', '2025-06-02 12:56:29'),
(166, 15, 'Created Order', 'Order ID: 181', '2025-06-02 12:57:54'),
(167, 15, 'Created Order', 'Order ID: 182', '2025-06-02 14:54:16'),
(168, 15, 'Created Order', 'Order ID: 183', '2025-06-02 16:23:09'),
(169, 15, 'Created Order', 'Order ID: 184', '2025-06-03 10:23:46'),
(170, 15, 'Created Order', 'Order ID: 185', '2025-06-04 09:51:15'),
(171, 15, 'Created Order', 'Order ID: 186', '2025-06-04 11:45:14'),
(172, 15, 'Created Order', 'Order ID: 187', '2025-06-04 11:46:38'),
(173, 15, 'Created Order', 'Order ID: 188', '2025-06-04 12:13:19'),
(174, 15, 'Created Order', 'Order ID: 189', '2025-06-04 13:04:22'),
(175, 15, 'Created Order', 'Order ID: 190', '2025-06-04 15:50:23'),
(176, 15, 'Created Order', 'Order ID: 191', '2025-06-04 17:32:28'),
(177, 15, 'Created Order', 'Order ID: 192', '2025-06-05 09:12:04'),
(178, 15, 'Created Order', 'Order ID: 193', '2025-06-05 10:26:22'),
(179, 15, 'Created Order', 'Order ID: 194', '2025-06-05 16:10:39'),
(180, 15, 'Created Order', 'Order ID: 195', '2025-06-06 11:19:58'),
(181, 15, 'Created Order', 'Order ID: 196', '2025-06-06 11:48:03'),
(182, 15, 'Created Order', 'Order ID: 197', '2025-06-09 14:03:11'),
(183, 15, 'Created Order', 'Order ID: 198', '2025-06-12 12:32:55'),
(184, 15, 'Created Order', 'Order ID: 199', '2025-06-12 13:49:55'),
(185, 15, 'Created Order', 'Order ID: 200', '2025-06-18 12:23:00'),
(186, 15, 'Created Order', 'Order ID: 201', '2025-07-08 16:10:11'),
(187, 15, 'Created Order', 'Order ID: 202', '2025-07-08 17:05:13'),
(188, 15, 'Created Order', 'Order ID: 203', '2025-07-08 17:11:43'),
(189, 1, 'Created Order', 'Order ID: 204', '2025-07-14 08:34:01'),
(190, 1, 'Created Order', 'Order ID: 204', '2025-07-17 08:50:31'),
(191, 1, 'Created Order', 'Order ID: 205', '2025-07-17 08:55:15'),
(192, 1, 'Generated Quotation', 'Quotation ID: 10', '2025-07-17 16:08:53'),
(193, 1, 'Generated Quotation', 'Quotation ID: 11', '2025-07-17 16:55:42'),
(194, 1, 'Generated Quotation', 'Quotation ID: 12', '2025-07-17 17:23:38'),
(195, 1, 'Added Stock', 'Product ID: 74, Quantity: 12233, Type: PURCHASE', '2025-07-18 10:16:04'),
(196, 1, 'Added Stock', 'Product ID: 77, Quantity: 10000, Type: PURCHASE', '2025-07-21 08:02:04'),
(197, 1, 'Added Stock', 'Product ID: 77, Quantity: 20000, Type: PURCHASE', '2025-07-21 13:38:41'),
(198, 1, 'Added Stock', 'Product ID: 75, Quantity: 3200, Type: PURCHASE', '2025-07-21 13:40:25'),
(199, 1, 'Deleted Product', 'Product ID: 79', '2025-07-22 08:08:21'),
(200, 1, 'Deleted Product', 'Product ID: 80', '2025-07-22 08:08:25'),
(201, 1, 'Deleted Product', 'Product ID: 81', '2025-07-22 08:12:51'),
(202, 1, 'Deleted Product', 'Product ID: 82', '2025-07-22 09:06:47'),
(203, 1, 'Generated Quotation', 'Quotation ID: 14', '2025-07-22 11:26:52'),
(204, 1, 'Deleted Product', 'Product ID: 79', '2025-07-23 07:38:10'),
(205, 1, 'Deleted Product', 'Product ID: 80', '2025-07-23 08:16:27'),
(206, 1, 'Deleted Product', 'Product ID: 78', '2025-07-23 08:16:32'),
(207, 1, 'Deleted Purchase', 'Purchase ID: 5', '2025-07-23 08:30:47'),
(208, 1, 'Deleted Product', 'Product ID: 81', '2025-07-23 08:31:23'),
(209, 1, 'Created Order', 'Order ID: Array', '2025-07-23 09:43:08'),
(210, 1, 'Created Order', 'Order ID: Array', '2025-07-23 10:03:40'),
(211, 1, 'Created Order', 'Order ID: Array', '2025-07-23 10:05:40'),
(212, 1, 'Created Order', 'Order ID: 0', '2025-07-23 15:00:34'),
(213, 1, 'Created Order', 'Order ID: 0', '2025-07-23 15:23:27'),
(214, 1, 'Created Order', 'Order ID: 0', '2025-07-23 15:27:29'),
(215, 1, 'Created Order', 'Order ID: 0', '2025-07-23 15:35:20'),
(216, 1, 'Created Order', 'Order ID: 0', '2025-07-23 15:38:32'),
(217, 1, 'Created Order', 'Order ID: 0', '2025-07-23 15:45:02'),
(218, 1, 'Created Order', 'Order ID: 0', '2025-07-23 15:46:47'),
(219, 1, 'Created Order', 'Order ID: 0', '2025-07-23 15:49:08'),
(220, 1, 'Created Order', 'Order ID: 0', '2025-07-23 15:54:47'),
(221, 1, 'Created Order', 'Order ID: 214', '2025-07-23 17:16:12'),
(222, 1, 'Deleted Product', 'Product ID: 78', '2025-07-24 13:47:20'),
(223, 1, 'Deleted Purchase', 'Purchase ID: 4', '2025-07-24 15:17:06'),
(224, 1, 'Deleted Purchase', 'Purchase ID: 6', '2025-07-29 10:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_value`
--

CREATE TABLE `attribute_value` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `attribute_parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attribute_value`
--

INSERT INTO `attribute_value` (`id`, `value`, `attribute_parent_id`) VALUES
(5, 'Blue', 2),
(6, 'White', 2),
(7, 'M', 3),
(8, 'L', 3),
(9, 'Green', 2),
(10, 'Black', 2),
(12, 'Grey', 2),
(13, 'S', 3),
(17, 'yellow', 4),
(20, 'Small', 6),
(21, 'Medium', 6),
(22, 'Large', 6),
(23, 'Black', 4),
(24, 'Maroon', 4),
(25, 'Red', 4),
(26, 'Blue', 4),
(27, 'Navy', 4),
(28, 'Pearl White', 4),
(29, 'Phantom Black', 4),
(30, 'Gray', 4),
(31, 'XL', 6),
(32, 'XXL', 6),
(33, 'XXXL', 6),
(34, 'Free Size', 6),
(35, 'None', 6),
(36, 'Pink', 4);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `active`) VALUES
(1, 'Generic', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cash_accounts`
--

CREATE TABLE `cash_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `balance` decimal(15,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `active`) VALUES
(14, 'Company product', 1),
(15, 'Outsource', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('Asset','Liability','Equity','Income','Expense') NOT NULL,
  `parent_account_id` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `registration` int(11) NOT NULL,
  `tin` varchar(11) NOT NULL,
  `service_charge_value` varchar(255) NOT NULL,
  `vat_charge_value` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `logo`, `image`, `registration`, `tin`, `service_charge_value`, `vat_charge_value`, `address`, `phone`, `country`, `message`, `currency`) VALUES
(1, 'JEMAU INVESTMENT COMPANY LIMITED', 'a12ba40d9f1e7829852a943e9f94a365.png', '426985ffca26297a562d1355f00130dc.png', 186766911, '186-766-911', '0', '0', 'NMC,Industrial Area, Arusha', '0768100089', 'Tanzania', 'You\'re our priority', 'TZS');

-- --------------------------------------------------------

--
-- Table structure for table `company_expenses`
--

CREATE TABLE `company_expenses` (
  `id` int(11) NOT NULL,
  `expense_date` date NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_expenses`
--

INSERT INTO `company_expenses` (`id`, `expense_date`, `amount`, `description`, `category`, `user_id`) VALUES
(4, '2025-07-19', '20000.00', 'ufagio', 'Office Supplies', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_invoices`
--

CREATE TABLE `customer_invoices` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `status` varchar(20) DEFAULT 'Unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_payments`
--

CREATE TABLE `customer_payments` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `date` date NOT NULL,
  `method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permission`) VALUES
(1, 'Administrator', 'a:40:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:11:\"createBrand\";i:9;s:11:\"updateBrand\";i:10;s:9:\"viewBrand\";i:11;s:11:\"deleteBrand\";i:12;s:14:\"createCategory\";i:13;s:14:\"updateCategory\";i:14;s:12:\"viewCategory\";i:15;s:14:\"deleteCategory\";i:16;s:11:\"createStore\";i:17;s:11:\"updateStore\";i:18;s:9:\"viewStore\";i:19;s:11:\"deleteStore\";i:20;s:15:\"createAttribute\";i:21;s:15:\"updateAttribute\";i:22;s:13:\"viewAttribute\";i:23;s:15:\"deleteAttribute\";i:24;s:13:\"createProduct\";i:25;s:13:\"updateProduct\";i:26;s:11:\"viewProduct\";i:27;s:13:\"deleteProduct\";i:28;s:11:\"createOrder\";i:29;s:11:\"updateOrder\";i:30;s:9:\"viewOrder\";i:31;s:11:\"deleteOrder\";i:32;s:13:\"updateCompany\";i:33;s:14:\"viewAccounting\";i:34;s:16:\"updateAccounting\";i:35;s:16:\"reportAccounting\";i:36;s:16:\"deleteAccounting\";i:37;s:11:\"viewReports\";i:38;s:11:\"viewProfile\";i:39;s:13:\"updateSetting\";}'),
(2, 'Manager', 'a:25:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:11:\"createGroup\";i:4;s:11:\"updateGroup\";i:5;s:9:\"viewGroup\";i:6;s:11:\"createBrand\";i:7;s:11:\"updateBrand\";i:8;s:9:\"viewBrand\";i:9;s:14:\"createCategory\";i:10;s:14:\"updateCategory\";i:11;s:12:\"viewCategory\";i:12;s:11:\"createStore\";i:13;s:11:\"updateStore\";i:14;s:9:\"viewStore\";i:15;s:15:\"createAttribute\";i:16;s:15:\"updateAttribute\";i:17;s:13:\"viewAttribute\";i:18;s:13:\"createProduct\";i:19;s:13:\"updateProduct\";i:20;s:11:\"viewProduct\";i:21;s:11:\"createOrder\";i:22;s:11:\"updateOrder\";i:23;s:9:\"viewOrder\";i:24;s:13:\"updateCompany\";}'),
(3, 'Clerck', 'a:10:{i:0;s:11:\"createBrand\";i:1;s:9:\"viewBrand\";i:2;s:14:\"updateCategory\";i:3;s:12:\"viewCategory\";i:4;s:9:\"viewStore\";i:5;s:13:\"viewAttribute\";i:6;s:13:\"createProduct\";i:7;s:11:\"viewProduct\";i:8;s:11:\"createOrder\";i:9;s:9:\"viewOrder\";}');

-- --------------------------------------------------------

--
-- Table structure for table `journal_entries`
--

CREATE TABLE `journal_entries` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `journal_lines`
--

CREATE TABLE `journal_lines` (
  `id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `debit` decimal(15,2) DEFAULT '0.00',
  `credit` decimal(15,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `date_time` timestamp NULL DEFAULT NULL,
  `gross_amount` varchar(255) NOT NULL,
  `service_charge_rate` varchar(255) NOT NULL,
  `service_charge` varchar(255) NOT NULL,
  `vat_charge_rate` varchar(255) NOT NULL,
  `vat_charge` varchar(255) NOT NULL,
  `net_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `paid_status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `store_id` text NOT NULL,
  `amount_paid` decimal(15,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `bill_no`, `customer_name`, `customer_address`, `customer_phone`, `date_time`, `gross_amount`, `service_charge_rate`, `service_charge`, `vat_charge_rate`, `vat_charge`, `net_amount`, `discount`, `paid_status`, `user_id`, `store_id`, `amount_paid`) VALUES
(1, 'BILPR-ED74', 'Nasara', 'Sinon', '0674162426', '2025-07-30 03:52:20', '580000', '0', '0', '0', '0', '580000', '0', 2, 1, '7', '0.00'),
(2, 'BILPR-996C', 'Might', 'sokon 1', '0743991025', '2025-07-30 04:22:38', '580000', '0', '0', '0', '0', '580000', '0', 1, 1, '7', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `orders_item`
--

CREATE TABLE `orders_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_item`
--

INSERT INTO `orders_item` (`id`, `order_id`, `product_id`, `qty`, `rate`, `amount`) VALUES
(1, 1, 20, 1000, '580', '580000'),
(2, 2, 20, 1000, '580', '580000');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `attribute_value_id` text,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `availability` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `unit`, `description`, `attribute_value_id`, `brand_id`, `category_id`, `image`, `store_id`, `availability`) VALUES
(20, 'Pumba', '580.00', 'Kg', '<p><i></i><i></i><br></p>', 'null', 0, 15, NULL, 7, 1),
(21, 'Pumba mchele ngumu', '240.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(22, 'Shudu ngumu', '850.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(23, 'Pollard', '750.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(24, 'Shudu laini', '1000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(25, 'Pamba ngumu', '1150.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(26, 'Pamba laini', '1300.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(27, 'Mahindi Paraza', '1000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(28, 'Ngano', '1000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(29, 'Uduvi', '3500.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(30, 'Hamira', '1500.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(31, 'Dagaa(Kauzu)', '2400.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(32, 'Makayebo', '1300.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(33, 'Makayebo waliosagwa', '2000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(34, 'Mfupa', '600.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(35, 'Konokono', '350.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(36, 'Chumvi', '500.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(37, 'Chokaa', '500.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(38, 'DCP ya kupima', '1500.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(39, 'Soya Unga', '1800.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(40, 'Soya Chenga', '2500.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(41, 'Layers', '1000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(42, 'Broiler starter', '1000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(43, 'Grower', '1000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(44, 'Finisher', '1000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(45, 'Broiler pellet starter', '2000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(46, 'Broiler pellet grower', '2000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(47, 'Chokaa jumla', '240.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(48, 'Pig grower', '1000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(49, 'Pig stater', '1000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(50, 'Wheat bran', '650.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(51, 'Damu', '1500.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(52, 'Maize', '690.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(53, 'Ubuyu', '670.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(54, 'Josera Maziwa', '11000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(55, 'Maziwa Mengi(super maclick)', '3000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(56, 'Broiler premix', '3000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(57, 'Layers premix', '3000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(58, 'Pig booster', '3000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(59, 'Josera ya kunenepesha', '11000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(60, 'Jiwe chumvi ya kulamba', '11000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(61, 'DCP kopo ndogo', '2000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(62, 'DCP kopo kubwa', '3000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(63, 'DCP ya chenga packet', '5000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(64, 'Ng\'ombe mix(keen)', '2500.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(65, 'Maziwa mengi(Tengeru)', '1500.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(66, 'Bale', '850.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(67, 'Cotton', '1200.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(68, 'Mifupa Ng\'ombe', '600.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(69, 'Pillet Stater', '2000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(70, 'Pillet Growers', '2000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(71, 'Karanga', '700.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(72, 'Mahindi', '780.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(73, 'Kaudes', '4000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(74, 'Dagaa waliosagwa', '2000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(75, 'MTAMA', '1000.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(76, 'pumba mchele laini', '400.00', 'Kg', '', 'null', 0, 15, NULL, 7, 1),
(77, 'maziwa', '1323.00', 'Kg', '', 'null', 0, 15, NULL, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `supplier_no` varchar(20) NOT NULL,
  `qty` int(200) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `amount_paid` decimal(10,2) DEFAULT '0.00',
  `status` varchar(100) NOT NULL,
  `purchase_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `product_id`, `supplier`, `supplier_no`, `qty`, `unit`, `price`, `total_amount`, `amount_paid`, `status`, `purchase_date`, `user_id`, `store_id`) VALUES
(7, 20, 'Hamis j Hamis', '', 10000, 'KG', '520.00', '5200000.00', '5200000.00', 'Paid', '2025-07-30 06:46:00', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int(11) NOT NULL,
  `quotation_no` varchar(20) NOT NULL COMMENT 'Unique quotation number, e.g., QUOT-XXXX',
  `customer_name` varchar(255) NOT NULL COMMENT 'Customer name for the quotation',
  `customer_address` text COMMENT 'Customer address, optional',
  `customer_phone` varchar(50) DEFAULT NULL COMMENT 'Customer phone number, optional',
  `date_time` int(11) NOT NULL COMMENT 'Unix timestamp for quotation creation date and time',
  `gross_amount` decimal(10,2) NOT NULL COMMENT 'Total amount before taxes and discounts',
  `service_charge_rate` decimal(5,2) DEFAULT '0.00' COMMENT 'Service charge percentage',
  `service_charge` decimal(10,2) DEFAULT '0.00' COMMENT 'Service charge amount',
  `vat_charge_rate` decimal(5,2) DEFAULT '0.00' COMMENT 'VAT percentage',
  `vat_charge` decimal(10,2) DEFAULT '0.00' COMMENT 'VAT amount',
  `discount` decimal(10,2) DEFAULT '0.00' COMMENT 'Discount amount',
  `net_amount` decimal(10,2) NOT NULL COMMENT 'Final amount after taxes and discounts',
  `user_id` int(11) NOT NULL COMMENT 'ID of the user who created the quotation',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Record creation timestamp',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record update timestamp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Stores quotation details';

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `quotation_no`, `customer_name`, `customer_address`, `customer_phone`, `date_time`, `gross_amount`, `service_charge_rate`, `service_charge`, `vat_charge_rate`, `vat_charge`, `discount`, `net_amount`, `user_id`, `created_at`, `updated_at`) VALUES
(11, 'QUOT-F7E4', 'Eze', 'sin', '0743991025', 1752760538, '2000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2000.00', 1, '2025-07-17 13:55:38', '2025-07-17 13:55:38'),
(12, 'QUOT-EF38', 'Mhando', 'sinon', '0743991025', 1752762215, '2000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2000.00', 1, '2025-07-17 14:23:35', '2025-07-17 14:23:35'),
(13, 'QUOT-607A', 'ert', 'uyg', '098765433', 1752834567, '1120.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1120.00', 1, '2025-07-18 10:29:27', '2025-07-18 10:29:27'),
(14, 'QUOT-4172', 'mhanf', 'sinon', '', 1753172808, '1323.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1323.00', 1, '2025-07-22 08:26:48', '2025-07-22 08:26:48');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_items`
--

CREATE TABLE `quotation_items` (
  `id` int(11) NOT NULL,
  `quotation_id` int(11) NOT NULL COMMENT 'Foreign key referencing quotations(id)',
  `product_id` int(11) NOT NULL COMMENT 'Foreign key referencing products(id)',
  `qty` int(11) NOT NULL COMMENT 'Quantity of the product',
  `price` decimal(10,2) NOT NULL COMMENT 'Price per unit of the product',
  `amount` decimal(10,2) NOT NULL COMMENT 'Total amount for the item (qty * price)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Stores individual items for each quotation';

--
-- Dumping data for table `quotation_items`
--

INSERT INTO `quotation_items` (`id`, `quotation_id`, `product_id`, `qty`, `price`, `amount`) VALUES
(12, 11, 74, 1, '2000.00', '2000.00'),
(13, 12, 74, 1, '2000.00', '2000.00'),
(14, 13, 77, 2, '560.00', '1120.00'),
(15, 14, 77, 1, '1323.00', '1323.00');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `active`) VALUES
(6, 'MAJENGO', 1),
(7, 'NMC', 1),
(8, 'ESSO', 1),
(9, 'NGULELO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_invoices`
--

CREATE TABLE `supplier_invoices` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `status` varchar(20) DEFAULT 'Unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payments`
--

CREATE TABLE `supplier_payments` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `date` date NOT NULL,
  `method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `phone`, `gender`, `store_id`) VALUES
(1, 'admin', '$2y$10$7rLSvRVyTQORapkDOqmkhetjF6H9lJHngr4hJMSM2lHObJbW5EQh6', 'admin@gmail.com', 'Liam', 'Moore', '7777777777', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(7, 6, 4),
(8, 7, 4),
(9, 8, 4),
(10, 9, 5),
(11, 10, 5),
(12, 11, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_code` (`account_code`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_expenses`
--
ALTER TABLE `company_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_items`
--
ALTER TABLE `quotation_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `company_expenses`
--
ALTER TABLE `company_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders_item`
--
ALTER TABLE `orders_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
