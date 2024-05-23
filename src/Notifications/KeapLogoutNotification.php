<?php

namespace KeapGeek\Keap\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class KeapLogoutNotification extends Notification
{
    use Queueable;

    protected string $url;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->url = url('/keap/auth');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return config('keap.logout.via');
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('[ERROR] Keap Logout - '.config('app.name'))
            ->line('Keap has logged out, from '.config('app.env').' environment.')
            ->line('Click here to log in:')
            ->action('Keap Login', $this->url);
    }

    public function toTelegram(object $notifiable)
    {
        return (new TelegramMessage)
            ->to($notifiable->telegram_id)
            ->line('[ERROR] Keap Logout - '.config('app.name').' '.config('app.env'))
            ->button('Click here to Log In', $this->url, 1);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
