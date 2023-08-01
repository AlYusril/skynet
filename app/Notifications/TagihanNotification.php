<?php

namespace App\Notifications;

use App\Channels\WhacenterChannel;
use App\Services\WhacenterService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use URL;

class TagihanNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $tagihan;
    public function __construct($tagihan)
    {
        $this->tagihan = $tagihan;
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
            'tagihan_id' => $this->tagihan->id,
            'title' => 'Tagihan Internet ' . $this->tagihan->member->nama,
            'messages' => 'Tagihan Pelanggan Bulan ' . $this->tagihan->tanggal_tagihan->translatedFormat('F Y'),
            'url' => route('client.tagihan.show', $this->tagihan->id),
        ];
    }

    public function toWhacenter($notifiable)
    {
        $url = URL::temporarySignedRoute(
            'login.url',
            now()->addMinutes(30),
            [
                'tagihan_id' => $this->tagihan->id,
                'user_id' => $notifiable->id,
                'url' => route('client.tagihan.show', $this->tagihan->id)
            ]
        );
        $bulanTagihan = $this->tagihan->tanggal_tagihan->translatedFormat('F Y');
        return (new WhacenterService())
            ->to($notifiable->nohp)
            ->line("Hai Pelanggan Setia Skynet,")
            ->line("Berikut kami informasikan untuk tagihan internet untuk bulan " . $bulanTagihan. 'atas nama ' . $this->tagihan->member->nama)
            ->line('Jika sudah melakukan pembayaran abaikan pesan ini')
            ->line("Atau silahkan cek link berikut untuk informasi lengkapnya" . $url)
            ->line("Link berlaku sementara, dan jangan dibagikan ke siapapun");
    }
}
