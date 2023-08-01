<?php

namespace App\Http\Controllers;

use App\Models\BankSkynet;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\User;
use App\Notifications\PembayaranNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Notification;

class SkyMemberPembayaranController extends Controller
{
    public function index() {
        $pembayaran = Pembayaran::where('client_id', Auth::user()->id)
            ->latest()
            ->orderBy('tanggal_konfirmasi', 'desc')
            ->paginate(50);
        $data['models'] = $pembayaran;
        return view('client.pembayaran_index', $data);
    }

    public function show(Pembayaran $pembayaran) {
        Auth::user()->unreadNotifications->where('id', request('id'))->first()?->markAsRead();
        return view('client.pembayaran_show', [
            'model' => $pembayaran,
        ]);
    }

    public function create(Request $request)
    {
        // $data['tagihan'] = Tagihan::where('id', $request->tagihan_id)->first();
        $data['tagihan'] = Tagihan::clientMember()->findOrFail($request->tagihan_id);
        $data['model'] = new Pembayaran();
        $data['method'] = 'POST';
        $data['route'] = 'client.pembayaran.store';
        $data['listBank'] = BankSkynet::pluck('nama_bank', 'id');
        if ($request->bank_skynet_id != '') {
            $data['bankYangDipilih'] = BankSkynet::findOrFail($request->bank_skynet_id);
        }
        $data['url'] = route('client.pembayaran.create', [
            'tagihan_id' => $request->tagihan_id,
        ]);
        return view('client.pembayaran_form',$data);
    }
    public function store(Request $request){
        if ($request->bank_skynet_id == '') {
            flash()->addError('Bank Tujuan wajib diisi');
            return back();
        }
        $jumlahDibayar = str_replace('.', '', $request->jumlah_dibayar);

        $validasiPembayaran = Pembayaran::where('jumlah_dibayar', $jumlahDibayar)
            ->where('tagihan_id', $request->tagihan_id)
            // ->where('status_konfirmasi', 'belum')
            ->where('tanggal_konfirmasi', null)
            ->first();
        if ($validasiPembayaran != null) {
            flash()->addError('Data pembayaran ini sudah ada, mohon tunggu konfirmasi dari admin');
            return back();
        }

        $request->validate([
            'tanggal_bayar' => 'required',
            'jumlah_dibayar' => 'required',
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $buktiBayar = $request->file('bukti_bayar')->store('public');
        $dataPembayaran = [
            'bank_skynet_id' => $request->bank_skynet_id,
            'tagihan_id' => $request->tagihan_id,
            'client_id' => auth()->user()->id,
            'tanggal_bayar' => $request->tanggal_bayar . ' ' . date('H:i:s'),
            // 'status_konfirmasi' => 'belum',
            'jumlah_dibayar' => $jumlahDibayar,
            'bukti_bayar' => $buktiBayar,
            'metode_pembayaran' => 'transfer',
            'user_id' => 0,
        ];

        // Validasi pembayaran harus lunass
        // $tagihan = Tagihan::findOrFail($request->tagihan_id);
        // if ($jumlahDibayar >= $tagihan->total_tagihan) {
        //     DB::beginTransaction();
        //     try {
        //         $pembayaran = Pembayaran::create($dataPembayaran);
        //         $userAdmin = User::where('akses', 'admin')->get();
        //         Notification::send($userAdmin, new PembayaranNotification($pembayaran));
        //         DB::commit();
        //     } catch (\Throwable $th) {
        //         DB::rollback();
        //         flash()->addError('Gagal menyimpan data pembayaran, ' . $th->getMessage());
        //         return back();
        //     }
        // } else {
        //     DB::rollBack();
        //     flash()->addError('Jumlah pembayaran tidak boleh kurang dari total tagihan');
        //     return back();
        // }

        // Koding awal tanpa harus lunas
        DB::beginTransaction();
        try {
            // $pembayaran = Pembayaran::create($dataPembayaran);
            $pembayaran = new Pembayaran();
            $pembayaran->fill($dataPembayaran);
            $pembayaran->saveQuietly();
            $userAdmin = User::where('akses', 'admin')->get();
            Notification::send($userAdmin, new PembayaranNotification($pembayaran));
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            flash()->addError('Gagal menyimpan data pembayaran, ' . $th->getMessage());
            return back();
        }
        // end koding awal
        flash('Data pembayaran berhasil disimpan dan akan segera di konfirmasi oleh admin');
        return redirect()->route('client.pembayaran.show', $pembayaran->id);
    }
    public function destroy($id) {
        $pembayaran = Pembayaran::findOrFail($id);
        if ($pembayaran->tanggal_konfirmasi != null) {
            flash()->addError('Data pembayaran ini sudah di konfirmasi, tidak bisa dihapus');
            return back();
        }
        \Storage::delete($pembayaran->bukti_bayar);
        $pembayaran->delete();
        flash('Data pembayaran berhasil dihapus');
        return redirect()->route('client.tagihan.index');
    }
}
