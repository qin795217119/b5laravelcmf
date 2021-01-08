<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Admin;

use App\Services\MenuService;
use Illuminate\Http\Request;

class IndexController extends Backend
{
   public function __construct(Request $request)
   {

       parent::__construct($request);
   }

   public function index()
   {
       $menuHtml=(new MenuService())->getMenuListByLogin();
       $adminInfo=adminLoginInfo();
       unset($adminInfo['menu']);
       unset($adminInfo['role']);
       $adminInfo['struct']=$adminInfo['struct']?$adminInfo['struct'][0]['name']:'未分配部门';
       return $this->render('',['menuHtml'=>$menuHtml,'adminInfo'=>$adminInfo]);
   }

    public function home(){
       return $this->render();
   }
    public function test(){
        return $this->render();
    }
}
