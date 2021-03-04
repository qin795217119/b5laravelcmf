@extends('admin.public.form')

@include('widget.asset.select2')
@include('widget.asset.summernote')
@include('widget.asset.dragula')

@section('content')
    <form class="form-horizontal m" id="form-webad-add">
        <div class="form-group mb0">
            <label class="col-sm-2 control-label is-required">广告位置：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'select','extend'=>['name'=>'pos_id','data'=>[],'required'=>1,'id'=>'webpos']])
            </div>
            <label class="col-sm-3 control-label is-required">所属站点：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'select','extend'=>['name'=>'website','required'=>1,'data'=>$siteList,'place'=>'请选择所属站点','class'=>'select2','id'=>'website','value'=>$input['website']??'']])
            </div>
        </div>
        @render('iframe',['name'=>'forminput|信息标题','extend'=>['name'=>'title','required'=>1,'sm'=>'2']])
        @render('iframe',['name'=>'forminput|外链地址','extend'=>['name'=>'linkurl','sm'=>'2']])
        <div class="form-group mb0">
            <label class="col-sm-2 control-label">显示顺序：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'input','extend'=>['name'=>'listsort','type'=>'number','class'=>'form-control']])
            </div>
            <label class="col-sm-3 control-label">信息状态：</label>
            <div class="col-sm-3 mb15">
                @render('iframe',['name'=>'radio','extend'=>['name'=>'status','required'=>1,'value'=>1]])
            </div>
        </div>
        @render('iframe',['name'=>'image|图片信息','extend'=>['name'=>'imglist','id'=>'adlistimgbtn','multi'=>'true','sm'=>2,'tips'=>'','cat'=>'webadlist','drag'=>'true']])
        @render('iframe',['name'=>'formtextarea|文本内容','extend'=>['name'=>'text_text','sm'=>'2']])
        <div class="form-group">
            <label class="col-sm-2 control-label">图文内容：</label>
            <div class="col-sm-9">
                @render('iframe',['name'=>'input','extend'=>['name'=>'text_rich','type'=>'hidden','class'=>'summernote_content']])
                <div class="summernote" data-place=""></div>
            </div>
        </div>
    </form>
@stop

@section('script')
    <script>
        var posList=@json($posList);
        var pos_id="{{isset($input['pos_id'])?($input['pos_id']?:''):''}}";
        $(function () {
            getPos();
        });
        function select2change(obj) {
            if(obj.attr('id')=='website'){
                getPos();
            }
        }
        function getPos() {
            var website=$("#website").find("option:selected").val();
            var html='<option value="">请选择广告位置</option>';

            if(website && posList.hasOwnProperty(website)){
                var thisposarr=posList[website];
                if(thisposarr.length>0){
                    for(var i=0;i<thisposarr.length;i++){
                        var checked='';
                        if(thisposarr[i].id==pos_id) checked='selected';
                        html+='<option value="'+thisposarr[i].id+'" '+checked+'>'+thisposarr[i].title+'</option>';
                    }
                }
            }
            $("#webpos").html(html).select2();
        }

        function submitHandler() {
            if ($.validate.form()) {
                var sHTML = $('.summernote').summernote('code');
                $(".summernote_content").val(sHTML);
                $.operate.save(oasUrl, $('#form-webad-add').serialize());
            }
        }
    </script>
@stop
