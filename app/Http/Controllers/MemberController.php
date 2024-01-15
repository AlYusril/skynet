<?php

namespace App\Http\Controllers;

use App\Charts\MemberPaketChart;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Biaya;
use Illuminate\Http\Request;
use \App\Models\Member as Model;
use App\Models\User;

class MemberController extends Controller
{
    private $viewIndex ='member_index';
    private $viewCreate = 'member_form';
    private $viewEdit = 'member_form';
    private $viewShow = 'member_show';
    private $routePrefix = 'member';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, MemberPaketChart $memberPaketChart)
    {
        $models = Model::with('client', 'user')->latest();
        if ($request->filled('q')) {
            $models = $models->search($request->q);
        }

        if ($request->wantsJson()) {
            return response()->json($models->get(), 200);
        }
        // return response()->json($models->paginate(50));
        return view('admin.' . $this->viewIndex, [
            'models' => $models->paginate(settings()->get('app_pagination', '50')),
            'routePrefix' =>$this->routePrefix,
            'title' => 'Data Member',
            'memberPaketChart' => $memberPaketChart->build(),
        ]);
        // return $dataTable->render('admin.member_indexv2');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'listBiaya' => Biaya::has('children')->whereNull('parent_id')->pluck('nama', 'id'),
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'Form Data Pelanggan',
            'client' => User::where('akses', 'client')->pluck('name','id')
        ];
        return view('admin.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $requestData = $request->validated();
        $requestData['idpel'] = date('ym'). rand(1111, 99999);
        // input otomatis tabel paket
        $biaya = Biaya::findOrFail($requestData['biaya_id']);
        $requestData['paket'] = $biaya->nama;

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
            'listBiaya' => Biaya::has('children')->whereNull('parent_id')->pluck('nama', 'id'),
            'model' => Model::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'UPDATE',
            'title' => 'Form Data Member',
            'client' => User::where('akses', 'client')->pluck('name', 'id')
        ];
        return view('admin.'. $this->viewEdit, $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, $id)
    {
        $requestData = $request->validated();
         $model = Model::findOrFail($id);
         // Dapatkan objek Biaya baru
        $biayaBaru = Biaya::findOrFail($requestData['biaya_id']);
        
        // Periksa jika biaya_id berubah, perbarui nilai paket
        if ($model->biaya_id != $requestData['biaya_id']) {
            $requestData['paket'] = $biayaBaru->nama;
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
        // $model = Model::where('id',$id);
        $member = Model::findOrFail($id);
        if ($member->tagihan->count() >= 1) {
            flash('Data tidak bisa dihapus karena masih memiliki tagihan');
            return back();
        }
        $member->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}
