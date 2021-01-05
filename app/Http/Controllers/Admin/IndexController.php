<?php
// +----------------------------------------------------------------------
// | LaravelB5CMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Admin;


use App\Services\AdminService;
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

       $menuService=new MenuService();
       $menuHtml=$menuService->getMenuList(1);

       return $this->render('',['menuHtml'=>$menuHtml]);
   }

    public function home(){
       return $this->render();
   }
    public function test(){
        return $this->render();
    }
}
