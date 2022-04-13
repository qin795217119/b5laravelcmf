<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Extends\Libs;

use App\Extends\Helpers\Result;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    /**
     * 模块名称
     * @var string
     */
    protected string $module = '';

    /**
     * 分组名称
     * 二级控制器的文件夹名称
     * @var string
     */
    protected string $group = '';

    /**
     * 控制器名称
     * @var string
     */
    protected string $controller;

    /**
     * 方法名称
     * @var string
     */
    protected string $action;

    /**
     * Request实例
     * @var Request
     */
    protected Request $request;

    /**
     * 构造函数
     * BaseController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->__initialize();
    }

    /**
     * 自定义的初始化方法
     */
    public function __initialize(): void
    {
        $routeName = $this->request->route()->getActionName();
        list($controller, $action) = explode('@', $routeName);
        $controller = str_replace('Controller', '', class_basename($controller));
        $this->controller = strtolower($controller);
        $this->action = $action;
    }

    /**
     * 跳转到错误页
     * @param string $msg
     * @param int $code
     * @return View|JsonResponse
     */
    public function toError(string $msg = '发生错误了', int $code = 400): View|JsonResponse
    {
        if($this->request->isMethod('POST') || $this->request->ajax()){
            return Result::error($msg,$code);
        }else{
            $data = ['msg' => $msg, 'code' => $code];
            return $this->render('/error', $data);
        }
    }

    /**
     * 快捷视图
     * @param string $view
     * @param array $data
     * @return View
     */
    protected function render(string $view = "", array $data = []): View
    {
        if (empty($view)) {
            $view = $this->controller . '.' . $this->action;
        }
        if (($this->module || $this->group) && strpos($view, '/') !== 0) {
            $view = ($this->module ? $this->module . '.' : '') . ($this->group ? $this->group . '.' : '') . $view;
        }
        return view($view, $data);
    }

}
