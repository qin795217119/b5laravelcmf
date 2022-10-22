<?php

use Illuminate\Http\Request;
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

Route::get('/error', function (Request $request) {
    $msg = $request->get('msg','发生错误了');
    $code = $request->get('code','400');
    return view('error',['code'=>$code,'msg'=>$msg]);
})->name('error');

Route::get("/", function () {
    return redirect(route("admin.index"));
});
