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
            <div class="wall_top_title">流程介绍</div>
            <div class="wall_top_bgleft"></div>
            <div class="wall_top_bgcenter"></div>
            <div class="wall_top_bgright"></div>
        </div>
    </div>
    @if($wallInfo['contents'])
            <div class="wall_section">
                <div class="wall_sectionbox">
                    <div class="wall_section_title">活动介绍</div>
                        <div class="wall_section_contents">
                            <div class="wall_section_textarea">{{$wallInfo['contents']}}</div>
                        </div>
                </div>
            </div>
    @endif
    @if($processarr)
            <div class="wall_section">
                <div class="wall_sectionbox">
                    <div class="wall_section_title">活动流程</div>
                    <div class="wall_section_contents">
                        @foreach($processarr as $day=>$prolist)
                            <div class="wall_process_cattitle">{{$day}}</div>
                            @foreach($prolist as $proval)
                                <div class="wal_process_item">
                                    <div class="wall_process_hour">{{$proval['hour']}}</div>
                                    <div class="wall_process_item_title">{{$proval['title']}}</div>
                                    <div class="wall_process_desc">
                                        <div class="wall_section_textarea">{{$proval['desc']}}</div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
</div>
@stop
