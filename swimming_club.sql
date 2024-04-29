-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 12:03 PM
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
-- Database: `swimming_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `meets`
--

CREATE TABLE `meets` (
  `MeetID` int(11) NOT NULL,
  `MeetName` varchar(100) DEFAULT NULL,
  `MeetDate` date DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meets`
--

INSERT INTO `meets` (`MeetID`, `MeetName`, `MeetDate`, `Location`) VALUES
(4, 'Spring Splash Invitational', '2023-02-20', 'Aquatic Center, Cityville'),
(5, 'Fall Splash Invitational', '2013-02-02', 'Dhaka'),
(6, 'Summer Splash Invitational', '2009-02-02', 'Sylhet'),
(7, 'Spring Splash Invitational', '2023-02-02', 'Aquatic Center, Cityville'),
(8, 'Spring Splash Invitational', '0000-00-00', 'Aquatic Center, Cityville 2');

-- --------------------------------------------------------

--
-- Table structure for table `parent_swimmer`
--

CREATE TABLE `parent_swimmer` (
  `parent_id` int(11) DEFAULT NULL,
  `swimmer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `raceresults`
--

CREATE TABLE `raceresults` (
  `ResultID` int(11) NOT NULL,
  `RaceID` int(11) DEFAULT NULL,
  `SwimmerID` int(11) DEFAULT NULL,
  `TimeTaken` time DEFAULT NULL,
  `PlaceAchieved` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raceresults`
--

INSERT INTO `raceresults` (`ResultID`, `RaceID`, `SwimmerID`, `TimeTaken`, `PlaceAchieved`) VALUES
(25, 5, 3, '00:00:00', 1),
(26, 5, 3, '01:00:00', 2),
(27, 8, 3, '00:00:00', 1),
(28, 8, 3, '00:00:00', 2),
(32, 5, 3, '00:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `races`
--

CREATE TABLE `races` (
  `RaceID` int(11) NOT NULL,
  `RaceName` varchar(100) DEFAULT NULL,
  `Distance` int(11) DEFAULT NULL,
  `Stroke` varchar(50) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `MeetID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `races`
--

INSERT INTO `races` (`RaceID`, `RaceName`, `Distance`, `Stroke`, `Date`, `Location`, `MeetID`) VALUES
(5, 'La Lifp', 100, 'Back', '2010-02-02', 'Sylhet', 5),
(8, 'Champoinship 3', 100, 'Back', '2000-02-20', 'Dhaka', 6);

-- --------------------------------------------------------

--
-- Table structure for table `squad`
--

CREATE TABLE `squad` (
  `squad_id` int(11) NOT NULL,
  `squad_name` varchar(255) NOT NULL,
  `training_days` varchar(100) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `coach_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `squad`
--

INSERT INTO `squad` (`squad_id`, `squad_name`, `training_days`, `start_time`, `end_time`, `coach_id`) VALUES
(1, 'Squad AA', 'Monday,Tuesday', '08:00:00', '10:00:00', 10),
(2, 'Squad B', 'Tuesday,Thursday', '16:00:00', '18:00:00', 11),
(3, 'Bacth 1', 'Monday', '10:59:00', '00:59:00', NULL),
(4, 'Bacth 1', 'Monday,Saturday,Sunday', '23:22:00', '14:22:00', NULL),
(5, 'Squad AA', 'Tuesday', '11:11:00', '00:11:00', NULL),
(6, 'Squad BB', 'Monday', '11:11:00', '11:11:00', NULL),
(7, 'ee', 'Monday', '11:11:00', '11:11:00', NULL),
(8, 'ee2', 'Tuesday', '11:11:00', '11:11:00', NULL),
(9, 'Squad AA', 'Monday', '11:11:00', '11:11:00', 11),
(10, 'Bacth 1', 'Tuesday', '11:11:00', '11:11:00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `trainingattendance`
--

CREATE TABLE `trainingattendance` (
  `AttendanceID` int(11) NOT NULL,
  `SessionID` int(11) DEFAULT NULL,
  `SwimmerID` int(11) DEFAULT NULL,
  `AttendanceStatus` enum('Present','Absent','Late') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainingresults`
--

CREATE TABLE `trainingresults` (
  `ResultID` int(11) NOT NULL,
  `SessionID` int(11) DEFAULT NULL,
  `SwimmerID` int(11) DEFAULT NULL,
  `DistanceSwam` int(11) DEFAULT NULL,
  `TimeTaken` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainingsessions`
--

CREATE TABLE `trainingsessions` (
  `SessionID` int(11) NOT NULL,
  `SessionDate` date DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `role` enum('admin','coach','parent','swimmer') DEFAULT NULL,
  `squad_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `dob`, `phone`, `address`, `postcode`, `role`, `squad_id`) VALUES
(2, 'Emon', '$2y$10$gbbC9OmpK0IaV7h37/TKweDZbKyWQRYAcNI4f5RLRAc0nFr8BRNvm', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-09-22', '01743217209', 'eqr', '2123', 'admin', NULL),
(3, 'Emon4', '$2y$10$XJ6Lz4F842Q.AmKOLr5GqOpXl.K6bm.t88vSAIXXZj.k7xlH938CK', 'Emon', 'Singha', 'emonsingsha209@gmail.com', '2010-02-20', '01743217209', 'eqr', '2123', 'swimmer', 1),
(4, 'Emon5', '$2y$10$Pa7GeuIUtkEmBIn28TQbhuH/.Kwfzx1FBMK0FbzNByZ0vICwnR/5O', 'Emon', 'Singha', 'emonsiwngha2092@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(10, 'Emon8', '$2y$10$XsfM84d1cT0QPN/VN/sCPuSf3//Mj1wWtnxU9x6dJ8fozD78iQ6QC', 'Emon', 'Singha', 'emonsingssssha209@gmail.com', '2000-11-11', '01743217209', 'eqre', '2123', 'coach', NULL),
(11, 'John', '$2y$10$4m1uwA184aBeRNUtltr3puMIefWP7fRBsC4YJqGnq1EjTcl6Y5/Yq', 'Emon', 'Singha', 'emonsingha209222@gmail.com', '2000-02-02', '01743217209', 'eqr', '2123', 'coach', NULL),
(12, 'shuvo', 'sddwr', 'Shivo', 'singjh', 'emonsin@gmail.com', '2016-04-27', '0127123', 'edfwef', 'edfew', 'swimmer', 3),
(13, 'John2', '$2y$10$7Zj.ubTnem6skGBEt5s9Te1dQYVa4O8fkwdtGIzvdC4gXmb8FgYfm', 'Emon', 'Singha', 'emonsingha209222@gmail.com', '2000-02-20', '01743217209', 'eqr', '2123', 'coach', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meets`
--
ALTER TABLE `meets`
  ADD PRIMARY KEY (`MeetID`);

--
-- Indexes for table `parent_swimmer`
--
ALTER TABLE `parent_swimmer`
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `swimmer_id` (`swimmer_id`);

--
-- Indexes for table `raceresults`
--
ALTER TABLE `raceresults`
  ADD PRIMARY KEY (`ResultID`),
  ADD KEY `RaceID` (`RaceID`),
  ADD KEY `SwimmerID` (`SwimmerID`);

--
-- Indexes for table `races`
--
ALTER TABLE `races`
  ADD PRIMARY KEY (`RaceID`),
  ADD KEY `MeetID` (`MeetID`);

--
-- Indexes for table `squad`
--
ALTER TABLE `squad`
  ADD PRIMARY KEY (`squad_id`),
  ADD KEY `coach_id` (`coach_id`);

--
-- Indexes for table `trainingattendance`
--
ALTER TABLE `trainingattendance`
  ADD PRIMARY KEY (`AttendanceID`),
  ADD KEY `SessionID` (`SessionID`),
  ADD KEY `SwimmerID` (`SwimmerID`);

--
-- Indexes for table `trainingresults`
--
ALTER TABLE `trainingresults`
  ADD PRIMARY KEY (`ResultID`),
  ADD KEY `SessionID` (`SessionID`),
  ADD KEY `SwimmerID` (`SwimmerID`);

--
-- Indexes for table `trainingsessions`
--
ALTER TABLE `trainingsessions`
  ADD PRIMARY KEY (`SessionID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `squad_id` (`squad_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meets`
--
ALTER TABLE `meets`
  MODIFY `MeetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `raceresults`
--
ALTER TABLE `raceresults`
  MODIFY `ResultID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `races`
--
ALTER TABLE `races`
  MODIFY `RaceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `squad`
--
ALTER TABLE `squad`
  MODIFY `squad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `trainingattendance`
--
ALTER TABLE `trainingattendance`
  MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainingresults`
--
ALTER TABLE `trainingresults`
  MODIFY `ResultID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainingsessions`
--
ALTER TABLE `trainingsessions`
  MODIFY `SessionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parent_swimmer`
--
ALTER TABLE `parent_swimmer`
  ADD CONSTRAINT `parent_swimmer_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `parent_swimmer_ibfk_2` FOREIGN KEY (`swimmer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `raceresults`
--
ALTER TABLE `raceresults`
  ADD CONSTRAINT `raceresults_ibfk_1` FOREIGN KEY (`RaceID`) REFERENCES `races` (`RaceID`),
  ADD CONSTRAINT `raceresults_ibfk_2` FOREIGN KEY (`SwimmerID`) REFERENCES `users` (`id`);

--
-- Constraints for table `races`
--
ALTER TABLE `races`
  ADD CONSTRAINT `races_ibfk_1` FOREIGN KEY (`MeetID`) REFERENCES `meets` (`MeetID`);

--
-- Constraints for table `trainingattendance`
--
ALTER TABLE `trainingattendance`
  ADD CONSTRAINT `trainingattendance_ibfk_1` FOREIGN KEY (`SessionID`) REFERENCES `trainingsessions` (`SessionID`),
  ADD CONSTRAINT `trainingattendance_ibfk_2` FOREIGN KEY (`SwimmerID`) REFERENCES `users` (`id`);

--
-- Constraints for table `trainingresults`
--
ALTER TABLE `trainingresults`
  ADD CONSTRAINT `trainingresults_ibfk_1` FOREIGN KEY (`SessionID`) REFERENCES `trainingsessions` (`SessionID`),
  ADD CONSTRAINT `trainingresults_ibfk_2` FOREIGN KEY (`SwimmerID`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`squad_id`) REFERENCES `squad` (`squad_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
