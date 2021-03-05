@extends('admin.public.fullout')

@include('widget.asset.select2')
@include('widget.asset.jquery-layout')
@include('widget.asset.ztree')

@section('content')
    <style>
        body{position: relative;padding-top: 46px;}
    </style>
    <div style="position: absolute;top: 0;left: 0;padding: 2px 15px;background-color: #FFF;width: 100%;z-index: 10">
        <div class="select-list">
            <ul>
                <li> @render('iframe',['name'=>'select|当前站点','extend'=>['name'=>'','data'=>$siteList,'id'=>'thiswebsite','value'=>$website,'class'=>'select2']])<a href="javascript:changeWebsite();" class="btn btn-success btn-sm" style="vertical-align: top">切换站点</a> </li>
            </ul>
        </div>
    </div>

    <div class="ui-layout-west">
        <div class="box box-main">
            <div class="box-header">
                <div class="box-title">
                    <i class="fa icon-grid"></i> 网站菜单
                </div>
                <div class="box-tools pull-right">
                    @render('iframe',['name'=>'input','extend'=>['name'=>'treeId','id'=>'treeId','type'=>'hidden','value'=>'']])
                    @render('iframe',['name'=>'input','extend'=>['name'=>'treeName','id'=>'treeName','type'=>'hidden','value'=>'']])
                    <button type="button" class="btn btn-box-tool" title="网站菜单管理" onclick="$.modal.openTab('网站菜单', struct_indexUrl);"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-box-tool" id="btnExpand" title="展开" style="display:none;"><i class="fa fa-chevron-up"></i></button>
                    <button type="button" class="btn btn-box-tool" id="btnCollapse" title="折叠"><i class="fa fa-chevron-down"></i></button>
                    <button type="button" class="btn btn-box-tool" title="刷新菜单" onclick="getStructList()"><i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <div class="ui-layout-content">
                <div id="tree" class="ztree"></div>
            </div>
        </div>
    </div>

    <div class="ui-layout-center">
        <div class="container-div">
            <div class="row">
                <div class="col-sm-12 search-collapse">
                    <form id="role-form">
                        @render('iframe',['name'=>'input','extend'=>['name'=>'where[website]','id'=>'website','type'=>'hidden','value'=>$website]])
                        @render('iframe',['name'=>'input','extend'=>['name'=>'catid','id'=>'catid','type'=>'hidden']])
                        <div class="select-list">
                            <ul>
                                <li>@render('iframe',['name'=>'input|内容标题','extend'=>['name'=>'like[title]']])</li>
                                <li>@render('iframe',['name'=>'select|发布状态','extend'=>['name'=>'where[status]','value'=>'','place'=>'所有']])</li>
                                <li>
                                    @render('iframe',['name'=>'searchbtn|搜索'])
                                    @render('iframe',['name'=>'resetbtn|重置'])
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="btn-group-sm" id="toolbar" role="group">
                    <a class="btn btn-success disabled" id="addBtn1" href="javascript:addFunc();"><i class="fa fa-plus"></i> 新增</a>
                    @render('iframe',['name'=>'editbtn'])
                    @render('iframe',['name'=>'deletebtn'])

                </div>
                <div class="col-sm-12 select-table table-striped">
                    <table id="bootstrap-table"></table>
                </div>
            </div>
        </div>
    </div>

@stop

@section('script')
    <script>
        var struct_indexUrl_init=mUrl+'/webcat/index';
        var struct_treeUrl_init=mUrl+'/webcat/tree?root=0';
        var struct_indexUrl;
        var struct_treeUrl;
        $(function () {
            var panehHidden = false;
            if ($(this).width() < 769) {
                panehHidden = true;
            }
            $('body').layout({ initClosed: panehHidden, west__size: 185,togglerContent_open:"<i class='fa fa-caret-left'></i>",togglerContent_closed:"<i class='fa fa-caret-right'></i>" });

            //加载菜单和列表
            loadFunc();

            //左侧菜单展开和收起
            $('#btnExpand').click(function() {
                $._tree.expandAll(true);
                $(this).hide();
                $('#btnCollapse').show();
            });
            $('#btnCollapse').click(function() {
                $._tree.expandAll(false);
                $(this).hide();
                $('#btnExpand').show();
            });
        });
        function loadFunc() {
            $("#addBtn1").addClass("disabled");
            $("#treeId").val('0');
            $("#treeName").val('');
            $("#catid").val('0');
            struct_treeUrl=struct_treeUrl_init+'&website='+$("#website").val();
            struct_indexUrl=struct_indexUrl_init+'?website='+$("#website").val();
            getStructList();
            getUserList();
        }
        function getStructList() {
            var options = {
                url: struct_treeUrl,
                expandLevel: 2,
                onClick : zOnClick
            };
            $.tree.init(options);
            $.table.search();
            function zOnClick(event, treeId, treeNode) {
                $("#catid").val(treeNode.id);
                $("#treeId").val(treeNode.id);
                $("#treeName").val(treeNode.name);
                if(treeNode.type === 'none' || treeNode.type === 'link') {
                    $("#addBtn1").addClass("disabled");
                }else{
                    $("#addBtn1").removeClass("disabled");
                }
                $.table.search();
            }
        }
        function getUserList() {
            var options = {
                modalName: "内容列表",
                sortName:'subtime',
                sortOrder:'desc',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '内容ID', align: 'center', sortable: true},
                    {field: 'title', align: 'center', title: '标题'},
                    {
                        field: 'catid',
                        align: 'center',
                        title: '菜单',
                        formatter:function (value, row, index) {
                            return row.catid_name;
                        }
                    },
                    {
                        title: '状态',
                        field: 'status',
                        align: 'center',
                        formatter: function (value, row, index) {
                            return $.view.statusShow(row,false);
                        }
                    },
                    {field: 'subtime', title: '发布时间', align: 'center', sortable: true},
                    {field: 'create_time', title: '发布时间', align: 'center', sortable: true,visible: false},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},
                    {
                        title: '操作',
                        align: 'center',
                        formatter: function(value, row, index) {
                            return '@render("iframe",["name"=>"formopbtn","extend"=>["type"=>["edit","delete"],"rowId"=>"row.id"]])';
                        }
                    }
                ]
            };
            $.table.init(options);
        }

        //切换站点
        function changeWebsite() {
            $("#website").val($("#thiswebsite").find('option:selected').val());
            loadFunc();
        }

        //添加信息按钮点击
        function addFunc() {
            var catid=$("#catid").val();
            if(!catid || catid=='' || catid=='0'){
                $.modal.tips('请先选择左边的分类菜单');
                return false;
            }
            $.operate.addExt("catid="+catid,null,false,$("#treeName").val());
        }
    </script>
@stop

