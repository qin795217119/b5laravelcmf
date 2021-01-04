<?php

namespace App\Models;

/**
 * 管理员权限分组表
 * Class Admin
 * @package App\Models
 */
class AdminRole extends BaseModel
{
    protected $table='b5net_admin_role';

    public $timestamps=false;


    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }

}
