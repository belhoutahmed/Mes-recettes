-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 20 jan. 2023 à 08:11
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tdw`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `hash_pwd` varchar(1024) NOT NULL,
  `token` varchar(1024) DEFAULT NULL,
  `sexe` varchar(1) NOT NULL,
  `date_naissance` date NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `name`, `email`, `hash_pwd`, `token`, `sexe`, `date_naissance`) VALUES
(1, 'Admin', 'Admin@esi.dz', 'Admin', NULL, 'M', '2000-11-13');

-- --------------------------------------------------------

--
-- Structure de la table `apartenir_saison`
--

DROP TABLE IF EXISTS `apartenir_saison`;
CREATE TABLE IF NOT EXISTS `apartenir_saison` (
  `id_ingredient` int(11) NOT NULL,
  `id_saison` int(11) NOT NULL,
  PRIMARY KEY (`id_ingredient`,`id_saison`),
  KEY `id_saison` (`id_saison`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `apartenir_saison`
--

INSERT INTO `apartenir_saison` (`id_ingredient`, `id_saison`) VALUES
(1, 1),
(2, 2),
(4, 3),
(5, 1),
(6, 1),
(6, 2),
(10, 4),
(11, 2),
(12, 4),
(13, 3),
(15, 3),
(19, 4),
(20, 1),
(21, 3),
(22, 3),
(23, 3),
(26, 2),
(28, 2),
(29, 1),
(30, 3),
(31, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `lien` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `name`, `lien`, `description`) VALUES
(1, 'Entrées', 'lien', 'Entrées'),
(2, 'Plats', 'lien', 'Plats'),
(3, 'Desserts', 'lien', 'Desserts'),
(4, 'Boissons', 'lien', 'Boissons');

-- --------------------------------------------------------

--
-- Structure de la table `contenir_ingredient`
--

DROP TABLE IF EXISTS `contenir_ingredient`;
CREATE TABLE IF NOT EXISTS `contenir_ingredient` (
  `id_recette` int(11) NOT NULL,
  `id_ingredient` int(11) NOT NULL,
  `quantite` float(5,1) NOT NULL,
  `unite` varchar(20) DEFAULT NULL,
  `quantite en unite` float(5,1) DEFAULT NULL,
  PRIMARY KEY (`id_recette`,`id_ingredient`),
  KEY `id_ingredient` (`id_ingredient`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contenir_ingredient`
--

