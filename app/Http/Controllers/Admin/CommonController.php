<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Extends\Helpers\Admin\LoginAuth;
use App\Extends\Helpers\Result;
use App\Extends\Helpers\Upload;
use App\Extends\Services\System\AdminLoginService;
use App\Models\System\Admin;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class CommonController extends Backend
{

    /**
     * 图片上传
     * @return JsonResponse
     */
    public function uploadimg(): JsonResponse
    {
        if($this->request->isMethod('POST')){
            $upload = new Upload();
            $upload->type = 'img';
            $upload->cat = trim($this->request->post('cat'));
            $upload->width = intval($this->request->post('width', 0));
            $upload->height = intval($this->request->post('height', 0));
            return $upload->run();
        }else{
            return Result::error('请求类型错误');
        }

    }

    /**
     * 视频上传
     * @return JsonResponse
     */
    public function uploadvideo(): JsonResponse
    {
        if($this->request->isMethod('POST')) {
            $upload = new Upload();
            $upload->type = 'video';
            $upload->cat = trim($this->request->post('cat'));
            return $upload->run();
        }else{
            return Result::error('请求类型错误');
        }
    }

    /**
     * 文件上传
     * @return JsonResponse
     */
    public function uploadfile(): JsonResponse
    {
        if($this->request->isMethod('POST')) {
            $upload = new Upload();
            $upload->type = 'file';
            $upload->cat = trim($this->request->post('cat'));
            return $upload->run();
        }else{
            return Result::error('请求类型错误');
        }
    }

    /**
     * 裁剪图片
     * @return View
     */
    public function cropper(): View
    {
        $data=[
            'id' => $this->request->get('id',''),
            'cat' => $this->request->get('cat',''),
        ];
        return $this->render('',$data);
    }

    /**
     * 锁屏
     * @return View|JsonResponse
     */
    public function lockscreen(): View|JsonResponse
    {
        if($this->request->isMethod('POST')){
            $password = $this->request->post('password');
            if(!$password) return Result::error('请输入密码');

            $adminId = LoginAuth::adminLoginInfo('info.id');
            if(!$adminId){
                return Result::error('登录失效，请重新登录');
            }

            $service = new AdminLoginService();
            $service->getUser('id',$adminId);
            if(!$service->validatePassword($password)){
                return Result::error($service->message);
            }

            if($service->_user['status']!=1){
                return Result::error('用户状态错误，请重新登录');
            }
            session()->forget('islock');
            return Result::success('登录成功');

        }else{
            session()->put('islock',1);
            $adminInfo = LoginAuth::adminLoginInfo('info');
            return $this->render('',['user'=>$adminInfo]);
        }
    }

    /**
     * 清除所有缓存
     * @return JsonResponse
     */
    public function cacheclear(): JsonResponse
    {
        Artisan::call('cache:clear');
        return Result::success('缓存清除成功');
    }

    /**
     * 修改密码
     * @return View|JsonResponse
     */
    public function repass(): View|JsonResponse
    {
        if($this->request->isMethod('POST')){
            $data = $this->request->post();
            $validator = Validator::make($data,
                [
                    'oldpass' => 'required|min:2|max:20',
                    'newpass' => 'required|min:6|max:20',
                    'confirmpass' => 'required|min:6|max:20|same:newpass'
                ],
                [],
                ['oldpass'=>'旧密码','newpass'=>'新密码','confirmpass'=>'确认密码']
            );
            if ($validator->stopOnFirstFailure()->fails()) {
                $error = $validator->errors()->first();
                return Result::error($error ?: '表单数据错误');
            }
            if($data['oldpass'] == $data['newpass']){
                return Result::error('新旧密码不能一样');
            }

            $service = new AdminLoginService();
            $service->getUser('id',LoginAuth::adminLoginInfo('info.id'));
            if(!$service->validatePassword($data['oldpass'])){
                return  Result::error($service->message);
            }
            Admin::bUpdate(['id'=>$service->_user['id'],'password'=>md5($data['newpass'])]);
            return Result::success('密码修改成功');
        }else{
            return $this->render();
        }
    }
}
