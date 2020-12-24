<select name="{{$name}}" @if (isset($id) && $id) id="{{$id}}" @endif @if (isset($class) && $class) class="{{$class}}" @endif @if (isset($mult) && $mult) multiple @endif>
    @if(isset($place) && $place)
        @if($place!='false')
            <option value="">{{$place}}</option>
        @endif
    @else
        <option value="">请选择{{$title}}</option>
    @endif
    @foreach ($data as $key => $val)
        @if (is_array($val))
            <option value="{{$val["$showvalue"]}}" @if ($val["$showvalue"]==$value  && $value!=='') selected="" @endif>{{$val["$showname"]}}</option>
        @else
            <option value="{{$key}}" @if ($key==$value && $value!=='') selected="" @endif>{{$val}}</option>
        @endif
    @endforeach
</select>
