<?php
namespace App\Models;

/**
 * 字典分类
 * Class DictType
 * @package App\Models
 */
class DictType extends BaseModel
{
    protected $table = 'b5net_dict_type';
    protected $attributes=[
        'name'=>'',
        'value'=>'',
        'type'=>'',
        'is_default'=>0,
        'status'=>1,
        'listsort'=>0,
        'note'=>'',
    ];
}
