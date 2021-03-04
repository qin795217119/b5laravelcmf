@extends('web.site.default.layout')

@section('content')
<div class="b5index-banner">
    <div class="swiper-container banner-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a href="javascript:;" style="background-image: url({{asset('static/site/default/images/demo/banner_1.jpg')}})"></a>
            </div>
            <div class="swiper-slide">
                <a href="javascript:;" style="background-image: url({{asset('static/site/default/images/demo/banner_2.jpg')}})"></a>
            </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-white"></div>
    </div>
</div>

<div class="con_container">
    <div class="b5_title01"><a href="" target="_blank">产品中心<span>/<small>PRODUCTS</small></span></a></div>
    <div class="b5_index_productList">
        <div class="swiper-container product-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a class="index_swiper_item" href="./peixun_shizi_1.html">
                        <div class="index_swiper_img" style="background-image: url({{asset('static/site/default/images/demo/shizi_1.png')}})"></div>
                        <div class="index_swiper_title">庄纪旭</div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a class="index_swiper_item" href="./peixun_shizi_2.html">
                        <div class="index_swiper_img" style="background-image: url({{asset('static/site/default/images/demo/shizi_2.png')}})"></div>
                        <div class="index_swiper_title">柴鸥林</div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a class="index_swiper_item" href="./peixun_shizi_3.html">
                        <div class="index_swiper_img" style="background-image: url({{asset('static/site/default/images/demo/shizi_3.png')}})"></div>
                        <div class="index_swiper_title">杨建中</div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a class="index_swiper_item" href="./peixun_shizi_3.html">
                        <div class="index_swiper_img" style="background-image: url({{asset('static/site/default/images/demo/shizi_4.png')}})"></div>
                        <div class="index_swiper_title">杨建中</div>
                    </a>
                </div><div class="swiper-slide">
                    <a class="index_swiper_item" href="./peixun_shizi_2.html">
                        <div class="index_swiper_img" style="background-image: url({{asset('static/site/default/images/demo/shizi_2.png')}})"></div>
                        <div class="index_swiper_title">柴鸥林</div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a class="index_swiper_item" href="./peixun_shizi_3.html">
                        <div class="index_swiper_img" style="background-image: url({{asset('static/site/default/images/demo/shizi_3.png')}})"></div>
                        <div class="index_swiper_title">杨建中</div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a class="index_swiper_item" href="./peixun_shizi_3.html">
                        <div class="index_swiper_img" style="background-image: url({{asset('static/site/default/images/demo/shizi_4.png')}})"></div>
                        <div class="index_swiper_title">杨建中</div>
                    </a>
                </div>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next swiper-button-white"></div>
            <div class="swiper-button-prev swiper-button-white"></div>
        </div>
    </div>
</div>
<div class="b5_index_content02">
    <div class="con_container">
        <div class="b5_con2_left01">
            <div class="b5_con2_ltitle"><a href="" target="_blank">关于我们<span>/<small>abuot us</small></span></a></div>
            <p>江花集团:前身系山东江花水表有限公司，创建于1999年。</p>
            <p>总部位于山东省临沂市李官镇工业园，注册资金1.06亿。</p>
            <p>集团公司是一家涵盖水表、热量表的研发与制造、智能物联网、无线传输和采集、智慧城市的发展和建设，家居软装、市政园林、水表互联网、金融管理、文化产业与餐饮等七大核心产业的大型集团公司，市场遍布国内近三十余省市、自治区和直辖市，产品远销港澳台，欧美、中东等国家和地区。</p>
            <a href="" target="_blank" class="b5_con2_more01">查看详情</a>
        </div>
        <div class="b5_con2_right01">
            <img src="{{asset('static/site/default/images/img01.jpg')}}">
        </div>
    </div>
</div>
<script>
    $(function () {
        new Swiper('.banner-container', {
            autoplay: true,
            effect:'fade',
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
        new Swiper('.product-container', {
            autoplay: {
                delay: 4000,
                stopOnLastSlide: false,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            speed: 1000,
            spaceBetween:25,
            slidesPerView: 'auto'
        });

    })
</script>
@stop
