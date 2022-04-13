    <script src="{{asset('static/plugins/jquery/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('static/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- bootstrap-table 表格插件 -->
    <script src="{{asset('static/plugins/bootstrap-table/bootstrap-table.min.js')}}"></script>
    <script src="{{asset('static/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js')}}"></script>
    <script src="{{asset('static/plugins/bootstrap-table/extensions/mobile/bootstrap-table-mobile.min.js')}}"></script>
    <!-- jquery-validate 表单验证插件 -->
    <script src="{{asset('static/plugins/validate/jquery.validate.min.js')}}"></script>
    <script src="{{asset('static/plugins/validate/messages_zh.min.js')}}"></script>
    <script src="{{asset('static/plugins/validate/jquery.validate.extend.js')}}"></script>
@section('js_common')
@show
    <script src="{{asset('static/plugins/blockUI/jquery.blockUI.js')}}"></script>
    <script src="{{asset('static/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('static/plugins/layui/layui.js')}}"></script>
    <script src="{{asset('static/admin/js/iframe-ui.js')}}"></script>
    <script src="{{asset('static/admin/js/common.js')}}"></script>
@section('script_before')
@show
@section('script')
@show
@section('script_after')
@show
