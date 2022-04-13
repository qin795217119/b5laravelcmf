@extends('admin.layout.form')

@section('content')
<form class="form-horizontal m" id="form-add">
    <input type="hidden" name="parent_id" id="treeId" value="0">
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">上级菜单：</label>
        <div class="col-sm-8">
            <div class="input-group">
                <input type="text" id="treeName" value="顶级菜单" class="form-control" placeholder="请选择上级菜单" readonly autocomplete="off"/>
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">菜单名称：</label>
        <div class="col-sm-8">
            <input type="text" name="name" value="" class="form-control" placeholder="请输入菜单名称" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">菜单类型：</label>
        <div class="col-sm-8">
            @foreach($typeList as $type=>$name)
                <label class="radio-box">
                    <input type="radio" name="type" value="{{$type}}" required/> {{$name}}
                </label>
            @endforeach
        </div>
    </div>
    <div class="form-group mb0">
        <label class="col-sm-3 control-label">权限标识：</label>
        <div class="col-sm-3 ">
            <input type="text" name="perms" value="" class="form-control" placeholder="请输入权限标识" autocomplete="off"/>
        </div>

        <label class="col-sm-2 control-label">请求地址：</label>
        <div class="col-sm-3 ">
            <input type="text" name="url" value="" class="form-control" placeholder="请输入请求地址" autocomplete="off"/>
        </div>
        <div class="col-xs-12 mb15">
            <label class="col-sm-3"></label>
            <span class="help-block m-b-none col-sm-9"><i class="fa fa-info-circle"></i> 菜单类型为目录时，都不填写；为菜单时，都需要填写；为方法时，不需要填写地址</span>
        </div>
    </div>

    <div class="form-group mb0">
        <label class="col-sm-3 control-label">打开方式：</label>
        <div class="col-sm-3 mb15">
            <select name="target" class="form-control">
                <option value="0">页签</option>
                <option value="1">窗口</option>
            </select>
        </div>
        <label class="col-sm-2 control-label">显示顺序：</label>
        <div class="col-sm-3 mb15">
            <input type="number" name="listsort" value="0" class="form-control" placeholder="请输入显示顺序" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group icon_dropbox">
        <label class="col-sm-3 control-label">图标：</label>
        <div class="col-sm-8">
            <input type="text" name="icon" id="icon" value="" class="form-control" placeholder="请选择图标"  autocomplete="off"/>
            <div class="ms-parent" style="width: 100%;">
                <div class="icon-drop animated flipInX" style="display: none;max-height:180px;overflow-y:auto">
                    @include('admin.system.menu.icon')
                </div>
            </div>
        </div>
    </div>

    <div class="form-group mb0">
        <label class="col-sm-3 control-label is-required">菜单状态：</label>
        <div class="col-sm-3 mb15">
            <label class="radio-box">
                <input type="radio" name="status" value="0"/> 隐藏
            </label>
            <label class="radio-box">
                <input type="radio" name="status" value="1" checked/> 显示
            </label>
        </div>

        <label class="col-sm-2 control-label is-required">是否刷新：</label>
        <div class="col-sm-3 mb15">
            <label class="radio-box">
                <input type="radio" name="is_refresh" value="0" checked/> 否
            </label>
            <label class="radio-box">
                <input type="radio" name="is_refresh" value="1"/> 是
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
            //选择菜单树
            $("#treeName").click(function () {
                var treeId = $("#treeId").val();
                var url = urlcreate("{{ route('system.menu.tree') }}","id=" + treeId + "&root=1") ;
                var options = {
                    title: '菜单选择',
                    width: "380",
                    url: url,
                    callBack: doSubmit
                };
                $.modal.openOptions(options);
            });

            //选择图标
            $("#icon").click(function() {
                $(".icon-drop").toggle();
            });
            $("body").click(function(event) {
                var obj = event.srcElement || event.target;
                if (!$(obj).is("#icon")) {
                    $(".icon-drop").hide();
                }
            });
            $(".icon-drop").find(".ico-list i").on("click", function() {
                $('#icon').val($(this).attr('class'));
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
