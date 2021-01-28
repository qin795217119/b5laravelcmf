<!DOCTYPE html>
<html lang="zh" xmlns:th="http://www.thymeleaf.org">
<head>
    <title>选择经纬度</title>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="{{asset('static/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <style>
        body, html{width: 100%;height: 100%;margin:0;font-family:"微软雅黑";}
        #l-map{min-height:300px;height:100%;width:100%;position: relative}
        #r-result{width:100%;}
    </style>
</head>
<body>
<div id="r-result" style="position: absolute;z-index: 999;right: 0">
    <input type="text" id="place" style="width: 170px;font-size: 12px;margin-right: 2px;color: #333;float: right" value="{{$keyword}}">
    <input type="hidden" id="lat" value="{{$lat}}">
    <input type="hidden" id="lng" value="{{$lng}}">

</div>
<div id="l-map">
</div>
<script src="{{asset('static/plugins/jquery/jquery-1.12.4.min.js')}}"></script>
<script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp&libraries=place&key={{$mapkey}}"></script>
<script type="text/javascript">
    var keyword="{{$keyword}}";
    var keyfirst="{{$keyfirst}}";
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var geocoder,map,marker = null;
    $(function () {
        init();
        if(keyword!="" && keyfirst=="1"){
            geocoder.getLocation(keyword);
        }
    });

    var init= function() {
        var center = new qq.maps.LatLng({{$lat}},{{$lng}});
        map = new qq.maps.Map(document.getElementById('l-map'),{
            center: center,
            panControl: false,
            zoomControl:false,
            mapTypeControl:false,
            scaleControl:false,
            zoom: 15
        });

        showCenterMarker();
        //地址解析类
        geocoder = new qq.maps.Geocoder({
            complete : function(result){
                map.setCenter(result.detail.location);
                showCenterMarker();
            }
        });
        //实例化自动完成
        var ap = new qq.maps.place.Autocomplete(document.getElementById('place'));
        //调用Poi检索类。用于进行本地检索、周边检索等服务。
        var searchService = new qq.maps.SearchService({
            complete:function(ees){
                if(ees.type=='POI_LIST'){
                    if(ees.detail.pois.length>0){
                        var conss=ees.detail.pois[0];
                        var thislocation = new qq.maps.LatLng(conss.latLng.lat,conss.latLng.lng);
                        map.setCenter(thislocation);
                        showCenterMarker();
                    }
                }

            }
        });
        //添加关键字检索选中
        qq.maps.event.addListener(ap, "confirm", function(res){
            searchService.search(res.value);
        });

        //添加地图拖动事件
        qq.maps.event.addListener(map, "drag", function(res){
            showCenterMarker();
        });
    };
    function showCenterMarker() {
        var mapCenter = map.getCenter();
        if(!marker){
            marker = new qq.maps.Marker({
                position: mapCenter,
                draggable: true,
                map: map
            });
        }else{
            marker.setPosition(mapCenter);
        }

        $("#lat").val(mapCenter.getLat().toFixed(7));
        $("#lng").val(mapCenter.getLng().toFixed(7));
    }
</script>
</body>
</html>

