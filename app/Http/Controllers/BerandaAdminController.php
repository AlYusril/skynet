<?php

namespace App\Http\Controllers;

use App\Charts\PembayaranStatusChart;
use App\Charts\TagihanBulananChart;
use App\Charts\TagihanStatusChart;
use App\Models\Member;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class BerandaAdminController extends Controller
{
    public function index(
        TagihanBulananChart $tagihanBulananChart, 
        TagihanStatusChart $tagihanStatusChart, 
        PembayaranStatusChart $pembayaranStatusChart
        )
    {
        $tahun = date('Y');
        $bulan = date('m');

        $pembayaranNull = Pembayaran::whereNull('tanggal_konfirmasi')->get();
        $data['pembayaranBelumKonfirmasi'] = $pembayaranNull;
        $data['nominalBelumKonfirmasi'] = $pembayaranNull->sum('jumlah_dibayar');
        $data['member'] = Member::count();

        $tagihan = Tagihan::with('member')->whereYear('tanggal_tagihan', $tahun)
            ->whereMonth('tanggal_tagihan', $bulan)->get();
        $tagihanPerPaket = $tagihan->groupBy('member.desa')->sortKeys();

        $tagihanBelumBayar = $tagihan->where('status', '<>', 'lunas');
        $tagihanSudahBayar = $tagihan->where('status', 'lunas');

        $pembayaran = Pembayaran::whereYear('tanggal_bayar', $tahun)
            ->whereMonth('tanggal_bayar', $bulan)->get();
            
        $data['tagihanPerPaket'] = $tagihanPerPaket;
        $data['totalTagihan'] = $tagihan->count();
        $data['totalPembayaran'] = $pembayaran->sum('jumlah_dibayar');
        $data['totalMemberBayar'] = $pembayaran->count();
        $data['totalMemberBayar'] = $pembayaran->count();
        $data['tagihanSudahBayar'] = $tagihanSudahBayar;
        $data['tagihanBelumBayar'] = $tagihanBelumBayar;
        $data['tahun'] = $tahun;
        $data['bulan'] = ubahBulanLaravel($bulan);

        $data['tagihanChart'] = $tagihanBulananChart->build([
            $tagihanBelumBayar->count(),
            $tagihanSudahBayar->count(),
        ]);
        // Chart Tagihan berdasarkan status
        $labelTagihanStatusChart = ['lunas', 'angsur', 'baru'];
        $dataTagihanStatusChart = [
            $tagihan->where('status', 'lunas')->count(),
            $tagihan->where('status', 'angsur')->count(),
            $tagihan->where('status', 'baru')->count(),
        ];
        $data['tagihanStatusChart'] = $tagihanStatusChart->build($labelTagihanStatusChart, $dataTagihanStatusChart);

        // Chart pembayaran berdasarkan status
        $labelPembayaranChart = ['Sudah Dikonfirmasi', 'Belum Dikonfirmasi'];
        $dataPembayaranChart = [
            $pembayaran->whereNotNull('tanggal_konfirmasi')->count(),
            $pembayaran->whereNull('tanggal_konfirmasi')->count(),
        ];
        $data['pembayaranStatusChart'] = $pembayaranStatusChart->build($labelPembayaranChart, $dataPembayaranChart);
        return view('admin.beranda_index', $data);
    }
}
