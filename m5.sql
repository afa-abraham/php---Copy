-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 01:54 PM
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
-- Database: `m5`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `height` varchar(20) DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `interested` varchar(50) DEFAULT NULL,
  `body_type` varchar(20) DEFAULT NULL,
  `hair_color` varchar(20) DEFAULT NULL,
  `eyes_color` varchar(20) DEFAULT NULL,
  `ethnicity` varchar(50) DEFAULT NULL,
  `marital_status` varchar(50) DEFAULT NULL,
  `smoking` varchar(50) DEFAULT NULL,
  `drinking` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `children` varchar(50) DEFAULT NULL,
  `no_of_children` int(11) DEFAULT NULL,
  `employment` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `idealMatch` text DEFAULT NULL,
  `additional_comments` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `fname`, `lname`, `age`, `location`, `height`, `weight`, `interested`, `body_type`, `hair_color`, `eyes_color`, `ethnicity`, `marital_status`, `smoking`, `drinking`, `religion`, `education`, `children`, `no_of_children`, `employment`, `description`, `idealMatch`, `additional_comments`, `created_at`) VALUES
(1, 'Adil', 'Marco', 0, 'United States', '5\\\'10\\\" (177 cm)', '170 lbs (77.0 kg)', '18-27 years old', 'Athletic', 'Dark Brown', 'Brown', 'Asian', 'Single', 'No', 'Occasionally', 'Christian', 'Master\\\'s', 'No children but I want them', 0, 'Business Owner', 'I\\\'m a 36 year old cool guy with a Master\\\'s Degree , worked in finance previously now I run my own energy business in Miami, Florida. I play basketball and am on the beach every week and still haven\\\'t figured out how to cook :)', 'I\\\'m looking for a fun, down to earth girl who can be my \\\"wifey\\\" for \\\"Lifey\\\" and be a great lover, cook supporter and hopefully one day \\\"mom \\\" to my kids. Really need to have a great calm spirit and a fun joyous character.', '', '2024-07-29 14:15:53');

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

