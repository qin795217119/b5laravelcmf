<a
    class="btn btn-primary single {{isset($widget_data['disabled'])?'disabled':''}}"
@if(isset($widget_data['full']))
    onclick="$.operate.editFull('@if(isset($widget_data['opid'])) {{$widget_data['opid']}} @endif',this)"
@else
    onclick="$.operate.edit('@if(isset($widget_data['opid'])) {{$widget_data['opid']}} @endif',this)"
@endif
>
    <i class="fa fa-edit"></i> {{$widget_data['title']?:'修改'}}
</a>

