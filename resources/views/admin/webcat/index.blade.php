@extends('admin.public.layout')

@include('widget.asset.treetable')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="webcat-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'select|站点平台','extend'=>['name'=>'where[website]','data'=>$siteList,'id'=>'website','value'=>$website]])</li>
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
        @render('iframe',['name'=>'btn|新增','extend'=>['class'=>'btn-success','id'=>'addWebCat']])
        @render('iframe',['name'=>'editbtn'])
        @render('iframe',['name'=>'expendbtn'])
        <a class="btn btn-danger" onclick="cacheDel()"><i class="fa fa-refresh"></i> 清理缓存</a>
    </div>

    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-tree-table"></table>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            var options = {
                url: cUrl + "/index?website={{$website}}",
                modalName: "网站菜单",
                columns: [{
                    field: 'selectItem',
                    radio: true
                },

                {title: '菜单名称(前端)', field: 'name'},
                {
                    title: '菜单标题',
                    field: 'title',
                    formatter: function(value, row, index) {
                        return $.table.tooltip(value,7);
                    }
                },
                    {title: 'ID', field: 'id'},
                {title: '排序', field: 'listsort'},
                {title: '类型', field: 'type_name'},
                {
                    field: 'status',
                    title: '可见',
                    formatter: function(value, row, index) {
                        return $.view.statusShow(row,false,['隐藏','显示']);
                    }
                },
                {
                    title: '操作',
                    formatter: function(value, row, index) {
                        return '@render("iframe",["name"=>"formopbtn","extend"=>["type"=>["edit","add","delete"],"rowId"=>"row.id"]])';
                    }
                }]
            };
            $.treeTable.init(options);

            //新增字典数据-传入当前网站
            $("#addWebCat").click(function () {
                var website = $("#website option:selected").val();
                $.operate.addExt("website="+website);
            })
        });
        function cacheDel() {
            var website=$("#website").val();
            $.operate.clearcache('website='+website);
        }
    </script>
@stop
