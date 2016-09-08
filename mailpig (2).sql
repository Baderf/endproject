-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 08, 2016 at 10:28 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mailpig`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `enterprise` varchar(500) NOT NULL,
  `type` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL DEFAULT 'standard',
  `created_at` varchar(50) NOT NULL,
  `created_at_time` varchar(100) NOT NULL,
  `date_from` varchar(30) NOT NULL,
  `date_to` varchar(30) NOT NULL,
  `date_to_time` varchar(100) NOT NULL,
  `std_sent` varchar(100) NOT NULL DEFAULT '0',
  `invitation_sent` varchar(100) NOT NULL DEFAULT '0',
  `reminder_sent` varchar(100) NOT NULL DEFAULT '0',
  `info_sent` varchar(100) NOT NULL DEFAULT '0',
  `ty_sent` varchar(100) NOT NULL DEFAULT '0',
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `form_id`, `title`, `enterprise`, `type`, `image`, `created_at`, `created_at_time`, `date_from`, `date_to`, `date_to_time`, `std_sent`, `invitation_sent`, `reminder_sent`, `info_sent`, `ty_sent`, `deleted`) VALUES
(33, 1, 0, 'Testevent', 'Testname', 'Testtyp', 'apps/app_backend/public/media/usermedia_1/33_Testevent/1473267762_65abb483fd6672209b67e2d51062455e_large.jpeg', '09/07/2016 7:00 pm', '1473267605', '11/03/2012 12:00 PM', '12/03/2012 12:00 PM', '1354532400', '0', '0', '0', '0', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `events_link_eventdetails`
--

CREATE TABLE IF NOT EXISTS `events_link_eventdetails` (
  `event_id` int(11) NOT NULL,
  `eventdetails_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events_link_eventdetails`
--

INSERT INTO `events_link_eventdetails` (`event_id`, `eventdetails_id`) VALUES
(14, 3),
(15, 4),
(16, 5),
(0, 6),
(0, 7),
(0, 8),
(17, 9),
(18, 10),
(19, 11),
(20, 12),
(21, 13),
(22, 14),
(23, 15),
(24, 16),
(25, 17),
(26, 18),
(27, 19),
(28, 20),
(29, 21),
(30, 22),
(31, 23),
(32, 24),
(33, 25);

-- --------------------------------------------------------

--
-- Table structure for table `event_details`
--

CREATE TABLE IF NOT EXISTS `event_details` (
`id` int(11) unsigned NOT NULL,
  `event_id` int(11) NOT NULL,
  `participants_max` int(11) NOT NULL DEFAULT '200',
  `participants_current` int(11) NOT NULL,
  `destination_ids` varchar(150) NOT NULL,
  `event_image` varchar(200) NOT NULL DEFAULT 'standard',
  `formular_ids` int(11) NOT NULL,
  `mail_ids` int(11) NOT NULL,
  `statistic_ids` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_details`
--

