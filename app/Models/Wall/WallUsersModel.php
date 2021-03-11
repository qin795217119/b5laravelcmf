<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models\Wall;

use App\Models\BaseModel;

class WallUsersModel extends BaseModel
{
    protected $table = 'b5net_wall_users';
    protected $attributes=[
        'nickname'=>'',
        'headimg'=>'',
        'truename'=>'',
        'mobile'=>'',
        'sex'=>0,
        'status'=>1,
    ];
}
