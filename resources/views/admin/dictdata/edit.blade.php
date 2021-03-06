@extends('admin.public.form')

@include('widget.asset.select2')

@section('content')
    <form class="form-horizontal m" id="form-dictdata-edit">
        @render('iframe',['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])
        @render('iframe',['name'=>'formselect|字典类型','extend'=>['name'=>'type','required'=>1,'data'=>$typelist,'showvalue'=>'type','showname'=>'name','place'=>'','info'=>$info,'class'=>'select2']])
        @render('iframe',['name'=>'forminput|数据名称','extend'=>['name'=>'name','required'=>1,'info'=>$info]])
        @render('iframe',['name'=>'forminput|数据值','extend'=>['name'=>'value','required'=>1,'info'=>$info]])
        @render('iframe',['name'=>'forminput|显示顺序','extend'=>['name'=>'listsort','type'=>'number','required'=>1,'info'=>$info]])
        @render('iframe',['name'=>'formradio|字典状态','extend'=>['name'=>'status','info'=>$info]])
        @render('iframe',['name'=>'formtextarea|备注','extend'=>['name'=>'note','info'=>$info]])
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-dictdata-edit').serialize());
            }
        }
    </script>
@stop
