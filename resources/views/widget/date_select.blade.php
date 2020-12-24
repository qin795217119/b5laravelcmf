<input name="{{$dateName}}" id="{{$dateName}}" value="{{$dateValue}}" lay-verify="{{$dateType}}" placeholder="请选择{{$dateTips}}" autocomplete="off" class="layui-input date-icon" type="text">
<script>
    layui.use(['function'], function () {
        var func = layui.function;

        // 初始化日期
        func.initDate(['{{$dateName}}|{{$dateType}}'], function (value, date) {
            console.log("当前选择日期:" + value);
            console.log("日期详细信息：" + JSON.stringify(date));
        });
    });
</script>
