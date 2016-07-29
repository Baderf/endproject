-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 28. Jul 2016 um 18:11
-- Server-Version: 10.1.13-MariaDB
-- PHP-Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mailpig`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `events`
--

CREATE TABLE `events` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `date_from` varchar(30) NOT NULL,
  `date_to` varchar(30) NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `events`
--

INSERT INTO `events` (`id`, `user_id`, `form_id`, `title`, `type`, `created_at`, `date_from`, `date_to`, `deleted`) VALUES
(24, 1, 0, 'Neues Event Testvorgang', 'Mitarbeiterevent', '07/28/2016 6:00 pm', '11/03/2012 12:00 PM', '12/03/2012 12:00 PM', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `events_link_eventdetails`
--

CREATE TABLE `events_link_eventdetails` (
  `event_id` int(11) NOT NULL,
  `eventdetails_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `events_link_eventdetails`
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
(24, 16);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event_details`
--

CREATE TABLE `event_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `event_id` int(11) NOT NULL,
  `participants_max` int(11) NOT NULL DEFAULT '200',
  `participants_current` int(11) NOT NULL,
  `destination_ids` varchar(150) NOT NULL,
  `event_image` varchar(200) NOT NULL DEFAULT 'standard-image.jpg',
  `formular_ids` int(11) NOT NULL,
  `mail_ids` int(11) NOT NULL,
  `statistic_ids` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `event_details`
--

INSERT INTO `event_details` (`id`, `event_id`, `participants_max`, `participants_current`, `destination_ids`, `event_image`, `formular_ids`, `mail_ids`, `statistic_ids`) VALUES
(16, 24, 200, 0, '', 'standard-image.jpg', 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `formulars`
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
  `user_field_ids` varchar(150) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `formulars`
--

INSERT INTO `formulars` (`id`, `title`, `user_id`, `description`, `action`, `action_target`, `standard_field_ids`, `deactive_standard_fields`, `user_field_ids`) VALUES
(1, 'Testtitel', 1, 'Seasdjioadjioasdjioasdjioasjioasdiojjioajioasdsad asdjiosad ia oiasiosa iojasd sjdi sd afjopdv pv admkdfskopfsdokp sdfjop sdf sdfa', 'choose', 'id', ':10::1::2::4::5::7:', ':3::6::8::9::11::12::13::14::15::16:', ':36::37:'),
(5, 'TEST3', 1, NULL, '0', NULL, ':1::2::4::5::7:', ':3::6::8::9::10::11::12::13::14::15::16:', '0');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `settings`
--

CREATE TABLE `settings` (
  `standard_active_field_ids` varchar(500) NOT NULL,
  `standard_deactive_field_ids` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `settings`
--

INSERT INTO `settings` (`standard_active_field_ids`, `standard_deactive_field_ids`) VALUES
(':1::2::4::5::7:', ':3::6::8::9::10::11::12::13::14::15::16:');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `standard_formular_fields`
--

CREATE TABLE `standard_formular_fields` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `type` varchar(150) NOT NULL,
  `is_standard` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `standard_formular_fields`
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
-- Tabellenstruktur für Tabelle `users`
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
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `usergroup`, `data`, `created_at`, `hash`, `is_active`) VALUES
(1, 'florian', 'florian-bader@gmx.at', '7696f77acb71b55d282f8e673ed3bd06b8b7b720:1695', 1, '{"vname":"Florian","nname":"Bader","country":"0"}', 1468395961, '5785f1b96a81e', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users_event_24`
--

CREATE TABLE `users_event_24` (
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
-- Tabellenstruktur für Tabelle `users_event_template`
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
-- Tabellenstruktur für Tabelle `users_mails_24`
--

CREATE TABLE `users_mails_24` (
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
-- Tabellenstruktur für Tabelle `users_mails_template`
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
-- Tabellenstruktur für Tabelle `user_formular_fields`
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
-- Daten für Tabelle `user_formular_fields`
--

INSERT INTO `user_formular_fields` (`id`, `user_id`, `formular_id`, `title`, `type`, `default_value`, `data_values`, `placeholder`, `is_required`) VALUES
(34, 1, 1, 'Mein Selectionfield', 'text', 'Value 1', '', 'Das ist ein Placeholder', 'true'),
(35, 1, 1, 'Numberfelds', 'text', '', '', 'Das ist ein Placeholder...', 'false'),
(36, 1, 1, 'DATE123asd', 'date', '07/14/2016', '', 'gasd', 'false'),
(37, 1, 1, 'TEST123123asd', 'select', 'Ernst123', ':Ernst123::Hans::Peter:', 'das is n pla', 'true');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `event_details`
--
ALTER TABLE `event_details`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `formulars`
--
ALTER TABLE `formulars`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `standard_formular_fields`
--
ALTER TABLE `standard_formular_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indizes für die Tabelle `users_event_24`
--
ALTER TABLE `users_event_24`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users_mails_24`
--
ALTER TABLE `users_mails_24`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user_formular_fields`
--
ALTER TABLE `user_formular_fields`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT für Tabelle `event_details`
--
ALTER TABLE `event_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT für Tabelle `formulars`
--
ALTER TABLE `formulars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT für Tabelle `standard_formular_fields`
--
ALTER TABLE `standard_formular_fields`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `users_event_24`
--
ALTER TABLE `users_event_24`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `users_mails_24`
--
ALTER TABLE `users_mails_24`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `user_formular_fields`
--
ALTER TABLE `user_formular_fields`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
