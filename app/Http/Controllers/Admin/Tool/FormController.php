<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF [快捷通用基础开发管理平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace App\Http\Controllers\Admin\Tool;

use Illuminate\Contracts\View\View;

class FormController extends Tool
{
    /**
     * 表单构建
     * @return View
     */
    public function build(): View
    {
        return $this->render();
    }
}
