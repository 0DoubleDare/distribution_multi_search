/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.4.8-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: distro_multi_search
-- ------------------------------------------------------
-- Server version	11.4.8-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Current Database: `distro_multi_search`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `distro_multi_search` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `distro_multi_search`;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` mediumtext DEFAULT NULL,
  `votes` int(11) NOT NULL DEFAULT 0,
  `comment_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_comment_user_id` (`user_id`),
  KEY `fk_comment_post_id` (`post_id`),
  CONSTRAINT `fk_comment_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_comment_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES
(1,7,12,'Фигня пост удаляй',0,'2026-04-20 18:57:54'),
(2,7,12,'ЛООООООООЛ',0,'2026-04-21 04:44:14'),
(4,18,12,'fsdfsd',0,'2026-04-21 10:50:36'),
(5,18,12,'fsdfsd',0,'2026-04-21 10:51:16'),
(6,18,12,'Приве как дела',0,'2026-04-21 10:51:43'),
(7,18,12,'Неплохо брат',0,'2026-04-21 10:51:51'),
(10,8,12,'Неплохой дистро для ГЕЙМЕРОВ',0,'2026-04-21 10:55:00'),
(12,25,14,'sudo chmod +777 users:users',0,'2026-04-21 12:12:50'),
(13,27,12,'Спасибо',0,'2026-04-21 13:26:17');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

--
-- Table structure for table `linux_distributions`
--

DROP TABLE IF EXISTS `linux_distributions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `linux_distributions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `posts_count` int(10) unsigned NOT NULL COMMENT 'Количество постов которые относятся к конкретному дистрибутиву',
  `description` text DEFAULT NULL,
  `official_wiki_url` text DEFAULT NULL,
  `icon_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linux_distributions`
--

/*!40000 ALTER TABLE `linux_distributions` DISABLE KEYS */;
INSERT INTO `linux_distributions` VALUES
(1,'NixOS',5,'Неубиваемая система с декларативным подходом: вся конфигурация описывается в одном файле, что позволяет мгновенно откатывать любые изменения.','https://wiki.nixos.org/wiki/NixOS_Wiki','nixos_icon'),
(2,'Fedora',1,'Полигон инноваций: всегда свежее ПО и самые новые технологии (Wayland, Btrfs), которые позже становятся стандартом в мире Linux.','https://fedoraproject.org/wiki/Fedora_Project_Wiki/ru','fedora_icon'),
(3,'Ubuntu',2,'Золотой стандарт дружелюбности: самый популярный дистрибутив с огромным сообществом и гарантированной поддержкой любого софта.','https://wiki.ubuntu.com/','ubuntu_icon'),
(4,'Arch',0,'Конструктор «Сделай сам»: минималистичная база с философией KISS и доступом к AUR — самому большому репозиторию пользовательских пакетов.','https://wiki.archlinux.org/title/Main_page','arch_linux_icon'),
(5,'CachyOS',1,'Arch на стероидах: оптимизирован под максимальную производительность процессора и отзывчивость интерфейса «из коробки».','https://wiki.cachyos.org/','cachyos_icon'),
(6,'OpenSUSE',1,'Немецкая точность и YaST: лучший графический центр управления системой и уникальная файловая структура с автоматическими снимками системы.','https://ru.opensuse.org/','opensuse_icon'),
(7,'Void Linux',0,'Независимый минимализм: не использует systemd, работает на молниеносном менеджере пакетов XBPS и подходит для тех, кто ценит простоту и скорость.','https://docs.voidlinux.org/','void_linux_icon'),
(8,'Debian',0,'«Универсальная ОС»: эталон стабильности и надежности, на котором держится половина интернета и сотни других дистрибутивов.','https://wiki.debian.org/','debian_icon'),
(9,'Red Hat',0,'Корпоративная крепость: платное решение для бизнеса с десятилетней поддержкой, строгими стандартами безопасности и сертификациями.','https://www.redhat.com/','redhat_icon');
/*!40000 ALTER TABLE `linux_distributions` ENABLE KEYS */;

--
-- Table structure for table `post_categories`
--

DROP TABLE IF EXISTS `post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT 'Категория поста. Помощь / Вопрос / Полезные практики и так далее',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_categories`
--

