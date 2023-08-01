<?php

namespace App\Notifications;

use App\Channels\WhacenterChannel;
use App\Services\WhacenterService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PembayaranKonfirmasiNotification extends Notification
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
            'pembayaran_id' => $this->pembayaran->id,
            'title' => 'Konfirmasi Pembayaran',
            'messages' => 'Pembayaran Tagihan atas nama' . $this->pembayaran->tagihan->member->nama . ' telah di konfirmasi',
            'url' => route('client.pembayaran.show', $this->pembayaran->id)
        ];
    }

    /**
     * Summary of toWhacenter
     * @param mixed $notifiable
     * @return void
     */
    // public function toWhacenter($notifiable): WhacenterService
    public function toWhacenter($notifiable): ?WhacenterService
    {
        $bulanTagihan = $this->pembayaran->tagihan->tanggal_tagihan->translatedFormat('F Y');
        return (new WhacenterService())
            ->to($notifiable->nohp)
            ->line("Yth. Pelanggan " .settings()->get('app_name'))
            ->line("\nKami informasikan telah diterima pembayaran tagihan untuk bulan " . $bulanTagihan) 
            ->line("\natas nama " . $this->pembayaran->tagihan->member->nama)
            ->line("sebesar " . formatRupiah($this->pembayaran->jumlah_dibayar))
            ->line("Status Tagihan : *" . $this->pembayaran->tagihan->status.'*')
            ->line("\nTerima kasih atas kerja samanya, semoga sehat selalu");
    }
}
