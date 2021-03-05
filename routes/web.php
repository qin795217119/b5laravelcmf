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
    Route::namespace('Web\Site')->prefix($key)->group(function () use ($key){
        Route::get('/',ucwords($key).'Controller@index');
        Route::get('/index',ucwords($key).'Controller@index');
        Route::get('/list',ucwords($key).'Controller@list');
        Route::get('/info',ucwords($key).'Controller@info');
        Route::get('/page',ucwords($key).'Controller@page');
    });

}

