-- phpMyAdmin SQL Dump
-- version 5.0.4deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql.info.unicaen.fr:3306
-- Généré le : lun. 28 nov. 2022 à 13:27
-- Version du serveur :  10.5.11-MariaDB-1
-- Version de PHP : 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `22005759_0`
--

-- --------------------------------------------------------

--
-- Structure de la table `ship`
--

CREATE TABLE `ship` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(700) DEFAULT NULL,
  `built` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ship`
--

INSERT INTO `ship` (`id`, `name`, `description`, `built`) VALUES
(1, 'HMS Victory', 'Le HMS Victory est un navire de ligne de premier rang britannique à trois-mâts voiles carrées. Il est principalement connu comme le vaisseau de l\'amiral Nelson lors de la bataille de Trafalgar (vaisseau amiral en second de l\'état-major de la Marine, commandant en chef de l\'amirauté). Il connut une succession de victoires à la tête de la flotte britannique entre 1778 et 1812.\r\n\r\nLancé en 1765 et désormais préservé en cale sèche, il est le plus ancien navire de guerre intact au monde.', 1765),
(2, 'Whydah Gally', 'Le Whydah Gally, parfois écrit Whidah ou Whidaw, était un navire qui servit au commerce triangulaire avant sa capture par le pirate Samuel « Black Sam » Bellamy. Le navire a coulé dans une tempête au large de cap Cod, le 26 avril 1717, noyant Bellamy ainsi que la quasi-totalité de l\'équipage. Lors de sa capture, le navire est commandé par Laurens Prins. ', 1716),
(3, 'Queen Anne\'s Revenge', 'Le Queen Anne\'s Revenge est le nom du plus célèbre des navires possédés par le pirate Barbe Noire. Il s\'agissait de l\'ex-frégate La Concorde de 300 tonneaux et 40 canons construit en 1710 dans le chantier naval de Rochefort et effectuant la traite négrière. Barbe-Noire s\'en est emparé le 28 novembre 1717. Il l\'a utilisé pour faire le blocus de Charleston en Caroline du Sud et il l\'a perdu en mai 1718 lors d\'un échouement, au large de Beaufort en Caroline du Nord. ', 1710),
(4, 'Hermione', 'L\'Hermione est une réplique du navire de guerre français L\'Hermione, un trois-mâts carré, en service de 1779 à 1793, reconstruite par l\'association Hermione-La Fayette dans l\'ancien Arsenal de Rochefort à partir de 1997 et lancée en eaux salées le 7 septembre 2014. ', 2012);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ship`
--
ALTER TABLE `ship`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ship`
--
ALTER TABLE `ship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
