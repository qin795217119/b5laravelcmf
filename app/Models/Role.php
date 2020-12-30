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

    /**
     * 根据权限字符查询角色
     * @param $roleKey
     * @return mixed
     */
    public function getRoleByKey($roleKey)
    {
        return parent::info([['rolekey','=',$roleKey]]);
    }
    /**
     * 获取分组列表用于选择
     * @return array
     */
    public function getSelectList(){
        $result= $this->where('status',1)->select('id','name')->orderBy('listsort','asc')->get();

        return $result ? $result->toArray() : [];
    }
}
