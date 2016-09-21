-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2016 at 10:08 AM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.10-2+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exercice`
--

-- --------------------------------------------------------

--
-- Table structure for table `enterprises`
--

CREATE TABLE `enterprises` (
  `id` int(11) NOT NULL,
  `enterprise_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_siren` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_adress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_sector` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `enterprises`
--

INSERT INTO `enterprises` (`id`, `enterprise_name`, `enterprise_siren`, `enterprise_adress`, `enterprise_sector`) VALUES
(37, 'Entreprise A', '012345678', '1 rue des xxxx, 30 000 Nimes', 10),
(41, 'Entreprise B', '876543210', '24 boulevard des fleurs, 75014 Paris', 6);

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE `sectors` (
  `id` int(11) NOT NULL,
  `sector_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`id`, `sector_name`) VALUES
(1, 'Agriculture, chasse, sylviculture'),
(2, 'Pêche, aquaculture, services annexes'),
(3, 'Industries extractives'),
(4, 'Industrie manufacturière'),
(5, 'Production et distribution d\'électricité, de gaz et d\'eau'),
(6, 'Construction'),
(7, 'Commerce ; réparations automobile et d\'articles domestiques'),
(8, 'Hôtels et restaurants'),
(9, 'Transports et communications'),
(10, 'Activités financières'),
(11, 'Immobilier, location et services aux entreprises'),
(12, 'Administration publique'),
(13, 'Education'),
(14, 'Santé et action sociale'),
(15, 'Services collectifs, sociaux et personnels'),
(16, 'Activités des ménages'),
(17, 'Activités extra-territoriales');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(1, 'admin', 'admin', 'admin@admin.dev', 'admin@admin.dev', 1, 'nqvzcq5knvkkg4so4go888sc4o88cgc', '2sScm7n/rD4gIrNArxXU1GMoPVjRohyt2oiwx5tT3o1wpo+Q02AqHsLhDz+lhVVGxiq9diVxGDnZu4eItPIMCQ==', '2016-09-21 10:07:15', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enterprises`
--
ALTER TABLE `enterprises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_82B62DDBD8BE53F1` (`enterprise_sector`);

--
-- Indexes for table `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_1483A5E9A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_1483A5E9C05FB297` (`confirmation_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enterprises`
--
ALTER TABLE `enterprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `enterprises`
--
ALTER TABLE `enterprises`
  ADD CONSTRAINT `FK_82B62DDBD8BE53F1` FOREIGN KEY (`enterprise_sector`) REFERENCES `sectors` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
