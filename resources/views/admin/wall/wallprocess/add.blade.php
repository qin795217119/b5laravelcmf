@extends('admin.public.form')
@include('widget.asset.mypicker')

@section('content')
    <form class="form-horizontal m" id="form-wallprocess-add">
        <input type="hidden" name="wall_id" value="{{$wallInfo['id']}}">
        @render('iframe',['name'=>'forminput|日程标题','extend'=>['name'=>'title','required'=>1,'sm'=>'2']])
        @render('iframe',['name'=>'forminput|日程日期','extend'=>['name'=>'daytime','required'=>1,'sm'=>'2','id'=>'daytime','readonly'=>'']])
        @render('iframe',['name'=>'forminput|日程时间','extend'=>['name'=>'hour','sm'=>'2','tips'=>'具体小时分钟，例如08:00-10:30']])
        @render('iframe',['name'=>'forminput|排序','extend'=>['type'=>'number','name'=>'listsort','value'=>0,'sm'=>'2','tips'=>'从小到大排序，越小的在前面']])
        @render('iframe',['name'=>'formradio|状态','extend'=>['name'=>'status','required'=>1,'sm'=>'2','value'=>1]])
        @render('iframe',['name'=>'formtextarea|日程介绍','extend'=>['name'=>'desc','sm'=>2]])
    </form>
@stop

@section('script')
    <script>
        $("#daytime").click(function () {
            WdatePicker({dateFmt:'yyyy-MM-dd'})
        });
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-wallprocess-add').serialize());
            }
        }
    </script>
@stop
