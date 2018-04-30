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
  `admin_name` varchar(50) NOT NULL DEFAULT '' COMMENT '名字',
  `passwd` char(40) NOT NULL DEFAULT '' COMMENT '密码',
  `role` int(1) NOT NULL DEFAULT '0' COMMENT '角色：0超级管理员；1管理员',
  `phone` char(11) NOT NULL DEFAULT '' COMMENT '联系电话',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮件',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启用：1表示启用；0表示禁用；-1表示删除',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `delete_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='管理员表';


-- ----------------------------
-- Table structure for ti_login_log
-- ----------------------------
DROP TABLE IF EXISTS `ti_login_log`;
CREATE TABLE `ti_login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(30) NOT NULL DEFAULT '' COMMENT '登录账号',
  `ipaddr` char(11) NOT NULL DEFAULT '0' COMMENT '登录ip',
  `site` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0管理员系统登录，1应用系统登录',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '登录状态，0登录失败，包括用户名、密码、任何尝试登陆，均记录，1登录成功',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='网站登录记录表';