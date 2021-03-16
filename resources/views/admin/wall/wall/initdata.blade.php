@extends('admin.public.form')

@section('content')

<div class="main_box">
    <div class="col-xs-4">
        <p>
            <a href="javascript:;" class="btn btn-success b5ajaxget" data-title="确定执行此操作吗" data-url="{{\Illuminate\Support\Facades\URL::route('wall_admin_initdata',['wall_id'=>$wallInfo['id'],'type'=>'prizeusers'])}}">
                清空中奖信息
            </a>
        </p>
        <p class="mt20">
            <a href="javascript:;" class="btn btn-info b5ajaxget" data-title="确定执行此操作吗" data-url="{{\Illuminate\Support\Facades\URL::route('wall_admin_initdata',['wall_id'=>$wallInfo['id'],'type'=>'wallusers'])}}">
                清空签到及中奖信息
            </a>
        </p>
        <p class="mt20">
            <a href="javascript:;" class="btn btn-danger b5ajaxget" data-title="确定执行此操作吗" data-url="{{\Illuminate\Support\Facades\URL::route('wall_admin_initdata',['wall_id'=>$wallInfo['id'],'type'=>'wall'])}}">
                删除该活动及相关信息
            </a>
        </p>
    </div>
</div>
@stop
