<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'Illuminate\Database\Events\QueryExecuted' => [
            '\App\Listeners\QueryListener',
        ],
        'App\Events\LoginEvent'   => [
            '\App\Listeners\LoginListener',
        ],
        'App\Events\LogoutEvent'  => [
            '\App\Listeners\LogoutListener',
        ],
        'App\Events\LockoutEvent' => [
            '\App\Listeners\LoginLockoutListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
