<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Middleware;

use App\Helpers\Util\WechatApi;
use App\Services\Wall\WallService;
use App\Services\WechatUsersService;
use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class WallWap
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
        //所有请求都要带有wall_id

        //判断是否有wall_id和活动信息正确性
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
//        setWapOpenId('oBi_at-f8RORVDzNs-DY42Gx2Z5Y');
        //判断是否授权获取信息
        $openId=getWapOpenId();
        $mtype='wall_'.$wall_id;
        if($openId){
            $wechatInfo=(new WechatUsersService())->info([['openid','=',$openId],['type','=',$mtype]]);
            if(!$wechatInfo){
                $openId='';
                dropWapOpenId();
            }
        }
        if(!$openId){
            if(IS_GET && !IS_AJAX){
                //统一手机端微信授权方法
                $url=URL::route('wap_wxauthinfo',['mtype'=>$mtype,'b5reduri'=>URL::full()]);
                return (new WechatApi())->getOpenId($url);

            }else{
                return response(message('请先登录',false,[],101),200);
            }
        }
        $request->attributes->add(['wechatInfo'=>$wechatInfo]);
        $request->attributes->add(['wallInfo'=>$wallInfo]);
        if(IS_GET && !IS_AJAX){
            view()->share('wallInfo',$wallInfo);
            view()->share('wechatInfo',$wechatInfo);
        }
        return $next($request);
    }


}
