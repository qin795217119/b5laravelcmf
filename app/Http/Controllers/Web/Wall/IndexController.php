<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Web\Wall;

use App\Http\Controllers\Web\WebController;
use App\Models\Wall\WallUsersModel;
use App\Services\Wall\WallPrizeService;
use App\Services\Wall\WallPrizeUsersService;
use App\Services\Wall\WallUsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class IndexController extends WebController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function qrcode(Request $request){
        $wallInfo=$request->get('wallInfo');
//        dd(URL::route('wall_wap_index',['wall_id'=>$wallInfo['id']]));
        return QrCode::format('png')->margin(1)->size(500)->generate('aaa');

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

    public function sign(){
        return $this->render('wall.sign');
    }

    //获取签到用户列表
    public function getsignlist(Request $request){
        $wallInfo=$request->get('wallInfo');
        $lastid=intval($request->input('lastid',0));
        $count=WallUsersModel::where([['wall_id','=',$wallInfo['id']],['status','=',1]])->count();
        $list=WallUsersModel::where([['wall_id','=',$wallInfo['id']],['status','=',1],['id','>',$lastid]])->select(['id','openid','headimg','truename'])->orderBy('id','asc')->take(10)->get()->toArray();
        return message('返回成功',true,['list'=>$list,'count'=>$count]);
    }

    //获取可参与活动人数
    public function inactusernum(Request $request){
        $wallInfo=$request->get('wallInfo');
        $userlist=[];
        foreach (WallUsersModel::where([['wall_id','=',$wallInfo['id']],['status','=',1]])->select(['id','openid','truename','headimg','sex'])->cursor() as $user){
            $userlist[]=$user->toArray();
        }
        return message('操作成功',true,['list'=>$userlist]);
    }

    //获取某奖品已中奖人列表
    public function prizegetuser(Request $request){
        $wallInfo=$request->get('wallInfo');
        $prizeId=intval($request->input('prize_id',0));
        $userlist=[];
        if($prizeId>0){
            $userlist=(new WallPrizeUsersService())->getAll([['prize_id','=',$prizeId],['wall_id','=',$wallInfo['id']]],['id','openid','truename','headimg']);
        }
        $userlist=$userlist?$userlist:[];
        return message('成功返回',true,['list'=>$userlist]);
    }

    //删除某个奖品的中奖用户
    public function delprizeuser(Request $request){
        $wallInfo=$request->get('wallInfo');
        $prizeId=intval($request->input('prize_id',0));
        $openid=trim($request->input('openid',''));
        if($prizeId<1 || !$openid) return message('参数错误',false);
        $info=(new WallPrizeUsersService())->info([['wall_id','=',$wallInfo['id']],['prize_id','=',$prizeId],['openid','=',$openid]],false);
        if(!$info) return message('未查询到获奖信息',false);
        if($info->delete()){
            return message('删除完成',true);
        }else{
            return message('删除失败',false);
        }
    }

    //存储中将用户
    public function getdraw(Request $request){
        $wallInfo=$request->get('wallInfo');
        $prize_id=intval(request()->input('prize_id',0));
        $openid=trim(request()->input('openid',''));
        if($openid && $prize_id){
            $userinfo=(new WallUsersService())->info([['wall_id','=',$wallInfo['id']],['openid','=',$openid]]);
            if($userinfo){
                $data=[
                    'wall_id'=>$wallInfo['id'],
                    'openid'=>$userinfo['openid'],
                    'truename'=>$userinfo['truename'],
                    'mobile'=>$userinfo['mobile'],
                    'headimg'=>$userinfo['headimg'],
                    'prize_id'=>$prize_id,
                    'status'=>0,
                ];
                $res=(new WallPrizeUsersService())->add($data);
                if($res['success']){
                    return $res;
                }else{
                    return message('中奖信息保存失败',false);
                }
            }else{
                return message('获取用户信息错误',false);
            }
        }
        return message('参数错误',false);
    }

}
