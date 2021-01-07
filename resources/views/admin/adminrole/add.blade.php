@extends('admin.public.layout')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            @render('iframe',['name'=>'input','extend'=>['name'=>'role_id','id'=>'role_id','type'=>'hidden','value'=>$role_id]])
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'input|登录名称','extend'=>['name'=>'like[username]']])</li>
                    <li>
                        @render('iframe',['name'=>'searchbtn|搜索'])
                        @render('iframe',['name'=>'resetbtn|重置'])
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <div class="btn-group-sm" id="toolbar" role="group">
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        $(function () {
            var options = {
                modalName: "人员",
                sortName:'id',
                url: cUrl + "/tree",
                showSearch: false,
                showRefresh: false,
                showToggle: false,
                showColumns: false,
                clickToSelect: true,
                rememberSelected: true,
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '用户ID', align: 'center',visible: false},
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
                            return $.view.statusShow(row,false);
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

                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true},
                    {field: 'note', title: '备注', visible: false},
                ]
            };
            $.table.init(options);
        });
        /* 添加用户-选择用户-提交 */
        function submitHandler() {
            var rows = $.table.selectFirstColumns();
            if (rows.length == 0) {
                $.modal.alertWarning("请至少选择一条记录");
                return;
            }
            var data = { "role_id": $("#role_id").val(), "user_id": rows.join() };
            $.operate.save(aUrl, data);
        }
    </script>
@stop

