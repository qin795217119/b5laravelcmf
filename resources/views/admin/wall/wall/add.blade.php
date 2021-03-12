@extends('admin.public.form')

@section('content')
    <form class="form-horizontal m" id="form-wall-add">
        @render('iframe',['name'=>'forminput|活动标题','extend'=>['name'=>'title','required'=>1,'sm'=>'2']])
        @render('iframe',['name'=>'forminput|大屏密码','extend'=>['type'=>'password','name'=>'password','required'=>1,'sm'=>'2','tips'=>'登录现场大屏的密码']])
        <div class="form-group mb0">
            <label class="col-sm-2 control-label is-required">活动状态：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'radio','extend'=>['name'=>'status','required'=>1,'sm'=>'2','data'=>['关闭','开启'],'value'=>1]])
            </div>
            <label class="col-sm-3 control-label is-required">报名状态：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'radio','extend'=>['name'=>'isopen','required'=>1,'sm'=>'2','data'=>['关闭','开启'],'value'=>0]])
            </div>
        </div>
        @render('iframe',['name'=>'image|LOGO','extend'=>['name'=>'logoimg','id'=>'logoimgbtn','sm'=>2,'tips'=>'200*60像素。最好使用png格式，背景透明','cat'=>'wall']])
        @render('iframe',['name'=>'image|背景图片','extend'=>['name'=>'bgimg','id'=>'bgimgbtn','sm'=>2,'tips'=>'1600*900像素。请用深色背景，文字为白色','cat'=>'wall']])
        @render('iframe',['name'=>'formtextarea|活动介绍','extend'=>['name'=>'contents','sm'=>2]])
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-wall-add').serialize());
            }
        }
    </script>
@stop
