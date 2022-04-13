@extends('admin.layout.form')

@include('widget.asset.summernote')

@section('content')
<form class="form-horizontal m" id="form-add">
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">公告标题：</label>
        <div class="col-sm-8">
            <input type="text" name="title" value="" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">公告内容：</label>
        <div class="col-sm-8">
            <textarea id="content" name="content" class="hide" required></textarea>
            <div class="summernote" data-place="请输入公告内容" id="contentEditor"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">状态：</label>
        <div class="col-sm-8">
            <label class="radio-box">
                <input type="radio" name="status" value="0"/> 隐藏
            </label>
            <label class="radio-box">
                <input type="radio" name="status" value="1" checked/> 显示
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
                $.operate.save(oasUrl, $('#form-add').serialize());
            }
        }
    </script>
@stop
