-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2017 at 03:54 PM
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
  `header` varchar(5000) NOT NULL,
  `detail` varchar(5000) NOT NULL,
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
(1, 'Checkpoint 2', 'Accident at checkpoint 2', 1, 2, 18.805099838307, 98.950178963423, 0, 1),
(2, 'Checkpoint 3', 'Accident at checkpoint 3', 2, 2, 18.804824171552, 98.949492317915, 0, 2);

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
  `header` varchar(5000) NOT NULL,
  `detail` varchar(5000) NOT NULL,
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
(1, 'Water in Checkpoint 2', 'No water', 2, 1, 18.805189792683, 98.950007302046, 0, 2);

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
  `password` varchar(255) NOT NULL,
  `images` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `runner`
--

INSERT INTO `runner` (`id`, `fname`, `lname`, `type`, `sSID`, `tel`, `username`, `password`, `images`) VALUES
(1, 'Chaloempong', 'Budkra', 'Mini Marathon', '1659900779653', '0831611245', 'illumillal', '123456', 'runner3.jpg'),
(2, 'Poramin', 'Sornngam', 'Marathon', '1659900676432', '0831611345', 'illumillal', '123456', 'runner1.jpg'),
(3, 'Nicharee', 'Yooyong', 'Half Marathon', '165889944623', '084163453', 'illumillal', '123456', 'runner2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `category` varchar(5000) NOT NULL,
  `lag` double NOT NULL,
  `lng` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `fname` varchar(5000) NOT NULL,
  `lname` varchar(5000) NOT NULL,
  `category` varchar(5000) NOT NULL,
  `username` varchar(5000) NOT NULL,
  `password` varchar(5000) NOT NULL,
  `images` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `fname`, `lname`, `category`, `username`, `password`, `images`) VALUES
(1, 'Panpech', 'Pothong', 'Water', 'oattimman', '1234567', 'staff2.jpg'),
(2, 'Thanongsak', ' Nate-anong', 'Checkpoint', 'illumillal', '1234567', 'staff1.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
