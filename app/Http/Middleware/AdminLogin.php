<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Middleware;

use Closure;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $controller=strtolower(CONTROLLER_NAME);

        $notLoginConArr = ['public'];
        $adminId=adminLoginInfo('info.id');

        if(!$adminId && !in_array($controller,$notLoginConArr)){
            if(IS_GET && !IS_AJAX){
                return redirect(adminUrl('login'));
            }else{
                return response(message('请先登录',false,[],101),200);
            }
        }else{
            return $next($request);
        }

    }
}
