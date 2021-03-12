<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Wap\Wall;

use App\Http\Controllers\Wap\WapController;
use Illuminate\Http\Request;

class IndexController extends WapController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index(Request $request){
        $wallInfo=$request->get('wallInfo');
        $wechatInfo=$request->get('wechatInfo');
        dd($wechatInfo);
        return $this->render('wall.index');
    }

}
