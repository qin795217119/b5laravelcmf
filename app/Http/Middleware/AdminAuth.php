<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
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
            //锁屏判断
            $islock=$this->checkLock();
            if($islock){
                if(IS_GET && !IS_AJAX){
                    return redirect('/admin/lockscreen');
                }else{
                    return response(message('锁屏中，无法此操作',false),200);
                }
            }
            //权限判断
            $hasPerms = $this->checkAuth($adminId);
            if(!$hasPerms){
                if(IS_GET && !IS_AJAX){
                    return redirect('/admin/noauth');
                }else{
                    return response(message('无权访问',false),200);
                }
            }
        }
        return $next($request);
    }

    /**
     * 判断锁屏
     * @return bool
     */
    public function checkLock(){
        $islock=session('islock');
        if(!$islock) return false;
        //节点标识
        $module_name = strtolower(MODULES_NAME);
        $controller_name = strtolower(CONTROLLER_NAME);
        $action_name = strtolower(ACTION_NAME);
        $permission = $module_name . ':' . $controller_name . ':' . $action_name;
        if($permission=='admin:common:lockscreen' || $permission=='admin:public:logout'){
            return false;
        }
        return true;
    }
    /**
     * 权限验证
     * @return bool
     */
    public function checkAuth($adminId)
    {
        if ($adminId==1) return true;
        //检测权限

        //节点标识
        $module_name = strtolower(MODULES_NAME);
        $controller_name = strtolower(CONTROLLER_NAME);
        $action_name = strtolower(ACTION_NAME);
        $permission = $module_name . ':' . $controller_name . ':' . $action_name;

        //不走授权的控制器及、方法及节点
        $notAuthController = ['public', 'common'];
        $notAuthAction = ['tree'];
        $notAuthPermission=['admin:index:index','admin:index:home'];
        if (in_array($controller_name, $notAuthController) || in_array($action_name, $notAuthAction) || in_array($permission,$notAuthPermission)) {
            return true;
        }

        //获取登录时的授权菜单Id
        $menuList = adminLoginInfo('menu');
        if (empty($menuList)) {
            return false;
        }

        //获取节点信息
        $menuInfo = (new MenuService())->info([['perms', '=', $permission]], true);
        //节点不存在或禁用
        if (!$menuInfo || !$menuInfo['status']) return false;

        if (in_array($menuInfo['id'], $menuList)) return true;
        return false;
    }
}
