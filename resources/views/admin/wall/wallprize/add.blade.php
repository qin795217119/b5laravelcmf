@extends('admin.public.form')

@section('content')
    <form class="form-horizontal m" id="form-wallprize-add">
        <input type="hidden" name="wall_id" value="{{$wallInfo['id']}}" id="wall_id">
        @render('iframe',['name'=>'forminput|所属活动','extend'=>['name'=>'','required'=>1,'sm'=>'2','value'=>$wallInfo['title'],'disabled'=>'']])
        @render('iframe',['name'=>'forminput|奖品等级','extend'=>['name'=>'title','required'=>1,'sm'=>'2','tips'=>'例如：一等奖，二等奖']])
        @render('iframe',['name'=>'forminput|奖品名称','extend'=>['name'=>'name','required'=>1,'sm'=>'2','tips'=>'奖品真实名称']])
        @render('iframe',['name'=>'forminput|奖品数量','extend'=>['type'=>'number','name'=>'number','required'=>1,'sm'=>'2']])
        @render('iframe',['name'=>'image|奖品图片','extend'=>['name'=>'thumbimg','id'=>'thumbimgbtn','sm'=>2,'tips'=>'400*400像素','width'=>'400','height'=>'400','cat'=>'wall']])
    </form>
@stop

@section('script')
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-wallprize-add').serialize());
            }
        }
    </script>
@stop
