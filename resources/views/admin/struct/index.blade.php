@extends('admin.public.layout')

@include('widget.asset.treetable')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'input|组织名称','extend'=>['name'=>'like[name]']])</li>
                    <li>@render('iframe',['name'=>'select|组织状态','extend'=>['name'=>'where[status]','value'=>'','place'=>'所有']])</li>
                    <li>
                        @render('iframe',['name'=>'searchtreebtn|搜索'])
                        @render('iframe',['name'=>'resetbtn|重置'])
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <div class="btn-group-sm" id="toolbar" role="group">
        @render('iframe',['name'=>'addbtn'])
        @render('iframe',['name'=>'editbtn'])
        @render('iframe',['name'=>'expendbtn'])
    </div>

    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-tree-table"></table>
    </div>
@endsection

@section('script')
    <script>
        var datas = '';
        $(function() {
            var options = {
                modalName: "组织",
                expandAll:true,
                columns: [{
                    field: 'selectItem',
                    radio: true
                },
                    {
                        title: '组织名称',
                        field: 'name',
                        formatter: function(value, row, index) {
                            if ($.common.isEmpty(row.icon)) {
                                return row.name;
                            } else {
                                return '<i class="' + row.icon + '"></i> <span class="nav-label">' + row.name + '</span>';
                            }
                        }
                    },
                    {
                        field: 'listsort',
                        title: '排序'
                    },
                    {
                        field: 'status',
                        title: '状态',
                        formatter: function(value, row, index) {
                            return $.view.statusShow(row,false);

                        }
                    },
                    {field: 'create_time', title: '创建时间', sortable: true},
                    {field: 'update_time', title: '更新时间',sortable: true,visible: false},
                    {field: 'note', title: '备注',visible: false},
                    {
                        title: '操作',
                        width: '20',
                        widthUnit: '%',
                        align: "left",
                        formatter: function(value, row, index) {
                            if(row.id!=100){
                                return '@render("iframe",["name"=>"formopbtn","extend"=>["type"=>["edit","add","delete"],"rowId"=>"row.id"]])';
                            }else{
                                return '@render("iframe",["name"=>"formopbtn","extend"=>["type"=>["edit","add"],"rowId"=>"row.id"]])';
                            }

                        }
                    }]
            };
            $.treeTable.init(options);
        });
    </script>
@stop