/*!40000 ALTER TABLE `post_categories` DISABLE KEYS */;
INSERT INTO `post_categories` VALUES
(1,'Помощь'),
(2,'Вопрос'),
(3,'Полезно'),
(4,'Шутка');
/*!40000 ALTER TABLE `post_categories` ENABLE KEYS */;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `distribution_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `post_created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_distribution_type_key` (`distribution_id`),
  KEY `fk_category_key` (`category_id`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `fk_category_key` FOREIGN KEY (`category_id`) REFERENCES `post_categories` (`id`),
  CONSTRAINT `fk_distribution_type_key` FOREIGN KEY (`distribution_id`) REFERENCES `linux_distributions` (`id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES
(2,12,'Привет чувак','Мега крутой пост',1,1,'2026-04-19 12:22:13'),
(5,12,'fdsf','fdsfsd',1,1,'2026-04-19 14:19:13'),
(6,12,'dasdsa','dasdasdasdasd',1,1,'2026-04-19 14:19:20'),
(7,12,'ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС','ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКСЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС ЛИНУКС',3,4,'2026-04-19 14:20:44'),
(8,12,'CachyOS норм или не норм?','lorem',5,2,'2026-04-19 14:50:38'),
(13,12,'Беслпатно','Как взломать redhat линукс ',1,1,'2026-04-19 16:24:13'),
(15,12,'Десктоп','Опен сус норм или стрем как десктом? БЛИН',6,2,'2026-04-20 06:00:14'),
(18,12,'Демонстрация','Что делать если сломалась запись экрана',3,2,'2026-04-21 04:46:35'),
(25,14,'Проблема с правами в XAMPP','Что делать подскажите',2,1,'2026-04-21 12:12:35'),
(27,14,'Конфигурация докер','Чтобы включить докер в систему добавьте в configuration.nix строку virtualization.docker.enable = true',1,1,'2026-04-21 13:25:46');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`localhost`*/ /*!50003 TRIGGER on_posts_insert
AFTER INSERT ON posts
FOR EACH ROW
    BEGIN
        UPDATE linux_distributions
            set posts_count = posts_count + 1 WHERE id = NEW.distribution_id;
    end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`localhost`*/ /*!50003 TRIGGER on_posts_delete
    AFTER DELETE ON posts
    FOR EACH ROW
    BEGIN
        UPDATE linux_distributions
            set posts_count = IF(posts_count > 0, posts_count - 1, 0) WHERE id = OLD.distribution_id;
    end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `user_privileges`
--

DROP TABLE IF EXISTS `user_privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_privileges`
--

/*!40000 ALTER TABLE `user_privileges` DISABLE KEYS */;
INSERT INTO `user_privileges` VALUES
(1,'default'),
(2,'admin'),
(3,'moderator');
/*!40000 ALTER TABLE `user_privileges` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(255) DEFAULT NULL COMMENT 'Отображаемое имя пользователя которое не должно быть уникальным',
  `username` varchar(500) NOT NULL,
  `password` varchar(2048) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `avatar_path` varchar(500) DEFAULT NULL,
  `carma` int(11) DEFAULT 100 COMMENT 'Репутация пользователя, представляет из себя целое число  и по умолчанию у каждого пользователя 100 кармы. Чем ниже - тем хуже человек',
  `user_role_id` int(11) DEFAULT 1,
  `account_created` timestamp NULL DEFAULT current_timestamp(),
  `account_deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_user_type` (`user_role_id`),
  CONSTRAINT `fk_user_type` FOREIGN KEY (`user_role_id`) REFERENCES `user_privileges` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(12,'Никита','NeKet','$2y$12$Jiakyag6zmEsBztu1goqMOCg3bUOYPrVKCnv2W/4zJB2XEUUA8Cd2','lidernikita@gmail.com',NULL,100,1,'2026-04-19 11:21:43',NULL),
(13,'2342','dfsdfsdfsdf','$2y$12$0Ka9M7q7vp5T1QxzQGei3.1zLD5qhAcfeN.mPJdWh/jUtF1PkZxIq','eew@example.com',NULL,100,1,'2026-04-19 15:51:43',NULL),
(14,'Сергей Викторович','rahmanin','$2y$12$tPRU7wXfMeqZd93a99IqlePtQGbCn2cPiOE998GeT0fTCog9Rq7Ue','popa@gmail.com',NULL,100,1,'2026-04-21 10:57:53',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-04-22  8:44:37
