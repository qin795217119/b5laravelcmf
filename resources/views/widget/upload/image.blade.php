<style type="text/css">
	.layui-upload-drag {
	    position: relative;
	    padding: 10px;
	    border: 1px dashed #e2e2e2;
	    background-color: #fff;
	    text-align: center;
	    cursor: pointer;
	    color: #999;
	}
</style>
<div class="layui-input-block">
	<div class="layui-upload-drag">
	 	<a href="@if ($imageValue != null) {{$imageValue}} @else javascript:void(0); @endif" @if ($imageValue != null)target="black" @endif>
	 		<img id="{{$imageName}}_show_id" src="@if ($imageValue != null) {{$imageValue}} @else /static/admin/assets/images/default_upload.png @endif" alt="上传图片" width="{{$imageWidth}}" height="{{$imageHeight}}">
	 	</a>
	 	<input type="hidden" id="{{$imageName}}" name="{{$imageName}}" value="@if ($imageHidden != null){{$imageHidden}} @endif">
	</div>
	<div style="margin-top:10px;">
		<button type="button" class="layui-btn" id="upload_{{$imageName}}"><i class="layui-icon">&#xe67c;</i>上传{{$imageTitle}}</button>
	</div>
	@if ($showTips != null)
	<div class="layui-form-mid layui-word-aux">{{$showTips}}</div>
    @endif
</div>
<script type="text/javascript">
layui.use(['upload','croppers'],function(){
	//声明变量
	var layer = layui.layer
	,upload = layui.upload
	,croppers = layui.croppers
	,$ = layui.$;

	if({{$isCrop}}==1) {

		//图片裁剪组件
	    croppers.render({
	        elem: '#upload_{{$imageName}}'
	        ,name:"{{$imageName}}"
	        ,saveW:{{$cropWidth}}     //保存宽度
	        ,saveH:{{$cropHeight}}
	        ,mark:{{$cropRate}}    //选取比例
	        ,area:['750px','500px']  //弹窗宽度
	        ,url: "/upload/uploadImage"
	        ,done: function(url){
	        	//上传完毕回调
	            $('#{{$imageName}}').val(url);
	            $('#{{$imageName}}_show_id').attr('src',url);
	        }
	    });

	}else{

		/**
		 * 普通图片上传
		 */
		var uploadInst = upload.render({
		    elem: '#upload_{{$imageName}}'
			,url: "/upload/uploadImage"
			,accept:'images'
			,acceptMime:'image/*'
			,exts: "{{$imageExts}}"
			,field:'file'//文件域字段名
			,size: {{$imageSize}} //最大允许上传的文件大小
			,before: function(obj){
				//预读本地文件
			}
			,done: function(res){
				//上传完毕回调

				if(!res.success){
					layer.msg(res.msg,{ icon: 5 });
					return false;
				}

				//上传成功
				$('#{{$imageName}}_show_id').attr('src', res.data);
	    		$('#{{$imageName}}').val(res.data);
			}
			,error: function(){
				//请求异常回调
				return layer.msg('数据请求异常');
			}
		});

	}

});

</script>
