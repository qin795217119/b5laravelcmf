@extends('admin.public.layout')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'input|跳转名称','extend'=>['name'=>'like[title]']])</li>
                    <li>@render('iframe',['name'=>'input|跳转标识','extend'=>['name'=>'like[type]']])</li>
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
                modalName: "跳转",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '跳转ID',  sortable: true},
                    {field: 'title', title: '跳转名称'},
                    {field: 'type', title: '跳转标识'},
                    {field: 'list_url', title: '模块连接'},
                    {field: 'info_url', title: '信息链接'},
                    {
                        title: '状态',
                        field: 'status',
                        align: 'center',
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
                            return '@render("iframe",["name"=>"formopbtn","extend"=>["type"=>["edit","delete"],"rowId"=>"row.id"]])';
                        }
                    }
                ]
            };
            $.table.init(options);
        });
    </script>
@stop

