@extends('admin.public.layout')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="website-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'input|站点标题','extend'=>['name'=>'like[title]']])</li>
                    <li>@render('iframe',['name'=>'select|站点状态','extend'=>['name'=>'where[status]','value'=>'','place'=>'所有','data'=>[1=>'开启',0=>'关闭']]])</li>
                    <li>
                        @render('iframe',['name'=>'searchbtn|搜索'])
                        @render('iframe',['name'=>'resetbtn|重置'])
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <div class="btn-group-sm" id="toolbar" role="group">
        @render('iframe',['name'=>'addbtn'])
        @render('iframe',['name'=>'editbtn'])
        @render('iframe',['name'=>'cachebtn'])
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        $(function () {
            var options = {
                modalName: "站点管理",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: 'ID', align: 'center', sortable: true},
                    {field: 'title', title: '站点标题'},
                    {   field: 'name',
                        title: '名称（前端）',
                        formatter:function (value, row, index) {
                            return '<a href="/'+row.code+'" target="_blank">'+row.name+'</a>';
                        }
                    },
                    {field: 'code', title: '标识'},
                    {
                        title: '状态',
                        field: 'status',
                        align: 'center',
                        sortable: true,
                        formatter: function (value, row, index) {
                            return $.view.statusShow(row,false,['关闭','开启']);
                        }
                    },

                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},
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

