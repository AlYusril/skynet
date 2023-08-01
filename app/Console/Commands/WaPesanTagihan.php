<?php

namespace App\Console\Commands;

use App\Models\Tagihan;
use App\Services\WhacenterService;
use Illuminate\Console\Command;

class WaPesanTagihan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pesanwa:tagihan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tagihan = Tagihan::with('member', 'tagihanDetails')->where('status', 'baru')->get();
        $templateTeks = Settings('pesan_tagihan');
        if ($templateTeks != '') {
            foreach ($tagihan as $item) {
                $rincianTagihan = [];

            foreach ($item->tagihanDetails as $detail) {
                $rincianTagihan[] = $detail->nama_biaya.': '. formatRupiah($detail->jumlah_biaya);
            }
        
                $templateReplace = [
                    '{bulan}' => $item->tanggal_tagihan->month,
                    '{tahun}' => $item->tanggal_tagihan->year,
                    '{nama}' => $item->member->nama,
                    '{idpel}' => $item->member->idpel,
                    '{tagihan}' => formatRupiah($item->tagihanDetails->sum('jumlah_biaya')),
                    '{rincianTagihan}' => implode("\n", $rincianTagihan),
                ];
                $pesan = str_replace(array_keys($templateReplace), array_values($templateReplace), $templateTeks);
        
                if ($item->member->client != null && $item->member->client->nohp != null) {
                    $ws = new WhacenterService();
                    $ws->line($pesan)->to($item->member->client->nohp)->send();
                }
            }
        }     
        $this->info('Pesan WA pengingat tagihan berhasil dikirim');

        // Test pengiriman
        // $ws = new WhacenterService();
        // $ws->line('test wa scheduler')->to('6281334746312')->send();
    }
}
