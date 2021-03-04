<div class="wy_head">
    <div class="con_container">
        <div class="wy_logo"><img src="{{asset('static/site/default/images/logo.png')}}" /></div>
        <div class="" id="header">
            <ul id="nav">
                <li>
                    <a href=""><span>首页</span><span class="bkg"></span></a>
                </li>
                @foreach($menuList as $val)
                    <li>
                        <a href=""><span>{{$val['name']}}</span><span class="bkg"></span></a>
                        @if($val['childArr'])
                            <div class="menuchlist">
                                @foreach($val['childArr'] as $chval)
                                    <a href="">{{$chval['name']}}</a>
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <form class="wy_search" method="get" action="">
            <input type="text" class="wy_text01"  name="keyword"/><input type="submit" value=" " class="wy_but01" />
        </form>
    </div>
</div>
