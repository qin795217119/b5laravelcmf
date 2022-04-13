@extends('admin.layout.form')

@section('content')
<form class="form-horizontal m" id="form-add">
    <input type="hidden" name="parent_id" id="treeId" value="{{$root_id}}">

    <div class="form-group">
        <label class="col-sm-3 control-label is-required">上级组织：</label>
        <div class="col-sm-8">
            <div class="input-group">
                <input type="text" id="treeName" value="{{$root_name}}" class="form-control" placeholder="请选择上级组织" readonly autocomplete="off"/>
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">组织名称：</label>
        <div class="col-sm-8">
            <input type="text" name="name" value="" class="form-control" placeholder="请输入组织名称" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">显示顺序：</label>
        <div class="col-sm-8">
            <input type="number" name="listsort" value="0" class="form-control" placeholder="请输入显示顺序" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">负责人：</label>
        <div class="col-sm-8">
            <input type="text" name="leader" value="" class="form-control" placeholder="请输入负责人" autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">联系电话：</label>
        <div class="col-sm-8">
            <input type="text" name="phone" value="" class="form-control" placeholder="请输入联系电话" autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">状态：</label>
        <div class="col-sm-8">
            <label class="radio-box">
                <input type="radio" name="status" value="0"/> 有效
            </label>
            <label class="radio-box">
                <input type="radio" name="status" value="1" checked/> 无效
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label ">备注：</label>
        <div class="col-sm-8">
            <textarea name="note" class="form-control" placeholder="请输入备注"></textarea>
        </div>
    </div>
</form>
@stop

@section('script')
    <script>
        $(function () {
            //选择组织树
            $("#treeName").click(function () {
                var treeId = $("#treeId").val();
                var url=urlcreate("{{route('system.struct.tree')}}","id=" + treeId);
                var options = {
                    title: '组织选择',
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
                $.operate.save(oasUrl, $('#form-add').serialize());
            }
        }
    </script>
@stop
