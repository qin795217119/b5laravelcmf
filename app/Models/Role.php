<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
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

    public function menus(){
        return $this->belongsToMany(Menu::class,RoleMenu::class,'role_id','menu_id');
    }
}
