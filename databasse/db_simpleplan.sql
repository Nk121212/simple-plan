/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_simpleplan

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-02-08 14:44:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sp_confirmation_log
-- ----------------------------
DROP TABLE IF EXISTS `sp_confirmation_log`;
CREATE TABLE `sp_confirmation_log` (
  `email` varchar(255) NOT NULL DEFAULT '',
  `otp` varchar(50) NOT NULL DEFAULT '',
  `valid_until` datetime DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of sp_confirmation_log
-- ----------------------------
INSERT INTO `sp_confirmation_log` VALUES ('alradjendra0510@gmail.com', 'STXem', '2021-02-08 14:36:08');
INSERT INTO `sp_confirmation_log` VALUES ('helper001@gmail.com', '6Iv1m', '2021-02-08 14:37:09');
INSERT INTO `sp_confirmation_log` VALUES ('helper002@gmail.com', 'bEmU0', '2021-02-08 14:37:55');
INSERT INTO `sp_confirmation_log` VALUES ('setiawankahfii@gmail.com', 'm1kcR', '2021-02-08 14:33:06');
INSERT INTO `sp_confirmation_log` VALUES ('warlyansyah@gmail.com', 'lbUZV', '2021-02-08 14:40:36');

-- ----------------------------
-- Table structure for sp_purpose
-- ----------------------------
DROP TABLE IF EXISTS `sp_purpose`;
CREATE TABLE `sp_purpose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_user` varchar(100) NOT NULL,
  `purpose` varchar(100) DEFAULT '',
  `rating` varchar(5) DEFAULT '',
  `attachment` varchar(255) DEFAULT '',
  `comment` varchar(255) DEFAULT '',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `add_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`,`email_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of sp_purpose
-- ----------------------------

-- ----------------------------
-- Table structure for sp_purpose_helper
-- ----------------------------
DROP TABLE IF EXISTS `sp_purpose_helper`;
CREATE TABLE `sp_purpose_helper` (
  `id_purpose` int(11) DEFAULT NULL,
  `email_helper` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of sp_purpose_helper
-- ----------------------------

-- ----------------------------
-- Table structure for sp_task_progress
-- ----------------------------
DROP TABLE IF EXISTS `sp_task_progress`;
CREATE TABLE `sp_task_progress` (
  `id_purpose` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  `progress` varchar(4) DEFAULT NULL,
  `add_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_purpose`,`id_task`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of sp_task_progress
-- ----------------------------

-- ----------------------------
-- Table structure for sp_task_purpose
-- ----------------------------
DROP TABLE IF EXISTS `sp_task_purpose`;
CREATE TABLE `sp_task_purpose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_purpose` int(11) NOT NULL,
  `email_helper` varchar(100) DEFAULT '' COMMENT 'add by = email user yang add',
  `task` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `rating` varchar(4) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `add_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`,`id_purpose`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of sp_task_purpose
-- ----------------------------

-- ----------------------------
-- Table structure for sp_user
-- ----------------------------
DROP TABLE IF EXISTS `sp_user`;
CREATE TABLE `sp_user` (
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of sp_user
-- ----------------------------
INSERT INTO `sp_user` VALUES ('alradjendra0510@gmail.com', '$2y$10$0Y7c0WSmvYdHQiHUnMgMhutDtwcKIexnJP.8oMGF1psZqvd..khkq', 'AL', 'Amin', '1');
INSERT INTO `sp_user` VALUES ('helper001@gmail.com', '$2y$10$yiBBmfk.p6beF3Vh9rOy/uFFD2sFTYb6NY0Nv1ZvATBgZuIeMKFne', 'Helper', '001', '1');
INSERT INTO `sp_user` VALUES ('helper002@gmail.com', '$2y$10$omlrnELbeMaiM6RZWgzytO821BVvwdL/gY.AdVnFNTUiB/kD9YkLC', 'Helper', '002', '1');
INSERT INTO `sp_user` VALUES ('warlyansyah@gmail.com', '$2y$10$5J09ABDQamen8KOYilXBFundRUQTD.CV0YQGVVk0GDj96S6JjSjrK', 'Warlian', 'syah', '1');
