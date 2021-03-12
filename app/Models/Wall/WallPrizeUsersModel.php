<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models\Wall;

use App\Models\BaseModel;

class WallPrizeUsersModel extends BaseModel
{
    protected $table = 'b5net_wall_prize_users';
    protected $attributes=[
        'nickname'=>'',
        'truename'=>'',
        'headimg'=>'',
        'mobile'=>'',
        'getcode'=>'',
    ];
}
