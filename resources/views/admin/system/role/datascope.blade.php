@extends('admin.layout.form')

@include('widget.asset.ztree')

@section('content')
<form class="form-horizontal m" id="form-add">
    <input type="hidden" name="id" value="{{$info['id']}}">
    <input type="hidden" name="treeId" id="treeId" value="{{$userStruct}}">
    <div class="form-group">
        <label class="col-sm-3 control-label">角色名称：</label>
        <div class="col-sm-8">
            <div class="form-control-static">{{$info['name']}}</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">角色标识：</label>
        <div class="col-sm-8">
            <div class="form-control-static">{{$info['rolekey']}}</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">数据范围：</label>
        <div class="col-sm-8">
            <select name="data_scope" id="data_scope_select" class="form-control">
                @foreach($typeList as $type=>$typeName)
                    <option value="{{$type}}" @if($type == $info['data_scope']) selected @endif>{{$typeName}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group" id="customData">
        <label class="col-sm-3 control-label">数据权限：</label>
        <div class="col-sm-8">
            <label class="check-box">
                <input type="checkbox" value="1" class="treeOpClass">展开/折叠</label>
            <label class="check-box">
                <input type="checkbox" value="2" class="treeOpClass">全选/全不选</label>
            <label class="check-box">
                <input type="checkbox" value="3" class="treeOpClass">父子联动</label>
            <div id="menuTrees" class="ztree ztree-border"></div>
        </div>
    </div>
</form>
@stop

@section('script')
    <script>
        $(function() {
            dataScopeChange();
            $("#data_scope_select").change(function (){
                dataScopeChange();
            });
            initTree()

        });

        function initTree(){
            var options = {
                id: "menuTrees",
                url: "{{route('system.struct.tree')}}",
                ismult:true,
                childparent:false,
                expandLevel: 2,
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
        }
        function dataScopeChange(){
            var val = $("#data_scope_select").val()
            if(val=='8'){
                $("#customData").show()
            }else{
                $("#customData").hide()
            }
        }
        function submitHandler() {
            $.operate.save(aUrl, $('#form-add').serialize());
        }
    </script>
@stop
