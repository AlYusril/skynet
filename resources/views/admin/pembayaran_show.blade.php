@extends('layouts.app_corona')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">DATA PEMBAYARAN</h5>
                <div class="table-responsive mt-3">
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <td colspan="2" class="text-white bg-dark">INFORMASI TAGIHAN PELANGGAN</td>
                            </tr>
                            <tr>
                                <td width="18%">No</td>
                                <td>{{ $model->id }}</td>
                            </tr>
                            <tr>
                                <td>ID Tagihan</td>
                                <td>{{ $model->tagihan_id }}</td>
                            </tr>
                            <tr>
                                <td>Item Tagihan</td>
                                <td>
                                    <table>
                                        <thead>
                                            <th>No</th>
                                            <th>Nama Biaya</th>
                                            <th>Jumlah</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($model->tagihan->tagihanDetails as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama_biaya }}</td>
                                                    <td>{{ formatRupiah($item->jumlah_biaya) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Tagihan</td>
                                <td>: {{ formatRupiah($model->tagihan->tagihanDetails->sum('jumlah_biaya')) }}</td>
                            </tr>
                            {{-- <tr>
                                <td>Cetak Invoice</td>
                                <td>: <a href="{{ route('invoice.show' , $model->tagihan_id) }}" target="_blank"><i class="fa fa-print"></i> Invoice</a></td>
                            </tr> --}}
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informasi Pelanggan</h5>
                <div class="table-responsive">
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <td colspan="2" class="text-white bg-dark">INFORMASI PELANGGAN</td>
                            </tr>
                            <tr>
                                <td>Nama pelanggan</td>
                                <td>: {{ $model->tagihan->member->nama }}</td>
                            </tr>
                            <tr>
                                <td>Nama Akun</td>
                                <td>: {{ $model->tagihan->member->client->name ?? 'Belum ada' }}</td>
                            </tr>
                            @if ($model->metode_pembayaran != 'manual')
                                <tr>
                                    <td>Bank Tujuan</td>
                                    <td>: {{ $model->bankSkynet->nama_rekening }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>Tanggal Pembayaran</td>
                                <td>: {{ optional($model->tanggal_bayar)->translatedFormat('d F Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td>Total Tagihan</td>
                                <td>: {{ formatRupiah($model->tagihan->tagihanDetails->sum('jumlah_biaya')) }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Dibayar</td>
                                <td>: {{ formatRupiah($model->jumlah_dibayar) }}</td>
                            </tr>
                            <tr>
                                <td>Metode Pembayaran</td>
                                <td>: {{ $model->metode_pembayaran }}</td>
                            </tr>
                            <tr>
                                <td>Bukti Bayar</td>
                                <td>: 
                                    <a href="javascript:void[0]" 
                                        onclick="popupCenter({url: '{{ \Storage::url($model->bukti_bayar) }}', title: 'Bukti Pembayaran', w: 900, h: 500}); ">
                                    Lihat Bukti Bayar
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Status Konfirmasi</td>
                                <td>: {{ $model->status_konfirmasi }}</td>
                            </tr>
                            <tr>
                                <td>Status Pembayaran</td>
                                <td>: {{ $model->tagihan->getStatusTagihanClient() }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Konfirmasi</td>
                                <td>: {{ optional($model->tanggal_konfirmasi)->translatedFormat('d F Y H:i') }}</td>
                            </tr>
                        </thead>
                    </table>
                </div>
                @if ($model->tanggal_konfirmasi == null)
                {!! Form::open([
                    'route' => $route, 
                    'method' => 'PUT', 
                    'onsubmit' => 'return confirm ("Apakah anda yakin?")'
                ]) !!}
                {!! Form::hidden('pembayaran_id', $model->id, []) !!}
                {!! Form::submit('Konfirmasi Pembayaran', ['class' => 'btn btn-primary mt-3']) !!}
                {!! Form::close() !!}
                @else
                <div class="alert alert-primary mt-2" role="alert">
                    <h4>TAGIHAN SUDAH DI KONFIRMASI</h4>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
