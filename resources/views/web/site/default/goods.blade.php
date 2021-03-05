@extends('web.site.default.layout')

@section('content')

<div class="web_headebg">
    <div class="con_container">
        <p class="web_headebg_title">{{$parentCat?$parentCat['title']:$catInfo['title']}}</p>
    </div>
</div>
<div class="news_list_catbox">
    <div class="con_container">
        <div class="news_list_catcell">
            @foreach($catList as $cat)
                <a href="{{$cat['url']?:'javascript:;'}}" class="{{$cat['id']==$catInfo['id']?'current':''}}">{{$cat['title']}}</a>
            @endforeach
        </div>
        <div class="news_posbox">
            <img src="{{asset('static/site/default/images/icon06.png')}}" />
            <a href="{{$home_url}}">首页</a>&gt;
            @if($parentCat)
                <a href="{{$parentCat['url']}}">{{$parentCat['title']}}</a>&gt;
            @endif
            <a href="{{$catInfo['url']}}">{{$catInfo['title']}}</a>
        </div>
    </div>
</div>
<div class="con_container news_list_conbox">
    <div class="news_list_left">
        <div class="goods_list_list">
            @foreach($list as $item)
                <dl>
                    <dt><a href="{{$item['linkurl']}}" target="_blank" class="img" style="background-image: url({{$item['thumbimg']}})"></a></dt>
                    <dd><a href="{{$item['linkurl']}}" target="_blank">{{$item['title']}}</a></dd>
                </dl>
            @endforeach
        </div>
        <div class="b5_pagebox">
            {!!$_page!!}
        </div>
    </div>
    <div class="news_list_right">
        <a href="javascript:;"><img src="{{asset('static/site/default/images/pic02.jpg')}}"></a>
        <a href="javascript:;"><img src="{{asset('static/site/default/images/map.jpg')}}"></a>
        <a href="javascript:;"><img src="{{asset('static/site/default/images/pic03.jpg')}}"></a>
    </div>
</div>
@stop
