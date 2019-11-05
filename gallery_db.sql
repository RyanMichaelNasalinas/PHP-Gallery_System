-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2019 at 11:25 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `author` varchar(11) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `photo_id`, `author`, `body`) VALUES
(4, 44, 'awe', 'Wow great Photo'),
(5, 44, 'admin', 'Thanks!'),
(6, 44, 'admin', 'wewe');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(255) NOT NULL,
  `alternate_text` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `uploaded_by` varchar(255) NOT NULL,
  `date_uploaded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `title`, `caption`, `description`, `filename`, `alternate_text`, `type`, `size`, `uploaded_by`, `date_uploaded`) VALUES
(29, 'Photo1', 'Photo1', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>', 'bg.jpg', 'Photo1', 'image/jpeg', 37740, 'awe', '2019-11-05 13:58:27'),
(43, 'waaaaaaaaa', '', 'waaa', 'Picture1.png', '', 'image/png', 6796, 'awe', '2019-11-05 13:58:27'),
(44, 'wewew', '', 'wewe', 'Desert.jpg', '', 'image/jpeg', 845941, 'admin', '2019-11-05 13:58:27'),
(46, 'This is fucking Cool', '', 'Hydrangeas', 'Hydrangeas.jpg', '', 'image/jpeg', 595284, 'Manticore1996', '2019-11-05 13:58:27'),
(47, 'What the fuck', '', 'This photo break my brief', 'Chrysanthemum.jpg', '', 'image/jpeg', 879394, 'awe', '2019-11-05 00:00:00'),
(48, 'WEWEWEW', '', 'WEWE', 'Tulips.jpg', '', 'image/jpeg', 620888, 'awe', '0000-00-00 00:00:00'),
(49, 'ASDASDASDAS', '', 'QWES', 'Koala.jpg', '', 'image/jpeg', 780831, 'awe', '2019-11-05 23:04:15'),
(50, 'hehehe', '', 'heheh', 'stair_1_after.jpg', '', 'image/jpeg', 57574, 'awe', '2019-11-05 23:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `user_image`, `user_level`) VALUES
(37, 'admin', '$2y$10$RIb5QUjzlwXbvfDJtVw3DeOtH5E/6cph/UYsjEtdqTUgRaOf9GqoO', 'Admin', 'Admin', 'car.jpg', 'admin'),
(55, 'awe', '$2y$10$CmSHfsj2mTL5PmY491RfjuXqfqQm1PLlFJj1ahgEUkx9bcJBo/rZa', 'awe', 'awe', 'fun.jpg', 'user'),
(66, 'Manticore1996', '$2y$10$bVVn5PsQ1fBQNzdFMikPdutB2A.QPbrqNgfG6aAmPl.Vwtzw/obIG', 'Ryan Michael', 'Nasalinas', 'Hydrangeas.jpg', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_id` (`photo_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
