<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

/**
 * 后台基类
 * Class Backend
 * @package App\Http\Controllers\Admin
 */
class Backend extends BaseController
{
    // 服务
    protected $service;
    // 校验
    protected $validate;
    // 登录ID
    protected $adminId;
    // 登录信息
    protected $adminInfo;

    /**
     * 构造函数
     * Backend constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        // 初始化配置
        $this->initConfig();
    }

    public function initConfig()
    {
        defined('MODULES_NAME') or define('MODULES_NAME', 'admin');

        defined('PAGE_LIMIT') or define('PAGE_LIMIT',10);

        view()->share('group',strtolower(MODULES_NAME));
    }

    public function initLogin()
    {

    }

    /**
     * 跳转到错误页
     * @param string $msg
     * @param int $code
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toError(string $msg='发生错误了',int $code=400){
        $data=['msg'=>$msg,'code'=>$code];
        return $this->render('admin.public.error',$data);
    }
    /**
     * 控制器入口
     * @return mixed
     */
    public function index()
    {
        if (IS_POST) {
            return $this->service->getList();
        }
        $data = request()->input();
        if ($data) {
            view()->share('input', $data);
        }
        return $this->render();
    }

    /**
     * 添加操作
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(){
        if(IS_POST){
            $argList = func_get_args();
            $data = isset($argList[0]) ? $argList[0] : [];
            return $this->service->add($data);
        }
        $data = request()->input();
        if ($data) {
            view()->share('input', $data);
        }
        return $this->render();
    }
    /**
     * 编辑操作
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        if (IS_POST) {
            $argList = func_get_args();
            $data = isset($argList[0]) ? $argList[0] : [];
            return $this->service->edit($data);
        }
        $info = [];
        $id = request()->input('id', 0);
        if ($id) {
            $info = $this->service->info($id);
        } else {
            $data = request()->input();
            if ($data) {
                view()->share('input', $data);
            }
        }
        view()->share('info',$info);
        return $this->render();
    }

    /**
     * 删除
     * @return mixed
     */
    public function drop(){
        return $this->service->drop();
    }

    /**
     * 修改状态
     * @return mixed
     */
    public function setstatus(){
        return $this->service->setStatus();
    }

    /**
     * 渲染模板
     * @param string $view
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render($view = "", $data = [])
    {
        if (empty($view)) {
            // 获取请求地址
            return view(strtolower(MODULES_NAME) . "." . strtolower(CONTROLLER_NAME) . '.' . strtolower(ACTION_NAME), $data);
        }
        return view($view, $data);
    }
}
