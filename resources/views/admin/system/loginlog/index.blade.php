@extends('admin.layout.layout')

@section('content')
<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <div class="select-list">
            <ul>
                <li>登录名称：<input type="text" name="like[login_name]" value=""></li>
                <li>登陆状态：
                    <select name="where[status]">
                        <option value="">全部</option>
                        <option value="1">成功</option>
                        <option value="0">失败</option>
                    </select>
                <li>
                <li class="select-time">
                    <label>登陆时间： </label>
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
    <a class="btn btn-success" onclick="$.operate.add()"><i class="fa fa-plus"></i> 新增</a>
    <a class="btn btn-primary single disabled" onclick="$.operate.edit('',this)"><i class="fa fa-edit"></i> 修改</a>
    <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll(this)"><i class="fa fa-trash"></i> 批量删除</a>
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
                sortOrder: "desc",
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '日志ID', visible:false},
                    {
                        field: '',
                        title:'序号',
                        formatter:function (value, row, index){
                            return $.table.serialNumber(index);
                        }
                    },
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
                    {field: 'create_time', title: '登陆时间', align: 'center', sortable: true}
                ]
            };
            $.table.init(options);
        });
    </script>
@stop

