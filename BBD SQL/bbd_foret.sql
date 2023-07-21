-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour foret
CREATE DATABASE IF NOT EXISTS `foret` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `foret`;

-- Listage de la structure de table foret. aimer_etre_vivant
CREATE TABLE IF NOT EXISTS `aimer_etre_vivant` (
  `id_etre_vivant` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `commentaire` text NOT NULL,
  KEY `aimer_etre_vivant.id_etre_vivant` (`id_etre_vivant`),
  KEY `aimer_etre_vivant.id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `aimer_etre_vivant.id_etre_vivant` FOREIGN KEY (`id_etre_vivant`) REFERENCES `etre_vivant` (`id_etre_vivant`),
  CONSTRAINT `aimer_etre_vivant.id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.aimer_etre_vivant : ~0 rows (environ)

-- Listage de la structure de table foret. aimer_foret
CREATE TABLE IF NOT EXISTS `aimer_foret` (
  `id_foret` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `commentaire` text,
  KEY `aimer_foret.id_foret` (`id_foret`),
  KEY `aimer_foret.id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `aimer_foret.id_foret` FOREIGN KEY (`id_foret`) REFERENCES `foret` (`id_foret`),
  CONSTRAINT `aimer_foret.id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.aimer_foret : ~0 rows (environ)

-- Listage de la structure de table foret. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.categorie : ~2 rows (environ)
INSERT INTO `categorie` (`id_categorie`, `nom_categorie`) VALUES
	(1, 'arbre'),
	(2, 'plante'),
	(3, 'animal');

-- Listage de la structure de table foret. categorie_produit
CREATE TABLE IF NOT EXISTS `categorie_produit` (
  `id_categorie_produit` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categorie_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.categorie_produit : ~0 rows (environ)

-- Listage de la structure de table foret. classe
CREATE TABLE IF NOT EXISTS `classe` (
  `id_classe` int NOT NULL AUTO_INCREMENT,
  `nom_classe` varchar(50) NOT NULL,
  PRIMARY KEY (`id_classe`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.classe : ~1 rows (environ)
INSERT INTO `classe` (`id_classe`, `nom_classe`) VALUES
	(1, 'Equisetopsida'),
	(3, 'Mammalia Linnaeus');

-- Listage de la structure de table foret. commande
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int NOT NULL AUTO_INCREMENT,
  `dateCommande` datetime NOT NULL,
  `id_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `commande.id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `commande.id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.commande : ~0 rows (environ)

-- Listage de la structure de table foret. commentaire_animaux
CREATE TABLE IF NOT EXISTS `commentaire_animaux` (
  `id_commentaire_animaux` int NOT NULL AUTO_INCREMENT,
  `id_etre_vivant` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `commentaire` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_commentaire_animaux`),
  KEY `id_etre_vivant_animaux` (`id_etre_vivant`),
  KEY `id_utilisateur_animaux` (`id_utilisateur`),
  CONSTRAINT `id_etre_vivant_animaux` FOREIGN KEY (`id_etre_vivant`) REFERENCES `etre_vivant` (`id_etre_vivant`),
  CONSTRAINT `id_utilisateur_animaux` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.commentaire_animaux : ~0 rows (environ)
INSERT INTO `commentaire_animaux` (`id_commentaire_animaux`, `id_etre_vivant`, `id_utilisateur`, `commentaire`, `date`) VALUES
	(2, 4, 3, 'quelle beauté !', '2023-07-21 09:08:15'),
	(3, 6, 3, 'Le roi de la forêt.', '2023-07-21 09:08:15');

-- Listage de la structure de table foret. commentaire_arbre
CREATE TABLE IF NOT EXISTS `commentaire_arbre` (
  `id_commentaire_arbre` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int NOT NULL,
  `id_etre_vivant` int NOT NULL,
  `commentaire` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_commentaire_arbre`),
  KEY `id_utilisateur_commentaire` (`id_utilisateur`),
  KEY `id_etre_vivant_commentaire` (`id_etre_vivant`),
  CONSTRAINT `id_etre_vivant_commentaire` FOREIGN KEY (`id_etre_vivant`) REFERENCES `etre_vivant` (`id_etre_vivant`),
  CONSTRAINT `id_utilisateur_commentaire` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.commentaire_arbre : ~3 rows (environ)
INSERT INTO `commentaire_arbre` (`id_commentaire_arbre`, `id_utilisateur`, `id_etre_vivant`, `commentaire`, `date`) VALUES
	(6, 3, 1, 'Ce chêne est magnifique !', '2023-07-21 09:07:19'),
	(8, 3, 2, 'Le frêne est une espèces commune des forêt d&#039;alsace', '2023-07-21 09:07:19');

-- Listage de la structure de table foret. commentaire_foret
CREATE TABLE IF NOT EXISTS `commentaire_foret` (
  `id_commentaire_foret` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int NOT NULL,
  `commentaire` text NOT NULL,
  `id_foret` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_commentaire_foret`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_foret` (`id_foret`),
  CONSTRAINT `id_foret_commentaire` FOREIGN KEY (`id_foret`) REFERENCES `foret` (`id_foret`),
  CONSTRAINT `id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.commentaire_foret : ~4 rows (environ)
INSERT INTO `commentaire_foret` (`id_commentaire_foret`, `id_utilisateur`, `commentaire`, `id_foret`, `date`) VALUES
	(5, 1, 'Une superbe forêt\r\n', 1, '2023-07-21 09:02:19'),
	(15, 3, 'Un incroyable chateaux', 1, '2023-07-21 09:05:27'),
	(16, 3, 'Le châteaux le plus impressionnant d&#039;alsace !', 2, '2023-07-21 09:02:19');

-- Listage de la structure de table foret. commentaire_plante
CREATE TABLE IF NOT EXISTS `commentaire_plante` (
  `id_commentaire_plante` int NOT NULL AUTO_INCREMENT,
  `id_etre_vivant` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `commentaire` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_commentaire_plante`),
  KEY `id_etre_vivant_plante` (`id_etre_vivant`),
  KEY `id_utilisateur_plante` (`id_utilisateur`),
  CONSTRAINT `id_etre_vivant_plante` FOREIGN KEY (`id_etre_vivant`) REFERENCES `etre_vivant` (`id_etre_vivant`),
  CONSTRAINT `id_utilisateur_plante` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.commentaire_plante : ~0 rows (environ)
INSERT INTO `commentaire_plante` (`id_commentaire_plante`, `id_etre_vivant`, `id_utilisateur`, `commentaire`, `date`) VALUES
	(2, 3, 3, 'Une superbe plante.', '2023-07-21 09:07:45'),
	(3, 5, 3, 'Très commune en alsace', '2023-07-21 09:07:45');

-- Listage de la structure de table foret. consulter
CREATE TABLE IF NOT EXISTS `consulter` (
  `id_utilisateur` int NOT NULL,
  `id_topics` int NOT NULL,
  KEY `consulter.id_utilisateur` (`id_utilisateur`),
  KEY `consulter.id_topics` (`id_topics`),
  CONSTRAINT `consulter.id_topics` FOREIGN KEY (`id_topics`) REFERENCES `topics` (`id_topics`),
  CONSTRAINT `consulter.id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.consulter : ~0 rows (environ)

-- Listage de la structure de table foret. espece
CREATE TABLE IF NOT EXISTS `espece` (
  `id_espece` int NOT NULL AUTO_INCREMENT,
  `nom_espece` varchar(50) NOT NULL,
  PRIMARY KEY (`id_espece`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.espece : ~6 rows (environ)
INSERT INTO `espece` (`id_espece`, `nom_espece`) VALUES
	(1, 'Quercus robur'),
	(2, 'Fraxinus excelsior'),
	(3, 'Allium ursinum'),
	(4, 'Lynx lynx'),
	(5, 'Orchis purpurea'),
	(6, 'Cervus elaphus');

-- Listage de la structure de table foret. etre_vivant
CREATE TABLE IF NOT EXISTS `etre_vivant` (
  `id_etre_vivant` int NOT NULL AUTO_INCREMENT,
  `nom_courant` varchar(25) NOT NULL,
  `nom_latin` varchar(50) NOT NULL,
  `taille` int DEFAULT NULL,
  `poids` int DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `photo_repartition` varchar(50) DEFAULT NULL,
  `id_classe` int NOT NULL,
  `id_ordre` int NOT NULL,
  `id_famille` int NOT NULL,
  `id_espece` int NOT NULL,
  `id_categorie` int NOT NULL,
  `descriptif` text,
  PRIMARY KEY (`id_etre_vivant`),
  KEY `id_classe` (`id_classe`),
  KEY `id_ordre` (`id_ordre`),
  KEY `id_famille` (`id_famille`),
  KEY `id_espece` (`id_espece`),
  KEY `id_categorie` (`id_categorie`),
  CONSTRAINT `id_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`),
  CONSTRAINT `id_classe` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id_classe`),
  CONSTRAINT `id_espece` FOREIGN KEY (`id_espece`) REFERENCES `espece` (`id_espece`),
  CONSTRAINT `id_famille` FOREIGN KEY (`id_famille`) REFERENCES `famille` (`id_famille`),
  CONSTRAINT `id_ordre` FOREIGN KEY (`id_ordre`) REFERENCES `ordre` (`id_ordre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.etre_vivant : ~6 rows (environ)
INSERT INTO `etre_vivant` (`id_etre_vivant`, `nom_courant`, `nom_latin`, `taille`, `poids`, `photo`, `photo_repartition`, `id_classe`, `id_ordre`, `id_famille`, `id_espece`, `id_categorie`, `descriptif`) VALUES
	(1, 'chêne pédonculé', 'quercus robur', 30, NULL, 'public/img/Arbre/chene_pedoncule.jpg', 'public/img/Arbre/chene_pedoncule.png', 1, 1, 1, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
	(2, 'Frêne', 'Fraxinus excelsior', 50, NULL, 'public/img/Arbre/Fraxinus-excelsior-frene.jpg', 'public/img/Arbre/aire_repartition_frene.jpg', 1, 2, 2, 2, 1, NULL),
	(3, 'ail-des-ours', 'Allium ursinum', NULL, NULL, 'public/img/plante/ail-des-ours.jpg', 'public/img/plante/repartition_ail_ours.png', 1, 3, 3, 3, 2, NULL),
	(4, 'Lynx', 'Lynx lynx', 100, 20, 'public/img/Animaux/lynx.jpg', 'public/img/Animaux/repartitionLynx.jpg', 3, 4, 4, 4, 3, NULL),
	(5, 'Orchidée pourpre', 'Orchis purpurea', 50, NULL, 'public/img/plante/orchide_pourpre.jpg', 'public/img/plante/repartition_orchide.jpg', 1, 3, 5, 5, 2, 'L\'orchis pourpre (Orchis purpurea) ou petite demoiselle est une espèce de plantes herbacées vivaces de la famille des Orchidacées assez commune en Europe, que l\'on rencontre aussi en Afrique du Nord, en Turquie et au Caucase. Elle est nommée « Pentecôte » dans l\'Ouest de la France.'),
	(6, 'Cerf élaphe', 'Cervus elaphus', 150, 200, 'public/img/Animaux/Cervus_elaphus.jpg', 'public/img/Animaux/Cerf_repartition.png', 3, 5, 6, 6, 3, 'Le cerf élaphe (Cervus elaphus) est un grand cervidé des forêts tempérées d\'Europe, d\'Afrique du Nord, d\'Asie occidentale et d\'Amérique . Son nom est un pléonasme, car « élaphe » signifie déjà « cerf » en grec.');

-- Listage de la structure de table foret. famille
CREATE TABLE IF NOT EXISTS `famille` (
  `id_famille` int NOT NULL AUTO_INCREMENT,
  `nom_famille` varchar(50) NOT NULL,
  PRIMARY KEY (`id_famille`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.famille : ~6 rows (environ)
INSERT INTO `famille` (`id_famille`, `nom_famille`) VALUES
	(1, 'Fagaceae Dumort'),
	(2, 'Oleaceae'),
	(3, 'Amaryllidaceae'),
	(4, 'Felidae'),
	(5, 'Orchidaceae'),
	(6, 'Cervidae');

-- Listage de la structure de table foret. foret
CREATE TABLE IF NOT EXISTS `foret` (
  `id_foret` int NOT NULL AUTO_INCREMENT,
  `nom_foret` varchar(25) NOT NULL,
  `ville` varchar(25) DEFAULT NULL,
  `code_postal` varchar(25) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `descriptif` text,
  PRIMARY KEY (`id_foret`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.foret : ~2 rows (environ)
INSERT INTO `foret` (`id_foret`, `nom_foret`, `ville`, `code_postal`, `photo`, `descriptif`) VALUES
	(1, 'Forêt de Saverne', 'Saverne ', '67700', 'public/img/forêt/Chateaux-de-Saverne.jpg', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.'),
	(2, 'Forêt de Orschwiller', 'Orschwiller', '67600', 'public/img/forêt/Haut-Koenigsbourg.jpg', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.');

-- Listage de la structure de table foret. message
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_topics` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_message`),
  KEY `message.id_topics` (`id_topics`),
  KEY `message.id_utilisateur` (`id_user`),
  CONSTRAINT `message.id_topics` FOREIGN KEY (`id_topics`) REFERENCES `topics` (`id_topics`),
  CONSTRAINT `message.id_utilisateur` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.message : ~0 rows (environ)

-- Listage de la structure de table foret. ordre
CREATE TABLE IF NOT EXISTS `ordre` (
  `id_ordre` int NOT NULL AUTO_INCREMENT,
  `nom_ordre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ordre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.ordre : ~3 rows (environ)
INSERT INTO `ordre` (`id_ordre`, `nom_ordre`) VALUES
	(1, 'Fagales'),
	(2, 'Lamiales'),
	(3, 'Asparagales'),
	(4, 'Carnivora'),
	(5, 'Cetartiodactyla');

-- Listage de la structure de table foret. point
CREATE TABLE IF NOT EXISTS `point` (
  `id_point` int NOT NULL AUTO_INCREMENT,
  `etape` varchar(50) DEFAULT NULL,
  `longitude` decimal(10,0) NOT NULL,
  `lattitude` decimal(10,0) NOT NULL,
  `id_randonnee` int NOT NULL,
  PRIMARY KEY (`id_point`),
  KEY `point.id_randonnee` (`id_randonnee`),
  CONSTRAINT `point.id_randonnee` FOREIGN KEY (`id_randonnee`) REFERENCES `randonnee` (`id_randonnee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.point : ~0 rows (environ)

-- Listage de la structure de table foret. possede_etre_vivant
CREATE TABLE IF NOT EXISTS `possede_etre_vivant` (
  `id_foret` int NOT NULL,
  `id_etre_vivant` int NOT NULL,
  KEY `id_foret` (`id_foret`),
  KEY `id_etre_vivant` (`id_etre_vivant`),
  CONSTRAINT `id_etre_vivant` FOREIGN KEY (`id_etre_vivant`) REFERENCES `etre_vivant` (`id_etre_vivant`),
  CONSTRAINT `id_foret` FOREIGN KEY (`id_foret`) REFERENCES `foret` (`id_foret`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.possede_etre_vivant : ~0 rows (environ)

-- Listage de la structure de table foret. produit
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(50) NOT NULL,
  `prix` decimal(20,6) NOT NULL,
  `descriptif` text,
  `id_categorie` int NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `produit.id_categorie` (`id_categorie`),
  CONSTRAINT `produit.id_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categorie_produit` (`id_categorie_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.produit : ~0 rows (environ)

-- Listage de la structure de table foret. randonnee
CREATE TABLE IF NOT EXISTS `randonnee` (
  `id_randonnee` int NOT NULL AUTO_INCREMENT,
  `nom_randonnee` varchar(50) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `duree` int DEFAULT NULL,
  `difficulte` varchar(25) DEFAULT NULL,
  `id_foret` int DEFAULT NULL,
  `id_utilisateur` int NOT NULL,
  `longitude` decimal(22,20) DEFAULT NULL,
  `lattitude` decimal(22,20) DEFAULT NULL,
  PRIMARY KEY (`id_randonnee`),
  KEY `randonnee.id_foret` (`id_foret`),
  KEY `randonnee.id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `randonnee.id_foret` FOREIGN KEY (`id_foret`) REFERENCES `foret` (`id_foret`),
  CONSTRAINT `randonnee.id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.randonnee : ~0 rows (environ)
INSERT INTO `randonnee` (`id_randonnee`, `nom_randonnee`, `date_creation`, `duree`, `difficulte`, `id_foret`, `id_utilisateur`, `longitude`, `lattitude`) VALUES
	(1, 'randonnee des chateaux Saverne', '2023-06-30 14:22:13', 2, '2', 1, 1, 48.72440600000000000000, 7.33811600000000000000),
	(2, 'randonnee du chateau du Haut-Koeinbourg', '2023-06-30 15:00:21', 30, '3', 2, 1, 48.24945500000000000000, 7.34436600000000000000);

-- Listage de la structure de table foret. topics
CREATE TABLE IF NOT EXISTS `topics` (
  `id_topics` int NOT NULL AUTO_INCREMENT,
  `nom_topics` varchar(50) NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_categorie` int DEFAULT NULL,
  PRIMARY KEY (`id_topics`),
  KEY `topics.id_categorie` (`id_categorie`),
  CONSTRAINT `topics.id_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.topics : ~0 rows (environ)

-- Listage de la structure de table foret. utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `email` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.utilisateur : ~3 rows (environ)
INSERT INTO `utilisateur` (`id_utilisateur`, `role`, `email`, `pseudo`, `password`, `createAt`) VALUES
	(1, 'user', 'test@gmail.com', 'angalland', '12345', '2023-06-30 14:20:47'),
	(2, 'user', 'angalland@laposte.net', 'test1', '$2y$10$oQUjdWD1GXuPu/gMi/SlUeb/Hp7uSA61ULnGvr0MRTV6LTs0Llnf6', '2023-07-12 14:38:47'),
	(3, 'user', 'sophie.loir@laposte.net', 'sophie', '$2y$10$FurVnOUOFb0SDbnyi0JmreUE4tPs14fTHfM7jlzNo5Yx12f80EDCy', '2023-07-12 15:01:48');

-- Listage de la structure de table foret. vendre
CREATE TABLE IF NOT EXISTS `vendre` (
  `id_produit` int NOT NULL,
  `id_commande` int NOT NULL,
  `quantite` int DEFAULT '1',
  KEY `vendre.id_produit` (`id_produit`),
  KEY `vendre.id_commande` (`id_commande`),
  CONSTRAINT `vendre.id_commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`),
  CONSTRAINT `vendre.id_produit` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table foret.vendre : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
