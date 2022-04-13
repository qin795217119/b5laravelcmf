/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : b5laravel9cmf

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2022-04-13 16:39:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `b5net_admin`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin`;
CREATE TABLE `b5net_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '登录名',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '登录密码',
  `realname` varchar(30) NOT NULL DEFAULT '' COMMENT '人员姓名',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `note` varchar(255) DEFAULT '' COMMENT '备注',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10010 DEFAULT CHARSET=utf8mb4 COMMENT='管理员表';

-- ----------------------------
-- Records of b5net_admin
-- ----------------------------
INSERT INTO `b5net_admin` VALUES ('10000', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '超管', '1', '超级管理员', '2020-12-24 10:50:56', '2022-04-13 05:49:00');
INSERT INTO `b5net_admin` VALUES ('10007', 'test', 'e10adc3949ba59abbe56e057f20f883e', 'test', '1', '', '2022-03-19 23:55:46', '2022-03-21 17:04:49');

-- ----------------------------
-- Table structure for `b5net_admin_pos`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin_pos`;
CREATE TABLE `b5net_admin_pos` (
  `admin_id` int(11) NOT NULL COMMENT '用户ID',
  `pos_id` int(11) NOT NULL COMMENT '职位ID',
  UNIQUE KEY `admin_id` (`admin_id`,`pos_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='用户和职位关联表';

-- ----------------------------
-- Records of b5net_admin_pos
-- ----------------------------
INSERT INTO `b5net_admin_pos` VALUES ('10000', '1');
INSERT INTO `b5net_admin_pos` VALUES ('10007', '2');

