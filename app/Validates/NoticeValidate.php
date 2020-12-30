<?php

namespace App\Validates;


class NoticeValidate extends ValidateBase
{
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:30',
            'rolekey' => 'required|min:3|max:30|alpha_num'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '角色名称',
            'roleky' => '角色标识'
        ];
    }
}
