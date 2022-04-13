@extends('admin.layout.layout')

@include('widget.asset.treetable')

@section('content')
    <div class="col-sm-12 alert alert-warning alert-dismissable" style="margin: 10px 0 0 0">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
        <p>可以实现最多三级菜单展示：目录 => 目录 => 菜单</p>
    </div>
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>菜单名称：<input type="text" name="like[name]"></li>
                    <li>菜单状态：
                        <select name="where[status]">
                            <option value="">全部</option>
                            <option value="1">显示</option>
                            <option value="0">隐藏</option>
                        </select>
                    <li>
                    <li>
                        <a class="btn btn-primary btn-rounded btn-sm" onclick="$.treeTable.search()"><i class="fa fa-search"></i> 搜索</a>
                        <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset()"><i class="fa fa-refresh"></i> 重置</a>
                    </li>
                </ul>
            </div>
        </form>
    </div>

    <div class="btn-group-sm" id="toolbar" role="group">
        <a class="btn btn-success" onclick="$.operate.add(this)"><i class="fa fa-plus"></i> 新增</a>
        <a class="btn btn-info" id="expendinfobtn"><i class="fa fa-exchange"></i> 展开/折叠</a>
    </div>

    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-tree-table"></table>
    </div>
@stop

@section('script')
    <script>
        var datas = '';
        $(function() {
            var options = {
                modalName: "菜单",
                columns: [{
                    field: 'selectItem',
                    radio: true
                },
                    {
                        title: '菜单名称',
                        field: 'name',
                        formatter: function(value, row, index) {
                            if ($.common.isEmpty(row.icon)) {
                                return row.name;
                            } else {
                                return '<i class="' + row.icon + '"></i> <span class="nav-label">' + row.name + '</span>';
                            }
                        }
                    },
                    {field: 'listsort', title: '排序',},
                    {
                        field: 'url',
                        title: '请求地址',
                        formatter: function(value, row, index) {
                            return $.table.tooltip(value);
                        }
                    },
                    {
                        title: '类型',
                        field: 'type',
                        formatter: function(value, item, index) {
                            if (item.type == 'M') {
                                return '<span class="label label-success">目录</span>';
                            }
                            else if (item.type == 'C') {
                                return '<span class="label label-primary">菜单</span>';
                            }
                            else if (item.type == 'F') {
                                return '<span class="label label-warning">按钮</span>';
                            }
                        }
                    },
                    {
                        field: 'status',
                        title: '状态',
                        formatter: function(value, row, index) {
                            if (row.type == 'F') {
                                return $.view.statusShow(row,false,['禁止访问','可以访问']);
                            }
                            return $.view.statusShow(row,false,['隐藏','显示']);

                        }
                    },
                    {
                        field: 'perms',
                        title: '权限标识',
                        formatter: function(value, row, index) {
                            if(!value){
                                return '-';
                            }else{
                                return value;
                            }
                        }
                    },
                    {field: 'note', title: '备注',visible:false},
                    {
                        title: '操作',
                        formatter: function(value, row, index) {
                            var actions = [];
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:;" onclick="$.operate.edit(\'' + row.id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                            actions.push('<a class="btn btn-danger btn-xs" href="javascript:;" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-remove"></i>删除</a> ');
                            return actions.join('');
                        }
                    }]
            };
            $.treeTable.init(options);
        });
    </script>
@stop
