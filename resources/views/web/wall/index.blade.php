@extends('web.wall.layout')

@section('content')
<div class="draw_bigshow">
    <div class="draw_bigshow_header"></div>
    <div class="draw_bigshow_mian scrollbox">
        <div class="draw_bigshow_list"></div>
    </div>
    <div class="draw_bigshow_bgimg"></div>
    <div class="draw_bigshow_bottom">
        <div class="draw_bigshow_bottom_btn">关闭</div>
    </div>
</div>
<div class="drawbox extcombox">

    <div class="row drawmainbox">
        <div class="col-xs-3 draw_sbox">
            <div class="draw_section">
                <div class="draw_section_left">
                    <div class="draw_section_ltitle">幸运抽奖</div>
                    <div class="draw_section_lmain">
                        <div class="draw_section_lmain_imgbox">
                            <div class="draw_section_lmain_imgmain">
                                <div class="draw_section_lmain_img" id="showprizeimg"></div>
                            </div>
                        </div>
                        <div class="draw_section_lmain_itembox">
                            <div class="draw_section_lmain_item">
                                数量：<span id="prizeallnum">0</span>
                            </div>

                        </div>
                        <div class="draw_section_lmain_itembox">
                            <div class="draw_section_lmain_item" id="showprizename"></div>
                        </div>
                    </div>
                    <div class="draw_section_lfooter">
                        <div class="draw_lfooter_main">
                            <div class="draw_lfooter_cell">
                                <div class="draw_lfooter_title">抽奖参与人数</div>
                                <div class="draw_lfooter_value">
                                    <div class="draw_lfooter_allnumbox">
                                        <div class="draw_lfooter_allnum"><span id="inactnum">0</span>人</div>
                                        <div class="refresh_allnum">
                                            <i class="fa fa-refresh"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="draw_lfooter_cell">
                                <div class="draw_lfooter_title">选择奖品选项</div>
                                <div class="draw_lfooter_value">
                                    <select id="prize_id" class="prizecheck">
                                        <option value="0" data-name="请选择奖品" data-img="{{asset('static/wall/web/images/deprize.png')}}" data-num="0">请选择奖品</option>
                                        @foreach($prizeList as $prizeinfo)
                                        <option value="{{$prizeinfo['id']}}" data-name="{{$prizeinfo['name']}}" data-img="{{$prizeinfo['thumbimg']}}" data-num="{{$prizeinfo['number']}}">{{$prizeinfo['title']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="draw_lfooter_cell">
                                <div class="draw_lfooter_title">每次抽取人数</div>
                                <div class="draw_lfooter_value">
                                    <div class="draw_num_checkbox">
                                        <div class="draw_num_op draw_num_desc" data-type="desc"
                                             onselectstart="return false">-
                                        </div>
                                        <div class="draw_num_input">
                                            <input type="number" value="1" readonly id="drawnumber">
                                        </div>
                                        <div class="draw_num_op draw_num_asc" data-type="asc"
                                             onselectstart="return false">+
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 draw_sbox">
            <div class="draw_section draw_section_user">
                <div class="draw_user_box ">
                    <div class="draw_user_scroll scrollbox">
                        <div class="draw_user_list"></div>
                    </div>
                </div>
                <div class="draw_star_btnbox">
                    <div class="draw_star_btn btn btn-warning">开始抽奖</div>
                </div>
            </div>
        </div>
        <div class="col-xs-3 draw_sbox">
            <div class="draw_section">
                <div class="draw_section_right">
                    <div class="draw_section_rtitle">
                        <a href="javascript:;" class="showbigget">中奖列表</a>
                        <span id="hasnumber"></span>
                    </div>
                    <div class="draw_ruser_lbox scrollbox">
                        <div class="draw_ruser_list"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var userslist=[];
    var drawsetInterIndex=[];
    var drawprizeIndex=null;
    var isdraw=false;
    var showlist=[];
    $(function () {
        showDrawBobx();
        prizeChangeShow();
        getPrizeGetUserList();
        getInactUserNum();
        //加减抽奖人数
        $(".draw_num_op").click(function () {
            if($(".draw_star_btn").hasClass('isdraw')){
                b5tips('正在抽奖中，无法此操作');
                return false;
            }
            var thisval = parseInt($("#drawnumber").val());
            var datatype = $(this).attr("data-type");
            if (datatype == 'desc') {
                if (thisval > 1) {
                    thisval = thisval - 1;
                } else {
                    thisval = 1;
                }
            } else {
                thisval = thisval + 1;
            }
            $("#drawnumber").val(thisval);
            showDrawBobx();
        });

        //更换奖品信息显示，并查询中将人列表
        $("#prize_id").change(function (e) {
            prizeChangeShow();
        });

        //更新可抽奖参与人数
        $(".refresh_allnum").click(function () {
            getInactUserNum();
        });

        $(".showbigget").click(function () {
            showlist=[];
            $(".draw_ruser_list .draw_ruser_item").each(function () {
                var headimg=$(this).attr('data-img');
                var truename=$(this).attr('data-title');
                var thisuser={headimg:headimg,truename:truename};
                showlist.push(thisuser);
            });
            bigshowuser();
        });
        $(".draw_bigshow_bottom_btn").click(function () {
            $(".draw_bigshow").hide();
            $(".extcombox").show();
        });
        //删除中奖用户
        $(document).on("click",".draw_ruser_delete",function () {
            var thisobj=$(this);
            var prize_id=parseInt($("#prize_id").val());
            if(prize_id==0){
                b5tips('请选择奖品');
                return false;
            }
            var openid=thisobj.attr('data-openid');
            if(openid==''){
                b5tips('用户参数错误');
                return false;
            }
            b5confirm('确定删除该中奖用户吗?',function () {
                var ldindex=b5showloading();
                $.ajax({
                    type: "GET",
                    url: "/wall/delprizeuser?wall_id={{$wallInfo['id']}}",
                    data: {prize_id:prize_id,openid:openid},
                    dataType: "json",
                    success: function(result){
                        if (result.code==0) {
                            thisobj.parents(".draw_ruser_item").remove();
                            var allnum=$(".draw_ruser_list .draw_ruser_item").length;
                            $("#hasnumber").html(allnum+'人');
                        }else{
                            b5tips(result.msg);
                        }
                    },
                    complete:function(){
                        b5hideloading(ldindex);
                    },
                    error:function(){
                        b5tips("网络链接错误");
                    }
                });
            });
        });

        //开始结束抽奖
        $(".draw_star_btn").click(function () {
            var btnobj=$(this)
            var prize_id=parseInt($("#prize_id").val());
            if(prize_id<1){
                b5tips('请选择奖品');
                return false;
            }
            if(btnobj.hasClass('isdraw')){
                if(btnobj.hasClass('drawing')){
                    return false;
                }
                btnobj.addClass('drawing');
                btnobj.html('抽奖中...');
                showlist=[];
                drawprizeIndex=setInterval(function () {
                    drawPrize();
                },100);
            }else{
                var drawnumber=parseInt($("#drawnumber").val());
                if(userslist.length<1 || userslist.length<drawnumber){
                    b5tips('抽奖参与人数不足');
                    return false;
                }
                $(this).addClass('isdraw');
                $(this).html('停止');
                circledrawuser();
            }
        })
    });
    //大屏显示用户
    function bigshowuser() {
        var html='';
        for (var i in showlist) {
            html+=' <div class="draw_bigshow_itembox">' +
                '       <div class="draw_bigshow_itemboxm">' +
                '           <div class="draw_bigshow_itemmain">' +
                '               <div class="draw_bigshow_itemmainbox">' +
                '                   <div class="draw_bigshow_itemimgbox">' +
                '                       <div class="draw_bigshow_itemimg" style="background-image: url('+showlist[i].headimg+')"></div>' +
                '                   </div>' +
                '                   <div class="draw_bigshow_imgbord1"></div>' +
                '                   <div class="draw_bigshow_imgbord"></div>' +
                '               </div>' +
                '           </div>' +
                '           <div class="draw_bigshow_itemtitle">'+showlist[i].truename+'</div>' +
                '       </div>' +
                '   </div>'
        }
        $(".draw_bigshow_list").html(html);
        $(".extcombox").hide();
        $(".draw_bigshow").show();
    }
    //抽奖
    function drawPrize() {
        if(drawsetInterIndex.length<1){
            return false;
        }
        if(isdraw) return false;
        isdraw=true;
        var interIndex=drawsetInterIndex.shift();
        var userscount=userslist.length;
        var index=Math.floor(Math.random()*userscount);
        var info=userslist[index];
        var prize_id=parseInt($("#prize_id").val());
        $.ajax({
            type: "GET",
            url: "/wall/getdraw?wall_id={{$wallInfo['id']}}",
            data: {openid:info.openid,prize_id:prize_id},
            dataType: "json",
            success: function(result){
                if (result.code==0) {
                    userslist.splice(index,1);
                    clearInterval(interIndex);
                    $("#inactnum").html(userslist.length);
                    var allnum=$(".draw_user_list .draw_user_itembox").length;
                    var leftlen=drawsetInterIndex.length;
                    var thisindex=allnum-leftlen-1;
                    var obj=$(".draw_user_list").find(".draw_user_itembox").eq(thisindex);
                    obj.find(".draw_user_itemimg").css('background-image','url('+info.headimg+')');
                    obj.find(".draw_user_itemtitle").html(info.truename);

                    var html='<div class="draw_ruser_item" data-img="'+info.headimg+'" data-title="'+info.truename+'">  ' +
                        '           <div class="draw_ruser_imgbox">    ' +
                        '               <div class="draw_ruser_img" style="background-image: url('+info.headimg+')"></div>      ' +
                        '           </div>    ' +
                        '           <div class="draw_ruser_info">'+info.truename+'</div>    ' +
                        '           <div class="draw_ruser_delete" data-openid="'+info.openid+'"><i class="fa fa-close"></i></div>  ' +
                        '    </div>';
                    $(".draw_ruser_list").prepend(html);
                    var allnum=$(".draw_ruser_list .draw_ruser_item").length;
                    $("#hasnumber").html(allnum+'人');
                    showlist.push({headimg:info.headimg,truename:info.truename});
                    if(leftlen<1){
                        bigshowuser();
                        clearInterval(drawprizeIndex);
                        $(".draw_star_btn").removeClass('drawing');
                        $(".draw_star_btn").removeClass('isdraw');
                        $(".draw_star_btn").html('开始抽奖');
                    }
                }
            },
            complete:function(){
                isdraw=false;
            }
        });
    }
    //奖品选择框改变
    function prizeChangeShow() {
        // var prize_id=parseInt($("#prize_id").val());
        var checkobj=$('#prize_id option:selected');
        var num=checkobj.attr('data-num');
        var name=checkobj.attr('data-name');
        var thumbimg=checkobj.attr('data-img');
        $("#showprizename").html(name);
        $("#prizeallnum").html(num);
        $("#showprizeimg").css('background-image','url('+thumbimg+')');
        getPrizeGetUserList();
    }
    //根据抽奖人数显示头像框数量
    function showDrawBobx() {
        var num = parseInt($("#drawnumber").val());
        var html='';
        for(var i=0;i<num;i++){
            html+='<div class="draw_user_itembox">' +
                '         <div class="draw_user_itemboxm">' +
                '             <div class="draw_user_itemmain">' +
                '                 <div class="draw_user_itemmainbox">' +
                '                     <div class="draw_user_itemimgbox">' +
                '                           <div class="draw_user_itemimg"></div>' +
                '                     </div>' +
                '                     <div class="draw_user_imgbord"></div>' +
                '                 </div>' +
                '             </div>' +
                '             <div class="draw_user_itemtitle"></div>' +
                '         </div>' +
                '     </div>';
        }
        $(".draw_user_list").html(html)
    }
    //更新参与人数列表及数量
    function getInactUserNum() {
        var index=b5showloading();
        $.ajax({
            type: "GET",
            url: "/wall/inactusernum?wall_id={{$wallInfo['id']}}",
            data: {},
            dataType: "json",
            success: function(result){
                if (result.code==0) {
                    userslist=result.data.list;
                    $("#inactnum").html(userslist.length)
                }
            },
            complete:function(){
                b5hideloading(index);
            }
        });
    }
    //获取某奖品已中奖人列表
    function getPrizeGetUserList() {
        var prize_id=parseInt($("#prize_id").val());
        if(prize_id==0){
            $(".draw_ruser_list").html('');
            $("#hasnumber").html('0人');
        }else{
            var index=b5showloading();
            $.ajax({
                type: "GET",
                url: "/wall/prizegetuser?wall_id={{$wallInfo['id']}}",
                data: {prize_id:prize_id},
                dataType: "json",
                success: function(result){
                    if (result.code==0) {
                        var list=result.data.list;
                        var html='';
                        for (var i in list){
                            html+='<div class="draw_ruser_item"  data-img="'+list[i].headimg+'" data-title="'+list[i].truename+'">' +
                                '      <div class="draw_ruser_imgbox">' +
                                '          <div class="draw_ruser_img" style="background-image: url('+list[i].headimg+')"></div>' +
                                '      </div>' +
                                '      <div class="draw_ruser_info">'+list[i].truename+'</div>' +
                                '      <div class="draw_ruser_delete" data-openid="'+list[i].openid+'"><i class="fa fa-close"></i></div>' +
                                '  </div>'
                        }
                        $(".draw_ruser_list").html(html);
                        var allnum=$(".draw_ruser_list .draw_ruser_item").length;
                        $("#hasnumber").html(allnum+'人');
                    }else{
                        b5tips(result.msg);
                    }
                },
                complete:function(){
                    b5hideloading(index);
                },
                error:function(){
                    b5tips("网络链接错误");
                }
            });
        }
    }
    //开始抽奖头像滚动
    function circledrawuser() {
        var userscount=userslist.length;
        var i=0;
        $(".draw_user_list .draw_user_itembox").each(function () {
            var that=$(this);
            drawsetInterIndex[i]=setInterval(function () {
                var index=Math.floor(Math.random()*userscount);
                var info=userslist[index];
                that.find(".draw_user_itemimg").css('background-image','url('+info.headimg+')');
                that.find(".draw_user_itemtitle").html(info.truename);
            },100);
            i++;
        })
    }
</script>
@stop