CREATE TABLE `mails` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sender_deleted` tinyint(1) DEFAULT 0,
  `receiver_deleted` tinyint(1) DEFAULT 0,
  `is_read` tinyint(1) DEFAULT 0,
  `archived` tinyint(1) DEFAULT 0,
  `sender_archived` tinyint(1) DEFAULT 0,
  `receiver_archived` tinyint(1) DEFAULT 0,
  `is_draft` tinyint(1) DEFAULT 0,
  `thread_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mails`
--

INSERT INTO `mails` (`id`, `sender_id`, `receiver_id`, `subject`, `body`, `created_at`, `sent_at`, `sender_deleted`, `receiver_deleted`, `is_read`, `archived`, `sender_archived`, `receiver_archived`, `is_draft`, `thread_id`) VALUES
(280, 1, 4, 'Make me ', '12222', '2024-07-26 09:37:10', '2024-07-26 09:37:10', 0, 0, 0, 0, 0, 0, 0, 280),
(281, 1, 4, 'maewe', '2111', '2024-07-26 09:39:00', '2024-07-26 09:39:00', 0, 0, 0, 0, 0, 0, 0, 281),
(282, 1, 4, 'maewe', '2111', '2024-07-26 09:45:39', '2024-07-26 09:45:39', 0, 0, 1, 0, 0, 0, 0, 282),
(283, 1, 4, 'maewe', '2111', '2024-07-26 09:45:40', '2024-07-26 09:45:40', 0, 0, 1, 0, 0, 0, 0, 283),
(284, 1, 1, '1234565', '55555', '2024-07-26 09:50:25', '2024-07-26 09:50:25', 0, 0, 0, 0, 0, 0, 0, 284),
(285, 3, 3, '12121', '21312', '2024-07-26 13:18:43', '2024-07-26 13:18:43', 0, 0, 0, 0, 0, 0, 0, 285),
(286, 3, 3, 'MArk', 'sasddddd', '2024-07-26 13:33:24', '2024-07-26 13:33:24', 0, 0, 0, 0, 0, 0, 0, 286),
(287, 4, 1, 'maewe', '', '2024-07-26 14:28:49', '2024-07-26 14:28:49', 0, 0, 0, 0, 0, 0, 1, 0),
(288, 4, 1, 'maewe', '', '2024-07-26 14:31:48', '2024-07-26 14:31:48', 0, 0, 0, 0, 0, 0, 1, 0),
(289, 4, 1, 'maewe', '', '2024-07-26 14:31:49', '2024-07-26 14:31:49', 0, 0, 0, 0, 0, 0, 1, 0),
(290, 4, 1, 'maewe', '', '2024-07-26 14:37:06', '2024-07-26 14:37:06', 0, 0, 0, 0, 0, 0, 1, 0),
(291, 4, 1, 'maewe', '', '2024-07-26 14:38:19', '2024-07-26 14:38:19', 0, 0, 0, 0, 0, 0, 1, 0),
(292, 4, 1, 'maewe', '', '2024-07-26 14:38:43', '2024-07-26 14:38:43', 0, 0, 0, 0, 0, 0, 1, 0),
(293, 4, 1, 'maewe', '', '2024-07-26 14:39:59', '2024-07-26 14:39:59', 0, 0, 0, 0, 0, 0, 1, 0),
(294, 4, 1, 'maewe', '', '2024-07-26 14:40:12', '2024-07-26 14:40:12', 0, 0, 0, 0, 0, 0, 1, 0),
(295, 4, 1, 'maewe', '', '2024-07-26 14:41:17', '2024-07-26 14:41:17', 0, 0, 0, 0, 0, 0, 1, 0),
(296, 4, 1, 'maewe', '', '2024-07-26 14:42:04', '2024-07-26 14:42:04', 0, 0, 0, 0, 0, 0, 1, 0),
(297, 4, 1, 'maewe', '', '2024-07-26 14:49:50', '2024-07-26 14:49:50', 0, 0, 0, 0, 0, 0, 1, 0),
(298, 4, 1, 'maewe', '', '2024-07-26 14:51:27', '2024-07-26 14:51:27', 0, 0, 0, 0, 0, 0, 1, 0),
(299, 4, 1, 'maewe', '', '2024-07-26 14:54:21', '2024-07-26 14:54:21', 0, 0, 0, 0, 0, 0, 1, 0),
(300, 4, 1, 'maewe', '', '2024-07-26 14:56:47', '2024-07-26 14:56:47', 0, 0, 0, 0, 0, 0, 1, 0),
(301, 4, 1, 'maewe', '', '2024-07-26 14:58:47', '2024-07-26 14:58:47', 0, 0, 0, 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'admin'),
(3, 'client'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `age` tinyint(2) DEFAULT NULL,
  `brithdate` date DEFAULT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `marital_status` enum('Single','Married','Divorced','Widowed') DEFAULT NULL,
  `fb_link` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `email`, `first_name`, `last_name`, `middle_name`, `age`, `brithdate`, `mobile_number`, `marital_status`, `fb_link`, `role_id`, `created_at`, `profile_image`) VALUES
(1, 'afa_admin', 'afa administrator', '$2y$10$hzTdvoNT9sak/n1vw75WZemlFqCfpO7yh77XV7rWX5Ony6uMQrkzG', 'afa-admin@gmail.com', NULL, NULL, NULL, NULL, NULL, '09176610000', NULL, NULL, 1, '2024-07-12 10:57:10', 'admin.jpg'),
(2, 'IBSS_moderator', 'IBSS ADMIN', '$2y$10$LgFI8aBkn3PfNx2bXLApYen.zg6SrWVln1f5xYs2pR3BlLNSQGxPy', 'ibssmoderator@afa.com', NULL, NULL, NULL, NULL, NULL, '09176610001', NULL, NULL, 1, '2024-07-19 10:17:04', 'admin2.jpg'),
(3, 'Isabella', 'Isabella Fuentess', '$2y$10$NAttkx6uxqfWQi3P.Djcj.4aJiV.UW.nNv2PF3ggjTmvKPBIZGx7q', 'Isabella@gmail.com', NULL, NULL, NULL, NULL, NULL, '09176617776', NULL, NULL, 2, '2024-07-12 09:07:02', 'womanDP.webp'),
(4, 'Fernanda', 'Fernanda Poe', '$2y$10$GifqKUQGxVN9ODkCyuFBBuGrxe2oD5jbDaEaE3Jpl5kO9KC9TB0/C', 'fernanda@email.com', NULL, NULL, NULL, NULL, NULL, '123123', NULL, NULL, 2, '2024-07-12 15:45:23', 'dpgirl.png'),
(5, 'client', 'client ko', '$2y$10$u51wV69AGdN0HV32G7bEcOJyZcm5HOhLCAKJafg85xl7jSy0sCiTq', 'client@test.com', NULL, NULL, NULL, NULL, NULL, '123123', NULL, NULL, 3, '2024-07-22 11:41:39', 'client.png'),
(6, 'client2', 'client two', '$2y$10$WsKy6tcaJtU6w.XCc4gjqOGphxzDi6Lcdb/XN9mPZr6t8Ci77Lc5G', 'client2@gmail.com', NULL, NULL, NULL, NULL, NULL, '21312', NULL, NULL, 3, '2024-07-22 14:06:53', 'client2.png'),
(46, 'jose_santos', 'Jose Abad Santos', '$2y$10$.E5ZWUFsOFw48ss7GIo1JeugwAhW0Ko2t2PalJ5BqdPaJPJnJJvtC', 'josesantos@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2024-07-29 09:28:00', 'default.png'),
(47, 'maria_derende', 'Maria Derende', '$2y$10$eLJw4HW1ZBTPDH0rTEaONONJ9jo8r969NmWJTcwpr9tdbtSk55USi', 'mariaderende@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2024-07-29 09:30:46', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_mail_status`
--

