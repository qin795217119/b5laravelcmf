/**
 * 通用js方法封装处理
 */
var layer;

// 当前table相关信息
var table = {
    config: {},
    // 当前实例配置
    options: {},
    // 设置实例配置
    set: function(id) {
        if($.common.getLength(table.config) > 1) {
            var tableId = $.common.isEmpty(id) ? $(event.currentTarget).parents(".bootstrap-table").find("table.table").attr("id") : id;
            if ($.common.isNotEmpty(tableId)) {
                table.options = table.get(tableId);
            }
        }
    },
    // 获取实例配置
    get: function(id) {
        return table.config[id];
    },
    // 记住选择实例组
    rememberSelecteds: {},
    // 记住选择ID组
    rememberSelectedIds: {}
};

(function ($) {
    $.extend({
        _tree: {},
        bttTable: {},
        // 表格封装处理
        table: {
            // 初始化表格参数
            init: function(options) {
                var defaults = {
                    id: "bootstrap-table",
                    type: 0, // 0 代表bootstrapTable 1代表bootstrapTreeTable
                    url: bootUrl.url,
                    createUrl: bootUrl.createUrl,
                    updateUrl: bootUrl.updateUrl,
                    removeUrl: bootUrl.removeUrl,
                    removeAllUrl: bootUrl.removeAllUrl,
                    clearCacheUrl: bootUrl.clearCacheUrl,
                    method: 'post',
                    height: undefined,
                    classes:"table table-hover",
                    sidePagination: "server",
                    sortName: 'id',
                    sortOrder: "asc",
                    pagination: true,
                    paginationLoop: false,
                    pageSize: 10,
                    pageNumber: 1,
                    pageList: [10, 25, 50],
                    toolbar: "toolbar",
                    loadingFontSize: 13,
                    striped: false,
                    escape: false,
                    firstLoad: true,
                    showFooter: false,
                    search: false,
                    showToolbar:true,
                    showSearch: true,
                    showPageGo: false,
                    showRefresh: true,
                    showColumns: true,
                    showToggle: true,
                    showExport: false,
                    clickToSelect: false,
                    singleSelect: false,
                    mobileResponsive: true,
                    maintainSelected: false,
                    rememberSelected: false,
                    fixedColumns: false,
                    fixedNumber: 0,
                    fixedRightNumber: 0,
                    queryParams: $.table.queryParams,
                    rowStyle: {}
                };

                var options = $.extend(defaults, options);
                options.exportUrl = options.url;
                if(!options.showToolbar){
                    options.showExport = false;
                    options.showRefresh = false;
                    options.showToggle = false;
                    options.showColumns = false;
                    options.showSearch = false;
                }

                table.options = options;
                table.config[options.id] = options;
                $.table.initEvent();
                $('#' + options.id).bootstrapTable({
                    id: options.id,
                    url: options.url,                                   // 请求后台的URL（*）
                    contentType: "application/x-www-form-urlencoded",   // 编码类型
                    method: options.method,                             // 请求方式（*）
                    cache: false,                                       // 是否使用缓存
                    classes: options.classes,
                    height: options.height,                             // 表格的高度
                    striped: options.striped,                           // 是否显示行间隔色
                    sortable: true,                                     // 是否启用排序
                    sortStable: true,                                   // 设置为 true 将获得稳定的排序
                    sortName: options.sortName,                         // 排序列名称
                    sortOrder: options.sortOrder,                       // 排序方式  asc 或者 desc
                    pagination: options.pagination,                     // 是否显示分页（*）
                    paginationLoop: options.paginationLoop,             // 是否启用分页条无限循环的功能
                    pageNumber: 1,                                      // 初始化加载第一页，默认第一页
                    pageSize: options.pageSize,                         // 每页的记录行数（*）
                    pageList: options.pageList,                         // 可供选择的每页的行数（*）
                    firstLoad: options.firstLoad,                       // 是否首次请求加载数据，对于数据较大可以配置false
                    escape: options.escape,                             // 转义HTML字符串
                    showFooter: options.showFooter,                     // 是否显示表尾
                    iconSize: 'outline',                                // 图标大小：undefined默认的按钮尺寸 xs超小按钮sm小按钮lg大按钮
                    toolbar: '#' + options.toolbar,                     // 指定工作栏
                    loadingFontSize: options.loadingFontSize,           // 自定义加载文本的字体大小
                    sidePagination: options.sidePagination,             // server启用服务端分页client客户端分页
                    search: options.search,                             // 是否显示搜索框功能
                    searchText: options.searchText,                     // 搜索框初始显示的内容，默认为空
                    showSearch: options.showSearch,                     // 是否显示检索信息
                    showPageGo: options.showPageGo,                     // 是否显示跳转页
                    showRefresh: options.showRefresh,                   // 是否显示刷新按钮
                    showColumns: options.showColumns,                   // 是否显示隐藏某列下拉框
                    showToggle: options.showToggle,                     // 是否显示详细视图和列表视图的切换按钮
                    showExport: options.showExport,                     // 是否支持导出文件
                    showHeader: options.showHeader,                     // 是否显示表头
                    showFullscreen: options.showFullscreen,             // 是否显示全屏按钮
                    uniqueId: options.uniqueId,                         // 唯一的标识符
                    clickToSelect: options.clickToSelect,               // 是否启用点击选中行
                    singleSelect: options.singleSelect,                 // 是否单选checkbox
                    mobileResponsive: options.mobileResponsive,         // 是否支持移动端适配
                    cardView: options.cardView,                         // 是否启用显示卡片视图
                    detailView: options.detailView,                     // 是否启用显示细节视图
                    onCheck: options.onCheck,                           // 当选择此行时触发
                    onUncheck: options.onUncheck,                       // 当取消此行时触发
                    onCheckAll: options.onCheckAll,                     // 当全选行时触发
                    onUncheckAll: options.onUncheckAll,                 // 当取消全选行时触发
                    onClickRow: options.onClickRow,                     // 点击某行触发的事件
                    onDblClickRow: options.onDblClickRow,               // 双击某行触发的事件
                    onClickCell: options.onClickCell,                   // 单击某格触发的事件
                    onDblClickCell: options.onDblClickCell,             // 双击某格触发的事件
                    onEditableSave: options.onEditableSave,             // 行内编辑保存的事件
                    onExpandRow: options.onExpandRow,                   // 点击详细视图的事件
                    onPostBody: options.onPostBody,                     // 渲染完成后执行的事件
                    maintainSelected: options.maintainSelected,         // 前端翻页时保留所选行
                    rememberSelected: options.rememberSelected,         // 启用翻页记住前面的选择
                    fixedColumns: options.fixedColumns,                 // 是否启用冻结列（左侧）
                    fixedNumber: options.fixedNumber,                   // 列冻结的个数（左侧）
                    fixedRightNumber: options.fixedRightNumber,         // 列冻结的个数（右侧）
                    onReorderRow: options.onReorderRow,                 // 当拖拽结束后处理函数
                    queryParams: options.queryParams,                   // 传递参数（*）
                    rowStyle: options.rowStyle,                         // 通过自定义函数设置行样式
                    footerStyle: options.footerStyle,                   // 通过自定义函数设置页脚样式
                    headerStyle: options.headerStyle,                   // 通过自定义函数设置标题样式
                    columns: options.columns,                           // 显示列信息（*）
                    data: options.data,                                 // 被加载的数据
                    responseHandler: $.table.responseHandler,           // 在加载服务器发送来的数据之前处理函数
                    onLoadSuccess: $.table.onLoadSuccess,               // 当所有数据被加载时触发处理函数
                    exportOptions: options.exportOptions,               // 前端导出忽略列索引
                    printPageBuilder: options.printPageBuilder,         // 自定义打印页面模板
                    detailFormatter: options.detailFormatter,           // 在行下面展示其他数据列表
                });
            },
            // 获取实例ID，如存在多个返回#id1,#id2 delimeter分隔符
            getOptionsIds: function(separator) {
                var _separator = $.common.isEmpty(separator) ? "," : separator;
                var optionsIds = "";
                $.each(table.config, function(key, value){
                    optionsIds += "#" + key + _separator;
                });
                return optionsIds.substring(0, optionsIds.length - 1);
            },
            // 查询条件
            queryParams: function(params) {
                var curParams = {
                    // 传递参数查询参数
                    pageSize:       params.limit,
                    pageNum:        params.offset / params.limit + 1,
                    searchValue:    params.search,
                    orderByColumn:  params.sort,
                    isAsc:          params.order
                };
                var currentId = $.common.isEmpty(table.options.formId) ? $('form').attr('id') : table.options.formId;
                return $.extend(curParams, $.common.formToJSON(currentId));
            },
            // 请求获取数据后处理回调函数
            responseHandler: function(res) {
                if (typeof table.get(this.id).responseHandler == "function") {
                    table.get(this.id).responseHandler(res);
                }
                if (res.code == web_status.SUCCESS) {
                    if ($.common.isNotEmpty(table.options.sidePagination) && table.options.sidePagination == 'client') {
                        return res.data;
                    } else {
                        if ($.common.isNotEmpty(table.options.rememberSelected) && table.options.rememberSelected) {
                            var column = $.common.isEmpty(table.options.uniqueId) ? table.options.columns[1].field : table.options.uniqueId;
                            $.each(res.data, function(i, row) {
                                row.state = $.inArray(row[column], table.rememberSelectedIds[table.options.id]) !== -1;
                            })
                        }
                          return { rows: res.data, total: res.total, extend: res.hasOwnProperty('extend')?res.extend:{}};
                    }
                } else {
                    $.modal.alertWarning(res.msg);
                    return { rows: [], total: 0 };
                }
            },
            // 初始化事件
            initEvent: function() {
                // 实例ID信息
                var optionsIds = $.table.getOptionsIds();
                // 监听事件处理
                $(optionsIds).on(TABLE_EVENTS, function () {
                    table.set($(this).attr("id"));
                });
                // 在表格体渲染完成，并在 DOM 中可见后触发（事件）
                $(optionsIds).on("post-body.bs.table", function (e, args) {
                     // 浮动提示框特效
                    $(".table [data-toggle='tooltip']").tooltip();
                    // 气泡弹出框特效
                    $('.table [data-toggle="popover"]').popover();
                });
                // 选中、取消、全部选中、全部取消（事件）
                $(optionsIds).on("check.bs.table check-all.bs.table uncheck.bs.table uncheck-all.bs.table", function (e, rowsAfter, rowsBefore) {
                    // 复选框分页保留保存选中数组
                    var rows = $.common.equals("uncheck-all", e.type) ? rowsBefore : rowsAfter;
                    var rowIds = $.table.affectedRowIds(rows);
                    if ($.common.isNotEmpty(table.options.rememberSelected) && table.options.rememberSelected) {
                        func = $.inArray(e.type, ['check', 'check-all']) > -1 ? 'union' : 'difference';
                        var selectedIds = table.rememberSelectedIds[table.options.id];
                        if($.common.isNotEmpty(selectedIds)) {
                            table.rememberSelectedIds[table.options.id] = _[func](selectedIds, rowIds);
                        } else {
                            table.rememberSelectedIds[table.options.id] = _[func]([], rowIds);
                        }
                        var selectedRows = table.rememberSelecteds[table.options.id];
                        if($.common.isNotEmpty(selectedRows)) {
                            table.rememberSelecteds[table.options.id] = _[func](selectedRows, rows);
                        } else {
                            table.rememberSelecteds[table.options.id] = _[func]([], rows);
                        }
                    }
                });
                // 加载成功、选中、取消、全部选中、全部取消（事件）
                $(optionsIds).on("check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table load-success.bs.table", function () {
                    var toolbar = table.options.toolbar;
                    var uniqueId = table.options.uniqueId;
                    // 工具栏按钮控制
                    var rows = $.common.isEmpty(uniqueId) ? $.table.selectFirstColumns() : $.table.selectColumns(uniqueId);
                    // 非多个禁用
                    $('#' + toolbar + ' .multiple').toggleClass('disabled', !rows.length);
                    // 非单个禁用
                    $('#' + toolbar + ' .single').toggleClass('disabled', rows.length!=1);
                });
                //图片展示事件
                $(optionsIds).on("click",".photospreshow",function (){
                    var id = $(this).attr("id");
                    new Viewer(document.getElementById(id),{navbar:false,title:false});
                });

                // 单击tooltip事件
                $(optionsIds).on("click", '.tooltip-show', function() {
                    var target = $(this).data('target');
                    var input = $(this).prev();
                    if ($.common.equals("copy", target)) {
                        input.select();
                        document.execCommand("copy");
                    } else if ($.common.equals("open", target)) {
                        parent.layer.alert(input.val(), {
                            title: "信息内容",
                            shadeClose: true,
                            btn: ['确认'],
                            btnclass: ['btn btn-primary'],
                        });
                    }
                });
            },
            // 当所有数据被加载时触发
            onLoadSuccess: function(data) {
                if (typeof table.options.onLoadSuccess == "function") {
                    table.options.onLoadSuccess(data);
                }
            },
            // 表格销毁
            destroy: function (tableId) {
                var currentId = $.common.isEmpty(tableId) ? table.options.id : tableId;
                $("#" + currentId).bootstrapTable('destroy');
            },
            // 序列号生成
            serialNumber: function (index, tableId) {
                var currentId = $.common.isEmpty(tableId) ? table.options.id : tableId;
                var tableParams = $("#" + currentId).bootstrapTable('getOptions');
                var pageSize = $.common.isNotEmpty(tableParams.pageSize) ? tableParams.pageSize: table.options.pageSize;
                var pageNumber = $.common.isNotEmpty(tableParams.pageNumber) ? tableParams.pageNumber: table.options.pageNumber;
                return pageSize * (pageNumber - 1) + index + 1;
            },
            // 列超出指定长度浮动提示 target（copy单击复制文本 open弹窗打开文本 link 打开链接）
            tooltip: function (value, length, target) {
                var _length = $.common.isEmpty(length) ? 20 : length;
                var _text = "";
                var _value = $.common.nullToStr(value);
                var _target = $.common.isEmpty(target) ? 'copy' : target;
                if (_value.length > _length) {
                    _text = _value.substr(0, _length) + "...";
                    if(_target == 'link'){
                        return $.common.sprintf('<a href="%s" class="tooltip-show" data-toggle="tooltip" target="_blank" title="%s">%s</a>',_value,  _value, _text);
                    }

                    _value = _value.replace(/\'/g,"&apos;");
                    _value = _value.replace(/\"/g,"&quot;");
                    var actions = [];
                    actions.push($.common.sprintf('<input style="opacity: 0;position: absolute;width:5px;z-index:-1" type="text" value="%s"/>', _value));
                    actions.push($.common.sprintf('<a href="###" class="tooltip-show" data-toggle="tooltip" data-target="%s" title="%s">%s</a>', _target, _value, _text));
                    return actions.join('');
                } else {
                    _text = _value;
                    if(_target == 'link'){
                        return $.common.sprintf('<a href="%s" class="tooltip-show" target="_blank" title="%s">%s</a>',_value,  _value, _text);
                    }
                    return _text;
                }
            },
            // 下拉按钮切换
            dropdownToggle: function (value) {
                var actions = [];
                actions.push('<div class="btn-group">');
                actions.push('<button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">');
                actions.push('<i class="fa fa-cog"></i>&nbsp;<span class="fa fa-chevron-down"></span></button>');
                actions.push('<ul class="dropdown-menu">');
                actions.push(value.replace(/<a/g,"<li><a").replace(/<\/a>/g,"</a></li>"));
                actions.push('</ul>');
                actions.push('</div>');
                return actions.join('');
            },
            // 图片预览
             imageView: function (row,type,width,height,fit='cover') {
                var value = row[type]
                if ($.common.isNotEmpty(value)) {
                    var id = row.id
                    var shtml = '';
                    var list = value.split(',');
                    var style="object-fit:"+fit+";";
                    if(width){
                        style+="width:"+width+"px;"
                    }
                    if(height){
                        style+="height:"+height+"px;"
                    }
                    for (let i = 0; i < list.length; i++) {
                        shtml += $.common.sprintf("<img class='img-table-show' src='%s' style='"+style+"'/>", list[i]);
                    }
                    shtml = '<div class="photospreshow" id="'+type+'_'+id+'">'+shtml+'</div>';
                    return shtml;
                } else {
                    return $.common.nullToStr(value);
                }
            },
            // 搜索-默认第一个form
            search: function(formId, tableId) {
                table.set(tableId);
                table.options.formId = $.common.isEmpty(formId) ? $('form').attr('id') : formId;
                var params = $.common.isEmpty(tableId) ? $("#" + table.options.id).bootstrapTable('getOptions') : $("#" + tableId).bootstrapTable('getOptions');
                if($.common.isNotEmpty(tableId)){
                    $("#" + tableId).bootstrapTable('refresh', params);
                } else{
                    $("#" + table.options.id).bootstrapTable('refresh', params);
                }
            },
            // 导出数据
            exportExcel: function(formId) {
                table.set();
                $.modal.confirm("确定导出所有" + table.options.modalName + "吗？", function() {
                    var currentId = $.common.isEmpty(formId) ? $('form').attr('id') : formId;
                    var params = $("#" + table.options.id).bootstrapTable('getOptions');
                    var dataParam = $("#" + currentId).serializeArray();
                    dataParam.push({ "name": "orderByColumn", "value": params.sortName });
                    dataParam.push({ "name": "isAsc", "value": params.sortOrder });
                    dataParam.push({ "name": "isExport", "value": "1" });
                    $.modal.loading("正在导出数据，请稍后...");
                    $.post(table.options.exportUrl, dataParam, function(result) {
                        if (result.code == web_status.SUCCESS) {
                            window.location.href = urlcreate(bootUrl.downUrl,"fileName=" + encodeURI(result.msg) + "&delete=" + true);
                        } else if (result.code == web_status.WARNING) {
                            $.modal.alertWarning(result.msg);
                        } else {
                            $.modal.alertError(result.msg);
                        }
                        $.modal.closeLoading();
                    });
                });
            },
            // 刷新表格
            refresh: function(tableId) {
                var currentId = $.common.isEmpty(tableId) ? table.options.id : tableId;
                $("#" + currentId).bootstrapTable('refresh', {
                    silent: true
                });
            },
            // 查询表格指定列值
            selectColumns: function(column) {
                var rows = $.map($("#" + table.options.id).bootstrapTable('getSelections'), function (row) {
                    return $.common.getItemField(row, column);
                });
                if ($.common.isNotEmpty(table.options.rememberSelected) && table.options.rememberSelected) {
                    var selectedRows = table.rememberSelecteds[table.options.id];
                    if($.common.isNotEmpty(selectedRows)) {
                        rows = $.map(table.rememberSelecteds[table.options.id], function (row) {
                            return $.common.getItemField(row, column);
                        });
                    }
                }
                return $.common.uniqueFn(rows);
            },
            // 获取当前页选中或者取消的行ID
            affectedRowIds: function(rows) {
                var column = $.common.isEmpty(table.options.uniqueId) ? table.options.columns[1].field : table.options.uniqueId;
                var rowIds;
                if ($.isArray(rows)) {
                    rowIds = $.map(rows, function(row) {
                        return $.common.getItemField(row, column);
                    });
                } else {
                    rowIds = [rows[column]];
                }
                return rowIds;
            },
            // 查询表格首列值
            selectFirstColumns: function() {
                var rows = $.map($("#" + table.options.id).bootstrapTable('getSelections'), function (row) {
                    return $.common.getItemField(row, table.options.columns[1].field);
                });
                if ($.common.isNotEmpty(table.options.rememberSelected) && table.options.rememberSelected) {
                    var selectedRows = table.rememberSelecteds[table.options.id];
                    if($.common.isNotEmpty(selectedRows)) {
                        rows = $.map(selectedRows, function (row) {
                            return $.common.getItemField(row, table.options.columns[1].field);
                        });
                    }
                }
                return $.common.uniqueFn(rows);
            },

            // 显示表格指定列
            showColumn: function(column, tableId) {
                var currentId = $.common.isEmpty(tableId) ? table.options.id : tableId;
                $("#" + currentId).bootstrapTable('showColumn', column);
            },
            // 隐藏表格指定列
            hideColumn: function(column, tableId) {
                var currentId = $.common.isEmpty(tableId) ? table.options.id : tableId;
                $("#" + currentId).bootstrapTable('hideColumn', column);
            },
            // 显示所有表格列
            showAllColumns: function(tableId) {
                var currentId = $.common.isEmpty(tableId) ? table.options.id : tableId;
                $("#" + currentId).bootstrapTable('showAllColumns');
            },
            // 隐藏所有表格列
            hideAllColumns: function(tableId) {
                var currentId = $.common.isEmpty(tableId) ? table.options.id : tableId;
                $("#" + currentId).bootstrapTable('hideAllColumns');
            }
        },
        // 表格树封装处理
        treeTable: {
            // 初始化表格
            init: function(options) {
                var defaults = {
                    id: "bootstrap-tree-table",
                    type: 1, // 0 代表bootstrapTable 1代表bootstrapTreeTable
                    height: 0,
                    url: bootUrl.url,
                    createUrl: bootUrl.createUrl,
                    updateUrl: bootUrl.updateUrl,
                    removeUrl: bootUrl.removeUrl,
                    code: "id",
                    parentCode: "parent_id",
                    uniqueId: "id",
                    expandAll: false,
                    expandFirst: false,
                    rootIdValue: null,
                    ajaxParams: {},
                    toolbar: "toolbar",
                    striped: false,
                    expandColumn: 1,
                    showSearch: true,
                    showRefresh: true,
                    showColumns: true
                };
                //加载默人搜索条件
                var params = $.common.formToJSON($('form').attr('id'));
                params.isTree = 1;
                options.ajaxParams = Object.assign({},options.ajaxParams,params);

                options = $.extend(defaults, options);
                table.options = options;
                table.config[options.id] = options;
                $.table.initEvent();
                $.bttTable = $('#' + options.id).bootstrapTreeTable({
                    code: options.code,                                 // 用于设置父子关系
                    parentCode: options.parentCode,                     // 用于设置父子关系
                    type: 'post',                                       // 请求方式（*）
                    url: options.url,                                   // 请求后台的URL（*）
                    data: options.data,                                 // 无url时用于渲染的数据
                    ajaxParams: options.ajaxParams,                     // 请求数据的ajax的data属性
                    rootIdValue: options.rootIdValue,                   // 设置指定根节点id值
                    height: options.height,                             // 表格树的高度
                    expandColumn: options.expandColumn,                 // 在哪一列上面显示展开按钮
                    striped: options.striped,                           // 是否显示行间隔色
                    bordered: false,                                    // 是否显示边框
                    toolbar: '#' + options.toolbar,                     // 指定工作栏
                    showSearch: options.showSearch,                     // 是否显示检索信息
                    showRefresh: options.showRefresh,                   // 是否显示刷新按钮
                    showColumns: options.showColumns,                   // 是否显示隐藏某列下拉框
                    expandAll: options.expandAll,                       // 是否全部展开
                    expandFirst: options.expandFirst,                   // 是否默认第一级展开--expandAll为false时生效
                    columns: options.columns,                           // 显示列信息（*）
                    responseHandler: $.treeTable.responseHandler,       // 在加载服务器发送来的数据之前处理函数
                    onLoadSuccess: $.treeTable.onLoadSuccess            // 当所有数据被加载时触发处理函数
                });
            },
            // 条件查询
            search: function(formId) {
                var currentId = $.common.isEmpty(formId) ? $('form').attr('id') : formId;
                var params = $.common.formToJSON(currentId);
                $.bttTable.bootstrapTreeTable('refresh', params);
            },
            // 刷新
            refresh: function() {
                $.bttTable.bootstrapTreeTable('refresh');
            },
            // 查询表格树指定列值
            selectColumns: function(column) {
                var rows = $.map($.bttTable.bootstrapTreeTable('getSelections'), function (row) {
                    return $.common.getItemField(row, column);
                });
                return $.common.uniqueFn(rows);
            },
            // 请求获取数据后处理回调函数，校验异常状态提醒
            responseHandler: function(res) {
                if (typeof table.options.responseHandler == "function") {
                    table.options.responseHandler(res);
                }
                if (res.code != undefined && res.code != web_status.SUCCESS) {
                    $.modal.alertWarning(res.msg);
                    return [];
                } else {
                    return res.data;
                }
            },
            // 当所有数据被加载时触发
            onLoadSuccess: function(data) {
                if (typeof table.options.onLoadSuccess == "function") {
                    table.options.onLoadSuccess(data);
                }
                $(".table [data-toggle='tooltip']").tooltip();
            },

        },
        // 表单常用展示效果
        view:{
            //开关状态显示
            statusTools:function(row,click,statusArr,field) {
                if($.common.isEmpty(statusArr)) {
                    statusArr=['停用','正常'];
                }
                field=$.common.isEmpty(field)?'status':field;
                var clickHtml = '';
                if(click){
                    var dataval = row[field] == 1 ? 0 : 1;
                    var datatitle = row[field] == 1 ? statusArr[0]:statusArr[1];
                    datatitle=datatitle==='正常'?'启用':datatitle;
                    clickHtml = 'b5-event="tablestatus" data-id="' + row.id + '" data-val="' + dataval + '" data-name="'+datatitle+'"';
                }
                var classs = row[field] == 1 ? 'fa-toggle-on' : 'fa-toggle-off';
                return '<i class="fa '+classs+' text-info fa-2x" '+clickHtml+'></i> ';
            },
            //lable状态显示
            statusShow:function (row,click,statusArr,field) {
                if($.common.isEmpty(statusArr)) {
                    statusArr=['停用','正常'];
                }
                field=$.common.isEmpty(field)?'status':field;
                var clickHtml = '';
                if(click){
                    var dataval = row[field] == 1 ? 0 : 1;
                    var datatitle = row[field] == 1 ? statusArr[0]:statusArr[1];
                    datatitle=datatitle==='正常'?'启用':datatitle;
                    clickHtml = 'b5-event="tablestatus" data-id="' + row.id + '" data-val="' + dataval + '" data-name="'+datatitle+'"';
                }
                var classs = row[field] == 1 ? 'badge-primary' : 'badge-warning';
                return '<span class="badge '+classs+'" '+clickHtml+'>'+statusArr[row[field]]+'</span>';
            }
        },
        // 表单封装处理
        form: {
            // 表单重置
            reset: function(formId, tableId) {
                table.set(tableId);
                var currentId = $.common.isEmpty(formId) ? $('form').attr('id') : formId;
                $("#" + currentId)[0].reset();
                if ($.fn.select2 !== undefined) {
                    $("select.select2").each(function () {
                        $(this).val($(this).find('option').eq(0).val()).trigger('change');
                    })
                }
                if($.common.isFunction('tableSearchReset')){
                    tableSearchReset();
                }
                if (table.options.type == table_type.bootstrapTable) {
                    if($.common.isEmpty(tableId)){
                        $("#" + table.options.id).bootstrapTable('refresh');
                    } else{
                        $("#" + tableId).bootstrapTable('refresh');
                    }
                } else if (table.options.type == table_type.bootstrapTreeTable) {
                    if($.common.isEmpty(tableId)){
                        $("#" + table.options.id).bootstrapTreeTable('refresh', []);
                    } else{
                        $("#" + tableId).bootstrapTreeTable('refresh', []);
                    }
                }
            },
            // 获取选中复选框项
            selectCheckeds: function(name) {
                var checkeds = "";
                $('input:checkbox[name="' + name + '"]:checked').each(function(i) {
                    if (0 == i) {
                        checkeds = $(this).val();
                    } else {
                        checkeds += ("," + $(this).val());
                    }
                });
                return checkeds;
            },
            // 获取选中下拉框项
            selectSelects: function(name) {
                var selects = "";
                $('#' + name + ' option:selected').each(function (i) {
                    if (0 == i) {
                        selects = $(this).val();
                    } else {
                        selects += ("," + $(this).val());
                    }
                });
                return selects;
            }
        },
        // 弹出层封装处理
        modal: {
            //layer初始化
            layerinit:function(callback) {
                if(window.layer!==undefined){
                    if($.common.isFunction(callback)) {
                        if (typeof callback === 'string') {
                            eval(callback + "(layer)")
                        } else {
                            callback(layer)
                        }
                    }
                }else{
                    layui.use(['layer'],function () {
                        layer=layui.layer;
                        layer.config({
                            extend: 'moon/style.css',
                            skin: 'layer-ext-moon'
                        });
                        if($.common.isFunction(callback)) {
                            if (typeof callback === 'string') {
                                eval(callback + "(layer)")
                            } else {
                                callback(layer)
                            }
                        }
                    })
                }
            },
            // 显示图标
            icon: function(type) {
                var icon = "";
                if (type == modal_status.WARNING) {
                    icon = 0;
                } else if (type == modal_status.SUCCESS) {
                    icon = 1;
                } else if (type == modal_status.FAIL) {
                    icon = 2;
                } else {
                    icon = 3;
                }
                return icon;
            },
            //请提示
            tips:function(content,callback){
                window.layer=undefined;
                layui.use(['layer'],function () {
                    var layers=layui.layer;
                    layers.config({
                        extend: 'default/layer.css',
                        skin: ''
                    });
                    layers.msg(content,{time: 2000, shade: [0.1, '#000'],shadeClose:true},function () {
                        if($.common.isNotEmpty(callback)) {
                            $.common.callBackOp(callback);
                        }
                    });
                })
            },
            // 消息提示
            msg: function(content, type,callback) {
                $.modal.layerinit(function (layer) {
                    if ($.common.isNotEmpty(type)) {
                        layer.msg(content, {icon: $.modal.icon(type), time: 2000, shift: 5, shade: [0.1, '#000'],shadeClose:true},function () {
                            if($.common.isNotEmpty(callback)) {
                                $.common.callBackOp(callback);
                            }
                        });
                    } else {
                        layer.msg(content,{icon:0,time: 2000, shade: [0.1, '#000']},function () {
                            if($.common.isNotEmpty(callback)) {
                                $.common.callBackOp(callback);
                            }
                        });
                    }
                });
            },
            //layer的加载曾
            b5showload(){
                $.modal.layerinit(function (layer) {
                    layer.load(1, {
                        shade: [0.2,'#000'] //0.1透明度的白色背景
                    });
                })
            },
            b5hideload(){
                $.modal.layerinit(function (layer) {
                    layer.closeAll('loading');
                })
            },
            // 错误消息
            msgError: function(content,callback) {
                $.modal.msg(content, modal_status.FAIL,callback);
            },
            // 成功消息
            msgSuccess: function(content,callback) {
                $.modal.msg(content, modal_status.SUCCESS,callback);
            },
            // 警告消息
            msgWarning: function(content,callback) {
                $.modal.msg(content, modal_status.WARNING,callback);
            },
            // 弹出提示
            alert: function(content, type,callback) {
                $.modal.layerinit(function (layer) {
                    layer.alert(content, {
                        icon: $.modal.icon(type),
                        title: "系统提示",
                        btn: ['确认'],
                        btnclass: ['btn btn-primary'],
                    },function (index) {
                        layer.close(index);
                        if($.common.isNotEmpty(callback)){
                            $.common.callBackOp(callback);
                        }
                    });
                });
            },
            // 消息提示并刷新父窗体
            msgReload: function(msg, type) {
                $.modal.layerinit(function (layer) {
                    layer.msg(msg, {
                            icon: $.modal.icon(type),
                            time: 500,
                            shade: [0.1, '#8F8F8F']
                        },
                        function () {
                            $.modal.reload();
                        });
                });
            },
            // 错误提示
            alertError: function(content,callback) {
                $.modal.alert(content, modal_status.FAIL,callback);
            },
            // 成功提示
            alertSuccess: function(content,callback) {
                $.modal.alert(content, modal_status.SUCCESS,callback);
            },
            // 警告提示
            alertWarning: function(content,callback) {
                $.modal.alert(content, modal_status.WARNING,callback);
            },
            // 关闭窗体
            close: function (index) {
                $.modal.layerinit(function (layer) {
                    if($.common.isEmpty(index)){
                        index = parent.layer.getFrameIndex(window.name);
                    }
                    parent.layer.close(index);
                });
            },
            // 关闭全部窗体
            closeAll: function () {
                $.modal.layerinit(function (layer) {
                    layer.closeAll();
                });
            },
            // 确认窗体
            confirm: function (content, callback,callback1) {
                $.modal.layerinit(function (layer) {
                    layer.confirm(content, {
                        icon: 3,
                        title: "系统提示",
                        btn: ['确认', '取消']
                    }, function (index) {
                        layer.close(index);
                        if($.common.isNotEmpty(callback)){
                            $.common.callBackOp(callback);
                        }
                    },function (index){
                        layer.close(index);
                        if($.common.isNotEmpty(callback1)){
                            $.common.callBackOp(callback1);
                        }
                    });
                });
            },
            // 弹出层指定宽度
            open: function (title, url, width, height, callback) {
                //如果是移动端，就使用自适应大小弹窗
                if ($.common.isMobile()) {
                    width = 'auto';
                    height = 'auto';
                }
                if ($.common.isEmpty(title)) {
                    title = false;
                }
                if ($.common.isEmpty(url)) {
                    url = "/404.html";
                }
                if ($.common.isEmpty(width)) {
                    width = 800;
                }
                if ($.common.isEmpty(height)) {
                    height = ($(window).height() - 50);
                }
                if ($.common.isEmpty(callback)) {
                    callback = function(index, layero) {
                        var iframeWin = layero.find('iframe')[0];
                        iframeWin.contentWindow.submitHandler(index, layero);
                    }
                }

                var area=[width + 'px', height + 'px'];
                var docW=$(document).width();
                var scrollbar=true;
                var isfull=false;
                if($.common.isNumber(width) && width>=docW){
                    // area=['100%','100%'];
                    scrollbar=false;
                    isfull=true;
                }

                $.modal.layerinit(function (layer) {
                    var index=layer.open({
                        type: 2,
                        area: area,
                        fix: false,
                        //不固定
                        maxmin: true,
                        shade: 0.3,
                        title: title,
                        content: url,
                        btn: ['确定', '关闭'],
                        // 弹层外区域关闭
                        shadeClose: true,
                        // scrollbar:false,
                        yes: callback,
                        cancel: function (index) {
                            return true;
                        }
                    });
                    if(isfull){
                        layer.full(index)
                    }
                });
            },
            // 弹出层指定参数选项
            openOptions: function (options) {
                $.modal.layerinit(function (layer) {
                    var _url = $.common.isEmpty(options.url) ? "/404.html" : options.url;
                    var _title = $.common.isEmpty(options.title) ? "系统窗口" : options.title;
                    var _width = $.common.isEmpty(options.width) ? "800" : options.width;
                    var _height = $.common.isEmpty(options.height) ? ($(window).height() - 50) : options.height;
                    if(_width.indexOf('%') === -1){
                        _width = _width + 'px'
                    }
                    var _btn = ['<i class="fa fa-check"></i> 确认', '<i class="fa fa-close"></i> 关闭'];
                    if ($.common.isEmpty(options.yes)) {
                        options.yes = function(index, layero) {
                            options.callBack(index, layero);
                        }
                    }
                    var btnCallback = {};
                    if(options.btn instanceof Array){
                        for (var i = 1, len = options.btn.length; i < len; i++) {
                            var btn = options["btn" + (i + 1)];
                            if (btn) {
                                btnCallback["btn" + (i + 1)] = btn;
                            }
                        }
                    }
                    var index = layer.open($.extend({
                        type: 2,
                        maxmin: $.common.isEmpty(options.maxmin) ? true : options.maxmin,
                        shade: 0.3,
                        title: _title,
                        fix: false,
                        area: [_width , _height + 'px'],
                        content: _url,
                        shadeClose: $.common.isEmpty(options.shadeClose) ? true : options.shadeClose,
                        skin: options.skin,
                        btn: $.common.isEmpty(options.btn) ? _btn : options.btn,
                        yes: options.yes,
                        cancel: function () {
                            return true;
                        }
                    }, btnCallback));
                    if ($.common.isNotEmpty(options.full) && options.full === true) {
                        layer.full(index);
                    }
                });

            },
            // 弹出层全屏
            openFull: function (title, url, width, height) {
                //如果是移动端，就使用自适应大小弹窗
                if ($.common.isMobile()) {
                    width = 'auto';
                    height = 'auto';
                }
                if ($.common.isEmpty(title)) {
                    title = false;
                }
                if ($.common.isEmpty(url)) {
                    url = "/404.html";
                }
                if ($.common.isEmpty(width)) {
                    width = 800;
                }
                if ($.common.isEmpty(height)) {
                    height = ($(window).height() - 50);
                }
                $.modal.layerinit(function (layer) {
                    var index = layer.open({
                        type: 2,
                        area: [width + 'px', height + 'px'],
                        fix: false,
                        //不固定
                        maxmin: true,
                        shade: 0.3,
                        title: title,
                        content: url,
                        btn: ['确定', '关闭'],
                        // 弹层外区域关闭
                        shadeClose: true,
                        yes: function (index, layero) {
                            var iframeWin = layero.find('iframe')[0];
                            iframeWin.contentWindow.submitHandler(index, layero);
                        },
                        cancel: function (index) {
                            return true;
                        }
                    });
                    layer.full(index);
                });
            },
            // 选卡页方式打开
            openTab: function (title, url, isRefresh) {
                createMenuItem(url, title, isRefresh);
            },
            // 选卡页同一页签打开
            parentTab: function (title, url) {
                var dataId = window.frameElement.getAttribute('data-id');
                createMenuItem(url, title);
                closeItem(dataId);
            },
            // 关闭选项卡
            closeTab: function (dataId) {
                closeItem(dataId);
            },
            // 禁用按钮
            disable: function() {
                var doc = window.top == window.parent ? window.document : window.parent.document;
                $("a[class*=layui-layer-btn]", doc).addClass("layer-disabled");
            },
            // 启用按钮
            enable: function() {
                var doc = window.top == window.parent ? window.document : window.parent.document;
                $("a[class*=layui-layer-btn]", doc).removeClass("layer-disabled");
            },
            // 打开遮罩层
            loading: function (message) {
                $.blockUI({ message: '<div class="loaderbox"><div class="loading-activity"></div> ' + message + '</div>' });
            },
            // 关闭遮罩层
            closeLoading: function () {
                setTimeout(function(){
                    $.unblockUI();
                }, 50);
            },
            // 重新加载
            reload: function () {
                parent.location.reload();
            }
        },
        // 操作封装处理
        operate: {
            //ajax提交
            b5ajax:function(url, type, dataType, data, callback, completecallback){
                var config = {
                    url: url,
                    type: type,
                    dataType: dataType,
                    data: data,
                    beforeSend: function () {
                        $.modal.loading("正在处理中，请稍后...");
                    },
                    success: function(result) {
                        $.modal.closeLoading();
                        if($.common.isFunction(callback)){
                            if(typeof callback ==='string'){
                                eval(callback+"(result)");
                            }else{
                                callback(result);
                            }
                        }else{

                            if(result.code==web_status.SUCCESS){
                                $.modal.msgSuccess(result.msg,result.url);
                            }else if (result.code == web_status.FAIL){
                                $.modal.msgError(result.msg,result.url);
                            }else if (result.code == web_status.WARNING){
                                $.modal.msgWarning(result.msg,result.url);
                            }else{
                                $.modal.msg(result.msg,'',result.url);
                            }
                        }
                    },
                    complete:function () {
                        if($.common.isFunction(completecallback)){
                            if(typeof completecallback ==='string'){
                                eval(completecallback+"()");
                            }else{
                                completecallback();
                            }
                        }
                    }
                };
                $.ajax(config);
            },
            b5post:function(url,data,callback,completecallback){
                $.operate.b5ajax(url, "post", "json", data, callback,completecallback);
            },
            b5get:function(url,data,callback,completecallback){
                $.operate.b5ajax(url, "get", "json", data, callback,completecallback);
            },
            // 提交数据
            submit: function(url, type, dataType, data, callback) {
                var config = {
                    url: url,
                    type: type,
                    dataType: dataType,
                    data: data,
                    beforeSend: function () {
                        $.modal.loading("正在处理中，请稍后...");
                    },
                    success: function(result) {
                        if (typeof callback == "function") {
                            callback(result);
                        }
                        $.operate.ajaxSuccess(result);
                    }
                };
                $.ajax(config)
            },
            // post请求传输
            post: function(url, data, callback) {
                $.operate.submit(url, "post", "json", data, callback);
            },
            // get请求传输
            get: function(url, callback) {
                $.operate.submit(url, "get", "json", "", callback);
            },
            //状态修改请求
            statusChange:function(obj){
                table.set();
                var id = obj.data("id");
                var status = obj.data('val');
                var title = table.options.modalName;
                title = title ? title : '信息';
                var name = obj.data('name');
                if (!name) {
                    name = status == '1' ? '启用' : '停用';
                }
                $.modal.confirm("确认要" + name + "该" + title + "吗？", function() {
                    $.operate.post(bootUrl.statusUrl, { "id": id, "status": status, name:name });
                });
            },
            // 详细信息
            detail: function(id, width, height) {
                table.set();
                var _url = $.operate.detailUrl(id);
                var _width = $.common.isEmpty(width) ? "800" : width;
                var _height = $.common.isEmpty(height) ? ($(window).height() - 50) : height;
                //如果是移动端，就使用自适应大小弹窗
                if ($.common.isMobile()) {
                    _width = 'auto';
                    _height = 'auto';
                }
                var options = {
                    title: table.options.modalName + "详细",
                    width: _width,
                    height: _height,
                    url: _url,
                    skin: 'layui-layer-gray',
                    btn: ['关闭'],
                    yes: function (index, layero) {
                        layer.close(index);
                    }
                };
                $.modal.openOptions(options);
            },
            // 详细访问地址
            detailUrl: function(id) {
                var url = "/404.html";
                if ($.common.isNotEmpty(id)) {
                    url = table.options.detailUrl.replace("%id%", id);
                } else {
                    var id = $.common.isEmpty(table.options.uniqueId) ? $.table.selectFirstColumns() : $.table.selectColumns(table.options.uniqueId);
                    if (id.length == 0) {
                        $.modal.alertWarning("请至少选择一条记录");
                        return;
                    }
                    url = table.options.detailUrl.replace("%id%", id);
                }
                return url;
            },
            //清除缓存
            clearcache:function(){
                table.set();
                var url=table.options.clearCacheUrl;
                $.operate.submit(url, "post");
            },
            // 删除信息
            remove: function(id,obj) {
                table.set();
                if($.common.isEmpty(id) && obj){
                    var data_id=$(obj).data('id');
                    if($.common.isNotEmpty(data_id)){
                        id=data_id;
                    }
                    if($.common.isEmpty(id)){
                        var rows = $.common.isEmpty(table.options.uniqueId) ? $.table.selectFirstColumns() : $.table.selectColumns(table.options.uniqueId);
                        if (rows.length !== 1) {
                            $.modal.alertWarning("请选择一条记录");
                            return;
                        }
                        id=rows[0];
                    }
                }
                $.modal.confirm("确定删除该条" + table.options.modalName + "信息吗？", function() {
                    var url = table.options.removeUrl;
                    var data = { "id": id };
                    $.operate.submit(url, "post", "json", data);
                });
            },
            // 批量删除信息
            removeAll: function(obj) {
                table.set();
                var column='';
                if(obj){
                    column=$(obj).data('column');
                }
                var rows = $.common.isEmpty(table.options.uniqueId) ? $.table.selectFirstColumns() : $.table.selectColumns(table.options.uniqueId);
                if($.common.isNotEmpty(column)){
                    rows = $.table.selectColumns(column);
                }
                if (rows.length == 0) {
                    $.modal.alertWarning("请至少选择一条记录");
                    return;
                }
                $.modal.confirm("确认要删除选中的" + rows.length + "条数据吗?", function() {
                    var url = table.options.removeAllUrl;
                    var data = { "ids": rows.join() };
                    $.operate.submit(url, "post", "json", data);
                });
            },
            // 添加信息
            add: function(obj,id) {
                table.set();
                var width='';
                var height='';
                if(obj){
                    width=$(obj).data('width');
                    height=$(obj).data('height');
                }
                if($.common.isEmpty(id) && obj){
                    var dataid=$(obj).data('id');
                    if($.common.isNotEmpty(dataid)){
                        id=dataid;
                    }
                }
                $.modal.open("添加" + table.options.modalName, $.operate.addUrl(id),width,height);
            },
            //添加额外信息
            addExt: function(args,obj,isFull,name){
                table.set();
                var url=table.options.createUrl.replace("id=%id%", "");
                url=urlcreate(url,args);
                if(isFull){
                    $.modal.openFull("添加" + (name?name:table.options.modalName), url);
                }else{
                    $.modal.open("添加" + (name?name:table.options.modalName), url);
                }
            },
            // 添加信息，以tab页展现
            addTab: function (id) {
                table.set();
                $.modal.openTab("添加" + table.options.modalName, $.operate.addUrl(id));
            },
            // 添加信息 全屏
            addFull: function(id,obj) {
                table.set();
                if($.common.isEmpty(id) && obj){
                    var dataid=$(obj).data('id');
                    if($.common.isNotEmpty(dataid)){
                        id=dataid;
                    }
                }
                $.modal.openFull("添加" + table.options.modalName, $.operate.addUrl(id));
            },
            // 添加访问地址
            addUrl: function(id) {
                var url = $.common.isEmpty(id) ? table.options.createUrl.replace("%id%", "") : table.options.createUrl.replace("%id%", id);
                return url;
            },
            // 修改信息
            edit: function(id,obj) {
                table.set();
                if($.common.isEmpty(id) && obj){
                    var dataid=$(obj).data('id');
                    if($.common.isNotEmpty(dataid)){
                        id=dataid;
                    }
                }
                if($.common.isEmpty(id) && table.options.type == table_type.bootstrapTreeTable) {
                    var row = $("#" + table.options.id).bootstrapTreeTable('getSelections')[0];
                    if ($.common.isEmpty(row)) {
                        $.modal.alertWarning("请至少选择一条记录");
                        return;
                    }
                    var url = table.options.updateUrl.replace("%id%", row[table.options.uniqueId]);
                    $.modal.open("修改" + table.options.modalName, url);
                } else {
                    $.modal.open("修改" + table.options.modalName, $.operate.editUrl(id));
                }
            },
            // 修改信息，以tab页展现
            editTab: function(id,obj) {
                table.set();
                if($.common.isEmpty(id) && obj){
                    var dataid=$(obj).data('id');
                    if($.common.isNotEmpty(dataid)){
                        id=dataid;
                    }
                }
                if($.common.isEmpty(id) && table.options.type == table_type.bootstrapTreeTable) {
                    var row = $("#" + table.options.id).bootstrapTreeTable('getSelections')[0];
                    if ($.common.isEmpty(row)) {
                        $.modal.alertWarning("请至少选择一条记录");
                        return;
                    }
                    var url = table.options.updateUrl.replace("%id%", row[table.options.uniqueId]);
                    $.modal.openTab("修改" + table.options.modalName, url);
                } else {
                    $.modal.openTab("修改" + table.options.modalName, $.operate.editUrl(id));
                }
            },
            // 修改信息 全屏
            editFull: function(id,obj) {
                table.set();
                var url = "/404.html";
                if ($.common.isNotEmpty(id)) {
                    url = table.options.updateUrl.replace("%id%", id);
                } else {
                    if($.common.isEmpty(id) && obj){
                        var dataid=$(obj).data('id');
                        if($.common.isNotEmpty(dataid)){
                            id=dataid;
                        }
                    }
                    if($.common.isEmpty(id)){
                        if(table.options.type == table_type.bootstrapTreeTable) {
                            var row = $("#" + table.options.id).bootstrapTreeTable('getSelections')[0];
                            if ($.common.isEmpty(row)) {
                                $.modal.alertWarning("请至少选择一条记录");
                                return;
                            }
                            url = table.options.updateUrl.replace("%id%", row[table.options.uniqueId]);
                        } else {
                            var row = $.common.isEmpty(table.options.uniqueId) ? $.table.selectFirstColumns() : $.table.selectColumns(table.options.uniqueId);
                            url = table.options.updateUrl.replace("%id%", row);
                        }
                    }
                }
                $.modal.openFull("修改" + table.options.modalName, url);
            },
            // 修改访问地址
            editUrl: function(id) {
                var url = "/404.html";
                if ($.common.isNotEmpty(id)) {
                    url = table.options.updateUrl.replace("%id%", id);
                } else {
                    var rows = $.common.isEmpty(table.options.uniqueId) ? $.table.selectFirstColumns() : $.table.selectColumns(table.options.uniqueId);
                    if (rows.length == 0) {
                        $.modal.alertWarning("请至少选择一条记录");
                        return;
                    }
                    url = table.options.updateUrl.replace("%id%", rows[0]);
                }
                return url;
            },
            // 保存信息 刷新表格
            save: function(url, data, callback) {
                var config = {
                    url: url,
                    type: "post",
                    dataType: "json",
                    data: data,
                    beforeSend: function () {
                        $.modal.loading("正在处理中，请稍后...");
                        $.modal.disable();
                    },
                    success: function(result) {
                        if (typeof callback == "function") {
                            callback(result);
                        }
                        $.operate.successCallback(result);
                    }
                };
                $.ajax(config)
            },
            // 保存信息 弹出提示框
            saveModal: function(url, data, callback) {
                var config = {
                    url: url,
                    type: "post",
                    dataType: "json",
                    data: data,
                    beforeSend: function () {
                        $.modal.loading("正在处理中，请稍后...");
                    },
                    success: function(result) {
                        if (typeof callback == "function") {
                            callback(result);
                        }
                        if (result.code == web_status.SUCCESS) {
                            $.modal.alertSuccess(result.msg)
                        } else if (result.code == web_status.WARNING) {
                            $.modal.alertWarning(result.msg)
                        } else {
                            $.modal.alertError(result.msg);
                        }
                        $.modal.closeLoading();
                    }
                };
                $.ajax(config)
            },
            // 保存选项卡信息
            saveTab: function(url, data, callback) {
                var config = {
                    url: url,
                    type: "post",
                    dataType: "json",
                    data: data,
                    beforeSend: function () {
                        $.modal.loading("正在处理中，请稍后...");
                    },
                    success: function(result) {
                        if (typeof callback == "function") {
                            callback(result);
                        }
                        $.operate.successTabCallback(result);
                    }
                };
                $.ajax(config)
            },
            // 保存结果弹出msg刷新table表格
            ajaxSuccess: function (result) {
                if (result.code == web_status.SUCCESS && table.options.type == table_type.bootstrapTable) {
                    result.msg && $.modal.msgSuccess(result.msg);
                    $.table.refresh();
                } else if (result.code == web_status.SUCCESS && table.options.type == table_type.bootstrapTreeTable) {
                    result.msg && $.modal.msgSuccess(result.msg);
                    $.treeTable.refresh();
                } else if (result.code == web_status.SUCCESS && $.common.isEmpty(table.options.type)) {
                    result.msg && $.modal.msgSuccess(result.msg)
                }  else if (result.code == web_status.WARNING) {
                    $.modal.alertWarning(result.msg)
                }  else {
                    $.modal.alertError(result.msg);
                }
                $.modal.closeLoading();
            },
            // 成功结果提示msg（父窗体全局更新）
            saveSuccess: function (result) {
                if (result.code == web_status.SUCCESS) {
                    $.modal.msgReload("保存成功,正在刷新数据请稍后……", modal_status.SUCCESS);
                } else if (result.code == web_status.WARNING) {
                    $.modal.alertWarning(result.msg)
                }  else {
                    $.modal.alertError(result.msg);
                }
                $.modal.closeLoading();
            },
            // 成功回调执行事件（父窗体静默更新）
            successCallback: function(result) {
                if (result.code == web_status.SUCCESS) {
                    var parent = window.parent;
                    if (parent.table.options.type == table_type.bootstrapTable) {
                        $.modal.close();
                        parent.$.modal.msgSuccess(result.msg);
                        parent.$.table.refresh();
                    } else if (parent.table.options.type == table_type.bootstrapTreeTable) {
                        $.modal.close();
                        parent.$.modal.msgSuccess(result.msg);
                        parent.$.treeTable.refresh();
                    } else {
                        if(result.url!==''){
                            $.modal.msgSuccess('保存成功',result.url);
                        }else{
                            $.modal.msgReload("保存成功,正在刷新数据请稍后……", modal_status.SUCCESS);
                        }
                    }
                } else if (result.code == web_status.WARNING) {
                    $.modal.alertWarning(result.msg)
                }  else {
                    $.modal.alertError(result.msg);
                }
                $.modal.closeLoading();
                $.modal.enable();
            },
            // 选项卡成功回调执行事件（父窗体静默更新）
            successTabCallback: function(result) {
                if (result.code == web_status.SUCCESS) {
                    var topWindow = $(window.parent.document);
                    var activeObj = $('.page-tabs-content', topWindow).find('.active');
                    var currentId = activeObj.attr('data-panel');
                    if(currentId){
                        var $contentWindow = $('.RuoYi_iframe[data-id="' + currentId + '"]', topWindow)[0].contentWindow;
                        $.modal.close();
                        $contentWindow.$.modal.msgSuccess(result.msg);
                        $contentWindow.$(".layui-layer-padding").removeAttr("style");
                        if ($contentWindow.table.options.type == table_type.bootstrapTable) {
                            $contentWindow.$.table.refresh();
                        } else if ($contentWindow.table.options.type == table_type.bootstrapTreeTable) {
                            $contentWindow.$.treeTable.refresh();
                        }
                        $.modal.closeTab();
                    }else{
                        $.modal.close();
                        $.modal.msgSuccess(result.msg,function (){
                            $.modal.closeTab();
                        });
                    }
                } else if (result.code == web_status.WARNING) {
                    $.modal.alertWarning(result.msg)
                } else {
                    $.modal.alertError(result.msg);
                }
                $.modal.closeLoading();
            }
        },
        // 校验封装处理
        validate: {
            // 判断返回标识是否唯一 false 不存在 true 存在
            unique: function (value) {
                if (value == "0") {
                    return true;
                }
                return false;
            },
            // 表单验证
            form: function (formId,parmas) {
                var currentId = $.common.isEmpty(formId) ? $('form').attr('id') : formId;
                parmas = parmas?parmas:{};
                return $("#" + currentId).validate(parmas).form();
            },
            // 重置表单验证（清除提示信息）
            reset: function (formId) {
                var currentId = $.common.isEmpty(formId) ? $('form').attr('id') : formId;
                return $("#" + currentId).validate().resetForm();
            }
        },
        // 树插件封装处理
        tree: {
            _option: {},
            _lastValue: {},
            // 初始化树结构
            init: function(options) {
                var defaults = {
                    id: "tree",                    // 属性ID
                    expandLevel: 0,                // 展开等级节点
                    showParentLevel:0,              //选中时显示父级的等级开始
                    ismult:false,                   //是否开启多选
                    childparent:false,
                    view: {
                        selectedMulti: false,      // 设置是否允许同时选中多个节点
                        nameIsHTML: true           // 设置 name 属性是否支持 HTML 脚本
                    },
                    check: {
                        enable: true,             // 置 zTree 的节点上是否显示 checkbox / radio
                        chkStyle:'checkbox',
                        autoCheckTrigger:false,
                        nocheckInherit: false,      // 设置子节点是否自动继承
                    },
                    data: {
                        key: {
                            title: "name"         // 节点数据保存节点提示信息的属性名称
                        },
                        simpleData: {
                            enable: true,           // true / false 分别表示 使用 / 不使用 简单数据模式
                            pIdKey: 'parent_id'
                        }
                    },
                    onClick:$.tree.zOnClick,
                    onCheck:$.tree.zOnCheck,
                };
                var options = $.extend(defaults, options);
                if(options.childparent){
                    options.check.chkboxType={ "Y": "ps", "N": "ps" };
                }else{
                    options.check.chkboxType={"Y":"","N":""};
                }
                if(options.ismult){
                    options.check.enable=true;
                }else{
                    options.check.enable=false;
                }
                $.tree._option = options;
                // 树结构初始化加载
                var setting = {
                    callback: {
                        onClick: options.onClick,                      // 用于捕获节点被点击的事件回调函数
                        onCheck: options.onCheck,                      // 用于捕获 checkbox / radio 被勾选 或 取消勾选的事件回调函数
                        onDblClick: options.onDblClick                 // 用于捕获鼠标双击之后的事件回调函数
                    },
                    check: options.check,
                    view: options.view,
                    data: options.data
                };
                $.post(options.url, function(result) {
                    if (result.code == web_status.SUCCESS) {
                        var data=result.data;
                        var treeId = $("#treeId").val();
                        var tree = $.fn.zTree.init($("#" + options.id), setting, data);
                        $._tree = tree;
                        for (var i = 0; i < options.expandLevel; i++) {
                            var nodes = tree.getNodesByParam("level", i);
                            for (var j = 0; j < nodes.length; j++) {
                                tree.expandNode(nodes[j], true, false, false);
                            }
                        }

                        //选中默认
                        if($.common.isNotEmpty(treeId)){
                            var treeIdArr=treeId.split(',');
                            treeIdArr.forEach(function (item) {
                                if($.common.isNotEmpty(item)){
                                    var node = tree.getNodesByParam("id", item, null)[0];
                                    if(!options.check.enable){
                                        $._tree.selectNode(node, true);
                                    }
                                    $.tree.zOnClick('',options.id,node);
                                }
                            });
                        }

                        // 回调tree方法
                        if(typeof(options.callBack) === "function"){
                            options.callBack(tree);
                        }
                    } else if (result.code == web_status.WARNING) {
                        $.modal.alertWarning(result.msg)
                    } else {
                        $.modal.alertError(result.msg);
                    }
                    $.modal.closeLoading();

                });
            },
            // 搜索节点
            searchNode: function() {
                // 取得输入的关键字的值
                var value = $.common.trim($("#keyword").val());
                if ($.tree._lastValue == value) {
                    return;
                }

                // 保存最后一次搜索名称
                $.tree._lastValue = value;
                var nodes = $._tree.getNodes();

                // 如果要查空字串，就退出不查了。
                if (value == "") {
                    $.tree.showAllNode(nodes);
                    return;
                }
                $.tree.hideAllNode(nodes);
                // 根据搜索值模糊匹配
                $.tree.updateNodes($._tree.getNodesByParamFuzzy("name", value));
            },
            // 显示所有节点
            showAllNode: function(nodes) {
                nodes = $._tree.transformToArray(nodes);
                for (var i = nodes.length - 1; i >= 0; i--) {
                    if (nodes[i].getParentNode() != null) {
                        $._tree.expandNode(nodes[i], true, false, false, false);
                    } else {
                        $._tree.expandNode(nodes[i], true, true, false, false);
                    }
                    $._tree.showNode(nodes[i]);
                    $.tree.showAllNode(nodes[i].children);
                }
            },
            // 隐藏所有节点
            hideAllNode: function(nodes) {
                var tree = $.fn.zTree.getZTreeObj("tree");
                var nodes = $._tree.transformToArray(nodes);
                for (var i = nodes.length - 1; i >= 0; i--) {
                    $._tree.hideNode(nodes[i]);
                }
            },
            // 显示所有父节点
            showParent: function(treeNode) {
                var parentNode;
                while ((parentNode = treeNode.getParentNode()) != null) {
                    $._tree.showNode(parentNode);
                    $._tree.expandNode(parentNode, true, false, false);
                    treeNode = parentNode;
                }
            },
            // 显示所有孩子节点
            showChildren: function(treeNode) {
                if (treeNode.isParent) {
                    for (var idx in treeNode.children) {
                        var node = treeNode.children[idx];
                        $._tree.showNode(node);
                        $.tree.showChildren(node);
                    }
                }
            },
            // 更新节点状态
            updateNodes: function(nodeList) {
                $._tree.showNodes(nodeList);
                for (var i = 0, l = nodeList.length; i < l; i++) {
                    var treeNode = nodeList[i];
                    $.tree.showChildren(treeNode);
                    $.tree.showParent(treeNode)
                }
            },
            // 获取当前被勾选集合
            getCheckedNodes: function(column) {
                var _column = $.common.isEmpty(column) ? "id" : column;
                var nodes = $._tree.getCheckedNodes(true);
                return $.map(nodes, function (row) {
                    return row[_column];
                }).join();
            },
            // 不允许根父节点选择
            notAllowParents: function(_tree) {
                var nodes = _tree.getSelectedNodes();
                if(nodes.length == 0){
                    $.modal.msgError("请选择节点后提交");
                    return false;
                }
                for (var i = 0; i < nodes.length; i++) {
                    if (nodes[i].level == 0) {
                        $.modal.msgError("不能选择根节点（" + nodes[i].name + "）");
                        return false;
                    }
                    if (nodes[i].isParent) {
                        $.modal.msgError("不能选择父节点（" + nodes[i].name + "）");
                        return false;
                    }
                }
                return true;
            },
            // 不允许最后层级节点选择
            notAllowLastLevel: function(_tree) {
                var nodes = _tree.getSelectedNodes();
                for (var i = 0; i < nodes.length; i++) {
                    if (!nodes[i].isParent) {
                        $.modal.msgError("不能选择最后层级节点（" + nodes[i].name + "）");
                        return false;
                    }
                }
                return true;
            },
            // 隐藏/显示搜索栏
            toggleSearch: function() {
                $('#search').slideToggle(200);
                $('#btnShow').toggle();
                $('#btnHide').toggle();
                $('#keyword').focus();
            },
            // 折叠
            collapse: function() {
                $._tree.expandAll(false);
            },
            // 展开
            expand: function() {
                $._tree.expandAll(true);
            },
            zOnCheck:function(){
                var treeIdArr = [];
                var treeIdName = [];
                $._tree.getCheckedNodes().forEach(function (item) {
                    treeIdArr.push(item.id);
                    treeIdName.push(item.name);
                });
                $("#treeId").val(treeIdArr.join(','));
                $("#treeName").val(treeIdName.join(','));
            },
            showParentAllName(nodes,rearr){
                var showParentLevel = $.tree._option.showParentLevel;
                if(showParentLevel !== false){
                    if(nodes.level > showParentLevel){
                        var parentnode=nodes.getParentNode();
                        if(parentnode){
                            rearr.unshift(parentnode.name);
                            $.tree.showParentAllName(parentnode,rearr)
                        }
                    }
                }

            },
            zOnClick:function (event, ztreeId, treeNode) {
                if($.tree._option.check.enable){//多选
                    $._tree.checkNode(treeNode, !treeNode.checked, true);
                    $.tree.zOnCheck()
                }else{
                    //单选
                    var treeIdArr = [];
                    var treeIdName = [];
                    $._tree.getSelectedNodes().forEach(function (item) {
                        // var treeIdName=item.name
                        var parentName=[];
                        $.tree.showParentAllName(item,parentName);
                        parentName.push(item.name);
                        treeIdArr.push(item.id);
                        treeIdName.push(parentName.join('-'));
                    });
                    $("#treeId").val(treeIdArr.join(','));
                    $("#treeName").val(treeIdName.join(','));
                }

            }
        },
        // 通用方法封装处理
        common: {
            //通用连接处理
            processurl:function(url){
                switch (url) {
                    case 'reload':
                        window.location.reload();
                        break;
                    case 'preload':
                        parent.location.reload();
                        break;
                    case 'closeOpen':
                        $.modal.close();
                        break;
                }
            },
            //回调方法判断
            callBackOp(callback){
                if($.common.isNotEmpty(callback)){
                    if($.common.isFunction(callback)){
                        if(typeof callback ==='string'){
                            eval(callback+"()");
                        }else{
                            callback();
                        }
                    }else{
                        $.common.processurl(callback);
                    }
                }
            },
            // 判断字符串是否为空
            isEmpty: function (value) {
                if (value == null || this.trim(value) == "" || value==undefined) {
                    return true;
                }
                return false;
            },
            // 判断一个字符串是否为非空串
            isNotEmpty: function (value) {
                return !$.common.isEmpty(value);
            },
            // 空对象转字符串
            nullToStr: function(value) {
                if ($.common.isEmpty(value)) {
                    return "-";
                }
                return value;
            },
            // 是否显示数据 为空默认为显示
            visible: function (value) {
                if ($.common.isEmpty(value) || value == true) {
                    return true;
                }
                return false;
            },
            // 空格截取
            trim: function (value) {
                if (value == null) {
                    return "";
                }
                return value.toString().replace(/(^\s*)|(\s*$)|\r|\n/g, "");
            },
            // 比较两个字符串（大小写敏感）
            equals: function (str, that) {
                return str == that;
            },
            // 比较两个字符串（大小写不敏感）
            equalsIgnoreCase: function (str, that) {
                return String(str).toUpperCase() === String(that).toUpperCase();
            },
            // 将字符串按指定字符分割
            split: function (str, sep, maxLen) {
                if ($.common.isEmpty(str)) {
                    return null;
                }
                var value = String(str).split(sep);
                return maxLen ? value.slice(0, maxLen - 1) : value;
            },
            // 字符串格式化(%s )
            sprintf: function (str) {
                var args = arguments, flag = true, i = 1;
                str = str.replace(/%s/g, function () {
                    var arg = args[i++];
                    if (typeof arg === 'undefined') {
                        flag = false;
                        return '';
                    }
                    return arg == null ? '' : arg;
                });
                return flag ? str : '';
            },
            // 日期格式化 时间戳  -> yyyy-MM-dd HH-mm-ss
            dateFormat: function(date, format) {
                var that = this;
                if (that.isEmpty(date)) return "";
                if (!date) return;
                if (!format) format = "yyyy-MM-dd";
                switch (typeof date) {
                    case "string":
                        date = new Date(date.replace(/-/, "/"));
                        break;
                    case "number":
                        date = new Date(date);
                        break;
                }
                if (!date instanceof Date) return;
                var dict = {
                    "yyyy": date.getFullYear(),
                    "M": date.getMonth() + 1,
                    "d": date.getDate(),
                    "H": date.getHours(),
                    "m": date.getMinutes(),
                    "s": date.getSeconds(),
                    "MM": ("" + (date.getMonth() + 101)).substr(1),
                    "dd": ("" + (date.getDate() + 100)).substr(1),
                    "HH": ("" + (date.getHours() + 100)).substr(1),
                    "mm": ("" + (date.getMinutes() + 100)).substr(1),
                    "ss": ("" + (date.getSeconds() + 100)).substr(1)
                };
                return format.replace(/(yyyy|MM?|dd?|HH?|ss?|mm?)/g,
                    function() {
                        return dict[arguments[0]];
                    });
            },
            // 获取节点数据，支持多层级访问
            getItemField: function (item, field) {
                var value = item;
                if (typeof field !== 'string' || item.hasOwnProperty(field)) {
                    return item[field];
                }
                var props = field.split('.');
                for (var p in props) {
                    value = value && value[props[p]];
                }
                return value;
            },
            //获取随机字符串
            getrandomkey: function () {
                var  x="0123456789qwertyuioplkjhgfdsazxcvbnm";
                var  tmp="",tm1="";
                var timestamp = new Date().getTime();
                for(var  i=0;i<5;i++)  {
                    tmp  +=  x.charAt(Math.ceil(Math.random()*100000000)%x.length);
                }
                for(var  i=0;i<5;i++)  {
                    tm1  +=  x.charAt(Math.ceil(Math.random()*100000000)%x.length);
                }
                return  tm1+timestamp+tmp;
            },
            // 指定随机数返回
            random: function (min, max) {
                return Math.floor((Math.random() * max) + min);
            },
            // 判断字符串是否是以start开头
            startWith: function(value, start) {
                var reg = new RegExp("^" + start);
                return reg.test(value)
            },
            // 判断字符串是否是以end结尾
            endWith: function(value, end) {
                var reg = new RegExp(end + "$");
                return reg.test(value)
            },
            // 数组去重
            uniqueFn: function(array) {
                var result = [];
                var hashObj = {};
                for (var i = 0; i < array.length; i++) {
                    if (!hashObj[array[i]]) {
                        hashObj[array[i]] = true;
                        result.push(array[i]);
                    }
                }
                return result;
            },
            // 数组中的所有元素放入一个字符串
            join: function(array, separator) {
                if ($.common.isEmpty(array)) {
                    return null;
                }
                return array.join(separator);
            },
            // 获取form下所有的字段并转换为json对象
            formToJSON: function(formId) {
                var json = {};
                $.each($("#" + formId).serializeArray(), function(i, field) {
                    if(json[field.name]) {
                        json[field.name] += ("," + field.value);
                    } else {
                        json[field.name] = field.value;
                    }
                });
                return json;
            },
            // 数据字典转下拉框
            dictToSelect: function(datas, value, name) {
                var actions = [];
                actions.push($.common.sprintf("<select class='form-control' name='%s'>", name));
                $.each(datas, function(index, dict) {
                    actions.push($.common.sprintf("<option value='%s'", dict.dictValue));
                    if (dict.dictValue == ('' + value)) {
                        actions.push(' selected');
                    }
                    actions.push($.common.sprintf(">%s</option>", dict.dictLabel));
                });
                actions.push('</select>');
                return actions.join('');
            },
            // 获取obj对象长度
            getLength: function(obj) {
                var count = 0;
                for (var i in obj) {
                    if (obj.hasOwnProperty(i)) {
                        count++;
                    }
                }
                return count;
            },
            // 判断移动端
            isMobile: function () {
                return navigator.userAgent.match(/(Android|iPhone|SymbianOS|Windows Phone|iPad|iPod)/i);
            },
            //判断参数是否是函数
            isFunction:function (funcName) {
                if($.common.isEmpty(funcName)){
                    return  false;
                }
                try {
                    if (typeof(eval(funcName)) == "function") {
                        return true;
                    }
                } catch(e) {}
                return false;
            },
            //判断是否是数字
            isNumber:function(val){
                if (parseFloat(val).toString() == "NaN") {
                    return false;
                } else {
                    return true;
                }
            },
            // 数字正则表达式，只能为0-9数字
            numValid : function(text){
                var patten = new RegExp(/^[0-9]+$/);
                return patten.test(text);
            },
            // 英文正则表达式，只能为a-z和A-Z字母
            enValid : function(text){
                var patten = new RegExp(/^[a-zA-Z]+$/);
                return patten.test(text);
            },
            // 英文、数字正则表达式，必须包含（字母，数字）
            enNumValid : function(text){
                var patten = new RegExp(/^(?=.*[a-zA-Z]+)(?=.*[0-9]+)[a-zA-Z0-9]+$/);
                return patten.test(text);
            },
            // 英文、数字、特殊字符正则表达式，必须包含（字母，数字，特殊字符!@#$%^&*()-=_+）
            charValid : function(text){
                var patten = new RegExp(/^(?=.*[A-Za-z])(?=.*\d)(?=.*[~!@#\$%\^&\*\(\)\-=_\+])[A-Za-z\d~!@#\$%\^&\*\(\)\-=_\+]{6,}$/);
                return patten.test(text);
            },
        }
    });
})(jQuery);

$.modal.layerinit();
/** 表格类型 */
table_type = {
    bootstrapTable: 0,
    bootstrapTreeTable: 1
};

/** 消息状态码 */
web_status = {
    SUCCESS: 0,
    FAIL: 500,
    WARNING: 301
};

/** 弹窗状态码 */
modal_status = {
    SUCCESS: "success",
    FAIL: "error",
    WARNING: "warning"
};
