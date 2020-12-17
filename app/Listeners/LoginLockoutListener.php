<?php

namespace App\Listeners;

use App\Events\LockoutEvent;
use App\Models\Admin;
use App\Notifications\AlarmNotify;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

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
     * @param LockoutEvent $event
     * @return void
     */
    public function handle(LockoutEvent $event)
    {
        $email     = $event->request->email;
        $attempts  = $event->attempts;
        $userClass = '\App\Models\\' . Str::title($event->userType);
        $user      = $userClass::where('email', $email)->first();

        if ($user) {
            $message     = trans('auth.login failed', ['times' => $attempts]);
            $loginParams = [
                'login_name' => $user->email,
                'ip'         => $event->request->ip(),
                'msg'        => $message,
                'status'     => 0,
            ];
            $user->loginHistories()->create($loginParams);
            if ($user->type != Admin::SUPER_ADMIN) {
                $message = trans('auth.abnormal message', [
                    'name' => $user->email,
                    'time' => Carbon::now()
                ]);
                // todo: 告警通知
//                $user->notify(new AlarmNotify($message));
            }
        }
    }
}
