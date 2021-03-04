<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Validates;

class WebPosValidate extends ValidateBase
{
    public function rules()
    {
        return [
            'title' => 'required|min:2|max:50',
            'website' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'title' => '位置名称',
            'website' => '所属站点'
        ];
    }
}
