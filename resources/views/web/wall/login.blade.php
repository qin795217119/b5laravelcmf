@extends('web.wall.layout')

@section('content')
    <div class="loginbox">
        <div class="loginmain">
            <div class="loginform">
                <form action="" method="post" onsubmit="return false" id="subform">
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="请输入管理密码">
                    </div>
                    <div class="form-group">
                        <input type="button" class="loginsubbtn" value="点击进入">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var islogin=false;
        $(function () {
            $("#password").focus();
            $(".loginsubbtn").click(function () {
                subform()
            });
            $(document).keypress(function(event){
                if(event.keyCode ==13){
                    subform();
                    event.preventDefault();
                }
            });
        });

        function subform() {
            var password=$("#password").val();
            if(password==''){
                b5tips('请输入密码');
                return false;
            }
            if(islogin) return false;
            islogin=true;
            var url=window.location.href;
            var loadindex=b5showloading();
            $.ajax({
                type: "POST",
                url: url,
                data: $("#subform").serialize(),
                dataType: "json",
                success: function(data){
                    b5tips(data.msg,data.url);
                },
                complete:function(){
                    islogin=false;
                    b5hideloading(loadindex);
                },
                error:function(){
                    b5tips("网络链接错误");
                }
            });
            return false;
        }
    </script>
@stop
