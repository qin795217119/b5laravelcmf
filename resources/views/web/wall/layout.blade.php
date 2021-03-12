<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{{$wallInfo['title']??''}}</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript"  src="{{asset('static/plugins/flexible.js')}}"></script>
<script type="text/javascript" src="{{asset('static/plugins/jquery/jquery-1.12.4.min.js')}}"></script>
<!--[if lt IE 9]>
    <script type="text/javascript"  src="{{asset('static/plugins/html5shiv.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/plugins/respond.min.js')}}"></script>
<![endif]-->
<link rel="stylesheet" href="{{asset('static/plugins/fontawesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('static/plugins/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('static/wall/web/css/css.css')}}">
<script src="{{asset('static/plugins/screenfull.min.js')}}" type="text/javascript"></script>
<script src="{{asset('static/plugins/mlayer/mlayer.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('static/common/js/common.js')}}"></script>
<script>
    var deheader="{{asset('static/wall/web/images/deheader.png')}}";
</script>
<body style="background-image: url({{$wallInfo['bgimg']??''}})">
    <div class="main-box">
        <header class="header extcombox">
            <div class="row">
                <div class="col-xs-2">
                    <div class="logobox">
                        <div class="logo" style="background-image: url({{$wallInfo['logoimg']??''}})"></div>
                    </div>
                </div>
                <div class="col-xs-8">
                    <div class="header_titlebox">{{$wallInfo['title']??''}}</div>
                </div>
                <div class="col-xs-2">
                    <div class="header_numbox"></div>
                </div>
            </div>
        </header>
        <div class="centerbox">
            @yield('content')
        </div>
        <div class="show_qrcode">
            <div class="closebutton"><i class="fa fa-close"></i></div>
            <div class="title">扫描下面的二维码参与签到</div>
            <img class="qrcode" src="">
        </div>
        <footer class="footer extcombox">
            <div class="footer_box">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="footer_left">
                            <div class="footer_item {{(isset($menu_index) && $menu_index==='sign')?'current':''}}">
                                <a href="/wall/sign?wall_id={{$wallInfo['id']}}">
                                    <div class="footer_item_icon">
                                        <i class="fa fa-edit"></i>
                                    </div>
                                    <div class="footer_item_title">签到</div>
                                </a>
                            </div>
                            <div class="footer_item {{(isset($menu_index) && $menu_index==='draw')?'current':''}}">
                                <a href="/wall/?wall_id={{$wallInfo['id']}}">
                                    <div class="footer_item_icon">
                                        <i class="fa fa-stack-overflow"></i>
                                    </div>
                                    <div class="footer_item_title">抽奖</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="footer_right">
                            <div class="footer_item" id="wallmusicbtn">
                                <div class="footer_item_icon">
                                    <i class="fa fa-music"></i>
                                </div>
                                <div class="footer_item_title">音效</div>
                            </div>
                            <div class="footer_item qrcodeshowbtn ">
                                <div class="footer_item_icon">
                                    <i class="fa fa-qrcode"></i>
                                </div>
                                <div class="footer_item_title">二维码</div>
                            </div>
                            <div class="footer_item fullscreenbtn">
                                <div class="footer_item_icon">
                                    <i class="fa fa-tv"></i>
                                </div>
                                <div class="footer_item_title">全屏</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div style="display: none;">
            <audio controls="controls" id="wallmusic" loop="true" src="{{asset('static/wall/web/music/wall.mp3')}}">
                您的浏览器不支持音乐播放
            </audio>
        </div>
    </div>

    <script>
        $(function () {
            $(".show_qrcode .closebutton").click(function () {
                $(".show_qrcode").slideUp();
                $(".qrcodeshowbtn").removeClass("current");
            });
            $(".qrcodeshowbtn").click(function () {
                if($(this).hasClass('current')){
                    $(this).removeClass("current");
                    $(".show_qrcode").slideUp();
                }else{
                    $(this).addClass("current");
                    $(".show_qrcode").slideDown();
                }
            });
            $(".fullscreenbtn").click(function () {
                var canfull=screenfull.isEnabled;
                if(canfull){
                    if (screenfull.isFullscreen) {
                        screenfull.exit();
                    }else{
                        screenfull.request();
                    }
                }
            })
            $("#wallmusicbtn").click(function () {
                var audio = document.getElementById('wallmusic');
                if(audio!==null){
                    if($(this).hasClass('current')){
                        if(audio.paused){
                            //audio.play();
                        }else{
                            audio.pause();
                        }
                        $(this).removeClass('current')
                    }else{
                        if(audio.paused){
                            audio.play();
                        }else{
                            //audio.pause();
                        }
                        $(this).addClass('current')
                    }

                }
            })
        })
    </script>
</body>
</html>
