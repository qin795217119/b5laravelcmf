<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Middleware;

use App\Cache\MapplyCache;
use App\Helpers\Util\ValidateApi;
use App\Services\WechatUsersService;
use Closure;
use Illuminate\Support\Arr;

class MapplyApi
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
        $mapply_id=trim(request()->input('actid',0));
        $token=trim(request()->input('token',''));
        if(!$mapply_id || !ValidateApi::isInteger($mapply_id) || $mapply_id<1){
            return response(message('活动参数错误',false,[],400),200);
        }
        if($token){
            $wechatInfo=(new WechatUsersService())->info([['openid','=',$token],['type','=','mapply_'.$mapply_id]]);
            if(!$wechatInfo){
                return response(message('授权信息错误',false,[],305),200);
            }
        }
        if(!$token && !in_array(ACTION_NAME,['wxauth','wxinfo'])){
            return response(message('',false,[],305),200);
        }
        $mapplyInfo=MapplyCache::get($mapply_id);
        if (!$mapplyInfo || !$mapplyInfo['status']){
            return response(message('活动信息不存在',false,[],400),200);
        }
        $request->attributes->add(['mapplyInfo'=>$mapplyInfo]);
        $request->attributes->add(['token'=>$token]);
        return $next($request);
    }
}
