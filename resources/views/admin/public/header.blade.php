<head>
    <meta charset="utf-8">
    <title>@yield('title','b5laravelcmf')</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="{{asset('static/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('static/plugins/fontawesome/css/font-awesome.min.css')}}" rel="stylesheet"/>
    @section('css_common')
<link href="{{asset('static/plugins/bootstrap-table/bootstrap-table.min.css')}}" rel="stylesheet"/>
    @show
<link href="{{asset('static/plugins/layui/css/layui.css')}}" rel="stylesheet">
    <link href="{{asset('static/plugins/animate/animate.css')}}" rel="stylesheet"/>
    <link href="{{asset('static/admin/css/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('static/admin/css/iframe-ui.css')}}" rel="stylesheet"/>
    <script>
        var _M_ = '{{$group}}'
        var _C_ = '{{$app}}';
        var _A_ = '{{$act}}';
        var rootUrl ="/";
        var mUrl = rootUrl+_M_;
        var cUrl = mUrl+"/" + _C_;
        var aUrl = cUrl+"/"+_A_;
        var oasUrl=cUrl+"/add";
        var oesUrl=cUrl+"/edit";
    </script>
</head>