-- ----------------------------
-- Table structure for `b5net_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin_role`;
CREATE TABLE `b5net_admin_role` (
  `admin_id` int(11) NOT NULL COMMENT '用户ID',
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  UNIQUE KEY `admin_id` (`admin_id`,`role_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户和角色关联表';

-- ----------------------------
-- Records of b5net_admin_role
-- ----------------------------
INSERT INTO `b5net_admin_role` VALUES ('10000', '1');
INSERT INTO `b5net_admin_role` VALUES ('10007', '3');

-- ----------------------------
-- Table structure for `b5net_admin_struct`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin_struct`;
CREATE TABLE `b5net_admin_struct` (
  `admin_id` int(11) NOT NULL COMMENT '用户ID',
  `struct_id` int(11) NOT NULL COMMENT '组织ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户与组织架构关联表';

-- ----------------------------
-- Records of b5net_admin_struct
-- ----------------------------
INSERT INTO `b5net_admin_struct` VALUES ('10007', '104');
INSERT INTO `b5net_admin_struct` VALUES ('10000', '100');

-- ----------------------------
-- Table structure for `b5net_config`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_config`;
CREATE TABLE `b5net_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` varchar(30) NOT NULL DEFAULT '' COMMENT '配置标识',
  `style` varchar(10) NOT NULL DEFAULT '' COMMENT '配置类型',
  `is_sys` char(1) NOT NULL DEFAULT '0' COMMENT '是否系统内置 0否 1是',
  `groups` varchar(50) DEFAULT '' COMMENT '配置分组',
  `value` text COMMENT '配置值',
  `extra` varchar(255) DEFAULT '' COMMENT '配置项',
  `note` varchar(255) DEFAULT '' COMMENT '配置说明',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COMMENT='系统配置表';

-- ----------------------------
-- Records of b5net_config
-- ----------------------------
INSERT INTO `b5net_config` VALUES ('1', '配置分组', 'sys_config_group', 'array', '1', '', 'site:基本设置\r\nwx:微信设置\r\nsms:短信配置\r\nemail:邮箱配置\r\nimgwater:图片水印', '', '', '2020-12-31 14:01:18', '2022-03-22 20:45:21');
INSERT INTO `b5net_config` VALUES ('2', '系统名称', 'sys_config_sysname', 'text', '1', 'site', 'B5LaravelCMF', '', '系统后台显示的名称', '2020-12-31 14:01:18', '2022-04-13 07:27:31');
INSERT INTO `b5net_config` VALUES ('4', '阿里accessKeyId', 'sms_ali_key', 'text', '0', 'sms', '', '', '阿里短信-AccessKey ID', '2021-01-11 19:26:13', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES ('5', '阿里accessSecret', 'sms_ali_secret', 'text', '0', 'sms', '', '', '阿里短信-AccessKey Secret', '2021-01-11 19:26:45', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES ('6', '阿里signName', 'sms_ali_signname', 'text', '0', 'sms', '', '', '阿里短信-签名', '2021-01-11 19:27:53', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES ('7', '阿里tempId', 'sms_ali_temp', 'text', '0', 'sms', '', '', '阿里短信-tempId模板', '2021-01-11 19:30:21', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES ('10', '公众号appid', 'wechat_appid', 'text', '0', 'wx', 'wx2dbcd1ebf29bd18f', '', '微信公众号的AppId', '2021-01-12 11:05:50', '2021-03-27 23:06:59');
INSERT INTO `b5net_config` VALUES ('11', '公众号secret', 'wechat_appsecret', 'text', '0', 'wx', '8f2ea486cf4182ba9211d26cdb7c343a', '', '微信公众号-AppSecret', '2021-01-12 11:06:24', '2021-03-27 23:06:59');
INSERT INTO `b5net_config` VALUES ('12', '服务地址', 'sys_email_host', 'text', '0', 'email', 'smtp.163.com', '', '类似:smtp.163.com', '2021-01-22 15:28:10', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES ('13', '邮箱地址', 'sys_email_username', 'text', '0', 'email', 'lyyd_lh@163.com', '', '发送邮件的邮箱地址', '2021-01-22 15:28:39', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES ('14', '授权密码', 'sys_email_password', 'text', '0', 'email', 'UCSMPMHNDJSALQVW', '', '', '2021-01-22 15:29:34', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES ('15', '服务端口', 'sys_email_port', 'text', '0', 'email', '465', '', '', '2021-01-22 15:30:05', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES ('16', '是否SSL', 'sys_email_ssl', 'select', '0', 'email', '1', '0:否\r\n1:是', '', '2021-01-22 15:31:23', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES ('17', '网站标题', 'web_site_name', 'text', '0', 'site', 'XXXXXX公司', '', '', '2021-03-24 15:09:24', '2022-03-21 16:28:31');
INSERT INTO `b5net_config` VALUES ('18', '水印文字', 'img_water_text', 'text', '0', 'imgwater', 'B5YiiCMF', '', '', '2021-07-29 20:44:32', '2022-03-21 13:26:25');
INSERT INTO `b5net_config` VALUES ('19', '水印文字大小', 'img_water_text_font', 'text', '0', 'imgwater', '20', '', '', '2021-07-29 20:44:48', '2022-03-21 13:26:25');
INSERT INTO `b5net_config` VALUES ('20', '水印文字颜色', 'img_water_text_color', 'text', '0', 'imgwater', 'ff0000', '', '', '2021-07-29 20:45:03', '2022-03-21 13:26:25');
INSERT INTO `b5net_config` VALUES ('21', '水印位置', 'img_water_text_position', 'select', '0', 'imgwater', '1', '1:左上角\r\n3:右上角\r\n5:垂直水平居中\r\n7:左下角\r\n9:右下角', '对应think-image的水印位置 1-9', '2021-07-29 20:45:28', '2022-03-21 13:26:25');
INSERT INTO `b5net_config` VALUES ('22', '是否演示模式', 'demo_mode', 'select', '0', '', '1', '1:是\r\n0:否', '', '2022-03-21 16:17:48', '2022-03-21 16:17:48');

-- ----------------------------
-- Table structure for `b5net_loginlog`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_loginlog`;
CREATE TABLE `b5net_loginlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '访问ID',
  `login_name` varchar(50) DEFAULT '' COMMENT '登录账号',
  `ipaddr` varchar(50) DEFAULT '' COMMENT '登录IP地址',
  `login_location` varchar(255) DEFAULT '' COMMENT '登录地点',
  `browser` varchar(100) DEFAULT '' COMMENT '浏览器类型',
  `os` varchar(100) DEFAULT '' COMMENT '操作系统',
  `net` varchar(50) DEFAULT '',
  `status` char(1) DEFAULT '0' COMMENT '登录状态（0成功 1失败）',
  `msg` varchar(255) DEFAULT '' COMMENT '提示消息',
  `create_time` datetime DEFAULT NULL COMMENT '访问时间',
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COMMENT='系统访问记录';

-- ----------------------------
-- Records of b5net_loginlog
-- ----------------------------

-- ----------------------------
-- Table structure for `b5net_menu`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_menu`;
CREATE TABLE `b5net_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父菜单ID',
  `listsort` int(11) NOT NULL DEFAULT '0' COMMENT '显示顺序',
  `url` varchar(200) NOT NULL DEFAULT '' COMMENT '请求地址',
  `target` tinyint(1) NOT NULL DEFAULT '0' COMMENT '打开方式（0页签 1新窗口）',
  `type` char(1) NOT NULL DEFAULT '' COMMENT '菜单类型（M目录 C菜单 F按钮）',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '菜单状态（1显示 0隐藏）',
  `is_refresh` char(1) DEFAULT '0' COMMENT '是否刷新（0不刷新 1刷新）',
  `perms` varchar(100) DEFAULT '' COMMENT '权限标识',
  `icon` varchar(100) DEFAULT '' COMMENT '菜单图标',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`) USING BTREE,
  KEY `listsort` (`listsort`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15205 DEFAULT CHARSET=utf8mb4 COMMENT='菜单权限表';

-- ----------------------------
-- Records of b5net_menu
-- ----------------------------
INSERT INTO `b5net_menu` VALUES ('1', '系统管理', '0', '10', '', '0', 'M', '1', '0', '', 'fa fa-cog', '2021-01-03 07:25:11', '2022-03-20 16:00:14', '系统管理');
INSERT INTO `b5net_menu` VALUES ('2', '权限管理', '0', '20', '', '0', 'M', '1', '0', '', 'fa fa-id-card-o', '2021-01-03 07:25:11', '2022-03-20 16:00:10', '权限管理');
INSERT INTO `b5net_menu` VALUES ('3', '系统工具', '0', '30', '', '0', 'M', '1', '0', '', 'fa fa-cloud', '2021-07-29 20:28:41', '2022-03-20 15:59:55', '');
INSERT INTO `b5net_menu` VALUES ('90', '官方网站', '0', '99', 'http://www.b5net.com', '1', 'C', '1', '0', '', 'fa fa-send', '2021-01-05 12:05:30', '2021-01-18 17:07:15', '官方网站');
INSERT INTO `b5net_menu` VALUES ('100', '人员管理', '2', '1', 'system/admin/index', '0', 'C', '1', '0', 'system:admin:index', 'fa fa-user-o', '2021-01-03 07:25:11', '2022-03-20 16:02:24', '人员管理');
INSERT INTO `b5net_menu` VALUES ('101', '角色管理', '2', '2', 'system/role/index', '0', 'C', '1', '0', 'system:role:index', 'fa fa-address-book-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色管理');
INSERT INTO `b5net_menu` VALUES ('102', '组织架构', '2', '3', 'system/struct/index', '0', 'C', '1', '0', 'system:struct:index', 'fa fa-sitemap', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织架构');
INSERT INTO `b5net_menu` VALUES ('103', '菜单管理', '2', '4', 'system/menu/index', '0', 'C', '1', '0', 'system:menu:index', 'fa fa-server', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单管理');
INSERT INTO `b5net_menu` VALUES ('104', '登录日志', '2', '5', 'system/loginlog/index', '0', 'C', '1', '0', 'system:loginlog:index', 'fa fa-paw', '2021-01-03 07:25:11', '2021-01-07 12:54:43', '登录日志');
INSERT INTO `b5net_menu` VALUES ('105', '参数配置', '1', '1', 'system/config/index', '0', 'C', '1', '0', 'system:config:index', 'fa fa-sliders', '2021-01-03 07:25:11', '2021-01-05 12:20:56', '参数配置');
INSERT INTO `b5net_menu` VALUES ('106', '网站设置', '1', '0', 'system/config/site', '0', 'C', '1', '0', 'system:config:site', 'fa fa-object-group', '2021-01-11 22:17:31', '2021-01-11 22:39:46', '网站设置');
INSERT INTO `b5net_menu` VALUES ('107', '通知公告', '1', '10', 'system/notice/index', '0', 'C', '1', '0', 'system:notice:index', 'fa fa-bullhorn', '2021-01-03 07:25:11', '2021-03-17 14:05:34', '通知公告');
INSERT INTO `b5net_menu` VALUES ('108', '岗位管理', '1', '2', 'system/position/index', '0', 'C', '1', '0', 'system:position:index', '', null, null, '');
INSERT INTO `b5net_menu` VALUES ('150', '代码生成', '3', '3', 'tool/gen/create', '0', 'C', '1', '0', 'tool:gen:create', '', '2021-07-29 20:29:15', '2022-04-12 13:40:34', '');
INSERT INTO `b5net_menu` VALUES ('151', '表单构建', '3', '2', 'tool/form/build', '0', 'C', '1', '0', 'tool:form:build', '', '2021-07-29 20:29:15', '2022-04-12 13:39:59', '');
INSERT INTO `b5net_menu` VALUES ('152', '图片操作', '3', '1', 'tool/upload/index', '0', 'C', '1', '0', 'tool:upload:index', '', '2021-07-29 20:29:15', '2021-07-29 20:29:15', '');
INSERT INTO `b5net_menu` VALUES ('10000', '用户新增', '100', '1', '', '0', 'F', '1', '0', 'system:admin:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '用户新增');
INSERT INTO `b5net_menu` VALUES ('10001', '用户修改', '100', '2', '', '0', 'F', '1', '0', 'system:admin:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '用户修改');
INSERT INTO `b5net_menu` VALUES ('10002', '用户删除', '100', '3', '', '0', 'F', '1', '0', 'system:admin:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '用户删除');
INSERT INTO `b5net_menu` VALUES ('10004', '用户状态', '100', '4', '', '0', 'F', '1', '0', 'system:admin:setstatus', '', '2021-01-03 07:25:11', '2021-01-08 10:47:09', '用户状态');
INSERT INTO `b5net_menu` VALUES ('10100', '角色新增', '101', '1', '', '0', 'F', '1', '0', 'system:role:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色新增');
INSERT INTO `b5net_menu` VALUES ('10101', '角色修改', '101', '2', '', '0', 'F', '1', '0', 'system:role:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色修改');
INSERT INTO `b5net_menu` VALUES ('10102', '角色删除', '101', '3', '', '0', 'F', '1', '0', 'system:role:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色删除');
INSERT INTO `b5net_menu` VALUES ('10104', '角色状态', '101', '4', '', '0', 'F', '1', '0', 'system:role:setstatus', '', '2021-01-03 07:25:11', '2021-01-08 10:47:31', '角色状态');
INSERT INTO `b5net_menu` VALUES ('10105', '菜单授权', '101', '10', '', '0', 'F', '1', '0', 'system:role:auth', '', '2021-01-03 07:25:11', '2021-01-07 13:32:41', '菜单授权');
INSERT INTO `b5net_menu` VALUES ('10106', '数据权限', '101', '11', '', '0', 'F', '1', '0', 'system:role:datascope', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据权限');
INSERT INTO `b5net_menu` VALUES ('10200', '组织新增', '102', '1', '', '0', 'F', '1', '0', 'system:struct:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织新增');
INSERT INTO `b5net_menu` VALUES ('10201', '组织修改', '102', '2', '', '0', 'F', '1', '0', 'system:struct:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织修改');
INSERT INTO `b5net_menu` VALUES ('10202', '组织删除', '102', '3', '', '0', 'F', '1', '0', 'system:struct:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织删除');
INSERT INTO `b5net_menu` VALUES ('10300', '菜单新增', '103', '1', '', '0', 'F', '1', '0', 'system:menu:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单新增');
INSERT INTO `b5net_menu` VALUES ('10301', '菜单修改', '103', '2', '', '0', 'F', '1', '0', 'system:menu:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单修改');
INSERT INTO `b5net_menu` VALUES ('10302', '菜单删除', '103', '3', '', '0', 'F', '1', '0', 'system:menu:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单删除');
INSERT INTO `b5net_menu` VALUES ('10400', '日志删除', '104', '0', '', '0', 'F', '1', '0', 'system:loginlog:drop', '', '2021-01-07 13:03:15', '2021-01-07 13:03:15', '日志删除');
INSERT INTO `b5net_menu` VALUES ('10401', '日志清空', '104', '0', '', '0', 'F', '1', '0', 'system:loginlog:trash', '', '2021-01-07 13:04:06', '2021-01-07 13:04:06', '日志清空');
INSERT INTO `b5net_menu` VALUES ('10500', '参数新增', '105', '1', '', '0', 'F', '1', '0', 'system:config:add', '', '2021-01-03 07:25:11', '2021-01-05 06:00:02', '参数新增');
INSERT INTO `b5net_menu` VALUES ('10501', '参数修改', '105', '2', '', '0', 'F', '1', '0', 'system:config:edit', '', '2021-01-03 07:25:11', '2021-01-05 06:00:25', '参数修改');
INSERT INTO `b5net_menu` VALUES ('10502', '参数删除', '105', '3', '', '0', 'F', '1', '0', 'system:config:drop', '', '2021-01-03 07:25:11', '2021-01-05 06:00:59', '参数删除');
INSERT INTO `b5net_menu` VALUES ('10503', '参数批量删除', '105', '4', '', '0', 'F', '1', '0', 'system:config:dropall', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '参数批量删除');
INSERT INTO `b5net_menu` VALUES ('10504', '清除缓存', '105', '5', '', '0', 'F', '1', '0', 'system:config:delcache', '', '2021-01-03 07:25:11', '2021-01-08 10:46:47', '清除缓存');
INSERT INTO `b5net_menu` VALUES ('10700', '公告新增', '107', '1', '', '0', 'F', '1', '0', 'system:notice:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告新增');
INSERT INTO `b5net_menu` VALUES ('10701', '公告修改', '107', '2', '', '0', 'F', '1', '0', 'system:notice:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告修改');
INSERT INTO `b5net_menu` VALUES ('10702', '公告删除', '107', '3', '', '0', 'F', '1', '0', 'system:notice:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告删除');
INSERT INTO `b5net_menu` VALUES ('10703', '公告批量删除', '107', '4', '', '0', 'F', '1', '0', 'system:notice:dropall', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告批量删除');
INSERT INTO `b5net_menu` VALUES ('10801', '添加岗位', '108', '1', '', '0', 'F', '1', '0', 'system:position:index', '', null, null, '');
INSERT INTO `b5net_menu` VALUES ('10802', '编辑岗位', '108', '2', '', '0', 'F', '1', '0', 'system:position:add', '', null, null, '');
INSERT INTO `b5net_menu` VALUES ('10803', '删除岗位', '108', '3', '', '0', 'F', '1', '0', 'system:position:dropall', '', null, null, '');
INSERT INTO `b5net_menu` VALUES ('15201', '图片添加', '152', '1', '', '0', 'F', '1', '0', 'tool:upload:add', '', null, null, '');
INSERT INTO `b5net_menu` VALUES ('15202', '图片编辑', '152', '2', '', '0', 'F', '1', '0', 'tool:upload:edit', '', null, null, '');
INSERT INTO `b5net_menu` VALUES ('15203', '图片删除', '152', '3', '', '0', 'F', '1', '0', 'tool:upload:drop', '', null, null, '');
INSERT INTO `b5net_menu` VALUES ('15204', '图片批量删除', '152', '4', '', '0', 'F', '1', '0', 'tool:upload:dropall', '', null, null, '');

-- ----------------------------
-- Table structure for `b5net_notice`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_notice`;
CREATE TABLE `b5net_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '公告ID',
  `title` varchar(150) NOT NULL DEFAULT '' COMMENT '公告标题',
  `type` varchar(10) DEFAULT '' COMMENT '公告类型（1通知 2公告）',
  `desc` varchar(200) DEFAULT NULL,
  `content` longtext COMMENT '公告内容',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '公告状态（1正常 0关闭）',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='通知公告表';

-- ----------------------------
-- Records of b5net_notice
-- ----------------------------
INSERT INTO `b5net_notice` VALUES ('1', '【公告】： B5LaravelCMF新版本发布啦', '2', null, '<p>新版本内容</p><p><br></p><p>新版本内容</p><p>新版本内容</p><p>新版本内容</p><p><br><img src=\"http://tp6cmf.my/uploads/editor/2022/03/22/39f66f7bb77e23ad05bf2dc50524fcd0.jpg\" style=\"width: 500px;\" data-filename=\"u=1160057685,2978145411&amp;fm=26&amp;gp=0.jpg\"></p>', '1', '2022-03-12 11:33:42', '2022-03-22 19:42:08');
INSERT INTO `b5net_notice` VALUES ('2', '【通知】：B5LaravelCMF系统凌晨维护', '1', null, '<p><img src=\"http://tp6cmf.my/uploads/editor/2022/03/22/e61034cba38250949bd2c26319085033.jpg\" style=\"width: 500px;\" data-filename=\"u=3671441873,259090506&amp;fm=26&amp;gp=0.jpg\"><font color=\"#0000ff\">维护内容</font></p><p><font color=\"#0000ff\"><br></font></p>', '1', '2022-03-20 11:33:42', '2022-03-22 19:42:17');

-- ----------------------------
-- Table structure for `b5net_position`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_position`;
CREATE TABLE `b5net_position` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '岗位名称',
  `poskey` varchar(50) DEFAULT NULL COMMENT '岗位标识',
  `listsort` int(11) DEFAULT '100' COMMENT '排序',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态',
  `note` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='岗位表';

-- ----------------------------
-- Records of b5net_position
-- ----------------------------
INSERT INTO `b5net_position` VALUES ('1', '总经理', 'ceo', '1', '1', '', '2022-04-04 23:04:49', '2022-04-08 12:44:52');
INSERT INTO `b5net_position` VALUES ('2', '部门经理', 'cpo', '2', '1', '', '2022-04-04 23:25:34', '2022-04-08 13:24:04');
INSERT INTO `b5net_position` VALUES ('3', '组长', 'cgo', '3', '1', '', '2022-04-04 23:26:08', '2022-04-08 12:53:33');
INSERT INTO `b5net_position` VALUES ('4', '员工', 'user', '4', '1', '12', '2022-04-04 23:26:50', '2022-04-13 00:45:11');

-- ----------------------------
-- Table structure for `b5net_role`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_role`;
CREATE TABLE `b5net_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '角色名称',
  `rolekey` varchar(50) NOT NULL DEFAULT '' COMMENT '角色权限字符串',
  `data_scope` mediumint(5) NOT NULL DEFAULT '1' COMMENT '数据范围（1：全部数据权限 2：自定数据权限 3：本部门数据权限 4：本部门及以下数据权限）',
  `listsort` int(11) NOT NULL DEFAULT '0' COMMENT '显示顺序',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '角色状态（1正常 0停用）',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rolekey` (`rolekey`) USING BTREE,
  KEY `listsort` (`listsort`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='角色信息表';

-- ----------------------------
-- Records of b5net_role
-- ----------------------------
INSERT INTO `b5net_role` VALUES ('1', '超级管理员', 'administrator', '1', '0', '1', '2020-12-28 07:42:31', '2022-04-11 15:15:15', '超级管理员');
INSERT INTO `b5net_role` VALUES ('3', '测试角色', 'test', '8', '0', '1', '2022-03-19 23:43:03', '2022-04-13 02:00:11', '');

-- ----------------------------
-- Table structure for `b5net_role_menu`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_role_menu`;
CREATE TABLE `b5net_role_menu` (
  `role_id` bigint(20) NOT NULL COMMENT '角色ID',
  `menu_id` bigint(20) NOT NULL COMMENT '菜单ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='角色和菜单关联表';

-- ----------------------------
-- Records of b5net_role_menu
-- ----------------------------
INSERT INTO `b5net_role_menu` VALUES ('3', '1');
INSERT INTO `b5net_role_menu` VALUES ('3', '107');
INSERT INTO `b5net_role_menu` VALUES ('3', '3');
INSERT INTO `b5net_role_menu` VALUES ('3', '152');
INSERT INTO `b5net_role_menu` VALUES ('3', '15201');
INSERT INTO `b5net_role_menu` VALUES ('3', '15202');
INSERT INTO `b5net_role_menu` VALUES ('3', '15203');
INSERT INTO `b5net_role_menu` VALUES ('3', '15204');
INSERT INTO `b5net_role_menu` VALUES ('3', '151');
INSERT INTO `b5net_role_menu` VALUES ('3', '150');
INSERT INTO `b5net_role_menu` VALUES ('3', '90');

-- ----------------------------
-- Table structure for `b5net_role_struct`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_role_struct`;
CREATE TABLE `b5net_role_struct` (
  `role_id` int(10) NOT NULL COMMENT '角色ID',
  `struct_id` int(10) NOT NULL COMMENT '部门ID',
  PRIMARY KEY (`role_id`,`struct_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='角色和部门关联表';

-- ----------------------------
-- Records of b5net_role_struct
-- ----------------------------
INSERT INTO `b5net_role_struct` VALUES ('3', '103');
INSERT INTO `b5net_role_struct` VALUES ('3', '104');

-- ----------------------------
-- Table structure for `b5net_struct`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_struct`;
CREATE TABLE `b5net_struct` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '部门id',
  `name` varchar(50) DEFAULT '' COMMENT '部门名称',
  `parent_name` varchar(255) DEFAULT '',
  `parent_id` int(11) DEFAULT '0' COMMENT '父部门id',
  `levels` varchar(100) DEFAULT '' COMMENT '祖级列表',
  `listsort` int(11) DEFAULT '0' COMMENT '显示顺序',
  `leader` varchar(20) DEFAULT NULL COMMENT '负责人',
  `phone` varchar(20) DEFAULT NULL COMMENT '联系电话',
  `note` varchar(255) DEFAULT '' COMMENT '备注',
  `status` char(1) DEFAULT '1' COMMENT '部门状态（1正常 0停用）',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COMMENT='组织架构';

-- ----------------------------
-- Records of b5net_struct
-- ----------------------------
INSERT INTO `b5net_struct` VALUES ('100', '冰舞科技', '', '0', '0', '0', '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2022-03-19 16:20:29');
INSERT INTO `b5net_struct` VALUES ('101', '北京总公司', '冰舞科技', '100', '0,100', '1', '冰舞', '18888888888', '', '1', '2020-12-24 11:33:42', '2022-03-19 16:21:09');
INSERT INTO `b5net_struct` VALUES ('103', '研发部门', '冰舞科技,北京总公司', '101', '0,100,101', '1', '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2022-03-19 16:21:01');
INSERT INTO `b5net_struct` VALUES ('104', '市场部门', '冰舞科技,北京总公司', '101', '0,100,101', '2', '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2022-03-19 16:21:01');
INSERT INTO `b5net_struct` VALUES ('105', '测试部门', '冰舞科技,北京总公司', '101', '0,100,101', '3', '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2022-03-19 16:21:01');
INSERT INTO `b5net_struct` VALUES ('110', '山东分公司', '冰舞科技', '100', '0,100', '2', '冰舞', '1888888', '', '1', '2021-01-08 11:11:33', '2022-03-19 16:21:14');
INSERT INTO `b5net_struct` VALUES ('111', '销售部门', '冰舞科技,山东分公司', '110', '0,100,110', '1', '', '', '', '1', '2021-01-08 11:11:48', '2022-03-19 16:21:14');
INSERT INTO `b5net_struct` VALUES ('112', 'php开发', '冰舞科技,北京总公司,测试部门', '105', '0,100,101,105', '1', '', '', '', '1', '2021-03-29 18:02:29', '2022-03-28 12:52:59');

-- ----------------------------
-- Table structure for `b5net_wechat_access`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_wechat_access`;
CREATE TABLE `b5net_wechat_access` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appid` varchar(50) NOT NULL DEFAULT '',
  `access_token` varchar(255) NOT NULL DEFAULT '',
  `jsapi_ticket` varchar(255) NOT NULL DEFAULT '',
  `access_token_add` int(11) NOT NULL DEFAULT '0',
  `jsapi_ticket_add` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `appid` (`appid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='微信jsapi和access';

-- ----------------------------
-- Records of b5net_wechat_access
-- ----------------------------

-- ----------------------------
-- Table structure for `b5net_wechat_users`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_wechat_users`;
CREATE TABLE `b5net_wechat_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) NOT NULL DEFAULT '' COMMENT '唯一标识',
  `appid` varchar(50) NOT NULL DEFAULT '' COMMENT '公众号参数',
  `nickname` varchar(50) NOT NULL DEFAULT '' COMMENT '昵称',
  `headimg` varchar(255) NOT NULL DEFAULT '' COMMENT '头像地址',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '所属活动',
  `update_time` datetime DEFAULT NULL COMMENT '资料更新时间',
  `create_time` datetime DEFAULT NULL COMMENT '添加时间',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别',
  `city` varchar(50) NOT NULL DEFAULT '' COMMENT '城市',
  `country` varchar(50) NOT NULL DEFAULT '' COMMENT '国家',
  `province` varchar(50) NOT NULL DEFAULT '' COMMENT '省份',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `openid` (`openid`,`appid`,`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='微信用户信息表';

-- ----------------------------
-- Records of b5net_wechat_users
-- ----------------------------
INSERT INTO `b5net_wechat_users` VALUES ('2', 'oHwQ-5zzJiXhutCVWmSPfQyAx7Yk', 'wx2dbcd1ebf29bd18f', '简单', 'https://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLGqoCcD0iamzHcJDmfU4sKbpqBYxD9icXcTtxlKkia3mB2OZIrIucsnq21FwSvFvBSxsiaTtAm5ZHmeQ/132', 'scratch_1', '2021-04-08 16:47:17', '2021-04-08 16:47:17', '1', '', '中国', '', '1');
INSERT INTO `b5net_wechat_users` VALUES ('3', 'oHwQ-5_qj1L9HHnUpclLOJPh_Z7M', 'wx2dbcd1ebf29bd18f', '九方资源ヽ赖小伙 ', 'https://thirdwx.qlogo.cn/mmopen/vi_32/fKibib5mxicWGxOgAQY0PUucIft3D243GXLMkm4vMY7cJmqzR2Zmhr9nrsTR1PFfDXlCsZ3sJcy4UGwptNu7CmSwQ/132', 'scratch_1', '2021-04-14 14:07:13', '2021-04-14 14:07:13', '1', '赣州', '中国', '江西', '1');
INSERT INTO `b5net_wechat_users` VALUES ('4', 'oHwQ-54NH0I3WbRt77eF5-EKo-C8', 'wx2dbcd1ebf29bd18f', 'Hello World', 'https://thirdwx.qlogo.cn/mmopen/vi_32/M3PEicW5ziceOUdVDX7vQicZgvxDMPYCaiavl4l2m8IFPyzSHMTbiaeL3mtaXMiafD8CJQicFrNoHiau1ypkJo0m2HYibcw/132', 'scratch_1', '2021-04-19 21:24:36', '2021-04-19 21:24:36', '1', '', '黑山', '', '1');

-- ----------------------------
-- Table structure for `demo_media`
-- ----------------------------
DROP TABLE IF EXISTS `demo_media`;
CREATE TABLE `demo_media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(200) DEFAULT NULL COMMENT '单图',
  `imgs` text COMMENT '多图',
  `crop` varchar(200) DEFAULT NULL COMMENT '裁剪图片',
  `video` varchar(200) DEFAULT NULL COMMENT '视频',
  `file` varchar(200) DEFAULT NULL COMMENT '单文件',
  `files` text COMMENT '多文件',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of demo_media
-- ----------------------------
INSERT INTO `demo_media` VALUES ('1', '/uploads/demo/2022/04/13/bc331a1181dcbc26928f06e954291cf4.jpeg', '/uploads/demo/2022/04/13/3c93c3b90885ae4d02fa11a82ca2d2ff.jpeg,/uploads/demo/2022/04/13/a9f83847417b27404a96c3003610e923.jpeg,/uploads/demo/2022/04/13/cb3c454c37513b5560ab0c044aeb5561.jpg', '/uploads/demo/2022/04/13/eba6dff0e9cbbc5dabd35b8a9e15e579.jpg', '/uploads/demo/2022/04/13/a40d6b6d71754ba4ba4f82a2cf681cc7.mp4', '/uploads/demo/2022/04/13/b51527924c0498faf888c89ba338421f.png', '/uploads/demo/2022/04/13/b59db9d3e5ce6ab574dd8d3ed54b9449.png,/uploads/demo/2022/04/13/4d3cfc07f9c04a0814d2090d13fdbd7b.txt', '2022-03-22 19:43:57', '2022-04-13 07:14:13');
INSERT INTO `demo_media` VALUES ('2', '/uploads/demo/2022/04/13/858ceb761a38708082bdc9e3d88d4231.jpeg', '/uploads/demo/2022/04/13/b0fb20e72f5d3831eaac982cfa0b4c72.jpeg,/uploads/demo/2022/04/13/8aebd4b79fba3c836ca49a650efa903e.jpeg,/uploads/demo/2022/04/13/8d2ffc75b29a47255aaaa9e07d726c51.jpeg,/uploads/demo/2022/04/13/51a7fda05c6b2357879ac116670b69b8.jpeg,/uploads/demo/2022/04/13/1258a3a0ca55bec3d0a0a76c77497d4b.jpg', '/uploads/demo/2022/04/13/ba9412535db43c992bd2368b7952213e.jpg,/uploads/demo/2022/04/13/82f880ca196b2518b2085537e53ffea4.jpg', '/uploads/demo/2022/04/13/043364b19923bd45898cf128cbe30acf.mp4', '/uploads/demo/2022/04/13/45cc36c665f4bbbfc955099764264092.png', '/uploads/demo/2022/04/13/f9203a3c5530cebfbaf9469c7f1eb32a.txt', '2022-04-13 07:18:02', '2022-04-13 07:18:02');
