<?php

namespace App\Http\Controllers\Admin;

use App\Services\AdminService;
use Illuminate\Http\Request;

/**
 * 公共操作控制器
 * Class PublicController
 * @package App\Http\Controllers\Admin
 */
class PublicController extends Backend
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function login(){
        if(IS_POST){
            return (new AdminService())->login();
        }
        return $this->render();
    }

    public function logout(){
        return (new AdminService())->logout();
    }
}