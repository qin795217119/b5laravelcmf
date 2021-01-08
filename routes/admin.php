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


    Route::get('/', 'IndexController@index');
    Route::get('/home', 'IndexController@home');
//公共操作
    Route::any('/login', 'PublicController@login');
    Route::any('/logout', 'PublicController@logout');
    Route::any('/noauth','PublicController@noauth');
    Route::any('/lockscreen','CommonController@lockscreen');
    Route::any('/common/uploadimg', 'CommonController@uploadimg');
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
    Route::any('/config/web', 'ConfigController@web');
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
});



