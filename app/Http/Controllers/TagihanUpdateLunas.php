<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Notifications\PembayaranKonfirmasiNotification;
use Illuminate\Http\Request;

class TagihanUpdateLunas extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        for ($i=0; $i < count($request->tagihan_id) ; $i++) { 
            $tagihan = Tagihan::where('status', 'baru')
                ->where('id', $request->tagihan_id[$i])
                ->first();
        }
        if ($tagihan != null) {
            $dataPembayaran['tanggal_konfirmasi'] = now();
            $dataPembayaran['metode_pembayaran'] = 'manual';
            $dataPembayaran['tanggal_bayar'] = now();
            $dataPembayaran['jumlah_dibayar'] = $tagihan->total_tagihan;
            $dataPembayaran['tagihan_id'] = $tagihan->id;
            $dataPembayaran['client_id'] = $tagihan->member->client_id ?? 0;
            // Simpan pembayaran
            $pembayaran = Pembayaran::create($dataPembayaran);
            // Kirim Notifikasi pembayaran
            $client = $pembayaran->client;
            if ($client != null) {
                $client->notify(new PembayaranKonfirmasiNotification($pembayaran));
            }
        }
        return response()->json([
            'message' => 'Data berhasil disimpan',
        ], 200);
    }
}
