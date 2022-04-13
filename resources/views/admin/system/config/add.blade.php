@extends('admin.layout.form')

@section('content')
    <form class="form-horizontal m" id="form-add">
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">配置标题：</label>
            <div class="col-sm-8">
                <input type="text" name="title" value="" class="form-control" placeholder="请输入配置标题" required autocomplete="off"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label is-required">配置标识：</label>
            <div class="col-sm-8">
                <input type="text" name="type" value="" class="form-control" placeholder="请输入配置标识" required autocomplete="off"/>
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 角色唯一标识，使用3-20为字母、数字或‘_’组成</span>
            </div>
        </div>
        <div class="form-group mb0">
            <label class="col-sm-3 control-label is-required">配置类型：</label>
            <div class="col-sm-3 mb15">
                <select name="style" class="form-control">
                    <option value="">请选择配置类型</option>
                    @foreach ($styleList as $type=>$name)
                        <option value="{{$type}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
            <label class="col-sm-2 control-label">配置分组：</label>
            <div class="col-sm-3 mb15">
                <select name="groups" class="form-control">
                    <option value="">请选择配置分组</option>
                    @foreach ($groupList as $type=>$name)
                        <option value="{{$type}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">配置值：</label>
            <div class="col-sm-8">
                <textarea name="value" class="form-control" rows="3"></textarea>
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 当为枚举类型时，标识选中该值</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">配置项：</label>
            <div class="col-sm-8">
                <textarea name="extra" class="form-control" rows="3"></textarea>
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 只有类型为枚举类型时有效，表示枚举列表</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label ">备注：</label>
            <div class="col-sm-8">
                <textarea name="note" class="form-control" placeholder="请输入备注"></textarea>
            </div>
        </div>
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-add').serialize());
            }
        }
    </script>
@stop
