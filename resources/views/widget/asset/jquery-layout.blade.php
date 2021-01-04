@section('css_common')
    @parent
    <link rel="stylesheet" href="{{asset('static/plugins/jquery-layout/layout-default.css')}}">
@stop
@section('js_common')
    @parent
    <script src="{{asset('static/plugins/jquery-layout/jquery.layout.min.js')}}"></script>
@stop
