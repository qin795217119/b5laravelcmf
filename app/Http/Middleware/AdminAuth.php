<?php

namespace App\Http\Middleware;

use App\Services\MenuService;
use Closure;

class AdminAuth
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
        $adminId = adminLoginInfo('info.id');
        if($adminId){
            $hasPerms = $this->checkAuth($adminId);
            if(!$hasPerms){
                if(IS_GET && !IS_AJAX){
                    return redirect('/admin/noauth');
                }else{
                    return message('无权访问',false);
                }
            }
        }
        return $next($request);
    }

    /**
     * 权限验证
     * @return bool
     */
    public function checkAuth($adminId)
    {
        if ($adminId==1) return true;

        //检测权限
        $module_name = strtolower(MODULES_NAME);
        $controller_name = strtolower(CONTROLLER_NAME);
        $action_name = strtolower(ACTION_NAME);

        //不走授权的控制器及方法
        $notAuthController = ['public', 'common'];
        $notAuthAction = ['tree'];
        if (in_array($controller_name, $notAuthController) || in_array($action_name, $notAuthAction)) {
            return true;
        }

        //获取登录时的授权菜单Id
        $menuList = adminLoginInfo('menu');
        if (empty($menuList)) {
            return false;
        }
        //节点标识
        $permission = $module_name . ':' . $controller_name . ':' . $action_name;
        //获取节点信息
        $menuInfo = (new MenuService())->info([['perms', '=', $permission]], true);
        //节点不存在或禁用
        if (!$menuInfo || !$menuInfo['status']) return false;

        if (in_array($menuInfo['id'], $menuList)) return true;
        return false;
    }
}
