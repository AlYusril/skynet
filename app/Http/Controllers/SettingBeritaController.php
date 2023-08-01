<?php

namespace App\Http\Controllers;

use App\Models\Landingpage;
use Illuminate\Http\Request;
use App\Models\Landingpage as Model;
use Illuminate\Support\Facades\Storage;

class SettingBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Landingpage::where('jenis', 'berita')->get();
        return view('admin.setting_berita_index', [
            'models' => $models,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $models = new Model;
        return view('admin.setting_berita_form',[
            'models' => $models,
            'method' => 'POST',
            'route' => ['berita.store'],
            'button' => 'SIMPAN',
            'title' => 'Input Form Berita',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'required|mimes:png,jpg,svg,jpeg|max:2048',
        ]);
        $requestData['jenis'] = 'berita';
        if ($request->hasFile('gambar')) {
            $requestData['gambar'] = $request->file('gambar')->store('public');
        }
        Model::create($requestData);
        flash('Berita berhasil di upload');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $models = Model::where('jenis', 'berita')->get();
        return view('admin.setting_berita_show',[
            'models' => $models,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $models = Model::findOrFail($id);
        $data = [
            'models' => $models,
            'method' => 'PUT',
            'route' => ['berita.update', $id],
            'button' => 'UPDATE',
            'title' => 'Edit Form Services',
        ];
        // dd($data);
        return view('admin.setting_berita_form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = Model::findOrFail($id);
        $requestData = $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'jenis' => 'nullable',
        ]);
        if ($request->hasFile('gambar')) {
            if ($model->foto != null && Storage::exists($model->foto)) {
                Storage::delete($model->foto);
            }
            $requestData['gambar'] = $request->file('gambar')->store('public');
         }
         $model->fill($requestData);
         $model->save();
         flash('Data berhasil diubah');
         return redirect()->route('berita.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $models = Model::findOrFail($id);
        $models->delete();
        flash('Berita berhasil dihapus');
        return back();
    }
}
