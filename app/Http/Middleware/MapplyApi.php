<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Middleware;

use App\Cache\MapplyCache;
use App\Helpers\Util\ValidateApi;
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
        if(!$token){
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
