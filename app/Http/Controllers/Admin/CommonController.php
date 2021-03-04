<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Admin;

use App\Cache\ConfigCache;
use App\Helpers\Util\UploadApi;
use App\Services\AdminService;
use Illuminate\Support\Facades\Artisan;

/**
 * 公共操作控制器
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class CommonController extends Backend
{

    /**
     * 图片上传
     * @return array
     */
    public function uploadimg(){
        $upload=new UploadApi();
        $upload->cat=request()->input('cat','images');
        $upload->width=request()->input('width','0');
        $upload->height=request()->input('height','0');
        $res=$upload->run();
        return message($res['msg'],$res['status']?true:false,$res['data']);
    }

    /**
     * 锁屏
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lockscreen(){
        if (IS_POST){
            $password=request()->input('password','');
            if(empty($password)){
                return  message('请输入密码',false);
            }
            $adminId=adminLoginInfo('info.id');
            if(!$adminId){
               return message('登录信息丢失，请重新登录',false);
            }
            $userinfo=(new AdminService())->info($adminId,true,false);
            if(!$userinfo){
               return message('用户信息丢失，请重新登录',false);
            }
            if($userinfo['password']!=get_password($password)){
                return message('密码错误',false);
            }
            if($userinfo['status']!=1){
                return message('用户状态错误，请重新登录',false);
            }
            app('session')->forget('islock');
            return message('登录成功',true);
        }else{
            app('session')->put('islock',true);
            $user=adminLoginInfo('info');
            return $this->render('',['user'=>$user]);
        }
    }

    //修改密码
    public function repass(){
        if(IS_POST){
            return (new AdminService())->repass();
        }
        return $this->render('',['name'=>adminLoginInfo('info.name')]);
    }

    //清除所有缓存
    public function cacheclear(){
        Artisan::call('cache:clear');
        return message('缓存清除成功',true,[],null,'reload');
    }

    public function mapselect(){
        $address=request()->input("keyword",'');
        $lat=request()->input("lat",0);
        $lng=request()->input("lng",0);

        $keyfirst=0;
        $lat=round($lat,7);
        $lng=round($lng,7);
        if(empty($lat) || empty($lng)){
            $keyfirst=1;
            $lat=35.0615473;
            $lng=118.3404347;
        }
        return $this->render('',['keyfirst' => $keyfirst,'keyword'=>$address,'lat'=>$lat,'lng'=>$lng,'mapkey'=>ConfigCache::get('sys_map_qqkey')]);
    }
}
