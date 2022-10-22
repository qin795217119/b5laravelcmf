<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('upload', \App\Extends\Tags\Upload::class);

        // 添加模板按钮权限判断方法
        Blade::if('hasPerm', function ($permission) {
            return hasPerm($permission);
        });
    }
}
