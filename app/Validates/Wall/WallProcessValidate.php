<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Validates\Wall;

use App\Validates\ValidateBase;

class WallProcessValidate extends ValidateBase
{
    public function rules()
    {
        return [
            'wall_id' => 'required',
            'daytime' => 'required|date_format:Y-m-d',
            'title' => 'required|min:2|max:90'
        ];
    }

    public function attributes()
    {
        return [
            'wall_id' => '所属活动',
            'daytime' => '日程日期',
            'title' => '日程标题'
        ];
    }
}
