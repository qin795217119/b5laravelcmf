<div class="form-group {{$widget_data['name']}}_field">
    <label class="@if(isset($widget_data['sm']) && $widget_data['sm']=='2') col-sm-2 @else col-sm-3 @endif control-label @if (isset($widget_data['required']))is-required @endif">{{$widget_data['title']}}：</label>
    <div class="@if(isset($widget_data['sm']) && $widget_data['sm']=='2') col-sm-9 @else col-sm-8 @endif">
        <select
            name="{{$widget_data['name']}}"
            @if ($widget_data['id']) id="{{$widget_data['id']}}" @endif

            @if ($widget_data['class'])
                class="{{$widget_data['class']}}"
            @else
                class="form-control"
            @endif
            @if (isset($widget_data['required'])) required @endif
            @if (isset($widget_data['readonly'])) readonly="true" @endif
            @if (isset($widget_data['mult']) && $widget_data['mult']) multiple @endif>
            @if(isset($widget_data['place']))
                @if($widget_data['place'])
                    <option value="">{{$widget_data['place']}}</option>
                @else
                    <option value="">请选择{{$widget_data['title']}}</option>
                @endif
            @endif
            @foreach ($widget_data['data']??[1=>'正常',0=>'停用'] as $key => $val)
                @if (is_array($val))
                    <option
                        value="{{$val[$widget_data['showvalue']]}}"
                        @if(isset($widget_data['value']))
                            @if ($val[$widget_data['showvalue']]==$widget_data['value']  && $widget_data['value']!=='') selected="" @endif
                        @elseif(isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']]))
                            @if ($val[$widget_data['showvalue']]==$widget_data['info'][$widget_data['name']]  && $widget_data['info'][$widget_data['name']]!=='') selected="" @endif
                        @endif
                    >{{$val[$widget_data['showname']]}}</option>
                @else
                    <option
                        value="{{$key}}"
                        @if(isset($widget_data['value']))
                            @if ($key==$widget_data['value']  && $widget_data['value']!=='') selected="" @endif
                        @elseif(isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']]))
                            @if ($key==$widget_data['info'][$widget_data['name']]  && $widget_data['info'][$widget_data['name']]!=='') selected="" @endif
                        @endif
                    >{{$val}}</option>
                @endif
            @endforeach
        </select>
        @if(isset($widget_data['tips']))
            <span class="help-block m-b-none">@if($widget_data['tips'])<i class="fa fa-info-circle"></i> {{$widget_data['tips']}}@endif</span>
        @endif
    </div>
</div>
