-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2017 at 01:46 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marathon`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkpointreport`
--

CREATE TABLE `checkpointreport` (
  `id` int(11) NOT NULL,
  `checkpointId` int(11) NOT NULL,
  `runnerId` int(11) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emergencyreport`
--

CREATE TABLE `emergencyreport` (
  `id` int(11) NOT NULL,
  `header` text NOT NULL,
  `detail` text NOT NULL,
  `runnerId` int(11) NOT NULL,
  `staffId` int(11) NOT NULL,
  `lag` double NOT NULL,
  `lng` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `emergencyreport`
--

INSERT INTO `emergencyreport` (`id`, `header`, `detail`, `runnerId`, `staffId`, `lag`, `lng`, `status`, `level`) VALUES
(1, 'testemergency', 't', 1, 1, 1.02, 2.02, 0, 3),
(3, 'wqeqwe', 'qweqweqwe', 2453, 4523, 452, 452, 1, 0),
(4, 'wqeqwe', 'qweqweqwe', 2453, 4523, 452, 452, 1, 0),
(5, 'qweqwe', 'qweqwe', 111, 111, 111, 111, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `header` text NOT NULL,
  `detail` text NOT NULL,
  `author` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `problemreport`
--

CREATE TABLE `problemreport` (
  `id` int(11) NOT NULL,
  `header` text NOT NULL,
  `detail` text NOT NULL,
  `senderId` int(11) NOT NULL,
  `staffId` int(11) NOT NULL,
  `lag` double NOT NULL,
  `lng` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problemreport`
--

INSERT INTO `problemreport` (`id`, `header`, `detail`, `senderId`, `staffId`, `lag`, `lng`, `status`, `level`) VALUES
(1, 'test', 'test', 111, 111, 1.2, 1.2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `runner`
--

CREATE TABLE `runner` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `sSID` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `runner`
--

INSERT INTO `runner` (`id`, `fname`, `lname`, `sSID`, `tel`, `username`, `password`) VALUES
(1, 'testFname', 'testLname', 'testSSID', 'testTel', 'testUser', 'testPass'),
(2, 'qweqwe', 'qweqw', 'qweqwe', 'qweqwe', 'qweqwe', 'qweqwe');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL,
  `lag` double NOT NULL,
  `lng` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `category` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `fname`, `lname`, `category`, `username`, `password`) VALUES
(1, 'testFname', 'testLName', 'water', 'teststaff', 'passstaff'),
(2, 'firstname', 'lastname', 'checkpoint', 'username1', 'password1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkpointreport`
--
ALTER TABLE `checkpointreport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergencyreport`
--
ALTER TABLE `emergencyreport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problemreport`
--
ALTER TABLE `problemreport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `runner`
--
ALTER TABLE `runner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkpointreport`
--
ALTER TABLE `checkpointreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emergencyreport`
--
ALTER TABLE `emergencyreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `problemreport`
--
ALTER TABLE `problemreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `runner`
--
ALTER TABLE `runner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
