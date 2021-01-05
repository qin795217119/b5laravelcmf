@extends('admin.public.layout')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'input|角色名称','extend'=>['name'=>'like[name]']])</li>
                    <li>@render('iframe',['name'=>'input|权限字符','extend'=>['name'=>'where[rolekey]']])</li>
                    <li>@render('iframe',['name'=>'select|角色状态','extend'=>['name'=>'where[status]','value'=>'','place'=>'所有']])</li>
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
@stop

@section('script')
    <script>
        $(function () {
            var options = {
                modalName: "角色",
                sortName:'listsort',
                columns: [
                    {checkbox: true},
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
                            actions.push('<a class="btn btn-danger btn-xs" href="javascript:;" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-remove"></i>删除</a> ');
                            var more = [];

                            more.push("<a class='btn btn-default btn-xs' href='javascript:;' onclick='authMenu(" + row.id + ")'><i class='fa fa-check-square-o'></i>菜单权限</a> ");
                            more.push("<a class='btn btn-default btn-xs' href='javascript:;' onclick='authUser(" + row.id + ")'><i class='fa fa-user'></i>分配用户</a>");
                            actions.push('<a tabindex="0" class="btn btn-info btn-xs" data-placement="left" data-toggle="popover" data-html="true" data-trigger="focus" data-container="body" data-content="' + more.join('') + '"><i class="fa fa-chevron-circle-right"></i>更多操作</a>');

                            return actions.join('');
                        }
                    }
                ]
            };
            $.table.init(options);
        });
        /* 角色管理-分配用户 */
        function authUser(roleId) {
            var url = mUrl + '/adminrole/index?role_id=' + roleId;
            $.modal.openTab("分配用户", url);
        }
        /* 角色管理-菜单授权 */
        function authMenu(roleId) {
            var url = cUrl + '/auth?role_id=' + roleId;
            $.modal.open("菜单授权", url);
        }
    </script>
@stop

