-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : easyentbtsndrc.mysql.db
-- Généré le : lun. 13 jan. 2025 à 08:59
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
-- Structure de la table `animaux`
--

CREATE TABLE `animaux` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `video_url` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `animaux`
--

INSERT INTO `animaux` (`id`, `name`) VALUES
(1, 'Python'),
(2, 'Tortue'),
(3, 'Iguane'),
(4, 'Ara'),
(5, 'Grand Hocco'),
(6, 'Panthère'),
(7, 'Perroquet'),
(8, 'Tamarin'),
(9, 'Capucin'),
(10, 'Ouistiti'),
(11, 'Gibbon'),
(12, 'Varan de Komodo'),
(13, 'Eléphant'),
(14, 'Girafe'),
(15, 'Grivet'),
(16, 'Cercorpithèque'),
(17, 'Hyène'),
(18, 'Loup à crinière'),
(19, 'Lion'),
(20, 'Hippopotame'),
(21, 'Zèbre'),
(22, 'Panda roux'),
(23, 'Lémurien'),
(24, 'Chèvre naine'),
(25, 'Mouflon'),
(26, 'Binturong'),
(27, 'Loutre'),
(28, 'Macaque crabier'),
(29, 'Cerf'),
(30, 'Vautour'),
(31, 'Daim'),
(32, 'Antilope'),
(33, 'Nilgut'),
(34, 'Loup d\'Europe'),
(35, 'Rhinocéros'),
(36, 'Suricate'),
(37, 'Fennec'),
(38, 'Coati'),
(39, 'Saïmiri'),
(40, 'Tapir'),
(41, 'Casoar'),
(42, 'Crocodile nain'),
(43, 'Guépard'),
(44, 'Gazelle'),
(45, 'Autruche'),
(46, 'Gnou'),
(47, 'Oryx beisa'),
(48, 'Marabout'),
(49, 'Cigogne'),
(50, 'Oryx algazelle'),
(51, 'Watusi'),
(52, 'Ane de Somalie'),
(53, 'Yack'),
(54, 'Mouton noir'),
(55, 'Ibis'),
(56, 'Pécari'),
(57, 'Tamanoir'),
(58, 'Flamant rose'),
(59, 'Nandou'),
(60, 'Emeu'),
(61, 'Wallaby'),
(62, 'Porc-épic'),
(63, 'Lynx'),
(64, 'Serval'),
(65, 'Chien des buissons'),
(66, 'Tigre'),
(67, 'Bison'),
(68, 'Ane de provence'),
(69, 'Dromadaire');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `fk_id_enclos` int NOT NULL,
  `note` tinyint NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `nom`, `fk_id_enclos`, `note`, `commentaire`) VALUES
(1, 'Michel DUPONT', 3, 4, 'cdcdcd'),
(2, 'Paul FISCHER ', 2, 5, 'tegdgd  db d ddjd'),
(3, 'TOTO', 14, 3, 'hhjjddd dkddkn d ddd '),
(4, 'Samuel', 12, 4, 'c était top !');

-- --------------------------------------------------------

--
-- Structure de la table `biomes`
--

CREATE TABLE `biomes` (
  `id` int NOT NULL,
  `color` text NOT NULL,
  `name` text NOT NULL,
  `ouvert` tinyint(1) NOT NULL DEFAULT '1',
  `h_deb_repas` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `h_fin_repas` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `biomes`
--

INSERT INTO `biomes` (`id`, `color`, `name`, `ouvert`, `h_deb_repas`, `h_fin_repas`) VALUES
(1, '#70D5C2', 'La Bergerie des reptiles', 1, '12h30', '14h'),
(2, '#A4BDCC', 'Le Vallon des cascades', 1, '12h', '13h'),
(3, '#B5A589', 'Le Belvédère', 1, '', ''),
(4, '#E2A59D', 'Le Plateau', 0, '12h30', '14h'),
(5, '#E2CA9D', 'Les Clairières', 1, '', ''),
(6, '#C5E29D', 'Le Bois des pins', 1, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `enclos`
--

CREATE TABLE `enclos` (
  `id` int NOT NULL,
  `id_biomes` int NOT NULL,
  `h_deb_repas` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `h_fin_repas` varchar(30) NOT NULL,
  `ouvert` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `enclos`
--

INSERT INTO `enclos` (`id`, `id_biomes`, `h_deb_repas`, `h_fin_repas`, `ouvert`) VALUES
(1, 2, '11h', '15h', 1),
(2, 2, '12h30', '14h', 1),
(3, 2, '', '', 0),
(4, 2, '', '', 0),
(5, 2, '', '', 0),
(6, 2, '', '', 0),
(7, 2, '', '', 0),
(8, 2, '', '', 0),
(9, 2, '', '', 0),
(10, 1, '', '', 0),
(11, 3, '', '', 0),
(12, 3, '', '', 0),
(13, 3, '', '', 0),
(14, 3, '', '', 0),
(15, 3, '', '', 0),
(16, 3, '13h', '15h', 1),
(17, 3, '', '', 0),
(18, 3, '', '', 0),
(19, 3, '', '', 0),
(20, 4, '', '', 0),
(21, 4, '', '', 0),
(22, 4, '', '', 0),
(23, 4, '', '', 0),
(24, 4, '', '', 0),
(25, 4, '', '', 0),
(26, 4, '', '', 0),
(27, 4, '', '', 0),
(28, 4, '', '', 0),
(29, 4, '', '', 0),
(30, 4, '', '', 0),
(31, 4, '', '', 0),
(32, 6, '', '', 0),
(33, 6, '', '', 0),
(34, 6, '', '', 0),
(35, 6, '', '', 0),
(36, 6, '', '', 0),
(37, 5, '', '', 0),
(38, 5, '', '', 0),
(39, 5, '', '', 0),
(40, 5, '', '', 0),
(41, 5, '', '', 0),
(42, 5, '', '', 0),
(43, 5, '', '', 0),
(44, 5, '', '', 0),
(45, 5, '', '', 0),
(46, 5, '', '', 0),
(47, 5, '', '', 0),
(48, 5, '', '', 0),
(49, 5, '', '', 0),
(50, 5, '', '', 0),
(51, 5, '', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE `profil` (
  `id_profil` tinyint NOT NULL,
  `libelle_profil` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`id_profil`, `libelle_profil`) VALUES
(1, 'admin'),
(2, 'utilisateur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animaux`
--
ALTER TABLE `animaux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `biomes`
--
ALTER TABLE `biomes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `enclos`
--
ALTER TABLE `enclos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animaux`
--
ALTER TABLE `animaux`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `biomes`
--
ALTER TABLE `biomes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `enclos`
--
ALTER TABLE `enclos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
