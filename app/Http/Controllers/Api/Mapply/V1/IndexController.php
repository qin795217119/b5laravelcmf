<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Api\Mapply\V1;


use App\Helpers\Util\WechatApi;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class IndexController extends ApiController
{
    public function index(Request $request){
        $signPackage=(new WechatApi())->signPackage($request->post('signurl',''));
        return message('操作成功',true,['info'=>$request->get('mapplyInfo'),'signpackage'=>$signPackage['data']]);
    }
}
