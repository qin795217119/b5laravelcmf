<?php
// +----------------------------------------------------------------------
// | LaravelB5CMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Admin;


use App\Cache\AdpositionCache;
use App\Cache\ConfigCache;
use App\Cache\DictCache;
use App\Cache\RedtypeCache;
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
//       var_dump(ConfigCache::get('sys_config_group'));
       $menuHtml=(new MenuService())->getMenuListByLogin();
       return $this->render('',['menuHtml'=>$menuHtml]);
   }

    public function home(){
       return $this->render();
   }
    public function test(){
        return $this->render();
    }
}
