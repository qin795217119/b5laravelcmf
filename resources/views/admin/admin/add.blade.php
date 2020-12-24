@extends('admin.public.form')

@section('content')
    <form class="form-horizontal m" id="form-admin-add">
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">登录名称：</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="postName" id="postName" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">岗位编码：</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="postCode" id="postCode" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">显示顺序：</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="postSort" id="postSort" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">岗位状态：</label>
            <div class="col-sm-8">
                <div class="radio-box">
                    <input type="radio" id="s1" name="status" value="11" checked="true">
                    <label for="s1" >啊实打实</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="s2" name="status" value="22" checked="false">
                    <label for="s2" ></label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">备注：</label>
            <div class="col-sm-8">
                <textarea id="remark" name="remark" class="form-control"></textarea>
            </div>
        </div>
    </form>
@endsection
