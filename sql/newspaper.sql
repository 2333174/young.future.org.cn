/*
Navicat MySQL Data Transfer

Source Server         : root
Source Server Version : 80015
Source Host           : localhost:3306
Source Database       : young_future

Target Server Type    : MYSQL
Target Server Version : 80015
File Encoding         : 65001

Date: 2020-02-19 23:24:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for newspaper
-- ----------------------------
DROP TABLE IF EXISTS `newspaper`;
CREATE TABLE `newspaper` (
  `title` varchar(255) NOT NULL,
  `uploadTime` datetime NOT NULL,
  `uploadPerson` varchar(255) NOT NULL,
  `viewTimes` int(11) NOT NULL,
  `coverNum` int(11) NOT NULL,
  PRIMARY KEY (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
