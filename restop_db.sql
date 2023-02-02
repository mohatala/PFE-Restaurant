-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 08 sep. 2022 à 12:20
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `restop_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_list`
--

CREATE TABLE `admin_list` (
  `admin_id` int(11) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin_list`
--

INSERT INTO `admin_list` (`admin_id`, `fullname`, `username`, `password`, `status`, `date_created`) VALUES
(1, 'mohammed', 'admin', '0192023a7bbd73250516f069df18b500', 0, '2021-11-11 05:13:12'),
(4, 'medtechp', 'medtech', 'da2550f00907e1601628524200439e35', 0, '2022-05-16 11:14:59'),
(5, 'talaini', 'talaini', '9636d03c35be3827dcfee0f66cbb206f', 1, '2022-05-16 11:21:41'),
(6, 'morad', 'imad', 'b5c802a64a21c23e2006192fa1890bd3', 1, '2022-05-16 11:22:44'),
(8, 'mohammed', 'mohammed', 'd79cd06799863224b7324d969c1e2084', 0, '2022-08-10 11:50:46');

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE `adresses` (
  `id_adresse` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `adresse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `adresses`
--

INSERT INTO `adresses` (`id_adresse`, `id_client`, `adresse`) VALUES
(1, 4, 'mohammedia andalouss'),
(2, 5, 'azerty');

-- --------------------------------------------------------

--
-- Structure de la table `apropos`
--

CREATE TABLE `apropos` (
  `Id_apropos` int(11) NOT NULL,
  `Title` varchar(20) NOT NULL,
  `Description` text NOT NULL,
  `Img_apropos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `apropos`
--

INSERT INTO `apropos` (`Id_apropos`, `Title`, `Description`, `Img_apropos`) VALUES
(1, 'A propos de nous', 'Restop est un lieu dï¿½diï¿½ ï¿½ la nourriture saine et savoureuse. C est un espace de vie, de partage et de convivialitï¿½ qui met les bons produits au coeur de votre assiette. Chez nous les ingrï¿½dients sont issus de l agriculture biologique ou raisonnï¿½e. Nous les sï¿½lectionnons directement auprï¿½s de nos fournisseurs prï¿½fï¿½rï¿½s. Nous les cuisinons avec respect et les servons avec amour.', 'd.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `lib_categorie` varchar(20) NOT NULL,
  `id_plat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `lib_categorie`, `id_plat`) VALUES
(1, 'Specialites', 1);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `Id_client` int(11) NOT NULL,
  `Nom_client` varchar(20) NOT NULL,
  `Prenom_client` varchar(20) NOT NULL,
  `Email` text NOT NULL,
  `Tel` int(11) NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`Id_client`, `Nom_client`, `Prenom_client`, `Email`, `Tel`, `Password`) VALUES
