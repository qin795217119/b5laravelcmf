@extends('web.wall.layout')

@section('content')
<div class="signbox scrollbox" id="signbox">
    <ul id="userlist"></ul>
</div>
<script>
    var userlist=[];
    var lastid=0;
    var isload=false;
    $(function () {
        getUserList();
        setInterval(function () {
            getUserList()
        },3000);
        setInterval(function () {
            showUsers()
        },500)
    });
    function showUsers() {
        if(userlist.length>0){
            var info=userlist.shift();
            if(info){
                var html='<li>' +
                    '            <div class="imgbox">' +
                    '                <div class="img" style="background-image: url('+(info.headimg==''?deheader:info.headimg)+')"></div>' +
                    '            </div>' +
                    '            <div class="title">'+info.nickname+'</div>' +
                    '        </li>';
                $("#userlist").append(html);
                var ele = document.getElementById('signbox');
                ele.scrollTop = ele.scrollHeight;

            }
        }
    }
    function getUserList() {
        if(isload) return false;
        isload=true;
        $.ajax({
            type: 'GET',
            url: '/wall/getsignlist?wall_id={{$wallInfo['id']}}',
            data: {lastid:lastid},
            dataType: "json",
            success: function(result){
                if (result.code==0) {
                    $(".header_numbox").html(result.data.count+'人');
                    var list=result.data.list;
                    for (var i in list){
                        userlist.push(list[i])
                        lastid=list[i].id;
                    }
                }
            },
            complete: function(){
                isload=false;
            }
        });
    }
</script>
@stop
