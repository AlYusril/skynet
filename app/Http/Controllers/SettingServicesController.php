<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Landingpage as Model;
use Illuminate\Support\Facades\Storage;

class SettingServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Model::where('jenis', 'services')->get();
        return view('admin.setting_services_index',[
            'models' => $models,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $models = new Model;
        return view('admin.setting_services_form',[
            'models' => $models,
            'method' => 'POST',
            'route' => ['services.store'],
            'button' => 'SIMPAN',
            'title' => 'Input Form Services',
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
            'gambar' => 'required',
        ]);
        $requestData['jenis'] = 'services';
        // if ($request->hasFile('gambar')) {
        //     $requestData['gambar'] = $request->file('gambar')->store('public');
        // }
        Model::create($requestData);
        flash('Berita berhasil di upload');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $models = Model::where('jenis', 'services')->get();
        return view('admin.setting_services_show',[
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
            'route' => ['services.update', $id],
            'button' => 'UPDATE',
            'title' => 'Edit Form Services',
        ];
        // dd($data);
        return view('admin.setting_services_form',$data);
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
            'gambar' => 'required',
        ]);
        // if ($request->hasFile('gambar')) {
        //     if ($model->foto != null && Storage::exists($model->foto)) {
        //         Storage::delete($model->foto);
        //     }
        //     $requestData['gambar'] = $request->file('gambar')->store('public');
        //  }
         $model->fill($requestData);
         $model->save();
         flash('Data berhasil diubah');
         return redirect()->route('services.index');
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
