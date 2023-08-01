<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Http\Requests\StorePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;
use App\Models\Tagihan;
use App\Notifications\PembayaranKonfirmasiNotification;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $models = Pembayaran::latest();
        if ($request->filled('q')) {
            $models = $models->whereHas('tagihan', function ($q) {
                $q->whereHas('member', function ($q) {
                    $q->where('nama', 'like', '%' . request('q') . '%');
                });
            });
        }

        if ($request->filled('tahun')) {
            $models = $models->whereYear('tanggal_bayar', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $models = $models->whereMonth('tanggal_bayar', $request->bulan);
        }

        if ($request->filled('status')) {
            if ($request->status == 'sudah') {
                $models = $models->whereNotNull('tanggal_konfirmasi');
            }

            if ($request->status == 'belum') {
                $models = $models->whereNull('tanggal_konfirmasi');
            }
        }

        $data['models'] = $models->orderBy('tanggal_konfirmasi','desc')->paginate(50);
        $data['title'] = 'Data Pembayaran';
        return view('admin.pembayaran_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePembayaranRequest $request)
    {
        $requestData = $request->validated();
        $requestData['tanggal_konfirmasi'] = now();
        $requestData['metode_pembayaran'] = 'manual';
        $tagihan = Tagihan::findOrFail($requestData['tagihan_id']);
        $requestData['client_id'] = $tagihan->member->client_id ?? 0;
        
        // simpan pembayaran
        $pembayaran = Pembayaran::create($requestData);
        // kirim notifikasi
        $client = $pembayaran->client;
        if ($client != null) {
            $client->notify(new PembayaranKonfirmasiNotification($pembayaran));
        }
        flash('Pembayaran berhasil disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        auth()->user()->unreadNotifications->where('id', request('id'))->first()?->markAsRead();
        return view('admin.pembayaran_show',[
            'model' => $pembayaran,
            'route' => ['pembayaran.update', $pembayaran->id]
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        // $pembayaran->status_konfirmasi = 'sudah';
        $client = $pembayaran->client;
        $client->notify(new PembayaranKonfirmasiNotification($pembayaran));
        $pembayaran->tanggal_konfirmasi = now();
        $pembayaran->user_id = auth()->user()->id;
        $pembayaran->save();
        
        flash('Data pembayaran berhasil dikonfirmasi');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        flash('Data pembayaran berhasil dihapus');
        return back();
    }
}
