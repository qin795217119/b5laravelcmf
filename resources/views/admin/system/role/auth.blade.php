@extends('admin.layout.form')

@include('widget.asset.ztree')

@section('content')
<form class="form-horizontal m" id="form-add">
    <div class="form-group">
        <label class="col-sm-3 control-label">角色名称：</label>
        <div class="col-sm-8">
            <div class="form-control-static">{{$info['name']}}</div>
        </div>
    </div>
    <input type="hidden" name="id" value="{{$info['id']}}">
    <input type="hidden" name="treeId" id="treeId" value="{{$menuList}}">

    <div class="form-group">
        <label class="col-sm-3 control-label">菜单权限：</label>
        <div class="col-sm-8">
            <label class="check-box">
                <input type="checkbox" value="1" class="treeOpClass">展开/折叠</label>
            <label class="check-box">
                <input type="checkbox" value="2" class="treeOpClass">全选/全不选</label>
            <label class="check-box">
                <input type="checkbox" value="3" class="treeOpClass" checked>父子联动</label>
            <div id="menuTrees" class="ztree ztree-border"></div>
        </div>
    </div>
</form>
@stop

@section('script')
    <script>
        $(function() {
            var options = {
                id: "menuTrees",
                url: "{{ route('system.menu.tree') }}",
                ismult:true,
                childparent:false,
                expandLevel: 1,
                callBack:function (tree) {
                    tree.setting.check.chkboxType = { "Y": "ps", "N": "ps" };
                }
            };
            $.tree.init(options);
            $('input.treeOpClass').on('ifChanged', function(obj){
                var type = $(this).val();
                var checked = obj.currentTarget.checked;
                if (type == 1) {
                    if (checked) {
                        $._tree.expandAll(true);
                    } else {
                        $._tree.expandAll(false);
                    }
                } else if (type == "2") {
                    if (checked) {
                        $._tree.checkAllNodes(true);
                        $.tree.zOnCheck();
                    } else {
                        $._tree.checkAllNodes(false);
                        $.tree.zOnCheck();
                    }
                } else if (type == "3") {
                    if (checked) {
                        $._tree.setting.check.chkboxType = { "Y": "ps", "N": "ps" };
                    } else {
                        $._tree.setting.check.chkboxType = { "Y": "", "N": "" };
                    }
                }
            })
        });
        function submitHandler() {
            $.operate.save(aUrl, $('#form-add').serialize());
        }
    </script>
@stop
