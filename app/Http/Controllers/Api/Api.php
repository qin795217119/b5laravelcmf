<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Http\Controllers\Api;

use App\Extends\Libs\BaseController;

class Api extends BaseController
{
    protected string $module = 'api';

    public function __initialize(): void
    {
        parent::__initialize();
    }
}
