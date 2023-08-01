@extends('layouts.app_corona')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                <div class="card-body">
                   <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <td width="15%">Status Member</td>
                                    <td>: <span class="badge {{ $model->status == 'aktif' ? 'badge-primary' : 'badge-danger' }}">{{ $model->status }}</span></td>
                                </tr>

                                <tr>
                                    <td>Akun</td>
                                    <td>: {{ $model->client->name ?? 'Belum ada' }}</td>
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
                        <h5 class="mt-3">Tagihan Pelanggan</h5>
                        <div class="row">
                            <div class="col-md-5">
                                <table class="table table-bordered table-sm">
                                    <tbody>
                                        <thead>
                                            <th>NO</th>
                                            <th>Item Tagihan</th>
                                            <th>Jumlah Tagihan</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($model->biaya->children as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td class="text-right">{{ formatRupiah($item->jumlah) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <td colspan="2">Total Tagihan</td>
                                            <td class="text-right font-weight-bold">{{ formatRupiah($model->biaya->children->sum('jumlah')) }}</td>
                                        </tfoot>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('status.update',[
                                    'model' => 'member',
                                    'id' => $model->id,
                                    'status' => $model->status == 'aktif' ? 'non-aktif' : 'aktif',
                                ]) }}" 
                                class="btn btn-sm btn-primary mt-3" onclick="return confirm('Anda yakin ?')">
                                {{ $model->status == 'aktif' ? 'Non-Aktifkan Pelanggan ini' : 'Aktifkan Pelanggan ini' }}
                            </a>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
