-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2018 at 10:14 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dricon`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loan`
--

CREATE TABLE `tbl_loan` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `loan_type` int(11) NOT NULL,
  `date_borrowed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount_borrowed` int(11) NOT NULL,
  `interest` int(11) NOT NULL,
  `amount_to_pay` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `status` enum('approved','not approved','pending') NOT NULL DEFAULT 'pending',
  `withdrawn` enum('yes','no') NOT NULL DEFAULT 'no',
  `state` enum('cleared','unpaid') NOT NULL DEFAULT 'unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loanpayment`
--

CREATE TABLE `tbl_loanpayment` (
  `id` int(11) NOT NULL,
  `date_paid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loantype`
--

CREATE TABLE `tbl_loantype` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `interest` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_loantype`
--

INSERT INTO `tbl_loantype` (`id`, `name`, `interest`, `date_added`) VALUES
(1, 'Emergency', 5, '2018-04-12 06:36:20'),
(2, 'Development', 20, '2018-04-12 08:21:46'),
(3, 'Members Loan', 0, '2018-04-12 08:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `userlevel` enum('Admin','Manager','Accounts') NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('retired','active','dismissed','suspended') NOT NULL DEFAULT 'active',
  `current_login` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`id`, `username`, `first_name`, `last_name`, `userlevel`, `password`, `status`, `current_login`, `last_login`) VALUES
(1, 'admin', 'Admin', 'Marsha', 'Admin', '$2y$10$izMJ07SLPjtTNa542CNNV.XooUsi1Xvg/GtPpZPfxW5QRTHv1XWoO', 'active', '2018-06-15 07:11:44', '0000-00-00 00:00:00'),
(2, 'masha', 'Manager', 'Marsha', 'Manager', '$2y$10$Mb/lE.E/A949StJCFR8D3.IOqfr8bs86TBiQTr1Mgw0jUxcac0I.G', 'active', '2018-06-15 07:12:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `marital_status` enum('single','married','divorced','widow') NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `id_number` int(11) NOT NULL,
  `status` enum('active','pending','','') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usersedit`
--

CREATE TABLE `tbl_usersedit` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `marital_status` enum('single','married','divorced','widow') NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `id_number` int(11) NOT NULL,
  `status` enum('active','pending','','') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_loan`
--
ALTER TABLE `tbl_loan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `loan_type` (`loan_type`);

--
-- Indexes for table `tbl_loanpayment`
--
ALTER TABLE `tbl_loanpayment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_id` (`loan_id`);

--
-- Indexes for table `tbl_loantype`
--
ALTER TABLE `tbl_loantype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_number` (`id_number`);

--
-- Indexes for table `tbl_usersedit`
--
ALTER TABLE `tbl_usersedit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_loan`
--
ALTER TABLE `tbl_loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_loanpayment`
--
ALTER TABLE `tbl_loanpayment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_loantype`
--
ALTER TABLE `tbl_loantype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_usersedit`
--
ALTER TABLE `tbl_usersedit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_loan`
--
ALTER TABLE `tbl_loan`
  ADD CONSTRAINT `tbl_loan_ibfk_1` FOREIGN KEY (`user`) REFERENCES `tbl_users` (`id`),
  ADD CONSTRAINT `tbl_loan_ibfk_2` FOREIGN KEY (`loan_type`) REFERENCES `tbl_loantype` (`id`);

--
-- Constraints for table `tbl_loanpayment`
--
ALTER TABLE `tbl_loanpayment`
  ADD CONSTRAINT `tbl_loanpayment_ibfk_1` FOREIGN KEY (`loan_id`) REFERENCES `tbl_loan` (`id`);

--
-- Constraints for table `tbl_usersedit`
--
ALTER TABLE `tbl_usersedit`
  ADD CONSTRAINT `tbl_usersedit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
