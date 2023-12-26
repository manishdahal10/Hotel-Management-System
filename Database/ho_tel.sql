-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2023 at 08:44 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ho_tel`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `about_image` varchar(255) NOT NULL,
  `about_title` varchar(255) NOT NULL,
  `about_content` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`about_image`, `about_title`, `about_content`) VALUES
('about.jpg', 'About Us', 'We pride ourselves on providing exceptional service and exceeding our guests\' expectations. From the moment you step into our elegant lobby, you\'ll be greeted by our friendly and attentive staff, dedicated to ensuring your stay is nothing short of extraordinary.\r\n<br>\r\nOur accommodations are designed to offer the utmost comfort and style. Each room and suite is meticulously appointed with luxurious amenities, plush bedding, and stunning views of the city/surrounding landscape. Whether you choose a spacious suite or a cozy room, every detail has been carefully curated to create a serene and inviting atmosphere.\r\n\r\n\r\n\r\nFor those seeking relaxation and rejuvenation, our wellness facilities are designed to pamper your body and mind. Unwind with a revitalizing spa treatment, take a refreshing dip in our sparkling pool, or maintain your fitness routine in our state-of-the-art fitness center.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `booking_order_id` varchar(255) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkin_time` time NOT NULL,
  `checkout_date` date NOT NULL,
  `number_of_stays` int(11) NOT NULL,
  `total_price` int(255) NOT NULL,
  `accept_reject_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `booking_order_id`, `room_id`, `room_name`, `user_id`, `name`, `contact`, `payment_method`, `checkin_date`, `checkin_time`, `checkout_date`, `number_of_stays`, `total_price`, `accept_reject_status`) VALUES
(69, '8GVBRHTB', 39, 'Super Deluxx', 29, 'Manish Dahal', '498897394', 'Debit Card', '2023-10-05', '15:22:00', '2023-10-10', 4, 1090, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `checked_out`
--

CREATE TABLE `checked_out` (
  `booking_id` int(11) NOT NULL,
  `booking_order_id` varchar(255) NOT NULL,
  `room_id` varchar(255) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `guest_name` varchar(255) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkin_time` time NOT NULL,
  `checkout_date` date NOT NULL,
  `number_of_stays` int(11) NOT NULL,
  `total_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checked_out`
--

INSERT INTO `checked_out` (`booking_id`, `booking_order_id`, `room_id`, `room_name`, `user_id`, `guest_name`, `contact`, `payment_method`, `checkin_date`, `checkin_time`, `checkout_date`, `number_of_stays`, `total_price`) VALUES
(16, '54YCH1HG', '33', 'Manish', 29, 'Manish Dahal', '988', 'Debit Card', '2023-09-06', '22:07:00', '2023-09-30', 23, '5631');

-- --------------------------------------------------------

--
-- Table structure for table `check_in`
--

CREATE TABLE `check_in` (
  `booking_id` int(11) NOT NULL,
  `booking_order_id` varchar(255) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `guest_name` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkin_time` time NOT NULL,
  `checkout_date` date NOT NULL,
  `number_of_stays` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `gallery_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `gallery_image`) VALUES
(19, 'gallery1.jpg'),
(20, 'gallery2.jpg'),
(21, 'gallery3.jpg'),
(22, 'gallery4.jpg'),
(23, 'gallery5.jpg'),
(24, 'gallery6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(30) NOT NULL,
  `room` varchar(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `status` varchar(255) NOT NULL COMMENT '0 = Available , 1= Unavailable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room`, `category_id`, `status`) VALUES
(14, 'Manish', 17, ' Available');

-- --------------------------------------------------------

--
-- Table structure for table `room_categories`
--

CREATE TABLE `room_categories` (
  `room_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `quantity` int(50) NOT NULL,
  `adult` int(50) NOT NULL,
  `children` int(50) NOT NULL,
  `desc` varchar(1000) NOT NULL,
  `facilities` varchar(50) NOT NULL,
  `features` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_categories`
--

INSERT INTO `room_categories` (`room_id`, `name`, `price`, `image`, `area`, `quantity`, `adult`, `children`, `desc`, `facilities`, `features`) VALUES
(33, 'Premium Delux', '244', '4.jpg', '267', 12, 9, 3, 'ucshaiu', 'WiFi,Air Conditioning', 'Bedroom,Balcony,Kitchen'),
(39, 'Super Deluxx', '250', 'room-1.jpg', '130', 12, 8, 4, 'A room is an enclosed space within a building that is typically used for a specific purpose, such as living, sleeping, working, or storing items. Rooms can vary in size and design, and they are usually separated by walls and doors from other areas of a building. Each room serves a particular function and is often furnished and decorated accordingly. For example, a bedroom is a room designed for sleeping and relaxation, typically containing a bed, wardrobe, and other furnishings for personal comfort. Similarly, a living room is a common area for socializing and entertaining, usually furnished with sofas, chairs, a television, and other amenities.', 'WiFi,Air Conditioning,Telephone,Spa', 'Bedroom,Balcony,Kitchen'),
(40, 'Family Room', '150', 'room-4.jpg', '250', 11, 12, 13, 'anhdfiuhs iud i', 'WiFi,Air Conditioning', 'Bedroom,Balcony,Kitchen'),
(41, 'Super DE', '255', '2.jpg', '200', 5, 2, 3, 'Front View of Sea\r\n', 'WiFi,Air Conditioning,Room Heater', 'Bedroom,Balcony,Kitchen');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `email`, `phone`, `password`, `address`, `gender`) VALUES
(29, 'Manish Dahal', 'luffyung', 'verseflux@gmail.com', '9844975896', 'd8578edf8458ce06fbc5', 'Koteshwor', 'Male'),
(30, 'New User', 'manish12', 'manish@gmail.com', '123445678', '59c95189ac895fcc1c6e', 'lokanthali', 'Male'),
(31, 'Newcheck', 'man12345', 'ba@gmail.com', '984105678', 'qwerty', 'kotesg', 'male'),
(32, 'Manish Dahal', 'luffyung123', 'verseflu@gmail.com', '9844975896', 'd8578edf8458ce06fbc5', 'Nowww', 'Male'),
(33, 'Manish Dahal', 'luffyung234', 'versefx@gmail.com', '9844975896', 'e10adc3949ba59abbe56', 'london', 'Male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `checked_out`
--
ALTER TABLE `checked_out`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `check_in`
--
ALTER TABLE `check_in`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_categories`
--
ALTER TABLE `room_categories`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `checked_out`
--
ALTER TABLE `checked_out`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `check_in`
--
ALTER TABLE `check_in`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `room_categories`
--
ALTER TABLE `room_categories`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
