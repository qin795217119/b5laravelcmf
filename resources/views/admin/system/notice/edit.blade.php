@extends('admin.layout.form')

@include('widget.asset.summernote')

@section('content')
<form class="form-horizontal m" id="form-edit">
    <input type="hidden" name="id" value="{{$info['id']}}">
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">公告标题：</label>
        <div class="col-sm-8">
            <input type="text" name="title" value="{{$info['title']}}" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">公告内容：</label>
        <div class="col-sm-8">
            <textarea class="summernote_content hide" id="content" name="content">{{$info['content']}}</textarea>
            <div class="summernote" data-place="请输入公告内容" id="contentEditor"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">状态：</label>
        <div class="col-sm-8">
            <label class="radio-box">
                <input type="radio" name="status" value="1" @if($info["status"] == "0") checked @endif/> 隐藏
            </label>
            <label class="radio-box">
                <input type="radio" name="status" value="1" @if($info["status"] == "1") checked @endif/> 显示
            </label>
        </div>
    </div>
</form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                if($("#contentEditor").summernote('isEmpty')){
                    $.modal.msgError('请填写内容')
                    return false;
                }
                var sHTML = $('#contentEditor').summernote('code');
                $("#content").val(sHTML);
                $.operate.save(oesUrl, $('#form-edit').serialize());
            }
        }
    </script>
@stop
