<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;

/**
 * 管理员
 * Class Admin
 * @package App\Models
 */
class Admin extends BaseModel
{
    protected $table='b5net_admin';

    protected $attributes=[
        'username'=>'',
        'realname'=>'',
        'password'=>'',
        'group_id'=>0,
        'status'=>1,
        'note'=>'',
    ];

    public function role()
    {
        return $this->hasOne(AdminRole::class,'admin_id');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class,AdminRole::class,'admin_id','role_id');
    }
    public function structs()
    {
        return $this->belongsToMany(Struct::class,AdminStruct::class,'admin_id','struct_id');
    }
}
