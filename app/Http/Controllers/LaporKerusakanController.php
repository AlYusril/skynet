<?php

namespace App\Http\Controllers;

use App\Models\LaporanKendala;
use App\Models\Member;
use App\Models\User;
use App\Services\WhacenterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporKerusakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'member' => Member::whereNotNull('client_id')->pluck('nama', 'id'),
            'laporan' => LaporanKendala::with('member')
            ->orderByRaw("CASE WHEN status = 'Belum' THEN 1 WHEN status = 'On-Process' THEN 2 ELSE 3 END")
            ->orderBy('updated_at')
            // ->latest() // Optional, jika Anda ingin urutkan secara descending berdasarkan created_at
            ->paginate(settings()->get('app_pagination', '50')),
        ];
        return view('admin.lapor_kerusakan_form', $data);
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
    public function store(Request $request)
    {
        $user = Auth::user();
        $member = Member::findOrFail($request->input('member_id'));
        $request->validate([
            'member_id' => 'required',
            'pesan' => 'required',
        ]);
        $tiket_id = rand(1000, 9999);
        $pelapor = $user->name;
        $nama = $member->nama;
        $alamat = $member->alamat_lengkap;
        $pesan = $request->input('pesan');
        $admin = User::where('akses', 'admin')->pluck('nohp');

        LaporanKendala::create([
            'user_id' => $user->id,
            'member_id' => $request->input('member_id'),
            'tiket_id' => $tiket_id,
            'pesan' => $pesan,
            'status' => 'Belum',
        ]);

        $ws = New WhacenterService();
        $ws->line("*Komplain Pelanggan*")
            ->line("\nPelapor : ". $pelapor)
            ->line("\nNama Pelanggan: *".$nama.'*' )
            ->line("Alamat : ". $alamat)
            ->line("Tiket Laporan : #". $tiket_id)
            ->line("\nPesan : ". $pesan);
        foreach ($admin as $nomor) {
            $ws->to($nomor)->send();
        }
        
        flash('laporan berhasil dikirim');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $laporan = LaporanKendala::findOrFail($id);
        $member = Member::where('id', $laporan->member_id)->first();
        if ($request->has('status')) {
            $allowedStatus = ['On-Process', 'Selesai'];
            if (in_array($request->status, $allowedStatus)) {
                $ws = New WhacenterService();
                if ($request->status == 'On-Process') {
                    $ws->line("Pelanggan Yth,\n")
                        ->line("Laporan gangguan layanan internet anda a/n ". $member->nama .
                                ", dengan tiket gangguan (#". $laporan->tiket_id. ") telah kami terima")
                        ->line("Kami akan melakukan perbaikan dan apabila diperlukan teknisi kami akan memeriksa / memperbaiki di rumah Bpk/Ibu.")
                        ->line("Mohon ditunggu, estimasi perbaikan < 24 jam, terima kasih.");
                    $ws->to($member->nohp)->send();
                }
                if ($request->status == 'Selesai') {
                    $ws->line("Laporan gangguan anda dengan tiket gangguan (#". $laporan->tiket_id. ") telah selesai diperbaiki")
                        ->line("Jika masih berkendala, silahkan hubungi kembali, terima kasih");
                    $ws->to($member->nohp)->send();
                }
                // dd($request->status);
                $laporan->status = $request->status;
                $laporan->save();
            }
        } else {
            // Handle delete request
            $laporan->delete();
        }
        flash('Laporan berhasil diperbarui');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laporan = LaporanKendala::findOrFail($id);
        $laporan->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}
