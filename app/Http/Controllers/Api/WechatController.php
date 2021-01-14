<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;

class WechatController extends ApiController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
}
