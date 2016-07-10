-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 10, 2016 at 09:35 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `work2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `BOOKING_ID` int(20) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL,
  `BOOKER` varchar(300) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `FLOOR` varchar(255) NOT NULL,
  `ROOM_BOOKED` varchar(255) NOT NULL,
  `ITEMS_NEEDED` varchar(255) NOT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date NOT NULL,
  `START_TIME` time NOT NULL,
  `END_TIME` time NOT NULL,
  `STATUS` set('APPROVED','DISAPPROVED','PENDING','') NOT NULL DEFAULT 'PENDING',
  `COLOUR` varchar(15) NOT NULL DEFAULT '#1E90FF'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`BOOKING_ID`, `NAME`, `DESCRIPTION`, `BOOKER`, `EMAIL`, `FLOOR`, `ROOM_BOOKED`, `ITEMS_NEEDED`, `START_DATE`, `END_DATE`, `START_TIME`, `END_TIME`, `STATUS`, `COLOUR`) VALUES
(83, 'wow', 'dfd', 'me', 'brimarte@live.com', '2nd Floor', 'Large Hall', '', '2016-07-03', '2016-07-03', '06:00:00', '10:00:00', 'APPROVED', '#1E90FF'),
(84, 'wow', 'dfd', 'me', 'brimarte@live.com', '2nd Floor', 'Large Hall', '', '2016-07-03', '2016-07-03', '06:00:00', '10:00:00', 'DISAPPROVED', '#1E90FF'),
(85, 'wow', 'dfd', 'me', 'brimarte@live.com', '2nd Floor', 'Large Hall', '', '2016-07-03', '2016-07-03', '06:00:00', '10:00:00', 'PENDING', '#1E90FF');

-- --------------------------------------------------------

--
-- Table structure for table `floor`
--

CREATE TABLE `floor` (
  `FLOOR_ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `floor`
--

INSERT INTO `floor` (`FLOOR_ID`, `NAME`) VALUES
(1, '2nd Floor'),
(2, '9th Floor'),
(3, '8th Floor');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ITEM_ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ITEM_ID`, `NAME`) VALUES
(1, 'Projector'),
(2, 'Audio System'),
(3, 'Refreshments');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`ID`, `NAME`) VALUES
(0, 'Normal'),
(1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `ROOM_ID` int(20) NOT NULL,
  `ROOM_NAME` varchar(300) NOT NULL,
  `FLOOR_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`ROOM_ID`, `ROOM_NAME`, `FLOOR_ID`) VALUES
(1, 'Board Room', 2),
(2, 'Large Hall', 1),
(3, 'Room 8A', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(30) NOT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `FIRSTNAME` varchar(255) NOT NULL,
  `LASTNAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `LEVEL` int(10) NOT NULL DEFAULT '0',
  `PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `USERNAME`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `LEVEL`, `PASSWORD`) VALUES
(1, 'admin', 'crbooking', 'NCA', 'crbooking@nca.org.gh', 1, '3ec51cf42506697ecd72e441c3e62486');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BOOKING_ID`);

--
-- Indexes for table `floor`
--
ALTER TABLE `floor`
  ADD PRIMARY KEY (`FLOOR_ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ITEM_ID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`ROOM_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BOOKING_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `floor`
--
ALTER TABLE `floor`
  MODIFY `FLOOR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ITEM_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `ROOM_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
