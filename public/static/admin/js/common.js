/**
 * 通用方法封装处理
 */

$(function() {
    $(document).on("click","*[b5-event]",function () {
        b5event($(this));
    });
    //表单自动提交
    $(".b5submit_btn").click(function () {
        var target=$(this).attr("data-target");
        var url=$(this).attr("data-url");
        var title=$(this).attr("data-title");
        if($.common.isEmpty(target)){
            $.modal.msgError('未配置表单target');
            return false;
        }
        if($.common.isEmpty(url)){
            url=window.location.href;
        }
        if($.common.isFunction('b5submit_btn_before')){
            var before=b5submit_btn_before();
            if(!before){
                return false;
            }
        }

        var data=$("#"+target).serialize();
        if(title){
            $.modal.confirm(title,function () {
                $.operate.saveModal(url,data)
            });
        }else{
            $.operate.saveModal(url,data)
        }
    });
    $(".b5ajaxget").click(function () {
        var title=$(this).attr("data-title");
        var data={};
        var url=$(this).attr("data-url");
        if(title){
            $.modal.confirm(title,function () {
                $.operate.saveModal(url,data)
            });
        }else{
            $.operate.saveModal(url,data)
        }
    });
    // 回到顶部绑定
    if ($.fn.toTop !== undefined) {
        $('#scroll-up').toTop();
    }

    // select2复选框事件绑定
    if ($.fn.select2 !== undefined) {
        $.fn.select2.defaults.set( "theme", "bootstrap" );
        $("select.select2").each(function () {
            var option = select2Option($(this));
            $(this).select2(option).on("change", function () {
                if($.common.isFunction('select2change')){
                    select2change($(this));
                }
            })
        })
    }

    // iCheck单选框及复选框事件绑定
    if ($.fn.iCheck !== undefined) {
        $(".check-box:not(.noicheck),.radio-box:not(.noicheck)").each(function() {
            $(this).iCheck({
                checkboxClass: 'icheckbox-blue',
                radioClass: 'iradio-blue',
            })
        })
    }

    //富文本
    if ($(".summernote").length > 0) {
        $(".summernote").each(function () {
            var thisObj=$(this);
            //
            var summernote_title=thisObj.data('place');
            if($.common.isEmpty(summernote_title)) summernote_title='';
            var summernote_height=thisObj.data('height');
            if($.common.isEmpty(summernote_height)) summernote_height=192;
            thisObj.summernote({
                placeholder: summernote_title,
                height: summernote_height,
                lang: 'zh-CN',
                followingToolbar: false,
                callbacks: {
                    onImageUpload: function (files) {
                        for (var i=0;i<files.length;i++){
                            sendFile(files[i],{cat:'editor'},function (data) {
                                thisObj.summernote('editor.insertImage', data.url, data.originName);
                            });
                        }
                    }
                }
            });
            if(thisObj.parent().find(".summernote_content").length>0){
                thisObj.summernote('code', thisObj.parent().find(".summernote_content").eq(0).val());
            }
        })
    }

    // 气泡弹出框特效
    $(document).on("click", '.table [data-toggle="popover"]', function() {
        $(this).popover("toggle")
    });
    // 取消回车自动提交表单
    $(document).on("keypress", ":input:not(textarea):not([type=submit])", function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });

    // laydate 时间控件绑定
    if ($(".select-time").length > 0) {
       layui.use('laydate', function() {
            var laydate = layui.laydate;
            var startDate = laydate.render({
                elem: '#startTime',
                max: $('#endTime').val(),
                trigger: 'click',
                done: function(value, date) {
                    // 结束时间大于开始时间
                    if (value !== '') {
                        endDate.config.min.year = date.year;
                        endDate.config.min.month = date.month - 1;
                        endDate.config.min.date = date.date;
                    } else {
                        endDate.config.min.year = '';
                        endDate.config.min.month = '';
                        endDate.config.min.date = '';
                    }
                }
            });
            var endDate = laydate.render({
                elem: '#endTime',
                min: $('#startTime').val(),
                trigger: 'click',
                done: function(value, date) {
                    // 开始时间小于结束时间
                    if (value !== '') {
                        startDate.config.max.year = date.year;
                        startDate.config.max.month = date.month - 1;
                        startDate.config.max.date = date.date;
                    } else {
                        startDate.config.max.year = '2099';
                        startDate.config.max.month = '12';
                        startDate.config.max.date = '31';
                    }
                }
            });
        });
    }

    // laydate time-input 时间控件绑定
    if ($(".time-input").length > 0) {
        layui.use('laydate', function () {
            var com = layui.laydate;
            $(".time-input").each(function (index, item) {
                var time = $(item);
                // 控制控件外观
                var type = time.attr("data-type") || 'date';
                // 控制回显格式
                var format = time.attr("data-format") || 'yyyy-MM-dd';
                // 控制日期控件按钮
                var buttons = time.attr("data-btn") || 'clear|now|confirm', newBtnArr = [];
                // 日期控件选择完成后回调处理
                var callback = time.attr("data-callback") || {};
                if (buttons) {
                    if (buttons.indexOf("|") > 0) {
                        var btnArr = buttons.split("|"), btnLen = btnArr.length;
                        for (var j = 0; j < btnLen; j++) {
                            if ("clear" === btnArr[j] || "now" === btnArr[j] || "confirm" === btnArr[j]) {
                                newBtnArr.push(btnArr[j]);
                            }
                        }
                    } else {
                        if ("clear" === buttons || "now" === buttons || "confirm" === buttons) {
                            newBtnArr.push(buttons);
                        }
                    }
                } else {
                    newBtnArr = ['clear', 'now', 'confirm'];
                }
                com.render({
                    elem: item,
                    trigger: 'click',
                    type: type,
                    format: format,
                    btns: newBtnArr,
                    done: function (value, data) {
                        if (typeof window[callback] != 'undefined'
                            && window[callback] instanceof Function) {
                            window[callback](value, data);
                        }
                    }
                });
            });
        });
    }

    // tree 关键字搜索绑定
    if ($("#keyword").length > 0) {
        $("#keyword").bind("focus", function focusKey(e) {
            if ($("#keyword").hasClass("empty")) {
                $("#keyword").removeClass("empty");
            }
        }).bind("blur", function blurKey(e) {
            if ($("#keyword").val() === "") {
                $("#keyword").addClass("empty");
            }
            $.tree.searchNode(e);
        }).bind("input propertychange", $.tree.searchNode);
    }

    // tree表格树 展开/折叠
    var expandFlag;
    $("#expendinfobtn").click(function() {
        var dataExpand = $.common.isEmpty(table.options.expandAll) ? true : table.options.expandAll;
        expandFlag = $.common.isEmpty(expandFlag) ? dataExpand : expandFlag;
        if (!expandFlag) {
            $.bttTable.bootstrapTreeTable('expandAll');
        } else {
            $.bttTable.bootstrapTreeTable('collapseAll');
        }
        expandFlag = expandFlag ? false: true;
    })
    // 按下ESC按钮关闭弹层
    $('body', document).on('keyup', function(e) {
        if (e.which === 27) {
            $.modal.closeAll();
        }
    });
});
(function ($) {
    'use strict';
    $.fn.toTop = function(opt) {
        var elem = this;
        var win = (opt && opt.hasOwnProperty('win')) ? opt.win : $(window);
        var doc = (opt && opt.hasOwnProperty('doc')) ? opt.doc : $('html, body');
        var options = $.extend({
            autohide: true,
            offset: 50,
            speed: 500,
            position: true,
            right: 15,
            bottom: 5
        }, opt);
        elem.css({
            'cursor': 'pointer'
        });
        if (options.autohide) {
            elem.css('display', 'none');
        }
        if (options.position) {
            elem.css({
                'position': 'fixed',
                'right': options.right,
                'bottom': options.bottom,
            });
        }
        elem.click(function() {
            doc.animate({
                scrollTop: 0
            }, options.speed);
        });
        win.scroll(function() {
            var scrolling = win.scrollTop();
            if (options.autohide) {
                if (scrolling > options.offset) {
                    elem.fadeIn(options.speed);
                } else elem.fadeOut(options.speed);
            }
        });
    };
})(jQuery);

