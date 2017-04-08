#
# SQL Export
# Created by Querious (1068)
# Created: 8 de abril de 2017 16:13:56 BRT
# Encoding: Unicode (UTF-8)
#


DROP DATABASE IF EXISTS `thinkific`;
CREATE DATABASE `thinkific` DEFAULT CHARACTER SET latin1 DEFAULT COLLATE latin1_swedish_ci;
USE `thinkific`;




SET @PREVIOUS_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 0;


DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `module_meta`;
DROP TABLE IF EXISTS `course_meta`;
DROP TABLE IF EXISTS `courses`;
DROP TABLE IF EXISTS `modules`;


CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `mudule_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `module_meta_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_user_fk` (`user_id`),
  KEY `courses_module_fk` (`mudule_id`),
  CONSTRAINT `courses_module_fk` FOREIGN KEY (`mudule_id`) REFERENCES `modules` (`id`),
  CONSTRAINT `courses_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `course_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `module_id` int(11) NOT NULL,
  `module_meta_id` int(11) DEFAULT '0',
  `value` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_meta_course_fk` (`course_id`),
  KEY `course_meta_module_fk` (`module_id`),
  KEY `course_meta_module_meta_fk` (`module_meta_id`) USING BTREE,
  CONSTRAINT `course_meta_course_fk` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `course_meta_module_fk` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `module_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `key` int(11) DEFAULT NULL,
  `module_id` int(11) NOT NULL,
  `default` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module_meta_module_fk` (`module_id`),
  CONSTRAINT `module_meta_module_fk` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;




SET FOREIGN_KEY_CHECKS = @PREVIOUS_FOREIGN_KEY_CHECKS;


SET @PREVIOUS_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 0;


LOCK TABLES `modules` WRITE;
ALTER TABLE `modules` DISABLE KEYS;
ALTER TABLE `modules` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `courses` WRITE;
ALTER TABLE `courses` DISABLE KEYS;
ALTER TABLE `courses` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `course_meta` WRITE;
ALTER TABLE `course_meta` DISABLE KEYS;
ALTER TABLE `course_meta` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `module_meta` WRITE;
ALTER TABLE `module_meta` DISABLE KEYS;
ALTER TABLE `module_meta` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `users` WRITE;
ALTER TABLE `users` DISABLE KEYS;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES 
	(2,'Administrador','admin@gmail.com','$2y$10$M2QLM6tvLErbFOPrwwBSBO9Xr7c39gMWEDFZBibVveJHOQzmSwlk.','2017-04-08 04:13:57','2017-04-08 04:13:57');
ALTER TABLE `users` ENABLE KEYS;
UNLOCK TABLES;




SET FOREIGN_KEY_CHECKS = @PREVIOUS_FOREIGN_KEY_CHECKS;


