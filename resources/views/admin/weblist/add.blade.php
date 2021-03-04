@extends('admin.public.form')

@include('widget.asset.mypicker')
@include('widget.asset.summernote')
@include('widget.asset.dragula')

@section('content')
    <form class="form-horizontal m" id="form-weblist-add">
        <div class="form-group mb0">
            <label class="col-sm-2 control-label is-required">所属菜单：</label>
            <div class="col-sm-3 mb15">
                <input type="hidden" name="catid" id="treeId" value="{{$catInfo['id']}}">
                <input type="hidden" id="treeType" value="{{$catInfo['type']}}">
                <input type="text" id="treeName" value="{{$catInfo['title']}}" class="form-control" readonly>
            </div>
            <label class="col-sm-3 control-label is-required">所属站点：</label>
            <div class="col-sm-3 mb15">
                <input type="hidden" name="website" id="website" value="{{$catInfo['website']}}">
                <input type="text" value="{{$catInfo['website_info']['title']??'未选择'}}" class="form-control" disabled>
            </div>
        </div>
        @render('iframe',['name'=>'forminput|信息标题','extend'=>['name'=>'title','required'=>1,'sm'=>'2']])
        <div class="form-group mb0">
            <label class="col-sm-2 control-label">信息来源：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'input','extend'=>['name'=>'froms','class'=>'form-control']])
            </div>
            <label class="col-sm-3 control-label">编辑作者：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'input','extend'=>['name'=>'author','class'=>'form-control']])
            </div>
        </div>
        @render('iframe',['name'=>'formtextarea|信息简介','extend'=>['name'=>'remark','sm'=>'2','tips'=>'为空时自动截取内容的前100个字符']])
        <div class="form-group mb0">
            <label class="col-sm-2 control-label">发布时间：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'input','extend'=>['name'=>'subtime','class'=>'form-control','id'=>'subtime','value'=>date('Y-m-d H:i:s'),'readonly'=>'']])
            </div>
            <label class="col-sm-3 control-label">信息状态：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'radio','extend'=>['name'=>'status','required'=>1,'value'=>1]])
            </div>
        </div>
        @render('iframe',['name'=>'forminput|外链地址','extend'=>['name'=>'linkurl','sm'=>'2','tips'=>'详情为第三链接时，点击跳转到改地址']])
        @render('iframe',['name'=>'image|图片信息','extend'=>['name'=>'imglist','id'=>'weblistimgbtn','multi'=>'true','sm'=>2,'tips'=>'默认第一张为该信息的缩略图','cat'=>'weblist','drag'=>'true']])
        <div class="form-group">
            <label class="col-sm-2 control-label">图文内容：</label>
            <div class="col-sm-9">
                @render('iframe',['name'=>'input','extend'=>['name'=>'content','type'=>'hidden','class'=>'summernote_content']])
                <div class="summernote" data-place=""></div>
            </div>
        </div>
    </form>
@stop

@section('script')
    <script>
        $(function () {
            $("#subtime").click(function () {
                WdatePicker({maxDate:'%y-%M-%d',dateFmt:'yyyy-MM-dd HH:mm:ss'})
            });
            //选择菜单树
            $("#treeName").click(function () {
                var website=$("#website").val();
                var treeId = $("#treeId").val();
                var menuId = treeId > -1 ? treeId : 1;
                var url = mUrl + "/webcat/tree?id=" + menuId + "&website=" + website + "&root=0";
                var options = {
                    title: '菜单选择',
                    width: "380",
                    url: url,
                    callBack: doSubmit,
                    onClick : zOnClick
                };
                $.modal.openOptions(options);
            });
        })
        function zOnClick(event, treeId, treeNode) {
            console.log(treeNode)
        }
        function doSubmit(index, layero){
            var body = layer.getChildFrame('body', index);
            $("#treeId").val(body.find('#treeId').val());
            $("#treeName").val(body.find('#treeName').val());
            var nodeInfo=JSON.parse(body.find("#treeNodeInput").val());
            $("#treeType").val(nodeInfo.type);
            layer.close(index);
        }
        function submitHandler() {
            if ($.validate.form()) {
                var sHTML = $('.summernote').summernote('code');
                $(".summernote_content").val(sHTML);
                $.operate.save(oasUrl, $('#form-weblist-add').serialize());
            }
        }
    </script>
@stop
