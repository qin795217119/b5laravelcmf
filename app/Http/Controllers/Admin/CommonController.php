<?php

namespace App\Http\Controllers\Admin;

/**
 * 公共操作控制器
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class CommonController extends Backend
{

    public function uploadimg(){
        $path = request()->file('file')->store('avatars');

        return message('成功',true,['path'=>'/uploads/'.$path]);
    }
}
