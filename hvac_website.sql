-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307:3307
-- Generation Time: Apr 30, 2024 at 10:12 AM
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
-- Database: `hvac_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `Username` varchar(12) NOT NULL,
  `Password` varchar(12) NOT NULL,
  `FirstName` varchar(32) NOT NULL,
  `LastName` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `Username`, `Password`, `FirstName`, `LastName`) VALUES
(1, 'admin', 'a_password', 'Jimmy', 'Adminman');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `AppointmentID` int(11) NOT NULL,
  `Date` varchar(11) NOT NULL,
  `Time` time NOT NULL,
  `Price` varchar(64) NOT NULL,
  `Urgency` varchar(32) NOT NULL,
  `CustomerEmail` varchar(64) NOT NULL,
  `TechnicianID` int(11) NOT NULL,
  `AdminID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `FirstName` varchar(32) NOT NULL,
  `LastName` varchar(32) NOT NULL,
  `HouseSize` varchar(32) NOT NULL,
  `Phone` varchar(64) NOT NULL,
  `Street` varchar(64) NOT NULL,
  `City` varchar(32) NOT NULL,
  `USState` varchar(32) NOT NULL,
  `Email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `technician`
--

CREATE TABLE `technician` (
  `TechnicianID` int(11) NOT NULL,
  `FirstName` varchar(32) NOT NULL,
  `LastName` varchar(32) NOT NULL,
  `Username` varchar(12) NOT NULL,
  `Password` varchar(12) NOT NULL,
  `AdminID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technician`
--

INSERT INTO `technician` (`TechnicianID`, `FirstName`, `LastName`, `Username`, `Password`, `AdminID`) VALUES
(1, 'Techie', 'Smith', 'tech_smith', 't_password', 1),
(8, 'New', 'Guy', 'new_guy', 'new_pass', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`AppointmentID`),
  ADD KEY `TechnicianID` (`TechnicianID`),
  ADD KEY `CustomerEmail` (`CustomerEmail`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `CustomerID` (`CustomerID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `technician`
--
ALTER TABLE `technician`
  ADD PRIMARY KEY (`TechnicianID`),
  ADD UNIQUE KEY `TechnicianID` (`TechnicianID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `AdminID` (`AdminID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `AppointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `technician`
--
ALTER TABLE `technician`
  MODIFY `TechnicianID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`TechnicianID`) REFERENCES `technician` (`TechnicianID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_4` FOREIGN KEY (`CustomerEmail`) REFERENCES `customer` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `technician`
--
ALTER TABLE `technician`
  ADD CONSTRAINT `technician_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
