@section('css_common')
    @parent
    <link rel="stylesheet" href="{{asset('static/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('static/plugins/select2/select2-bootstrap.css')}}">
@stop
@section('js_common')
    @parent
    <script src="{{asset('static/plugins/select2/select2.min.js')}}"></script>
@stop
