<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models\System;

use App\Extends\Libs\AdminBaseModel;

class Role
{
    use AdminBaseModel;

    protected $table = 'b5net_role';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    protected $fillable = ['id', 'name', 'rolekey', 'listsort', 'data_scope', 'status', 'note', 'create_time', 'update_time'];
}
