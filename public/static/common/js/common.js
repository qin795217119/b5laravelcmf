//判断是否为对象
function isJson(str) {
    if (typeof str == 'string') {
        try {
            var obj = JSON.parse(str);
            if (typeof obj == 'object' && obj) {
                return obj;
            }
        } catch (e) {
        }
    } else if (typeof str == 'object' && str) {
        return str;
    }
    return false;
}

//获取随机数
function getrandomkey() {
    var  x="0123456789qwertyuioplkjhgfdsazxcvbnm";
    var  tmp="",tm1="";
    var timestamp = new Date().getTime();
    for(var i=0;i<5;i++)  {
        tmp  +=  x.charAt(Math.ceil(Math.random()*100000000)%x.length);
    }
    for(var j=0;j<5;j++)  {
        tm1  +=  x.charAt(Math.ceil(Math.random()*100000000)%x.length);
    }
    return  tm1+timestamp+tmp;
}
// 判断方法是否存在
function isExitsFunction(funcName) {
    if(funcName){
        try {
            if (typeof(eval(funcName)) == "function") {
                return true;
            }
        } catch(e) {}
    }
    return false;
}

//判断是否为手机号
function b5isMobil(s) {
    var patrn = /(^1[3|4|5|7|8]\d{9}$)|(^09\d{8}$)/;
    if(!patrn.exec(s)) return false
    return true
}

//url拼接
function urlCreate (url, params) {
    if (url.indexOf('?') > 0) {
        url += '&' + params;
    } else {
        url += '?' + params;
    }
    return url;
}

//获取url中的参数
function GetRequest(params) {
    var url = window.location.search;
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        var strs = str.split("&");
        for (var i = 0; i < strs.length; i++) {
            theRequest[strs[i].split("=")[0]] = (strs[i].split("=")[1]);
        }
    }
    if(params){
        if(theRequest.hasOwnProperty(params)){
            return theRequest[params];
        }else {
            return '';
        }
    }
    return theRequest;
}

//url跳转处理
function urlProcess(url, isreplace) {
    if (url == '') {
    }  else if (url == 'reload') {
        window.location.reload()
    } else if (url == 'back') {
        window.history.back();
    } else if (isreplace) {
        window.location.replace(url);
    } else {
        window.location.href=url;
    }
}

//轻提示
function b5tips(msg, url, shadeClose, isreplace) {
    if (shadeClose == undefined) {
        shadeClose = true;
    }
    if (isreplace == undefined) {
        isreplace = false;
    }

    if (msg == '' || msg == undefined || !msg) {
        urlProcess(url, isreplace);
        return false;
    }

    shadeClose = shadeClose ? true : false;
    if (url && url != undefined && url != 'undefined' && url != "") {
        mlayer.open({
            content: msg,
            skin: 'msg',
            shade: 'background-color: rgba(0,0,0,.2)',
            shadeClose: shadeClose,
            time: 3,
            end: function () {
                urlProcess(url, isreplace)
            }
        })

    } else {
        mlayer.open({
            content: msg,
            skin: 'msg',
            shade: 'background-color: rgba(0,0,0,.2)',
            shadeClose: true,
            time: 3
        })
    }
}

//显示加载动画
function b5showloading(msg) {
    if (msg) {
        return mlayer.open({
            type: 2
            , content: msg
        })
    } else {
        return mlayer.open({
            type: 2
        })
    }
}

//隐藏加载动画
function b5hideloading(index) {
    if (index != undefined) {
        mlayer.close(index)
    } else {
        mlayer.closeAll('loading')
    }
}

//关闭所有弹窗
function b5closeall(type){
    if(isEmpty(type)){
        mlayer.closeAll();
    }else{
        mlayer.closeAll(type);
    }
}
//弹出提示
function b5alert(msg, url, btntitle) {
    if (msg == '' || msg == undefined || !msg) {
        urlProcess(url);
        return false
    }
    btntitle = btntitle ? btntitle : '确定';
    mlayer.open({
        content: msg
        , shadeClose: false
        , btn: btntitle
        , yes: function (sssindex) {
            urlProcess(url);
            mlayer.close(sssindex);
        }
    })
}

//询问弹窗
function b5confirm(msg, yes, no) {
    if (msg == '' || msg == undefined || !msg) {
        urlProcess(url);
        return false
    }
    mlayer.open({
        content: msg
        , shadeClose: false
        , btn: ['确定', '取消']
        , yes: function (sssindex) {
            mlayer.close(sssindex);
            if (yes && typeof yes === "function") {
                yes()
            }
        },
        no: function (sssindex) {
            mlayer.close(sssindex);
            if (no && typeof no === "function") {
                no()
            }
        }
    })
}
/** 设置全局ajax处理 */
$.ajaxSetup({
    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    complete: function(XMLHttpRequest, textStatus) {
        if (textStatus == 'timeout') {
            b5tips("服务器超时，请稍后再试！");
            b5hideloading();
        } else if (textStatus == "parsererror" || textStatus == "error") {
            b5tips("服务器错误，请联系管理员！");
            b5hideloading();
        }
    }
});

