@if($widget_data['title'])
    {{$widget_data['title']}}：
@endif
@foreach ($widget_data['data']??[0=>'停用',1=>'启用'] as $key => $val)
    <div class="radio-box">
        @if (is_array($val))
            @if(isset($widget_data['value']))
                <input type="radio"
                       id="{{$widget_data['name']}}_{{$val[$widget_data['showvalue']]}}"
                       name="{{$widget_data['name']}}"
                       value="{{$val[$widget_data['showvalue']]}}"
                       @if ($val[$widget_data['showvalue']]==$widget_data['value']  && $widget_data['value']!=='') checked="true" @endif
                       @if (isset($widget_data['required']) && $loop->first) required @endif
                >
            @elseif(isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']]))
                <input type="radio"
                       id="{{$widget_data['name']}}_{{$val[$widget_data['showvalue']]}}"
                       name="{{$widget_data['name']}}"
                       value="{{$val[$widget_data['showvalue']]}}"
                       @if ($val[$widget_data['showvalue']]==$widget_data['info'][$widget_data['name']]  && $widget_data['info'][$widget_data['name']]!=='') checked="true" @endif
                       @if (isset($widget_data['required']) && $loop->first) required @endif
                >
            @else
                <input type="radio" id="{{$widget_data['name']}}_{{$val[$widget_data['showvalue']]}}" name="{{$widget_data['name']}}" value="{{$val[$widget_data['showvalue']]}}"   @if (isset($widget_data['required']) && $loop->first) required @endif>
            @endif
            <label for="{{$widget_data['name']}}_{{$val[$widget_data['showvalue']]}}">{{$val[$widget_data['showname']]}}</label>
        @else
            @if(isset($widget_data['value']))
                <input type="radio"
                       id="{{$widget_data['name']}}_{{$key}}"
                       name="{{$widget_data['name']}}"
                       value="{{$key}}"
                       @if ($key==$widget_data['value'] && $widget_data['value']!=='') checked="true" @endif
                       @if (isset($widget_data['required']) && $loop->first) required @endif
                >
            @elseif(isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']]))
                <input type="radio"
                       id="{{$widget_data['name']}}_{{$key}}"
                       name="{{$widget_data['name']}}"
                       value="{{$key}}"
                       @if ($key==$widget_data['info'][$widget_data['name']]  && $widget_data['info'][$widget_data['name']]!=='') checked="true" @endif
                       @if (isset($widget_data['required']) && $loop->first) required @endif
                >
            @else
                <input type="radio" id="{{$widget_data['name']}}_{{$key}}" name="{{$widget_data['name']}}" value="{{$key}}"  @if (isset($widget_data['required']) && $loop->first) required @endif>
            @endif
            <label for="{{$widget_data['name']}}_{{$key}}">{{$val}}</label>
        @endif
    </div>
@endforeach
@if(isset($widget_data['tips']) && $widget_data['tips'])
    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> {{$widget_data['tips']}}</span>
@endif
