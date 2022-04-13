<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$system_name}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="{{asset('static/plugins/layui/css/layui.css')}}" rel="stylesheet"/>
    <link href="{{asset('static/admin/css/login.css')}}" rel="stylesheet"/>
    <script>
        if (window !== top) top.location.replace(location.href);
    </script>
</head>
<body>
<div class="login-wrapper layui-anim layui-anim-scale">
    <form class="layui-form" id="login-form">
        <h2>{{$system_name}}</h2>
        <div class="layui-form-item layui-input-icon-group">
            <i class="layui-icon layui-icon-username"></i>
            <input class="layui-input" id="username" name="username" value="" placeholder="请输入用户名" autocomplete="off" required/>
        </div>
        <div class="layui-form-item layui-input-icon-group">
            <i class="layui-icon layui-icon-password"></i>
            <input class="layui-input" id="password" name="password" value="" placeholder="请输入密码" type="password" required/>
        </div>
        <div class="layui-form-item layui-input-icon-group login-captcha-group">
            <i class="layui-icon layui-icon-auz"></i>
            <input class="layui-input" id="captcha" name="captcha" value="" placeholder="请输入验证码" autocomplete="off" required/>
            <img onclick="changeCaptcha()" src="" width="130px" height="48px" class="login-captcha" alt="点击刷新验证码" id="captcha_img"/>
        </div>
        <div class="layui-form-item">
            <input type="checkbox" id="remember" name="remember" value="1" title="记住密码" lay-skin="primary" >
        </div>
        <div class="layui-form-item">
            <button class="layui-btn layui-btn-fluid" id="subBtn">登录</button>
        </div>
    </form>
</div>
<div class="login-copyright">copyright © 2021 b5net.com all rights reserved.</div>
<script src="{{asset('static/plugins/jquery/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('static/plugins/layui/layui.js')}}"></script>
<script>
    $(function (){
        changeCaptcha();
    });
    layui.use(['layer','form'], function () {
        var $ = layui.jquery;
        var layer = layui.layer;
        $('.login-wrapper').removeClass('layui-hide');
        $("#subBtn").click(function (){
            if(!$("#username").val()){
                layer.msg('请输入用户名');
                return false;
            }
            if(!$("#password").val()){
                layer.msg('请输入密码');
                return false;
            }
            if(!$("#captcha").val()){
                layer.msg('请输入验证码');
                return false;
            }
            $("#subBtn").attr('disabled', true).text('登录中...');
            var loadIndex = layer.load(2, {shade: [0.2,'#000']});
            $.ajax({
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: "{{route('admin.login')}}",
                data: $("#login-form").serialize(),
                dataType: "json",
                success: function (res) {
                    if (res.success) {
                        layer.msg('登录成功',{icon: 1,shade: [0.5, '#393D49'],time:1500},function () {
                            window.location.href = "{{route('admin.index')}}";
                        });
                    } else {
                        changeCaptcha();
                        layer.msg(res.msg,{shade: [0.5, '#393D49'],time:1500},function () {
                            $("#subBtn").text('登录').removeAttr('disabled');
                        });
                    }
                },
                complete:function(){
                    layer.close(loadIndex);
                },
                error: function () {
                    layer.msg('网络请求失败',{shade: [0.5, '#393D49'],time:1500},function () {
                        $("#subBtn").text('登录').removeAttr('disabled');
                    });
                }
            });
        });
    });
    function changeCaptcha(){
        var url = urlcreate("{{ captcha_src('admin') }}",'_t='+Math.random());
        $("#captcha_img").attr('src',url)
    }
    function urlcreate(url,params){
        if (params) {
            if (url.indexOf('?') > 0) {
                url += '&' + params;
            } else {
                url += '?' + params;
            }
        }
        return url;
    }

    $(document).keyup(function(event){
        if(event.keyCode ==13){
            $("#submit").trigger("click");
        }
    });
</script>
</body>
</html>
