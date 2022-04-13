@extends('admin.layout.form')

@include('widget.asset.ztree')

@section('content')
<style>
    body{height:auto;font-family: "Microsoft YaHei";background-color: #fff !important;}
    button{font-family: "SimSun","Helvetica Neue",Helvetica,Arial;}
</style>
<input type="hidden" name="treeId" id="treeId" value="{{$menu_id}}">
<input type="hidden" name="treeName" id="treeName" value="">
<div class="wrapper"><div class="treeShowHideButton" onclick="$.tree.toggleSearch();">
        <label id="btnShow" title="显示搜索" style="display:none;">︾</label>
        <label id="btnHide" title="隐藏搜索">︽</label>
    </div>
    <div class="treeSearchInput" id="search">
        <label for="keyword">关键字：</label><input type="text" class="empty" id="keyword" maxlength="50">
        <button class="btn" id="btn" onclick="$.tree.searchNode()"> 搜索 </button>
    </div>
    <div class="treeExpandCollapse">
        <a href="javascript:;" onclick="$.tree.expand()">展开</a> /
        <a href="javascript:;" onclick="$.tree.collapse()">折叠</a>
    </div>
    <div id="tree" class="ztree treeselect"></div>
</div>
@stop

@section('script')
    <script>
        $(function() {
            var url = urlcreate("{{ route('system.menu.tree') }}","root={{$root}}")
            var options = {
                url: url,
                showParentLevel:false,
                expandLevel: 1
            };
            $.tree.init(options);
        });
    </script>
@stop
