@extends('layouts.app_corona_blank')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-10">
        @include('admin.headerlaporan_index')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="{{ config('app.table_style') }}">
                                <thead class="{{ config('app.thead_style') }}">
                                <tr>
                                    <th width="1%">No</th>
                                    <th>Nama</th>
                                    <th>Id Pelanggan</th>
                                    <th>Tanggal Tagihan</th>
                                    <th>Status</th>
                                    <th>Total Tagihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($models as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->member->nama }}</td>
                                        <td>{{ $item->member->idpel }}</td>
                                        <td>{{ $item->tanggal_tagihan->translatedFormat('d-M-Y') }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td class="text-right">{{ formatRupiah($item->tagihanDetails->sum('jumlah_biaya')) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">Data kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <small class="mt-2 text-muted">Laporan Tagihan {{ $title }}</small>
                        {{-- <div class="mt-3">
                            {!! $models->links() !!}
                        </div> --}}
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
