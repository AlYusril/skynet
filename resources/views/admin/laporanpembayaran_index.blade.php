@extends('layouts.app_corona_blank')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 mt-3">
        @include('admin.headerlaporan_index')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="{{ config('app.table_style') }}">
                                <thead class="{{ config('app.thead_style') }}">
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Nama</th>
                                        <th>Id Pelanggan</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Metode Bayar</th>
                                        <th>Status</th>
                                        <th>Jumlah Dibayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($models as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->tagihan->member->nama }}</td>
                                            <td>{{ $item->tagihan->member->idpel }}</td>
                                            <td>{{ $item->tanggal_bayar->translatedFormat(config('app.format_tanggal')) }}</td>
                                            <td>{{ $item->metode_pembayaran }}</td>
                                            <td>
                                                {{ $item->status_konfirmasi }} <br>
                                                {{ optional($item->tanggal_konfirmasi)->translatedFormat(config('app.format_tanggal')) }}
                                            </td>
                                            <td class="text-right">{{ formatRupiah($item->jumlah_dibayar) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">Data kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{-- <div class="mt-3">
                                {!! $models->links() !!}
                            </div> --}}
                            <small class="mt-2 text-muted">Laporan Tagihan {{ $title }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
