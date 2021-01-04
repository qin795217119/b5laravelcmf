@extends('admin.public.form')

@section('content')
    <form class="form-horizontal m" id="form-redtype-add">
        @render('iframe',['name'=>'forminput|跳转名称','extend'=>['name'=>'title','required'=>1]])
        @render('iframe',['name'=>'forminput|跳转标识','extend'=>['name'=>'type','required'=>1]])
        @render('iframe',['name'=>'forminput|功能链接','extend'=>['name'=>'list_url']])
        @render('iframe',['name'=>'forminput|信息链接','extend'=>['name'=>'info_url']])
        @render('iframe',['name'=>'formradio|跳转状态','extend'=>['name'=>'status','required'=>1,'value'=>1]])
        @render('iframe',['name'=>'formtextarea|备注','extend'=>['name'=>'note']])
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-redtype-add').serialize());
            }
        }
    </script>
@stop
