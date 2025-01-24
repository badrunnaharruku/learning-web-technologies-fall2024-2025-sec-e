-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2025 at 02:54 PM
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
-- Database: `finman`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_details`
--

CREATE TABLE `application_details` (
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `loan_amount` decimal(10,2) NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL,
  `loan_term` int(11) NOT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_details`
--

INSERT INTO `application_details` (`application_id`, `user_id`, `loan_amount`, `interest_rate`, `loan_term`, `status`) VALUES
(1, 1, 258258.00, 5.00, 0, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `auto_pay`
--

CREATE TABLE `auto_pay` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `status` enum('Enabled','Disabled') DEFAULT 'Enabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_account`
--

INSERT INTO `bank_account` (`id`, `bank_name`, `account_number`) VALUES
(14, 'Dhaka Bank', '11478522225'),
(15, 'Sonali Bank', '11478522225'),
(16, 'Dhaka Bank', '55555555555');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('Pending','Paid','Auto-Pay Enabled') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `user_id`, `name`, `amount`, `due_date`, `status`) VALUES
(4, 1, 'Teution Fee', 12000.00, '2025-02-04', 'Pending'),
(5, 1, 'Teution 2 Fee', 1600.00, '2025-02-05', 'Auto-Pay Enabled'),
(6, 1, 'Teution 2 Fee', 1600.00, '2025-02-05', 'Auto-Pay Enabled'),
(7, 1, 'Teution 2 Fee', 1600.00, '2025-02-05', 'Auto-Pay Enabled'),
(8, 1, 'Gas', 300.00, '2025-01-31', 'Pending'),
(9, 1, 'TV', 200.00, '2025-02-03', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `installments`
--

CREATE TABLE `installments` (
  `id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `paid_date` date DEFAULT NULL,
  `status` enum('Pending','Paid') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `employment_status` varchar(255) NOT NULL,
  `monthly_income` decimal(10,2) NOT NULL,
  `loan_amount` decimal(10,2) NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL,
  `terms_accepted` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `employment_status`, `monthly_income`, `loan_amount`, `interest_rate`, `terms_accepted`, `created_at`) VALUES
(5, 'Unemployed', 500000.00, 5000.00, 6.00, 1, '2025-01-20 01:31:39'),
(6, 'Self-Employed', 5000000.00, 0.00, 5.00, 1, '2025-01-20 01:31:39'),
(7, 'Employed', 5555555.00, 0.00, 5.00, 1, '2025-01-20 01:31:39'),
(8, 'Employed', 555.00, 500.00, 5.00, 1, '2025-01-20 01:31:39'),
(9, 'Employed', 666666.00, 6000.00, 5.00, 1, '2025-01-20 01:31:39'),
(10, 'Employed', 666666.00, 6000.00, 5.00, 1, '2025-01-20 01:31:39'),
(11, 'Employed', 666666.00, 6000.00, 5.00, 1, '2025-01-20 01:31:39'),
(12, 'Employed', 666666.00, 6000.00, 5.00, 1, '2025-01-20 01:31:39'),
(13, 'Employed', 666666.00, 6000.00, 5.00, 1, '2025-01-20 01:31:39'),
(14, 'Employed', 666666.00, 6000.00, 5.00, 1, '2025-01-20 01:31:39'),
(15, 'Employed', 666666.00, 6000.00, 5.00, 1, '2025-01-20 01:31:39'),
(16, 'Employed', 666666.00, 6000.00, 5.00, 1, '2025-01-20 01:31:39'),
(17, 'Employed', 666666.00, 6000.00, 5.00, 1, '2025-01-20 01:31:39'),
(18, 'Employed', 4000000.00, 4000.00, 5.00, 1, '2025-01-20 01:31:39'),
(21, 'Employed', 5555555.00, 4455.00, 4.00, 1, '2025-01-22 03:45:04'),
(22, 'Employed', 55555555.00, 7444.00, 4.00, 1, '2025-01-22 04:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL,
  `term` int(11) NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_applications`
--

CREATE TABLE `loan_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employment_status` enum('Employed','Unemployed','Self-Employed','Student') NOT NULL,
  `monthly_income` decimal(10,2) NOT NULL,
  `loan_amount` decimal(10,2) NOT NULL,
  `loan_duration` int(11) NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_applications`
--

INSERT INTO `loan_applications` (`id`, `user_id`, `employment_status`, `monthly_income`, `loan_amount`, `loan_duration`, `interest_rate`, `status`, `created_at`) VALUES
(3, 1, 'Student', 12000.00, 50000.00, 6, 5.00, 'Pending', '2025-01-20 01:14:49'),
(4, 1, 'Unemployed', 15260.00, 9584.00, 6, 5.00, 'Pending', '2025-01-20 12:06:19'),
(5, 1, 'Self-Employed', 159874.00, 565656.00, 6, 5.00, 'Pending', '2025-01-20 12:20:57'),
(6, 1, 'Unemployed', 1254.00, 258258.00, 6, 5.00, 'Pending', '2025-01-20 12:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `status` enum('Unread','Read') DEFAULT 'Unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `date`, `status`) VALUES
(1, 1, 'Your payment has been processed successfully.', '2025-01-15 00:00:00', 'Read'),
(2, 1, 'Reminder: Your subscription is expiring soon.', '2025-01-16 00:00:00', 'Read'),
(3, 1, 'Welcome! Thank you for joining our platform.', '2025-01-10 00:00:00', 'Unread'),
(4, 1, 'Your order has been shipped and is on the way.', '2025-01-18 00:00:00', 'Unread'),
(5, 1, 'We could not process your payment. Please retry.', '2025-01-19 00:00:00', 'Unread'),
(6, 1, 'New offer available! Check it out in your account.', '2025-01-14 00:00:00', 'Unread'),
(7, 1, 'Your password was changed successfully.', '2025-01-13 00:00:00', 'Unread'),
(8, 1, 'Your account verification is pending.', '2025-01-12 00:00:00', 'Unread'),
(9, 1, 'Reminder: Your upcoming appointment is tomorrow.', '2025-01-20 00:00:00', 'Read'),
(10, 1, 'System maintenance is scheduled for tonight.', '2025-01-11 00:00:00', 'Read');

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `due_date` date NOT NULL,
  `status` enum('Pending','Completed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`id`, `user_id`, `title`, `description`, `due_date`, `status`) VALUES
(1, 1, 'Hello', 'Hello World', '2025-01-29', 'Pending'),
(2, 1, 'Music', 'Turn off', '2025-01-22', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_payments`
--

CREATE TABLE `scheduled_payments` (
  `id` int(11) NOT NULL,
  `bank_account_id` int(11) NOT NULL,
  `bill_amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_time` time NOT NULL,
  `is_paid` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scheduled_payments`
--

INSERT INTO `scheduled_payments` (`id`, `bank_account_id`, `bill_amount`, `payment_date`, `payment_time`, `is_paid`) VALUES
(2, 16, 45555555.00, '2025-01-23', '03:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','User') DEFAULT 'User',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `gender`, `dob`, `address`, `phone`, `password`, `role`, `created_at`) VALUES
(1, 'papabear', 'nishatislam84@gmail.com', 'male', '0000-00-00', '', '', 'Nishat1234', '', '2025-01-20 00:40:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application_details`
--
ALTER TABLE `application_details`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auto_pay`
--
ALTER TABLE `auto_pay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bill_id` (`bill_id`);

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `installments`
--
ALTER TABLE `installments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_id` (`loan_id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `loan_applications`
--
ALTER TABLE `loan_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `scheduled_payments`
--
ALTER TABLE `scheduled_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_account_id` (`bank_account_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application_details`
--
ALTER TABLE `application_details`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auto_pay`
--
ALTER TABLE `auto_pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `installments`
--
ALTER TABLE `installments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_applications`
--
ALTER TABLE `loan_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scheduled_payments`
--
ALTER TABLE `scheduled_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application_details`
--
ALTER TABLE `application_details`
  ADD CONSTRAINT `application_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `auto_pay`
--
ALTER TABLE `auto_pay`
  ADD CONSTRAINT `auto_pay_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `auto_pay_ibfk_2` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`);

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `installments`
--
ALTER TABLE `installments`
  ADD CONSTRAINT `installments_ibfk_1` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`);

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `loan_applications`
--
ALTER TABLE `loan_applications`
  ADD CONSTRAINT `loan_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reminders`
--
ALTER TABLE `reminders`
  ADD CONSTRAINT `reminders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `scheduled_payments`
--
ALTER TABLE `scheduled_payments`
  ADD CONSTRAINT `scheduled_payments_ibfk_1` FOREIGN KEY (`bank_account_id`) REFERENCES `bank_account` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
