<input type="text" id="{{$iconName}}" name="{{$iconName}}" lay-filter="{{$iconName}}" value="{{$iconValue}}" class="hide">
<style type="text/css">
    .layui-iconpicker .layui-anim {
        display: none;
        position: absolute;
        left: 0;
        top: 42px;
        padding: 5px 0;
        z-index: 899;
        min-width: 150%;
        border: 1px solid #d2d2d2;
        max-height: 300px;
        overflow-y: auto;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 4px rgba(0,0,0,.12);
        box-sizing: border-box;
    }
</style>
<script>
    layui.use(['iconPicker'], function () {
        var iconPicker = layui.iconPicker;

        /**
         * 选中图标 （常用于更新时默认选中图标）
         */
        iconPicker.checkIcon('{{$iconName}}', '{{$iconValue}}')

        iconPicker.render({
            // 选择器，推荐使用input
            elem: '#{{$iconName}}',
            // 数据类型：fontClass/unicode，推荐使用fontClass
            type: 'fontClass',
            // 是否开启搜索：true/false，默认true
            search: true,
            // 是否开启分页：true/false，默认true
            page: true,
            // 每页显示数量，默认12
            limit: 12,
            // 点击回调
            click: function (data) {
                console.log(data);
            },
            // 渲染成功后的回调
            success: function (d) {
                console.log(d);
            }
        });
    });
</script>
