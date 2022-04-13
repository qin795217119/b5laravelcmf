/* 2019-1-29

 * SuperSlide v3.0 alpha开发版
 * 轻松解决网站大部分特效展示问题
 * 详尽信息请看官网：http://www.SuperSlide2.com/
 *
 * Copyright 2011-2018, 大话主席 
 *
 * 请尊重原创，保留头部版权
 * 在保留版权的前提下可应用于个人或商业用途

 * v3.0：
    1、修复 mouseOverStop 和 autoPlay均为false下，点击切换按钮后会自动播放bug;
    2、interTime默认值改为4000;
    3、vis默认值改为"auto"
    4、scroll默认值改为"auto"
    5、增加参数 responsive -- 默认值ture，是否开启响应式功能
    6、增加参数 responsiveFun -- 响应式回调函数
    7、增加参数 responsiveFunTime -- 默认值100，单位毫秒，外框宽度改变（触发响应式）时回调函数执行间隔
    8、增加参数 autoHeight -- 默认值true，自动适配内容高度，常用于移动端，effect:"left或leftLoop",vis:1,scroll:1时有效
    9、增加参数 canTouch -- 默认值"auto"，移动端有效；是否带触摸拖拽效果；可选"auto"|true|false；auto情况下是除了fade、fold、slideDown不带触摸，其它都带
    10、重新设计"fold"的实现方式，不再需要计算宽高，现在可以自适应高度
    11、新增外置方法：
        play() -- 播放
        pause() -- 暂停
        prev() -- 上一页
        next() -- 下一页
        goTo(int) -- 跳到第int页
        refresh() -- 刷新效果
        reset() -- 重置效果
        getIndex() -- 获取当前页码
        getPages() -- 获取总页数
        clearStyle() -- 清除插件加入的style
        destroyInter() -- 销毁setInterval和setTimeout
        destroyEvents() -- 销毁事件绑定
        destroy() -- 销毁插件（clearStyle() + destroyInter() + destroyEvents()）

        使用方式：
        执行slide后会返回superslide对象集合；
        例如：
        var ss = $(".slider").slide({ .... });
        现在想设置第二个".slider"暂停，执行代码为： ss[1].pause();
    */

