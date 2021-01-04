@extends('admin.public.form')

@section('content')
    <form class="form-horizontal m" id="form-config-add">
        @render('iframe',['name'=>'forminput|配置标题','extend'=>['name'=>'title','required'=>1]])
        @render('iframe',['name'=>'forminput|配置标识','extend'=>['name'=>'type','required'=>1]])
        <div class="form-group mb0">
            <label class="col-sm-3 control-label">配置类型：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'select','extend'=>['name'=>'style','data'=>$stylelist,'value'=>'text','class'=>'form-control']])
            </div>
            <label class="col-sm-2 control-label">配置分组：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'select','extend'=>['name'=>'groups','place'=>'不分组','class'=>'form-control','data'=>$grouplist]])
            </div>
        </div>
        @render('iframe',['name'=>'formtextarea|配置值','extend'=>['name'=>'value','tips'=>'当为枚举类型时，标识选中得值']])
        @render('iframe',['name'=>'formtextarea|配置项','extend'=>['name'=>'extra','tips'=>'只有类型为枚举类型时有效，表示枚举列表']])
        @render('iframe',['name'=>'forminput|显示顺序','extend'=>['name'=>'listsort','type'=>'number','value'=>0]])
        @render('iframe',['name'=>'formtextarea|备注','extend'=>['name'=>'note']])
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-config-add').serialize());
            }
        }
    </script>
@stop
