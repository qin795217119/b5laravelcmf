@if ($itemList != null)
    @foreach ($itemList as $key => $val)
	<div class="layui-input-inline">
		<select name="{{$val['code']}}_id" id="{{$val['code']}}_id" lay-filter="{{$val['code']}}_id" lay-search="">
			<option value="">【请选择{{$val['tname']}}】</option>
            @foreach ($val['list'] as $vo)
            <option value="{{$vo["id"]}}" @if ($vo["id"]==$val['selected']) selected="" @endif>{{$vo["name"]}}</option>
            @endforeach
        </select>
	</div>
    @endforeach
@endif

<script type="text/javascript">
layui.use(['form'],function(){

	// 声明变量
	var layer = layui.layer
	,form = layui.form
	,$ = layui.$;

	// 选择站点
	form.on('select(item_id)',function(data){
		var id = data.value;
		console.log("站点ID:"+id);
		var select = data.othis;
		if (select[0]) {
			if (id > 0) {
				$.post("/itemcate/getCateList", { 'item_id':id }, function(data){
					if (data.success) {
						var str = "";
						$.each(data.data, function(i,item){
							str += "<option value=\"" + item.id + "\" >" + item.name + "</option>";
						});
						$("#cate_id").html('<option value="">【请选择栏目】</option>' + str);
						form.render('select');
					}else{
						$("#cate_id").html('');
						form.render('select');
						layer.msg(data.msg,{ icon: 5 });
						return false;
					}
				}, 'json');
			} else {

			}
		}
	});

	// 选择栏目
	form.on("select(cate_id)",function(data){
		var id = data.value;
		console.log("栏目ID:"+id);
	});

});
</script>
