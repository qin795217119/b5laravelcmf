@extends('admin.public.fullout')

@include('widget.asset.jquery-layout')
@include('widget.asset.ztree')

@section('content')
    <div class="ui-layout-west">
        <div class="box box-main">
            <div class="box-header">
                <div class="box-title">
                    <i class="fa icon-grid"></i> 组织机构
                </div>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" title="组织架构管理" onclick="$.modal.openTab('组织架构', struct_indexUrl);"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-box-tool" id="btnExpand" title="展开" style="display:none;"><i class="fa fa-chevron-up"></i></button>
                    <button type="button" class="btn btn-box-tool" id="btnCollapse" title="折叠"><i class="fa fa-chevron-down"></i></button>
                    <button type="button" class="btn btn-box-tool" title="刷新组织" onclick="getStructList()"><i class="fa fa-refresh"></i></button>
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
                        @render('iframe',['name'=>'input','extend'=>['name'=>'structId','id'=>'structId','type'=>'hidden']])
                        <div class="select-list">
                            <ul>
                                <li>@render('iframe',['name'=>'input|人员名称','extend'=>['name'=>'like[realname]']])</li>
                                <li>@render('iframe',['name'=>'input|登录名','extend'=>['name'=>'where[username]']])</li>
                                <li>@render('iframe',['name'=>'select|人员状态','extend'=>['name'=>'where[status]','value'=>'','place'=>'所有']])</li>
                                <li>
                                    @render('iframe',['name'=>'searchbtn|搜索'])
                                    @render('iframe',['name'=>'resetbtn|重置'])
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="btn-group-sm" id="toolbar" role="group">
                    @include('admin.public.toolbar')
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
        var struct_indexUrl=mUrl+'/struct/index';
        var struct_treeUrl=mUrl+'/struct/tree';
        $(function () {
            var panehHidden = false;
            if ($(this).width() < 769) {
                panehHidden = true;
            }
            $('body').layout({ initClosed: panehHidden, west__size: 185,togglerContent_open:"<i class='fa fa-caret-left'></i>",togglerContent_closed:"<i class='fa fa-caret-right'></i>" });
            getStructList();
            getUserList();

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
        function getStructList() {
            var options = {
                url: struct_treeUrl,
                expandLevel: 2,
                onClick : zOnClick
            };
            $.tree.init(options);
            $("#structId").val('');
            $.table.search();
            function zOnClick(event, treeId, treeNode) {
                $("#structId").val(treeNode.id);
                $.table.search();
            }
        }
        function getUserList() {
            var options = {
                modalName: "人员",
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '用户ID', align: 'center', sortable: true},
                    {field: 'username', align: 'center', title: '登录名称'},
                    {field: 'realname', align: 'center', title: '用户名称'},
                    {
                        field: 'structname',
                        title: '组织架构',
                        formatter:function (value, row, index) {
                            return $.table.tooltip(value,9);
                        }
                    },
                    {
                        title: '状态',
                        field: 'status',
                        align: 'center',
                        formatter: function (value, row, index) {
                            return $.view.statusTools(row,true);
                        }
                    },
                    {
                        field: 'rolename',
                        title: '角色分组',
                        visible: false,
                        formatter:function (value, row, index) {
                            return $.table.tooltip(value,9);
                        }
                    },
                    {field: 'last_time', align: 'center', title: '登陆时间',visible: false},
                    {field: 'last_ip', align: 'center', title: '登陆ip',visible: false},
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true,visible: false},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true},
                    {field: 'note', title: '备注', visible: false},
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
    </script>
@stop

