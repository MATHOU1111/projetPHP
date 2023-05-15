-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 15 mai 2023 à 07:23
-- Version du serveur : 5.7.24
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `author`
--

CREATE TABLE `author` (
  `Id` tinyint(3) UNSIGNED NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `author`
--

INSERT INTO `author` (`Id`, `FirstName`, `LastName`, `username`, `password`) VALUES
(1, 'John', 'Doe', 'john', '123456789'),
(2, 'Mathis', 'Dumage', 'mathou', '123456789'),
(3, 'Larry ', 'Bambelle', 'Larry', '123456789');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `Id` tinyint(3) UNSIGNED NOT NULL,
  `Name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`Id`, `Name`) VALUES
(3, 'Divers'),
(1, 'Oiseaux');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `Id` mediumint(8) UNSIGNED NOT NULL,
  `NickName` varchar(30) DEFAULT NULL,
  `Contents` text NOT NULL,
  `CreationTimestamp` datetime NOT NULL,
  `Post_Id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`Id`, `NickName`, `Contents`, `CreationTimestamp`, `Post_Id`) VALUES
(3, 'FanDOISEAU83', 'Je suis vraiment fan de celui-là, surtout quand il fait cui-cui.', '2023-05-15 09:03:52', 77),
(4, 'Paul', 'Excellent article !', '2023-05-15 09:04:13', 77),
(5, 'Pierre', 'J\'adore !', '2023-05-15 09:14:26', 78),
(6, 'Mathis', 'J\'aime bien celui-là, il est vraiment stylé.', '2023-05-15 09:18:10', 82),
(7, 'Antoine', 'Beau gosse l\'oiseau', '2023-05-15 09:18:25', 82),
(8, 'Fandoiseau12', 'J\'aime bien', '2023-05-15 09:18:50', 81),
(9, 'Chasseurdoiseau', 'Facile à tuer, mes préférées.', '2023-05-15 09:19:14', 80),
(10, 'Antoine', 'grr wouaf !!', '2023-05-15 09:19:28', 79);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `Id` smallint(5) UNSIGNED NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Contents` text NOT NULL,
  `CreationTimestamp` datetime NOT NULL,
  `Author_Id` tinyint(3) UNSIGNED DEFAULT NULL,
  `Category_Id` tinyint(3) UNSIGNED DEFAULT NULL,
  `Modifié` int(11) NOT NULL,
  `image_name` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`Id`, `Title`, `Contents`, `CreationTimestamp`, `Author_Id`, `Category_Id`, `Modifié`, `image_name`) VALUES
(77, 'Le Chocard à bec jaune', 'Cet oiseau possède un plumage entièrement noir avec des reflets métalliques, un bec jaune, des pattes rouges et ses appels sont distinctifs et facilement reconnaissables.\r\n\r\nLa taille, 36 à 39 cm, est exactement celle du choucas, l\'envergure atteint 70 à 85 cm et la masse 190 à 240 g, sans dimorphisme sexuel.\r\n\r\nTrès beaux à observer en vol, les chocards utilisent à merveille les courants d\'air et semblent prendre plaisir à se poursuivre ou à expérimenter les manœuvres aériennes. Ils vivent en bandes nombreuses.\r\n\r\nIls vivent jusqu\'à 11 ans en liberté.', '2023-05-15 09:03:13', 1, 1, 1, '480px-Chocard_à_bec_jaune.jpg'),
(78, 'Monticole merle-bleu', 'Le Monticole merle-bleu ou Monticole bleu (Monticola solitarius) est une espèce de passereaux traditionnellement appelé Merle bleu.\r\n\r\nIl mesure 21 à 23 cm, a une envergure de 32 à 37 cm et pèse 37 à 54 g.\r\n\r\nLe mâle a un plumage bleu-gris, mis à part les ailes et la queue qui sont plus foncées.\r\n\r\nLa femelle et l\'oisillon sont marron, rayés plus clair sous le ventre.\r\n\r\nLe monticole merle-bleu est omnivore.\r\n\r\nIl se nourrit principalement d\'insectes (coléoptères, orthoptères, lépidoptères), d\'arthropodes (araignées) et d\'autres invertébrés mais aussi de lézards de petite taille, ainsi que de baies (sorbier, merisier, aubépine...) et de fruits.\r\n\r\nLe nid se trouve dans un renfoncement rocheux, ou dans un bâtiment. Il est construit d\'éléments végétaux qui sont des feuilles, des mousses, des racines...\r\n\r\nLa femelle pond 4 ou 5 œufs, qu\'elle couve environ 2 semaines. Il y a parfois 2 couvées par été.', '2023-05-15 09:05:34', 2, 1, 0, 'Blue_rock_thrush_(male)_at_Gamla_Nature_Reserve.jpg'),
(79, 'Le Traquet rieur', 'Le Traquet rieur (Oenanthe leucura) est une espèce de passereaux appartenant à la famille des Muscicapidae. Olivier Messiaen a consacré à cet oiseau une pièce, qui en porte le nom, de son Catalogue d\'oiseaux.\r\n\r\nElle est officiellement classée comme « disparue de France » par l\'UICN. Le dernier couple nichait en 1996 dans le massif des Albères, dans les Pyrénées orientales.\r\n\r\nEn Provence et dans le Roussillon, le traquet rieur fréquentait les pentes arides, bien ensoleillées, les gorges des cours d\'eau et les falaises maritimes.\r\n\r\nLe traquet rieur se nourrit principalement d\'insectes, de larves, de petits lézards et baies.\r\n\r\nIl niche souvent dans un tas de pierres, un trou dans une muraille, sous une grosse pierre, au fond d\'une cavité: le nid est un amas de racines, herbes, mousse et feuilles. La ponte a lieu en mai et comporte 4 - 6 œufs, bleu très pâle, couvés 2 semaines par la femelle.', '2023-05-15 09:08:22', 3, 1, 1, '480px-Oenanthe_leucura_Martien_Brand (1).jpg'),
(80, 'Le Bouscarle de Cetti', 'La bouscarle de Cetti est de taille moyenne pour sa famille, mesurant 12,5 à 14 cm de long. Elle présente un plumage brun roux foncé uniforme sur le dessus et blanc terne sur le dessous, teinté de brun grisâtre sur les côtés de la gorge et de la poitrine. Sa queue est assez longue et ses ailes rondes et courtes. Elle possède un étroit sourcil pâle peu marqué et des cercles oculaires pâles. Remuante, elle agite la queue et les ailes et circule souvent la queue levée. Les deux sexes et les jeunes sont semblables en tout point, à noter cependant une teinte brunâtre légèrement plus prononcée chez le mâle, et une taille sensiblement plus élevée pour le mâle2.', '2023-05-15 09:15:18', 3, 1, 0, '37-090505-cettis-warbler-at-Kalloni-east-river.jpg'),
(81, 'L\'Alouette lulu', 'L\'alouette lulu est plutôt petite, à courte queue. À titre de comparaison, elle est moins grande que l\'Alouette des champs. L\'Alouette lulu mesure 14 à 15 cm de longueur pour une envergure de 24 à 30 cm et une masse de 26 à 35 g1. Son plumage strié est brun dans l\'ensemble, les yeux sont soulignés de sourcils blancs se joignant à la nuque. Sa poitrine blanchâtre est piquetée de noir et ses joues sont brun-roux.\r\n\r\nLes deux sexes sont indistingables, et les juvéniles présentent des dessus aux bords pâles ; leur poitrine est plutôt sombre diffus2.\r\n\r\nElle peut être distinguée des autres alouettes par sa présence dans des habitats plus boisés, et par sa queue assez courte, ainsi que le schéma \"clair-sombre-clair\" au bas de l\'aile2.', '2023-05-15 09:17:22', 3, 1, 0, 'Woodlark57.jpg'),
(82, 'Le Loriot d\'Europe', 'La parure du mâle, d’un jaune d’or éclatant, avec des ailes et une queue noires, est assez atypique des oiseaux européens et lui donne de ce fait l’aspect d’une espèce exotique. Le nom latin du loriot, oriolus, évoque la couleur jaune d\'or de son plumage.\r\n\r\nLe plumage de la femelle apparaît plus sobre : dos vert-olive et jaunâtre et ventre clair légèrement tacheté. Les jeunes revêtent un plumage terne de couleur brunâtre ou beige.\r\n\r\nSon vol entre les arbres est rapide et ondulé. Il pratique aussi occasionnellement un vol stationnaire lorsqu’il chasse.', '2023-05-15 09:17:58', 3, 1, 0, 'Oriolus_oriolus_Ayodar_1.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CreationTimestamp` (`CreationTimestamp`),
  ADD KEY `Post_Id` (`Post_Id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Title` (`Title`),
  ADD KEY `CreationTimestamp` (`CreationTimestamp`),
  ADD KEY `Author_Id` (`Author_Id`),
  ADD KEY `Category_Id` (`Category_Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `author`
--
ALTER TABLE `author`
  MODIFY `Id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `Id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `Id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `Id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`Post_Id`) REFERENCES `post` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `Post_ibfk_1` FOREIGN KEY (`Author_Id`) REFERENCES `author` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Post_ibfk_2` FOREIGN KEY (`Category_Id`) REFERENCES `category` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
