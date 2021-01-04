<?php
namespace App\Models;

/**
 * 通知公告
 * Class DictData
 * @package App\Models
 */
class Notice extends BaseModel
{
    protected $table = 'b5net_notice';
    protected $attributes=[
        'title'=>'',
        'type'=>'',
        'content'=>'',
        'textarea'=>'',
        'status'=>1,
        'listsort'=>99,
    ];
}
