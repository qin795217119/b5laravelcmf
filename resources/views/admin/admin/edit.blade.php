@extends('admin.public.form')
@section('content')
    <div class="model-box">
        <form class="layui-form model-form" action="" before-submit="before_submit">
            <input name="id" id="id" type="hidden" value="{{isset($info['id']) ? $info['id'] : 0}}">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label"><i class="red">*</i>用户名：</label>
                    <div class="layui-input-inline">
                        <input name="username" value="{{isset($info['username']) ? $info['username'] : ''}}" lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input {{(isset($info['id']) && $info['id']=='1')?'layui-disabled':''}}" type="text" {{(isset($info['id']) && $info['id']=='1')?'disabled':''}}>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">密码：</label>
                    <div class="layui-input-inline">
                        <input name="password" placeholder="请输入密码" autocomplete="off" class="layui-input" type="password">
                    </div>
                    <div class="layui-form-mid layui-word-aux">{{(isset($info['id']) && $info['id'])?'不填，保持不变':'不填，默认为123456'}}</div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label"><i class="red">*</i>权限分组：</label>
                    <div class="layui-input-inline">
                        @render('button',['name'=>'select|权限分组','extend'=>['name'=>'group_id','required'=>(isset($info['id']) && $info['id'])==1?0:1,'value'=>$info['group_id']??'','data'=>$authgroup,'showvalue'=>'id','showname'=>'name']])
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">真实姓名：</label>
                    <div class="layui-input-inline">
                        <input name="realname" value="{{isset($info['realname']) ? $info['realname'] : ''}}" autocomplete="off" placeholder="请输入真实姓名" class="layui-input" type="text">
                    </div>
                    <div class="layui-form-mid layui-word-aux">不填，默认为用户名</div>
                </div>
            </div>
            <div class="layui-form-item layui-form-text" >
                <label class="layui-form-label">备注：</label>
                <div class="layui-input-block">
                    <textarea name="note" placeholder="请输入备注" class="layui-textarea wm600">{{isset($info['note']) ? $info['note'] : ''}}</textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">状态：</label>
                <div class="layui-input-block">
                    @render('form',['name'=>'switch','extend'=>['name'=>'status','value'=>isset($info['status'])?$info['status']:1]])
                </div>
            </div>
            <div class="layui-form-item text-center mt20">
                @render('button',['name'=>'submit|立即保存'])
                @render('button',['name'=>'close|关闭'])
            </div>
        </form>
    </div>
@endsection
