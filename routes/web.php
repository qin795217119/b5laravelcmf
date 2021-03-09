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



//
$list=\App\Cache\WebSiteCache::getByCode();
foreach ($list as $key=>$val){
    if(!$val['status']) continue;
//    if(isset($val['is_default']) && $val['is_default']){
//        Route::get('/','Web\Site\\'.ucwords($key).'Controller@index');
//    }
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

