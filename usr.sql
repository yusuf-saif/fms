-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2022 at 05:51 PM
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
-- Database: `fms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `usr`
--

CREATE TABLE `usr` (
  `usr_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `passwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usr`
--

INSERT INTO `usr` (`usr_id`, `first_name`, `last_name`, `role`, `user`, `passwd`) VALUES
(8, 'demo', 'test', 'Head', 'demo', 'd941191e51e81390343e12b159bb123f'),
(9, 'FMC', 'Admin', 'Chairman', 'Admin', 'f4831417ef62d838f8d7d6bf2934b3ed'),
(11, 'test', 'tested', 'officer', 'test', 'd941191e51e81390343e12b159bb123f'),
(12, 'Donald', 'Duck', 'Chairman', 'saif', 'e10adc3949ba59abbe56e057f20f883e'),
(13, 'Donald', 'Duck', 'officer', 'admin', '0192023a7bbd73250516f069df18b500');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usr`
--
ALTER TABLE `usr`
  ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usr`
--
ALTER TABLE `usr`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
