<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models\Tool;

use App\Extends\Libs\AdminBaseModel;

class Upload
{
    use AdminBaseModel;

    protected $table = 'demo_media';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    protected $fillable = ['id','img','imgs','crop','video','file','files','create_time','update_time'];
}
