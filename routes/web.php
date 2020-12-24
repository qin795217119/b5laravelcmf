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

Route::get('/', function () {
    return view('welcome');
});

//后台管理路由
Route::prefix('admin')->group(function() {
    Route::namespace('Admin')->group(function (){
        Route::get('/', 'IndexController@index');
        Route::get('/home', 'IndexController@home');

        Route::get('/test','IndexController@test');
        //人员管理
        Route::get('/admin/index', 'AdminController@index');
        Route::post('/admin/index', 'AdminController@index');
        Route::get('/admin/add', 'AdminController@add');
        Route::post('/admin/add', 'AdminController@add');
        Route::get('/admin/edit', 'AdminController@edit');
        Route::post('/admin/edit', 'AdminController@edit');
        Route::post('/admin/drop', 'AdminController@drop');
        Route::post('/admin/status','AdminController@setStatus');
        //权限管理
        Route::get('/authgroup/index', 'AuthgroupController@index');
        Route::post('/authgroup/index', 'AuthgroupController@index');
        Route::get('/authgroup/add', 'AuthgroupController@add');
        Route::post('/authgroup/add', 'AuthgroupController@add');
        Route::get('/authgroup/edit', 'AuthgroupController@edit');
        Route::post('/authgroup/edit', 'AuthgroupController@edit');
        Route::post('/authgroup/drop', 'AuthgroupController@drop');
        Route::post('/authgroup/status','AuthgroupController@setStatus');

        //菜单管理
        Route::get('/menu/index', 'MenuController@index');

    });

});
