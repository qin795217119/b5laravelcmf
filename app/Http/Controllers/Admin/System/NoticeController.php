<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace App\Http\Controllers\Admin\System;

use App\Extends\Libs\AdminCommonAction;
use App\Models\System\Notice;

class NoticeController extends System
{
    use AdminCommonAction;
    protected string $model = Notice::class;


    protected function indexBefore(array $params): array
    {
        $params['field'] = ['id','title','status','create_time'];
        return $params;
    }
}
