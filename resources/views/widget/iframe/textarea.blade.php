@if($widget_data['title'])
    {{$widget_data['title']}}：
@endif
<textarea
    @if ($widget_data['name']) name="{{$widget_data['name']}}" @endif
@if ($widget_data['id']) id="{{$widget_data['id']}}" @endif
    @if ($widget_data['class']) class="{{$widget_data['class']}}" @else class="form-control" @endif
    @if (isset($widget_data['place']))
    @if ($widget_data['place'])
    placeholder="{{$widget_data['place']}}"
    @else
    placeholder="请输入{{$widget_data['title']}}"
    @endif
    @endif
    @if (isset($widget_data['maxlen']) && $widget_data['maxlen']) maxlength="{{$widget_data['maxlen']}}" @endif
    @if (isset($widget_data['required'])) required @endif
    @if (isset($widget_data['rows'])) rows="{{$widget_data['rows']}}" @else rows="3" @endif
    @if (isset($widget_data['readonly'])) readonly="true" @endif
           >@if(isset($widget_data['value'])){{$widget_data['value']}}@elseif(isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']])){{$widget_data['info'][$widget_data['name']]}}@endif</textarea>
