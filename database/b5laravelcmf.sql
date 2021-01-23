/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : b5laravelcmf

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-01-23 16:33:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `b5net_adlist`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_adlist`;
CREATE TABLE `b5net_adlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '信息标题',
  `adtype` varchar(100) NOT NULL DEFAULT '' COMMENT '推荐位置',
  `redtype` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '跳转类型',
  `redfunc` varchar(100) DEFAULT '' COMMENT '跳转模块',
  `redinfo` varchar(500) CHARACTER SET utf8 DEFAULT '' COMMENT '跳转值',
  `listsort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `text_text` text COMMENT '文本信息',
  `text_rich` text CHARACTER SET utf8 COMMENT '富文本信息',
  `imglist` text CHARACTER SET utf8 COMMENT '图片信息',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='推荐信息表';

-- ----------------------------
-- Records of b5net_adlist
-- ----------------------------
INSERT INTO `b5net_adlist` VALUES ('2', '测试大苏打大苏打', 'web_index_banner', 'func', 'notice', '', '1', '1', 'asdsadasd', '<p><br></p><p><img src=\"http://www.laravel6.my/uploads/editor/2021/01/10/b6300d0e87928166450e2dd2c1b5a6f2.jpg\" data-filename=\"timg (2).jpg\" style=\"width: 50%;\"><br></p><p><br></p><p></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p>asdasdsadasd</p><p>asdasdasdasd</p>', '/uploads/adlist/2021/01/08/6b8984a88347c29f97563853c47985f8.jpg', '2021-01-05 03:33:07', '2021-01-10 03:15:11');

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
  `last_time` datetime DEFAULT NULL COMMENT '登录时间',
  `last_ip` varchar(30) DEFAULT NULL COMMENT '登录ip',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='管理员表';

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
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) NOT NULL COMMENT '用户ID',
  `role_id` int(10) NOT NULL COMMENT '角色ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_id` (`admin_id`,`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='用户和角色关联表';

-- ----------------------------
-- Records of b5net_admin_role
-- ----------------------------
INSERT INTO `b5net_admin_role` VALUES ('5', '2', '2');
INSERT INTO `b5net_admin_role` VALUES ('4', '1', '1');

-- ----------------------------
-- Table structure for `b5net_admin_struct`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin_struct`;
CREATE TABLE `b5net_admin_struct` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) NOT NULL COMMENT '用户ID',
  `struct_id` int(10) NOT NULL COMMENT '组织ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COMMENT='用户与组织架构关联表';

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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '唯一标识',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '位置名称',
  `note` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `width` mediumint(5) NOT NULL DEFAULT '0',
  `height` mediumint(5) NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name` (`type`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='推荐位置表';

-- ----------------------------
-- Records of b5net_adposition
-- ----------------------------
INSERT INTO `b5net_adposition` VALUES ('1', 'web_index_banner', '首页banner图片', '宽高为1920*400像素', '0', '0', null, '2021-01-08 06:02:11');

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
  `listsort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COMMENT='系统配置表';

