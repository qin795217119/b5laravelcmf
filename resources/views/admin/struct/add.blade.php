@extends('admin.public.form')

@section('content')
    <form class="form-horizontal m" id="form-struct-add">
        @render('iframe',['name'=>'input','extend'=>['name'=>'parent_id','type'=>'hidden','id'=>'treeId','value'=>$parent_id]])
        @render('iframe',['name'=>'forminput|上级组织','extend'=>['name'=>'','id'=>'treeName','readonly'=>'','addon'=>'fa-search','value'=>$parent_name]])
        @render('iframe',['name'=>'forminput|组织名称','extend'=>['name'=>'name','required'=>1]])
        @render('iframe',['name'=>'forminput|显示顺序','extend'=>['name'=>'listsort','required'=>1]])
        @render('iframe',['name'=>'forminput|负责人','extend'=>['name'=>'leader']])
        @render('iframe',['name'=>'forminput|联系电话','extend'=>['name'=>'phone']])
        @render('iframe',['name'=>'formradio|组织状态','extend'=>['name'=>'status','value'=>1]])
        @render('iframe',['name'=>'formtextarea|备注','extend'=>['name'=>'note']])
    </form>
@stop

@section('script')
    <script>
        $(function () {
            //选择组织树
            $("#treeName").click(function () {
                var treeId = $("#treeId").val();
                var menuId = treeId > 0 ? treeId : 1;
                var url = cUrl + "/tree?id=" + menuId;
                var options = {
                    title: '组织选择',
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
                $.operate.save(oasUrl, $('#form-struct-add').serialize());
            }
        }
    </script>
@stop
