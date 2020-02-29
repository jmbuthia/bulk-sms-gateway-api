-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 29, 2020 at 01:19 PM
-- Server version: 10.3.22-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smsgateway`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `categoryid` int(11) NOT NULL,
  `category_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `category_name`) VALUES
(1, 'Administrator'),
(3, 'Secretary'),
(2, 'Super_Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `companyid` int(11) NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `api_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `api_key` text COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyid`, `company_name`, `api_username`, `api_key`, `active`, `datecreated`) VALUES
(1, 'ruemerc', 'mbuthia', '9b4c2774d90cd2a56385154d3a68369606bafa0f12dc6b0d863635370b16129b', 1, '2017-04-27 00:00:00'),
(2, 'johnson', 'mbuthia', '	9b4c2774d90cd2a56385154d3a68369606bafa0f12dc6b0d863635370b16129b', 1, '2017-05-05 10:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `contactid` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contactid`, `first_name`, `last_name`, `phone`, `active`, `company_name`) VALUES
(74, 'JOHNSON', 'MBUTHIA', '+254717925741', 1, 'ruemerc'),
(75, 'JOHNSON', 'MBUTHIA', '+254717925741', 1, 'johnson'),
(76, 'stive', 'thiga', '+254712577777', 1, 'johnson'),
(77, 'Njoroge', 'Nduati', '+254727643607', 1, 'johnson'),
(78, 'moses', 'tsaka', '+254726631229', 2, 'johnson'),
(84, 'Kennedy', 'Kori', '+254719677197', 1, 'johnson'),
(85, 'Mary', 'Nyawira', '0703904118', 1, 'johnson'),
(86, 'Anthony', 'Gathege', '0714759182', 1, 'johnson'),
(87, 'Stanley', 'Mutwiri', '0719406139', 1, 'johnson'),
(92, 'Lilian', 'Njeru', '0708268151', 1, 'johnson'),
(93, 'Leonard', 'kipgetich', '0728065590', 1, 'johnson');

-- --------------------------------------------------------

--
-- Table structure for table `contact_groups`
--

CREATE TABLE IF NOT EXISTS `contact_groups` (
  `groupid` int(11) NOT NULL,
  `group_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_groups`
--

INSERT INTO `contact_groups` (`groupid`, `group_name`, `active`, `datecreated`, `company_name`) VALUES
(1, 'Group 1', 1, '2017-05-08 10:56:48', 'johnson'),
(2, 'Group 2', 1, '2017-05-08 10:56:56', 'johnson'),
(3, 'Group 3', 2, '2017-05-09 16:45:06', 'johnson');

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE IF NOT EXISTS `forgot_password` (
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `reset_code` int(11) NOT NULL,
  `time_requested` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE IF NOT EXISTS `group_members` (
  `groupid` int(11) NOT NULL,
  `contactid` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `datejoined` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`groupid`, `contactid`, `active`, `datejoined`) VALUES
(1, 75, 1, '2017-05-08 10:57:30'),
(1, 76, 1, '2017-05-08 10:57:30'),
(2, 75, 1, '2017-05-08 11:34:50'),
(2, 76, 1, '2017-05-08 11:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `profile_picture` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'images/profile/defaultprofilepicture.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `profile_picture`) VALUES
('admin', 'f6fdffe48c908deb0f4c3bd36c032e72', 'images/profile/defaultprofilepicture.jpg'),
('johnson', 'd74609372ceda08468b291fd6bf2ce65', 'images/profile/johnson.png'),
('thiga', '456e27ab89a192139436b06db961f06c', 'images/profile/defaultprofilepicture.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `messageid` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `timecreated` datetime NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageid`, `message`, `timecreated`, `company_name`) VALUES
(1, 'test', '2017-05-12 11:26:24', 'johnson'),
(2, 'Scheduled individual joghnson', '2017-05-12 11:44:01', 'johnson'),
(3, 'Message 1 ', '2017-05-12 11:46:01', 'johnson'),
(4, 'meso individual', '2017-05-12 11:50:30', 'johnson'),
(5, 'uighuhuh', '2017-05-12 11:59:34', 'johnson'),
(6, 'ttu', '2017-05-12 14:37:09', 'johnson'),
(7, '23', '2017-05-12 14:40:48', 'johnson'),
(8, '12', '2017-05-12 15:20:01', 'johnson'),
(9, '14', '2017-05-12 15:24:01', 'johnson'),
(10, 'one individual one message sechedule', '2017-05-12 15:53:01', 'johnson'),
(11, 'group schedule sms', '2017-05-12 15:55:01', 'johnson'),
(12, 'group no schedule', '2017-05-12 15:56:44', 'johnson'),
(13, 'individual', '2017-05-12 15:57:12', 'johnson'),
(14, 'delay from 2017-05-12 15:58:52', '2017-05-12 15:59:04', 'johnson'),
(15, 'thiga acc. individual', '2017-05-12 16:02:04', 'johnson'),
(16, 'thiga acc. group no schedule', '2017-05-12 16:03:48', 'johnson'),
(17, 'scheduled at 2017-05-12 16:06:02', '2017-05-12 16:07:01', 'johnson'),
(18, 'Thiga acc. group scheduled sms at 2017-05-12 16:10:08. count delay', '2017-05-12 16:11:02', 'johnson'),
(19, 'Hi johnson, somebody asked to reset your smsgateway password.\nYour reset code is: 13327 .\nIf you didn''t ask for this, just ignore.', '2017-05-12 16:36:38', 'johnson'),
(20, 'Hi johnson, somebody asked to reset your smsgateway password.\nYour reset code is: 52329 .\nIf you didn''t ask for this, just ignore.', '2017-05-12 16:40:55', 'johnson'),
(21, 'Timer at 8', '2017-05-12 20:03:02', 'johnson'),
(22, 'scheduled at 2017-05-13 08:40:00 to groups', '2017-05-13 08:40:02', 'johnson'),
(23, 'Hi there', '2017-05-19 16:57:15', 'johnson'),
(24, 'Test new upload', '2017-06-08 09:07:01', 'johnson'),
(25, 'Niga your are awesome', '2017-06-13 21:10:06', 'johnson'),
(26, 'Ebu amka ', '2017-06-13 21:10:46', 'johnson'),
(27, 'Ni Kori', '2017-06-13 21:11:56', 'johnson'),
(28, 'https://www.dropbox.com/s/oe1ytapn7777ibl/e-mining.apk?dl=0', '2017-08-03 17:33:52', 'johnson'),
(29, 'e-mining-1 apk setup link\r\nhttps://drive.google.com/file/d/0B5yi_XWiB9VFYlZzdFJTeUZGdlk/view?usp=sharing', '2017-08-05 13:27:36', 'johnson'),
(30, 'Scheduled message........', '2017-08-31 10:30:01', 'johnson'),
(31, '.qwerty', '2017-09-03 20:41:32', 'johnson'),
(32, 'Sasa?', '2017-11-25 11:22:47', 'johnson'),
(33, 'Bal', '2018-05-14 18:52:23', 'johnson'),
(34, 'Hi', '2018-05-17 18:40:34', 'johnson'),
(35, 'Kulal 6. Nko kwa Sami.', '2018-05-18 16:13:42', 'johnson'),
(36, 'Then mutsimoto', '2018-05-18 16:49:58', 'johnson'),
(37, 'Oilseal 4 mutsimoto  1 our book all at mutsimoto. Am at dobie na ni forklift.', '2018-05-18 17:15:43', 'johnson'),
(38, 'Ndogo ndogo', '2018-05-22 16:54:28', 'johnson'),
(39, 'hi', '2018-08-26 15:08:02', 'johnson'),
(40, 'Mambo bro? Kuwa na ckukuu poa. Regard Johnson ', '2018-12-26 01:01:01', 'johnson'),
(41, 'It looks like this. Enjoy your knight.\r\nRegards Johnson. ', '2019-02-16 20:25:29', 'johnson'),
(42, 'Test', '2019-02-16 20:25:54', 'johnson');

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_sms`
--

CREATE TABLE IF NOT EXISTS `scheduled_sms` (
  `messageid` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `scheduled_time` datetime NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_sent` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `scheduled_sms`
--

INSERT INTO `scheduled_sms` (`messageid`, `message`, `scheduled_time`, `company_name`, `is_sent`) VALUES
(1, 'Umefika wapi mutongoria', '2017-05-10 15:38:00', 'johnson', 1),
(2, 'Message 1 ', '2017-05-12 11:45:11', 'johnson', 1),
(3, 'Scheduled individual joghnson', '2017-05-12 11:43:59', 'johnson', 1),
(4, '12', '2017-05-12 15:19:18', 'johnson', 1),
(5, '14', '2017-05-12 15:21:58', 'johnson', 1),
(6, 'one individual one message sechedule', '2017-05-12 15:51:06', 'johnson', 1),
(7, 'group schedule sms', '2017-05-12 15:54:02', 'johnson', 1),
(8, 'delay from 2017-05-12 15:58:52', '2017-05-12 15:58:52', 'johnson', 1),
(9, 'scheduled at 2017-05-12 16:06:02', '2017-05-12 16:06:02', 'johnson', 1),
(10, 'Thiga acc. group scheduled sms at 2017-05-12 16:10:08. count delay', '2017-05-12 16:10:08', 'johnson', 1),
(11, 'Timer at 8', '2017-05-12 20:02:40', 'johnson', 1),
(12, 'scheduled at 2017-05-13 08:40:00 to groups', '2017-05-13 08:40:00', 'johnson', 1),
(13, 'Scheduled message........', '2017-08-31 10:30:00', 'johnson', 1),
(14, 'Test new upload', '2017-06-08 09:07:00', 'johnson', 1),
(15, 'hi', '2018-08-26 15:05:15', 'johnson', 1),
(16, 'Mambo bro? Kuwa na ckukuu poa. Regard Johnson ', '2018-12-26 01:00:43', 'johnson', 1);

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_sms_list`
--

CREATE TABLE IF NOT EXISTS `scheduled_sms_list` (
  `messageid` int(11) NOT NULL,
  `contactid` int(11) NOT NULL,
  `groupid` int(11) DEFAULT NULL,
  `sent_by` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `scheduled_sms_list`
--

INSERT INTO `scheduled_sms_list` (`messageid`, `contactid`, `groupid`, `sent_by`) VALUES
(1, 75, NULL, 'johnson'),
(2, 75, 1, 'johnson'),
(2, 76, 1, 'johnson'),
(2, 75, 2, 'johnson'),
(2, 76, 2, 'johnson'),
(3, 75, NULL, 'johnson'),
(4, 75, NULL, 'johnson'),
(5, 75, NULL, 'johnson'),
(6, 75, NULL, 'johnson'),
(7, 75, 1, 'johnson'),
(7, 76, 1, 'johnson'),
(7, 75, 2, 'johnson'),
(7, 76, 2, 'johnson'),
(8, 75, NULL, 'johnson'),
(9, 75, NULL, 'thiga'),
(10, 75, 1, 'thiga'),
(10, 76, 1, 'thiga'),
(10, 75, 2, 'thiga'),
(10, 76, 2, 'thiga'),
(11, 75, NULL, 'johnson'),
(12, 75, 1, 'johnson'),
(12, 76, 1, 'johnson'),
(12, 75, 2, 'johnson'),
(12, 76, 2, 'johnson'),
(13, 75, NULL, 'johnson'),
(14, 76, NULL, 'johnson'),
(15, 93, NULL, 'johnson'),
(16, 86, NULL, 'johnson');

-- --------------------------------------------------------

--
-- Table structure for table `sent_messages`
--

CREATE TABLE IF NOT EXISTS `sent_messages` (
  `messageid` int(11) NOT NULL,
  `contactid` int(11) NOT NULL,
  `groupid` int(11) DEFAULT NULL,
  `timesent` datetime NOT NULL,
  `sent_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sent_messages`
--

INSERT INTO `sent_messages` (`messageid`, `contactid`, `groupid`, `timesent`, `sent_by`) VALUES
(1, 75, NULL, '2017-05-12 11:26:24', 'johnson'),
(2, 75, NULL, '2017-05-12 11:44:01', 'johnson'),
(3, 75, 1, '2017-05-12 11:46:02', 'johnson'),
(3, 76, 1, '2017-05-12 11:46:02', 'johnson'),
(4, 75, NULL, '2017-05-12 11:50:30', 'johnson'),
(5, 75, NULL, '2017-05-12 11:59:34', 'johnson'),
(6, 75, NULL, '2017-05-12 14:37:09', 'johnson'),
(7, 75, NULL, '2017-05-12 14:40:48', 'johnson'),
(7, 76, NULL, '2017-05-12 14:40:48', 'johnson'),
(8, 75, NULL, '2017-05-12 15:20:02', 'johnson'),
(9, 75, NULL, '2017-05-12 15:24:01', 'johnson'),
(10, 75, NULL, '2017-05-12 15:53:01', 'johnson'),
(11, 75, 1, '2017-05-12 15:55:01', 'johnson'),
(11, 76, 1, '2017-05-12 15:55:01', 'johnson'),
(12, 75, 1, '2017-05-12 15:56:44', 'johnson'),
(12, 76, 1, '2017-05-12 15:56:45', 'johnson'),
(13, 75, NULL, '2017-05-12 15:57:12', 'johnson'),
(14, 75, NULL, '2017-05-12 15:59:04', 'johnson'),
(15, 75, NULL, '2017-05-12 16:02:05', 'thiga'),
(16, 75, 1, '2017-05-12 16:03:48', 'thiga'),
(16, 76, 1, '2017-05-12 16:03:48', 'thiga'),
(17, 75, NULL, '2017-05-12 16:07:01', 'thiga'),
(18, 75, 1, '2017-05-12 16:11:03', 'thiga'),
(18, 76, 1, '2017-05-12 16:11:03', 'thiga'),
(19, 75, NULL, '2017-05-12 16:36:38', 'johnson'),
(20, 75, NULL, '2017-05-12 16:40:55', 'johnson'),
(21, 75, NULL, '2017-05-12 20:03:02', 'johnson'),
(22, 75, 1, '2017-05-13 08:40:02', 'johnson'),
(22, 76, 1, '2017-05-13 08:40:02', 'johnson'),
(23, 75, NULL, '2017-05-19 16:57:15', 'johnson'),
(24, 76, NULL, '2017-06-08 09:07:01', 'johnson'),
(25, 84, NULL, '2017-06-13 21:10:07', 'johnson'),
(26, 75, NULL, '2017-06-13 21:10:46', 'johnson'),
(27, 75, NULL, '2017-06-13 21:11:56', 'johnson'),
(28, 75, NULL, '2017-08-03 17:33:52', 'johnson'),
(28, 85, NULL, '2017-08-03 17:33:52', 'johnson'),
(29, 75, NULL, '2017-08-05 13:27:36', 'johnson'),
(29, 85, NULL, '2017-08-05 13:27:36', 'johnson'),
(30, 75, NULL, '2017-08-31 10:30:02', 'johnson'),
(31, 86, NULL, '2017-09-03 20:41:33', 'johnson'),
(32, 87, NULL, '2017-11-25 11:22:47', 'johnson'),
(33, 75, NULL, '2018-05-14 18:52:24', 'johnson'),
(34, 92, NULL, '2018-05-17 18:40:34', 'johnson'),
(35, 87, NULL, '2018-05-18 16:13:42', 'johnson'),
(36, 87, NULL, '2018-05-18 16:49:58', 'johnson'),
(37, 87, NULL, '2018-05-18 17:15:43', 'johnson'),
(38, 87, NULL, '2018-05-22 16:54:28', 'johnson'),
(39, 93, NULL, '2018-08-26 15:08:02', 'johnson'),
(40, 86, NULL, '2018-12-26 01:01:01', 'johnson'),
(41, 77, NULL, '2019-02-16 20:25:29', 'johnson'),
(42, 75, NULL, '2019-02-16 20:25:54', 'johnson');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `first_name`, `last_name`, `gender`, `active`, `phone`, `datecreated`) VALUES
(21, 'admin', 'JOHNSON', 'MBUTHIA', 'Male', 1, '+254717925741', '2017-05-02 16:16:35'),
(22, 'johnson', 'JOHNSON', 'MBUTHIA', 'Male', 1, '+254717925741', '2017-05-05 10:36:54'),
(23, 'thiga', 'stive', 'thiga', 'Male', 1, '+254712577777', '2017-05-09 08:42:01');

-- --------------------------------------------------------

--
-- Table structure for table `users_company`
--

CREATE TABLE IF NOT EXISTS `users_company` (
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_company`
--

INSERT INTO `users_company` (`username`, `company_name`) VALUES
('admin', 'ruemerc'),
('johnson', 'johnson'),
('thiga', 'johnson');

-- --------------------------------------------------------

--
-- Table structure for table `user_rights`
--

CREATE TABLE IF NOT EXISTS `user_rights` (
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `category_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_rights`
--

INSERT INTO `user_rights` (`username`, `category_name`) VALUES
('admin', 'Super_Administrator'),
('johnson', 'Administrator'),
('thiga', 'Secretary');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyid`),
  ADD UNIQUE KEY `company_name` (`company_name`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contactid`),
  ADD UNIQUE KEY `company_phone` (`phone`,`company_name`),
  ADD KEY `fk_contact_company_name` (`company_name`);

--
-- Indexes for table `contact_groups`
--
ALTER TABLE `contact_groups`
  ADD PRIMARY KEY (`groupid`),
  ADD UNIQUE KEY `company_groups_fkey` (`group_name`,`company_name`),
  ADD KEY `fk_contact_groups_company_name` (`company_name`);

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`time_requested`,`username`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`groupid`,`contactid`),
  ADD KEY `groupid` (`groupid`),
  ADD KEY `contactid` (`contactid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageid`),
  ADD KEY `fk_message_company_name` (`company_name`);

--
-- Indexes for table `scheduled_sms`
--
ALTER TABLE `scheduled_sms`
  ADD PRIMARY KEY (`messageid`),
  ADD KEY `company_name` (`company_name`);

--
-- Indexes for table `scheduled_sms_list`
--
ALTER TABLE `scheduled_sms_list`
  ADD KEY `contactid` (`contactid`),
  ADD KEY `messageid` (`messageid`),
  ADD KEY `groupid` (`groupid`),
  ADD KEY `sent_by` (`sent_by`);

--
-- Indexes for table `sent_messages`
--
ALTER TABLE `sent_messages`
  ADD PRIMARY KEY (`messageid`,`contactid`),
  ADD KEY `groupid` (`groupid`),
  ADD KEY `messageid` (`messageid`),
  ADD KEY `contactid` (`contactid`),
  ADD KEY `fk_sent_by_users` (`sent_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_company`
--
ALTER TABLE `users_company`
  ADD KEY `company_name` (`company_name`);

--
-- Indexes for table `user_rights`
--
ALTER TABLE `user_rights`
  ADD KEY `username` (`username`),
  ADD KEY `category_name` (`category_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `companyid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contactid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `contact_groups`
--
ALTER TABLE `contact_groups`
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `scheduled_sms`
--
ALTER TABLE `scheduled_sms`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`company_name`) REFERENCES `company` (`company_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact_groups`
--
ALTER TABLE `contact_groups`
  ADD CONSTRAINT `contact_groups_ibfk_1` FOREIGN KEY (`company_name`) REFERENCES `company` (`company_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_ibfk_2` FOREIGN KEY (`groupid`) REFERENCES `contact_groups` (`groupid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `group_members_ibfk_3` FOREIGN KEY (`contactid`) REFERENCES `contacts` (`contactid`) ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`company_name`) REFERENCES `company` (`company_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scheduled_sms`
--
ALTER TABLE `scheduled_sms`
  ADD CONSTRAINT `scheduled_sms_ibfk_1` FOREIGN KEY (`company_name`) REFERENCES `company` (`company_name`) ON UPDATE CASCADE;

--
-- Constraints for table `scheduled_sms_list`
--
ALTER TABLE `scheduled_sms_list`
  ADD CONSTRAINT `scheduled_sms_list_ibfk_1` FOREIGN KEY (`contactid`) REFERENCES `contacts` (`contactid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `scheduled_sms_list_ibfk_2` FOREIGN KEY (`sent_by`) REFERENCES `users` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `scheduled_sms_list_ibfk_3` FOREIGN KEY (`groupid`) REFERENCES `contact_groups` (`groupid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `scheduled_sms_list_ibfk_4` FOREIGN KEY (`messageid`) REFERENCES `scheduled_sms` (`messageid`) ON UPDATE CASCADE;

--
-- Constraints for table `sent_messages`
--
ALTER TABLE `sent_messages`
  ADD CONSTRAINT `sent_messages_ibfk_1` FOREIGN KEY (`contactid`) REFERENCES `contacts` (`contactid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sent_messages_ibfk_2` FOREIGN KEY (`messageid`) REFERENCES `messages` (`messageid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sent_messages_ibfk_3` FOREIGN KEY (`groupid`) REFERENCES `group_members` (`groupid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sent_messages_ibfk_4` FOREIGN KEY (`sent_by`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_company`
--
ALTER TABLE `users_company`
  ADD CONSTRAINT `users_company_ibfk_1` FOREIGN KEY (`company_name`) REFERENCES `company` (`company_name`) ON UPDATE CASCADE;

--
-- Constraints for table `user_rights`
--
ALTER TABLE `user_rights`
  ADD CONSTRAINT `user_rights_ibfk_2` FOREIGN KEY (`category_name`) REFERENCES `category` (`category_name`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
