<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use Illuminate\Http\Request;

class BiayaUpdateStatus extends Controller
{
    public function __invoke(Request $request) 
    {
        $biaya = Biaya::whereNull('parent_id');
        $biayaIds = $request->biaya_id;
        $allBiayaIds = $biaya->pluck('id')->toArray();

        // Ambil semua ID yang tidak dicentang
        $uncheckedIds = array_diff($allBiayaIds, $biayaIds);

        // Gunakan metode update untuk mengubah status menjadi 'promo' pada checkbox yang dicentang
        $biaya->whereIn('id', $biayaIds)
            ->update(['status' => 'promo', 'status_paket' => 'aktif']);

        // Gunakan metode update untuk mengubah status menjadi 'baru' pada checkbox yang tidak dicentang
        $biaya->whereIn('id', $uncheckedIds)
            ->update(['status' => '']);

        $biayas = Biaya::whereNull('parent_id');
        $statusPaketIds = $request->biaya_status_id;
        $uncheckedPaketIds = array_diff($allBiayaIds, $statusPaketIds);
        $biayas->whereIn('id', $statusPaketIds)
            ->update(['status_paket' => 'aktif']);
        
        Biaya::whereNull('parent_id')
            ->whereIn('id', $uncheckedPaketIds)
            ->update(['status_paket' => 'non-aktif', 'status' => '']);
        return response()->json([
            'message' => 'Status berhasil di update',
        ], 200);
    }
}
