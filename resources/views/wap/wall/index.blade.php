@extends('wap.wall.layout')

@section('content')
<div class="wallindex">
    <div class="topbox">
        <div class="topbg" style="background-image: url({{$wallInfo['logoimg']}})"></div>
        <div class="toptitle">{{$wallInfo['title']}}</div>
    </div>
    <div class="container-fluid oplistbox">
        <div class="col-xs-4 cat_cell">
            <div class="cat_box">
                <a href="/wallwap/myprize?wall_id={{$wallInfo['id']}}">
                    <div class="cat_info">
                        <div class="cat_imgbox">
                            <div class="cat_img cat_drawprize"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xs-4 cat_cell">
            <div class="cat_box">
                <a href="/wallwap/process?wall_id={{$wallInfo['id']}}">
                    <div class="cat_info">
                        <div class="cat_imgbox">
                            <div class="cat_img cat_drawprocess"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xs-4 cat_cell">
            <div class="cat_box">
                <a href="/wallwap/sign?wall_id={{$wallInfo['id']}}">
                    <div class="cat_info">
                        <div class="cat_imgbox">
                            <div class="cat_img cat_drawsign"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="bgbox"></div>
<div class="bgboxbg"></div>
@stop
