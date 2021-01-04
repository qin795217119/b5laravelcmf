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
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new Role());
        $loadValidate && $this->setValidate(new RoleValidate());
    }



}
