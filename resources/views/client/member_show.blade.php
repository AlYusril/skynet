@extends('layouts.app_corona_client')

@section('content')
<div class="header">
</div>
<div class="row justify-content-center">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            {{-- <div class="card-header">{{ $title }}</div> --}}
            <div class="card-body">
               <div class="card-title">Detail Member</div>
               <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <td width="15%">Status Member</td>
                                <td>: <span class="badge {{ $model->status == 'aktif' ? 'badge-outline-success' : 'badge-outline-danger' }}">{{ $model->status }}</span></td>
                            </tr>

                            <tr>
                                <td>Akun</td>
                                <td>: {{ $model->client->name }}</td>
                            </tr>

                            <tr>
                                <td>Nama</td>
                                <td>: {{ $model->nama }}</td>
                            </tr>

                            <tr>
                                <td>No HP</td>
                                <td>: {{ $model->nohp }}</td>
                            </tr>

                            <tr>
                                <td>Desa</td>
                                <td>: {{ $model->desa }}</td>
                            </tr>

                            <tr>
                                <td>Kecamatan</td>
                                <td>: {{ $model->kecamatan }}</td>
                            </tr>

                            <tr>
                                <td>Alamat Lengkap</td>
                                <td>: {{ $model->alamat_lengkap }}</td>
                            </tr>

                            <tr>
                                <td>ID Pelanggan</td>
                                <td>: {{ $model->idpel }}</td>
                            </tr>

                            <tr>
                                <td>Paket</td>
                                <td>: {{ $model->biaya->nama }}</td>
                            </tr>
                            
                            <tr>
                                <td>Tanggal Buat</td>
                                <td>: {{ $model->created_at->format('d/m/Y H:i') }}</td>
                            </tr>

                            <tr>
                                <td>Di Buat Oleh</td>
                                <td>: {{ $model->user->name }}</td>
                            </tr>
                        </thead>
                    </table>
               </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tagihan Pelanggan</h5>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="{{ config('app.table_style') }}">
                                <thead class="{{ config('app.thead_style') }}">
                                    <th width="2%">NO</th>
                                    <th>Item Tagihan</th>
                                    <th>Jumlah Tagihan</th>
                                </thead>
                                <tbody>
                                    @foreach ($model->biaya->children as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td class="text-right">{{ formatRupiah($item->jumlah) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <td colspan="2" class="text-right">Total Tagihan</td>
                                    <td class="text-center font-weight-bold">{{ formatRupiah($model->biaya->children->sum('jumlah')) }}</td>
                                </tfoot>
                            </table>
                            {{-- <a href="{{ route('kartumember.index', [
                                'member_id' => $model->id,
                                'tahun' => date('Y'),
                                ]) }}" target="_blank">
                                <i class="fa fa-print"></i> Kartu Tagihan Pelanggan
                            </a> --}}
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
