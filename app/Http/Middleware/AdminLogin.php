<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Middleware;

use App\Services\AdminRoleService;
use App\Services\AdminService;
use App\Services\AdminStructService;
use App\Services\RoleMenuService;
use Closure;
use Illuminate\Support\Facades\Cookie;

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
            if($this->auotLoginByCookie()){
                return $next($request);
            }
            if(IS_GET && !IS_AJAX){
                return redirect(adminUrl('login'));
            }else{
                return response(message('请先登录',false,[],101),200);
            }
        }else{
            return $next($request);
        }

    }

    public function auotLoginByCookie(){
        $userid=Cookie::get(config('app.admin_session').'_cookie');
        if(!$userid) return false;

        $userinfo=(new AdminService())->info($userid,true,false);
        if(empty($userinfo) || $userinfo['status']!=1){
            return false;
        }
        //获取管理员组织
        $structList=(new AdminStructService())->getListByAdmin($userinfo['id']);

        //获取管理员分组
        $roleList = (new AdminRoleService())->getListByAdmin($userinfo['id'], false, false);
        $roleName=[];
        $roleId=[];
        foreach ($roleList as $role){
            $roleId[]=$role['id'];
            $roleName[]=$role['name'];
        }
        //获取分组菜单权限ID
        $menuIdList = (new RoleMenuService())->getRoleMenuList($roleId);
        $sessionData=[
            'info'=>[
                'id'=>$userinfo['id'],
                'username'=>$userinfo['username'],
                'name'=>$userinfo['realname']
            ],
            'struct'=>$structList,
            'role'=>[
                'id'=>$roleId,
                'name'=>$roleName,
            ],
            'menu'=>$menuIdList
        ];
        app('session')->flush();
        app('session')->put(config('app.admin_session'),$sessionData);
        Cookie::queue(config('app.admin_session').'_cookie',$userinfo['id'],30*24*3600);
        return true;
    }
}
