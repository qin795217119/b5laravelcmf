<div class="form-group">
    <label class="@if(isset($widget_data['sm']) && $widget_data['sm']=='2') col-sm-2 @else col-sm-3 @endif control-label @if (isset($widget_data['required']))is-required @endif">{{$widget_data['title']}}：</label>
    <div class="@if(isset($widget_data['sm']) && $widget_data['sm']=='2') col-sm-9 @else col-sm-8 @endif">
        @if(isset($widget_data['addon']) && $widget_data['addon'])
            <div class="input-group">
        @endif
        <input
            @if (isset($widget_data['type']) && $widget_data['type']) type="{{$widget_data['type']}}" @else type="text" @endif
            @if ($widget_data['name']) name="{{$widget_data['name']}}" @endif
            @if ($widget_data['id']) id="{{$widget_data['id']}}" @endif
            @if(isset($widget_data['value']))
                value="{{$widget_data['value']}}"
            @elseif(isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']]))
                value="{{$widget_data['info'][$widget_data['name']]}}"
            @else
                value=""
            @endif
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
            @if (isset($widget_data['readonly'])) readonly="true" @endif
             autocomplete="off"
        />




        @if(isset($widget_data['addon']) && $widget_data['addon'])
            <span class="input-group-addon"><i class="fa {{$widget_data['addon']}}"></i></span>
            </div>
        @endif
        @if(isset($widget_data['tips']) && $widget_data['tips'])
            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> {{$widget_data['tips']}}</span>
        @endif
    </div>
</div>
