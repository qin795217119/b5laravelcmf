@extends('admin.layout.form')

@section('content')
<form class="form-horizontal m" id="form-edit">
    <input type="hidden" name="id" value="{{$info['id']}}">
___REPLACE___</form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-edit').serialize());
            }
        }
    </script>
@stop
