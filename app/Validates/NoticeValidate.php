<?php

namespace App\Validates;


class NoticeValidate extends ValidateBase
{
    public function rules()
    {
        return [
            'title' => 'required|min:2|max:150',
            'type' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'title' => '公告标题',
            'type' => '公告类型'
        ];
    }
}
