<?php
namespace App\Models;

/**
 * 字典数据
 * Class DictData
 * @package App\Models
 */
class DictData extends BaseModel
{
    protected $table = 'b5net_dict_data';
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
