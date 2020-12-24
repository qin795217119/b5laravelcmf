<input name="{{$name}}" id="{{$name}}" @if($value) checked @endif value="@if($value) 1 @else 0 @endif"  lay-skin="switch" lay-filter="{{$filter??$name}}" lay-text="{{$text??'正常|禁用'}}" type="checkbox" @if(isset($event)) lay-event="{{$event}}" @endif>

<script>
layui.use(['form'], function(){
	var form = layui.form;
    $("#{{$name}}").attr('type', 'hidden').val("{{$value?1:0}}");
	form.on('switch({{$filter??$name}})', function(data) {
	    $(data.elem).val(this.checked ? 1 : 0);
	});
});
</script>
