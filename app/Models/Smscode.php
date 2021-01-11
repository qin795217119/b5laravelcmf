<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;

/**
 * 短信验证码
 * Class Smscode
 * @package App\Models
 */
class Smscode extends BaseModel
{
    protected $table = 'b5net_smscode';
    protected $attributes=[
        'mobile'=>'',
        'code'=>'',
        'type'=>0,
        'os'=>'',
        'status'=>0
    ];
}
