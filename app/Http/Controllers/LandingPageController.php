<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Landingpage;
use App\Services\WhacenterService;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Biaya::has('children')->whereNull('parent_id')->get();
        return view('landing_page', [
            'listBiaya' => $models->pluck('nama', 'id'),
            'title' => 'Landing Page',
            'models' => $models,
            'sponsor' => Landingpage::where('jenis', 'sponsor')->get(),
            'services' => Landingpage::where('jenis', 'services')->get(),
            'berita' => Landingpage::where('jenis', 'berita')->get(),
            'slider' => Landingpage::where('jenis', 'slider')->get(),
        ]);
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
        $request->validate([
            'nama' => 'required',
            'email' => 'nullable',
            'nohp' => 'required',
            'biaya' => 'required',
            'alamat' => 'required',
        ]);

        $nama = $request->input('nama');
        $email = $request->input('email');
        $nohp = $request->input('nohp');
        $alamat = $request->input('alamat');
        $paket = Biaya::whereNull('parent_id')->findOrFail($request->input('biaya'))->nama;
        // Format pesan untuk WhatsApp
        $pesan = "Daftar Pasang Baru%0A"
            . "Nama: " . $nama . "%0A"
            . "Email: " . $email . "%0A"
            . "No HP: " . $nohp . "%0A"
            . "Paket: " . $paket . "%0A"
            . "Alamat: " . urlencode($alamat);

        // if ($request->has('nohp')) {
        //     $ws = new WhacenterService();
        //     $ws->line("Hai Sobat, terimakasih sudah menghubungi ". Settings('app_name'))
        //     ->line("berikut data diri anda, apakah sudah benar?")
        //     ->line($pesan)
        //     ->line("jika sudah benar balas" . '"IYA"' . "dan team kami akan segera menuju lokasi anda")
        //     ->to($request->nohp)->send();
        // }
        
        $pesanWa = "https://wa.me/". Settings('app_phone'). '?text='. $pesan;
        return redirect()->away($pesanWa);
        // return "<script>window.open('".$pesanWa."', '_blank')</script>";
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
        //
    }
}
