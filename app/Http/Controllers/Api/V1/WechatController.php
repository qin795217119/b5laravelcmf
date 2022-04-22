<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF [快捷通用基础开发管理平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace App\Http\Controllers\Api\V1;

use App\Extends\Helpers\WechatHelper;
use App\Extends\Libs\ApiTraitWechat;

class WechatController extends V1
{
    //注意在路由添加 getopenid和getwechatcode
    //也可以不引入该类，自己参照 ApiTraitWechat 写两个方法
    use ApiTraitWechat;


    public function back(){
        //前端访问链接 设置回调链接为当前
        //http://www.b5laravel.my/api/v1/wechat/getopenid?after_url=http%3A%2F%2Fwww.b5laravel.my%2Fapi%2Fv1%2Fwechat%2Fback
        var_dump($this->request->get('openid'));

        $share_sign = (new WechatHelper())->signPackage();
        var_dump($share_sign);
    }



}
