@extends('admin.public.layout')

@section('css_common')
    <link rel="stylesheet" href="{{asset('static/plugins/ztree/css/metroStyle/metroStyle.css')}}">
@stop
@section('js_common')
    <script src="{{asset('static/plugins/ztree/js/jquery.ztree.core.min.js')}}"></script>
@stop

@section('content')
    <style>
        body{height:auto;font-family: "Microsoft YaHei";background-color: #fff !important;}
        button{font-family: "SimSun","Helvetica Neue",Helvetica,Arial;}
    </style>
    @render('iframe',['name'=>'input','extend'=>['name'=>'treeId','id'=>'treeId','type'=>'hidden','value'=>$menuId]])
    @render('iframe',['name'=>'input','extend'=>['name'=>'treeName','id'=>'treeName','type'=>'hidden','value'=>'']])
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
@endsection


@section('script')
    <script>
        $(function() {
            var options = {
                url: aUrl,
                expandLevel: 1,
                onClick : zOnClick
            };
            $.tree.init(options);
        });

        function zOnClick(event, treeId, treeNode) {
            var treeId = treeNode.id;
            var treeName = treeNode.name;
            $("#treeId").val(treeId);
            $("#treeName").val(treeName);
        }
    </script>
@stop
