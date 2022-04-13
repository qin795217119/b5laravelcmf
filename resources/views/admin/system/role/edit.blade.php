@extends('admin.layout.form')

@section('content')
<form class="form-horizontal m" id="form-edit">
    <input type="hidden" name="id" value="{{$info['id']}}">
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">角色名称：</label>
        <div class="col-sm-8">
            <input type="text" name="name" value="{{$info['name']}}" class="form-control" placeholder="请输入角色名称" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">角色标识：</label>
        <div class="col-sm-8">
            <input type="text" name="rolekey" value="{{$info['rolekey']}}" class="form-control" placeholder="请输入角色标识" required autocomplete="off"/>
            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 角色唯一标识，使用3-20为字母、数字或‘_’组成</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">显示顺序：</label>
        <div class="col-sm-8">
            <input type="number" name="listsort" value="{{$info['listsort']}}" class="form-control" placeholder="请输入显示顺序" autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">角色状态：</label>
        <div class="col-sm-8">
            <label class="radio-box">
                <input type="radio" name="status" value="0" @if($info['status'] == '0') checked @endif>停用
            </label>
            <label class="radio-box">
                <input type="radio" name="status" value="1" @if($info['status'] == '1') checked @endif>启用
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label ">备注：</label>
        <div class="col-sm-8">
            <textarea name="note" class="form-control" placeholder="请输入备注" rows="3">{{$info['note']}}</textarea>
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