//获取select2默认配置
function select2Option(obj){
    //修改了select2.js  搜索根据空格多个关键字
    var search_type=obj.attr("data-searchType") || '&';
    var option = {
        searchtype:search_type
    };
    var width=obj.attr("data-width") || '200px';
    var placeholder = obj.attr("data-place") || '';
    var clear = obj.attr("data-clear") || '';
    if(width) {
        option.width = width
    }
    if(placeholder) {
        option.placeholder = placeholder
    }
    if(clear){
        option.placeholder = placeholder?placeholder:'请选择'
        option.placeholderOption = ''
        option.allowClear = true
    }
    return option;
}
//select设置默认值
function select2Default(id,change,value){
    value = value || ''
    change = value || false
    var option = select2Option($("#"+id));
    if(change){
        $("#"+id).select2(option).val(value).trigger('change');
    }else{
        $("#"+id).select2(option).val(value);
    }
}
//自定义事件方法
function b5event(obj) {
    var type=obj.attr("b5-event");
    switch (type) {
        case "tablestatus"://停用启用表格中的状态
            $.operate.statusChange(obj);
            break;
        case "closeDialog":
            closeDialog();
            break;
        case "refreshWin":
            window.location.reload();
            break;
        case "searchToggle":
            $(".b5search-collapse").slideToggle('fast');
            break;
        case "openDialog":
            b5open(obj.data("title"),obj.data("url"),obj.data("type"));
            break;
    }
}

