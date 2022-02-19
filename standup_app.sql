-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `wrqtepbzfx` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `wrqtepbzfx`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `auth_tokens`;
CREATE TABLE `auth_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `auth_type` varchar(255) NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expires_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `auth_tokens` (`id`, `user_email`, `auth_type`, `selector`, `token`, `created_at`, `expires_at`) VALUES
(78,	'sunil.verma@webdesignmarket.com.au',	'remember_me',	'bb9bce10c60e8d1a',	'$2y$10$ACzagxlA5L7wFiimXwoBGumOqy.gZefWYimNEwrlX3N93FaaUj0YK',	'2022-02-11 13:44:07',	'2022-02-21 13:44:07'),
(79,	'sujoinhouse@gmail.com',	'account_verify',	'5b76611901dabef6',	'$2y$10$EdgA/wAvu4b3kLuI5O3oqewO1A6tIj6R4wlLrBlcE42N9h26mjqC.',	'2022-02-13 15:45:57',	'2022-02-13 16:45:57'),
(80,	'sujoinhouse@gmail.com',	'password_reset',	'001551172fe1ba86',	'$2y$10$G8IoKB7MCWHE.8MK6PHoIeQJeNsg14Toq0kWzHUEA6oFiU7EXQLsO',	'2022-02-13 15:47:14',	'2022-02-13 16:47:14'),
(82,	'sunilnagpal30@gmail.com',	'account_verify',	'2e397631c0fdd0a4',	'$2y$10$rdmZ5L5YBbc9lL5TDhFM1uWsdX4HMnhmBOl00nnq.meVvYCMVIw6.',	'2022-02-13 16:58:28',	'2022-02-13 17:58:28'),
(95,	'info@techiewarriors.com',	'remember_me',	'3238857f53b99a00',	'$2y$10$Y5uGZrxFOJw/G2UgZ3wswegBoNwx2k3gnNcESySHnjzacsrAB.Df2',	'2022-02-19 15:10:06',	'2022-03-01 15:10:06');

DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `logo_url` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `standup`;
CREATE TABLE `standup` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `standup_answers`;
CREATE TABLE `standup_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'logged in user who submitted the answers',
  `question_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `standup_answers` (`id`, `user_id`, `question_id`, `answer`, `date_added`, `date_updated`) VALUES
(1,	33,	1,	'p1',	'2022-02-13 17:00:19',	NULL),
(2,	33,	1,	'p2',	'2022-02-13 17:00:19',	NULL),
(3,	33,	2,	'p3',	'2022-02-13 17:00:19',	NULL),
(4,	33,	2,	'p4',	'2022-02-13 17:00:19',	NULL),
(5,	33,	3,	'p5',	'2022-02-13 17:00:19',	NULL),
(6,	33,	3,	'p6',	'2022-02-13 17:00:19',	NULL),
(7,	34,	1,	'Question 1',	'2022-02-13 17:59:57',	NULL),
(8,	34,	1,	'Worked on WDM discussion',	'2022-02-13 17:59:57',	NULL),
(9,	34,	2,	'Have kick of round',	'2022-02-13 17:59:57',	NULL),
(10,	34,	2,	'Will continue on the Tasks',	'2022-02-13 17:59:57',	NULL),
(11,	34,	3,	'Currently no challanges',	'2022-02-13 17:59:57',	NULL);

DROP TABLE IF EXISTS `standup_items`;
CREATE TABLE `standup_items` (
  `id` int(11) NOT NULL,
  `standup_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_description` varchar(255) NOT NULL,
  `linked_task` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `standup_questions`;
CREATE TABLE `standup_questions` (
  `id` int(11) NOT NULL,
  `question_title` varchar(255) NOT NULL,
  `question_description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `headline` varchar(255) DEFAULT NULL,
  `bio` text,
  `profile_image` varchar(255) NOT NULL DEFAULT '_defaultUser.png',
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `id` (`id`,`username`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `gender`, `headline`, `bio`, `profile_image`, `verified_at`, `created_at`, `updated_at`, `deleted_at`, `last_login_at`) VALUES
(0,	'standup',	'standup@wdm.com',	'$2y$10$jhIOk4NVdBile/NwhAU9We/f0aoohx.cG9CizmIALRz0aCKJa5s6a',	'standup',	'standup',	'm',	'Test',	'Test',	'_defaultUser.png',	NULL,	'2022-02-09 12:30:05',	'2022-02-13 15:38:34',	NULL,	NULL),
(31,	'sunil',	'sunil.verma@webdesignmarket.com.au',	'48ccc87cd7afb85704a63e8d5953d326',	'Sunil',	'Verma',	'm',	'Developer',	'',	'_defaultUser.png',	'2022-02-10 17:41:26',	'2022-02-09 13:21:31',	'2022-02-13 17:27:11',	NULL,	'2022-02-13 17:27:11'),
(32,	'WDMDev',	'sujoinhouse@gmail.com',	'$2y$10$Ez/Zk97hzSgkd0/RZEImY.3MA8wyfVf5CL9VZ/eh1fiY0xFgka466',	'wdm',	'verma',	'm',	'Test Dev',	'Test',	'_defaultUser.png',	NULL,	'2022-02-13 15:45:57',	'2022-02-13 15:45:57',	NULL,	NULL),
(33,	'suniln',	'sunilnagpal30@gmail.com',	'$2y$10$2wTqATrS89B1qKhpTHf/r.fNnCQgjwNvvzbY7jrcBXfqjk5pYeQia',	'',	'',	NULL,	'',	'',	'_defaultUser.png',	'2022-02-13 17:00:00',	'2022-02-13 16:56:59',	'2022-02-13 18:02:34',	NULL,	'2022-02-13 17:35:02'),
(34,	'sunil123',	'vsunil209@gmail.com',	'$2y$10$cU3WOvX23ZBcWF0zBwDotOaza71CglzGu7Th6c9zXaMTdUpuCryYy',	'Sunil Verma',	'Verma',	'm',	'Developer',	'sunil123',	'_defaultUser.png',	'2022-02-13 17:58:03',	'2022-02-13 17:23:09',	'2022-02-13 17:58:03',	NULL,	'2022-02-13 17:49:15'),
(35,	'info',	'info@techiewarriors.com',	'$2y$10$Nv1s5UtexqAPY88F/VRe/ew4zAVMNydcVWztCZKfFHDYA5jazEyEm',	'Sunil',	'Verma',	'm',	'',	'',	'_defaultUser.png',	'2022-02-19 15:12:04',	'2022-02-19 15:09:49',	'2022-02-19 15:12:04',	NULL,	'2022-02-19 15:10:06');

-- 2022-02-19 17:00:02
