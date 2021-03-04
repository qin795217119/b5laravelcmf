@extends('admin.public.layout')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'select|站点平台','extend'=>['name'=>'where[website]','data'=>$siteList,'id'=>'website']])</li>
                    <li>@render('iframe',['name'=>'input|位置名称','extend'=>['name'=>'like[title]']])</li>
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
        <a class="btn btn-danger" onclick="cacheDel()"><i class="fa fa-refresh"></i> 清理缓存</a>
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        var websiteList=@json($siteList);
        $(function () {
            var options = {
                modalName: "位置",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '位置ID',  sortable: true},
                    {field: 'title', title: '位置名称'},
                    {
                        field: 'website',
                        title: '所属站点',
                        sortable: true,
                        formatter:function (value, row, index) {
                            if(websiteList.hasOwnProperty(row.website)){
                                return $.table.tooltip(websiteList[row.website],20);
                            }else{
                                return '-';
                            }

                        }
                    },
                    {
                        field: 'width',
                        title: '宽度',
                        formatter:function (value, row, index) {
                            if(value=='0'){
                                return '-';
                            }
                            return value;
                        }
                    },
                    {
                        field: 'height',
                        title: '高度',
                        formatter:function (value, row, index) {
                            if(value=='0'){
                                return '-';
                            }
                            return value;
                        }
                    },
                    {
                        field: 'note',
                        title: '备注',
                        formatter:function (value, row, index) {
                            return $.table.tooltip(value,20);
                        }
                    },
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
        function cacheDel() {
            var website=$("#website").val();
            $.operate.clearcache('website='+website);
        }
    </script>
@stop

