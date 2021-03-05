<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Validates;


use App\Services\WebCatService;

class WebCatValidate extends ValidateBase
{
    public function rules()
    {
        return [
            'title' => 'required|min:2|max:50',
            'name' => 'required|min:2|max:50',
            'website' => 'required',
            'type' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'title' => '菜单标题',
            'name' => '菜单名称',
            'website' => '所属站点',
            'type' => '菜单类型'
        ];
    }
}
