B5LaravelCMF V2.0
=========

### 介绍
基于 Laravel 9 + bootstrap 3，构架的通用后台开发框架，简洁、易读、方便系统扩展及二次开发。
系统完全开源，数据库文件在public目录下，超管默认为：admin，123456。

和V1和版本差距较大，该版本去除了service层的必须，改成自己根据需要创建，只完成基本核心功能

### 系统演示
地址：http://b5laravelcmf.b5net.com

账号：ceshi

密码：123456

### 下载地址：

github: https://github.com/qin795217119/b5laravelcmf

gitee: https://gitee.com/b5net/b5-laravel-cmf

前端采用java的若依框架前端并进行了一定的修改，使用文档可参考 http://doc.ruoyi.vip/ruoyi/document/qdsc.html

### 内置功能

1. 人员管理：人员是系统操作者，该功能主要完成系统用户配置。
2. 组织架构：配置系统组织机构（公司、部门、小组），树结构展现支持。
3. 菜单管理：配置系统菜单，操作权限，按钮权限标识等。
4. 角色管理：角色菜单权限分配、数据权限分配。
5. 登录日志：登录后台记录信息。
6. 参数配置：多种类型的参数配置。
7. 通知公告：系统通知公告信息发布维护。
8. 表单构建：快速构建form表单html代码
9. 代码生成：一键生成基于表的控制器、模型以及html页面


### 使用说明

1. 环境推荐使用 PHP 8.1 + Mysql 5.7/8 +Nginx，系统搭建参考官方文档
2. 基于  laravel 9.x  + bootstrap 3构架，未对框架进行任何修改。
3. 系统默认使用DB查询构造器进行数据库操作，若想支持模型操作，只需将模型继承Model
4. 封装了文件上传、图片上传等标签、快速实现上传
5. 实现了一键导出excel功能；表单导出（参考人员管理）、全部数据导出（参考参数管理）

### 界面截图
![Image text](https://gitee.com/b5net/img-folder/raw/master/user.png)
![Image text](https://gitee.com/b5net/img-folder/raw/master/menu.png)
![Image text](https://gitee.com/b5net/img-folder/raw/master/struct.png)
![Image text](https://gitee.com/b5net/img-folder/raw/master/config.png)
![Image text](https://gitee.com/b5net/img-folder/raw/master/role_menu.png)
![Image text](https://gitee.com/b5net/img-folder/raw/master/role_datascope.png)
![Image text](https://gitee.com/b5net/img-folder/raw/master/build.png)









