<?php

namespace App\Http\Controllers\Admin;


use App\Services\AdminRoleService;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Backend
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new RoleService();
    }

}
