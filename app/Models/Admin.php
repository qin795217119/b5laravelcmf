<?php

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

    /**
     * 根据用户名查询信息
     * @param $username
     * @return mixed
     */
    public function getUserByName($username)
    {
        return parent::info([['username','=',$username]]);
    }
}
