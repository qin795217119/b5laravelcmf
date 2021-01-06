@extends('admin.public.form')

@include('widget.asset.ztree')

@section('content')
    <form class="form-horizontal m" id="form-roleauth-add">
        @render('iframe',['name'=>'forminput|角色名称','extend'=>['name'=>'name','readonly'=>'','info'=>$info]])
        @render('iframe',['name'=>'input','extend'=>['type'=>'hidden','name'=>'id','info'=>$info]])
        @render('iframe',['name'=>'input','extend'=>['type'=>'hidden','name'=>'treeId','id'=>'treeId','value'=>$menuList]])
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
            var url = mUrl + "/menu/tree?root=0";
            var options = {
                id: "menuTrees",
                url: url,
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
            $.operate.save(aUrl, $('#form-roleauth-add').serialize());
        }
    </script>
@stop
