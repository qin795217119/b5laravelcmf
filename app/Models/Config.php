<?php
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
        'style'=>0,
        'groups'=>'',
        'extra'=>'',
        'value'=>'',
        'listsort'=>0,
        'is_sys'=>0,
        'note'=>'',
    ];
    public $styleList=[
        0=>'文本',
        1=>'数组',
        2=>'枚举'
    ];
}
