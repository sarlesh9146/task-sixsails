-- Adminer 4.8.1 MySQL 5.7.34-0ubuntu0.18.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `feature_task`;
CREATE TABLE `feature_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(200) NOT NULL,
  `effort_days` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `feature_task` (`id`, `task_name`, `effort_days`, `priority`) VALUES
(1,	'Designing 1',	3,	1),
(2,	'Designing 2',	3,	1),
(3,	'Database migrations',	1,	2),
(4,	'Implement Backend Base library',	5,	3),
(5,	'Implement UI Base library',	3,	3),
(6,	'Build UI for users list page',	5,	4),
(7,	'Implement backend for users list page',	3,	4),
(8,	'Add filters for users list page',	4,	5),
(9,	'Build Create new user page',	3,	5),
(10,	'Build Update user page',	2,	6),
(11,	'Assign roles',	7,	7),
(12,	'Deactivate users',	3,	7),
(13,	'Export user details in PDF',	4,	7),
(14,	'Export users in Excel',	4,	7),
(15,	'Reactivate users',	2,	7),
(16,	'Dev testing 1',	3,	8),
(17,	'Dev testing 2',	3,	8),
(18,	'Defect fixes 1',	3,	8),
(19,	'Defect fixes 2',	3,	9);

-- 2021-06-21 21:28:40
