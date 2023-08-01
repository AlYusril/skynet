<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class LaporanPembayaranController extends Controller
{
    public function index(Request $request) {
        $models = Pembayaran::query();
        $title = "";
        $data = [
            'listBiaya' => Biaya::has('children')->whereNull('parent_id')->pluck('nama', 'id'),
        ];
        
        if ($request->filled('tahun')) {
            $models = $models->whereYear('tanggal_bayar', $request->tahun);
            $title = $title . " Tahun " . $request->tahun;
        }

        if ($request->filled('bulan')) {
            $models = $models->whereMonth('tanggal_bayar', $request->bulan);
            $title = " Bulan " . ubahNamaBulan($request->bulan);
        }

        if ($request->filled('status')) {
            $models = $models->where('status', $request->status);
            $title = $title . " Status Tagihan " . $request->status;
        }

        if ($request->filled('biaya')) {
            $models = $models->whereHas('tagihan', function ($q) use ($request) {
                $q->whereHas('member', function ($q) use ($request){
                    $q->where('biaya_id', $request->biaya);
                });
            });
            $title = $title . " Paket " . $data['listBiaya'][$request->biaya];
        }
// dd($request->tahun);
        $models = $models->get();
        return view('admin.laporanpembayaran_index', compact('models', 'title'));
    }
}
