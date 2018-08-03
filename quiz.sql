/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50721
Source Host           : 127.0.0.1:3306
Source Database       : quiz

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2018-08-02 23:30:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for answers
-- ----------------------------
DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` varchar(255) DEFAULT NULL,
  `is_correct` tinyint(4) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=152 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of answers
-- ----------------------------
INSERT INTO `answers` VALUES ('142', 'Curabitur pulvinar, felis vitae molestie fermentum, velit diam ultrices lorem, ac laoreet dui metus vel nibh.', null, '40', '2018-08-02 15:26:47', '2018-08-02 15:26:47');
INSERT INTO `answers` VALUES ('102', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', null, '31', '2018-08-02 15:22:52', '2018-08-02 15:22:52');
INSERT INTO `answers` VALUES ('103', 'Nam eu arcu et diam efficitur vestibulum.', null, '31', '2018-08-02 15:22:52', '2018-08-02 15:22:52');
INSERT INTO `answers` VALUES ('104', 'Duis at vulputate nunc.', '1', '31', '2018-08-02 15:22:52', '2018-08-02 15:22:52');
INSERT INTO `answers` VALUES ('105', 'Sed id velit justo.', null, '31', '2018-08-02 15:22:52', '2018-08-02 15:22:52');
INSERT INTO `answers` VALUES ('106', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', null, '32', '2018-08-02 15:23:20', '2018-08-02 15:23:20');
INSERT INTO `answers` VALUES ('107', 'Nam eu arcu et diam efficitur vestibulum.', '1', '32', '2018-08-02 15:23:20', '2018-08-02 15:23:20');
INSERT INTO `answers` VALUES ('108', 'Duis at vulputate nunc.', null, '32', '2018-08-02 15:23:20', '2018-08-02 15:23:20');
INSERT INTO `answers` VALUES ('109', 'Sed id velit justo.', '1', '32', '2018-08-02 15:23:20', '2018-08-02 15:23:20');
INSERT INTO `answers` VALUES ('110', 'Quisque blandit nulla ut magna dapibus, quis suscipit augue consequat. ', null, '32', '2018-08-02 15:23:20', '2018-08-02 15:23:20');
INSERT INTO `answers` VALUES ('111', 'Curabitur pulvinar, felis vitae molestie fermentum, velit diam ultrices lorem, ac laoreet dui metus vel nibh.', null, '32', '2018-08-02 15:23:20', '2018-08-02 15:23:20');
INSERT INTO `answers` VALUES ('112', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', null, '33', '2018-08-02 15:23:33', '2018-08-02 20:46:37');
INSERT INTO `answers` VALUES ('113', 'Nam eu arcu et diam efficitur vestibulum.', null, '33', '2018-08-02 15:23:33', '2018-08-02 20:46:37');
INSERT INTO `answers` VALUES ('114', 'Duis at vulputate nunc.', null, '33', '2018-08-02 15:23:33', '2018-08-02 20:46:37');
INSERT INTO `answers` VALUES ('115', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', null, '34', '2018-08-02 15:24:35', '2018-08-02 15:24:44');
INSERT INTO `answers` VALUES ('116', 'Nam eu arcu et diam efficitur vestibulum.', '1', '34', '2018-08-02 15:24:35', '2018-08-02 15:24:44');
INSERT INTO `answers` VALUES ('117', 'Duis at vulputate nunc.', null, '34', '2018-08-02 15:24:35', '2018-08-02 15:24:44');
INSERT INTO `answers` VALUES ('119', 'Sed id velit justo.', null, '34', '2018-08-02 15:24:44', '2018-08-02 15:24:44');
INSERT INTO `answers` VALUES ('120', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '1', '35', '2018-08-02 15:25:36', '2018-08-02 15:25:39');
INSERT INTO `answers` VALUES ('121', 'Nam eu arcu et diam efficitur vestibulum.', null, '35', '2018-08-02 15:25:36', '2018-08-02 15:25:39');
INSERT INTO `answers` VALUES ('122', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', null, '36', '2018-08-02 15:25:51', '2018-08-02 15:25:51');
INSERT INTO `answers` VALUES ('123', 'Nam eu arcu et diam efficitur vestibulum.', null, '36', '2018-08-02 15:25:51', '2018-08-02 15:25:51');
INSERT INTO `answers` VALUES ('124', 'Duis at vulputate nunc.', '1', '36', '2018-08-02 15:25:51', '2018-08-02 15:25:51');
INSERT INTO `answers` VALUES ('125', 'Sed id velit justo.', null, '36', '2018-08-02 15:25:51', '2018-08-02 15:25:51');
INSERT INTO `answers` VALUES ('126', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', null, '37', '2018-08-02 15:26:02', '2018-08-02 15:26:05');
INSERT INTO `answers` VALUES ('127', 'Nam eu arcu et diam efficitur vestibulum.', '1', '37', '2018-08-02 15:26:02', '2018-08-02 15:26:05');
INSERT INTO `answers` VALUES ('128', 'Duis at vulputate nunc.', '1', '37', '2018-08-02 15:26:02', '2018-08-02 15:26:05');
INSERT INTO `answers` VALUES ('129', 'Sed id velit justo.', null, '37', '2018-08-02 15:26:02', '2018-08-02 15:26:05');
INSERT INTO `answers` VALUES ('130', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', null, '38', '2018-08-02 15:26:15', '2018-08-02 15:26:15');
INSERT INTO `answers` VALUES ('131', 'Nam eu arcu et diam efficitur vestibulum.', '1', '38', '2018-08-02 15:26:15', '2018-08-02 15:26:15');
INSERT INTO `answers` VALUES ('132', 'Duis at vulputate nunc.', null, '38', '2018-08-02 15:26:15', '2018-08-02 15:26:15');
INSERT INTO `answers` VALUES ('133', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', null, '39', '2018-08-02 15:26:26', '2018-08-02 15:26:26');
INSERT INTO `answers` VALUES ('134', 'Nam eu arcu et diam efficitur vestibulum.', '1', '39', '2018-08-02 15:26:26', '2018-08-02 15:26:26');
INSERT INTO `answers` VALUES ('135', 'Duis at vulputate nunc.', null, '39', '2018-08-02 15:26:26', '2018-08-02 15:26:26');
INSERT INTO `answers` VALUES ('136', 'Sed id velit justo.', null, '39', '2018-08-02 15:26:26', '2018-08-02 15:26:26');
INSERT INTO `answers` VALUES ('137', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '1', '40', '2018-08-02 15:26:47', '2018-08-02 15:26:47');
INSERT INTO `answers` VALUES ('138', 'Nam eu arcu et diam efficitur vestibulum.', null, '40', '2018-08-02 15:26:47', '2018-08-02 15:26:47');
INSERT INTO `answers` VALUES ('139', 'Duis at vulputate nunc.', '1', '40', '2018-08-02 15:26:47', '2018-08-02 15:26:47');
INSERT INTO `answers` VALUES ('140', 'Sed id velit justo.', null, '40', '2018-08-02 15:26:47', '2018-08-02 15:26:47');
INSERT INTO `answers` VALUES ('141', 'Quisque blandit nulla ut magna dapibus, quis suscipit augue consequat. ', '1', '40', '2018-08-02 15:26:47', '2018-08-02 15:26:47');
INSERT INTO `answers` VALUES ('143', 'Ut feugiat venenatis nunc, et ullamcorper dui sodales eget.', null, '40', '2018-08-02 15:26:47', '2018-08-02 15:26:47');
INSERT INTO `answers` VALUES ('144', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '1', '41', '2018-08-02 15:26:56', '2018-08-02 15:26:56');
INSERT INTO `answers` VALUES ('145', 'Nam eu arcu et diam efficitur vestibulum.', null, '41', '2018-08-02 15:26:56', '2018-08-02 15:26:56');
INSERT INTO `answers` VALUES ('146', 'Duis at vulputate nunc.', null, '41', '2018-08-02 15:26:56', '2018-08-02 15:26:56');
INSERT INTO `answers` VALUES ('147', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', null, '42', '2018-08-02 15:27:07', '2018-08-02 15:27:07');
INSERT INTO `answers` VALUES ('148', 'Nam eu arcu et diam efficitur vestibulum.', '1', '42', '2018-08-02 15:27:07', '2018-08-02 15:27:07');
INSERT INTO `answers` VALUES ('149', 'Maecenas fermentum porttitor sapien a tempor.', null, '43', '2018-08-02 18:18:03', '2018-08-02 20:46:41');
INSERT INTO `answers` VALUES ('150', 'Proin ac eros sem.', null, '43', '2018-08-02 18:18:03', '2018-08-02 20:46:41');
INSERT INTO `answers` VALUES ('151', 'Praesent lobortis arcu vitae nisl sodales, at laoreet dolor condimentum. ', null, '43', '2018-08-02 18:18:03', '2018-08-02 20:46:41');

-- ----------------------------
-- Table structure for questions
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` text,
  `quiz_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of questions
-- ----------------------------
INSERT INTO `questions` VALUES ('33', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '67', 'single', '2018-08-02 15:22:11', '2018-08-02 20:46:37');
INSERT INTO `questions` VALUES ('31', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '67', 'single', '2018-08-02 15:22:08', '2018-08-02 15:22:52');
INSERT INTO `questions` VALUES ('32', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '67', 'multiple', '2018-08-02 15:22:10', '2018-08-02 15:23:20');
INSERT INTO `questions` VALUES ('34', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '41', 'single', '2018-08-02 15:24:15', '2018-08-02 15:24:44');
INSERT INTO `questions` VALUES ('35', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '41', 'single', '2018-08-02 15:25:21', '2018-08-02 15:25:39');
INSERT INTO `questions` VALUES ('36', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '41', 'single', '2018-08-02 15:25:23', '2018-08-02 15:25:51');
INSERT INTO `questions` VALUES ('37', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '40', 'multiple', '2018-08-02 15:25:23', '2018-08-02 15:26:05');
INSERT INTO `questions` VALUES ('38', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '40', 'single', '2018-08-02 15:25:24', '2018-08-02 15:26:15');
INSERT INTO `questions` VALUES ('39', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '40', 'single', '2018-08-02 15:25:26', '2018-08-02 15:26:26');
INSERT INTO `questions` VALUES ('40', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '39', 'multiple', '2018-08-02 15:25:26', '2018-08-02 15:26:47');
INSERT INTO `questions` VALUES ('41', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '39', 'single', '2018-08-02 15:25:27', '2018-08-02 15:26:56');
INSERT INTO `questions` VALUES ('42', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '38', 'single', '2018-08-02 15:25:28', '2018-08-02 15:27:07');
INSERT INTO `questions` VALUES ('43', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '109', 'single', '2018-08-02 17:42:33', '2018-08-02 20:46:41');

-- ----------------------------
-- Table structure for quiz
-- ----------------------------
DROP TABLE IF EXISTS `quiz`;
CREATE TABLE `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of quiz
-- ----------------------------
INSERT INTO `quiz` VALUES ('38', 'Assuntos Gerais', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '2018-08-01 19:47:19', '2018-08-02 00:02:44');
INSERT INTO `quiz` VALUES ('39', 'Programação', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '2018-08-01 19:47:19', '2018-08-01 21:18:16');
INSERT INTO `quiz` VALUES ('40', 'Saúde', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '2018-08-01 19:47:19', '2018-08-01 21:16:07');
INSERT INTO `quiz` VALUES ('41', 'Vida & Bem Estar', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '2018-08-01 19:47:19', '2018-08-01 19:47:19');
INSERT INTO `quiz` VALUES ('67', 'Teste de Tópico', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '2018-08-01 19:47:19', '2018-08-02 11:02:51');
INSERT INTO `quiz` VALUES ('109', 'Outro Tópico', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus eleifend massa, nec egestas turpis ultricies sed. Nam sit amet ipsum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget pulvinar metus. Sed vulputate at dui at tincidunt. Curabitur aliquet nisl lectus, at posuere enim fringilla ut. Aliquam vel luctus sapien.', '2018-08-02 17:42:21', '2018-08-02 22:49:44');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `register_at` datetime DEFAULT NULL,
  `login_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'A', 'Trezzo', 'trezo@trezo.com', 'senha', null, null);
INSERT INTO `users` VALUES ('2', 'U', 'Paulo Sérgio', 'web.paulosergio@gmail.com', null, '2018-08-02 15:53:08', '2018-08-02 19:04:27');
INSERT INTO `users` VALUES ('3', 'U', 'Teste', 'teste@teste.com', null, '2018-08-02 18:48:03', '2018-08-02 18:48:48');

-- ----------------------------
-- Table structure for user_answers
-- ----------------------------
DROP TABLE IF EXISTS `user_answers`;
CREATE TABLE `user_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` int(11) DEFAULT NULL,
  `is_correct` int(11) DEFAULT NULL,
  `started_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_answers
-- ----------------------------
INSERT INTO `user_answers` VALUES ('9', '3', '41', '34', '116', null, '2018-08-02 18:35:58', '2018-08-02 18:36:09');
INSERT INTO `user_answers` VALUES ('10', '2', '41', '35', '120', '1', '2018-08-02 18:36:09', '2018-08-02 18:38:25');
INSERT INTO `user_answers` VALUES ('11', '2', '41', '36', '123', null, '2018-08-02 18:36:09', '2018-08-02 18:39:25');
INSERT INTO `user_answers` VALUES ('12', '3', '40', '37', '127', null, '2018-08-02 18:52:46', '2018-08-02 19:52:50');
INSERT INTO `user_answers` VALUES ('13', '2', '40', '38', '132', null, '2018-08-02 18:52:46', '2018-08-02 19:52:50');
INSERT INTO `user_answers` VALUES ('14', '2', '40', '39', '136', null, '2018-08-02 18:52:46', '2018-08-02 19:52:50');
INSERT INTO `user_answers` VALUES ('15', '2', '39', '40', '137', null, '2018-08-02 18:54:17', '2018-08-02 18:59:20');
INSERT INTO `user_answers` VALUES ('16', '2', '39', '41', '146', null, '2018-08-02 18:54:20', '2018-08-02 18:55:25');
INSERT INTO `user_answers` VALUES ('17', '2', '38', '42', '148', '1', '2018-08-02 18:55:55', '2018-08-02 19:55:58');
INSERT INTO `user_answers` VALUES ('18', '3', '67', '31', '103', null, '2018-08-02 19:04:32', '2018-08-02 19:24:37');
INSERT INTO `user_answers` VALUES ('19', '2', '67', '32', '110', null, '2018-08-02 19:04:32', '2018-08-02 19:24:37');
INSERT INTO `user_answers` VALUES ('20', '2', '67', '33', '114', null, '2018-08-02 19:04:32', '2018-08-02 19:24:37');
INSERT INTO `user_answers` VALUES ('21', '1', '40', '37', '128', null, '2018-08-02 22:42:39', '2018-08-02 22:53:58');
INSERT INTO `user_answers` VALUES ('22', '1', '40', '38', '130', null, '2018-08-02 22:42:39', '2018-08-02 22:53:58');
INSERT INTO `user_answers` VALUES ('23', '1', '40', '39', '134', null, '2018-08-02 22:42:39', '2018-08-02 22:53:58');
INSERT INTO `user_answers` VALUES ('24', '1', '41', '36', '122', null, '2018-08-02 22:46:19', '2018-08-02 22:56:23');
