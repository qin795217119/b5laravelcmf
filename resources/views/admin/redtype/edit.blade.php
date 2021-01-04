@extends('admin.public.form')

@section('content')
    <form class="form-horizontal m" id="form-redtype-edit">
        @render('iframe',['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])
        @render('iframe',['name'=>'forminput|跳转名称','extend'=>['name'=>'title','required'=>1,'info'=>$info]])
        @render('iframe',['name'=>'forminput|跳转标识','extend'=>['name'=>'type','required'=>1,'info'=>$info]])
        @render('iframe',['name'=>'forminput|功能链接','extend'=>['name'=>'list_url','info'=>$info]])
        @render('iframe',['name'=>'forminput|信息链接','extend'=>['name'=>'info_url','info'=>$info]])
        @render('iframe',['name'=>'formradio|跳转状态','extend'=>['name'=>'status','required'=>1,'info'=>$info]])
        @render('iframe',['name'=>'formtextarea|备注','extend'=>['name'=>'note','info'=>$info]])
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-redtype-edit').serialize());
            }
        }
    </script>
@stop
