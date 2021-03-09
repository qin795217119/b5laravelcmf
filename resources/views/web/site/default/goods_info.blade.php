@extends('web.site.default.layout')

@section('content')
    <div class="web_headebg">
        <div class="con_container">
            <p class="web_headebg_title">{{$catInfo['title']}}</p>
        </div>
    </div>
<div class="con_container">
    <div class="list_info_title">{{$info['title']}}</div>
    <div class="list_info_retitle">@if($info['froms'])<span>来源：{{$info['froms']}}</span>@endif<span>时间 : {{substr($info['subtime'],0,10)}}</span></div>
    <div class="info_page_content">
        @if(isset($infoExt['imglist']) && $infoExt['imglist'])
            <p style="text-align: center">
                @foreach($infoExt['imglist'] as $img)
                    <img src="{{$img}}" style="max-width: 100%;">
                @endforeach
            </p>
        @endif
        {!! ($infoExt['content']??'') !!}
    </div>
</div>
@stop
