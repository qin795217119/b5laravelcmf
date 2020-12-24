@extends('admin.public.layout')
@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>
                        角色名称：<input type="text" name="roleName"/>
                    </li>
                    <li>
                        权限字符：<input type="text" name="roleKey"/>
                    </li>
                    <li>
                        角色状态：<select name="status">
                            <option value="">所有</option>
                            <option value="0">正常</option>
                            <option value="1">停用</option>
                        </select>
                    </li>
                    <li class="select-time">
                        <label>创建时间： </label>
                        <input type="text" class="time-input" id="startTime" placeholder="开始时间" name="params[beginTime]"/>
                        <span>-</span>
                        <input type="text" class="time-input" id="endTime" placeholder="结束时间" name="params[endTime]"/>
                    </li>
                    <li>
                        <a class="btn btn-primary btn-rounded btn-sm" onclick="$.table.search()"><i class="fa fa-search"></i>&nbsp;搜索</a>
                        <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset()"><i class="fa fa-refresh"></i>&nbsp;重置</a>
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <div class="btn-group-sm" id="toolbar" role="group">
        <a class="btn btn-success" onclick="$.operate.add()">
            <i class="fa fa-plus"></i> 新增
        </a>
        <a class="btn btn-primary single disabled" onclick="$.operate.edit()" >
            <i class="fa fa-edit"></i> 修改
        </a>
        <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll()">
            <i class="fa fa-remove"></i> 删除
        </a>
        <a class="btn btn-warning" onclick="$.table.exportExcel()">
            <i class="fa fa-download"></i> 导出
        </a>
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop
@section('script')
    <script>
        var prefix = "/admin/authgroup";
        $(function () {
            var options = {
                url: prefix + "/index",
                createUrl: prefix + "/edit",
                updateUrl: prefix + "/edit?id={id}",
                removeUrl: prefix + "/drop",
                modalName: "人员",
                sortName: "id",
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '编号', align: 'center', sortable: true},
                    {field: 'name', align: 'center', title: '角色分组'},
                    {
                        title: '状态',
                        align: 'center',
                        formatter: function (value, row, index) {
                            return statusTools(row);
                        }
                    },
                    {
                        title: '操作',
                        align: 'center',
                        formatter: function(value, row, index) {
                            var actions = [];
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:void(0)" onclick="$.operate.edit(\'' + row.id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                            actions.push('<a class="btn btn-danger btn-xs" href="javascript:void(0)" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-remove"></i>删除</a> ');
                            return actions.join('');
                        }
                    }
                ]
            };
            $.table.init(options);
        });
        /* 角色状态显示 */
        function statusTools(row) {
            if (row.status == 1) {
                return '<i class="fa fa-toggle-on text-info fa-2x" onclick="enable(\'' + row.id + '\')"></i> ';
            } else {
                return '<i class="fa fa-toggle-off text-info fa-2x" onclick="disable(\'' + row.id + '\')"></i> ';
            }
        }
    </script>
@stop

