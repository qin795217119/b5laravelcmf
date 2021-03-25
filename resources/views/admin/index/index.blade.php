<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>B5LaravelCMF</title>
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;url=/ie.html"/>
    <![endif]-->
    <link href="{{asset('static/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('static/plugins/contextMenu/jquery.contextMenu.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('static/plugins/fontawesome/css/font-awesome.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('static/plugins/layui/css/layui.css')}}" rel="stylesheet">
    <link href="{{asset('static/plugins/animate/animate.css')}}" rel="stylesheet"/>
    <link href="{{asset('static/admin/css/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('static/admin/css/skins.css')}}" rel="stylesheet"/>
    <link href="{{asset('static/admin/css/iframe-ui.css')}}" rel="stylesheet"/>
    <script>
        if (window !== top) top.location.replace(location.href);
        var _M_ = '{{$group}}'
        var _C_ = '{{$app}}';
        var _A_ = '{{$act}}';
        var rootUrl ="/";
        var mUrl = rootUrl+_M_;
        var cUrl = mUrl+"/" + _C_;
    </script>
</head>
<body class="fixed-sidebar full-height-layout gray-bg theme-dark skin-blue" style="overflow: hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close">
            <i class="fa fa-times-circle"></i>
        </div>
        <a href="">
            <li class="logo hidden-xs">
                <span class="logo-lg">B5LaravelCMF</span>
            </li>
        </a>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <div class="user-panel">
                        <a class="menuItem noactive" title="个人中心" href="">
                            <div class="hide" text="个人中心"></div>
                            <div class="pull-left image">
                                <img src="{{asset('static/admin/images/profile.jpg')}}" class="img-circle" alt="User Image">
                            </div>
                        </a>
                        <div class="pull-left info">
                            <p style="height: 15px;line-height: 16px;width: 100%;overflow: hidden;font-size: 12px">{{$adminInfo['struct']}}</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
                            <a href="/admin/logout" style="padding-left:5px;"><i class="fa fa-sign-out text-danger"></i> 注销</a>
                        </div>
                    </div>
                </li>
                <!--- 菜单 -->
                <li>
                    <a class="menuItem" href="/admin/home"><i class="fa fa-home"></i> <span class="nav-label">首页</span> </a>
                </li>
                {!! $menuHtml !!}
{{--                <li>--}}
{{--                    <a href="#">--}}
{{--                        <i class="fa fa-cog"></i>--}}
{{--                        <span class="nav-label">系统管理</span>--}}
{{--                        <span class="fa arrow"></span>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-second-level">--}}
{{--                        <li><a class="menuItem" href="/admin/config/index">参数配置</a></li>--}}
{{--                        <li><a class="menuItem" href="/admin/dict/index">字典管理</a></li>--}}
{{--                        <li><a class="menuItem" href="/admin/notice/index">通知公告</a></li>--}}
{{--                        <li><a class="menuItem" href="/admin/adlist/index">推荐信息</a></li>--}}
{{--                        <li><a class="menuItem" href="/admin/adposition/index">推荐位置</a></li>--}}
{{--                        <li><a class="menuItem" href="/admin/redtype/index">跳转管理</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->

    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2" style="color:#FFF;" href="#" title="收起菜单">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right welcome-message">
                    <li><a data-toggle="tooltip" data-trigger="hover" data-placement="bottom" title="清除缓存" href="javascript:clearCacheAll();"><i class="fa fa-question-circle"></i> 清除缓存</a></li>
                    <li><a data-toggle="tooltip" data-trigger="hover" data-placement="bottom" title="开发文档" href="javascript:alert('暂无');"><i class="fa fa-question-circle"></i> 文档</a></li>
                    <li><a data-toggle="tooltip" data-trigger="hover" data-placement="bottom" title="锁定屏幕" href="#" id="lockScreen"><i class="fa fa-lock"></i> 锁屏</a></li>
                    <li><a data-toggle="tooltip" data-trigger="hover" data-placement="bottom" title="全屏显示" href="#" id="fullScreen"><i class="fa fa-arrows-alt"></i> 全屏</a></li>
                    <li class="dropdown user-menu">
                        <a href="javascript:;" class="dropdown-toggle" data-hover="dropdown">
                            <img src="{{asset('static/admin/images/profile.jpg')}}" class="user-image">
                            <span class="hidden-xs">{{$adminInfo['info']['name']}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="mt5">
                                <a href="" class="menuItem"><i class="fa fa-user"></i> 个人中心</a>
                            </li>
                            <li>
                                <a href="javascript:rePass();"><i class="fa fa-key"></i> 修改密码</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="/admin/logout"><i class="fa fa-sign-out"></i> 退出登录</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row content-tabs">
            <button class="roll-nav roll-left tabLeft">
                <i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active menuTab" data-id="/admin/home">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right tabRight">
                <i class="fa fa-forward"></i>
            </button>
            <a href="javascript:;" class="roll-nav roll-right tabReload"><i class="fa fa-refresh"></i> 刷新</a>
        </div>

        <a id="ax_close_max" class="ax_close_max" href="#" title="关闭全屏"> <i class="fa fa-times-circle-o"></i> </a>

        <div class="row mainContent" id="content-main">
            <iframe class="RuoYi_iframe" name="iframe0" width="100%" height="100%" data-id="/admin/home"
                    src="/admin/home" frameborder="0" seamless></iframe>
        </div>

        <div class="footer">
            <div class="pull-right">© 2021 b5net.com Copyright </div>
        </div>
    </div>
    <!--右侧部分结束-->
</div>
<script src="{{asset('static/plugins/jquery/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('static/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('static/plugins/metismenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('static/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('static/plugins/contextMenu/jquery.contextMenu.min.js')}}"></script>
<script src="{{asset('static/plugins/blockUI/jquery.blockUI.js')}}"></script>
<script src="{{asset('static/plugins/layui/layui.js')}}"></script>
<script src="{{asset('static/admin/js/iframe-ui.js')}}"></script>
<script src="{{asset('static/admin/js/common.js')}}"></script>
<script src="{{asset('static/admin/js/index.js')}}"></script>
<script src="{{asset('static/plugins/fullscreen/jquery.fullscreen.js')}}"></script>
<script>
    // history（表示去掉地址的#）否则地址以"#"形式展示
    var mode = "history";
    // 历史访问路径缓存
    var historyPath = storage.get("historyPath");
    // 是否页签与菜单联动
    var isLinkage = true;


    var wsUrl = "ws://b5laravelcmf.b5net.com:9502";
    var websocket = new WebSocket(wsUrl);

    //势力花对性的onopen属性
    websocket.onopen = function(evt){};
    //实例化 onmessage
    websocket.onmessage = function(evt){
        console.log("ws-server："+evt.data);
    };

    //onclose
    websocket.onclose = function(evt){};
    //error
    websocket.onerror=function(evt,e){
        console.log("error:"+evt.data);
    };


    /** 刷新时访问路径页签 */
    function applyPath(url) {
        $('a[href$="' + decodeURI(url) + '"]').click();
        if (!$('a[href$="' + url + '"]').hasClass("noactive")) {
            $('a[href$="' + url + '"]').parent("li").addClass("selected").parents("li").addClass("active").end().parents("ul").addClass("in");
        }
    }
    $(function() {
        if ($.common.equals("history", mode) && window.performance.navigation.type == 1) {
            var url = storage.get('publicPath');
            if ($.common.isNotEmpty(url)) {
                applyPath(url);
            }
        } else {
            var hash = location.hash;
            if ($.common.isNotEmpty(hash)) {
                var url = hash.substring(1, hash.length);
                applyPath(url);
            } else {
                if ($.common.equals("history", mode)) {
                    storage.set('publicPath', "");
                }
            }
        }
        $("[data-toggle='tooltip']").tooltip();
    });


    /* 修改密码 */
    function rePass() {
        var url = mUrl + '/common/repass';
        $.modal.open("修改密码", url, '770', '380');
    }

    function clearCacheAll() {
        $.operate.b5get('/admin/cacheclear');
    }
</script>
</body>
</html>


