@extends('admin.public.form')
@section('content')
    <div class="model-box">
        <form class="layui-form model-form" action="" after-submit="afterSubForm">
            <input name="id" id="id" type="hidden" value="{{$info['id'] ?? 0}}">
            <div class="layui-form-item">
                <label class="layui-form-label">权限分组：</label>
                <div class="layui-input-inline">
                    <input name="name" value="{{$info['name'] ?? ''}}" lay-verify="required" autocomplete="off" placeholder="请输入权限分组" class="layui-input" type="text">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">状态：</label>
                <div class="layui-input-block">
                    @render('form',['name'=>'switch','extend'=>['name'=>'status','value'=>isset($info['status'])?$info['status']:1]])
                </div>
            </div>

            <div class="layui-form-item layui-form-text" >
                <label class="layui-form-label">备注：</label>
                <div class="layui-input-block">
                    <textarea name="note" placeholder="请输入备注" class="layui-textarea wm600">{{$info['note'] ??''}}</textarea>
                </div>
            </div>
            <div class="layui-form-item text-center mt20">
                @render('button',['name'=>'submit|立即保存'])
                @render('button',['name'=>'close|关闭'])
            </div>
        </form>
    </div>
@endsection
