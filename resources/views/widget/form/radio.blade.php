@if (isset($data) && $data)
    @foreach ($data as $key => $val)
        @if (is_array($val))
            <input type="radio" name="{{$name??''}}" value="{{$val['value']}}" title="{{$val['name']}}" @if (isset($value) && $val["value"]==$value) checked="" @endif @if(isset($val['disabled']))  disabled="" @endif>
        @else
            <input type="radio" name="{{$name??''}}" value="{{$key}}" title="{{$val}}" @if (isset($value) && $val==$key) checked="" @endif>
        @endif
    @endforeach
@endif
