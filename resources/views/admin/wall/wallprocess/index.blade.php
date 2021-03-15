@extends('admin.public.layout')

@section('content')
{{--    <p class="bg-primary mt10" style="padding: 10px;border-radius: 5px;">{{$wallInfo['title']}}</p>--}}
    <div class="col-sm-12 search-collapse">
        <form id="website-form">
            <input type="hidden" name="where[wall_id]" value="{{$wallInfo['id']}}" id="wall_id">
            <div class="select-list">
                <ul>
                    <li>所属活动：<span class="search-item-text">{{$wallInfo['title']}}</span></li>
                    <li>@render('iframe',['name'=>'input|日程标题','extend'=>['name'=>'like[title]']])</li>
                    <li>
                        @render('iframe',['name'=>'searchbtn|搜索'])
                        @render('iframe',['name'=>'resetbtn|重置'])
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <div class="btn-group-sm" id="toolbar" role="group">
        @render('iframe',['name'=>'addbtn','extend'=>['opid'=>$wallInfo['id']]])
        @render('iframe',['name'=>'editbtn'])
        @render('iframe',['name'=>'deletebtn'])
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        $(function () {
            var options = {
                modalName: "活动日程",
                sortName:'listsort',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: 'ID', align: 'center', sortable: true,visible: false},
                    {
                        field: '',
                        title: '序号',
                        sortable: false,
                        align: "center",
                        width: 40,
                        formatter: function (value, row, index) {
                            return $.table.serialNumber(index);
                        }
                    },
                    {field: 'daytime', title: '日期', sortable: true},
                    {
                        field: 'hour',
                        title: '时间',
                        formatter:function (value, row, index) {
                            return value?value:'-';
                        }
                    },
                    {
                        field: 'title',
                        title: '标题',
                        formatter:function (value, row, index) {
                            return $.table.tooltip(value,18);
                        }
                    },
                    {
                        field: 'desc',
                        title: '介绍',
                        formatter:function (value, row, index) {
                            return $.table.tooltip(value,20);
                        }
                    },
                    {title: '排序', field: 'listsort', align: 'center', sortable: true},
                    {
                        title: '状态',
                        field: 'status',
                        align: 'center',
                        sortable: true,
                        formatter: function (value, row, index) {
                            return $.view.statusShow(row,false);
                        }
                    },
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true,visible: false},
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

