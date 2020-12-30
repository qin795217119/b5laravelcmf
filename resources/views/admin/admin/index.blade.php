@extends('admin.public.layout')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
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
@stop

@section('script')
    <script>
        $(function () {
            var options = {
                modalName: "人员",
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '用户ID', align: 'center', sortable: true},
                    {field: 'username', align: 'center', title: '登录名称'},
                    {field: 'realname', align: 'center', title: '用户名称'},
                    {field: 'group_name', align: 'center', title: '权限分组'},
                    {
                        title: '状态',
                        field: 'status',
                        align: 'center',
                        formatter: function (value, row, index) {
                            return $.view.statusTools(row,true);
                        }
                    },
                    {field: 'last_time', align: 'center', title: '登陆时间'},
                    {field: 'last_ip', align: 'center', title: '登陆ip',visible: false},
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true,visible: false},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},
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
        });

    </script>
@stop

