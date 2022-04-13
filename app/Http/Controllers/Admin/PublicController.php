<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Extends\Helpers\Admin\LoginAuth;
use App\Extends\Services\System\AdminLoginService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class PublicController extends Backend
{
    /**
     * 登录
     * @return Application|View|JsonResponse|RedirectResponse|Redirector
     */
    public function login(): View|JsonResponse|Redirector|Application|RedirectResponse
    {
        if($this->request->isMethod('POST')){
            return (new AdminLoginService())->login($this->request->post());
        }else{
            if(LoginAuth::adminLoginInfo()){
                 return redirect(route('admin.index'));
            }else{
                return $this->render();
            }
        }
    }

    /**
     * 退出登录
     * @return Application|RedirectResponse|Redirector
     */
    public function logout(): Redirector|Application|RedirectResponse
    {
        (new AdminLoginService())->logout();
        return redirect(route('admin.login'));
    }
}
