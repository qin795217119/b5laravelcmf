<?php

namespace App\Services;

use App\Models\Role;
use App\Validates\RoleValidate;


/**
 * 权限分组管理
 * Class RoleService
 * @package App\Services
 */
class RoleService extends BaseService
{
    /**
     * 构造方法
     */
    public function __construct()
    {
        $this->setModel(new Role());
        $this->setValidate(new RoleValidate());
    }


    /**
     * 获取分组列表
     * @param bool $isKeyVal
     * @return mixed
     */
    public function getSelectList($isKeyVal = false)
    {
        $result = $this->model->getSelectList();
        if ($isKeyVal && $result) {
            $result=collect($result);
            $result=$result->keyBy('id');
            $result= $result->all();
        }
        return $result;
    }
}
