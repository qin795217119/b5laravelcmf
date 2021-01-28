@extends('admin.public.layout')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'input|活动名称','extend'=>['name'=>'like[title]']])</li>
                    <li class="select-time">
                        <label>创建时间： </label>
                        @render('iframe',['name'=>'input','extend'=>['name'=>'between[create_time][start]','id'=>'startTime','class'=>'time-input','place'=>'开始时间']])
                        <span>-</span>
                        @render('iframe',['name'=>'input','extend'=>['name'=>'between[create_time][end]','id'=>'endTime','class'=>'time-input','place'=>'结束时间']])
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
                modalName: "预约报名",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: 'ID', align: 'center', sortable: true},
                    {field: 'title', title: '活动名称'},
                    {
                        field: 'money',
                        title: '预约金额',
                        align: 'center',
                        formatter:function (value, row, index) {
                            if(value && value>0){
                                return value;
                            }else{
                                return '-'
                            }
                        }
                    },
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

