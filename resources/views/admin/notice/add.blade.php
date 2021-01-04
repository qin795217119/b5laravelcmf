@extends('admin.public.form')

@include('widget.asset.summernote')

@section('content')
    <form class="form-horizontal m" id="form-notice-add">
        @render('iframe',['name'=>'forminput|公告标题','extend'=>['name'=>'title','required'=>1,'sm'=>'2']])
        @render('iframe',['name'=>'formselect|公告类型','extend'=>['name'=>'type','required'=>1,'data'=>$typelist,'place'=>'','class'=>'form-control','sm'=>'2']])
        <div class="form-group">
            <label class="col-sm-2 control-label">公告内容：</label>
            <div class="col-sm-9">
                @render('iframe',['name'=>'input','extend'=>['name'=>'content','type'=>'hidden','class'=>'summernote_content']])
                <div class="summernote" data-place="请输入公告内容"></div>
            </div>
        </div>
        @render('iframe',['name'=>'formradio|公告状态','extend'=>['name'=>'status','required'=>1,'value'=>1,'sm'=>'2']])
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                var sHTML = $('.summernote').summernote('code');
                $(".summernote_content").val(sHTML);
                $.operate.save(oasUrl, $('#form-notice-add').serialize());
            }
        }
    </script>
@stop
