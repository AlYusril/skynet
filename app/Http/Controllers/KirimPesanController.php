<?php

namespace App\Http\Controllers;

use App\Channels\WhacenterChannel;
use App\Models\Member;
use App\Models\User;
use App\Notifications\KirimPesanMassal;
use Illuminate\Http\Request;

class KirimPesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.kirimpesan_form',[
            'clientList' => User::where('akses','client')->get()->pluck('name_with_nohp','id'),
            'desaList' => Member::distinct('desa')->pluck('desa'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // return view('admin.kirimpesan_form',[
        //     'clientList' => User::where('akses','client')->get()->pluck('name_with_nohp','id'),
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'nullable',
            'desa_id' => 'nullable',
            'pesan' => 'required',
            'channels' => 'required',
        ]);
        $channels = $request->channels;
        if (in_array('whatsapp', $channels)) {
            // array search and replace whatsapp
            $channels[array_search('whatsapp', $channels)] = WhacenterChannel::class;
        }
        // Short by user client
        $users = User::where('akses', 'client');
        if ($request->client_id) {
            $users->where('id', $request->client_id);
            $users->get()->each(function ($users) use ($request, $channels) {
                $users->notify(new KirimPesanMassal($channels, $request->pesan));
            });
        }
        // Short by Desa
        if ($request->desa_id != null) {
            $desa = Member::whereNotNull('nohp');
            $desa->where('desa', $request->desa_id);
            $desa->get()->each(function ($desa) use ($request, $channels) {
                $desa->notify(new KirimPesanMassal($channels, $request->pesan));
            });
        } else {
            $users->get()->each(function ($users) use ($request, $channels) {
                $users->notify(new KirimPesanMassal($channels, $request->pesan));
            });
        }

        // $users->get()->each(function ($users) use ($request, $channels) {
        //     $users->notify(new KirimPesanMassal($channels, $request->pesan));
        // });
        flash('Pesan berhasil dikirim');
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
        //
    }
}
