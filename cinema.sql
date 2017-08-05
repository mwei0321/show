/*
Navicat MySQL Data Transfer

Source Server         : dev
Source Server Version : 50505
Source Host           : 120.76.26.165:3306
Source Database       : cinema

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-08-04 17:18:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for actor
-- ----------------------------
DROP TABLE IF EXISTS `actor`;
CREATE TABLE `actor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名字',
  `avatar` varchar(255) DEFAULT '' COMMENT '头像',
  `age` int(2) DEFAULT NULL COMMENT '年龄',
  `gender` tinyint(1) DEFAULT '1' COMMENT '性别（1.男，0.女）',
  `constellation` varchar(10) DEFAULT '' COMMENT '星座',
  `birthday` varchar(12) DEFAULT NULL COMMENT '生日',
  `address` varchar(200) DEFAULT '' COMMENT '地址',
  `intro` text COMMENT '简介',
  `praise` int(11) DEFAULT '0' COMMENT '点赞',
  `comment_num` int(11) DEFAULT '0' COMMENT '评论数',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for actor_comment
-- ----------------------------
DROP TABLE IF EXISTS `actor_comment`;
CREATE TABLE `actor_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actor_id` int(11) NOT NULL DEFAULT '0' COMMENT '演员ID',
  `reply_id` int(11) DEFAULT '0' COMMENT '回复评论id',
  `reply_mid` int(11) DEFAULT '0' COMMENT '回复用户ID',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin COMMENT '评论内容',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态（1：显示，0:隐藏）',
  `ctime` int(11) DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='节目评论表';

-- ----------------------------
-- Table structure for actor_photo
-- ----------------------------
DROP TABLE IF EXISTS `actor_photo`;
CREATE TABLE `actor_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actor_id` int(11) NOT NULL COMMENT '演员ID',
  `path` varchar(120) NOT NULL DEFAULT '' COMMENT '图片路径',
  `size` varchar(20) NOT NULL DEFAULT '0' COMMENT '大小',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态（1：显示，0:隐藏）',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for actor_praise
-- ----------------------------
DROP TABLE IF EXISTS `actor_praise`;
CREATE TABLE `actor_praise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actor_id` int(11) NOT NULL DEFAULT '0' COMMENT '演员ID',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '点赞ID',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态（1：点赞，0:隐藏）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) NOT NULL COMMENT '自动登录key',
  `password_hash` varchar(255) NOT NULL COMMENT '加密密码',
  `password_reset_token` varchar(255) DEFAULT NULL COMMENT '重置密码token',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `role` smallint(6) NOT NULL DEFAULT '10' COMMENT '角色等级',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Table structure for advert
-- ----------------------------
DROP TABLE IF EXISTS `advert`;
CREATE TABLE `advert` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) DEFAULT NULL COMMENT '标题',
  `cover` varchar(120) DEFAULT NULL,
  `content` text COMMENT '内容',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态',
  `ctime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='广告表';

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
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT '1' COMMENT '1.广告 2.动态 3.演出',
  `obj_id` int(11) DEFAULT '0' COMMENT '对象ID',
  `sort` tinyint(1) DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) DEFAULT '1',
  `ctime` int(11) DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='广告栏';

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型（1.节目 2.动态 3.演员）',
  `obj_id` int(11) NOT NULL DEFAULT '0' COMMENT '类型对象ID',
  `reply_id` int(11) NOT NULL DEFAULT '0' COMMENT '回复评论id',
  `reply_mid` int(11) NOT NULL DEFAULT '0' COMMENT '回复用户ID',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `content` tinytext COLLATE utf8mb4_bin NOT NULL COMMENT '评论内容',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态（1：显示，0:隐藏）',
  `ctime` int(11) NOT NULL DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='评论表';

-- ----------------------------
-- Table structure for dynamic
-- ----------------------------
DROP TABLE IF EXISTS `dynamic`;
CREATE TABLE `dynamic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '标题',
  `cover` varchar(120) NOT NULL DEFAULT '' COMMENT '封面',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态 （1：启动，0：禁止，2:草稿）',
  `content` text NOT NULL COMMENT '内容',
  `read_num` int(11) DEFAULT '0' COMMENT '阅读数',
  `utime` int(11) DEFAULT NULL COMMENT '更新时间',
  `praise` int(11) DEFAULT '0' COMMENT '点赞',
  `comment_num` int(11) DEFAULT '0' COMMENT '评论数',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dynamic_comment
-- ----------------------------
DROP TABLE IF EXISTS `dynamic_comment`;
CREATE TABLE `dynamic_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dynamic_id` int(11) NOT NULL DEFAULT '0' COMMENT '节目ID',
  `reply_id` int(11) DEFAULT '0' COMMENT '回复评论ID',
  `reply_mid` int(11) DEFAULT '0' COMMENT '回复用户ID',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin COMMENT '评论内容',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态（1：显示，0:隐藏）',
  `ctime` int(11) DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='节目评论表';

-- ----------------------------
-- Table structure for dynamic_praise
-- ----------------------------
DROP TABLE IF EXISTS `dynamic_praise`;
CREATE TABLE `dynamic_praise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dynamic_id` int(11) NOT NULL DEFAULT '0' COMMENT '演员ID',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '点赞ID',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态（1：点赞，0:取消）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `status` tinyint(1) DEFAULT '1' COMMENT '状态 （1：启动，0：禁止）',
  `last_login_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `cellphone` (`cellphone`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for reserved_seat
-- ----------------------------
DROP TABLE IF EXISTS `reserved_seat`;
CREATE TABLE `reserved_seat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `show_id` int(11) DEFAULT '0' COMMENT '节目ID',
  `times_id` int(11) DEFAULT '0' COMMENT '节目场次',
  `row` tinyint(2) DEFAULT '0' COMMENT '行号',
  `column` tinyint(2) DEFAULT '0' COMMENT '列号',
  `seat_id` int(11) DEFAULT '0' COMMENT '座位号',
  PRIMARY KEY (`id`),
  KEY `showId` (`show_id`),
  KEY `showTimes` (`times_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for room_seat
-- ----------------------------
DROP TABLE IF EXISTS `room_seat`;
CREATE TABLE `room_seat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int(11) DEFAULT '0' COMMENT '房间号',
  `row` tinyint(2) DEFAULT '0' COMMENT '行号',
  `column` tinyint(2) DEFAULT '0' COMMENT '列号',
  `seat_id` int(11) DEFAULT '0' COMMENT '座位数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=390 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for show
-- ----------------------------
DROP TABLE IF EXISTS `show`;
CREATE TABLE `show` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL DEFAULT '' COMMENT '标题',
  `cover` varchar(120) NOT NULL COMMENT '封面',
  `intro` text NOT NULL COMMENT '简介',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态（1:开启  0:关闭,2：暂定）',
  `duration` int(11) NOT NULL COMMENT '时长',
  `praise` int(11) DEFAULT '0' COMMENT '点赞',
  `comment_num` int(11) DEFAULT '0' COMMENT '评论数',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for show_comment
-- ----------------------------
DROP TABLE IF EXISTS `show_comment`;
CREATE TABLE `show_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `show_id` int(11) NOT NULL DEFAULT '0' COMMENT '节目ID',
  `reply_id` int(11) DEFAULT '0' COMMENT '回复评论id',
  `reply_mid` int(11) DEFAULT '0' COMMENT '回复用户ID',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin COMMENT '评论内容',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态（1：显示，0:隐藏）',
  `ctime` int(11) DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='节目评论表';

-- ----------------------------
-- Table structure for show_praise
-- ----------------------------
DROP TABLE IF EXISTS `show_praise`;
CREATE TABLE `show_praise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `show_id` int(11) NOT NULL DEFAULT '0' COMMENT '演员ID',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '点赞ID',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态（1：点赞，0:隐藏）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for show_times
-- ----------------------------
DROP TABLE IF EXISTS `show_times`;
CREATE TABLE `show_times` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `show_id` int(11) DEFAULT NULL COMMENT '节目ID',
  `room_id` tinyint(2) DEFAULT '1' COMMENT '房间号',
  `stime` int(11) DEFAULT NULL COMMENT '开始时间',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `show_id` (`show_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for start_logo
-- ----------------------------
DROP TABLE IF EXISTS `start_logo`;
CREATE TABLE `start_logo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL COMMENT '启动logo',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ticket
-- ----------------------------
DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '节日ID',
  `times_id` int(11) DEFAULT '0' COMMENT '场次',
  `order_id` int(11) DEFAULT '0' COMMENT '订单ID',
  `row` tinyint(2) DEFAULT NULL,
  `column` tinyint(2) DEFAULT NULL COMMENT '列',
  `seat_id` int(11) DEFAULT NULL COMMENT '座位号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ticket_order
-- ----------------------------
DROP TABLE IF EXISTS `ticket_order`;
CREATE TABLE `ticket_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` tinyint(2) DEFAULT '1' COMMENT '房间ID',
  `member_id` int(11) DEFAULT NULL COMMENT '会员ID',
  `show_id` int(11) DEFAULT '0' COMMENT '演出ID',
  `times_id` int(11) DEFAULT '0' COMMENT '场次',
  `code` int(11) DEFAULT '0' COMMENT '序列号',
  `ticket_num` int(11) DEFAULT '0' COMMENT '票数',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态（1:正常 5:已取票 7:退票）',
  `ctime` int(11) DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Table structure for verify_code
-- ----------------------------
DROP TABLE IF EXISTS `verify_code`;
CREATE TABLE `verify_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `cellphone` varchar(36) NOT NULL,
  `member_id` int(11) NOT NULL DEFAULT '-1',
  `type` int(11) NOT NULL COMMENT '1活动报名验证码；11注册验证码',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1有效，2过期',
  `create_time` int(11) NOT NULL,
  `dead_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COMMENT='验证码';
