@extends('admin.public.layout')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'input|字典名称','extend'=>['name'=>'like[name]']])</li>
                    <li>@render('iframe',['name'=>'input|字典标识','extend'=>['name'=>'where[type]']])</li>
                    <li>@render('iframe',['name'=>'select|字典状态','extend'=>['name'=>'where[status]','value'=>'','place'=>'所有']])</li>
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
        @render('iframe',['name'=>'deletebtn','extend'=>['column'=>'type']])
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
                modalName: "字典",
                sortName:'listsort',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '字典ID',  sortable: true},
                    {field: 'name', title: '字典名称'},
                    {
                        field: 'type',
                        title: '字典标识',
                        sortable: true,
                        formatter: function(value, row, index) {
                            return '<a href="javascript:void(0)" onclick="detail_mine(\'' + row.type + '\')">' + value + '</a>';
                        }},
                    {field: 'listsort', title: '显示顺序',align: 'center', sortable: true},
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
                            return '@render("iframe",["name"=>"formopbtn","extend"=>["type"=>["edit"],"rowId"=>"row.id"]])'+'@render("iframe",["name"=>"formopbtn","extend"=>["type"=>["list_mine"],"rowId"=>"row.type"]])'+'@render("iframe",["name"=>"formopbtn","extend"=>["type"=>["delete"],"rowId"=>"row.type"]])';
                        }
                    }
                ]
            };
            $.table.init(options);
        });
        /*字典列表-详细*/
        function detail_mine(dictId) {
            var url = mUrl + '/dictdata/index?type=' + dictId;
            $.modal.openTab("字典数据", url);
        }
    </script>
@stop

