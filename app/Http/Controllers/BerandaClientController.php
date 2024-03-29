<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientMemberCollection;
use App\Http\Resources\ClientMemberResource;
use App\Models\Member;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaClientController extends Controller
{
    public function index()
    {
        $member = Member::with('tagihan')->where('client_id', auth()->user()->id)->orderBy('nama', 'asc')->get();

        // Perulangan data member | untuk menampilkan rekap tagihan
        foreach ($member as $itemMember) {
            $dataTagihan = [];
            $tahun = date('Y');
            foreach (bulanTagihan() as $bulan) {
                // Mencari tagihan berdasarkan member, tahun, dan bulan
                $tagihan = $itemMember->tagihan->filter(function ($value) use ($bulan, $tahun) {
                    return $value->tanggal_tagihan->year == $tahun && $value->tanggal_tagihan->month == $bulan;
                })->first();
        
                // Inisialisasi variabel pembayaran dan tanggal konfirmasi
                $pembayaran = null;
                $tanggalKonfirmasi = null;

                // Periksa jika tagihan ada
                if ($tagihan) {
                    $pembayaran = $tagihan->pembayaran->first();
                    $tanggalKonfirmasi = $pembayaran ? $pembayaran->tanggal_konfirmasi : null;
                }
                
                // masukan data ke array
                $statusBayar = "baru";
                if ($tagihan == null) {
                    $statusBayar = "-";
                }elseif ($tagihan->status != '') {
                    $statusBayar = $tagihan->status;
                    $pembayaran = $tagihan->pembayaran->whereNull('tanggal_konfirmasi');
                    if ($pembayaran->count() >= 1) {
                        $statusBayar = "belum";
                    }
                }
                $dataTagihan[] = [
                    'bulan' => ubahNamaBulan($bulan),
                    'tahun' => $tahun,
                    'tagihan' => $tagihan,
                    // 'total_tagihan' => $tagihan->total_tagihan ?? 0,
                    // 'status_tagihan' => ($tagihan == null) ? false:true,
                    'status_pembayaran' => $statusBayar,
                    // 'status_bayar_teks' => ($tagihan->status == null) ? 'Belum Bayar' : 'Sudah Bayar',
                    // 'tanggal_lunas' => $tagihan->tanggal_lunas ?? ' ',
                    'tanggal_konfirmasi' => $tanggalKonfirmasi ?? ' ',
                ];

            }
            $dataRekap[] = [
                'member' => $itemMember,
                'dataTagihan' => $dataTagihan
            ];
        }
        $data['dataRekap'] = $dataRekap;
        $data['header'] = bulanTagihan();
        $memberId = Auth::user()->member()->pluck('id');
        // dd($membersId);
        $tagihan = Tagihan::whereIn('member_id', $memberId)->get();
        $data['tagihan'] = $tagihan->where('status', '<>', 'lunas');
        // dd($tagihan);

        if (request()->wantsJson()) {
            return response()->json($data, 200);
        }
        return view('client.beranda_index', $data);
    }

    public function indexApi() {
        $member = Member::with('tagihan')->where('client_id', auth()->user()->id)
        ->orderBy('nama', 'asc')->first();
        return $this->successResponse("Data sudah disimpan");
    }
}
