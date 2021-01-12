<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;


class WechatAccess extends BaseModel
{
    public $table='b5net_wechat_access';
    public $primaryKey='appid';
    public $keyType='string';
    public $incrementing=false;
    public $timestamps=false;
    protected $attributes=[
        'appid'=>'',
        'access_token'=>'',
        'jsapi_ticket'=>'',
        'access_token_add'=>0,
        'jsapi_ticket_add'=>0
    ];
}