(3, 'talaini', 'mohammed', 'admin@gmail.com', 640253256, 'ab4f63f9ac65152575886860dde480a1'),
(4, 'talaini', 'mohammed', 'talaini@gmail.com', 617066494, 'ab4f63f9ac65152575886860dde480a1'),
(5, 'imad', 'imad', 'imad@gmail.com', 123458, 'ab4f63f9ac65152575886860dde480a1');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_plat` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` double NOT NULL,
  `type_cmd` varchar(30) NOT NULL,
  `Note` text NOT NULL,
  `adresse` text NOT NULL,
  `Etat` varchar(30) NOT NULL,
  `Date_commande` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_client`, `id_plat`, `quantite`, `prix`, `type_cmd`, `Note`, `adresse`, `Etat`, `Date_commande`) VALUES
(3, 0, 0, 0, 0, '', '', '', '', NULL),
(4, 0, 0, 0, 0, '', '', '', '', NULL),
(5, 0, 0, 0, 0, '', '', '', '', NULL),
(6, 0, 0, 0, 0, '', '', '', '', NULL),
(7, 4, 4, 2, 200, 'livraison', 'zerz', '1', '', NULL),
(8, 4, 3, 2, 200, 'livraison', '^pl^p', '1', '', NULL),
(8, 4, 6, 2, 200, 'livraison', '^pl^p', '1', '', NULL),
(8, 4, 3, 3, 300, 'livraison', '^pl^p', '1', '', NULL),
(8, 4, 4, 2, 200, 'livraison', '^pl^p', '1', '', NULL),
(9, 4, 3, 2, 200, 'livraison', 'azert', 'mohammedia andalouss', '', NULL),
(9, 4, 6, 2, 200, 'livraison', 'azert', 'mohammedia andalouss', '', NULL),
(9, 4, 3, 3, 300, 'livraison', 'azert', 'mohammedia andalouss', '', NULL),
(9, 4, 4, 2, 200, 'livraison', 'azert', 'mohammedia andalouss', '', NULL),
(10, 4, 3, 2, 200, 'livraison', 'azerrf', 'mohammedia andalouss', 'Enregistrer', NULL),
(10, 4, 6, 2, 200, 'livraison', 'azerrf', 'mohammedia andalouss', 'Enregistrer', NULL),
(10, 4, 3, 3, 300, 'livraison', 'azerrf', 'mohammedia andalouss', 'Enregistrer', NULL),
(10, 4, 4, 2, 200, 'livraison', 'azerrf', 'mohammedia andalouss', 'Enregistrer', NULL),
(11, 4, 2, 1, 100, 'livraison', 'dssdf', 'mohammedia andalouss', 'En Cours Preparation', NULL),
(11, 4, 1, 1, 150, 'livraison', 'dssdf', 'mohammedia andalouss', 'En Cours Preparation', NULL),
(12, 4, 1, 1, 150, 'livraison', 'azerty', 'mohammedia andalouss', 'En Cours Livraison', '2022-06-05'),
(12, 4, 2, 1, 100, 'livraison', 'azerty', 'mohammedia andalouss', 'En Cours Livraison', '2022-06-05'),
(13, 4, 3, 2, 200, 'livraison', 'azerty', 'mohammedia andalouss', 'Enregistrer', '2022-06-07'),
(13, 4, 4, 1, 100, 'livraison', 'azerty', 'mohammedia andalouss', 'Enregistrer', '2022-06-07'),
(13, 4, 5, 1, 100, 'livraison', 'azerty', 'mohammedia andalouss', 'Enregistrer', '2022-06-07'),
(14, 4, 6, 1, 100, 'livraison', 'azerty', 'mohammedia andalouss', 'Enregistrer', '2022-08-10'),
(14, 4, 4, 1, 100, 'livraison', 'azerty', 'mohammedia andalouss', 'Enregistrer', '2022-08-10'),
(15, 4, 3, 2, 200, 'livraison', 'zerty', 'mohammedia andalouss', 'Enregistrer', '2022-09-02'),
(15, 4, 7, 1, 120, 'livraison', 'zerty', 'mohammedia andalouss', 'Enregistrer', '2022-09-02'),
(16, 4, 4, 1, 100, 'livraison', 'azerty', 'mohammedia andalouss', 'Enregistrer', '2022-09-02'),
(16, 4, 5, 1, 100, 'livraison', 'azerty', 'mohammedia andalouss', 'Enregistrer', '2022-09-02'),
(17, 4, 1, 1, 150, 'livraison', 'azerty', 'mohammedia andalouss', 'Enregistrer', '2022-09-02'),
(17, 4, 2, 1, 100, 'livraison', 'azerty', 'mohammedia andalouss', 'Enregistrer', '2022-09-02'),
(17, 4, 3, 1, 100, 'livraison', 'azerty', 'mohammedia andalouss', 'Enregistrer', '2022-09-02'),
(18, 4, 2, 1, 100, 'livraison', 'azerty', 'mohammedia andalouss', 'Confirmer', '2022-09-02'),
(18, 4, 3, 1, 100, 'livraison', 'azerty', 'mohammedia andalouss', 'Confirmer', '2022-09-02'),
(19, 5, 3, 1, 100, 'livraison', 'azerty', 'azerty', 'Enregistrer', '2022-09-03'),
(19, 5, 2, 2, 200, 'livraison', 'azerty', 'azerty', 'Enregistrer', '2022-09-03'),
(19, 5, 4, 2, 200, 'livraison', 'azerty', 'azerty', 'Enregistrer', '2022-09-03');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `Id_contact` int(11) NOT NULL,
  `Phone_contact` varchar(20) NOT NULL,
  `Email_contact` varchar(50) NOT NULL,
  `Adresse` text NOT NULL,
  `Adresse_map` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`Id_contact`, `Phone_contact`, `Email_contact`, `Adresse`, `Adresse_map`) VALUES
(1, '0617554823', 'Restop@gmail.com', 'Casablanca ain sbaa ', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3322.8373191732626!2d-7.541548311699466!3d33.60922141129859!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7cc8a3fe5d34d%3A0xf2c3f24d8e67353c!2sEcole%20IBEGIS!5e0!3m2!1sfr!2sma!4v1655375398672!5m2!1sfr!2sma\"');

-- --------------------------------------------------------

--
-- Structure de la table `emails`
--

CREATE TABLE `emails` (
  `id_email` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `msg` text NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `emails`
--

INSERT INTO `emails` (`id_email`, `nom`, `email`, `msg`, `statut`) VALUES
(4, 'med', 'anas.talaini1991@gmail.com', 'zertyuiopù*', 1);

-- --------------------------------------------------------

--
-- Structure de la table `expert`
--

CREATE TABLE `expert` (
  `Id_expert` int(11) NOT NULL,
  `Nom_expert` varchar(20) NOT NULL,
  `Specialite_expert` varchar(20) NOT NULL,
  `Img_expert` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `expert`
--

INSERT INTO `expert` (`Id_expert`, `Nom_expert`, `Specialite_expert`, `Img_expert`) VALUES
(1, 'chef1', 'Cuisine', 'chef1.jpg'),
(2, 'Mohammed Zai', 'Cuisine', 'chef2.webp'),
(3, 'Fouad Zorgui', 'Cuisine', 'chef3.webp'),
(4, 'Mounir Rochdi', 'Cuisine', 'chef4.webp');

-- --------------------------------------------------------

--
-- Structure de la table `menu_du_jour`
--

CREATE TABLE `menu_du_jour` (
  `id_mj` int(11) NOT NULL,
  `id_plat` int(11) NOT NULL,
  `date_mj` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `menu_du_jour`
--

INSERT INTO `menu_du_jour` (`id_mj`, `id_plat`, `date_mj`) VALUES
(1, 1, '2022-05-22'),
(2, 2, '2022-05-22'),
(4, 4, '2022-05-22'),
(5, 5, '2022-05-23'),
(6, 6, '2022-05-23'),
(7, 2, '2022-05-23'),
(8, 4, '2022-05-23'),
(9, 1, '2022-07-23'),
(10, 3, '2022-07-23'),
(11, 4, '2022-07-23'),
(12, 5, '2022-07-24'),
(13, 1, '2022-09-06'),
(14, 4, '2022-09-06'),
(15, 6, '2022-09-06');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `total_views` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pages`
--

