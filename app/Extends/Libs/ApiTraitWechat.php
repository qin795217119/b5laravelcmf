<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Extends\Libs;

use App\Extends\Helpers\Functions;
use App\Extends\Helpers\Result;
use App\Extends\Helpers\WechatHelper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Request;

/**
 * 微信授权通用方法
 * 需要根据自己实际业务进行修改
 * 或者自己根据调用方法移动到controller中
 */
trait ApiTraitWechat
{

    /**
     * 前端需要调用授权方法，需要直接跳转到该连接
     * @return Application|RedirectResponse|Redirector
     */
    public function getopenid(): Redirector|Application|RedirectResponse
    {

        //授权后的跳转地址，由前端决定
        $after_url=$this->request->input('after_url','');

        //对地址进行处理，防止传递过程中出错
        $after_url=$after_url?str_replace('=','#',base64_encode($after_url)):'';

        $current = url()->current();

        //跳转到当前的授权地址
        //mytype 可以用来区分不同的应用，也可以不穿
        $auth_url = str_replace('getopenid','getwechatcode',$current);
        $auth_url = Functions::urlContact($auth_url,'after_url='.$after_url.'&mytype=all');

        return (new WechatHelper())->getOpenId($auth_url);
    }

    /**
     * 微信授权后回调的连接，由上面的方法决定
     * @return JsonResponse|Redirector|RedirectResponse|Application
     */
    public function getwechatcode(): JsonResponse|Redirector|RedirectResponse|Application
    {
        $result = (new WechatHelper())->getUserInfo();
        if(!$result['success']){
            return Result::response($result);
        }
        //$mtype = $result['data']['mtype'];

        $openid = $result['data']['openid'];

        //如果获取用户
        //$userInfo = $result['data']['userInfo'];

        $after_url = Request::input('after_url','');
        $after_url=base64_decode(str_replace('#','=',$after_url));


        //在需要返回的url后面拼接open_id用户进行存储
        //或者在这里进行加密token处理
        $after_url=Functions::urlContact($after_url,'openid='.$openid);

        return redirect($after_url);
    }
}
