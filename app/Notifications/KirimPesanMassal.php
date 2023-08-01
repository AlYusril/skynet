<?php

namespace App\Notifications;

use App\Services\WhacenterService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class KirimPesanMassal extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $channels;
    private $pesan;
    public function __construct(array $channels, String $pesan)
    {
        $this->channels = $channels;
        $this->pesan = $pesan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return $this->channels;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line($this->pesan);
    }

    public function toWhacenter($notifiable)
    {
        return (new WhacenterService())
            ->to($notifiable->nohp)
            ->line($this->pesan);
    }
}
