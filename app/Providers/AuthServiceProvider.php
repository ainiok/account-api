<?php

namespace App\Providers;

use App\Services\Auth\XAdminGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Laravel\Passport\RouteRegistrar;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes(function (RouteRegistrar $router) {
            $router->forAuthorization();
        });
        // access token默认是长期有效，下面修改默认有效期
        Passport::tokensExpireIn(now()->addDays(1));
        Passport::refreshTokensExpireIn(now()->addDays(7));
        Passport::personalAccessTokensExpireIn(now()->addMonths(1));

        Auth::extend('xAdmin', function ($app, $name, array $config) {
            dd($config);
            // $provider = $this->createUserProvider($config['provider'] ?? null);
            //
            //  $guard = new SessionGuard($name, $provider, $this->app['session.store']);
            $provider = Auth::createUserProvider($config['provider'] ?? null);
            return new XAdminGuard();
        });
    }
}
