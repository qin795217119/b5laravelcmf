@extends('admin.public.layout')

@include('widget.asset.treetable')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'input|菜单名称','extend'=>['name'=>'like[name]']])</li>
                    <li>@render('iframe',['name'=>'select|菜单状态','extend'=>['name'=>'where[status]','value'=>'','place'=>'所有']])</li>
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
                modalName: "菜单",
                columns: [{
                    field: 'selectItem',
                    radio: true
                },
                    {
                        title: '菜单名称',
                        field: 'name',
                        formatter: function(value, row, index) {
                            if ($.common.isEmpty(row.icon)) {
                                return row.name;
                            } else {
                                return '<i class="' + row.icon + '"></i> <span class="nav-label">' + row.name + '</span>';
                            }
                        }
                    },
                    {field: 'listsort', title: '排序',},
                    {
                        field: 'url',
                        title: '请求地址',
                        formatter: function(value, row, index) {
                            return $.table.tooltip(value);
                        }
                    },
                    {
                        title: '类型',
                        field: 'type',
                        formatter: function(value, item, index) {
                            if (item.type == 'M') {
                                return '<span class="label label-success">目录</span>';
                            }
                            else if (item.type == 'C') {
                                return '<span class="label label-primary">菜单</span>';
                            }
                            else if (item.type == 'F') {
                                return '<span class="label label-warning">按钮</span>';
                            }
                        }
                    },
                    {
                        field: 'status',
                        title: '可见',
                        formatter: function(value, row, index) {
                            if (row.type == 'F') {
                                return $.view.statusShow(row,false,['禁止访问','可以访问']);
                            }
                            return $.view.statusShow(row,false,['隐藏','显示']);

                        }
                    },
                    {
                        field: 'perms',
                        title: '权限标识',
                        formatter: function(value, row, index) {
                            if(!value){
                                return '-';
                            }else{
                                return value;
                            }
                        }
                    },
                    {field: 'note', title: '备注',visible:false},
                    {
                        title: '操作',
                        formatter: function(value, row, index) {
                            return '@render("iframe",["name"=>"formopbtn","extend"=>["type"=>["edit","add","delete"],"rowId"=>"row.id"]])';
                        }
                    }]
            };
            $.treeTable.init(options);
        });
    </script>
@stop
