-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Client :  db735531723.db.1and1.com
-- Généré le :  Mer 20 Juin 2018 à 05:28
-- Version du serveur :  5.5.60-0+deb7u1-log
-- Version de PHP :  5.4.45-0+deb7u14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `db735531723`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `published` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid` tinyint(1) DEFAULT '0',
  `id_Post` int(11) NOT NULL,
  `id_User` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Comment_id_Post` (`id_Post`),
  KEY `FK_Comment_id_User` (`id_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=33 ;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `content`, `published`, `valid`, `id_Post`, `id_User`) VALUES
(24, 'Ceci est mon premier article alors soyez sympa ! ;)', '2018-06-20 00:03:17', 1, 11, 1),
(25, 'T''en fait pas ! Nous aussi on est nouveau ! ;)', '2018-06-20 00:56:24', 1, 11, 18),
(26, 'De toute façon c''est toi qui nous a créé alors on est obligé de faire ce que tu nous dit ! ^^', '2018-06-20 00:57:15', 1, 11, 17),
(27, '2 toute fason t qu1 konar !! Tu 2 vré m pa existé toa et ton site de merde !!', '2018-06-20 01:03:01', 0, 11, 19),
(29, 'An + il ser a ri1 ton site pov tache !', '2018-06-20 01:04:47', 0, 11, 19),
(30, 'Je trouve ton article très cohérent ! Par contre est-ce que tu pourrais citer tes sources s''il te plaît la prochaine fois ? :)', '2018-06-20 01:06:29', 1, 12, 18),
(31, 'Pas de souci ! C''est modifié ! Merci du conseil ! ;)', '2018-06-20 01:06:55', 1, 12, 1),
(32, 'Avec plaisir ! ^^', '2018-06-20 01:07:09', 1, 12, 18);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_Post` int(11) DEFAULT NULL,
  `id_User` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Image_id_Post` (`id_Post`),
  KEY `FK_Image_id_User` (`id_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `id_Post`, `id_User`) VALUES
