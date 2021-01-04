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
        @render('iframe',['name'=>'btn|新增','extend'=>['class'=>'btn-success','id'=>'selectUser']])
        @render('iframe',['name'=>'deletebtn|批量取消授权'])
        @render('iframe',['name'=>'closetab'])
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        $(function () {
            var options = {
                modalName: "用户角色",
                sortName:'create_time',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '序号',visible:false},
                    {field: 'username', title: '登录名称'},
                    {field: 'realname', title: '用户名称'},
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
                    {field: 'note', title: '备注',visible: false},
                    {
                        title: '操作',
                        align: 'center',
                        formatter: function(value, row, index) {
                            return '@render("iframe",["name"=>"formopbtn","extend"=>["type"=>["deleteauth"],"rowId"=>"row.id"]])';
                        }
                    }
                ]
            };
            $.table.init(options);

            //添加信息的用户
            $("#selectUser").click(function () {
                var url = cUrl + '/add?role_id=' + $("#role_id").val();
                $.modal.open("选择用户", url);
            });
        });
    </script>
@stop

