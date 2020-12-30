@extends('admin.public.layout')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'input|人员名称','extend'=>['name'=>'realname','place'=>'false']])</li>
                    <li>@render('iframe',['name'=>'input|登录名','extend'=>['name'=>'username','place'=>'false']])</li>
                    <li>@render('iframe',['name'=>'select|人员状态','extend'=>['name'=>'status','required'=>1,'value'=>'','place'=>'所有']])</li>
                    <li class="select-time">
                        <label>创建时间： </label>
                        @render('iframe',['name'=>'input','extend'=>['name'=>'params[beginTime]','id'=>'startTime','class'=>'time-input','place'=>'开始时间']])
                        <span>-</span>
                        @render('iframe',['name'=>'input','extend'=>['name'=>'params[endTime]','id'=>'endTime','class'=>'time-input','place'=>'结束时间']])
                    </li>
                    <li>
                        @render('iframe',['name'=>'searchbtn|搜索'])
                        @render('iframe',['name'=>'resetbtn|重置'])
                    </li>
                </ul>
            </div>
        </form>
    </div>
    @include('admin.public.toolbar')
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        $(function () {
            var options = {
                modalName: "人员",
                sortName: "id",
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '用户ID', align: 'center', sortable: true},
                    {field: 'username', align: 'center', title: '登录名称'},
                    {field: 'realname', align: 'center', title: '用户名称'},
                    {field: 'group_name', align: 'center', title: '权限分组'},
                    {
                        title: '状态',
                        align: 'center',
                        formatter: function (value, row, index) {
                            return $.operate.statusTools(row,true);
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

    </script>
@stop

