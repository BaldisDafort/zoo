-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : easyentbtsndrc.mysql.db
-- Généré le : lun. 13 jan. 2025 à 09:13
-- Version du serveur : 8.0.39-30
-- Version de PHP : 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `easyentbtsndrc`
--

-- --------------------------------------------------------

--
-- Structure de la table `relation_enclos_animaux`
--

CREATE TABLE `relation_enclos_animaux` (
  `id` int NOT NULL,
  `fk_id_enclos` int NOT NULL,
  `fk_id_animal` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `relation_enclos_animaux`
--

INSERT INTO `relation_enclos_animaux` (`id`, `fk_id_enclos`, `fk_id_animal`) VALUES
(1, 1, 4),
(2, 1, 7),
(3, 2, 5),
(4, 3, 6),
(5, 4, 22),
(6, 5, 24),
(7, 6, 23),
(8, 7, 24),
(9, 7, 2),
(10, 8, 25),
(11, 9, 26),
(12, 9, 27),
(13, 10, 1),
(14, 10, 2),
(15, 10, 3),
(16, 11, 35),
(17, 11, 47),
(18, 11, 46),
(19, 12, 36),
(20, 13, 37),
(21, 14, 38),
(22, 14, 39),
(23, 15, 40),
(24, 16, 41),
(25, 17, 42),
(26, 18, 43),
(27, 19, 44),
(28, 19, 45),
(29, 20, 8),
(30, 21, 9),
(31, 18, 43),
(32, 19, 44),
(33, 19, 45),
(34, 20, 8),
(35, 21, 9),
(36, 22, 10),
(37, 23, 11),
(38, 24, 15),
(39, 24, 16),
(40, 25, 12),
(41, 26, 14),
(42, 27, 13),
(43, 28, 17),
(44, 29, 18),
(45, 30, 19),
(46, 31, 19),
(47, 32, 28),
(48, 33, 29),
(49, 35, 31),
(50, 35, 32),
(51, 35, 33),
(52, 36, 34),
(53, 0, 0),
(54, 37, 49),
(55, 0, 0),
(56, 39, 50),
(57, 39, 51),
(58, 39, 52),
(59, 40, 53),
(60, 40, 54),
(61, 41, 55),
(62, 41, 2),
(63, 42, 56),
(64, 43, 57),
(65, 43, 58),
(66, 43, 59),
(67, 44, 60),
(68, 44, 61),
(69, 45, 62),
(70, 46, 63),
(71, 47, 64),
(72, 48, 65),
(73, 49, 66),
(74, 50, 67),
(75, 51, 68),
(76, 51, 69);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL,
  `id_biome` int NOT NULL,
  `name` text,
  `type` enum('wc','water','shop','station','lodge','tent','paillote','nomad_cofee','little_cofee','play_area','picnic_area','view') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fk_id_profil` tinyint NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nickname` text NOT NULL,
  `password` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `fk_id_profil`, `email`, `nickname`, `password`) VALUES
(3, 1, 'kabdelfettah@gmail.com', 'Rimka83270', '$2y$10$HHYhXff5/GO/LDjYbDkX5e/uU9QKd7gSOj7TNfv/eNFLxKjGkjKF6'),
(5, 1, 'selim@gmail.com', 'loup', '$2y$10$PvIgyhqSBnd4jYTJbcnkzO0cN5VmJMRcgufGDri2d2GFjFsN8uCwW'),
(6, 1, 'kabdelfettah@gmail.com', 'Rimka', '$2y$10$UieZMBUQMoFQ.YTFVJau6.787LInMcdBHwu1ucVRGJZOgHqyDI9bO');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `relation_enclos_animaux`
--
ALTER TABLE `relation_enclos_animaux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `relation_enclos_animaux`
--
ALTER TABLE `relation_enclos_animaux`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
