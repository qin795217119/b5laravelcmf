<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;

/**
 * 组织架构
 * Class Menu
 * @package App\Models
 */
class Struct extends BaseModel
{
    protected $table = 'b5net_struct';
    protected $attributes=[
        'name'=>'',
        'parent_id'=>100,
        'levels'=>'',
        'listsort'=>0,
        'status'=>1,
        'leader'=>'',
        'phone'=>'',
        'note'=>''
    ];
}
