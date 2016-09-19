-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 14, 2016 at 12:34 PM
-- Server version: 5.7.13-6-log
-- PHP Version: 5.5.38-1~dotdeb+7.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u79786db2`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) UNSIGNED NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `form_id`, `title`, `enterprise`, `type`, `image`, `created_at`, `created_at_time`, `date_from`, `date_to`, `date_to_time`, `std_sent`, `invitation_sent`, `reminder_sent`, `info_sent`, `ty_sent`, `deleted`) VALUES
(33, 1, 8, 'Testevent', 'Testname', 'Testtyp', 'apps/app_backend/public/media/usermedia_1/33_Testevent/1473267762_65abb483fd6672209b67e2d51062455e_large.jpeg', '09/07/2016 7:00 pm', '1473267605', '11/03/2012 12:00 PM', '12/03/2012 12:00 PM', '1354532400', '0', '1', '1', '0', '0', 0),
(34, 1, 0, 'TestOnline', 'Onlin', 'Online', 'apps/app_backend/public/media/usermedia_1/34_TestOnline/1473597512_485520_613471305428832_6169350582064372401_n.jpg', '09/11/2016 12:33 pm', '1473597198', '11/03/2012 12:00 PM', '11/22/2017 12:00 PM', '1511352000', '1', '0', '0', '0', '0', 0),
(35, 1, 0, '', '', '', 'standard', '09/11/2016 1:11 pm', '1473599518', '09/22/2016 4:00 am', '12/03/2012 12:00 PM', '1354536000', '0', '0', '0', '0', '0', 0),
(36, 8, 10, 'OnlineTest1', 'onlinetest1', 'Mitarbeiterevent', 'standard', '09/11/2016 2:03 pm', '1473602627', '11/30/2016 12:00 PM', '11/30/2016 13:00 PM', '', '0', '1', '0', '0', '0', 0),
(37, 1, 0, 'Test2Online', 'Bl', 'bal', 'standard', '09/12/2016 7:18 am', '1473664719', '11/03/2012 12:00 PM', '12/03/2012 12:00 PM', '1354536000', '1', '1', '0', '0', '0', 0),
(38, 9, 0, 'test', 'TEST2', 'test', 'standard', '09/13/2016 7:51 pm', '1473796295', '11/03/2012 12:00 PM', '12/03/2012 12:00 PM', '1354536000', '0', '0', '0', '0', '0', 0),
(39, 13, 11, 'Testevent', 'Raiffeisen', 'Mitarbeiterevent', 'apps/app_backend/public/media/usermedia_13/39_Testevent/1473816008_65abb483fd6672209b67e2d51062455e_large.jpeg', '09/14/2016 1:19 am', '1473815992', '10/11/2016 12:00 am', '10/12/2016 12:00 am', '1476230400', '0', '1', '0', '0', '0', 0),
(40, 14, 12, 'Investorpresentations', 'Raiffeisen Bank International', 'Evening event', 'apps/app_backend/public/media/usermedia_14/40_Investorpresentations/1473852454_65abb483fd6672209b67e2d51062455e_large.jpeg', '09/14/2016 11:27 am', '1473852440', '09/15/2016 12:00 am', '09/16/2016 12:00 am', '1473984000', '0', '1', '1', '0', '0', 0),
(41, 14, 0, 'Financemeeting', 'Raiffeisen Bank International', 'Employers', 'standard', '09/14/2016 11:42 am', '1473853360', '11/11/2016 12:00 PM', '12/11/2016 12:00 PM', '1481457600', '0', '0', '0', '0', '0', 0),
(42, 15, 0, 'Mein Event', 'smartlabs', 'Party Hard', 'standard', '09/14/2016 12:04 pm', '1473854648', '11/03/2012 12:00 PM', '12/03/2012 12:00 PM', '1354536000', '0', '0', '0', '0', '0', 0),
(45, 16, 0, 'Event', 'Enterprise', 'Event', 'standard', '09/14/2016 12:12 pm', '1473855166', '10/17/2016 12:00 PM', '10/18/2016 12:00 PM', '1476792000', '0', '0', '0', '0', '0', 0),
(47, 14, 0, 'asjdioasd', 'ajsidoadjio', 'asjidoasdjioa', 'standard', '09/14/2016 12:24 pm', '1473855895', '09/21/2016 12:00 am', '09/22/2016 3:00 am', '1474513200', '0', '0', '0', '0', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `events_link_eventdetails`
--

CREATE TABLE `events_link_eventdetails` (
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
(33, 25),
(34, 26),
(35, 27),
(36, 28),
(37, 29),
(38, 30),
(39, 31),
(40, 32),
(41, 33),
(42, 34),
(43, 35),
(44, 36),
(45, 37),
(46, 38),
(47, 39);

-- --------------------------------------------------------

--
-- Table structure for table `event_details`
--

CREATE TABLE `event_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `event_id` int(11) NOT NULL,
  `participants_max` int(11) NOT NULL DEFAULT '200',
  `participants_current` int(11) NOT NULL,
  `destination_ids` varchar(150) NOT NULL,
  `event_image` varchar(200) NOT NULL DEFAULT 'standard',
  `formular_ids` int(11) NOT NULL,
  `mail_ids` int(11) NOT NULL,
  `statistic_ids` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(25, 33, 200, 0, '', 'standard', 0, 0, 0),
