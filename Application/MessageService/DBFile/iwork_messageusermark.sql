/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : iwork

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2014-11-30 23:27:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `iwork_messageusermark`
-- ----------------------------
DROP TABLE IF EXISTS `iwork_messageusermark`;
CREATE TABLE `iwork_messageusermark` (
  `mum_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `is_read` tinyint(4) NOT NULL,
  `read_time` datetime NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  `delete_time` datetime NOT NULL,
  PRIMARY KEY (`mum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iwork_messageusermark
-- ----------------------------
