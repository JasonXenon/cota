-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 18 avr. 2023 à 19:42
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cota`
--

-- --------------------------------------------------------

--
-- Structure de la table `ifo_jeu`
--

CREATE TABLE `ifo_jeu` (
  `jeu_id` int(11) NOT NULL,
  `jeu_nom` varchar(100) NOT NULL,
  `jeu_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ifo_jeu`
--

INSERT INTO `ifo_jeu` (`jeu_id`, `jeu_nom`, `jeu_color`) VALUES
(1, 'Rainbow Six: Siege', '#C32F27'),
(2, 'Valorant', '#7461F0'),
(3, 'Counter Strike Global Offensive', '#0B7A75');

-- --------------------------------------------------------

--
-- Structure de la table `ifo_niveau`
--

CREATE TABLE `ifo_niveau` (
  `niveauID` int(11) NOT NULL,
  `niveauLibelle` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ifo_niveau`
--

INSERT INTO `ifo_niveau` (`niveauID`, `niveauLibelle`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Structure de la table `ifo_profile`
--

CREATE TABLE `ifo_profile` (
  `profileID` int(11) NOT NULL,
  `profileBackgroundColor` varchar(100) NOT NULL DEFAULT '#645E85',
  `profileCreationDate` datetime NOT NULL DEFAULT current_timestamp(),
  `profileAvatar` varchar(100) NOT NULL DEFAULT 'default.png',
  `profileBio` varchar(400) NOT NULL DEFAULT 'Aucune information disponible.',
  `profileBlockType` varchar(100) NOT NULL DEFAULT 'none',
  `profileUserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ifo_profile`
--

INSERT INTO `ifo_profile` (`profileID`, `profileBackgroundColor`, `profileCreationDate`, `profileAvatar`, `profileBio`, `profileBlockType`, `profileUserID`) VALUES
(26, '#b2a6e8', '2022-12-29 18:36:35', '26.jpg', 'yo cv chuis un admin ;)                                        \r\n                                 ', 'images', 40),
(27, '#645E85', '2023-01-11 23:45:19', 'default.png', 'Aucune information disponible.', 'none', 41),
(28, '#645E85', '2023-01-11 23:54:50', 'default.png', 'Aucune information disponible.', 'none', 42),
(32, '#645E85', '2023-04-09 15:52:50', 'default.png', 'Aucune information disponible.', 'none', 46),
(35, '#645E85', '2023-04-12 00:20:14', 'default.png', 'Aucune information disponible.', 'none', 49),
(38, '#645E85', '2023-04-14 22:19:13', 'default.png', 'Aucune information disponible.', 'none', 52),
(39, '#645E85', '2023-04-18 16:03:17', 'default.png', 'Aucune information disponible.', 'none', 53);

-- --------------------------------------------------------

--
-- Structure de la table `ifo_rdv`
--

CREATE TABLE `ifo_rdv` (
  `rdv_id` int(11) NOT NULL,
  `rdv_pseudo` varchar(255) NOT NULL,
  `rdv_date_start` datetime NOT NULL,
  `rdv_date_end` datetime NOT NULL,
  `rdv_moment` varchar(100) NOT NULL,
  `rdv_jeu_id` int(11) DEFAULT NULL,
  `confirmation_status` varchar(255) NOT NULL DEFAULT 'En attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ifo_rdv`
--

INSERT INTO `ifo_rdv` (`rdv_id`, `rdv_pseudo`, `rdv_date_start`, `rdv_date_end`, `rdv_moment`, `rdv_jeu_id`, `confirmation_status`) VALUES
(181, 'Xenon', '2023-04-20 08:00:00', '2023-04-20 12:00:00', '', 1, 'En attente');

-- --------------------------------------------------------

--
-- Structure de la table `ifo_user`
--

CREATE TABLE `ifo_user` (
  `userID` int(11) NOT NULL,
  `userNom` varchar(80) NOT NULL,
  `userPrenom` varchar(80) NOT NULL,
  `userPseudo` varchar(100) NOT NULL,
  `userNiveauID` int(11) NOT NULL DEFAULT 2,
  `userEmail` varchar(80) NOT NULL,
  `userPass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ifo_user`
--

INSERT INTO `ifo_user` (`userID`, `userNom`, `userPrenom`, `userPseudo`, `userNiveauID`, `userEmail`, `userPass`) VALUES
(40, 'admin', 'admin', 'admin', 1, 'admin@gmail.com', '$2y$10$5jxlbaqc8o4f9d5l50J64OyNsd7/H9F6xGY6XazuO5KmIlbJx8DU6'),
(41, 'Luberlu', 'Patrick', 'Oai', 2, 'oaitothetop@gmail.com', '$2y$10$hQE9irPbPXKOBMJevUX2KuJNMwyqG.Y0ouaCYprxfc8OAY6LBU36a'),
(42, 'Lebleu', 'Stephanne', 'Shaiiko', 2, 'shaiikololo@gmail.com', '$2y$10$XyhM0lM6En7UtV8jYFxk7OtKMi.UIvcc8oJpSCdwp0dMmQaVyEwOi'),
(46, 'Levecq', 'Bertrand', 'Bidule', 2, 'bidule@gmail.com', '$2y$10$yJXQbiHLAmbUFFG9ZO0DO.ESYRKQYQ2dBV1z.ZUxeTusS7RQG7ONy'),
(49, 'Levecq', 'Jason', 'Xenon', 1, 'levecqjason@gmail.com', '$2y$10$h5ftz2UV6BFfuvFMoO6pjOaghUrVNgkZLuOPGnm5pfv2vQhTNMXdK'),
(52, 'Arthur', 'Arthur', 'Broly', 2, 'broly@gmail.com', '$2y$10$a1jGYgHz9F6YwURI0vQzleBKIreubvcy3WflSux72uIR/M.VlLa8u'),
(53, 'Levecq', 'Jason', 'ASCEFG', 2, 'test@gmail.com', '$2y$10$Td4cHRUAB.lOpar1fPUJLu67XuXWkxbL3zrKXdvJ.m7/GBGOcBT7W');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ifo_jeu`
--
ALTER TABLE `ifo_jeu`
  ADD PRIMARY KEY (`jeu_id`);

--
-- Index pour la table `ifo_niveau`
--
ALTER TABLE `ifo_niveau`
  ADD UNIQUE KEY `niveauID` (`niveauID`);

--
-- Index pour la table `ifo_profile`
--
ALTER TABLE `ifo_profile`
  ADD PRIMARY KEY (`profileID`),
  ADD KEY `fk_profile_userID` (`profileUserID`);

--
-- Index pour la table `ifo_rdv`
--
ALTER TABLE `ifo_rdv`
  ADD PRIMARY KEY (`rdv_id`),
  ADD KEY `fk_rdv_jeu_id` (`rdv_jeu_id`);

--
-- Index pour la table `ifo_user`
--
ALTER TABLE `ifo_user`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `test` (`userNiveauID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ifo_jeu`
--
ALTER TABLE `ifo_jeu`
  MODIFY `jeu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `ifo_profile`
--
ALTER TABLE `ifo_profile`
  MODIFY `profileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `ifo_rdv`
--
ALTER TABLE `ifo_rdv`
  MODIFY `rdv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT pour la table `ifo_user`
--
ALTER TABLE `ifo_user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ifo_profile`
--
ALTER TABLE `ifo_profile`
  ADD CONSTRAINT `fk_profile_userID` FOREIGN KEY (`profileUserID`) REFERENCES `ifo_user` (`userID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ifo_rdv`
--
ALTER TABLE `ifo_rdv`
  ADD CONSTRAINT `fk_rdv_jeu_id` FOREIGN KEY (`rdv_jeu_id`) REFERENCES `ifo_jeu` (`jeu_id`);

--
-- Contraintes pour la table `ifo_user`
--
ALTER TABLE `ifo_user`
  ADD CONSTRAINT `test` FOREIGN KEY (`userNiveauID`) REFERENCES `ifo_niveau` (`niveauID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
