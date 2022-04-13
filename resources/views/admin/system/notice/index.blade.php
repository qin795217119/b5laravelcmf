@extends('admin.layout.layout')

@section('content')
<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <div class="select-list">
            <ul>
                <li>公告标题：<input type="text" name="like[title]" value=""></li>
                <li class="select-time">
                    <label>创建时间： </label>
                    <input type="text" name="between[create_time][start]" id="startTime" placeholder="开始时间" readonly>
                    <span>-</span>
                    <input type="text" name="between[create_time][end]" id="endTime" placeholder="结束时间" readonly>
                </li>
                <li>
                    <a class="btn btn-primary btn-rounded btn-sm" onclick="$.table.search()"><i class="fa fa-search"></i> 搜索</a>
                    <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset()"><i class="fa fa-refresh"></i> 重置</a>
                </li>
            </ul>
        </div>
    </form>
</div>
<div class="btn-group-sm" id="toolbar" role="group">
    <a class="btn btn-success" onclick="$.operate.add()"><i class="fa fa-plus"></i> 新增</a>
    <a class="btn btn-primary single disabled" onclick="$.operate.editFull('',this)"><i class="fa fa-edit"></i> 修改</a>
    <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll(this)"><i class="fa fa-trash"></i> 批量删除</a>
</div>
<div class="col-sm-12 select-table table-striped">
    <table id="bootstrap-table"></table>
</div>
@stop

@section('script')
    <script>
        $(function () {
            var options = {
                modalName: "通知公告",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '公告ID', align: 'center', sortable: true},
                    {field: 'title', title: '公告标题'},
                    {
                        title: '状态',
                        field: 'status',
                        align: 'center',
                        sortable: true,
                        formatter: function (value, row, index) {
                            return $.view.statusShow(row,false);
                        }
                    },

                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},
                    {
                        title: '操作',
                        align: 'center',
                        formatter: function(value, row, index) {
                            var actions = [];
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:;" onclick="$.operate.editFull(\'' + row.id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                            actions.push('<a class="btn btn-danger btn-xs" href="javascript:;" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-remove"></i>删除</a> ');
                            return actions.join('');
                        }
                    }
                ]
            };
            $.table.init(options);
        });
    </script>
@stop

