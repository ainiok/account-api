<?php

namespace App\Notifications;

use App\Models\MailCaptcha;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CaptchaNotify extends Notification
{
    use Queueable;

    protected $driver;

    /**
     * Create a new notification instance.
     *
     * @param string $driver
     * @return void
     */
    public function __construct($driver = 'default')
    {
        $this->driver = $driver;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        switch ($this->driver) {
            case 'sms':
                return [];
            case 'mail':
                return ['mail'];
            default:
                return [];
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $code = MailCaptcha::genCodeAndStore($notifiable->email);
        return (new MailMessage())->view(
            'emails.code', ['code' => $code]
        )->subject(trans('email.captcha.subject'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
