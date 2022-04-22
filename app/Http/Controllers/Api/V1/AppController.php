<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF [快捷通用基础开发管理平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace App\Http\Controllers\Api\V1;

use App\Extends\Libs\ApiTraitToken;
use Illuminate\Http\Request;

/**
 * 示例方法
 * Class AppController
 * @package App\Http\Controllers\Api\V1
 */
class AppController extends V1
{
    use ApiTraitToken;
    public function __construct(Request $request)
    {
        parent::__construct($request);
        //使用授权中间件api.token
        //app,token为传递给中间件的参数
        //except login方法不走中间件
        $this->middleware('api.token:app,token')->except('login');
    }

    //示例获取通过token获取的token表对应信息
    public function index(){
        var_dump($this->request->get('__token'));die;

//        array(4) {
//            ["token"]=>
//              string(32) "804e919a041bb63d99aff25545671487"
//            ["type"]=>
//              string(3) "app"
//            ["user_id"]=>
//              int(122)
//            ["exp_time"]=>
//              int(1651199565)
//        }

    }


    public function login(){
        //调用加密方法 传入用户id 和 平台类型
        $result = $this->setToken(122,'app');
        var_dump($result);
    }
}
