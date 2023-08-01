@extends('layouts.app_corona_client')

@section('content')
<div class="header">
    <div class="page-title">DATA PEMBAYARAN</div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <td colspan="2" class="card-title text-white bg-dark">INFORMASI TAGIHAN PELANGGAN</td>
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
                            <tr>
                                <td>Cetak Invoice</td>
                                <td>: <a href="{{ route('invoice.show' , $model->tagihan_id) }}" target="_blank"><i class="fa fa-print"></i> Invoice</a></td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-light">
                        <tr>
                            <td colspan="2" class="text-white bg-dark">INFORMASI PELANGGAN</td>
                        </tr>
                        <tr>
                            <td>Nama pelanggan</td>
                            <td>: {{ $model->tagihan->member->nama }}</td>
                        </tr>
                        <tr>
                            <td>Nama Akun</td>
                            <td>: {{ $model->tagihan->member->client->name }}</td>
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
                        @if ($model->tanggal_konfirmasi != null)
                            <tr>
                                <td>Cetak Kwitansi</td>
                                <td>: <a href="{{ route('kwitansipembayaran.show', $model->id) }}" target="_blank"><i class="fa fa-print"></i> Download Kwitansi</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="footer">
            @if ($model->tanggal_konfirmasi != null)
                <div class="alert alert-primary" role="alert">
                    <h4>TAGIHAN SUDAH DI KONFIRMASI</h4>
                </div>
                <a href="{{ route('kwitansipembayaran.show', $model->id) }}" target="blank" class="fa fa-print">Download Kwitansi</a>
            @else
                {!! Form::open([
                    'route' => [ 'client.pembayaran.destroy', $model->id],
                    'method' => 'DELETE',
                    'onsubmit' => 'return confirm("Yakin menghapus data ini?")',
                ]) !!}

                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i> Batalkan Konfirmasi
                </button>
                {!! Form::close() !!}
            @endif
        </div>
    </div>
</div>
@endsection
