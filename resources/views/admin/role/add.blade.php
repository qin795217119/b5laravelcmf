@extends('admin.public.form')

@section('content')
    <form class="form-horizontal m" id="form-role-add">
        @render('iframe',['name'=>'forminput|角色名称','extend'=>['name'=>'name','required'=>1]])
        @render('iframe',['name'=>'forminput|权限字符','extend'=>['name'=>'rolekey','required'=>1]])
        @render('iframe',['name'=>'forminput|显示顺序','extend'=>['name'=>'listsort','type'=>'number','value'=>0]])
        @render('iframe',['name'=>'formradio|角色状态','extend'=>['name'=>'status','required'=>1,'value'=>1]])
        @render('iframe',['name'=>'formtextarea|备注','extend'=>['name'=>'note']])
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-role-add').serialize());
            }
        }
    </script>
@stop
