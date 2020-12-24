<input
    type="@if (isset($type) && $type) {{$type}} @else text @endif"
    name="{{$name}}"
    value="@if (isset($value) && $value) {{$value}} @endif"
    @if (isset($id) && $id) id="{{$id}}" @endif
    @if (isset($class) && $class) class="{{$class}}" @endif
    @if(isset($place) && $place)
    @if($place!='false')
        placeholder="{{$place}}"
    @endif
    @else
        placeholder="请输入{{$place}}"
    @endif
    @if (isset($maxlen) && $maxlen) maxlength="{{$maxlen}}" @endif
    @if (isset($required)) required @endif
/>
@if(isset($addon) && $addon)
    <span class="input-group-addon"><i class="fa {{$addon}}"></i></span>
@endif
