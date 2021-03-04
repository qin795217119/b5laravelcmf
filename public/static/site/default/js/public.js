var win = $(window),
    nav_on = null;
$(function () {
    // 导航栏控制
    (function () {
        var nav = $('#nav'),
            shop = $('#shop'),
            // search_box = shop.find('#searchbox'),
            // search_btn = shop.find('.btn-search')[0],
            lis = nav.children(),
            lis_1 = lis.filter(':not(.more)'),
            lis_2 = lis.filter('.more'),
            links = lis.children(),
            links_1 = lis_1.children(),
            links_2 = lis_2.children(),
            subNav = $('#subNav'),
            subitem = $('#subNav').find('.item'),
            prev_item = $(),
            spans = links.children(),
            offs = spans.filter('.off'),
            ons = spans.filter('.on'),
            sbs = spans.filter('.slideBlock'),

            hei = links.eq(0).height(),
            len = lis.length,

            // 记录当前
            link_page = null,
            link_curr = null,

            timeout = -1;

        // 初始化当前链接
        //href = location.href.replace(/[_\d]{1,2}\./, '.');      // 静态页面用
         href = location.href;                                  // 程序用
        console.log(href);
        for (var i = 0; i < len; i++) {
            link_page = links.eq(i);
            console.log(href);
           // if (href.indexOf(link_page.attr('href').replace(/(?:_\d)?\..*/, '')) > 0) {    // 静态页面用
           //  if (href.indexOf(link_page.attr('href').replace(/(?:_\d)?\..*/, '')) > 0) {    // 程序用
           //      control(nav_on = link_curr = link_page = link_page[0], false);
           //      delete i;
           //      break;
           //  }
            if(link_page.hasClass("onss")){
                control(nav_on = link_curr = link_page = link_page[0], false);
                delete i;
                break;
            }
        }
        links_2.each(function (idx) {
            if (this === nav_on) return;
            this.setAttribute('idx', idx);
        });
        if (i === len) {
            if (href.indexOf('/user') >= 0) {
                control(nav_on = link_curr = link_page = links.eq(5)[0], false);
            } else {
                control(nav_on = link_curr = link_page = links.eq(0)[0], false);
            }
        }


        win.on('load', function () {
            // 鼠标指向, 链接高亮
            links_1.hover(function () { control(this, false) }, none);
            links_2.hover(function () { control(this, true) }, none);
            // 鼠标离开导航栏, 恢复当前页面高亮
            nav.hover(none, function () {
                timeout = setTimeout(function () {
                    control(link_page, true);
                }, 10);
            });
            subNav.hover(function () {
                clearTimeout(timeout);
            }, function () {
                control(link_page, true);
            });
        });

        function control(elem, flag, idx) {
            $(link_curr).removeClass("on");
            $(elem).addClass("on");
            link_curr = elem;
            prev_item.removeClass('on');
            if (flag) {
                idx = parseInt(elem.getAttribute('idx'));
                prev_item = subitem.eq(idx).addClass('on');
                // search_box.hide();
                // search_btn.className = "btn-search";
            }
        }
        function none() { }





    }());
   



});