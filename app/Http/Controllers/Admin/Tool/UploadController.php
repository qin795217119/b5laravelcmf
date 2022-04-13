<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace App\Http\Controllers\Admin\Tool;

use App\Extends\Libs\AdminCommonAction;
use App\Models\Tool\Upload;

class UploadController extends Tool
{
    use AdminCommonAction;
    protected string $model = Upload::class;


}
