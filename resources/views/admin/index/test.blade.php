@extends('admin.public.layout')
@section('title', '主页')
@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li>
                        角色名称：<input type="text" name="roleName"/>
                    </li>
                    <li>
                        权限字符：<input type="text" name="roleKey"/>
                    </li>
                    <li>
                        角色状态：<select name="status">
                            <option value="">所有</option>
                            <option value="0">正常</option>
                            <option value="1">停用</option>
                        </select>
                    </li>
                    <li class="select-time">
                        <label>创建时间： </label>
                        <input type="text" class="time-input" id="startTime" placeholder="开始时间" name="params[beginTime]"/>
                        <span>-</span>
                        <input type="text" class="time-input" id="endTime" placeholder="结束时间" name="params[endTime]"/>
                    </li>
                    <li>
                        <a class="btn btn-primary btn-rounded btn-sm" onclick="$.table.search()"><i class="fa fa-search"></i>&nbsp;搜索</a>
                        <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset()"><i class="fa fa-refresh"></i>&nbsp;重置</a>
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <div class="btn-group-sm" id="toolbar" role="group">
        <a class="btn btn-success" onclick="$.operate.add()">
            <i class="fa fa-plus"></i> 新增
        </a>
        <a class="btn btn-primary single disabled" onclick="$.operate.edit()" >
            <i class="fa fa-edit"></i> 修改
        </a>
        <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll()">
            <i class="fa fa-remove"></i> 删除
        </a>
        <a class="btn btn-warning" onclick="$.table.exportExcel()">
            <i class="fa fa-download"></i> 导出
        </a>
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop
@section('script')
    <script>
        var prefix = ".";
        var editFlag = "";
        var removeFlag = "";
        $(function () {
            var options = {
                // url: prefix + "/findList",
                createUrl: prefix + "/add.html",
                updateUrl: prefix + "/update/{id}",
                removeUrl: prefix + "/delete",
                modalName: "角色",
                showSearch:false,
                sortName: "roleSort",
                columns: [{
                    checkbox: true
                },
                    {
                        field: 'roleId',
                        title: '角色编号'
                    },
                    {
                        field: 'roleName',
                        title: '角色名称',
                        sortable: true
                    },
                    {
                        field: 'roleKey',
                        title: '权限字符',
                        sortable: true
                    },
                    {
                        field: 'roleSort',
                        title: '显示顺序',
                        sortable: true
                    },
                    {
                        visible: editFlag == 'hidden' ? false : true,
                        title: '角色状态',
                        align: 'center',
                        formatter: function (value, row, index) {
                            return statusTools(row);
                        }
                    },
                    {
                        field: 'createTime',
                        title: '创建时间',
                        sortable: true
                    },
                    {
                        title: '操作',
                        align: 'center',
                        formatter: function(value, row, index) {
                            var actions = [];
                            actions.push('<a class="btn btn-success btn-xs ' + editFlag + '" href="javascript:void(0)" onclick="$.operate.edit(\'' + row.roleId + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                            actions.push('<a class="btn btn-danger btn-xs ' + removeFlag + '" href="javascript:void(0)" onclick="$.operate.remove(\'' + row.roleId + '\')"><i class="fa fa-remove"></i>删除</a> ');
                            var more = [];

                            more.push("<a class='btn btn-default btn-xs " + editFlag + "' href='javascript:void(0)' onclick='authDataScope(" + row.roleId + ")'><i class='fa fa-check-square-o'></i>数据权限</a> ");
                            more.push("<a class='btn btn-default btn-xs " + editFlag + "' href='javascript:void(0)' onclick='authUser(" + row.roleId + ")'><i class='fa fa-user'></i>分配用户</a>");
                            actions.push('<a tabindex="0" class="btn btn-info btn-xs" data-placement="left" data-toggle="popover" data-html="true" data-trigger="focus" data-container="body" data-content="' + more.join('') + '"><i class="fa fa-chevron-circle-right"></i>更多操作</a>');


                            return actions.join('');
                        }
                    }],
                data:[
                    {
                        admin: true,
                        createBy: null,
                        createTime: "2020-12-14 18:59:18",
                        dataScope: "1",
                        delFlag: "0",
                        deptIds: null,
                        flag: false,
                        menuIds: null,
                        params: {},
                        remark: "超级管理员",
                        roleId: 1,
                        roleKey: "admin",
                        roleName: "超级管理员",
                        roleSort: "1",
                        searchValue: null,
                        status: "0",
                        updateBy: null,
                        updateTime: null
                    },
                    {
                        admin: false,
                        createBy: null,
                        createTime: "2020-12-14 18:59:18",
                        dataScope: "2",
                        delFlag: "0",
                        deptIds: null,
                        flag: false,
                        menuIds: null,
                        params: {},
                        remark: "普通角色",
                        roleId: 2,
                        roleKey: "common",
                        roleName: "普通角色",
                        roleSort: "2",
                        searchValue: null,
                        status: "0",
                        updateBy: null,
                        updateTime: null,
                    }
                ]
            };
            $.table.init(options);
        });
        /* 角色状态显示 */
        function statusTools(row) {
            if (row.status == 1) {
                return '<i class=\"fa fa-toggle-off text-info fa-2x\" onclick="enable(\'' + row.roleId + '\')"></i> ';
            } else {
                return '<i class=\"fa fa-toggle-on text-info fa-2x\" onclick="disable(\'' + row.roleId + '\')"></i> ';
            }
        }
    </script>
@stop
