<head>
    <meta charset="utf-8">
    <title>{{$system_name}}</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="{{asset('static/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('static/plugins/fontawesome/css/font-awesome.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('static/plugins/bootstrap-table/bootstrap-table.min.css')}}" rel="stylesheet"/>
@section('css_common')
@show
    <link href="{{asset('static/plugins/layui/css/layui.css')}}" rel="stylesheet">
    <link href="{{asset('static/plugins/animate/animate.css')}}" rel="stylesheet"/>
    <link href="{{asset('static/admin/css/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('static/admin/css/iframe-ui.css')}}" rel="stylesheet"/>
    <script>
        var _M_ = '{{$group}}'
        var _C_ = '{{$app}}';
        var _A_ = '{{$act}}';
        var aUrl = _M_+_C_+'/'+_A_; //当前地址
        var oasUrl=_M_+_C_+'/add'; //添加地址
        var oesUrl=_M_+_C_+'/edit'; //编辑地址
        var upImgUrl="{{route('admin.uploadimg')}}";
        var upFileUrl="{{route('admin.uploadfile')}}";
        var bootUrl={
            url: _M_+_C_+'/index',//table列表地址
            createUrl: oasUrl,
            updateUrl: oesUrl+"?id=%id%",
            removeUrl: _M_+_C_+'/drop',//删除地址
            removeAllUrl: _M_+_C_+'/dropall',//批量删除地址
            statusUrl: _M_+_C_+'/setstatus',//状态改变地址
            downUrl:"{{route('admin.download')}}",
        }
    </script>
</head>
