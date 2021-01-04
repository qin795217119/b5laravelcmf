@section('css_common')
    @parent
    <link rel="stylesheet" href="{{asset('static/plugins/summernote/summernote.min.css')}}">
@stop
@section('js_common')
    @parent
    <script src="{{asset('static/plugins/summernote/summernote.min.js')}}"></script>
    <script src="{{asset('static/plugins/summernote/lang/summernote-zh-CN.min.js')}}"></script>
@stop
