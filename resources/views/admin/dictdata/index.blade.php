@extends('admin.public.layout')
@section('css_common')
    @parent
    <link rel="stylesheet" href="{{asset('static/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('static/plugins/select2/select2-bootstrap.css')}}">
@stop
@section('js_common')
    @parent
    <script src="{{asset('static/plugins/select2/select2.min.js')}}"></script>
@stop
@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'select|字典类型','extend'=>['name'=>'where[type]','id'=>'dictType','class'=>'select2','data'=>$typelist,'showvalue'=>'type','showname'=>'name','place'=>'所有字典','value'=>$input['type']??'']])</li>
                    <li>@render('iframe',['name'=>'input|数据标签','extend'=>['name'=>'where[name]']])</li>
                    <li>@render('iframe',['name'=>'select|数据状态','extend'=>['name'=>'where[status]','value'=>'','place'=>'所有']])</li>
                    <li>
                        @render('iframe',['name'=>'searchbtn|搜索'])
                        @render('iframe',['name'=>'resetbtn|重置'])
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <div class="btn-group-sm" id="toolbar" role="group">
        @render('iframe',['name'=>'btn|新增','extend'=>['class'=>'btn-success','id'=>'addDictData']])
        @render('iframe',['name'=>'editbtn'])
        @render('iframe',['name'=>'deletebtn'])
        @render('iframe',['name'=>'exportbtn'])
        @render('iframe',['name'=>'closetab'])
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        $(function () {
            var options = {
                modalName: "数据",
                sortName:'listsort',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '数据ID',  sortable: true},
                    {field: 'name', title: '数据标签'},
                    {field: 'value', title: '数据值'},
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
                            return '@render("iframe",["name"=>"formopbtn","extend"=>["type"=>["edit","delete"],"rowId"=>"row.id"]])';
                        }
                    }
                ]
            };
            $.table.init(options);

            //新增字典数据-传入当前类型
            $("#addDictData").click(function () {
                var dictType = $("#dictType option:selected").val();
                $.operate.add(dictType);
            })
        });
    </script>
@stop

