<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class KwitansiPembayaranController extends Controller
{
    public function show($id) 
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $data['pembayaran'] = $pembayaran;
        $data['title'] = 'Kwitansi Pembayaran '.$pembayaran->id;
        return view('kwitansi_pembayaran', $data);
    }
}
