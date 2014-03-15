-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 10 2014 г., 00:42
-- Версия сервера: 5.6.15-log
-- Версия PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `bandee`
--

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `id_country` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_city_country1_idx` (`id_country`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Структура таблицы `favorit_order`
--

CREATE TABLE IF NOT EXISTS `favorit_order` (
  `id_order` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_order`,`id_user`),
  KEY `fk_favorit_order_order1_idx` (`id_order`),
  KEY `fk_favorit_order_user1_idx` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `favorit_resume`
--

CREATE TABLE IF NOT EXISTS `favorit_resume` (
  `id_user` int(10) unsigned NOT NULL,
  `id_resume` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_user`,`id_resume`),
  KEY `fk_user_has_resume_user1` (`id_user`),
  KEY `fk_user_has_resume_resume1` (`id_resume`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(120) NOT NULL,
  `title` varchar(200) NOT NULL,
  `text` text,
  `status` tinyint(4) DEFAULT '1' COMMENT '0-ban,1-normal',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `instrument`
--

CREATE TABLE IF NOT EXISTS `instrument` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `id_group` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_instrument_group1_idx` (`id_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `instr_group`
--

CREATE TABLE IF NOT EXISTS `instr_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `title` varchar(200) NOT NULL,
  `text` text,
  `type` tinyint(1) NOT NULL COMMENT '1-video,2-audio',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-ban,1-normal',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `metro`
--

CREATE TABLE IF NOT EXISTS `metro` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `id_city` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_metro_city1_idx` (`id_city`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Структура таблицы `new`
--

CREATE TABLE IF NOT EXISTS `new` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `text` text NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '1',
  `id_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_new_user1_idx` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `news_comment`
--

CREATE TABLE IF NOT EXISTS `news_comment` (
  `id` int(10) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `text` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `id_new` int(10) NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_new_comm_new1_idx` (`id_new`),
  KEY `fk_new_comm_user1_idx` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `money_status` tinyint(1) NOT NULL DEFAULT '0',
  `skill` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `consertskill` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Консертный опыт',
  `id_profile` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_profile1` (`id_profile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `orders_comments`
--

CREATE TABLE IF NOT EXISTS `orders_comments` (
  `id_order` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `text` tinytext NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_order_has_user_order1` (`id_order`),
  KEY `fk_order_has_user_user1` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `order_has_answer`
--

CREATE TABLE IF NOT EXISTS `order_has_answer` (
  `id_order` int(10) unsigned NOT NULL,
  `id_resume` int(10) unsigned NOT NULL,
  `new` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_order`,`id_resume`),
  KEY `fk_answer_order1_idx` (`id_order`),
  KEY `fk_answer_order_resume1_idx` (`id_resume`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_has_image`
--

CREATE TABLE IF NOT EXISTS `order_has_image` (
  `id_image` int(10) unsigned NOT NULL,
  `id_order` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_image`,`id_order`),
  KEY `fk_image_order_image1_idx` (`id_image`),
  KEY `fk_image_order_order1_idx` (`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_has_instrument`
--

CREATE TABLE IF NOT EXISTS `order_has_instrument` (
  `id_order` int(10) unsigned NOT NULL,
  `id_instrument` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_order`,`id_instrument`),
  KEY `fk_order_has_instrument_order1` (`id_order`),
  KEY `fk_order_has_instrument_instrument1` (`id_instrument`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_has_media`
--

CREATE TABLE IF NOT EXISTS `order_has_media` (
  `id_order` int(10) unsigned NOT NULL,
  `id_media` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_order`,`id_media`),
  KEY `fk_order_has_media_order1` (`id_order`),
  KEY `fk_order_has_media_media1` (`id_media`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_has_subgenre`
--

CREATE TABLE IF NOT EXISTS `order_has_subgenre` (
  `id_subgenre` int(10) unsigned NOT NULL,
  `id_order` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_subgenre`,`id_order`),
  KEY `fk_order_genre_subgenre1_idx` (`id_subgenre`),
  KEY `fk_order_genre_order1_idx` (`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pays_history`
--

CREATE TABLE IF NOT EXISTS `pays_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `price` decimal(19,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `from` varchar(255) NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Payhistory_user1_idx` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` tinyint(1) NOT NULL COMMENT '1 - страница пользователя\n2 - страница группы ',
  `vk` varchar(65) DEFAULT NULL,
  `googleplus` varchar(65) DEFAULT NULL,
  `facebook` varchar(65) DEFAULT NULL,
  `twitter` varchar(65) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `avatar` varchar(120) DEFAULT NULL,
  `id_metro` int(10) unsigned DEFAULT NULL,
  `id_city` int(10) unsigned DEFAULT NULL,
  `skype` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profile_metro1` (`id_metro`),
  KEY `fk_profile_city1` (`id_city`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=153 ;

-- --------------------------------------------------------

--
-- Структура таблицы `profile_has_resume`
--

CREATE TABLE IF NOT EXISTS `profile_has_resume` (
  `id_profile` int(10) unsigned NOT NULL,
  `id_resume` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_profile`,`id_resume`),
  KEY `fk_profile_has_resume_profile1` (`id_profile`),
  KEY `fk_profile_has_resume_resume1` (`id_resume`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `resume`
--

CREATE TABLE IF NOT EXISTS `resume` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `money_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `skill` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '0-ban,1-normal,2-vip',
  `consertskill` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Концертный опыт',
  `id_profile` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_resume_profile1` (`id_profile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `resumes_comment`
--

CREATE TABLE IF NOT EXISTS `resumes_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `id_resume` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comment_resume_user1_idx` (`id_user`),
  KEY `fk_comment_resume_resume1_idx` (`id_resume`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `resume_has_answer`
--

CREATE TABLE IF NOT EXISTS `resume_has_answer` (
  `new` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `id_resume` int(10) unsigned NOT NULL,
  `id_order` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_resume`,`id_order`),
  KEY `fk_answer_resume_resume1_idx` (`id_resume`),
  KEY `fk_answer_resume_order1_idx` (`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `resume_has_image`
--

CREATE TABLE IF NOT EXISTS `resume_has_image` (
  `id_resume` int(10) unsigned NOT NULL,
  `id_image` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_resume`,`id_image`),
  KEY `fk_resume_has_image_resume1` (`id_resume`),
  KEY `fk_resume_has_image_image1` (`id_image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `resume_has_instrument`
--

CREATE TABLE IF NOT EXISTS `resume_has_instrument` (
  `id_resume` int(10) unsigned NOT NULL,
  `id_instrument` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_resume`,`id_instrument`),
  KEY `fk_resume_has_instrument_resume1` (`id_resume`),
  KEY `fk_resume_has_instrument_instrument1` (`id_instrument`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `resume_has_media`
--

CREATE TABLE IF NOT EXISTS `resume_has_media` (
  `id_resume` int(10) unsigned NOT NULL,
  `id_media` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_resume`,`id_media`),
  KEY `fk_resume_has_media_resume1` (`id_resume`),
  KEY `fk_resume_has_media_media1` (`id_media`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `resume_has_subgenre`
--

CREATE TABLE IF NOT EXISTS `resume_has_subgenre` (
  `id_resume` int(10) unsigned NOT NULL,
  `id_subgenre` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_resume`,`id_subgenre`),
  KEY `fk_resume_has_subgenre_resume1` (`id_resume`),
  KEY `fk_resume_has_subgenre_subgenre1` (`id_subgenre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `subgenre`
--

CREATE TABLE IF NOT EXISTS `subgenre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `id_genre` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subgenre_genre1_idx` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mail` varchar(125) NOT NULL,
  `password` varchar(40) NOT NULL,
  `key` char(32) NOT NULL COMMENT 'ключь для авторизации',
  `fio` varchar(250) DEFAULT NULL,
  `role` tinyint(1) unsigned NOT NULL,
  `sex` tinyint(1) DEFAULT NULL COMMENT '1-man,2-woman',
  `birthday` date DEFAULT NULL,
  `full_info` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `balans` decimal(19,2) DEFAULT '0.00',
  `send_status` int(1) NOT NULL,
  `last_visit` timestamp NULL DEFAULT NULL,
  `id_profile` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_profile1` (`id_profile`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `fk_city_country1` FOREIGN KEY (`id_country`) REFERENCES `country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `favorit_order`
--
ALTER TABLE `favorit_order`
  ADD CONSTRAINT `fk_favorit_order_order1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_favorit_order_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `favorit_resume`
--
ALTER TABLE `favorit_resume`
  ADD CONSTRAINT `fk_user_has_resume_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_resume_resume1` FOREIGN KEY (`id_resume`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `instrument`
--
ALTER TABLE `instrument`
  ADD CONSTRAINT `fk_instrument_group1` FOREIGN KEY (`id_group`) REFERENCES `instr_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `metro`
--
ALTER TABLE `metro`
  ADD CONSTRAINT `fk_metro_city1` FOREIGN KEY (`id_city`) REFERENCES `city` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `new`
--
ALTER TABLE `new`
  ADD CONSTRAINT `fk_new_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `news_comment`
--
ALTER TABLE `news_comment`
  ADD CONSTRAINT `fk_new_comm_new1` FOREIGN KEY (`id_new`) REFERENCES `new` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_new_comm_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_profile1` FOREIGN KEY (`id_profile`) REFERENCES `profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `orders_comments`
--
ALTER TABLE `orders_comments`
  ADD CONSTRAINT `fk_order_has_user_order1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_has_user_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `order_has_answer`
--
ALTER TABLE `order_has_answer`
  ADD CONSTRAINT `fk_answer_order1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_answer_order_resume1` FOREIGN KEY (`id_resume`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `order_has_image`
--
ALTER TABLE `order_has_image`
  ADD CONSTRAINT `fk_image_order_image1` FOREIGN KEY (`id_image`) REFERENCES `image` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_image_order_order1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `order_has_instrument`
--
ALTER TABLE `order_has_instrument`
  ADD CONSTRAINT `fk_order_has_instrument_order1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_has_instrument_instrument1` FOREIGN KEY (`id_instrument`) REFERENCES `instrument` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `order_has_media`
--
ALTER TABLE `order_has_media`
  ADD CONSTRAINT `fk_order_has_media_order1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_has_media_media1` FOREIGN KEY (`id_media`) REFERENCES `media` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `order_has_subgenre`
--
ALTER TABLE `order_has_subgenre`
  ADD CONSTRAINT `fk_order_genre_order1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_genre_subgenre1` FOREIGN KEY (`id_subgenre`) REFERENCES `subgenre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `pays_history`
--
ALTER TABLE `pays_history`
  ADD CONSTRAINT `fk_Payhistory_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_city1` FOREIGN KEY (`id_city`) REFERENCES `city` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_profile_metro1` FOREIGN KEY (`id_metro`) REFERENCES `metro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `profile_has_resume`
--
ALTER TABLE `profile_has_resume`
  ADD CONSTRAINT `fk_profile_has_resume_profile1` FOREIGN KEY (`id_profile`) REFERENCES `profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_profile_has_resume_resume1` FOREIGN KEY (`id_resume`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `resume`
--
ALTER TABLE `resume`
  ADD CONSTRAINT `fk_resume_profile1` FOREIGN KEY (`id_profile`) REFERENCES `profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `resumes_comment`
--
ALTER TABLE `resumes_comment`
  ADD CONSTRAINT `fk_comment_resume_resume1` FOREIGN KEY (`id_resume`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comment_resume_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `resume_has_answer`
--
ALTER TABLE `resume_has_answer`
  ADD CONSTRAINT `fk_answer_resume_order1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_answer_resume_resume1` FOREIGN KEY (`id_resume`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `resume_has_image`
--
ALTER TABLE `resume_has_image`
  ADD CONSTRAINT `fk_resume_has_image_resume1` FOREIGN KEY (`id_resume`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_resume_has_image_image1` FOREIGN KEY (`id_image`) REFERENCES `image` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `resume_has_instrument`
--
ALTER TABLE `resume_has_instrument`
  ADD CONSTRAINT `fk_resume_has_instrument_resume1` FOREIGN KEY (`id_resume`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_resume_has_instrument_instrument1` FOREIGN KEY (`id_instrument`) REFERENCES `instrument` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `resume_has_media`
--
ALTER TABLE `resume_has_media`
  ADD CONSTRAINT `fk_resume_has_media_resume1` FOREIGN KEY (`id_resume`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_resume_has_media_media1` FOREIGN KEY (`id_media`) REFERENCES `media` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `resume_has_subgenre`
--
ALTER TABLE `resume_has_subgenre`
  ADD CONSTRAINT `fk_resume_has_subgenre_resume1` FOREIGN KEY (`id_resume`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_resume_has_subgenre_subgenre1` FOREIGN KEY (`id_subgenre`) REFERENCES `subgenre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `subgenre`
--
ALTER TABLE `subgenre`
  ADD CONSTRAINT `fk_subgenre_genre1` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_profile1` FOREIGN KEY (`id_profile`) REFERENCES `profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
