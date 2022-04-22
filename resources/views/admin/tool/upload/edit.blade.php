@extends('admin.layout.form')

@include('widget.asset.dragula')
@include('widget.asset.upload')

@section('content')
    <form class="form-horizontal m" id="form-edit">
        <input type="hidden" name="id" value="{{$info['id']}}">
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">单图：</label>
            <div class="col-sm-8">
                <input type="hidden" name="img" value="" id="img" required>
                <x-upload type="img" name="img_upload" :extend="['cat'=>'demo','link'=>1,'tips'=>'格式为jpg,jpeg,png,gif；大小不能超过10M','data'=>$info['img']]"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">多图：</label>
            <div class="col-sm-8">
                <input type="hidden" name="imgs" value="" id="imgs" required>
                <x-upload type="img" name="imgs_upload" :extend="['cat'=>'demo','link'=>1,'multi'=>5,'tips'=>'格式为jpg,jpeg,png,gif；大小不能超过10M；最多上传5张；可拖动排序','data'=>$info['imgs']]"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">裁剪图片：</label>
            <div class="col-sm-8">
                <input type="hidden" name="crop" value="" id="crop" required>
                <x-upload type="img" name="crop_upload" :extend="['cat'=>'demo','link'=>1,'multi'=>2,'crop'=>1,'tips'=>'格式为jpg,jpeg,png,gif；大小不能超过10M；最多上传2张；可拖动排序','data'=>$info['crop']]"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">视频：</label>
            <div class="col-sm-8">
                <input type="hidden" name="video" value="" id="video" required>
                <x-upload type="video" name="video_upload" :extend="['cat'=>'demo','tips'=>'格式为mp4；大小不能超过100M','data'=>$info['video']]"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">单文件：</label>
            <div class="col-sm-8">
                <input type="hidden" name="file" value="" id="file" required>
                <x-upload type="file" name="file_upload" :extend="['cat'=>'demo','link'=>1,'exts'=>'txt|rar|doc|png', 'tips'=>'格式为txt|rar|doc|png；大小不能超过100M','data'=>$info['file']]"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">多文件：</label>
            <div class="col-sm-8">
                <input type="hidden" name="files" value="" id="files" required>
                <x-upload type="file" name="files_upload" :extend="['cat'=>'demo','link'=>1,'multi'=>3,'exts'=>'txt|rar|doc|png', 'tips'=>'格式为txt|rar|doc|png；最大上传3个；大小不能超过100M','data'=>$info['files']]"/>
            </div>
        </div>

        <div class="row m-t-md">
            <div class="col-sm-offset-5 col-sm-10">
                <button type="button" class="btn btn-sm btn-primary" onclick="submitHandler()"><i class="fa fa-check"></i>保 存</button>
                <button type="button" class="btn btn-sm btn-danger" onclick="closeItem()"><i class="fa fa-reply-all"></i>关 闭 </button>
            </div>
        </div>
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            var img = '';
            var imgs = [];
            var crop = [];
            var file = [];
            var files = [];

            if($("input[name='img_upload[]']").length>0){
                $("input[name='img_upload[]']").each(function () {
                    var imgval = $(this).val();
                    if(imgval){
                        img = imgval;
                    }
                })
            }
            $("#img").val(img);

            if($("input[name='imgs_upload[]']").length>0){
                $("input[name='imgs_upload[]']").each(function () {
                    var imgval = $(this).val();
                    if(imgval){
                        imgs.push(imgval)
                    }
                })
            }
            $("#imgs").val(imgs.join(','));

            if($("input[name='crop_upload[]']").length>0){
                $("input[name='crop_upload[]']").each(function () {
                    var imgval = $(this).val();
                    if(imgval){
                        crop.push(imgval)
                    }
                })
            }
            $("#crop").val(crop.join(','));

            $("#video").val($("#videourl_video_upload").val());

            if($("input[name='file_upload[]']").length>0){
                $("input[name='file_upload[]']").each(function () {
                    var imgval = $(this).val();
                    if(imgval){
                        file = imgval
                    }
                })
            }
            $("#file").val(file);

            if($("input[name='files_upload[]']").length>0){
                $("input[name='files_upload[]']").each(function () {
                    var imgval = $(this).val();
                    if(imgval){
                        files.push(imgval)
                    }
                })
            }
            $("#files").val(files.join(','));

            if ($.validate.form("",{ignore:""})) {

                $.operate.saveTab(oesUrl, $('#form-edit').serialize());
            }
        }
    </script>
@stop
