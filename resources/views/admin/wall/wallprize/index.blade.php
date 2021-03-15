@extends('admin.public.layout')

@section('content')
{{--    <p class="bg-primary mt10" style="padding: 10px;border-radius: 5px;">{{$wallInfo['title']}}</p>--}}
    <div class="col-sm-12 search-collapse">
        <form id="website-form">
            <input type="hidden" name="where[wall_id]" value="{{$wallInfo['id']}}" id="wall_id">
            <div class="select-list">
                <ul>
                    <li>所属活动：<span class="search-item-text">{{$wallInfo['title']}}</span></li>
                    <li>@render('iframe',['name'=>'input|奖品名称','extend'=>['name'=>'like[name]']])</li>

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
                modalName: "抽奖奖品",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: 'ID', align: 'center', sortable: true},
                    {field: 'title', title: '奖品等级'},
                    {field: 'name', title: '奖品名称'},
                    {field: 'number', title: '奖品数量'},
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

