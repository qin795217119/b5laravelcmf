@if (!empty($dataList))
    @foreach ($dataList as $val)
	<input name="{{$checkboxName}}[{{$val['show_value']}}]" lay-skin="primary" title="{{$val['show_name']}}" @if ($val['checked'] == 1) checked="" @endif type="checkbox">
    @endforeach
@endif
