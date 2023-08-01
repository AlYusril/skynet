<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Collection\Collection;

class KartuSppController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->akses == 'client') {
            $member = Member::where('client_id', Auth::user()->id)
            ->where('id', $request->member_id)
            ->firstOrFail();
        } else {
            $member = Member::with('tagihan')->findOrFail($request->member_id);
        }
        $tahun = $request->tahun;
        $arrayData = [];
        foreach (bulanTagihan() as $bulan) {
            // if ($bulan == 1) {
            //     $tahun = $tahun + 1;
            // }
            // mencari tagihan berdasarkan member, tahun dan bulan
            $tagihan = $member->tagihan->filter(function ($value) use ($bulan, $tahun) {
                return $value->tanggal_tagihan->year == $tahun && $value->tanggal_tagihan->month == $bulan;
            })->first();
            $tanggalBayar = '';
            // jika tagihan tidak kosong dan status tidak baru, berarti sudah bayar, ambil tanggal bayar
            if ($tagihan != null && $tagihan->status != 'baru') {
                $tanggalBayar = $tagihan->pembayaran->first()->tanggal_bayar->format('d/m/Y');
            };
            // masukan data ke array
            $arrayData[] = [
                'bulan' => ubahNamaBulan($bulan),
                'tahun' => $tahun,
                'total_tagihan' => $tagihan->total_tagihan ?? 0,
                'status_tagihan' => ($tagihan == null) ? false:true,
                'status_pembayaran' => ($tagihan == null) ? 'Belum Bayar' : $tagihan->status,
                'tanggal_bayar' => $tanggalBayar,
            ];

        }
        if (request('output') == 'pdf') {
            $pdf = Pdf::loadView('kartumember_index', [
                'kartuMember' => collect($arrayData),
                'member' => $member,
            ]);
            $namaFile = 'kartu_member_' . $member->nama . '_' . $request->tahun . '.pdf';
            return $pdf->download($namaFile);
        }
        return view('kartumember_index',[
            'kartuMember' => collect($arrayData),
            'member' => $member,
        ]);
    }
}
