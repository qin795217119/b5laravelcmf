<?php

namespace App\Http\Controllers\Admin;

use App\Services\AdminService;
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
    }
}
