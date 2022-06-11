<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Extends\Middleware;

use App\Extends\Helpers\Result;
use App\Extends\Libs\ApiTraitToken;
use Closure;
use Illuminate\Http\Request;

/**
 * 判断token的过滤器
 */
class ApiToken
{
    use ApiTraitToken;

    /**
     * 平台类型
     * @var string
     */
    public string $type = '';

    /**
     * 接口登录参数
     * @var string
     */
    public string $key = 'token';

    /**
     * @param Request $request
     * @param Closure $next
     * @param string $type 平台类型 例如 app和h5两个登录不影响彼此
     * @param string $key 验证字段 默认token
     * @param bool $noLogin 是否允许未登录，true时未登录不会直接返回未登录，需自己根据__token进行判断，主要用于某个控制器中登录或者未登录都可以进行的操作
     * @return mixed
     */
    public function handle(Request $request, Closure $next,string $type='',string $key='',bool $noLogin = false): mixed{
        $key = $key?:'token';
        $token = $request->input($key, '');
        $token_record = $this->getToken($token,$type);
        if (!$token_record && !$noLogin) {
            if($request->isMethod('POST') || $request->ajax()){
                return Result::error('登录失效，请重新登录',305);
            }else{
                return  redirect(route('error',['msg'=>'登录失效，请重新登录','code'=>305]));
            }
        }
        //将token信息传递
        $request->attributes->add(['__token'=>$token_record]);
        return $next($request);
    }
}
