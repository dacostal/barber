-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 22 mars 2021 à 12:15
-- Version du serveur :  8.0.16
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `barber`
--

-- --------------------------------------------------------

--
-- Structure de la table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `canceled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `barber_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appointment`
--

INSERT INTO `appointment` (`id`, `date`, `start_time`, `end_time`, `canceled`, `created_at`, `deleted_at`, `customer_id`, `barber_id`, `service_id`) VALUES
(2, '2021-03-22', '18:30:00', '19:00:00', 0, '2021-02-05 18:58:22', NULL, 31, 21, 1),
(3, '2021-03-23', '18:30:00', '19:00:00', 0, '2021-02-05 18:59:41', NULL, 31, 21, 3),
(4, '2021-03-24', '18:30:00', '19:00:00', 0, '2021-02-09 00:00:00', NULL, 31, 21, 3),
(5, '2021-03-22', '16:00:00', '16:30:00', 0, '2021-02-09 00:00:00', NULL, 31, 21, 8);

-- --------------------------------------------------------

--
-- Structure de la table `appointment_availability`
--

CREATE TABLE `appointment_availability` (
  `appointment_id` int(11) NOT NULL,
  `availability_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `availability`
--

CREATE TABLE `availability` (
  `id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day` int(11) NOT NULL,
  `time_of_day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `availability`
--

INSERT INTO `availability` (`id`, `start_time`, `end_time`, `day`, `time_of_day`) VALUES
(1, '09:00:00', '09:30:00', 1, 'Matin'),
(2, '09:30:00', '10:00:00', 1, 'Matin'),
(3, '10:00:00', '10:30:00', 1, 'Matin'),
(4, '10:30:00', '11:00:00', 1, 'Matin'),
(5, '11:00:00', '11:30:00', 1, 'Matin'),
(6, '11:30:00', '12:00:00', 1, 'Matin'),
(7, '12:00:00', '12:30:00', 1, 'Apres-midi'),
(8, '12:30:00', '13:00:00', 1, 'Apres-midi'),
(9, '13:00:00', '13:30:00', 1, 'Apres-midi'),
(10, '13:30:00', '14:00:00', 1, 'Apres-midi'),
(11, '14:00:00', '14:30:00', 1, 'Apres-midi'),
(12, '14:30:00', '15:00:00', 1, 'Apres-midi'),
(13, '15:00:00', '15:30:00', 1, 'Apres-midi'),
(14, '15:30:00', '16:00:00', 1, 'Apres-midi'),
(15, '16:00:00', '16:30:00', 1, 'Apres-midi'),
(16, '16:30:00', '17:00:00', 1, 'Apres-midi'),
(17, '17:00:00', '17:30:00', 1, 'Apres-midi'),
(18, '17:30:00', '18:00:00', 1, 'Apres-midi'),
(19, '18:00:00', '18:30:00', 1, 'Apres-midi'),
(20, '18:30:00', '19:00:00', 1, 'Apres-midi'),
(21, '09:00:00', '09:30:00', 2, 'Matin'),
(22, '09:30:00', '10:00:00', 2, 'Matin'),
(23, '10:00:00', '10:30:00', 2, 'Matin'),
(24, '10:30:00', '11:00:00', 2, 'Matin'),
(25, '11:00:00', '11:30:00', 2, 'Matin'),
(26, '11:30:00', '12:00:00', 2, 'Matin'),
(27, '12:00:00', '12:30:00', 2, 'Apres-midi'),
(28, '12:30:00', '13:00:00', 2, 'Apres-midi'),
(29, '13:00:00', '13:30:00', 2, 'Apres-midi'),
(30, '13:30:00', '14:00:00', 2, 'Apres-midi'),
(31, '14:00:00', '14:30:00', 2, 'Apres-midi'),
(32, '14:30:00', '15:00:00', 2, 'Apres-midi'),
(33, '15:00:00', '15:30:00', 2, 'Apres-midi'),
(34, '15:30:00', '16:00:00', 2, 'Apres-midi'),
(35, '16:00:00', '16:30:00', 2, 'Apres-midi'),
(36, '16:30:00', '17:00:00', 2, 'Apres-midi'),
(37, '17:00:00', '17:30:00', 2, 'Apres-midi'),
(38, '17:30:00', '18:00:00', 2, 'Apres-midi'),
(39, '18:00:00', '18:30:00', 2, 'Apres-midi'),
(40, '18:30:00', '19:00:00', 2, 'Apres-midi'),
(41, '09:00:00', '09:30:00', 3, 'Matin'),
(42, '09:30:00', '10:00:00', 3, 'Matin'),
(43, '10:00:00', '10:30:00', 3, 'Matin'),
(44, '10:30:00', '11:00:00', 3, 'Matin'),
(45, '11:00:00', '11:30:00', 3, 'Matin'),
(46, '11:30:00', '12:00:00', 3, 'Matin'),
(47, '12:00:00', '12:30:00', 3, 'Apres-midi'),
(48, '12:30:00', '13:00:00', 3, 'Apres-midi'),
(49, '13:00:00', '13:30:00', 3, 'Apres-midi'),
(50, '13:30:00', '14:00:00', 3, 'Apres-midi'),
(51, '14:00:00', '14:30:00', 3, 'Apres-midi'),
(52, '14:30:00', '15:00:00', 3, 'Apres-midi'),
(53, '15:00:00', '15:30:00', 3, 'Apres-midi'),
(54, '15:30:00', '16:00:00', 3, 'Apres-midi'),
(55, '16:00:00', '16:30:00', 3, 'Apres-midi'),
(56, '16:30:00', '17:00:00', 3, 'Apres-midi'),
(57, '17:00:00', '17:30:00', 3, 'Apres-midi'),
(58, '17:30:00', '18:00:00', 3, 'Apres-midi'),
(59, '18:00:00', '18:30:00', 3, 'Apres-midi'),
(60, '18:30:00', '19:00:00', 3, 'Apres-midi'),
(61, '09:00:00', '09:30:00', 4, 'Matin'),
(62, '09:30:00', '10:00:00', 4, 'Matin'),
(63, '10:00:00', '10:30:00', 4, 'Matin'),
(64, '10:30:00', '11:00:00', 4, 'Matin'),
(65, '11:00:00', '11:30:00', 4, 'Matin'),
(66, '11:30:00', '12:00:00', 4, 'Matin'),
(67, '12:00:00', '12:30:00', 4, 'Apres-midi'),
(68, '12:30:00', '13:00:00', 4, 'Apres-midi'),
(69, '13:00:00', '13:30:00', 4, 'Apres-midi'),
(70, '13:30:00', '14:00:00', 4, 'Apres-midi'),
(71, '14:00:00', '14:30:00', 4, 'Apres-midi'),
(72, '14:30:00', '15:00:00', 4, 'Apres-midi'),
(73, '15:00:00', '15:30:00', 4, 'Apres-midi'),
(74, '15:30:00', '16:00:00', 4, 'Apres-midi'),
(75, '16:00:00', '16:30:00', 4, 'Apres-midi'),
(76, '16:30:00', '17:00:00', 4, 'Apres-midi'),
(77, '17:00:00', '17:30:00', 4, 'Apres-midi'),
(78, '17:30:00', '18:00:00', 4, 'Apres-midi'),
(79, '18:00:00', '18:30:00', 4, 'Apres-midi'),
(80, '18:30:00', '19:00:00', 4, 'Apres-midi'),
(81, '09:00:00', '09:30:00', 5, 'Matin'),
(82, '09:30:00', '10:00:00', 5, 'Matin'),
(83, '10:00:00', '10:30:00', 5, 'Matin'),
(84, '10:30:00', '11:00:00', 5, 'Matin'),
(85, '11:00:00', '11:30:00', 5, 'Matin'),
(86, '11:30:00', '12:00:00', 5, 'Matin'),
(87, '12:00:00', '12:30:00', 5, 'Apres-midi'),
(88, '12:30:00', '13:00:00', 5, 'Apres-midi'),
(89, '13:00:00', '13:30:00', 5, 'Apres-midi'),
(90, '13:30:00', '14:00:00', 5, 'Apres-midi'),
(91, '14:00:00', '14:30:00', 5, 'Apres-midi'),
(92, '14:30:00', '15:00:00', 5, 'Apres-midi'),
(93, '15:00:00', '15:30:00', 5, 'Apres-midi'),
(94, '15:30:00', '16:00:00', 5, 'Apres-midi'),
(95, '16:00:00', '16:30:00', 5, 'Apres-midi'),
(96, '16:30:00', '17:00:00', 5, 'Apres-midi'),
(97, '17:00:00', '17:30:00', 5, 'Apres-midi'),
(98, '17:30:00', '18:00:00', 5, 'Apres-midi'),
(99, '18:00:00', '18:30:00', 5, 'Apres-midi'),
(100, '18:30:00', '19:00:00', 5, 'Apres-midi'),
(101, '09:00:00', '09:30:00', 6, 'Matin'),
(102, '09:30:00', '10:00:00', 6, 'Matin'),
(103, '10:00:00', '10:30:00', 6, 'Matin'),
(104, '10:30:00', '11:00:00', 6, 'Matin'),
(105, '11:00:00', '11:30:00', 6, 'Matin'),
(106, '11:30:00', '12:00:00', 6, 'Matin'),
(107, '12:00:00', '12:30:00', 6, 'Apres-midi'),
(108, '12:30:00', '13:00:00', 6, 'Apres-midi'),
(109, '13:00:00', '13:30:00', 6, 'Apres-midi'),
(110, '13:30:00', '14:00:00', 6, 'Apres-midi'),
(111, '14:00:00', '14:30:00', 6, 'Apres-midi'),
(112, '14:30:00', '15:00:00', 6, 'Apres-midi'),
(113, '15:00:00', '15:30:00', 6, 'Apres-midi'),
(114, '15:30:00', '16:00:00', 6, 'Apres-midi'),
(115, '16:00:00', '16:30:00', 6, 'Apres-midi'),
(116, '16:30:00', '17:00:00', 6, 'Apres-midi'),
(117, '17:00:00', '17:30:00', 6, 'Apres-midi'),
(118, '17:30:00', '18:00:00', 6, 'Apres-midi'),
(119, '18:00:00', '18:30:00', 6, 'Apres-midi'),
(120, '18:30:00', '19:00:00', 6, 'Apres-midi');

-- --------------------------------------------------------

--
-- Structure de la table `barber`
--

CREATE TABLE `barber` (
  `id` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `barber`
--

INSERT INTO `barber` (`id`, `is_admin`) VALUES
(21, 1),
(22, 0),
(23, 0),
(24, 0),
(25, 0),
(26, 0),
(27, 0),
(28, 0),
(29, 0),
(30, 0);

-- --------------------------------------------------------

--
-- Structure de la table `barber_availability`
--

CREATE TABLE `barber_availability` (
  `barber_id` int(11) NOT NULL,
  `availability_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `barber_availability`
--

INSERT INTO `barber_availability` (`barber_id`, `availability_id`) VALUES
(21, 1),
(21, 2),
(21, 3),
(21, 4),
(21, 5),
(21, 6),
(21, 7),
(21, 8),
(21, 9),
(21, 10),
(21, 11),
(21, 12),
(21, 13),
(21, 14),
(21, 15),
(21, 16),
(21, 17),
(21, 18),
(21, 19),
(21, 20),
(21, 21),
(21, 22),
(21, 23),
(21, 24),
(21, 25),
(21, 26),
(21, 27),
(21, 28),
(21, 29),
(21, 30),
(21, 31),
(21, 32),
(21, 33),
(21, 34),
(21, 35),
(21, 36),
(21, 37),
(21, 38),
(21, 39),
(21, 40),
(21, 41),
(21, 42),
(21, 43),
(21, 44),
(21, 45),
(21, 46),
(21, 47),
(21, 48),
(21, 49),
(21, 50),
(21, 51),
(21, 52),
(21, 53),
(21, 54),
(21, 55),
(21, 56),
(21, 57),
(21, 58),
(21, 59),
(21, 60),
(21, 61),
(21, 62),
(21, 63),
(21, 64),
(21, 65),
(21, 66),
(21, 67),
(21, 68),
(21, 69),
(21, 70),
(21, 71),
(21, 72),
(21, 73),
(21, 74),
(21, 75),
(21, 76),
(21, 77),
(21, 78),
(21, 79),
(21, 80),
(21, 81),
(21, 82),
(21, 83),
(21, 84),
(21, 85),
(21, 86),
(21, 87),
(21, 88),
(21, 89),
(21, 90),
(21, 91),
(21, 92),
(21, 93),
(21, 94),
(21, 95),
(21, 96),
(21, 97),
(21, 98),
(21, 99),
(21, 100),
(21, 101),
(21, 102),
(21, 103),
(21, 104),
(21, 105),
(21, 106),
(21, 107),
(21, 108),
(21, 109),
(21, 110),
(21, 111),
(21, 112),
(21, 113),
(21, 114),
(21, 115),
(21, 116),
(21, 117),
(21, 118),
(21, 119),
(21, 120),
(23, 1),
(23, 2),
(23, 3),
(23, 4),
(23, 5),
(23, 6),
(23, 7),
(23, 8),
(23, 9),
(23, 10),
(23, 11),
(23, 12),
(23, 13),
(23, 14),
(23, 15),
(23, 16),
(23, 17),
(23, 18),
(23, 19),
(23, 20),
(23, 21),
(23, 22),
(23, 23),
(23, 24),
(23, 25),
(23, 26),
(23, 27),
(23, 28),
(23, 29),
(23, 30),
(23, 31),
(23, 32),
(23, 33),
(23, 34),
(23, 35),
(23, 36),
(23, 37),
(23, 38),
(23, 39),
(23, 40),
(23, 41),
(23, 42),
(23, 43),
(23, 44),
(23, 45),
(23, 46),
(23, 47),
(23, 48),
(23, 49),
(23, 50),
(23, 51),
(23, 52),
(23, 53),
(23, 54),
(23, 55),
(23, 56),
(23, 57),
(23, 58),
(23, 59),
(23, 60),
(23, 61),
(23, 62),
(23, 63),
(23, 64),
(23, 65),
(23, 66),
(23, 67),
(23, 68),
(23, 69),
(23, 70),
(23, 71),
(23, 72),
(23, 73),
(23, 74),
(23, 75),
(23, 76),
(23, 77),
(23, 78),
(23, 79),
(23, 80),
(23, 81),
(23, 82),
(23, 83),
(23, 84),
(23, 85),
(23, 86),
(23, 87),
(23, 88),
(23, 89),
(23, 90),
(23, 91),
(23, 92),
(23, 93),
(23, 94),
(23, 95),
(23, 96),
(23, 97),
(23, 98),
(23, 99),
(23, 100),
(27, 7),
(27, 8),
(27, 9),
(27, 10),
(27, 11),
(27, 12),
(27, 13),
(27, 14),
(27, 15),
(27, 16),
(27, 17),
(27, 18),
(27, 19),
(27, 20),
(27, 21),
(27, 22),
(27, 23),
(27, 24),
(27, 25),
(27, 26),
(27, 27),
(27, 28),
(27, 29),
(27, 30),
(27, 31),
(27, 32),
(27, 33),
(27, 34),
(27, 35),
(27, 36),
(27, 37),
(27, 38),
(27, 39),
(27, 40),
(27, 41),
(27, 42),
(27, 43),
(27, 44),
(27, 45),
(27, 46),
(27, 47),
(27, 48),
(27, 49),
(27, 50),
(27, 51),
(27, 52),
(27, 53),
(27, 54),
(27, 55),
(27, 56),
(27, 57),
(27, 58),
(27, 59),
(27, 60),
(27, 61),
(27, 62),
(27, 63),
(27, 64),
(27, 65),
(27, 66),
(27, 67),
(27, 68),
(27, 69),
(27, 70),
(27, 71),
(27, 72),
(27, 73),
(27, 74),
(27, 75),
(27, 76),
(27, 77),
(27, 78),
(27, 79),
(27, 80),
(27, 81),
(27, 82),
(27, 83),
(27, 84),
(27, 85),
(27, 86),
(27, 87),
(27, 88),
(27, 89),
(27, 90),
(27, 91),
(27, 92),
(27, 93),
(27, 94),
(27, 95),
(27, 96),
(27, 97),
(27, 98),
(27, 99),
(27, 100),
(27, 101),
(27, 102),
(27, 103),
(27, 104),
(27, 105),
(27, 106),
(27, 107),
(27, 108),
(27, 109),
(27, 110),
(27, 111),
(27, 112),
(27, 113),
(27, 114),
(27, 115),
(27, 116),
(27, 117),
(27, 118),
(27, 119),
(27, 120);

-- --------------------------------------------------------

--
-- Structure de la table `barber_service`
--

CREATE TABLE `barber_service` (
  `barber_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `barber_service`
--

INSERT INTO `barber_service` (`barber_id`, `service_id`) VALUES
(21, 1),
(21, 6),
(22, 2),
(23, 1),
(24, 3),
(25, 4),
(26, 2),
(27, 1),
(28, 8),
(29, 3),
(30, 10);

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`id`, `last_name`, `address`, `city`, `zipcode`) VALUES
(31, 'Kuhlman', '5344 Prince Road Apt. 347', NULL, '75019'),
(32, 'O\'Reilly', '3103 Denis Vista Suite 787', NULL, '75019'),
(33, 'Torp', '2825 Adah Lakes Suite 875', NULL, '75019'),
(34, 'Rice', '21608 Elinor Mill Suite 488', NULL, '75019'),
(35, 'Grady', '986 Botsford Roads', NULL, '75019'),
(36, 'Howell', '65284 Francisca Crossroad Apt. 917', NULL, '75019'),
(37, 'Kunde', '499 Cara Groves Apt. 947', NULL, '75019'),
(38, 'Harber', '374 Rudy Oval Apt. 510', NULL, '75019'),
(39, 'Hintz', '15447 Kemmer Junction', NULL, '75019'),
(40, 'Grimes', '165 Marvin Garden Suite 426', NULL, '75019');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210124174204', '2021-03-11 14:03:58', 58),
('DoctrineMigrations\\Version20210124175210', '2021-03-11 14:03:58', 6),
('DoctrineMigrations\\Version20210124175529', '2021-03-11 14:03:58', 8),
('DoctrineMigrations\\Version20210128175032', '2021-03-11 14:03:58', 65),
('DoctrineMigrations\\Version20210128175822', '2021-03-11 14:03:58', 10),
('DoctrineMigrations\\Version20210128182137', '2021-03-11 14:03:58', 166),
('DoctrineMigrations\\Version20210306215711', '2021-03-11 14:03:59', 8),
('DoctrineMigrations\\Version20210311143214', '2021-03-11 14:32:25', 315);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `time` time NOT NULL,
  `price` double NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `title`, `description`, `time`, `price`, `created_at`, `deleted_at`, `category`) VALUES
(1, 'Est qui delectus aut.', 'Id laborum autem enim et ullam consequatur nostrum ea.', '00:58:00', 16, '2021-03-11 14:32:40', NULL, 'barbe'),
(2, 'Dolores aperiam rem similique.', 'Quis at voluptatem totam sed beatae laboriosam excepturi.', '00:10:00', 67, '2021-03-11 14:32:40', NULL, 'barbe'),
(3, 'In velit est.', 'Aut quam vel optio sunt omnis laudantium ad.', '00:29:00', 95, '2021-03-11 14:32:40', NULL, 'barbe'),
(4, 'Est eum.', 'Nisi ex vero porro qui.', '00:45:00', 36, '2021-03-11 14:32:40', NULL, 'cheuveux'),
(5, 'Itaque non aut.', 'Enim vitae recusandae ratione molestiae.', '00:53:00', 27, '2021-03-11 14:32:40', NULL, 'combo'),
(6, 'Porro et dolores omnis laudantium.', 'Id soluta aspernatur sunt est et dolore adipisci veniam.', '00:37:00', 71, '2021-03-11 14:32:40', NULL, 'barbe'),
(7, 'Impedit in sint.', 'Omnis cum ipsum explicabo iure accusamus voluptatem et at.', '00:19:00', 15, '2021-03-11 14:32:40', NULL, 'cheuveux'),
(8, 'Rerum quia natus.', 'Tenetur sunt saepe nisi debitis.', '00:12:00', 23, '2021-03-11 14:32:40', NULL, 'cheuveux'),
(9, 'Iste error enim.', 'Accusantium aut aliquid magni explicabo magni.', '00:03:00', 49, '2021-03-11 14:32:40', NULL, 'barbe'),
(10, 'Reiciendis aut aut.', 'Enim autem omnis rerum minus sequi consequatur temporibus.', '00:53:00', 87, '2021-03-11 14:32:40', NULL, 'cheuveux'),
(11, 'toto', 'coupe à toto', '01:15:00', 35, '2021-03-11 00:00:00', NULL, 'combo');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `phone`, `created_at`, `deleted_at`, `type`) VALUES
(21, 'hlemke@pouros.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$JBfzalAdvV0Gal0SVOjzog$ZaUBjTMa7fLB0ymgxzZ+gPGEc8L4arX54v4QeZFUoeU', 'Lelah', '0600000000', '2021-03-11 14:32:41', NULL, 'barber'),
(22, 'keebler.camron@yahoo.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$Li+mIOqRdbw3yCGylTPf3g$d50Ly2zsDSAWxqLeEbiCkabqFsx/UqzjW0Wvhccqhak', 'Jaunita', '0600000001', '2021-03-11 14:32:42', NULL, 'barber'),
(23, 'whowell@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$UvC8EnGvHEu6OmYEW5vsPA$NQMp1kpLJBeMWPvKpXeyrtT0GANvm7u8e4is0g14toE', 'Genoveva', '0600000002', '2021-03-11 14:32:42', NULL, 'barber'),
(24, 'sabrina.marvin@schaden.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$Ll+M1s2zvC2ufqqcC5eWyg$OTaSrIBReTVGCKtZijBgjZZ8OgbmNiRzZBPhVUarXl8', 'Milo', '0600000003', '2021-03-11 14:32:42', NULL, 'barber'),
(25, 'hadley.johns@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$5IAEHGWNO5syMxVInd1FgA$uE3cPho729mKc84d0PPOtc6E8/Ku15p4V/9zvpbuWj8', 'Valentin', '0600000004', '2021-03-11 14:32:42', NULL, 'barber'),
(26, 'jenkins.trent@kuphal.net', '[]', '$argon2id$v=19$m=65536,t=4,p=1$kI2wTgVdVdltHd+/Wh5cwA$WQrxVbkE5srLF3LkeGiF6SEFDdjDxMfRQhO04V64d5k', 'Ayla', '0600000005', '2021-03-11 14:32:42', NULL, 'barber'),
(27, 'hartmann.savanna@dare.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$q06d6ScaY6sz6rR5kKW95g$gIhC/UZFClQhaH6krg/GoALyUEEIJLXw+Xd/VXRFNTM', 'Lyda', '0600000006', '2021-03-11 14:32:42', NULL, 'barber'),
(28, 'nash.rice@klocko.info', '[]', '$argon2id$v=19$m=65536,t=4,p=1$CwDs1g9rSB0IK0nn9MfhTg$hBB+0vc40Q6gavDltQj56UhhCK6N3lk2dkUb8G+I8P0', 'Turner', '0600000007', '2021-03-11 14:32:42', NULL, 'barber'),
(29, 'lfisher@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$qVVCLch3Yu6bn+DzRVAEaQ$r2cRAKSjpri/rmZWP6Om2c4w/wSXkZ1bVaaw1i+SCPA', 'Irwin', '0600000008', '2021-03-11 14:32:43', NULL, 'barber'),
(30, 'thessel@yahoo.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$dOCt+6nt9qY4PtRmYL0VIg$CiuuJn2nDG5ggytsmzljjFezbTnHv0zK4/xz0LQiexM', 'Polly', '0600000009', '2021-03-11 14:32:43', NULL, 'barber'),
(31, 'oceane.roberts@schaden.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$9S1gP0JJeG2uHuFqFiTh4Q$gNg1GApo4wCTbFfJGk51QzRKe476XSyGoLvtpNjC2vs', 'Anabelle', '0600000000', '2021-03-11 14:32:40', NULL, 'customer'),
(32, 'brandt.lemke@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$J7bJwP+zObV6QXaBYPtewg$cRUqsOC83V7YDStlIJdiSRy4Wmy/6xEOjttBQaZRc/Y', 'Kurt', '0600000001', '2021-03-11 14:32:40', NULL, 'customer'),
(33, 'carley.gulgowski@mann.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$rLGSaf4VDS2kleJrXI/bNA$a8PjEcWlh0tUToyNnydqCEedskbltV2INZ5dhqqykFE', 'Orval', '0600000002', '2021-03-11 14:32:40', NULL, 'customer'),
(34, 'kiehn.turner@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$v9lU/HMqmRVU2KYdHqCh/A$qaNEaxvfhtsh6u+y1Hh4BTVL8mxv7tvXrfkXkIpfufc', 'Destany', '0600000003', '2021-03-11 14:32:40', NULL, 'customer'),
(35, 'luettgen.augustus@kautzer.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$iowuJsoYDNgO2ZRnoEhgtA$6uw/m9xVWI2CLiwfZrIAVcO7L2/JSr1ZcwUJGWzjvkU', 'Emmy', '0600000004', '2021-03-11 14:32:41', NULL, 'customer'),
(36, 'pink.williamson@yahoo.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$PZliyuRXNyz4absya2NySg$eprJWwGk0Gfk3ZJNpMfVYOGf65Vxq55C9dPMARJnXnk', 'Frederique', '0600000005', '2021-03-11 14:32:41', NULL, 'customer'),
(37, 'alvena33@yahoo.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$//jAnLJeEbli2PrhSVRYGg$5naN6IvuGllNaWBm5FkiLe2xpshnPnZX7ZaLKPOVEUI', 'Cleveland', '0600000006', '2021-03-11 14:32:41', NULL, 'customer'),
(38, 'tatyana.becker@goyette.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$SANj0UgzgK/k8QM1BPzNSw$/wYsTpB6QA6JvPphbQPjKDzmmJTUFRnHY7ldC0E3+ss', 'Jonas', '0600000007', '2021-03-11 14:32:41', NULL, 'customer'),
(39, 'ilene.durgan@veum.biz', '[]', '$argon2id$v=19$m=65536,t=4,p=1$i3FnVg/kpUHsZOtTsFs+bg$gkbXD+7ViQP6jyhD4D/0rL+j6ef8YdjKu+ehs+8f5YY', 'Louie', '0600000008', '2021-03-11 14:32:41', NULL, 'customer'),
(40, 'crona.olin@hotmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$4IHc/LIKlWJB88j+ONSX5g$Gvzngs322gsWNyBGqx9+Dh0Pys1C9FwIibuAI0GuYo8', 'Hugh', '0600000009', '2021-03-11 14:32:41', NULL, 'customer');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FE38F8449395C3F3` (`customer_id`),
  ADD KEY `IDX_FE38F844BFF2FEF2` (`barber_id`),
  ADD KEY `IDX_FE38F844ED5CA9E6` (`service_id`);

--
-- Index pour la table `appointment_availability`
--
ALTER TABLE `appointment_availability`
  ADD PRIMARY KEY (`appointment_id`,`availability_id`),
  ADD KEY `IDX_C675B5B2E5B533F9` (`appointment_id`),
  ADD KEY `IDX_C675B5B261778466` (`availability_id`);

--
-- Index pour la table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `barber`
--
ALTER TABLE `barber`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `barber_availability`
--
ALTER TABLE `barber_availability`
  ADD PRIMARY KEY (`barber_id`,`availability_id`),
  ADD KEY `IDX_D3E0D757BFF2FEF2` (`barber_id`),
  ADD KEY `IDX_D3E0D75761778466` (`availability_id`);

--
-- Index pour la table `barber_service`
--
ALTER TABLE `barber_service`
  ADD PRIMARY KEY (`barber_id`,`service_id`),
  ADD KEY `IDX_B6C881ABBFF2FEF2` (`barber_id`),
  ADD KEY `IDX_B6C881ABED5CA9E6` (`service_id`);

--
-- Index pour la table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `availability`
--
ALTER TABLE `availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `FK_FE38F8449395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `FK_FE38F844BFF2FEF2` FOREIGN KEY (`barber_id`) REFERENCES `barber` (`id`),
  ADD CONSTRAINT `FK_FE38F844ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Contraintes pour la table `appointment_availability`
--
ALTER TABLE `appointment_availability`
  ADD CONSTRAINT `FK_C675B5B261778466` FOREIGN KEY (`availability_id`) REFERENCES `availability` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C675B5B2E5B533F9` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `barber`
--
ALTER TABLE `barber`
  ADD CONSTRAINT `FK_7C48A9A4BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `barber_availability`
--
ALTER TABLE `barber_availability`
  ADD CONSTRAINT `FK_D3E0D75761778466` FOREIGN KEY (`availability_id`) REFERENCES `availability` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D3E0D757BFF2FEF2` FOREIGN KEY (`barber_id`) REFERENCES `barber` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `barber_service`
--
ALTER TABLE `barber_service`
  ADD CONSTRAINT `FK_B6C881ABBFF2FEF2` FOREIGN KEY (`barber_id`) REFERENCES `barber` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B6C881ABED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `FK_81398E09BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
