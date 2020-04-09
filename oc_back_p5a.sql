-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 24 Avril 2018 à 16:46
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `oc_back_p5`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `published` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid` tinyint(1) DEFAULT NULL,
  `id_Post` int(11) NOT NULL,
  `id_User` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `content`, `published`, `valid`, `id_Post`, `id_User`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:18', 1, 2, 1),
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:34', 1, 2, 1),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:42', 1, 2, 1),
(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:44', 1, 2, 1),
(5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:45', 1, 2, 1),
(6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:45', 1, 2, 1),
(7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:46', 1, 2, 1),
(8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:47', 1, 2, 1),
(9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:48', 1, 2, 1),
(10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:48', 1, 2, 1),
(11, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:50', 1, 2, 1),
(12, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:51', 1, 2, 1),
(13, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:55', 1, 2, 1),
(14, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:55', 1, 2, 1),
(15, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:55', 1, 2, 1),
(16, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:55', 1, 2, 1),
(17, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:56', 1, 2, 1),
(18, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:56', 1, 2, 1),
(19, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:56', 1, 2, 1),
(20, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:49:02', 1, 2, 1),
(21, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:49:03', 1, 2, 1),
(22, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a.', '2018-04-17 16:48:18', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `label` varchar(25) NOT NULL,
  `id_Post` int(11) DEFAULT NULL,
  `id_User` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `label`, `id_Post`, `id_User`) VALUES
(1, 'MalronWall', NULL, 1),
(2, 'premier', 1, NULL),
(3, 'deuxieme', 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `slug` varchar(25) NOT NULL,
  `chapo` tinytext,
  `content` text NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_User` int(11) NOT NULL,
  `id_Image` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`id`, `title`, `slug`, `chapo`, `content`, `lastUpdate`, `id_User`, `id_Image`) VALUES
