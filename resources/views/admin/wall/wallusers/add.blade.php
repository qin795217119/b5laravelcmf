@extends('admin.public.form')

@section('content')
    <form class="form-horizontal m" id="form-wallusers-add">
        <input type="hidden" name="wall_id" value="{{$wallInfo['id']}}">
        @render('iframe',['name'=>'forminput|姓名','extend'=>['name'=>'truename','required'=>1,'sm'=>'2']])
        @render('iframe',['name'=>'forminput|手机号码','extend'=>['type'=>'number','name'=>'mobile','required'=>1,'sm'=>'2']])
        @render('iframe',['name'=>'formradio|性别','extend'=>['name'=>'sex','sm'=>'2','required'=>1,'data'=>[0=>'保密',1=>'男',2=>'女'],'value'=>0]])
        @render('iframe',['name'=>'formradio|状态','extend'=>['name'=>'status','required'=>1,'sm'=>'2','value'=>1]])
        @render('iframe',['name'=>'image|头像','extend'=>['name'=>'headimg','id'=>'headimgbtn','sm'=>2,'tips'=>'400*400像素','width'=>'400','height'=>'400','cat'=>'walluser']])
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-wallusers-add').serialize());
            }
        }
    </script>
@stop
