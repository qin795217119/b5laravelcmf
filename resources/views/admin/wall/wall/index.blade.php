@extends('admin.public.layout')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="website-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'input|活动名称','extend'=>['name'=>'like[title]']])</li>
                    <li>@render('iframe',['name'=>'select|站点状态','extend'=>['name'=>'where[status]','value'=>'','place'=>'所有','data'=>[1=>'开启',0=>'关闭']]])</li>
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
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        $(function () {
            var options = {
                modalName: "现场抽奖",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: 'ID', align: 'center', sortable: true},
                    {
                        field: 'title',
                        title: '站点标题',
                        formatter:function (value, row, index) {
                            return '<a href="/wall?wall_id='+row.id+'" target="_blank">'+$.table.tooltip(value,25)+'</a>'
                        }
                    },
                    {
                        title: '活动状态',
                        field: 'status',
                        align: 'center',
                        sortable: true,
                        formatter: function (value, row, index) {
                            return $.view.statusShow(row,false,['关闭','开启']);
                        }
                    },
                    {
                        title: '报名状态',
                        field: 'isopen',
                        align: 'center',
                        sortable: true,
                        formatter: function (value, row, index) {
                            return $.view.statusShow(row,false,['关闭','开启'],'isopen');
                        }
                    },
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},
                    {
                        title: '操作',
                        align: 'center',
                        formatter: function(value, row, index) {
                            var actions = [];
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:;" onclick="$.operate.edit(\'' + row.id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                            actions.push('<a class="btn btn-danger btn-xs" href="javascript:;" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-remove"></i>删除</a> ');

                            var more = [];
                            more.push("<a class='btn btn-default btn-xs' href='javascript:;' onclick='prizeSet(" + row.id + ")'><i class='fa fa-gift'></i> 奖品设置</a> ");
                            more.push("<a class='btn btn-default btn-xs' href='javascript:;' onclick='regUser(" + row.id + ")'><i class='fa fa-user'></i> 签到会员</a>");
                            more.push("<a class='btn btn-default btn-xs' href='javascript:;' onclick='processList(" + row.id + ")'><i class='fa fa-calendar'></i> 活动日程</a>");
                            more.push("<a class='btn btn-default btn-xs' href='javascript:;' onclick='dataClear(" + row.id + ")'><i class='fa fa-trash'></i> 数据清除</a>");
                            actions.push('<a tabindex="0" class="btn btn-info btn-xs" data-placement="left" data-toggle="popover" data-html="true" data-trigger="focus" data-container="body" data-content="' + more.join('') + '"><i class="fa fa-chevron-circle-right"></i>更多操作</a>');
                            return actions.join('');
                        }
                    }
                ]
            };
            $.table.init(options);
        });

        function prizeSet(wall_id) {
            var url = mUrl + '/wallprize/index?wall_id=' + wall_id;
            $.modal.openTab("【"+wall_id+"】活动奖品", url);
        }
        function regUser(wall_id) {
            var url = mUrl + '/wallusers/index?wall_id=' + wall_id;
            $.modal.openTab("【"+wall_id+"】签到会员", url);
        }
        function processList(wall_id) {
            var url = mUrl + '/wallprocess/index?wall_id=' + wall_id;
            $.modal.openTab("【"+wall_id+"】活动日程", url);
        }
    </script>
@stop

