-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 22, 2022 at 01:36 PM
-- Server version: 5.7.35-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vieningo_a`
--

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
  `role` enum('Klientas','Administratorius') NOT NULL DEFAULT 'Klientas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Naudotojai`
--

INSERT INTO `Naudotojai` (`id`, `vardas`, `pavarde`, `slaptazodis`, `regdata`, `epastas`, `aktyvus`, `slapyvardis`, `naudotojo_id`, `role`) VALUES
(3, 'Jonas', 'Jonaitis', '$2y$10$/jSAq4pQkK48KH4RIkw2Vu4iSKz3ROGfVKE5pgDiPCREyYGE5gVLm', '2022-10-24 11:29:23', 'jonaitis@gmail.com', 0, 'jonas123', 220270930588110926, 'Klientas'),
(4, 'Zenius', 'Zeniauskas', '$2y$10$Ta5KEoOWw.xhY92hrDMVCuS9liuyrilJUaD.k56HuU4xSbSB8Goc2', '2022-10-24 11:32:05', 'zenius@gmail.com', 0, 'zenius123a', 277514461748, 'Administratorius'),
(5, 'Bronius', 'Broniauskas', '$2y$10$Q8h6m3jLiSG5bsG5AwqixOZrOZgZo9/Eup66MU9OaA.LS7hDSm52K', '2022-10-24 11:32:34', 'bronius@gmail.com', 0, 'bronius123', 4759998767, 'Administratorius'),
(6, 'Tomas', 'Tomauskas', '$2y$10$o1jXK/ZOHEvUHmfX2YP5GeWiR0Z93YS.JT99qKVYdqMCUU5BkvlyC', '2022-10-24 16:33:31', 'tomas@gmail.com', 0, 'tomas123', 6635613424494870, 'Klientas'),
(7, 'Ruonis', 'Ruoniauskas', '$2y$10$alwaxp4Cqkcnhz8GEoGc/u/r8BTYnTc2EMS1Q2X1xmu61kj7r2d1W', '2022-10-24 17:11:22', 'ruonis@gmail.com', 0, 'ruonis123', 177598706, 'Klientas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Naudotojai`
--
ALTER TABLE `Naudotojai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `naudotojo_id` (`naudotojo_id`),
  ADD KEY `regdata` (`regdata`),
  ADD KEY `slapyvardis` (`slapyvardis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Naudotojai`
--
ALTER TABLE `Naudotojai`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
