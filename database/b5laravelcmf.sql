/*
Navicat MySQL Data Transfer

Source Server         : 我的新ECS
Source Server Version : 80023
Source Host           : 47.114.86.223:3306
Source Database       : admin_b5laravel

Target Server Type    : MYSQL
Target Server Version : 80023
File Encoding         : 65001

Date: 2021-03-09 09:46:07
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
INSERT INTO `b5net_admin` VALUES ('1', 'admin', '41b67b282ed0709f70bdebce8a70c90c', '超管', '1', '超级管理员', '2020-12-24 10:50:56', '2021-03-09 09:43:01', null, null);
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
  `net` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0' COMMENT '登录状态（0成功 1失败）',
  `msg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '提示消息',
  `login_time` datetime DEFAULT NULL COMMENT '访问时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=593 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='系统访问记录';

-- ----------------------------
-- Records of b5net_loginlog
-- ----------------------------
INSERT INTO `b5net_loginlog` VALUES ('1', 'ceshi', '112.66.33.23', '海南省海口市', 'Edge 87.0.664.75', 'OS X 10_14_6', '', '1', '登陆成功', '2021-01-10 13:23:39');
INSERT INTO `b5net_loginlog` VALUES ('2', 'ceshi', '111.194.51.15', '北京市', 'Chrome 87.0.4280.141', 'OS X 10_14_2', '', '1', '登陆成功', '2021-01-10 13:30:46');
INSERT INTO `b5net_loginlog` VALUES ('3', 'ceshi', '182.148.203.14', '四川省成都市', 'Chrome 87.0.4280.88', 'Windows 10.0', '', '1', '登陆成功', '2021-01-10 13:37:09');
INSERT INTO `b5net_loginlog` VALUES ('4', 'ceshi', '118.114.112.190', '四川省成都市', 'Chrome 87.0.4280.88', 'Windows 10.0', '', '1', '登陆成功', '2021-01-10 13:40:53');
INSERT INTO `b5net_loginlog` VALUES ('5', 'ceshi', '49.157.12.4', '菲律宾', 'Chrome 87.0.4280.88', 'Windows 10.0', '', '1', '登陆成功', '2021-01-10 13:52:38');
INSERT INTO `b5net_loginlog` VALUES ('6', 'ceshi', '223.104.102.138', '河北省衡水市', 'Safari 11.1.2', 'OS X 10_13_6', '', '1', '登陆成功', '2021-01-10 13:57:35');
INSERT INTO `b5net_loginlog` VALUES ('7', 'ceshi', '116.178.54.78', '新疆喀什', 'Chrome 87.0.4280.88', 'Windows 10.0', '', '1', '登陆成功', '2021-01-10 14:07:15');
INSERT INTO `b5net_loginlog` VALUES ('8', 'ceshi', '124.236.131.159', '河北省石家庄市', 'Chrome 87.0.4280.141', 'OS X 10_15_7', '', '1', '登陆成功', '2021-01-10 14:22:44');
INSERT INTO `b5net_loginlog` VALUES ('9', 'ceshi', '114.97.153.133', '安徽省合肥市', 'Chrome 87.0.4280.141', 'Windows 10.0', '', '1', '登陆成功', '2021-01-10 14:39:02');
INSERT INTO `b5net_loginlog` VALUES ('10', 'ceshi', '36.235.155.38', '台湾省台中市', 'Chrome 87.0.4280.101', 'OS X 11_1_0', '', '1', '登陆成功', '2021-01-10 14:58:50');
INSERT INTO `b5net_loginlog` VALUES ('11', 'ceshi', '116.249.16.103', '云南省昆明市', 'Chrome 86.0.4240.75', 'Windows 10.0', '', '1', '登陆成功', '2021-01-10 15:22:40');
INSERT INTO `b5net_loginlog` VALUES ('12', 'ceshi', '118.170.105.147', '台湾省南投市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '', '1', '登陆成功', '2021-01-10 15:25:16');
INSERT INTO `b5net_loginlog` VALUES ('13', 'ceshi', '14.20.88.50', '广东省深圳市', 'Chrome 87.0.4280.88', 'OS X 10_15_7', '', '1', '登陆成功', '2021-01-10 15:55:22');
INSERT INTO `b5net_loginlog` VALUES ('14', 'ceshi', '119.123.74.208', '广东省深圳市', 'Chrome 84.0.4147.135', 'OS X 10_15_3', '', '1', '登陆成功', '2021-01-10 16:01:42');
INSERT INTO `b5net_loginlog` VALUES ('15', 'ceshi', '115.192.115.207', '浙江省杭州市', 'Chrome 78.0.3904.108', 'Windows 10.0', '', '1', '登陆成功', '2021-01-10 16:06:28');
INSERT INTO `b5net_loginlog` VALUES ('16', 'ceshi', '120.41.230.89', '福建省厦门市', 'Chrome 87.0.4280.88', 'OS X 11_1_0', '', '1', '登陆成功', '2021-01-10 16:06:46');
INSERT INTO `b5net_loginlog` VALUES ('17', 'ceshi', '113.118.46.205', '广东省深圳市', 'Chrome 87.0.4280.88', 'Windows 10.0', '', '1', '登陆成功', '2021-01-10 16:14:01');
INSERT INTO `b5net_loginlog` VALUES ('18', 'ceshi', '113.97.34.90', '广东省深圳市', 'Chrome 87.0.4280.88', 'OS X 11_1_0', '', '1', '登陆成功', '2021-01-10 16:23:32');
INSERT INTO `b5net_loginlog` VALUES ('19', 'ceshi', '157.255.242.249', '广东省深圳市', 'UCBrowser 12.1.7.997', 'AndroidOS 9', '', '1', '登陆成功', '2021-01-10 18:27:49');
INSERT INTO `b5net_loginlog` VALUES ('20', 'ceshi', '27.18.58.85', '湖北省武汉市', 'Chrome 87.0.4280.67', 'OS X 11_1_0', '', '1', '登陆成功', '2021-01-10 18:30:58');
INSERT INTO `b5net_loginlog` VALUES ('21', 'ceshi', '27.17.218.175', '湖北省武汉市', 'Chrome 72.0.3626.81', 'Windows 6.1', '', '1', '登陆成功', '2021-01-10 18:49:11');
INSERT INTO `b5net_loginlog` VALUES ('22', 'admin', '144.52.190.101', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登陆成功', '2021-01-10 19:46:35');
INSERT INTO `b5net_loginlog` VALUES ('23', 'ceshi', '112.96.179.223', '广东省广州市', 'Chrome 87.0.4280.141', 'Windows 6.1', '', '1', '登陆成功', '2021-01-10 19:47:10');
INSERT INTO `b5net_loginlog` VALUES ('24', 'admin', '144.52.190.101', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '0', '验证码错误', '2021-01-10 20:18:54');
INSERT INTO `b5net_loginlog` VALUES ('25', 'admin', '144.52.190.101', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登陆成功', '2021-01-10 20:19:03');
INSERT INTO `b5net_loginlog` VALUES ('26', 'ceshi', '58.48.129.152', '湖北省武汉市', 'Chrome 87.0.4280.141', 'OS X 10_14_6', '电信', '1', '登陆成功', '2021-01-10 21:23:30');
INSERT INTO `b5net_loginlog` VALUES ('27', 'ceshi', '171.214.249.125', '四川省成都市', 'Chrome 76.0.3809.89', 'AndroidOS 10', '电信', '1', '登陆成功', '2021-01-10 22:37:51');
INSERT INTO `b5net_loginlog` VALUES ('28', 'ceshi', '124.236.159.27', '河北省石家庄市', 'Chrome 87.0.4280.88', 'OS X 10_13_6', '电信', '1', '登陆成功', '2021-01-10 22:47:41');
INSERT INTO `b5net_loginlog` VALUES ('29', 'ceshi', '118.250.74.168', '湖南省长沙市', 'Edge 87.0.664.66', 'OS X 11_1_0', '电信', '1', '登陆成功', '2021-01-10 23:21:10');
INSERT INTO `b5net_loginlog` VALUES ('30', 'ceshi', '61.144.100.140', '广东省广州市海珠区', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-10 23:41:22');
INSERT INTO `b5net_loginlog` VALUES ('31', 'ceshi', '27.17.218.175', '湖北省武汉市', 'Chrome 72.0.3626.81', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-10 23:47:38');
INSERT INTO `b5net_loginlog` VALUES ('32', 'ceshi', '220.185.204.31', '浙江省台州市椒江区', 'Chrome 87.0.4280.88', 'OS X 10_14_6', '电信', '1', '登陆成功', '2021-01-11 08:21:01');
INSERT INTO `b5net_loginlog` VALUES ('33', 'ceshi', '60.10.194.48', '河北省廊坊市', 'Chrome 55.0.2883.87', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-11 08:48:43');
INSERT INTO `b5net_loginlog` VALUES ('34', 'ceshi', '218.18.79.43', '广东省深圳市宝安区', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '0', '验证码错误', '2021-01-11 09:08:53');
INSERT INTO `b5net_loginlog` VALUES ('35', 'ceshi', '218.18.79.43', '广东省深圳市宝安区', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '0', '验证码错误', '2021-01-11 09:08:57');
INSERT INTO `b5net_loginlog` VALUES ('36', 'ceshi', '220.180.34.115', '安徽省合肥市巢湖市', 'Chrome 87.0.4280.88', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-11 09:14:52');
INSERT INTO `b5net_loginlog` VALUES ('37', 'ceshi', '59.173.28.234', '湖北省武汉市', 'Chrome 70.0.3538.25', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 09:15:23');
INSERT INTO `b5net_loginlog` VALUES ('38', 'ceshi', '220.180.34.115', '安徽省合肥市巢湖市', 'Chrome 87.0.4280.88', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-11 09:15:28');
INSERT INTO `b5net_loginlog` VALUES ('39', 'ceshi', '219.137.140.124', '广东省广州市天河区', 'Chrome 87.0.4280.66', 'Windows 10.0', '/白云区电信', '1', '登陆成功', '2021-01-11 09:17:45');
INSERT INTO `b5net_loginlog` VALUES ('40', 'ceshi', '122.224.137.197', '浙江省杭州市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 09:19:09');
INSERT INTO `b5net_loginlog` VALUES ('41', 'ceshi', '218.89.243.127', '四川省成都市', 'Edge 87.0.664.66', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 09:25:31');
INSERT INTO `b5net_loginlog` VALUES ('42', 'ceshi', '1.87.202.105', '陕西省西安市', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '0', '验证码错误', '2021-01-11 09:31:02');
INSERT INTO `b5net_loginlog` VALUES ('43', 'ceshi', '1.87.202.105', '陕西省西安市', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 09:31:17');
INSERT INTO `b5net_loginlog` VALUES ('44', 'ceshi', '183.160.48.103', '安徽省合肥市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 09:35:39');
INSERT INTO `b5net_loginlog` VALUES ('45', 'ceshi', '113.66.110.94', '广东省广州市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 09:42:27');
INSERT INTO `b5net_loginlog` VALUES ('46', 'ceshi', '222.129.122.31', '北京市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '联通', '1', '登陆成功', '2021-01-11 09:43:16');
INSERT INTO `b5net_loginlog` VALUES ('47', 'ceshi', '124.236.159.27', '河北省石家庄市', 'Chrome 87.0.4280.88', 'OS X 10_13_6', '电信', '1', '登陆成功', '2021-01-11 09:45:39');
INSERT INTO `b5net_loginlog` VALUES ('48', 'ceshi', '116.232.54.193', '上海市徐汇区', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 09:46:08');
INSERT INTO `b5net_loginlog` VALUES ('49', 'ceshi', '113.104.214.44', '广东省深圳市', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 09:47:01');
INSERT INTO `b5net_loginlog` VALUES ('50', 'ceshi', '219.137.206.200', '广东省广州市越秀区', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 09:47:19');
INSERT INTO `b5net_loginlog` VALUES ('51', 'ceshi', '113.87.180.35', '广东省深圳市', 'Chrome 73.0.3683.86', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-11 09:48:41');
INSERT INTO `b5net_loginlog` VALUES ('52', 'ceshi', '123.116.3.79', '北京市', 'Edge 87.0.664.75', 'OS X 10_15_7', '联通', '1', '登陆成功', '2021-01-11 09:50:05');
INSERT INTO `b5net_loginlog` VALUES ('53', 'ceshi', '113.57.114.26', '湖北省武汉市', 'Chrome 87.0.4280.88', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-11 09:51:38');
INSERT INTO `b5net_loginlog` VALUES ('54', 'ceshi', '113.128.208.150', '山东省济南市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '电信', '1', '登陆成功', '2021-01-11 09:55:23');
INSERT INTO `b5net_loginlog` VALUES ('55', 'ceshi', '117.39.63.66', '陕西省西安市', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 10:01:18');
INSERT INTO `b5net_loginlog` VALUES ('56', 'ceshi', '218.94.95.62', '江苏省南京市', 'Chrome 87.0.4280.88', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-11 10:01:24');
INSERT INTO `b5net_loginlog` VALUES ('57', 'ceshi', '14.104.140.230', '重庆市', 'Chrome 87.0.4280.88', 'Linux ', '电信', '1', '登陆成功', '2021-01-11 10:03:34');
INSERT INTO `b5net_loginlog` VALUES ('58', 'ceshi', '61.148.123.214', '北京市', 'Chrome 87.0.4280.88', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-11 10:03:42');
INSERT INTO `b5net_loginlog` VALUES ('59', 'ceshi', '27.202.8.235', '山东省东营市', 'Chrome 87.0.4280.88', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-11 10:09:47');
INSERT INTO `b5net_loginlog` VALUES ('60', 'ceshi', '118.113.0.110', '四川省成都市', 'Chrome 87.0.4280.88', 'OS X 10_13_6', '电信', '1', '登陆成功', '2021-01-11 10:12:45');
INSERT INTO `b5net_loginlog` VALUES ('61', 'ceshi', '122.226.65.250', '浙江省金华市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 10:13:44');
INSERT INTO `b5net_loginlog` VALUES ('62', 'ceshi', '117.22.85.130', '陕西省西安市', 'Chrome 87.0.4280.88', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-11 10:22:06');
INSERT INTO `b5net_loginlog` VALUES ('63', 'ceshi', '111.206.116.194', '北京市', 'Chrome 80.0.3987.87', 'Windows 10.0', '联通', '0', '验证码错误', '2021-01-11 10:26:13');
INSERT INTO `b5net_loginlog` VALUES ('64', 'ceshi', '111.206.116.194', '北京市', 'Chrome 80.0.3987.87', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-11 10:26:20');
INSERT INTO `b5net_loginlog` VALUES ('65', 'ceshi', '171.88.21.98', '四川省成都市', 'Chrome 86.0.4240.183', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 10:27:23');
INSERT INTO `b5net_loginlog` VALUES ('66', 'ceshi', '27.38.248.38', '广东省深圳市', 'Chrome 87.0.4280.88', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-11 10:28:48');
INSERT INTO `b5net_loginlog` VALUES ('67', 'ceshi', '116.21.13.83', '广东省广州市', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 10:30:42');
INSERT INTO `b5net_loginlog` VALUES ('68', 'ceshi', '218.4.69.42', '江苏省苏州市', 'Chrome 87.0.4280.88', 'Windows 6.1', '电信', '0', '验证码错误', '2021-01-11 10:36:08');
INSERT INTO `b5net_loginlog` VALUES ('69', 'ceshi', '218.4.69.42', '江苏省苏州市', 'Chrome 87.0.4280.88', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-11 10:36:20');
INSERT INTO `b5net_loginlog` VALUES ('70', 'ceshi', '121.60.67.233', '湖北省武汉市', 'Chrome 85.0.4183.102', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 10:57:50');
INSERT INTO `b5net_loginlog` VALUES ('71', 'ceshi', '116.22.162.106', '广东省广州市', 'Chrome 87.0.4280.141', 'OS X 10_15_4', '电信', '1', '登陆成功', '2021-01-11 11:08:01');
INSERT INTO `b5net_loginlog` VALUES ('72', 'ceshi', '39.77.147.216', '山东省青岛市', 'Chrome 87.0.4280.88', 'OS X 11_1_0', '联通', '1', '登陆成功', '2021-01-11 11:11:33');
INSERT INTO `b5net_loginlog` VALUES ('73', 'ceshi', '180.174.233.20', '上海市', 'Chrome 87.0.4280.88', 'OS X 11_0_1', '电信', '1', '登陆成功', '2021-01-11 11:18:15');
INSERT INTO `b5net_loginlog` VALUES ('74', 'ceshi', '202.86.175.59', '澳门', 'Chrome 87.0.4280.141', 'Windows 6.1', '澳门电讯', '1', '登陆成功', '2021-01-11 11:19:41');
INSERT INTO `b5net_loginlog` VALUES ('75', 'ceshi', '111.160.31.58', '天津市', 'Chrome 87.0.4280.141', 'Windows 10.0', '联通', '0', '验证码错误', '2021-01-11 11:46:06');
INSERT INTO `b5net_loginlog` VALUES ('76', 'ceshi', '111.160.31.58', '天津市', 'Chrome 87.0.4280.141', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-11 11:46:12');
INSERT INTO `b5net_loginlog` VALUES ('77', 'ceshi', '113.247.216.151', '湖南省长沙市', 'Chrome 85.0.4183.83', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 12:02:16');
INSERT INTO `b5net_loginlog` VALUES ('78', 'ceshi', '116.237.228.29', '上海市宝山区', 'Chrome 87.0.4280.88', 'OS X 11_0_1', '电信', '1', '登陆成功', '2021-01-11 13:03:10');
INSERT INTO `b5net_loginlog` VALUES ('79', 'ceshi', '39.170.25.117', '浙江省杭州市', 'Chrome 86.0.4240.111', 'Windows 10.0', '移动', '1', '登陆成功', '2021-01-11 13:25:33');
INSERT INTO `b5net_loginlog` VALUES ('80', 'ceshi', '39.129.23.23', '云南省昆明市', 'Chrome 87.0.4280.141', 'OS X 10_14_5', '移动', '1', '登陆成功', '2021-01-11 13:37:29');
INSERT INTO `b5net_loginlog` VALUES ('81', 'ceshi', '221.222.54.93', '北京市大兴区', 'Chrome 80.0.3987.87', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-11 13:37:49');
INSERT INTO `b5net_loginlog` VALUES ('82', 'ceshi', '113.77.86.243', '广东省东莞市', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 13:42:08');
INSERT INTO `b5net_loginlog` VALUES ('83', 'ceshi', '222.89.181.55', '河南省许昌市', 'Chrome 87.0.4280.88', 'OS X 10_15_7', '电信', '0', '验证码错误', '2021-01-11 13:52:39');
INSERT INTO `b5net_loginlog` VALUES ('84', 'ceshi', '222.89.181.55', '河南省许昌市', 'Chrome 87.0.4280.88', 'OS X 10_15_7', '电信', '1', '登陆成功', '2021-01-11 13:52:44');
INSERT INTO `b5net_loginlog` VALUES ('85', 'ceshi', '171.120.103.78', '山西省晋中市', 'Chrome 87.0.4280.66', 'Windows 10.0', '联通', '0', '验证码错误', '2021-01-11 14:03:12');
INSERT INTO `b5net_loginlog` VALUES ('86', 'ceshi', '171.120.103.78', '山西省晋中市', 'Chrome 87.0.4280.66', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-11 14:03:25');
INSERT INTO `b5net_loginlog` VALUES ('87', 'ceshi', '144.52.167.183', '山东省临沂市', 'Chrome 86.0.4240.111', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 14:03:46');
INSERT INTO `b5net_loginlog` VALUES ('88', 'ceshi', '171.113.2.162', '湖北省武汉市', 'Chrome 84.0.4147.89', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 14:05:45');
INSERT INTO `b5net_loginlog` VALUES ('89', 'ceshi', '125.119.14.105', '浙江省杭州市', 'Chrome 84.0.4147.125', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 14:15:53');
INSERT INTO `b5net_loginlog` VALUES ('90', 'ceshi', '115.60.19.202', '河南省郑州市', 'Chrome 87.0.4280.88', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-11 14:16:48');
INSERT INTO `b5net_loginlog` VALUES ('91', 'ceshi', '125.119.14.105', '浙江省杭州市', 'Chrome 53.0.2785.116', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 14:17:46');
INSERT INTO `b5net_loginlog` VALUES ('92', 'ceshi', '125.119.14.105', '浙江省杭州市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 14:17:47');
INSERT INTO `b5net_loginlog` VALUES ('93', 'ceshi', '125.119.14.105', '浙江省杭州市', 'Chrome 53.0.2785.116', 'Windows 10.0', '电信', '0', '验证码错误', '2021-01-11 14:17:53');
INSERT INTO `b5net_loginlog` VALUES ('94', 'ceshi', '125.119.14.105', '浙江省杭州市', 'Chrome 84.0.4147.125', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 14:18:15');
INSERT INTO `b5net_loginlog` VALUES ('95', 'ceshi', '113.128.208.10', '山东省济南市', 'Chrome 87.0.4280.88', 'OS X 10_15_7', '电信', '0', '验证码错误', '2021-01-11 14:20:30');
INSERT INTO `b5net_loginlog` VALUES ('96', 'ceshi', '113.128.208.10', '山东省济南市', 'Chrome 87.0.4280.88', 'OS X 10_15_7', '电信', '1', '登陆成功', '2021-01-11 14:20:43');
INSERT INTO `b5net_loginlog` VALUES ('97', 'ceshi', '113.69.96.203', '广东省佛山市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 14:29:50');
INSERT INTO `b5net_loginlog` VALUES ('98', 'ceshi', '219.137.140.164', '广东省广州市天河区', 'Chrome 84.0.4147.105', 'Windows 6.1', '/白云区电信', '1', '登陆成功', '2021-01-11 14:45:10');
INSERT INTO `b5net_loginlog` VALUES ('99', 'ceshi', '218.77.40.203', '湖南省长沙市', 'Chrome 69.0.3497.81', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 14:48:30');
INSERT INTO `b5net_loginlog` VALUES ('100', 'ceshi', '222.212.88.131', '四川省成都市', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 15:01:41');
INSERT INTO `b5net_loginlog` VALUES ('101', 'ceshi', '60.166.72.177', '安徽省合肥市', 'Chrome 69.0.3947.100', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-11 15:01:45');
INSERT INTO `b5net_loginlog` VALUES ('102', 'ceshi', '171.113.248.119', '湖北省', 'Edge 87.0.664.75', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 15:10:20');
INSERT INTO `b5net_loginlog` VALUES ('103', 'ceshi', '113.110.224.84', '广东省深圳市', 'Chrome 78.0.3904.108', 'Linux ', '电信', '1', '登陆成功', '2021-01-11 15:17:20');
INSERT INTO `b5net_loginlog` VALUES ('104', 'ceshi', '211.137.200.48', '山东省济南市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '移动', '1', '登陆成功', '2021-01-11 15:26:57');
INSERT INTO `b5net_loginlog` VALUES ('105', 'ceshi', '223.150.188.249', '湖南省常德市', 'Chrome 87.0.4280.88', 'OS X 11_1_0', '电信', '1', '登陆成功', '2021-01-11 15:27:26');
INSERT INTO `b5net_loginlog` VALUES ('106', 'ceshi', '115.193.179.50', '浙江省杭州市', 'Chrome 86.0.4240.111', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 15:31:11');
INSERT INTO `b5net_loginlog` VALUES ('107', 'ceshi', '123.149.78.73', '河南省郑州市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 15:33:33');
INSERT INTO `b5net_loginlog` VALUES ('108', 'ceshi', '113.87.162.232', '广东省深圳市', 'Edge 81.0.416.77', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-11 15:36:41');
INSERT INTO `b5net_loginlog` VALUES ('109', 'ceshi', '115.60.22.172', '河南省郑州市', 'Chrome 87.0.4280.88', 'OS X 10_14_6', '联通', '1', '登陆成功', '2021-01-11 15:38:39');
INSERT INTO `b5net_loginlog` VALUES ('110', 'ceshi', '113.119.80.245', '广东省广州市', 'Chrome 84.0.4147.89', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 15:45:34');
INSERT INTO `b5net_loginlog` VALUES ('111', 'ceshi', '61.140.26.240', '广东省广州市天河区', 'Chrome 80.0.3987.87', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 16:21:14');
INSERT INTO `b5net_loginlog` VALUES ('112', 'ceshi', '116.52.98.61', '云南省昆明市', 'Safari 14.0.2', 'OS X 10_15_6', '电信', '1', '登陆成功', '2021-01-11 16:24:41');
INSERT INTO `b5net_loginlog` VALUES ('113', 'ceshi', '119.98.185.82', '湖北省武汉市洪山区', 'Chrome 55.0.2883.87', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 16:53:31');
INSERT INTO `b5net_loginlog` VALUES ('114', 'ceshi', '117.107.168.98', '北京市', 'Chrome 87.0.4280.67', 'OS X 10_15_7', '教育信息网', '1', '登陆成功', '2021-01-11 16:56:32');
INSERT INTO `b5net_loginlog` VALUES ('115', 'ceshi', '163.177.68.30', '广东省深圳市', 'Chrome 81.0.4044.138', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-11 17:02:07');
INSERT INTO `b5net_loginlog` VALUES ('116', 'ceshi', '171.221.254.124', '四川省成都市', 'Chrome 86.0.4240.183', 'Linux ', '电信', '1', '登陆成功', '2021-01-11 17:04:16');
INSERT INTO `b5net_loginlog` VALUES ('117', 'ceshi', '103.249.245.68', '北京市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 17:12:32');
INSERT INTO `b5net_loginlog` VALUES ('118', 'ceshi', '221.219.5.189', '北京市海淀区', 'Chrome 87.0.4280.88', 'OS X 10_15_1', '联通', '1', '登陆成功', '2021-01-11 17:26:55');
INSERT INTO `b5net_loginlog` VALUES ('119', 'ceshi', '125.70.179.202', '四川省成都市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 17:27:24');
INSERT INTO `b5net_loginlog` VALUES ('120', 'ceshi', '112.95.250.7', '广东省深圳市', 'Chrome 70.0.3538.110', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-11 17:27:52');
INSERT INTO `b5net_loginlog` VALUES ('121', 'ceshi', '120.238.236.67', '广东省', 'Chrome 87.0.4280.88', 'OS X 10_15_7', '移动', '1', '登陆成功', '2021-01-11 17:31:46');
INSERT INTO `b5net_loginlog` VALUES ('122', 'ceshi', '10.1.1.1', '局域网', 'Chrome 86.0.4240.198', 'Windows 10.0', 'IP', '1', '登陆成功', '2021-01-11 17:33:56');
INSERT INTO `b5net_loginlog` VALUES ('123', 'ceshi', '101.231.137.68', '上海市', 'Chrome 87.0.4280.88', 'Linux ', '电信', '1', '登陆成功', '2021-01-11 17:37:38');
INSERT INTO `b5net_loginlog` VALUES ('124', 'ceshi', '139.206.11.57', '四川省', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 17:42:12');
INSERT INTO `b5net_loginlog` VALUES ('125', 'ceshi', '1.181.101.58', '内蒙古包头市', 'Chrome 86.0.4240.198', 'Linux ', '电信', '0', '验证码错误', '2021-01-11 17:45:02');
INSERT INTO `b5net_loginlog` VALUES ('126', 'ceshi', '1.181.101.58', '内蒙古包头市', 'Chrome 86.0.4240.198', 'Linux ', '电信', '1', '登陆成功', '2021-01-11 17:45:07');
INSERT INTO `b5net_loginlog` VALUES ('127', 'ceshi', '14.221.176.89', '广东省东莞市', 'Chrome 75.0.3770.100', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 17:52:01');
INSERT INTO `b5net_loginlog` VALUES ('128', 'ceshi', '125.71.204.95', '四川省成都市', 'Chrome 86.0.4240.75', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-11 17:59:04');
INSERT INTO `b5net_loginlog` VALUES ('129', 'ceshi', '183.228.59.245', '重庆市', 'Chrome 79.0.3945.116', 'AndroidOS 9', '移动', '1', '登陆成功', '2021-01-11 18:03:18');
INSERT INTO `b5net_loginlog` VALUES ('130', 'ceshi', '125.118.66.103', '浙江省杭州市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 18:08:40');
INSERT INTO `b5net_loginlog` VALUES ('131', 'ceshi', '101.231.137.68', '上海市', 'Chrome 87.0.4280.88', 'Linux ', '电信', '1', '登陆成功', '2021-01-11 20:32:28');
INSERT INTO `b5net_loginlog` VALUES ('132', 'ceshi', '39.187.232.151', '浙江省金华市', 'Chrome 78.0.3904.108', 'Windows 10.0', '移动', '0', '验证码错误', '2021-01-11 20:43:00');
INSERT INTO `b5net_loginlog` VALUES ('133', 'ceshi', '39.187.232.151', '浙江省金华市', 'Chrome 78.0.3904.108', 'Windows 10.0', '移动', '1', '登陆成功', '2021-01-11 20:43:09');
INSERT INTO `b5net_loginlog` VALUES ('134', 'ceshi', '122.238.202.175', '浙江省温州市', 'Chrome 87.0.4280.88', 'OS X 10_15_6', '电信', '1', '登陆成功', '2021-01-11 22:34:45');
INSERT INTO `b5net_loginlog` VALUES ('135', 'ceshi', '121.35.101.108', '广东省深圳市宝安区', 'Safari 14.0.2', 'OS X 10_15_6', '电信', '1', '登陆成功', '2021-01-11 23:06:34');
INSERT INTO `b5net_loginlog` VALUES ('136', 'ceshi', '211.97.109.92', '福建省福州市', 'Chrome 88.0.4315.4', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-11 23:35:39');
INSERT INTO `b5net_loginlog` VALUES ('137', 'ceshi', '144.52.190.101', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 23:59:03');
INSERT INTO `b5net_loginlog` VALUES ('138', 'admin', '144.52.190.101', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-11 23:59:20');
INSERT INTO `b5net_loginlog` VALUES ('139', 'ceshi', '144.52.190.101', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-12 00:00:10');
INSERT INTO `b5net_loginlog` VALUES ('140', 'ceshi', '174.139.126.153', '美国', 'Chrome 87.0.4280.141', 'OS X 10_15_7', '加利福尼亚州洛杉矶Krypt数据中心', '1', '登陆成功', '2021-01-12 00:14:25');
INSERT INTO `b5net_loginlog` VALUES ('141', 'ceshi', '125.70.103.185', '四川省成都市', 'Edge 87.0.664.75', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-12 00:43:45');
INSERT INTO `b5net_loginlog` VALUES ('142', 'ceshi', '14.221.97.129', '广东省东莞市', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-12 00:48:38');
INSERT INTO `b5net_loginlog` VALUES ('143', 'ceshi', '110.184.179.135', '四川省成都市', 'Safari 14.0.2', 'OS X 10_15_6', '电信', '1', '登陆成功', '2021-01-12 03:29:59');
INSERT INTO `b5net_loginlog` VALUES ('144', 'ceshi', '125.71.204.95', '四川省成都市', 'Chrome 86.0.4240.75', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-12 09:47:58');
INSERT INTO `b5net_loginlog` VALUES ('145', 'ceshi', '125.117.230.83', '浙江省金华市', 'Chrome 87.0.4280.66', 'Windows 10.0', '电信', '0', '验证码错误', '2021-01-12 09:48:42');
INSERT INTO `b5net_loginlog` VALUES ('146', 'ceshi', '125.117.230.83', '浙江省金华市', 'Chrome 87.0.4280.66', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-12 09:48:54');
INSERT INTO `b5net_loginlog` VALUES ('147', 'ceshi', '113.104.180.21', '广东省深圳市', 'Chrome 87.0.4280.66', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-12 09:56:05');
INSERT INTO `b5net_loginlog` VALUES ('148', 'ceshi', '110.191.166.105', '四川省成都市', 'Chrome 84.0.4147.105', 'Windows 10.0', '四川师范大学', '1', '登陆成功', '2021-01-12 10:17:37');
INSERT INTO `b5net_loginlog` VALUES ('149', 'ceshi', '59.57.155.184', '福建省厦门市集美区', 'Chrome 85.0.4183.83', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-12 10:29:24');
INSERT INTO `b5net_loginlog` VALUES ('150', 'ceshi', '122.238.126.191', '浙江省嘉兴市', 'Edge 80.0.361.111', 'OS X 10_15_3', '电信', '1', '登陆成功', '2021-01-12 10:31:08');
INSERT INTO `b5net_loginlog` VALUES ('151', 'ceshi', '124.126.200.99', '北京市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '中国电信北京研究院', '1', '登陆成功', '2021-01-12 10:33:42');
INSERT INTO `b5net_loginlog` VALUES ('152', 'ceshi', '111.201.51.55', '北京市', 'Chrome 87.0.4280.88', 'OS X 11_1_0', '联通紫竹桥互联网数据中心', '1', '登陆成功', '2021-01-12 11:30:34');
INSERT INTO `b5net_loginlog` VALUES ('153', 'ceshi', '58.247.83.86', '上海市', 'Chrome 87.0.4280.141', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-12 11:56:23');
INSERT INTO `b5net_loginlog` VALUES ('154', 'ceshi', '117.26.40.54', '福建省泉州市晋江市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-12 13:28:01');
INSERT INTO `b5net_loginlog` VALUES ('155', 'ceshi', '117.26.40.54', '福建省泉州市晋江市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-12 13:28:32');
INSERT INTO `b5net_loginlog` VALUES ('156', 'ceshi', '113.246.211.23', '湖南省长沙市', 'Chrome 87.0.4280.88', 'OS X 11_1_0', '电信', '0', '验证码错误', '2021-01-12 13:29:43');
INSERT INTO `b5net_loginlog` VALUES ('157', 'ceshi', '113.246.211.23', '湖南省长沙市', 'Chrome 87.0.4280.88', 'OS X 11_1_0', '电信', '1', '登陆成功', '2021-01-12 13:29:50');
INSERT INTO `b5net_loginlog` VALUES ('158', 'ceshi', '101.71.12.135', '浙江省杭州市', 'Edge 80.0.361.111', 'OS X 10_15_3', '联通', '1', '登陆成功', '2021-01-12 13:39:31');
INSERT INTO `b5net_loginlog` VALUES ('159', 'ceshi', '58.35.196.114', '上海市', 'Chrome 87.0.4280.88', 'OS X 10_13_6', '电信', '1', '登陆成功', '2021-01-12 14:43:11');
INSERT INTO `b5net_loginlog` VALUES ('160', 'ceshi', '14.221.176.143', '广东省东莞市', 'Chrome 75.0.3770.100', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-12 14:46:54');
INSERT INTO `b5net_loginlog` VALUES ('161', 'ceshi', '125.117.230.83', '浙江省金华市', 'Chrome 87.0.4280.66', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-12 15:27:56');
INSERT INTO `b5net_loginlog` VALUES ('162', 'ceshi', '118.114.167.101', '四川省成都市', 'Chrome 87.0.4280.88', 'OS X 10_15_7', '电信', '0', '验证码错误', '2021-01-12 17:14:42');
INSERT INTO `b5net_loginlog` VALUES ('163', 'ceshi', '118.114.167.101', '四川省成都市', 'Chrome 87.0.4280.88', 'OS X 10_15_7', '电信', '0', '验证码错误', '2021-01-12 17:14:49');
INSERT INTO `b5net_loginlog` VALUES ('164', 'ceshi', '118.114.167.101', '四川省成都市', 'Chrome 87.0.4280.88', 'OS X 10_15_7', '电信', '1', '登陆成功', '2021-01-12 17:15:03');
INSERT INTO `b5net_loginlog` VALUES ('165', 'ceshi', '117.158.195.123', '河南省', 'Chrome 87.0.4280.141', 'Windows 10.0', '移动', '1', '登陆成功', '2021-01-12 17:15:27');
INSERT INTO `b5net_loginlog` VALUES ('166', 'ceshi', '103.102.195.69', '北京市', 'Safari 14.0.2', 'OS X 10_15_6', '联通', '1', '登陆成功', '2021-01-12 17:52:24');
INSERT INTO `b5net_loginlog` VALUES ('167', 'ceshi', '113.218.233.57', '湖南省长沙市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-12 18:59:17');
INSERT INTO `b5net_loginlog` VALUES ('168', 'ceshi', '101.88.122.193', '上海市', 'Edge 87.0.664.75', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-12 23:51:53');
INSERT INTO `b5net_loginlog` VALUES ('169', 'ceshi', '222.247.152.161', '湖南省长沙市', 'Chrome 78.0.3904.108', 'Windows 10.0', '电信', '0', '验证码错误', '2021-01-13 04:06:34');
INSERT INTO `b5net_loginlog` VALUES ('170', 'ceshi', '222.247.152.161', '湖南省长沙市', 'Chrome 78.0.3904.108', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-13 04:06:54');
INSERT INTO `b5net_loginlog` VALUES ('171', 'ceshi', '222.247.152.161', '湖南省长沙市', 'Chrome 78.0.3904.108', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-13 04:11:15');
INSERT INTO `b5net_loginlog` VALUES ('172', 'ceshi', '125.117.230.83', '浙江省金华市', 'Chrome 87.0.4280.66', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-13 09:32:06');
INSERT INTO `b5net_loginlog` VALUES ('173', 'ceshi', '112.65.136.194', '上海市徐汇区', 'Chrome 84.0.4147.135', 'Windows 10.0', '联通漕河泾数据中心', '1', '登陆成功', '2021-01-13 10:03:42');
INSERT INTO `b5net_loginlog` VALUES ('174', 'ceshi', '118.112.74.30', '四川省成都市龙泉驿区', 'Edge 87.0.664.75', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-13 10:59:36');
INSERT INTO `b5net_loginlog` VALUES ('175', 'ceshi', '114.242.26.92', '北京市', 'Chrome 87.0.4280.141', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-13 11:00:17');
INSERT INTO `b5net_loginlog` VALUES ('176', 'ceshi', '14.113.251.86', '广东省茂名市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-13 11:40:46');
INSERT INTO `b5net_loginlog` VALUES ('177', 'ceshi', '39.149.209.144', '河南省驻马店市', 'Chrome 87.0.4280.88', 'Windows 10.0', '移动', '1', '登陆成功', '2021-01-13 13:41:47');
INSERT INTO `b5net_loginlog` VALUES ('178', 'ceshi', '121.225.46.185', '江苏省南京市', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-13 15:50:43');
INSERT INTO `b5net_loginlog` VALUES ('179', 'ceshi', '222.247.152.161', '湖南省长沙市', 'Chrome 78.0.3904.108', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-13 15:51:30');
INSERT INTO `b5net_loginlog` VALUES ('180', 'ceshi', '120.231.19.165', '广东省湛江市', 'Chrome 87.0.4280.141', 'Windows 10.0', '移动', '1', '登陆成功', '2021-01-13 16:09:37');
INSERT INTO `b5net_loginlog` VALUES ('181', 'ceshi', '49.65.246.180', '江苏省南京市', 'Chrome 87.0.4280.88', 'OS X 11_0_1', '电信', '1', '登陆成功', '2021-01-13 18:27:53');
INSERT INTO `b5net_loginlog` VALUES ('182', 'ceshi', '221.237.138.13', '四川省成都市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '电信', '1', '登陆成功', '2021-01-13 19:42:25');
INSERT INTO `b5net_loginlog` VALUES ('183', 'ceshi', '101.231.137.68', '上海市', 'Chrome 87.0.4280.88', 'Linux ', '电信', '1', '登陆成功', '2021-01-13 20:30:47');
INSERT INTO `b5net_loginlog` VALUES ('184', 'ceshi', '120.83.50.237', '广东省清远市', 'Chrome 87.0.4280.88', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-13 21:25:04');
INSERT INTO `b5net_loginlog` VALUES ('185', 'ceshi', '171.90.198.163', '四川省自贡市', 'Chrome 87.0.4280.66', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-13 23:37:44');
INSERT INTO `b5net_loginlog` VALUES ('186', 'ceshi', '101.231.137.68', '上海市', 'Chrome 87.0.4280.88', 'Linux ', '电信', '1', '登陆成功', '2021-01-14 08:55:58');
INSERT INTO `b5net_loginlog` VALUES ('187', 'ceshi', '1.205.134.137', '贵州省遵义市', 'Edge 87.0.664.75', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-14 10:11:33');
INSERT INTO `b5net_loginlog` VALUES ('188', 'ceshi', '121.235.205.253', '江苏省无锡市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-14 10:48:00');
INSERT INTO `b5net_loginlog` VALUES ('189', 'ceshi', '121.235.205.253', '江苏省无锡市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-14 10:48:15');
INSERT INTO `b5net_loginlog` VALUES ('190', 'ceshi', '114.246.34.159', '北京市', 'Chrome 87.0.4280.88', 'OS X 11_1_0', '联通', '1', '登陆成功', '2021-01-14 16:44:01');
INSERT INTO `b5net_loginlog` VALUES ('191', 'ceshi', '49.66.129.79', '江苏省无锡市', 'Chrome 87.0.4280.141', 'OS X 10_12_6', '电信', '0', '验证码错误', '2021-01-14 17:24:17');
INSERT INTO `b5net_loginlog` VALUES ('192', 'ceshi', '49.66.129.79', '江苏省无锡市', 'Chrome 87.0.4280.141', 'OS X 10_12_6', '电信', '1', '登陆成功', '2021-01-14 17:24:30');
INSERT INTO `b5net_loginlog` VALUES ('193', 'ceshi', '183.159.124.206', '浙江省杭州市', 'Chrome 87.0.4280.141', 'OS X 10_15_4', '电信', '1', '登陆成功', '2021-01-14 20:50:47');
INSERT INTO `b5net_loginlog` VALUES ('194', 'ceshi', '59.52.204.56', '江西省南昌市', 'Chrome 87.0.4280.141', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-15 08:50:40');
INSERT INTO `b5net_loginlog` VALUES ('195', 'ceshi', '60.173.236.97', '安徽省合肥市巢湖市', 'Chrome 86.0.4240.198', 'OS X 10_12_6', '电信', '1', '登陆成功', '2021-01-15 13:52:09');
INSERT INTO `b5net_loginlog` VALUES ('196', 'ceshi', '43.243.136.120', '北京市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '联通', '1', '登陆成功', '2021-01-15 16:25:28');
INSERT INTO `b5net_loginlog` VALUES ('197', 'ceshi', '43.243.136.120', '北京市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '联通', '1', '登陆成功', '2021-01-15 16:26:20');
INSERT INTO `b5net_loginlog` VALUES ('198', 'ceshi', '27.18.46.65', '湖北省武汉市', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-15 16:35:17');
INSERT INTO `b5net_loginlog` VALUES ('199', 'ceshi', '61.140.70.48', '广东省广州市', 'Chrome 86.0.4240.183', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-15 17:00:26');
INSERT INTO `b5net_loginlog` VALUES ('200', 'ceshi', '111.36.171.150', '山东省', 'Edge 87.0.664.75', 'Windows 10.0', '移动', '0', '验证码错误', '2021-01-16 12:51:28');
INSERT INTO `b5net_loginlog` VALUES ('201', 'ceshi', '111.36.171.150', '山东省', 'Edge 87.0.664.75', 'Windows 10.0', '移动', '0', '验证码错误', '2021-01-16 12:51:42');
INSERT INTO `b5net_loginlog` VALUES ('202', 'ceshi', '111.36.171.150', '山东省', 'Edge 87.0.664.75', 'Windows 10.0', '移动', '1', '登陆成功', '2021-01-16 12:51:53');
INSERT INTO `b5net_loginlog` VALUES ('203', 'ceshi', '120.234.24.49', '广东省深圳市', 'Chrome 87.0.4280.88', 'Windows 10.0', '移动', '1', '登陆成功', '2021-01-16 17:24:54');
INSERT INTO `b5net_loginlog` VALUES ('204', 'ceshi', '27.207.241.68', '山东省德州市', 'Chrome 78.0.3904.108', 'Windows 10.0', '联通', '0', '验证码错误', '2021-01-17 12:42:54');
INSERT INTO `b5net_loginlog` VALUES ('205', 'ceshi', '27.207.241.68', '山东省德州市', 'Chrome 78.0.3904.108', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-17 12:43:03');
INSERT INTO `b5net_loginlog` VALUES ('206', 'ceshi', '113.104.182.95', '广东省深圳市', 'Chrome 87.0.4280.88', 'OS X 11_0_1', '电信', '0', '验证码错误', '2021-01-18 10:28:55');
INSERT INTO `b5net_loginlog` VALUES ('207', 'ceshi', '113.104.182.95', '广东省深圳市', 'Chrome 87.0.4280.88', 'OS X 11_0_1', '电信', '1', '登陆成功', '2021-01-18 10:29:02');
INSERT INTO `b5net_loginlog` VALUES ('208', 'ceshi', '115.238.81.206', '浙江省杭州市', 'Chrome 87.0.4280.141', 'OS X 10_15_7', '电信', '1', '登陆成功', '2021-01-18 11:20:43');
INSERT INTO `b5net_loginlog` VALUES ('209', 'ceshi', '182.139.222.91', '四川省成都市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '0', '验证码错误', '2021-01-18 11:31:02');
INSERT INTO `b5net_loginlog` VALUES ('210', 'ceshi', '182.139.222.91', '四川省成都市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-18 11:31:11');
INSERT INTO `b5net_loginlog` VALUES ('211', 'ceshi', '27.189.205.108', '河北省廊坊市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-18 11:33:10');
INSERT INTO `b5net_loginlog` VALUES ('212', 'ceshi', '121.60.67.95', '湖北省武汉市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '电信', '1', '登陆成功', '2021-01-18 11:34:11');
INSERT INTO `b5net_loginlog` VALUES ('213', 'ceshi', '27.189.205.108', '河北省廊坊市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-18 11:35:25');
INSERT INTO `b5net_loginlog` VALUES ('214', 'ceshi', '124.65.27.222', '北京市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '联通', '1', '登陆成功', '2021-01-18 11:37:06');
INSERT INTO `b5net_loginlog` VALUES ('215', 'ceshi', '119.8.58.182', '香港', 'Chrome 87.0.4280.141', 'Windows 10.0', '华为云', '1', '登陆成功', '2021-01-18 11:37:32');
INSERT INTO `b5net_loginlog` VALUES ('216', 'ceshi', '222.171.225.189', '黑龙江省哈尔滨市', 'Firefox 84.0', 'OS X 10.14', '电信', '1', '登陆成功', '2021-01-18 11:39:15');
INSERT INTO `b5net_loginlog` VALUES ('217', 'ceshi', '182.97.77.241', '江西省南昌市', 'Chrome 70.0.3538.80', 'AndroidOS 10', '电信', '1', '登陆成功', '2021-01-18 11:48:57');
INSERT INTO `b5net_loginlog` VALUES ('218', 'ceshi', '223.104.214.158', '四川省', 'Chrome 87.0.4280.141', 'Windows 10.0', '移动数据网络无线AP基站', '1', '登陆成功', '2021-01-18 11:54:27');
INSERT INTO `b5net_loginlog` VALUES ('219', 'ceshi', '182.90.255.33', '广西梧州市', 'Chrome 87.0.4280.88', 'Windows 10.0', '联通', '0', '验证码错误', '2021-01-18 11:56:39');
INSERT INTO `b5net_loginlog` VALUES ('220', 'ceshi', '182.90.255.33', '广西梧州市', 'Chrome 87.0.4280.88', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-18 11:56:50');
INSERT INTO `b5net_loginlog` VALUES ('221', 'ceshi', '182.48.105.105', '北京市海淀区', 'Chrome 87.0.4280.141', 'OS X 11_0_1', '北京舒华士科技有限公司', '1', '登陆成功', '2021-01-18 12:36:10');
INSERT INTO `b5net_loginlog` VALUES ('222', 'ceshi', '114.102.129.129', '安徽省宿州市泗县', 'Chrome 87.0.4280.141', 'OS X 10_15_7', '电信', '1', '登陆成功', '2021-01-18 12:50:35');
INSERT INTO `b5net_loginlog` VALUES ('223', 'ceshi', '116.6.115.61', '广东省深圳市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-18 13:32:25');
INSERT INTO `b5net_loginlog` VALUES ('224', 'ceshi', '110.184.65.15', '四川省成都市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-18 13:39:28');
INSERT INTO `b5net_loginlog` VALUES ('225', 'ceshi', '47.90.103.44', '香港', 'Chrome 87.0.4280.141', 'Windows 10.0', '阿里云', '1', '登陆成功', '2021-01-18 13:39:35');
INSERT INTO `b5net_loginlog` VALUES ('226', 'ceshi', '116.22.35.93', '广东省广州市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-18 13:42:54');
INSERT INTO `b5net_loginlog` VALUES ('227', 'ceshi', '171.113.241.234', '湖北省', 'Chrome 87.0.4280.88', 'OS X 11_1_0', '电信', '1', '登陆成功', '2021-01-18 13:47:28');
INSERT INTO `b5net_loginlog` VALUES ('228', 'ceshi', '171.113.241.234', '湖北省', 'Chrome 87.0.4280.88', 'OS X 11_1_0', '电信', '1', '登陆成功', '2021-01-18 13:50:57');
INSERT INTO `b5net_loginlog` VALUES ('229', 'ceshi', '1.193.56.53', '河南省郑州市', 'Chrome 87.0.4280.141', 'OS X 10_14_6', '电信', '1', '登陆成功', '2021-01-18 14:00:24');
INSERT INTO `b5net_loginlog` VALUES ('230', 'ceshi', '124.128.122.79', '山东省济南市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '联通', '1', '登陆成功', '2021-01-18 14:18:13');
INSERT INTO `b5net_loginlog` VALUES ('231', 'ceshi', '114.226.53.101', '江苏省常州市', 'Chrome 86.0.4240.183', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-18 14:30:14');
INSERT INTO `b5net_loginlog` VALUES ('232', 'ceshi', '61.152.193.59', '上海市', 'Chrome 87.0.4280.141', 'OS X 10_14_6', '电信', '1', '登陆成功', '2021-01-18 14:31:00');
INSERT INTO `b5net_loginlog` VALUES ('233', 'ceshi', '183.11.70.135', '广东省深圳市', 'Chrome 87.0.4280.141', 'OS X 11_0_1', '电信', '1', '登陆成功', '2021-01-18 15:04:17');
INSERT INTO `b5net_loginlog` VALUES ('234', 'ceshi', '183.11.70.135', '广东省深圳市', 'Chrome 87.0.4280.141', 'OS X 11_0_1', '电信', '1', '登陆成功', '2021-01-18 15:04:34');
INSERT INTO `b5net_loginlog` VALUES ('235', 'ceshi', '175.11.28.89', '湖南省长沙市', 'Chrome 89.0.4386.2', 'OS X 10_15_7', '电信', '1', '登陆成功', '2021-01-18 15:34:19');
INSERT INTO `b5net_loginlog` VALUES ('236', 'ceshi', '218.76.9.218', '湖南省长沙市', 'Chrome 87.0.4280.141', 'OS X 10_13_6', '电信', '1', '登陆成功', '2021-01-18 15:43:08');
INSERT INTO `b5net_loginlog` VALUES ('237', 'ceshi', '223.104.9.254', '四川省', 'Chrome 77.0.3865.120', 'AndroidOS 10', '移动数据上网公共出口', '0', '验证码错误', '2021-01-18 15:48:29');
INSERT INTO `b5net_loginlog` VALUES ('238', 'ceshi', '223.104.9.254', '四川省', 'Chrome 77.0.3865.120', 'AndroidOS 10', '移动数据上网公共出口', '0', '验证码错误', '2021-01-18 15:48:37');
INSERT INTO `b5net_loginlog` VALUES ('239', 'ceshi', '223.104.9.254', '四川省', 'Chrome 77.0.3865.120', 'AndroidOS 10', '移动数据上网公共出口', '1', '登陆成功', '2021-01-18 15:48:52');
INSERT INTO `b5net_loginlog` VALUES ('240', 'ceshi', '221.222.129.10', '北京市海淀区', 'Chrome 87.0.4280.141', 'Windows 10.0', '联通', '0', '验证码错误', '2021-01-18 15:56:45');
INSERT INTO `b5net_loginlog` VALUES ('241', 'ceshi', '221.222.129.10', '北京市海淀区', 'Chrome 87.0.4280.141', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-18 15:56:53');
INSERT INTO `b5net_loginlog` VALUES ('242', 'ceshi', '180.169.184.14', '上海市', 'Chrome 87.0.4280.141', 'OS X 10_13_6', '电信', '1', '登陆成功', '2021-01-18 16:19:33');
INSERT INTO `b5net_loginlog` VALUES ('243', 'ceshi', '113.246.243.102', '湖南省长沙市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-18 16:34:07');
INSERT INTO `b5net_loginlog` VALUES ('244', 'ceshi', '113.108.156.242', '广东省广州市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '电信', '1', '登陆成功', '2021-01-18 17:03:18');
INSERT INTO `b5net_loginlog` VALUES ('245', 'ceshi', '101.71.37.3', '浙江省杭州市', 'Chrome 87.0.4280.88', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-18 17:03:21');
INSERT INTO `b5net_loginlog` VALUES ('246', 'ceshi', '36.110.66.197', '北京市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '电信', '1', '登陆成功', '2021-01-18 17:39:49');
INSERT INTO `b5net_loginlog` VALUES ('247', 'ceshi', '125.120.123.241', '浙江省杭州市', 'Chrome 87.0.4280.141', 'OS X 10_14_6', '电信', '1', '登陆成功', '2021-01-18 17:59:48');
INSERT INTO `b5net_loginlog` VALUES ('248', 'ceshi', '114.102.176.240', '安徽省宿州市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-18 19:05:24');
INSERT INTO `b5net_loginlog` VALUES ('249', 'ceshi', '27.18.43.157', '湖北省武汉市', 'Chrome 72.0.3626.81', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-18 20:56:18');
INSERT INTO `b5net_loginlog` VALUES ('250', 'ceshi', '171.8.152.255', '河南省郑州市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '电信', '1', '登陆成功', '2021-01-18 21:16:01');
INSERT INTO `b5net_loginlog` VALUES ('251', 'ceshi', '163.125.176.127', '广东省深圳市', 'Chrome 83.0.4103.106', 'AndroidOS 10', '联通', '1', '登陆成功', '2021-01-19 00:15:42');
INSERT INTO `b5net_loginlog` VALUES ('252', 'ceshi', '149.167.60.169', '澳大利亚', 'Chrome 87.0.4280.141', 'Windows 10.0', '', '1', '登陆成功', '2021-01-19 06:05:09');
INSERT INTO `b5net_loginlog` VALUES ('253', 'ceshi', '182.150.112.194', '四川省成都市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '电信', '1', '登陆成功', '2021-01-19 09:18:22');
INSERT INTO `b5net_loginlog` VALUES ('254', 'ceshi', '14.105.176.198', '重庆市', 'Chrome 86.0.4240.111', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-19 09:51:38');
INSERT INTO `b5net_loginlog` VALUES ('255', 'ceshi', '119.137.55.148', '广东省深圳市宝安区', 'Chrome 87.0.4280.141', 'OS X 11_0_1', '电信', '1', '登陆成功', '2021-01-19 10:00:46');
INSERT INTO `b5net_loginlog` VALUES ('256', 'ceshi', '120.85.149.13', '广东省广州市', 'Chrome 87.0.4280.88', 'Windows 6.1', '联通', '1', '登陆成功', '2021-01-19 10:06:31');
INSERT INTO `b5net_loginlog` VALUES ('257', 'ceshi', '114.251.129.122', '北京市', 'Edge 87.0.664.75', 'OS X 11_1_0', '联通', '1', '登陆成功', '2021-01-19 10:09:06');
INSERT INTO `b5net_loginlog` VALUES ('258', 'ceshi', '47.242.50.117', '香港', 'Chrome 87.0.4280.88', 'OS X 11_1_0', '阿里云', '0', '验证码错误', '2021-01-19 10:11:23');
INSERT INTO `b5net_loginlog` VALUES ('259', 'ceshi', '47.242.50.117', '香港', 'Chrome 87.0.4280.88', 'OS X 11_1_0', '阿里云', '1', '登陆成功', '2021-01-19 10:11:38');
INSERT INTO `b5net_loginlog` VALUES ('260', 'ceshi', '117.63.234.7', '江苏省常州市', 'Chrome 87.0.4280.141', 'OS X 10_14_5', '电信', '1', '登陆成功', '2021-01-19 10:16:45');
INSERT INTO `b5net_loginlog` VALUES ('261', 'ceshi', '118.112.203.88', '四川省成都市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-19 10:18:17');
INSERT INTO `b5net_loginlog` VALUES ('262', 'ceshi', '125.71.204.95', '四川省成都市', 'Chrome 86.0.4240.75', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-19 10:18:30');
INSERT INTO `b5net_loginlog` VALUES ('263', 'ceshi', '112.5.202.114', '福建省', 'Chrome 78.0.3904.108', 'Windows 10.0', '移动', '1', '登陆成功', '2021-01-19 10:23:49');
INSERT INTO `b5net_loginlog` VALUES ('264', 'ceshi', '124.65.8.116', '北京市', 'Chrome 87.0.4280.66', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-19 10:28:11');
INSERT INTO `b5net_loginlog` VALUES ('265', 'ceshi', '113.89.102.124', '广东省深圳市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-19 10:31:19');
INSERT INTO `b5net_loginlog` VALUES ('266', 'ceshi', '125.94.169.221', '广东省汕头市', 'Chrome 70.0.3538.25', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-19 10:32:17');
INSERT INTO `b5net_loginlog` VALUES ('267', 'ceshi', '113.102.167.40', '广东省深圳市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-19 10:37:12');
INSERT INTO `b5net_loginlog` VALUES ('268', 'ceshi', '14.104.205.190', '重庆市', 'Chrome 86.0.4240.111', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-19 10:41:08');
INSERT INTO `b5net_loginlog` VALUES ('269', 'ceshi', '115.54.89.150', '河南省安阳市', 'Chrome 86.0.4240.193', 'Windows 6.1', '联通', '1', '登陆成功', '2021-01-19 10:44:52');
INSERT INTO `b5net_loginlog` VALUES ('270', 'ceshi', '125.47.74.86', '河南省郑州市', 'Chrome 87.0.4280.141', 'OS X 10_15_2', '联通', '0', '验证码错误', '2021-01-19 10:51:29');
INSERT INTO `b5net_loginlog` VALUES ('271', 'ceshi', '125.47.74.86', '河南省郑州市', 'Chrome 87.0.4280.141', 'OS X 10_15_2', '联通', '1', '登陆成功', '2021-01-19 10:51:40');
INSERT INTO `b5net_loginlog` VALUES ('272', 'ceshi', '124.114.156.210', '陕西省西安市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-19 11:30:18');
INSERT INTO `b5net_loginlog` VALUES ('273', 'ceshi', '118.113.212.52', '四川省成都市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-19 11:46:12');
INSERT INTO `b5net_loginlog` VALUES ('274', 'ceshi', '112.5.202.114', '福建省', 'Chrome 78.0.3904.108', 'Windows 10.0', '移动', '1', '登陆成功', '2021-01-19 12:32:25');
INSERT INTO `b5net_loginlog` VALUES ('275', 'ceshi', '111.235.135.57', '马来西亚', 'Chrome 87.0.4280.141', 'OS X 10_15_4', '', '1', '登陆成功', '2021-01-19 13:51:48');
INSERT INTO `b5net_loginlog` VALUES ('276', 'ceshi', '106.6.162.63', '江西省南昌市', 'Chrome 86.0.4240.111', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-19 14:06:34');
INSERT INTO `b5net_loginlog` VALUES ('277', 'ceshi', '120.85.149.13', '广东省广州市', 'Chrome 87.0.4280.88', 'Windows 6.1', '联通', '1', '登陆成功', '2021-01-19 14:10:00');
INSERT INTO `b5net_loginlog` VALUES ('278', 'ceshi', '121.60.64.53', '湖北省武汉市', 'Chrome 87.0.4280.107', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-19 14:18:09');
INSERT INTO `b5net_loginlog` VALUES ('279', 'ceshi', '110.184.68.184', '四川省成都市', 'Chrome 86.0.4240.111', 'Windows 10.0', '电信', '0', '验证码错误', '2021-01-19 14:56:49');
INSERT INTO `b5net_loginlog` VALUES ('280', 'ceshi', '110.184.68.184', '四川省成都市', 'Chrome 86.0.4240.111', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-19 14:56:56');
INSERT INTO `b5net_loginlog` VALUES ('281', 'ceshi', '167.179.5.52', '柬埔寨', 'Chrome 87.0.4280.88', 'Windows 10.0', '', '1', '登陆成功', '2021-01-19 15:08:15');
INSERT INTO `b5net_loginlog` VALUES ('282', 'ceshi', '113.102.164.195', '广东省深圳市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-19 15:39:52');
INSERT INTO `b5net_loginlog` VALUES ('283', 'ceshi', '101.22.63.34', '河北省唐山市', 'Chrome 87.0.4280.88', 'Windows 10.0', '联通', '0', '验证码错误', '2021-01-19 15:52:53');
INSERT INTO `b5net_loginlog` VALUES ('284', 'ceshi', '101.22.63.34', '河北省唐山市', 'Chrome 87.0.4280.88', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-19 15:52:59');
INSERT INTO `b5net_loginlog` VALUES ('285', 'ceshi', '120.71.209.151', '新疆吐鲁番市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-19 15:59:14');
INSERT INTO `b5net_loginlog` VALUES ('286', 'ceshi', '223.149.10.57', '湖南省怀化市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-19 16:01:57');
INSERT INTO `b5net_loginlog` VALUES ('287', 'ceshi', '120.40.99.70', '福建省福州市', 'Chrome 87.0.4280.141', 'OS X 10_14_6', '电信', '0', '验证码错误', '2021-01-19 16:49:55');
INSERT INTO `b5net_loginlog` VALUES ('288', 'ceshi', '120.40.99.70', '福建省福州市', 'Chrome 87.0.4280.141', 'OS X 10_14_6', '电信', '1', '登陆成功', '2021-01-19 16:50:03');
INSERT INTO `b5net_loginlog` VALUES ('289', 'ceshi', '101.88.122.193', '上海市', 'Edge 87.0.664.75', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-19 22:23:43');
INSERT INTO `b5net_loginlog` VALUES ('290', 'ceshi', '122.243.247.114', '浙江省金华市', 'Chrome 87.0.4280.66', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-20 11:03:38');
INSERT INTO `b5net_loginlog` VALUES ('291', 'ceshi', '112.95.74.135', '广东省深圳市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '联通', '1', '登陆成功', '2021-01-20 11:21:42');
INSERT INTO `b5net_loginlog` VALUES ('292', 'ceshi', '116.21.59.18', '广东省广州市天河区', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-20 11:25:20');
INSERT INTO `b5net_loginlog` VALUES ('293', 'ceshi', '202.104.129.54', '广东省深圳市', 'Chrome 84.0.4147.125', 'Windows 10.0', '搜搜蜘蛛', '1', '登陆成功', '2021-01-20 15:20:06');
INSERT INTO `b5net_loginlog` VALUES ('294', 'ceshi', '140.206.133.44', '上海市', 'Chrome 88.0.4324.96', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-20 16:21:11');
INSERT INTO `b5net_loginlog` VALUES ('295', 'ceshi', '61.183.196.110', '湖北省武汉市', 'Chrome 79.0.3945.117', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-21 09:25:56');
INSERT INTO `b5net_loginlog` VALUES ('296', 'ceshi', '61.183.196.110', '湖北省武汉市', 'Chrome 79.0.3945.117', 'Windows 6.1', '电信', '1', '登陆成功', '2021-01-21 09:27:34');
INSERT INTO `b5net_loginlog` VALUES ('297', 'ceshi', '59.127.116.11', '台湾省', 'Chrome 87.0.4280.141', 'Windows 10.0', '中华电信(HiNet)数据中心', '1', '登陆成功', '2021-01-21 10:53:13');
INSERT INTO `b5net_loginlog` VALUES ('298', 'ceshi', '218.77.40.203', '湖南省长沙市', 'Chrome 69.0.3497.81', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-21 11:06:42');
INSERT INTO `b5net_loginlog` VALUES ('299', 'ceshi', '61.243.41.227', '贵州省铜仁市', 'Chrome 69.0.3497.100', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-21 12:17:38');
INSERT INTO `b5net_loginlog` VALUES ('300', 'ceshi', '112.91.236.3', '广东省阳江市', 'Chrome 87.0.4280.141', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-21 13:35:39');
INSERT INTO `b5net_loginlog` VALUES ('301', 'ceshi', '36.25.104.57', '浙江省', 'Chrome 87.0.4280.66', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-21 13:36:32');
INSERT INTO `b5net_loginlog` VALUES ('302', 'ceshi', '183.12.220.74', '广东省深圳市', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-21 13:48:52');
INSERT INTO `b5net_loginlog` VALUES ('303', 'ceshi', '35.241.125.132', '香港', 'Chrome 87.0.4280.88', 'OS X 11_1_0', 'Google云计算数据中心', '1', '登陆成功', '2021-01-21 15:08:28');
INSERT INTO `b5net_loginlog` VALUES ('304', 'ceshi', '27.42.99.207', '广东省珠海市', 'Chrome 87.0.4280.141', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-21 15:27:07');
INSERT INTO `b5net_loginlog` VALUES ('305', 'ceshi', '27.42.99.207', '广东省珠海市', 'Chrome 87.0.4280.141', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-21 15:37:35');
INSERT INTO `b5net_loginlog` VALUES ('306', 'ceshi', '27.42.99.228', '广东省珠海市', 'Chrome 87.0.4280.141', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-21 15:48:51');
INSERT INTO `b5net_loginlog` VALUES ('307', 'ceshi', '113.92.159.100', '广东省深圳市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-21 17:41:08');
INSERT INTO `b5net_loginlog` VALUES ('308', 'ceshi', '27.42.99.207', '广东省珠海市', 'Chrome 87.0.4280.141', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-21 19:05:21');
INSERT INTO `b5net_loginlog` VALUES ('309', 'ceshi', '27.42.99.207', '广东省珠海市', 'Chrome 87.0.4280.141', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-21 19:10:49');
INSERT INTO `b5net_loginlog` VALUES ('310', 'ceshi', '101.88.111.176', '上海市', 'Chrome 87.0.4280.141', 'OS X 10_15_7', '电信', '0', '验证码错误', '2021-01-22 01:10:41');
INSERT INTO `b5net_loginlog` VALUES ('311', 'ceshi', '101.88.111.176', '上海市', 'Chrome 87.0.4280.141', 'OS X 10_15_7', '电信', '1', '登陆成功', '2021-01-22 01:10:47');
INSERT INTO `b5net_loginlog` VALUES ('312', 'ceshi', '61.48.53.241', '北京市', 'Chrome 88.0.4324.96', 'OS X 11_0_1', '联通', '1', '登陆成功', '2021-01-22 16:09:23');
INSERT INTO `b5net_loginlog` VALUES ('313', 'ceshi', '42.53.129.8', '辽宁省', 'Chrome 79.0.3945.88', 'Linux ', '联通', '1', '登陆成功', '2021-01-23 15:57:07');
INSERT INTO `b5net_loginlog` VALUES ('314', 'ceshi', '223.167.173.94', '上海市', 'Chrome 63.0.3239.132', 'Windows 10.0', '联通', '0', '验证码错误', '2021-01-23 22:59:09');
INSERT INTO `b5net_loginlog` VALUES ('315', 'ceshi', '223.167.173.94', '上海市', 'Chrome 63.0.3239.132', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-23 22:59:22');
INSERT INTO `b5net_loginlog` VALUES ('316', 'ceshi', '144.52.56.15', '山东省青岛市', 'Edge 87.0.664.75', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-25 08:24:28');
INSERT INTO `b5net_loginlog` VALUES ('317', 'ceshi', '36.110.85.83', '北京市', 'Edge 87.0.664.60', 'OS X 10_15_7', '电信', '1', '登陆成功', '2021-01-25 14:28:54');
INSERT INTO `b5net_loginlog` VALUES ('318', 'ceshi', '120.204.63.53', '上海市', 'Chrome 80.0.3987.117', 'AndroidOS 8.1.0', '移动', '1', '登陆成功', '2021-01-26 07:54:10');
INSERT INTO `b5net_loginlog` VALUES ('319', 'ceshi', '18.236.140.156', '美国', 'Chrome 88.0.4324.96', 'Windows 10.0', '俄勒冈州波特兰Amazon数据中心', '1', '登陆成功', '2021-01-26 10:05:59');
INSERT INTO `b5net_loginlog` VALUES ('320', 'ceshi', '112.91.236.3', '广东省阳江市', 'Chrome 87.0.4280.141', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-26 10:53:45');
INSERT INTO `b5net_loginlog` VALUES ('321', 'ceshi', '59.41.74.245', '广东省广州市海珠区', 'Chrome 86.0.4240.183', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-26 11:40:24');
INSERT INTO `b5net_loginlog` VALUES ('322', 'ceshi', '101.70.61.167', '浙江省宁波市', 'Chrome 87.0.4280.141', 'OS X 10_15_7', '联通', '1', '登陆成功', '2021-01-26 13:08:37');
INSERT INTO `b5net_loginlog` VALUES ('323', 'ceshi', '116.22.58.26', '广东省广州市花都区', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-26 18:03:20');
INSERT INTO `b5net_loginlog` VALUES ('324', 'ceshi', '124.65.25.148', '北京市', 'Chrome 87.0.4280.88', 'OS X 10_15_7', '联通', '1', '登陆成功', '2021-01-26 18:57:00');
INSERT INTO `b5net_loginlog` VALUES ('325', 'ceshi', '114.246.34.139', '北京市', 'Chrome 87.0.4280.88', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-26 19:43:48');
INSERT INTO `b5net_loginlog` VALUES ('326', 'ceshi', '171.90.198.151', '四川省自贡市', 'Chrome 75.0.3770.156', 'AndroidOS 10', '电信', '1', '登陆成功', '2021-01-27 00:58:00');
INSERT INTO `b5net_loginlog` VALUES ('327', 'ceshi', '39.65.152.226', '山东省临沂市', 'Chrome 87.0.4280.141', 'Windows 6.1', '联通', '1', '登陆成功', '2021-01-27 14:36:00');
INSERT INTO `b5net_loginlog` VALUES ('328', 'ceshi', '180.111.65.171', '江苏省南京市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '0', '验证码错误', '2021-01-27 17:56:46');
INSERT INTO `b5net_loginlog` VALUES ('329', 'ceshi', '180.111.65.171', '江苏省南京市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-27 17:56:51');
INSERT INTO `b5net_loginlog` VALUES ('330', 'ceshi', '119.186.72.209', '山东省', 'Chrome 87.0.4280.141', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-28 01:35:08');
INSERT INTO `b5net_loginlog` VALUES ('331', 'ceshi', '180.111.65.171', '江苏省南京市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-28 09:28:36');
INSERT INTO `b5net_loginlog` VALUES ('332', 'ceshi', '222.188.218.156', '江苏省常州市', 'Chrome 88.0.4324.96', 'Linux ', '电信', '1', '登陆成功', '2021-01-28 15:26:19');
INSERT INTO `b5net_loginlog` VALUES ('333', 'ceshi', '120.36.94.15', '福建省福州市', 'Edge 88.0.705.50', 'OS X 11_1_0', '电信', '1', '登陆成功', '2021-01-29 09:52:53');
INSERT INTO `b5net_loginlog` VALUES ('334', 'ceshi', '112.7.65.118', '山东省', 'Chrome 78.0.3904.108', 'Windows 10.0', '移动', '1', '登陆成功', '2021-01-29 11:45:42');
INSERT INTO `b5net_loginlog` VALUES ('335', 'ceshi', '118.26.139.18', '北京市', 'Chrome 88.0.4324.96', 'Windows 6.3', '中移铁通', '1', '登陆成功', '2021-01-29 14:19:41');
INSERT INTO `b5net_loginlog` VALUES ('336', 'ceshi', '58.58.181.33', '山东省日照市', 'Chrome 88.0.4324.104', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-29 15:40:04');
INSERT INTO `b5net_loginlog` VALUES ('337', 'ceshi', '58.58.181.33', '山东省日照市', 'Chrome 88.0.4324.104', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-29 15:40:37');
INSERT INTO `b5net_loginlog` VALUES ('338', 'ceshi', '119.50.169.211', '吉林省延边州', 'Chrome 87.0.4280.88', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-29 16:29:16');
INSERT INTO `b5net_loginlog` VALUES ('339', 'ceshi', '118.161.57.160', '台湾省', 'Chrome 88.0.4324.104', 'Windows 10.0', '中华电信(HiNet)数据中心', '1', '登陆成功', '2021-01-29 16:50:40');
INSERT INTO `b5net_loginlog` VALUES ('340', 'ceshi', '113.104.177.116', '广东省深圳市', 'Chrome 70.0.3538.25', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-30 11:52:39');
INSERT INTO `b5net_loginlog` VALUES ('341', 'ceshi', '113.104.177.116', '广东省深圳市', 'Chrome 70.0.3538.25', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-30 11:54:12');
INSERT INTO `b5net_loginlog` VALUES ('342', 'ceshi', '221.227.67.118', '江苏省无锡市', 'Chrome 88.0.4324.104', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-30 12:51:00');
INSERT INTO `b5net_loginlog` VALUES ('343', 'ceshi', '27.38.249.152', '广东省深圳市', 'Chrome 70.0.3538.25', 'Windows 10.0', '联通', '1', '登陆成功', '2021-01-30 17:59:34');
INSERT INTO `b5net_loginlog` VALUES ('344', 'ceshi', '113.104.177.116', '广东省深圳市', 'Chrome 70.0.3538.25', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-30 23:34:14');
INSERT INTO `b5net_loginlog` VALUES ('345', 'ceshi', '1.86.58.83', '陕西省西安市', 'Chrome 71.0.3578.141', 'AndroidOS 10', '电信', '0', '验证码错误', '2021-01-31 13:48:15');
INSERT INTO `b5net_loginlog` VALUES ('346', 'ceshi', '1.86.58.83', '陕西省西安市', 'Chrome 71.0.3578.141', 'AndroidOS 10', '电信', '1', '登陆成功', '2021-01-31 13:48:33');
INSERT INTO `b5net_loginlog` VALUES ('347', 'ceshi', '113.104.178.56', '广东省深圳市', 'Chrome 70.0.3538.25', 'Windows 10.0', '电信', '1', '登陆成功', '2021-01-31 21:41:44');
INSERT INTO `b5net_loginlog` VALUES ('348', 'ceshi', '118.26.139.18', '北京市', 'Chrome 88.0.4324.96', 'Windows 6.3', '中移铁通', '1', '登陆成功', '2021-02-01 09:37:09');
INSERT INTO `b5net_loginlog` VALUES ('349', 'ceshi', '10.1.1.1', '局域网', 'Chrome 86.0.4240.198', 'Windows 10.0', 'IP', '1', '登陆成功', '2021-02-01 10:23:07');
INSERT INTO `b5net_loginlog` VALUES ('350', 'ceshi', '118.26.139.18', '北京市', 'Chrome 88.0.4324.96', 'Windows 6.3', '中移铁通', '1', '登陆成功', '2021-02-01 17:19:31');
INSERT INTO `b5net_loginlog` VALUES ('351', 'ceshi', '118.26.139.18', '北京市', 'Chrome 88.0.4324.96', 'Windows 6.3', '中移铁通', '1', '登陆成功', '2021-02-02 10:20:42');
INSERT INTO `b5net_loginlog` VALUES ('352', 'ceshi', '175.10.45.101', '湖南省长沙市', 'Edge 84.0.522.50', 'Windows 10.0', '电信', '0', '验证码错误', '2021-02-02 13:48:46');
INSERT INTO `b5net_loginlog` VALUES ('353', 'ceshi', '175.10.45.101', '湖南省长沙市', 'Edge 84.0.522.50', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-02 13:48:53');
INSERT INTO `b5net_loginlog` VALUES ('354', 'ceshi', '36.7.111.51', '安徽省合肥市', 'Edge 88.0.705.56', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-02 16:56:06');
INSERT INTO `b5net_loginlog` VALUES ('355', 'ceshi', '118.166.51.6', '台湾省', 'Chrome 88.0.4324.104', 'Windows 10.0', '中华电信(HiNet)数据中心', '1', '登陆成功', '2021-02-02 22:04:35');
INSERT INTO `b5net_loginlog` VALUES ('356', 'ceshi', '118.166.51.6', '台湾省', 'Chrome 88.0.4324.104', 'Windows 10.0', '中华电信(HiNet)数据中心', '1', '登陆成功', '2021-02-02 23:17:29');
INSERT INTO `b5net_loginlog` VALUES ('357', 'ceshi', '118.166.51.6', '台湾省', 'Chrome 88.0.4324.104', 'Windows 10.0', '中华电信(HiNet)数据中心', '1', '登陆成功', '2021-02-03 06:52:21');
INSERT INTO `b5net_loginlog` VALUES ('358', 'ceshi', '1.161.11.184', '台湾省台北市', 'Chrome 88.0.4324.104', 'Windows 10.0', '中华电信', '1', '登陆成功', '2021-02-03 11:47:52');
INSERT INTO `b5net_loginlog` VALUES ('359', 'ceshi', '1.161.11.184', '台湾省台北市', 'Chrome 88.0.4324.104', 'Windows 10.0', '中华电信', '0', '验证码错误', '2021-02-03 11:48:07');
INSERT INTO `b5net_loginlog` VALUES ('360', 'ceshi', '1.161.11.184', '台湾省台北市', 'Chrome 88.0.4324.104', 'Windows 10.0', '中华电信', '0', '验证码错误', '2021-02-03 11:48:13');
INSERT INTO `b5net_loginlog` VALUES ('361', 'ceshi', '1.161.11.184', '台湾省台北市', 'Chrome 88.0.4324.104', 'Windows 10.0', '中华电信', '1', '登陆成功', '2021-02-03 11:48:19');
INSERT INTO `b5net_loginlog` VALUES ('362', 'ceshi', '117.32.136.30', '陕西省西安市', 'Chrome 88.0.4324.104', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-03 15:29:20');
INSERT INTO `b5net_loginlog` VALUES ('363', 'ceshi', '114.247.186.83', '北京市', 'Chrome 88.0.4324.104', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-03 15:48:20');
INSERT INTO `b5net_loginlog` VALUES ('364', 'ceshi', '120.36.226.227', '福建省厦门市', 'Safari 14.0.1', 'OS X 10_14_6', '电信', '1', '登陆成功', '2021-02-04 09:24:43');
INSERT INTO `b5net_loginlog` VALUES ('365', 'ceshi', '118.26.139.18', '北京市', 'Chrome 88.0.4324.104', 'Windows 6.3', '中移铁通', '1', '登陆成功', '2021-02-04 11:22:25');
INSERT INTO `b5net_loginlog` VALUES ('366', 'ceshi', '36.28.148.205', '浙江省', 'Chrome 78.0.3904.108', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-04 23:25:18');
INSERT INTO `b5net_loginlog` VALUES ('367', 'ceshi', '34.92.22.220', '香港', 'Chrome 87.0.4280.141', 'Windows 10.0', 'Google云计算数据中心', '1', '登陆成功', '2021-02-06 02:17:12');
INSERT INTO `b5net_loginlog` VALUES ('368', 'ceshi', '112.17.245.23', '浙江省杭州市', 'Chrome 88.0.4324.141', 'AndroidOS 9', '移动', '1', '登陆成功', '2021-02-06 16:52:41');
INSERT INTO `b5net_loginlog` VALUES ('369', 'ceshi', '36.7.72.214', '安徽省合肥市', 'Chrome 85.0.4183.83', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-07 13:19:27');
INSERT INTO `b5net_loginlog` VALUES ('370', 'ceshi', '223.104.247.27', '浙江省嘉兴市', 'Chrome 88.0.4324.146', 'OS X 10_15_7', '移动', '1', '登陆成功', '2021-02-08 22:31:21');
INSERT INTO `b5net_loginlog` VALUES ('371', 'ceshi', '120.239.89.224', '广东省江门市', 'Chrome 87.0.4280.88', 'Windows 10.0', '移动', '0', '验证码错误', '2021-02-09 03:52:03');
INSERT INTO `b5net_loginlog` VALUES ('372', 'ceshi', '120.239.89.224', '广东省江门市', 'Chrome 87.0.4280.88', 'Windows 10.0', '移动', '1', '登陆成功', '2021-02-09 03:52:14');
INSERT INTO `b5net_loginlog` VALUES ('373', 'ceshi', '110.249.168.6', '河北省石家庄市', 'Chrome 88.0.4324.104', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-09 18:02:57');
INSERT INTO `b5net_loginlog` VALUES ('374', 'ceshi', '113.91.141.128', '广东省深圳市', 'Chrome 88.0.4324.150', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-09 18:13:28');
INSERT INTO `b5net_loginlog` VALUES ('375', 'ceshi', '119.28.89.67', '香港', 'Chrome 88.0.4324.146', 'OS X 11_2_0', '腾讯云', '0', '验证码错误', '2021-02-09 18:29:47');
INSERT INTO `b5net_loginlog` VALUES ('376', 'ceshi', '119.28.89.67', '香港', 'Chrome 88.0.4324.146', 'OS X 11_2_0', '腾讯云', '1', '登陆成功', '2021-02-09 18:30:01');
INSERT INTO `b5net_loginlog` VALUES ('377', 'ceshi', '120.199.163.172', '浙江省金华市', 'Chrome 88.0.4324.146', 'OS X 11_2_0', '移动', '1', '登陆成功', '2021-02-09 20:09:56');
INSERT INTO `b5net_loginlog` VALUES ('378', 'ceshi', '120.68.156.89', '新疆', 'Safari 14.0.2', 'OS X 10_15_6', '电信', '0', '验证码错误', '2021-02-09 21:21:37');
INSERT INTO `b5net_loginlog` VALUES ('379', 'ceshi', '120.68.156.89', '新疆', 'Safari 14.0.2', 'OS X 10_15_6', '电信', '0', '验证码错误', '2021-02-09 21:21:44');
INSERT INTO `b5net_loginlog` VALUES ('380', 'ceshi', '120.68.156.89', '新疆', 'Safari 14.0.2', 'OS X 10_15_6', '电信', '0', '验证码错误', '2021-02-09 21:21:54');
INSERT INTO `b5net_loginlog` VALUES ('381', 'ceshi', '120.68.156.89', '新疆', 'Safari 14.0.2', 'OS X 10_15_6', '电信', '0', '验证码错误', '2021-02-09 21:22:05');
INSERT INTO `b5net_loginlog` VALUES ('382', 'ceshi', '120.235.230.3', '广东省', 'Chrome 85.0.4183.121', 'OS X 10_15_4', '移动', '0', '验证码错误', '2021-02-09 21:27:54');
INSERT INTO `b5net_loginlog` VALUES ('383', 'ceshi', '124.236.159.49', '河北省石家庄市', 'Chrome 88.0.4324.146', 'OS X 10_13_6', '电信', '1', '登陆成功', '2021-02-09 22:28:19');
INSERT INTO `b5net_loginlog` VALUES ('384', 'ceshi', '171.90.199.180', '四川省自贡市', 'Chrome 88.0.4324.104', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-09 22:51:26');
INSERT INTO `b5net_loginlog` VALUES ('385', 'ceshi', '27.18.42.202', '湖北省武汉市', 'Chrome 72.0.3626.81', 'Windows 6.1', '电信', '1', '登陆成功', '2021-02-09 23:28:19');
INSERT INTO `b5net_loginlog` VALUES ('386', 'ceshi', '202.98.37.225', '重庆市', 'Chrome 88.0.4324.96', 'OS X 11_1_0', '电信', '1', '登陆成功', '2021-02-10 09:25:49');
INSERT INTO `b5net_loginlog` VALUES ('387', 'ceshi', '120.36.226.161', '福建省厦门市', 'Chrome 75.0.3770.100', 'Windows 6.1', '电信', '1', '登陆成功', '2021-02-10 09:36:47');
INSERT INTO `b5net_loginlog` VALUES ('388', 'ceshi', '210.13.88.18', '上海市', 'Chrome 88.0.4324.146', 'OS X 11_2_0', '联通', '1', '登陆成功', '2021-02-10 09:42:49');
INSERT INTO `b5net_loginlog` VALUES ('389', 'ceshi', '113.110.229.200', '广东省深圳市', 'Chrome 88.0.4324.104', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-10 09:46:29');
INSERT INTO `b5net_loginlog` VALUES ('390', 'ceshi', '183.237.230.82', '广东省', 'Chrome 88.0.4324.146', 'Windows 10.0', '移动', '1', '登陆成功', '2021-02-10 10:19:51');
INSERT INTO `b5net_loginlog` VALUES ('391', 'ceshi', '123.116.5.142', '北京市', 'Edge 88.0.705.63', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-10 10:47:01');
INSERT INTO `b5net_loginlog` VALUES ('392', 'ceshi', '42.238.184.12', '河南省商丘市', 'Chrome 88.0.4324.150', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-10 10:47:11');
INSERT INTO `b5net_loginlog` VALUES ('393', 'ceshi', '106.114.218.96', '河北省石家庄市', 'Chrome 88.0.4324.150', 'OS X 10_15_7', '电信', '1', '登陆成功', '2021-02-10 10:48:28');
INSERT INTO `b5net_loginlog` VALUES ('394', 'ceshi', '106.114.218.96', '河北省石家庄市', 'Chrome 88.0.4324.150', 'OS X 10_15_7', '电信', '1', '登陆成功', '2021-02-10 10:50:20');
INSERT INTO `b5net_loginlog` VALUES ('395', 'ceshi', '61.173.176.216', '上海市金山区', 'Chrome 86.0.4240.198', 'Windows 6.1', '电信', '0', '验证码错误', '2021-02-10 13:11:52');
INSERT INTO `b5net_loginlog` VALUES ('396', 'ceshi', '61.173.176.216', '上海市金山区', 'Chrome 86.0.4240.198', 'Windows 6.1', '电信', '0', '验证码错误', '2021-02-10 13:12:05');
INSERT INTO `b5net_loginlog` VALUES ('397', 'ceshi', '61.173.176.216', '上海市金山区', 'Chrome 86.0.4240.198', 'Windows 6.1', '电信', '1', '登陆成功', '2021-02-10 13:12:14');
INSERT INTO `b5net_loginlog` VALUES ('398', 'ceshi', '110.250.52.196', '河北省唐山市', 'Chrome 88.0.4324.150', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-10 16:49:52');
INSERT INTO `b5net_loginlog` VALUES ('399', 'ceshi', '39.110.208.54', '日本', 'Chrome 88.0.4324.146', 'Windows 10.0', 'So net娱乐通讯', '1', '登陆成功', '2021-02-10 17:30:06');
INSERT INTO `b5net_loginlog` VALUES ('400', 'ceshi', '116.230.88.180', '上海市', 'Chrome 88.0.4324.150', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-10 19:17:14');
INSERT INTO `b5net_loginlog` VALUES ('401', 'ceshi', '61.185.195.190', '陕西省西安市', 'Chrome 88.0.4324.146', 'OS X 11_1_0', '电信', '1', '登陆成功', '2021-02-10 21:13:06');
INSERT INTO `b5net_loginlog` VALUES ('402', 'ceshi', '120.204.163.88', '上海市', 'Chrome 70.0.3538.25', 'Windows 10.0', '移动', '1', '登陆成功', '2021-02-10 23:09:31');
INSERT INTO `b5net_loginlog` VALUES ('403', 'ceshi', '153.34.181.58', '江苏省苏州市', 'Edge 88.0.705.63', 'Windows 10.0', '联通', '0', '验证码错误', '2021-02-11 10:42:46');
INSERT INTO `b5net_loginlog` VALUES ('404', 'ceshi', '153.34.181.58', '江苏省苏州市', 'Edge 88.0.705.63', 'Windows 10.0', '联通', '0', '验证码错误', '2021-02-11 10:42:52');
INSERT INTO `b5net_loginlog` VALUES ('405', 'ceshi', '153.34.181.58', '江苏省苏州市', 'Edge 88.0.705.63', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-11 10:42:59');
INSERT INTO `b5net_loginlog` VALUES ('406', 'ceshi', '153.34.181.58', '江苏省苏州市', 'Edge 88.0.705.63', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-11 10:44:59');
INSERT INTO `b5net_loginlog` VALUES ('407', 'ceshi', '223.73.8.52', '广东省汕头市', 'Chrome 88.0.4324.150', 'Windows 10.0', '移动', '1', '登陆成功', '2021-02-11 17:03:18');
INSERT INTO `b5net_loginlog` VALUES ('408', 'ceshi', '120.239.34.177', '广东省茂名市', 'Chrome 88.0.4324.104', 'Windows 10.0', '移动', '1', '登陆成功', '2021-02-12 10:37:46');
INSERT INTO `b5net_loginlog` VALUES ('409', 'ceshi', '183.217.228.168', '江西省赣州市', 'Chrome 88.0.4324.150', 'Windows 10.0', '移动', '1', '登陆成功', '2021-02-12 11:25:13');
INSERT INTO `b5net_loginlog` VALUES ('410', 'ceshi', '116.17.240.166', '广东省河源市', 'Chrome 88.0.4324.150', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-12 15:14:57');
INSERT INTO `b5net_loginlog` VALUES ('411', 'ceshi', '117.143.135.236', '上海市', 'Chrome 88.0.4324.150', 'Windows 10.0', '移动', '1', '登陆成功', '2021-02-12 22:45:24');
INSERT INTO `b5net_loginlog` VALUES ('412', 'ceshi', '103.207.70.13', '亚太地区', 'Chrome 88.0.4324.150', 'Windows 10.0', '', '1', '登陆成功', '2021-02-13 20:03:24');
INSERT INTO `b5net_loginlog` VALUES ('413', 'ceshi', '112.0.5.131', '江苏省盐城市', 'Chrome 90.0.4412.3', 'OS X 11_2_1', '移动', '1', '登陆成功', '2021-02-13 23:01:01');
INSERT INTO `b5net_loginlog` VALUES ('414', 'ceshi', '42.228.237.222', '河南省郑州市', 'Chrome 89.0.4356.6', 'Windows 10.0', '联通', '0', '验证码错误', '2021-02-14 16:55:00');
INSERT INTO `b5net_loginlog` VALUES ('415', 'ceshi', '42.228.237.222', '河南省郑州市', 'Chrome 89.0.4356.6', 'Windows 10.0', '联通', '0', '验证码错误', '2021-02-14 16:55:05');
INSERT INTO `b5net_loginlog` VALUES ('416', 'ceshi', '42.228.237.222', '河南省郑州市', 'Chrome 89.0.4356.6', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-14 16:55:11');
INSERT INTO `b5net_loginlog` VALUES ('417', 'ceshi', '42.224.140.109', '河南省洛阳市', 'Chrome 89.0.4356.6', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-14 16:56:39');
INSERT INTO `b5net_loginlog` VALUES ('418', 'ceshi', '42.224.140.109', '河南省洛阳市', 'Chrome 89.0.4356.6', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-14 16:57:41');
INSERT INTO `b5net_loginlog` VALUES ('419', 'ceshi', '42.224.143.98', '河南省洛阳市', 'Chrome 89.0.4356.6', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-14 19:58:34');
INSERT INTO `b5net_loginlog` VALUES ('420', 'ceshi', '42.224.143.98', '河南省洛阳市', 'Chrome 89.0.4356.6', 'Windows 10.0', '联通', '0', '验证码错误', '2021-02-14 20:00:11');
INSERT INTO `b5net_loginlog` VALUES ('421', 'ceshi', '42.224.143.98', '河南省洛阳市', 'Chrome 89.0.4356.6', 'Windows 10.0', '联通', '0', '验证码错误', '2021-02-14 20:00:17');
INSERT INTO `b5net_loginlog` VALUES ('422', 'ceshi', '42.224.143.98', '河南省洛阳市', 'Chrome 89.0.4356.6', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-14 20:00:24');
INSERT INTO `b5net_loginlog` VALUES ('423', 'ceshi', '144.52.190.101', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-14 20:14:17');
INSERT INTO `b5net_loginlog` VALUES ('424', 'ceshi', '183.98.58.34', '韩国', 'Chrome 88.0.4324.150', 'Windows 10.0', 'KT电信', '1', '登陆成功', '2021-02-16 16:59:38');
INSERT INTO `b5net_loginlog` VALUES ('425', 'ceshi', '113.102.164.8', '广东省深圳市', 'Chrome 88.0.4324.150', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-16 17:11:59');
INSERT INTO `b5net_loginlog` VALUES ('426', 'ceshi', '18.163.7.135', '香港', 'Chrome 88.0.4324.150', 'OS X 11_2_0', 'Amazon数据中心', '1', '登陆成功', '2021-02-16 17:14:21');
INSERT INTO `b5net_loginlog` VALUES ('427', 'ceshi', '110.249.168.6', '河北省石家庄市', 'Chrome 88.0.4324.104', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-16 17:23:09');
INSERT INTO `b5net_loginlog` VALUES ('428', 'ceshi', '117.89.108.37', '江苏省南京市', 'Chrome 88.0.4324.150', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-16 18:46:13');
INSERT INTO `b5net_loginlog` VALUES ('429', 'ceshi', '175.171.50.189', '辽宁省大连市', 'Chrome 88.0.4324.150', 'OS X 11_2_1', '联通', '0', '验证码错误', '2021-02-16 19:32:12');
INSERT INTO `b5net_loginlog` VALUES ('430', 'ceshi', '175.171.50.189', '辽宁省大连市', 'Chrome 88.0.4324.150', 'OS X 11_2_1', '联通', '0', '验证码错误', '2021-02-16 19:32:20');
INSERT INTO `b5net_loginlog` VALUES ('431', 'ceshi', '175.171.50.189', '辽宁省大连市', 'Chrome 88.0.4324.150', 'OS X 11_2_1', '联通', '1', '登陆成功', '2021-02-16 19:32:28');
INSERT INTO `b5net_loginlog` VALUES ('432', 'ceshi', '120.243.22.39', '安徽省', 'Chrome 69.0.3497.100', 'Windows 10.0', '移动', '1', '登陆成功', '2021-02-16 19:44:08');
INSERT INTO `b5net_loginlog` VALUES ('433', 'ceshi', '115.53.109.76', '河南省许昌市', 'Chrome 86.0.4240.198', 'Windows 10.0', '联通', '0', '验证码错误', '2021-02-16 20:23:53');
INSERT INTO `b5net_loginlog` VALUES ('434', 'ceshi', '115.53.109.76', '河南省许昌市', 'Chrome 86.0.4240.198', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-16 20:24:03');
INSERT INTO `b5net_loginlog` VALUES ('435', 'ceshi', '113.249.56.124', '重庆市', 'Chrome 88.0.4324.150', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-16 21:38:16');
INSERT INTO `b5net_loginlog` VALUES ('436', 'ceshi', '112.22.92.212', '江苏省无锡市', 'Chrome 88.0.4324.150', 'Windows 10.0', '移动', '1', '登陆成功', '2021-02-16 22:39:57');
INSERT INTO `b5net_loginlog` VALUES ('437', 'ceshi', '115.152.146.74', '江西省上饶市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '电信', '1', '登陆成功', '2021-02-17 00:07:36');
INSERT INTO `b5net_loginlog` VALUES ('438', 'ceshi', '202.186.122.24', '马来西亚', 'Chrome 88.0.4324.150', 'Windows 10.0', '', '1', '登陆成功', '2021-02-17 04:11:59');
INSERT INTO `b5net_loginlog` VALUES ('439', 'ceshi', '112.238.169.172', '山东省烟台市', 'Chrome 86.0.4240.198', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-17 15:35:09');
INSERT INTO `b5net_loginlog` VALUES ('440', 'ceshi', '171.214.136.127', '四川省成都市', 'Chrome 88.0.4324.150', 'Windows 6.1', '电信', '1', '登陆成功', '2021-02-17 15:41:10');
INSERT INTO `b5net_loginlog` VALUES ('441', 'ceshi', '110.249.168.6', '河北省石家庄市', 'Chrome 88.0.4324.104', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-17 17:08:08');
INSERT INTO `b5net_loginlog` VALUES ('442', 'ceshi', '125.80.182.173', '重庆市渝中区', 'Chrome 76.0.3809.100', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-17 19:24:25');
INSERT INTO `b5net_loginlog` VALUES ('443', 'ceshi', '112.112.242.41', '云南省昆明市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-17 20:58:50');
INSERT INTO `b5net_loginlog` VALUES ('444', 'ceshi', '223.73.8.170', '广东省汕头市', 'Chrome 88.0.4324.182', 'Windows 10.0', '移动', '1', '登陆成功', '2021-02-17 23:52:45');
INSERT INTO `b5net_loginlog` VALUES ('445', 'ceshi', '115.60.60.147', '河南省郑州市', 'Chrome 87.0.4280.67', 'OS X 10_15_7', '联通', '1', '登陆成功', '2021-02-18 09:03:57');
INSERT INTO `b5net_loginlog` VALUES ('446', 'ceshi', '115.60.60.147', '河南省郑州市', 'Chrome 88.0.4324.182', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-18 09:05:26');
INSERT INTO `b5net_loginlog` VALUES ('447', 'ceshi', '223.93.131.98', '浙江省杭州市', 'Chrome 87.0.4280.141', 'Windows 10.0', '移动', '1', '登陆成功', '2021-02-18 09:21:36');
INSERT INTO `b5net_loginlog` VALUES ('448', 'ceshi', '221.0.77.146', '山东省烟台市', 'Chrome 86.0.4240.198', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-18 09:44:54');
INSERT INTO `b5net_loginlog` VALUES ('449', 'ceshi', '180.166.163.34', '上海市', 'Chrome 88.0.4324.146', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-18 10:55:20');
INSERT INTO `b5net_loginlog` VALUES ('450', 'ceshi', '110.249.168.6', '河北省石家庄市', 'Chrome 88.0.4324.104', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-18 11:33:20');
INSERT INTO `b5net_loginlog` VALUES ('451', 'ceshi', '120.34.217.181', '福建省南平市建阳市', 'Chrome 78.0.3904.108', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-18 13:45:31');
INSERT INTO `b5net_loginlog` VALUES ('452', 'ceshi', '221.0.77.146', '山东省烟台市', 'Chrome 86.0.4240.198', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-18 13:56:03');
INSERT INTO `b5net_loginlog` VALUES ('453', 'ceshi', '218.208.214.165', '马来西亚', 'Chrome 88.0.4324.150', 'Windows 10.0', '', '1', '登陆成功', '2021-02-18 14:29:13');
INSERT INTO `b5net_loginlog` VALUES ('454', 'ceshi', '60.216.101.226', '山东省', 'Edge 88.0.705.68', 'Windows 10.0', 'BGP大带宽业务机柜段', '1', '登陆成功', '2021-02-18 17:02:08');
INSERT INTO `b5net_loginlog` VALUES ('455', 'ceshi', '115.206.246.244', '浙江省杭州市', 'Chrome 88.0.4324.146', 'OS X 10_15_7', '电信', '1', '登陆成功', '2021-02-18 17:19:44');
INSERT INTO `b5net_loginlog` VALUES ('456', 'ceshi', '182.138.227.201', '四川省成都市', 'Chrome 87.0.4280.66', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-18 17:24:51');
INSERT INTO `b5net_loginlog` VALUES ('457', 'ceshi', '39.170.15.156', '浙江省杭州市', 'Chrome 88.0.4324.150', 'OS X 11_2_0', '移动', '0', '验证码错误', '2021-02-19 09:08:50');
INSERT INTO `b5net_loginlog` VALUES ('458', 'ceshi', '39.170.15.156', '浙江省杭州市', 'Chrome 88.0.4324.150', 'OS X 11_2_0', '移动', '1', '登陆成功', '2021-02-19 09:08:59');
INSERT INTO `b5net_loginlog` VALUES ('459', 'ceshi', '60.2.224.235', '河北省唐山市', 'Chrome 88.0.4324.182', 'Windows 6.1', '联通', '1', '登陆成功', '2021-02-19 11:18:03');
INSERT INTO `b5net_loginlog` VALUES ('460', 'ceshi', '60.2.224.235', '河北省唐山市', 'Chrome 88.0.4324.182', 'Windows 6.1', '联通', '1', '登陆成功', '2021-02-19 11:20:11');
INSERT INTO `b5net_loginlog` VALUES ('461', 'ceshi', '58.35.215.135', '上海市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-19 11:48:05');
INSERT INTO `b5net_loginlog` VALUES ('462', 'ceshi', '183.236.34.71', '广东省广州市', 'Safari 14.0.3', 'OS X 10_15_6', '移动', '0', '验证码错误', '2021-02-19 12:00:41');
INSERT INTO `b5net_loginlog` VALUES ('463', 'ceshi', '183.130.122.154', '浙江省', 'Chrome 83.0.4103.97', 'Windows 10.0', '电信中心网络', '1', '登陆成功', '2021-02-19 12:56:27');
INSERT INTO `b5net_loginlog` VALUES ('464', 'ceshi', '183.236.34.71', '广东省广州市', 'Safari 14.0.3', 'OS X 10_15_6', '移动', '0', '验证码错误', '2021-02-19 13:36:28');
INSERT INTO `b5net_loginlog` VALUES ('465', 'ceshi', '183.236.34.71', '广东省广州市', 'Safari 14.0.3', 'OS X 10_15_6', '移动', '1', '登陆成功', '2021-02-19 13:36:35');
INSERT INTO `b5net_loginlog` VALUES ('466', 'ceshi', '123.235.232.48', '山东省青岛市', 'Chrome 88.0.4324.182', 'Windows 6.1', '联通', '1', '登陆成功', '2021-02-19 14:46:45');
INSERT INTO `b5net_loginlog` VALUES ('467', 'ceshi', '59.56.32.93', '福建省福州市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '0', '验证码错误', '2021-02-19 15:38:22');
INSERT INTO `b5net_loginlog` VALUES ('468', 'ceshi', '59.56.32.93', '福建省福州市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-19 15:38:30');
INSERT INTO `b5net_loginlog` VALUES ('469', 'ceshi', '121.230.135.61', '江苏省泰州市姜堰市', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-19 15:41:59');
INSERT INTO `b5net_loginlog` VALUES ('470', 'ceshi', '106.6.162.235', '江西省南昌市', 'Chrome 88.0.4324.150', 'Windows 6.1', '电信', '1', '登陆成功', '2021-02-19 15:50:25');
INSERT INTO `b5net_loginlog` VALUES ('471', 'ceshi', '116.253.152.247', '广西柳州市', 'Chrome 70.0.3538.25', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-19 23:36:20');
INSERT INTO `b5net_loginlog` VALUES ('472', 'ceshi', '183.236.34.71', '广东省广州市', 'Safari 14.0.3', 'OS X 10_15_6', '移动', '1', '登陆成功', '2021-02-20 09:05:11');
INSERT INTO `b5net_loginlog` VALUES ('473', 'ceshi', '119.129.253.109', '广东省广州市', 'Chrome 88.0.4324.146', 'OS X 10_15_6', '电信', '1', '登陆成功', '2021-02-20 09:12:13');
INSERT INTO `b5net_loginlog` VALUES ('474', 'ceshi', '58.35.215.135', '上海市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 10:10:41');
INSERT INTO `b5net_loginlog` VALUES ('475', 'ceshi', '218.2.6.10', '江苏省淮安市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 10:37:10');
INSERT INTO `b5net_loginlog` VALUES ('476', 'ceshi', '183.53.191.239', '广东省珠海市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 14:23:06');
INSERT INTO `b5net_loginlog` VALUES ('477', 'ceshi', '58.35.215.135', '上海市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 14:28:28');
INSERT INTO `b5net_loginlog` VALUES ('478', 'admin', '58.35.215.135', '上海市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '0', '账号或密码错误', '2021-02-20 14:28:45');
INSERT INTO `b5net_loginlog` VALUES ('479', 'ceshi', '58.35.215.135', '上海市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 14:28:59');
INSERT INTO `b5net_loginlog` VALUES ('480', 'ceshi', '27.186.228.203', '河北省保定市', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 14:44:01');
INSERT INTO `b5net_loginlog` VALUES ('481', 'ceshi', '120.41.180.224', '福建省厦门市', 'Chrome 88.0.4324.150', 'OS X 10_15_7', '电信', '1', '登陆成功', '2021-02-20 14:53:24');
INSERT INTO `b5net_loginlog` VALUES ('482', 'ceshi', '58.35.215.135', '上海市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 14:55:26');
INSERT INTO `b5net_loginlog` VALUES ('483', 'ceshi', '120.41.180.224', '福建省厦门市', 'Chrome 88.0.4324.150', 'OS X 10_15_7', '电信', '0', '验证码错误', '2021-02-20 15:14:57');
INSERT INTO `b5net_loginlog` VALUES ('484', 'ceshi', '120.41.180.224', '福建省厦门市', 'Chrome 88.0.4324.150', 'OS X 10_15_7', '电信', '1', '登陆成功', '2021-02-20 15:15:02');
INSERT INTO `b5net_loginlog` VALUES ('485', 'ceshi', '183.6.107.248', '广东省广州市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 15:16:30');
INSERT INTO `b5net_loginlog` VALUES ('486', 'ceshi', '183.5.191.240', '广东省广州市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 15:25:15');
INSERT INTO `b5net_loginlog` VALUES ('487', 'ceshi', '124.236.131.201', '河北省石家庄市', 'Chrome 88.0.4324.182', 'OS X 10_15_7', '电信', '1', '登陆成功', '2021-02-20 15:29:20');
INSERT INTO `b5net_loginlog` VALUES ('488', 'ceshi', '101.229.173.220', '上海市', 'Chrome 88.0.4324.104', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 15:34:58');
INSERT INTO `b5net_loginlog` VALUES ('489', 'ceshi', '120.36.213.237', '福建省厦门市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 15:47:25');
INSERT INTO `b5net_loginlog` VALUES ('490', 'ceshi', '125.67.137.43', '四川省绵阳市', 'Chrome 83.0.4103.106', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 15:48:47');
INSERT INTO `b5net_loginlog` VALUES ('491', 'ceshi', '111.172.195.247', '湖北省武汉市', 'Chrome 88.0.4324.182', 'OS X 11_2_0', '电信', '0', '验证码错误', '2021-02-20 15:54:07');
INSERT INTO `b5net_loginlog` VALUES ('492', 'ceshi', '111.172.195.247', '湖北省武汉市', 'Chrome 88.0.4324.182', 'OS X 11_2_0', '电信', '1', '登陆成功', '2021-02-20 15:54:24');
INSERT INTO `b5net_loginlog` VALUES ('493', 'ceshi', '113.248.153.235', '重庆市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '0', '验证码错误', '2021-02-20 15:57:01');
INSERT INTO `b5net_loginlog` VALUES ('494', 'ceshi', '113.248.153.235', '重庆市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '0', '验证码错误', '2021-02-20 15:57:08');
INSERT INTO `b5net_loginlog` VALUES ('495', 'ceshi', '113.248.153.235', '重庆市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 15:57:18');
INSERT INTO `b5net_loginlog` VALUES ('496', 'ceshi', '144.255.144.180', '山东省临沂市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 16:05:16');
INSERT INTO `b5net_loginlog` VALUES ('497', 'ceshi', '119.139.197.146', '广东省深圳市', 'Chrome 88.0.4324.182', 'OS X 11_2_1', '电信', '1', '登陆成功', '2021-02-20 16:40:38');
INSERT INTO `b5net_loginlog` VALUES ('498', 'ceshi', '101.83.241.186', '上海市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 16:41:02');
INSERT INTO `b5net_loginlog` VALUES ('499', 'ceshi', '1.83.106.29', '陕西省西安市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 16:52:25');
INSERT INTO `b5net_loginlog` VALUES ('500', 'ceshi', '171.109.213.41', '广西贵港市', 'Opera 73.0.3856.344', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 16:57:29');
INSERT INTO `b5net_loginlog` VALUES ('501', 'ceshi', '113.98.116.238', '广东省广州市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 16:59:04');
INSERT INTO `b5net_loginlog` VALUES ('502', 'ceshi', '36.148.107.53', '湖南省', 'Chrome 77.0.3865.120', 'AndroidOS 11', '移动', '1', '登陆成功', '2021-02-20 17:08:21');
INSERT INTO `b5net_loginlog` VALUES ('503', 'ceshi', '116.233.206.212', '上海市宝山区', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 17:09:41');
INSERT INTO `b5net_loginlog` VALUES ('504', 'ceshi', '122.192.12.232', '江苏省', 'Edge 87.0.664.66', 'OS X 10_15_7', '联通数据上网公共出口', '0', '验证码错误', '2021-02-20 17:12:40');
INSERT INTO `b5net_loginlog` VALUES ('505', 'ceshi', '122.192.12.232', '江苏省', 'Edge 87.0.664.66', 'OS X 10_15_7', '联通数据上网公共出口', '0', '验证码错误', '2021-02-20 17:12:46');
INSERT INTO `b5net_loginlog` VALUES ('506', 'ceshi', '122.192.12.232', '江苏省', 'Edge 87.0.664.66', 'OS X 10_15_7', '联通数据上网公共出口', '1', '登陆成功', '2021-02-20 17:12:56');
INSERT INTO `b5net_loginlog` VALUES ('507', 'ceshi', '183.156.103.208', '浙江省杭州市', 'Chrome 88.0.4324.182', 'OS X 10_13_6', '电信', '1', '登陆成功', '2021-02-20 17:52:45');
INSERT INTO `b5net_loginlog` VALUES ('508', 'ceshi', '119.129.253.109', '广东省广州市', 'Chrome 88.0.4324.146', 'OS X 10_15_6', '电信', '1', '登陆成功', '2021-02-20 18:13:08');
INSERT INTO `b5net_loginlog` VALUES ('509', 'ceshi', '115.221.94.175', '浙江省温州市', 'Edge 88.0.705.68', 'OS X 11_2_1', '电信', '1', '登陆成功', '2021-02-20 19:14:54');
INSERT INTO `b5net_loginlog` VALUES ('510', 'ceshi', '117.61.244.231', '江苏省宿迁市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-20 21:19:11');
INSERT INTO `b5net_loginlog` VALUES ('511', 'ceshi', '123.232.217.63', '山东省济南市', 'Chrome 78.0.3904.108', 'Windows 6.1', '联通', '0', '验证码错误', '2021-02-20 21:58:09');
INSERT INTO `b5net_loginlog` VALUES ('512', 'ceshi', '123.232.217.63', '山东省济南市', 'Chrome 78.0.3904.108', 'Windows 6.1', '联通', '0', '验证码错误', '2021-02-20 21:58:17');
INSERT INTO `b5net_loginlog` VALUES ('513', 'ceshi', '123.232.217.63', '山东省济南市', 'Chrome 78.0.3904.108', 'Windows 6.1', '联通', '0', '验证码错误', '2021-02-20 21:58:26');
INSERT INTO `b5net_loginlog` VALUES ('514', 'ceshi', '123.232.217.63', '山东省济南市', 'Chrome 78.0.3904.108', 'Windows 6.1', '联通', '1', '登陆成功', '2021-02-20 21:58:35');
INSERT INTO `b5net_loginlog` VALUES ('515', 'ceshi', '125.36.109.219', '天津市', 'Chrome 70.0.3538.25', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-21 09:42:03');
INSERT INTO `b5net_loginlog` VALUES ('516', 'ceshi', '113.118.121.234', '广东省深圳市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-21 10:42:34');
INSERT INTO `b5net_loginlog` VALUES ('517', 'ceshi', '219.133.101.245', '广东省深圳市罗湖区', 'Chrome 84.0.4147.135', 'OS X 10_15_3', '电信', '1', '登陆成功', '2021-02-21 11:52:59');
INSERT INTO `b5net_loginlog` VALUES ('518', 'ceshi', '14.217.203.255', '广东省东莞市', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-21 14:24:19');
INSERT INTO `b5net_loginlog` VALUES ('519', 'ceshi', '118.114.239.42', '四川省成都市', 'Chrome 87.0.4280.88', 'OS X 10_12_6', '电信', '1', '登陆成功', '2021-02-21 15:22:55');
INSERT INTO `b5net_loginlog` VALUES ('520', 'ceshi', '106.59.252.74', '云南省昆明市', 'Edge 88.0.705.74', 'OS X 11_2_1', '电信', '1', '登陆成功', '2021-02-21 15:45:24');
INSERT INTO `b5net_loginlog` VALUES ('521', 'ceshi', '58.242.147.157', '安徽省安庆市', 'Chrome 70.0.3538.80', 'AndroidOS 11', '联通', '0', '验证码错误', '2021-02-21 17:51:56');
INSERT INTO `b5net_loginlog` VALUES ('522', 'ceshi', '58.242.147.157', '安徽省安庆市', 'Chrome 70.0.3538.80', 'AndroidOS 11', '联通', '1', '登陆成功', '2021-02-21 17:52:03');
INSERT INTO `b5net_loginlog` VALUES ('523', 'ceshi', '39.182.24.96', '浙江省杭州市', 'Chrome 72.0.3626.81', 'Windows 6.1', '移动', '0', '验证码错误', '2021-02-21 20:44:23');
INSERT INTO `b5net_loginlog` VALUES ('524', 'ceshi', '39.182.24.96', '浙江省杭州市', 'Chrome 72.0.3626.81', 'Windows 6.1', '移动', '1', '登陆成功', '2021-02-21 20:44:32');
INSERT INTO `b5net_loginlog` VALUES ('525', 'ceshi', '117.176.205.153', '四川省成都市', 'Edge 88.0.705.74', 'Windows 10.0', '移动', '1', '登陆成功', '2021-02-21 21:11:49');
INSERT INTO `b5net_loginlog` VALUES ('526', 'ceshi', '182.242.65.140', '云南省昆明市', 'Chrome 70.0.3538.25', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-22 10:31:01');
INSERT INTO `b5net_loginlog` VALUES ('527', 'ceshi', '14.153.184.15', '广东省深圳市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '0', '验证码错误', '2021-02-22 11:25:26');
INSERT INTO `b5net_loginlog` VALUES ('528', 'ceshi', '14.153.184.15', '广东省深圳市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-22 11:25:39');
INSERT INTO `b5net_loginlog` VALUES ('529', 'ceshi', '14.153.184.15', '广东省深圳市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-22 11:26:02');
INSERT INTO `b5net_loginlog` VALUES ('530', 'ceshi', '110.184.39.100', '四川省成都市', 'Chrome 80.0.3987.87', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-22 11:32:22');
INSERT INTO `b5net_loginlog` VALUES ('531', 'ceshi', '122.224.140.154', '浙江省杭州市', 'Chrome 88.0.4324.96', 'OS X 10_13_6', '电信', '1', '登陆成功', '2021-02-22 13:58:40');
INSERT INTO `b5net_loginlog` VALUES ('532', 'ceshi', '111.75.2.80', '江西省九江市', 'Chrome 88.0.4324.150', 'Windows 6.1', '电信', '1', '登陆成功', '2021-02-22 14:22:35');
INSERT INTO `b5net_loginlog` VALUES ('533', 'ceshi', '111.75.2.80', '江西省九江市', 'Chrome 88.0.4324.150', 'Windows 6.1', '电信', '1', '登陆成功', '2021-02-22 14:49:14');
INSERT INTO `b5net_loginlog` VALUES ('534', 'ceshi', '119.39.48.24', '湖南省长沙市', 'Firefox 85.0', 'Windows 6.1', '联通', '1', '登陆成功', '2021-02-22 15:01:07');
INSERT INTO `b5net_loginlog` VALUES ('535', 'ceshi', '36.101.177.226', '海南省海口市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-22 15:07:39');
INSERT INTO `b5net_loginlog` VALUES ('536', 'ceshi', '171.83.19.98', '湖北省武汉市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-22 15:37:06');
INSERT INTO `b5net_loginlog` VALUES ('537', 'ceshi', '125.71.204.95', '四川省成都市', 'Chrome 88.0.4324.104', 'Windows 6.1', '电信', '1', '登陆成功', '2021-02-22 16:06:24');
INSERT INTO `b5net_loginlog` VALUES ('538', 'ceshi', '120.41.180.224', '福建省厦门市', 'Chrome 88.0.4324.182', 'OS X 10_15_7', '电信', '1', '登陆成功', '2021-02-22 16:50:51');
INSERT INTO `b5net_loginlog` VALUES ('539', 'ceshi', '222.187.210.38', '江苏省宿迁市', 'Edge 88.0.705.74', 'Windows 10.0', '电信', '0', '验证码错误', '2021-02-23 09:04:27');
INSERT INTO `b5net_loginlog` VALUES ('540', 'ceshi', '222.187.210.38', '江苏省宿迁市', 'Edge 88.0.705.74', 'Windows 10.0', '电信', '0', '验证码错误', '2021-02-23 09:04:36');
INSERT INTO `b5net_loginlog` VALUES ('541', 'ceshi', '222.187.210.38', '江苏省宿迁市', 'Edge 88.0.705.74', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-23 09:04:43');
INSERT INTO `b5net_loginlog` VALUES ('542', 'ceshi', '111.198.148.173', '北京市', 'Chrome 87.0.4280.88', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-23 10:37:07');
INSERT INTO `b5net_loginlog` VALUES ('543', 'ceshi', '14.105.95.135', '重庆市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-23 11:56:07');
INSERT INTO `b5net_loginlog` VALUES ('544', 'ceshi', '14.105.95.135', '重庆市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '0', '验证码错误', '2021-02-23 13:31:03');
INSERT INTO `b5net_loginlog` VALUES ('545', 'ceshi', '14.105.95.135', '重庆市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-23 13:31:10');
INSERT INTO `b5net_loginlog` VALUES ('546', 'ceshi', '101.28.220.211', '河北省邯郸市', 'Chrome 85.0.4183.83', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-23 15:53:47');
INSERT INTO `b5net_loginlog` VALUES ('547', 'ceshi', '111.9.27.179', '四川省成都市', 'Chrome 88.0.4324.150', 'OS X 11_1_0', '移动', '1', '登陆成功', '2021-02-23 16:29:10');
INSERT INTO `b5net_loginlog` VALUES ('548', 'ceshi', '183.63.148.170', '广东省广州市', 'Chrome 78.0.3904.108', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-23 16:32:52');
INSERT INTO `b5net_loginlog` VALUES ('549', 'ceshi', '183.63.148.170', '广东省广州市', 'Chrome 78.0.3904.108', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-23 16:47:53');
INSERT INTO `b5net_loginlog` VALUES ('550', 'ceshi', '58.35.215.135', '上海市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-23 18:18:22');
INSERT INTO `b5net_loginlog` VALUES ('551', 'ceshi', '111.30.122.172', '天津市', 'Chrome 78.0.3904.108', 'Windows 6.1', '移动', '1', '登陆成功', '2021-02-23 22:59:13');
INSERT INTO `b5net_loginlog` VALUES ('552', 'ceshi', '180.166.163.34', '上海市', 'Chrome 88.0.4324.146', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-24 14:24:02');
INSERT INTO `b5net_loginlog` VALUES ('553', 'ceshi', '125.92.173.186', '广东省中山市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-24 15:28:34');
INSERT INTO `b5net_loginlog` VALUES ('554', 'ceshi', '58.209.170.5', '江苏省苏州市常熟市', 'Chrome 88.0.4324.182', 'Windows 6.1', '电信', '1', '登陆成功', '2021-02-24 16:58:50');
INSERT INTO `b5net_loginlog` VALUES ('555', 'ceshi', '58.209.170.5', '江苏省苏州市常熟市', 'Chrome 88.0.4324.182', 'Windows 6.1', '电信', '1', '登陆成功', '2021-02-24 16:59:16');
INSERT INTO `b5net_loginlog` VALUES ('556', 'ceshi', '1.195.32.21', '河南省新乡市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-24 22:09:59');
INSERT INTO `b5net_loginlog` VALUES ('557', 'ceshi', '58.35.215.135', '上海市', 'Chrome 88.0.4324.190', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-25 10:34:19');
INSERT INTO `b5net_loginlog` VALUES ('558', 'ceshi', '58.35.215.135', '上海市', 'Chrome 88.0.4324.190', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-25 17:56:43');
INSERT INTO `b5net_loginlog` VALUES ('559', 'ceshi', '124.235.235.131', '吉林省长春市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登陆成功', '2021-02-27 16:49:56');
INSERT INTO `b5net_loginlog` VALUES ('560', 'ceshi', '183.209.154.208', '江苏省南京市', 'Chrome 87.0.4280.66', 'Windows 6.1', '移动', '1', '登陆成功', '2021-02-27 17:34:47');
INSERT INTO `b5net_loginlog` VALUES ('561', 'ceshi', '183.209.154.208', '江苏省南京市', 'Chrome 87.0.4280.66', 'Windows 6.1', '移动', '1', '登陆成功', '2021-02-27 17:43:01');
INSERT INTO `b5net_loginlog` VALUES ('562', 'ceshi', '112.239.41.6', '山东省枣庄市', 'Chrome 88.0.4324.190', 'Windows 10.0', '联通', '0', '验证码错误', '2021-02-28 01:25:15');
INSERT INTO `b5net_loginlog` VALUES ('563', 'ceshi', '112.239.41.6', '山东省枣庄市', 'Chrome 88.0.4324.190', 'Windows 10.0', '联通', '1', '登陆成功', '2021-02-28 01:25:20');
INSERT INTO `b5net_loginlog` VALUES ('564', 'ceshi', '183.209.154.208', '江苏省南京市', 'Chrome 87.0.4280.66', 'Windows 6.1', '移动', '1', '登陆成功', '2021-02-28 11:10:05');
INSERT INTO `b5net_loginlog` VALUES ('565', 'ceshi', '113.119.38.215', '广东省广州市', 'Chrome 88.0.4324.192', 'OS X 11_2_1', '电信', '0', '验证码错误', '2021-03-01 16:30:43');
INSERT INTO `b5net_loginlog` VALUES ('566', 'ceshi', '113.119.38.215', '广东省广州市', 'Chrome 88.0.4324.192', 'OS X 11_2_1', '电信', '0', '验证码错误', '2021-03-01 16:30:52');
INSERT INTO `b5net_loginlog` VALUES ('567', 'ceshi', '182.150.112.194', '四川省成都市', 'Chrome 88.0.4324.104', 'Windows 10.0', '电信', '0', '验证码错误', '2021-03-01 16:31:13');
INSERT INTO `b5net_loginlog` VALUES ('568', 'ceshi', '182.150.112.194', '四川省成都市', 'Chrome 88.0.4324.104', 'Windows 10.0', '电信', '1', '登陆成功', '2021-03-01 16:31:19');
INSERT INTO `b5net_loginlog` VALUES ('569', 'ceshi', '113.119.38.215', '广东省广州市', 'Chrome 88.0.4324.192', 'OS X 11_2_1', '电信', '1', '登陆成功', '2021-03-01 16:31:34');
INSERT INTO `b5net_loginlog` VALUES ('570', 'ceshi', '183.67.95.74', '重庆市', 'Chrome 75.0.3770.100', 'Windows 10.0', '电信', '1', '登陆成功', '2021-03-01 19:03:33');
INSERT INTO `b5net_loginlog` VALUES ('571', 'ceshi', '117.175.121.87', '四川省', 'Chrome 84.0.4147.125', 'Windows 10.0', '移动', '1', '登陆成功', '2021-03-02 00:23:53');
INSERT INTO `b5net_loginlog` VALUES ('572', 'ceshi', '182.200.21.207', '辽宁省沈阳市沈河区', 'Chrome 88.0.4324.190', 'Windows 10.0', '电信', '0', '验证码错误', '2021-03-02 09:57:26');
INSERT INTO `b5net_loginlog` VALUES ('573', 'ceshi', '182.200.21.207', '辽宁省沈阳市沈河区', 'Chrome 88.0.4324.190', 'Windows 10.0', '电信', '1', '登陆成功', '2021-03-02 09:57:35');
INSERT INTO `b5net_loginlog` VALUES ('574', 'ceshi', '58.35.215.135', '上海市', 'Chrome 88.0.4324.190', 'Windows 10.0', '电信', '1', '登陆成功', '2021-03-02 18:00:08');
INSERT INTO `b5net_loginlog` VALUES ('575', 'ceshi', '60.27.204.141', '天津市', 'Safari 14.0.3', 'OS X 10_15_6', '联通', '0', '验证码不正确', '2021-03-08 12:32:51');
INSERT INTO `b5net_loginlog` VALUES ('576', 'ceshi', '60.27.204.141', '天津市', 'Safari 14.0.3', 'OS X 10_15_6', '联通', '1', '登录成功', '2021-03-08 12:33:02');
INSERT INTO `b5net_loginlog` VALUES ('577', 'ceshi', '60.27.204.141', '天津市', 'Chrome 77.0.3865.120', 'AndroidOS 10', '联通', '1', '登录成功', '2021-03-08 12:42:09');
INSERT INTO `b5net_loginlog` VALUES ('578', 'ceshi', '111.225.250.28', '河北省保定市', 'Chrome 74.0.3729.131', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-08 13:44:52');
INSERT INTO `b5net_loginlog` VALUES ('579', 'ceshi', '117.173.226.245', '四川省', 'Chrome 87.0.4280.88', 'Windows 10.0', '移动', '1', '登陆成功', '2021-03-08 09:43:47');
INSERT INTO `b5net_loginlog` VALUES ('580', 'ceshi', '58.35.215.135', '上海市', 'Chrome 89.0.4389.82', 'Windows 10.0', '电信', '1', '登陆成功', '2021-03-08 10:21:24');
INSERT INTO `b5net_loginlog` VALUES ('581', 'ceshi', '61.144.173.62', '广东省深圳市宝安区', 'Chrome 88.0.4324.96', 'Windows 10.0', '/南山区电信', '1', '登陆成功', '2021-03-08 12:19:26');
INSERT INTO `b5net_loginlog` VALUES ('582', 'ceshi', '60.27.204.141', '天津市', 'Safari 14.0.3', 'OS X 10_15_6', '联通', '1', '登陆成功', '2021-03-08 12:49:10');
INSERT INTO `b5net_loginlog` VALUES ('583', 'ceshi', '118.112.74.97', '四川省成都市龙泉驿区', 'Chrome 88.0.4324.190', 'Windows 6.1', '电信', '1', '登陆成功', '2021-03-08 15:15:34');
INSERT INTO `b5net_loginlog` VALUES ('584', 'ceshi', '36.26.157.208', '浙江省', 'Edge 89.0.774.45', 'Windows 10.0', '电信', '0', '验证码错误', '2021-03-08 15:18:43');
INSERT INTO `b5net_loginlog` VALUES ('585', 'ceshi', '36.26.157.208', '浙江省', 'Edge 89.0.774.45', 'Windows 10.0', '电信', '0', '验证码错误', '2021-03-08 15:18:50');
INSERT INTO `b5net_loginlog` VALUES ('586', 'ceshi', '36.26.157.208', '浙江省', 'Edge 89.0.774.45', 'Windows 10.0', '电信', '1', '登陆成功', '2021-03-08 15:18:56');
INSERT INTO `b5net_loginlog` VALUES ('587', 'ceshi', '14.104.83.145', '重庆市', 'Chrome 88.0.4324.192', 'OS X 10_14_6', '电信', '1', '登陆成功', '2021-03-08 16:53:16');
INSERT INTO `b5net_loginlog` VALUES ('588', 'ceshi', '101.80.85.61', '上海市', 'Chrome 85.0.4183.83', 'Windows 6.1', '电信', '1', '登陆成功', '2021-03-08 18:40:38');
INSERT INTO `b5net_loginlog` VALUES ('589', 'ceshi', '61.223.237.143', '台湾省台中市', 'Chrome 88.0.4324.192', 'OS X 11_2_2', '中华电信', '1', '登陆成功', '2021-03-08 22:17:18');
INSERT INTO `b5net_loginlog` VALUES ('590', 'ceshi', '112.66.32.123', '海南省海口市', 'Chrome 89.0.4356.6', 'Windows 6.1', '电信', '1', '登陆成功', '2021-03-08 22:22:46');
INSERT INTO `b5net_loginlog` VALUES ('591', 'ceshi', '111.33.253.254', '天津市', 'Chrome 78.0.3904.108', 'Windows 6.1', '移动', '0', '验证码错误', '2021-03-08 22:31:41');
INSERT INTO `b5net_loginlog` VALUES ('592', 'ceshi', '111.33.253.254', '天津市', 'Chrome 78.0.3904.108', 'Windows 6.1', '移动', '1', '登陆成功', '2021-03-08 22:31:58');

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
INSERT INTO `b5net_role_menu` VALUES ('2', '4');
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
INSERT INTO `b5net_role_menu` VALUES ('2', '111');
INSERT INTO `b5net_role_menu` VALUES ('2', '112');
INSERT INTO `b5net_role_menu` VALUES ('2', '113');
INSERT INTO `b5net_role_menu` VALUES ('2', '114');
INSERT INTO `b5net_role_menu` VALUES ('2', '115');
INSERT INTO `b5net_role_menu` VALUES ('2', '116');
INSERT INTO `b5net_role_menu` VALUES ('2', '117');
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
INSERT INTO `b5net_role_menu` VALUES ('2', '11101');
INSERT INTO `b5net_role_menu` VALUES ('2', '11102');
INSERT INTO `b5net_role_menu` VALUES ('2', '11103');
INSERT INTO `b5net_role_menu` VALUES ('2', '11201');
INSERT INTO `b5net_role_menu` VALUES ('2', '11202');
INSERT INTO `b5net_role_menu` VALUES ('2', '11203');
INSERT INTO `b5net_role_menu` VALUES ('2', '11204');
INSERT INTO `b5net_role_menu` VALUES ('2', '11301');
INSERT INTO `b5net_role_menu` VALUES ('2', '11302');
INSERT INTO `b5net_role_menu` VALUES ('2', '11303');
INSERT INTO `b5net_role_menu` VALUES ('2', '11304');
INSERT INTO `b5net_role_menu` VALUES ('2', '11401');
INSERT INTO `b5net_role_menu` VALUES ('2', '11402');
INSERT INTO `b5net_role_menu` VALUES ('2', '11403');
INSERT INTO `b5net_role_menu` VALUES ('2', '11501');
INSERT INTO `b5net_role_menu` VALUES ('2', '11502');
INSERT INTO `b5net_role_menu` VALUES ('2', '11503');
INSERT INTO `b5net_role_menu` VALUES ('2', '11504');
INSERT INTO `b5net_role_menu` VALUES ('2', '11601');
INSERT INTO `b5net_role_menu` VALUES ('2', '11602');
INSERT INTO `b5net_role_menu` VALUES ('2', '11603');
INSERT INTO `b5net_role_menu` VALUES ('2', '11604');

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
  `website` int NOT NULL DEFAULT '0' COMMENT '鎵€灞炵珯鐐?',
  `parent_id` int NOT NULL DEFAULT '0' COMMENT '父级菜单',
  `listsort` int NOT NULL DEFAULT '0' COMMENT '显示排序',
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT 'album相册，list文章列表，page单页，link外链,',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `lang` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '语言',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '外链地址',
  `template_list` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '列表模板',
  `template_info` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '详情模板',
  `checkcode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '选中菜单的标识',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='网站-菜单分类';

-- ----------------------------
-- Records of b5net_web_cat
-- ----------------------------
INSERT INTO `b5net_web_cat` VALUES ('1', '企业简介', '企业简介', '1', '0', '0', 'page', '1', '', '', '', '', 'jianjie', '2021-02-25 16:05:58', '2021-03-05 13:25:59');
INSERT INTO `b5net_web_cat` VALUES ('2', '产品展示', '产品展示', '1', '0', '1', 'none', '1', '', '', '', '', 'goods', '2021-02-25 16:08:10', '2021-03-05 13:26:53');
INSERT INTO `b5net_web_cat` VALUES ('3', '联系我们', '联系我们', '1', '0', '4', 'page', '1', '', '', '', '', 'aboutus', '2021-02-25 16:09:06', '2021-03-05 13:43:51');
INSERT INTO `b5net_web_cat` VALUES ('4', '服务范围', '服务范围', '1', '0', '3', 'link', '1', '', 'http://www.b5net.com', '', '', 'fuwu', '2021-02-25 16:12:30', '2021-03-05 16:51:46');
INSERT INTO `b5net_web_cat` VALUES ('5', 'PE塑胶管', 'PE塑胶管', '1', '2', '0', 'goods', '1', '', '', '', '', 'goods', '2021-02-25 16:14:54', '2021-03-05 13:26:14');
INSERT INTO `b5net_web_cat` VALUES ('7', '新闻资讯', '新闻资讯', '1', '0', '2', 'list', '1', '', '', '', '', 'news', '2021-03-01 09:25:15', '2021-03-05 13:26:31');
INSERT INTO `b5net_web_cat` VALUES ('9', 'PVC塑胶管', 'PVC塑胶管', '1', '2', '2', 'goods', '1', '', '', '', '', 'goods', '2021-03-04 17:23:53', '2021-03-05 13:26:25');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='网站-信息列表';

-- ----------------------------
-- Records of b5net_web_list
-- ----------------------------
INSERT INTO `b5net_web_list` VALUES ('3', 'PE穿线管', '', '1', '', '', '/uploads/weblist/2021/03/05/6b1c444d414becb88d5875b34447cb24.jpg', '5', '1', '0', '', '2021-03-01 16:34:53', '2021-03-05 11:39:17', '2021-03-05 11:38:02');
INSERT INTO `b5net_web_list` VALUES ('4', '全市民营经济统战工作会议召开', '3月4日上午，全市民营经济统战工作会议召开。市委书记王安德出席会议并讲话，市委副书记、市长孟庆斌主持。', '1', '临沂日报', '临沂日报', '/uploads/weblist/2021/03/05/50a2e7b0d034aa665eb104a565bfa8e2.jpg', '7', '1', '0', '', '2021-03-03 14:21:00', '2021-03-05 14:24:35', '2021-03-05 14:24:31');
INSERT INTO `b5net_web_list` VALUES ('5', '企业简介', '', '1', '', '', '', '1', '1', '0', '', '2021-03-04 17:34:50', '2021-03-05 13:45:02', '2021-03-05 13:44:57');
INSERT INTO `b5net_web_list` VALUES ('7', 'PVC-M给水管', '', '1', '', '', '/uploads/weblist/2021/03/05/ca174243017980aff0e5057b0e62326a.jpg', '9', '1', '0', '', '2021-03-05 11:32:01', '2021-03-05 11:32:01', '2021-03-05 11:26:49');
INSERT INTO `b5net_web_list` VALUES ('8', 'PVC-U给水管', '', '1', '', '', '/uploads/weblist/2021/03/05/b492a9964eef0b249eb8bf40518f63ee.jpg', '9', '1', '0', '', '2021-03-05 11:34:51', '2021-03-05 11:34:51', '2021-03-05 11:32:48');
INSERT INTO `b5net_web_list` VALUES ('9', 'PVC雨水管道', '', '1', '', '', '/uploads/weblist/2021/03/05/4a979db00e37757190a5ef25505e6032.jpg', '9', '1', '0', '', '2021-03-05 11:36:06', '2021-03-05 11:36:06', '2021-03-05 11:35:34');
INSERT INTO `b5net_web_list` VALUES ('10', 'PE农田灌溉管', '', '1', '', '', '/uploads/weblist/2021/03/05/1725a2e8c1153283d96befd516dcf59c.jpg', '5', '1', '0', '', '2021-03-05 11:42:27', '2021-03-05 11:42:27', '2021-03-05 11:40:32');
INSERT INTO `b5net_web_list` VALUES ('11', 'PE螺旋波纹管', '', '1', '', '', '/uploads/weblist/2021/03/05/924bcaa62f33f36c51143b3d8c7de62e.jpg', '5', '1', '0', '', '2021-03-05 11:44:21', '2021-03-05 11:44:21', '2021-03-05 11:43:19');
INSERT INTO `b5net_web_list` VALUES ('12', '联系我们', '', '1', '', '', '', '3', '1', '0', '', '2021-03-05 13:43:31', '2021-03-05 13:50:46', '2021-03-05 13:50:34');
INSERT INTO `b5net_web_list` VALUES ('13', '我市中小学、幼儿园如期开学   寒假，再见！新学期，你好!', '安静了月余的校园，再现朗朗读书声。3月1日，临沂市中小学、幼儿园分批、错时错峰，如期开学，让校园重现往日生机。', '1', '沂蒙晚报', '沂蒙晚报', '/uploads/weblist/2021/03/05/70db3bb4799fcce6ed970d773ba44d49.jpg', '7', '1', '0', '', '2021-03-05 14:24:26', '2021-03-05 14:24:26', '2021-03-02 14:23:27');
INSERT INTO `b5net_web_list` VALUES ('14', '舞狮闹新春', '', '1', '新华社', '新华社', '/uploads/weblist/2021/03/05/0fa247d4c6b7724d2b4a09da59b169a3.jpg', '7', '1', '0', '', '2021-03-05 14:25:55', '2021-03-05 14:26:15', '2021-02-18 14:26:05');

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
INSERT INTO `b5net_web_list_ext` VALUES ('3', '<p>&nbsp; &nbsp; &nbsp; &nbsp;PE管是以聚乙烯树脂为主要原料，加入适当助剂，经挤出方式加工成型，具有耐腐蚀、抗冲击、抗老化、强度高、易弯曲、施工便捷等特点。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">&nbsp; &nbsp; &nbsp; &nbsp;可广泛用于室外通信电缆和光缆的护套管道系统，包括局间中继管道、馈线管道、配线管道和专用网管道以及特殊规定的长途通信管道。具有很强的适用型，适合电缆、电线等诸多线缆的穿放。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　*执行标准：GB/T13663-2000</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　盘管（100米，200米，300米）</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　穿线索主要型号：32405063</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　*颜色：白色、红色、也可是用户指定的其它颜色。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">（1）优异的物理性能采用优良聚乙烯原料生产。既具有良好的刚性、强度、也有很好的柔性。既可以采用接套连接，又可以采用热熔对接。施工简便，有利于管道的安装。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（2）耐腐蚀，使用寿命长。在沿海地区，地下水位偏高，土地湿度大。使用金属或其它管道须防腐，且寿命一般只有30年，而PE管材可耐多种化学介质，不受土壤腐蚀的影响。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（3）韧性、挠度好。PE管材是一种高韧性管材，其断裂伸长率超过500％。对基础不均匀的地面沉降和错位的适应能力非常强。抗震性好。小口径管材可任意弯曲。（PE穿线管厂家如何选择）</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（4）管壁光滑，摩擦系数小，穿缆容易，施工效率高，施工成本低。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（5）电绝缘性能好，使用寿命长（地埋管寿命五十年以上），经久耐用，线路运行安全可靠。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（6）重量轻，维修、安装施工、保养方便，易于运输及操作。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（7）小口径管材可采用盘管形式，管段长，接头少，安装简便。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（8）管材可做成多种颜色，以示区分。（如何选择PE管）</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（9）低温抗冲性能优异。PE的低温脆化温度较低，可在-20～60℃温度范围内安全使用。冬季施工时因材料冲击性好，不会发生管子脆裂。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（10）耐磨性好。PE管与其它金属管材相比，耐磨性是金属管的4倍。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（11）多种全新的施工方式。PE管除了传统的开挖方式进行施工外，还可以采用多种全新的非开挖技术，如顶管，衬管，裂管等方式施工，这对于一些不允许开挖的场所，是好的选择。</p><p><br></p>', '/uploads/weblist/2021/03/05/6b1c444d414becb88d5875b34447cb24.jpg', '1', '5');
INSERT INTO `b5net_web_list_ext` VALUES ('4', '<div>3月4日上午，全市民营经济统战工作会议召开。市委书记王安德出席会议并讲话，市委副书记、市长孟庆斌主持。</div><div>王安德指出，临沂是民营经济大市，民营市场主体是推动经济社会发展的重要力量。全市各级各部门要深入学习贯彻习近平总书记关于新时代民营经济统战工作重要指示精神，坚持“两个毫不动摇”“三个没有变”，扎实做好民营经济统战工作，促进民营经济高质量发展。</div><div>王安德强调，要强化政治引领，进一步促进民营经济人士健康成长。着力巩固扩大政治共识，自觉用习近平新时代中国特色社会主义思想武装头脑、指导实践；着力深化理想信念教育，不断增强政治认同、思想认同、理论认同、情感认同；着力加强民营企业党建工作，教育引导民营经济人士树牢“四个意识”、坚定“四个自信”、做到“两个维护”。</div><div>王安德要求，要主动担当作为，进一步推动民营经济高质量发展。持续优化营商环境，抓好政策落实、政务服务、法治环境建设；健全政企沟通协商机制，坚持开门决策，构建“亲”“清”政商关系，引导民营经济人士发挥作用；坚决防范化解债务风险和安全生产风险，推动企业持续健康发展。</div><div>王安德强调，要加强党的领导，进一步凝聚民营经济统战工作合力。完善体制机制，明确职责、密切配合，引导民营企业规范有序发展；坚持重心下移、力量下沉，推动基层民营经济统战工作扎实开展；提升服务本领，加强教育培训，提升民营经济统战干部队伍整体素质，不断开创全市民营经济统战工作新局面。</div><div>孟庆斌在主持讲话时强调，全市各级各部门要提高政治站位，充分认识坚持基本经济制度的极端重要性，毫不动摇地鼓励、支持、引导非公有制经济发展。要结合党史学习教育，引导民营经济人士坚定理想信念，始终与党委政府同心同德，做爱国敬业、守法经营、创业创新、回报社会的典范。要用心搞好服务，深化“放管服”改革，坚持国企、民企一视同仁，推行全生命周期服务，用好政策落实、问题解决“两张清单”，做到“企业需要时、政府无处不在，企业不需要时、政府无声无息”。要形成工作合力，强化工作统筹、政策统筹、力量统筹，推动民营经济统战工作再上新水平，为加快临沂“由大到强、由美到富、由新到精”战略性转变贡献力量。</div><div>会上，传达了习近平总书记关于新时代民营经济统战工作的重要指示精神，学习了全国、全省民营经济统战工作会议要求，兰山区、市工信局、翔宇实业集团负责同志作了发言。</div><div>会议采取视频形式，市里设主会场，各县区设分会场。市领导边峰、侯晓滨、王晓嫚在主会场参加会议。</div>', '/uploads/weblist/2021/03/05/50a2e7b0d034aa665eb104a565bfa8e2.jpg', '1', '7');
INSERT INTO `b5net_web_list_ext` VALUES ('5', '<div>1、公司概况：这里面可以包括注册时间，注册资本，公司性质，技术力量，规模，员工人数，员工素质等;</div><div>2、公司发展状况:公司的发展速度,有何成绩,有何荣誉称号等;</div><div>3、公司文化:公司的目标,理念,宗旨,使命,愿景,寄语等;</div><div>4、公司主要产品:性能,特色,创新,超前;</div><div>5、销售业绩及网络:销售量,各地销售点等;</div><div>6、售后服务:主要是公司售后服务的承诺。</div><div><br></div><div>以上几个点都是重要的因素。</div><div><br></div><div>拓展资料：</div><div>一、公司的定义：</div><div>公司是依照公司法在中国境内设立的有限责任公司和股份有限公司，是以营利为目的的企业法人。它是适应市场经济社会化大生产的需要而形成的一种企业组织形式。</div><div><br></div><div>二、公司的类型：</div><div>1、无限责任公司</div><div><br></div><div>是指全体股东对公司债务承担无限连带清偿责任的公司。</div><div>2、有限责任公司</div><div>是指公司全体股东对公司债务仅以各自的出资额为限承担责任的公司。</div><div><br></div><div><br></div><div>3、两合公司</div><div>是指公司的一部分股东对公司债务承担无限连带责任，另一部分股东对公司债务仅以出资额为限承担有限责任的公司。</div><div><br></div><div>4、股份有限公司</div><div>是指公司资本划分为等额股份，全体股东仅以各自持有的股份额为限对公司债务承担责任的公司。</div><div><br></div><div>5、股份两合公司</div><div>是指公司资本划分为等额股份，一部分股东对公司债务承担无限连带责任，另一部分股东对公司债务仅以其持有的股份额为限承担责任的公司。</div>', '', '1', '1');
INSERT INTO `b5net_web_list_ext` VALUES ('7', '<p>&nbsp; &nbsp; &nbsp; &nbsp; 高抗冲聚氯乙烯（PVC-M）环保给水管是以PVC树脂粉为主材料，添加抗冲改性剂，通过先进的加工工艺挤出成型的兼有高强度及高韧性的高性能新型管道。产品执行行业标准CJ/T272-2008，性能优异。此管道在国外已成熟，并广泛推广应用。</p><p><br></p><p>&nbsp; &nbsp; &nbsp; &nbsp; 抗冲改性剂的添加在保持PVC-U管道高强度的同时增加了材料的延展性，从而使得产品具有良好的韧性，增强了管道的安全性和环境适应性。产品兼有了PVC-U管简易的连接方式、平直性等优点和PE管的高抗冲性能，是综合性能优异的管道。</p><p><br></p><p><b>高抗冲PVC-M环保给水管主要特点</b></p><p><br></p><p>1、质量轻，便于运输与安装。由于原料进行了高抗冲改性，在同等压力下，PVC-M管壁厚更小，质量也更轻。</p><p><br></p><p>2、良好的刚度和韧性。PVC-M管材在保持PVC-U管材的弹性模量的同时，提高了管材的柔韧性，抗冲击性能优异，能抵抗外界冲击，环境适应性强。耐环境开裂性能的提高能有效抵抗安装和运输过程中对管材的外力冲击。与同规格的普通PVC-U管材相比，抗冲击性能显著提高，能更有效地抵抗点载荷和地基不均匀沉降。</p><p><br></p><p>3、卫生环保，没有污染，保证输水水质，不结垢，不滋生细菌。管道使用无铅配方生产，卫生性能符合GB/T17219-1998安全性评价标准规定以及国家卫生部相关的卫生安全评价规定。</p><p><br></p><p>4、连接方式简便可靠。产品使用简单易行的胶粘剂粘接或弹性密封圈连接，安装简易牢固。</p><p><br></p><p>5、管道运行、维护成本更低。产品壁厚小，管道流径大，节能低耗。PVC-M管材的水力坡降值小于PVC-U管材，在出厂水压相同时，在管网相同的地点上用户水压相对较高，可以保证更多用户对水压的要求，且常年运行费用大大降低。产品韧性的提高，提升了管道抗水锤能力，杜绝管线在运行过程中的破坏，减少管道维护成本。</p><p><br></p><p>6、耐腐蚀，使用寿命长。耐化学腐蚀性能强，可用于任何适用于普通PVC-U管道的场合。在正常使用条件下，使用寿命在50年以上。</p>', '/uploads/weblist/2021/03/05/ca174243017980aff0e5057b0e62326a.jpg', '1', '9');
INSERT INTO `b5net_web_list_ext` VALUES ('8', '<p>&nbsp; &nbsp; &nbsp; &nbsp; UPVC管是一种以聚氯乙烯（PVC）树脂为质料，不含增塑剂的塑料管材。随着化学工业技术的开展，现能够出产无毒级的管材，所以它具有通常聚氯乙烯的功能，又增加了一些优良功能，具体来说它具有耐腐蚀性和柔软性好的长处，因此格外适用于供水管网。因为它不导电，因此不容易与酸、碱、盐发作电化学反响，酸、碱、盐都难于腐蚀它，所以不需要外防腐涂层和内衬。而柔软性好这又克服了曩昔塑料管脆性的缺陷，在荷载作用下能发生屈从而不发作决裂。</p><p><br></p><p>1、自来水配管工程（包括室内供水和室外市政水管），由于Upvc塑料管具有耐酸碱、耐腐蚀、不生锈、不结垢、保护水质、避免水次污染的优点，在大力提倡生产环保产品的今天，作为一种保护人类健康的理想“绿色建材”，已被中国乃至全球广泛推广应用。</p><p><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">2、节水灌溉配管工程，Upvc喷滴灌溉系统的使用与普通灌溉相比，可节水50％－70％，同时可节约肥料和农药用量，农作物产量可提高30％－80％。在中国水资源缺乏、农业生产灌溉方式落后的今天，这对促进中国节水农业生产发展有着较大的社会效益。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">3、建筑用配管工程。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><span style=\"color: inherit;\"><br></span></p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><span style=\"color: inherit;\">4、Upvc塑料管具有优异的绝缘能力，还广泛用作邮电通讯电缆导管。</span><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">5、Upvc塑料管耐酸碱、耐腐蚀，许多化工厂用作输液配管。其他还用于凿井工程、医药配管工程、矿物盐水输送配管工程、电气配管工程等。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">&nbsp; &nbsp; &nbsp; &nbsp; UPVC管的韧性是非常关键的指标。韧性大的管当我们将其锯成窄条后，试着折180°，如果一折就断，说明韧性很差，脆性大；如果很难折断，说明有韧性，而且在折时越需要费力才能折断的管材，强度很好，韧性一般不错。结尾可观察断茬（锯的茬口除外），茬口越细腻，说明管材均化性、强度和韧性越好。 UPVC管的抗冲击性，也可用简单的办法做宏观的大致的判断。可选择室温接近20℃的环境，将锯成200mm长的管段（对110mm管），用铁锤猛击，好的管材，用人力很难一次击破。（管越粗，承力越大）<br></p><p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Microsoft YaHei&quot;; font-size: 14px; word-spacing: 10px;\"><br></span></p>', '/uploads/weblist/2021/03/05/b492a9964eef0b249eb8bf40518f63ee.jpg', '1', '9');
INSERT INTO `b5net_web_list_ext` VALUES ('9', '', '/uploads/weblist/2021/03/05/4a979db00e37757190a5ef25505e6032.jpg,/uploads/weblist/2021/03/05/a117db1348d657b10948ad808c440984.jpg', '1', '9');
INSERT INTO `b5net_web_list_ext` VALUES ('10', '<p style=\"margin-top: 5px; margin-bottom: 5px;\">大棚pe灌溉管，PE农田灌溉管的连接：</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　1．电热熔接性：采用专用电热熔焊机将直管与直管、直管与管件连接起来。一般多用于160mm以下管。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　2．热熔对接连接：采用专用的对接焊机管道连接起来，一般多用于160mm以上管。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　3．钢塑连接：可采用法兰、螺纹丝扣等方法连接。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">大棚灌溉管，PE农田灌溉管管验收：</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　①接收PE聚乙烯管材、管件须进行验收。先验收产品使用说明书、产品合格证、质量保证书和各项性能检验验收报告等有关资料。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　②验收PE聚乙烯管材、管件时，应在同一批中抽样，并按现行国家标准《给水用(PE)聚乙烯材》进行规格尺寸和外观性能检查，必要时宜进行测试。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　③农业灌溉聚乙烯管具有重量轻、水流阻力小、耐腐蚀、不易滋生微生物、安装简便迅速、造价低、寿命长、具有保温功能等。</p>', '/uploads/weblist/2021/03/05/1725a2e8c1153283d96befd516dcf59c.jpg', '1', '5');
INSERT INTO `b5net_web_list_ext` VALUES ('11', '<p>&nbsp; &nbsp; &nbsp; &nbsp;钢带增强PE螺旋波纹管是指以高密度聚乙烯(PE)为基体，用表面涂敷粘接树脂的钢带成型为波形作为主要支撑结构，并与聚乙烯材料缠绕复合成整体的双壁螺旋波纹管称之为钢带增强PE螺旋波纹管。</p><p><br></p><p>&nbsp; &nbsp; &nbsp; &nbsp;管材可使用热熔挤出焊接连接、热收缩管(带)连接、卡箍（哈夫套）连接和电熔带连接等连接方式。必要时可以结合应用两种连接方式。</p><p><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">&nbsp; &nbsp; &nbsp; &nbsp;1、钢带增强PE螺旋波纹管管材管件的内外壁光滑，摩擦系数小。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　2、钢带增强PE螺旋波纹管抗压性能高：能承受750N以上压力，故可以明装也可暗敷于混凝土内，不会受压破坏。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　3、钢带增强PE螺旋波纹管抗冲、耐热性能好：套管在混凝土浇注过程中，受到正常的捣固冲击不会破裂，且在施工过程中受到凝结热作用不变软。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　4、钢带增强PE螺旋波纹管防潮耐酸碱：防潮耐酸碱性能优良，不会锈蚀，各连接处按规定用PVC粘合剂粘接，可防水渗进管内，防潮效果更佳。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　5、钢带增强PE螺旋波纹管离火自熄，火焰不会沿着管道蔓延。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　6、套管有优良绝缘性能，在浸水状态下AC2000V、50Hz不会击穿。在防止意外触电方面，国际上趋向于绝缘比接地好，而PVC套管正满足这个要求。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　7、因钢带增强PE螺旋波纹管中添加了特种助剂，不会发出气味，吸引虫鼠咬噬破坏。</p><p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Microsoft YaHei&quot;; font-size: 18px; word-spacing: 10px;\"><br></span></p>', '/uploads/weblist/2021/03/05/924bcaa62f33f36c51143b3d8c7de62e.jpg', '1', '5');
INSERT INTO `b5net_web_list_ext` VALUES ('12', '<p>地址：XXXXXXXXXXXXXXXXXX</p><p><br></p><p>电话：XXXXXXXXX</p><p><br></p><p>邮箱：357145480@qq.com</p>', '', '1', '3');
INSERT INTO `b5net_web_list_ext` VALUES ('13', '<div>安静了月余的校园，再现朗朗读书声。3月1日，临沂市中小学、幼儿园分批、错时错峰，如期开学，让校园重现往日生机。</div><div><br></div><div>“寒假再见，新学期你好。”迎着蒙蒙细雨，“神兽们”背着书包、佩戴口罩、拎着水杯，与家长挥手道别，信步走进久违的校园。“终于盼到开学了！一个假期在家太无聊了。”临沂杏园小学5年级的张同学笑着说，他更喜欢与同学和老师朝夕相处的日子，特别迫切地希望早点见到他们。</div><div><br></div><div>升旗仪式，开学典礼，开学第一课……齐聚校园广场，平邑县地方镇中小学大泉校区进行新学期第一次升旗仪式，师生齐唱国歌，荡气回肠，让校园焕发出新生机；站在2021年的新起点上，兰陵县向城镇中心小学各班级通过PPT课件开启了开学第一课，点燃希望，再次出发，迎接新学期的到来；临沂佳和小学认真组织，上好开学第一课，传达有关疫情防控及学校一日常规要求，学生们认真听讲，展现佳和学子风貌……</div><div><br></div><div>为了迎接“神兽”返校，开学之前，临沂大部分中小学、幼儿园已提前做好准备，将学校、教室装扮一新。窗明几净的教室，摆放有序的桌子，静等“神兽们”的归来。临沂沂龙湾小学门口，红色的拱形门上写着，“开学啦，属我最牛！”还有教职工穿着玩偶装扮，特意迎接“神兽”返校。</div><div><br></div><div>如何帮助学生快速实现假期模式与学校模式的转换呢？临沂市第三中学于3月1日上午面向学生开展心理健康第一课。课堂上，心理老师鼓励学生复盘假期，畅谈开学后的心情与感受，引导学生平稳度过适应期，帮助学生提升情绪管理的能力，以更饱满、更高效的状态投入到学习中。</div><div><br></div><div>“神兽”返校离不开大家的守护，交警部门疏导交通，确保交通秩序井然，让学生安全返校。各学校的家长志愿者也成为开学首日一道亮丽的风景线，临沂第三实验小学的家长志愿们身穿荧光色马甲，早早出现在学校门口，随时准备提供帮助，助力学生返校。</div><div><br></div><div>根据疫情防控的相关要求，开学后，各学校要全面把控所有进出校园通道，实行校园相对封闭管理，做到专人负责、区域划分合理、人员登记排查记录齐全。工作人员和来访人员佩戴口罩,对进出人员监测体温。坚持入校登记制度，校外无关人员一律不准进校，师生员工进校门需核验身份并监测体温。入校时若出现发热、干咳、咽痛、嗅（味）觉减退、腹泻等疑似症状，应当由专人带至临时等候区，测量体温，及时联系学生家长，按规定流程处置。</div>', '/uploads/weblist/2021/03/05/70db3bb4799fcce6ed970d773ba44d49.jpg', '1', '7');
INSERT INTO `b5net_web_list_ext` VALUES ('14', '<div>近日，山东省临沂市沂南县铜井镇竹泉村的村民在民俗活动中表演舞狮。</div><div><br></div><div>春节期间，人们用丰富多彩的方式度过假期。&nbsp;</div>', '/uploads/weblist/2021/03/05/0fa247d4c6b7724d2b4a09da59b169a3.jpg', '1', '7');

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
  `template` varchar(30) COLLATE utf8mb4_general_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='网站-站点管理';

-- ----------------------------
-- Records of b5net_web_site
-- ----------------------------
INSERT INTO `b5net_web_site` VALUES ('1', 'test1', '测试站点11', 'XXXXX公司', '1', '2021-02-25 10:50:08', '2021-03-02 10:48:47', '1', '');
INSERT INTO `b5net_web_site` VALUES ('3', 'test2', '测试站点2', '中国XXXXX有限公司', '1', '2021-03-09 09:17:53', '2021-03-09 09:17:53', '0', '');

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