(26, 34, 200, 0, '', 'standard', 0, 0, 0),
(27, 35, 200, 0, '', 'standard', 0, 0, 0),
(28, 36, 200, 0, '', 'standard', 0, 0, 0),
(29, 37, 200, 0, '', 'standard', 0, 0, 0),
(30, 38, 200, 0, '', 'standard', 0, 0, 0),
(31, 39, 200, 0, '', 'standard', 0, 0, 0),
(32, 40, 200, 0, '', 'standard', 0, 0, 0),
(33, 41, 200, 0, '', 'standard', 0, 0, 0),
(34, 42, 200, 0, '', 'standard', 0, 0, 0),
(35, 43, 200, 0, '', 'standard', 0, 0, 0),
(36, 44, 200, 0, '', 'standard', 0, 0, 0),
(37, 45, 200, 0, '', 'standard', 0, 0, 0),
(38, 46, 200, 0, '', 'standard', 0, 0, 0),
(39, 47, 200, 0, '', 'standard', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `formulars`
--

CREATE TABLE `formulars` (
  `id` int(10) UNSIGNED NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `formulars`
--

INSERT INTO `formulars` (`id`, `title`, `user_id`, `description`, `action`, `action_target`, `standard_field_ids`, `deactive_standard_fields`, `user_field_ids`, `created_at`, `updated_at`) VALUES
(1, 'Testtitel', 1, 'Seasdjioadjioasdjioasdjioasjioasdiojjioajioasdsad asdjiosad ia oiasiosa iojasd sjdi sd afjopdv pv admkdfskopfsdokp sdfjop sdf sdfa', 'url', 'www.google.at', ':1::2::5::4::7:', ':3::6::8::9::11::12::13::14::15::16::10:', ':36::37::39::40::41:', '', '12/09/2016 07:33 am'),
(5, 'TEST3', 1, '', 'confirmation_mail', '7', ':1::2::4::5::7:', ':3::6::8::9::10::11::12::13::14::15::16:', ':37:', '', '07/09/2016 04:14 pm'),
(6, 'Gelis VA', 1, 'Das ist meine VA', 'confirmation_mail', 'id', ':1::2::4::5::7:', ':3::6::8::9::10::11::12::13::14::15::16:', ':42:', '15/08/2016 08:58 pm', '12/09/2016 07:43 am'),
(7, 'Manuels Formular', 1, 'OASCHLOCH', 'choose', 'id', ':1::4::5::9::7:', ':3::6::8::10::11::12::13::14::15::16::2:', ':43:', '17/08/2016 03:56 pm', '17/08/2016 03:05 pm'),
(8, 'Begleitperson', 1, NULL, '0', NULL, ':1::2::4::5::7:', ':3::6::8::9::10::11::12::13::14::15::16:', ':44:', '21/08/2016 02:15 pm', '21/08/2016 02:10 pm'),
(9, 'TEstformular', 1, NULL, '0', NULL, ':1::4::2::5::7:', ':3::6::8::9::10::11::12::13::14::15::16:', ':45::46:', '21/08/2016 04:18 pm', '12/09/2016 09:35 pm'),
(10, 'TestOnline1', 8, 'Please fill in all fields!', 'confirmation_mail', 'Danke fÃ¼r deine Registrierung!', ':2::4::5::7:', ':3::6::8::9::10::11::12::13::14::15::16::1:', ':47:', '11/09/2016 02:06 pm', '11/09/2016 02:11 pm'),
(11, 'Testformular', 13, 'Testbeschreibung', 'feedback', 'Test - Danke fÃ¼r deine Registrierung', ':1::2::4::5::7:', ':3::6::8::9::10::11::12::13::14::15::16:', ':48:', '14/09/2016 01:42 am', '14/09/2016 01:54 am'),
(12, 'Investorpresentations Formular', 14, 'This is the accepting formular for the event: investorpresentations.', 'url', 'www.google.at', ':2::4::6::5::7:', ':3::8::9::10::11::12::13::14::15::16::1:', ':49::50:', '14/09/2016 11:12 am', '14/09/2016 12:26 pm'),
(13, 'Financemeeting', 14, '', 'feedback', '44', ':1::2::4::5::7:', ':3::6::8::9::10::11::12::13::14::15::16:', '0', '14/09/2016 11:14 am', '14/09/2016 11:41 am');

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

CREATE TABLE `mails` (
  `id` int(11) UNSIGNED NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mails`
--

INSERT INTO `mails` (`id`, `user_id`, `event_id`, `title`, `subject`, `sender`, `sender_adress`, `preview`, `mail_type`, `already_sent`, `file_edit_name`, `file_mail_name`, `last_update`) VALUES
(25, 1, 33, 'Einladungsmail fÃ¼r Event', 'Testsubject', 'Testevent', 'florian.bader@gmx.at', 'Test', 'invitation', 1, 'mail_25.html', 'mail_25.html', '07/09/2016 07:23 pm'),
(26, 1, 33, 'EinTest', 'TestBetreff', 'Testname', 'florian-bader@gmx.at', 'TEst123', 'information', 0, 'mail_26.html', 'mail_26.html', '14/09/2016 07:00 am'),
(27, 1, 34, 'TEST', 'asdasd', '', '', '', 'savethedate', 0, 'mail_27.html', 'mail_27.html', ''),
(28, 1, 34, 'Jsjsjs', 'Sjsjs', '', '', '', 'confirmation', 0, 'mail_28.html', 'mail_28.html', ''),
(29, 1, 34, 'TEST', 'TEST2', 'Floooo', 'florian-bader@gmx.at', 'SERS', 'invitation', 0, 'mail_29.html', 'mail_29.html', ''),
(30, 1, 34, 'TEST222', 'Test222', '', '', '', 'reminder', 0, 'mail_30.html', 'mail_30.html', '13/09/2016 07:03 pm'),
(31, 8, 36, 'TestEinladung', 'Einladung: TestOnline', 'onlinetest1', 'florian-bader@gmx.at', 'Dies ist eine Einladung!', 'invitation', 1, 'mail_31.html', 'mail_31.html', '11/09/2016 02:19 pm'),
(32, 8, 36, 'Confirmationtest', 'Confirmation: Zur Einladung', 'onlinetest1', 'florian-bader@gmx.at', 'Confirmation', 'confirmation', 0, 'mail_32.html', 'mail_32.html', '11/09/2016 02:03 pm'),
(33, 1, 37, 'Einladung: Rafaels Einladung', 'Test', 'TEst', 'florian-bader@gmx.at', 'TEST', 'savethedate', 1, 'mail_33.html', 'mail_33.html', '12/09/2016 07:08 am'),
(34, 1, 37, 'Test2', 'Confirmation: Rafaels BestÃ¤tigung', '', '', '', 'confirmation', 0, 'mail_34.html', 'mail_34.html', '13/09/2016 07:54 pm'),
(35, 1, 37, 'hzzug', 'gzuugz', '', '', '', 'thankyou', 0, 'mail_35.html', 'mail_35.html', '13/09/2016 12:16 pm'),
(36, 1, 37, 'Einladungstest', 'Testbetreff', 'Ich', 'florian-bader@gmx.at', 'Hallo', 'invitation', 1, 'mail_36.html', 'mail_36.html', '13/09/2016 12:36 pm'),
(37, 1, 33, 'test', 'Test', '', '', '', 'savethedate', 0, 'mail_37.html', 'mail_37.html', '13/09/2016 01:34 pm'),
(38, 1, 33, 'test2', 'test', 'Test', 'florian-bader@gmx.at', 'TEST', 'reminder', 1, 'mail_38.html', 'mail_38.html', '13/09/2016 09:31 pm'),
(39, 1, 37, 'TESTVIEW', 'TESTVIEW', 'test', 'florian-bader@gmx.at', 'test', 'reminder', 0, 'mail_39.html', 'mail_39.html', '13/09/2016 02:39 pm'),
(40, 9, 38, 'test', 'test', '', '', '', 'invitation', 0, 'mail_40.html', 'mail_40.html', ''),
(41, 1, 33, 'TET123', 'asd', '', '', '', 'thankyou', 0, 'mail_41.html', 'mail_41.html', '13/09/2016 09:11 pm'),
(42, 13, 39, 'Testeinladung', 'Einladung: Test', 'Ich', 'florian-bader@gmx.at', 'TEST', 'invitation', 1, 'mail_42.html', 'mail_42.html', '14/09/2016 01:21 am'),
(43, 14, 40, 'Invitation Investorpresentation', 'Invitation - Investorpresentations 2016', 'Raiffeisen Bank International', 'florian-bader@gmx.at', 'Hi, this is the Invitation', 'invitation', 1, 'mail_43.html', 'mail_43.html', '14/09/2016 11:23 am'),
(44, 14, 40, 'Confirmation Investorpresentations', 'Confirmation - Investorpresentations', 'Raiffeisen Bank International', 'florian-bader@gmx.at', 'Hi, this is the confirmation', 'confirmation', 0, 'mail_44.html', 'mail_44.html', '14/09/2016 11:16 am'),
(45, 14, 40, 'Reminder: Investorpresentation', 'Reminder - Investorpresentation 2016', 'Raiffeisen Bank International', 'florian-bader@gmx.at', 'Hallo, das ist ein Text.', 'reminder', 1, 'mail_45.html', 'mail_45.html', '14/09/2016 12:31 pm'),
(46, 16, 45, 'TestPlate', 'Subject', '', '', '', 'invitation', 0, 'mail_46.html', 'mail_46.html', '');

-- --------------------------------------------------------

--
-- Table structure for table `mail_templates`
--

CREATE TABLE `mail_templates` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `template_mail` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_templates`
--

INSERT INTO `mail_templates` (`id`, `user_id`, `title`, `template_mail`) VALUES
(1, 1, 'TEST', 'mail_11'),
(25, 1, 'TEST', 'mail_12'),
(29, 1, 'TEST mit TEmplate', 'mail_13'),
(30, 1, 'TESTCONFIRMATION', 'mail_21'),
(31, 1, 'Test-mail', 'mail_1'),
(32, 8, 'TestEinladung', 'mail_31'),
(33, 1, 'Test2', 'mail_34'),
(34, 14, 'Invitation Investorpresentation', 'mail_43');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
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

CREATE TABLE `standard_formular_fields` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `type` varchar(150) NOT NULL,
  `is_standard` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `usergroup` int(11) NOT NULL,
  `data` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `is_active` int(11) NOT NULL,
  `intro_on` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `usergroup`, `data`, `created_at`, `hash`, `is_active`, `intro_on`) VALUES
(1, 'florian', 'florian-bader@gmx.at', '7696f77acb71b55d282f8e673ed3bd06b8b7b720:1695', 1, '{"vname":"Florian","nname":"Bader","country":"0"}', 1468395961, '5785f1b96a81e', 1, 1),
(8, 'online', 'florian-bader@gmx.at', 'd4b34aca401843e6d3dc2e68f7338c0e5f5fd094:3298', 1, '{"vname":"florianBa","nname":"bader","country":"Schweiz"}', 1473602312, '57d5630838f19', 1, 1),
(9, 'bader', 'florian-bader@gmx.at', 'd4c3fffa9b1cf8b10fa12f5120516072f8a3ab0d:3137', 1, '{"vname":"ajisod","nname":"asdjio","country":"Schweiz"}', 1473796250, '57d8589a86d62', 1, 1),
(10, 'floBa', 'florian-bader@gmx.at', '4b648e3eee8f28810523ccff040cf7829620020c:9274', 1, '{"vname":"Florian","nname":"Bader","country":"Schweiz"}', 1473814211, '57d89ec3793a6', 0, 1),
(12, 'Flotschi', 'florian-bader@gmx.at', 'aa7f168baf7fbfbb90fa068bbba4a41c8bdc590f:1995', 1, '{"vname":"Florian","nname":"Bader","country":"Schweiz"}', 1473814415, '57d89f8fbf770', 1, 1),
(13, 'fifi92', 'florian-bader@gmx.at', '0e259ddc0754d6b56c87ca7f9c9eef6b891ed500:8705', 1, '{"vname":"Florian","nname":"Bader","country":"Schweiz"}', 1473815687, '57d8a4876e143', 1, 0),
(14, 'Presentation', 'florian-bader@gmx.at', 'b1b062f4d07cf7e287ab504d25474bfb278a6a02:1046', 1, '{"vname":"Florian","nname":"Bader","country":"\\u00d6sterreich"}', 1473851326, '57d92fbe9e719', 1, 0),
(15, 'gneugeb', 'gn90at@gmail.com', '69ea822b9e92c946896fc2a93b75d2b9d3cb079b:7648', 1, '{"vname":"Guillermo","nname":"Neugebauer","country":"\\u00d6sterreich"}', 1473854507, '57d93c2bd0f02', 1, 0),
(16, 'Daniel', 'lechthaler.d@gmail.com', '5be92915e273ab147b37474c741d98a870c102b0:5720', 1, '{"vname":"Daniel","nname":"Lechthaler","country":"\\u00d6sterreich"}', 1473854567, '57d93c6750151', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_event_33`
--

CREATE TABLE `users_event_33` (
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
  `canceled` int(11) NOT NULL,
  `Altersgruppe` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_event_33`
--

INSERT INTO `users_event_33` (`id`, `hash`, `firstname`, `lastname`, `sex`, `professionaltitle`, `enterprise`, `birthday`, `email`, `fulladress`, `street`, `housenumber`, `city`, `postal`, `salutation`, `trailingtitle`, `function`, `department`, `accepted`, `canceled`, `Altersgruppe`) VALUES
(1, 'e6a9fc04320a924f46c7c737432bb0389d9dd095', 'Testuser', 'TEst2', 'Male', '-', '-', '', 'florian-bader@gmx.at', '-', '-', '-', '-', '-', '-', '-', '-', '-', 0, 0, '26-32');

-- --------------------------------------------------------

--
-- Table structure for table `users_event_34`
--

CREATE TABLE `users_event_34` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_event_34`
--

INSERT INTO `users_event_34` (`id`, `hash`, `firstname`, `lastname`, `sex`, `professionaltitle`, `enterprise`, `birthday`, `email`, `fulladress`, `street`, `housenumber`, `city`, `postal`, `salutation`, `trailingtitle`, `function`, `department`, `accepted`, `canceled`) VALUES
(1, '27628cad1feed1a6c6be37ac46219dabfbadd29d', 'Rafael', 'Riegler', 'Male', '-', '-', '09/12/2016', 'rafael.riegler@rbinternational.com', '-', '-', '-', '-', '-', '-', '-', '-', '-', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_event_35`
--

CREATE TABLE `users_event_35` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_event_36`
--

CREATE TABLE `users_event_36` (
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
  `canceled` int(11) NOT NULL,
  `TestOnline` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_event_36`
--

INSERT INTO `users_event_36` (`id`, `hash`, `firstname`, `lastname`, `sex`, `professionaltitle`, `enterprise`, `birthday`, `email`, `fulladress`, `street`, `housenumber`, `city`, `postal`, `salutation`, `trailingtitle`, `function`, `department`, `accepted`, `canceled`, `TestOnline`) VALUES
(1, '75cb437814b018cc67bffa0233c83e9a1d8cf449', 'Florian', 'Bader', 'Male', '-', '-', '', 'florian-bader@gmx.at', '-', '-', '-', '-', '-', '-', '-', '-', '-', 0, 1, 'Option1');

-- --------------------------------------------------------

--
-- Table structure for table `users_event_37`
--

CREATE TABLE `users_event_37` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_event_37`
--

INSERT INTO `users_event_37` (`id`, `hash`, `firstname`, `lastname`, `sex`, `professionaltitle`, `enterprise`, `birthday`, `email`, `fulladress`, `street`, `housenumber`, `city`, `postal`, `salutation`, `trailingtitle`, `function`, `department`, `accepted`, `canceled`) VALUES
(2, '0710ad351b507b3abac4df3a5cad0207603ce28c', 'test1', 'Bader', 'Male', '-', '-', '-', 'florian-bader@gmx.at', '-', '-', '-', '-', '-', '-', '-', '-', '-', 0, 0),
(3, '8df6e1e8484b13abdfcb62d5742c414ed54f10ed', 'Test2', 'bader', 'Male', '-', '-', '-', 'florian-bad@gmx.at', '-', '-', '-', '-', '-', '-', '-', '-', '-', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_event_38`
--

CREATE TABLE `users_event_38` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_event_39`
--

CREATE TABLE `users_event_39` (
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
  `canceled` int(11) NOT NULL,
  `Testuserformular` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_event_39`
--

INSERT INTO `users_event_39` (`id`, `hash`, `firstname`, `lastname`, `sex`, `professionaltitle`, `enterprise`, `birthday`, `email`, `fulladress`, `street`, `housenumber`, `city`, `postal`, `salutation`, `trailingtitle`, `function`, `department`, `accepted`, `canceled`, `Testuserformular`) VALUES
(1, '0710ad351b507b3abac4df3a5cad0207603ce28c', 'Florian', 'Bader', 'Male', '-', '-', '-', 'florian-bader@gmx.at', '-', '-', '-', '-', '-', '-', '-', '-', '-', 1, 0, 'Test1');

-- --------------------------------------------------------

--
-- Table structure for table `users_event_40`
--

CREATE TABLE `users_event_40` (
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
  `canceled` int(11) NOT NULL,
  `Presentation` varchar(200) NOT NULL,
  `Color` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_event_40`
--

INSERT INTO `users_event_40` (`id`, `hash`, `firstname`, `lastname`, `sex`, `professionaltitle`, `enterprise`, `birthday`, `email`, `fulladress`, `street`, `housenumber`, `city`, `postal`, `salutation`, `trailingtitle`, `function`, `department`, `accepted`, `canceled`, `Presentation`, `Color`) VALUES
(1, '0710ad351b507b3abac4df3a5cad0207603ce28c', 'Florian', 'Bader', 'Male', '-', '-', '-', 'florian-bader@gmx.at', '-', '-', '-', '-', '-', '-', '-', '-', '-', 0, 0, '', ''),
(2, '2355666dc81a7443b6126d73cf95bffbcfcf8b55', 'Rafael', 'Riegler', 'Male', '-', '-', '09/14/2016', 'florian-bader@gmx.at', '-', '-', '-', '-', '-', '-', '-', '-', '-', 0, 0, '', ''),
(3, 'e6a1375747c1cd32ded557eb8ba1621eca989725', 'Kristina', 'Zirm', 'Male', '-', '-', '2016-09-22', 'florian-bader@gmx.at', '-', '-', '-', '-', '-', '-', '-', '-', '-', 1, 0, 'Presentation 1', 'Yellow');

-- --------------------------------------------------------

--
-- Table structure for table `users_event_41`
--

CREATE TABLE `users_event_41` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_event_41`
--

INSERT INTO `users_event_41` (`id`, `hash`, `firstname`, `lastname`, `sex`, `professionaltitle`, `enterprise`, `birthday`, `email`, `fulladress`, `street`, `housenumber`, `city`, `postal`, `salutation`, `trailingtitle`, `function`, `department`, `accepted`, `canceled`) VALUES
(1, '0710ad351b507b3abac4df3a5cad0207603ce28c', 'Florian', 'Bader', 'Male', '-', '-', '-', 'florian-bader@gmx.at', '-', '-', '-', '-', '-', '-', '-', '-', '-', 0, 0),
(2, '6dd74e2efa2eb18e2c0eb0b3dd122b2cdba153a4', 'Kristina', 'Zirm', 'Female', '-', '-', '', 'florian-bader@gmx.at', '-', '-', '-', '-', '-', '-', '-', '-', '-', 0, 0),
(3, '2355666dc81a7443b6126d73cf95bffbcfcf8b55', 'Rafael', 'Riegler', 'Male', '-', '-', '09/14/2016', 'florian-bader@gmx.at', '-', '-', '-', '-', '-', '-', '-', '-', '-', 0, 0),
(4, '3ea4e8d88c119f57ff4a6348f4cca8e2927c2118', 'Angelika', 'Marinitsch', 'Female', '-', '-', '', 'florian-bader@gmx.at', '-', '-', '-', '-', '-', '-', '-', '-', '-', 0, 0),
(5, 'b9eacc22722b0674496c05c9b190aac4d11f0486', 'Birgit', 'Murhammer', 'Female', '-', '-', '-', 'florian-bader@gmx.at', '-', '-', '-', '-', '-', '-', '-', '-', '-', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_event_42`
--

CREATE TABLE `users_event_42` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_event_45`
--

CREATE TABLE `users_event_45` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_event_47`
--

CREATE TABLE `users_event_47` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_event_template`
--

CREATE TABLE `users_event_template` (
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

CREATE TABLE `users_mails_33` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_mails_33`
--

INSERT INTO `users_mails_33` (`id`, `user_id`, `invitation_sent`, `invitation_open`, `invitation_viewed`, `invitation_id`, `reminder_sent`, `reminder_open`, `reminder_viewed`, `reminder_id`, `std_sent`, `std_open`, `std_viewed`, `std_id`, `info_sent`, `info_open`, `info_viewed`, `info_id`, `ty_sent`, `ty_open`, `ty_viewed`, `ty_id`) VALUES
(1, 1, 1, 0, 1, 25, 1, 0, 1, 38, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_mails_34`
--

CREATE TABLE `users_mails_34` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_mails_34`
--

INSERT INTO `users_mails_34` (`id`, `user_id`, `invitation_sent`, `invitation_open`, `invitation_viewed`, `invitation_id`, `reminder_sent`, `reminder_open`, `reminder_viewed`, `reminder_id`, `std_sent`, `std_open`, `std_viewed`, `std_id`, `info_sent`, `info_open`, `info_viewed`, `info_id`, `ty_sent`, `ty_open`, `ty_viewed`, `ty_id`) VALUES
(1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_mails_35`
--

CREATE TABLE `users_mails_35` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_mails_36`
--

CREATE TABLE `users_mails_36` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_mails_36`
--

INSERT INTO `users_mails_36` (`id`, `user_id`, `invitation_sent`, `invitation_open`, `invitation_viewed`, `invitation_id`, `reminder_sent`, `reminder_open`, `reminder_viewed`, `reminder_id`, `std_sent`, `std_open`, `std_viewed`, `std_id`, `info_sent`, `info_open`, `info_viewed`, `info_id`, `ty_sent`, `ty_open`, `ty_viewed`, `ty_id`) VALUES
(1, 1, 1, 0, 0, 32, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_mails_37`
--

CREATE TABLE `users_mails_37` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_mails_37`
--

INSERT INTO `users_mails_37` (`id`, `user_id`, `invitation_sent`, `invitation_open`, `invitation_viewed`, `invitation_id`, `reminder_sent`, `reminder_open`, `reminder_viewed`, `reminder_id`, `std_sent`, `std_open`, `std_viewed`, `std_id`, `info_sent`, `info_open`, `info_viewed`, `info_id`, `ty_sent`, `ty_open`, `ty_viewed`, `ty_id`) VALUES
(2, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 3, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_mails_38`
--

CREATE TABLE `users_mails_38` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_mails_39`
--

CREATE TABLE `users_mails_39` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_mails_39`
--

INSERT INTO `users_mails_39` (`id`, `user_id`, `invitation_sent`, `invitation_open`, `invitation_viewed`, `invitation_id`, `reminder_sent`, `reminder_open`, `reminder_viewed`, `reminder_id`, `std_sent`, `std_open`, `std_viewed`, `std_id`, `info_sent`, `info_open`, `info_viewed`, `info_id`, `ty_sent`, `ty_open`, `ty_viewed`, `ty_id`) VALUES
(1, 1, 1, 0, 1, 42, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_mails_40`
--

CREATE TABLE `users_mails_40` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_mails_40`
--

INSERT INTO `users_mails_40` (`id`, `user_id`, `invitation_sent`, `invitation_open`, `invitation_viewed`, `invitation_id`, `reminder_sent`, `reminder_open`, `reminder_viewed`, `reminder_id`, `std_sent`, `std_open`, `std_viewed`, `std_id`, `info_sent`, `info_open`, `info_viewed`, `info_id`, `ty_sent`, `ty_open`, `ty_viewed`, `ty_id`) VALUES
(1, 1, 1, 0, 1, 43, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 2, 1, 0, 1, 43, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 3, 1, 0, 1, 43, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_mails_41`
--

CREATE TABLE `users_mails_41` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_mails_41`
--

INSERT INTO `users_mails_41` (`id`, `user_id`, `invitation_sent`, `invitation_open`, `invitation_viewed`, `invitation_id`, `reminder_sent`, `reminder_open`, `reminder_viewed`, `reminder_id`, `std_sent`, `std_open`, `std_viewed`, `std_id`, `info_sent`, `info_open`, `info_viewed`, `info_id`, `ty_sent`, `ty_open`, `ty_viewed`, `ty_id`) VALUES
(1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_mails_42`
--

CREATE TABLE `users_mails_42` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_mails_45`
--

CREATE TABLE `users_mails_45` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_mails_47`
--

CREATE TABLE `users_mails_47` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_mails_template`
--

CREATE TABLE `users_mails_template` (
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

CREATE TABLE `user_formular_fields` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `formular_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `default_value` varchar(5000) NOT NULL,
  `data_values` varchar(5000) NOT NULL,
  `placeholder` varchar(500) NOT NULL,
  `is_required` varchar(10) NOT NULL DEFAULT 'true'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(45, 1, 9, 'Begleitperson', 'radio', 'Nein, danke!', ':Nein, danke!::Ja, mÃ¶chte ich!:', '', 'true'),
(46, 1, 9, 'Deine Altersgruppe', 'select', '20-25', ':20-25::26-30::31-40:', '', 'true'),
(47, 8, 10, 'TestOnline', 'select', 'Option1', ':Option1::Option2:', '', 'true'),
(48, 13, 11, 'Testuserformular', 'select', 'Test2', ':Test2::Test1:', '', 'true'),
(49, 14, 12, 'Presentation', 'select', 'Presentation 1', ':Presentation 1::Presentation 2::Presentation 3:', '', 'true'),
(50, 14, 12, 'Color', 'select', 'Yellow', ':Yellow::Black::Gold:', '', 'true');

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_event_33`
--
ALTER TABLE `users_event_33`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_event_34`
--
ALTER TABLE `users_event_34`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_event_35`
--
ALTER TABLE `users_event_35`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_event_36`
--
ALTER TABLE `users_event_36`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_event_37`
--
ALTER TABLE `users_event_37`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_event_38`
--
ALTER TABLE `users_event_38`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_event_39`
--
ALTER TABLE `users_event_39`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_event_40`
--
ALTER TABLE `users_event_40`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_event_41`
--
ALTER TABLE `users_event_41`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_event_42`
--
ALTER TABLE `users_event_42`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_event_45`
--
ALTER TABLE `users_event_45`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_event_47`
--
ALTER TABLE `users_event_47`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_mails_33`
--
ALTER TABLE `users_mails_33`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_mails_34`
--
ALTER TABLE `users_mails_34`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_mails_35`
--
ALTER TABLE `users_mails_35`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_mails_36`
--
ALTER TABLE `users_mails_36`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_mails_37`
--
ALTER TABLE `users_mails_37`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_mails_38`
--
ALTER TABLE `users_mails_38`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_mails_39`
--
ALTER TABLE `users_mails_39`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_mails_40`
--
ALTER TABLE `users_mails_40`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_mails_41`
--
ALTER TABLE `users_mails_41`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_mails_42`
--
ALTER TABLE `users_mails_42`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_mails_45`
--
ALTER TABLE `users_mails_45`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_mails_47`
--
ALTER TABLE `users_mails_47`
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `event_details`
--
ALTER TABLE `event_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `formulars`
--
ALTER TABLE `formulars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `mails`
--
ALTER TABLE `mails`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `mail_templates`
--
ALTER TABLE `mail_templates`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `standard_formular_fields`
--
ALTER TABLE `standard_formular_fields`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users_event_33`
--
ALTER TABLE `users_event_33`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_event_34`
--
ALTER TABLE `users_event_34`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_event_35`
--
ALTER TABLE `users_event_35`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_event_36`
--
ALTER TABLE `users_event_36`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_event_37`
--
ALTER TABLE `users_event_37`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_event_38`
--
ALTER TABLE `users_event_38`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_event_39`
--
ALTER TABLE `users_event_39`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_event_40`
--
ALTER TABLE `users_event_40`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_event_41`
--
ALTER TABLE `users_event_41`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users_event_42`
--
ALTER TABLE `users_event_42`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_event_45`
--
ALTER TABLE `users_event_45`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_event_47`
--
ALTER TABLE `users_event_47`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_mails_33`
--
ALTER TABLE `users_mails_33`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_mails_34`
--
ALTER TABLE `users_mails_34`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_mails_35`
--
ALTER TABLE `users_mails_35`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_mails_36`
--
ALTER TABLE `users_mails_36`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_mails_37`
--
ALTER TABLE `users_mails_37`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_mails_38`
--
ALTER TABLE `users_mails_38`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_mails_39`
--
ALTER TABLE `users_mails_39`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_mails_40`
--
ALTER TABLE `users_mails_40`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_mails_41`
--
ALTER TABLE `users_mails_41`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users_mails_42`
--
ALTER TABLE `users_mails_42`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_mails_45`
--
ALTER TABLE `users_mails_45`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_mails_47`
--
ALTER TABLE `users_mails_47`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_formular_fields`
--
ALTER TABLE `user_formular_fields`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
