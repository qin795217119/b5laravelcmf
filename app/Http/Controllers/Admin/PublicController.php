<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Admin;

use App\Jobs\TestJob;
use App\Mail\TestMail;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

/**
 * 公共操作控制器
 * Class PublicController
 * @package App\Http\Controllers\Admin
 */
class PublicController extends Backend
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function login(){
        if(IS_POST){
            return (new AdminService())->login();
        }
        if(adminLoginInfo('info.id')){
            return redirect(adminUrl(''));
        }
        return $this->render();
    }

    public function logout(){
        return (new AdminService())->logout();
    }

    public function noauth(){
        return $this->render('admin.public.error',['msg'=>'未获取授权','code'=>400]);
    }

    public function vemail(){
        $token=\request()->input('token');
        $data=decrypt(base64_decode($token),true);
        var_dump($data);
    }
    public function test(){
//        $this->dispatch(new TestJob([]));
        TestJob::dispatch(['id'=>111,'name' => '测试用户', 'email' => '357145480@qq.com', 'type' => 'vemail'])->delay(now()->addSeconds(20));

    }
}
