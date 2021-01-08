@extends('admin.public.layout')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'input|信息标题','extend'=>['name'=>'like[title]']])</li>
                    <li>@render('iframe',['name'=>'select|推荐位置','extend'=>['name'=>'where[adtype]','value'=>'','place'=>'所有','data'=>$adposlist]])</li>
                    <li>@render('iframe',['name'=>'select|跳转类型','extend'=>['name'=>'where[redtype]','value'=>'','place'=>'所有','data'=>$typelist]])</li>
                    <li>@render('iframe',['name'=>'select|跳转模块','extend'=>['name'=>'where[redfunc]','value'=>'','place'=>'所有','data'=>$funclist]])</li>
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
        @render('iframe',['name'=>'cachebtn'])
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        var typelist = @json($typelist);
        var funclist = @json($funclist);
        var adposlist = @json($adposlist);
        $(function () {
            var options = {
                modalName: "推荐信息",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '信息ID',  sortable: true},
                    {field: 'title', title: '信息标题'},
                    {
                        field: 'adtype',
                        title: '推荐位置',
                        formatter: function (value, row, index) {
                            return adposlist.hasOwnProperty(value)?adposlist[value]:'-';
                        }
                    },
                    {
                        field: 'redtype',
                        title: '跳转类型',
                        formatter: function (value, row, index) {
                            return typelist.hasOwnProperty(value)?typelist[value]:'-';
                        }
                    },
                    {
                        field: 'redfunc',
                        title: '跳转模块',
                        formatter: function (value, row, index) {
                            return funclist.hasOwnProperty(value)?funclist[value]:'-';
                        }
                    },
                    {
                        field: 'redinfo',
                        title: '跳转信息',
                        formatter:function (value, row, index) {
                            return value?$.table.tooltip(value,15):'-';
                        }
                    },
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

