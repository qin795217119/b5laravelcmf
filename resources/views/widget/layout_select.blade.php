@if ($layoutList != null)
    @foreach ($layoutList as $key => $val)
	<div class="layui-input-inline">
		<select name="{{$val['code']}}_id" id="{{$val['code']}}_id" lay-filter="{{$val['code']}}_id" lay-verify="required">
			<option value="">【请选择{{$val['tname']}}】</option>
            @foreach ($val['list'] as $vo)
                <option value="{{$vo["id"]}}" @if ($vo["id"]==$val['selected']) selected="" @endif>{{$vo["name"]}}</option>
            @endforeach
		</select>
	</div>
    @endforeach
@endif

<script type="text/javascript">
layui.use(['form','layer'],function(){

	//声明变量
	var layer = layui.layer,
		form = layui.form,
		$ = layui.$;

	//选择节点
	form.on('select(item_id)',function(data){
		var id = data.value;
		console.log("站点ID:"+id);
		var select = data.othis;
		if (select[0]) {
			if (id > 0) {
				$.post("/layoutdesc/getLayoutDescList", { 'item_id':id }, function(data){
					if (data.success) {
						var str = "";
						$.each(data.data, function(i,item){
							str += "<option value=\"" + item.loc_id + "\" >" + item.loc_desc + "</option>";
						});
						$("#loc_id").html('<option value="">【请选择页面位置】</option>' + str);
						form.render('select');
					}else{
						$("#loc_id").html('<option value="">【请选择页面位置】</option>');
						layer.msg(data.msg,{ icon: 5 });
						return false;
					}
				}, 'json');
			} else {

			}
		}
	});

	//选择节点
	form.on("select(loc_id)",function(data){
		var id = data.value;
		console.log("节点ID:"+id);
	});

});
</script>
