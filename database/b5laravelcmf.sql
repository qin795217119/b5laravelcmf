/*
Navicat MySQL Data Transfer

Source Server         : 我的新ECS
Source Server Version : 80023
Source Host           : 47.114.86.223:3306
Source Database       : admin_b5laravel

Target Server Type    : MYSQL
Target Server Version : 80023
File Encoding         : 65001

Date: 2021-03-04 19:58:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `b5net_adlist`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_adlist`;
CREATE TABLE `b5net_adlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '信息标题',
  `adtype` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '推荐位置',
  `redtype` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '跳转类型',
  `redfunc` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '跳转模块',
  `redinfo` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '跳转值',
  `listsort` int NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `text_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '文本信息',
  `text_rich` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '富文本信息',
  `imglist` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '图片信息',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='推荐信息表';

-- ----------------------------
-- Records of b5net_adlist
-- ----------------------------
INSERT INTO `b5net_adlist` VALUES ('2', '测试大苏打大苏打', 'web_index_banner', 'func', 'notice', '', '1', '1', 'asdsadasd', '<p><img src=\"http://admin.b5laravelcmf.b5net.com/uploads/editor/2021/02/02/e3a0d1adbcdb1d42589d6d52df5f65e0.jpg\" data-filename=\"timg.jpg\" style=\"width: 341px;\"><br></p><p><br></p><p><br></p><p></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p>asdasdsadasd</p><p>asdasdasdasd</p>', '/uploads/adlist/2021/01/08/6b8984a88347c29f97563853c47985f8.jpg,/uploads/adlist/2021/02/02/cdf792eb290eabcb47c5e9d27b01b5d5.jpg', '2021-01-05 03:33:07', '2021-02-02 21:52:33');

-- ----------------------------
-- Table structure for `b5net_admin`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin`;
CREATE TABLE `b5net_admin` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '登录名',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '登录密码',
  `realname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '人员姓名',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '状态',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '备注',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `last_time` datetime DEFAULT NULL COMMENT '登录时间',
  `last_ip` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '登录ip',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='管理员表';

-- ----------------------------
-- Records of b5net_admin
-- ----------------------------
INSERT INTO `b5net_admin` VALUES ('1', 'admin', '41b67b282ed0709f70bdebce8a70c90c', '超管', '1', '超级管理员', '2020-12-24 10:50:56', '2021-01-16 00:46:00', null, null);
INSERT INTO `b5net_admin` VALUES ('2', 'ceshi', '41b67b282ed0709f70bdebce8a70c90c', '测试1111', '1', '测试账号', '2020-12-24 13:14:57', '2021-01-16 11:13:36', null, null);

-- ----------------------------
-- Table structure for `b5net_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin_role`;
CREATE TABLE `b5net_admin_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` int NOT NULL COMMENT '用户ID',
  `role_id` int NOT NULL COMMENT '角色ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_id` (`admin_id`,`role_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='用户和角色关联表';

-- ----------------------------
-- Records of b5net_admin_role
-- ----------------------------
INSERT INTO `b5net_admin_role` VALUES ('4', '1', '1');
INSERT INTO `b5net_admin_role` VALUES ('5', '2', '2');

-- ----------------------------
-- Table structure for `b5net_admin_struct`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin_struct`;
CREATE TABLE `b5net_admin_struct` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int NOT NULL COMMENT '用户ID',
  `struct_id` int NOT NULL COMMENT '组织ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='用户与组织架构关联表';

-- ----------------------------
-- Records of b5net_admin_struct
-- ----------------------------
INSERT INTO `b5net_admin_struct` VALUES ('1', '6', '103');
INSERT INTO `b5net_admin_struct` VALUES ('2', '6', '104');
INSERT INTO `b5net_admin_struct` VALUES ('3', '7', '105');
INSERT INTO `b5net_admin_struct` VALUES ('4', '7', '104');
INSERT INTO `b5net_admin_struct` VALUES ('8', '2', '103');
INSERT INTO `b5net_admin_struct` VALUES ('9', '2', '105');

-- ----------------------------
-- Table structure for `b5net_adposition`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_adposition`;
CREATE TABLE `b5net_adposition` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '唯一标识',
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '位置名称',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `width` mediumint NOT NULL DEFAULT '0',
  `height` mediumint NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='推荐位置表';

-- ----------------------------
-- Records of b5net_adposition
-- ----------------------------
INSERT INTO `b5net_adposition` VALUES ('1', 'web_index_banner', '首页banner图片', '宽高为1920*400像素', '0', '0', null, '2021-01-08 06:02:11');

-- ----------------------------
-- Table structure for `b5net_config`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_config`;
CREATE TABLE `b5net_config` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '配置标识',
  `style` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '配置类型',
  `is_sys` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '是否系统内置 0否 1是',
  `groups` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '配置分组',
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '配置值',
  `extra` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '配置项',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '配置说明',
  `listsort` int unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='系统配置表';

-- ----------------------------
-- Records of b5net_config
-- ----------------------------
INSERT INTO `b5net_config` VALUES ('1', '配置分组', 'sys_config_group', 'array', '0', '', 'site:基本设置\r\nwx:微信设置\r\nsms:短信配置\r\nemail:邮箱配置\r\nmap:地图相关', '', '系统配置的分组配置', '0', '2020-12-30 16:17:10', '2021-01-25 19:54:42');
INSERT INTO `b5net_config` VALUES ('2', '系统名称', 'sys_config_sysname', 'text', '0', 'site', 'B5LaravleCMF', '', '系统后台显示的名称', '0', '2020-12-31 14:01:18', '2021-01-12 00:02:59');
INSERT INTO `b5net_config` VALUES ('3', '演示模式', 'sys_config_demo', 'select', '0', 'site', '1', '1:开启\r\n0:关闭', '开启后，除超管外不可进行非查询操作', '0', '2021-01-08 05:58:25', '2021-01-12 00:02:59');
INSERT INTO `b5net_config` VALUES ('4', '阿里accessKeyId', 'sms_ali_key', 'text', '0', 'sms', '', '', '阿里短信-AccessKey ID', '0', '2021-01-11 19:26:13', '2021-01-11 23:45:06');
INSERT INTO `b5net_config` VALUES ('5', '阿里accessSecret', 'sms_ali_secret', 'text', '0', 'sms', '', '', '阿里短信-AccessKey Secret', '1', '2021-01-11 19:26:45', '2021-01-11 23:45:06');
INSERT INTO `b5net_config` VALUES ('6', '阿里signName', 'sms_ali_signname', 'text', '0', 'sms', '', '', '阿里短信-签名', '2', '2021-01-11 19:27:53', '2021-01-11 23:45:06');
INSERT INTO `b5net_config` VALUES ('7', '阿里tempId', 'sms_ali_temp', 'text', '0', 'sms', '', '', '阿里短信-tempId模板', '3', '2021-01-11 19:30:21', '2021-01-11 23:45:06');
INSERT INTO `b5net_config` VALUES ('8', '聚合appkey', 'sms_juhe_appkey', 'text', '0', 'sms', '', '', '聚合短信-APPKEY', '10', '2021-01-11 19:33:27', '2021-01-11 23:45:06');
INSERT INTO `b5net_config` VALUES ('9', '聚合tempId', 'sms_juhe_temp', 'text', '0', 'sms', '', '', '聚合短信-TPLID模板', '11', '2021-01-11 19:34:26', '2021-01-11 23:45:06');
INSERT INTO `b5net_config` VALUES ('10', '公众号appid', 'wechat_appid', 'text', '0', 'wx', 'wx2ba634598c7df708', '', '微信公众号的AppId', '0', '2021-01-12 11:05:50', '2021-01-28 13:58:52');
INSERT INTO `b5net_config` VALUES ('11', '公众号secret', 'wechat_appsecret', 'text', '0', 'wx', 'e82cdf89c396b1dd88f1632eaf70fb2d', '', '微信公众号-AppSecret', '1', '2021-01-12 11:06:24', '2021-01-28 13:58:52');
INSERT INTO `b5net_config` VALUES ('12', '服务地址', 'sys_email_host', 'text', '0', 'email', 'smtp.163.com', '', '', '1', '2021-01-23 14:01:57', '2021-01-23 14:01:57');
INSERT INTO `b5net_config` VALUES ('13', '邮箱地址', 'sys_email_username', 'text', '0', 'email', 'lyyd_lh@163.com', '', '', '2', '2021-01-23 14:02:14', '2021-01-23 14:02:20');
INSERT INTO `b5net_config` VALUES ('14', '授权密码', 'sys_email_password', 'text', '0', 'email', 'UCSMPMHNDJSALQVW', '', '', '3', '2021-01-23 14:02:40', '2021-01-23 14:02:40');
INSERT INTO `b5net_config` VALUES ('15', '服务端口', 'sys_email_port', 'text', '0', 'email', '465', '', '', '4', '2021-01-23 14:02:58', '2021-01-23 14:02:58');
INSERT INTO `b5net_config` VALUES ('16', '是否SSL', 'sys_email_ssl', 'select', '0', 'email', '1', '0:否\r\n1:是', '', '5', '2021-01-23 14:03:20', '2021-01-23 14:03:20');
INSERT INTO `b5net_config` VALUES ('17', '腾讯地图Key', 'sys_map_qqkey', 'text', '0', 'map', 'ZZFBZ-ZUBY6-URGSB-MKE3Q-FUMGK-ZPB7S', '', '', '0', '2021-01-25 19:55:48', '2021-01-25 21:10:28');

-- ----------------------------
-- Table structure for `b5net_dict_data`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_dict_data`;
CREATE TABLE `b5net_dict_data` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '字典编码',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '字典标签',
  `value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '字典键值',
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '字典类型',
  `listsort` int NOT NULL DEFAULT '0' COMMENT '字典排序',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '状态（1正常 0停用）',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `value` (`value`) USING BTREE,
  KEY `type` (`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='字典数据表';

-- ----------------------------
-- Records of b5net_dict_data
-- ----------------------------
INSERT INTO `b5net_dict_data` VALUES ('1', '通知', '1', 'sys_notice_type', '1', '1', '2021-01-01 14:39:33', '2021-01-01 14:41:11', '');
INSERT INTO `b5net_dict_data` VALUES ('2', '公告', '2', 'sys_notice_type', '2', '1', '2021-01-01 14:40:37', '2021-01-01 14:41:14', '');
INSERT INTO `b5net_dict_data` VALUES ('3', '无跳转', 'none', 'sys_redtype_type', '1', '0', '2021-01-04 06:12:52', '2021-01-07 15:17:38', '');
INSERT INTO `b5net_dict_data` VALUES ('4', 'URL链接', 'url', 'sys_redtype_type', '2', '1', '2021-01-04 06:13:16', '2021-01-04 06:14:25', '');
INSERT INTO `b5net_dict_data` VALUES ('5', '功能模块', 'func', 'sys_redtype_type', '3', '1', '2021-01-04 06:13:45', '2021-01-04 06:13:45', '');
INSERT INTO `b5net_dict_data` VALUES ('6', '信息内容', 'info', 'sys_redtype_type', '4', '1', '2021-01-04 06:14:13', '2021-01-04 06:14:13', '');

-- ----------------------------
-- Table structure for `b5net_dict_type`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_dict_type`;
CREATE TABLE `b5net_dict_type` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '字典主键',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '字典名称',
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '字典类型',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '状态（1正常 0停用）',
  `listsort` int NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `dict_type` (`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='字典类型表';

-- ----------------------------
-- Records of b5net_dict_type
-- ----------------------------
INSERT INTO `b5net_dict_type` VALUES ('1', '通知类型', 'sys_notice_type', '1', '0', '2020-12-30 14:32:58', '2020-12-30 14:32:58', '通知公告类型列表');
INSERT INTO `b5net_dict_type` VALUES ('2', '跳转类型', 'sys_redtype_type', '1', '1', '2021-01-04 06:12:22', '2021-01-04 06:12:22', '跳转管理中的跳转类型');

-- ----------------------------
-- Table structure for `b5net_loginlog`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_loginlog`;
CREATE TABLE `b5net_loginlog` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '访问ID',
  `login_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '登录账号',
  `ipaddr` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '登录IP地址',
  `login_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '登录地点',
  `browser` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '浏览器类型',
  `os` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '操作系统',
  `net` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '营运',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0' COMMENT '登录状态（0成功 1失败）',
  `msg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '提示消息',
  `login_time` datetime DEFAULT NULL COMMENT '访问时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='系统访问记录';

-- ----------------------------
-- Records of b5net_loginlog
-- ----------------------------
INSERT INTO `b5net_loginlog` VALUES ('1', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登陆成功', '2021-01-16 00:21:16');
INSERT INTO `b5net_loginlog` VALUES ('2', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登陆成功', '2021-01-16 11:02:48');
INSERT INTO `b5net_loginlog` VALUES ('3', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登陆成功', '2021-01-16 20:51:55');
INSERT INTO `b5net_loginlog` VALUES ('4', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登陆成功', '2021-01-17 11:45:03');
INSERT INTO `b5net_loginlog` VALUES ('5', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登陆成功', '2021-01-18 12:32:17');
INSERT INTO `b5net_loginlog` VALUES ('6', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登陆成功', '2021-01-19 11:02:40');
INSERT INTO `b5net_loginlog` VALUES ('7', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登陆成功', '2021-01-22 14:17:24');
INSERT INTO `b5net_loginlog` VALUES ('8', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登陆成功', '2021-01-23 14:01:05');
INSERT INTO `b5net_loginlog` VALUES ('9', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登陆成功', '2021-01-24 22:26:52');
INSERT INTO `b5net_loginlog` VALUES ('10', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登陆成功', '2021-01-25 10:22:11');
INSERT INTO `b5net_loginlog` VALUES ('11', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登陆成功', '2021-01-25 10:24:07');
INSERT INTO `b5net_loginlog` VALUES ('12', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '0', '验证码错误', '2021-01-25 13:53:29');
INSERT INTO `b5net_loginlog` VALUES ('13', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登陆成功', '2021-01-25 13:53:35');
INSERT INTO `b5net_loginlog` VALUES ('14', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登陆成功', '2021-01-25 13:55:07');
INSERT INTO `b5net_loginlog` VALUES ('15', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '0', '验证码错误', '2021-01-25 14:13:06');
INSERT INTO `b5net_loginlog` VALUES ('16', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登陆成功', '2021-01-25 14:13:13');
INSERT INTO `b5net_loginlog` VALUES ('17', 'admin', '144.52.190.101', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '0', '账号或密码错误', '2021-02-02 21:01:44');
INSERT INTO `b5net_loginlog` VALUES ('18', 'admin', '144.52.190.101', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '0', '验证码错误', '2021-02-02 21:01:51');
INSERT INTO `b5net_loginlog` VALUES ('19', 'admin', '144.52.190.101', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '0', '账号或密码错误', '2021-02-02 21:01:56');
INSERT INTO `b5net_loginlog` VALUES ('20', 'admin', '144.52.190.101', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '0', '验证码错误', '2021-02-02 21:02:06');
INSERT INTO `b5net_loginlog` VALUES ('21', 'admin', '144.52.190.101', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '0', '账号或密码错误', '2021-02-02 21:02:57');
INSERT INTO `b5net_loginlog` VALUES ('22', 'admin', '144.52.190.101', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '0', '账号或密码错误', '2021-02-02 21:03:33');
INSERT INTO `b5net_loginlog` VALUES ('23', 'admin', '144.52.190.101', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '0', '账号或密码错误', '2021-02-02 21:51:48');
INSERT INTO `b5net_loginlog` VALUES ('24', 'admin', '144.52.190.101', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-02 21:51:59');
INSERT INTO `b5net_loginlog` VALUES ('25', 'test', '144.52.190.229', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '0', '账号或密码错误', '2021-03-02 21:26:24');
INSERT INTO `b5net_loginlog` VALUES ('26', 'admin', '144.52.190.229', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '0', '验证码错误', '2021-03-02 21:26:33');
INSERT INTO `b5net_loginlog` VALUES ('27', 'admin', '144.52.190.229', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-03-02 21:26:39');
INSERT INTO `b5net_loginlog` VALUES ('28', 'admin', '144.52.190.229', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-03-02 21:29:08');
INSERT INTO `b5net_loginlog` VALUES ('29', 'ceshi', '144.52.190.229', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-03-02 21:29:23');
INSERT INTO `b5net_loginlog` VALUES ('30', 'admin', '144.52.190.229', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-03-02 21:29:57');
INSERT INTO `b5net_loginlog` VALUES ('31', 'admin', '123.132.237.18', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '联通', '1', '登陆成功', '2021-03-03 15:34:56');

-- ----------------------------
-- Table structure for `b5net_mapply`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_mapply`;
CREATE TABLE `b5net_mapply` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '活动名称',
  `banner` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '顶部Banner',
  `share_title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '分享标题',
  `share_desc` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '分享简介',
  `share_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '分享图片',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '预约金额',
  `rules` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '活动规则',
  `agreement` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '参与协议',
  `themecolor` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `is_multi` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否允许提交多个',
  `com_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '门店名称',
  `com_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '门店地址',
  `com_phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '门店电话',
  `com_lat` decimal(10,7) DEFAULT '0.0000000' COMMENT '纬度',
  `com_lng` decimal(10,7) DEFAULT '0.0000000' COMMENT '经度',
  `regfield` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `start_time` datetime DEFAULT NULL COMMENT '开始预约时间',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='微预约-活动表';

-- ----------------------------
-- Records of b5net_mapply
-- ----------------------------
INSERT INTO `b5net_mapply` VALUES ('1', '全民健身中心年卡预约大优惠', '/uploads/mapply/2021/01/27/00f7807e94117c99b032befd521025ff.jpg', '阿萨大', '撒大', '/uploads/mapply/2021/01/25/48b1b32c30bd012d94b3ca27e8bac8c0.jpg', '0.00', '活动介绍：活动介绍：活动介绍：活动介绍：活动介绍：活动介绍：活动介绍：活动介绍：\r\n活动介绍：活动介绍：活动介绍：\r\nasdad', '阿三大苏打', 'FF4F1E', '1', '1', '主办单位主办单位', '活动地址活动地址', '联系电话联系电话联系电话', '35.0615473', '118.3404347', '{\"name\":{\"title\":\"\\u59d3\\u540d\",\"require\":1},\"phone\":{\"title\":\"\\u8054\\u7cfb\\u7535\\u8bdd\",\"require\":1},\"idcard\":{\"title\":\"\\u8eab\\u4efd\\u8bc1\\u53f7\",\"require\":0},\"sex\":{\"title\":\"\\u6027\\u522b\",\"require\":0},\"birthday\":{\"title\":\"\\u51fa\\u751f\\u65e5\\u671f\",\"require\":0}}', '2021-01-26 00:00:00', '2021-04-06 00:00:00', '2021-01-25 22:55:19', '2021-03-03 14:15:00');

-- ----------------------------
-- Table structure for `b5net_mapply_count`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_mapply_count`;
CREATE TABLE `b5net_mapply_count` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `mid` int NOT NULL DEFAULT '0' COMMENT '活动ID',
  `click` int NOT NULL DEFAULT '0' COMMENT '点击次数',
  `number` int NOT NULL DEFAULT '0' COMMENT '订单数量',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `daytime` int NOT NULL DEFAULT '0' COMMENT '时间',
  `paynumber` int NOT NULL COMMENT '支付数量',
  PRIMARY KEY (`id`),
  KEY `pid` (`mid`,`daytime`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='微预约-活动统计';

-- ----------------------------
-- Records of b5net_mapply_count
-- ----------------------------
INSERT INTO `b5net_mapply_count` VALUES ('1', '1', '0', '6', '0.00', '1613664000', '6');

-- ----------------------------
-- Table structure for `b5net_mapply_order`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_mapply_order`;
CREATE TABLE `b5net_mapply_order` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `mid` int NOT NULL DEFAULT '0' COMMENT '活动ID',
  `order_sn` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '订单号',
  `trade_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `openid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户id',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `is_pay` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否支付',
  `paytime` int NOT NULL DEFAULT '0' COMMENT '支付时间',
  `order_title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否使用',
  `use_time` int NOT NULL DEFAULT '0' COMMENT '使用时间',
  `user_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '姓名',
  `user_birthday` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '出生日期',
  `user_sex` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '用户性别',
  `user_mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '手机号码',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `ip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_sn` (`order_sn`) USING BTREE,
  KEY `pid` (`mid`) USING BTREE,
  KEY `openid` (`openid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='微预约-预约订单';

-- ----------------------------
-- Records of b5net_mapply_order
-- ----------------------------
INSERT INTO `b5net_mapply_order` VALUES ('22', '1', '10161369686676422', '', 'oBi_at5iKwWaNcmTEpkr_IUwxDBw', '0.00', '1', '1613696866', '全民健身中心年卡预约大优惠', '0', '0', '', '', '', '', '2021-02-19 09:07:46', '2021-02-19 09:07:46', '123.132.237.18');
INSERT INTO `b5net_mapply_order` VALUES ('23', '1', '10161369692794887', '', 'oBi_at5iKwWaNcmTEpkr_IUwxDBw', '0.00', '1', '1613696927', '全民健身中心年卡预约大优惠', '0', '0', '', '', '', '', '2021-02-19 09:08:47', '2021-02-19 09:08:47', '123.132.237.18');
INSERT INTO `b5net_mapply_order` VALUES ('24', '1', '10161369775000435', '', 'oBi_at5iKwWaNcmTEpkr_IUwxDBw', '0.00', '1', '1613697750', '全民健身中心年卡预约大优惠', '0', '0', '', '', '', '', '2021-02-19 09:22:30', '2021-02-19 09:22:30', '123.132.237.18');
INSERT INTO `b5net_mapply_order` VALUES ('25', '1', '10161369778244673', '', 'oBi_at5iKwWaNcmTEpkr_IUwxDBw', '0.00', '1', '1613697782', '全民健身中心年卡预约大优惠', '0', '0', '', '', '', '', '2021-02-19 09:23:02', '2021-02-19 09:23:02', '123.132.237.18');
INSERT INTO `b5net_mapply_order` VALUES ('26', '1', '10161369782419505', '', 'oBi_at5iKwWaNcmTEpkr_IUwxDBw', '0.00', '1', '1613697824', '全民健身中心年卡预约大优惠', '0', '0', '', '', '', '', '2021-02-19 09:23:44', '2021-02-19 09:23:44', '123.132.237.18');
INSERT INTO `b5net_mapply_order` VALUES ('27', '1', '10161369799652602', '', 'oBi_at5iKwWaNcmTEpkr_IUwxDBw', '0.00', '1', '1613697996', '全民健身中心年卡预约大优惠', '0', '0', '', '', '', '', '2021-02-19 09:26:36', '2021-02-19 09:26:36', '123.132.237.18');

-- ----------------------------
-- Table structure for `b5net_mapply_order_ext`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_mapply_order_ext`;
CREATE TABLE `b5net_mapply_order_ext` (
  `mid` int NOT NULL COMMENT '活动ID',
  `oid` int NOT NULL COMMENT '订单ID',
  `fieldkey` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '字段标识',
  `fieldval` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '字段值'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='微预约-预约提交信息表';

-- ----------------------------
-- Records of b5net_mapply_order_ext
-- ----------------------------
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '22', 'name', '李先生');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '22', 'phone', '13333333333');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '22', 'idcard', '');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '22', 'sex', '男');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '22', 'birthday', '2021-02-19');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '23', 'name', '李先生');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '23', 'phone', '13333333333');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '23', 'idcard', '');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '23', 'sex', '男');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '23', 'birthday', '2021-02-19');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '24', 'name', '李先生');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '24', 'phone', '13333322222');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '24', 'idcard', '');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '24', 'sex', '男');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '24', 'birthday', '');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '25', 'name', '阿萨大');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '25', 'phone', '15555522222');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '25', 'idcard', '');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '25', 'sex', '男');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '25', 'birthday', '');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '26', 'name', '对方是个');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '26', 'phone', '15577766666');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '26', 'idcard', '');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '26', 'sex', '男');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '26', 'birthday', '');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '27', 'name', '奥瑟');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '27', 'phone', '18888877654');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '27', 'idcard', '');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '27', 'sex', '男');
INSERT INTO `b5net_mapply_order_ext` VALUES ('1', '27', 'birthday', '');

-- ----------------------------
-- Table structure for `b5net_mapply_order_log`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_mapply_order_log`;
CREATE TABLE `b5net_mapply_order_log` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL COMMENT '订单ID',
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作名称',
  `optype` tinyint(1) NOT NULL COMMENT '操作用户 1用户 2 商户 3 管理员',
  `opname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作人',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mid` int NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='微预约-订单操作记录';

-- ----------------------------
-- Records of b5net_mapply_order_log
-- ----------------------------
INSERT INTO `b5net_mapply_order_log` VALUES ('22', '22', '创建订单', '1', '', '', '1', '2021-02-19 09:07:46', '2021-02-19 09:07:46');
INSERT INTO `b5net_mapply_order_log` VALUES ('23', '23', '创建订单', '1', '', '', '1', '2021-02-19 09:08:47', '2021-02-19 09:08:47');
INSERT INTO `b5net_mapply_order_log` VALUES ('24', '24', '创建订单', '1', '', '', '1', '2021-02-19 09:22:30', '2021-02-19 09:22:30');
INSERT INTO `b5net_mapply_order_log` VALUES ('25', '25', '创建订单', '1', '', '', '1', '2021-02-19 09:23:02', '2021-02-19 09:23:02');
INSERT INTO `b5net_mapply_order_log` VALUES ('26', '26', '创建订单', '1', '', '', '1', '2021-02-19 09:23:44', '2021-02-19 09:23:44');
INSERT INTO `b5net_mapply_order_log` VALUES ('27', '27', '创建订单', '1', '', '', '1', '2021-02-19 09:26:36', '2021-02-19 09:26:36');

-- ----------------------------
-- Table structure for `b5net_menu`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_menu`;
CREATE TABLE `b5net_menu` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `parent_id` int NOT NULL DEFAULT '0' COMMENT '父菜单ID',
  `listsort` int NOT NULL DEFAULT '0' COMMENT '显示顺序',
  `url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '请求地址',
  `target` tinyint(1) NOT NULL DEFAULT '0' COMMENT '打开方式（0页签 1新窗口）',
  `type` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '菜单类型（M目录 C菜单 F按钮）',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '菜单状态（1显示 0隐藏）',
  `is_refresh` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0' COMMENT '是否刷新（0不刷新 1刷新）',
  `perms` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '权限标识',
  `icon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '菜单图标',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`) USING BTREE,
  KEY `listsort` (`listsort`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11605 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='菜单权限表';

-- ----------------------------
-- Records of b5net_menu
-- ----------------------------
INSERT INTO `b5net_menu` VALUES ('1', '系统管理', '0', '1', '', '0', 'M', '1', '0', '', 'fa fa-cog', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '系统管理');
INSERT INTO `b5net_menu` VALUES ('2', '权限管理', '0', '2', '', '0', 'M', '1', '0', '', 'fa fa-id-card-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '权限管理');
INSERT INTO `b5net_menu` VALUES ('3', '网站管理', '0', '3', '', '0', 'M', '1', '0', '', 'fa fa-globe', '2021-01-03 07:25:11', '2021-03-02 20:59:20', '内容管理');
INSERT INTO `b5net_menu` VALUES ('4', '微信应用', '0', '4', '', '0', 'M', '1', '0', '', 'fa fa-weixin', '2021-01-25 10:23:01', '2021-01-25 16:25:46', '');
INSERT INTO `b5net_menu` VALUES ('90', '官方网站', '0', '99', 'http://www.b5net.com', '1', 'C', '1', '0', '', 'fa fa-send', '2021-01-05 12:05:30', '2021-01-05 12:09:03', '官方网站');
INSERT INTO `b5net_menu` VALUES ('100', '人员管理', '2', '1', '/admin/admin/index', '0', 'C', '1', '0', 'admin:admin:index', 'fa fa-user-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '人员管理');
INSERT INTO `b5net_menu` VALUES ('101', '角色管理', '2', '2', '/admin/role/index', '0', 'C', '1', '0', 'admin:role:index', 'fa fa-address-book-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色管理');
INSERT INTO `b5net_menu` VALUES ('102', '组织架构', '2', '3', '/admin/struct/index', '0', 'C', '1', '0', 'admin:struct:index', 'fa fa-sitemap', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织架构');
INSERT INTO `b5net_menu` VALUES ('103', '菜单管理', '2', '4', '/admin/menu/index', '0', 'C', '1', '0', 'admin:menu:index', 'fa fa-server', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单管理');
INSERT INTO `b5net_menu` VALUES ('104', '登录日志', '2', '5', '/admin/loginlog/index', '0', 'C', '1', '0', 'admin:loginlog:index', 'fa fa-paw', '2021-01-03 07:25:11', '2021-01-07 12:54:43', '登录日志');
INSERT INTO `b5net_menu` VALUES ('105', '参数配置', '1', '1', '/admin/config/index', '0', 'C', '1', '0', 'admin:config:index', 'fa fa-sliders', '2021-01-03 07:25:11', '2021-01-05 12:20:56', '参数配置');
INSERT INTO `b5net_menu` VALUES ('106', '字典管理', '1', '2', '/admin/dict/index', '0', 'C', '1', '0', 'admin:dict:index', 'fa fa-file-code-o', '2021-01-03 07:25:11', '2021-01-05 06:01:47', '字典管理');
INSERT INTO `b5net_menu` VALUES ('107', '通知公告', '1', '10', '/admin/notice/index', '0', 'C', '1', '0', 'admin:notice:index', 'fa fa-bullhorn', '2021-01-03 07:25:11', '2021-03-02 20:58:40', '通知公告');
INSERT INTO `b5net_menu` VALUES ('108', '跳转模块', '1', '3', '/admin/redtype/index', '0', 'C', '1', '0', 'admin:redtype:index', 'fa fa-code-fork', '2021-01-03 07:25:11', '2021-01-04 08:12:28', '跳转模块');
INSERT INTO `b5net_menu` VALUES ('109', '推荐位置', '1', '4', '/admin/adposition/index', '0', 'C', '1', '0', 'admin:adposition:index', 'fa fa-file-zip-o', '2021-01-03 07:25:11', '2021-03-02 21:13:14', '推荐位置');
INSERT INTO `b5net_menu` VALUES ('110', '推荐信息', '1', '11', '/admin/adlist/index', '0', 'C', '1', '0', 'admin:adlist:index', 'fa fa-sun-o', '2021-01-03 07:25:11', '2021-03-02 21:13:40', '推荐信息');
INSERT INTO `b5net_menu` VALUES ('111', '预约报名', '4', '1', '/admin/mapply/index', '0', 'C', '1', '0', 'admin:mapply:index', '', '2021-01-25 10:25:09', '2021-01-25 10:25:40', '');
INSERT INTO `b5net_menu` VALUES ('112', '站点管理', '3', '2', '/admin/website/index', '0', 'C', '1', '0', 'admin:website:index', '', '2021-03-02 21:00:24', '2021-03-02 21:10:06', '');
INSERT INTO `b5net_menu` VALUES ('113', '分类菜单', '3', '3', '/admin/webcat/index', '0', 'C', '1', '0', 'admin:webcat:index', '', '2021-03-02 21:00:24', '2021-03-03 15:07:20', '');
INSERT INTO `b5net_menu` VALUES ('114', '内容信息', '3', '0', '/admin/weblist/index', '0', 'C', '1', '0', 'admin:weblist:index', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('115', '广告信息', '3', '1', '/admin/webad/index', '0', 'C', '1', '0', 'admin:webad:index', '', '2021-03-02 21:00:24', '2021-03-04 16:29:21', '');
INSERT INTO `b5net_menu` VALUES ('116', '广告位置', '3', '4', '/admin/webpos/index', '0', 'C', '1', '0', 'admin:webpos:index', '', '2021-03-02 21:00:24', '2021-03-02 21:21:29', '');
INSERT INTO `b5net_menu` VALUES ('117', '清除缓存', '1', '8', '/admin/admin/allcache', '0', 'F', '1', '0', 'admin:admin:allcache', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('10000', '用户新增', '100', '1', '', '0', 'F', '1', '0', 'admin:admin:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '用户新增');
INSERT INTO `b5net_menu` VALUES ('10001', '用户修改', '100', '2', '', '0', 'F', '1', '0', 'admin:admin:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '用户修改');
INSERT INTO `b5net_menu` VALUES ('10002', '用户删除', '100', '3', '', '0', 'F', '1', '0', 'admin:admin:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '用户删除');
INSERT INTO `b5net_menu` VALUES ('10004', '用户状态', '100', '4', '', '0', 'F', '1', '0', 'admin:admin:setstatus', '', '2021-01-03 07:25:11', '2021-01-08 10:47:09', '用户状态');
INSERT INTO `b5net_menu` VALUES ('10100', '角色新增', '101', '1', '', '0', 'F', '1', '0', 'admin:role:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色新增');
INSERT INTO `b5net_menu` VALUES ('10101', '角色修改', '101', '2', '', '0', 'F', '1', '0', 'admin:role:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色修改');
INSERT INTO `b5net_menu` VALUES ('10102', '角色删除', '101', '3', '', '0', 'F', '1', '0', 'admin:role:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色删除');
INSERT INTO `b5net_menu` VALUES ('10104', '角色状态', '101', '4', '', '0', 'F', '1', '0', 'admin:role:setstatus', '', '2021-01-03 07:25:11', '2021-01-08 10:47:31', '角色状态');
INSERT INTO `b5net_menu` VALUES ('10105', '菜单授权', '101', '10', '', '0', 'F', '1', '0', 'admin:role:auth', '', '2021-01-03 07:25:11', '2021-01-07 13:32:41', '菜单授权');
INSERT INTO `b5net_menu` VALUES ('10110', '角色人员', '101', '11', '', '0', 'F', '1', '0', 'admin:adminrole:index', '', '2021-01-03 07:25:11', '2021-01-07 13:33:15', '角色人员');
INSERT INTO `b5net_menu` VALUES ('10111', '取消角色人员', '101', '12', '', '0', 'F', '1', '0', 'admin:adminrole:drop', '', '2021-01-03 07:25:11', '2021-01-07 15:36:14', '取消角色人员');
INSERT INTO `b5net_menu` VALUES ('10112', '添加角色人员', '101', '13', '', '0', 'F', '1', '0', 'admin:adminrole:add', '', '2021-01-03 07:25:11', '2021-01-07 15:36:14', '添加角色人员');
INSERT INTO `b5net_menu` VALUES ('10200', '组织新增', '102', '1', '', '0', 'F', '1', '0', 'admin:struct:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织新增');
INSERT INTO `b5net_menu` VALUES ('10201', '组织修改', '102', '2', '', '0', 'F', '1', '0', 'admin:struct:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织修改');
INSERT INTO `b5net_menu` VALUES ('10202', '组织删除', '102', '3', '', '0', 'F', '1', '0', 'admin:struct:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织删除');
INSERT INTO `b5net_menu` VALUES ('10300', '菜单新增', '103', '1', '', '0', 'F', '1', '0', 'admin:menu:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单新增');
INSERT INTO `b5net_menu` VALUES ('10301', '菜单修改', '103', '2', '', '0', 'F', '1', '0', 'admin:menu:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单修改');
INSERT INTO `b5net_menu` VALUES ('10302', '菜单删除', '103', '3', '', '0', 'F', '1', '0', 'admin:menu:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单删除');
INSERT INTO `b5net_menu` VALUES ('10400', '日志删除', '104', '0', '', '0', 'F', '1', '0', 'admin:loginlog:drop', '', '2021-01-07 13:03:15', '2021-01-07 13:03:15', '日志删除');
INSERT INTO `b5net_menu` VALUES ('10401', '日志清空', '104', '0', '', '0', 'F', '1', '0', 'admin:loginlog:trash', '', '2021-01-07 13:04:06', '2021-01-07 13:04:06', '日志清空');
INSERT INTO `b5net_menu` VALUES ('10500', '参数新增', '105', '1', '', '0', 'F', '1', '0', 'admin:config:add', '', '2021-01-03 07:25:11', '2021-01-05 06:00:02', '参数新增');
INSERT INTO `b5net_menu` VALUES ('10501', '参数修改', '105', '2', '', '0', 'F', '1', '0', 'admin:config:edit', '', '2021-01-03 07:25:11', '2021-01-05 06:00:25', '参数修改');
INSERT INTO `b5net_menu` VALUES ('10502', '参数删除', '105', '3', '', '0', 'F', '1', '0', 'admin:config:drop', '', '2021-01-03 07:25:11', '2021-01-05 06:00:59', '参数删除');
INSERT INTO `b5net_menu` VALUES ('10504', '清除缓存', '105', '4', '', '0', 'F', '1', '0', 'admin:config:delcache', '', '2021-01-03 07:25:11', '2021-01-08 10:46:47', '清除缓存');
INSERT INTO `b5net_menu` VALUES ('10505', '网站设置', '1', '0', '/admin/config/site', '0', 'C', '1', '0', 'admin:config:site', 'fa fa-object-group', '2021-01-11 22:17:31', '2021-01-11 22:39:46', '');
INSERT INTO `b5net_menu` VALUES ('10600', '字典新增', '106', '1', '', '0', 'F', '1', '0', 'admin:dict:add', '', '2021-01-03 07:25:11', '2021-01-05 06:02:13', '字典新增');
INSERT INTO `b5net_menu` VALUES ('10601', '字典修改', '106', '2', '', '0', 'F', '1', '0', 'admin:dict:edit', '', '2021-01-03 07:25:11', '2021-01-05 06:02:32', '字典修改');
INSERT INTO `b5net_menu` VALUES ('10602', '字典删除', '106', '3', '', '0', 'F', '1', '0', 'admin:dict:drop', '', '2021-01-03 07:25:11', '2021-01-05 06:02:53', '字典删除');
INSERT INTO `b5net_menu` VALUES ('10603', '清除缓存', '106', '4', '', '0', 'F', '1', '0', 'admin:dict:delcache', '', '2021-01-03 07:25:11', '2021-01-07 15:27:19', '清除缓存');
INSERT INTO `b5net_menu` VALUES ('10610', '数据列表', '106', '10', '', '0', 'F', '1', '0', 'admin:dictdata:index', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据列表');
INSERT INTO `b5net_menu` VALUES ('10611', '数据新增', '106', '11', '', '0', 'F', '1', '0', 'admin:dictdata:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据新增');
INSERT INTO `b5net_menu` VALUES ('10612', '数据修改', '106', '12', '', '0', 'F', '1', '0', 'admin:dictdata:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据修改');
INSERT INTO `b5net_menu` VALUES ('10613', '数据删除', '106', '13', '', '0', 'F', '1', '0', 'admin:dictdata:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据删除');
INSERT INTO `b5net_menu` VALUES ('10700', '公告新增', '107', '1', '', '0', 'F', '1', '0', 'admin:notice:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告新增');
INSERT INTO `b5net_menu` VALUES ('10701', '公告修改', '107', '2', '', '0', 'F', '1', '0', 'admin:notice:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告修改');
INSERT INTO `b5net_menu` VALUES ('10702', '公告删除', '107', '3', '', '0', 'F', '1', '0', 'admin:notice:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告删除');
INSERT INTO `b5net_menu` VALUES ('10800', '跳转新增', '108', '1', '', '0', 'F', '1', '0', 'admin:redtype:add', '', '2021-01-08 07:29:26', '2021-01-08 07:29:26', '跳转新增');
INSERT INTO `b5net_menu` VALUES ('10801', '跳转编辑', '108', '2', '', '0', 'F', '1', '0', 'admin:redtype:edit', '', '2021-01-08 07:29:26', '2021-01-08 07:29:26', '跳转编辑');
INSERT INTO `b5net_menu` VALUES ('10802', '跳转删除', '108', '3', '', '0', 'F', '1', '0', 'admin:redtype:drop', '', '2021-01-08 07:29:26', '2021-01-08 07:29:26', '跳转删除');
INSERT INTO `b5net_menu` VALUES ('10803', '清除缓存', '108', '4', '', '0', 'F', '1', '0', 'admin:redtype:delcache', '', '2021-01-08 07:29:26', '2021-01-08 07:29:26', '清除缓存');
INSERT INTO `b5net_menu` VALUES ('10900', '位置新增', '109', '1', '', '0', 'F', '1', '0', 'admin:adposition:add', '', '2021-01-07 15:36:14', '2021-01-07 15:36:14', '位置新增');
INSERT INTO `b5net_menu` VALUES ('10901', '位置编辑', '109', '2', '', '0', 'F', '1', '0', 'admin:adposition:edit', '', '2021-01-07 15:37:56', '2021-01-07 15:37:56', '位置编辑');
INSERT INTO `b5net_menu` VALUES ('10902', '位置删除', '109', '3', '', '0', 'F', '1', '0', 'admin:adposition:drop', '', '2021-01-03 07:25:11', '2021-01-07 15:36:14', '位置删除');
INSERT INTO `b5net_menu` VALUES ('10903', '清除缓存', '109', '4', '', '0', 'F', '1', '0', 'admin:adposition:delcache', '', '2021-01-03 07:25:11', '2021-01-07 15:36:14', '清除缓存');
INSERT INTO `b5net_menu` VALUES ('11000', '信息新增', '110', '1', '', '0', 'F', '1', '0', 'admin:adlist:add', '', '2021-01-08 07:26:14', '2021-01-08 07:26:14', '信息新增');
INSERT INTO `b5net_menu` VALUES ('11001', '信息编辑', '110', '2', '', '0', 'F', '1', '0', 'admin:adlist:edit', '', '2021-01-08 07:26:14', '2021-01-08 07:26:14', '信息编辑');
INSERT INTO `b5net_menu` VALUES ('11002', '信息删除', '110', '3', '', '0', 'F', '1', '0', 'admin:adlist:drop', '', '2021-01-08 07:26:14', '2021-01-08 07:26:14', '信息删除');
INSERT INTO `b5net_menu` VALUES ('11003', '清除缓存', '110', '4', '', '0', 'F', '1', '0', 'admin:adlist:delcache', '', '2021-01-08 07:26:14', '2021-01-08 07:26:14', '清除缓存');
INSERT INTO `b5net_menu` VALUES ('11101', '添加预约', '111', '1', '', '0', 'F', '1', '0', 'admin:mapply:add', '', '2021-01-25 10:26:18', '2021-01-25 10:27:12', '');
INSERT INTO `b5net_menu` VALUES ('11102', '编辑预约', '111', '2', '', '0', 'F', '1', '0', 'admin:mapply:edit', '', '2021-01-25 10:27:00', '2021-01-25 10:27:19', '');
INSERT INTO `b5net_menu` VALUES ('11103', '删除预约', '111', '3', '', '0', 'F', '1', '0', 'admin:mapply:drop', '', '2021-01-25 10:27:45', '2021-01-25 10:27:45', '');
INSERT INTO `b5net_menu` VALUES ('11201', '添加站点', '112', '1', '', '0', 'F', '1', '0', 'admin:website:add', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11202', '编辑站点', '112', '2', '', '0', 'F', '1', '0', 'admin:website:edit', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11203', '删除站点', '112', '3', '', '0', 'F', '1', '0', 'admin:website:drop', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11204', '清除缓存', '112', '4', '', '0', 'F', '1', '0', 'admin:website:delcache', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11301', '添加站点分类', '113', '1', '', '0', 'F', '1', '0', 'admin:webcat:add', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11302', '编辑站点分类', '113', '2', '', '0', 'F', '1', '0', 'admin:webcat:edit', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11303', '删除站点分类', '113', '3', '', '0', 'F', '1', '0', 'admin:webcat:drop', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11304', '清除站点分类缓存', '113', '4', '', '0', 'F', '1', '0', 'admin:webcat:delcache', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11401', '添加信息', '114', '1', '', '0', 'F', '1', '0', 'admin:weblist:add', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11402', '编辑信息', '114', '2', '', '0', 'F', '1', '0', 'admin:weblist:edit', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11403', '删除信息', '114', '3', '', '0', 'F', '1', '0', 'admin:weblist:drop', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11501', '添加广告', '115', '1', '', '0', 'F', '1', '0', 'admin:webad:add', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11502', '编辑广告', '115', '2', '', '0', 'F', '1', '0', 'admin:webad:edit', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11503', '删除广告', '115', '3', '', '0', 'F', '1', '0', 'admin:webad:drop', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11504', '清除广告缓存', '115', '4', '', '0', 'F', '1', '0', 'admin:webad:delcache', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11601', '添加位置', '116', '1', '', '0', 'F', '1', '0', 'admin:webpos:add', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11602', '编辑位置', '116', '2', '', '0', 'F', '1', '0', 'admin:webpos:edit', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11603', '删除位置', '116', '3', '', '0', 'F', '1', '0', 'admin:webpos:drop', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');
INSERT INTO `b5net_menu` VALUES ('11604', '清除位置缓存', '116', '4', '', '0', 'F', '1', '0', 'admin:webpos:delcache', '', '2021-03-02 21:00:24', '2021-03-02 21:00:24', '');

-- ----------------------------
-- Table structure for `b5net_notice`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_notice`;
CREATE TABLE `b5net_notice` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '公告ID',
  `title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '公告标题',
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '公告类型（1通知 2公告）',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '公告内容',
  `textarea` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '非html内容',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '公告状态（1正常 0关闭）',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='通知公告表';

-- ----------------------------
-- Records of b5net_notice
-- ----------------------------
INSERT INTO `b5net_notice` VALUES ('1', '【公告】： B5LaravelCMF新版本发布啦', '2', '<p>新版本内容</p><p><br></p><p>新版本内容</p><p>新版本内容</p><p>新版本内容<br></p>', '', '1', '2020-12-24 11:33:42', '2021-01-01 15:57:03');
INSERT INTO `b5net_notice` VALUES ('2', '【通知】：B5LaravelCMF系统凌晨维护', '1', '<font color=\"#0000ff\">维护内容</font>', '', '1', '2020-12-24 11:33:42', '2021-01-01 15:57:22');

-- ----------------------------
-- Table structure for `b5net_opert_log`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_opert_log`;
CREATE TABLE `b5net_opert_log` (
  `oper_id` bigint NOT NULL AUTO_INCREMENT COMMENT '日志主键',
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '模块标题',
  `business_type` int DEFAULT '0' COMMENT '业务类型（0其它 1新增 2修改 3删除）',
  `method` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '方法名称',
  `request_method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '请求方式',
  `operator_type` int DEFAULT '0' COMMENT '操作类别（0其它 1后台用户 2手机端用户）',
  `oper_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '操作人员',
  `dept_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '部门名称',
  `oper_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '请求URL',
  `oper_ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '主机地址',
  `oper_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '操作地点',
  `oper_param` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '请求参数',
  `json_result` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '返回参数',
  `status` int DEFAULT '0' COMMENT '操作状态（0正常 1异常）',
  `error_msg` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '错误消息',
  `oper_time` datetime DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`oper_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='操作日志记录';

-- ----------------------------
-- Records of b5net_opert_log
-- ----------------------------

-- ----------------------------
-- Table structure for `b5net_redtype`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_redtype`;
CREATE TABLE `b5net_redtype` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '跳转标识',
  `list_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '跳转模块连接',
  `info_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '跳转信息链接',
  `status` tinyint unsigned NOT NULL DEFAULT '1',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '备注',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `adkey` (`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='跳转配置表';

-- ----------------------------
-- Records of b5net_redtype
-- ----------------------------
INSERT INTO `b5net_redtype` VALUES ('1', '通知公告', 'notice', '', '', '1', '通知公告模块', '2021-01-04 07:34:32', '2021-01-04 07:48:51');
INSERT INTO `b5net_redtype` VALUES ('2', '个人中心', 'ucenter', '', '', '1', '', '2021-01-08 06:39:27', '2021-01-08 06:50:44');

-- ----------------------------
-- Table structure for `b5net_role`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_role`;
CREATE TABLE `b5net_role` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `rolekey` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '角色权限字符串',
  `listsort` int NOT NULL DEFAULT '0' COMMENT '显示顺序',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '角色状态（1正常 0停用）',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rolekey` (`rolekey`) USING BTREE,
  KEY `listsort` (`listsort`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='角色信息表';

-- ----------------------------
-- Records of b5net_role
-- ----------------------------
INSERT INTO `b5net_role` VALUES ('1', '超管', 'administrator', '0', '1', '2020-12-28 07:42:31', '2020-12-28 07:42:31', '超级管理员');
INSERT INTO `b5net_role` VALUES ('2', '普通用户', 'common', '1', '1', '2021-01-15 10:58:24', '2021-01-15 10:58:24', '');

-- ----------------------------
-- Table structure for `b5net_role_menu`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_role_menu`;
CREATE TABLE `b5net_role_menu` (
  `role_id` bigint NOT NULL COMMENT '角色ID',
  `menu_id` bigint NOT NULL COMMENT '菜单ID',
  PRIMARY KEY (`role_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='角色和菜单关联表';

-- ----------------------------
-- Records of b5net_role_menu
-- ----------------------------
INSERT INTO `b5net_role_menu` VALUES ('2', '1');
INSERT INTO `b5net_role_menu` VALUES ('2', '2');
INSERT INTO `b5net_role_menu` VALUES ('2', '3');
INSERT INTO `b5net_role_menu` VALUES ('2', '90');
INSERT INTO `b5net_role_menu` VALUES ('2', '100');
INSERT INTO `b5net_role_menu` VALUES ('2', '101');
INSERT INTO `b5net_role_menu` VALUES ('2', '102');
INSERT INTO `b5net_role_menu` VALUES ('2', '103');
INSERT INTO `b5net_role_menu` VALUES ('2', '104');
INSERT INTO `b5net_role_menu` VALUES ('2', '105');
INSERT INTO `b5net_role_menu` VALUES ('2', '106');
INSERT INTO `b5net_role_menu` VALUES ('2', '107');
INSERT INTO `b5net_role_menu` VALUES ('2', '108');
INSERT INTO `b5net_role_menu` VALUES ('2', '109');
INSERT INTO `b5net_role_menu` VALUES ('2', '110');
INSERT INTO `b5net_role_menu` VALUES ('2', '10000');
INSERT INTO `b5net_role_menu` VALUES ('2', '10001');
INSERT INTO `b5net_role_menu` VALUES ('2', '10002');
INSERT INTO `b5net_role_menu` VALUES ('2', '10004');
INSERT INTO `b5net_role_menu` VALUES ('2', '10100');
INSERT INTO `b5net_role_menu` VALUES ('2', '10101');
INSERT INTO `b5net_role_menu` VALUES ('2', '10102');
INSERT INTO `b5net_role_menu` VALUES ('2', '10104');
INSERT INTO `b5net_role_menu` VALUES ('2', '10105');
INSERT INTO `b5net_role_menu` VALUES ('2', '10110');
INSERT INTO `b5net_role_menu` VALUES ('2', '10111');
INSERT INTO `b5net_role_menu` VALUES ('2', '10112');
INSERT INTO `b5net_role_menu` VALUES ('2', '10200');
INSERT INTO `b5net_role_menu` VALUES ('2', '10201');
INSERT INTO `b5net_role_menu` VALUES ('2', '10202');
INSERT INTO `b5net_role_menu` VALUES ('2', '10300');
INSERT INTO `b5net_role_menu` VALUES ('2', '10301');
INSERT INTO `b5net_role_menu` VALUES ('2', '10302');
INSERT INTO `b5net_role_menu` VALUES ('2', '10400');
INSERT INTO `b5net_role_menu` VALUES ('2', '10401');
INSERT INTO `b5net_role_menu` VALUES ('2', '10500');
INSERT INTO `b5net_role_menu` VALUES ('2', '10501');
INSERT INTO `b5net_role_menu` VALUES ('2', '10502');
INSERT INTO `b5net_role_menu` VALUES ('2', '10504');
INSERT INTO `b5net_role_menu` VALUES ('2', '10505');
INSERT INTO `b5net_role_menu` VALUES ('2', '10600');
INSERT INTO `b5net_role_menu` VALUES ('2', '10601');
INSERT INTO `b5net_role_menu` VALUES ('2', '10602');
INSERT INTO `b5net_role_menu` VALUES ('2', '10603');
INSERT INTO `b5net_role_menu` VALUES ('2', '10610');
INSERT INTO `b5net_role_menu` VALUES ('2', '10611');
INSERT INTO `b5net_role_menu` VALUES ('2', '10612');
INSERT INTO `b5net_role_menu` VALUES ('2', '10613');
INSERT INTO `b5net_role_menu` VALUES ('2', '10700');
INSERT INTO `b5net_role_menu` VALUES ('2', '10701');
INSERT INTO `b5net_role_menu` VALUES ('2', '10702');
INSERT INTO `b5net_role_menu` VALUES ('2', '10800');
INSERT INTO `b5net_role_menu` VALUES ('2', '10801');
INSERT INTO `b5net_role_menu` VALUES ('2', '10802');
INSERT INTO `b5net_role_menu` VALUES ('2', '10803');
INSERT INTO `b5net_role_menu` VALUES ('2', '10900');
INSERT INTO `b5net_role_menu` VALUES ('2', '10901');
INSERT INTO `b5net_role_menu` VALUES ('2', '10902');
INSERT INTO `b5net_role_menu` VALUES ('2', '10903');
INSERT INTO `b5net_role_menu` VALUES ('2', '11000');
INSERT INTO `b5net_role_menu` VALUES ('2', '11001');
INSERT INTO `b5net_role_menu` VALUES ('2', '11002');
INSERT INTO `b5net_role_menu` VALUES ('2', '11003');

-- ----------------------------
-- Table structure for `b5net_smscode`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_smscode`;
CREATE TABLE `b5net_smscode` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '手机号码',
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '验证码',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '例如：1注册 2登录 3忘记密码',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0未验证 1已验证',
  `os` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '运营商',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='验证码表';

-- ----------------------------
-- Records of b5net_smscode
-- ----------------------------

-- ----------------------------
-- Table structure for `b5net_struct`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_struct`;
CREATE TABLE `b5net_struct` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '部门id',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '部门名称',
  `parent_id` int DEFAULT '0' COMMENT '父部门id',
  `levels` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '祖级列表',
  `listsort` int DEFAULT '0' COMMENT '显示顺序',
  `leader` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '负责人',
  `phone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '联系电话',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '备注',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '1' COMMENT '部门状态（1正常 0停用）',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='组织架构';

-- ----------------------------
-- Records of b5net_struct
-- ----------------------------
INSERT INTO `b5net_struct` VALUES ('100', '冰舞科技', '0', '0', '0', '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2021-01-08 11:06:15');
INSERT INTO `b5net_struct` VALUES ('101', '北京总公司', '100', '0,100', '1', '冰舞', '18888888888', '', '1', '2020-12-24 11:33:42', '2021-01-08 11:06:04');
INSERT INTO `b5net_struct` VALUES ('103', '研发部门', '101', '0,100,101', '1', '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2021-01-08 11:06:29');
INSERT INTO `b5net_struct` VALUES ('104', '市场部门', '101', '0,100,101', '2', '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2021-01-08 11:06:33');
INSERT INTO `b5net_struct` VALUES ('105', '测试部门', '101', '0,100,101', '3', '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2021-01-16 11:14:11');
INSERT INTO `b5net_struct` VALUES ('110', '山东分公司', '100', '0,100', '2', '冰舞', '1888888', '', '1', '2021-01-08 11:11:33', '2021-01-08 11:11:33');
INSERT INTO `b5net_struct` VALUES ('111', '销售部门', '110', '0,100,110', '1', '', '', '', '1', '2021-01-08 11:11:48', '2021-01-08 11:11:48');

-- ----------------------------
-- Table structure for `b5net_web_ad`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_web_ad`;
CREATE TABLE `b5net_web_ad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '信息标题',
  `pos_id` int NOT NULL DEFAULT '0' COMMENT '推荐位置',
  `linkurl` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `listsort` int NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `text_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '文本信息',
  `text_rich` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '富文本信息',
  `imglist` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '图片信息',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `website` varchar(50) COLLATE utf8mb4_general_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='推荐信息表';

-- ----------------------------
-- Records of b5net_web_ad
-- ----------------------------
INSERT INTO `b5net_web_ad` VALUES ('1', '首页banner1', '1', '', '0', '1', '', '', '/uploads/adlist/2021/03/04/7929a2b2618809eacd8a3aaf1ca45406.jpg', '2021-03-04 16:01:17', '2021-03-04 16:53:26', '1');
INSERT INTO `b5net_web_ad` VALUES ('2', '首页banner2', '1', 'http://www.b5net.com', '1', '1', '', '', '/uploads/webadlist/2021/03/04/96e9a1ae8e8c76a6ca971cbb8dbb1ba7.jpg', '2021-03-04 16:26:22', '2021-03-04 16:55:22', '1');
INSERT INTO `b5net_web_ad` VALUES ('3', '啊大苏打撒旦', '4', '', '0', '1', '', '', '', '2021-03-04 17:37:16', '2021-03-04 17:37:16', '1');

-- ----------------------------
-- Table structure for `b5net_web_cat`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_web_cat`;
CREATE TABLE `b5net_web_cat` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '菜单标题，后台',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '菜单名称 前台',
  `catkey` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '菜单标识',
  `website` int NOT NULL DEFAULT '0' COMMENT '鎵€灞炵珯鐐?',
  `parent_id` int NOT NULL DEFAULT '0' COMMENT '父级菜单',
  `listsort` int NOT NULL DEFAULT '0' COMMENT '显示排序',
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT 'album相册，list文章列表，page单页，link外链,',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `lang` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '语言',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '外链地址',
  `relcat` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '关联的菜单标识',
  `checkcode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '选中菜单的标识',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='网站-菜单分类';

-- ----------------------------
-- Records of b5net_web_cat
-- ----------------------------
INSERT INTO `b5net_web_cat` VALUES ('1', '集团简介11111', '集团简介', 'about', '1', '0', '0', 'page', '1', '', '', '', '', '2021-02-25 16:05:58', '2021-03-04 17:22:37');
INSERT INTO `b5net_web_cat` VALUES ('2', '产品展示2222', '产品展示', 'prod', '1', '0', '1', 'none', '1', '', '', '', '', '2021-02-25 16:08:10', '2021-03-03 14:15:40');
INSERT INTO `b5net_web_cat` VALUES ('3', '联系我们3333', '联系我们', 'link', '1', '0', '4', 'page', '1', '', '', '', '', '2021-02-25 16:09:06', '2021-03-01 09:30:12');
INSERT INTO `b5net_web_cat` VALUES ('4', '资质证明444', '资质证明', 'cert', '1', '0', '3', 'page', '1', '', '', '', '', '2021-02-25 16:12:30', '2021-03-01 09:29:49');
INSERT INTO `b5net_web_cat` VALUES ('5', 'PE管材123', 'PE管材', 'pe', '1', '2', '0', 'goods', '1', '', '', '', '', '2021-02-25 16:14:54', '2021-02-26 10:02:46');
INSERT INTO `b5net_web_cat` VALUES ('7', '新闻资讯', '新闻资讯', 'news', '1', '0', '2', 'list', '1', '', '', '', '', '2021-03-01 09:25:15', '2021-03-02 10:40:43');
INSERT INTO `b5net_web_cat` VALUES ('9', '陶瓷产品', '陶瓷产品', 'pottery', '1', '2', '2', 'list', '1', '', '', '', '', '2021-03-04 17:23:53', '2021-03-04 17:24:00');

-- ----------------------------
-- Table structure for `b5net_web_list`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_web_list`;
CREATE TABLE `b5net_web_list` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `remark` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '简介',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `author` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '作者',
  `froms` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '来源',
  `thumbimg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '缩略图',
  `catid` int NOT NULL DEFAULT '0' COMMENT '所属菜单ID',
  `website` int DEFAULT '0' COMMENT '鎵€灞炵珯鐐?',
  `click` int DEFAULT '0',
  `linkurl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '外链地址',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `subtime` datetime DEFAULT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='网站-信息列表';

-- ----------------------------
-- Records of b5net_web_list
-- ----------------------------
INSERT INTO `b5net_web_list` VALUES ('3', '测试标题111', '简介4444444', '1', '作者333', '来源22', '/uploads/weblist/2021/03/03/c3b4be409520b765d60ae349e22bc179.jpg', '5', '1', '0', '', '2021-03-01 16:34:53', '2021-03-03 14:57:25', '2021-03-03 14:57:10');
INSERT INTO `b5net_web_list` VALUES ('4', '新闻资讯测试信息11111', '啊萨达萨达萨达萨达是打赏打赏\r\n奥瑟大撒大阿萨大阿萨大as\r\n打赏阿萨大阿萨大阿萨大阿萨大阿斯顿撒', '1', '作者测试11', '来源1', '/uploads/weblist/2021/03/03/2d0afe6d2780c722ab58268382522cda.jpg', '7', '1', '0', '', '2021-03-03 14:21:00', '2021-03-03 14:21:00', '2021-03-03 14:17:31');
INSERT INTO `b5net_web_list` VALUES ('5', '集团简介', '温热微软', '1', '', '', '', '1', '1', '0', '', '2021-03-04 17:34:50', '2021-03-04 17:35:01', '2021-03-04 17:34:58');

-- ----------------------------
-- Table structure for `b5net_web_list_ext`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_web_list_ext`;
CREATE TABLE `b5net_web_list_ext` (
  `id` int unsigned NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `imglist` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `website` int DEFAULT '0',
  `catid` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='网站-信息列表其他信息';

-- ----------------------------
-- Records of b5net_web_list_ext
-- ----------------------------
INSERT INTO `b5net_web_list_ext` VALUES ('3', '<p>内容5555</p><p>内容5555<span style=\"color: inherit;\">内容5555</span><span style=\"color: inherit;\">内容5555</span><span style=\"color: inherit;\">内容5555</span><span style=\"color: inherit;\">内容5555</span><span style=\"color: inherit;\">内容5555</span><span style=\"color: inherit;\">内容5555</span></p><p>内容5555内容5555内容5555内容5555内容5555内容5555内容5555内容5555内容5555内容5555内容5555内容5555内容5555内容5555内容5555内容5555内容5555内容5555内容5555内容5555内容5555</p><p><img src=\"http://www.laravelweb.my/uploads/editor/2021/03/01/b0bf4ded340b48d2868566b906676319.jpg\" data-filename=\"timg (2).jpg\" style=\"width: 50%;\"><span style=\"color: inherit;\"><br></span><br></p>', '/uploads/weblist/2021/03/03/c3b4be409520b765d60ae349e22bc179.jpg,/uploads/weblist/2021/03/03/45e9ba219691a5ae720ef7d6fd454a36.png', '1', '5');
INSERT INTO `b5net_web_list_ext` VALUES ('4', '<p>啊实打实打算打赏dasd</p><p>啊实打实打赏打赏撒</p><p>阿萨大阿萨大阿萨大阿萨大奥瑟<img src=\"http://admin.b5laravelcmf.b5net.com/uploads/editor/2021/03/03/2c9933521a0ffbd3e784a42eda6abd49.png\" data-filename=\"未标题-1.png\" style=\"width: 400px;\"></p>', '/uploads/weblist/2021/03/03/2d0afe6d2780c722ab58268382522cda.jpg', '1', '7');
INSERT INTO `b5net_web_list_ext` VALUES ('5', '', '', '1', '1');

-- ----------------------------
-- Table structure for `b5net_web_pos`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_web_pos`;
CREATE TABLE `b5net_web_pos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `website` int NOT NULL DEFAULT '0' COMMENT '鎵€灞炵珯鐐?',
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '位置名称',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `width` mediumint NOT NULL DEFAULT '0',
  `height` mediumint NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='推荐位置表';

-- ----------------------------
-- Records of b5net_web_pos
-- ----------------------------
INSERT INTO `b5net_web_pos` VALUES ('1', '1', '站点banner图', '', '0', '0', '2021-03-03 16:59:03', '2021-03-04 16:58:56');
INSERT INTO `b5net_web_pos` VALUES ('3', '2', '站点banner图1111', '', '0', '0', '2021-03-04 10:04:16', '2021-03-04 15:07:53');
INSERT INTO `b5net_web_pos` VALUES ('4', '1', '参数的撒山东', '', '0', '0', '2021-03-04 17:36:34', '2021-03-04 17:36:34');

-- ----------------------------
-- Table structure for `b5net_web_site`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_web_site`;
CREATE TABLE `b5net_web_site` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标识',
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '站点标题（后台）',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '站点名称（前台）',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `is_default` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='网站-站点管理';

-- ----------------------------
-- Records of b5net_web_site
-- ----------------------------
INSERT INTO `b5net_web_site` VALUES ('1', 'test1', '测试站点11', 'XXXXX公司', '1', '2021-02-25 10:50:08', '2021-03-02 10:48:47', '1');

-- ----------------------------
-- Table structure for `b5net_wechat_access`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_wechat_access`;
CREATE TABLE `b5net_wechat_access` (
  `appid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `access_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `jsapi_ticket` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `access_token_add` int NOT NULL DEFAULT '0',
  `jsapi_ticket_add` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`appid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='微信jsapi和access';

-- ----------------------------
-- Records of b5net_wechat_access
-- ----------------------------
INSERT INTO `b5net_wechat_access` VALUES ('wx2ba634598c7df708', '42_LA-wqGsGGvUWbCxmb8f1ic0Xkw900VKoCcKbLKo1IPscAGppSGgDrr45KjFbl8l9uKA3toE02j7K8NKxHpkW9ZQQFb5SDf9uw0ranFSmNBfygIHAtb405AS55btkdXUGE6FcE5MMOJp0k5UNLXWfAHAEQP', 'sM4AOVdWfPE4DxkXGEs8VEHh_EQ4eLTYEqfB5PSBsfgAFPXaFywajpOFxzal83KDMqKnS6qguhgFsAwiHHcTcA', '1613696845', '1613696846');

-- ----------------------------
-- Table structure for `b5net_wechat_users`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_wechat_users`;
CREATE TABLE `b5net_wechat_users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '唯一标识',
  `appid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '公众号参数',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `headimg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '头像地址',
  `update_time` datetime DEFAULT NULL COMMENT '资料更新时间',
  `create_time` datetime DEFAULT NULL COMMENT '添加时间',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别',
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '城市',
  `country` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '国家',
  `province` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '省份',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `openid` (`openid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='微信用户信息表';

-- ----------------------------
-- Records of b5net_wechat_users
-- ----------------------------
INSERT INTO `b5net_wechat_users` VALUES ('1', 'oBi_at5iKwWaNcmTEpkr_IUwxDBw', 'wx2ba634598c7df708', 'A????', 'https://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIiamNbeIaDHptKEkg0E90qgfQ8QnOdPoeBOYDE0UyBN0ExkCLYIAyNMQr6tnro5ssXTEwX0J8Q0icg/132', '2021-02-02 23:35:48', '2021-02-02 23:35:48', '1', '临沂', '中国', '山东', '1', 'mapply_1');
INSERT INTO `b5net_wechat_users` VALUES ('2', 'oBi_at-f8RORVDzNs-DY42Gx2Z5Y', 'wx2ba634598c7df708', '李先生', 'https://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eo5thwrUYkscpLLpLc8gx4q6CL8nxm7Ciaicjc9icMYCYEsXWaGsbkjETycFAZMVUIGmiazSDiaib7XKOgw/132', '2021-02-18 14:48:55', '2021-02-18 14:48:55', '1', '临沂', '中国', '山东', '1', 'mapply_1');

-- ----------------------------
-- Table structure for `failed_jobs`
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for `jobs`
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`(191)) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('2', '2021_01_06_091649_create_sessions_table', '1');
INSERT INTO `migrations` VALUES ('3', '2021_01_23_102307_create_jobs_table', '1');
