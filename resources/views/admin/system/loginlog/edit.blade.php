@extends('admin.layout.form')

@section('content')
<form class="form-horizontal m" id="form-edit">
    <input type="hidden" name="id" value="{{$info['id']}}">
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">登录账号：</label>
        <div class="col-sm-8">
            <input type="text" name="login_name" value="{{$info['login_name']}}" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">登录IP地址：</label>
        <div class="col-sm-8">
            <input type="text" name="ipaddr" value="{{$info['ipaddr']}}" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">登录地点：</label>
        <div class="col-sm-8">
            <input type="text" name="login_location" value="{{$info['login_location']}}" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">浏览器类型：</label>
        <div class="col-sm-8">
            <input type="text" name="browser" value="{{$info['browser']}}" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">操作系统：</label>
        <div class="col-sm-8">
            <input type="text" name="os" value="{{$info['os']}}" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">net：</label>
        <div class="col-sm-8">
            <input type="text" name="net" value="{{$info['net']}}" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">登录状态（0成功 1失败）：</label>
        <div class="col-sm-8">
            <label class="radio-box">
                <input type="radio" name="status" value="1" @if($info["status"] == "0") checked @endif/> 隐藏
            </label>
            <label class="radio-box">
                <input type="radio" name="status" value="1" @if($info["status"] == "1") checked @endif/> 显示
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">提示消息：</label>
        <div class="col-sm-8">
            <input type="text" name="msg" value="{{$info['msg']}}" class="form-control" required autocomplete="off"/>
        </div>
    </div>
</form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-edit').serialize());
            }
        }
    </script>
@stop
