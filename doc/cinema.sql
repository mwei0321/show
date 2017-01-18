/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : cinema

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-01-18 16:17:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for actor
-- ----------------------------
DROP TABLE IF EXISTS `actor`;
CREATE TABLE `actor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名字',
  `age` int(2) DEFAULT NULL COMMENT '年龄',
  `gender` tinyint(1) DEFAULT '1' COMMENT '性别（1.男，0.女）',
  `birthday` varchar(12) DEFAULT NULL COMMENT '生日',
  `address` varchar(200) DEFAULT '' COMMENT '地址',
  `intro` text COMMENT '简介',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `passwd` varchar(40) NOT NULL COMMENT '密码',
  `avatar` varchar(120) DEFAULT NULL COMMENT '头像',
  `last_login_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `static` tinyint(1) DEFAULT '1' COMMENT '状态 （1：启动，0：禁止）',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for app_logo
-- ----------------------------
DROP TABLE IF EXISTS `app_logo`;
CREATE TABLE `app_logo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(120) DEFAULT NULL COMMENT 'logo',
  `static` tinyint(1) DEFAULT '1' COMMENT '状态 （1：启动，0：禁止）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dynamic
-- ----------------------------
DROP TABLE IF EXISTS `dynamic`;
CREATE TABLE `dynamic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '标题',
  `cover` varchar(120) NOT NULL DEFAULT '' COMMENT '封面',
  `static` tinyint(4) DEFAULT '1' COMMENT '状态 （1：启动，0：禁止）',
  `content` text NOT NULL COMMENT '内容',
  `utime` int(11) DEFAULT NULL COMMENT '更新时间',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `nickname` varchar(20) DEFAULT '' COMMENT '昵称',
  `passwd` varchar(40) NOT NULL COMMENT '密码',
  `avatar` varchar(120) DEFAULT '' COMMENT '头像',
  `cellphone` varchar(15) NOT NULL DEFAULT '' COMMENT '手机号码',
  `static` tinyint(1) DEFAULT '1' COMMENT '状态 （1：启动，0：禁止）',
  `last_login_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `cellphone` (`cellphone`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for show
-- ----------------------------
DROP TABLE IF EXISTS `show`;
CREATE TABLE `show` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL DEFAULT '' COMMENT '标题',
  `cover` varchar(120) NOT NULL COMMENT '封面',
  `intro` text NOT NULL COMMENT '简介',
  `stime` int(11) DEFAULT NULL COMMENT '开始时间',
  `etime` int(11) DEFAULT NULL COMMENT '结束时间',
  `duration` int(11) NOT NULL COMMENT '时长',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for show_actor
-- ----------------------------
DROP TABLE IF EXISTS `show_actor`;
CREATE TABLE `show_actor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `show_id` int(11) DEFAULT NULL COMMENT '节目ID',
  `actor_id` int(11) DEFAULT NULL COMMENT '演员ID',
  `duty` tinyint(1) DEFAULT NULL COMMENT '职务（1.演员 2.导演）',
  `ctime` int(11) DEFAULT NULL,
  `act` varchar(30) DEFAULT '' COMMENT '扮演',
  PRIMARY KEY (`id`),
  KEY `show_actor` (`show_id`,`actor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ticket
-- ----------------------------
DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '节日ID',
  `show_id` int(11) NOT NULL,
  `row` tinyint(2) DEFAULT NULL,
  `column` tinyint(2) DEFAULT NULL COMMENT '列',
  `seat_number` int(11) DEFAULT NULL COMMENT '座位号',
  PRIMARY KEY (`id`),
  KEY `show_id` (`show_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
