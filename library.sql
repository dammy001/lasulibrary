-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2019 at 10:03 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_books`
--

CREATE TABLE `add_books` (
  `id` int(11) NOT NULL,
  `bookName` varchar(255) NOT NULL,
  `book_image` varchar(255) NOT NULL,
  `book_category` varchar(255) NOT NULL,
  `book_author_name` varchar(255) NOT NULL,
  `book_publication_date` varchar(255) NOT NULL,
  `book_purchase_date` varchar(255) NOT NULL,
  `book_qty` varchar(255) NOT NULL,
  `available_qty` varchar(255) NOT NULL,
  `libarian_username` varchar(255) NOT NULL,
  `dateAdded` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_books`
--

INSERT INTO `add_books` (`id`, `bookName`, `book_image`, `book_category`, `book_author_name`, `book_publication_date`, `book_purchase_date`, `book_qty`, `available_qty`, `libarian_username`, `dateAdded`) VALUES
(3, 'Introduction to SQL', 'ionic.png', 'Programming', 'S.A Aribisala', '2017-11-28', '2019-12-29', '100', '100', 'admin', '19-Oct-2019'),
(4, 'Algorithm', 'icon.png', 'Computer Science', 'J.J. Stroud', '2019-02-06', '2019-11-04', '200', '199', 'staff001', '08-Nov-2019');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `staffNo` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastLogin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `staffNo`, `contact`, `password`, `lastLogin`) VALUES
(1, 'Damilare', 'Anjorin', 'staff001', '08106420637', 'staff001', '2019-11-26 02:02:32pm');

-- --------------------------------------------------------

--
-- Table structure for table `issue_books`
--

CREATE TABLE `issue_books` (
  `id` int(11) NOT NULL,
  `student_matricno` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_department` varchar(255) NOT NULL,
  `student_level` varchar(255) NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_issue_date` varchar(255) NOT NULL,
  `book_return_date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_books`
--

INSERT INTO `issue_books` (`id`, `student_matricno`, `student_name`, `student_department`, `student_level`, `student_email`, `book_name`, `book_issue_date`, `book_return_date`, `status`) VALUES
(1, '150591031', 'damilare damilare', 'computer science', '300', 'damilare', 'Algorithm', '08-Nov-2019', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `student_matricno` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `timesent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `admin_username`, `student_matricno`, `title`, `message`, `status`, `timesent`) VALUES
(3, 'admin', '150591031', 'dsdskk', 'kldsfkklk', '1', '08-Mar-2019 11:37:28am');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(100) NOT NULL,
  `matricno` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `dateRegistered` varchar(255) NOT NULL,
  `approveBy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `matricno`, `firstname`, `lastname`, `email`, `faculty`, `department`, `level`, `image`, `password`, `status`, `dateRegistered`, `approveBy`) VALUES
(4, '150591065', 'Alimat', 'Lawal', 'lawalalimat@gmail.com', 'Sciences', 'Computer Science', '400', '56960689_2260069880738641_8666675414082519040_o.jpg', 'alimat', '1', '2019-11-22', 'staff001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_books`
--
ALTER TABLE `add_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_books`
--
ALTER TABLE `issue_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
-- AUTO_INCREMENT for table `add_books`
--
ALTER TABLE `add_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `issue_books`
--
ALTER TABLE `issue_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
