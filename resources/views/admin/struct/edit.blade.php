@extends('admin.public.form')

@section('content')
    <form class="form-horizontal m" id="form-menu-add">
        @render('iframe',['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])
        @render('iframe',['name'=>'input','extend'=>['name'=>'parent_id','type'=>'hidden','id'=>'treeId','info'=>$info]])
        @render('iframe',['name'=>'forminput|上级组织','extend'=>['name'=>'','id'=>'treeName','readonly'=>'','addon'=>'fa-search','value'=>$info['parent_name']]])
        @render('iframe',['name'=>'forminput|组织名称','extend'=>['name'=>'name','required'=>1,'info'=>$info]])
        @render('iframe',['name'=>'forminput|显示顺序','extend'=>['name'=>'listsort','required'=>1,'info'=>$info]])
        @render('iframe',['name'=>'forminput|负责人','extend'=>['name'=>'leader','info'=>$info]])
        @render('iframe',['name'=>'forminput|联系电话','extend'=>['name'=>'phone','info'=>$info]])
        @render('iframe',['name'=>'formradio|组织状态','extend'=>['name'=>'status','info'=>$info]])
        @render('iframe',['name'=>'formtextarea|备注','extend'=>['name'=>'note','info'=>$info]])
    </form>
@stop

@section('script')
    <script>
        $(function () {
            //选择菜单树
            $("#treeName").click(function () {
                var treeId = $("#treeId").val();
                var menuId = treeId > 0 ? treeId : 1;
                var url = cUrl + "/tree?id=" + menuId;
                var options = {
                    title: '菜单选择',
                    width: "380",
                    url: url,
                    callBack: doSubmit
                };
                $.modal.openOptions(options);
            });

            //选择图标
            $("#icon").click(function() {
                $(".icon-drop").toggle();
            });
            $("body").click(function(event) {
                var obj = event.srcElement || event.target;
                if (!$(obj).is("#icon")) {
                    $(".icon-drop").hide();
                }
            });
            $(".icon-drop").find(".ico-list i").on("click", function() {
                $('#icon').val($(this).attr('class'));
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
                $.operate.save(oesUrl, $('#form-menu-add').serialize());
            }
        }
    </script>
@stop
