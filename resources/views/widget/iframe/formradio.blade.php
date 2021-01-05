<div class="form-group {{$widget_data['name']}}_field">
    <label class="@if(isset($widget_data['sm']) && $widget_data['sm']=='2') col-sm-2 @else col-sm-3 @endif control-label @if (isset($widget_data['required']))is-required @endif">{{$widget_data['title']}}：</label>
    <div class="@if(isset($widget_data['sm']) && $widget_data['sm']=='2') col-sm-9 @else col-sm-8 @endif">
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
                        <input type="radio" id="{{$widget_data['name']}}_{{$val[$widget_data['showvalue']]}}" name="{{$widget_data['name']}}" value="{{$val[$widget_data['showvalue']]}}"  @if (isset($widget_data['required']) && $loop->first) required @endif>
                    @endif

                    <label for="{{$widget_data['name']}}_{{$val[$widget_data['showvalue']]}}">{{$val["$showname"]}}</label>
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
        @if(isset($widget_data['tips']))
            <span class="help-block m-b-none">@if($widget_data['tips'])<i class="fa fa-info-circle"></i> {{$widget_data['tips']}}@endif</span>
        @endif
    </div>
</div>
