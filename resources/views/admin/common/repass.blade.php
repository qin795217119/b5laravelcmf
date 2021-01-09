@extends('admin.public.form')

@section('content')
		<form class="form-horizontal m" id="form-user-repass">
            @render('iframe',['name'=>'forminput|登录名称','extend'=>['name'=>'','value'=>$name,'readonly'=>'true']])
            @render('iframe',['name'=>'forminput|旧密码','extend'=>['type'=>'password','name'=>'oldpass','required'=>1]])
            @render('iframe',['name'=>'forminput|新密码','extend'=>['type'=>'password','name'=>'newpass','required'=>1]])
            @render('iframe',['name'=>'forminput|确认密码','extend'=>['type'=>'password','name'=>'confirmpass','required'=>1,'tips'=>'请再次输入新密码']])
		</form>
	</div>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(aUrl, $('#form-user-repass').serialize());
            }
        }
    </script>
@stop
