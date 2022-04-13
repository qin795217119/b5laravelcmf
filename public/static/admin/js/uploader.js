//删除上传图片
function b5uploadImgRemove(obj) {
    $(obj).parents(".b5uploadmainbox").find(".btn-b5upload").removeAttr("disabled");
    $(obj).parents(".b5upload_li").remove();
}
//获取最大上传数量
function b5uploadMaxNum(id){
    var obj=$("#"+id);
    var maxnum=obj.data('multi');
    if(!maxnum) maxnum =1;
    if(!$.common.numValid(maxnum)){
        $.modal.msgError('上传参数：数量格式错误');
        return false;
    }
    return parseInt(maxnum)<1?1:parseInt(maxnum);
}

//上传文件成功后的展示的html
function b5uploadfilehtml(path,name,url,filename){
    var inputname = $("#"+name).data('inputname');
    inputname = inputname?true:false;
    url = url?url:path;
    if(!filename){
        filename = getFileName(path);
    }
    var classname = getExtClass(path);
    var html='<div class="b5upload_li">' +
        '           <input type="hidden" name="'+name+'[]" value="'+path+'">' +
        '           <div class="b5upload_filetype '+classname+'"></div>' +
        '           <div class="b5upload_filename">';
    if(inputname){
        html+= '        <input type="text" name="'+name+'_name[]" value="'+filename+'" class="form-control">';
    }else{
        html+= filename;
    }

    html+= '        </div>' +
        '               <div class="b5upload_fileop">' +
        '                   <a href="javascript:;" onclick="b5uploadImgRemove(this)"><i class="fa fa-trash-o"></i>删除</a>' +
        '                  <a href="'+url+'" target="_blank"><i class="fa fa-hand-o-right"></i>查看</a>' +
        '               </div>' +
        '      </div>';
    return html;
}

//上传图片成功后的展示的html
function b5uploadimghtml(path,name,url=''){
    url = url?url:path
    var html='<div class="b5upload_li">' +
        '           <input type="hidden" name="'+name+'[]" value="'+path+'">' +
        '           <div class="b5uploadimg_con">' +
        '                <div class="b5uploadimg_cell">' +
        '                     <img src="'+url+'" alt="">' +
        '                </div>' +
        '            </div>' +
        '            <div class="b5uploadimg_footer">' +
        '                 <a href="javascript:;" onclick="b5uploadImgRemove(this)"><i class="fa fa-trash-o"></i>删除</a>' +
        '                  <a href="'+url+'" target="_blank"><i class="fa fa-hand-o-right"></i>查看</a>' +
        '            </div>' +
        '      </div>';
    return html;
}


//将上传图片后的html渲染到页面
function b5uploadhtmlshow(id,html) {
    var obj=$("#"+id);
    var maxnum = b5uploadMaxNum(id);
    var listbox =obj.parents(".b5uploadmainbox").find(".b5uploadlistbox");

    if(maxnum>1){
        var hasNum = listbox.find(".b5upload_li").length;
        if(hasNum+1>=maxnum){
            obj.parents(".b5uploadmainbox").find(".btn-b5upload").attr("disabled","disabled");
        }
        if(hasNum>=maxnum){
            $.modal.alertError('最多上传数量为'+maxnum+'个');
            return false;
        }
        listbox.append(html);
    }else{
        listbox.html(html);
    }
    return true;
}
//上传链接按钮
function b5uploadImgLink(id) {
    var type = $("#"+id).parents('.b5uploadmainbox').data('type')
    type = type?type:'file';
    $("#"+id+"_linkbtn").click(function () {
        var linkval=$("#"+id+"_link").val();
        if($.common.isEmpty(linkval)){
            $.modal.msgWarning("请输入链接");
        }else{
            var html = '';
            if(type =='img'){
                html=b5uploadimghtml(linkval,id);
            }else{
                html=b5uploadfilehtml(linkval,id);
            }
            if(!html) return false;
            if(b5uploadhtmlshow(id,html)){
                $("#"+id+"_link").val('');
            }
        }
    });
}

//上传图片文件按钮初始化
function b5uploadimginit(id,callback) {
    var maxnum = b5uploadMaxNum(id);
    var multi = maxnum > 1 ? true : false;
    layui.use('upload', function(){
        layui.upload.render({
            elem: '#'+id //绑定元素
            ,url: upImgUrl //上传接口
            ,field:'file'
            ,multiple:multi
            ,number:maxnum
            ,data:{
                width:function(){
                    return $.common.isEmpty($("#"+id).attr('data-width'))?0:$("#"+id).attr('data-width');
                },
                height:function () {
                    return $.common.isEmpty($("#"+id).attr('data-height'))?0:$("#"+id).attr('data-height');
                },
                cat:function () {
                    return $.common.isEmpty($("#"+id).attr('data-cat'))?'':$("#"+id).attr('data-cat');
                }
            }
            ,accept:'images'
            ,acceptMime:'image/*'
            ,done: function(res){
                if(res.success && res.code===0){
                    if($.common.isFunction(callback)){
                        callback(id,res.data);
                    }else{
                        var html=b5uploadimghtml(res.data.path,id,res.data.url);
                        b5uploadhtmlshow(id,html);
                    }
                }else{
                    $.modal.msgError(res.msg)
                }
            }
            ,error: function(){
                $.modal.msgWarning('网络连接错误')
            }
        });
    });
}


function b5uploadfileinit(id,callback) {
    var maxnum = b5uploadMaxNum(id);
    var multi = maxnum > 1 ? true : false;
    layui.use('upload', function(){
        layui.upload.render({
            elem: '#'+id //绑定元素
            ,url: upFileUrl //上传接口
            ,field:'file'
            ,multiple:multi
            ,number:maxnum
            ,data:{
                cat:function () {
                    return $.common.isEmpty($("#"+id).attr('data-cat'))?'':$("#"+id).attr('data-cat');
                }
            }
            ,accept:'file'
            ,before:function () {}
            ,done: function(res){
                if(res.success && res.code===0){
                    if($.common.isFunction(callback)){
                        callback(id,res.data);
                    }else{
                        var html=b5uploadfilehtml(res.data.path,id,res.data.url,res.data.originName);
                        b5uploadhtmlshow(id,html);
                    }
                }else{
                    $.modal.msgError(res.msg)
                }
            }
            ,error: function(){
                $.modal.msgWarning('网络连接错误')
            }
        });
    });
}


