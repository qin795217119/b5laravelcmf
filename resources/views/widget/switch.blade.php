<input name="{{$switchName}}" id="{{$switchName}}" @if ($switchValue==1) checked @endif value="@if ($switchValue==1) 1 @else 2 @endif"  lay-skin="switch" lay-filter="{{$switchFilter}}" lay-text="{{$switchTitle}}" type="checkbox">
<script>
layui.use(['form'], function(){
	var form = layui.form,
		$ = layui.$;

	// 初始化
    var hidden = "{{$switchHidden}}";
    if ("{{$switchValue}}" == 1) {
        if (hidden != "") {
            $("."+hidden).removeClass("layui-hide");
        }
        $("#{{$switchName}}").attr('type', 'hidden').val(1);
    } else {
        if (hidden != "") {
            $("."+hidden).addClass("layui-hide");
        }
        $("#{{$switchName}}").attr('type', 'hidden').val(2);
    }

	form.on('switch({{$switchFilter}})', function(data) {
		console.log('switch开关选择状态：'+this.checked);
	    $(data.elem).attr('type', 'hidden').val(this.checked ? 1 : 2);
        // 设置隐藏域
        if (hidden != "") {
            var isSel = data.elem.checked;
            if (isSel) {
                $("."+hidden).removeClass("layui-hide");
            } else {
                $("."+hidden).addClass("layui-hide");
            }
        }
	});
});
</script>
