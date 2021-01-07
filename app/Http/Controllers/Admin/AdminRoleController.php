<?php

namespace App\Http\Controllers\Admin;

use App\Services\AdminRoleService;
use Illuminate\Http\Request;

/**
 * 人员和权限分组控制器
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminRoleController extends Backend
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new AdminRoleService();
        IS_GET && !IS_AJAX && view()->share('role_id',intval(request()->input('role_id')));
    }

    public function tree(){
        return $this->service->getList(false);
    }
}