(function ($, win) {
    $.fn.slide = function (options) {
        $.fn.slide.defaults = {
            type: "slide",
            effect: "fade",
            autoPlay: false,
            delayTime: 500,
            interTime: 4000,
            triggerTime: 150,
            defaultIndex: 0,
            titCell: ".hd li",
            mainCell: ".bd",
            targetCell: null,
            trigger: "mouseover",
            scroll: "auto",
            vis: "auto",
            titOnClassName: "on",
            autoPage: false,
            prevCell: ".prev",
            nextCell: ".next",
            pageStateCell: ".pageState",
            opp: false,
            pnLoop: true,
            easing: "swing",
            startFun: null,
            endFun: null,
            switchLoad: null,

            playStateCell: ".playState",
            mouseOverStop: true,
            defaultPlay: true,
            returnDefault: false,

            responsive: true,
            responsiveFun: null,
            responsiveFunTime: 100,
            autoHeight: true,
            canTouch: "auto"
        };

        var ary = [];
        var createObj = function (opts, slider) {

            var _this = this;
            var effect = opts.effect;
            var prevBtn = $(opts.prevCell, slider);
            var nextBtn = $(opts.nextCell, slider);
            var pageState = $(opts.pageStateCell, slider);
            var playState = $(opts.playStateCell, slider);

            var navObj = $(opts.titCell, slider); //导航子元素结合
            var navObjSize = navObj.length;
            var conBox = $(opts.mainCell, slider); //内容元素父层对象
            var conBoxSize = conBox.children().length;
            var sLoad = opts.switchLoad;
            var tarObj = $(opts.targetCell, slider);

            /*字符串转换*/
            var index = parseInt(opts.defaultIndex);
            var delayTime = parseInt(opts.delayTime);
            var interTime = parseInt(opts.interTime);
            var triggerTime = parseInt(opts.triggerTime);

            var scroll = isNaN(opts.scroll) ? "auto" : parseInt(opts.scroll);
            var vis = isNaN(opts.vis) ? "auto" : parseInt(opts.vis);

            var autoPlay = (opts.autoPlay == "false" || opts.autoPlay == false) ? false : true;
            var opp = (opts.opp == "false" || opts.opp == false) ? false : true;
            var autoPage = (opts.autoPage == "false" || opts.autoPage == false) ? false : true;
            var pnLoop = (opts.pnLoop == "false" || opts.pnLoop == false) ? false : true;
            var mouseOverStop = (opts.mouseOverStop == "false" || opts.mouseOverStop == false) ? false : true;
            var defaultPlay = (opts.defaultPlay == "false" || opts.defaultPlay == false) ? false : true;
            var returnDefault = (opts.returnDefault == "false" || opts.returnDefault == false) ? false : true;
            var canTouch = opts.canTouch;

            //触摸相关
            var supportTouch = !!("ontouchstart" in window || window.navigator.msMaxTouchPoints);
            if( canTouch=="auto" ){
                if ( ("left leftLoop leftMarquee top topLoop topMarquee").indexOf(effect) != -1 ) {
                    canTouch=true;
                }else{
                    canTouch=false;
                }
            }else{
                canTouch = (opts.canTouch == "false" || opts.canTouch == false) ? false : true;
            }
            canTouch = (canTouch && supportTouch)?true:false;

            var touchStart = supportTouch ? 'touchstart' : 'touchstart';
            var touchMove = supportTouch ? 'touchmove' : 'touchmove';
            var touchEnd = supportTouch ? 'touchend' : 'touchend';
            // var touchStart = supportTouch ? 'touchstart' : 'mousedown';
            // var touchMove = supportTouch ? 'touchmove' : 'mousemove';
            // var touchEnd = supportTouch ? 'touchend' : 'mouseup';

            //内部使用变量
            var slideH = 0;
            var slideW = 0;
            var selfW = 0;
            var selfH = 0;
            var easing = opts.easing;
            var inter = null; //autoPlay-setInterval
            var titST = null; //titCell-setTimeout
            var rtnST = null; //返回默认-setTimeout
            var pnST = null; //前后按钮长安-setTimeout
            var resizeST = null; //win响应式-setTimeout
            var titOn = opts.titOnClassName;

            var onIndex = navObj.index(slider.find("." + titOn));
            var oldIndex = index = onIndex == -1 ? index : onIndex;
            var defaultIndex = index;
            var scrollNum = 0;

            var _ind = index;
            var cloneNum = 0;
            var _tar;
            var isMarq = effect == "leftMarquee" || effect == "topMarquee" ? true : false;
            var isLeftEffectForTouch = ("left leftLoop leftMarquee fade fold").indexOf(effect) == -1?false:true;
            var isTopEffectForTouch = ("top topLoop topMarquee fade fold").indexOf(effect) == -1?false:true;
            var isLeftEffect = ("left leftLoop leftMarquee").indexOf(effect) == -1?false:true;
            var isTopEffect = ("top topLoop topMarquee").indexOf(effect) == -1?false:true;
            var conBoxParWidth = conBox.parent().width();
            var conBoxParHeight = conBox.parent().height();

            var responsiveCallBack = function () {
                if ($.isFunction(opts.responsiveFun)) {
                    opts.responsiveFun(index, navObjSize, slider, $(opts.titCell, slider), conBox, tarObj, prevBtn, nextBtn)
                }
            };
            var startCallBack = function () {
                if ($.isFunction(opts.startFun)) {
                    opts.startFun(index, navObjSize, slider, $(opts.titCell, slider), conBox, tarObj, prevBtn, nextBtn)
                }
            };
            var endCallBack = function () {
                if ($.isFunction(opts.endFun)) {
                    opts.endFun(index, navObjSize, slider, $(opts.titCell, slider), conBox, tarObj, prevBtn, nextBtn)
                }
            };
            var resetOn = function () {
                navObj.removeClass(titOn);
                if (defaultPlay) {
                    navObj.eq(defaultIndex).addClass(titOn)
                }
            };

            //绑定titCell事件
            var titCellEvent = function (o) {
                if (opts.trigger == "mouseover") {
                    o.hover(function () {
                        var hoverInd = o.index(this);
                        titST = setTimeout(function () {
                            index = hoverInd;
                            doPlay();
                            resetInter();
                        }, opts.triggerTime);
                    }, function () { clearTimeout(titST) });
                } else {
                    o.click(function () {
                        index = o.index(this);
                        doPlay();
                        resetInter();
                    })
                }
            };

            //单独处理菜单效果
            if (opts.type == "menu") {
                if (defaultPlay) {
                    navObj.removeClass(titOn).eq(index).addClass(titOn);
                }
                navObj.hover(
                    function () {
                        _tar = $(this).find(opts.targetCell);
                        var hoverInd = navObj.index($(this));

                        titST = setTimeout(function () {
                            index = hoverInd;
                            navObj.removeClass(titOn).eq(index).addClass(titOn);
                            startCallBack();
                            switch (effect) {
                                case "fade":
                                    _tar.stop(true, true).animate({ opacity: "show" }, delayTime, easing, endCallBack);
                                    break;
                                case "slideDown":
                                    _tar.stop(true, true).animate({ height: "show" }, delayTime, easing, endCallBack);
                                    break;
                            }
                        }, opts.triggerTime);

                    }, function () {
                        clearTimeout(titST);
                        switch (effect) {
                            case "fade":
                                _tar.animate({ opacity: "hide" }, delayTime, easing);
                                break;
                            case "slideDown":
                                _tar.animate({ height: "hide" }, delayTime, easing);
                                break;
                        }
                    }
                );

                if (returnDefault) {
                    slider.hover(function () { clearTimeout(rtnST); }, function () { rtnST = setTimeout(resetOn, delayTime); });
                }

                return;
            }

            //切换加载
            var doSwitchLoad = function (objs) {

                var changeImg = function (t) {
                    for (var i = t; i < (vis + t); i++) {
                        objs.eq(i).find("img[" + sLoad + "]").each(function () {
                            var _t = $(this);
                            _t.attr("src", _t.attr(sLoad));
                            if (conBox.find(".clone")[0]) { //如果存在.clone
                                var chir = conBox.children();
                                for (var j = 0; j < chir.length; j++) {
                                    chir.eq(j).find("img[" + sLoad + "]").each(function () {
                                        if ($(this).attr(sLoad) == _t.attr("src")) {
                                            $(this).attr("src", $(this).attr(sLoad));
                                        }
                                    });
                                }
                            }
                        });
                    }
                };
                switch (effect) {
                    case "fade":
                    case "fold":
                    case "top":
                    case "left":
                    case "slideDown":
                        changeImg(index * scroll);
                        break;
                    case "leftLoop":
                    case "topLoop":
                        changeImg(cloneNum + scrollNum(_ind));
                        break;
                    case "leftMarquee":
                    case "topMarquee":
                        var curS = effect == "leftMarquee" ? conBox.css("left").replace("px", "") : conBox.css("top").replace("px", "");
                        var slideT = effect == "leftMarquee" ? slideW : slideH;
                        var mNum = cloneNum;
                        if (curS % slideT != 0) {
                            var curP = Math.abs(curS / slideT ^ 0);
                            if (index == 1) {
                                mNum = cloneNum + curP
                            } else {
                                mNum = cloneNum + curP - 1
                            }
                        }
                        changeImg(mNum);
                        break;
                }
            }; //doSwitchLoad end

            //初始化
            var setInit = function () {
                var tempIndex = index;
                if (true) {}
                selfW = 0;
                selfH = 0;
                conBox.children().each(function () { //取最大值
                    if ($(this).width() > selfW) {
                        selfW = $(this).width();
                        slideW = $(this).outerWidth(true);
                    }
                    if ($(this).height() > selfH) {
                        selfH = $(this).height();
                        slideH = $(this).outerHeight(true);
                    }
                });

                if (opts.vis == "auto") {
                    if(isTopEffect){
                        vis = parseInt(conBoxParHeight / slideH);
                    }else{
                        vis = parseInt(conBoxParWidth / slideW);
                    }
                    
                    vis = vis==0?1:vis;
                }
                if (opts.scroll == "auto") {
                    scroll = vis
                }
                cloneNum = conBoxSize >= vis ? (conBoxSize % scroll != 0 ? conBoxSize % scroll : scroll) : 0;

                //处理分页
                if (navObjSize == 0) {
                    navObjSize = conBoxSize;
                }
                //只有左右按钮
                if (isMarq) {
                    navObjSize = 2;
                    tempIndex = 0;
                }
                if (autoPage) {
                    if (conBoxSize >= vis) {
                        if (effect == "leftLoop" || effect == "topLoop") {
                            navObjSize = conBoxSize % scroll != 0 ? (conBoxSize / scroll ^ 0) + 1 : conBoxSize / scroll;
                        }
                        //else if (isMarq){ navObjSize=2 }
                        else {
                            var tempS = conBoxSize - vis;
                            navObjSize = 1 + parseInt(tempS % scroll != 0 ? (tempS / scroll + 1) : (tempS / scroll));
                            if (navObjSize <= 0) {
                                navObjSize = 1;
                            }
                        }
                    } else {
                        navObjSize = 1
                    }

                    $(opts.titCell, slider).empty();

                    var str = "";

                    if (opts.autoPage == true || opts.autoPage == "true") {
                        for (var i = 0; i < navObjSize; i++) {
                            str += "<li>" + (i + 1) + "</li>"
                        }
                    } else {
                        for (var i = 0; i < navObjSize; i++) {
                            str += opts.autoPage.replace("$", (i + 1))
                        }
                    }
                    $(opts.titCell, slider).html(str);

                    navObj = $(opts.titCell, slider).children(); //重置导航子元素对象
                    navObj.eq(index).addClass(titOn);

                    titCellEvent(navObj);

                }

                if (conBoxSize >= vis) { //当内容个数少于可视个数，不执行效果。

                    //console.log(vis+"|"+cloneNum);

                    var cloneEle = function () {
                        var _chr = conBox.children();
                        for (var i = 0; i < vis; i++) {
                            _chr.eq(i).clone().addClass("clone").appendTo(conBox);
                        }
                        for (var i = 0; i < cloneNum; i++) {
                            _chr.eq(conBoxSize - i - 1).clone().addClass("clone").prependTo(conBox);
                        }
                    };
                    switch (effect) {
                        case "fold":
                            conBox.css({ "overflow": "hidden" }).children().css({ "width": "100%", "float": "left", "marginRight": "-100%", "display": "none" });
                            break;

                        case "top":
                            conBox.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; height:' + vis * slideH + 'px"></div>').css({ "top": -(tempIndex * scroll) * slideH, "position": "relative", "padding": "0", "margin": "0" }).children().css({ "height": selfH });
                            break;
                        case "left":
                            var visScope = isNaN(opts.vis) ? opts.vis : vis * slideW + 'px';
                            conBox.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; width:' + visScope + '"></div>');
                            conBox.css({ "width": conBoxSize * slideW, "left": -(tempIndex * scroll) * slideW, "position": "relative", "overflow": "hidden", "padding": "0", "margin": "0" }).children().css({ "float": "left", "width": selfW });

                            break;
                        case "leftLoop":
                        case "leftMarquee":
                            cloneEle();
                            var visScope = isNaN(opts.vis) ? "100%" : vis * slideW + 'px';
                            conBox.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; width:' + visScope + '"></div>');
                            conBox.css({ "width": (conBoxSize + vis + 1 + cloneNum) * slideW, "position": "relative", "overflow": "hidden", "padding": "0", "margin": "0", "left": -(cloneNum + tempIndex * scroll) * slideW }).children().css({ "float": "left", "width": selfW });

                            break;
                        case "topLoop":
                        case "topMarquee":
                            cloneEle();
                            conBox.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; height:' + vis * slideH + 'px"></div>').css({ "height": (conBoxSize + vis + cloneNum) * slideH, "position": "relative", "padding": "0", "margin": "0", "top": -(cloneNum + tempIndex * scroll) * slideH }).children().css({ "height": selfH });
                            break;
                    }

                }

                //针对leftLoop、topLoop的滚动个数
                scrollNum = function (ind) {
                    var _tempCs = ind * scroll;
                    if (ind == navObjSize) {
                        _tempCs = conBoxSize;
                    } else if (ind == -1 && conBoxSize % scroll != 0) {
                        _tempCs = -conBoxSize % scroll;
                    }
                    return _tempCs;
                };

                //pageState.html( "<span>"+(index+1)+"</span>/"+navObjSize);

            }; //setInit End
            setInit();
            responsiveCallBack();

            //效果函数
            var doPlay = function (_setInit) {
                // 当前页状态不触发效果
                if (defaultPlay && oldIndex == index && !_setInit && !isMarq) {
                    return;
                }

                //处理页码
                if (isMarq) {
                    if (index >= 1) {
                        index = 1;
                    } else if (index <= 0) {
                        index = 0;
                    }
                } else {
                    _ind = index;
                    if (index >= navObjSize) {
                        index = 0;
                    } else if (index < 0) {
                        index = navObjSize - 1;
                    }
                }

                //处理切换加载
                if (sLoad != null) {
                    doSwitchLoad(conBox.children())
                }

                startCallBack();

                //处理targetCell
                if (tarObj[0]) {
                    _tar = tarObj.eq(index);
                    if (sLoad != null) {
                        doSwitchLoad(tarObj)
                    }
                    if (effect == "slideDown") {
                        tarObj.not(_tar).stop(true, true).slideUp(delayTime);
                        _tar.slideDown(delayTime, easing, function () {
                            if (!conBox[0]) {
                                endCallBack()
                            }
                        });
                    } else {
                        tarObj.not(_tar).stop(true, true).hide();
                        _tar.animate({ opacity: "show" }, delayTime, function () {
                            if (!conBox[0]) {
                                endCallBack()
                            }
                        });
                    }
                }

                if (conBoxSize >= vis) { //当内容个数少于可视个数，不执行效果。
                    switch (effect) {
                        case "fade":
                            conBox.children().stop(true, true).eq(index).animate({ opacity: "show" }, delayTime, easing, function () { endCallBack() }).siblings().hide();
                            break;
                        case "fold":
                            conBox.children().stop(true, true).eq(index).animate({ opacity: "show" }, delayTime, easing, function () { endCallBack() }).siblings().animate({ opacity: "hide" }, delayTime, easing);
                            break;
                        case "top":
                            conBox.stop(true, false).animate({ "top": -index * scroll * slideH }, delayTime, easing, function () { endCallBack() });
                            break;
                        case "left":
                            conBox.stop(true, false).animate({ "left": -index * scroll * slideW }, delayTime, easing, function () { endCallBack() });
                            break;
                        case "leftLoop":
                            var __ind = _ind;
                            conBox.stop(true, true).animate({ "left": -(scrollNum(_ind) + cloneNum) * slideW }, delayTime, easing, function () {
                                if (__ind <= -1) {
                                    conBox.css("left", -(cloneNum + (navObjSize - 1) * scroll) * slideW);
                                } else if (__ind >= navObjSize) {
                                    conBox.css("left", -cloneNum * slideW);
                                }
                                endCallBack();
                            });
                            break; //leftLoop end

                        case "topLoop":
                            var __ind = _ind;
                            conBox.stop(true, true).animate({ "top": -(scrollNum(_ind) + cloneNum) * slideH }, delayTime, easing, function () {
                                if (__ind <= -1) {
                                    conBox.css("top", -(cloneNum + (navObjSize - 1) * scroll) * slideH);
                                } else if (__ind >= navObjSize) {
                                    conBox.css("top", -cloneNum * slideH);
                                }
                                endCallBack();
                            });
                            break; //topLoop end

                        case "leftMarquee":
                            var tempLeft = conBox.css("left").replace("px", "");
                            if (index == 0) {
                                conBox.animate({ "left": ++tempLeft }, 0, function () {
                                    if (conBox.css("left").replace("px", "") >= 0) {
                                        conBox.css("left", -conBoxSize * slideW)
                                    }
                                });
                            } else {
                                conBox.animate({ "left": --tempLeft }, 0, function () {
                                    if (conBox.css("left").replace("px", "") <= -(conBoxSize + cloneNum) * slideW) {
                                        conBox.css("left", -cloneNum * slideW)
                                    }
                                });
                            }
                            break; // leftMarquee end

                        case "topMarquee":
                            var tempTop = conBox.css("top").replace("px", "");
                            if (index == 0) {
                                conBox.animate({ "top": ++tempTop }, 0, function () {
                                    if (conBox.css("top").replace("px", "") >= 0) {
                                        conBox.css("top", -conBoxSize * slideH)
                                    }
                                });
                            } else {
                                conBox.animate({ "top": --tempTop }, 0, function () {
                                    if (conBox.css("top").replace("px", "") <= -(conBoxSize + cloneNum) * slideH) {
                                        conBox.css("top", -cloneNum * slideH)
                                    }
                                });
                            }
                            break; // topMarquee end

                    } //switch end
                }

                navObj.removeClass(titOn).eq(index).addClass(titOn);

                oldIndex = index;
                if (!pnLoop) { //pnLoop控制前后按钮是否继续循环
                    nextBtn.removeClass("nextStop");
                    prevBtn.removeClass("prevStop");
                    if (index == 0) {
                        prevBtn.addClass("prevStop");
                    }
                    if (index == navObjSize - 1) {
                        nextBtn.addClass("nextStop");
                    }
                }

                pageState.html("<span>" + (index + 1) + "</span>/" + navObjSize);

                // 自动适配高度
                if (opts.autoHeight && (effect == "left" || effect == "leftLoop") && vis == 1 && scroll == 1) {
                    var curItem = conBox.children().not(conBox.find(".clone")).eq(index);
                    var pic = curItem.find("img");
                    var picCount = pic.length;

                    if (picCount <= 0) {
                        conBox.height(curItem.outerHeight());
                        return;
                    }
                    pic.each(function () { //存在图片时监测图片高度
                        var img = $(this);
                        var imgInt = setInterval(function () {
                            if (img.height() > 0) {
                                clearInterval(imgInt);
                                picCount--;
                                if (picCount <= 0) {
                                    conBox.height(curItem.outerHeight());
                                }
                            }
                        }, 50);
                    });
                }

            }; // doPlay end

            //初始化执行
            if (defaultPlay) {
                doPlay(true);
            }

            //返回默认状态
            if (returnDefault) {
                slider.hover(function () { clearTimeout(rtnST) }, function () {
                    rtnST = setTimeout(function () {
                        index = defaultIndex;
                        if (defaultPlay) {
                            doPlay();
                        } else {
                            if (effect == "slideDown") {
                                _tar.slideUp(delayTime, resetOn);
                            } else {
                                _tar.animate({ opacity: "hide" }, delayTime, resetOn);
                            }
                        }
                        oldIndex = index;
                    }, 300);
                });
            }

            ///自动播放函数
            var setInter = function (time) {
                inter = setInterval(function () {
                opp ? index-- : index++;
                doPlay();
                }, !!time ? time : interTime);
            };
            var setMarInter = function (time) { inter = setInterval(doPlay, !!time ? time : interTime); };
            // 处理mouseOverStop
            var resetInter = function () {
                if (!mouseOverStop && autoPlay && !playState.hasClass("pauseState")) {
                    clearInterval(inter);
                    setInter();
                }
            }; /* 修复 mouseOverStop 和 autoPlay均为false下，点击切换按钮后会自动播放bug */
            // 前后按钮函数
            var nextFun = function () {
                if (pnLoop || index != navObjSize - 1) {
                    index++;
                    doPlay();
                    if (!isMarq) {
                        resetInter();
                    }
                }
            };
            var prevFun = function () {
                if (pnLoop || index != 0) {
                    index--;
                    doPlay();
                    if (!isMarq) {
                        resetInter();
                    }
                }
            };
            //处理playState
            var playStateFun = function () {
                autoPlay=true;
                clearInterval(inter);
                playState.removeClass("pauseState");
                isMarq ? setMarInter() : setInter();
            };
            var pauseStateFun = function () {
                autoPlay=false;
                clearInterval(inter);
                playState.addClass("pauseState");
            };

            //初始化自动播放
            var setAutoPlay = function(){
                if (autoPlay) {
                    if (isMarq) {
                        opp ? index-- : index++;
                        setMarInter();
                        if (mouseOverStop) {
                            conBox.hover(pauseStateFun, playStateFun);
                        }
                    } else {
                        setInter();
                        if (mouseOverStop) {
                            slider.hover(pauseStateFun, playStateFun);
                        }
                    }
                } else {
                    if (isMarq) {
                        opp ? index-- : index++;
                    }
                    playState.addClass("pauseState");
                }
            }
            setAutoPlay();

            //绑定事件
            var setTrigger = function () {
                playState.click(function () { playState.hasClass("pauseState") ? playStateFun() : pauseStateFun() });

                titCellEvent(navObj);
                //前后按钮事件
                if (isMarq) {
                    nextBtn.mousedown(nextFun);
                    prevBtn.mousedown(prevFun);
                    //前后按钮长按10倍加速
                    if (pnLoop) {
                       
                        var marDown = function () {
                            pnST = setTimeout(function () {
                                clearInterval(inter);
                                setMarInter(interTime / 10 ^ 0)
                            }, 150)
                        };
                        var marUp = function () {
                            clearTimeout(pnST);
                            clearInterval(inter);
                            setMarInter()
                        };
                        nextBtn.mousedown(marDown);
                        nextBtn.mouseup(marUp);
                        prevBtn.mousedown(marDown);
                        prevBtn.mouseup(marUp);
                    }
                    //前后按钮mouseover事件
                    if (opts.trigger == "mouseover") {
                        nextBtn.hover(nextFun, function () {});
                        prevBtn.hover(prevFun, function () {});
                    }
                } else {
                    nextBtn.click(nextFun);
                    prevBtn.click(prevFun);
                }

                //触摸事件
                if( canTouch ){
                    conBox.on(touchStart, function (e) {

                        conBox.stop(1, 1);
                        clearInterval(inter);
                        conBox.find("a").click(function (e) { e.preventDefault() });

                        e = supportTouch ? e.originalEvent.targetTouches[0] : (e || window.event);

                        var distX,
                            distY,
                            oX,
                            oY,
                            oL,
                            oT;
                        var _this = $(this);
                        oL = this.offsetLeft;
                        oT = this.offsetTop;
                        oX = e.pageX;
                        oY = e.pageY;
                        var scrollY = false;

                        $(this).on(touchMove, function (ev) {

                            e = supportTouch ? ev.originalEvent.targetTouches[0] : (ev || window.event);
                            distX = e.pageX - oX;
                            distY = e.pageY - oY;

                            scrollY = Math.abs(distX) < Math.abs(distY)?true:false;

                            if (!scrollY && isLeftEffectForTouch ) {
                                ev.preventDefault();
                                if (effect == "left" && ((index == 0 && distX > 0) || (index >= navObjSize - 1 && distX < 0))) {
                                    distX = distX * 0.4
                                }
                                if(effect != "fade" && effect != "fold"){
                                    _this.css({ "left": oL + distX + "px" });
                                }
                            }else if( scrollY && isTopEffectForTouch ){

                                ev.preventDefault();
                                if (effect == "top" && ((index == 0 && distY > 0) || (index >= navObjSize - 1 && distY < 0))) {
                                    distY = distY * 0.4
                                }
                                if(effect != "fade" && effect != "fold"){
                                    _this.css({ "top": oT + distY + "px" });
                                }
                            }

                        });

                        $(this).on(touchEnd, function (e) {

                            if (!distX) {
                                conBox.find("a").off("click")
                            }else if (!scrollY && isLeftEffectForTouch ) {
                                if (Math.abs(distX) > slideW / 10) {
                                    distX > 0 ? index-- : index++;
                                    if (effect == "left") {
                                        index = index < 0 ? 0 : index;
                                        index = index >= navObjSize ? navObjSize - 1 : index;
                                    }
                                }
                                doPlay(true);
                            }else if( scrollY && isTopEffectForTouch ){
                                if (Math.abs(distY) > slideH / 10) {
                                    distY > 0 ? index-- : index++;
                                    if (effect == "top") {
                                        index = index < 0 ? 0 : index;
                                        index = index >= navObjSize ? navObjSize - 1 : index;
                                    }
                                }
                                doPlay(true);
                            }

                            clearInterval(inter);
                            playState.removeClass("pauseState");
                            if(autoPlay){ isMarq ? setMarInter() : setInter(); }

                            conBox.off(touchMove);
                            conBox.off(touchEnd);

                        });

                    });
                }

            };
            setTrigger();

            // 为检测设备尺寸变化，清除一些附加样色和元素
            var clear = function () {
                conBox.stop(true, true);
                if (conBox.parent().hasClass("tempWrap")) {
                    conBox.unwrap("tempWrap")
                };
                conBox.find(".clone").remove();
                if(isLeftEffect){
                    conBox.children().css({ "width": "", "float": "" });
                    conBox.css({ "width": "", "left": 0 });
                }else if(isTopEffect){
                    conBox.children().css({ "height": "" });
                    conBox.css({ "height": "", "top": 0 });
                }
            };

            //检测设备尺寸变化
            var setResponsive = function(){
                if (opts.responsive) {
                    var _vis;
                    var _conBoxParWidth;
                    var _conBoxParHeight;
                    var orientationChange = function () {
                        responsiveCallBack();
                        _conBoxParWidth = conBox.parent().width();
                        _conBoxParHeight = conBox.parent().height();

                        if ( isLeftEffect && _conBoxParWidth != conBoxParWidth) { //外层宽度有变化才执行
                            conBoxParWidth = _conBoxParWidth;

                            //处理sLoad
                            /*
                            _vis = parseInt( conBox.parent().width() / slideW );
                            vis = _vis;
                            if( opts.scroll=="auto" ){ scroll = vis }*/

                            clear();
                            setInit();
                            doPlay(true);
                        }
                        else if ( isTopEffect && _conBoxParHeight != conBoxParHeight) { //外层高度有变化才执行
                            conBoxParHeight = _conBoxParHeight;
                            clear();
                            setInit();
                            doPlay(true);
                        }
                    };
                    $(win).resize(function () {
                        if (resizeST) {
                            clearTimeout(resizeST);
                        }
                        resizeST = setTimeout(orientationChange, opts.responsiveFunTime);
                    });
                }
            }
            setResponsive();

            /*-- 外置API --*/
            //清除所有附加元素和样色
            this.clearStyle = function () {
                if (conBox.parent().hasClass("tempWrap")) {
                    conBox.unwrap("tempWrap")
                };
                conBox.find(".clone").remove();
                conBox.children().removeAttr("style");
                conBox.removeAttr("style");
            };

            //销毁setInterval和setTimeout
            this.destroyInter = function () {
                clearInterval(inter);
                clearTimeout(rtnST);
                clearTimeout(titST);
                clearTimeout(pnST);
                //clearTimeout(resizeST);
            };

            //销毁事件绑定
            this.destroyEvents = function () {
                nextBtn.off();
                prevBtn.off();
                conBox.off();
                slider.off();
                navObj.off();
                //$(win).off();
            };

            //销毁插件
            this.destroy = function () {
                this.destroyEvents();
                this.destroyInter();
                this.clearStyle();
            };

            //刷新
            this.refresh = function () {
                this.destroy();
                setInit();
                setTrigger();
                doPlay(true);
                setAutoPlay();
            };

            //重置（待完善）
            this.reset = function () {
                index = parseInt(opts.defaultIndex);
                scroll = isNaN(opts.scroll) ? "auto" : parseInt(opts.scroll);
                vis = isNaN(opts.vis) ? "auto" : parseInt(opts.vis);
                autoPlay = (opts.autoPlay == "false" || opts.autoPlay == false) ? false : true;
                navObjSize = navObj.length;
                conBoxSize = conBox.children().length;
                this.refresh();
            };

            //获取当前索引/页码
            this.getIndex = function () { return index };
            //获取总页数
            this.getPages = function(){ return navObjSize };

            //暂停
            this.pause = function () { pauseStateFun() };
            this.play = function () { playStateFun() };
            this.prev = function () { prevFun() };
            this.next = function () { nextFun() };
            this.goTo = function (i) {
                resetInter();
                if (pnLoop || i != navObjSize ) {
                    index = i;
                    doPlay();
                }
            };
        }; //createObj End

        this.each(function () {
            var o = new createObj($.extend({}, $.fn.slide.defaults, options), $(this));
            ary.push(o);
        }); //each End

        return ary;

    }; //slide End

})(jQuery, window);

