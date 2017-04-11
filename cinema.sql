/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : cinema

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-04-11 15:08:20
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
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of actor
-- ----------------------------
INSERT INTO `actor` VALUES ('1', 'aaaa2', '', '52', '1', null, '20150', 'aaaaa', 'aaaaa', null);
INSERT INTO `actor` VALUES ('2', 'bbbb', '', '24', '1', null, '2054', 'saaaa', 'dfdssd', null);
INSERT INTO `actor` VALUES ('3', '黄女', '/actor/2017/mw2017022206441569046.png', null, '1', '处女座', '1999', '广东', '', '1487659587');
INSERT INTO `actor` VALUES ('4', 'sniper', '/actor/2017/mw2017022206462090235.png', null, '1', '式', '20145', '工', '斯柯达塔顶\r\n地 地\r\n枯顶戴 顶替栽\r\n', '1487746028');

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
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('6', 'admin', 'aaa', '$2y$13$h9KF6JTsUyKJMCc4Occ/VuISsmCf0zZXpHDoNwy/l9hwG3dJ8fwki', '111', '111', '111', '10', '1111', '111');

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
-- Records of app_logo
-- ----------------------------

-- ----------------------------
-- Table structure for dynamic
-- ----------------------------
DROP TABLE IF EXISTS `dynamic`;
CREATE TABLE `dynamic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '标题',
  `cover` varchar(120) NOT NULL DEFAULT '' COMMENT '封面',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态 （1：启动，0：禁止）',
  `content` text NOT NULL COMMENT '内容',
  `read_num` int(11) DEFAULT '0' COMMENT '阅读数',
  `utime` int(11) DEFAULT NULL COMMENT '更新时间',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dynamic
-- ----------------------------
INSERT INTO `dynamic` VALUES ('1', '劳而无功枯地2', '', '1', '苛工顶戴 顶戴 士大夫 东走西顾 打止夺下 夺下 夺下 ', '16', null, null);
INSERT INTO `dynamic` VALUES ('2', '夺士大夫枯干 枯干', '/dynamic/2017/mw2017022206452869623.png', '1', '塔顶地工食道癌无可奈何花落去 花样百出塔顶地士大夫地花样百出花样百出花样百出花样百出塔顶地劳而无功 大师傅', '15', '1487745930', null);
INSERT INTO `dynamic` VALUES ('3', 'aaaaaaaa', '/dynamic/2017/mw2017022206454685958.png', '1', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\n\r\naaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaa', '0', null, '1487745954');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('1', 'abc', 'asdfasd', 'd9b1d7db4cd6e70935368a1efb10e377', '', '18665857320', '1', null, '1487127623');
INSERT INTO `member` VALUES ('2', 'Iamxiaokang', '', '14e1b600b1fd579f47433b88e8d85291', 'http://stage2.getop.cc/avatar/2017/7c3fd260eecae5c871ead227568335b1.png', '15102011866', '1', null, '1487230295');
INSERT INTO `member` VALUES ('3', 'hupozhu', '', '2f7b52aacfbf6f44e13d27656ecb1f59', 'http://stage2.getop.cc/avatar/2017/avatar.jpg', '17710166380', '1', null, '1487314452');
INSERT INTO `member` VALUES ('4', 'abqsxz7', '', 'd7afde3e7059cd0a0fe09eec4b0008cd', 'http://stage2.getop.cc/avatar/2017/516be704688013a0d8f669810bec0783.png', '18102727238', '1', null, '1487644048');
INSERT INTO `member` VALUES ('5', 'abqsxz', '', 'dc0ae7e1387be9b795f5d6299e383759', '', '18102727230', '1', null, '1487663941');
INSERT INTO `member` VALUES ('6', 'ab', '', 'd7afde3e7059cd0a0fe09eec4b0008cd', '', '18102727232', '1', null, '1487663987');
INSERT INTO `member` VALUES ('7', 'jk', '', 'ff9dcefbad5545557485549e15eccfa4', '', '18102727233', '1', null, '1487664184');
INSERT INTO `member` VALUES ('8', 'aw', '', 'd8cbec4d46e7f421213bab17b89e8174', '', '18102727234', '1', null, '1487664765');

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
-- Records of reserved_seat
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1168 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of room_seat
-- ----------------------------
INSERT INTO `room_seat` VALUES ('1167', '1', '15', '1', '361');
INSERT INTO `room_seat` VALUES ('1166', '1', '15', '2', '362');
INSERT INTO `room_seat` VALUES ('1165', '1', '15', '3', '363');
INSERT INTO `room_seat` VALUES ('1164', '1', '15', '4', '364');
INSERT INTO `room_seat` VALUES ('1163', '1', '15', '5', '365');
INSERT INTO `room_seat` VALUES ('1162', '1', '15', '6', '366');
INSERT INTO `room_seat` VALUES ('1161', '1', '15', '7', '367');
INSERT INTO `room_seat` VALUES ('1160', '1', '15', '8', '368');
INSERT INTO `room_seat` VALUES ('1159', '1', '15', '9', '369');
INSERT INTO `room_seat` VALUES ('1158', '1', '15', '10', '370');
INSERT INTO `room_seat` VALUES ('1157', '1', '15', '11', '371');
INSERT INTO `room_seat` VALUES ('1156', '1', '15', '12', '372');
INSERT INTO `room_seat` VALUES ('1155', '1', '15', '13', '373');
INSERT INTO `room_seat` VALUES ('1154', '1', '15', '14', '374');
INSERT INTO `room_seat` VALUES ('1153', '1', '15', '15', '375');
INSERT INTO `room_seat` VALUES ('1152', '1', '15', '16', '376');
INSERT INTO `room_seat` VALUES ('1151', '1', '15', '17', '377');
INSERT INTO `room_seat` VALUES ('1150', '1', '15', '18', '378');
INSERT INTO `room_seat` VALUES ('1149', '1', '15', '19', '379');
INSERT INTO `room_seat` VALUES ('1148', '1', '15', '20', '380');
INSERT INTO `room_seat` VALUES ('1147', '1', '15', '21', '381');
INSERT INTO `room_seat` VALUES ('1146', '1', '15', '22', '382');
INSERT INTO `room_seat` VALUES ('1145', '1', '15', '23', '383');
INSERT INTO `room_seat` VALUES ('1144', '1', '15', '24', '384');
INSERT INTO `room_seat` VALUES ('1143', '1', '15', '25', '385');
INSERT INTO `room_seat` VALUES ('1142', '1', '15', '26', '386');
INSERT INTO `room_seat` VALUES ('1141', '1', '15', '27', '387');
INSERT INTO `room_seat` VALUES ('1140', '1', '15', '28', '388');
INSERT INTO `room_seat` VALUES ('1139', '1', '15', '29', '389');
INSERT INTO `room_seat` VALUES ('1138', '1', '14', '1', '333');
INSERT INTO `room_seat` VALUES ('1137', '1', '14', '2', '334');
INSERT INTO `room_seat` VALUES ('1136', '1', '14', '3', '335');
INSERT INTO `room_seat` VALUES ('1135', '1', '14', '4', '336');
INSERT INTO `room_seat` VALUES ('1134', '1', '14', '5', '337');
INSERT INTO `room_seat` VALUES ('1133', '1', '14', '6', '338');
INSERT INTO `room_seat` VALUES ('1132', '1', '14', '7', '339');
INSERT INTO `room_seat` VALUES ('1131', '1', '14', '8', '340');
INSERT INTO `room_seat` VALUES ('1130', '1', '14', '9', '341');
INSERT INTO `room_seat` VALUES ('1129', '1', '14', '10', '342');
INSERT INTO `room_seat` VALUES ('1128', '1', '14', '11', '343');
INSERT INTO `room_seat` VALUES ('1127', '1', '14', '12', '344');
INSERT INTO `room_seat` VALUES ('1126', '1', '14', '13', '345');
INSERT INTO `room_seat` VALUES ('1125', '1', '14', '14', '346');
INSERT INTO `room_seat` VALUES ('1124', '1', '14', '15', '347');
INSERT INTO `room_seat` VALUES ('1123', '1', '14', '16', '348');
INSERT INTO `room_seat` VALUES ('1122', '1', '14', '17', '349');
INSERT INTO `room_seat` VALUES ('1121', '1', '14', '18', '350');
INSERT INTO `room_seat` VALUES ('1120', '1', '14', '19', '351');
INSERT INTO `room_seat` VALUES ('1119', '1', '14', '20', '352');
INSERT INTO `room_seat` VALUES ('1118', '1', '14', '21', '353');
INSERT INTO `room_seat` VALUES ('1117', '1', '14', '22', '354');
INSERT INTO `room_seat` VALUES ('1116', '1', '14', '23', '355');
INSERT INTO `room_seat` VALUES ('1115', '1', '14', '24', '356');
INSERT INTO `room_seat` VALUES ('1114', '1', '14', '25', '357');
INSERT INTO `room_seat` VALUES ('1113', '1', '14', '26', '358');
INSERT INTO `room_seat` VALUES ('1112', '1', '14', '27', '359');
INSERT INTO `room_seat` VALUES ('1111', '1', '14', '28', '360');
INSERT INTO `room_seat` VALUES ('1110', '1', '13', '1', '305');
INSERT INTO `room_seat` VALUES ('1109', '1', '13', '2', '306');
INSERT INTO `room_seat` VALUES ('1108', '1', '13', '3', '307');
INSERT INTO `room_seat` VALUES ('1107', '1', '13', '4', '308');
INSERT INTO `room_seat` VALUES ('1106', '1', '13', '5', '309');
INSERT INTO `room_seat` VALUES ('1105', '1', '13', '6', '310');
INSERT INTO `room_seat` VALUES ('1104', '1', '13', '7', '311');
INSERT INTO `room_seat` VALUES ('1103', '1', '13', '8', '312');
INSERT INTO `room_seat` VALUES ('1102', '1', '13', '9', '313');
INSERT INTO `room_seat` VALUES ('1101', '1', '13', '10', '314');
INSERT INTO `room_seat` VALUES ('1100', '1', '13', '11', '315');
INSERT INTO `room_seat` VALUES ('1099', '1', '13', '12', '316');
INSERT INTO `room_seat` VALUES ('1098', '1', '13', '13', '317');
INSERT INTO `room_seat` VALUES ('1097', '1', '13', '14', '318');
INSERT INTO `room_seat` VALUES ('1096', '1', '13', '15', '319');
INSERT INTO `room_seat` VALUES ('1095', '1', '13', '16', '320');
INSERT INTO `room_seat` VALUES ('1094', '1', '13', '17', '321');
INSERT INTO `room_seat` VALUES ('1093', '1', '13', '18', '322');
INSERT INTO `room_seat` VALUES ('1092', '1', '13', '19', '323');
INSERT INTO `room_seat` VALUES ('1091', '1', '13', '20', '324');
INSERT INTO `room_seat` VALUES ('1090', '1', '13', '21', '325');
INSERT INTO `room_seat` VALUES ('1089', '1', '13', '22', '326');
INSERT INTO `room_seat` VALUES ('1088', '1', '13', '23', '327');
INSERT INTO `room_seat` VALUES ('1087', '1', '13', '24', '328');
INSERT INTO `room_seat` VALUES ('1086', '1', '13', '25', '329');
INSERT INTO `room_seat` VALUES ('1085', '1', '13', '26', '330');
INSERT INTO `room_seat` VALUES ('1084', '1', '13', '27', '331');
INSERT INTO `room_seat` VALUES ('1083', '1', '13', '28', '332');
INSERT INTO `room_seat` VALUES ('1082', '1', '12', '1', '282');
INSERT INTO `room_seat` VALUES ('1081', '1', '12', '2', '283');
INSERT INTO `room_seat` VALUES ('1080', '1', '12', '3', '284');
INSERT INTO `room_seat` VALUES ('1079', '1', '12', '4', '285');
INSERT INTO `room_seat` VALUES ('1078', '1', '12', '5', '286');
INSERT INTO `room_seat` VALUES ('1077', '1', '12', '6', '287');
INSERT INTO `room_seat` VALUES ('1076', '1', '12', '7', '288');
INSERT INTO `room_seat` VALUES ('1075', '1', '12', '8', '289');
INSERT INTO `room_seat` VALUES ('1074', '1', '12', '9', '290');
INSERT INTO `room_seat` VALUES ('1073', '1', '12', '10', '291');
INSERT INTO `room_seat` VALUES ('1072', '1', '12', '11', '292');
INSERT INTO `room_seat` VALUES ('1071', '1', '12', '12', '293');
INSERT INTO `room_seat` VALUES ('1070', '1', '12', '13', '294');
INSERT INTO `room_seat` VALUES ('1069', '1', '12', '14', '295');
INSERT INTO `room_seat` VALUES ('1068', '1', '12', '15', '296');
INSERT INTO `room_seat` VALUES ('1067', '1', '12', '16', '297');
INSERT INTO `room_seat` VALUES ('1066', '1', '12', '17', '298');
INSERT INTO `room_seat` VALUES ('1065', '1', '12', '18', '299');
INSERT INTO `room_seat` VALUES ('1064', '1', '12', '19', '300');
INSERT INTO `room_seat` VALUES ('1063', '1', '12', '20', '301');
INSERT INTO `room_seat` VALUES ('1062', '1', '12', '21', '302');
INSERT INTO `room_seat` VALUES ('1061', '1', '12', '22', '303');
INSERT INTO `room_seat` VALUES ('1060', '1', '12', '23', '304');
INSERT INTO `room_seat` VALUES ('1059', '1', '11', '1', '259');
INSERT INTO `room_seat` VALUES ('1058', '1', '11', '2', '260');
INSERT INTO `room_seat` VALUES ('1057', '1', '11', '3', '261');
INSERT INTO `room_seat` VALUES ('1056', '1', '11', '4', '262');
INSERT INTO `room_seat` VALUES ('1055', '1', '11', '5', '263');
INSERT INTO `room_seat` VALUES ('1054', '1', '11', '6', '264');
INSERT INTO `room_seat` VALUES ('1053', '1', '11', '7', '265');
INSERT INTO `room_seat` VALUES ('1052', '1', '11', '8', '266');
INSERT INTO `room_seat` VALUES ('1051', '1', '11', '9', '267');
INSERT INTO `room_seat` VALUES ('1050', '1', '11', '10', '268');
INSERT INTO `room_seat` VALUES ('1049', '1', '11', '11', '269');
INSERT INTO `room_seat` VALUES ('1048', '1', '11', '12', '270');
INSERT INTO `room_seat` VALUES ('1047', '1', '11', '13', '271');
INSERT INTO `room_seat` VALUES ('1046', '1', '11', '14', '272');
INSERT INTO `room_seat` VALUES ('1045', '1', '11', '15', '273');
INSERT INTO `room_seat` VALUES ('1044', '1', '11', '16', '274');
INSERT INTO `room_seat` VALUES ('1043', '1', '11', '17', '275');
INSERT INTO `room_seat` VALUES ('1042', '1', '11', '18', '276');
INSERT INTO `room_seat` VALUES ('1041', '1', '11', '19', '277');
INSERT INTO `room_seat` VALUES ('1040', '1', '11', '20', '278');
INSERT INTO `room_seat` VALUES ('1039', '1', '11', '21', '279');
INSERT INTO `room_seat` VALUES ('1038', '1', '11', '22', '280');
INSERT INTO `room_seat` VALUES ('1037', '1', '11', '23', '281');
INSERT INTO `room_seat` VALUES ('1036', '1', '10', '1', '236');
INSERT INTO `room_seat` VALUES ('1035', '1', '10', '2', '237');
INSERT INTO `room_seat` VALUES ('1034', '1', '10', '3', '238');
INSERT INTO `room_seat` VALUES ('1033', '1', '10', '4', '239');
INSERT INTO `room_seat` VALUES ('1032', '1', '10', '5', '240');
INSERT INTO `room_seat` VALUES ('1031', '1', '10', '6', '241');
INSERT INTO `room_seat` VALUES ('1030', '1', '10', '7', '242');
INSERT INTO `room_seat` VALUES ('1029', '1', '10', '8', '243');
INSERT INTO `room_seat` VALUES ('1028', '1', '10', '9', '244');
INSERT INTO `room_seat` VALUES ('1027', '1', '10', '10', '245');
INSERT INTO `room_seat` VALUES ('1026', '1', '10', '11', '246');
INSERT INTO `room_seat` VALUES ('1025', '1', '10', '12', '247');
INSERT INTO `room_seat` VALUES ('1024', '1', '10', '13', '248');
INSERT INTO `room_seat` VALUES ('1023', '1', '10', '14', '249');
INSERT INTO `room_seat` VALUES ('1022', '1', '10', '15', '250');
INSERT INTO `room_seat` VALUES ('1021', '1', '10', '16', '251');
INSERT INTO `room_seat` VALUES ('1020', '1', '10', '17', '252');
INSERT INTO `room_seat` VALUES ('1019', '1', '10', '18', '253');
INSERT INTO `room_seat` VALUES ('1018', '1', '10', '19', '254');
INSERT INTO `room_seat` VALUES ('1017', '1', '10', '20', '255');
INSERT INTO `room_seat` VALUES ('1016', '1', '10', '21', '256');
INSERT INTO `room_seat` VALUES ('1015', '1', '10', '22', '257');
INSERT INTO `room_seat` VALUES ('1014', '1', '10', '23', '258');
INSERT INTO `room_seat` VALUES ('1013', '1', '9', '1', '213');
INSERT INTO `room_seat` VALUES ('1012', '1', '9', '2', '214');
INSERT INTO `room_seat` VALUES ('1011', '1', '9', '3', '215');
INSERT INTO `room_seat` VALUES ('1010', '1', '9', '4', '216');
INSERT INTO `room_seat` VALUES ('1009', '1', '9', '5', '217');
INSERT INTO `room_seat` VALUES ('1008', '1', '9', '6', '218');
INSERT INTO `room_seat` VALUES ('1007', '1', '9', '7', '219');
INSERT INTO `room_seat` VALUES ('1006', '1', '9', '8', '220');
INSERT INTO `room_seat` VALUES ('1005', '1', '9', '9', '221');
INSERT INTO `room_seat` VALUES ('1004', '1', '9', '10', '222');
INSERT INTO `room_seat` VALUES ('1003', '1', '9', '11', '223');
INSERT INTO `room_seat` VALUES ('1002', '1', '9', '12', '224');
INSERT INTO `room_seat` VALUES ('1001', '1', '9', '13', '225');
INSERT INTO `room_seat` VALUES ('1000', '1', '9', '14', '226');
INSERT INTO `room_seat` VALUES ('999', '1', '9', '15', '227');
INSERT INTO `room_seat` VALUES ('998', '1', '9', '16', '228');
INSERT INTO `room_seat` VALUES ('997', '1', '9', '17', '229');
INSERT INTO `room_seat` VALUES ('996', '1', '9', '18', '230');
INSERT INTO `room_seat` VALUES ('995', '1', '9', '19', '231');
INSERT INTO `room_seat` VALUES ('994', '1', '9', '20', '232');
INSERT INTO `room_seat` VALUES ('993', '1', '9', '21', '233');
INSERT INTO `room_seat` VALUES ('992', '1', '9', '22', '234');
INSERT INTO `room_seat` VALUES ('991', '1', '9', '23', '235');
INSERT INTO `room_seat` VALUES ('990', '1', '8', '1', '190');
INSERT INTO `room_seat` VALUES ('989', '1', '8', '2', '191');
INSERT INTO `room_seat` VALUES ('988', '1', '8', '3', '192');
INSERT INTO `room_seat` VALUES ('987', '1', '8', '4', '193');
INSERT INTO `room_seat` VALUES ('986', '1', '8', '5', '194');
INSERT INTO `room_seat` VALUES ('985', '1', '8', '6', '195');
INSERT INTO `room_seat` VALUES ('984', '1', '8', '7', '196');
INSERT INTO `room_seat` VALUES ('983', '1', '8', '8', '197');
INSERT INTO `room_seat` VALUES ('982', '1', '8', '9', '198');
INSERT INTO `room_seat` VALUES ('981', '1', '8', '10', '199');
INSERT INTO `room_seat` VALUES ('980', '1', '8', '11', '200');
INSERT INTO `room_seat` VALUES ('979', '1', '8', '12', '201');
INSERT INTO `room_seat` VALUES ('978', '1', '8', '13', '202');
INSERT INTO `room_seat` VALUES ('977', '1', '8', '14', '203');
INSERT INTO `room_seat` VALUES ('976', '1', '8', '15', '204');
INSERT INTO `room_seat` VALUES ('975', '1', '8', '16', '205');
INSERT INTO `room_seat` VALUES ('974', '1', '8', '17', '206');
INSERT INTO `room_seat` VALUES ('973', '1', '8', '18', '207');
INSERT INTO `room_seat` VALUES ('972', '1', '8', '19', '208');
INSERT INTO `room_seat` VALUES ('971', '1', '8', '20', '209');
INSERT INTO `room_seat` VALUES ('970', '1', '8', '21', '210');
INSERT INTO `room_seat` VALUES ('969', '1', '8', '22', '211');
INSERT INTO `room_seat` VALUES ('968', '1', '8', '23', '212');
INSERT INTO `room_seat` VALUES ('967', '1', '7', '1', '167');
INSERT INTO `room_seat` VALUES ('966', '1', '7', '2', '168');
INSERT INTO `room_seat` VALUES ('965', '1', '7', '3', '169');
INSERT INTO `room_seat` VALUES ('964', '1', '7', '4', '170');
INSERT INTO `room_seat` VALUES ('963', '1', '7', '5', '171');
INSERT INTO `room_seat` VALUES ('962', '1', '7', '6', '172');
INSERT INTO `room_seat` VALUES ('961', '1', '7', '7', '173');
INSERT INTO `room_seat` VALUES ('960', '1', '7', '8', '174');
INSERT INTO `room_seat` VALUES ('959', '1', '7', '9', '175');
INSERT INTO `room_seat` VALUES ('958', '1', '7', '10', '176');
INSERT INTO `room_seat` VALUES ('957', '1', '7', '11', '177');
INSERT INTO `room_seat` VALUES ('956', '1', '7', '12', '178');
INSERT INTO `room_seat` VALUES ('955', '1', '7', '13', '179');
INSERT INTO `room_seat` VALUES ('954', '1', '7', '14', '180');
INSERT INTO `room_seat` VALUES ('953', '1', '7', '15', '181');
INSERT INTO `room_seat` VALUES ('952', '1', '7', '16', '182');
INSERT INTO `room_seat` VALUES ('951', '1', '7', '17', '183');
INSERT INTO `room_seat` VALUES ('950', '1', '7', '18', '184');
INSERT INTO `room_seat` VALUES ('949', '1', '7', '19', '185');
INSERT INTO `room_seat` VALUES ('948', '1', '7', '20', '186');
INSERT INTO `room_seat` VALUES ('947', '1', '7', '21', '187');
INSERT INTO `room_seat` VALUES ('946', '1', '7', '22', '188');
INSERT INTO `room_seat` VALUES ('945', '1', '7', '23', '189');
INSERT INTO `room_seat` VALUES ('944', '1', '6', '1', '139');
INSERT INTO `room_seat` VALUES ('943', '1', '6', '2', '140');
INSERT INTO `room_seat` VALUES ('942', '1', '6', '3', '141');
INSERT INTO `room_seat` VALUES ('941', '1', '6', '4', '142');
INSERT INTO `room_seat` VALUES ('940', '1', '6', '5', '143');
INSERT INTO `room_seat` VALUES ('939', '1', '6', '6', '144');
INSERT INTO `room_seat` VALUES ('938', '1', '6', '7', '145');
INSERT INTO `room_seat` VALUES ('937', '1', '6', '8', '146');
INSERT INTO `room_seat` VALUES ('936', '1', '6', '9', '147');
INSERT INTO `room_seat` VALUES ('935', '1', '6', '10', '148');
INSERT INTO `room_seat` VALUES ('934', '1', '6', '11', '149');
INSERT INTO `room_seat` VALUES ('933', '1', '6', '12', '150');
INSERT INTO `room_seat` VALUES ('932', '1', '6', '13', '151');
INSERT INTO `room_seat` VALUES ('931', '1', '6', '14', '152');
INSERT INTO `room_seat` VALUES ('930', '1', '6', '15', '153');
INSERT INTO `room_seat` VALUES ('929', '1', '6', '16', '154');
INSERT INTO `room_seat` VALUES ('928', '1', '6', '17', '155');
INSERT INTO `room_seat` VALUES ('927', '1', '6', '18', '156');
INSERT INTO `room_seat` VALUES ('926', '1', '6', '19', '157');
INSERT INTO `room_seat` VALUES ('925', '1', '6', '20', '158');
INSERT INTO `room_seat` VALUES ('924', '1', '6', '21', '159');
INSERT INTO `room_seat` VALUES ('923', '1', '6', '22', '160');
INSERT INTO `room_seat` VALUES ('922', '1', '6', '23', '161');
INSERT INTO `room_seat` VALUES ('921', '1', '6', '24', '162');
INSERT INTO `room_seat` VALUES ('920', '1', '6', '25', '163');
INSERT INTO `room_seat` VALUES ('919', '1', '6', '26', '164');
INSERT INTO `room_seat` VALUES ('918', '1', '6', '27', '165');
INSERT INTO `room_seat` VALUES ('917', '1', '6', '28', '166');
INSERT INTO `room_seat` VALUES ('916', '1', '5', '1', '111');
INSERT INTO `room_seat` VALUES ('915', '1', '5', '2', '112');
INSERT INTO `room_seat` VALUES ('914', '1', '5', '3', '113');
INSERT INTO `room_seat` VALUES ('913', '1', '5', '4', '114');
INSERT INTO `room_seat` VALUES ('912', '1', '5', '5', '115');
INSERT INTO `room_seat` VALUES ('911', '1', '5', '6', '116');
INSERT INTO `room_seat` VALUES ('910', '1', '5', '7', '117');
INSERT INTO `room_seat` VALUES ('909', '1', '5', '8', '118');
INSERT INTO `room_seat` VALUES ('908', '1', '5', '9', '119');
INSERT INTO `room_seat` VALUES ('907', '1', '5', '10', '120');
INSERT INTO `room_seat` VALUES ('906', '1', '5', '11', '121');
INSERT INTO `room_seat` VALUES ('905', '1', '5', '12', '122');
INSERT INTO `room_seat` VALUES ('904', '1', '5', '13', '123');
INSERT INTO `room_seat` VALUES ('903', '1', '5', '14', '124');
INSERT INTO `room_seat` VALUES ('902', '1', '5', '15', '125');
INSERT INTO `room_seat` VALUES ('901', '1', '5', '16', '126');
INSERT INTO `room_seat` VALUES ('900', '1', '5', '17', '127');
INSERT INTO `room_seat` VALUES ('899', '1', '5', '18', '128');
INSERT INTO `room_seat` VALUES ('898', '1', '5', '19', '129');
INSERT INTO `room_seat` VALUES ('897', '1', '5', '20', '130');
INSERT INTO `room_seat` VALUES ('896', '1', '5', '21', '131');
INSERT INTO `room_seat` VALUES ('895', '1', '5', '22', '132');
INSERT INTO `room_seat` VALUES ('894', '1', '5', '23', '133');
INSERT INTO `room_seat` VALUES ('893', '1', '5', '24', '134');
INSERT INTO `room_seat` VALUES ('892', '1', '5', '25', '135');
INSERT INTO `room_seat` VALUES ('891', '1', '5', '26', '136');
INSERT INTO `room_seat` VALUES ('890', '1', '5', '27', '137');
INSERT INTO `room_seat` VALUES ('889', '1', '5', '28', '138');
INSERT INTO `room_seat` VALUES ('888', '1', '4', '1', '83');
INSERT INTO `room_seat` VALUES ('887', '1', '4', '2', '84');
INSERT INTO `room_seat` VALUES ('886', '1', '4', '3', '85');
INSERT INTO `room_seat` VALUES ('885', '1', '4', '4', '86');
INSERT INTO `room_seat` VALUES ('884', '1', '4', '5', '87');
INSERT INTO `room_seat` VALUES ('883', '1', '4', '6', '88');
INSERT INTO `room_seat` VALUES ('882', '1', '4', '7', '89');
INSERT INTO `room_seat` VALUES ('881', '1', '4', '8', '90');
INSERT INTO `room_seat` VALUES ('880', '1', '4', '9', '91');
INSERT INTO `room_seat` VALUES ('879', '1', '4', '10', '92');
INSERT INTO `room_seat` VALUES ('878', '1', '4', '11', '93');
INSERT INTO `room_seat` VALUES ('877', '1', '4', '12', '94');
INSERT INTO `room_seat` VALUES ('876', '1', '4', '13', '95');
INSERT INTO `room_seat` VALUES ('875', '1', '4', '14', '96');
INSERT INTO `room_seat` VALUES ('874', '1', '4', '15', '97');
INSERT INTO `room_seat` VALUES ('873', '1', '4', '16', '98');
INSERT INTO `room_seat` VALUES ('872', '1', '4', '17', '99');
INSERT INTO `room_seat` VALUES ('871', '1', '4', '18', '100');
INSERT INTO `room_seat` VALUES ('870', '1', '4', '19', '101');
INSERT INTO `room_seat` VALUES ('869', '1', '4', '20', '102');
INSERT INTO `room_seat` VALUES ('868', '1', '4', '21', '103');
INSERT INTO `room_seat` VALUES ('867', '1', '4', '22', '104');
INSERT INTO `room_seat` VALUES ('866', '1', '4', '23', '105');
INSERT INTO `room_seat` VALUES ('865', '1', '4', '24', '106');
INSERT INTO `room_seat` VALUES ('864', '1', '4', '25', '107');
INSERT INTO `room_seat` VALUES ('863', '1', '4', '26', '108');
INSERT INTO `room_seat` VALUES ('862', '1', '4', '27', '109');
INSERT INTO `room_seat` VALUES ('861', '1', '4', '28', '110');
INSERT INTO `room_seat` VALUES ('860', '1', '3', '1', '55');
INSERT INTO `room_seat` VALUES ('859', '1', '3', '2', '56');
INSERT INTO `room_seat` VALUES ('858', '1', '3', '3', '57');
INSERT INTO `room_seat` VALUES ('857', '1', '3', '4', '58');
INSERT INTO `room_seat` VALUES ('856', '1', '3', '5', '59');
INSERT INTO `room_seat` VALUES ('855', '1', '3', '6', '60');
INSERT INTO `room_seat` VALUES ('854', '1', '3', '7', '61');
INSERT INTO `room_seat` VALUES ('853', '1', '3', '8', '62');
INSERT INTO `room_seat` VALUES ('852', '1', '3', '9', '63');
INSERT INTO `room_seat` VALUES ('851', '1', '3', '10', '64');
INSERT INTO `room_seat` VALUES ('850', '1', '3', '11', '65');
INSERT INTO `room_seat` VALUES ('849', '1', '3', '12', '66');
INSERT INTO `room_seat` VALUES ('848', '1', '3', '13', '67');
INSERT INTO `room_seat` VALUES ('847', '1', '3', '14', '68');
INSERT INTO `room_seat` VALUES ('846', '1', '3', '15', '69');
INSERT INTO `room_seat` VALUES ('845', '1', '3', '16', '70');
INSERT INTO `room_seat` VALUES ('844', '1', '3', '17', '71');
INSERT INTO `room_seat` VALUES ('843', '1', '3', '18', '72');
INSERT INTO `room_seat` VALUES ('842', '1', '3', '19', '73');
INSERT INTO `room_seat` VALUES ('841', '1', '3', '20', '74');
INSERT INTO `room_seat` VALUES ('840', '1', '3', '21', '75');
INSERT INTO `room_seat` VALUES ('839', '1', '3', '22', '76');
INSERT INTO `room_seat` VALUES ('838', '1', '3', '23', '77');
INSERT INTO `room_seat` VALUES ('837', '1', '3', '24', '78');
INSERT INTO `room_seat` VALUES ('836', '1', '3', '25', '79');
INSERT INTO `room_seat` VALUES ('835', '1', '3', '26', '80');
INSERT INTO `room_seat` VALUES ('834', '1', '3', '27', '81');
INSERT INTO `room_seat` VALUES ('833', '1', '3', '28', '82');
INSERT INTO `room_seat` VALUES ('832', '1', '2', '1', '28');
INSERT INTO `room_seat` VALUES ('831', '1', '2', '2', '29');
INSERT INTO `room_seat` VALUES ('830', '1', '2', '3', '30');
INSERT INTO `room_seat` VALUES ('829', '1', '2', '4', '31');
INSERT INTO `room_seat` VALUES ('828', '1', '2', '5', '32');
INSERT INTO `room_seat` VALUES ('827', '1', '2', '6', '33');
INSERT INTO `room_seat` VALUES ('826', '1', '2', '7', '34');
INSERT INTO `room_seat` VALUES ('825', '1', '2', '8', '35');
INSERT INTO `room_seat` VALUES ('824', '1', '2', '9', '36');
INSERT INTO `room_seat` VALUES ('823', '1', '2', '10', '37');
INSERT INTO `room_seat` VALUES ('822', '1', '2', '11', '38');
INSERT INTO `room_seat` VALUES ('821', '1', '2', '12', '39');
INSERT INTO `room_seat` VALUES ('820', '1', '2', '13', '40');
INSERT INTO `room_seat` VALUES ('819', '1', '2', '14', '41');
INSERT INTO `room_seat` VALUES ('818', '1', '2', '15', '42');
INSERT INTO `room_seat` VALUES ('817', '1', '2', '16', '43');
INSERT INTO `room_seat` VALUES ('816', '1', '2', '17', '44');
INSERT INTO `room_seat` VALUES ('815', '1', '2', '18', '45');
INSERT INTO `room_seat` VALUES ('814', '1', '2', '19', '46');
INSERT INTO `room_seat` VALUES ('813', '1', '2', '20', '47');
INSERT INTO `room_seat` VALUES ('812', '1', '2', '21', '48');
INSERT INTO `room_seat` VALUES ('811', '1', '2', '22', '49');
INSERT INTO `room_seat` VALUES ('810', '1', '2', '23', '50');
INSERT INTO `room_seat` VALUES ('809', '1', '2', '24', '51');
INSERT INTO `room_seat` VALUES ('808', '1', '2', '25', '52');
INSERT INTO `room_seat` VALUES ('807', '1', '2', '26', '53');
INSERT INTO `room_seat` VALUES ('806', '1', '2', '27', '54');
INSERT INTO `room_seat` VALUES ('805', '1', '1', '1', '1');
INSERT INTO `room_seat` VALUES ('804', '1', '1', '2', '2');
INSERT INTO `room_seat` VALUES ('803', '1', '1', '3', '3');
INSERT INTO `room_seat` VALUES ('802', '1', '1', '4', '4');
INSERT INTO `room_seat` VALUES ('801', '1', '1', '5', '5');
INSERT INTO `room_seat` VALUES ('800', '1', '1', '6', '6');
INSERT INTO `room_seat` VALUES ('799', '1', '1', '7', '7');
INSERT INTO `room_seat` VALUES ('798', '1', '1', '8', '8');
INSERT INTO `room_seat` VALUES ('797', '1', '1', '9', '9');
INSERT INTO `room_seat` VALUES ('796', '1', '1', '10', '10');
INSERT INTO `room_seat` VALUES ('795', '1', '1', '11', '11');
INSERT INTO `room_seat` VALUES ('794', '1', '1', '12', '12');
INSERT INTO `room_seat` VALUES ('793', '1', '1', '13', '13');
INSERT INTO `room_seat` VALUES ('792', '1', '1', '14', '14');
INSERT INTO `room_seat` VALUES ('791', '1', '1', '15', '15');
INSERT INTO `room_seat` VALUES ('790', '1', '1', '16', '16');
INSERT INTO `room_seat` VALUES ('789', '1', '1', '17', '17');
INSERT INTO `room_seat` VALUES ('788', '1', '1', '18', '18');
INSERT INTO `room_seat` VALUES ('787', '1', '1', '19', '19');
INSERT INTO `room_seat` VALUES ('786', '1', '1', '20', '20');
INSERT INTO `room_seat` VALUES ('785', '1', '1', '21', '21');
INSERT INTO `room_seat` VALUES ('784', '1', '1', '22', '22');
INSERT INTO `room_seat` VALUES ('783', '1', '1', '23', '23');
INSERT INTO `room_seat` VALUES ('782', '1', '1', '24', '24');
INSERT INTO `room_seat` VALUES ('781', '1', '1', '25', '25');
INSERT INTO `room_seat` VALUES ('780', '1', '1', '26', '26');
INSERT INTO `room_seat` VALUES ('779', '1', '1', '27', '27');

-- ----------------------------
-- Table structure for show
-- ----------------------------
DROP TABLE IF EXISTS `show`;
CREATE TABLE `show` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL DEFAULT '' COMMENT '标题',
  `cover` varchar(120) NOT NULL COMMENT '封面',
  `intro` text NOT NULL COMMENT '简介',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态（1:开启  0:关闭）',
  `duration` int(11) NOT NULL COMMENT '时长',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of show
-- ----------------------------
INSERT INTO `show` VALUES ('1', 'asdfasd', 'sdfads', 'asdfasdfasdfasdf', '1', '0', '123456');
INSERT INTO `show` VALUES ('3', 'aaaaaaaaaa2', '', '1231231\r\n31\r\n23\r\n1\r\n23\r\n12\r\n31\r\n2312', '1', '123', '1484552821');
INSERT INTO `show` VALUES ('4', 'aaaaaaaaaa', '', '1231231\r\n31\r\n23\r\n1\r\n23\r\n12\r\n31\r\n2312', '1', '123', '1484552831');
INSERT INTO `show` VALUES ('6', 'aaaaaaaaaa', '', '1231231\r\n31\r\n23\r\n1\r\n23\r\n12\r\n31\r\n2312', '1', '123', '1484552982');
INSERT INTO `show` VALUES ('7', 'aaaaaaaaaa', '', '1231231\r\n31\r\n23\r\n1\r\n23\r\n12\r\n31\r\n2312', '1', '123', '1484553037');
INSERT INTO `show` VALUES ('8', 'aaaaaaaaaa', '', '1231231\r\n31\r\n23\r\n1\r\n23\r\n12\r\n31\r\n2312', '1', '123', '1484553049');
INSERT INTO `show` VALUES ('9', 'aaaaaaaaaa', '', '1231231\r\n31\r\n23\r\n1\r\n23\r\n12\r\n31\r\n2312', '0', '123', '1484553210');
INSERT INTO `show` VALUES ('27', 'asdfasdf', '', '12312312312312', '1', '123', '1484563095');
INSERT INTO `show` VALUES ('28', 'asdfasdf', '', '12312312312312', '0', '123', '1484634935');
INSERT INTO `show` VALUES ('30', 'nnnnnnnn', '', 'asdfasdfasdfasdf', '1', '15', '1484721677');
INSERT INTO `show` VALUES ('31', '言言言方', '', 'asdfasdfasdfasdf', '1', '15', '1484722833');
INSERT INTO `show` VALUES ('34', '言言言方333355555577777', '', 'asdfasdfasdfasdf', '1', '15', '1484724735');
INSERT INTO `show` VALUES ('35', '言言言方11111', '/showimg/2017/WechatIMG17.jpeg', 'asdfasdfasdfasdf', '1', '15', '1486975342');
INSERT INTO `show` VALUES ('36', '言言言方224', '/showimg/2017/linu-2016.jpg', 'asdfasdfasdfasdf', '1', '15', '1484726239');
INSERT INTO `show` VALUES ('43', '哈哈哈', '/showimg/2017/mw201702220643084485.jpeg', '222225555555555555', '1', '25', '1487660735');
INSERT INTO `show` VALUES ('44', '啦啦啦啦啦了', '/showimg/2017/WechatIMG17.jpeg', '', '1', '236', '1487668192');

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
) ENGINE=MyISAM AUTO_INCREMENT=160 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of show_actor
-- ----------------------------
INSERT INTO `show_actor` VALUES ('1', '19', '1', '0', '1484554378', '');
INSERT INTO `show_actor` VALUES ('2', '20', '1', '0', '1484554434', '');
INSERT INTO `show_actor` VALUES ('3', '21', '1', '0', '1484554538', '');
INSERT INTO `show_actor` VALUES ('4', '22', '1', '0', '1484554634', '');
INSERT INTO `show_actor` VALUES ('5', '23', '1', '0', '1484554660', '');
INSERT INTO `show_actor` VALUES ('6', '24', '1', '0', '1484556721', '');
INSERT INTO `show_actor` VALUES ('7', '25', '1', '0', '1484556854', '');
INSERT INTO `show_actor` VALUES ('8', '26', '1', '0', '1484559195', '');
INSERT INTO `show_actor` VALUES ('9', '27', '1', '0', '1484563095', '');
INSERT INTO `show_actor` VALUES ('10', '28', '1', '0', '1484634935', '');
INSERT INTO `show_actor` VALUES ('11', '29', '2', '2', '1484719587', '');
INSERT INTO `show_actor` VALUES ('12', '30', '2', '2', '1484721677', '');
INSERT INTO `show_actor` VALUES ('13', '30', '1', '7', '1484721677', '');
INSERT INTO `show_actor` VALUES ('14', '31', '1', '7', '1484722833', '');
INSERT INTO `show_actor` VALUES ('15', '31', '2', '2', '1484722833', '');
INSERT INTO `show_actor` VALUES ('16', '32', '1', '7', '1484723574', '');
INSERT INTO `show_actor` VALUES ('17', '32', '2', '2', '1484723574', '');
INSERT INTO `show_actor` VALUES ('18', '33', '1', '7', '1484724720', '');
INSERT INTO `show_actor` VALUES ('19', '33', '2', '2', '1484724720', '');
INSERT INTO `show_actor` VALUES ('20', '34', '1', '7', '1484724735', '');
INSERT INTO `show_actor` VALUES ('21', '34', '2', '2', '1484724735', '');
INSERT INTO `show_actor` VALUES ('57', '36', '1', '7', '1484726239', '');
INSERT INTO `show_actor` VALUES ('62', '35', '1', '7', '1486975342', '');
INSERT INTO `show_actor` VALUES ('63', '35', '2', '2', '1486975342', '');
INSERT INTO `show_actor` VALUES ('64', '37', '1', '1', '1487648824', '哈哈哈');
INSERT INTO `show_actor` VALUES ('65', '37', '2', '7', '1487648824', '');
INSERT INTO `show_actor` VALUES ('68', '38', '1', '0', '1487658163', '');
INSERT INTO `show_actor` VALUES ('71', '39', '1', '0', '1487658233', '');
INSERT INTO `show_actor` VALUES ('72', '40', '1', '0', '1487658479', '');
INSERT INTO `show_actor` VALUES ('73', '41', '1', '0', '1487659230', '');
INSERT INTO `show_actor` VALUES ('74', '42', '3', '6', '1487659937', '');
INSERT INTO `show_actor` VALUES ('75', '42', '1', '0', '1487659937', '');
INSERT INTO `show_actor` VALUES ('159', '43', '3', '2', '1487745790', '');
INSERT INTO `show_actor` VALUES ('158', '43', '3', '0', '1487745790', '');
INSERT INTO `show_actor` VALUES ('157', '43', '3', '0', '1487745790', '');
INSERT INTO `show_actor` VALUES ('156', '43', '3', '0', '1487745790', '');
INSERT INTO `show_actor` VALUES ('155', '43', '3', '0', '1487745790', '');
INSERT INTO `show_actor` VALUES ('154', '43', '3', '0', '1487745790', '');
INSERT INTO `show_actor` VALUES ('153', '43', '3', '0', '1487745790', '');
INSERT INTO `show_actor` VALUES ('152', '43', '3', '0', '1487745790', '');
INSERT INTO `show_actor` VALUES ('151', '43', '3', '7', '1487745790', '');
INSERT INTO `show_actor` VALUES ('150', '43', '2', '0', '1487745790', '');
INSERT INTO `show_actor` VALUES ('149', '43', '1', '1', '1487745790', '');
INSERT INTO `show_actor` VALUES ('148', '44', '1', '0', '1487733966', '');

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
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of show_times
-- ----------------------------
INSERT INTO `show_times` VALUES ('13', '1', '1', '1496547559', '1486547559');
INSERT INTO `show_times` VALUES ('12', '1', '1', '1496747559', '1486547559');
INSERT INTO `show_times` VALUES ('11', '1', '1', '1499547559', '1486547559');
INSERT INTO `show_times` VALUES ('10', '36', '1', '1489547559', '1486547559');
INSERT INTO `show_times` VALUES ('9', '36', '1', '1486547559', '1486547559');
INSERT INTO `show_times` VALUES ('8', '36', '1', '1486747559', '1486547559');
INSERT INTO `show_times` VALUES ('14', '35', '1', '1486944000', '1486974669');
INSERT INTO `show_times` VALUES ('15', '35', '1', '0', '1486974669');
INSERT INTO `show_times` VALUES ('16', '35', '1', '0', '1486974669');
INSERT INTO `show_times` VALUES ('17', '35', '1', '1486944000', '1486974947');
INSERT INTO `show_times` VALUES ('18', '35', '1', '1486944000', '1486975001');
INSERT INTO `show_times` VALUES ('19', '35', '1', '1486944000', '1486975040');
INSERT INTO `show_times` VALUES ('20', '35', '1', '1486944000', '1486975040');
INSERT INTO `show_times` VALUES ('21', '35', '1', '1487944000', '1486975040');
INSERT INTO `show_times` VALUES ('22', '35', '1', '1488962000', '1486975293');
INSERT INTO `show_times` VALUES ('25', '35', '1', '1489962000', '1486975311');
INSERT INTO `show_times` VALUES ('28', '37', '1', '1487656800', '1487648824');
INSERT INTO `show_times` VALUES ('29', '38', '1', '1487520000', '1487658028');
INSERT INTO `show_times` VALUES ('31', '38', '1', '1486915200', '1487658163');
INSERT INTO `show_times` VALUES ('32', '38', '1', '1487692800', '1487658163');
INSERT INTO `show_times` VALUES ('33', '39', '1', '1487606400', '1487658201');
INSERT INTO `show_times` VALUES ('34', '39', '1', '1487606400', '1487658217');
INSERT INTO `show_times` VALUES ('35', '39', '1', '1487606400', '1487658233');
INSERT INTO `show_times` VALUES ('36', '39', '1', '1487606400', '1487658233');
INSERT INTO `show_times` VALUES ('37', '40', '1', '1487692800', '1487658479');
INSERT INTO `show_times` VALUES ('38', '41', '1', '1487667600', '1487659230');
INSERT INTO `show_times` VALUES ('39', '41', '1', '1487685600', '1487659230');
INSERT INTO `show_times` VALUES ('40', '42', '1', '1487779200', '1487659937');
INSERT INTO `show_times` VALUES ('47', '43', '1', '1487774460', '1487667521');
INSERT INTO `show_times` VALUES ('50', '44', '1', '1487935200', '1487668468');
INSERT INTO `show_times` VALUES ('51', '44', '1', '1488021600', '1487733389');
INSERT INTO `show_times` VALUES ('52', '44', '1', '1488194400', '1487733389');
INSERT INTO `show_times` VALUES ('53', '44', '1', '1487762640', '1487733966');

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
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ticket
-- ----------------------------
INSERT INTO `ticket` VALUES ('1', '0', '0', '1', '1', '1');
INSERT INTO `ticket` VALUES ('2', '0', '0', '1', '3', '2');
INSERT INTO `ticket` VALUES ('3', '0', '0', '1', '4', '3');
INSERT INTO `ticket` VALUES ('13', '0', '0', '1', '6', '5');
INSERT INTO `ticket` VALUES ('14', '0', '0', '1', '6', '6');
INSERT INTO `ticket` VALUES ('15', '0', '0', '1', '8', '7');
INSERT INTO `ticket` VALUES ('16', '0', '0', '1', '8', '8');
INSERT INTO `ticket` VALUES ('17', '0', '0', '1', '9', '37');
INSERT INTO `ticket` VALUES ('18', '0', '0', '1', '9', '10');
INSERT INTO `ticket` VALUES ('19', '0', '0', '1', '9', '9');
INSERT INTO `ticket` VALUES ('20', '0', '0', '1', '9', '36');
INSERT INTO `ticket` VALUES ('21', '0', '0', '2', '7', '34');
INSERT INTO `ticket` VALUES ('22', '0', '0', '2', '7', '35');
INSERT INTO `ticket` VALUES ('23', '0', '0', '1', '11', '11');
INSERT INTO `ticket` VALUES ('24', '0', '0', '1', '11', '12');
INSERT INTO `ticket` VALUES ('25', '0', '0', '3', '15', '69');
INSERT INTO `ticket` VALUES ('26', '0', '0', '3', '15', '96');
INSERT INTO `ticket` VALUES ('27', '0', '0', '8', '5', '194');
INSERT INTO `ticket` VALUES ('28', '0', '0', '8', '5', '197');
INSERT INTO `ticket` VALUES ('29', '0', '0', '6', '15', '153');
INSERT INTO `ticket` VALUES ('30', '0', '0', '4', '5', '114');
INSERT INTO `ticket` VALUES ('31', '0', '0', '4', '5', '115');
INSERT INTO `ticket` VALUES ('32', '0', '0', '4', '5', '87');
INSERT INTO `ticket` VALUES ('33', '13', '1', '1', '7', '7');
INSERT INTO `ticket` VALUES ('34', '13', '1', '1', '8', '8');
INSERT INTO `ticket` VALUES ('35', '13', '2', '1', '9', '9');
INSERT INTO `ticket` VALUES ('36', '13', '2', '1', '10', '10');
INSERT INTO `ticket` VALUES ('37', '10', '3', '1', '1', '1');
INSERT INTO `ticket` VALUES ('38', '10', '3', '1', '2', '2');
INSERT INTO `ticket` VALUES ('39', '10', '3', '1', '3', '3');
INSERT INTO `ticket` VALUES ('40', '10', '3', '1', '4', '4');
INSERT INTO `ticket` VALUES ('41', '10', '4', '3', '5', '59');
INSERT INTO `ticket` VALUES ('42', '10', '4', '4', '5', '87');
INSERT INTO `ticket` VALUES ('43', '10', '5', '13', '26', '330');
INSERT INTO `ticket` VALUES ('44', '10', '5', '13', '25', '329');
INSERT INTO `ticket` VALUES ('45', '10', '6', '2', '9', '36');
INSERT INTO `ticket` VALUES ('46', '10', '6', '5', '10', '120');
INSERT INTO `ticket` VALUES ('47', '10', '6', '4', '10', '92');
INSERT INTO `ticket` VALUES ('48', '10', '6', '3', '10', '64');
INSERT INTO `ticket` VALUES ('49', '10', '7', '1', '9', '9');
INSERT INTO `ticket` VALUES ('50', '10', '7', '1', '10', '10');
INSERT INTO `ticket` VALUES ('51', '10', '8', '2', '1', '28');
INSERT INTO `ticket` VALUES ('52', '10', '8', '2', '2', '29');
INSERT INTO `ticket` VALUES ('53', '10', '8', '2', '3', '30');
INSERT INTO `ticket` VALUES ('54', '10', '8', '2', '4', '31');
INSERT INTO `ticket` VALUES ('55', '10', '9', '5', '16', '126');
INSERT INTO `ticket` VALUES ('56', '28', '10', '1', '10', '10');
INSERT INTO `ticket` VALUES ('57', '28', '10', '2', '11', '38');
INSERT INTO `ticket` VALUES ('58', '28', '10', '3', '13', '67');
INSERT INTO `ticket` VALUES ('59', '28', '10', '4', '14', '96');
INSERT INTO `ticket` VALUES ('60', '41', '11', '6', '5', '143');
INSERT INTO `ticket` VALUES ('61', '41', '11', '6', '6', '144');
INSERT INTO `ticket` VALUES ('62', '41', '11', '6', '7', '145');
INSERT INTO `ticket` VALUES ('63', '41', '12', '8', '4', '193');
INSERT INTO `ticket` VALUES ('64', '41', '12', '8', '5', '194');
INSERT INTO `ticket` VALUES ('65', '41', '12', '8', '6', '195');
INSERT INTO `ticket` VALUES ('66', '41', '12', '8', '7', '196');
INSERT INTO `ticket` VALUES ('67', '41', '13', '9', '8', '220');
INSERT INTO `ticket` VALUES ('68', '41', '13', '9', '7', '219');
INSERT INTO `ticket` VALUES ('69', '10', '14', '7', '4', '170');
INSERT INTO `ticket` VALUES ('70', '10', '14', '7', '5', '171');
INSERT INTO `ticket` VALUES ('71', '10', '14', '8', '5', '194');
INSERT INTO `ticket` VALUES ('72', '10', '14', '8', '6', '195');
INSERT INTO `ticket` VALUES ('73', '44', '15', '4', '3', '85');
INSERT INTO `ticket` VALUES ('74', '44', '15', '4', '4', '86');
INSERT INTO `ticket` VALUES ('75', '50', '16', '1', '27', '27');
INSERT INTO `ticket` VALUES ('76', '50', '16', '1', '26', '26');
INSERT INTO `ticket` VALUES ('77', '50', '16', '2', '27', '54');
INSERT INTO `ticket` VALUES ('78', '50', '16', '2', '26', '53');
INSERT INTO `ticket` VALUES ('79', '50', '17', '4', '14', '96');
INSERT INTO `ticket` VALUES ('80', '50', '18', '5', '22', '132');
INSERT INTO `ticket` VALUES ('81', '50', '19', '4', '19', '101');
INSERT INTO `ticket` VALUES ('82', '50', '19', '4', '20', '102');
INSERT INTO `ticket` VALUES ('83', '50', '19', '4', '21', '103');
INSERT INTO `ticket` VALUES ('84', '50', '19', '4', '22', '104');
INSERT INTO `ticket` VALUES ('85', '50', '20', '7', '19', '185');
INSERT INTO `ticket` VALUES ('86', '50', '20', '7', '20', '186');
INSERT INTO `ticket` VALUES ('87', '50', '20', '7', '21', '187');
INSERT INTO `ticket` VALUES ('88', '50', '20', '7', '22', '188');

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
  `ctime` int(11) DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of ticket_order
-- ----------------------------
INSERT INTO `ticket_order` VALUES ('1', '1', '1', '1', '13', '68013', '2', '0');
INSERT INTO `ticket_order` VALUES ('2', '1', '1', '1', '13', '870443', '2', '0');
INSERT INTO `ticket_order` VALUES ('3', '1', '1', '36', '10', '785620', '4', '0');
INSERT INTO `ticket_order` VALUES ('4', '1', '1', '36', '10', '665899', '2', '0');
INSERT INTO `ticket_order` VALUES ('5', '1', '1', '36', '10', '510819', '2', '0');
INSERT INTO `ticket_order` VALUES ('6', '1', '2', '36', '10', '617278', '4', '0');
INSERT INTO `ticket_order` VALUES ('7', '1', '2', '36', '10', '745325', '2', '0');
INSERT INTO `ticket_order` VALUES ('8', '1', '4', '36', '10', '873480', '4', '0');
INSERT INTO `ticket_order` VALUES ('9', '1', '2', '36', '10', '932784', '1', '0');
INSERT INTO `ticket_order` VALUES ('10', '1', '4', '37', '28', '340611', '4', '0');
INSERT INTO `ticket_order` VALUES ('11', '1', '1', '43', '41', '348021', '3', '0');
INSERT INTO `ticket_order` VALUES ('12', '1', '1', '43', '41', '932274', '4', '0');
INSERT INTO `ticket_order` VALUES ('13', '1', '1', '43', '41', '418366', '2', '0');
INSERT INTO `ticket_order` VALUES ('14', '1', '1', '36', '10', '750894', '4', '0');
INSERT INTO `ticket_order` VALUES ('15', '1', '3', '43', '44', '338471', '2', '0');
INSERT INTO `ticket_order` VALUES ('16', '1', '4', '44', '50', '570355', '4', '0');
INSERT INTO `ticket_order` VALUES ('17', '1', '2', '44', '50', '842126', '1', '0');
INSERT INTO `ticket_order` VALUES ('18', '1', '4', '44', '50', '103041', '1', '0');
INSERT INTO `ticket_order` VALUES ('19', '1', '5', '44', '50', '410462', '4', '0');
INSERT INTO `ticket_order` VALUES ('20', '1', '5', '44', '50', '675676', '4', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=2865 DEFAULT CHARSET=utf8 COMMENT='验证码';

-- ----------------------------
-- Records of verify_code
-- ----------------------------
INSERT INTO `verify_code` VALUES ('2848', '7185', '15102011866aq', '-1', '11', '1', '0', '0');
INSERT INTO `verify_code` VALUES ('2849', '7185', '15102011866aq', '-1', '11', '1', '0', '0');
INSERT INTO `verify_code` VALUES ('2850', '7185', '15102011866aq', '-1', '11', '1', '0', '0');
INSERT INTO `verify_code` VALUES ('2864', '7506', '18102727234', '-1', '11', '1', '1487664869', '0');
