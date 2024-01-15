<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessTagihanStore;
use App\Models\Tagihan as Model;
use App\Http\Requests\StoreTagihanRequest;
use App\Http\Requests\UpdateTagihanRequest;
use App\Models\Biaya;
use App\Models\Member;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Notifications\TagihanNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Notification;

class TagihanController extends Controller
{
    private $viewIndex ='tagihan_index';
    private $viewCreate = 'tagihan_form';
    private $viewEdit = 'tagihan_form';
    private $viewShow = 'tagihan_show';
    private $routePrefix = 'tagihan';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $models = Model::latest('tanggal_tagihan');
        if ($request->filled('q')) {
            $models = $models->search($request->q, null, true);
        }

        if ($request->filled('tahun')) {
            $models = $models->whereYear('tanggal_tagihan', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $models = $models->whereMonth('tanggal_tagihan', $request->bulan);
        }

        if ($request->filled('status')) {
            $models = $models->where('status', $request->status);
        }
        return view('admin.' . $this->viewIndex, [
            'models' => $models->paginate(settings()->get('app_pagination', '50')),
            'routePrefix' =>$this->routePrefix,
            'title' => 'Data Tagihan Pelanggan',
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
            'title' => 'Form Tagihan Pelanggan',
            'memberList' => Member::pluck('nama', 'id'),
            // 'desa' => Member::pluck('paket', 'paket'),
            // 'desa' => Member::pluck('desa', 'desa'),
            // 'kecamatan' => Member::pluck('kecamatan', 'kecamatan'),
            // 'biaya' => Biaya::get(),
        ];
        return view('admin.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagihanRequest $request)
    {
        $requestData = array_merge($request->validated(), ['user_id' => auth()->user()->id]);
        $processTagihan = new ProcessTagihanStore($requestData);
        dispatch($processTagihan);
        // $processTagihan = ProcessTagihanStore::dispatch($requestData);
        
        // flash("Data Tagihan Berhasil Disimpan")->success();
        // return back();

        // return response()->json([
        //     'message' => 'Data berhasil disimpan',
        // ], 200);
        // return redirect()->action('\Imtigger\LaravelJobStatus\ProgressController@progress', [$processTagihan->getJobStatusId()]);
        return redirect()->route('jobstatus.index', ['job_status_id' => $processTagihan->getJobStatusId()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $member = Member::findOrFail($request->member_id);
        $tahun = $request->tahun;
        $arrayData = [];
        foreach (bulanTagihan() as $bulan) {
            // if ($bulan == 1) {
            //     $tahun = $tahun + 1;
            // }
            $tagihan = Tagihan::where('member_id', $request->member_id)
            ->whereYear('tanggal_tagihan', $tahun)
            ->whereMonth('tanggal_tagihan', $bulan)
            ->first();
            $tanggalBayar = '';
            if ($tagihan != null && $tagihan->status != 'baru') {
                // $tanggalBayar = $tagihan->pembayaran->first()->tanggal_bayar->format('d/m/Y');
                $tanggalBayar = optional($tagihan->pembayaran->first())->tanggal_bayar;
                if ($tanggalBayar) {
                    $tanggalBayar = $tanggalBayar->format('d/m/Y');
                } else {
                    $tanggalBayar = 'Belum ada tanggal pembayaran';
                }
            };

            $arrayData[] = [
                'bulan' => ubahNamaBulan($bulan),
                'tahun' => $tahun,
                'total_tagihan' => $tagihan->total_tagihan ?? 0,
                'status_tagihan' => ($tagihan == null) ? false:true,
                'status_pembayaran' => ($tagihan == null) ? 'Belum Bayar' : $tagihan->status,
                'tanggal_bayar' => $tanggalBayar,
            ];

        }
        $data['kartuMember'] = collect($arrayData);
        $tagihan = Model::with('pembayaran')->findOrFail($id);
        $data['tagihan'] = $tagihan;
        $data['member'] = $tagihan->member;
        $data['periode'] = Carbon::parse($tagihan->tanggal_tagihan)->translatedFormat('F Y');
        $data['model'] = new Pembayaran();
        return view('admin.' . $this->viewShow, $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Model $tagihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagihanRequest $request, Model $tagihan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        if ($tagihan->status != 'baru') {
            flash()->addError("Data tagihan tidak dapat dihapus, karena sudah lunas");
            return back();
        }
        TagihanDetail::where('tagihan_id', $id)->delete();
        Tagihan::destroy($id);
        Pembayaran::where('tagihan_id', $id)->delete();
        flash("Data tagihan berhasil dihapus");
        return back();
    }
}
