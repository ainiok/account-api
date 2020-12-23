<?php
/**
 * Author: xiaojin
 * Email: job@ainiok.com
 * Date: 2020/12/23 19:30
 */

namespace App\Channels;

use Illuminate\Notifications\Notification;

class SmsChannel
{
    /**
     * 发送给定通知.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);
        $message->send();
    }
}
