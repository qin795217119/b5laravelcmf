@extends('admin.public.form')

@include('widget.asset.dragula')
@include('widget.asset.mypicker')
@include('widget.asset.jscolor')

@section('content')
    <form class="form-horizontal m" id="form-website-add">
        @render('iframe',['name'=>'forminput|站点标题','extend'=>['name'=>'title','required'=>1,'sm'=>'2','tips'=>'后台展示，用于管理员区分']])
        @render('iframe',['name'=>'forminput|站点名称','extend'=>['name'=>'name','required'=>1,'sm'=>'2','tips'=>'前端展示']])
        @render('iframe',['name'=>'forminput|站点标识','extend'=>['name'=>'code','required'=>1,'sm'=>'2','tips'=>'唯一标识，小写英文或小写英文+数字,不要有特殊符号']])
        @render('iframe',['name'=>'formradio|站点状态','extend'=>['name'=>'status','required'=>1,'value'=>1,'sm'=>'2','data'=>['关闭','开启'],'class'=>'form-control']])
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-website-add').serialize());
            }
        }
    </script>
@stop
