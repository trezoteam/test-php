/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.1.19-MariaDB : Database - quiz
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`quiz` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `quiz`;

/*Table structure for table `participant` */

DROP TABLE IF EXISTS `participant`;

CREATE TABLE `participant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `participant` */

insert  into `participant`(`id`,`email`,`create_at`) values (1,'felipe.devel@gmail.com','2017-09-11 10:33:04');

/*Table structure for table `participant_answer` */

DROP TABLE IF EXISTS `participant_answer`;

CREATE TABLE `participant_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participant_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `question_option_id` int(11) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `is_correct` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_participant_id_part` (`participant_id`),
  KEY `fk_question_id_part` (`question_id`),
  KEY `fk_question_option_part` (`question_option_id`),
  CONSTRAINT `fk_participant_id_part` FOREIGN KEY (`participant_id`) REFERENCES `participant` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_question_id_part` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_question_option_part` FOREIGN KEY (`question_option_id`) REFERENCES `question_option` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `participant_answer` */

insert  into `participant_answer`(`id`,`participant_id`,`question_id`,`question_option_id`,`answer`,`is_correct`) values (1,1,1,NULL,'Deu tudo certo',NULL),(2,1,2,1,NULL,1),(3,1,3,4,NULL,0);

/*Table structure for table `question` */

DROP TABLE IF EXISTS `question`;

CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_quiz_id` (`quiz_id`),
  KEY `fk_type` (`type_id`),
  CONSTRAINT `fk_quiz_id` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_type` FOREIGN KEY (`type_id`) REFERENCES `type_question` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `question` */

insert  into `question`(`id`,`subject`,`quiz_id`,`type_id`,`created_at`,`updated_at`) values (1,'Qual sua profissão',1,2,'2017-09-11 10:31:10',NULL),(2,'Qual é a melhor opção de teste para você?',1,1,'2017-09-11 10:31:30',NULL),(3,'O que é galinheiro',1,2,'2017-09-11 10:32:15',NULL);

/*Table structure for table `question_option` */

DROP TABLE IF EXISTS `question_option`;

CREATE TABLE `question_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `is_correct` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_question_id` (`question_id`),
  CONSTRAINT `fk_question_id` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `question_option` */

insert  into `question_option`(`id`,`question_id`,`answer`,`is_correct`,`created_at`,`updated_at`) values (1,2,'Teste certo',1,'2017-09-11 10:31:58',NULL),(2,2,'Teste errado',0,'2017-09-11 10:32:00',NULL),(3,3,'Opção certa ',1,'2017-09-11 10:32:27',NULL),(4,3,'Opção errada',0,'2017-09-11 10:32:36',NULL),(5,3,'Nenhuma opção',0,'2017-09-11 10:32:43',NULL);

/*Table structure for table `quiz` */

DROP TABLE IF EXISTS `quiz`;

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `quiz` */

insert  into `quiz`(`id`,`name`,`description`,`created_at`,`updated_at`) values (1,'Nome profissional','informações sobre sua profissão','2017-09-11 10:29:12','2017-09-11 10:29:15');

/*Table structure for table `type_question` */

DROP TABLE IF EXISTS `type_question`;

CREATE TABLE `type_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `type_question` */

insert  into `type_question`(`id`,`name`) values (1,'Multipla escolha'),(2,'Descritiva');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