INSERT INTO `contenir_ingredient` (`id_recette`, `id_ingredient`, `quantite`, `unite`, `quantite en unite`) VALUES
(1, 25, 250.0, NULL, NULL),
(1, 5, 2.0, 'u', 70.0),
(1, 33, 70.0, NULL, NULL),
(1, 19, 5.0, 'cl', 10.0),
(1, 31, 20.0, NULL, NULL),
(1, 29, 1.0, 'cuillères à soupe', 10.0),
(1, 1, 3.0, 'u', 150.0),
(1, 21, 100.0, NULL, NULL),
(1, 4, 2.0, 'u', 150.0),
(1, 32, 2.0, 'cuillères à soupe', 10.0),
(1, 28, 0.5, 'cuillère à café', 5.0),
(1, 17, 0.5, 'cuillère à café', 5.0),
(1, 34, 150.0, 'cl', 10.0),
(2, 20, 3.0, 'u', 140.0),
(2, 1, 2.0, 'u', 150.0),
(2, 6, 2.0, 'u', 6.0),
(2, 31, 20.0, NULL, NULL),
(2, 27, 2.0, 'u', 60.0),
(2, 17, 0.5, 'cuillère à café', 5.0),
(2, 28, 0.5, 'cuillère à café', 5.0),
(3, 16, 250.0, NULL, NULL),
(3, 36, 0.5, 'cuillère à café', 5.0),
(3, 34, 25.0, 'cl', 10.0),
(3, 35, 80.0, NULL, NULL),
(3, 7, 150.0, NULL, NULL),
(3, 17, 0.5, 'cuillère à café', 5.0),
(3, 18, 80.0, NULL, NULL),
(4, 13, 2.0, 'u', 200.0),
(4, 8, 20.0, 'cl', 10.0),
(4, 34, 20.0, 'cl', 10.0),
(5, 24, 100.0, NULL, NULL),
(5, 18, 1.0, 'cuillère à café', 5.0),
(5, 5, 1.0, 'u', 70.0),
(5, 1, 2.0, 'u', 150.0),
(5, 21, 50.0, NULL, NULL),
(5, 25, 250.0, NULL, NULL),
(5, 35, 2.0, 'cuillères à soupe', 10.0),
(5, 4, 1.0, 'u', 150.0),
(5, 2, 1.0, 'u', 200.0),
(5, 31, 20.0, NULL, NULL),
(5, 22, 50.0, NULL, NULL),
(5, 32, 1.0, 'cuillères à soupe', 10.0),
(5, 29, 1.0, 'cuillères à soupe', 10.0),
(5, 17, 1.0, 'cuillère à café', 5.0),
(6, 20, 6.0, 'u', 140.0),
(6, 1, 3.0, 'u', 150.0),
(6, 27, 1.0, 'u', 60.0),
(6, 6, 5.0, 'u', 6.0),
(6, 35, 3.0, 'cuillères à soupe', 10.0),
(6, 17, 0.5, 'cuillère à café', 5.0),
(6, 28, 0.5, 'cuillère à café', 5.0),
(7, 16, 100.0, NULL, NULL),
(7, 5, 1.0, 'u', 70.0),
(7, 2, 1.0, 'u', 200.0),
(7, 21, 50.0, NULL, NULL),
(7, 4, 0.5, 'u', 150.0),
(7, 32, 1.0, 'cuillère à café', 5.0),
(7, 28, 0.5, 'cuillère à café', 5.0),
(7, 31, 20.0, NULL, NULL),
(7, 25, 150.0, NULL, NULL),
(7, 1, 1.0, 'u', 150.0),
(7, 6, 1.0, 'u', 6.0),
(7, 19, 0.5, 'cuillère à café', 5.0),
(7, 18, 1.0, 'cuillères à soupe', 10.0),
(7, 29, 1.0, 'cuillère à café', 5.0),
(7, 17, 0.5, 'cuillère à café', 5.0),
(8, 16, 800.0, NULL, NULL),
(8, 17, 2.0, 'cuillère à café', 5.0),
(8, 35, 30.0, 'cl', 10.0),
(8, 34, 50.0, 'cl', 10.0),
(9, 34, 50.0, 'cl', 10.0),
(9, 7, 100.0, NULL, NULL),
(9, 36, 10.0, NULL, NULL),
(9, 16, 200.0, NULL, NULL),
(9, 3, 10.0, NULL, NULL),
(9, 17, 5.0, NULL, NULL),
(9, 19, 50.0, 'cl', 10.0),
(10, 2, 500.0, NULL, NULL),
(10, 4, 0.5, 'u', 150.0),
(10, 20, 2.0, 'u', 140.0),
(10, 6, 5.0, 'u', 6.0),
(10, 35, 2.0, 'cuillères à soupe', 10.0),
(10, 27, 1.0, 'u', 60.0),
(10, 17, 0.5, 'cuillère à café', 5.0),
(10, 28, 0.5, 'cuillère à café', 5.0),
(11, 7, 125.0, NULL, NULL),
(11, 17, 0.5, 'cuillère à café', 5.0),
(11, 27, 3.0, 'u', 60.0),
(11, 18, 50.0, NULL, NULL),
(12, 1, 3.0, 'u', 140.0),
(12, 19, 3.0, 'cuillères à soupe', 10.0),
(12, 17, 0.5, 'cuillère à café', 5.0),
(12, 4, 1.0, 'u', 150.0),
(12, 31, 20.0, NULL, NULL),
(13, 12, 14.0, 'u', 150.0),
(13, 34, 50.0, 'cl', 10.0),
(14, 34, 25.0, 'cl', 10.0),
(14, 14, 0.5, 'u', 150.0),
(15, 12, 1.0, 'u', 150.0),
(15, 15, 1.0, 'u', 150.0),
(15, 9, 1.0, 'u', 150.0),
(16, 11, 300.0, NULL, NULL),
(16, 14, 0.5, 'u', 150.0),
(16, 3, 100.0, NULL, NULL),
(16, 34, 100.0, 'cl', 10.0),
(17, 7, 250.0, NULL, NULL),
(17, 27, 60.0, 'u', 60.0),
(17, 8, 50.0, 'cl', 10.0),
(17, 3, 50.0, NULL, NULL),
(17, 17, 0.5, 'cuillère à café', 5.0),
(18, 27, 6.0, 'u', 60.0),
(18, 11, 150.0, NULL, NULL),
(18, 14, 1.0, 'u', 140.0),
(18, 3, 250.0, NULL, NULL),
(18, 2, 50.0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `diaporama`
--

DROP TABLE IF EXISTS `diaporama`;
CREATE TABLE IF NOT EXISTS `diaporama` (
  `id_diaporama` int(11) NOT NULL AUTO_INCREMENT,
  `id_news` int(11) DEFAULT NULL,
  `id_recette` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_diaporama`),
  KEY `id_news` (`id_news`),
  KEY `id_recette` (`id_recette`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `diaporama`
--

INSERT INTO `diaporama` (`id_diaporama`, `id_news`, `id_recette`) VALUES
(20, 2, NULL),
(13, NULL, 9),
(23, NULL, 1),
(17, 1, NULL),
(22, NULL, 8);

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

DROP TABLE IF EXISTS `etape`;
CREATE TABLE IF NOT EXISTS `etape` (
  `id_etape` int(11) NOT NULL AUTO_INCREMENT,
  `id_recette` int(11) NOT NULL,
  `nemero` int(3) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id_etape`,`id_recette`),
  KEY `id_recette` (`id_recette`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etape`
--

INSERT INTO `etape` (`id_etape`, `id_recette`, `nemero`, `description`) VALUES
(1, 1, 1, 'La veille, mettre les pois chiches à tremper dans un grand volume d\'eau. Le jour de la recette, les égoutter et réserver.'),
(2, 1, 2, 'Epluchez les légumes et coupez-les en dés grossiers.'),
(3, 1, 3, 'Coupez la viande en petits morceaux. Dans une grande cocotte, faites chauffer l\'huile d\'olive et faites caraméliser la viande 2 minutes de chaque côté.'),
(4, 1, 4, 'Parallèlement, pelez et émincez l\'oignon, râpez les tomates.'),
(5, 1, 5, 'Ajoutez les légumes, les tomates et l\'oignon à la viande puis laissez revenir 5 minutes.'),
(6, 1, 6, 'Ajoutez toutes les épices, salez et poivrez.'),
(7, 1, 7, 'Ciselez la coriandre et versez la moitié dans la cocotte avec les légumes et la viande. Réservez le reste pour la décoration.'),
(8, 1, 8, 'Ajoutez 1,5 litre d\'eau dans la cocotte et faites mijoter votre chorba algérienne à feu fort durant 20 minutes.'),
(9, 1, 9, 'Ajoutez le concentré de tomates, les vermicelles et les pois chiches et rectifiez l\'assaisonnement.'),
(10, 1, 10, 'Poursuivre la cuisson durant 10 minutes à couvert.'),
(11, 1, 11, 'Servez aussitôt votre chorba algérienne en décorant d\'un peu de coriandre fraîche'),
(12, 2, 1, 'Préchauffez le four à 200°C (Th. 6/7).'),
(13, 2, 2, 'Emincez les gousses d’ail. Réservez.'),
(14, 2, 3, 'Ciselez le coriandre fraîche.'),
(15, 2, 4, 'Lavez les poivrons, et déposez-les directement sur une grille allant au four. Enfournez pendant 25 à 30 minutes environ. Les poivrons doivent légèrement noircir sur toutes les faces.'),
(16, 2, 5, 'Dès que la peau commence à former des cloques, sortez-les du four, déposez-les dans un saladier, couvrez d’un film alimentaire et laissez reposer 15 minutes pour qu’ils refroidissent.'),
(17, 2, 6, 'Déposez alors les poivrons sur une planche à découper et retirez la peau. Coupez les poivrons en deux, enlevez les pépins puis taillez en julienne (petits dés).'),
(18, 2, 7, 'Faites bouillir une casserole d’eau et plongez les tomates une minute dedans. Egouttez-les, retirez la peau puis coupez-les en julienne.'),
(19, 2, 8, 'Chauffez une poêle avec un peu d’huile d’olive et faites revenir l’ail quelques minutes avant d’ajouter les tomates, puis les poivrons. Poursuivez la cuisson pendant 5 minutes.'),
(20, 2, 9, 'assaisonnez avec le sel et le poivre et laissez cuire jusqu’à ce que les poivrons deviennent fondants'),
(21, 2, 10, 'Cassez les œufs dans la poêle et faites cuire comme des œufs au plat par dessus la garniture.'),
(22, 2, 11, 'Saupoudrez de persil avant de servir bien chaud.'),
(23, 3, 1, 'Pour réaliser la recette du msemen algerien, prenez tout d\'abord un grand saladier dans lequel vous allez mélanger la semoule fine, la farine, la levure et le sel.'),
(24, 3, 2, 'Faite tiédir l\'eau et incorporez-la au mélange petit à petit pour avoir une pâte homogène et sans grumeau !'),
(25, 3, 3, 'Pétrissez la pâte du msemen algerien, je vous conseille d\'utiliser la fonction pétrissage de votre robot ménager car il faut pétrir environ 15 minutes. Si vous n\'en avez pas.'),
(26, 3, 4, 'Une fois que vous avez une pâte bien élastique, faites de petites boules que vous allez aplatir sur une surface non adhérente ou graissée. Affinez votre pâte petit à petit à la main ou au rouleau.'),
(27, 3, 5, 'Prenez un pinceau en silicone pour ne pas qu\'il perde ses poils et qu\'ils se mélangent à la pâte, trempez-le dans l\'huile et badigeonnez la pâte, puis versez de semoule fine en pluie.'),
(28, 3, 6, 'Faite chauffer votre poêle non adhérente ou crêpière, et faites cuire vos msemen algeriens 1 minute de chaque côté jusqu\'à obtenir une belle coloration.'),
(29, 3, 7, 'Les msemen algeriens peuvent se déguster sucrés ou salés avec de la confiture par exemple, ou une sauce salée !'),
(30, 3, 8, 'Cette recetteque vous ferez assez facilement avec l\'habitude, accompagnera toute la période du Ramadan ! Régalez-vous et régalez vos convives ! '),
(31, 4, 1, 'presse les deux aranges.'),
(32, 4, 2, 'Versez le jus d\'orange et le lait dans une bouteille vide.'),
(33, 4, 3, 'Ajoutez le l\'eau et secouez légèrement.'),
(34, 5, 1, 'Dans une marmite, mettez l’huile et le smen à chauffer, faites revenir les morceaux de viandes et de poulets. Ajoutez l\'oignon haché et laissez revenir 5 min à petit. Incorporez les épices .'),
(35, 5, 2, 'mélangez bien le tout. Incorporez l\'orge égoutté et mélangez. Laissez l\'orge s’imprégner de toutes les saveurs pendant 10 min. tout en mélangeant.'),
(36, 5, 3, 'Ajoutez ensuite le concentré de tomate,la coriandre. Faites bien revenir à feu moyeu, puis mouillez de 2 à 3 litres d’eau. Ajoutez les lentilles et les pois chiches. Portez à ébullition..'),
(37, 5, 4, 'Entre temps, épluchez la pomme de terre, et grattez la carotte . Dès l’ébullition, ajoutez ces légumes entiers et le piment dans la marmite, et laissez cuire, à feu modéré pendant 40 min environ.'),
(38, 5, 5, 'Ensuite passer au mixeur (la carotte, la pomme de terre et les tomates coupées en dés).'),
(39, 5, 6, 'Remettez la purée de légume dans la marmite, mélangez, et ajoutez l’eau ci nécessaire. À part, délayez le levain dans un bol d\'eau froide, ajoutez le vinaigre.'),
(40, 5, 7, ' À la fin de la cuisson saupoudrez du reste de carvi et de coriandre ciselée finement. Servez avec de jus de citron.'),
(41, 6, 1, 'Grillez les poivrons, mettez-les dans un sac en plastique. Laissez refroidir.'),
(42, 6, 2, 'Ôtez les poivron après refroidissement et découpez-les en petits morceaux.'),
(43, 6, 3, 'Épluchez les gousses d\'ails et coupez-les en gros dés.'),
(44, 6, 4, 'Enlevez la peau des tomates et découpez-les en petits morceaux.'),
(45, 6, 5, 'Dans une petite cocote, mettez l\'huile et les tomates, faites revenir jusqu\'à ce que les tomates fondent.'),
(46, 6, 6, 'Ajoutez l\'ail, la feuille de sel et poivre. Mélangez le tout puis continuez la cuisson 15 minutes.'),
(47, 6, 7, 'Ajoutez les dés de poivrons. Laissez mijoter 15 minutes à feu doux jusqu\'à ce que les poivrons deviennent légèrement fondant.'),
(48, 6, 8, 'Cassez l’œuf dans un petit bol. Ajoutez un pincée de sel. Mélangez à l\'aide d\'une fourchette.'),
(49, 6, 9, 'Versez ce mélange au dessus de la chekchouka cuite et laissez mijoter quelques minutes.'),
(50, 6, 10, 'Servez la chekchouka chaude, tiède ou froide, selon votre gout avec du pain Algérien, Matloua, ftira, kasra.'),
(51, 7, 1, 'Coupez votre morceau d’agneau en morceaux. Faites chauffer l’huile d’olive avec le petit morceau de smen dans une marmite.'),
(52, 7, 2, 'Ajoutez l’agneau, l’oignon et l’ail et laissez cuire jusqu’à ce que la viande change de couleur, sans dorer.'),
(53, 7, 3, 'Ajoutez la tomate mixée ainsi que l’ensemble des épices, le persil, la coriandre, le concentré de tomate, et laissez revenir pendant 5 min.'),
(54, 7, 4, 'Versez vos 500 ml d’eau, ajoutez le demi-navet coupé en quart, les pois chiches et le morceau de citrouille avec sa peau. Couvrez et laissez cuire 30 minutes environ.'),
(55, 7, 5, 'Pendant ce temps, coupez votre carotte et votre courgette en morceaux, dans le sens de la longueur. Faites des quarts de pomme de terre.'),
(56, 7, 6, 'Ajoutez ces légumes à la marmite. Couvrez et laissez cuire 30 minutes à feu moyen.'),
(57, 7, 7, 'Dans les dernières minutes de cuisson de votre couscous, préparez la semoule : faites chauffer 1 min au micro-ondes 130 ml d’eau avec un peu de sel et d’huile d’olive. '),
(58, 7, 8, ' Versez dans votre semoule dans l’eau chaude et réservez 5 min. Égrenez votre semoule à l’aide d’une fourchette et faites-la à nouveau chauffer au micro-ondes 1 min.'),
(59, 8, 1, 'Dans un plat creux mélangez la semoule et le sel, base de la kesra algérienne.'),
(60, 8, 2, 'Versez l\'huile dessus et frottez avec les mains pour sabler le mélange.'),
(61, 8, 3, 'Ajoutez l\'eau légèrement tiède au fur et à mesure et pétrissez la pâte environ 15 minutes jusqu\'à obtention d\'une texture bien lisse, ni trop ferme, ni trop molle.'),
(62, 8, 4, 'Détaillez-la ensuite en 2 à 4 boules selon la taille de votre appareil de cuisson. Comptez 2 grandes galettes kesra algériennes de 28 à 30 cm de diamètres.'),
(63, 8, 5, 'Chauffez à sec un tajine spécial kesra, une tôle en fonte ou une grande poêle antiadhésive.'),
(64, 8, 6, 'Abaissez les boules de pâte sur un plan de travail propre que vous pouvez également fariner. '),
(65, 8, 7, 'Aplatissez bien au rouleau à pâtisserie pour former de belles galettes bien rondes sur une hauteur de 0,5 cm environ.'),
(66, 8, 8, 'Piquez la surface des galettes avec une fourchette.'),
(67, 8, 9, 'Faites cuire la kesra algérienne d\'abord sur une face en la tournant sur elle-même pour la faire dorer uniformément sans la faire brûler.'),
(68, 8, 10, 'Servez chaudes, tièdes ou froides avec du miel, un café ou bien pour accompagner un plat en sauce ou remplacer le pain.'),
(69, 9, 1, 'Dans un mixer, verser l’eau, puis la semoule, la farine, le sucre, la levure fraîche, la levure chimique et enfin le sel.'),
(70, 9, 2, ' Mixez pendant 5 minutes pour obtenir une pâte bien lisse.'),
(71, 9, 3, 'Faites chauffer une poêle à feu moyen, et comme pour une crêpe, versez une louche de beghrir.'),
(72, 9, 4, 'Attendez que les trous se forment, et ne retournez surtout pas le beghrir : la cuisson ne se fait que sur un côté.'),
(73, 9, 5, 'Cuisez les crêpes mille trous les unes après les autres, en les déposant sur un torchon propre.'),
(74, 9, 6, 'Et maintenant, vous pouvez dégustez vos délicieux beghrirs en les nappant d\'huile d\'olive.'),
(75, 10, 1, 'Pelez les pommes de terre, lavez-les, coupez-les en petits dés ou bien en fines rondelles, et mettez-les dans une marmite.'),
(76, 10, 2, 'Préparez la sauce avec: l\'ail, oignon, sel, poivre et huile .'),
(77, 10, 3, 'Versez ce mélange sur les pommes de terre et recouvrez à hauteur avec de l\'eau. Portez à ébullition et laissez cuire à petit feu.'),
(78, 10, 4, 'Pendant ce temps, grillez les poivrons, nettoyez-les et coupez-les en morceaux. Ajoutez-le sur les pommes de terre.'),
(79, 10, 5, 'Faire cuire à feu doux, environ 5 mn. Réduisez la sauce. Dans un bol cassez l’œuf, et à l\'aide d\'une fourchette battez-le bien.'),
(80, 10, 6, 'Versez sur les pommes de terre, Remuez la marmite délicatement dans tous les sens, éteignez aussitôt.'),
(81, 11, 1, 'Préchauffez le four à 180°C (thermostat 6)'),
(82, 11, 2, 'Déposez dans une casserole le beurre coupé en morceaux. Faites-le fondre à feu doux avec le sel et 25 cl d’eau.'),
(83, 11, 3, 'Lorsque le beurre est bien fondu, ajoutez la farine d’un seul coup. Mélangez vigoureusement à l’aide d’une spatule en bois'),
(84, 11, 4, 'Ajoutez les œufs un à un en mélangeant bien à chaque fois.'),
(85, 11, 5, 'Râpez le Comté et ajoutez-le à la pâte à chou. Mélangez-bien pour le répartir uniformément.'),
(86, 11, 6, 'Enfournez pendant 35 minutes. Lorsque les gougères au Comté sont bien dorées, sortez-les du four.'),
(87, 11, 7, 'Laissez les gougères au Comté refroidir 1 ou 2 minutes pour ne pas vous brûler. Dégustez-les chaudes ou tièdes.'),
(88, 12, 1, 'Lavez les tomates et coupez-les en quartiers. Déposez-les ensuite dans un saladier.'),
(89, 12, 2, 'Épluchez l\'oignon et émincez-le. Ajoutez-le aux quartiers de tomate puis mélangez.'),
(90, 12, 3, 'Préparez la vinaigrette en mélangeant l\'huile avec le vinaigre, la ciboulette et la coriandre ciselées.'),
(91, 12, 4, 'Versez cette vinaigrette dans le saladier et placez-le au frais jusqu\'au moment de servir.'),
(92, 13, 1, 'Pour commencer, rincez les pommes et enlever les pépins. Coupez les en morceaux. Placez les morceaux dans le bol.'),
(93, 13, 2, 'Mixez d’abord à petite vitesse puis augmenter petit à petit.'),
(94, 13, 3, 'Une fois cela fait, passer le jus dans une passoire afin d’enlever les morceaux restés. Mettez dans un contenant puis réservez au frais. Consommez le jus rapidement.'),
(95, 14, 1, 'Faites tiédir l’eau. Pendant ce temps, pressez le demi-citron jaune.'),
(96, 14, 2, 'Versez le jus de citron dans un verre. Ajoutez l’eau tiède, mélangez.'),
(97, 14, 3, 'Dégustez ce jus de citron detox immédiatement.'),
(98, 15, 1, 'Epluchez la pomme et la poire. Coupez la queue des fruits et évidez-les. A l\'aide d\'un couteau.'),
(99, 15, 2, 'Plongez ces cubes dans la cuve de votre centrifugeuse et pressez-les. Récupérez le jus dans un pichet.'),
(100, 15, 3, 'Epluchez la banane et déposez-la dans votre blender. Ajoutez le jus pomme-poire et mixez à pleine puissance.'),
(101, 15, 4, 'Versez ce jus dans un grand verre et consommez-le bien frais.'),
(102, 16, 1, 'Lavez les fraise et équeutez-les. Garder 6 belles fraises pour la décoration des verres.'),
(103, 16, 2, 'Dans un blender, mixez le reste de fraise avec le jus de citron, le sucre et 1 verre d\'eau.'),
(104, 16, 3, 'Ajoutez à ce mélange le reste d\'eau. Ajoutez de la glace si vous voulez une boisson instantanée et glacée.'),
(105, 17, 1, 'Dans un saladier, mélangez la farine, le sel et le sucre en poudre. Creusez ensuite un puits pour y casser les œufs.'),
(106, 17, 2, 'Mélangez en effectuant des cercles du centre vers l’extérieur. Versez ensuite le lait petit à petit.'),
(107, 17, 3, 'Avec un coton, badigeonnez d’huile le fond de votre crêpière et faites-la chauffer à feu vif.'),
(108, 17, 4, 'Une fois bien chaude, versez-y une louche de pâte et laissez cuire 3 min de chaque côté.'),
(109, 17, 5, 'Empilez les crêpes sur une assiette, en les recouvrant éventuellement d’un torchon propre pour les conserver au chaud !'),
(110, 18, 1, 'Préchauffez le four à 180°C en chaleur tournante. Séparez les jaunes d’œufs des blancs. Zestez le citron entièrement.'),
(111, 18, 2, 'puis presser la moitié. Mélangez 50 g de sucre en poudre avec les zestes et le jus de citron.'),
(112, 18, 3, 'Montez les blancs en neige bien ferme avec 100 g de sucre en poudre, à incorporer en 3 fois.'),
(113, 18, 4, 'Dans un autre saladier, mélangez les jaunes d’œufs avec les derniers 100 g de sucre en poudre ainsi que la fleur d’oranger.'),
(114, 18, 5, 'Ajoutez le mélange zestes et jus de citron/sucre. Versez le mélange de farine et de fécule.'),
(115, 18, 6, 'Incorporez délicatement à l’aide d’une maryse, les blancs en neige jusqu’à obtention d’une préparation bien homogène.'),
(116, 18, 7, 'Enfournez pour 1h de cuisson et dégustez votre biscuit de Savoie.');

-- --------------------------------------------------------

--
-- Structure de la table `fetes`
--

DROP TABLE IF EXISTS `fetes`;
CREATE TABLE IF NOT EXISTS `fetes` (
  `id_fetes` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id_fetes`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fetes`
--

INSERT INTO `fetes` (`id_fetes`, `name`, `description`) VALUES
(1, 'Mariage', ''),
(2, 'Achoura', ''),
(3, 'Aid', ''),
(4, 'Ramadan', ''),
(5, 'El mawlid', '');

-- --------------------------------------------------------

--
-- Structure de la table `fetes_recette`
--

DROP TABLE IF EXISTS `fetes_recette`;
CREATE TABLE IF NOT EXISTS `fetes_recette` (
  `id_recette` int(11) NOT NULL,
  `id_fetes` int(11) NOT NULL,
  PRIMARY KEY (`id_recette`,`id_fetes`),
  KEY `id_fetes` (`id_fetes`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fetes_recette`
--

INSERT INTO `fetes_recette` (`id_recette`, `id_fetes`) VALUES
(1, 1),
(1, 4),
(5, 1),
(5, 4),
(7, 1),
(7, 2),
(7, 3),
(7, 5),
(9, 5);

-- --------------------------------------------------------

--
-- Structure de la table `info`
--

DROP TABLE IF EXISTS `info`;
CREATE TABLE IF NOT EXISTS `info` (
  `id_info` int(11) NOT NULL AUTO_INCREMENT,
  `glucides` float(7,2) DEFAULT NULL,
  `lipides` float(7,2) DEFAULT NULL,
  `minéraux` varchar(50) DEFAULT NULL,
  `vitamines` varchar(50) DEFAULT NULL,
  `id_ingredient` int(11) NOT NULL,
  PRIMARY KEY (`id_info`),
  KEY `id_ingredient` (`id_ingredient`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `info`
--

INSERT INTO `info` (`id_info`, `glucides`, `lipides`, `minéraux`, `vitamines`, `id_ingredient`) VALUES
(1, 3.90, 0.10, 'potassium,calcium,fer', 'C,B', 1),
(2, 18.00, 0.10, 'potassium,magnésium,phosphore', 'C,B1,B3', 2),
(3, 99.00, 0.00, 'magnésium,fer', 'B2', 3),
(4, 5.70, 0.20, 'zinc,magnésium,fer', 'C,A', 4),
(5, 5.10, 0.30, 'calcium,potassium', 'C,A,B6', 5),
(6, 21.20, 0.30, 'calcium,magnésium,potassium', 'C,B1,B6,B9', 6),
(7, 76.00, 1.50, ' cuivre,zinc,potassium,phosphore', 'B,E,A,D,K', 7),
(8, 4.80, 3.25, 'calcium,potassium', 'D,A,C', 8),
(9, 19.60, 0.25, 'manganèse,potassium', 'C,B6', 9),
(10, 9.00, 0.30, 'cuivre,potassium', 'C,E', 10),
(11, 7.00, 0.20, 'fer', 'C', 11),
(12, 8.80, 0.00, 'potassium', 'C', 12),
(13, 9.60, 0.20, 'calcium,potassium,phosphore', 'C', 13),
(14, 1.60, 0.30, 'potassium', 'C,B9', 14),
(15, 12.20, 0.30, 'cuivre', 'K1,E', 15),
(16, 64.00, 1.00, 'fer,magnésium', 'B1', 16),
(17, 0.00, 0.00, 'sodium,magnésium', NULL, 17),
(18, 1.00, 61.00, 'sélenium', 'A,E', 18),
(19, 0.00, 100.00, NULL, 'K1,E', 19),
(20, 4.80, 0.30, 'fer', 'C,B6', 20),
(21, 27.40, 2.60, 'calcium,phosphore', 'K', 21),
(22, 16.00, 0.50, 'fer,magnésium', 'B12,B9', 22),
(23, 15.00, 0.80, 'calcium,phosphore', 'C,B1', 23),
(24, 1.00, 13.50, 'sélenium,fer,phosphore', 'B3,B2,B6', 24),
(25, 0.20, 10.00, 'zinc,fer', 'B3,B6', 25),
(26, 1.30, 0.50, 'calcium,fer', 'Bêta-carotène,K1', 26),
(27, 0.90, 10.00, 'zinc,fer,sélenium', 'A,D', 27),
(28, 43.00, 3.00, 'manganèse,cuivre', 'C,K,B6', 28),
(29, 64.00, 3.80, 'calcium,potassium', 'E,A', 29),
(30, 33.70, 22.30, 'calcium,fer,magnésium', 'E,A', 30),
(31, 3.60, 0.50, 'calcium,potassium,magnésium', 'A,C,K', 31),
(32, 2.70, 0.33, 'phosphore,potassium', 'C,E', 32),
(33, 82.00, 0.10, 'magnésium', 'B', 33),
(34, 0.00, 0.00, 'sélenium', NULL, 34),
(35, 0.00, 100.00, NULL, 'E', 35),
(36, 17.90, 6.30, 'fer', NULL, 36);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `id_ingredient` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `healthy` tinyint(1) NOT NULL,
  `proportion` float(7,2) DEFAULT NULL,
  `calories` int(12) NOT NULL,
  PRIMARY KEY (`id_ingredient`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`id_ingredient`, `name`, `healthy`, `proportion`, `calories`) VALUES
(1, 'la tomate', 1, 90.00, 18),
(2, 'Pommes de terre', 1, 70.00, 73),
(3, 'Le sucre', 0, 10.00, 400),
(4, 'Oignon', 1, 90.00, 31),
(5, 'La carotte', 1, 90.00, 40),
(6, 'L\'ail', 1, 80.00, 130),
(7, 'La farine', 1, 70.00, 350),
(8, 'Le lait', 1, 80.00, 150),
(9, 'La banane', 1, 90.00, 89),
(10, 'La pêche', 1, 70.00, 43),
(11, 'La fraise', 1, 70.00, 29),
(12, 'La pomme', 1, 80.00, 14),
(13, 'L\'orange', 1, 90.00, 45),
(14, 'Le citron', 1, 90.00, 17),
(15, 'La poire', 1, 60.00, 50),
(16, 'La semoule', 1, 60.00, 110),
(17, 'Le sel', 0, 20.00, 0),
(18, 'Le beurre', 0, 10.00, 775),
(19, 'L\'huile d\'olive', 1, 90.00, 900),
(20, 'le poivron', 1, 55.00, 75),
(21, 'le pois chiche', 1, 65.00, 47),
(22, 'lentilles', 1, 70.00, 42),
(23, 'les haricots blancs', 1, 75.00, 113),
(24, 'Le poulet', 1, 60.00, 206),
(25, 'La viande', 1, 55.00, 185),
(26, 'La laitue', 1, 60.00, 15),
(27, 'Les oeufs', 1, 55.00, 145),
(28, 'Le poivre noir', 1, 60.00, 17),
(29, 'Le poivre rouge', 1, 55.00, 31),
(30, 'Le cumin', 1, 54.00, 22),
(31, 'coriandre fraîche', 1, 70.00, 23),
(32, 'Tomate consontré', 0, 40.00, 30),
(33, 'Vermicelles', 1, 55.00, 374),
(34, 'L\'eau', 1, 100.00, 18),
(35, 'L\'huile', 0, 20.00, 899),
(36, 'levure boulangère', 0, 35.00, 105);

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id_news` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(40) DEFAULT NULL,
  `paragraphe` varchar(1000) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `vedio` varchar(50) DEFAULT NULL,
  `id_recette` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_news`),
  KEY `id_recette` (`id_recette`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id_news`, `titre`, `paragraphe`, `image`, `vedio`, `id_recette`) VALUES
(2, 'Conservation', 'Savoir bien conserver ses aliments présente bien des avantages. \r\nPremièrement, c’est bon pour la planète et notre porte-monnaie : \r\non évite le gaspillage alimentaire en adoptant le réflexe de conserver quand il y a des restes ! \r\nDeuxième, conserver ses aliments peut permettre de profiter de certains fruits et \r\nlégumes qui nous manquent lorsque ce n’est pas leur pleine saison de consommation. \r\nPar exemple, des tomates séchées ou encore des fruits séchés. Mais comment conserver ses aliments \r\npour qu’ils gardent un maximum de saveurs, et de fraîcheur ? Exit la salade flétrie, le pain tout dur, \r\nle beurre qui n’a plus d’allure, les légumes et les fruits quasiment moisis… Ici, on vous explique comment conserver au mieux les \r\naliments pour en profiter pleinement, et le plus longtemps possible !', '../../assets/images_news/Conservation.webp', NULL, NULL),
(1, 'Cuisson des aliments', 'La cuisson des aliments, tout un art, qu’on se le dise. En effet, ce \r\nn’est pas une mince affaire que de réussir la cuisson d’une viande pour qu’elle soit « à point », \r\nd’obtenir une chair tendre lors de la cuisson du poisson, de faire cuire du riz sans que les grains ne \r\nse collent entre eux. D’autant que les méthodes de cuisson se font nombreuses. Certaines sublimeront les \r\nsaveurs d’un aliment, d’autres conserveront ses atouts nutritionnels au maximum. À chaque envie, une méthode \r\nde cuisson adaptée : à la vapeur, à la poêle, au four, au bain-marie, au court-bouillon, etc. Pour \r\nvous accompagner et vous aider à maîtriser la cuisson en cuisine (gage de réussite de vos recettes !), \r\nretrouvez par aliment, \r\ntoutes nos explications détaillées. L’art de la cuisson, vous maîtrisez, maintenant ?', '../../assets/images_news/Cuisson des aliments.webp', NULL, NULL),
(5, NULL, NULL, NULL, NULL, 3),
(18, NULL, NULL, NULL, NULL, 4),
(19, NULL, NULL, NULL, NULL, 2),
(20, NULL, NULL, NULL, NULL, 1),
(21, NULL, NULL, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Structure de la table `notation`
--

DROP TABLE IF EXISTS `notation`;
CREATE TABLE IF NOT EXISTS `notation` (
  `id_utilisateur` int(11) NOT NULL,
  `id_recette` int(11) NOT NULL,
  `note` float(5,1) NOT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_recette`),
  KEY `id_recette` (`id_recette`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `notation`
--

INSERT INTO `notation` (`id_utilisateur`, `id_recette`, `note`) VALUES
(1, 1, 8.0),
(3, 1, 7.0),
(2, 3, 5.0),
(2, 4, 6.0),
(3, 5, 8.5),
(2, 6, 3.0),
(3, 7, 10.0),
(3, 9, 4.0),
(1, 2, 7.0);

-- --------------------------------------------------------

--
-- Structure de la table `parametre`
--

DROP TABLE IF EXISTS `parametre`;
CREATE TABLE IF NOT EXISTS `parametre` (
  `id_parametre` int(11) NOT NULL,
  `pourcentage` float(5,1) NOT NULL,
  PRIMARY KEY (`id_parametre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `parametre`
--

INSERT INTO `parametre` (`id_parametre`, `pourcentage`) VALUES
(1, 70.0),
(2, 81.0),
(3, 260.0);

-- --------------------------------------------------------

--
-- Structure de la table `preferance`
--

DROP TABLE IF EXISTS `preferance`;
CREATE TABLE IF NOT EXISTS `preferance` (
  `id_user` int(11) NOT NULL,
  `id_recette` int(11) NOT NULL,
  PRIMARY KEY (`id_user`,`id_recette`),
  KEY `id_recette` (`id_recette`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `preferance`
--

INSERT INTO `preferance` (`id_user`, `id_recette`) VALUES
(2, 1),
(2, 5),
(2, 6),
(2, 11),
(2, 18);

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `id_recette` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `description` varchar(200) NOT NULL,
  `diffuculte` varchar(50) DEFAULT NULL,
  `vedio` varchar(50) DEFAULT NULL,
  `temps_preparation` float(7,2) DEFAULT NULL,
  `temps_repos` float(7,2) DEFAULT NULL,
  `temps_cuisant` float(7,2) DEFAULT NULL,
  `validate` tinyint(1) DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  `id_categorie` int(11) NOT NULL,
  PRIMARY KEY (`id_recette`),
  KEY `id_categorie` (`id_categorie`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id_recette`, `titre`, `image`, `description`, `diffuculte`, `vedio`, `temps_preparation`, `temps_repos`, `temps_cuisant`, `validate`, `id_user`, `id_categorie`) VALUES
(1, 'Chorba algérienne', '../../assets/images_recette/Chorba_algerienne.webp', 'La chorba à l\'algérienne est une soupe traditionnelle orientale principalement consommée en Algérie\r\nC\'est une soupe à base de viande d\'agneau ou de mouton, de tomates, de vermicelles et de légumes.', 'moyenne', NULL, 30.00, 10.00, 20.00, 1, NULL, 1),
(2, 'Chakchouka', '../../assets/images_recette/chakchouka.webp', 'La chakchouka algérienne est une délicieuse entrée aux légumes que l’on sert chaude ou froide', 'facile', NULL, 15.00, 15.00, 60.00, 1, NULL, 2),
(3, 'MSEMEN', '../../assets/images_recette/Msemen.webp', 'C\'est un dessert algerien a base de semoule apprecie lors des fetes.', 'moyenne', NULL, 25.00, 10.00, 2.00, 1, NULL, 3),
(4, 'Jus d\'orange', '../../assets/images_recette/Jus_d\'orange.jpg', 'C\'est un jus simple a base d\'orange et de lait', 'facile', NULL, 5.00, 0.00, 0.00, 1, NULL, 4),
(5, 'Harira', '../../assets/images_recette/Harira.webp', 'La Harira est une soupe traditionnelle Algérienne spécifique de l’ouest D’Algérie, elle est préparée habituellement\r\n courant le mois sacré du ramadan pour la rupture du jeûne', 'facile', NULL, 40.00, 10.00, 60.00, 1, NULL, 1),
(6, 'Chakchouka makliya', '../../assets/images_recette/Chakchouka makliya.webp', 'un mélange de légumes qui varis selon les saisons, les recettes sont faciles à préparer et \r\npas chers, et cette version est trés', 'facile', NULL, 30.00, 10.00, 30.00, 1, NULL, 2),
(7, 'Couscous', '../../assets/images_recette/Couscous.webp', 'Ce plat complet et mondialement connu contient à la fois des légumes, de la viande et des féculents. Il se \r\ndéguste traditionnellement avec un verre de lait fermenté.', 'moyenne', NULL, 20.00, 0.00, 70.00, 1, NULL, 2),
(8, 'Kesra algérienne', '../../assets/images_recette/Kesra algérienne.webp', 'La kersa algérienne est assez facile à réaliser, Cette recette traditionnelle est très \r\nappréciée au petit déjeuner qu\'au goûter que pour accompagner toutes sortes de plats en sauce !', 'moyenne', NULL, 25.00, 0.00, 15.00, 1, NULL, 1),
(9, 'Beghrir', '../../assets/images_recette/Beghrir.webp', 'Le beghrir, est une crêpe épaisse à base de semoule que l’on sert aussi pendant le mois du ramadan. On l’appelle \r\naussi « crêpes aux mille trous ».', 'facile', NULL, 10.00, 90.00, 5.00, 1, NULL, 2),
(10, 'Chtitha batata', '../../assets/images_recette/Chtitha batata.webp', ' Chtitha batata est un classique de la cuisine Algérienne, elle est trés présente sur nos tables et surtout \r\nà cette saison d\'été où les poivrons sont bons et gorgés de soleil.', 'facile', NULL, 30.00, 0.00, 30.00, 1, NULL, 2),
(11, 'Gougères', '../../assets/images_recette/cougeres.webp', ' Changez des habituelles chips et autres biscuits industriels. Pour l’apéritif, épatez vos amis en proposant \r\nde délicieuses gougères.Après avoir testé cette recette, vous deviendrez accro !', 'facile', NULL, 15.00, 10.00, 35.00, 1, NULL, 1),
(12, 'Salade de tomates', '../../assets/images_recette/salade.webp', ' Un grand classique de l\'été qui marche tout le temps, avec tout le monde : la salade de tomates ! \r\nTrès rafraîchissante, très savoureuse, et excellente pour la santé', 'facile', NULL, 10.00, 0.00, 0.00, 1, NULL, 1),
(13, 'Jus de pomme', '../../assets/images_recette/jus_pomme.webp', ' Rien de mieux le matin qu’un bon jus de pomme au blender maison ! Fait en uniquement 20 min, ', 'facile', NULL, 15.00, 0.00, 0.00, 1, NULL, 4),
(14, 'Jus de citron', '../../assets/images_recette/jus_citron.webp', ' Ce jus de citron est une boisson idéale dans le cadre d’une cure detox. Ce coupe-faim naturel favorise la perte de \r\npoids et aide à avoir un ventre plat.', 'facile', NULL, 5.00, 0.00, 0.00, 1, NULL, 4),
(15, 'Jus de banane', '../../assets/images_recette/jus_banane.webp', ' Ce jus de citron est une boisson idéale dans le cadre d’une cure detox. Ce coupe-faim naturel favorise la perte de \r\npoids et aide à avoir un ventre platLa banane est l\'un des rares fruits.', 'facile', NULL, 15.00, 0.00, 0.00, 1, NULL, 4),
(16, 'Jus de fraise', '../../assets/images_recette/jus_fraise.webp', ' La fraise, ça s’apprécie aussi en boisson, la recette de ce jus est simple et facile à faire, cette boisson est tellement \r\nfraîche, je ne me lasse pas, elle ravira aussi les petits', 'facile', NULL, 60.00, 0.00, 0.00, 1, NULL, 4),
(17, 'Crêpes faciles', '../../assets/images_recette/crepes.webp', '  Du goûter à l’anniversaire en passant par la fameuse « crêpes party », personne ne lui résiste. \r\nPour une recette de crêpe facile', 'facile', NULL, 20.00, 30.00, 3.00, 1, NULL, 3),
(18, 'Biscuit de Savoie', '../../assets/images_recette/biscuit.webp', 'Depuis tout petit, ma grand-mère me prépare ce superbe biscuit de Savoie ultra moelleux et si délicieux!', 'facile', NULL, 20.00, 0.00, 60.00, 1, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `saison`
--

DROP TABLE IF EXISTS `saison`;
CREATE TABLE IF NOT EXISTS `saison` (
  `id_saison` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id_saison`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `saison`
--

INSERT INTO `saison` (`id_saison`, `name`) VALUES
(1, 'été'),
(2, 'printemps'),
(3, 'hiver'),
(4, 'automne');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `hash_pwd` varchar(1024) NOT NULL,
  `token` varchar(1024) DEFAULT NULL,
  `sexe` varchar(1) NOT NULL,
  `date_naissance` date NOT NULL,
  `validate` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `hash_pwd`, `token`, `sexe`, `date_naissance`, `validate`) VALUES
(2, 'belhout ahmed', 'ja_ahmed@esi.dz', 'belhout123456', NULL, 'M', '2023-01-15', 0),
(4, 'brahami lamine', 'jl_brahami@esi.dz', 'fff', NULL, 'M', '2022-05-11', 0),
(5, '4kja ggg', 'ja_belhout@esi.d', 'jhk', NULL, 'M', '2023-01-25', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
