<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //[自定义迁移]忽略Passport的默认迁移
        Passport::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 定义资源集合外层是否要被data包装 todo: 待验证
//        Resource::withoutWrapping();
        $this->app['router']->matched(function (RouteMatched $routeMatched) {
            $route = $routeMatched->route;
            if (!Arr::has($route->getAction(), 'guard')) {
                return;
            }
            $routeGuard = $route->getAction('guard');
            $this->app['auth']->resolveUsersUsing(function ($guard = null) use ($routeGuard) {
                return $this->app['auth']->guard($routeGuard)->user();
            });
            $this->app['auth']->setDefaultDriver($routeGuard);
        });
    }
}
