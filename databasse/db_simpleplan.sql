/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_simpleplan

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-01-27 09:18:02
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
  PRIMARY KEY (`email`,`otp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of sp_confirmation_log
-- ----------------------------
INSERT INTO `sp_confirmation_log` VALUES ('setiawankahfii@gmail.com', '0Ro93', '2021-01-15 17:15:41');
INSERT INTO `sp_confirmation_log` VALUES ('vdot04@gmail.com', 'n5Sqw', '2021-01-22 14:35:57');

-- ----------------------------
-- Table structure for sp_helper
-- ----------------------------
DROP TABLE IF EXISTS `sp_helper`;
CREATE TABLE `sp_helper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_purpose` int(11) NOT NULL,
  `email_user` varchar(100) DEFAULT '',
  `helper_desc` varchar(100) DEFAULT '',
  `start_date` date DEFAULT NULL,
  `interval` smallint(6) DEFAULT NULL,
  `rating` varchar(5) DEFAULT '',
  `attachment` varchar(255) DEFAULT '',
  `comment` varchar(255) DEFAULT '',
  `status` smallint(6) DEFAULT 0 COMMENT '0=belum ditanggapi, 1 = diterima, 2 = di tolak',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of sp_helper
-- ----------------------------

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_purpose` int(11) DEFAULT NULL,
  `email_helper` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of sp_purpose_helper
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
  PRIMARY KEY (`email`,`password`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of sp_user
-- ----------------------------
INSERT INTO `sp_user` VALUES ('setiawankahfii@gmail.com', '$2y$10$.6MzBEtRE03m/EZDPu.feeKds0GL7YEi6IRF8oDtpUE1MrU5IX8NW', 'Kahfi', 'Setiawan', '1');
INSERT INTO `sp_user` VALUES ('vdot04@gmail.com', '$2y$10$Tf/Z5wxRtN4KNmIHR8yQCOX0tYDYsokpg86eKEut63n7rS2r8/6jG', 'dot', 'dorot', '1');
