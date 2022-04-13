@extends('admin.layout.layout')

@include('widget.asset.treetable')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>
                        组织名称：<input type="text" name="like[name]" value="">
                    </li>
                    <li>组织状态：
                        <select name="where[status]">
                            <option value="">全部</option>
                            <option value="1">有效</option>
                            <option value="0">无效</option>
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
                modalName: "组织部门",
                expandAll:true,
                columns: [{
                    field: 'selectItem',
                    radio: true
                },
                    {
                        title: '组织名称',
                        field: 'name',
                        formatter: function(value, row, index) {
                            if ($.common.isEmpty(row.icon)) {
                                return row.name;
                            } else {
                                return '<i class="' + row.icon + '"></i> <span class="nav-label">' + row.name + '</span>';
                            }
                        }
                    },
                    {
                        field: 'listsort',
                        title: '排序'
                    },
                    {
                        field: 'status',
                        title: '状态',
                        formatter: function(value, row, index) {
                            return $.view.statusShow(row,false);

                        }
                    },
                    {field: 'create_time', title: '创建时间', sortable: true},
                    {field: 'update_time', title: '更新时间',sortable: true,visible: false},
                    {field: 'note', title: '备注',visible: false},
                    {
                        title: '操作',
                        width: '20',
                        widthUnit: '%',
                        align: "left",
                        formatter: function(value, row, index) {
                            var actions = [];
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:;" onclick="$.operate.edit(\'' + row.id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                            if(row.id != {{$root_id}}){
                                actions.push('<a class="btn btn-danger btn-xs" href="javascript:;" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-remove"></i>删除</a> ');
                            }
                            return actions.join('');
                        }
                    }]
            };
            $.treeTable.init(options);
        });
    </script>
@stop
