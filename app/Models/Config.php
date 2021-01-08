<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;

/**
 * 系统配置
 * Class Config
 * @package App\Models
 */
class Config extends BaseModel
{
    protected $table = 'b5net_config';
    protected $attributes=[
        'title'=>'',
        'type'=>'',
        'style'=>'text',
        'groups'=>'',
        'extra'=>'',
        'value'=>'',
        'listsort'=>0,
        'is_sys'=>0,
        'note'=>'',
    ];
}
