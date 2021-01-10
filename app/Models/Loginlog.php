<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;

/**
 * 登录日志
 * Class Loginlog
 * @package App\Models
 */
class Loginlog extends BaseModel
{
    protected $table = 'b5net_loginlog';
    public $timestamps = false;
    protected $attributes=[
        'login_name'=>'',
        'ipaddr'=>'',
        'login_location'=>'',
        'browser'=>'',
        'os'=>'',
        'net'=>'',
        'status'=>'0',
        'msg'=>'',
        'login_time'=>''
    ];
}
