@extends('wap.wall.layout')

@section('content')
<div class="bgbox1"></div>
<div class="bgboxbg"></div>
<div class="wallbox">
    <div class="wall_top">
        <div class="wall_left">

        </div>
        <div class="wall_topinfo">
            <div class="wall_top_title">活动签到</div>
            <div class="wall_top_bgleft"></div>
            <div class="wall_top_bgcenter"></div>
            <div class="wall_top_bgright"></div>
        </div>
    </div>
    <div class="wall_section sign_section">
        <div class="wall_sectionbox">
            <form class="sign-form" action="" id="sign_form">
                <div class="b5form_cell">
                    <div class="b5form_cell_box">
                        <div class="b5form_cell_title">姓名</div>
                        <div class="b5form_cell_info">
                            <input type="text" name="truename" required  placeholder="请填写您的姓名" autocomplete="off" id="truename" value="<?=$userInfo?$userInfo['truename']:$wechatInfo['nickname']?>">
                        </div>
                    </div>
                </div>
                <div class="b5form_cell">
                    <div class="b5form_cell_box">
                        <div class="b5form_cell_title">手机号码</div>
                        <div class="b5form_cell_info">
                            <input type="number" name="mobile" required  placeholder="请填写手机号码" autocomplete="off" id="mobile" value="<?=$userInfo?$userInfo['mobile']:''?>">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if($userInfo)
        <div class="wall_section">
            <div class="wall_sectionbox select_subbox">
                <div class="select_sub disabled">
                    您已签到
                </div>
            </div>
        </div>
    @else
        @if($wallInfo['isopen'])
            <div class="wall_section">
                <div class="wall_sectionbox select_subbox">
                    <div class="select_sub">
                        确认签到
                    </div>
                </div>
            </div>
            <script>
                $(function () {
                    $(".select_sub").click(function () {
                        if($("#truename").val()==''){
                            b5tips('请填写您的姓名');
                            return false;
                        }
                        if($("#mobile").val()==''){
                            b5tips('请填写手机号码');
                            return false;
                        }
                        var loadindex=b5showloading();
                        $.ajax({
                            type: 'POST',
                            url: window.location.href,
                            data: $("#sign_form").serialize(),
                            dataType: "json",
                            success: function (result) {
                                b5tips(result.msg,result.url);
                            },
                            complete: function () {
                                b5hideloading(loadindex)
                            },
                            error: function () {
                                b5tips('网络链接错误');
                            }
                        });
                    })
                })
            </script>
        @else
            <div class="wall_section">
                <div class="wall_sectionbox select_subbox">
                    <div class="select_sub disabled">
                        签到未开启
                    </div>
                </div>
            </div>
        @endif
    @endif

</div>
@stop
