-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2017 at 03:37 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `UNAME` varchar(50) DEFAULT NULL,
  `PWD` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`UNAME`, `PWD`) VALUES
('admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `enmae` varchar(100) DEFAULT NULL,
  `eventid` varchar(100) DEFAULT NULL,
  `day` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `times` varchar(100) DEFAULT NULL,
  `venue` varchar(100) DEFAULT NULL,
  `picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`enmae`, `eventid`, `day`, `date`, `times`, `venue`, `picture`) VALUES
('abcd', 'E-1001', 'Wednesday', '2017-06-28', '9:00-12:00', 'abc', 'Rakesh.jpg'),
('ac', 'E-1002', 'Thursday', '2017-06-29', '9:00-12:00', 'ac', 'th[1].jpg'),
('a', 'E-1003', 'Thursday', '2017-06-29', '8:00-12:00', 'ab', 'Rakesh.jpg'),
('xyz', 'E-1004', 'Friday', '2017-06-30', '9:00-12:00', 'abc', 'raaja.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `PHOTO` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`PHOTO`) VALUES
('icon-service.jpg'),
('homepage06.gif'),
('nishanth.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mastertable`
--

CREATE TABLE `mastertable` (
  `FNAME` varchar(50) DEFAULT NULL,
  `MNAME` varchar(50) DEFAULT NULL,
  `LNAME` varchar(50) DEFAULT NULL,
  `POYR` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mastertable`
--

INSERT INTO `mastertable` (`FNAME`, `MNAME`, `LNAME`, `POYR`) VALUES
('joshi', 'joshi', 'joshi', '2015'),
('Aanand', 'Raaja', 'T', '2014'),
('Nishanth', 'Ananathram', 'S', '2013'),
('Rakesh', 'Kumar', 'SG', '2012'),
('Rahul', 'Lokesh', 'NS', '2011'),
('sri', 'ram', 'S', '2015'),
('Vivek', 'Kumar', 'Sinha', '2014'),
('Rohit', 'Shankar', 'SV', '2011'),
('abc', 'abc', 'abc', '2015'),
('abe', 'abe', 'abe', '2016'),
('ade', 'ade', 'ade', '2016'),
('ade1', 'ade1', 'ade1', '2015');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `FNAME` varchar(50) DEFAULT NULL,
  `MNAME` varchar(50) DEFAULT NULL,
  `LNAME` varchar(50) DEFAULT NULL,
  `GENDER` varchar(100) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `ADDRESS` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `POYR` varchar(50) DEFAULT NULL,
  `MOBILE` varchar(50) DEFAULT NULL,
  `PHOTO` varchar(100) DEFAULT NULL,
  `PASSWORD` varchar(50) DEFAULT NULL,
  `VERIFY` varchar(50) DEFAULT NULL,
  `qualify` varchar(500) DEFAULT NULL,
  `profession` varchar(500) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `jborhstd` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`FNAME`, `MNAME`, `LNAME`, `GENDER`, `DOB`, `ADDRESS`, `EMAIL`, `POYR`, `MOBILE`, `PHOTO`, `PASSWORD`, `VERIFY`, `qualify`, `profession`, `branch`, `jborhstd`) VALUES
('abc', 'abc', 'abc', 'Male', '1990-10-10', '12', 'vskartscreation2014@gmail.com', '2015', '1231222121', 'linkedin.gif', 'a123', 'Yes', 'Diploma', 'Student', 'CS', 'Higher Studies'),
('abe', 'abe', 'abe', 'Male', '1990-10-10', '12', 'rockstarvsk2015@gmail.com', '2015', '1231222122', 'amar.png', 'abe', 'Yes', 'Diploma', 'Student', 'CS', 'Job'),
('ade', 'ade', 'ade', 'Male', '1990-10-10', '12', 'rockonvsk@gmail.com', '2015', '1231222121', 'amar.png', 'ade', 'Yes', 'Diploma', 'Student', 'CS', 'Job'),
('ade1', 'ade1', 'ade1', 'Male', '1990-10-10', '12', 'vskmusicworld@gmail.com', '2015', '1231222121', 'amar.png', 'ade1', 'Yes', 'Diploma', 'Student', 'CS', 'Higher Studies'),
('abc', 'aa', 'ss', 'Male', '1990-10-10', '12', 'a@g.com', '2015', '2131212131', 'Rakesh.jpg', 'a123', 'Yes', 'BE', 'Student', 'CS', 'Job'),
('b', 'b', 'b', 'Male', '1990-10-10', '21', 'b@g.com', '2015', '4112142312', 'amar.png', 'b123', 'Yes', 'BE', 'Student', 'CS', 'Higher Studies'),
('c', 'c', 'c', 'Male', '1990-10-10', '14', 'c@g.com', '2015', '1451241441', 'amar.png', 'c123', 'Yes', 'BE', 'Student', 'CS', 'Higher Studies'),
('d', 'd', 'd', 'Male', '1990-12-12', '14', 'd@g.com', '2015', '1231222221', 'raaja.jpg', 'd123', 'Yes', 'BE', 'Student', 'CS', 'Job'),
('e', 'e', 'e', 'Male', '1990-10-10', '16', 'e@g.com', '2015', '1617131152', 'raaja.jpg', 'e123', 'Yes', 'BE', 'Student', 'CS', 'Job'),
('f', 'f', 'f', 'Male', '1990-10-10', '14', 'f@g.com', '2015', '1212121412', 'raaja.jpg', 'f123', 'Yes', 'BE', 'Student', 'CS', 'Job');

-- --------------------------------------------------------

--
-- Table structure for table `tempmail`
--

CREATE TABLE `tempmail` (
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tempmail`
--

INSERT INTO `tempmail` (`email`) VALUES
('vskartscreation2014@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
