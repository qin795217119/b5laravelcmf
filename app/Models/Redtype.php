<?php
namespace App\Models;

/**
 * 跳转管理
 * Class DictType
 * @package App\Models
 */
class Redtype extends BaseModel
{
    protected $table = 'b5net_redtype';
    protected $attributes=[
        'title'=>'',
        'type'=>'',
        'redkey'=>'',
        'list_url'=>'',
        'info_url'=>'',
        'note'=>'',
        'status'=>1
    ];
}
