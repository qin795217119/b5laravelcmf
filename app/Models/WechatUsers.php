<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;


class WechatUsers extends BaseModel
{
    public $table='b5net_wechat_users';

    protected $attributes=[
        'openid'=>'',
        'appid'=>'',
        'nickname'=>'',
        'headimg'=>'',
        'city'=>'',
        'country'=>'',
        'province'=>'',
        'status'=>0,
        'sex'=>0
    ];
}
