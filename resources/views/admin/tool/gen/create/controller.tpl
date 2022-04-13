<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace App\Http\Controllers\Admin{$dir};

use App\Extends\Libs\AdminCommonAction;
use App\Models{$dir}\{$model};

class {$controller}Controller extends {$base}
{
    use AdminCommonAction;
    protected string $model = {$model}::class;


}
