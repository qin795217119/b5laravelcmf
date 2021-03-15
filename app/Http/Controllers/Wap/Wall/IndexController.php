<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Wap\Wall;

use App\Helpers\Util\ValidateApi;
use App\Http\Controllers\Wap\WapController;
use App\Services\Wall\WallProcessService;
use App\Services\Wall\WallUsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class IndexController extends WapController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index(Request $request){
        $wallInfo=$request->get('wallInfo');
        $wechatInfo=$request->get('wechatInfo');

        return $this->render('wall.index');
    }

    public function sign(Request $request){
        $wallInfo=$request->get('wallInfo');
        $wechatInfo=$request->get('wechatInfo');
        $userInfo=(new WallUsersService())->info([['openid','=',$wechatInfo['openid']],['wall_id','=',$wallInfo['id']]]);
        if(IS_POST){
            $truename=request()->input('truename','');
            $mobile=request()->input('mobile','');
            if($userInfo){
                return message('您已经签过名了',false);
            }
            $data=['wall_id'=>$wallInfo['id'],'openid'=>$wechatInfo['openid'],'headimg'=>$wechatInfo['headimg'],'truename'=>$truename,'mobile'=>$mobile,'sex'=>$wechatInfo['sex'],'status'=>1,'prizeid'=>''];
            $res=(new WallUsersService())->add($data,'','签到');
            if($res['success']){
                return message('签到成功，祝您获得大奖',true,[],null,URL::route('wall_wap_index',['wall_id'=>$wallInfo['id']]));
            }else{
                return $res;
            }
        }else{
            view()->share('wallInfo',$wallInfo);
            view()->share('wechatInfo',$wechatInfo);
            view()->share('userInfo',$userInfo);
            return $this->render('wall.sign');
        }
    }

    public function process(Request $request){
        $wallInfo=$request->get('wallInfo');
        $processList=(new WallProcessService())->getAll([['wall_id','=',$wallInfo['id']],['status','=',1]],['title','daytime','hour','desc'],[],'',[['listsort','asc'],['id','asc']]);
        $processarr=[];
        foreach ($processList as $process){
            $processarr[$process['daytime']][]=$process;
        }
        view()->share('wallInfo',$wallInfo);
        view()->share('processarr',$processarr);
        return $this->render('wall.process');
    }

    public function myprize(Request $request){
        $wallInfo=$request->get('wallInfo');
        $list=[];

        view()->share('wallInfo',$wallInfo);
        view()->share('list',$list);
        return $this->render('wall.myprize');
    }

}
