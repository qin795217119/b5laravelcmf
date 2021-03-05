@extends('web.site.default.layout')

@section('content')
    <div class="web_headebg">
        <div class="con_container">
            <p class="web_headebg_title">{{$catInfo['title']}}</p>
        </div>
    </div>
<div class="con_container">
{{--<div class="info_page_title">{{$info['title']}}</div>--}}
<div class="info_page_content">
    {!! ($infoExt?$infoExt['content']:'') !!}
</div>
</div>
@stop
