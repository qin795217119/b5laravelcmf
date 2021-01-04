<?php

namespace App\Http\Controllers\Admin;

use App\Services\AdminService;
use App\Services\RoleService;
use Illuminate\Http\Request;

/**
 * 人员管理控制器
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Backend
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new AdminService();
        IS_GET && !IS_AJAX && view()->share('rolelist',(new RoleService())->getAll([],['id','name'],[],'id,name',[['listsort','asc'],['id','asc']]));
    }
}