(1, NULL, 1),
(6, 11, NULL),
(7, 12, NULL),
(8, 13, NULL),
(9, NULL, 16),
(10, NULL, 17),
(11, NULL, 18);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `chapo` varchar(100) DEFAULT NULL,
  `content` text NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_User` int(11) NOT NULL,
  `id_Image` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  UNIQUE KEY `slug` (`slug`),
  KEY `FK_Post_id_User` (`id_User`),
  KEY `FK_Post_id_Image` (`id_Image`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`id`, `title`, `slug`, `chapo`, `content`, `lastUpdate`, `id_User`, `id_Image`) VALUES
(11, 'Mon premier article !', 'mon-premier-article-!', 'Le chapo permet d''expliquer un peu mieux le titre !', '<p style="text-align: center; background: white; margin: 0cm 0cm 11.25pt 0cm;" align="center"><strong style="mso-bidi-font-weight: normal;"><u><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: red; mso-ansi-language: EN-US;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span></u></strong></p>\r\n<p style="text-align: justify; background: white; margin: 0cm 0cm 11.25pt 0cm;"><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Ut at metus pharetra, suscipit lectus at, varius risus. Pellentesque in venenatis ligula.</span></p>\r\n<p style="text-align: justify; text-indent: -18.0pt; mso-list: l0 level1 lfo1; background: white; margin: 0cm 0cm 11.25pt 36.0pt;"><!-- [if !supportLists]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; mso-fareast-font-family: Arial; color: black;"><span style="mso-list: Ignore;">-<span style="font: 7.0pt ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Pellentesque massa diam, mollis auctor mattis in, fermentum non est.</span></p>\r\n<p style="text-align: justify; text-indent: -18.0pt; mso-list: l0 level1 lfo1; background: white; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px; margin: 0cm 0cm 11.25pt 36.0pt;"><!-- [if !supportLists]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; mso-fareast-font-family: Arial; color: black;"><span style="mso-list: Ignore;">-<span style="font: 7.0pt ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Cras laoreet vel quam et tincidunt.</span></p>\r\n<p style="text-align: justify; text-indent: -18.0pt; mso-list: l0 level1 lfo1; background: white; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px; margin: 0cm 0cm 11.25pt 36.0pt;"><!-- [if !supportLists]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; mso-fareast-font-family: Arial; color: black;"><span style="mso-list: Ignore;">-<span style="font: 7.0pt ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Vivamus placerat elementum lectus, vel porttitor erat fringilla in.</span></p>\r\n<p style="text-align: justify; text-indent: 18.0pt; background: white; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px; margin: 0cm 0cm 11.25pt 0cm;"><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Cras eget dolor mollis dolor tincidunt pellentesque. Donec semper, nisi sit amet pulvinar laoreet, nibh diam placerat sem, </span><em style="mso-bidi-font-style: normal;"><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: red; background: yellow; mso-highlight: yellow;">sit amet consectetur eros arcu eget urna</span></em><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">. In interdum neque lorem, quis pretium purus pharetra non. Vestibulum id blandit elit. Integer mauris neque, pulvinar id sagittis ut, lobortis a erat. Morbi mauris massa, consequat at iaculis sit amet, blandit ac dolor. Cras ligula leo, egestas quis rutrum et, laoreet nec neque.</span></p>\r\n<p style="text-align: right; text-indent: 18.0pt; background: white; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px; margin: 0cm 0cm 11.25pt 0cm;" align="right"><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">In sed enim iaculis, iaculis dolor quis, molestie leo. Quisque ut nunc nec eros mattis molestie sit amet ut neque. Phasellus lobortis faucibus pellentesque.</span></p>\r\n<p style="text-align: right; text-indent: 18.0pt; background: white; margin: 0cm 0cm 11.25pt 0cm;" align="right"><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Pellentesque blandit sodales nulla, eget sodales massa accumsan at. In non eros ac nisl feugiat interdum non a justo. Integer laoreet vestibulum orci, elementum tristique risus vestibulum in. Suspendisse fermentum enim turpis, quis malesuada mauris eleifend in. Aliquam erat volutpat. Aliquam erat volutpat.</span></p>\r\n<p class="MsoNormal" style="margin-bottom: .0001pt; line-height: normal; tab-stops: 45.8pt 91.6pt 137.4pt 183.2pt 229.0pt 274.8pt 320.6pt 366.4pt 412.2pt 458.0pt 503.8pt 549.6pt 595.4pt 641.2pt 687.0pt 732.8pt; background: #272822;"><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&lt;</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">div </span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #e2b23f; mso-ansi-language: EN-US; mso-fareast-language: FR;">class=</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #6de652; mso-ansi-language: EN-US; mso-fareast-language: FR;">"col-sm-12"</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;<br /><span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp; </span>&lt;</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">div </span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #e2b23f; mso-ansi-language: EN-US; mso-fareast-language: FR;">class=</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #6de652; mso-ansi-language: EN-US; mso-fareast-language: FR;">"alert alert-info col-sm-12 text-center mb-0" </span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #e2b23f; mso-ansi-language: EN-US; mso-fareast-language: FR;">role=</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #6de652; mso-ansi-language: EN-US; mso-fareast-language: FR;">"alert"</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;<br /><span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>&lt;</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">strong</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;<strong>Lorem ipsum dolor sit amet !</strong>&lt;/</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">strong</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;<br /><span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp; </span>&lt;/</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">div</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;<br />&lt;/</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">div</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;</span></p>', '2018-06-20 00:02:23', 1, 6),
(12, 'Un petit deuxième !', 'un-petit-deuxieme-!', NULL, '<p style="text-align: center; background: white; margin: 0cm 0cm 11.25pt 0cm;" align="center"><strong style="mso-bidi-font-weight: normal;"><u><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: red; mso-ansi-language: EN-US;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span></u></strong></p>\r\n<p style="text-align: justify; background: white; margin: 0cm 0cm 11.25pt 0cm;"><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Ut at metus pharetra, suscipit lectus at, varius risus. Pellentesque in venenatis ligula.</span></p>\r\n<p style="text-align: justify; text-indent: -18.0pt; mso-list: l0 level1 lfo1; background: white; margin: 0cm 0cm 11.25pt 36.0pt;"><!-- [if !supportLists]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; mso-fareast-font-family: Arial; color: black;"><span style="mso-list: Ignore;">-<span style="font: 7.0pt ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Pellentesque massa diam, mollis auctor mattis in, fermentum non est.</span></p>\r\n<p style="text-align: justify; text-indent: -18.0pt; mso-list: l0 level1 lfo1; background: white; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px; margin: 0cm 0cm 11.25pt 36.0pt;"><!-- [if !supportLists]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; mso-fareast-font-family: Arial; color: black;"><span style="mso-list: Ignore;">-<span style="font: 7.0pt ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Cras laoreet vel quam et tincidunt.</span></p>\r\n<p style="text-align: justify; text-indent: -18.0pt; mso-list: l0 level1 lfo1; background: white; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px; margin: 0cm 0cm 11.25pt 36.0pt;"><!-- [if !supportLists]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; mso-fareast-font-family: Arial; color: black;"><span style="mso-list: Ignore;">-<span style="font: 7.0pt ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Vivamus placerat elementum lectus, vel porttitor erat fringilla in.</span></p>\r\n<p style="text-align: justify; text-indent: 18.0pt; background: white; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px; margin: 0cm 0cm 11.25pt 0cm;"><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Cras eget dolor mollis dolor tincidunt pellentesque. Donec semper, nisi sit amet pulvinar laoreet, nibh diam placerat sem, </span><em style="mso-bidi-font-style: normal;"><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: red; background: yellow; mso-highlight: yellow;">sit amet consectetur eros arcu eget urna</span></em><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">. In interdum neque lorem, quis pretium purus pharetra non. Vestibulum id blandit elit. Integer mauris neque, pulvinar id sagittis ut, lobortis a erat. Morbi mauris massa, consequat at iaculis sit amet, blandit ac dolor. Cras ligula leo, egestas quis rutrum et, laoreet nec neque.</span></p>\r\n<p style="text-align: right; text-indent: 18.0pt; background: white; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px; margin: 0cm 0cm 11.25pt 0cm;" align="right"><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">In sed enim iaculis, iaculis dolor quis, molestie leo. Quisque ut nunc nec eros mattis molestie sit amet ut neque. Phasellus lobortis faucibus pellentesque.</span></p>\r\n<p style="text-align: right; text-indent: 18.0pt; background: white; margin: 0cm 0cm 11.25pt 0cm;" align="right"><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Pellentesque blandit sodales nulla, eget sodales massa accumsan at. In non eros ac nisl feugiat interdum non a justo. Integer laoreet vestibulum orci, elementum tristique risus vestibulum in. Suspendisse fermentum enim turpis, quis malesuada mauris eleifend in. Aliquam erat volutpat. Aliquam erat volutpat.</span></p>\r\n<p class="MsoNormal" style="margin-bottom: .0001pt; line-height: normal; tab-stops: 45.8pt 91.6pt 137.4pt 183.2pt 229.0pt 274.8pt 320.6pt 366.4pt 412.2pt 458.0pt 503.8pt 549.6pt 595.4pt 641.2pt 687.0pt 732.8pt; background: #272822;"><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&lt;</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">div </span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #e2b23f; mso-ansi-language: EN-US; mso-fareast-language: FR;">class=</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #6de652; mso-ansi-language: EN-US; mso-fareast-language: FR;">"col-sm-12"</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;<br /><span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp; </span>&lt;</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">div </span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #e2b23f; mso-ansi-language: EN-US; mso-fareast-language: FR;">class=</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #6de652; mso-ansi-language: EN-US; mso-fareast-language: FR;">"alert alert-info col-sm-12 text-center mb-0" </span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #e2b23f; mso-ansi-language: EN-US; mso-fareast-language: FR;">role=</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #6de652; mso-ansi-language: EN-US; mso-fareast-language: FR;">"alert"</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;<br /><span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>&lt;</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">strong</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;<strong>Lorem ipsum dolor sit amet !</strong>&lt;/</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">strong</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;<br /><span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp; </span>&lt;/</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">div</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;<br />&lt;/</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">div</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;</span></p>', '2018-06-20 00:30:08', 1, 7),
(13, 'Et un petit dernier !!!!', 'et-un-petit-dernier-!!!!', 'L''article précédent n''avait pas de chapô ! Mais cette fois-ci je vais en mettre un assez long !!', '<p style="text-align: center; background: white; margin: 0cm 0cm 11.25pt 0cm;" align="center"><strong style="mso-bidi-font-weight: normal;"><u><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: red; mso-ansi-language: EN-US;">Lorem ipsum dolor sit amet, consectetur adipiscing elit !</span></u></strong></p>\r\n<p style="text-align: justify; background: white; margin: 0cm 0cm 11.25pt 0cm;"><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Ut at metus pharetra, suscipit lectus at, varius risus. Pellentesque in venenatis ligula.</span></p>\r\n<p style="text-align: justify; text-indent: -18.0pt; mso-list: l0 level1 lfo1; background: white; margin: 0cm 0cm 11.25pt 36.0pt;"><!-- [if !supportLists]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; mso-fareast-font-family: Arial; color: black;"><span style="mso-list: Ignore;">-<span style="font: 7.0pt ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Pellentesque massa diam, mollis auctor mattis in, fermentum non est.</span></p>\r\n<p style="text-align: justify; text-indent: -18.0pt; mso-list: l0 level1 lfo1; background: white; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px; margin: 0cm 0cm 11.25pt 36.0pt;"><!-- [if !supportLists]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; mso-fareast-font-family: Arial; color: black;"><span style="mso-list: Ignore;">-<span style="font: 7.0pt ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Cras laoreet vel quam et tincidunt.</span></p>\r\n<p style="text-align: justify; text-indent: -18.0pt; mso-list: l0 level1 lfo1; background: white; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px; margin: 0cm 0cm 11.25pt 36.0pt;"><!-- [if !supportLists]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; mso-fareast-font-family: Arial; color: black;"><span style="mso-list: Ignore;">-<span style="font: 7.0pt ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Vivamus placerat elementum lectus, vel porttitor erat fringilla in.</span></p>\r\n<p style="text-align: justify; text-indent: 18.0pt; background: white; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px; margin: 0cm 0cm 11.25pt 0cm;"><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Cras eget dolor mollis dolor tincidunt pellentesque. Donec semper, nisi sit amet pulvinar laoreet, nibh diam placerat sem, </span><em style="mso-bidi-font-style: normal;"><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: red; background: yellow; mso-highlight: yellow;">sit amet consectetur eros arcu eget urna</span></em><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">. In interdum neque lorem, quis pretium purus pharetra non. Vestibulum id blandit elit. Integer mauris neque, pulvinar id sagittis ut, lobortis a erat. Morbi mauris massa, consequat at iaculis sit amet, blandit ac dolor. Cras ligula leo, egestas quis rutrum et, laoreet nec neque.</span></p>\r\n<p style="text-align: right; text-indent: 18.0pt; background: white; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px; margin: 0cm 0cm 11.25pt 0cm;" align="right"><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">In sed enim iaculis, iaculis dolor quis, molestie leo. Quisque ut nunc nec eros mattis molestie sit amet ut neque. Phasellus lobortis faucibus pellentesque.</span></p>\r\n<p style="text-align: right; text-indent: 18.0pt; background: white; margin: 0cm 0cm 11.25pt 0cm;" align="right"><span style="font-size: 10.5pt; font-family: ''Arial'',sans-serif; color: black;">Pellentesque blandit sodales nulla, eget sodales massa accumsan at. In non eros ac nisl feugiat interdum non a justo. Integer laoreet vestibulum orci, elementum tristique risus vestibulum in. Suspendisse fermentum enim turpis, quis malesuada mauris eleifend in. Aliquam erat volutpat. Aliquam erat volutpat.</span></p>\r\n<p class="MsoNormal" style="margin-bottom: .0001pt; line-height: normal; tab-stops: 45.8pt 91.6pt 137.4pt 183.2pt 229.0pt 274.8pt 320.6pt 366.4pt 412.2pt 458.0pt 503.8pt 549.6pt 595.4pt 641.2pt 687.0pt 732.8pt; background: #272822;"><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&lt;</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">div </span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #e2b23f; mso-ansi-language: EN-US; mso-fareast-language: FR;">class=</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #6de652; mso-ansi-language: EN-US; mso-fareast-language: FR;">"col-sm-12"</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;<br /><span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp; </span>&lt;</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">div </span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #e2b23f; mso-ansi-language: EN-US; mso-fareast-language: FR;">class=</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #6de652; mso-ansi-language: EN-US; mso-fareast-language: FR;">"alert alert-info col-sm-12 text-center mb-0" </span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #e2b23f; mso-ansi-language: EN-US; mso-fareast-language: FR;">role=</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #6de652; mso-ansi-language: EN-US; mso-fareast-language: FR;">"alert"</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;<br /><span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>&lt;</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">strong</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;<strong>Lorem ipsum dolor sit amet !</strong>&lt;/</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">strong</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;<br /><span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp; </span>&lt;/</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">div</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;<br />&lt;/</span><strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #ff4c3f; mso-ansi-language: EN-US; mso-fareast-language: FR;">div</span></strong><span lang="EN-US" style="font-size: 10.5pt; font-family: ''Courier New''; mso-fareast-font-family: ''Times New Roman''; color: #f8f8f2; mso-ansi-language: EN-US; mso-fareast-language: FR;">&gt;</span></p>', '2018-06-20 02:34:49', 16, 8);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Super-administrateur'),
(2, 'Administrateur'),
(3, 'Membre');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  `tokenLogon` varchar(32) DEFAULT NULL,
  `tokenForgotPwd` varchar(32) DEFAULT NULL,
  `id_Image` int(11) DEFAULT NULL,
  `id_Role` int(11) NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_User_id_Image` (`id_Image`),
  KEY `FK_User_id_Role` (`id_Role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `name`, `firstname`, `email`, `password`, `blocked`, `tokenLogon`, `tokenForgotPwd`, `id_Image`, `id_Role`) VALUES
(1, 'MalronWall', 'Tourte', 'Thibaut', 'thibaut.tourte@gmail.com', 'be571287a5832f9956ba392d2379c811', 0, NULL, NULL, 1, 1),
(16, 'Test1', 'Test1', 'Test1', 'test1@gmail.com', 'be571287a5832f9956ba392d2379c811', 0, NULL, NULL, 9, 2),
(17, 'Test2', 'Test2', 'Test2', 'test2@gmail.com', 'be571287a5832f9956ba392d2379c811', 0, NULL, NULL, 10, 2),
(18, 'Test3', 'Test3', 'Test3', 'test3@gmail.com', 'be571287a5832f9956ba392d2379c811', 0, NULL, NULL, 11, 3),
(19, 'Test4', 'Test4', 'Test4', 'test4@gmail.com', 'be571287a5832f9956ba392d2379c811', 0, NULL, NULL, NULL, 3),
(20, 'Test5', 'Test5', 'Test5', 'test5@gmail.com', 'be571287a5832f9956ba392d2379c811', 1, NULL, NULL, NULL, 3),
(23, 'MorvanA', 'Morvan', 'Aurélien', 'morvan.aurelien@gmail.com', '7f001ab480f3d7deab2ae7bac3604bb8', 0, NULL, NULL, NULL, 2);

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
