<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function () {
    Route::controller(\App\Http\Controllers\Api\V1\AppController::class)->prefix('app')->group(function (){
       Route::any('/index','index');
       Route::any('/login','login');
    });


    Route::controller(\App\Http\Controllers\Api\V1\WechatController::class)->prefix('wechat')->group(function (){
        Route::get('/getopenid','getopenid');
        Route::get('/getwechatcode','getwechatcode');
        Route::get('/back','back');
    });
});

Route::any('/test/index',[\App\Http\Controllers\Api\TestController::class,'index']);