-- ----------------------------
-- Records of b5net_config
-- ----------------------------
INSERT INTO `b5net_config` VALUES ('1', '配置分组', 'sys_config_group', 'array', '0', '', 'site:基本设置\r\nwx:微信设置\r\nsms:短信配置\r\nemail:邮箱配置', '', '系统配置的分组配置', '0', '2020-12-30 16:17:10', '2021-01-23 14:01:34');
INSERT INTO `b5net_config` VALUES ('2', '系统名称', 'sys_config_sysname', 'text', '0', 'site', 'B5LaravleCMF', '', '系统后台显示的名称', '0', '2020-12-31 14:01:18', '2021-01-12 00:02:59');
INSERT INTO `b5net_config` VALUES ('3', '演示模式', 'sys_config_demo', 'select', '0', 'site', '1', '1:开启\r\n0:关闭', '开启后，除超管外不可进行非查询操作', '0', '2021-01-08 05:58:25', '2021-01-12 00:02:59');
INSERT INTO `b5net_config` VALUES ('4', '阿里accessKeyId', 'sms_ali_key', 'text', '0', 'sms', '', '', '阿里短信-AccessKey ID', '0', '2021-01-11 19:26:13', '2021-01-11 23:45:06');
INSERT INTO `b5net_config` VALUES ('5', '阿里accessSecret', 'sms_ali_secret', 'text', '0', 'sms', '', '', '阿里短信-AccessKey Secret', '1', '2021-01-11 19:26:45', '2021-01-11 23:45:06');
INSERT INTO `b5net_config` VALUES ('6', '阿里signName', 'sms_ali_signname', 'text', '0', 'sms', '', '', '阿里短信-签名', '2', '2021-01-11 19:27:53', '2021-01-11 23:45:06');
INSERT INTO `b5net_config` VALUES ('7', '阿里tempId', 'sms_ali_temp', 'text', '0', 'sms', '', '', '阿里短信-tempId模板', '3', '2021-01-11 19:30:21', '2021-01-11 23:45:06');
INSERT INTO `b5net_config` VALUES ('8', '聚合appkey', 'sms_juhe_appkey', 'text', '0', 'sms', '', '', '聚合短信-APPKEY', '10', '2021-01-11 19:33:27', '2021-01-11 23:45:06');
INSERT INTO `b5net_config` VALUES ('9', '聚合tempId', 'sms_juhe_temp', 'text', '0', 'sms', '', '', '聚合短信-TPLID模板', '11', '2021-01-11 19:34:26', '2021-01-11 23:45:06');
INSERT INTO `b5net_config` VALUES ('10', '公众号appid', 'wechat_appid', 'text', '0', 'wx', '', '', '微信公众号的AppId', '0', '2021-01-12 11:05:50', '2021-01-12 11:05:50');
INSERT INTO `b5net_config` VALUES ('11', '公众号secret', 'wechat_appsecret', 'text', '0', 'wx', '', '', '微信公众号-AppSecret', '1', '2021-01-12 11:06:24', '2021-01-12 11:06:24');
INSERT INTO `b5net_config` VALUES ('12', '服务地址', 'sys_email_host', 'text', '0', 'email', 'smtp.163.com', '', '', '1', '2021-01-23 14:01:57', '2021-01-23 14:01:57');
INSERT INTO `b5net_config` VALUES ('13', '邮箱地址', 'sys_email_username', 'text', '0', 'email', 'lyyd_lh@163.com', '', '', '2', '2021-01-23 14:02:14', '2021-01-23 14:02:20');
INSERT INTO `b5net_config` VALUES ('14', '授权密码', 'sys_email_password', 'text', '0', 'email', 'UCSMPMHNDJSALQVW', '', '', '3', '2021-01-23 14:02:40', '2021-01-23 14:02:40');
INSERT INTO `b5net_config` VALUES ('15', '服务端口', 'sys_email_port', 'text', '0', 'email', '465', '', '', '4', '2021-01-23 14:02:58', '2021-01-23 14:02:58');
INSERT INTO `b5net_config` VALUES ('16', '是否SSL', 'sys_email_ssl', 'select', '0', 'email', '1', '0:否\r\n1:是', '', '5', '2021-01-23 14:03:20', '2021-01-23 14:03:20');

-- ----------------------------
-- Table structure for `b5net_dict_data`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_dict_data`;
CREATE TABLE `b5net_dict_data` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '字典编码',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '字典标签',
  `value` varchar(100) NOT NULL DEFAULT '' COMMENT '字典键值',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '字典类型',
  `listsort` int(4) NOT NULL DEFAULT '0' COMMENT '字典排序',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '状态（1正常 0停用）',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `value` (`value`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='字典数据表';

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
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '字典主键',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '字典名称',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '字典类型',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '状态（1正常 0停用）',
  `listsort` int(10) NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `dict_type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='字典类型表';

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
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '访问ID',
  `login_name` varchar(50) DEFAULT '' COMMENT '登录账号',
  `ipaddr` varchar(50) DEFAULT '' COMMENT '登录IP地址',
  `login_location` varchar(255) DEFAULT '' COMMENT '登录地点',
  `browser` varchar(100) DEFAULT '' COMMENT '浏览器类型',
  `os` varchar(100) DEFAULT '' COMMENT '操作系统',
  `net` varchar(50) DEFAULT '' COMMENT '营运',
  `status` char(1) DEFAULT '0' COMMENT '登录状态（0成功 1失败）',
  `msg` varchar(255) DEFAULT '' COMMENT '提示消息',
  `login_time` datetime DEFAULT NULL COMMENT '访问时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COMMENT='系统访问记录';

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

