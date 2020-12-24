<!-- 引入基类模板 -->
@extends('admin.public.layout')

<!-- 主体部分 -->
@section('content')
    <!-- 功能查询区 -->
    <div class="b5search-collapse mb10">
        <form class="layui-form toolbar">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label w-auto">真实姓名：</label>
                    <div class="layui-input-inline">
                        <input type="text" name="realname" placeholder="请输入真实姓名" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline" style="margin-bottom: 0">
                    <div class="layui-btn-container">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="demo1"><i class="layui-icon layui-icon-search"></i> 搜索</button>
                        <button type="reset" class="layui-btn layui-btn-primary"><i class="layui-icon layui-icon-refresh"></i> 重置</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- 内容区 -->
    <div class="layui-card layui-b5maincard">
        <div class="layui-card-body">
            <div class="b5main_header">
                <div class="layui-btn-container">
                    <button type="button" class="layui-btn"><i class="layui-icon layui-icon-addition"></i> 添加</button>
                    <button type="button" class="layui-btn layui-btn-danger"><i class="layui-icon layui-icon-delete"></i> 删除</button>
                </div>

                <div class="layui-btn-group">
                    <button type="button" class="layui-btn layui-btn-primary b5searchdisplay"><i class="layui-icon layui-icon-search"></i></button>
                    <button type="button" class="layui-btn layui-btn-primary"><i class="layui-icon layui-icon-refresh"></i></button>
                </div>
            </div>
            <div class="b5tablebox">
                <table class="layui-hide" id="tableList"></table>
            </div>

        </div>
    </div>

    <script>
        layui.use('table', function(){
            var table = layui.table;

            //展示已知数据
            table.render({
                elem: '#tableList'
                ,cols: [[ //标题栏
                    {field: 'id', title: 'ID', width: 80, sort: true}
                    ,{field: 'username', title: '用户名', width: 120}
                    ,{field: 'email', title: '邮箱', minWidth: 150}
                    ,{field: 'sign', title: '签名', minWidth: 160}
                    ,{field: 'sex', title: '性别', width: 80}
                    ,{field: 'city', title: '城市', width: 100}
                    ,{field: 'experience', title: '积分', width: 80, sort: true}
                ]]
                ,data: [{
                    "id": "10001"
                    ,"username": "杜甫"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "116"
                    ,"ip": "192.168.0.8"
                    ,"logins": "108"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10002"
                    ,"username": "李白"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "12"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                    ,"LAY_CHECKED": true
                }, {
                    "id": "10003"
                    ,"username": "王勃"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "65"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10004"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "666"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10005"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "86"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10006"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "12"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10007"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "16"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10008"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10009"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10010"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10011"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10012"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10013"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10014"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10015"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10016"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10017"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10018"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10019"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10020"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10021"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10022"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10023"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10024"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10025"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10026"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }, {
                    "id": "10027"
                    ,"username": "贤心"
                    ,"email": "xianxin@layui.com"
                    ,"sex": "男"
                    ,"city": "浙江杭州"
                    ,"sign": "人生恰似一场修行"
                    ,"experience": "106"
                    ,"ip": "192.168.0.8"
                    ,"logins": "106"
                    ,"joinTime": "2016-10-14"
                }]
                //,skin: 'line' //表格风格
                // ,even: true
                ,page: true //是否显示分页
                //,limits: [5, 7, 10]
                //,limit: 5 //每页默认显示的数量
            });
        });
    </script>
@endsection
