@extends('admin.public.form')
@section('css_common')
    @parent
    <link rel="stylesheet" href="{{asset('static/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('static/plugins/select2/select2-bootstrap.css')}}">
@stop
@section('js_common')
    @parent
    <script src="{{asset('static/plugins/select2/select2.min.js')}}"></script>
@stop
@section('content')
    <form class="form-horizontal m" id="form-dictdata-add">
        @render('iframe',['name'=>'formselect|字典类型','extend'=>['name'=>'type','required'=>1,'data'=>$typelist,'showvalue'=>'type','showname'=>'name','place'=>'','value'=>$input['id']??'','class'=>'select2']])
        @render('iframe',['name'=>'forminput|字典标签','extend'=>['name'=>'name','required'=>1]])
        @render('iframe',['name'=>'forminput|字典键值','extend'=>['name'=>'value','required'=>1]])
        @render('iframe',['name'=>'forminput|显示顺序','extend'=>['name'=>'listsort','type'=>'number','required'=>1,'value'=>0]])
        @render('iframe',['name'=>'formradio|系统默认','extend'=>['name'=>'is_default','value'=>0,'data'=>['否','是']]])
        @render('iframe',['name'=>'formradio|字典状态','extend'=>['name'=>'status','value'=>1]])
        @render('iframe',['name'=>'formtextarea|备注','extend'=>['name'=>'note']])
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-dictdata-add').serialize());
            }
        }
    </script>
@stop
