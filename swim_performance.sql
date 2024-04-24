-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 10:40 PM
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
-- Database: `swim_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `swim_performance`
--

CREATE TABLE `swim_performance` (
  `id` int(11) NOT NULL,
  `swimmer_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `time` time NOT NULL,
  `validated` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `swim_performance`
--

INSERT INTO `swim_performance` (`id`, `swimmer_id`, `event_name`, `event_date`, `time`, `validated`) VALUES
(1, 32, '100m Freestyle', '2024-04-01', '00:58:23', 1),
(2, 32, '200m Backstroke', '2024-04-05', '02:10:45', 1),
(3, 32, '50m Breaststroke', '2024-04-02', '00:35:12', 1),
(4, 32, '200m Butterfly', '2024-04-03', '02:30:59', 1),
(5, 32, '100m Freestyle', '2024-04-04', '01:00:00', 1),
(6, 32, '400m Individual Medley', '2024-04-06', '05:30:15', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `swim_performance`
--
ALTER TABLE `swim_performance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `swimmer_id` (`swimmer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `swim_performance`
--
ALTER TABLE `swim_performance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `swim_performance`
--
ALTER TABLE `swim_performance`
  ADD CONSTRAINT `swim_performance_ibfk_1` FOREIGN KEY (`swimmer_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
