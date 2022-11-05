@extends('admin.layout.layout')

@section('content')
<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <div class="select-list">
            <ul>
                <li>ID：<input type="text" name="where[id]" value=""></li>
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
    @hasPerm("{$group}:{$controller}:add")
    <a class="btn btn-success" onclick="$.operate.add()"><i class="fa fa-plus"></i> 新增</a>
    @endhasPerm

    @hasPerm("{$group}:{$controller}:edit")
    <a class="btn btn-primary single disabled" onclick="$.operate.edit('',this)"><i class="fa fa-edit"></i> 修改</a>
    @endhasPerm

    @hasPerm("{$group}:{$controller}:drop")
    <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll(this)"><i class="fa fa-trash"></i> 批量删除</a>
    @endhasPerm
</div>
<div class="col-sm-12 select-table table-striped">
    <table id="bootstrap-table"></table>
</div>
@stop

@section('script')
    <script>
        $(function () {
            var options = {
                modalName: "{$moduleName}",
                sortName:'id',
                sortOrder: "desc",
                columns: [
                    {checkbox: true},
                    {field: 'id', title: 'ID', align: 'center', sortable: true},
___REPLACE___                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},
                @if(hasPerm("{$group}:{$controller}:edit") || hasPerm("{$group}:{$controller}:drop"))
                    {
                        title: '操作',
                        align: 'center',
                        formatter: function(value, row, index) {
                            var actions = [];
                        @hasPerm("{$group}:{$controller}:edit")
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:;" onclick="$.operate.edit(\'' + row.id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                        @endhasPerm

                        @hasPerm("{$group}:{$controller}:drop")
                            actions.push('<a class="btn btn-danger btn-xs" href="javascript:;" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-remove"></i>删除</a> ');
                        @endhasPerm
                            return actions.join('');
                        }
                    }
                    @endif
                ]
            };
            $.table.init(options);
        });
    </script>
@stop

