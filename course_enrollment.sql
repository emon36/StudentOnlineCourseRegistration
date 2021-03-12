-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2021 at 04:36 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_enrollment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `date`) VALUES
(1, 'emon36', 'admin123', '2021-03-09 14:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `courseenrolls`
--

CREATE TABLE `courseenrolls` (
  `id` int(11) NOT NULL,
  `studentRegno` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `status` int(11) DEFAULT 0,
  `edate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courseenrolls`
--

INSERT INTO `courseenrolls` (`id`, `studentRegno`, `session`, `department`, `level`, `course`, `semester`, `section`, `status`, `edate`) VALUES
(7, '162-15-7789', '2021', 'CSE', 'Level 1', 'Computer basics', 'spring 2021', '', 1, '2021-03-08 16:40:45'),
(8, '162-15-7789', '2021', 'CSE', 'Level 1', 'Algorithms ', 'spring 2021', '', 1, '2021-03-09 14:42:48'),
(9, '162-15-7779', '2021', 'CSE', 'Level 1', 'Algorithms ', 'spring 2021', '', 0, '2021-03-09 14:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `courseCode` varchar(255) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `noofSeats` int(11) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `courseCode`, `courseName`, `section`, `noofSeats`, `creationDate`) VALUES
(1, 'CSE 111', 'Computer basics', 'A,B,C,D,E,F', 248, '2021-03-08 16:40:45'),
(2, 'CSE 112', 'Algorithms ', 'A,B,C,D,E', 247, '2021-03-09 14:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `creationDate`) VALUES
(2, 'CSE', '2021-03-05 15:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `level` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `level`, `creationDate`) VALUES
(1, 'Level 1', '2021-03-05 15:08:00'),
(2, 'Level 2', '2021-03-05 15:08:15'),
(4, 'Level 3', '2021-03-05 15:08:26'),
(5, 'Level 4', '2021-03-05 15:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `is_active` int(11) DEFAULT 0,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semester`, `is_active`, `creationDate`) VALUES
(1, 'spring 2021', 1, '2021-03-10 06:57:23'),
(2, 'summer 2021', 0, '2021-03-10 06:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `is_active` int(11) DEFAULT 0,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `session`, `is_active`, `creationDate`) VALUES
(1, '2021', 1, '2021-03-10 07:05:49'),
(12, '2020', 0, '2021-03-10 07:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `studentName` varchar(255) NOT NULL,
  `StudentRegno` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `studentPhoto` varchar(255) NOT NULL,
  `cgpa` varchar(255) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `studentName`, `StudentRegno`, `password`, `studentPhoto`, `cgpa`, `creationdate`) VALUES
(13, 'Md. Shahbuddin Emon', '162-15-7789', '222333', 'bcs size.jpg', '3.20', '2021-03-09 06:50:33'),
(15, 'Moinul Islam', '162-15-7779', '444555', '', '', '2021-03-09 14:37:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courseenrolls`
--
ALTER TABLE `courseenrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courseenrolls`
--
ALTER TABLE `courseenrolls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
