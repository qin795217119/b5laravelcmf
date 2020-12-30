@extends('admin.public.form')

@section('content')
    <form class="form-horizontal m" id="form-role-edit">
        @render('iframe',['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])
        @render('iframe',['name'=>'forminput|角色名称','extend'=>['name'=>'name','required'=>1,'info'=>$info]])
        @render('iframe',['name'=>'forminput|权限字符','extend'=>['name'=>'rolekey','required'=>1,'info'=>$info]])
        @render('iframe',['name'=>'forminput|显示顺序','extend'=>['name'=>'listsort','type'=>'number','info'=>$info]])
        @render('iframe',['name'=>'formradio|角色状态','extend'=>['name'=>'status','required'=>1,'info'=>$info]])
        @render('iframe',['name'=>'formtextarea|备注','extend'=>['name'=>'note','info'=>$info]])
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-role-edit').serialize());
            }
        }
    </script>
@stop
