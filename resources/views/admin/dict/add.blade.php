@extends('admin.public.form')

@section('content')
    <form class="form-horizontal m" id="form-dict-add">
        @render('iframe',['name'=>'forminput|字典名称','extend'=>['name'=>'name','required'=>1]])
        @render('iframe',['name'=>'forminput|字典标识','extend'=>['name'=>'type','required'=>1]])
        @render('iframe',['name'=>'forminput|显示顺序','extend'=>['name'=>'listsort','type'=>'number','value'=>0]])
        @render('iframe',['name'=>'formradio|字典状态','extend'=>['name'=>'status','required'=>1,'value'=>1]])
        @render('iframe',['name'=>'formtextarea|备注','extend'=>['name'=>'note']])
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-dict-add').serialize());
            }
        }
    </script>
@stop
