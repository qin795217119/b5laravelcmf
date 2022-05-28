@extends('admin.layout.layout')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>角色名称：<input type="text" name="like[name]"></li>
                    <li>权限字符：<input type="text" name="like[rolekey]"></li>
                    <li>组织状态：
                        <select name="where[status]">
                            <option value="">全部</option>
                            <option value="1">有效</option>
                            <option value="0">无效</option>
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
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        var root_id = "{{$root_id}}";
        $(function () {
            var options = {
                modalName: "角色",
                sortName:'listsort',
                sortOrder:'asc',
                columns: [
                    {
                        checkbox: true,
                        formatter:function(value,row,index){
                            if(row.id == root_id) return {disabled : true};
                        }
                    },
                    {field: 'id', title: '角色ID', align: 'center', sortable: true},
                    {field: 'name', title: '角色名称'},
                    {field: 'rolekey', title: '权限字符'},
                    {field: 'listsort', title: '显示顺序',align: 'center', sortable: true},
                    {
                        title: '状态',
                        field: 'status',
                        align: 'center',
                        sortable: true,
                        formatter: function (value, row, index) {
                            return $.view.statusTools(row,true);
                        }
                    },
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},
                    {field: 'note', title: '备注',visible: false},
                    {
                        title: '操作',
                        align: 'center',
                        formatter: function(value, row, index) {
                            var actions = [];
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:;" onclick="$.operate.edit(\'' + row.id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                            if(row.id != root_id){
                                actions.push('<a class="btn btn-danger btn-xs" href="javascript:;" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-remove"></i>删除</a> ');
                                var more = [];

                                more.push("<a class='btn btn-default btn-xs' href='javascript:;' onclick='authMenu(" + row.id + ")'><i class='fa fa-check-square-o'></i>菜单权限</a> ");
                                more.push("<a class='btn btn-default btn-xs' href='javascript:;' onclick='dataScope(" + row.id + ")'><i class='fa fa-check-square-o'></i>数据权限</a> ");
                                actions.push('<a tabindex="0" class="btn btn-info btn-xs" role="button" data-placement="left" data-toggle="popover" data-html="true" data-trigger="hover" data-container="body" data-content="' + more.join('') + '"><i class="fa fa-chevron-circle-right"></i>更多操作</a>');
                            }
                            return actions.join('');
                        }
                    }
                ]
            };
            $.table.init(options);
        });
        /* 角色管理-菜单授权 */
        function authMenu(roleId) {
            var url = "{{route('system.role.auth')}}";
            url=urlcreate(url,'role_id=' + roleId);
            $.modal.open("菜单授权", url);
        }
        /* 角色管理-数据范围 */
        function dataScope(roleId){
            var url = "{{route('system.role.datascope')}}";
            url=urlcreate(url,'role_id=' + roleId);
            $.modal.open("分配数据权限", url);
        }
    </script>
@stop

