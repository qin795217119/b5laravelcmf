@extends('admin.public.layout')

@include('widget.asset.select2')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>@render('iframe',['name'=>'select|所属站点','extend'=>['name'=>'website','data'=>$siteList,'id'=>'website','class'=>'select2']])</li>
                    <li>@render('iframe',['name'=>'select|广告位置','extend'=>['name'=>'where[pos_id]','id'=>'webpos','data'=>[]]])</li>
                    <li>@render('iframe',['name'=>'input|信息标题','extend'=>['name'=>'like[title]']])</li>
                    <li>
                        @render('iframe',['name'=>'searchbtn|搜索'])
                        <a class="btn btn-warning btn-rounded btn-sm" onclick="resetSearch()"><i class="fa fa-refresh"></i>&nbsp;重置</a>
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <div class="btn-group-sm" id="toolbar" role="group">
        <a class="btn btn-success addbtn_cc" onclick="toAdd()"><i class="fa fa-plus"></i> 新增</a>
        @render('iframe',['name'=>'editbtn'])
        @render('iframe',['name'=>'deletebtn'])
        @render('iframe',['name'=>'cachebtn'])
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        var posList=@json($posList);
        $(function () {
            getPos();
            var options = {
                modalName: "推荐信息",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '信息ID',  sortable: true},
                    {field: 'title', title: '信息标题'},
                    {
                        field: 'pos_id',
                        title: '广告位置',
                        formatter: function (value, row, index) {
                            return getPosName(row);
                        }
                    },
                    {
                        title: '状态',
                        field: 'status',
                        align: 'center',
                        formatter: function (value, row, index) {
                            return $.view.statusShow(row,false);
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

        function getPosName(row) {
            var website=row.website;
            if(website && posList.hasOwnProperty(website)){
                var thisposarr=posList[website];
                if(thisposarr.length>0){
                    for(var i=0;i<thisposarr.length;i++){
                        if(thisposarr[i].id==row.pos_id){
                            return thisposarr[i].title;
                        }
                    }
                }
            }
            return row.pos_id;
        }
        function select2change(obj) {
            if(obj.attr('id')=='website'){
                getPos();
            }
        }

        function resetSearch() {
            $.form.reset();
            $("#website").select2('destroy').select2();
            $("#webpos").select2('destroy').select2();
        }
        function toAdd() {
            var pos_id=$("#webpos").find("option:selected").val();
            var website=$("#website").find("option:selected").val();
            if(!website) return false;
            $.operate.addExt("website="+website+"&pos_id="+pos_id,null,false);
        }
        function getPos() {
            var website=$("#website").find("option:selected").val();
            if(!website){
                $("#addbtn_cc").addClass('disabled');
            }else{
                $("#addbtn_cc").removeClass('disabled');
            }
            var html='<option value="">请选择广告位置</option>';
            if(website && posList.hasOwnProperty(website)){
                var thisposarr=posList[website];
                if(thisposarr.length>0){
                    for(var i=0;i<thisposarr.length;i++){
                        html+='<option value="'+thisposarr[i].id+'">'+thisposarr[i].title+'</option>';
                    }
                }
            }
            $("#webpos").html(html).select2();
        }
    </script>
@stop

