<div class="layui-form-item text-center @if ($buttonType==1) model-form-footer @endif">
	@if (isset($button_submit))
	<button class="layui-btn" lay-filter="submitForm" lay-submit="">{{$button_submit_title}}</button>
	@endif
    @if (isset($button_close))
	<button class="layui-btn layui-btn-primary" type="button" ew-event="closeDialog">{{$button_close_title}}</button>
    @endif
    @if (isset($button_reset))
	<button type="reset" class="layui-btn layui-btn-normal">{{$button_reset_title}}</button>
    @endif
</div>