/** 刷新选项卡 */
var refreshItem = function(){
    var topWindow = $(window.parent.document);
    var currentId = $('.page-tabs-content', topWindow).find('.active').attr('data-id');
    var target = $('.RuoYi_iframe[data-id="' + currentId + '"]', topWindow);
    var url = target.attr('src');
    target.attr('src', url).ready();
}

/** 关闭选项卡 */
var closeItem = function(dataId){
	var topWindow = $(window.parent.document);
	if($.common.isNotEmpty(dataId)){
	    window.parent.$.modal.closeLoading();
	    // 根据dataId关闭指定选项卡
	    $('.menuTab[data-id="' + dataId + '"]', topWindow).remove();
	    // 移除相应tab对应的内容区
	    $('.mainContent .RuoYi_iframe[data-id="' + dataId + '"]', topWindow).remove();
	    return;
	}
	var panelUrl = window.frameElement.getAttribute('data-panel');
	$('.page-tabs-content .active i', topWindow).click();
	if($.common.isNotEmpty(panelUrl)){
	    $('.menuTab[data-id="' + panelUrl + '"]', topWindow).addClass('active').siblings('.menuTab').removeClass('active');
	    $('.mainContent .RuoYi_iframe', topWindow).each(function() {
	        if ($(this).data('id') == panelUrl) {
	            $(this).show().siblings('.RuoYi_iframe').hide();
	            return false;
            }
        });
    }
}