jQuery.easing['jswing'] = jQuery.easing['swing'];
jQuery.extend(jQuery.easing,
{
    def: 'easeOutQuad',
    swing: function (x, t, b, c, d) { return jQuery.easing[jQuery.easing.def](x, t, b, c, d); },
    easeInQuad: function (x, t, b, c, d) { return c * (t /= d) * t + b; },
    easeOutQuad: function (x, t, b, c, d) { return -c * (t /= d) * (t - 2) + b },
    easeInOutQuad: function (x, t, b, c, d) {
        if ((t /= d / 2) < 1) {
            return c / 2 * t * t + b;
        }
        return -c / 2 * ((--t) * (t - 2) - 1) + b
    },
    easeInCubic: function (x, t, b, c, d) { return c * (t /= d) * t * t + b },
    easeOutCubic: function (x, t, b, c, d) { return c * ((t = t / d - 1) * t * t + 1) + b },
    easeInOutCubic: function (x, t, b, c, d) {
        if ((t /= d / 2) < 1) {
            return c / 2 * t * t * t + b;
        }
        return c / 2 * ((t -= 2) * t * t + 2) + b
    },
    easeInQuart: function (x, t, b, c, d) { return c * (t /= d) * t * t * t + b },
    easeOutQuart: function (x, t, b, c, d) { return -c * ((t = t / d - 1) * t * t * t - 1) + b },
    easeInOutQuart: function (x, t, b, c, d) {
        if ((t /= d / 2) < 1) {
            return c / 2 * t * t * t * t + b;
        }
        return -c / 2 * ((t -= 2) * t * t * t - 2) + b
    },
    easeInQuint: function (x, t, b, c, d) { return c * (t /= d) * t * t * t * t + b },
    easeOutQuint: function (x, t, b, c, d) { return c * ((t = t / d - 1) * t * t * t * t + 1) + b },
    easeInOutQuint: function (x, t, b, c, d) {
        if ((t /= d / 2) < 1) {
            return c / 2 * t * t * t * t * t + b;
        }
        return c / 2 * ((t -= 2) * t * t * t * t + 2) + b
    },
    easeInSine: function (x, t, b, c, d) { return -c * Math.cos(t / d * (Math.PI / 2)) + c + b },
    easeOutSine: function (x, t, b, c, d) { return c * Math.sin(t / d * (Math.PI / 2)) + b },
    easeInOutSine: function (x, t, b, c, d) { return -c / 2 * (Math.cos(Math.PI * t / d) - 1) + b },
    easeInExpo: function (x, t, b, c, d) { return (t == 0) ? b : c * Math.pow(2, 10 * (t / d - 1)) + b },
    easeOutExpo: function (x, t, b, c, d) { return (t == d) ? b + c : c * (-Math.pow(2, -10 * t / d) + 1) + b },
    easeInOutExpo: function (x, t, b, c, d) {
        if (t == 0) {
            return b;
        }
        if (t == d) {
            return b + c;
        }
        if ((t /= d / 2) < 1) {
            return c / 2 * Math.pow(2, 10 * (t - 1)) + b;
        }
        return c / 2 * (-Math.pow(2, -10 * --t) + 2) + b
    },
    easeInCirc: function (x, t, b, c, d) { return -c * (Math.sqrt(1 - (t /= d) * t) - 1) + b },
    easeOutCirc: function (x, t, b, c, d) { return c * Math.sqrt(1 - (t = t / d - 1) * t) + b },
    easeInOutCirc: function (x, t, b, c, d) {
        if ((t /= d / 2) < 1) {
            return -c / 2 * (Math.sqrt(1 - t * t) - 1) + b;
        }
        return c / 2 * (Math.sqrt(1 - (t -= 2) * t) + 1) + b
    },
    easeInElastic: function (x, t, b, c, d) {
        var s = 1.70158;
        var p = 0;
        var a = c;
        if (t == 0) {
            return b;
        }
        if ((t /= d) == 1) {
            return b + c;
        }
        if (!p) {
            p = d * .3;
        }
        if (a < Math.abs(c)) {
            a = c;
            var s = p / 4;
        } else {
            var s = p / (2 * Math.PI) * Math.asin(c / a);
        }
        return -(a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p)) + b
    },
    easeOutElastic: function (x, t, b, c, d) {
        var s = 1.70158;
        var p = 0;
        var a = c;
        if (t == 0) {
            return b;
        }
        if ((t /= d) == 1) {
            return b + c;
        }
        if (!p) {
            p = d * .3;
        }
        if (a < Math.abs(c)) {
            a = c;
            var s = p / 4;
        } else {
            var s = p / (2 * Math.PI) * Math.asin(c / a);
        }
        return a * Math.pow(2, -10 * t) * Math.sin((t * d - s) * (2 * Math.PI) / p) + c + b
    },
    easeInOutElastic: function (x, t, b, c, d) {
        var s = 1.70158;
        var p = 0;
        var a = c;
        if (t == 0) {
            return b;
        }
        if ((t /= d / 2) == 2) {
            return b + c;
        }
        if (!p) {
            p = d * (.3 * 1.5);
        }
        if (a < Math.abs(c)) {
            a = c;
            var s = p / 4;
        } else {
            var s = p / (2 * Math.PI) * Math.asin(c / a);
        }
        if (t < 1) {
            return -.5 * (a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p)) + b;
        }
        return a * Math.pow(2, -10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p) * .5 + c + b
    },
    easeInBack: function (x, t, b, c, d, s) {
        if (s == undefined) {
            s = 1.70158;
        }
        return c * (t /= d) * t * ((s + 1) * t - s) + b
    },
    easeOutBack: function (x, t, b, c, d, s) {
        if (s == undefined) {
            s = 1.70158;
        }
        return c * ((t = t / d - 1) * t * ((s + 1) * t + s) + 1) + b
    },
    easeInOutBack: function (x, t, b, c, d, s) {
        if (s == undefined) {
            s = 1.70158;
        }
        if ((t /= d / 2) < 1) {
            return c / 2 * (t * t * (((s *= (1.525)) + 1) * t - s)) + b;
        }
        return c / 2 * ((t -= 2) * t * (((s *= (1.525)) + 1) * t + s) + 2) + b
    },
    easeInBounce: function (x, t, b, c, d) { return c - jQuery.easing.easeOutBounce(x, d - t, 0, c, d) + b },
    easeOutBounce: function (x, t, b, c, d) {
        if ((t /= d) < (1 / 2.75)) {
            return c * (7.5625 * t * t) + b;
        } else if (t < (2 / 2.75)) {
            return c * (7.5625 * (t -= (1.5 / 2.75)) * t + .75) + b;
        } else if (t < (2.5 / 2.75)) {
            return c * (7.5625 * (t -= (2.25 / 2.75)) * t + .9375) + b;
        } else {
            return c * (7.5625 * (t -= (2.625 / 2.75)) * t + .984375) + b;
        }
    },
    easeInOutBounce: function (x, t, b, c, d) {
        if (t < d / 2) {
            return jQuery.easing.easeInBounce(x, t * 2, 0, c, d) * .5 + b;
        }
        return jQuery.easing.easeOutBounce(x, t * 2 - d, 0, c, d) * .5 + c * .5 + b;
    }
});