<a class="btn btn-danger multiple {{isset($widget_data['disabled'])?'disabled':''}}" onclick="$.operate.removeAll(this)" data-column="{{isset($widget_data['column'])?$widget_data['column']:''}}">
    <i class="fa fa-remove"></i> {{$widget_data['title']?:'删除'}}
</a>

