<!DOCTYPE html>
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$siteInfo['name']??''}}</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="Keywords" content="{{$siteInfo['name']??''}}" />
    <link href="{{asset('static/site/default/css/b5net.css')}}" rel="stylesheet"/>
    <link href="{{asset('static/plugins/swiper/css/swiper.min.css')}}" rel="stylesheet"/>

    <script src="{{asset('static/plugins/jquery/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('static/plugins/swiper/js/swiper.min.js')}}"></script>
    <body>
        @include('web.site.default.header')
        @yield('content')
        @include('web.site.default.footer')
    </body>
</html>
