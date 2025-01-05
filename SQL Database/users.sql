-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2025 at 08:34 AM
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
-- Database: `midproject_bncc`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_Name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `photo` varchar(250) NOT NULL,
  `bio` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_Name`, `last_name`, `email`, `pass`, `photo`, `bio`) VALUES
(1, 'admin', 'BNCC', 'adminBNCC@gmail.com', '0192023a7bbd73250516f069df18b500', 'BNCCAdminProfPic.png', 'Hi my name is Admin, and I like backend development.'),
(4, 'Charlotte', 'Montgomery', 'charlotte.montgomery@gmail.com', '4b58c07218956b957f253c068f8b01e7', 'Person1.jpg', 'A marketing strategist with a flair for digital innovation and customer-centric campaigns. With a background in communications and a degree from Harvard University, she has led successful global marketing initiatives for leading tech firms. Outside of work, Anastasia enjoys painting, yoga, and traveling to explore different cultures and cuisines.'),
(5, 'Christopher', 'Wijaya', 'christopher.wijaya@gmail.com', '3593cdf157bfc9c511dfa947e838d2a7', 'Person2.jpg', ''),
(6, 'Alexander', 'Johnson', 'alexander.johnson@gmail.com', 'c961d7297d0a85846721710f8a086650', 'Person3.jpg', 'An experienced software engineer with over 10 years of expertise in developing scalable applications. He holds a Master’s degree in Computer Science from Stanford University and is passionate about solving complex problems using technology. In his free time, Alexander enjoys reading historical novels, practicing photography, and exploring nature trails.'),
(7, 'Alexandria', 'Richardson', 'alexandria.richardson@gmail.com', '863cd7d417b4d407a4baa2bb3ac0e3b1', 'Person4.jpg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
