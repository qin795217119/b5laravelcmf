@if ($cityList != null)
    @foreach ($cityList as $key => $val)
	<div class="layui-input-inline" style="width:165px;">
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
	var form = layui.form,
		$ = layui.$;

	// 选择省份
	form.on('select(province_id)',function(data){
		var id = data.value;
		console.log("省份ID:"+id);
		var select = data.othis;
		if (select[0]) {
			if (id > 0) {
				$.post("/city/getChilds", { 'id':id }, function(data){
					if (data.success) {
						var str = "";
						$.each(data.data, function(i,item){
							str += "<option value=\"" + i + "\" >" + item.name + "</option>";
						});
						$("#city_id").html('<option value="">【请选择市】</option>' + str);
						$("#district_id").html('<option value="">【请选择县/区】</option>');
						form.render('select');
					}else{
						layer.msg(data.msg,{ icon: 5 });

						$("#city_id").html('<option value="">【请选择市】</option>');
						$("#district_id").html('<option value="">【请选择县/区】</option>');
						form.render('select');


						return false;
					}
				}, 'json');
			} else {

			}
		}
	});

	// 选择城市
	form.on('select(city_id)',function(data){
		var id = data.value;
		console.log("城市ID:"+id);
		var select = data.othis;
		if (select[0]) {
			if (id > 0) {
				$.post("/city/getChilds", { 'id':id }, function(data){
					if (data.success) {
						var str = "";
						$.each(data.data, function(i,item){
							str += "<option value=\"" + i + "\" >" + item.name + "</option>";
						});
						$("#district_id").html('<option value="">【请选择县/区】</option>' + str);
						form.render('select');
					}
				}, 'json');
			} else {
				layer.msg(data.msg,{ icon: 5 });

				$("#district_id").html('<option value="">【请选择县/区】</option>');
				form.render('select');

				return false;
			}
		}
	});

	// 选择县区
	form.on("select(district_id)",function(data){
		var id = data.value;
		console.log("县区ID:"+id);
	});

});
</script>
