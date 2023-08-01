<?php

namespace App\Http\Controllers;

use App\Services\WhacenterService;
use Illuminate\Http\Request;
use QCod\Settings\Setting\Setting;

class SettingController extends Controller
{
    public function index() 
    {
        return view('admin.setting_form');
    }

    public function store(Request $request) 
    {
        // Test Koneksi WA
        if ($request->has('tes_wa')) {
            $ws = new WhacenterService();
            $statusSend = $ws->line("testing koneksi WA")->to($request->tes_wa)->send();
            if ($statusSend) {
                session()->flash('success', 'Data sudah dikirim. Status: ' . $ws->getMessage());
            } else {
                session()->flash('error', 'Data Gagal dikirim. Status: ' . $ws->getMessage());
            }
            if ($request['wha_device_id'] == null) {
                return back();
            }
        }
        
        // End Test
        $dataSettings = $request->except('_token');
        if ($request->hasFile('app_logo')) {
            $request->validate([
                'app_logo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $dataSettings['app_logo'] = $request->file('app_logo')->store('public');
        }
        settings()->set($dataSettings);
        flash('Data sudah disimpan');
        return back();
    }
}