/** 创建选项卡 */
function createMenuItem(dataUrl, menuName, isRefresh) {
    var panelUrl = window.frameElement.getAttribute('data-id');
    dataIndex = $.common.random(1, 100),
    flag = true;
    if (dataUrl == undefined || $.trim(dataUrl).length == 0) return false;
    var topWindow = $(window.parent.document);
    // 选项卡菜单已存在
    $('.menuTab', topWindow).each(function() {
        if ($(this).data('id') == dataUrl) {
            if (!$(this).hasClass('active')) {
                $(this).addClass('active').siblings('.menuTab').removeClass('active');
                scrollToTab(this);
                $('.page-tabs-content').animate({ marginLeft: ""}, "fast");
                // 显示tab对应的内容区
                $('.mainContent .RuoYi_iframe', topWindow).each(function() {
                    if ($(this).data('id') == dataUrl) {
                        $(this).show().siblings('.RuoYi_iframe').hide();
                        return false;
                    }
                });
            }
            if (isRefresh) {
            	refreshTab();
            }
            flag = false;
            return false;
        }
    });
    // 选项卡菜单不存在
    if (flag) {
        var str = '<a href="javascript:;" class="active menuTab noactive" data-id="' + dataUrl + '" data-panel="' + panelUrl + '">' + menuName + ' <i class="fa fa-times-circle"></i></a>';
        $('.menuTab', topWindow).removeClass('active');

        // 添加选项卡对应的iframe
        var str1 = '<iframe class="RuoYi_iframe" name="iframe' + dataIndex + '" width="100%" height="100%" src="' + dataUrl + '" frameborder="0" data-id="' + dataUrl + '" data-panel="' + panelUrl + '" seamless></iframe>';
        $('.mainContent', topWindow).find('iframe.RuoYi_iframe').hide().parents('.mainContent').append(str1);

        window.parent.$.modal.loading("数据加载中...");
        $('.mainContent iframe:visible', topWindow).load(function () {
            window.parent.$.modal.closeLoading();
        });

        // 添加选项卡
        $('.menuTabs .page-tabs-content', topWindow).append(str);
        scrollToTab($('.menuTab.active', topWindow));
    }
    return false;
}

// 刷新iframe
function refreshTab() {
	var topWindow = $(window.parent.document);
	var currentId = $('.page-tabs-content', topWindow).find('.active').attr('data-id');
	var target = $('.RuoYi_iframe[data-id="' + currentId + '"]', topWindow);
    var url = target.attr('src');
	target.attr('src', url).ready();
}

// 滚动到指定选项卡
function scrollToTab(element) {
    var topWindow = $(window.parent.document);
    var marginLeftVal = calSumWidth($(element).prevAll()),
    marginRightVal = calSumWidth($(element).nextAll());
    // 可视区域非tab宽度
    var tabOuterWidth = calSumWidth($(".content-tabs", topWindow).children().not(".menuTabs"));
    //可视区域tab宽度
    var visibleWidth = $(".content-tabs", topWindow).outerWidth(true) - tabOuterWidth;
    //实际滚动宽度
    var scrollVal = 0;
    if ($(".page-tabs-content", topWindow).outerWidth() < visibleWidth) {
        scrollVal = 0;
    } else if (marginRightVal <= (visibleWidth - $(element).outerWidth(true) - $(element).next().outerWidth(true))) {
        if ((visibleWidth - $(element).next().outerWidth(true)) > marginRightVal) {
            scrollVal = marginLeftVal;
            var tabElement = element;
            while ((scrollVal - $(tabElement).outerWidth()) > ($(".page-tabs-content", topWindow).outerWidth() - visibleWidth)) {
                scrollVal -= $(tabElement).prev().outerWidth();
                tabElement = $(tabElement).prev();
            }
        }
    } else if (marginLeftVal > (visibleWidth - $(element).outerWidth(true) - $(element).prev().outerWidth(true))) {
        scrollVal = marginLeftVal - $(element).prev().outerWidth(true);
    }
    $('.page-tabs-content', topWindow).animate({ marginLeft: 0 - scrollVal + 'px' }, "fast");
}

//计算元素集合的总宽度
function calSumWidth(elements) {
    var width = 0;
    $(elements).each(function() {
        width += $(this).outerWidth(true);
    });
    return width;
}


// 本地缓存处理
var storage = {
    set: function(key, value) {
        window.localStorage.setItem(key, value);
    },
    get: function(key) {
        return window.localStorage.getItem(key);
    },
    remove: function(key) {
        window.localStorage.removeItem(key);
    },
    clear: function() {
        window.localStorage.clear();
    }
};

