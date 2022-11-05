@extends('admin.layout.form')
{{--如果需要下拉选择组件,请开启下面这一行--}}
{{--@include("widget.asset.select2")--}}


@section('content')
<form class="form-horizontal m" id="form-edit">
    <input type="hidden" name="id" value="{{$info['id']}}">
___REPLACE___</form>
@stop

@section('script')
    <script>
        $("#form-edit").validate();

        {{--$("#XX").val(["{{$info['xx']}}"]).trigger("change");--}}

        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-edit').serialize());
            }
        }
    </script>
@stop
