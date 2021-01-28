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

Route::namespace('Api\Mapply\V1')->prefix('mapply/v1')->middleware(['api','api.mapply'])->group(function (){
    Route::post('/index', 'IndexController@index');
});
Route::namespace('Api\V1')->prefix('v1')->middleware('api')->group(function (){
    Route::post('/', 'IndexController@index');
});