INSERT INTO `event_details` (`id`, `event_id`, `participants_max`, `participants_current`, `destination_ids`, `event_image`, `formular_ids`, `mail_ids`, `statistic_ids`) VALUES
(16, 24, 200, 0, '', 'standard-image.jpg', 0, 0, 0),
(17, 25, 200, 0, '', 'standard-image.jpg', 0, 0, 0),
(18, 26, 200, 0, '', 'apps/app_backend/public/media/usermedia_1/26_Kristinas Party/1473253213_65abb483fd6672209b67e2d51062455e_large.jpeg', 0, 0, 0),
(19, 27, 200, 0, '', 'standard-image.jpg', 0, 0, 0),
(20, 28, 200, 0, '', 'standard-image.jpg', 0, 0, 0),
(21, 29, 200, 0, '', 'standard-image.jpg', 0, 0, 0),
(22, 30, 200, 0, '', 'standard-image.jpg', 0, 0, 0),
(23, 31, 200, 0, '', 'standard-image.jpg', 0, 0, 0),
(24, 32, 200, 0, '', 'standard-image.jpg', 0, 0, 0),
(25, 33, 200, 0, '', 'standard', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `formulars`
--

CREATE TABLE IF NOT EXISTS `formulars` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(80) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(1500) DEFAULT NULL,
  `action` varchar(150) DEFAULT '0',
  `action_target` varchar(500) DEFAULT NULL,
  `standard_field_ids` varchar(150) NOT NULL DEFAULT '0',
  `deactive_standard_fields` varchar(200) NOT NULL,
  `user_field_ids` varchar(150) NOT NULL DEFAULT '0',
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `formulars`
--

INSERT INTO `formulars` (`id`, `title`, `user_id`, `description`, `action`, `action_target`, `standard_field_ids`, `deactive_standard_fields`, `user_field_ids`, `created_at`, `updated_at`) VALUES
(1, 'Testtitel', 1, 'Seasdjioadjioasdjioasdjioasjioasdiojjioajioasdsad asdjiosad ia oiasiosa iojasd sjdi sd afjopdv pv admkdfskopfsdokp sdfjop sdf sdfa', 'url', 'www.google.at', ':1::2::5::4::7:', ':3::6::8::9::11::12::13::14::15::16::10:', ':37::36::39::40::41:', '', '07/09/2016 04:50 pm'),
(5, 'TEST3', 1, '', 'confirmation_mail', '7', ':1::2::4::5::7:', ':3::6::8::9::10::11::12::13::14::15::16:', ':37:', '', '07/09/2016 04:14 pm'),
(6, 'Gelis VA', 1, 'Das ist meine VA', 'feedback', 'id', ':1::2::4::5::7:', ':3::6::8::9::10::11::12::13::14::15::16:', ':42:', '15/08/2016 08:58 pm', '15/08/2016 08:32 pm'),
(7, 'Manuels Formular', 1, 'OASCHLOCH', 'choose', 'id', ':1::4::5::9::7:', ':3::6::8::10::11::12::13::14::15::16::2:', ':43:', '17/08/2016 03:56 pm', '17/08/2016 03:05 pm'),
(8, 'Begleitperson', 1, NULL, '0', NULL, ':1::2::4::5::7:', ':3::6::8::9::10::11::12::13::14::15::16:', ':44:', '21/08/2016 02:15 pm', '21/08/2016 02:10 pm'),
(9, 'TEstformular', 1, NULL, '0', NULL, ':1::4::2::5::7:', ':3::6::8::9::10::11::12::13::14::15::16:', ':45::46:', '21/08/2016 04:18 pm', '21/08/2016 04:26 pm');

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

CREATE TABLE IF NOT EXISTS `mails` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `sender` varchar(500) NOT NULL,
  `sender_adress` varchar(500) NOT NULL,
  `preview` varchar(1000) NOT NULL,
  `mail_type` varchar(100) NOT NULL,
  `already_sent` int(11) NOT NULL DEFAULT '0',
  `file_edit_name` varchar(150) NOT NULL,
  `file_mail_name` varchar(150) NOT NULL,
  `last_update` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mails`
--

INSERT INTO `mails` (`id`, `user_id`, `event_id`, `title`, `subject`, `sender`, `sender_adress`, `preview`, `mail_type`, `already_sent`, `file_edit_name`, `file_mail_name`, `last_update`) VALUES
(25, 1, 33, 'Einladungsmail fÃ¼r Event', 'Testsubject', '', '', '', 'invitation', 0, 'mail_25.html', 'mail_25.html', '07/09/2016 07:23 pm');

-- --------------------------------------------------------

--
-- Table structure for table `mail_templates`
--

CREATE TABLE IF NOT EXISTS `mail_templates` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `template_mail` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_templates`
--

INSERT INTO `mail_templates` (`id`, `user_id`, `title`, `template_mail`) VALUES
(1, 1, 'TEST', 'mail_11'),
(25, 1, 'TEST', 'mail_12'),
(29, 1, 'TEST mit TEmplate', 'mail_13'),
(30, 1, 'TESTCONFIRMATION', 'mail_21'),
(31, 1, 'Test-mail', 'mail_1');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `standard_active_field_ids` varchar(500) NOT NULL,
  `standard_deactive_field_ids` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`standard_active_field_ids`, `standard_deactive_field_ids`) VALUES
(':1::2::4::5::7:', ':3::6::8::9::10::11::12::13::14::15::16:');

-- --------------------------------------------------------

--
-- Table structure for table `standard_formular_fields`
--

CREATE TABLE IF NOT EXISTS `standard_formular_fields` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `type` varchar(150) NOT NULL,
  `is_standard` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `standard_formular_fields`
--

