<!DOCTYPE html>
<html>
<!-- 引入头部 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{{$siteInfo['name']??''}}</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .code {
        border-right: 2px solid;
        font-size: 26px;
        padding: 0 15px 0 15px;
        text-align: center;
    }

    .message {
        font-size: 18px;
        text-align: center;
    }
</style>
<body style="">
<div class="flex-center position-ref full-height">
    <div class="code">
        {{$code??'404'}}
    </div>

    <div class="message" style="padding: 10px;">
        {{$msg??'哎呦，您访问的页面不存在(⋟﹏⋞)'}}
    </div>
</div>
</body>
</html>
