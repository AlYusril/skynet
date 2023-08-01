<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBiayaRequest;
use App\Http\Requests\UpdateBiayaRequest;
use Illuminate\Http\Request;
use \App\Models\Biaya as Model;

class BiayaController extends Controller
{
    private $viewIndex ='biaya_index';
    private $viewCreate = 'biaya_form';
    private $viewEdit = 'biaya_form';
    private $viewShow = 'biaya_show';
    private $routePrefix = 'biaya';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->filled('q')) {
            $models = Model::with('user')->whereNull('parent_id')->search($request->q)->paginate(settings()->get('app_pagination', '50'));
        }else {
            $models = Model::with('user')->whereNull('parent_id')->latest()->paginate(settings()->get('app_pagination', '50'));
        }
        return view('admin.' . $this->viewIndex, [
            'models' => $models,
            'routePrefix' =>$this->routePrefix,
            'title' => 'Data Paket Internet',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $biaya = new Model();
        if ($request->filled('parent_id')) {
            $biaya = Model::with('children')->findOrFail($request->parent_id);
        }
        $data = [
            'parentData' => $biaya,
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'Form Paket Internet',
        ];
        return view('admin.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBiayaRequest $request)
    {
        Model::create($request->validated());
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
        ];
        return view('admin.'. $this->viewEdit, $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBiayaRequest $request, $id)
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
        $model = Model::findOrFail($id);
        if ($model->children->count() >= 1) {
            flash()->addError('Data tidak dapat dihapus, hapus item biaya terlebih dahulu');
            return back();
        }
        // validasi relasi ke model member
        if ($model->member->count() >= 1) {
            flash()->addError('Data gagal dihapus karena masih memiliki relasi ke data member');
            return back();
        }
        $model->delete();
        flash('Data berhasil dihapus');
        return back();
    }

    public function deleteItem($id) {
        $model = Model::findOrFail($id);
        if ($model->parent->member->count() >= 1) {
            flash()->addError('Data gagal dihapus karena terkait data lain');
            return back();
        }
        $model->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}