(1, 'Premier', 'premier', 'Yeeees !! On a fini premier !!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a. Praesent quis ultrices arcu, et vulputate mauris. Cras arcu augue, dignissim et aliquet vitae, gravida ut diam. Pellentesque varius ante neque, ut pharetra mi ultrices vitae. Etiam convallis dignissim magna. Quisque venenatis ipsum tempus ipsum molestie eleifend. Aliquam eu purus ornare, mattis leo pretium, ultrices tellus. Curabitur et posuere nisl. Curabitur at erat risus. Nunc eget velit lobortis, hendrerit nunc ac, faucibus erat. Praesent volutpat, quam sed efficitur dictum, purus dui cursus augue, id pellentesque sem lectus nec erat.\n\nDonec non nibh vitae enim ornare vestibulum eget a nunc. Maecenas sagittis tincidunt est, vel ultricies lectus volutpat eget. Sed vitae dolor eleifend, tincidunt sapien nec, tempor lacus. Duis id purus sit amet dolor faucibus tempus. Aenean venenatis nulla ac est semper, ut dictum lacus dignissim. Cras sollicitudin, dolor eget tristique suscipit, quam justo mollis risus, tristique vehicula sapien felis a leo. Etiam finibus pretium eros at suscipit. Pellentesque ex ex, ultrices et pellentesque sit amet, fermentum a sem. In varius velit at tempus cursus. Fusce sit amet ex sapien.\n\nDuis eget ullamcorper risus, tincidunt vestibulum turpis. Curabitur ornare venenatis nulla, ut aliquet massa mattis vitae. Maecenas vel tortor in lectus dictum commodo. Sed eleifend quis metus ut eleifend. Quisque vestibulum ex non diam vestibulum tempor. Nam convallis augue vel mauris vestibulum hendrerit. Nunc pulvinar lacus quis lorem gravida, a tempus sem blandit. Vestibulum non sem enim. Nam at purus commodo, feugiat ipsum in, lobortis ligula. Donec in mauris sit amet velit aliquet faucibus. Ut mi ligula, suscipit sit amet iaculis a, posuere at lacus. Morbi malesuada eros pharetra augue aliquet, id elementum ipsum venenatis. Praesent venenatis fermentum metus vitae dignissim.', '2018-04-15 15:10:09', 1, 2),
(2, 'Deuxième', 'deuxieme', 'Un article avec pleiiiin de commentaire !!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a. Praesent quis ultrices arcu, et vulputate mauris. Cras arcu augue, dignissim et aliquet vitae, gravida ut diam. Pellentesque varius ante neque, ut pharetra mi ultrices vitae. Etiam convallis dignissim magna. Quisque venenatis ipsum tempus ipsum molestie eleifend. Aliquam eu purus ornare, mattis leo pretium, ultrices tellus. Curabitur et posuere nisl. Curabitur at erat risus. Nunc eget velit lobortis, hendrerit nunc ac, faucibus erat. Praesent volutpat, quam sed efficitur dictum, purus dui cursus augue, id pellentesque sem lectus nec erat.\r\n\r\nDonec non nibh vitae enim ornare vestibulum eget a nunc. Maecenas sagittis tincidunt est, vel ultricies lectus volutpat eget. Sed vitae dolor eleifend, tincidunt sapien nec, tempor lacus. Duis id purus sit amet dolor faucibus tempus. Aenean venenatis nulla ac est semper, ut dictum lacus dignissim. Cras sollicitudin, dolor eget tristique suscipit, quam justo mollis risus, tristique vehicula sapien felis a leo. Etiam finibus pretium eros at suscipit. Pellentesque ex ex, ultrices et pellentesque sit amet, fermentum a sem. In varius velit at tempus cursus. Fusce sit amet ex sapien.\r\n\r\nDuis eget ullamcorper risus, tincidunt vestibulum turpis. Curabitur ornare venenatis nulla, ut aliquet massa mattis vitae. Maecenas vel tortor in lectus dictum commodo. Sed eleifend quis metus ut eleifend. Quisque vestibulum ex non diam vestibulum tempor. Nam convallis augue vel mauris vestibulum hendrerit. Nunc pulvinar lacus quis lorem gravida, a tempus sem blandit. Vestibulum non sem enim. Nam at purus commodo, feugiat ipsum in, lobortis ligula. Donec in mauris sit amet velit aliquet faucibus. Ut mi ligula, suscipit sit amet iaculis a, posuere at lacus. Morbi malesuada eros pharetra augue aliquet, id elementum ipsum venenatis. Praesent venenatis fermentum metus vitae dignissim.', '2018-04-15 15:10:09', 1, 3),
(3, 'Troisième', 'troisieme-slug', 'Juste un test pour voir si ça fonctionne !', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a. Praesent quis ultrices arcu, et vulputate mauris. Cras arcu augue, dignissim et aliquet vitae, gravida ut diam. Pellentesque varius ante neque, ut pharetra mi ultrices vitae. Etiam convallis dignissim magna. Quisque venenatis ipsum tempus ipsum molestie eleifend. Aliquam eu purus ornare, mattis leo pretium, ultrices tellus. Curabitur et posuere nisl. Curabitur at erat risus. Nunc eget velit lobortis, hendrerit nunc ac, faucibus erat. Praesent volutpat, quam sed efficitur dictum, purus dui cursus augue, id pellentesque sem lectus nec erat.\r\n\r\nDonec non nibh vitae enim ornare vestibulum eget a nunc. Maecenas sagittis tincidunt est, vel ultricies lectus volutpat eget. Sed vitae dolor eleifend, tincidunt sapien nec, tempor lacus. Duis id purus sit amet dolor faucibus tempus. Aenean venenatis nulla ac est semper, ut dictum lacus dignissim. Cras sollicitudin, dolor eget tristique suscipit, quam justo mollis risus, tristique vehicula sapien felis a leo. Etiam finibus pretium eros at suscipit. Pellentesque ex ex, ultrices et pellentesque sit amet, fermentum a sem. In varius velit at tempus cursus. Fusce sit amet ex sapien.\r\n\r\nDuis eget ullamcorper risus, tincidunt vestibulum turpis. Curabitur ornare venenatis nulla, ut aliquet massa mattis vitae. Maecenas vel tortor in lectus dictum commodo. Sed eleifend quis metus ut eleifend. Quisque vestibulum ex non diam vestibulum tempor. Nam convallis augue vel mauris vestibulum hendrerit. Nunc pulvinar lacus quis lorem gravida, a tempus sem blandit. Vestibulum non sem enim. Nam at purus commodo, feugiat ipsum in, lobortis ligula. Donec in mauris sit amet velit aliquet faucibus. Ut mi ligula, suscipit sit amet iaculis a, posuere at lacus. Morbi malesuada eros pharetra augue aliquet, id elementum ipsum venenatis. Praesent venenatis fermentum metus vitae dignissim.', '2018-04-15 15:10:09', 1, NULL),
(4, 'Quatrième', 'quatrieme-slug', 'Juste un test pour voir si ça fonctionne !', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a. Praesent quis ultrices arcu, et vulputate mauris. Cras arcu augue, dignissim et aliquet vitae, gravida ut diam. Pellentesque varius ante neque, ut pharetra mi ultrices vitae. Etiam convallis dignissim magna. Quisque venenatis ipsum tempus ipsum molestie eleifend. Aliquam eu purus ornare, mattis leo pretium, ultrices tellus. Curabitur et posuere nisl. Curabitur at erat risus. Nunc eget velit lobortis, hendrerit nunc ac, faucibus erat. Praesent volutpat, quam sed efficitur dictum, purus dui cursus augue, id pellentesque sem lectus nec erat.\r\n\r\nDonec non nibh vitae enim ornare vestibulum eget a nunc. Maecenas sagittis tincidunt est, vel ultricies lectus volutpat eget. Sed vitae dolor eleifend, tincidunt sapien nec, tempor lacus. Duis id purus sit amet dolor faucibus tempus. Aenean venenatis nulla ac est semper, ut dictum lacus dignissim. Cras sollicitudin, dolor eget tristique suscipit, quam justo mollis risus, tristique vehicula sapien felis a leo. Etiam finibus pretium eros at suscipit. Pellentesque ex ex, ultrices et pellentesque sit amet, fermentum a sem. In varius velit at tempus cursus. Fusce sit amet ex sapien.\r\n\r\nDuis eget ullamcorper risus, tincidunt vestibulum turpis. Curabitur ornare venenatis nulla, ut aliquet massa mattis vitae. Maecenas vel tortor in lectus dictum commodo. Sed eleifend quis metus ut eleifend. Quisque vestibulum ex non diam vestibulum tempor. Nam convallis augue vel mauris vestibulum hendrerit. Nunc pulvinar lacus quis lorem gravida, a tempus sem blandit. Vestibulum non sem enim. Nam at purus commodo, feugiat ipsum in, lobortis ligula. Donec in mauris sit amet velit aliquet faucibus. Ut mi ligula, suscipit sit amet iaculis a, posuere at lacus. Morbi malesuada eros pharetra augue aliquet, id elementum ipsum venenatis. Praesent venenatis fermentum metus vitae dignissim.', '2018-04-15 15:10:09', 1, NULL),
(5, 'Cinquième', 'cinquieme-slug', 'Juste un test pour voir si ça fonctionne !', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a. Praesent quis ultrices arcu, et vulputate mauris. Cras arcu augue, dignissim et aliquet vitae, gravida ut diam. Pellentesque varius ante neque, ut pharetra mi ultrices vitae. Etiam convallis dignissim magna. Quisque venenatis ipsum tempus ipsum molestie eleifend. Aliquam eu purus ornare, mattis leo pretium, ultrices tellus. Curabitur et posuere nisl. Curabitur at erat risus. Nunc eget velit lobortis, hendrerit nunc ac, faucibus erat. Praesent volutpat, quam sed efficitur dictum, purus dui cursus augue, id pellentesque sem lectus nec erat.\r\n\r\nDonec non nibh vitae enim ornare vestibulum eget a nunc. Maecenas sagittis tincidunt est, vel ultricies lectus volutpat eget. Sed vitae dolor eleifend, tincidunt sapien nec, tempor lacus. Duis id purus sit amet dolor faucibus tempus. Aenean venenatis nulla ac est semper, ut dictum lacus dignissim. Cras sollicitudin, dolor eget tristique suscipit, quam justo mollis risus, tristique vehicula sapien felis a leo. Etiam finibus pretium eros at suscipit. Pellentesque ex ex, ultrices et pellentesque sit amet, fermentum a sem. In varius velit at tempus cursus. Fusce sit amet ex sapien.\r\n\r\nDuis eget ullamcorper risus, tincidunt vestibulum turpis. Curabitur ornare venenatis nulla, ut aliquet massa mattis vitae. Maecenas vel tortor in lectus dictum commodo. Sed eleifend quis metus ut eleifend. Quisque vestibulum ex non diam vestibulum tempor. Nam convallis augue vel mauris vestibulum hendrerit. Nunc pulvinar lacus quis lorem gravida, a tempus sem blandit. Vestibulum non sem enim. Nam at purus commodo, feugiat ipsum in, lobortis ligula. Donec in mauris sit amet velit aliquet faucibus. Ut mi ligula, suscipit sit amet iaculis a, posuere at lacus. Morbi malesuada eros pharetra augue aliquet, id elementum ipsum venenatis. Praesent venenatis fermentum metus vitae dignissim.', '2018-04-15 15:10:09', 1, NULL),
(6, 'Sixième', 'sixieme-slug', 'Juste un test pour voir si ça fonctionne !', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a. Praesent quis ultrices arcu, et vulputate mauris. Cras arcu augue, dignissim et aliquet vitae, gravida ut diam. Pellentesque varius ante neque, ut pharetra mi ultrices vitae. Etiam convallis dignissim magna. Quisque venenatis ipsum tempus ipsum molestie eleifend. Aliquam eu purus ornare, mattis leo pretium, ultrices tellus. Curabitur et posuere nisl. Curabitur at erat risus. Nunc eget velit lobortis, hendrerit nunc ac, faucibus erat. Praesent volutpat, quam sed efficitur dictum, purus dui cursus augue, id pellentesque sem lectus nec erat.\r\n\r\nDonec non nibh vitae enim ornare vestibulum eget a nunc. Maecenas sagittis tincidunt est, vel ultricies lectus volutpat eget. Sed vitae dolor eleifend, tincidunt sapien nec, tempor lacus. Duis id purus sit amet dolor faucibus tempus. Aenean venenatis nulla ac est semper, ut dictum lacus dignissim. Cras sollicitudin, dolor eget tristique suscipit, quam justo mollis risus, tristique vehicula sapien felis a leo. Etiam finibus pretium eros at suscipit. Pellentesque ex ex, ultrices et pellentesque sit amet, fermentum a sem. In varius velit at tempus cursus. Fusce sit amet ex sapien.\r\n\r\nDuis eget ullamcorper risus, tincidunt vestibulum turpis. Curabitur ornare venenatis nulla, ut aliquet massa mattis vitae. Maecenas vel tortor in lectus dictum commodo. Sed eleifend quis metus ut eleifend. Quisque vestibulum ex non diam vestibulum tempor. Nam convallis augue vel mauris vestibulum hendrerit. Nunc pulvinar lacus quis lorem gravida, a tempus sem blandit. Vestibulum non sem enim. Nam at purus commodo, feugiat ipsum in, lobortis ligula. Donec in mauris sit amet velit aliquet faucibus. Ut mi ligula, suscipit sit amet iaculis a, posuere at lacus. Morbi malesuada eros pharetra augue aliquet, id elementum ipsum venenatis. Praesent venenatis fermentum metus vitae dignissim.', '2018-04-15 15:10:09', 1, NULL),
(7, 'Septième', 'septieme-slug', 'Juste un test pour voir si ça fonctionne !', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a. Praesent quis ultrices arcu, et vulputate mauris. Cras arcu augue, dignissim et aliquet vitae, gravida ut diam. Pellentesque varius ante neque, ut pharetra mi ultrices vitae. Etiam convallis dignissim magna. Quisque venenatis ipsum tempus ipsum molestie eleifend. Aliquam eu purus ornare, mattis leo pretium, ultrices tellus. Curabitur et posuere nisl. Curabitur at erat risus. Nunc eget velit lobortis, hendrerit nunc ac, faucibus erat. Praesent volutpat, quam sed efficitur dictum, purus dui cursus augue, id pellentesque sem lectus nec erat.\r\n\r\nDonec non nibh vitae enim ornare vestibulum eget a nunc. Maecenas sagittis tincidunt est, vel ultricies lectus volutpat eget. Sed vitae dolor eleifend, tincidunt sapien nec, tempor lacus. Duis id purus sit amet dolor faucibus tempus. Aenean venenatis nulla ac est semper, ut dictum lacus dignissim. Cras sollicitudin, dolor eget tristique suscipit, quam justo mollis risus, tristique vehicula sapien felis a leo. Etiam finibus pretium eros at suscipit. Pellentesque ex ex, ultrices et pellentesque sit amet, fermentum a sem. In varius velit at tempus cursus. Fusce sit amet ex sapien.\r\n\r\nDuis eget ullamcorper risus, tincidunt vestibulum turpis. Curabitur ornare venenatis nulla, ut aliquet massa mattis vitae. Maecenas vel tortor in lectus dictum commodo. Sed eleifend quis metus ut eleifend. Quisque vestibulum ex non diam vestibulum tempor. Nam convallis augue vel mauris vestibulum hendrerit. Nunc pulvinar lacus quis lorem gravida, a tempus sem blandit. Vestibulum non sem enim. Nam at purus commodo, feugiat ipsum in, lobortis ligula. Donec in mauris sit amet velit aliquet faucibus. Ut mi ligula, suscipit sit amet iaculis a, posuere at lacus. Morbi malesuada eros pharetra augue aliquet, id elementum ipsum venenatis. Praesent venenatis fermentum metus vitae dignissim.', '2018-04-15 15:10:09', 1, NULL),
(8, 'Huitième', 'huitieme-slug', 'Juste un test pour voir si ça fonctionne !', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a. Praesent quis ultrices arcu, et vulputate mauris. Cras arcu augue, dignissim et aliquet vitae, gravida ut diam. Pellentesque varius ante neque, ut pharetra mi ultrices vitae. Etiam convallis dignissim magna. Quisque venenatis ipsum tempus ipsum molestie eleifend. Aliquam eu purus ornare, mattis leo pretium, ultrices tellus. Curabitur et posuere nisl. Curabitur at erat risus. Nunc eget velit lobortis, hendrerit nunc ac, faucibus erat. Praesent volutpat, quam sed efficitur dictum, purus dui cursus augue, id pellentesque sem lectus nec erat.\r\n\r\nDonec non nibh vitae enim ornare vestibulum eget a nunc. Maecenas sagittis tincidunt est, vel ultricies lectus volutpat eget. Sed vitae dolor eleifend, tincidunt sapien nec, tempor lacus. Duis id purus sit amet dolor faucibus tempus. Aenean venenatis nulla ac est semper, ut dictum lacus dignissim. Cras sollicitudin, dolor eget tristique suscipit, quam justo mollis risus, tristique vehicula sapien felis a leo. Etiam finibus pretium eros at suscipit. Pellentesque ex ex, ultrices et pellentesque sit amet, fermentum a sem. In varius velit at tempus cursus. Fusce sit amet ex sapien.\r\n\r\nDuis eget ullamcorper risus, tincidunt vestibulum turpis. Curabitur ornare venenatis nulla, ut aliquet massa mattis vitae. Maecenas vel tortor in lectus dictum commodo. Sed eleifend quis metus ut eleifend. Quisque vestibulum ex non diam vestibulum tempor. Nam convallis augue vel mauris vestibulum hendrerit. Nunc pulvinar lacus quis lorem gravida, a tempus sem blandit. Vestibulum non sem enim. Nam at purus commodo, feugiat ipsum in, lobortis ligula. Donec in mauris sit amet velit aliquet faucibus. Ut mi ligula, suscipit sit amet iaculis a, posuere at lacus. Morbi malesuada eros pharetra augue aliquet, id elementum ipsum venenatis. Praesent venenatis fermentum metus vitae dignissim.', '2018-04-15 15:10:09', 1, NULL),
(9, 'Neuvième', 'neuvieme-slug', 'Juste un test pour voir si ça fonctionne !', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a. Praesent quis ultrices arcu, et vulputate mauris. Cras arcu augue, dignissim et aliquet vitae, gravida ut diam. Pellentesque varius ante neque, ut pharetra mi ultrices vitae. Etiam convallis dignissim magna. Quisque venenatis ipsum tempus ipsum molestie eleifend. Aliquam eu purus ornare, mattis leo pretium, ultrices tellus. Curabitur et posuere nisl. Curabitur at erat risus. Nunc eget velit lobortis, hendrerit nunc ac, faucibus erat. Praesent volutpat, quam sed efficitur dictum, purus dui cursus augue, id pellentesque sem lectus nec erat.\r\n\r\nDonec non nibh vitae enim ornare vestibulum eget a nunc. Maecenas sagittis tincidunt est, vel ultricies lectus volutpat eget. Sed vitae dolor eleifend, tincidunt sapien nec, tempor lacus. Duis id purus sit amet dolor faucibus tempus. Aenean venenatis nulla ac est semper, ut dictum lacus dignissim. Cras sollicitudin, dolor eget tristique suscipit, quam justo mollis risus, tristique vehicula sapien felis a leo. Etiam finibus pretium eros at suscipit. Pellentesque ex ex, ultrices et pellentesque sit amet, fermentum a sem. In varius velit at tempus cursus. Fusce sit amet ex sapien.\r\n\r\nDuis eget ullamcorper risus, tincidunt vestibulum turpis. Curabitur ornare venenatis nulla, ut aliquet massa mattis vitae. Maecenas vel tortor in lectus dictum commodo. Sed eleifend quis metus ut eleifend. Quisque vestibulum ex non diam vestibulum tempor. Nam convallis augue vel mauris vestibulum hendrerit. Nunc pulvinar lacus quis lorem gravida, a tempus sem blandit. Vestibulum non sem enim. Nam at purus commodo, feugiat ipsum in, lobortis ligula. Donec in mauris sit amet velit aliquet faucibus. Ut mi ligula, suscipit sit amet iaculis a, posuere at lacus. Morbi malesuada eros pharetra augue aliquet, id elementum ipsum venenatis. Praesent venenatis fermentum metus vitae dignissim.', '2018-04-15 15:10:09', 1, NULL),
(10, 'Dixième', 'dixieme-slug', 'Juste un test pour voir si ça fonctionne !', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a. Praesent quis ultrices arcu, et vulputate mauris. Cras arcu augue, dignissim et aliquet vitae, gravida ut diam. Pellentesque varius ante neque, ut pharetra mi ultrices vitae. Etiam convallis dignissim magna. Quisque venenatis ipsum tempus ipsum molestie eleifend. Aliquam eu purus ornare, mattis leo pretium, ultrices tellus. Curabitur et posuere nisl. Curabitur at erat risus. Nunc eget velit lobortis, hendrerit nunc ac, faucibus erat. Praesent volutpat, quam sed efficitur dictum, purus dui cursus augue, id pellentesque sem lectus nec erat.\r\n\r\nDonec non nibh vitae enim ornare vestibulum eget a nunc. Maecenas sagittis tincidunt est, vel ultricies lectus volutpat eget. Sed vitae dolor eleifend, tincidunt sapien nec, tempor lacus. Duis id purus sit amet dolor faucibus tempus. Aenean venenatis nulla ac est semper, ut dictum lacus dignissim. Cras sollicitudin, dolor eget tristique suscipit, quam justo mollis risus, tristique vehicula sapien felis a leo. Etiam finibus pretium eros at suscipit. Pellentesque ex ex, ultrices et pellentesque sit amet, fermentum a sem. In varius velit at tempus cursus. Fusce sit amet ex sapien.\r\n\r\nDuis eget ullamcorper risus, tincidunt vestibulum turpis. Curabitur ornare venenatis nulla, ut aliquet massa mattis vitae. Maecenas vel tortor in lectus dictum commodo. Sed eleifend quis metus ut eleifend. Quisque vestibulum ex non diam vestibulum tempor. Nam convallis augue vel mauris vestibulum hendrerit. Nunc pulvinar lacus quis lorem gravida, a tempus sem blandit. Vestibulum non sem enim. Nam at purus commodo, feugiat ipsum in, lobortis ligula. Donec in mauris sit amet velit aliquet faucibus. Ut mi ligula, suscipit sit amet iaculis a, posuere at lacus. Morbi malesuada eros pharetra augue aliquet, id elementum ipsum venenatis. Praesent venenatis fermentum metus vitae dignissim.', '2018-04-15 15:10:09', 1, NULL),
(11, 'Onzième', 'onzieme-slug', 'Juste un test pour voir si ça fonctionne !', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ante ut turpis porta, quis hendrerit leo pretium. Duis varius lacus ac gravida pharetra. Nulla interdum, nisi sit amet mollis varius, massa massa tincidunt justo, ut commodo eros ipsum id libero. Vivamus ullamcorper tempus lacus, ac euismod sapien placerat a. Praesent quis ultrices arcu, et vulputate mauris. Cras arcu augue, dignissim et aliquet vitae, gravida ut diam. Pellentesque varius ante neque, ut pharetra mi ultrices vitae. Etiam convallis dignissim magna. Quisque venenatis ipsum tempus ipsum molestie eleifend. Aliquam eu purus ornare, mattis leo pretium, ultrices tellus. Curabitur et posuere nisl. Curabitur at erat risus. Nunc eget velit lobortis, hendrerit nunc ac, faucibus erat. Praesent volutpat, quam sed efficitur dictum, purus dui cursus augue, id pellentesque sem lectus nec erat.\r\n\r\nDonec non nibh vitae enim ornare vestibulum eget a nunc. Maecenas sagittis tincidunt est, vel ultricies lectus volutpat eget. Sed vitae dolor eleifend, tincidunt sapien nec, tempor lacus. Duis id purus sit amet dolor faucibus tempus. Aenean venenatis nulla ac est semper, ut dictum lacus dignissim. Cras sollicitudin, dolor eget tristique suscipit, quam justo mollis risus, tristique vehicula sapien felis a leo. Etiam finibus pretium eros at suscipit. Pellentesque ex ex, ultrices et pellentesque sit amet, fermentum a sem. In varius velit at tempus cursus. Fusce sit amet ex sapien.\r\n\r\nDuis eget ullamcorper risus, tincidunt vestibulum turpis. Curabitur ornare venenatis nulla, ut aliquet massa mattis vitae. Maecenas vel tortor in lectus dictum commodo. Sed eleifend quis metus ut eleifend. Quisque vestibulum ex non diam vestibulum tempor. Nam convallis augue vel mauris vestibulum hendrerit. Nunc pulvinar lacus quis lorem gravida, a tempus sem blandit. Vestibulum non sem enim. Nam at purus commodo, feugiat ipsum in, lobortis ligula. Donec in mauris sit amet velit aliquet faucibus. Ut mi ligula, suscipit sit amet iaculis a, posuere at lacus. Morbi malesuada eros pharetra augue aliquet, id elementum ipsum venenatis. Praesent venenatis fermentum metus vitae dignissim.', '2018-04-15 15:10:09', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Super-administrateur'),
(2, 'Administrateur'),
(3, 'Inscrit');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(32) DEFAULT NULL,
  `id_Image` int(11) DEFAULT NULL,
  `id_Role` int(11) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `name`, `firstname`, `email`, `password`, `blocked`, `token`, `id_Image`, `id_Role`) VALUES
(1, 'MalronWall', 'Tourte', 'Thibaut', 'thibaut.tourte17@gmail.com', 'be571287a5832f9956ba392d2379c811', 0, NULL, 1, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Comment_id_Post` (`id_Post`),
  ADD KEY `FK_Comment_id_User` (`id_User`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Image_id_Post` (`id_Post`),
  ADD KEY `FK_Image_id_User` (`id_User`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `FK_Post_id_User` (`id_User`),
  ADD KEY `FK_Post_id_Image` (`id_Image`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_User_id_Image` (`id_Image`),
  ADD KEY `FK_User_id_Role` (`id_Role`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_Comment_id_Post` FOREIGN KEY (`id_Post`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_Comment_id_User` FOREIGN KEY (`id_User`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_Image_id_Post` FOREIGN KEY (`id_Post`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_Image_id_User` FOREIGN KEY (`id_User`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_Post_id_Image` FOREIGN KEY (`id_Image`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `FK_Post_id_User` FOREIGN KEY (`id_User`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_User_id_Image` FOREIGN KEY (`id_Image`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `FK_User_id_Role` FOREIGN KEY (`id_Role`) REFERENCES `role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
