<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBankSkynetRequest;
use App\Http\Requests\UpdateBankSkynetRequest;
use Illuminate\Http\Request;
use \App\Models\Bank as Bank;
use \App\Models\BankSkynet as Model;

class BankSkynetController extends Controller
{
    private $viewIndex ='bankskynet_index';
    private $viewCreate = 'bankskynet_form';
    private $viewEdit = 'bankskynet_form';
    private $viewShow = 'bankskynet_show';
    private $routePrefix = 'bankskynet';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $models = Model::paginate(settings()->get('app_pagination', '50'));
        return view('admin.' . $this->viewIndex, [
            'models' => $models,
            'routePrefix' =>$this->routePrefix,
            'title' => 'Data Rekening Bank Skynet',
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
            'title' => 'Form Rekening Bank Skynet',
            'listBank' => Bank::pluck('nama_bank', 'id'),
        ];
        return view('admin.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBankSkynetRequest $request)
    {
        $requestData = $request->validated();
        $bank = Bank::find($request['bank_id']);
        unset($requestData['bank_id']);
        $requestData['kode'] = $bank->sandi_bank;
        $requestData['nama_bank'] = $bank->nama_bank;

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
            'model' => Model::findOrFail($id),
            'title' => 'Detail Member'
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
            'title' => 'Form Paket Internet',
            'listBank' => Bank::pluck('nama_bank', 'id'),
        ];
        return view('admin.'. $this->viewEdit, $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBankSkynetRequest $request, $id)
    {
         $model = Model::findOrFail($id);
         $model->fill($request->validated());
         $model->save();
         flash('Data berhasil diubah');
         return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Model::where('id',$id);
        $model->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}
