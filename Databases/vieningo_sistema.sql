-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 22, 2022 at 01:35 PM
-- Server version: 5.7.35-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vieningo_sistema`
--

-- --------------------------------------------------------

--
-- Table structure for table `Mokejimai`
--

CREATE TABLE `Mokejimai` (
  `id` bigint(20) NOT NULL,
  `naudotojo_id` bigint(20) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statusas` enum('Pateiktas','Priimtas','Atmestas') NOT NULL DEFAULT 'Pateiktas'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Mokejimai`
--

INSERT INTO `Mokejimai` (`id`, `naudotojo_id`, `data`, `statusas`) VALUES
(1, 277514461748, '2022-11-22 01:30:58', 'Priimtas'),
(4, 6635613424494870, '2022-11-22 02:21:20', 'Priimtas'),
(5, 25237475, '2022-11-22 03:19:08', 'Atmestas'),
(6, 25237475, '2022-11-22 03:39:18', 'Priimtas'),
(7, 317628998, '2022-11-22 06:51:16', 'Priimtas'),
(8, 2990273, '2022-11-22 09:38:51', 'Pateiktas');

-- --------------------------------------------------------

--
-- Table structure for table `Naudotojai`
--

CREATE TABLE `Naudotojai` (
  `id` bigint(20) NOT NULL,
  `vardas` varchar(20) NOT NULL,
  `pavarde` varchar(20) NOT NULL,
  `slaptazodis` varchar(100) NOT NULL,
  `regdata` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `epastas` varchar(100) NOT NULL,
  `aktyvus` tinyint(1) NOT NULL DEFAULT '0',
  `slapyvardis` varchar(40) NOT NULL,
  `naudotojo_id` bigint(20) NOT NULL,
  `role` enum('Klientas','Administratorius','Vadybininkas') NOT NULL DEFAULT 'Klientas',
  `ar_susimokejes` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Naudotojai`
--

