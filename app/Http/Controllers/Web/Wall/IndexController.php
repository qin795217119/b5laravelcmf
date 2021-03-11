<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Web\Wall;

use App\Http\Controllers\Web\WebController;
use App\Services\Wall\WallPrizeService;
use Illuminate\Http\Request;

class IndexController extends WebController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index(Request $request){
        $wallInfo=$request->get('wallInfo');
        $prizeList=(new WallPrizeService())->getAll([['wall_id','=',$wallInfo['id']]],['id','title','thumbimg','name','number'],[],'id',[['id','asc']]);
        view()->share('prizeList',$prizeList);
        return $this->render('wall.index');
    }

    public function login(Request $request){
        if(IS_GET && !IS_AJAX){
            return $this->render('wall.login');
        }else{
            $password=request()->input('password','');
            if(!$password) return message('请输入密码',false);
            $wallInfo=$request->get('wallInfo');
            if($wallInfo['password']!=$password) return message('密码错误',false);
            app('session')->put('wall_pc_login_'.$wallInfo['id'],'1111');
            return message('登陆成功',true);
        }
    }

}
