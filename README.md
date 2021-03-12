# b5LaravelCMF

#### 介绍
之前一直使用的是基于thinkphp3.2和Yii2自己封装的一套cmf基础功能。laravel处于刚开始阶段，网上找了一些laravel的管理系统，感觉不够漂亮，也怎么适合我的开发习惯，我喜欢所有源码都能看到，并且可以随时修改，不用再去研究别人的封装思想。发现java的若依系统很不错，页面代码都没有封装，可以想怎么开发就怎么开发，于是将其前端代码拿了下来，做了一些改动与laravel结合，做了一点简单封装，构架了这套CMF系统。


本系统只是经过简单测试，还未正式使用，若有问题或建议，请多多指教。

#### 软件架构
基于laravel 6 + bootstrap 3，其中使用了bootrstrap-table来进行列表的展示，以及一些较为流行js插件做各种效果，页面简洁、响应式。

系统在MVC的基础上加了已成Service，用来处理业务逻辑。
还单独列出了验证类Validate和缓存类Cache
基本是一个表 对应一个Model、Service、Validate及Cache。当然在后面开发的功能你可以根据自己的喜好写。

系统完全开源，数据库文件在database目录下，超管默认为：admin，123456。

#### 系统演示
地址：<a href="http://b5laravelcmf.b5net.com/" target="_blank">http://b5laravelcmf.b5net.com</a>

账号：ceshi

密码：123456

### 下载地址：
github: https://github.com/qin795217119/b5laravelcmf

gitee: https://gitee.com/b5net/b5-laravel-cmf      

#### 使用说明

1. 环境推荐使用 PHP 7.4 + Mysql 5.7 +Nginx 
2. 开启函数 proc_open
   开启PHP扩展  fileinfo、gd2、imagemagick等，若使用redis最好安装PHP的redis扩展
3.  使用nginx需要配置重写 
    location / {
              try_files $uri $uri/ /index.php?$query_string;
    }
4. 网站目录指向Public，.user.ini 去掉public，open_basedir=网站根目录/:/tmp/:/proc/
5. ip获取一直是局域网Ip时，App\Http\Middleware\TrustProxies中的protected $proxies='网关地址|例如：10.1.1.1';

#### 内置功能
新增微信预约功能：主要用来熟悉和测试API接口开发及其中间件、微信授权类等的测试。
新增PC官网网站系统：用户测试该系统的开发流程。

1. 人员管理：人员是系统操作者，该功能主要完成系统用户配置。
2. 组织架构：配置系统组织机构（公司、部门、小组），树结构展现支持，数据权限暂未开发。
3. 菜单管理：配置系统菜单，操作权限，按钮权限标识等。
4. 角色管理：角色菜单权限分配。
5. 字典管理：对系统中经常使用的一些较为固定的数据进行维护。
6. 参数管理：对系统动态配置常用参数，默认为文本、数据、枚举三种类型。
7. 跳转管理：用于定义系统内跳转的模块、模块列表地址、模块信息地址，可以与推荐信息结合生成跳转链接或标识，对于多端开发又用
8. 推荐位置：增加特定的标识用于推荐信息的分类
9. 推荐信息：又称广告，对应推荐位置，可以添加一或多条信息，包含 标题、图片、文本及富文本信息、跳转链接等信息
10. 通知公告：系统通知公告信息发布维护。
11. 操作日志：系统正常操作日志记录和查询；系统异常信息日志记录和查询。

#### 功能文档

1.H5的微信授权
    可以看中间件WallWap.php的demo
    
    $openid=getWapOpenId();//获取session中的openid
    if(!$openid){
        //b5reduri当前的url，mtype为所属应用 可以都为空
        $url=URL::route('wap_wxauthinfo',['mtype'=>$mtype,'b5reduri'=>URL::full()]);
        
        //跳转授权  授权完成后通过Wap\WechatController的wxinfo获取存储微信信息，然后团转到当前url
        return (new WechatApi())->getOpenId($url);
    }
   




