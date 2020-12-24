<select name="{{$selectName}}" id="{{$selectName}}" @if ($selectRequired==1) lay-verify="required" @endif lay-search="" lay-filter="{{$selectName}}">
	<option value="">【请选择{{$selectTitle}}】</option>
    @foreach ($selectData as $key => $val)
        @if (is_array($val))
        <option value="{{$val["$showValue"]}}" @if ($val["$showValue"]==$selectValue) selected="" @endif>{{$val["$showName"]}}</option>
        @else
            <option value="{{$key}}" @if ($key==$selectValue) selected="" @endif>{{$val}}</option>
        @endif
    @endforeach
</select>
