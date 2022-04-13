<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Extends\Validates\System;

use App\Extends\Libs\BaseValidate;

class StructValidate extends BaseValidate
{

    public function rules():array
    {
        return [
            'name' => 'required|min:2|max:30',
            'listsort' => 'integer'
        ];
    }

    public function attributes():array
    {
        return [
            'name' => '组织名称',
            'listsort' => '显示顺序'
        ];
    }

}
