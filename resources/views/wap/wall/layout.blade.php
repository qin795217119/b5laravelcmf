<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit"/>
    <meta name="force-rendering" content="webkit"/>
    <title>{{$wallInfo['title']??''}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript"  src="{{asset('static/plugins/flexible.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/plugins/jquery/jquery-1.12.4.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/plugins/mlayer/mlayer.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/common/js/common.js')}}"></script>
    <link rel="stylesheet" href="{{asset('static/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('static/wall/wap/css/css.css')}}">
</head>
<body>

<div class="main-box">
    <div class="centerbox">
        @yield('content')
    </div>
</div>
</body>
</html>
