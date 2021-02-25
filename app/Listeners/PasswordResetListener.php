<?php

namespace App\Listeners;

use App\Events\PasswordResetEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PasswordResetListener
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
     * @param  PasswordResetEvent  $event
     * @return void
     */
    public function handle(PasswordResetEvent $event)
    {
        // 短信通知
        // 邮件通知
    }
}
