<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User as Model;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    private $viewIndex ='user_index';
    private $viewCreate = 'user_form';
    private $viewEdit = 'user_form';
    private $viewShow = 'user_show';
    private $routePrefix = 'user';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $models = Model::where('akses', '<>', 'client')->latest();
        if ($request->filled('q')) {
            $models = $models->search($request->q);
        }
        return view('admin.' . $this->viewIndex, [
            'models' => $models->paginate(settings()->get('app_pagination', '50')),
            'routePrefix' => $this->routePrefix,
            'title' => 'Data User'
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
            'title' => 'Form User'
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
           'foto' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'akses' => 'required|in:admin',
           'password' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $requestData['foto'] = $request->file('foto')->store('public');
        }

        $requestData['password'] = bcrypt($requestData['password']);
        $requestData['email_verified_at'] = now();
        Model::create($requestData);
        flash('Data berhasil disimpan');
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
        $data = [
            'model' => Model::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'UPDATE',
            'title' => 'Form User'
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
            'nohp' => 'required|unique:users,email,' . $id,
            'foto' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'akses' => 'required,' . $id,
            'password' => 'nullable',
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
         return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Model::findOrFail($id);

        if ($model->id == 1) {
            flash()->addError('Data tidak bisa dihapus');
            return back();
        }

        $model->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}