CREATE TABLE `user_mail_status` (
  `id` int(11) NOT NULL,
  `mail_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `is_archived` tinyint(1) DEFAULT 0,
  `is_read` tinyint(1) DEFAULT 0,
  `notified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_mail_status`
--

INSERT INTO `user_mail_status` (`id`, `mail_id`, `user_id`, `is_deleted`, `is_archived`, `is_read`, `notified`) VALUES
(342, 280, 1, 0, 0, 0, 0),
(343, 280, 4, 0, 0, 0, 0),
(344, 281, 1, 0, 0, 0, 0),
(345, 281, 4, 0, 0, 0, 0),
(346, 282, 1, 0, 0, 0, 0),
(347, 282, 4, 0, 0, 1, 0),
(348, 283, 1, 0, 0, 0, 0),
(349, 283, 4, 0, 0, 1, 0),
(350, 284, 1, 0, 0, 0, 0),
(351, 284, 1, 0, 0, 0, 0),
(352, 285, 3, 0, 0, 0, 0),
(353, 285, 3, 0, 0, 0, 0),
(354, 286, 3, 0, 0, 0, 0),
(355, 286, 3, 0, 0, 0, 0),
(356, 287, 4, 0, 0, 0, 0),
(357, 288, 4, 0, 0, 0, 0),
(358, 289, 4, 0, 0, 0, 0),
(359, 290, 4, 0, 0, 0, 0),
(360, 291, 4, 0, 0, 0, 0),
(361, 292, 4, 0, 0, 0, 0),
(362, 293, 4, 0, 0, 0, 0),
(363, 294, 4, 0, 0, 0, 0),
(364, 295, 4, 0, 0, 0, 0),
(365, 296, 4, 0, 0, 0, 0),
(366, 297, 4, 0, 0, 0, 0),
(367, 298, 4, 0, 0, 0, 0),
(368, 299, 4, 0, 0, 0, 0),
(369, 300, 4, 0, 0, 0, 0),
(370, 301, 4, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mails_ibfk_1` (`sender_id`),
  ADD KEY `mails_ibfk_2` (`receiver_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_mail_status`
--
ALTER TABLE `user_mail_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_mail_status_ibfk_1` (`mail_id`),
  ADD KEY `user_mail_status_ibfk_2` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mails`
--
ALTER TABLE `mails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user_mail_status`
--
ALTER TABLE `user_mail_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mails`
--
ALTER TABLE `mails`
  ADD CONSTRAINT `mails_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mails_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_mail_status`
--
ALTER TABLE `user_mail_status`
  ADD CONSTRAINT `user_mail_status_ibfk_1` FOREIGN KEY (`mail_id`) REFERENCES `mails` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_mail_status_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
