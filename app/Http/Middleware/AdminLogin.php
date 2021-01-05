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
        if(!session('adminId') && !in_array($controller,$notLoginConArr)){
            return redirect('admin/login');
        }else{
            return $next($request);
        }

    }
}
