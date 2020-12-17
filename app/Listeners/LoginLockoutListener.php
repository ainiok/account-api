<?php

namespace App\Listeners;

use App\Events\LockoutEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginLockoutListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LockoutEvent  $event
     * @return void
     */
    public function handle(LockoutEvent $event)
    {
        //
    }
}
