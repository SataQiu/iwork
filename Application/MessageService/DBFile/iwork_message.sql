/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : iwork

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2014-11-30 23:27:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `iwork_message`
-- ----------------------------
DROP TABLE IF EXISTS `iwork_message`;
CREATE TABLE `iwork_message` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL COMMENT '消息内容',
  `send_uid` int(11) NOT NULL COMMENT '消息发送者ID',
  `message_type` int(11) NOT NULL COMMENT '消息类型',
  `level` int(11) NOT NULL COMMENT '消息级别',
  `create_time` datetime NOT NULL COMMENT '通知日期时间',
  `is_undo` tinyint(4) NOT NULL,
  `undo_time` datetime NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  `delete_time` datetime NOT NULL,
  `receiver_type` int(11) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iwork_message
-- ----------------------------
