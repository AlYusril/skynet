<?php

namespace App\Notifications;

use App\Channels\WhacenterChannel;
use App\Services\WhacenterService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use URL;

class PembayaranNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $pembayaran;
    public function __construct($pembayaran)
    {
        $this->pembayaran = $pembayaran;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', WhacenterChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'tagihan_id' => $this->pembayaran->tagihan_id,
            'client_id' => $this->pembayaran->client_id,
            'pembayaran_id' => $this->pembayaran->id,
            'title' => 'Pembayaran Tagihan',
            'messages' => $this->pembayaran->client->name . ' Melakukan pembayaran tagihan. ',
            'url' => route('pembayaran.show', $this->pembayaran->id),
        ];
    }

    public function toWhacenter($notifiable)
    {
        $url = URL::temporarySignedRoute(
            'login.url',
            now()->addMinutes(30),
            [
                'pembayaran_id' => $this->pembayaran->id,
                'user_id' => $notifiable->id,
                'url' => route('pembayaran.show', $this->pembayaran->id)
            ]
        );
        return (new WhacenterService())
            ->to($notifiable->nohp)
            ->line("Hallo Admin,")
            ->line("Ada Pembayaran Tagihan Pelanggan,")
            ->line($this->pembayaran->client->name . ' Melakukan pembayaran tagihan.')
            ->line("Klik link berikut untuk info selengkapnya: " . $url)
            ->line("Link khusus JANGAN DIBAGIKAN");
    }
}
