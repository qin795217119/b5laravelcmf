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

//统一错误页
Route::get('/error',function (){
   return view('web.error',['msg'=>request()->input('msg','')]);
})->name('error');
//H5统一微信授权链接
Route::get('/wap/wxauthinfo','Wap\WechatController@wxinfo')->name('wap_wxauthinfo');

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



//微现场PC和H5
Route::namespace('Web\Wall')->prefix('wall')->middleware('wall.web')->group(function (){
    Route::get('/','IndexController@index');
    Route::any('/login','IndexController@login');
    Route::any('/sign','IndexController@sign');
    Route::any('/qrcode','IndexController@qrcode')->name('wall_web_qrcode');
    Route::any('/getsignlist','IndexController@getsignlist');
    Route::get('/inactusernum','IndexController@inactusernum');
    Route::get('/prizegetuser','IndexController@prizegetuser');
    Route::get('/delprizeuser','IndexController@delprizeuser');
    Route::get('/getdraw','IndexController@getdraw');
});
Route::namespace('Wap\Wall')->prefix('wallwap')->middleware('wall.wap')->group(function (){
    Route::get('/','IndexController@index')->name('wall_wap_index');
    Route::any('/sign', 'IndexController@sign')->name('wall_wap_sign');
    Route::get('/process', 'IndexController@process')->name('wall_wap_process');
    Route::any('/myprize', 'IndexController@myprize')->name('wall_wap_myprize');
});
