@extends('admin.public.form')

@include('widget.asset.select2')
@include('widget.asset.summernote')
@include('widget.asset.dragula')

@section('content')
    <form class="form-horizontal m" id="form-redtype-edit">
        @render('iframe',['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])
        @render('iframe',['name'=>'formselect|推荐位置','extend'=>['name'=>'adtype','required'=>1,'sm'=>'2','data'=>$adposlist,'showvalue'=>'type','showname'=>'title','place'=>'','class'=>'select2','id'=>'adtype','tips'=>'','info'=>$info]])
        @render('iframe',['name'=>'forminput|信息标题','extend'=>['name'=>'title','required'=>1,'sm'=>'2','info'=>$info]])
        <div class="form-group mb0">
            <label class="col-sm-2 control-label is-required">跳转类型：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'select','extend'=>['name'=>'redtype','required'=>1,'data'=>$typelist,'place'=>'','class'=>'form-control','info'=>$info]])
            </div>
            <label class="col-sm-3 control-label">跳转模块：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'select','extend'=>['name'=>'redfunc','data'=>$funclist,'place'=>'','class'=>'select2','info'=>$info]])
            </div>
        </div>
        @render('iframe',['name'=>'forminput|跳转值','extend'=>['name'=>'redinfo','sm'=>'2','info'=>$info,'tips'=>'当跳转类型为URL链接或信息内容时，此选项有效']])
        <div class="form-group mb0">
            <label class="col-sm-2 control-label">显示顺序：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'input','extend'=>['name'=>'listsort','type'=>'number','class'=>'form-control','info'=>$info]])
            </div>
            <label class="col-sm-3 control-label">信息状态：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'radio','extend'=>['name'=>'status','required'=>1,'info'=>$info]])
            </div>
        </div>
        @render('iframe',['name'=>'image|图片信息','extend'=>['name'=>'imglist','id'=>'adlistimgbtn','multi'=>'true','sm'=>2,'tips'=>'','drag'=>'true','info'=>$info]])
        @render('iframe',['name'=>'formtextarea|文本内容','extend'=>['name'=>'text_text','sm'=>'2','info'=>$info]])
        <div class="form-group">
            <label class="col-sm-2 control-label">图文内容：</label>
            <div class="col-sm-9">
                @render('iframe',['name'=>'input','extend'=>['name'=>'text_rich','type'=>'hidden','class'=>'summernote_content','info'=>$info]])
                <div class="summernote" data-place=""></div>
            </div>
        </div>
    </form>
@stop

@section('script')
    <script>
        var adposlist = @json($adposlist);

        function select2change(obj) {
            if(obj.attr('id')=='adtype'){
                var val=obj.val();
                $(".imglist_field .help-block").html('');
                if(adposlist.hasOwnProperty(val) && $.common.isNotEmpty(adposlist[val].note)){
                    $(".imglist_field .help-block").html('<i class="fa fa-info-circle"></i>'+adposlist[val].note+'，可拖动进行排序');
                }
            }
        }
        function submitHandler() {
            if ($.validate.form()) {
                var sHTML = $('.summernote').summernote('code');
                $(".summernote_content").val(sHTML);
                $.operate.save(oesUrl, $('#form-redtype-edit').serialize());
            }
        }
    </script>
@stop
