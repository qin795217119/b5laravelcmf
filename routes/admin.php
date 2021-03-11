<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//后台管理路由
Route::namespace('Admin')->middleware(['admin.login','admin.auth'])->group(function (){
    Route::get('/test', 'PublicController@test');

    Route::get('/', 'IndexController@index');
    Route::get('/home', 'IndexController@home');


//public操作
    Route::any('/login', 'PublicController@login');
    Route::any('/logout', 'PublicController@logout');
    Route::any('/noauth','PublicController@noauth');
    Route::get('/public/vemail', 'PublicController@vemail');
//公共操作
    Route::get('/home', 'IndexController@home');
    Route::any('/cacheclear','CommonController@cacheclear');
    Route::any('/common/uploadimg', 'CommonController@uploadimg');
    Route::any('/common/repass','CommonController@repass');
    Route::any('/common/mapselect','CommonController@mapselect');
//组织架构
    Route::any('/struct/index', 'StructController@index');
    Route::any('/struct/add', 'StructController@add');
    Route::any('/struct/edit', 'StructController@edit');
    Route::any('/struct/drop', 'StructController@drop');
    Route::any('/struct/tree', 'StructController@tree');
//人员管理
    Route::any('/admin/index', 'AdminController@index');
    Route::any('/admin/add', 'AdminController@add');
    Route::any('/admin/edit', 'AdminController@edit');
    Route::any('/admin/drop', 'AdminController@drop');
    Route::any('/admin/setstatus','AdminController@setstatus');
//权限管理
    Route::any('/role/index', 'RoleController@index');
    Route::any('/role/add', 'RoleController@add');
    Route::any('/role/edit', 'RoleController@edit');
    Route::any('/role/drop', 'RoleController@drop');
    Route::any('/role/setstatus','RoleController@setstatus');
    Route::any('/role/auth', 'RoleController@auth');
//人员角色分配管理
    Route::any('/adminrole/index','AdminRoleController@index');
    Route::any('/adminrole/drop', 'AdminRoleController@drop');
    Route::any('/adminrole/add', 'AdminRoleController@add');
    Route::any('/adminrole/tree', 'AdminRoleController@tree');
//菜单管理
    Route::any('/menu/index', 'MenuController@index');
    Route::any('/menu/add', 'MenuController@add');
    Route::any('/menu/edit', 'MenuController@edit');
    Route::any('/menu/drop', 'MenuController@drop');
    Route::any('/menu/tree', 'MenuController@tree');
//字典管理
    Route::any('/dict/index', 'DictController@index');
    Route::any('/dict/add', 'DictController@add');
    Route::any('/dict/edit', 'DictController@edit');
    Route::any('/dict/drop', 'DictController@drop');
    Route::any('/dict/delcache', 'DictController@delcache');
//字典数据
    Route::any('/dictdata/index', 'DictdataController@index');
    Route::any('/dictdata/add', 'DictdataController@add');
    Route::any('/dictdata/edit', 'DictdataController@edit');
    Route::any('/dictdata/drop', 'DictdataController@drop');
//参数配置
    Route::any('/config/site', 'ConfigController@site');
    Route::any('/config/index', 'ConfigController@index');
    Route::any('/config/add', 'ConfigController@add');
    Route::any('/config/edit', 'ConfigController@edit');
    Route::any('/config/drop', 'ConfigController@drop');
    Route::any('/config/delcache','ConfigController@delcache');
//推荐位置
    Route::any('/adposition/index', 'AdpositionController@index');
    Route::any('/adposition/add', 'AdpositionController@add');
    Route::any('/adposition/edit', 'AdpositionController@edit');
    Route::any('/adposition/drop', 'AdpositionController@drop');
    Route::any('/adposition/delcache', 'AdpositionController@delcache');
//跳转管理
    Route::any('/redtype/index', 'RedtypeController@index');
    Route::any('/redtype/add', 'RedtypeController@add');
    Route::any('/redtype/edit', 'RedtypeController@edit');
    Route::any('/redtype/drop', 'RedtypeController@drop');
    Route::any('/redtype/delcache','RedtypeController@delcache');
//推荐信息
    Route::any('/adlist/index', 'AdlistController@index');
    Route::any('/adlist/add', 'AdlistController@add');
    Route::any('/adlist/edit', 'AdlistController@edit');
    Route::any('/adlist/drop', 'AdlistController@drop');
    Route::any('/adlist/delcache','AdlistController@delcache');
//通知公告
    Route::any('/notice/index', 'NoticeController@index');
    Route::any('/notice/add', 'NoticeController@add');
    Route::any('/notice/edit', 'NoticeController@edit');
    Route::any('/notice/drop', 'NoticeController@drop');
//登录日志
    Route::any('/loginlog/index', 'LoginlogController@index');
    Route::any('/loginlog/drop', 'LoginlogController@drop');
    Route::any('/loginlog/trash', 'LoginlogController@trash');
//预约报名
    Route::any('/mapply/index', 'MapplyController@index');
    Route::any('/mapply/add', 'MapplyController@add');
    Route::any('/mapply/edit', 'MapplyController@edit');
    Route::any('/mapply/drop', 'MapplyController@drop');
//网站系统
    Route::any('/website/index', 'WebSiteController@index');
    Route::any('/website/add', 'WebSiteController@add');
    Route::any('/website/edit', 'WebSiteController@edit');
    Route::any('/website/drop', 'WebSiteController@drop');
    Route::any('/website/delcache', 'WebSiteController@delcache');

    Route::any('/webcat/index', 'WebCatController@index');
    Route::any('/webcat/add', 'WebCatController@add');
    Route::any('/webcat/edit', 'WebCatController@edit');
    Route::any('/webcat/drop', 'WebCatController@drop');
    Route::any('/webcat/tree', 'WebCatController@tree');
    Route::any('/webcat/delcache', 'WebCatController@delcache');

    Route::any('/weblist/index', 'WebListController@index');
    Route::any('/weblist/add', 'WebListController@add');
    Route::any('/weblist/edit', 'WebListController@edit');
    Route::any('/weblist/drop', 'WebListController@drop');

    Route::any('/webpos/index', 'WebPosController@index');
    Route::any('/webpos/add', 'WebPosController@add');
    Route::any('/webpos/edit', 'WebPosController@edit');
    Route::any('/webpos/drop', 'WebPosController@drop');
    Route::any('/webpos/delcache', 'WebPosController@delcache');

    Route::any('/webad/index', 'WebAdController@index');
    Route::any('/webad/add', 'WebAdController@add');
    Route::any('/webad/edit', 'WebAdController@edit');
    Route::any('/webad/drop', 'WebAdController@drop');

//微现场抽奖
    Route::any('/wall/index', 'Wall\WallController@index');
    Route::any('/wall/add', 'Wall\WallController@add');
    Route::any('/wall/edit', 'Wall\WallController@edit');
    Route::any('/wall/drop', 'Wall\WallController@drop');

    Route::any('/wallprize/index', 'Wall\WallPrizeController@index');
    Route::any('/wallprize/add', 'Wall\WallPrizeController@add');
    Route::any('/wallprize/edit', 'Wall\WallPrizeController@edit');
    Route::any('/wallprize/drop', 'Wall\WallPrizeController@drop');

    Route::any('/wallusers/index', 'Wall\WallUsersController@index');
    Route::any('/wallusers/setstatus','Wall\WallUsersController@setstatus');
});



