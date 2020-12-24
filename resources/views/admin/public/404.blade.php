<!DOCTYPE html>
<html>
<!-- 引入头部 -->
@include("public.header")
<body>
<!-- 正文开始 -->
<div class="error-page">
    <img class="error-page-img" src="/static/admin/assets/images/ic_404.png">
    <div class="error-page-info">
        <h1>404</h1>
        <p>哎呦，您访问的页面不存在(⋟﹏⋞)</p>
        <div>
            <a ew-href="/index/main" class="layui-btn">返回首页</a>
        </div>
    </div>
</div>
<style>
    .error-page {
        position: absolute;
        top: 50%;
        width: 100%;
        text-align: center;
        -o-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        -moz-transform: translateY(-50%);
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    .error-page .error-page-img {
        display: inline-block;
        height: 260px;
        margin: 10px 15px;
    }

    .error-page .error-page-info {
        vertical-align: middle;
        display: inline-block;
        margin: 10px 15px;
    }

    .error-page .error-page-info > h1 {
        color: #434e59;
        font-size: 72px;
        font-weight: 600;
    }

    .error-page .error-page-info > p {
        color: #777;
        font-size: 20px;
        margin-top: 5px;
    }

    .error-page .error-page-info > div {
        margin-top: 30px;
    }
</style>

<!-- 引入脚部 -->
@include("public.footer")
</body>
</html>
