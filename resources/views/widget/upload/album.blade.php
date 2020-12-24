<style type="text/css">
	.layui-upload-drag {
	    position: relative;
	    padding: 10px;
	    border: 1px dashed #e2e2e2;
	    background-color: #fff;
	    text-align: center;
	    cursor: pointer;
	    color: #999;
		margin-right:10px;
		margin-bottom:10px;
	}
	.del_img{
		position: absolute;
		z-index: 99;
		right: 0;
		top: 0;
		width: 25px;
		height: 25px;
		display: block;
	}
	.del_img img{
		position: absolute;
		z-index: 9;
		right: 0px;
		top: 0px;
		width: 25px;
		height: 25px;
		display: inline-block;
	}
</style>

@if ($albumList != null)
    @foreach ($albumList as $key => $val)
	<div class="layui-upload-drag">
		<div class="del_img" onclick="remove_image_{{$albumName}}(this);">
			<img src="/static/admin/assets/images/delete.png">
		</div>
		<a href="{{$val}}" target="_blank">
			<img name="img_src_{{$albumName}}" src="{{$val}}" alt="{{$albumTips}}(点击放大预览)" title="{{$albumTips}}(点击放大预览)" width="{{$albumWidth}}" height="{{$albumHeight}}">
		</a>
	</div>
    @endforeach
@endif
<div class="layui-upload-drag img_upload_{{$albumName}}">
 	<img id="upload_album_{{$albumName}}" src="/static/admin/assets/images/default_upload.png" alt="上传{{$albumTips}}" title="上传{{$albumTips}}" width="{{$albumWidth}}" height="{{$albumHeight}}">
 	<input type="hidden" id="{{$albumName}}" name="{{$albumName}}" value="">
</div>

<script type="text/javascript">

layui.use(['upload','croppers'],function(){

	//声明变量
	var layer = layui.layer
		,upload = layui.upload
		,croppers = layui.croppers
		,$ = layui.$;

	// 初始化图片隐藏域
	var ids = '';
	$('img[name="img_src_{{$albumName}}"]').each(function(){
		ids += $(this).attr('src') + ","
	});
	ids = ids.substr(0, (ids.length - 1));
	$("#{{$albumName}}").val(ids);

	if({{$isCrop}}==1) {
		// 图片裁剪组件
		croppers.render({
			elem: '#upload_album_{{$albumName}}'
			,name:"{{$albumName}}"
			,saveW:{{$cropWidth}}     //保存宽度
			,saveH:{{$cropHeight}}
			,mark:{{$cropRate}}    //选取比例
			,area:['750px','500px']  //弹窗宽度
			,url: "/upload/uploadImage"
			,done: function(url){
				// 如果上传失败
				if(!url){
					return layer.msg('上传失败');
				}

				var hideStr = $("#{{$albumName}}").attr("value");
				var itemArr = hideStr.split(',');
				if(itemArr.length>="{{$albumNum}}"){
					layer.msg("最多上传{{$albumNum}}张图片",{ icon: 5,time: 1000}, function () {
						//TODO...
					});
					return false;
				}

				// 渲染界面
				var attStr = '<div class="layui-upload-drag">'+
						'<div class="del_img" onclick="remove_image_{{$albumName}}(this);">'+
						'<img src="/static/admin/assets/images/delete.png"></img>'+
						'</div>'+
						'<a href="'+url+'" target="_blank">'+
						'<img name="img_src_{{$albumName}}" src="'+url+'" alt="{{$albumTips}}(点击放大预览)" title="{{$albumTips}}(点击放大预览)" width="{{$albumWidth}}" height="{{$albumHeight}}">'+
						'</a>'+
						'</div>';
				$(".img_upload_{{$albumName}}").before(attStr);

				// 获取最新的图集
				var ids = '';
				$('img[name="img_src_{{$albumName}}"]').each(function(){
					ids += $(this).attr('src') + ","
				});
				ids = ids.substr(0, (ids.length - 1));
				// 给隐藏域赋值
				$("#{{$albumName}}").val(ids);

				return false;
			}
		});

	}else{
		/**
		 * 普通图片上传
		 */
		var uploadInst = upload.render({
			elem: '#upload_album_{{$albumName}}'
			,url: "/upload/uploadImage"
			,accept:'images'
			,acceptMime:'image/*'
			,exts: "{{$albumExts}}"
			,field:'file'//文件域字段名
			,size: {{$albumSize}} //最大允许上传的文件大小
			,multiple: true
			,number: {{$albumNum}} //最大上传张数
			,before: function(obj){
				//预读本地文件
			}
			,done: function(res){
				//上传完毕回调

				var hideStr = $("#{{$albumName}}").attr("value");
				var itemArr = hideStr.split(',');
				if(itemArr.length>="{{$albumNum}}"){
					layer.msg("最多上传{{$albumNum}}张图片",{ icon: 5,time: 1000}, function () {
						//TODO...
					});
					return false;
				}

				//如果上传失败
				if(res.status <= 0){
					return layer.msg('上传失败');
				}

				//渲染界面
				var attStr = '<div class="layui-upload-drag">'+
						'<div class="del_img" onclick="remove_image_{{$albumName}}(this);">'+
						'<img src="/static/admin/assets/images/delete.png"></img>'+
						'</div>'+
						'<a href="'+res.data+'" target="_blank">'+
						'<img name="img_src_{{$albumName}}" src="'+res.data+'" alt="{{$albumTips}}(点击放大预览)" title="{{$albumTips}}(点击放大预览)" width="{{$albumWidth}}" height="{{$albumHeight}}">'+
						'</a>'+
						'</div>';
				$(".img_upload_{{$albumName}}").before(attStr);

				//获取最新的图集
				var ids = '';
				$('img[name="img_src_{{$albumName}}"]').each(function(){
					ids += $(this).attr('src') + ","
				});
				ids = ids.substr(0, (ids.length - 1));
				//给隐藏域赋值
				$("#{{$albumName}}").val(ids);

				return false;
			}
			,error: function(){
				//请求异常回调
				return layer.msg('数据请求异常');
			}
		});
	}

});

// 删除图片
function remove_image_{{$albumName}}(obj) {
	//obj.remove();
	layui.$(obj).parent().remove();

	//获取最新的图集
	var ids = '';
	layui.$('img[name="img_src_{{$albumName}}"]').each(function(){
		ids += layui.$(this).attr('src') + ","
	});
	ids = ids.substr(0, (ids.length - 1));
	//给隐藏域赋值
	layui.$("#{{$albumName}}").val(ids);
}

</script>
