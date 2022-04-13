@extends('admin.layout.full')

@include('widget.asset.select2')
@include('widget.asset.jquery-layout')
@include('widget.asset.ztree')
@include('widget.asset.export')

@section('content')
<div class="ui-layout-west">
    <div class="box box-main">
        <div class="box-header">
            <div class="box-title">
                <i class="fa icon-grid"></i> 组织部门
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
                    <input type="hidden" name="structId" id="structId" value="">
                    <div class="select-list">
                        <ul>
                            <li>人员名称 <input type="text" name="like[realname]" value=""></li>
                            <li>角色分组
                                <select name="role_id" class="select2" data-width="150px">
                                    <option value="0">全部</option>
                                    @foreach($roleList as $value)
                                        <option value="{{$value['id']}}">{{$value['name']}}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>人员状态
                                <select name="where[status]">
                                    <option value="">全部</option>
                                    <option value="1">有效</option>
                                    <option value="0">无效</option>
                                </select>
                            <li>
                            <li>子部门
                                <select name="contains">
                                    <option value="1">包含</option>
                                    <option value="0">不包含</option>
                                </select>
                            <li>
                            <li>
                                <a class="btn btn-primary btn-rounded btn-sm" onclick="$.table.search()"><i class="fa fa-search"></i> 搜索</a>
                                <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset()"><i class="fa fa-refresh"></i> 重置</a>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
            <div class="btn-group-sm" id="toolbar" role="group">
                <a class="btn btn-success" onclick="$.operate.add(this)"><i class="fa fa-plus"></i> 新增</a>
                <a class="btn btn-primary single disabled" onclick="$.operate.edit('',this)"><i class="fa fa-edit"></i> 修改</a>
                <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll(this)"><i class="fa fa-trash"></i> 批量删除</a>
                <input type="hidden" id="checkUserList" value="">
                <a class="btn btn-default" onclick="userTree()"><i class="fa fa-check"></i> 测试选择人员</a>
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
        var root_id ="{{$root_id}}";
        var struct_indexUrl="{{route('system.struct.index')}}";
        var struct_treeUrl="{{route('system.struct.tree')}}";
        $(function () {
            var panehHidden = false;
            if ($(this).width() < 769) {
                panehHidden = true;
            }
            $('body').layout({ initClosed: panehHidden, west__size: 200,togglerContent_open:"<i class='fa fa-caret-left'></i>",togglerContent_closed:"<i class='fa fa-caret-right'></i>" });
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
                sortName:'id',
                sortOrder:'asc',
                showExport: true,
                exportOptions:{
                    ignoreColumn:[0]
                },
                columns: [
                    {
                        checkbox: true,
                        formatter:function(value,row,index){
                            if(row.id == root_id) return {disabled : true};
                        }
                    },
                    {field: 'id', title: '用户ID', align: 'center', sortable: true},
                    {
                        field: 'username',
                        align: 'center',
                        title: '登录名称'
                    },
                    {
                        field: 'realname',
                        align: 'center',
                        title: '用户名称'
                    },
                    {
                        field: 'struct_name',
                        title: '组织部门',
                        formatter:function (value, row, index) {
                            return $.table.tooltip(value,15);
                        }
                    },
                    {
                        field: 'pos_name',
                        title: '岗位',
                        formatter:function (value, row, index) {
                            return $.table.tooltip(value,9);
                        }
                    },
                    {
                        field: 'role_name',
                        title: '角色分组',
                        visible: false,
                        formatter:function (value, row, index) {
                            return $.table.tooltip(value,15);
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
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true,visible: false},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},
                    {field: 'note', title: '备注', visible: false},
                    {
                        title: '操作',
                        align: 'center',
                        export:false,
                        formatter: function(value, row, index) {
                            var actions = [];
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:;" onclick="$.operate.edit(\'' + row.id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                            if(row.id != root_id) {
                                actions.push('<a class="btn btn-danger btn-xs" href="javascript:;" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-remove"></i>删除</a> ');
                            }
                            return actions.join('');
                        }
                    }
                ]
            };
            $.table.init(options);
        }

        //显示选择人员弹窗
        function userTree(){
            var treeId= $("#checkUserList").val();
            //mult 1多选 0 单选
            var url = urlcreate("{{route('system.admin.tree')}}","ids="+treeId+"&mult=1");
            var options = {
                title: '人员选择',
                width: "800",
                url: url,
                callBack: doSubmit
            };
            $.modal.openOptions(options);
        }
        function doSubmit(index, layero){
            // var body = layer.getChildFrame('body', index);
            var iframeWin = window[layero.find('iframe')[0]['name']];//得到iframe页的窗口对象，执行iframe页的方法：
            var list = iframeWin.getCheckRows();
            var idList = [];
            if(list.length>0){
                for (let i = 0; i < list.length; i++) {
                    idList.push(list[i].id)
                }
            }
            $("#checkUserList").val(idList.join(','))
            console.log(list)
            layer.close(index);
        }
    </script>
@stop