// 主子表操作封装处理
var sub = {
    editColumn: function() {
    	var count = $("#" + table.options.id).bootstrapTable('getData').length;
    	var params = new Array();
    	for (var dataIndex = 0; dataIndex < count; dataIndex++) {
    	    var columns = $('#' + table.options.id + ' tr[data-index="' + dataIndex + '"] td');
    	    var obj = new Object();
    	    for (var i = 0; i < columns.length; i++) {
    	        var inputValue = $(columns[i]).find('input');
    	        var selectValue = $(columns[i]).find('select');
    	        var key = table.options.columns[i].field;
    	        if ($.common.isNotEmpty(inputValue.val())) {
    	            obj[key] = inputValue.val();
    	        } else if ($.common.isNotEmpty(selectValue.val())) {
    	            obj[key] = selectValue.val();
    	        } else {
    	            obj[key] = "";
    	        }
    	    }
    	    params.push({ index: dataIndex, row: obj });
    	}
    	$("#" + table.options.id).bootstrapTable("updateRow", params);
    },
    delColumn: function(column) {
    	sub.editColumn();
    	var subColumn = $.common.isEmpty(column) ? "index" : column;
    	var ids = $.table.selectColumns(subColumn);
        if (ids.length == 0) {
            $.modal.alertWarning("请至少选择一条记录");
            return;
        }
        $("#" + table.options.id).bootstrapTable('remove', { field: subColumn, values: ids });
    },
    addColumn: function(row, tableId) {
    	var currentId = $.common.isEmpty(tableId) ? table.options.id : tableId;
    	table.set(currentId);
    	var count = $("#" + currentId).bootstrapTable('getData').length;
    	sub.editColumn();
    	$("#" + currentId).bootstrapTable('insertRow', {
            index: count + 1,
            row: row
        });
    }
};
function sendFile(file,data, callback) {
    var formData = new FormData();
    if(data.hasOwnProperty('file_name')){
        formData.append("file", file,data.file_name);
    }else{
        formData.append("file", file);
    }

    if(data){
        for (var key in data){
            formData.append(key, data[key]);
        }
    }
    $.ajax({
        type: "POST",
        url: upImgUrl,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(result) {
            if (result.code == web_status.SUCCESS) {
                if($.common.isFunction(callback)){
                    callback(result.data);
                }
            } else {
                $.modal.alertError(result.msg);
            }
        },
        error: function() {
            $.modal.alertWarning("图片上传失败。");
        }
    });
}

//获取文件后缀
function getExtClass(url){
    var classname='';
    var ext=url.split(".").pop();
    ext=ext.replace(/\s*/g,"");
    ext=ext.toLowerCase();
    if(ext == 'doc' || ext=='docx'){
        classname='doc';
    }else if (ext == 'txt'){
        classname='txt';
    }else if (ext == 'pdf'){
        classname='pdf';
    }else if (ext == 'xls' || ext=='xlsx' || ext=='csv'){
        classname='xml';
    }else if (ext == 'png' || ext=='jpg' || ext=='jpeg' || ext=='gif' || ext=='bmp'){
        classname='image';
    }else if (ext == 'rar' || ext=='zip' || ext=='gz'){
        classname='rar';
    }
    return classname;
}

//获取文件名称
function getFileName(url){
    var index=url.lastIndexOf("\\");
    if(index<0) return url;
    return url.substring(index+1);
}
function GetRequest() {
    var url = window.location.search;
    var theRequest = new Object();
    if(url.indexOf("?") != -1) {
        var str = url.substr(1);
        strs = str.split("&");
        for(var i = 0; i < strs.length; i++) {
            theRequest[strs[i].split("=")[0]] = (strs[i].split("=")[1]);
        }
    }
    return theRequest;
}
function urlcreate(url,params){
    if ($.common.isNotEmpty(params)) {
        if (url.indexOf('?') > 0) {
            url += '&' + params;
        } else {
            url += '?' + params;
        }
    }
    return url;
}
/** 设置全局ajax处理 */
$.ajaxSetup({
    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

    complete: function(XMLHttpRequest, textStatus) {
        if (textStatus == 'timeout') {
            $.modal.alertWarning("服务器超时，请稍后再试！");
            $.modal.enable();
            $.modal.closeLoading();
        } else if (textStatus == "parsererror" || textStatus == "error") {
            $.modal.alertWarning("服务器错误，请联系管理员！");
            $.modal.enable();
            $.modal.closeLoading();
        }
    }
});
