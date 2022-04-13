<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Extends\Validates\System;

use App\Extends\Libs\BaseValidate;
use App\Models\System\Config;
use Illuminate\Validation\Rule;

class ConfigValidate extends BaseValidate
{

    protected function rules(): array
    {
        return [
            'title' => 'required|min:2|max:50',
            'type' => [
                'required',
                'min:3',
                'max:50',
                'alpha_dash',
                Rule::unique(Config::tableName())->where(function($query){
                    if(isset($this->data['id'])){
                        return $query->where('id','<>',$this->data['id']);
                    }
                })
            ],
            'style' => 'required'
        ];
    }


    protected function attributes():array
    {
        return [
            'title' => '配置标题',
            'type' => '配置标识',
            'style' => '配置类型'
        ];
    }

}
