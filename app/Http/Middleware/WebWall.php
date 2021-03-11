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
use App\Services\Wall\WallService;
use Closure;
use Illuminate\Support\Facades\Cookie;

class WebWall
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
        $error='';
        $wall_id=intval(request()->input('wall_id',0));

        if($wall_id>0){
            $wallInfo=(new WallService())->info($wall_id);
            if($wallInfo){
                if(!$wallInfo['status']) $error='活动已关闭或未开启';
            }else{
                $error='活动信息不存在';
            }
        }else{
            $error='参数错误';
        }

        if($error){
            if(IS_GET && !IS_AJAX){
                return redirect('/error?msg='.$error);
            }else{
                return response(message($error,false),200);
            }
        }

        $isLogin=session('wall_pc_login');
        if(!$isLogin && strtolower(ACTION_NAME)!='login'){
            if(IS_GET && !IS_AJAX){
                return redirect('/wall/login?wall_id='.$wall_id);
            }else{
                return response(message('请先登录',false,[],101),200);
            }
        }
        $request->attributes->add(['wallInfo'=>$wallInfo]);
        if(IS_GET && !IS_AJAX){
            view()->share('wallInfo',$wallInfo);
        }
        return $next($request);
    }


}
