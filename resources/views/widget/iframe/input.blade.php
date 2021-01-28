@if($widget_data['title'])
    {{$widget_data['title']}}：
@endif
<input
    type="@if (isset($widget_data['type']) && $widget_data['type']){{$widget_data['type']}}@else text @endif"
    name="{{$widget_data['name']}}"
    @if(isset($widget_data['value']))
        value="{{$widget_data['value']}}"
    @elseif(isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']]))
        value="{{$widget_data['info'][$widget_data['name']]}}"
    @else
        value=""
    @endif
    @if ($widget_data['id']) id="{{$widget_data['id']}}" @endif
    @if (isset($widget_data['style'])) style="{{$widget_data['style']}}" @endif
    @if ($widget_data['class']) class="{{$widget_data['class']}}" @endif
    @if(isset($widget_data['place']) && $widget_data['place'])
        placeholder="{{$widget_data['place']}}"
    @endif
    @if (isset($widget_data['maxlen']) && $widget_data['maxlen']) maxlength="{{$widget_data['maxlen']}}" @endif
    @if (isset($widget_data['required'])) required @endif
    @if (isset($widget_data['readonly'])) readonly="true" @endif
    autocomplete="off"
/>
@if(isset($widget_data['addon']) && $widget_data['addon'])
    <span class="input-group-addon"><i class="fa {{$widget_data['addon']}}"></i></span>
@endif


