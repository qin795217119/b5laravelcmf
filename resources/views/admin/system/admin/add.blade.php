@extends('admin.layout.form')

@include('widget.asset.select2')

@section('content')
<div class="main-content">
    <form class="form-horizontal m" id="form-add">
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">登录名称：</label>
            <div class="col-sm-8">
                <input type="text" name="username" value="" class="form-control" placeholder="请输入登录名称" required autocomplete="off"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">组织部门：</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="hidden" id="treeId" name="struct" value="">
                    <input type="text" id="treeName" value="" class="form-control" placeholder="请选择组织部门" readonly autocomplete="off"/>
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">角色分组：</label>
            <div class="col-sm-8">
                <input type="hidden" name="roles" value="" id="roles">
                @foreach($roleList as $value)
                    <label class="check-box">
                        <input type="checkbox" name="role" value="{{$value['id']}}" required/> {{$value['name']}}
                    </label>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">岗位职位：</label>
            <div class="col-sm-8">
                <select class="select2" data-width="90%" id="posSelect" name="pos">
                    <option value="">选择岗位</option>
                    @foreach($posList as $value)
                        <option value="{{$value['id']}}">{{$value['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">登录密码：</label>
            <div class="col-sm-8">
                <input type="password" name="password" value="" class="form-control" placeholder="请输入登录密码"  autocomplete="off"/>
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 可不填写，默认为123456</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">真实姓名：</label>
            <div class="col-sm-8">
                <input type="text" name="realname" value="" class="form-control" placeholder="请输入真实姓名"  autocomplete="off"/>
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 可不填写，默认为登陆账号</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">状态：</label>
            <div class="col-sm-8">
                <label class="radio-box"><input type="radio" name="status" value="0"/> 无效</label>
                <label class="radio-box"><input type="radio" name="status" value="1" checked/> 有效</label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label ">备注：</label>
            <div class="col-sm-8">
                <textarea name="note" class="form-control" placeholder="请输入备注"></textarea>
            </div>
        </div>
    </form>
</div>
@stop

@section('script')
    <script>
        $(function () {
            //选择组织架构
            $("#treeName").click(function () {
                var treeId=$("#treeId").val();
                var url = urlcreate("{{route('system.struct.tree')}}","id="+treeId+"&parent=0");
                var options = {
                    title: '组织架构选择',
                    width: "380",
                    url: url,
                    callBack: doSubmit
                };
                $.modal.openOptions(options);
            });
        });
        function doSubmit(index, layero){
            var body = layer.getChildFrame('body', index);
            $("#treeId").val(body.find('#treeId').val());
            $("#treeName").val(body.find('#treeName').val());
            layer.close(index);
        }
        function submitHandler() {
            if ($.validate.form()) {
                var roles = $.form.selectCheckeds("role");
                $("#roles").val(roles);
                // $("#pos").val($('#posSelect').val().join(','));
                $.operate.save(oasUrl, $('#form-add').serialize());
            }
        }
    </script>
@stop
