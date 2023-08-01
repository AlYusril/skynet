<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User as Model;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    private $viewIndex ='client_index';
    private $viewCreate = 'user_form';
    private $viewEdit = 'user_form';
    private $viewShow = 'client_show';
    private $routePrefix = 'client';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $models = Model::client()->latest();
        if ($request->filled('q')) {
            $models = $models->search($request->q);
        }
        return view('admin.' . $this->viewIndex, [
            'models' => $models->paginate(settings()->get('app_pagination', '50')),
            'routePrefix' =>$this->routePrefix,
            'title' => 'Data Pelanggan',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'Form Data Pelanggan'
        ];
        return view('admin.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
           'name' => 'required',
           'email' => 'required|unique:users', 
           'nohp' => 'required|unique:users',
           'password' => 'required',
           'foto' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('foto')) {
            $requestData['foto'] = $request->file('foto')->store('public');
        }
        $requestData['password'] = bcrypt($requestData['password']);
        $requestData['email_verified_at'] = now();
        $requestData['akses'] = 'client';
        Model::create($requestData);
        flash('Data berhasil disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('admin.' . $this->viewShow, [
            'member' => \App\Models\Member::pluck('nama', 'id'),
            // 'member' => \App\Models\Member::where('client_id', null)->pluck('nama', 'id'),
            // 'member' => \App\Models\Member::pluck('nama', 'id'),
            'model' => Model::with('member')->client()->where('id', $id)->firstOrFail(),
            'title' => 'Detail Akun Pengguna'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'model' => Model::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'UPDATE',
            'title' => 'Form Data Pelanggan'
        ];
        return view('admin.'. $this->viewEdit, $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'nohp' => 'required|unique:users,nohp,' . $id,
            'password' => 'nullable',
            'foto' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
         $model = Model::findOrFail($id);
         if ($requestData['password'] == ""){
            unset($requestData['password']);
         }else{
            $requestData['password'] = bcrypt($requestData['password']);
         }
         //  Untuk Isi Foto
         if ($request->hasFile('foto')) {
            if ($model->foto != null && Storage::exists($model->foto)) {
                Storage::delete($model->foto);
            }
            $requestData['foto'] = $request->file('foto')->store('public');
         }
         $model->fill($requestData);
         $model->save();
         flash('Data berhasil diubah');
         return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Model::where('akses', 'client')->where('id',$id);
        $model->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}
