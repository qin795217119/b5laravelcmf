@extends('admin.public.layout')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'input|配置名称','extend'=>['name'=>'like[title]']])</li>
                    <li>@render('iframe',['name'=>'input|配置标识','extend'=>['name'=>'where[type]']])</li>
                    <li>@render('iframe',['name'=>'select|系统内置','extend'=>['name'=>'where[is_sys]','value'=>'','place'=>'所有','data'=>['否','是']]])</li>
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
                modalName: "配置",
                sortName:'listsort',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '配置ID',  sortable: true},
                    {field: 'title', title: '配置标题'},
                    {field: 'type', title: '配置标识', sortable: true},
                    {field: 'listsort', title: '显示顺序',align: 'center', sortable: true},
                    {
                        title: '类型',
                        field: 'style',
                        align: 'center',
                        sortable: true,
                        formatter: function (value, row, index) {
                            return '-';
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
        /*配置列表-详细*/
        function detail_mine(dictId) {
            var url = mUrl + '/dictdata/index?type=' + dictId;
            $.modal.openTab("配置数据", url);
        }
    </script>
@stop

