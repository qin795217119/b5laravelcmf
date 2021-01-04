<?php
namespace App\Models;

/**
 * 权限分组
 * Class Role
 * @package App\Models
 */
class Role extends BaseModel
{
    protected $table = 'b5net_role';
    protected $attributes=[
        'name'=>'',
        'rolekey'=>'',
        'listsort'=>0,
        'note'=>'',
        'permission'=>'',
        'status'=>1
    ];
}
