@extends('admin.public.layout')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'input|公告标题','extend'=>['name'=>'like[title]']])</li>
                    <li>@render('iframe',['name'=>'select|公告类型','extend'=>['name'=>'where[type]','value'=>'','place'=>'所有','data'=>$typelist]])</li>
                    <li>
                        @render('iframe',['name'=>'searchbtn|搜索'])
                        @render('iframe',['name'=>'resetbtn|重置'])
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <div class="btn-group-sm" id="toolbar" role="group">
        @render('iframe',['name'=>'addbtn','extend'=>['full'=>'']])
        @render('iframe',['name'=>'editbtn','extend'=>['full'=>'']])
        @render('iframe',['name'=>'deletebtn'])
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        var typelist = {!! json_encode($typelist) !!};
        $(function () {
            var options = {
                modalName: "通知公告",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '公告ID', align: 'center', sortable: true},
                    {field: 'title', title: '公告标题'},
                    {
                        field: 'type',
                        title: '公告类型',
                        align: 'center',
                        formatter:function (value, row, index) {
                            if(typelist.hasOwnProperty(value)){
                                return typelist[value];
                            }else{
                                return '-';
                            }
                        }
                    },
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
                            return '@render("iframe",["name"=>"formopbtn","extend"=>["type"=>["editfull","delete"],"rowId"=>"row.id"]])';
                        }
                    }
                ]
            };
            $.table.init(options);
        });
    </script>
@stop

