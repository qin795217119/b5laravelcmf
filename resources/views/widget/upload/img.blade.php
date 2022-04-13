@php
    $widget_data['name'] = $widget_data['name']??'';
    $widget_data['title'] = $widget_data['title']??'上传图片';
    $widget_data['link'] = $widget_data['link']??'';
    $widget_data['tips'] = $widget_data['tips']??'';
    $widget_data['multi'] = intval($widget_data['multi']??'1');
    $widget_data['width'] = $widget_data['width']??'';
    $widget_data['height'] = $widget_data['height']??'';
    $widget_data['cat'] = $widget_data['cat']??'';
    $widget_data['crop'] = $widget_data['crop']??'';
    $widget_data['data'] = $widget_data['data']??'';
@endphp

<div class="b5uploadmainbox b5uploadimgbox" data-type="img">
    <button type="button" class="btn-b5upload btn btn-primary btn-sm" id="{{$widget_data['name']}}" data-multi="{{$widget_data['multi']}}" data-height="{{$widget_data['height']}}" data-width="{{$widget_data['width']}}" data-cat="{{$widget_data['cat']}}"><i class="fa fa-image"></i>{{$widget_data['title']}}</button>

    @if($widget_data['link'])
    或 <div class="uploadimg_link">
        <input type="text" class="form-control" id="{{$widget_data['name']}}_link" />
        <a href="javascript:;" class="btn btn-primary btn-sm" id="{{$widget_data['name']}}_linkbtn"><i class="fa fa-link"></i>添加</a>
    </div>
    @endif
    @if($widget_data['tips'])
    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> {{$widget_data['tips']}}</span>
    @endif
    <div class="b5uploadlistbox {{$widget_data['name']}}_imglist" id="{{$widget_data['name']}}_imglist"></div>
</div>

@section('script_before')
    <script>
        $(function () {
            @if($widget_data['link'])
                b5uploadImgLink("{{$widget_data['name']}}");
            @endif

            @if($widget_data['crop'])
                $("#{{$widget_data['name']}}").click(function () {
                    var url = "{{route('admin.cropper')}}";
                    var params = "id={{$widget_data['name']}}&cat={{$widget_data['cat']}}";
                    url = urlcreate(url,params);
                    $.modal.open("上传裁剪图片",url);
                });
            @else
                b5uploadimginit("{{$widget_data['name']}}");
            @endif

            @if($widget_data['multi']>1)
                dragula([{{$widget_data['name']}}_imglist]);
            @endif

            @if($widget_data['data'])
                @php
                    if(is_string($widget_data['data'])){
                        $widget_data['data'] = explode(',',$widget_data['data']);
                    }
                @endphp
                @foreach ($widget_data['data'] as $widget_data_val)
                    @php
                        $widget_data_url = \App\Extends\Helpers\Functions::getFileUrl($widget_data_val);
                    @endphp
                    b5uploadhtmlshow("{{$widget_data['name']}}",b5uploadimghtml("{{$widget_data_val}}","{{$widget_data['name']}}","{{$widget_data_url}}"))
                @endforeach
            @endif
        })
    </script>
@append
