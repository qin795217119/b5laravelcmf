<?php

namespace App\Http\Controllers\Admin;


use App\Services\AuthgroupService;
use Illuminate\Http\Request;

class AuthgroupController extends Backend
{

    /**
     * 构造方法
     * AdminController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new AuthgroupService();
    }

}