INSERT INTO `pages` (`id`, `total_views`) VALUES
(1, 101);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id_panier` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_plat` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id_panier`, `id_client`, `id_plat`, `quantite`) VALUES
(73, 0, 3, 2),
(84, 3, 1, 5),
(85, 3, 3, 2),
(86, 3, 2, 3),
(96, 0, 1, 1),
(109, 0, 1, 1),
(110, 0, 4, 1),
(111, 4, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `plat`
--

CREATE TABLE `plat` (
  `id_plat` int(11) NOT NULL,
  `intitule_plat` varchar(30) NOT NULL,
  `description_plat` text NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `prix_plat` double NOT NULL,
  `image_plat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `plat`
--

INSERT INTO `plat` (`id_plat`, `intitule_plat`, `description_plat`, `id_categorie`, `prix_plat`, `image_plat`) VALUES
(1, 'Special entree froide', 'Special entree froide1', 1, 150, 'tacos.jpg'),
(2, 'Special entree chaude', 'Special entree chaude', 0, 100, 'soupe.jpg'),
(3, 'Special pizza', 'Special pizza', 0, 100, 'c3.jpg'),
(4, 'Special plats marocaine', 'Special plats marocaine', 0, 100, 'couscous.jpg'),
(5, 'Special plats marocaine', 'Special plats marocaine', 0, 100, 'couscous.jpg'),
(6, 'Special plats marocaine', 'Special plats marocaine', 0, 100, 'couscous.jpg'),
(7, 'Special plats marocaine', 'Special plats marocaine\r\n', 1, 120, 'couscous.jpg'),
(8, 'Special pizza', 'Special pizza\r\n', 1, 100, 'c3.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `reservation_list`
--

CREATE TABLE `reservation_list` (
  `reservation_id` int(11) NOT NULL,
  `customer_name` text NOT NULL,
  `contact` text NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `table_id` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_client` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation_list`
--

INSERT INTO `reservation_list` (`reservation_id`, `customer_name`, `contact`, `email`, `address`, `table_id`, `datetime`, `status`, `date_created`, `id_client`) VALUES
(2, 'George Wilson', '0987854654', 'gwilson@sample.com', 'Sample Address 102', 5, '2021-11-23 15:00:00', 1, '2021-11-12 04:37:06', 0),
(3, 'mohammed', '0617066464', 'talainimohammed@gmail.com', 'azerty', 2, '2022-05-15 17:26:00', 1, '2022-05-15 17:23:30', 0),
(4, 'mohammed', '0617066464', 'talainimohammed95@gmail.com', 'azertyu', 2, '2022-05-16 21:09:00', 1, '2022-05-15 18:09:50', 0),
(6, 'mohammed talaini', '0617066464', 'talainimohammed@gmail.com', 'azertyu', 2, '2022-05-24 22:15:00', 2, '2022-05-15 18:15:42', 0),
(7, 'anas', '0458532586', 'azeaze@gmail.dfo', 'azerty', 8, '2022-05-18 13:07:00', 1, '2022-05-16 11:07:25', 0),
(8, 'mohammed', '0617066464', 'talainimohammed95@gmail.com', 'ertyu', 9, '2022-05-18 15:52:00', 1, '2022-05-16 11:52:35', 0),
(10, 'mohammed talaini', '061706646454654', 'azeaze@gmail.dfo', 'AZERTYU', 9, '2022-05-18 18:14:00', 1, '2022-05-16 12:14:58', 0),
(11, 'mohammed talaini', '061706646454654', 'azeaze@gmail.dfo', 'AZERTYU', 9, '2022-05-18 17:14:00', 0, '2022-05-16 12:15:08', 0),
(12, 'mohammed', '0617066464', 'talainimohammed95@gmail.com', 'azerezqm', 9, '0000-00-00 00:00:00', 1, '2022-05-18 11:29:43', 0),
(13, 'mohammed', '0617066494', 'talainimohammed95@gmail.com', 'azerty', 12, '2022-07-25 11:37:00', 0, '2022-07-24 09:37:14', 0),
(14, 'mohammed', '0617066494', 'anas.talaini1991@gmail.com', 'azerty', 10, '2022-07-25 10:17:00', 1, '2022-07-24 10:17:33', 4),
(15, 'mohammed', '0617066494', 'talainimohammed95@gmail.com', 'azertyui', 15, '2022-07-28 16:25:00', 0, '2022-07-26 10:20:00', 4),
(16, 'med', '147852', 'talaini@gmail.com', 'azertyu', 18, '0000-00-00 00:00:00', 0, '2022-09-04 11:09:12', 5),
(17, 'med', '147852', 'talaini@gmail.com', 'azerty', 17, '2022-09-04 11:09:00', 0, '2022-09-04 11:09:42', 5);

-- --------------------------------------------------------

--
-- Structure de la table `table_list`
--

CREATE TABLE `table_list` (
  `table_id` int(11) NOT NULL,
  `tbl_no` varchar(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `coordinates` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `table_list`
--

INSERT INTO `table_list` (`table_id`, `tbl_no`, `name`, `description`, `coordinates`, `status`, `date_created`, `type`) VALUES
(15, '7', 'Salle 1', 'Ideal for party', '0.7251991496119464, 0.4289423076923077, 0.9765374862324224, 0.9274038461538462', 1, '2022-07-26 09:54:53', 0),
(16, 's2', 'Salle 2', 'perfect', '0.31377270049435213, 0.7427884615384616, 0.6867780026126381, 0.9520192307692308', 1, '2022-07-26 09:59:00', 0),
(17, '1', 'Table 1', 'pour 6 Personne', '0.16676299696023753, 0.3172413617715068, 0.25057802586197164, 0.4235632008519666', 1, '2022-09-01 10:31:27', 1),
(18, '2', 'Table 2', 'Pour 2 Personne', '0.09739883511052655, 0.4982758445301275, 0.12919074262497743, 0.5816091778634609', 1, '2022-09-01 10:31:58', 1);

-- --------------------------------------------------------

--
-- Structure de la table `temoignage`
--

CREATE TABLE `temoignage` (
  `Id_temoignage` int(11) NOT NULL,
  `Id_client` int(11) NOT NULL,
  `Avis` text NOT NULL,
  `Affichernom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `temoignage`
--

INSERT INTO `temoignage` (`Id_temoignage`, `Id_client`, `Avis`, `Affichernom`) VALUES
(1, 4, 'Super Resto ! Bel endroit, cuisine délicieuse et bio, équipe souriante et service au top ! Je le recommande !', 1),
(2, 3, 'Restaurant de haut qualité avec des prix raisonnable, un personnel de haut niveau. Bonne continuation.', 0),
(3, 4, 'Super Resto ! Bel endroit, cuisine délicieuse et bio, équipe souriante et service au top ! Je le recommande !', 1),
(4, 3, 'Restaurant de haut qualité avec des prix raisonnable, un personnel de haut niveau. Bonne continuation.', 0),
(5, 3, 'Restaurant de haut qualité avec des prix raisonnable, un personnel de haut niveau. Bonne continuation.', 1),
(6, 3, 'Restaurant de haut qualité avec des prix raisonnable, un personnel de haut niveau. Bonne continuation.', 0),
(7, 3, 'Restaurant de haut qualité avec des prix raisonnable, un personnel de haut niveau. Bonne continuation.', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin_list`
--
ALTER TABLE `admin_list`
  ADD PRIMARY KEY (`admin_id`);

--
-- Index pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id_adresse`);

--
-- Index pour la table `apropos`
--
ALTER TABLE `apropos`
  ADD PRIMARY KEY (`Id_apropos`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`Id_client`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`Id_contact`);

--
-- Index pour la table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id_email`);

--
-- Index pour la table `expert`
--
ALTER TABLE `expert`
  ADD PRIMARY KEY (`Id_expert`);

--
-- Index pour la table `menu_du_jour`
--
ALTER TABLE `menu_du_jour`
  ADD PRIMARY KEY (`id_mj`);

--
-- Index pour la table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_panier`);

--
-- Index pour la table `plat`
--
ALTER TABLE `plat`
  ADD PRIMARY KEY (`id_plat`);

--
-- Index pour la table `reservation_list`
--
ALTER TABLE `reservation_list`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Index pour la table `table_list`
--
ALTER TABLE `table_list`
  ADD PRIMARY KEY (`table_id`);

--
-- Index pour la table `temoignage`
--
ALTER TABLE `temoignage`
  ADD PRIMARY KEY (`Id_temoignage`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin_list`
--
ALTER TABLE `admin_list`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `id_adresse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `apropos`
--
ALTER TABLE `apropos`
  MODIFY `Id_apropos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `Id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `Id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `emails`
--
ALTER TABLE `emails`
  MODIFY `id_email` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `expert`
--
ALTER TABLE `expert`
  MODIFY `Id_expert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `menu_du_jour`
--
ALTER TABLE `menu_du_jour`
  MODIFY `id_mj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id_panier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT pour la table `plat`
--
ALTER TABLE `plat`
  MODIFY `id_plat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `reservation_list`
--
ALTER TABLE `reservation_list`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `table_list`
--
ALTER TABLE `table_list`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `temoignage`
--
ALTER TABLE `temoignage`
  MODIFY `Id_temoignage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
