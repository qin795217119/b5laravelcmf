@extends('admin.layout.form')
{{--如果需要下拉选择组件,请开启下面这一行--}}
{{--@include("widget.asset.select2")--}}

@section('content')
<form class="form-horizontal m" id="form-add">
___REPLACE___</form>
@stop

@section('script')
    <script>
        $("#form-add").validate();

        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-add').serialize());
            }
        }
    </script>
@stop
