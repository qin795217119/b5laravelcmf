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
Route::redirect('/', '/admin');

Route::get('/error',function (){
   return view('web.error',['msg'=>request()->input('msg','')]);
});

//网站路由匹配
$list=\App\Cache\WebSiteCache::getByCode();
foreach ($list as $key=>$val){
    if(!$val['status']) continue;
    $controller=ucwords($key).'Controller';
    if(!class_exists('App\Http\Controllers\Web\Site\\'.$controller)){
        $controller='SiteController';
    }
    Route::namespace('Web\Site')->prefix($key)->group(function () use ($controller){
        Route::get('/',$controller.'@index');
        Route::get('/index',$controller.'@index');
        Route::get('/list',$controller.'@list');
        Route::get('/info',$controller.'@info');
        Route::get('/page',$controller.'@page');
    });
}

//微现场PC
Route::namespace('Web\Wall')->prefix('wall')->middleware('web.wall')->group(function (){
    Route::get('/','IndexController@index');
    Route::any('/login','IndexController@login');
    Route::get('/list','IndexController@list');
    Route::get('/info','IndexController@info');
    Route::get('/page','IndexController@page');
});

