<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Extends\Validates\System;

use App\Extends\Libs\BaseValidate;
use App\Models\System\Menu;
use Illuminate\Validation\Rule;

class MenuValidate extends BaseValidate
{
    public function rules():array
    {
        return [
            'name' => 'required|min:2|max:30',
            'perms'=>[
                'required',
                Rule::unique(Menu::tableName())->where(function($query){
                    if(isset($this->data['id'])){
                        return $query->where('id','<>',$this->data['id']);
                    }
                    return $query;
                })
            ],
            'listsort' => 'integer'
        ];
    }

    public function attributes():array
    {
        return [
            'name' => '菜单名称',
            'perms' => '权限标识',
            'listsort' => '显示顺序'
        ];
    }
}
