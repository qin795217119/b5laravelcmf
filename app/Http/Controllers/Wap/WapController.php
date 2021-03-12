<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Wap;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class WapController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * 跳转错误页
     * @param string $msg
     * @param int $code
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function error($msg='哎呦，您访问的页面不存在(⋟﹏⋞)',$code=400){
        return view("wap.error", ['msg'=>$msg,'code'=>$code]);
    }
    /**
     * 渲染模板
     * @param string $view
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render($view = "", $data = [])
    {
        return view("wap.". strtolower($view), $data);
    }
}
