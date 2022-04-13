@extends('admin.layout.form')

@section('content')
<form class="form-horizontal m" id="form-add">
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">登录账号：</label>
        <div class="col-sm-8">
            <input type="text" name="login_name" value="" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">登录IP地址：</label>
        <div class="col-sm-8">
            <input type="text" name="ipaddr" value="" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">登录地点：</label>
        <div class="col-sm-8">
            <input type="text" name="login_location" value="" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">浏览器类型：</label>
        <div class="col-sm-8">
            <input type="text" name="browser" value="" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">操作系统：</label>
        <div class="col-sm-8">
            <input type="text" name="os" value="" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">net：</label>
        <div class="col-sm-8">
            <input type="text" name="net" value="" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">登录状态（0成功 1失败）：</label>
        <div class="col-sm-8">
            <label class="radio-box">
                <input type="radio" name="status" value="0"/> 隐藏
            </label>
            <label class="radio-box">
                <input type="radio" name="status" value="1" checked/> 显示
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">提示消息：</label>
        <div class="col-sm-8">
            <input type="text" name="msg" value="" class="form-control" required autocomplete="off"/>
        </div>
    </div>
</form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-add').serialize());
            }
        }
    </script>
@stop
