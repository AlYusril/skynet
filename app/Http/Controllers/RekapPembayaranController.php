<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class RekapPembayaranController extends Controller
{
    public function index(Request $request) {
        $member = Member::orderBy('nama', 'asc');
        // if ($request->filled('biaya_id')) {
        //     $member->where('biaya_id', $request->biaya_id);
        // }

        if ($request->filled('biaya')) {
            $member = $member->whereHas('tagihan', function ($q) use ($request) {
                $q->whereHas('member', function ($q) use ($request){
                    $q->where('biaya_id', $request->biaya);
                });
            });
        }
        $member = $member->get(); //hapus take untuk munculkan banyak data
        $tahun = $request->tahun;
        // perulangan data member
        foreach ($member as $itemMember) {
            $dataTagihan = [];
            foreach (bulanTagihan() as $bulan) {
                // if ($bulan == 1) {
                //     $tahun = $tahun + 1;
                // }
                // mencari tagihan berdasarkan member, tahun dan bulan
                $tagihan = $itemMember->tagihan->filter(function ($value) use ($bulan, $tahun) {
                    return $value->tanggal_tagihan->year == $tahun && $value->tanggal_tagihan->month == $bulan;
                })->first();
                
                // masukan data ke array
                $dataTagihan[] = [
                    'bulan' => ubahNamaBulan($bulan),
                    'tahun' => $tahun,
                    'total_tagihan' => $tagihan->total_tagihan ?? 0,
                    'status_tagihan' => ($tagihan == null) ? false:true,
                    'status_pembayaran' => ($tagihan == null) ? 'Belum Bayar' : $tagihan->status,
                    'tanggal_lunas' => $tagihan->tanggal_lunas ?? '-',
                ];

            }
            $dataRekap[] = [
                'member' => $itemMember,
                'dataTagihan' => $dataTagihan
            ];
        }
        $data['dataRekap'] = $dataRekap;
        $data['header'] = bulanTagihan();
        $data['title'] = 'Rekap Data Tahunan';
        return view('admin.rekappembayaran_index', $data);
    }
}
