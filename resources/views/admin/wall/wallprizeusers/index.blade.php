@extends('admin.public.layout')
@include('widget.asset.select2')
@section('content')
{{--    <p class="bg-primary mt10" style="padding: 10px;border-radius: 5px;">{{$wallInfo['title']}}</p>--}}
    <div class="col-sm-12 search-collapse">
        <form id="website-form">
            <input type="hidden" name="where[wall_id]" value="{{$wallInfo['id']}}" id="wall_id">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'select|中奖奖品','extend'=>['name'=>'where[prize_id]','data'=>$prizeList,'showvalue'=>'id','showname'=>'name','place'=>'','class'=>'select2']])</li>
                    <li>@render('iframe',['name'=>'input|人员姓名','extend'=>['name'=>'like[truename]']])</li>
                    <li>@render('iframe',['name'=>'input|人员电话','extend'=>['name'=>'like[mobile]']])</li>
                    <li>@render('iframe',['name'=>'select|领取状态','extend'=>['name'=>'where[status]','value'=>'','place'=>'所有','data'=>['未领取','已领取']]])</li>
                    <li>
                        @render('iframe',['name'=>'searchbtn|搜索'])
                        @render('iframe',['name'=>'resetbtn|重置'])
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <div class="btn-group-sm" id="toolbar" role="group">
        @render('iframe',['name'=>'deletebtn'])
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        var prizeList=@json($prizeList);
        $(function () {
            var options = {
                modalName: "中奖信息",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: 'ID', align: 'center', sortable: true},
                    {
                        field: 'prize_id',
                        title: '奖品信息',
                        formatter:function (value, row, index) {
                            if(prizeList.hasOwnProperty(value)){
                                return '<img src="'+prizeList[value].thumbimg+'" style="height: 32px"> '+prizeList[value].name+'（'+prizeList[value].title+'）';
                            }
                        }
                    },
                    {
                        field: 'truename',
                        title: '中奖人员',
                        align: 'center',
                        formatter:function (value, row, index) {
                            return row.truename+'<br/>'+row.mobile;

                        }
                    },
                    {
                        title: '状态',
                        field: 'status',
                        align: 'center',
                        formatter: function (value, row, index) {
                            return $.view.statusShow(row,true,['未领取','已领取']);
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

