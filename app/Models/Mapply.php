<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;

/**
 * 微信预约报名活动表
 * Class Mapply
 * @package App\Models
 */
class Mapply extends BaseModel
{
    protected $table = 'b5net_mapply';
    protected $attributes=[
        'title'=>'',
        'banner'=>'',
        'share_title'=>'',
        'share_desc'=>'',
        'share_img'=>'',
        'money'=>0,
        'rules'=>'',
        'agreement'=>'',
        'themecolor'=>'',
        'status'=>1,
        'is_multi'=>0,
        'com_name'=>'',
        'com_address'=>'',
        'com_phone'=>'',
        'com_lat'=>0,
        'com_lng'=>0,
        'regfield'=>''
    ];
}
