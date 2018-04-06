/*
Navicat MySQL Data Transfer

Source Server         : hk
Source Server Version : 50638
Source Host           : 118.193.226.130:3306
Source Database       : tingther_ting

Target Server Type    : MYSQL
Target Server Version : 50638
File Encoding         : 65001

Date: 2018-04-06 15:17:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ti_admin
-- ----------------------------
DROP TABLE IF EXISTS `ti_admin`;
CREATE TABLE `ti_admin` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(30) NOT NULL DEFAULT '' COMMENT '登录账号',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名字',
  `passwd` char(40) NOT NULL DEFAULT '' COMMENT '密码',
  `tel` char(11) NOT NULL DEFAULT '' COMMENT '联系电话',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮件',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启用：1表示启用；0表示禁用',
  `is_del` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否删除：1表示未删除；0表示删除',
  `add_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ti_admin
-- ----------------------------
INSERT INTO `ti_admin` VALUES ('1', 'ti_admin', '管理员', 'e10adc3949ba59abbe56e057f20f883e', '18275697874', 'hdqjoy@163.com', '1', '1', '1522483591', '1522483591');
