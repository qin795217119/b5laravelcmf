@extends('admin.public.form')

@include('widget.asset.dragula')
@include('widget.asset.mypicker')
@include('widget.asset.jscolor')

@section('content')
    <form class="form-horizontal m" id="form-mapply-edit">
        @render('iframe',['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])
        <div class="bs-example bs-example-tabs b5navtab" data-example-id="togglable-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#base_con" id="base_con-tab" role="tab" data-toggle="tab" aria-controls="base_con" aria-expanded="true">活动信息</a>
                </li>
                <li role="presentation">
                    <a href="#link_con" id="link_con-tab" role="tab" data-toggle="tab" aria-controls="link_con" aria-expanded="true">联系地址</a>
                </li>
                <li role="presentation">
                    <a href="#user_con" id="user_con-tab" role="tab" data-toggle="tab" aria-controls="user_con" aria-expanded="true">预约信息</a>
                </li>
                <li role="presentation">
                    <a href="#share_con" id="share_con-tab" role="tab" data-toggle="tab" aria-controls="share_con" aria-expanded="true">分享配置</a>
                </li>
            </ul>
            <div class="tab-content mt20">
                <div role="tabpanel" class="tab-pane fade active in" id="base_con" aria-labelledby="base_con-tab">
                    @render('iframe',['name'=>'forminput|活动名称','extend'=>['name'=>'title','required'=>1,'sm'=>'2','info'=>$info]])
                    @render('iframe',['name'=>'image|顶部图片','extend'=>['name'=>'banner','id'=>'bannerimgbtn','multi'=>'true','sm'=>2,'width'=>750,'cat'=>'mapply','drag'=>'true','tips'=>'宽为750像素，高度随意。可拖动图片进行排序。','info'=>$info]])
                    <div class="form-group mb0">
                        <label class="col-sm-2 control-label">活动开关：</label>
                        <div class="col-sm-3 mb15">
                            @render('iframe',['name'=>'radio','extend'=>['name'=>'status','required'=>1,'info'=>$info,'sm'=>'2','data'=>['关闭','开启'],'class'=>'form-control jscolor']])
                        </div>
                        <label class="col-sm-3 control-label">主题颜色：</label>
                        <div class="col-sm-3 mb15">
                            @render('iframe',['name'=>'input','extend'=>['name'=>'themecolor','required'=>1,'class'=>'form-control jscolor','info'=>$info]])
                        </div>
                    </div>
                    @render('iframe',['name'=>'formtextarea|活动介绍','extend'=>['name'=>'rules','sm'=>'2','rows'=>6,'tips'=>'可填写活动信息或活动规则','info'=>$info]])
                </div>
                <div role="tabpanel" class="tab-pane" id="link_con" aria-labelledby="link_con-tab">
                    @render('iframe',['name'=>'forminput|主办单位','extend'=>['name'=>'com_name','sm'=>'2','info'=>$info]])
                    @render('iframe',['name'=>'forminput|联系电话','extend'=>['name'=>'com_phone','sm'=>'2','info'=>$info]])
                    @render('iframe',['name'=>'forminput|活动地址','extend'=>['name'=>'com_address','id'=>'com_address','sm'=>'2','info'=>$info]])
                    <div class="form-group mb0">
                        <label class="col-sm-2 control-label">地图经纬度：</label>
                        <div class="col-sm-9 mb15">
                            @render('iframe',['name'=>'input','extend'=>['name'=>'com_lng','id'=>'com_lng','type'=>'number','class'=>'form-control','style'=>'max-width:160px;display:inline-block','place'=>'经度','info'=>$info]])
                            @render('iframe',['name'=>'input','extend'=>['name'=>'com_lat','id'=>'com_lat','type'=>'number','class'=>'form-control','style'=>'max-width:160px;display:inline-block','place'=>'纬度','info'=>$info]])
                            <a href="javascript:showMapSelect();" class="btn btn-primary btn-sm" id="checkmap"><i class="fa fa-map-marker"></i> 点击选择</a>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="user_con" aria-labelledby="user_con-tab">
                    <div class="form-group mb0">
                        <label class="col-sm-2 control-label is-required">预约金额：</label>
                        <div class="col-sm-3 mb15">
                            @render('iframe',['name'=>'input','extend'=>['name'=>'money','type'=>'number','required'=>1,'info'=>$info,'sm'=>'2','tips'=>'若金额为0，则不会调用支付','class'=>'form-control']])
                        </div>
                        <label class="col-sm-2 control-label is-required">重复预约：</label>
                        <div class="col-sm-4 mb15">
                            @render('iframe',['name'=>'radio','extend'=>['name'=>'is_multi','required'=>1,'info'=>$info,'sm'=>'2','data'=>['否','是'],'class'=>'form-control']])
                        </div>
                    </div>
                    <div class="form-group mb0">
                        <label class="col-sm-2 control-label">预约时间：</label>
                        <div class="col-sm-9 mb15">
                            <div class="row">
                                <div class="col-xs-6 col-sm-5 col-md-4">
                                    <div class="input-group">
                                        @render('iframe',['name'=>'input','extend'=>['name'=>'start_time','id'=>'start_time','class'=>'form-control','place'=>'开始时间','addon'=>'fa-calendar-minus-o','info'=>$info]])
                                    </div>
                                </div>
                                <div class="hidden-xs" style="float: left;height: 30px;line-height: 30px">&nbsp;-&nbsp;</div>
                                <div class="col-xs-6 col-sm-5 col-md-4">
                                    <div class="input-group">
                                        @render('iframe',['name'=>'input','extend'=>['name'=>'end_time','id'=>'end_time','class'=>'form-control','place'=>'结束时间','addon'=>'fa-calendar-minus-o','info'=>$info]])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb0">
                        <label class="col-sm-2 control-label">预约表单：</label>
                        <div class="col-sm-9 mb15">
                            <select id="selectformfield" class="form-control" style="display: inline-block;width: auto">
                                <option value="">选择用户提交的信息</option>
                                @foreach($fieldList as $fkey=>$fval)
                                    <option value="{{$fkey}}">{{$fval}}</option>
                                @endforeach
                            </select>
                            <a href="javascript:addVolumeItem();" class="btn btn-primary btn-sm" id="checkmap"><i class="fa fa-plus"></i> 确认添加</a>
                            <div class="seletedformfieldbox">
                                @foreach ($info['regfield'] as $regfieldkey=>$regfileddinfo)
                                    <div class="optionlist-item optionlist-item-{{$regfieldkey}}" style="margin-top: 5px;margin-bottom: 0;">
                                        <a href="javascript:;" class="removeAttrFilter" onclick="removeVolume(this)">
                                            <i class="fa fa-minus-square-o" style="font-size: 18px;vertical-align: top;margin-top: 7px"></i>
                                            </a>
                                        <label style="display: inline-block;min-width: 80px">{{$fieldList[$regfieldkey]??''}}：</label>
                                        <label >显示名称：</label>
                                        <input type="text" class="form-control" style="width: 150px;display: inline-block;" autocomplete="off"  name="regfieldup[{{$regfieldkey}}][title]" value="{{$regfileddinfo['title']}}">
                                        <label>必填 <input type="checkbox" autocomplete="off" name="regfieldup[{{$regfieldkey}}][require]" value="1" style="margin-top: 3px;vertical-align: top" {{$regfileddinfo['require']=='1'?'checked':''}}></label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @render('iframe',['name'=>'formtextarea|预约协议','extend'=>['name'=>'agreement','sm'=>'2','rows'=>6,'info'=>$info]])
                </div>
                <div role="tabpanel" class="tab-pane" id="share_con" aria-labelledby="share_con-tab">
                    @render('iframe',['name'=>'forminput|分享标题','extend'=>['name'=>'share_title','sm'=>'2','tips'=>'为空时，默认为活动标题','info'=>$info]])
                    @render('iframe',['name'=>'formtextarea|分享简介','extend'=>['name'=>'share_desc','sm'=>'2','rows'=>2,'tips'=>'为空时，默认为活动标题','info'=>$info]])
                    @render('iframe',['name'=>'image|分享logo','extend'=>['name'=>'share_img','id'=>'shareimgbtn','multi'=>'false','link'=>'false','sm'=>2,'tips'=>'宽高最大为200*200像素，比例1：1','cat'=>'mapply','width'=>200,'height'=>200,'info'=>$info]])
                </div>
            </div>
        </div>
    </form>
@stop

@section('script')
    <script>
        $(function () {
            $("#start_time").click(function () {
                WdatePicker({maxDate:'#F{$dp.$D(\'start_time\')}',dateFmt:'yyyy-MM-dd HH:mm:ss'})
            });
            $("#end_time").click(function () {
                WdatePicker({minDate:'#F{$dp.$D(\'start_time\')}',dateFmt:'yyyy-MM-dd HH:mm:ss'})
            });
        });
        function addVolumeItem() {
            var selectedname = $("#selectformfield").val();
            if (selectedname === '') {
                $.modal.tips('请选择提交的信息选项');
                return false
            }
            if ($(".optionlist-item-" + selectedname).length > 0) {
                $.modal.tips('该提交的信息选项已经存在');
                return false
            }
            var selectedtitle = $("#selectformfield").find("option:selected").text();
            var html =
                '<div class="optionlist-item optionlist-item-' + selectedname + '" style="margin-top: 5px;margin-bottom: 0;">' +
                '    <a href="javascript:;" class="removeAttrFilter" onclick="removeVolume(this)">' +
                '        <i class="fa fa-minus-square-o" style="font-size: 18px;vertical-align: top;margin-top: 7px"></i>' +
                '    </a>' +
                '    <label style="display: inline-block;min-width: 80px">' + selectedtitle + '：</label>' +
                '    <label >显示名称：</label>' +
                '    <input type="text" class="form-control" style="width: 150px;display: inline-block;" autocomplete="off"  name="regfieldup[' + selectedname + '][title]" value="' + selectedtitle + '">' +
                '    <label>必填 <input type="checkbox" autocomplete="off" name="regfieldup[' + selectedname + '][require]" value="1" style="margin-top: 3px;vertical-align: top"></label>' +
                '</div>';
            $(".seletedformfieldbox").append(html)
        }

        function removeVolume(obj) {
            $(obj).parents('.optionlist-item').remove()
        }
        function showMapSelect() {
            var keyword=$("#com_address").val();
            var lat=$("#com_lat").val();
            var lng=$("#com_lng").val();
            var url = mUrl + "/common/mapselect?keyword="+keyword+"&lat="+lat+"&lng="+lng;
            var options = {
                title: '选择经纬度',
                width: "500",
                url: url,
                callBack: checkMap
            };
            $.modal.openOptions(options);
        }
        function checkMap(index, layero){
            var body = layer.getChildFrame('body', index);
            $("#com_lat").val(body.find('#lat').val());
            $("#com_lng").val(body.find('#lng').val());
            layer.close(index);
        }
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-mapply-edit').serialize());
            }
        }
    </script>
@stop
