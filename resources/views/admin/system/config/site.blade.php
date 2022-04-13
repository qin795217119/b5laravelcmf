@extends('admin.layout.layout')

@section('content')
    <div class="mt10" style="background-color: #fff;padding: 10px">
        @if(!empty($lists))
            <div class="bs-example bs-example-tabs b5navtab" data-example-id="togglable-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    @foreach($lists as $groupkey=>$groups)
                        <li role="presentation" class="@if ($loop->first) active @endif"><a href="#{{$groupkey}}" id="{{$groupkey}}-tab" role="tab" data-toggle="tab" aria-controls="{{$groupkey}}" aria-expanded="true">{{$groups['title']}}</a></li>
                    @endforeach
                </ul>
                <div class="tab-content mt20">
                    @foreach($lists as $groupkey=>$groups)
                        <div role="tabpanel" class="tab-pane fade @if ($loop->first) active in @endif" id="{{$groupkey}}" aria-labelledby="{{$groupkey}}-tab">
                            @if($groups['chList'])
                                <form class="form-horizontal" id="form-config-site-{{$groupkey}}">
                                    @foreach($groups['chList'] as $input)
                                        @if($input['style']=='text')
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">{{$input['title']}}：</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="{{$input['id']}}" value="{{$input['value']}}" class="form-control" autocomplete="off">
                                                    @if(!empty($input['note']))
                                                        <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> {{$input['note']}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        @if($input['style']=='textarea')
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">{{$input['title']}}：</label>
                                                <div class="col-sm-9">
                                                    <textarea rows="3" name="{{$input['id']}}" class="form-control" >{{$input['value']}}</textarea>
                                                    @if(!empty($input['note']))
                                                        <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> {{$input['note']}}</span>
                                                    @endif
                                                </div>

                                            </div>
                                        @endif
                                        @if($input['style']=='select')
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">{{$input['title']}}：</label>
                                                <div class="col-sm-9">
                                                    <select name="{{$input['id']}}" class="form-control">
                                                        @foreach($input['extra'] as $ikey=>$ival)
                                                            <option value="{{$ikey}}" @if($ikey==$input['value']) selected=""@endif>{{$ival}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if(!empty($input['note']))
                                                        <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> {{$input['note']}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        @if($input['style']=='array')
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">{{$input['title']}}：</label>
                                                <div class="col-sm-9">
                                                    <textarea rows="3" name="{{$input['id']}}" class="form-control" >{{$input['value']}}</textarea>
                                                    @if(!empty($input['note']))
                                                        <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> {{$input['note']}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="form-group text-center mt20">
                                        <a href="javascript:;" class="btn btn-success btn-mid b5submit_btn" data-target="form-config-site-{{$groupkey}}" data-title="确定提交网站配置信息">保存</a>
                                    </div>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@stop

@section('script')
    <script>
        $(function (){
            $(".nav-tabs li:first").addClass('active')
            $(".tab-content .tab-pane:first").addClass('active')
        })
    </script>
@stop
