<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SkyMemberProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'model' => User::findOrFail(Auth::user()->id),
            'method' => 'POST',
            'route' => 'client.profil.store',
            'button' => 'Edit',
            'title' => 'Form Ubah Profil'
        ];
        return view('client.password_form', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'model' => User::findOrFail(Auth::user()->id),
            'method' => 'POST',
            'route' => 'client.profil.store',
            'button' => 'Edit',
            'title' => 'Form Ubah Profil'
        ];
        return view('client.profil_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'nohp' => 'required|unique:users,email,' . $id,
            'foto' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable' 
         ]);
         $model = User::findOrFail($id);
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
