<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetNotify extends Notification
{
    use Queueable;

    protected $driver;

    /**
     * Create a new notification instance.
     *
     * @param string $driver
     */
    public function __construct($driver = 'email')
    {
        $this->driver = $driver;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        switch ($this->driver) {
            case 'sms':
                return [SmsChannel::class];
            default:
                return ['mail'];
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->view('emails.password.reset', [
                'name' => $notifiable->name,
                'time' => date('Y-m-d H:i:s'),
                'link' => env('APP_URL') . env('RESET_PASSWORD_URL')
            ])
            ->subject(trans('email.password_reset.subject', ['app_name'=>env('APP_NAME')]));
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
