@if(isset($widget_data['type']) && $widget_data['type'])
    @foreach($widget_data['type'] as $type)
        @if($type=='edit') <a class="btn btn-success btn-xs" href="javascript:;" onclick="$.operate.edit(\'' + {{$widget_data['rowId']}} + '\')"><i class="fa fa-edit"></i>编辑</a> @endif
        @if($type=='add') <a class="btn btn-info btn-xs" href="javascript:;" onclick="$.operate.add(\'' + {{$widget_data['rowId']}} + '\')"><i class="fa fa-plus"></i>新增</a> @endif
        @if($type=='list_mine') <a class="btn btn-info btn-xs" href="javascript:;" onclick="detail_mine(\'' + {{$widget_data['rowId']}} + '\')"><i class="fa fa-list-ul"></i>列表</a> @endif
        @if($type=='delete') <a class="btn btn-danger btn-xs" href="javascript:;" onclick="$.operate.remove(\'' + {{$widget_data['rowId']}} + '\')"><i class="fa fa-remove"></i>删除</a> @endif
    @endforeach
@endif
