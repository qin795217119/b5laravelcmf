@extends('admin.public.form')

@section('content')
    <form class="form-horizontal m" id="form-webpos-edit">
        @render('iframe',['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])
        @render('iframe',['name'=>'input','extend'=>['name'=>'website','type'=>'hidden','info'=>$info]])
        @render('iframe',['name'=>'formselect|所属站点','extend'=>['name'=>'website','required'=>1,'data'=>$siteList,'place'=>'','info'=>$info,'disabled'=>'']])
        @render('iframe',['name'=>'forminput|位置名称','extend'=>['name'=>'title','required'=>1,'info'=>$info]])
        <div class="form-group mb15">

            <label class="col-sm-3 control-label">宽度：</label>
            <div class="col-sm-3 mb5">
                @render('iframe',['name'=>'input','extend'=>['name'=>'width','type'=>'number','class'=>'form-control','info'=>$info]])
            </div>
            <label class="col-sm-2 control-label">高度：</label>
            <div class="col-sm-3 mb5">
                @render('iframe',['name'=>'input','extend'=>['name'=>'height','type'=>'number','class'=>'form-control','info'=>$info]])
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-xs-12 col-sm-8">
                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 宽度或高度填写时，将会对上传的图片进行裁剪压缩</span>
                </div>

            </div>
        </div>
        @render('iframe',['name'=>'formtextarea|备注','extend'=>['name'=>'note','info'=>$info]])
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-webpos-edit').serialize());
            }
        }
    </script>
@stop
