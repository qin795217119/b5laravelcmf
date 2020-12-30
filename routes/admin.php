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
//菜单管理
    Route::any('/menu/index', 'MenuController@index');
    Route::any('/menu/add', 'MenuController@add');
    Route::any('/menu/edit', 'MenuController@edit');
    Route::any('/menu/drop', 'MenuController@drop');
    Route::any('/menu/status','MenuController@setStatus');
    Route::any('/menu/tree', 'MenuController@tree');
//字典管理
    Route::any('/dict/index', 'DictController@index');
    Route::any('/dict/add', 'DictController@add');
    Route::any('/dict/edit', 'DictController@edit');
    Route::any('/dict/drop', 'DictController@drop');
    Route::any('/dict/status','DictController@setStatus');
//字典数据
    Route::any('/dictdata/index', 'DictdataController@index');
    Route::any('/dictdata/add', 'DictdataController@add');
    Route::any('/dictdata/edit', 'DictdataController@edit');
    Route::any('/dictdata/drop', 'DictdataController@drop');
    Route::any('/dictdata/status','DictdataController@setStatus');
//系统配置
    Route::any('/config/index', 'ConfigController@index');
    Route::any('/config/add', 'ConfigController@add');
    Route::any('/config/edit', 'ConfigController@edit');
    Route::any('/config/drop', 'ConfigController@drop');
});



