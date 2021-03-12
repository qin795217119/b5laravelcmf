<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Wap;

use App\Helpers\Util\WechatApi;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class WechatController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function wxinfo(Request $request){
        $res=(new WechatApi())->authInfo();
        if($res){
            if($res['success']){
                setWapOpenId($res['data']['openid']);
                return redirect($res['data']['url']);
            }else{
                return redirect(URL::route('error',['msg'=>$res['msg']]));
            }
        }
        return redirect(URL::route('error',['msg'=>'授权错误']));
    }
}