INSERT INTO `Naudotojai` (`id`, `vardas`, `pavarde`, `slaptazodis`, `regdata`, `epastas`, `aktyvus`, `slapyvardis`, `naudotojo_id`, `role`, `ar_susimokejes`) VALUES
(3, 'Jonas', 'Jonaitis', '$2y$10$/jSAq4pQkK48KH4RIkw2Vu4iSKz3ROGfVKE5pgDiPCREyYGE5gVLm', '2022-10-24 11:29:23', 'jonaitis@gmail.com', 0, 'jonas123', 220270930588110926, 'Administratorius', 0),
(4, 'Zenius', 'Zeniauskas', '$2y$10$Ta5KEoOWw.xhY92hrDMVCuS9liuyrilJUaD.k56HuU4xSbSB8Goc2', '2022-10-24 11:32:05', 'zenius@gmail.com', 0, 'zenius123', 277514461748, 'Klientas', 1),
(5, 'Bronius', 'Broniauskas', '$2y$10$Q8h6m3jLiSG5bsG5AwqixOZrOZgZo9/Eup66MU9OaA.LS7hDSm52K', '2022-10-24 11:32:34', 'bronius@gmail.com', 0, 'bronius123', 4759998767, 'Vadybininkas', 0),
(6, 'Tomas', 'Tomauskas', '$2y$10$o1jXK/ZOHEvUHmfX2YP5GeWiR0Z93YS.JT99qKVYdqMCUU5BkvlyC', '2022-10-24 16:33:31', 'tomas@gmail.com', 0, 'tomas123', 6635613424494870, 'Klientas', 1),
(7, 'Jaunius', 'Jauniauskas', '$2y$10$Mnbui9WyXCvxhtXdrIHBjOUNEbZmCoKvj18h.fzJf9nCQjsqo7RuO', '2022-10-24 22:28:26', 'jaunius@gmail.com', 0, 'jaunius123', 2990273, 'Klientas', 0),
(8, 'justinas', 'justinauskas', '$2y$10$yr5z7qGqPCP/H.UFKNlTOuv3x7Y6WEjJLU2A72b6tPNYUEbjD/KRy', '2022-10-25 04:26:18', 'justinas@gmail.com', 0, 'justinas123', 25237475, 'Klientas', 1),
(10, 'Rimas', 'Rimaitis', '$2y$10$f6d3VVOm5X6OfBV/eFUOy.ue8fbIYc0XleT1v2zGe1d0tvdr6aTGm', '2022-11-22 06:44:21', 'rimas@gmail.com', 0, 'rimas123', 317628998, 'Klientas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Prisijungimai`
--

CREATE TABLE `Prisijungimai` (
  `id` bigint(20) NOT NULL,
  `ip_adresas` varchar(45) NOT NULL,
  `laikas` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `naudotojo_id` bigint(20) NOT NULL,
  `epastas` varchar(100) NOT NULL,
  `aktyvus` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Prisijungimai`
--

INSERT INTO `Prisijungimai` (`id`, `ip_adresas`, `laikas`, `naudotojo_id`, `epastas`, `aktyvus`) VALUES
(6, '127.0.0.1', '2022-10-24 20:52:31', 220270930588110926, 'jonaitis@gmail.com', 0),
(7, '127.0.0.1', '2022-10-24 22:10:51', 277514461748, 'zenius@gmail.com', 0),
(8, '127.0.0.5', '2022-10-24 22:17:48', 4759998767, 'bronius@gmail.com', 0),
(9, '127.0.0.1', '2022-10-24 22:22:57', 277514461748, 'zenius@gmail.com', 0),
(10, '127.0.0.1', '2022-10-24 22:24:02', 277514461748, 'zenius@gmail.com', 0),
(11, '127.0.0.4', '2022-10-24 22:24:12', 4759998767, 'bronius@gmail.com', 0),
(12, '127.0.0.4', '2022-10-24 22:24:56', 4759998767, 'bronius@gmail.com', 0),
(13, '127.0.0.1', '2022-10-24 22:25:12', 277514461748, 'zenius@gmail.com', 0),
(14, '127.0.0.1', '2022-10-24 22:26:00', 6635613424494870, 'tomas@gmail.com', 0),
(15, '127.0.0.1', '2022-10-24 22:28:38', 2990273, 'jaunius@gmail.com', 0),
(16, '127.0.0.1', '2022-10-24 22:36:10', 277514461748, 'zenius@gmail.com', 0),
(17, '127.0.0.1', '2022-10-24 22:40:48', 277514461748, 'zenius@gmail.com', 0),
(18, '127.0.0.3', '2022-10-24 22:51:19', 4759998767, 'bronius@gmail.com', 0),
(19, '127.0.0.1', '2022-10-24 22:51:48', 277514461748, 'zenius@gmail.com', 0),
(20, '127.0.0.1', '2022-10-24 22:53:30', 277514461748, 'zenius@gmail.com', 0),
(21, '127.0.0.3', '2022-10-24 22:53:53', 4759998767, 'bronius@gmail.com', 0),
(22, '127.0.0.1', '2022-10-24 22:56:25', 220270930588110926, 'jonaitis@gmail.com', 0),
(23, '127.0.0.1', '2022-10-24 22:59:17', 277514461748, 'zenius@gmail.com', 0),
(24, '127.0.0.1', '2022-10-24 23:00:56', 277514461748, 'zenius@gmail.com', 0),
(25, '127.0.0.1', '2022-10-24 23:02:00', 277514461748, 'zenius@gmail.com', 0),
(26, '127.0.0.1', '2022-10-24 23:04:54', 277514461748, 'zenius@gmail.com', 0),
(27, '127.0.0.1', '2022-10-24 23:08:25', 277514461748, 'zenius@gmail.com', 0),
(28, '127.0.0.1', '2022-10-24 23:14:19', 277514461748, 'zenius@gmail.com', 0),
(29, '127.0.0.3', '2022-10-24 23:23:28', 4759998767, 'bronius@gmail.com', 0),
(30, '127.0.0.1', '2022-10-24 23:28:02', 220270930588110926, 'jonaitis@gmail.com', 0),
(31, '127.0.0.1', '2022-10-24 23:29:15', 277514461748, 'zenius@gmail.com', 0),
(32, '127.0.0.1', '2022-10-24 23:36:13', 277514461748, 'zenius@gmail.com', 0),
(33, '127.0.0.1', '2022-10-24 23:44:01', 277514461748, 'zenius@gmail.com', 0),
(34, '127.0.0.1', '2022-10-24 23:50:34', 6635613424494870, 'tomas@gmail.com', 0),
(35, '127.0.0.1', '2022-10-25 00:45:40', 277514461748, 'zenius@gmail.com', 0),
(36, '127.0.0.2', '2022-10-25 01:40:03', 4759998767, 'bronius@gmail.com', 0),
(37, '127.0.0.1', '2022-10-25 04:29:15', 25237475, 'justinas@gmail.com', 0),
(38, '127.0.0.1', '2022-10-25 04:48:30', 277514461748, 'zenius@gmail.com', 0),
(39, '127.0.0.1', '2022-10-25 05:21:30', 6635613424494870, 'tomas@gmail.com', 0),
(40, '127.0.0.2', '2022-10-25 05:26:20', 4759998767, 'bronius@gmail.com', 0),
(41, '127.0.0.2', '2022-11-17 15:59:26', 4759998767, 'bronius@gmail.com', 0),
(42, '127.0.0.2', '2022-11-17 16:01:58', 4759998767, 'bronius@gmail.com', 0),
(43, '127.0.0.1', '2022-11-17 16:09:38', 25237475, 'justinas@gmail.com', 0),
(44, '127.0.0.1', '2022-11-17 16:16:14', 4759998767, 'bronius@gmail.com', 0),
(45, '127.0.0.1', '2022-11-17 16:37:27', 4759998767, 'bronius@gmail.com', 0),
(58, '127.0.0.7', '2022-11-17 19:58:33', 4759998767, 'bronius@gmail.com', 0),
(59, '127.0.0.1', '2022-11-17 20:17:27', 4759998767, 'bronius@gmail.com', 0),
(60, '127.0.0.1', '2022-11-17 20:18:39', 4759998767, 'bronius@gmail.com', 0),
(61, '127.0.0.1', '2022-11-17 20:18:43', 4759998767, 'bronius@gmail.com', 0),
(62, '127.0.0.1', '2022-11-17 20:18:47', 4759998767, 'bronius@gmail.com', 0),
(63, '127.0.0.1', '2022-11-17 20:18:51', 4759998767, 'bronius@gmail.com', 0),
(64, '127.0.0.1', '2022-11-17 21:09:21', 4759998767, 'bronius@gmail.com', 0),
(65, '127.0.0.1', '2022-11-17 21:39:59', 4759998767, 'bronius@gmail.com', 0),
(66, '127.0.0.1', '2022-11-17 22:09:39', 4759998767, 'bronius@gmail.com', 0),
(67, '127.0.0.1', '2022-11-18 10:13:22', 4759998767, 'bronius@gmail.com', 0),
(68, '::1', '2022-11-18 10:50:27', 4759998767, 'bronius@gmail.com', 0),
(69, '::1', '2022-11-18 10:55:16', 4759998767, 'bronius@gmail.com', 0),
(70, '::1', '2022-11-18 10:55:33', 4759998767, 'bronius@gmail.com', 0),
(71, '::1', '2022-11-18 12:49:17', 4759998767, 'bronius@gmail.com', 0),
(72, '::1', '2022-11-18 12:49:42', 4759998767, 'bronius@gmail.com', 0),
(73, '::1', '2022-11-18 12:51:14', 4759998767, 'bronius@gmail.com', 0),
(74, '::1', '2022-11-18 12:54:23', 4759998767, 'bronius@gmail.com', 0),
(75, '127.0.0.1', '2022-11-18 13:03:50', 4759998767, 'bronius@gmail.com', 0),
(76, '127.0.0.1', '2022-11-18 13:05:13', 277514461748, 'zenius@gmail.com', 0),
(77, '::1', '2022-11-18 13:07:00', 4759998767, 'bronius@gmail.com', 0),
(78, '::1', '2022-11-18 13:10:42', 220270930588110926, 'jonaitis@gmail.com', 0),
(79, '::1', '2022-11-18 13:13:10', 220270930588110926, 'jonaitis@gmail.com', 0),
(80, '::1', '2022-11-18 13:16:13', 220270930588110926, 'jonaitis@gmail.com', 0),
(81, '::1', '2022-11-18 13:20:34', 277514461748, 'zenius@gmail.com', 0),
(82, '::1', '2022-11-18 13:24:29', 220270930588110926, 'jonaitis@gmail.com', 0),
(83, '::1', '2022-11-18 13:30:50', 220270930588110926, 'jonaitis@gmail.com', 0),
(84, '::1', '2022-11-18 13:31:17', 4759998767, 'bronius@gmail.com', 0),
(85, '::1', '2022-11-18 13:31:37', 277514461748, 'zenius@gmail.com', 0),
(86, '::1', '2022-11-18 13:33:10', 277514461748, 'zenius@gmail.com', 0),
(87, '::1', '2022-11-18 13:34:07', 220270930588110926, 'jonaitis@gmail.com', 0),
(88, '::1', '2022-11-18 13:34:23', 4759998767, 'bronius@gmail.com', 0),
(89, '127.0.0.1', '2022-11-18 13:37:36', 4759998767, 'bronius@gmail.com', 0),
(90, '127.0.0.1', '2022-11-18 13:39:38', 220270930588110926, 'jonaitis@gmail.com', 0),
(91, '127.0.0.1', '2022-11-18 13:57:25', 4759998767, 'bronius@gmail.com', 0),
(92, '127.0.0.1', '2022-11-18 14:17:18', 4759998767, 'bronius@gmail.com', 0),
(93, '127.0.0.1', '2022-11-18 14:20:04', 277514461748, 'zenius@gmail.com', 0),
(94, '127.0.0.1', '2022-11-18 14:23:14', 277514461748, 'zenius@gmail.com', 0),
(95, '127.0.0.1', '2022-11-18 14:24:01', 4759998767, 'bronius@gmail.com', 0),
(96, '127.0.0.1', '2022-11-18 14:38:20', 220270930588110926, 'jonaitis@gmail.com', 0),
(97, '127.0.0.1', '2022-11-18 14:52:11', 4759998767, 'bronius@gmail.com', 0),
(98, '127.0.0.1', '2022-11-21 17:57:10', 277514461748, 'zenius@gmail.com', 0),
(99, '127.0.0.1', '2022-11-21 18:02:18', 220270930588110926, 'jonaitis@gmail.com', 0),
(100, '127.0.0.1', '2022-11-21 18:03:43', 4759998767, 'bronius@gmail.com', 0),
(101, '127.0.0.1', '2022-11-21 18:04:22', 220270930588110926, 'jonaitis@gmail.com', 0),
(102, '127.0.0.1', '2022-11-21 18:08:57', 4759998767, 'bronius@gmail.com', 0),
(103, '127.0.0.1', '2022-11-21 18:42:57', 220270930588110926, 'jonaitis@gmail.com', 0),
(104, '127.0.0.1', '2022-11-21 18:45:13', 6635613424494870, 'tomas@gmail.com', 0),
(105, '127.0.0.1', '2022-11-21 18:48:11', 220270930588110926, 'jonaitis@gmail.com', 0),
(106, '127.0.0.1', '2022-11-21 18:48:43', 4759998767, 'bronius@gmail.com', 0),
(107, '127.0.0.1', '2022-11-21 18:51:28', 277514461748, 'zenius@gmail.com', 0),
(108, '::1', '2022-11-21 18:53:15', 220270930588110926, 'jonaitis@gmail.com', 0),
(109, '::1', '2022-11-21 21:10:46', 220270930588110926, 'jonaitis@gmail.com', 0),
(110, '::1', '2022-11-21 21:14:06', 220270930588110926, 'jonaitis@gmail.com', 0),
(111, '::1', '2022-11-21 21:31:31', 220270930588110926, 'jonaitis@gmail.com', 0),
(112, '127.0.0.1', '2022-11-21 21:33:19', 4759998767, 'bronius@gmail.com', 0),
(113, '127.0.0.1', '2022-11-21 21:47:03', 4759998767, 'bronius@gmail.com', 0),
(114, '127.0.0.1', '2022-11-21 21:47:12', 220270930588110926, 'jonaitis@gmail.com', 0),
(115, '127.0.0.1', '2022-11-21 21:47:52', 220270930588110926, 'jonaitis@gmail.com', 0),
(116, '127.0.0.1', '2022-11-21 21:50:37', 4759998767, 'bronius@gmail.com', 0),
(117, '127.0.0.1', '2022-11-21 21:55:09', 4759998767, 'bronius@gmail.com', 0),
(118, '127.0.0.1', '2022-11-21 21:55:29', 220270930588110926, 'jonaitis@gmail.com', 0),
(119, '127.0.0.1', '2022-11-21 23:02:24', 4759998767, 'bronius@gmail.com', 0),
(120, '127.0.0.1', '2022-11-21 23:02:35', 220270930588110926, 'jonaitis@gmail.com', 0),
(121, '127.0.0.1', '2022-11-21 23:49:03', 220270930588110926, 'jonaitis@gmail.com', 0),
(122, '127.0.0.1', '2022-11-21 23:51:55', 220270930588110926, 'jonaitis@gmail.com', 0),
(123, '127.0.0.1', '2022-11-21 23:54:47', 220270930588110926, 'jonaitis@gmail.com', 0),
(124, '127.0.0.1', '2022-11-21 23:57:15', 220270930588110926, 'jonaitis@gmail.com', 0),
(125, '127.0.0.1', '2022-11-21 23:58:56', 220270930588110926, 'jonaitis@gmail.com', 0),
(126, '127.0.0.1', '2022-11-21 23:59:38', 220270930588110926, 'jonaitis@gmail.com', 0),
(127, '127.0.0.1', '2022-11-22 00:18:44', 4759998767, 'bronius@gmail.com', 0),
(128, '127.0.0.1', '2022-11-22 00:30:32', 277514461748, 'zenius@gmail.com', 0),
(129, '127.0.0.1', '2022-11-22 00:42:44', 4759998767, 'bronius@gmail.com', 0),
(130, '127.0.0.1', '2022-11-22 00:43:00', 277514461748, 'zenius@gmail.com', 0),
(131, '127.0.0.1', '2022-11-22 01:13:11', 277514461748, 'zenius@gmail.com', 0),
(132, '127.0.0.1', '2022-11-22 01:32:35', 277514461748, 'zenius@gmail.com', 0),
(133, '127.0.0.1', '2022-11-22 02:05:30', 277514461748, 'zenius@gmail.com', 0),
(134, '127.0.0.1', '2022-11-22 02:15:58', 4759998767, 'bronius@gmail.com', 0),
(135, '127.0.0.1', '2022-11-22 02:17:17', 6635613424494870, 'tomas@gmail.com', 0),
(137, '127.0.0.1', '2022-11-22 02:26:54', 4759998767, 'bronius@gmail.com', 0),
(138, '127.0.0.1', '2022-11-22 02:27:49', 4759998767, 'bronius@gmail.com', 0),
(139, '127.0.0.1', '2022-11-22 02:37:29', 220270930588110926, 'jonaitis@gmail.com', 0),
(140, '127.0.0.1', '2022-11-22 02:39:16', 4759998767, 'bronius@gmail.com', 0),
(141, '127.0.0.1', '2022-11-22 03:18:48', 25237475, 'justinas@gmail.com', 0),
(142, '127.0.0.1', '2022-11-22 03:19:29', 4759998767, 'bronius@gmail.com', 0),
(143, '127.0.0.1', '2022-11-22 03:20:13', 25237475, 'justinas@gmail.com', 0),
(144, '127.0.0.1', '2022-11-22 03:40:15', 4759998767, 'bronius@gmail.com', 0),
(145, '127.0.0.1', '2022-11-22 03:40:41', 25237475, 'justinas@gmail.com', 0),
(148, '127.0.0.1', '2022-11-22 03:52:08', 4759998767, 'bronius@gmail.com', 0),
(149, '127.0.0.1', '2022-11-22 03:53:42', 4759998767, 'bronius@gmail.com', 0),
(150, '127.0.0.1', '2022-11-22 03:55:02', 4759998767, 'bronius@gmail.com', 0),
(151, '127.0.0.1', '2022-11-22 04:05:16', 25237475, 'justinas@gmail.com', 0),
(152, '127.0.0.1', '2022-11-22 04:10:00', 25237475, 'justinas@gmail.com', 0),
(153, '127.0.0.1', '2022-11-22 04:14:57', 277514461748, 'zenius@gmail.com', 0),
(154, '127.0.0.1', '2022-11-22 04:15:30', 4759998767, 'bronius@gmail.com', 0),
(155, '127.0.0.1', '2022-11-22 04:22:41', 25237475, 'justinas@gmail.com', 0),
(156, '127.0.0.1', '2022-11-22 04:24:15', 277514461748, 'zenius@gmail.com', 0),
(157, '127.0.0.1', '2022-11-22 04:35:20', 277514461748, 'zenius@gmail.com', 0),
(158, '127.0.0.1', '2022-11-22 05:02:08', 6635613424494870, 'tomas@gmail.com', 0),
(159, '127.0.0.1', '2022-11-22 05:06:24', 6635613424494870, 'tomas@gmail.com', 0),
(160, '127.0.0.1', '2022-11-22 05:07:18', 277514461748, 'zenius@gmail.com', 0),
(161, '127.0.0.1', '2022-11-22 05:23:48', 4759998767, 'bronius@gmail.com', 0),
(162, '127.0.0.1', '2022-11-22 05:29:06', 4759998767, 'bronius@gmail.com', 0),
(163, '127.0.0.1', '2022-11-22 05:53:01', 4759998767, 'bronius@gmail.com', 0),
(164, '127.0.0.1', '2022-11-22 05:55:36', 220270930588110926, 'jonaitis@gmail.com', 0),
(165, '127.0.0.1', '2022-11-22 05:57:59', 6635613424494870, 'tomas@gmail.com', 0),
(166, '127.0.0.1', '2022-11-22 06:33:05', 277514461748, 'zenius@gmail.com', 0),
(167, '127.0.0.1', '2022-11-22 06:38:25', 4759998767, 'bronius@gmail.com', 0),
(168, '127.0.0.1', '2022-11-22 06:45:47', 317628998, 'rimas@gmail.com', 0),
(169, '127.0.0.1', '2022-11-22 06:54:40', 4759998767, 'bronius@gmail.com', 0),
(170, '127.0.0.1', '2022-11-22 06:57:23', 317628998, 'rimas@gmail.com', 0),
(171, '127.0.0.1', '2022-11-22 07:01:49', 277514461748, 'zenius@gmail.com', 0),
(172, '127.0.0.1', '2022-11-22 07:05:59', 4759998767, 'bronius@gmail.com', 0),
(173, '127.0.0.1', '2022-11-22 07:10:52', 220270930588110926, 'jonaitis@gmail.com', 0),
(174, '127.0.0.1', '2022-11-22 09:14:36', 277514461748, 'zenius@gmail.com', 0),
(175, '127.0.0.1', '2022-11-22 09:23:02', 317628998, 'rimas@gmail.com', 0),
(176, '127.0.0.1', '2022-11-22 09:29:40', 2990273, 'jaunius@gmail.com', 0),
(177, '127.0.0.1', '2022-11-22 09:48:22', 220270930588110926, 'jonaitis@gmail.com', 0),
(178, '127.0.0.1', '2022-11-22 09:55:44', 4759998767, 'bronius@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Zinutes`
--

CREATE TABLE `Zinutes` (
  `id` bigint(20) NOT NULL,
  `naudotojo_id` bigint(20) NOT NULL,
  `tekstas` varchar(500) NOT NULL,
  `laikas` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Zinutes`
--

INSERT INTO `Zinutes` (`id`, `naudotojo_id`, `tekstas`, `laikas`) VALUES
(4, 25237475, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 04:05:16'),
(5, 25237475, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 04:10:00'),
(6, 277514461748, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 04:14:57'),
(7, 25237475, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 04:22:41'),
(8, 277514461748, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 04:24:24'),
(9, 277514461748, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 04:35:20'),
(10, 6635613424494870, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 05:02:08'),
(11, 6635613424494870, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 05:06:24'),
(12, 277514461748, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 05:07:18'),
(13, 6635613424494870, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 05:57:59'),
(14, 277514461748, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 06:33:05'),
(15, 317628998, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 06:45:47'),
(16, 317628998, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 06:57:23'),
(17, 277514461748, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 07:01:49'),
(18, 277514461748, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 09:14:36'),
(19, 317628998, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 09:23:02'),
(20, 2990273, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 09:29:40'),
(21, 277514461748, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 11:10:22'),
(22, 277514461748, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 11:10:34'),
(23, 277514461748, 'Prisijungta prie sistemos is IP adreso: 127.0.0.1', '2022-11-22 11:10:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Mokejimai`
--
ALTER TABLE `Mokejimai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Naudotojai`
--
ALTER TABLE `Naudotojai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `naudotojo_id` (`naudotojo_id`),
  ADD KEY `regdata` (`regdata`),
  ADD KEY `slapyvardis` (`slapyvardis`);

--
-- Indexes for table `Prisijungimai`
--
ALTER TABLE `Prisijungimai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `naudotojo_id` (`naudotojo_id`);

--
-- Indexes for table `Zinutes`
--
ALTER TABLE `Zinutes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Mokejimai`
--
ALTER TABLE `Mokejimai`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `Naudotojai`
--
ALTER TABLE `Naudotojai`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `Prisijungimai`
--
ALTER TABLE `Prisijungimai`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;
--
-- AUTO_INCREMENT for table `Zinutes`
--
ALTER TABLE `Zinutes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
