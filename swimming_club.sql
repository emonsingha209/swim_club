-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 03:48 AM
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
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postcode` varchar(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `dob`, `phone`, `address`, `postcode`, `role`, `approved`, `parent_id`, `created_at`) VALUES
(3, 'Emondqwed', '111', 'wfwef', 'dfswef', 'emon@example.com', '2011-02-02', '213123123', 'Kuril', '123', 'swimmer', 1, NULL, '2024-05-03 23:14:14'),
(4, 'qwe2e2e3we32', '111', 'er3', 'ewr', 'sheba@gmail.com', '1970-01-01', '121121212', 'Kuril', '123', 'parent', 0, NULL, '2024-05-03 23:14:14'),
(5, 'Emoner234rt', '111', 'Enib', 'efwerfw', 'emon@example.com', '2012-02-20', '01743217209', 'Kuril', '123', 'swimmer', 0, NULL, '2024-05-03 23:43:46'),
(6, 'fwerw4er4w3r', '111', 'ewr3r32', 'erwer', 'sheba@gmail.com', '1970-01-01', '12313123213', 'Kuril', '123', 'parent', 0, 5, '2024-05-03 23:43:48'),
(7, 'Emoner234rt', '$2y$10$RMVTHXDZj3D9FTrj..tP.On6BFNHdLprEUFASAGWTjga8ODAWasTW', 'Enib', 'efwerfw', 'emon@example.com', '2912-02-20', '01743217209', 'Kuril', '123', 'swimmer', 1, NULL, '2024-05-03 23:47:44'),
(8, 'fwerw4er4w3r', '$2y$10$VUn9eAjWPgI6SjWLUwYFv.0Dv3UyuBBPgVI3AATAG0Tl2Xr9Khuva', 'ewr3r32', 'erwer', 'sheba@gmail.com', '1970-01-01', '12313123213', 'Kuril', '123', 'parent', 0, 7, '2024-05-03 23:47:44'),
(9, 'Emoner234rt', '$2y$10$qCLnCKRoU1ZVznmi449ho.v0NAbUuFbUceov0vSZUp2JFTijWagJq', 'Enib', 'efwerfw', 'emon@example.com', '2023-02-20', '01743217209', 'Kuril', '123', 'swimmer', 1, 10, '2024-05-04 00:02:56'),
(10, 'fwerw4er4w3r', '$2y$10$omE0OtAupSo9zAWUPSUp9.tCVuXnR/0XhUVYSh01CGf8lfsMwYCcq', 'ewr3r32', 'erwer', 'sheba@gmail.com', '1970-01-01', '12313123213', 'Kuril', '123', 'parent', 1, NULL, '2024-05-04 00:02:56'),
(11, 'Emon1ww', '$2y$10$aYnjZwTrtnSuFzPvQ8JKl.COyRANaw0g.fpb6JuuwuGqhmmMakO.i', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', 1, 12, '2024-05-04 18:40:22'),
(12, 'Emon2sadwf', '$2y$10$0VaENNtAUrj4DOzzQmEtwuTcYBHg9HPtfbYuU.OXQCY13EUAlp.Ia', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', 1, NULL, '2024-05-04 18:40:22'),
(13, 'Emon1wwwer', '$2y$10$4zDgUV8GzDDPK0s.pLjW9uS5md4Gg4nY7cFnU/dI5A3fxMgU7mnYC', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-02', '01743217209', 'eqr', '2123', 'swimmer', 1, 14, '2024-05-04 18:42:43'),
(14, 'erf43r234rt2', '$2y$10$oYajNmoFMBEYRhU7TaRTrO3vvt9V2kJntdncQ6v7IIAQXayYOXhXG', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', 1, NULL, '2024-05-04 18:42:43'),
(15, 'Emon1wwweradsad', '$2y$10$kx1hBotMr3LHjgNQ5aqsL./aHxsbZD9beR7XOYZzXsm.0AhGk2hQG', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-02', '01743217209', 'eqr', '2123', 'swimmer', 1, 16, '2024-05-04 18:45:40'),
(16, 'erf43r234rt2we2we2w', '$2y$10$5HzlP.71x0ea2suIgypYD.PKZo2oZiFhpqnvGyOLbjPyTMVS0UrZC', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', 1, NULL, '2024-05-04 18:45:41'),
(17, 'Emon1wwweradsadsdswd', '$2y$10$7L9TzSBvcOtR919UD17x/OvLJgAtOUKaj/vn5LuqggOcU7L2nYgyi', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-11-02', '01743217209', 'eqr', '2123', 'swimmer', 1, 18, '2024-05-04 18:49:54'),
(18, 'erf43r234rt2we2we2wsadwqd', '$2y$10$ud82rc/ibi7QbVwMkHiOoODIJThv5R.HTq4GghG34JTIzI3/1FzEW', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', 1, NULL, '2024-05-04 18:49:54'),
(19, 'Emon123', '$2y$10$3Ynlu.6YOQ03mkZGGOTcRuyoktWbYYTov.7LDShZWkgNpiv6p5zme', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', 1, 20, '2024-05-04 18:54:08'),
(20, 'adfsewfdewqfeqw', '$2y$10$D9e58/4GrF6dDNmO2E6/Ce9GiXly/oBqOpQ/dUdAJlpx2LOFEU5h.', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', 1, NULL, '2024-05-04 18:54:08'),
(21, 'Emon1233', '$2y$10$95iLSRs5hsE9Yd427W1AmeoEM7fcCFu5U99X0aIzbqUySri9hklOG', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', 1, 22, '2024-05-04 18:55:51'),
(22, 'adfsewfdewqfeqwdweq', '$2y$10$szCg7kSFhiuEyiDhtQDuhOUXmb2zHGn0NoB9E/HA/eL5gzJsSxtjO', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', 1, NULL, '2024-05-04 18:55:51'),
(23, 'Emon123343', '$2y$10$/vc148pd4zzPCQrf.CXbEOP1/50lg9NzW7QTCpXe4q3EMyetZebru', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', 1, 24, '2024-05-04 18:58:37'),
(24, 'werwr', '$2y$10$D5AEerZxu2.UIVBgNXoSe.XePspozzb9EwhxO7dz0.c7FReddlb5O', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', 1, NULL, '2024-05-04 18:58:37'),
(25, 'Emon1233430000', '$2y$10$t1jlyHHZHi43KXU8geZ91.fQ4REoLbA2SyUrbP5.urwhxx64GAZJ2', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', 1, 26, '2024-05-04 19:01:25'),
(26, 'eqwdre', '$2y$10$n2QESBGs.ZJ4hv4/DGxbDuUc7dfbpjc8tCiFDaq1bnbgEM5ZdHgXO', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', 1, NULL, '2024-05-04 19:01:25'),
(27, 'Emon000033430000', '$2y$10$6TY.7qVJ8G2wVEmyszaMg.mAOOlI1ZeZjJyuWXlQKadGTptSmix9W', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', 1, 28, '2024-05-04 19:04:07'),
(28, 'eqwdreedq3e', '$2y$10$S/.OPQ5ExpOitkMC2/4q7eqTJLso9TiQ7MQCYh.Lvm5n/QcEMA/OO', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', 1, NULL, '2024-05-04 19:04:07'),
(29, 'Shuvo', '$2y$10$tqxCSO7pg2PBP4.pKMmGMeqsGdbmPtq21.uuXtlkrDtl3DPbGedZe', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2010-02-20', '01743217209', 'eqr', '2123', 'swimmer', 1, 30, '2024-05-05 00:42:57'),
(30, 'Shuvo0', '$2y$10$T.1hS6NMDICbka2lChItM.g6mXfY5Lgst0myrcDTle.1RTBM39KpK', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', 1, NULL, '2024-05-05 00:42:58'),
(31, 'Asha', '$2y$10$sJZMxKWCCPhEPdEQy3lIteu34GK/Fl.MCfp9B2S4sZpA8N8cVUw26', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2010-02-20', '01743217209', 'eqr', '2123', 'swimmer', 1, 32, '2024-05-05 00:52:27'),
(32, 'AshaAAA ', '$2y$10$GFT9mJ7G.fqWxvj1rxJg4.93wT0QqULpqE7BjxolSIpFO62YdtqPa', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', 1, NULL, '2024-05-05 00:52:27'),
(33, 'irin', '$2y$10$Smqfo7Di9u7FaYhoL4IzH.tR11A4YyJ7g6XITj4tf1GjszVAu3i9W', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2010-02-20', '01743217209', 'eqr', '2123', 'swimmer', 1, 34, '2024-05-05 01:28:39'),
(34, 'tinni', '$2y$10$pGKEcCOeAqT.GMbO7byyBuUweK7YvKGRi4ZO2IrNTSy9AF9Gavc0e', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', 1, NULL, '2024-05-05 01:28:39');

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
(8, 'Spring Splash Invitational', '2023-02-20', 'Aquatic Center, Cityville 2');

-- --------------------------------------------------------

--
-- Table structure for table `parent_swimmer`
--

CREATE TABLE `parent_swimmer` (
  `parent_id` int(11) DEFAULT NULL,
  `swimmer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent_swimmer`
--

INSERT INTO `parent_swimmer` (`parent_id`, `swimmer_id`) VALUES
(22, 24),
(26, 28),
(34, 36),
(38, 40),
(42, 44),
(50, 52),
(55, 56),
(58, 59),
(61, 60);

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
(32, 5, 3, '00:00:00', 3),
(33, 8, 17, '00:20:00', 3);

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
(4, 'Bacth 1', 'Monday,Saturday,Sunday', '23:22:00', '14:22:00', 13),
(5, 'Squad AA', 'Tuesday', '11:11:00', '00:11:00', 13),
(6, 'Squad BB', 'Monday', '11:11:00', '11:11:00', 3),
(7, 'ee', 'Monday', '11:11:00', '11:11:00', NULL),
(8, 'ee2', 'Tuesday', '11:11:00', '11:11:00', NULL),
(9, 'Squad AA', 'Monday', '11:11:00', '11:11:00', 0),
(10, 'Bacth 1', 'Tuesday', '11:11:00', '11:11:00', 13),
(13, 'hbtght', 'Tuesday,Wednesday', '14:02:00', '03:22:00', 0),
(14, 'dfdvfgs', 'Tuesday', '11:11:00', '00:22:00', 30);

-- --------------------------------------------------------

--
-- Table structure for table `training_performance`
--

CREATE TABLE `training_performance` (
  `PerformanceID` int(11) NOT NULL,
  `SessionID` int(11) DEFAULT NULL,
  `Swimmer_id` int(11) DEFAULT NULL,
  `TimeTaken` time DEFAULT NULL,
  `Comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_performance`
--

INSERT INTO `training_performance` (`PerformanceID`, `SessionID`, `Swimmer_id`, `TimeTaken`, `Comment`) VALUES
(7, 3, 3, '00:04:00', 'Good'),
(8, 2, 58, '00:02:00', 'ee'),
(9, 2, 60, '00:02:00', 'sd');

-- --------------------------------------------------------

--
-- Table structure for table `training_session`
--

CREATE TABLE `training_session` (
  `SessionID` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `Distance` decimal(10,2) DEFAULT NULL,
  `Stroke` varchar(50) DEFAULT NULL,
  `Squad_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_session`
--

INSERT INTO `training_session` (`SessionID`, `Date`, `Distance`, `Stroke`, `Squad_id`) VALUES
(2, '2000-02-20', 100.00, 'Back', 4),
(3, '2020-02-20', 400.00, 'Back', 5);

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
(3, 'Emon4', '$2y$10$XJ6Lz4F842Q.AmKOLr5GqOpXl.K6bm.t88vSAIXXZj.k7xlH938CK', 'Emon', 'Singha', 'emonsingsha209@gmail.com', '2010-02-20', '01743217209', 'eqr', '2123', 'swimmer', 5),
(4, 'Emon5', '$2y$10$Pa7GeuIUtkEmBIn28TQbhuH/.Kwfzx1FBMK0FbzNByZ0vICwnR/5O', 'Emon', 'Singha', 'emonsiwngha2092@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(10, 'Emon8', '$2y$10$XsfM84d1cT0QPN/VN/sCPuSf3//Mj1wWtnxU9x6dJ8fozD78iQ6QC', 'Emon', 'Singha', 'emonsingssssha209@gmail.com', '2000-11-11', '01743217209', 'eqre', '2123', 'coach', NULL),
(13, 'John2', '$2y$10$7Zj.ubTnem6skGBEt5s9Te1dQYVa4O8fkwdtGIzvdC4gXmb8FgYfm', 'Emon22', 'Singha', 'emonsingha209222@gmail.com', '2000-02-20', '01743217209', 'eqr', '2123', 'coach', NULL),
(14, 'Emoner234rt', '$2y$10$qCLnCKRoU1ZVznmi449ho.v0NAbUuFbUceov0vSZUp2JFTijWagJq', 'Em', 'efwerfw', 'emon@example.com', '2023-02-20', '01743217209', 'Kuril', '123', 'coach', NULL),
(15, 'fwerw4er4w3r', '$2y$10$omE0OtAupSo9zAWUPSUp9.tCVuXnR/0XhUVYSh01CGf8lfsMwYCcq', 'ewr3r32', 'erwer', 'sheba@gmail.com', '1970-01-01', '12313123213', 'Kuril', '123', 'parent', NULL),
(16, 'Emwqeqw3e', '$2y$10$RMVTHXDZj3D9FTrj..tP.On6BFNHdLprEUFASAGWTjga8ODAWasTW', 'Enib', 'efwerfw', 'emon@example.com', '2912-02-20', '01743217209', 'Kuril', '123', 'coach', NULL),
(17, 'Emon1ww', '$2y$10$aYnjZwTrtnSuFzPvQ8JKl.COyRANaw0g.fpb6JuuwuGqhmmMakO.i', 'EmonSs', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(18, 'Emon2sadwf', '$2y$10$0VaENNtAUrj4DOzzQmEtwuTcYBHg9HPtfbYuU.OXQCY13EUAlp.Ia', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(19, 'Emon1wwwer', '$2y$10$4zDgUV8GzDDPK0s.pLjW9uS5md4Gg4nY7cFnU/dI5A3fxMgU7mnYC', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-02', '01743217209', 'eqr', '21233', 'coach', NULL),
(20, 'erf43r234rt2', '$2y$10$oYajNmoFMBEYRhU7TaRTrO3vvt9V2kJntdncQ6v7IIAQXayYOXhXG', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(21, 'Emon1wwweradsad', '$2y$10$kx1hBotMr3LHjgNQ5aqsL./aHxsbZD9beR7XOYZzXsm.0AhGk2hQG', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-02', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(22, 'Emon1wwweradsad', '$2y$10$kx1hBotMr3LHjgNQ5aqsL./aHxsbZD9beR7XOYZzXsm.0AhGk2hQG', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-02', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(23, 'erf43r234rt2we2we2w', '$2y$10$5HzlP.71x0ea2suIgypYD.PKZo2oZiFhpqnvGyOLbjPyTMVS0UrZC', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(24, 'erf43r234rt2we2we2w', '$2y$10$5HzlP.71x0ea2suIgypYD.PKZo2oZiFhpqnvGyOLbjPyTMVS0UrZC', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(25, 'Emon1wwweradsadsdswd', '$2y$10$7L9TzSBvcOtR919UD17x/OvLJgAtOUKaj/vn5LuqggOcU7L2nYgyi', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-11-02', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(26, 'Emon1wwweradsadsdswd', '$2y$10$7L9TzSBvcOtR919UD17x/OvLJgAtOUKaj/vn5LuqggOcU7L2nYgyi', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-11-02', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(27, 'erf43r234rt2we2we2wsadwqd', '$2y$10$ud82rc/ibi7QbVwMkHiOoODIJThv5R.HTq4GghG34JTIzI3/1FzEW', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(28, 'erf43r234rt2we2we2wsadwqd', '$2y$10$ud82rc/ibi7QbVwMkHiOoODIJThv5R.HTq4GghG34JTIzI3/1FzEW', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(29, 'Emon123', '$2y$10$3Ynlu.6YOQ03mkZGGOTcRuyoktWbYYTov.7LDShZWkgNpiv6p5zme', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(30, 'Emon124', '$2y$10$3Ynlu.6YOQ03mkZGGOTcRuyoktWbYYTov.7LDShZWkgNpiv6p5zme', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'coach', NULL),
(31, 'adfsewfdewqfeqw', '$2y$10$D9e58/4GrF6dDNmO2E6/Ce9GiXly/oBqOpQ/dUdAJlpx2LOFEU5h.', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(32, 'adfsewfdewqfeqw', '$2y$10$D9e58/4GrF6dDNmO2E6/Ce9GiXly/oBqOpQ/dUdAJlpx2LOFEU5h.', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(33, 'Emon1233', '$2y$10$95iLSRs5hsE9Yd427W1AmeoEM7fcCFu5U99X0aIzbqUySri9hklOG', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(34, 'Emon1233', '$2y$10$95iLSRs5hsE9Yd427W1AmeoEM7fcCFu5U99X0aIzbqUySri9hklOG', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(35, 'adfsewfdewqfeqwdweq', '$2y$10$szCg7kSFhiuEyiDhtQDuhOUXmb2zHGn0NoB9E/HA/eL5gzJsSxtjO', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(36, 'adfsewfdewqfeqwdweq', '$2y$10$szCg7kSFhiuEyiDhtQDuhOUXmb2zHGn0NoB9E/HA/eL5gzJsSxtjO', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(37, 'Emon123343', '$2y$10$/vc148pd4zzPCQrf.CXbEOP1/50lg9NzW7QTCpXe4q3EMyetZebru', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(38, 'Emon123343', '$2y$10$/vc148pd4zzPCQrf.CXbEOP1/50lg9NzW7QTCpXe4q3EMyetZebru', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(39, 'werwr', '$2y$10$D5AEerZxu2.UIVBgNXoSe.XePspozzb9EwhxO7dz0.c7FReddlb5O', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(40, 'werwr', '$2y$10$D5AEerZxu2.UIVBgNXoSe.XePspozzb9EwhxO7dz0.c7FReddlb5O', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(41, 'Emon1233', '$2y$10$95iLSRs5hsE9Yd427W1AmeoEM7fcCFu5U99X0aIzbqUySri9hklOG', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(42, 'Emon1233', '$2y$10$95iLSRs5hsE9Yd427W1AmeoEM7fcCFu5U99X0aIzbqUySri9hklOG', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(43, 'adfsewfdewqfeqwdweq', '$2y$10$szCg7kSFhiuEyiDhtQDuhOUXmb2zHGn0NoB9E/HA/eL5gzJsSxtjO', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(44, 'adfsewfdewqfeqwdweq', '$2y$10$szCg7kSFhiuEyiDhtQDuhOUXmb2zHGn0NoB9E/HA/eL5gzJsSxtjO', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(45, 'Emon1233430000', '$2y$10$t1jlyHHZHi43KXU8geZ91.fQ4REoLbA2SyUrbP5.urwhxx64GAZJ2', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(46, 'Emon1233430000', '$2y$10$t1jlyHHZHi43KXU8geZ91.fQ4REoLbA2SyUrbP5.urwhxx64GAZJ2', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(47, 'eqwdre', '$2y$10$n2QESBGs.ZJ4hv4/DGxbDuUc7dfbpjc8tCiFDaq1bnbgEM5ZdHgXO', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(48, 'eqwdre', '$2y$10$n2QESBGs.ZJ4hv4/DGxbDuUc7dfbpjc8tCiFDaq1bnbgEM5ZdHgXO', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(49, 'Emon000033430000', '$2y$10$6TY.7qVJ8G2wVEmyszaMg.mAOOlI1ZeZjJyuWXlQKadGTptSmix9W', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(50, 'Emon000033430000', '$2y$10$6TY.7qVJ8G2wVEmyszaMg.mAOOlI1ZeZjJyuWXlQKadGTptSmix9W', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2009-02-20', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(52, 'eqwdreedq3e', '$2y$10$S/.OPQ5ExpOitkMC2/4q7eqTJLso9TiQ7MQCYh.Lvm5n/QcEMA/OO', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(53, 'Emondqwed', '111', 'wfwef', 'dfswef', 'emon@example.com', '2011-02-02', '213123123', 'Kuril', '123', 'swimmer', NULL),
(54, 'Emondqwed', '111', 'wfwef', 'dfswef', 'emon@example.com', '2011-02-02', '213123123', 'Kuril', '123', 'swimmer', NULL),
(55, 'Shuvo', '$2y$10$tqxCSO7pg2PBP4.pKMmGMeqsGdbmPtq21.uuXtlkrDtl3DPbGedZe', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2010-02-20', '01743217209', 'eqr', '2123', 'swimmer', NULL),
(56, 'Shuvo0', '$2y$10$T.1hS6NMDICbka2lChItM.g6mXfY5Lgst0myrcDTle.1RTBM39KpK', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(57, 'Sss', '$2y$10$lacD2V9HtoZ3VwJjB0TYwenGjamwrb05X1MVr8aJ8y7HhdChb34B.', 'Emnon', 'wdwd', 'emon@example.com', '2010-02-02', '01743217211', 'Kuril', '111', 'coach', NULL),
(58, 'Asha', '$2y$10$sJZMxKWCCPhEPdEQy3lIteu34GK/Fl.MCfp9B2S4sZpA8N8cVUw26', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2010-02-20', '01743217209', 'eqr', '2123', 'swimmer', 4),
(59, 'AshaAAA ', '$2y$10$GFT9mJ7G.fqWxvj1rxJg4.93wT0QqULpqE7BjxolSIpFO62YdtqPa', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL),
(60, 'irin', '$2y$10$Smqfo7Di9u7FaYhoL4IzH.tR11A4YyJ7g6XITj4tf1GjszVAu3i9W', 'Emon', 'Singha', 'emonsingha209@gmail.com', '2010-02-20', '01743217209', 'eqr', '2123', 'swimmer', 4),
(61, 'tinni', '$2y$10$pGKEcCOeAqT.GMbO7byyBuUweK7YvKGRi4ZO2IrNTSy9AF9Gavc0e', 'Emon', 'Singha', 'emonsingha209@gmail.com', '1970-01-01', '01743217209', 'eqr', '2123', 'parent', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `training_performance`
--
ALTER TABLE `training_performance`
  ADD PRIMARY KEY (`PerformanceID`),
  ADD KEY `training_performance_ibfk_1` (`SessionID`),
  ADD KEY `training_performance_ibfk_2` (`Swimmer_id`);

--
-- Indexes for table `training_session`
--
ALTER TABLE `training_session`
  ADD PRIMARY KEY (`SessionID`),
  ADD KEY `Squad_id` (`Squad_id`);

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
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `meets`
--
ALTER TABLE `meets`
  MODIFY `MeetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `raceresults`
--
ALTER TABLE `raceresults`
  MODIFY `ResultID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `races`
--
ALTER TABLE `races`
  MODIFY `RaceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `squad`
--
ALTER TABLE `squad`
  MODIFY `squad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `training_performance`
--
ALTER TABLE `training_performance`
  MODIFY `PerformanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `training_session`
--
ALTER TABLE `training_session`
  MODIFY `SessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

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
-- Constraints for table `training_performance`
--
ALTER TABLE `training_performance`
  ADD CONSTRAINT `training_performance_ibfk_1` FOREIGN KEY (`SessionID`) REFERENCES `training_session` (`SessionID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `training_performance_ibfk_2` FOREIGN KEY (`Swimmer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `training_session`
--
ALTER TABLE `training_session`
  ADD CONSTRAINT `training_session_ibfk_1` FOREIGN KEY (`Squad_id`) REFERENCES `squad` (`squad_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`squad_id`) REFERENCES `squad` (`squad_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
