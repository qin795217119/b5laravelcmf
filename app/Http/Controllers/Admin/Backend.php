<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
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
    protected $view_group='';

    /**
     * 构造函数
     * Backend constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->initSys();
    }


    // 初始化系统信息
    public function initSys()
    {
        defined('MODULES_NAME') or define('MODULES_NAME', 'admin');

        defined('PAGE_LIMIT') or define('PAGE_LIMIT', 10);

        if(IS_GET && !IS_AJAX){
            view()->share('group', strtolower(MODULES_NAME));
            view()->share("app", strtolower(CONTROLLER_NAME));
            view()->share("act", strtolower(ACTION_NAME));
        }
    }



    /**
     * 跳转到错误页
     * @param string $msg
     * @param int $code
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toError(string $msg = '发生错误了', int $code = 400)
    {
        if(IS_POST || IS_AJAX){
            return message($msg,false,[],$code);
        }else{
            $data = ['msg' => $msg, 'code' => $code];
            return $this->render('admin.public.error', $data);
        }

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
    public function add()
    {
        if (IS_POST) {
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
        }
        $data = request()->input();
        if ($data) {
            view()->share('input', $data);
        }
        view()->share('info', $info);
        $res=$this->edit_before($info,$data);
        if($res===true){
            return $this->render();
        }else{
            return $res;
        }
    }
    public function edit_before($info,$data){
        if(!$info){
            return $this->toError('信息不存在');
        }
        return true;
    }
    /**
     * 删除
     * @return mixed
     */
    public function drop()
    {
        return $this->service->drop();
    }

    /**
     * 修改状态
     * @return mixed
     */
    public function setstatus()
    {
        return $this->service->setStatus();
    }

    /**
     * 清除缓存
     * @return mixed
     */
    public function delcache(){
        return $this->service->delcache();
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
            return view(strtolower(MODULES_NAME) . ($this->view_group?'.'.$this->view_group:'') . "." . strtolower(CONTROLLER_NAME) . '.' . strtolower(ACTION_NAME) , $data);
        }
        return view($view, $data);
    }
}
