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
use App\Extends\Services\System\AdminLoginService;
use Closure;
use Illuminate\Http\Request;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        //不需要登录的控制器
        $controller = strtolower($request->get('controller'));
        $noLogin = ['public'];
        if (in_array($controller, $noLogin)) {
            return $next($request);
        }
        //是否登录
        $loginInfo = LoginAuth::adminLoginInfo();
        if ($loginInfo) {
            return $next($request);
        }

        //判断cookie
        if ($this->autoLoginByCookie()) {
            return $next($request);
        }

        //跳转登录
        if (!$request->ajax() && $request->isMethod('GET')) {
            return redirect(route('admin.login'));
        } else {
            return Result::error('请先登录',101);
        }

    }

    /**
     * 判断cookie是否存在并登录
     * @return bool
     */
    public function autoLoginByCookie(): bool
    {
        $userid = \Illuminate\Support\Facades\Cookie::get(config('app.admin_login_cookie'));
        if(!$userid) return false;
        $userinfo = (new AdminLoginService())->loginSession($userid);
        if (!$userinfo) {
            return false;
        }
        return true;
    }
}
