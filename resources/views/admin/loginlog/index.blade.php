@extends('admin.public.layout')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'input|登录名称','extend'=>['name'=>'where[login_name]']])</li>
                    <li>@render('iframe',['name'=>'input|登录地址','extend'=>['name'=>'like[ipaddr]']])</li>
                    <li>@render('iframe',['name'=>'select|登陆状态','extend'=>['name'=>'where[status]','value'=>'','place'=>'所有','data'=>[1=>'成功',0=>'失败']]])</li>
                    <li>
                        @render('iframe',['name'=>'searchbtn|搜索'])
                        @render('iframe',['name'=>'resetbtn|重置'])
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <div class="btn-group-sm" id="toolbar" role="group">
        @render('iframe',['name'=>'deletebtn'])
        @render('iframe',['name'=>'trashbtn'])
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        $(function () {
            var options = {
                modalName: "登录日志",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '日志ID', align: 'center', sortable: true},
                    {field: 'login_name', title: '登录名称'},
                    {field: 'login_location', title :'登录地点'},
                    {field: 'ipaddr', title: '登录地址'},
                    {field: 'browser', title: '浏览器'},
                    {field: 'os', title: '操作系统'},
                    {
                        title: '登录状态',
                        field: 'status',
                        align: 'center',
                        sortable: true,
                        formatter: function (value, row, index) {
                            return $.view.statusShow(row,false,['失败','成功']);
                        }
                    },
                    {field: 'msg', title: '操作信息'},
                    {field: 'login_time', title: '登陆时间', align: 'center', sortable: true}
                ]
            };
            $.table.init(options);
        });
    </script>
@stop

