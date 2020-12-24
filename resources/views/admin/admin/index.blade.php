@extends('admin.public.layout')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>角色名称：@render('iframe',['name'=>'input','extend'=>['name'=>'roleName','place'=>'false']])</li>
                    <li>权限字符：@render('iframe',['name'=>'input','extend'=>['name'=>'roleKey','place'=>'false']])</li>
                    <li>角色状态： @render('iframe',['name'=>'select','extend'=>['name'=>'status','required'=>1,'value'=>'','data'=>[1=>'正常',0=>'停用'],'place'=>'所有']])</li>
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
    <div class="btn-group-sm" id="toolbar" role="group">
        @render('iframe',['name'=>'addbtn|新增'])
        @render('iframe',['name'=>'editbtn|编辑'])
        @render('iframe',['name'=>'deletebtn|删除'])
        @render('iframe',['name'=>'exportbtn|导出'])
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        var prefix = "/admin/admin";
        $(function () {
            var options = {
                url: prefix + "/index",
                createUrl: prefix + "/add",
                updateUrl: prefix + "/edit?id={id}",
                removeUrl: prefix + "/drop",
                modalName: "人员",
                sortName: "id",
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '编号', align: 'center', sortable: true},
                    {field: 'username', align: 'center', title: '用户名', sortable: true},
                    {field: 'group_name', align: 'center', title: '权限分组'},
                    {
                        title: '状态',
                        align: 'center',
                        formatter: function (value, row, index) {
                            return statusTools(row);
                        }
                    },
                    {field: 'createTime', title: '创建时间', sortable: true},
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

