<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Landingpage as Model;

class SettingSponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Model::where('jenis', 'sponsor')->get();
        return view('admin.setting_sponsor_form',[
            'models' => $models,
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
        $requestData = $request->validate([
            'judul' => 'required',
            'gambar' => 'required|mimes:png,jpg,jpeg,svg|max:2048',
            'konten' => 'nullable',
        ]);
        $requestData['jenis'] = 'sponsor';
        if ($request->hasFile('gambar')) {
            $requestData['gambar'] = $request->file('gambar')->store('public');
        }
        Model::create($requestData);
        flash('Gambar berhasil di upload');
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
        $models = Model::findOrFail($id);
        $models->delete();
        flash('Gambar berhasil dihapus');
        return back();
    }
}
