@extends('wap.wall.layout')

@section('content')
<div class="bgbox1"></div>
<div class="bgboxbg"></div>
<div class="wallbox">
    <div class="wall_top">
        <div class="wall_left">
            <a href="{{route('wall_wap_index',['wall_id'=>$wallInfo['id']])}}">
                <div class="top_home"></div>
            </a>
        </div>
        <div class="wall_topinfo">
            <div class="wall_top_title">我的奖品</div>
            <div class="wall_top_bgleft"></div>
            <div class="wall_top_bgcenter"></div>
            <div class="wall_top_bgright"></div>
        </div>
    </div>
    <div class="wall_section">
        <div class="wall_sectionbox wall_myprize_list">
            @if($list)
                @foreach($list as $getinfo)
                    <div class="wall_myprize_cell">
                        <div class="wall_myprize_img" style="background-image: url({{$getinfo['prizeinfo']?$getinfo['prizeinfo']['thumbimg']:'/site/web/wall/images/deprize.png'}})"></div>
                        <div class="wall_myprize_info">
                            <div class="wall_myprize_title">
                                {{$getinfo['prizeinfo']?$getinfo['prizeinfo']['title']:$getinfo['prize_id']}}
                                @if($getinfo['status'])
                                    <span class="btn btn-success btn-xs">已领取</span>
                                @else
                                    <span class="btn btn-danger btn-xs">未领取</span>
                                @endif
                            </div>
                            <div class="wall_myprize_desc">{{$getinfo['prizeinfo']?$getinfo['prizeinfo']['prizename']:''}}</div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="wall_process_desc wall_noprice">您未中奖！</div>
            @endif

        </div>
    </div>
</div>
@stop
