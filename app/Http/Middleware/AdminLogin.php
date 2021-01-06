<?php

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
                return redirect('/admin/login');
            }else{
                return message('请先登录',false,[],101);
            }
        }else{
            return $next($request);
        }

    }
}
