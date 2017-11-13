-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2017 at 04:50 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
(1, 'test new emergency', 'test new emergency', 1, 3, 18.804320806128, 98.951153755188, 0, 1),
(2, '123123', '1123', 2, 3, 18.805268841449, 98.960251805547, 0, 3);

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
(1, 'test new problem', 'test new problem', 3, 1, 18.804365239427, 98.952655792236, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `runner`
--

CREATE TABLE `runner` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `sSID` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `runner`
--

INSERT INTO `runner` (`id`, `fname`, `lname`, `type`, `sSID`, `tel`, `username`, `password`) VALUES
(1, 'testFname', 'testLname', 'marathon', 'testSSID', 'testTel', 'testUser', 'testPass'),
(2, 'qweqwe', 'qweqw', 'half-marathon', 'qweqwe', 'qweqwe', 'qweqwe', 'qweqwe');

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
  `password` text NOT NULL,
  `images` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `fname`, `lname`, `category`, `username`, `password`, `images`) VALUES
(1, 'testFname', 'testLName', 'water', 'teststaff', 'passstaff', ''),
(2, 'firstname', 'lastname', 'checkpoint', 'username1', 'password1', ''),
(7, 'qweqwe', 'qweqwe', 'qweqw', 'qweqwe', 'qweq', '20170810_145804.jpg'),
(8, 'test', 'test', 'test', 'test', 'test', '20170810_145753.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
