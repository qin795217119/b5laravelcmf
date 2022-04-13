@extends('admin.layout.form')

@include('widget.asset.cropper')

@section('content')
<style>
    .btn input[type="file"]{opacity: 0;position: absolute;}
    .img-container {width: 100%;margin-bottom: 1rem;max-width: 350px;}
    .img-croppermain{width: 100%;position: relative;padding-bottom: 100%;height: 0;}
    .img-cropperbox{position: absolute;width: 100%;height: 100%;overflow: hidden;background-color: #f7f7f7;text-align: center;}
   .img-preview {
       background-color: #f7f7f7;
       text-align: center;
        width: 100%;
    }
    .img-container > img {
        max-width: 100%;
        vertical-align: middle;
        border-style: none;
    }
    .cropper-hidden {
        display: none !important;
    }
    .cropper-preview-main{width: 100%;position: relative;padding-bottom: 100%;height: 0;overflow: hidden}
    .cropper-preview-con {width: 100%;height: 100%;overflow: hidden;background: #f7f7f7;position: absolute;top: 0;left: 0;display: flex;align-items: center;justify-content: center}
    .cropper-preview-box{width: 100%;height: 100%;overflow: hidden;}
</style>
<div class="row">
    <div class="col-xs-8">
        <div class="img-container">
            <div class="img-croppermain">
                <div class="img-cropperbox">
                    <img id="image">
                </div>
            </div>
        </div>
        <div class="cropper-image-tools">
            <label class="btn btn-sm btn-primary" for="select_image">
                <input type="file" name="file" id="select_image" class="cropper-image-file"
                       onchange="selectImage(this)"
                       accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                <span>选择图片</span>
            </label>
            <button id="addZoom" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
            <button id="reduceZoom" class="btn btn-sm btn-primary"><i class="fa fa-minus"></i></button>
            <button id="rotateLeft" class="btn btn-sm btn-primary"><i class="fa fa-rotate-left"></i></button>
            <button id="rotateRight" class="btn btn-sm btn-primary"><i class="fa fa-rotate-right"></i></button>
            <button id="reset" class="btn btn-sm btn-primary"><i class="fa fa-refresh"></i></button>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="cropper-preview-main">
            <div class="cropper-preview-con">
                <div class="cropper-preview-box"></div>
            </div>
        </div>

    </div>
</div>
@stop

@section('script')
    <script>
        var index = parent.layer.getFrameIndex(window.name);
        var id = "{{$id}}";
        var cat = "{{$cat}}";
        $(function () {
            selectImage();
            $("#image").cropper({
                aspectRatio: NaN,//默认比例
                viewMode: 1,
                preview: '.cropper-preview-box'
            });
        })
        $("#addZoom").click(function () {
            if ($("#image").attr("src") != null) {
                $("#image").cropper('zoom', 0.1);
            }
        });
        $("#reduceZoom").click(function () {
            if ($("#image").attr("src") != null) {
                $("#image").cropper('zoom', -0.1);
            }
        });
        $("#rotateLeft").click(function () {
            if ($("#image").attr("src") != null) {
                $("#image").cropper('rotate', -45);
            }
        });
        $("#rotateRight").click(function () {
            if ($("#image").attr("src") != null) {
                $("#image").cropper('rotate', 45);
            }
        });
        $("#reset").click(function () {
            if ($("#image").attr("src") != null) {
                $("#image").cropper('reset');
            }
        });

        function submitHandler() {
            if ($("#image").attr("src") == null) {
                $.modal.alert('请先上传图片');
            } else {
                var cas = $('#image').cropper('getCroppedCanvas');
                var base64url = cas.toDataURL('image/jpeg',0.8); //转换为base64地址形式
                var createImgUrl = data2blob(base64url, 'image/jpeg');
                var filename = $.common.getrandomkey();
                filename = filename+'.jpg';
                sendFile(createImgUrl,{file_name:filename,cat:cat},function (result) {
                    var html =  window.parent.b5uploadimghtml(result.path,id,result.url);
                    window.parent.b5uploadhtmlshow(id,html);
                    $.modal.close(index);
                })

            }
        }

        //将base64转换为Blob文件
        function data2blob(data, mime) {
            data = data.split(',')[1];
            data = window.atob(data);
            var ia = new Uint8Array(data.length);
            for (var i = 0; i < data.length; i++) {
                ia[i] = data.charCodeAt(i);
            }
            return new Blob([ia], {
                type: mime
            });
        }

        function selectImage() {
            var $inputImage = $('#select_image'), URL = window.URL || window.webkitURL, blobURL;

            if (URL) {
                $inputImage.change(function () {
                    var files = this.files, file;

                    if (files && files.length) {
                        file = files[0];
                        if (/^image\/\w+$/.test(file.type)) {
                            blobURL = URL.createObjectURL(file);
                            $("#image").one('built.cropper', function () {
                                URL.revokeObjectURL(blobURL); // Revoke when load complete
                            }).cropper('reset', true).cropper('replace', blobURL);
                            $inputImage.val('');
                        } else {
                            $.modal.alert('请选择图片文件上传');
                        }
                    }
                });
            }
        }
    </script>
@stop
