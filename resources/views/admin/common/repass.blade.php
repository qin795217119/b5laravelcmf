@extends('admin.layout.form')

@section('content')
<form class="form-horizontal m" id="form-repass">
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">旧密码：</label>
        <div class="col-sm-8">
            <input type="password" name="oldpass" value="" class="form-control" placeholder="请输入旧密码"  autocomplete="off" required/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">新密码：</label>
        <div class="col-sm-8">
            <input type="password" name="newpass" value="" class="form-control" placeholder="请输入新密码"  autocomplete="off" required/>
            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 密码长度为6-20</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">确认密码：</label>
        <div class="col-sm-8">
            <input type="password" name="confirmpass" value="" class="form-control" placeholder="请输入再次新密码"  autocomplete="off" required/>
        </div>
    </div>

</form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save("{{route('admin.repass')}}", $('#form-repass').serialize());
            }
        }
    </script>
@stop