-- ----------------------------
-- Table structure for `b5net_menu`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_menu`;
CREATE TABLE `b5net_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `parent_id` int(10) NOT NULL DEFAULT '0' COMMENT '父菜单ID',
  `listsort` int(4) NOT NULL DEFAULT '0' COMMENT '显示顺序',
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
  KEY `parent_id` (`parent_id`),
  KEY `listsort` (`listsort`)
) ENGINE=MyISAM AUTO_INCREMENT=11004 DEFAULT CHARSET=utf8mb4 COMMENT='菜单权限表';

-- ----------------------------
-- Records of b5net_menu
-- ----------------------------
INSERT INTO `b5net_menu` VALUES ('1', '系统管理', '0', '1', '', '0', 'M', '1', '0', '', 'fa fa-cog', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '系统管理');
INSERT INTO `b5net_menu` VALUES ('2', '权限管理', '0', '2', '', '0', 'M', '1', '0', '', 'fa fa-id-card-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '权限管理');
INSERT INTO `b5net_menu` VALUES ('100', '人员管理', '2', '1', '/admin/admin/index', '0', 'C', '1', '0', 'admin:admin:index', 'fa fa-user-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '人员管理');
INSERT INTO `b5net_menu` VALUES ('101', '角色管理', '2', '2', '/admin/role/index', '0', 'C', '1', '0', 'admin:role:index', 'fa fa-address-book-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色管理');
INSERT INTO `b5net_menu` VALUES ('102', '组织架构', '2', '3', '/admin/struct/index', '0', 'C', '1', '0', 'admin:struct:index', 'fa fa-sitemap', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织架构');
INSERT INTO `b5net_menu` VALUES ('103', '菜单管理', '2', '4', '/admin/menu/index', '0', 'C', '1', '0', 'admin:menu:index', 'fa fa-server', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单管理');
INSERT INTO `b5net_menu` VALUES ('104', '登录日志', '2', '5', '/admin/loginlog/index', '0', 'C', '1', '0', 'admin:loginlog:index', 'fa fa-paw', '2021-01-03 07:25:11', '2021-01-07 12:54:43', '登录日志');
INSERT INTO `b5net_menu` VALUES ('105', '参数配置', '1', '1', '/admin/config/index', '0', 'C', '1', '0', 'admin:config:index', 'fa fa-sliders', '2021-01-03 07:25:11', '2021-01-05 12:20:56', '参数配置');
INSERT INTO `b5net_menu` VALUES ('106', '字典管理', '1', '2', '/admin/dict/index', '0', 'C', '1', '0', 'admin:dict:index', 'fa fa-file-code-o', '2021-01-03 07:25:11', '2021-01-05 06:01:47', '字典管理');
INSERT INTO `b5net_menu` VALUES ('107', '通知公告', '3', '10', '/admin/notice/index', '0', 'C', '1', '0', 'admin:notice:index', 'fa fa-bullhorn', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '通知公告');
INSERT INTO `b5net_menu` VALUES ('3', '内容管理', '0', '3', '', '0', 'M', '1', '0', '', 'fa fa-folder-open', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '内容管理');
INSERT INTO `b5net_menu` VALUES ('108', '跳转模块', '1', '3', '/admin/redtype/index', '0', 'C', '1', '0', 'admin:redtype:index', 'fa fa-code-fork', '2021-01-03 07:25:11', '2021-01-04 08:12:28', '跳转模块');
INSERT INTO `b5net_menu` VALUES ('109', '推荐位置', '1', '4', '/admin/adposition/index', '0', 'C', '1', '0', 'admin:adposition:index', 'fa fa-file-zip-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '推荐位置');
INSERT INTO `b5net_menu` VALUES ('110', '推荐信息', '3', '11', '/admin/adlist/index', '0', 'C', '1', '0', 'admin:adlist:index', 'fa fa-sun-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '推荐信息');
INSERT INTO `b5net_menu` VALUES ('10105', '菜单授权', '101', '10', '', '0', 'F', '1', '0', 'admin:role:auth', '', '2021-01-03 07:25:11', '2021-01-07 13:32:41', '菜单授权');
INSERT INTO `b5net_menu` VALUES ('10000', '用户新增', '100', '1', '', '0', 'F', '1', '0', 'admin:admin:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '用户新增');
INSERT INTO `b5net_menu` VALUES ('10001', '用户修改', '100', '2', '', '0', 'F', '1', '0', 'admin:admin:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '用户修改');
INSERT INTO `b5net_menu` VALUES ('10002', '用户删除', '100', '3', '', '0', 'F', '1', '0', 'admin:admin:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '用户删除');
INSERT INTO `b5net_menu` VALUES ('10004', '用户状态', '100', '4', '', '0', 'F', '1', '0', 'admin:admin:setstatus', '', '2021-01-03 07:25:11', '2021-01-08 10:47:09', '用户状态');
INSERT INTO `b5net_menu` VALUES ('10100', '角色新增', '101', '1', '', '0', 'F', '1', '0', 'admin:role:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色新增');
INSERT INTO `b5net_menu` VALUES ('10101', '角色修改', '101', '2', '', '0', 'F', '1', '0', 'admin:role:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色修改');
INSERT INTO `b5net_menu` VALUES ('10102', '角色删除', '101', '3', '', '0', 'F', '1', '0', 'admin:role:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色删除');
INSERT INTO `b5net_menu` VALUES ('10104', '角色状态', '101', '4', '', '0', 'F', '1', '0', 'admin:role:setstatus', '', '2021-01-03 07:25:11', '2021-01-08 10:47:31', '角色状态');
INSERT INTO `b5net_menu` VALUES ('10300', '菜单新增', '103', '1', '', '0', 'F', '1', '0', 'admin:menu:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单新增');
INSERT INTO `b5net_menu` VALUES ('10301', '菜单修改', '103', '2', '', '0', 'F', '1', '0', 'admin:menu:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单修改');
INSERT INTO `b5net_menu` VALUES ('10302', '菜单删除', '103', '3', '', '0', 'F', '1', '0', 'admin:menu:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单删除');
INSERT INTO `b5net_menu` VALUES ('10200', '组织新增', '102', '1', '', '0', 'F', '1', '0', 'admin:struct:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织新增');
INSERT INTO `b5net_menu` VALUES ('10201', '组织修改', '102', '2', '', '0', 'F', '1', '0', 'admin:struct:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织修改');
INSERT INTO `b5net_menu` VALUES ('10202', '组织删除', '102', '3', '', '0', 'F', '1', '0', 'admin:struct:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织删除');
INSERT INTO `b5net_menu` VALUES ('10500', '参数新增', '105', '1', '', '0', 'F', '1', '0', 'admin:config:add', '', '2021-01-03 07:25:11', '2021-01-05 06:00:02', '参数新增');
INSERT INTO `b5net_menu` VALUES ('10501', '参数修改', '105', '2', '', '0', 'F', '1', '0', 'admin:config:edit', '', '2021-01-03 07:25:11', '2021-01-05 06:00:25', '参数修改');
INSERT INTO `b5net_menu` VALUES ('10502', '参数删除', '105', '3', '', '0', 'F', '1', '0', 'admin:config:drop', '', '2021-01-03 07:25:11', '2021-01-05 06:00:59', '参数删除');
INSERT INTO `b5net_menu` VALUES ('10600', '字典新增', '106', '1', '', '0', 'F', '1', '0', 'admin:dict:add', '', '2021-01-03 07:25:11', '2021-01-05 06:02:13', '字典新增');
INSERT INTO `b5net_menu` VALUES ('10601', '字典修改', '106', '2', '', '0', 'F', '1', '0', 'admin:dict:edit', '', '2021-01-03 07:25:11', '2021-01-05 06:02:32', '字典修改');
INSERT INTO `b5net_menu` VALUES ('10602', '字典删除', '106', '3', '', '0', 'F', '1', '0', 'admin:dict:drop', '', '2021-01-03 07:25:11', '2021-01-05 06:02:53', '字典删除');
INSERT INTO `b5net_menu` VALUES ('10610', '数据列表', '106', '10', '', '0', 'F', '1', '0', 'admin:dictdata:index', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据列表');
INSERT INTO `b5net_menu` VALUES ('10611', '数据新增', '106', '11', '', '0', 'F', '1', '0', 'admin:dictdata:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据新增');
INSERT INTO `b5net_menu` VALUES ('10612', '数据修改', '106', '12', '', '0', 'F', '1', '0', 'admin:dictdata:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据修改');
INSERT INTO `b5net_menu` VALUES ('10613', '数据删除', '106', '13', '', '0', 'F', '1', '0', 'admin:dictdata:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据删除');
INSERT INTO `b5net_menu` VALUES ('10700', '公告新增', '107', '1', '', '0', 'F', '1', '0', 'admin:notice:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告新增');
INSERT INTO `b5net_menu` VALUES ('10701', '公告修改', '107', '2', '', '0', 'F', '1', '0', 'admin:notice:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告修改');
INSERT INTO `b5net_menu` VALUES ('10702', '公告删除', '107', '3', '', '0', 'F', '1', '0', 'admin:notice:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告删除');
INSERT INTO `b5net_menu` VALUES ('90', '官方网站', '0', '99', 'http://www.b5net.com', '1', 'C', '1', '0', '', 'fa fa-send', '2021-01-05 12:05:30', '2021-01-05 12:09:03', '官方网站');
INSERT INTO `b5net_menu` VALUES ('10400', '日志删除', '104', '0', '', '0', 'F', '1', '0', 'admin:loginlog:drop', '', '2021-01-07 13:03:15', '2021-01-07 13:03:15', '日志删除');
INSERT INTO `b5net_menu` VALUES ('10401', '日志清空', '104', '0', '', '0', 'F', '1', '0', 'admin:loginlog:trash', '', '2021-01-07 13:04:06', '2021-01-07 13:04:06', '日志清空');
INSERT INTO `b5net_menu` VALUES ('10110', '角色人员', '101', '11', '', '0', 'F', '1', '0', 'admin:adminrole:index', '', '2021-01-03 07:25:11', '2021-01-07 13:33:15', '角色人员');
INSERT INTO `b5net_menu` VALUES ('10111', '取消角色人员', '101', '12', '', '0', 'F', '1', '0', 'admin:adminrole:drop', '', '2021-01-03 07:25:11', '2021-01-07 15:36:14', '取消角色人员');
INSERT INTO `b5net_menu` VALUES ('10112', '添加角色人员', '101', '13', '', '0', 'F', '1', '0', 'admin:adminrole:add', '', '2021-01-03 07:25:11', '2021-01-07 15:36:14', '添加角色人员');
INSERT INTO `b5net_menu` VALUES ('10901', '位置编辑', '109', '2', '', '0', 'F', '1', '0', 'admin:adposition:edit', '', '2021-01-07 15:37:56', '2021-01-07 15:37:56', '位置编辑');
INSERT INTO `b5net_menu` VALUES ('10603', '清除缓存', '106', '4', '', '0', 'F', '1', '0', 'admin:dict:delcache', '', '2021-01-03 07:25:11', '2021-01-07 15:27:19', '清除缓存');
INSERT INTO `b5net_menu` VALUES ('10900', '位置新增', '109', '1', '', '0', 'F', '1', '0', 'admin:adposition:add', '', '2021-01-07 15:36:14', '2021-01-07 15:36:14', '位置新增');
INSERT INTO `b5net_menu` VALUES ('10902', '位置删除', '109', '3', '', '0', 'F', '1', '0', 'admin:adposition:drop', '', '2021-01-03 07:25:11', '2021-01-07 15:36:14', '位置删除');
INSERT INTO `b5net_menu` VALUES ('10903', '清除缓存', '109', '4', '', '0', 'F', '1', '0', 'admin:adposition:delcache', '', '2021-01-03 07:25:11', '2021-01-07 15:36:14', '清除缓存');
INSERT INTO `b5net_menu` VALUES ('10504', '清除缓存', '105', '4', '', '0', 'F', '1', '0', 'admin:config:delcache', '', '2021-01-03 07:25:11', '2021-01-08 10:46:47', '清除缓存');
INSERT INTO `b5net_menu` VALUES ('11000', '信息新增', '110', '1', '', '0', 'F', '1', '0', 'admin:adlist:add', '', '2021-01-08 07:26:14', '2021-01-08 07:26:14', '信息新增');
INSERT INTO `b5net_menu` VALUES ('11001', '信息编辑', '110', '2', '', '0', 'F', '1', '0', 'admin:adlist:edit', '', '2021-01-08 07:26:14', '2021-01-08 07:26:14', '信息编辑');
INSERT INTO `b5net_menu` VALUES ('11002', '信息删除', '110', '3', '', '0', 'F', '1', '0', 'admin:adlist:drop', '', '2021-01-08 07:26:14', '2021-01-08 07:26:14', '信息删除');
INSERT INTO `b5net_menu` VALUES ('11003', '清除缓存', '110', '4', '', '0', 'F', '1', '0', 'admin:adlist:delcache', '', '2021-01-08 07:26:14', '2021-01-08 07:26:14', '清除缓存');
INSERT INTO `b5net_menu` VALUES ('10800', '跳转新增', '108', '1', '', '0', 'F', '1', '0', 'admin:redtype:add', '', '2021-01-08 07:29:26', '2021-01-08 07:29:26', '跳转新增');
INSERT INTO `b5net_menu` VALUES ('10801', '跳转编辑', '108', '2', '', '0', 'F', '1', '0', 'admin:redtype:edit', '', '2021-01-08 07:29:26', '2021-01-08 07:29:26', '跳转编辑');
INSERT INTO `b5net_menu` VALUES ('10802', '跳转删除', '108', '3', '', '0', 'F', '1', '0', 'admin:redtype:drop', '', '2021-01-08 07:29:26', '2021-01-08 07:29:26', '跳转删除');
INSERT INTO `b5net_menu` VALUES ('10803', '清除缓存', '108', '4', '', '0', 'F', '1', '0', 'admin:redtype:delcache', '', '2021-01-08 07:29:26', '2021-01-08 07:29:26', '清除缓存');
INSERT INTO `b5net_menu` VALUES ('10505', '网站设置', '1', '0', '/admin/config/site', '0', 'C', '1', '0', 'admin:config:site', 'fa fa-object-group', '2021-01-11 22:17:31', '2021-01-11 22:39:46', '');

-- ----------------------------
-- Table structure for `b5net_notice`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_notice`;
CREATE TABLE `b5net_notice` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '公告ID',
  `title` varchar(150) NOT NULL DEFAULT '' COMMENT '公告标题',
  `type` varchar(10) DEFAULT '' COMMENT '公告类型（1通知 2公告）',
  `content` text COMMENT '公告内容',
  `textarea` text COMMENT '非html内容',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '公告状态（1正常 0关闭）',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='通知公告表';

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
  `oper_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '日志主键',
  `title` varchar(50) DEFAULT '' COMMENT '模块标题',
  `business_type` int(2) DEFAULT '0' COMMENT '业务类型（0其它 1新增 2修改 3删除）',
  `method` varchar(100) DEFAULT '' COMMENT '方法名称',
  `request_method` varchar(10) DEFAULT '' COMMENT '请求方式',
  `operator_type` int(1) DEFAULT '0' COMMENT '操作类别（0其它 1后台用户 2手机端用户）',
  `oper_name` varchar(50) DEFAULT '' COMMENT '操作人员',
  `dept_name` varchar(50) DEFAULT '' COMMENT '部门名称',
  `oper_url` varchar(255) DEFAULT '' COMMENT '请求URL',
  `oper_ip` varchar(50) DEFAULT '' COMMENT '主机地址',
  `oper_location` varchar(255) DEFAULT '' COMMENT '操作地点',
  `oper_param` varchar(2000) DEFAULT '' COMMENT '请求参数',
  `json_result` varchar(2000) DEFAULT '' COMMENT '返回参数',
  `status` int(1) DEFAULT '0' COMMENT '操作状态（0正常 1异常）',
  `error_msg` varchar(2000) DEFAULT '' COMMENT '错误消息',
  `oper_time` datetime DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`oper_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='操作日志记录';

-- ----------------------------
-- Records of b5net_opert_log
-- ----------------------------

-- ----------------------------
-- Table structure for `b5net_redtype`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_redtype`;
CREATE TABLE `b5net_redtype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
  `type` varchar(100) DEFAULT '' COMMENT '跳转标识',
  `list_url` varchar(255) DEFAULT '' COMMENT '跳转模块连接',
  `info_url` varchar(255) DEFAULT '' COMMENT '跳转信息链接',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `note` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `adkey` (`type`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='跳转配置表';

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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '角色名称',
  `rolekey` varchar(50) NOT NULL DEFAULT '' COMMENT '角色权限字符串',
  `listsort` int(4) NOT NULL DEFAULT '0' COMMENT '显示顺序',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '角色状态（1正常 0停用）',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rolekey` (`rolekey`),
  KEY `listsort` (`listsort`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='角色信息表';

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
  `role_id` bigint(20) NOT NULL COMMENT '角色ID',
  `menu_id` bigint(20) NOT NULL COMMENT '菜单ID',
  PRIMARY KEY (`role_id`,`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='角色和菜单关联表';

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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号码',
  `code` varchar(20) NOT NULL DEFAULT '' COMMENT '验证码',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '例如：1注册 2登录 3忘记密码',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0未验证 1已验证',
  `os` varchar(20) NOT NULL DEFAULT '' COMMENT '运营商',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='验证码表';

-- ----------------------------
-- Records of b5net_smscode
-- ----------------------------

-- ----------------------------
-- Table structure for `b5net_struct`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_struct`;
CREATE TABLE `b5net_struct` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '部门id',
  `name` varchar(30) DEFAULT '' COMMENT '部门名称',
  `parent_id` int(10) DEFAULT '0' COMMENT '父部门id',
  `levels` varchar(100) DEFAULT '' COMMENT '祖级列表',
  `listsort` int(10) DEFAULT '0' COMMENT '显示顺序',
  `leader` varchar(20) DEFAULT NULL COMMENT '负责人',
  `phone` varchar(11) DEFAULT NULL COMMENT '联系电话',
  `note` varchar(255) DEFAULT '' COMMENT '备注',
  `status` char(1) DEFAULT '1' COMMENT '部门状态（1正常 0停用）',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COMMENT='组织架构';

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
-- Table structure for `b5net_wechat_access`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_wechat_access`;
CREATE TABLE `b5net_wechat_access` (
  `appid` varchar(50) NOT NULL DEFAULT '',
  `access_token` varchar(255) NOT NULL DEFAULT '',
  `jsapi_ticket` varchar(255) NOT NULL DEFAULT '',
  `access_token_add` int(10) NOT NULL DEFAULT '0',
  `jsapi_ticket_add` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`appid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='微信jsapi和access';

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
  `update_time` datetime DEFAULT NULL COMMENT '资料更新时间',
  `create_time` datetime DEFAULT NULL COMMENT '添加时间',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别',
  `city` varchar(50) NOT NULL DEFAULT '' COMMENT '城市',
  `country` varchar(50) NOT NULL DEFAULT '' COMMENT '国家',
  `province` varchar(50) NOT NULL DEFAULT '' COMMENT '省份',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `openid` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='微信用户信息表';

-- ----------------------------
-- Records of b5net_wechat_users
-- ----------------------------

-- ----------------------------
-- Table structure for `failed_jobs`
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('2', '2021_01_06_091649_create_sessions_table', '1');
INSERT INTO `migrations` VALUES ('3', '2021_01_23_102307_create_jobs_table', '1');

-- ----------------------------
-- Table structure for `sessions`
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------
