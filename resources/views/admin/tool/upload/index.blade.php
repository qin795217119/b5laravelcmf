@extends('admin.layout.layout')

@include('widget.asset.viewer')

@section('content')
    <div class="col-sm-12 search-collapse">
        <form id="role-form">
            <div class="select-list">
                <ul>
                    <li class="select-time">
                        <label>创建时间： </label>
                        <input type="text" name="between[create_time][start]" id="startTime" placeholder="开始时间" readonly>
                        <span>-</span>
                        <input type="text" name="between[create_time][end]" id="endTime" placeholder="结束时间" readonly>
                    </li>
                    <li>
                        <a class="btn btn-primary btn-rounded btn-sm" onclick="$.table.search()"><i class="fa fa-search"></i> 搜索</a>
                        <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset()"><i class="fa fa-refresh"></i> 重置</a>
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <div class="btn-group-sm" id="toolbar" role="group">
        <a class="btn btn-success" onclick="$.operate.addTab()"><i class="fa fa-plus"></i> 新增</a>
        <a class="btn btn-primary single disabled" onclick="$.operate.edit('',this)"><i class="fa fa-edit"></i> 修改</a>
        <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll(this)"><i class="fa fa-trash"></i> 批量删除</a>
    </div>
    <div class="col-sm-12 select-table table-striped">
        <table id="bootstrap-table"></table>
    </div>
@stop

@section('script')
    <script>
        $(function () {
            var options = {
                modalName: "上传",
                sortName:'id',
                sortOrder: "desc",
                columns: [
                    {checkbox: true},
                    {field: 'id', title: 'ID',  sortable: true,visible:false},
                    {
                        title: '序号',
                        align: "center",
                        formatter: function (value, row, index) {
                            return $.table.serialNumber(index);
                        }
                    },
                    {
                        field: 'img',
                        title: '单图片',
                        formatter: function (value, row, index) {
                            return $.table.imageView(row,'img');
                        }
                    },
                    {
                        field: 'imgs',
                        title: '多图片',
                        formatter: function (value, row, index) {
                            return $.table.imageView(row,'imgs');
                        }
                    },
                    {
                        field: 'crop',
                        title: '裁剪图片',
                        formatter: function (value, row, index) {
                            return $.table.imageView(row,'crop');
                        }
                    },
                    {
                        title: '视频链接',
                        field: 'video',
                        align: 'center',
                        formatter: function (value, row, index) {
                            return $.table.tooltip(value,20,'link');
                        }
                    },
                    {
                        title: '单文件',
                        field: 'file',
                        align: 'center',
                        formatter: function (value, row, index) {
                            return $.table.tooltip(value,20,'copy');
                        }
                    },
                    {
                        title: '多文件',
                        field: 'files',
                        align: 'center',
                        formatter: function (value, row, index) {
                            return $.table.tooltip(value,20,'open');
                        }
                    },
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true},
                    {field: 'update_time', title: '更新时间', align: 'center', visible: false},
                    {
                        title: '操作',
                        align: 'center',
                        formatter: function(value, row, index) {
                            var actions = [];
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:;" onclick="$.operate.editFull(\'' + row.id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                            actions.push('<a class="btn btn-danger btn-xs" href="javascript:;" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-remove"></i>删除</a> ');
                            return actions.join('');
                        }
                    }
                ],
            };
            $.table.init(options);
        });
    </script>
@stop

