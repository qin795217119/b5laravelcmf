@extends('admin.public.layout')

@section('content')
{{--    <p class="bg-primary mt10" style="padding: 10px;border-radius: 5px;">{{$wallInfo['title']}}</p>--}}
    <div class="col-sm-12 search-collapse">
        <form id="website-form">
            <input type="hidden" name="where[wall_id]" value="{{$wallInfo['id']}}" id="wall_id">
            <div class="select-list">
                <ul>
                    <li>所属活动：<span class="search-item-text">{{$wallInfo['title']}}</span></li>
                    <li>@render('iframe',['name'=>'input|真实姓名','extend'=>['name'=>'like[truename]']])</li>
                    <li>@render('iframe',['name'=>'input|电话','extend'=>['name'=>'where[mobile]']])</li>
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
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        $(function () {
            var options = {
                modalName: "签到会员",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: 'ID', align: 'center', sortable: true},
                    {
                        field: 'headimg',
                        title: '头像',
                        formatter:function (value, row, index) {
                            if(value!=''){
                                return '<img src="'+value+'" style="height: 30px">';
                            }else{
                                return '-';
                            }
                        }
                    },
                    {field: 'nickname', title: '昵称'},
                    {
                        field: 'truename',
                        title: '真实姓名',
                        formatter:function (value, row, index) {
                            if(value){
                                return value;
                            }else{
                                return '-';
                            }
                        }
                    },
                    {
                        field: 'mobile',
                        title: '电话',
                        formatter:function (value, row, index) {
                            if(value){
                                return value;
                            }else{
                                return '-';
                            }
                        }
                    },
                    {
                        field: 'sex',
                        title: '性别',
                        formatter:function (value, row, index) {
                            if(value=='1'){
                                return '男';
                            }else if(value=='2'){
                                return '女';
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
                            return $.view.statusTools(row,true);
                        }
                    },
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false}
                ]
            };
            $.table.init(options);
        });
    </script>
@stop

