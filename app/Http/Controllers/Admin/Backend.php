<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

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
    }

    public function initLogin()
    {

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

        // 默认参数
        $data = request()->input();
        if ($data) {
            view()->share('input_json', json_encode($data));
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
            // 获取参数
            $argList = func_get_args();
            // 查询条件
            $data = isset($argList[0]) ? $argList[0] : [];
            $result = $this->service->add($data);
            return $result;
        }
        $data = request()->input();
        if ($data) {
            view()->share('data', $data);
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
            // 获取参数
            $argList = func_get_args();
            // 查询条件
            $data = isset($argList[0]) ? $argList[0] : [];
            $result = $this->service->edit($data);
            return $result;
        }
        $info = [];
        $id = request()->input('id', 0);
        if ($id) {
            $info = $this->service->getInfo($id);
        } else {
            $data = request()->input();
            if ($data) {
                view()->share('input_json', json_encode($data));
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
        if (IS_POST) {
            $result = $this->service->drop();
            return $result;
        }
    }

    /**
     * 修改状态
     * @return mixed
     */
    public function setStatus(){
        if (IS_POST) {
            $result = $this->service->setStatus();
            return $result;
        }
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
