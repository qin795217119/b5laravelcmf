<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * 构造函数
     * BaseController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        // 初始化网络请求配置
        $this->initRequestConfig($request);

        // 初始化系统常量
        $this->initSystemConst();
    }

    /**
     * 初始化请求配置
     * @param Request $request
     */
    private function initRequestConfig(Request $request)
    {
        // 定义是否GET请求
        defined('IS_GET') or define('IS_GET', $request->isMethod('GET'));

        // 定义是否POST请求
        defined('IS_POST') or define('IS_POST', $request->isMethod('POST'));

        // 定义是否AJAX请求
        defined('IS_AJAX') or define('IS_AJAX', $request->ajax());

        // 定义是否PAJAX请求
        defined('IS_PJAX') or define('IS_PJAX', $request->pjax());

        // 定义是否PUT请求
        defined('IS_PUT') or define('IS_PUT', $request->isMethod('PUT'));

        // 定义是否DELETE请求
        defined('IS_DELETE') or define('IS_DELETE', $request->isMethod('DELETE'));

        // 请求方式
        defined('REQUEST_METHOD') or define('REQUEST_METHOD', strtoupper($request->method()));

        $routeName=$request->route()->getActionName();
        list($class, $method) = explode('@', $routeName);
        $class = class_basename($class);

        $controller=str_replace('Controller','',$class);

        // 控制器名
        defined('CONTROLLER_NAME') or define('CONTROLLER_NAME', $controller);
        // 方法名
        defined('ACTION_NAME') or define('ACTION_NAME', $method);

    }

    /**
     * 初始化系统常量
     */
    private function initSystemConst()
    {
        // 项目根目录
        defined('ROOT_PATH') or define('ROOT_PATH', base_path());

        // 文件上传目录
        defined('ATTACHMENT_PATH') or define('ATTACHMENT_PATH', base_path('public'.DIRECTORY_SEPARATOR.'uploads'));

        // 图片上传目录
        defined('IMG_PATH') or define('IMG_PATH', base_path(ATTACHMENT_PATH.DIRECTORY_SEPARATOR.'images'));

        // 临时存放目录
        defined('UPLOAD_TEMP_PATH') or define('UPLOAD_TEMP_PATH', ATTACHMENT_PATH . DIRECTORY_SEPARATOR."temp");

        // 定义普通图片域名
        defined('IMG_URL') or define('IMG_URL', env('IMG_URL'));

    }
}
