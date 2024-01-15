<?php

namespace App\Http\Controllers;

use App\Models\LaporanKendala;
use App\Models\Member;
use App\Models\User;
use App\Services\WhacenterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkyMemberLaporKerusakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = Auth::user()->member->pluck('nama', 'id');
        $data = [
            'member_id' => $member,
            'members' => Auth::user()->member->pluck('nama', 'id'),
            'laporan' => LaporanKendala::latest()->where('user_id', Auth::user()->id)->with('member')
            ->orderByRaw("CASE WHEN status = 'On-Process' THEN 1 WHEN status = 'Belum' THEN 2 ELSE 3 END")
            ->paginate(settings()->get('app_pagination', '50'))
        ];
        return view('client.lapor_kerusakan_form', $data);
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

        if ($member->client_id == $user->id) {
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
        }else {
            flash()->addError("ID Pelanggan salah");
        }
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
        //
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
