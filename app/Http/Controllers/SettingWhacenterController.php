<?php

namespace App\Http\Controllers;

use App\Services\WhacenterService;
use Illuminate\Http\Request;

class SettingWhacenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statusKoneksiWa = false;
        try {
            $ws = new WhacenterService();
            $statusKoneksiWa = $ws->getDeviceStatus();
        } catch (\Throwable $th) {
            $statusKoneksiWa = false;
        }
        return view('admin.setting_whacenter_form', [
            'statusKoneksiWa' => $statusKoneksiWa
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Test Koneksi WA
        // if ($request->has('tes_wa')) {
        //     $ws = new WhacenterService();
        //     $statusSend = $ws->line("testing koneksi WA")->to($request->tes_wa)->send();
        //     if ($statusSend) {
        //         session()->flash('success', 'Data sudah dikirim. Status: ' . $ws->getMessage());
        //     } else {
        //         session()->flash('error', 'Data Gagal dikirim. Status: ' . $ws->getMessage());
        //     }
        //     if ($request['wha_device_id'] == null) {
        //         return back();
        //     }
        // }
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
