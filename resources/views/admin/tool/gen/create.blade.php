@extends('admin.layout.form')

@include('widget.asset.select2')

@section('content')
<div class="main-content">
    <div class="col-sm-12 alert alert-warning alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
        <p>该功能主要是基于已存在的数据表，创建控制器、model、模板以及菜单数据（列表、增、删、改）。没有那么智能，只是简单生成，视图html可能需要自己进行修改</p>
        <p>注意：表的字段要添加注释信息</p>
    </div>
    <form class="form-horizontal m" id="form-add">

        <div class="form-group">
            <label class="col-sm-3 control-label is-required">选择表：</label>
            <div class="col-sm-6">
                <select class="form-control select2" name="table" id="table" data-width="400px" data-clear="1" required>
                    <option value="">请选择要生成表</option>
                    @foreach($tableList as $table)
                    <option value="{{$table}}">{{$table}}</option>
                    @endforeach
                </select>
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 已经去除系统自带的表</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">生成类名：</label>
            <div class="col-sm-6">
                <input type="text" name="class" class="form-control" placeholder="生成类名" id="class" required>
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 一般为去除表的前缀，例如：goods_info,生成控制器/模型为 GoodsInfo</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">分组文件夹：</label>
            <div class="col-sm-6">
                <input type="text" name="dir" class="form-control" placeholder="分组文件夹">
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 主要完成后端的简单模块区分，影响控制器和Model的放置位置。例如system，会将控制器放在Admin/System下，Model放在Models/System下</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">创建模式：</label>
            <div class="col-sm-6">
                <select class="form-control" name="create_type">
                    <option value="0">全部</option>
                    <option value="1">控制器</option>
                    <option value="2">视图</option>
                    <option value="3">控制器+视图</option>
                    <option value="4">模型</option>
                </select>
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 默认创建为控制器+视图+模型</span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <div class="row">
                    <label class="col-sm-6 control-label">生成菜单：</label>
                    <div class="col-sm-3">
                        <select class="form-control" name="create_menu">
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <label class="col-sm-6 control-label">生成路由：</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="create_route">
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </div>
                 </div>
            </div>
        </div>
        <div class="row m-t-md">
            <div class="col-sm-offset-5 col-sm-10">
                <button type="button" class="btn btn-sm btn-primary" onclick="submitHandler()"><i class="fa fa-check"></i>保 存</button>
                <button type="button" class="btn btn-sm btn-danger" onclick="closeItem()"><i class="fa fa-reply-all"></i>关 闭 </button>
            </div>
        </div>
    </form>
</div>
@stop

@section('script')
    <script type="text/javascript">
        function select2change(obj){
            var id = obj.attr('id');
            var val = obj.val();
            if(id == 'table'){
                $("#class").val(val)
            }

        }
        function submitHandler() {
            if ($.validate.form()) {
                $.modal.confirm("若已存在会覆盖重新生成，确定继续吗", function() {
                    $.operate.saveTab(aUrl, $('#form-add').serialize());
                });

            }
        }
    </script>
@stop
