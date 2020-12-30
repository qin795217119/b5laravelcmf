@extends('admin.public.form')

@section('content')
    <form class="form-horizontal m" id="form-admin-add">
        @render('iframe',['name'=>'forminput|登录名称','extend'=>['name'=>'username','required'=>1]])
        @render('iframe',['name'=>'forminput|登录密码','extend'=>['name'=>'password','type'=>'password','value'=>'','tips'=>'可不填写，默认为123456']])
        @render('iframe',['name'=>'forminput|人员名称','extend'=>['name'=>'realname','tips'=>'可不填写，默认为登录名称']])
        @render('iframe',['name'=>'formradio|人员状态','extend'=>['name'=>'status','required'=>1,'value'=>1]])
        @render('iframe',['name'=>'formtextarea|备注','extend'=>['name'=>'note']])
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-admin-add').serialize());
            }
        }
    </script>
@stop
