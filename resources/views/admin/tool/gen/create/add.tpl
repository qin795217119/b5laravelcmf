@extends('admin.layout.form')

@section('content')
<form class="form-horizontal m" id="form-add">
___REPLACE___</form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-add').serialize());
            }
        }
    </script>
@stop
