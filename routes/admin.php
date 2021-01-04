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
Route::namespace('Admin')->group(function (){

    Route::get('/', 'IndexController@index');
    Route::get('/home', 'IndexController@home');

    Route::get('/test','IndexController@test');
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
    Route::any('/admin/status','AdminController@setStatus');
//权限管理
    Route::any('/role/index', 'RoleController@index');
    Route::any('/role/add', 'RoleController@add');
    Route::any('/role/edit', 'RoleController@edit');
    Route::any('/role/drop', 'RoleController@drop');
    Route::any('/role/status','RoleController@setStatus');
//人员权限分配管理
    Route::any('/adminrole/index','AdminRoleController@index');
    Route::any('/adminrole/drop', 'AdminRoleController@drop');
    Route::any('/adminrole/add', 'AdminRoleController@add');
    Route::any('/adminrole/unauthlist', 'AdminRoleController@unauthlist');
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
//推荐位置
    Route::any('/adposition/index', 'AdpositionController@index');
    Route::any('/adposition/add', 'AdpositionController@add');
    Route::any('/adposition/edit', 'AdpositionController@edit');
    Route::any('/adposition/drop', 'AdpositionController@drop');
//跳转管理
    Route::any('/redtype/index', 'RedtypeController@index');
    Route::any('/redtype/add', 'RedtypeController@add');
    Route::any('/redtype/edit', 'RedtypeController@edit');
    Route::any('/redtype/drop', 'RedtypeController@drop');
//通知公告
    Route::any('/notice/index', 'NoticeController@index');
    Route::any('/notice/add', 'NoticeController@add');
    Route::any('/notice/edit', 'NoticeController@edit');
    Route::any('/notice/drop', 'NoticeController@drop');
});



