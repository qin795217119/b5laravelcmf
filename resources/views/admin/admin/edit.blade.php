@extends('admin.public.form')

@section('content')
    <form class="form-horizontal m" id="form-admin-edit">
        @render('iframe',['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])
        @render('iframe',['name'=>'forminput|登录名称','extend'=>['name'=>'username','required'=>1,'info'=>$info]])
        @render('iframe',['name'=>'forminput|登录密码','extend'=>['name'=>'password','type'=>'password','value'=>'','tips'=>'可不填写，默认为原密码']])
        @render('iframe',['name'=>'forminput|人员名称','extend'=>['name'=>'realname','info'=>$info,'tips'=>'可不填写，默认为登录名称']])
        @render('iframe',['name'=>'formradio|人员状态','extend'=>['name'=>'status','required'=>1,'info'=>$info]])
        @render('iframe',['name'=>'formtextarea|备注','extend'=>['name'=>'note','info'=>$info]])
    </form>
@endsection

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-admin-edit').serialize());
            }
        }
    </script>
@stop
