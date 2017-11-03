-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2017 at 05:23 AM
-- Server version: 5.6.35
-- PHP Version: 7.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sendmail`
--

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

CREATE TABLE IF NOT EXISTS `app` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `auth_key` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `from_email` varchar(255) DEFAULT NULL,
  `reply_to` varchar(255) DEFAULT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(255) DEFAULT NULL,
  `smtp_encryption` varchar(255) DEFAULT NULL,
  `smtp_username` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `allowed_attachments` varchar(255) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app`
--

INSERT INTO `app` (`id`, `user_id`, `auth_key`, `name`, `description`, `from_name`, `from_email`, `reply_to`, `smtp_host`, `smtp_port`, `smtp_encryption`, `smtp_username`, `smtp_password`, `allowed_attachments`, `created_at`, `updated_at`) VALUES
(1, 9, 'medcThjoiFj-GDni3OhBN3Zmls7jfxhu', 'App 11were', 'xcaSD sxa', 'Vinh', 'godyvietnam@gmail.com', 'godyvietnam@gmail.com', 'smtp.gmail.com', '587', 'TLS', 'godyvietnam@gmail.com', 'blitkwvuwdeadlbo', 'jpeg,jpg,gif,png,pdf,zip', 1508471695, 1509508427);

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE IF NOT EXISTS `campaign` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `from_email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `reply_to` varchar(255) DEFAULT NULL,
  `template` text COMMENT 'Chiến dịch',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`id`, `user_id`, `name`, `from_name`, `from_email`, `subject`, `reply_to`, `template`, `created_at`, `updated_at`) VALUES
(1, 9, 'Vinh Huynh Tu', 'Vinh Huynh Tu', 'huynhtuvinh87@gmail.com', 'Gởi thư', 'huynhtuvinh87@gmail.com', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<pre><br /><!-- 100% background wrapper (grey background) --></pre>\r\n<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F0F0F0">\r\n<tbody>\r\n<tr>\r\n<td style="background-color: #f0f0f0;" align="center" valign="top" bgcolor="#F0F0F0"><br /> <!-- 600px container (white background) -->\r\n<table class="container" style="width: 600px; max-width: 600px;" border="0" width="600" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td class="container-padding header" style="font-family: Helvetica, Arial, sans-serif; font-size: 24px; font-weight: bold; padding-bottom: 12px; color: #df4726; padding-left: 24px; padding-right: 24px;" align="left">Xin ch&agrave;o [name]</td>\r\n</tr>\r\n<tr>\r\n<td class="content" style="padding-top: 12px; padding-bottom: 12px; background-color: #ffffff;" align="left">\r\n<table class="force-row" style="width: 600px;" border="0" width="600" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td class="content-wrapper" style="padding-left: 24px; padding-right: 24px;"><br />\r\n<div class="title" style="font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 600; color: #374550;">Three Columns</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class="cols-wrapper" style="padding-left: 12px; padding-right: 12px;"><!-- [if mso]>\r\n      <table border="0" width="576" cellpadding="0" cellspacing="0" style="width: 576px;">\r\n      <tr><td width="192" style="width: 192px;" valign="top"><![endif]-->\r\n<table class="force-row" style="width: 192px;" border="0" width="192" cellspacing="0" cellpadding="0" align="left">\r\n<tbody>\r\n<tr>\r\n<td class="col" style="padding: 18px 12px 12px 12px;" valign="top">\r\n<table class="img-wrapper" border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td style="padding-bottom: 18px;"><img class="image" style="max-width: 100%;" src="https://antwort-assets.s3.amazonaws.com/three-cols-images/ph-192x125@2x.png" alt="The White Whale" width="168" height="110" border="0" hspace="0" vspace="0" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td class="subtitle" style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 22px; font-weight: 600; color: #2469a0; padding-bottom: 6px;">The White Whale</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<div class="col-copy" style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 20px; text-align: left; color: #333333;">I take the good old fashioned ground that the whale is a fish, and call upon holy Jonah to back me. This fundamental thing settled, the next point is, in what internal respect does the whale differ from other fish.</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<!-- [if mso]></td><td width="192" style="width: 192px;" valign="top"><![endif]-->\r\n<table class="force-row" style="width: 192px;" border="0" width="192" cellspacing="0" cellpadding="0" align="left">\r\n<tbody>\r\n<tr>\r\n<td class="col" style="padding: 18px 12px 12px 12px;" valign="top">\r\n<table class="img-wrapper" border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td style="padding-bottom: 18px;"><img class="image" style="max-width: 100%;" src="https://antwort-assets.s3.amazonaws.com/three-cols-images/ph-192x125@2x.png" alt="I am Ishmael" width="168" height="110" border="0" hspace="0" vspace="0" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td class="subtitle" style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 22px; font-weight: 600; color: #2469a0; padding-bottom: 6px;">I am Ishmael</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<div class="col-copy" style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 20px; text-align: left; color: #333333;">Here upon the very point of starting for the voyage, Captain Peleg and Captain Bildad were going it with a high hand on the quarter-deck, just as if they were to be joint-commanders at sea, as well as to all appearances in port.</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<!-- [if mso]></td><td width="192" style="width: 192px;" valign="top"><![endif]-->\r\n<table class="force-row" style="width: 192px;" border="0" width="192" cellspacing="0" cellpadding="0" align="left">\r\n<tbody>\r\n<tr>\r\n<td class="col" style="padding: 18px 12px 12px 12px;" valign="top">\r\n<table class="img-wrapper" border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td style="padding-bottom: 18px;"><img class="image" style="max-width: 100%;" src="https://antwort-assets.s3.amazonaws.com/three-cols-images/ph-192x125@2x.png" alt="The Albatross flew across the ocean" width="168" height="110" border="0" hspace="0" vspace="0" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td class="subtitle" style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 22px; font-weight: 600; color: #2469a0; padding-bottom: 6px;">The Albatross flew across the ocean</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<div class="col-copy" style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 20px; text-align: left; color: #333333;">And somehow, at the time, I felt a sympathy and a sorrow for him, but for I don''t know what, unless it was the cruel loss of his leg. And yet I also felt a strange awe of him; but that sort of awe, which I cannot at all describe.</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<!-- [if mso]></td></tr></table><![endif]--></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class="container-padding footer-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 16px; color: #aaaaaa; padding-left: 24px; padding-right: 24px;" align="left"><br /><br /> Sample Footer text: &copy; 2015 Acme, Inc. <br /><br /> You are receiving this email because you opted in on our website. Update your <a style="color: #aaaaaa;" href="#">email preferences</a> or <a style="color: #aaaaaa;" href="#">unsubscribe</a>. <br /><br /> <strong>Acme, Inc.</strong><br /> <span class="ios-footer"> 123 Main St.<br /> Springfield, MA 12345<br /> </span> <a style="color: #aaaaaa;" href="http://www.acme-inc.com">www.acme-inc.com</a><br /> <br /><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<!--/600px container --></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<pre><!--/100% background wrapper--></pre>\r\n</body>\r\n</html></pre>\r\n</body>\r\n</html>', 1507777681, 1507794468);

-- --------------------------------------------------------

--
-- Table structure for table `email_history`
--

CREATE TABLE IF NOT EXISTS `email_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `to` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email_queue`
--

CREATE TABLE IF NOT EXISTS `email_queue` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_name` varchar(255) NOT NULL,
  `from_email` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE IF NOT EXISTS `list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`id`, `user_id`, `name`, `count`, `created_at`, `updated_at`) VALUES
(9, 9, 'Danh sách 1', 3, 1508226420, 1508226420);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `from_email` varchar(255) DEFAULT NULL,
  `reply_to` varchar(255) DEFAULT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(255) DEFAULT NULL,
  `smtp_encryption` varchar(255) DEFAULT NULL,
  `smtp_username` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `allowed_attachments` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `user_id`, `name`, `from_name`, `from_email`, `reply_to`, `smtp_host`, `smtp_port`, `smtp_encryption`, `smtp_username`, `smtp_password`, `allowed_attachments`, `logo`, `created_at`, `updated_at`) VALUES
(1, 9, 'Vinh Huynh Tu', 'Vinh Huynh Tu', 'huynhtuvinh87@gmail.com', 'huynhtuvinh87@gmail.com', 'smtp.gmail.com', '587', 'TLS', 'minaworksvn@gmail.com', 'minaworksvn17', 'jpeg,jpg,gif,png,pdf,zip', '0', 0, 1507611523),
(2, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1507694286, 1507694286);

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE IF NOT EXISTS `subscriber` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `user_id`, `list_id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(22, 9, 9, 'Vinh', 'huynhtuvinh87@gmail.com', 1508226422, 1508226422),
(23, 9, 9, 'GiiCms', 'giicmsvn@gmail.com', 1508226423, 1508226423),
(24, 9, 9, 'Gody', 'godyvietnam@gmail.com', 1508226423, 1508226423);

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE IF NOT EXISTS `template` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `html` text,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `user_id`, `name`, `html`, `created_at`, `updated_at`) VALUES
(1, 9, 'Template 1', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Xin ch&agrave;o [name]</p>\r\n</body>\r\n</html>', 1507775934, 1507792352),
(2, 9, 'Template 2', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p><img src="../uploads/files/121.jpg" alt="" width="820" height="443" /><img src="../uploads/files/121.jpg" alt="" /><img src="../uploads/files/121.jpg" alt="" width="200" height="200" />dvsssssssssssssssss</p>\r\n</body>\r\n</html>', 1507776321, 1507776379);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `email`, `auth_key`, `password_hash`, `password_reset_token`, `api_token`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '', 'admin@gmail.com', 'MMhaEXrgi7MNh1fiRQ2abT_ePpXIMzy5', '$2y$13$IqiGuk1J59sEKcc7gpFexeBbTYh24quDUdGtt6AYcEwFwnGRvpYqO', NULL, '', 'admin', 10, 1489110367, 1489110367),
(9, 'huynhtuvinh87', '', 'huynhtuvinh87@gmail.com', 'qhn0T3Jcu3ThCssXO31sr3PfPS0ZQlTe', '$2y$13$O6NcrCmdYoWxa7tV3pkDk.bLSbECJqK820seSiCiyo1Gd19k6oKsq', NULL, '', 'member', 10, 1507607035, 1507607035);

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE IF NOT EXISTS `user_meta` (
  `user_id` int(11) NOT NULL,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_history`
--
ALTER TABLE `email_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_queue`
--
ALTER TABLE `email_queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `index-user-status` (`status`),
  ADD KEY `index-user-email` (`email`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD KEY `index-user_meta-user_id` (`user_id`),
  ADD KEY `index-user_meta-meta_key` (`meta_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app`
--
ALTER TABLE `app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `email_history`
--
ALTER TABLE `email_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_queue`
--
ALTER TABLE `email_queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD CONSTRAINT `fk-user_meta-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
