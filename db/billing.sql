-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2016 at 07:05 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `billing`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lessee`
--

CREATE TABLE `tbl_lessee` (
  `lessee_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `rental_fee` float(15,2) NOT NULL,
  `balance` float(15,2) NOT NULL,
  `water_reading` float(20,2) NOT NULL,
  `electric_reading` float(20,2) NOT NULL,
  `status` varchar(100) NOT NULL,
  `last_statement` varchar(100) NOT NULL,
  `property_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lessee`
--

INSERT INTO `tbl_lessee` (`lessee_id`, `firstname`, `middlename`, `lastname`, `contact`, `unit`, `rental_fee`, `balance`, `water_reading`, `electric_reading`, `status`, `last_statement`, `property_name`) VALUES
(1, 'fejie', 'sorono', 'fairolen', '09123', '12', 2222.00, 0.00, 300.20, 500.10, 'open', 'APRIL 2016', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_properties`
--

CREATE TABLE `tbl_properties` (
  `id` int(11) NOT NULL,
  `property_name` varchar(500) NOT NULL,
  `property_pic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_properties`
--

INSERT INTO `tbl_properties` (`id`, `property_name`, `property_pic`) VALUES
(1, 'Royal Crowne', '13228022_1342348672447396_1167871297_n.jpg'),
(2, 'General Account', '13149929_1342348282447435_1784404737_n.jpg'),
(3, 'Downtown', '13219788_1342348299114100_66166953_n.jpg'),
(4, 'Enzuri', '13219991_1342350352447228_895276656_n.jpg'),
(5, 'South Avenue', '13233417_1342348389114091_1199929960_n.jpg'),
(6, 'Oakridge Residences', '13235708_1342348265780770_757993386_n.jpg'),
(7, 'Island Crest Residences', '13235719_1342348352447428_2099873685_n.jpg'),
(8, 'City Gate Residences', '13235976_1342348425780754_918706109_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rates`
--

CREATE TABLE `tbl_rates` (
  `rate_id` int(11) NOT NULL,
  `water_rate` float NOT NULL,
  `electric_rate` float NOT NULL,
  `interest_rate` float(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `trans_id` int(11) NOT NULL,
  `bill_id` varchar(200) NOT NULL,
  `lessee_id` varchar(100) NOT NULL,
  `start_water` float(15,2) NOT NULL,
  `end_water` float(15,2) NOT NULL,
  `start_electric` float(15,2) NOT NULL,
  `end_electric` float(15,2) NOT NULL,
  `past_due` varchar(100) NOT NULL,
  `interest_rate` varchar(100) NOT NULL,
  `prepare_by` varchar(100) NOT NULL,
  `date_printed` date NOT NULL,
  `rental_fee` float(15,2) NOT NULL,
  `cubic_consumed` varchar(100) NOT NULL,
  `interest` float(15,2) NOT NULL,
  `month_statement` varchar(100) NOT NULL,
  `total_amount` float(15,2) NOT NULL,
  `electric_consumed` varchar(100) NOT NULL,
  `water_due` float(15,2) NOT NULL,
  `electric_due` float(15,2) NOT NULL,
  `mcwd_rate` float(15,2) NOT NULL,
  `veco_rate` float(15,2) NOT NULL,
  `property_id` varchar(100) NOT NULL,
  `paid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`trans_id`, `bill_id`, `lessee_id`, `start_water`, `end_water`, `start_electric`, `end_electric`, `past_due`, `interest_rate`, `prepare_by`, `date_printed`, `rental_fee`, `cubic_consumed`, `interest`, `month_statement`, `total_amount`, `electric_consumed`, `water_due`, `electric_due`, `mcwd_rate`, `veco_rate`, `property_id`, `paid`) VALUES
(1, 'JGU4SJJMB', '1', 100.00, 233.00, 22.00, 222.00, '213', '', 'admin', '2016-05-21', 2222.00, '133', 0.00, 'jan', 2435.00, '200', 0.00, 0.00, 0.00, 0.00, '1', ''),
(2, 'TO1RAFQP4', '1', 233.00, 250.00, 222.00, 300.00, '100', '', 'admin', '2016-05-21', 2222.00, '17', 0.00, 'feb', 2322.00, '78', 0.00, 0.00, 0.00, 0.00, '1', ''),
(3, '2O1I3013G', '1', 250.00, 300.20, 300.00, 500.10, '2000', '', 'admin', '2016-05-22', 2222.00, '50.2', 0.00, 'APRIL 2016', 4222.00, '200.1', 0.00, 0.00, 0.00, 0.00, '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `fullname`, `status`, `type`, `date_registered`) VALUES
(1, 'admin', 'jan232015', 'admin', 'active', 'default', '2016-05-08 07:04:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_lessee`
--
ALTER TABLE `tbl_lessee`
  ADD PRIMARY KEY (`lessee_id`);

--
-- Indexes for table `tbl_properties`
--
ALTER TABLE `tbl_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rates`
--
ALTER TABLE `tbl_rates`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_lessee`
--
ALTER TABLE `tbl_lessee`
  MODIFY `lessee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_properties`
--
ALTER TABLE `tbl_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_rates`
--
ALTER TABLE `tbl_rates`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
