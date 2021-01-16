<div class="form-group">
    <label class="@if(isset($widget_data['sm']) && $widget_data['sm']=='2') col-sm-2 @else col-sm-3 @endif control-label @if (isset($widget_data['required']))is-required @endif">{{$widget_data['title']}}：</label>
    <div class="@if(isset($widget_data['sm']) && $widget_data['sm']=='2') col-sm-9 @else col-sm-8 @endif">
        @if(isset($widget_data['data']) && $widget_data['data'])
            @foreach ($widget_data['data'] as $key => $val)
                @if (is_array($val))
                    <label class="check-box" for="{{$widget_data['name']}}_{{$val[$widget_data['showvalue']]}}">
                        @if(isset($widget_data['value']))
                            <input type="checkbox"
                                   id="{{$widget_data['name']}}_{{$val[$widget_data['showvalue']]}}"
                                   name="{{$widget_data['name']}}"
                                   value="{{$val[$widget_data['showvalue']]}}"
                                   text="{{$val[$widget_data['showname']]}}"
                                   @if (in_array($val[$widget_data['showvalue']],is_array($widget_data['value'])?$widget_data['value']:explode(',',$widget_data['value']))) checked="true" @endif
                                   @if (isset($widget_data['required']) && $loop->first) required @endif
                            >
                        @elseif(isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']]))
                            <input type="checkbox"
                                   id="{{$widget_data['name']}}_{{$val[$widget_data['showvalue']]}}"
                                   name="{{$widget_data['name']}}"
                                   value="{{$val[$widget_data['showvalue']]}}"
                                   text="{{$val[$widget_data['showname']]}}"
                                   @if (in_array($val[$widget_data['showvalue']],is_array($widget_data['info'][$widget_data['name']])?$widget_data['info'][$widget_data['name']]:explode(',',$widget_data['info'][$widget_data['name']]))) checked="true" @endif
                                   @if (isset($widget_data['required']) && $loop->first) required @endif
                            >
                        @else
                            <input type="checkbox" id="{{$widget_data['name']}}_{{$val[$widget_data['showvalue']]}}" name="{{$widget_data['name']}}" value="{{$val[$widget_data['showvalue']]}}" text="{{$val[$widget_data['showname']]}}" @if (isset($widget_data['required']) && $loop->first) required @endif>
                        @endif
                            {{$val[$widget_data['showname']]}}
                    </label>
                @else
                    <label class="check-box" for="{{$widget_data['name']}}_{{$key}}">
                        @if(isset($widget_data['value']))
                            <input type="checkbox"
                                   id="{{$widget_data['name']}}_{{$key}}"
                                   name="{{$widget_data['name']}}"
                                   value="{{$key}}"
                                   text="{{$val}}"
                                   @if (in_array($key,is_array($widget_data['value'])?$widget_data['value']:explode(',',$widget_data['value']))) checked="true" @endif
                                   @if (isset($widget_data['required']) && $loop->first) required @endif
                            >
                        @elseif(isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']]))
                            <input type="checkbox"
                                   id="{{$widget_data['name']}}_{{$key}}"
                                   name="{{$widget_data['name']}}"
                                   value="{{$key}}"
                                   text="{{$val}}"
                                   @if (in_array($key,is_array($widget_data['info'][$widget_data['name']])?$widget_data['info'][$widget_data['name']]:explode(',',$widget_data['info'][$widget_data['name']]))) checked="true" @endif
                                   @if (isset($widget_data['required']) && $loop->first) required @endif
                            >
                        @else
                            <input type="checkbox" id="{{$widget_data['name']}}_{{$key}}" name="{{$widget_data['name']}}" value="{{$key}}" text="{{$val}}" @if (isset($widget_data['required']) && $loop->first) required @endif>
                        @endif
                            {{$val}}
                    </label>
                @endif
            @endforeach
        @endif
        @if(isset($widget_data['tips']) && $widget_data['tips'])
            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> {{$widget_data['tips']}}</span>
        @endif
    </div>
</div>
