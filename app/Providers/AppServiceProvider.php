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
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //视图合成
        Blade::directive('render', function ($expression) {
            list($class, $params) = explode(',', $expression, 2);

            $class = "App\\Http\\Components\\View\\" .ucfirst(trim($class, '\'" ')). "Component";
            return "<?php echo app()->makeWith('$class',$params)->init($params); ?>";
        });
    }
}
