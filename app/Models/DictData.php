<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
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
        'status'=>1,
        'listsort'=>0,
        'note'=>'',
    ];
}
