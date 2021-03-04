@extends('admin.public.form')

@section('content')
    <form class="form-horizontal m" id="form-webcat-edit">
        @render('iframe',['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])
        @render('iframe',['name'=>'input','extend'=>['name'=>'parent_id','type'=>'hidden','id'=>'treeId','info'=>$info]])
        @render('iframe',['name'=>'formselect|所属站点','extend'=>['name'=>'website','data'=>$siteList,'id'=>'website','disabled'=>'','info'=>$info]])
        @render('iframe',['name'=>'input','extend'=>['name'=>'website','type'=>'hidden','info'=>$info]])
        @render('iframe',['name'=>'forminput|菜单标题','extend'=>['name'=>'title','required'=>1,'tips'=>'用户管理员分辨信息','info'=>$info]])

        @render('iframe',['name'=>'forminput|上级菜单','extend'=>['name'=>'','id'=>'treeName','readonly'=>'','addon'=>'fa-search','value'=>$info['parent_name']]])
        @render('iframe',['name'=>'forminput|菜单名称','extend'=>['name'=>'name','class'=>'form-control','required'=>1,'info'=>$info]])
        @render('iframe',['name'=>'forminput|菜单标识','extend'=>['name'=>'catkey','class'=>'form-control','required'=>1,'place'=>'字母、数字，以及破折号 (-) 和下划线 ( _ )，唯一','info'=>$info]])
        <div class="form-group mb0">
            <label class="col-sm-3 control-label is-required">显示顺序：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'input','extend'=>['name'=>'listsort','type'=>'number','class'=>'form-control','info'=>$info]])
            </div>
            <label class="col-sm-2 control-label is-required">菜单类型：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'select','extend'=>['name'=>'type','required'=>1,'data'=>$typeList,'class'=>'form-control','info'=>$info]])
            </div>
        </div>
        @render('iframe',['name'=>'forminput|请求地址','extend'=>['name'=>'url','info'=>$info,'tips'=>'当菜单类型为外链跳转时有效']])
        @render('iframe',['name'=>'forminput|关联菜单','extend'=>['name'=>'relcat','tips'=>'关联菜单标识，多个用逗号(,)间隔，用户取多个菜单的信息列表','info'=>$info]])
        <div class="form-group mb0">
            <label class="col-sm-3 control-label">菜单状态：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'radio','extend'=>['name'=>'status','info'=>$info,'data'=>['隐藏','显示']]])
            </div>
            <label class="col-sm-2 control-label">选中标识：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'input','extend'=>['name'=>'checkcode','class'=>'form-control','info'=>$info]])
            </div>
        </div>
    </form>
@stop

@section('script')
    <script>
        $(function () {
            //选择菜单树
            $("#treeName").click(function () {
                var website=$("#website").val();
                if(website=='' || !website){
                    $.modal.tips('请选择所属站点');
                    return false;
                }
                var treeId = $("#treeId").val();
                var menuId = treeId > -1 ? treeId : 1;
                var url = cUrl + "/tree?id=" + menuId + "&website=" + website;
                var options = {
                    title: '上级菜单选择',
                    width: "380",
                    url: url,
                    callBack: doSubmit
                };
                $.modal.openOptions(options);
            });

        });
        function doSubmit(index, layero){
            var body = layer.getChildFrame('body', index);
            $("#treeId").val(body.find('#treeId').val());
            $("#treeName").val(body.find('#treeName').val());
            layer.close(index);
        }
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-webcat-edit').serialize());
            }
        }
    </script>
@stop