INSERT INTO `standard_formular_fields` (`id`, `name`, `fullname`, `type`, `is_standard`) VALUES
(1, 'firstname', 'Firstname', 'text', 1),
(2, 'lastname', 'Lastname', 'text', 1),
(3, 'sex', 'Sex', 'text', 1),
(4, 'professionaltitle', 'Professional Title', 'text', 1),
(5, 'enterprise', 'Enterprise', 'text', 1),
(6, 'birthday', 'Birthday', 'date', 1),
(7, 'email', 'Email', 'email', 1),
(8, 'fulladress', 'Full adress', 'text', 1),
(9, 'street', 'Street', 'text', 1),
(10, 'housenumber', 'House number', 'text', 1),
(11, 'city', 'City', 'text', 1),
(12, 'postal', 'Postal adress', 'text', 1),
(13, 'salutation', 'Salutation', 'text', 1),
(14, 'trailingtitle', 'Trailing title', 'text', 1),
(15, 'function', 'Function', 'text', 1),
(16, 'department', 'Department', 'text', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `usergroup` int(11) NOT NULL,
  `data` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `usergroup`, `data`, `created_at`, `hash`, `is_active`) VALUES
(1, 'florian', 'florian-bader@gmx.at', '7696f77acb71b55d282f8e673ed3bd06b8b7b720:1695', 1, '{"vname":"Florian","nname":"Bader","country":"0"}', 1468395961, '5785f1b96a81e', 1),
(2, 'Testuser1', 'florian-bad@gmx.at', '1016050c0fc0dfce15f8a88b2ff611f41a55c17c:3765', 1, '{"vname":"Hallo","nname":"Bader","country":"Schweiz"}', 1473268034, '57d0494285ad8', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_event_33`
--

CREATE TABLE IF NOT EXISTS `users_event_33` (
`id` int(11) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `professionaltitle` varchar(10) NOT NULL,
  `enterprise` varchar(50) NOT NULL,
  `birthday` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fulladress` varchar(500) NOT NULL,
  `street` varchar(50) NOT NULL,
  `housenumber` varchar(10) NOT NULL,
  `city` varchar(10) NOT NULL,
  `postal` varchar(10) NOT NULL,
  `salutation` varchar(30) NOT NULL,
  `trailingtitle` varchar(10) NOT NULL,
  `function` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `accepted` int(11) NOT NULL,
  `canceled` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_event_33`
--

INSERT INTO `users_event_33` (`id`, `hash`, `firstname`, `lastname`, `sex`, `professionaltitle`, `enterprise`, `birthday`, `email`, `fulladress`, `street`, `housenumber`, `city`, `postal`, `salutation`, `trailingtitle`, `function`, `department`, `accepted`, `canceled`) VALUES
(1, 'e6a9fc04320a924f46c7c737432bb0389d9dd095', 'Testuser', '-', 'Male', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_event_template`
--

CREATE TABLE IF NOT EXISTS `users_event_template` (
  `hash` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `professionaltitle` varchar(10) NOT NULL,
  `enterprise` varchar(50) NOT NULL,
  `birthday` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fulladress` varchar(500) NOT NULL,
  `street` varchar(50) NOT NULL,
  `housenumber` varchar(10) NOT NULL,
  `city` varchar(10) NOT NULL,
  `postal` varchar(10) NOT NULL,
  `salutation` varchar(30) NOT NULL,
  `trailingtitle` varchar(10) NOT NULL,
  `function` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `accepted` int(11) NOT NULL,
  `canceled` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_mails_33`
--

CREATE TABLE IF NOT EXISTS `users_mails_33` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invitation_sent` int(11) NOT NULL,
  `invitation_open` int(11) NOT NULL,
  `invitation_viewed` int(11) NOT NULL,
  `invitation_id` int(11) NOT NULL,
  `reminder_sent` int(11) NOT NULL,
  `reminder_open` int(11) NOT NULL,
  `reminder_viewed` int(11) NOT NULL,
  `reminder_id` int(11) NOT NULL,
  `std_sent` int(11) NOT NULL,
  `std_open` int(11) NOT NULL,
  `std_viewed` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `info_sent` int(11) NOT NULL,
  `info_open` int(11) NOT NULL,
  `info_viewed` int(11) NOT NULL,
  `info_id` int(11) NOT NULL,
  `ty_sent` int(11) NOT NULL,
  `ty_open` int(11) NOT NULL,
  `ty_viewed` int(11) NOT NULL,
  `ty_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_mails_33`
--

INSERT INTO `users_mails_33` (`id`, `user_id`, `invitation_sent`, `invitation_open`, `invitation_viewed`, `invitation_id`, `reminder_sent`, `reminder_open`, `reminder_viewed`, `reminder_id`, `std_sent`, `std_open`, `std_viewed`, `std_id`, `info_sent`, `info_open`, `info_viewed`, `info_id`, `ty_sent`, `ty_open`, `ty_viewed`, `ty_id`) VALUES
(1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_mails_template`
--

CREATE TABLE IF NOT EXISTS `users_mails_template` (
  `user_id` int(11) NOT NULL,
  `invitation_sent` int(11) NOT NULL,
  `invitation_open` int(11) NOT NULL,
  `invitation_viewed` int(11) NOT NULL,
  `invitation_id` int(11) NOT NULL,
  `reminder_sent` int(11) NOT NULL,
  `reminder_open` int(11) NOT NULL,
  `reminder_viewed` int(11) NOT NULL,
  `reminder_id` int(11) NOT NULL,
  `std_sent` int(11) NOT NULL,
  `std_open` int(11) NOT NULL,
  `std_viewed` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `info_sent` int(11) NOT NULL,
  `info_open` int(11) NOT NULL,
  `info_viewed` int(11) NOT NULL,
  `info_id` int(11) NOT NULL,
  `ty_sent` int(11) NOT NULL,
  `ty_open` int(11) NOT NULL,
  `ty_viewed` int(11) NOT NULL,
  `ty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_formular_fields`
--

CREATE TABLE IF NOT EXISTS `user_formular_fields` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `formular_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `default_value` varchar(5000) NOT NULL,
  `data_values` varchar(5000) NOT NULL,
  `placeholder` varchar(500) NOT NULL,
  `is_required` varchar(10) NOT NULL DEFAULT 'true'
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_formular_fields`
--

INSERT INTO `user_formular_fields` (`id`, `user_id`, `formular_id`, `title`, `type`, `default_value`, `data_values`, `placeholder`, `is_required`) VALUES
(34, 1, 1, 'Mein Selectionfield', 'text', 'Value 1', '', 'Das ist ein Placeholder', 'true'),
(35, 1, 1, 'Numberfelds', 'text', '', '', 'Das ist ein Placeholder...', 'false'),
(36, 1, 1, 'DATE123asd', 'date', '07/14/2016', '', 'gasd', 'false'),
(37, 1, 1, 'TEST123123asd', 'select', 'Ernst123', ':Ernst123::Hans::Peter:', 'das is n pla', 'true'),
(38, 1, 1, 'VGHFTZ', 'date', '', '', '', 'true'),
(39, 1, 1, 'Dein Geburtsdatum', 'date', '', '', 'Gib dein Geburtsdatum ein...', 'true'),
(40, 1, 1, 'WÃ¤hle aus:', 'select', 'Option1', ':Option1::Option2::Option3:', '', 'true'),
(41, 1, 1, 'Kristinas Zweiter Name', 'select', 'Birgit', ':Birgit::Tanja:', '', 'true'),
(42, 1, 6, 'Gelis Lieblingsfarbe', 'select', 'Gelb', ':Gelb::Blau::Schwarz::Lillaaaa:', '', 'true'),
(43, 1, 7, 'Meine Lieblingsfarbe', 'select', 'Gelb', ':Gelb::Blau::Schwarz:', '', 'true'),
(44, 1, 8, 'Altersgruppe', 'select', '18-25', ':18-25::26-32:', '', 'true'),
(45, 1, 9, 'Begleitperson', 'radio', 'Ja, mÃ¶chte ich!', ':Ja, mÃ¶chte ich!::Nein, danke!:', '', 'true'),
(46, 1, 9, 'Deine Altersgruppe', 'select', '20-25', ':20-25::26-30::31-40:', '', 'true');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_details`
--
ALTER TABLE `event_details`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formulars`
--
ALTER TABLE `formulars`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mails`
--
ALTER TABLE `mails`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_templates`
--
ALTER TABLE `mail_templates`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `standard_formular_fields`
--
ALTER TABLE `standard_formular_fields`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_event_33`
--
ALTER TABLE `users_event_33`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_mails_33`
--
ALTER TABLE `users_mails_33`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_formular_fields`
--
ALTER TABLE `user_formular_fields`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `event_details`
--
ALTER TABLE `event_details`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `formulars`
--
ALTER TABLE `formulars`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `mails`
--
ALTER TABLE `mails`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `mail_templates`
--
ALTER TABLE `mail_templates`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `standard_formular_fields`
--
ALTER TABLE `standard_formular_fields`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_event_33`
--
ALTER TABLE `users_event_33`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_mails_33`
--
ALTER TABLE `users_mails_33`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_formular_fields`
--
ALTER TABLE `user_formular_fields`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
