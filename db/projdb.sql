-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2023 at 05:41 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trace`
--

CREATE TABLE `tbl_trace` (
  `trailid` int(11) NOT NULL,
  `uname` varchar(15) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `action` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `tranID` int(11) NOT NULL,
  `refnum` varchar(15) DEFAULT NULL,
  `number` int(12) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`tranID`, `refnum`, `number`, `amount`, `name`, `date_created`) VALUES
(27, '0008203579976', 2147483647, 1350, 'Juan Dela Cruz', '2023-02-26 03:58:34'),
(28, '108203579976', 2147483647, 2000, 'Jose Dela Cruz', '2023-02-26 03:58:50'),
(29, '012300820357997', 2147483647, 1350, 'Jose Dela Cruz', '2023-02-26 03:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `uid` int(11) NOT NULL,
  `uname` varchar(10) DEFAULT NULL,
  `pass` varchar(75) DEFAULT NULL,
  `lname` varchar(15) DEFAULT NULL,
  `fname` varchar(15) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `position` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`uid`, `uname`, `pass`, `lname`, `fname`, `entry_date`, `position`) VALUES
(1, 'dnovencido', '13193ca3548b6fbdd0747b346ff94ec7', 'Novencido', 'Denver', '2023-02-25', 'Staff'),
(8, 'ben118', 'a64ee113b4b0356ed1754891310e7bc0', 'Dela Cruz', 'Ben', '2023-02-26', 'Staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_trace`
--
ALTER TABLE `tbl_trace`
  ADD PRIMARY KEY (`trailid`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`tranID`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_trace`
--
ALTER TABLE `tbl_trace`
  MODIFY `trailid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `tranID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
