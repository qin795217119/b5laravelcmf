<select name="{{$name??''}}" id="{{$id??''}}" @if (isset($required) && $required==1) lay-verify="required" @endif lay-search="" lay-filter="{{$name}}">
	<option value="">【请选择{{$title}}】</option>
    @if(isset($data) && $data)
        @foreach ($data as $key => $val)
            @if (is_array($val))
            <option value="{{$val["value"]}}" @if (isset($value) && $val["value"]==$value) selected="" @endif>{{$val["name"]}}</option>
            @else
                <option value="{{$key}}" @if (isset($value) && $key==$value) selected="" @endif>{{$val}}</option>
            @endif
        @endforeach
    @endif
</select>
