<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Extends\Middleware;

use App\Extends\Helpers\Admin\LoginAuth;
use App\Extends\Helpers\Result;
use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $controller = strtolower($request->get('controller'));
        $action = strtolower($request->get('action'));
        $group = strtolower($request->get('group'));

        //锁屏判断
        $islock=session()->get('islock');
        $lockPerms = ['common:lockscreen','public:logout'];
        if($islock && !in_array($controller.':'.$action,$lockPerms)){
            if($request->isMethod('POST') || $request->ajax()){
                return Result::error('锁屏中，无法此操作');
            }else{
                return  redirect(route('admin.lockscreen'));
            }
        }

        //权限判断
        $hasPower = LoginAuth::checkPower($group,$controller,$action);
        if(!$hasPower){
            if($request->isMethod('POST') || $request->ajax()){
                return Result::error('无权访问');
            }else{
                return  redirect(route('error',['msg'=>'无权访问','code'=>500]));
            }
        }
        return $next($request);
    }

}
